<?php

namespace app\common\logic;

use think\Db;
use think\Hook;
use think\Exception;
use app\common\model\GoldchainDaysum;
use app\common\model\GoldchainEntrust;
use app\common\model\GoldchainTrade;
use app\common\model\Users;
use app\common\model\GoldchainLog;
use app\mobile\controller\Goldchain;
use app\common\model\AccountLog;

class GoldchainLogic
{
    const TRADE_SOLD_WAY = 1, TRADE_BUY_WAY = 2;

    /**
     * 添加新淘链相关余额
     * @param integer $user_id 用户id
     * @param integer $type 类型1.新淘链 2.算力 3.余额(消费余额)
     * @param float $addQty 要添加的数量
     * @param float $trade_no 相关业务单号
     * @param string $memo 备注
     * @return array 返回数组
     */
    public function addBalance($user_id, $type, $addQty, $trade_no = '', $memo = '')
    {
        $decimalScale = config('default_decimal_scale');
        $user = Users::get($user_id);
        $return = array();
        $addQty = number_format($addQty, $decimalScale, '.', ''); //转换为定点
        $fieldName = array(
            'jin_num' => '新淘链',
            'consume_cp' => '消费算力',
            'user_money' => '消费余额',
        );
        if ($type == 1) {
            $field = 'jin_num';
            $logField = 'chain';
        } elseif ($type == 2) {
            $field = 'consume_cp';
            $logField = 'power';
        } elseif ($type == 3) {
            $field = 'user_money';
            $logField = 'user_money';
        } else {
            //throw new Exception('类型参数传递异常');
            $return = array(
                'code' => 0,
                'msg' => '类型参数传递异常',
                'data' => null,
            );
            return $return;
        }

        $user->$field = bcadd(strval($user->$field), strval($addQty), $decimalScale);
        if (bccomp($user->$field, '0', $decimalScale) < 0) {
            //throw new Exception('用户' . $field . '余额不足');
            $return = array(
                'code' => 0,
                'msg' => '用户' . $fieldName[$field] . '不足',
                'data' => null,
            );
            return $return;
        }

        $result = $user->save();
        if ($result) {
            //添加日志
            $logData = array(
                'user_id' => $user_id,
                $logField => $addQty,
                'trade_no' => $trade_no,
                'memo' => $memo,
            );
            $goldchainLog = GoldchainLog::create($logData);
            $return = array(
                'code' => 1,
                'msg' => '余额变更成功',
                'data' => null,
            );
            return $return;
        } else {
            //throw new Exception('添加余额失败');
            $return = array(
                'code' => 0,
                'msg' => '余额变更失败',
                'data' => null,
            );
            return $return;
        }
    }

    /**
     * 冻结新淘链相关余额(只是冻结,并不加减和回退相关余额)
     * @param integer $user_id 用户id
     * @param integer $type 类型1.新淘链 2.算力 3.余额
     * @param float @addQty 要冻结的数量
     * @param float $trade_no 相关业务单号
     * @param string $memo 备注
     * @return array 返回数组
     */
    public function frozenBalance($user_id, $type, $addQty, $trade_no = '', $memo = '')
    {
        $decimalScale = config('default_decimal_scale');
        $user = Users::get($user_id);
        $return = array();
        $fieldName = array(
            'frost_jin_num' => '新淘链',
            'frost_consume_cp' => '算力',
            'frozen_money' => '消费余额余额',
        );
        $addQty = number_format($addQty, $decimalScale, '.', ''); //转换为定点
        if ($type == 1) {
            $field = 'frost_jin_num';
            $logField = 'frozen_chain';
        } elseif ($type == 2) {
            $field = 'frost_consume_cp';
            $logField = 'frozen_power';
        } elseif ($type == 3) {
            $field = 'frozen_money';
            $logField = 'frozen_money';
        } else {
            //throw new Exception('类型参数传递异常');
            $return = array(
                'code' => 0,
                'msg' => '类型参数传递异常',
                'data' => null,
            );
            return $return;
        }
        $fieldValue = bcadd(strval($user->$field), strval($addQty), $decimalScale);
        if (bccomp($fieldValue, '0', $decimalScale) < 0) {
            //throw new Exception('用户(uid:' . $user_id . ')' . $field . '余额不足');
            $return = array(
                'code' => 0,
                'msg' => '用户(uid:' . $user_id . ')' . '已冻结'. $fieldName[$field] .'不足',
                'data' => null,
            );
            return $return;
        }
        $user->$field = $fieldValue;
        $result = $user->save();
        if ($result) {
            //添加日志
            $logData = array(
                'user_id' => $user_id,
                $logField => $addQty,
                'trade_no' => $trade_no,
                'memo' => $memo,
            );
            $goldchainLog = GoldchainLog::create($logData);
            $return = array(
                'code' => 1,
                'msg' => $fieldName[$field] . '冻结成功',
                'data' => null,
            );
            return $return;
        } else {
            $return = array(
                'code' => 0,
                'msg' => $fieldName[$field] . '冻结失败',
                'data' => null,
            );
            return $return;
        }
    }

    /**
     * 余额冻结
     * @param integer $user_id 用户id
     * @param integer $type 类型1.新淘链 2.算力 3.余额(消费余额)
     * @param float $qty 冻结的数量
     * @param float $trade_no 相关业务单号
     * @param string $memo 备注
     * @return array 返回数组
     */
    public function balanceToFrozen($user_id, $type, $qty, $trade_no = '', $memo = '')
    {
        $decimalScale = config('default_decimal_scale');
        //检测余额是否充足
        $user = Users::get($user_id);
        $fieldName = array(
            'jin_num' => '新淘链',
            'consume_cp' => '算力',
            'frost_jin_num' => '已冻结新淘链',
            'frost_consume_cp' => '已冻结算力',
            'user_money' => '消费余额',
            'frozen_money' => '已冻结消费余额',
        );
        $result = array();
        $qty = number_format($qty, $decimalScale, '.', ''); //转换为定点
        if ($type == 1) {
            $balanceField = 'jin_num';
            $frozenField = 'frost_jin_num';
        } elseif ($type == 2) {
            $balanceField = 'consume_cp';
            $frozenField = 'frost_consume_cp';
        } elseif ($type == 3) {
            $balanceField = 'user_money';
            $frozenField = 'frozen_money';
        } else {
            //throw new Exception('类型参数传递异常');
            $result = array(
                'code' => '0',
                'msg' => '类型参数传递异常',
                'data' => null,
            );
            return $result;
        }
        $user->$balanceField = bcsub(strval($user->$balanceField), strval($qty), $decimalScale);
        $user->frozenField = bcadd(strval($user->$frozenField), strval($qty), $decimalScale);
        if (bccomp($user->$balanceField, '0') < 0) {
            //throw new Exception('用户' . $balanceField . '余额不足');
            $result = array(
                'code' => '0',
                'msg' => '用户' . $fieldName[$balanceField] . '不足',
                'data' => null,
            );
            return $result;
        }
        Db::transaction(function () use ($user_id, $type, $qty, $trade_no, $memo, &$result) {
            $addBalanceResult = $this->addBalance($user_id, $type, -$qty, $trade_no, $memo . '扣除' . ($type == 1 ? '新淘链' : '算力'));
            if ($addBalanceResult['code'] == 0) {
                //throw new Exception('扣除用户' . $fieldName[$balanceField] . '余额失败');
                $result = array(
                    'code' => '0',
                    'msg' => '扣除用户' . $fieldName[$balanceField] . '失败',
                    'data' => null,
                );
                return $result;
            }
            $frozenBalanceResult = $this->frozenBalance($user_id, $type, $qty, $trade_no, $memo . '冻结'. ($type == 1 ? '新淘链' : '算力'));
            if ($frozenBalanceResult['code'] == 0) {
                //throw new Exception('冻结用户余额(' . $fieldName[$balanceField] . ')失败');
                $result = array(
                    'code' => '0',
                    'msg' => '冻结用户' . $fieldName[$balanceField] . '失败',
                    'data' => null,
                );
                return $result;
            }
            $result = array(
                'code' => '1',
                'msg' => $fieldName[$balanceField] . '冻结成功',
                'data' => null,
            );
        });
        return $result;
    }

    /**
     * 撤销冻结
     * @param integer $user_id 用户id
     * @param integer $type 类型1.新淘链 2.算力 3.余额
     * @param integer $qty 撤销冻结的数量
     * @param float $trade_no 相关业务单号
     * @param string $memo 备注
     * @return array 返回数组
     */
    public function frozenToBalance($user_id, $type, $qty, $trade_no = '', $memo = '')
    {
        $decimalScale = config('default_decimal_scale');
        //检测余额是否充足
        $user = Users::get($user_id);
        $fieldName = array(
            'jin_num' => '新淘链',
            'consume_cp' => '算力',
            'user_money' => '余额',
            'frost_jin_num' => '已冻结新淘链',
            'frost_consume_cp' => '已冻结算力',
            'frozen_money' => '已冻结余额',

        );
        $result = array();
        $qty = number_format($qty, $decimalScale, '.', ''); //转换为定点
        if ($type == 1) {
            $balanceField = 'jin_num';
            $frozenField = 'frost_jin_num';
        } elseif ($type == 2) {
            $balanceField = 'consume_cp';
            $frozenField = 'frost_consume_cp';
        } elseif ($type ==3) {
            $balanceField = 'user_money';
            $frozenField = 'frozen_money';
        } else {
            //throw new Exception('类型参数传递异常');
            $result = array(
                'code' => '0',
                'msg' => '类型参数传递异常',
                'data' => null,
            );
            return $result;
        }
        $user->frozenField = bcsub(strval($user->$frozenField), strval($qty), $decimalScale);
        $user->$balanceField = bcadd(strval($user->$balanceField), strval($qty), $decimalScale);
        if (bccomp($user->$frozenField, '0') < 0) {
            //throw new Exception('用户' . $frozenField . '不足');
            $result = array(
                'code' => '0',
                'msg' => '用户' . $fieldName[$frozenField] . '不足',
                'data' => null,
            );
            return $result;
        }
        Db::transaction(function () use ($user_id, $type, $qty, $trade_no, $memo, &$result) {
            //反冻结
            $frozenBalanceResult = $this->frozenBalance($user_id, $type, -$qty, $trade_no, $memo . '反冻结' . $fieldName[$balanceField]);
            if ($frozenBalanceResult['code'] == 0) {
                //throw new Exception('扣除用户' . $fieldName[$balanceField] . '余额失败');
                $result = array(
                    'code' => '0',
                    'msg' => '反冻结用户' . $fieldName[$balanceField] . '失败',
                    'data' => null,
                );
                return $result;
            }
            //余额增加
            $addBalanceResult = $this->addBalance($user_id, $type, $qty, $trade_no, $memo . '撤回' . $fieldName[$balanceField]);
            if ($addBalanceResult['code'] == 0) {
                //throw new Exception('冻结用户余额(' . $fieldName[$balanceField] . ')失败');
                $result = array(
                    'code' => '0',
                    'msg' => '撤回用户' . $fieldName[$frozenField] . '失败',
                    'data' => null,
                );
                return $result;
            }
            $result = array(
                'code' => '1',
                'msg' => $fieldName[$balanceField] . '撤回成功',
                'data' => null,
            );
        });
        return $result;
    }

    /**
     * 添加业务委托
     * @param integer $user_id 用户id
     * @param integer $type 类型[1.卖出 2.买入]
     * @param float $qty 委托数量
     * @param float $price 委托价格
     * @return array 返回数组
     */
    public function addEntrust($user_id, $type, $qty, $price)
    {
        $decimalScale = config('default_decimal_scale');
        if ($type == 1) {
            //冻结新淘链
            $frozenType = 1;
            $targetQty = number_format($qty, $decimalScale, '.', '');
        } elseif ($type == 2) {
            //冻结算力
            $frozenType = 2;
            $qty = number_format($qty, $decimalScale, '.', '');
            $price = number_format($price, $decimalScale, '.', '');
            $power = bcmul($qty, $price, $decimalScale);
            $targetQty = $power;
        } elseif ($type == 3) {
            //冻结余额
            $frozenType = 3;
            $qty = number_format($qty, $decimalScale, '.', '');
            $price = number_format($price, $decimalScale, '.', '');
            $power = bcmul($qty, $price, $decimalScale);
            $targetQty = $power;
        } else {
            //throw new Exception('未知交易类型!');
            return array(
                'code' => 0,
                'msg' => '添加失败，未知交易类型',
                'data' => null,
            );
        }

        Db::startTrans();

        //添加委托
        $data = array(
            'user_id' => $user_id,
            'type' => $type,
            'total_qty' => $qty,
            'price' => $price,
        );
        $goldChainEntrust = GoldchainEntrust::create($data);

        if (!$goldChainEntrust->id) {
            Db::rollback();
            return array(
                'code' => 0,
                'msg' => '添加失败',
                'data' => null,
            );
        }
        $result = $this->balanceToFrozen($user_id, $frozenType, $targetQty, $goldChainEntrust->trade_no, '添加业务委托');
        if ($result['code'] == 0) {
            Db::rollback();
            return array(
                'code' => 0,
                'msg' => '添加委托失败：冻结资金失败',
                'data' => null,
            );
        }

        Db::commit();
        return array(
            'code' => 1,
            'msg' => '添加成功',
            'data' => $goldChainEntrust,
        );
    }

    /**
     * 创建委托交易
     * @param integer $type 委托类型(是否委托) 0.普通交易(否)1.委托交易(是)
     * @param integer $way 交易发起类型 1.卖出 2.买入
     * @param integer $sold_entrust_id
     * @param integer $user_id 交易发起人id
     * @param integer $relation_user_id 交易完成人id
     * @param integer $buy_entrust_id
     * @param float $trade_qty
     * @return array 返回数组
     */
    private function addEntrustTrade($type, $way, $user_id, $relation_user_id, $sold_entrust_id, $buy_entrust_id, $trade_qty)
    {
        $data = array(
            'type' => $type,
            'way' => $way,
            'sold_entrust_id' => $sold_entrust_id,
            'buy_entrust_id' => $buy_entrust_id,
            'trade_qty' => $trade_qty,
        );
        $goldChainTrade = GoldchainTrade::create($data);
        $this->finishEntrustTrade($goldChainTrade->id); //委托类交易应自动完成
        //更新原委托数量
        if ($goldChainTrade->id) {
            $this->updateEntrust($goldChainTrade->id);
            return array(
                'code' => 1,
                'msg' => '交易成功',
                'data' => $goldChainTrade,
            );
        } else {
            return array(
                'code' => 0,
                'msg' => '交易失败',
                'data' => null,
            );
        }
    }

    /**
     * 完成委托交易
     * @param integer $trade_id 交易id
     * @return bool 成功返回真,失败返回假
     */
    private function finishEntrustTrade($trade_id)
    {
        $goldchainTrade = GoldchainTrade::get($trade_id);
        //如果交易状态不是未完成或者交易不是委托类型的就拒绝完成
        if ($goldchainTrade->status != 0 || $goldchainTrade->type == 0) {
            return false;
        }
        $goldchainTrade->status = 1;
        $result = $goldchainTrade->save();
        return $result ? true : false;
    }

    /**
     * 委托交易后刷新用户的相关新淘链相关资金
     * @param integer $trade_id 交易id
     * @return bool 成功返回真,失败返回假
     */
    private function afterEntrustTrade($trade_id)
    {
        $goldchainTrade = GoldchainTrade::get($trade_id);
        if ($goldchainTrade->way == GoldchainTrade::TRADE_SOLD_WAY) {
            $buy_user_id = $goldchainTrade->relation_user_id;
            $sold_user_id = $goldchainTrade->user_id;
        } elseif ($goldchainTrade->way == GoldchainTrade::TRADE_BUY_WAY) {
            $buy_user_id = $goldchainTrade->user_id;
            $sold_user_id = $goldchainTrade->relation_user_id;
        } else {
            throw new Exception('交易方式(way)异常');
            return false;
        }
        if (empty($buy_user_id) || empty($sold_user_id)) {
            throw new Exception('买家和卖家id不能为0');
            return false;
        }
        Db::startTrans();
        //扣除买方冻结的算力,增加买方的新淘链
        $res = $this->frozenBalance($buy_user_id, 2, -$goldchainTrade->amount, $goldchainTrade->trade_no, '交易扣除冻结算力');
        if ($res['code'] == 0) {
            Db::rollback();
            return false;
        }
        $res = $this->addBalance($buy_user_id, 1, $goldchainTrade->trade_qty, $goldchainTrade->trade_no, '交易成功增加新淘链');
        if ($res['code'] == 0) {
            Db::rollback();
            return false;
        }
        //扣除卖方冻结的新淘链,增加提现币
        $res = $this->frozenBalance($sold_user_id, 1, -$goldchainTrade->trade_qty, $goldchainTrade->trade_no, '交易扣除冻结新淘链');
        if ($res == 0) {
            return false;
            Db::rollback();
        }
        $res = accountLog($sold_user_id, 0, 0, '交易结算提现币', 0, 0, '', 0, floatval(number_format($goldchainTrade->amount, config('default_decimal_scale'), '.', '')));
        if ($res['code'] == 0) {
            return false;
            Db::rollbak();
        }
        Db::commit();
        return true;
    }

    /**
     * 交易后刷新买卖双方委托
     * @param integer $trade_id 交易ID
     * @return void
     */
    private function updateEntrust($trade_id)
    {
        $goldchainTrade = GoldchainTrade::find($trade_id);
        if ($goldchainTrade) {
            $soldEntrust = $goldchainTrade->soldEntrust;
            $buyEntrust = $goldchainTrade->buyEntrust;
            $soldEntrust->finish_qty = bcadd($soldEntrust->finish_qty, $goldchainTrade->trade_qty);
            $buyEntrust->finish_qty = bcadd($buyEntrust->finish_qty, $goldchainTrade->trade_qty);

            Db::startTrans();
            $soldResult = $soldEntrust->save();
            $buyResult = $buyEntrust->save();
            if (!$soldResult || !$buyResult) {
                Db::rollbak();
            }
            //扣除买方冻结的算力,增加买方的新淘链
            $this->frozenBalance(
                $buyEntrust->user_id,
                2,
                -$goldchainTrade->amount,
                $goldchainTrade->trade_no,
                '交易扣除冻结算力'
            ) || Db::rollback();
            $this->addBalance(
                $buyEntrust->user_id,
                1,
                $goldchainTrade->trade_qty,
                $goldchainTrade->trade_no,
                '交易成功增加新淘链'
            ) || Db::rollback();

            //扣除卖方冻结的新淘链,增加提现币
            $this->frozenBalance(
                $soldEntrust->user_id,
                1,
                -$goldchainTrade->trade_qty,
                $goldchainTrade->trade_no,
                '交易扣除冻结新淘链'
            ) || Db::rollback();
            accountLog(
                $soldEntrust->user_id,
                0,
                0,
                '交易结算提现币',
                0,
                0,
                '',
                0,
                floatval(number_format($goldchainTrade->amount, config('default_decimal_scale'), '.', '')),
                0,
                0
            ) || Db::rollbak();
            Db::commit();
        } else {
            throw new Exception('交易未找到');
        }
    }

    /**
     * 业务处理
     * @param integer $id 委托ID
     */
    public function handleEntrust($id)
    {
        //买入和卖出的处理
        $goldChainEntrust = GoldchainEntrust::get($id);
        if ($goldChainEntrust->type == 1) {
            $this->handleSoldEntrust($goldChainEntrust);
        } elseif ($goldChainEntrust->type == 2) {
            $this->handleBuyEntrust($goldChainEntrust);
        } else {
            throw new Exception('业务处理异常');
            return false;
        }
    }

    /**
     * 处理卖出委托
     * @param object $goldChainEntrust 委托模型对象
     * @return void
     */
    public function handleSoldEntrust($goldChainEntrust)
    {
        //查找买入委托中价格高于或等于标价的最早记录
        $buyEntrusts = GoldchainEntrust::where(function ($query) use ($goldChainEntrust) {
            $query->where('type', 2)
                ->where('price', '>=', $goldChainEntrust->price)
                ->where('surplus_qty', '>', 0)
                ->where('status', 0);
        })->order('create_time')->select();

        foreach ($buyEntrusts as $key => $buyEntrust) {
            if (bccomp($goldChainEntrust->surplus_qty, '0', config('default_decimal_scale')) == 0) {
                //业务结束
                break;
            } else {
                //业务继续
                $satisfy = bccomp($buyEntrust->surplus_qty, $goldChainEntrust->surplus_qty);
                $factQty = $satisfy >=0 ? $goldChainEntrust->surplus_qty : $buyEntrust->surplus_qty; //根据买卖需求计算实际数量避免溢出
                //创建交易
                $sold_entrust_id = $goldChainEntrust->id;
                $buy_entrust_id = $buyEntrust->id;
                $result = $this->addEntrustTrade(
                    $goldChainEntrust->type,
                    self::TRADE_SOLD_WAY,
                    $goldChainEntrust->user_id,
                    $buyEntrust->user_id,
                    $sold_entrust_id,
                    $buy_entrust_id,
                    $factQty
                );
                if (empty($result['code'])) {
                    throw new Exception('创建交易失败');
                }
            }
            $goldChainEntrust = GoldchainEntrust::get($goldChainEntrust->id);
        }
    }

    /**
     * 处理买入委托
     * @param object $goldChainEntrust 委托模型对象
     * @return void
     */
    public function handleBuyEntrust($goldChainEntrust)
    {
        //查找卖出委托中价格低于或等于标价的最早记录
        $soldEntrusts = GoldchainEntrust::where(function ($query) use ($goldChainEntrust) {
            $query->where('type', 1)
                ->where('price', '<=', $goldChainEntrust->price)
                ->where('surplus_qty', '>', 0)
                ->where('status', 0);
        })->order('create_time')->select();

        foreach ($soldEntrusts as $key => $soldEntrust) {
            if (bccomp($goldChainEntrust->surplus_qty, '0', config('default_decimal_scale')) == 0) {
                //业务结束
                break;
            } else {
                //业务继续
                $satisfy = bccomp($soldEntrust->surplus_qty, $goldChainEntrust->surplus_qty);
                $factQty = $satisfy >=0 ? $goldChainEntrust->surplus_qty : $soldEntrust->surplus_qty; //根据买卖需求计算实际数量避免溢出
                //创建交易
                $sold_entrust_id = $soldEntrust->id;
                $buy_entrust_id = $goldChainEntrust->id;
                $result = $this->addEntrustTrade(
                    $goldChainEntrust->type,
                    self::TRADE_BUY_WAY,
                    $goldChainEntrust->user_id,
                    $soldEntrust->user_id,
                    $sold_entrust_id,
                    $buy_entrust_id,
                    $factQty
                );
                if (empty($result['code'])) {
                    throw new Exception('创建交易失败');
                }
            }
            $goldChainEntrust = GoldchainEntrust::get($goldChainEntrust->id);
        }
    }

    /**
     * 检测当前用户导入新淘链的交易是否需要限制价格
     * @param integer $user_id 用户id
     * @return bool
     */
    private function isLimitPrice($user_id)
    {
        $user = get_user_info($user_id);
        $import_goldchain_price = tpCache('goldchain_trade.import_goldchain_price') ?: 0.9;
        $import_goldchain_limit_day = tpCache('goldchain_trade.import_goldchain_limit_day') ?: 50;
        $is_usercenter = $user['is_usercenter']; //是否是旧系统接入(1是)
        $expired_time = $user['reg_time'] + (86400 * $import_goldchain_limit_day); //交易价格限制过期时间
        //统计自己发起的卖出和响应别人卖出的卖出总数量
        $soldQty = GoldchainTrade::where('status', 1)->where(function ($query) use ($user_id) {
            $query->whereOr(function ($query) use ($user_id) {
                $query->where('way', GoldchainTrade::TRADE_SOLD_WAY)->where('user_id', $user_id);
            })->whereOr(function ($query) use ($user_id) {
                $query->where('way', GoldchainTrade::TRADE_BUY_WAY)->where('relation_user_id', $user_id);
            });
        })->sum('trade_qty');
        is_null($soldQty) && $soldQty = 0.00;
        $soldQtyCheckResult = bccomp($soldQty, $user['import_jin_num'], config('default_decimal_scale')); //-1代表导入的新淘链没有卖完
        if ($is_usercenter == 1 && time() < $expired_time && $soldQtyCheckResult == -1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 挂单价格判断
     * @param integer $way 挂单交易方式(1.卖出 2.买入)
     * @param float $price 价格
     * @param array $user 用户数组
     */
    private function tradePriceCheck($way, $price, $user)
    {
        $decimalScale = config('default_decimal_scale');
        $import_goldchain_price = tpCache('goldchain_trade.import_goldchain_price');
        $floatRatio = tpCache('goldchain_trade.float_ratio');
        empty($floatRatio) &&  $floatRatio = 2; //系统没设置就默认取2%
        $floatRatio /= 100;
        
        if ($way == GoldchainTrade::TRADE_SOLD_WAY && $user['is_usercenter'] == 1 && $this->isLimitPrice($user['user_id'])) {
            //导入用户卖出挂单价格检测
            if (bccomp($price, $import_goldchain_price, $decimalScale) != 0) {
                //价格检测
                return array(
                    'code' => 0,
                    'msg' => '从旧系统接入的新淘链交易价格必须是:' . $import_goldchain_price . '元',
                    'data' => null,
                );
            }
        } else {
            $openPrice = $this->getOpenPrice();
            $price = number_format($price, $decimalScale, '.', '');
            $floatNum = bcmul($openPrice, $floatRatio, $decimalScale);
            $difference = abs(bcsub($price, $openPrice, $decimalScale));
            $msg = '价格('.$price .')超过开盘价(' . $openPrice . ')的有效浮动范围('. number_format($floatRatio * 100) . '%)，请重新修改价格(' . (floatval($openPrice) - floatval($floatNum)) . '-' . (floatval($openPrice) + floatval($floatNum)) . '之间)';
            //价格浮动判断
            if (bccomp($difference, $floatNum) == 1) {
                return array(
                    'code' => 0,
                    'msg' => $msg,
                    'data' => null,
                );
            }
        }
        return array(
            'code' => 1,
            'msg' => '价格正常',
            'data' => null,
        );
    }

    /**
     * 检查是否允许交易
     * @param integer $user_id 用户id
     */
    private function isAllowTrade($user_id)
    {
        $allowTrade = tpCache('goldchain_trade.allowTrade');
        $user = Users::get($user_id);
        if (!$user) {
            return false;
        }
        if (empty($user->is_test) && empty($allowTrade)) {
            return false;
        }
        return true;
    }

    /**
     * 计算手续费
     * @param float $tradeQty 交易数量
     * @param float $factTradeRatio 实际交易数量占持有数量的比例
     * @return float 返回手续费
     */
    public function calcTradePoundage($tradeQty, $factTradeRatio)
    {
        $poundage = 0;
        $scale = config('default_decimal_scale');
        $tradeQty = number_format($tradeQty, $scale, '.', '');
        $tradeLimit = tpCache('goldchain_trade.trade_limit');
        $tradeLimit = unserialize($tradeLimit);
        $ratioColumn = array_column($tradeLimit, 'ratio');
        $poundageColumn = array_column($tradeLimit, 'poundage');
        array_multisort($ratioColumn, SORT_DESC, SORT_NUMERIC, $poundageColumn, SORT_DESC, SORT_NUMERIC, $tradeLimit);
        foreach ($tradeLimit as $key => $value) {
            if (bccomp($factTradeRatio, $value['ratio'], $scale) >= 0) {
                $currentPoundage = round($value['poundage'] / 100, 2);
                $poundage = bcmul($tradeQty, $currentPoundage, $scale);
                break;
            } else {
                continue;
            }
        }
        return $poundage;
    }

    /**
     * 添加普通挂单
     * @param integer $way 交易方式:1.GoldchainTrade::TRADE_SOLD_WAY(卖出), 2.GoldchainTrade::TRADE_BUY_WAY(买入)
     * @param integer $user_id 发起用户id
     * @param integer $trade_qty 交易数量
     * @param integer $price 交易单价
     */
    public function addTrade($way, $user_id, $trade_qty, $price)
    {
        $nowDate = strtotime(date('Y-m-d'));
        $decimalScale = config('default_decimal_scale');
        $price = number_format($price, $decimalScale, '.', '');
        if ($way == 1) {
            $type = 1;
        } elseif ($way == 2) {
            $type = 3; //从算力改为从余额支付
        } else {
            $type = 0;
        }
        //禁止交易的处理
        if (!$this->isAllowTrade($user_id)) {
            return array(
                'code' => 0,
                'msg' => '当前系统暂未开放交易',
                'data' => null,
            );
        }
        //输入参数合法性检测
        if (bccomp($trade_qty, '0', $decimalScale) <= 0) {
            return array(
                'code' => 0,
                'msg' => '输入错误,交易数量不能为0',
                'data' => null,
            );
        }
        if (bccomp($price, '0', $decimalScale) <= 0) {
            return array(
                'code' => 0,
                'msg' => '输入错误,交易单价不能为0',
                'data' => null,
            );
        }
        //参数格式化
        $config = tpCache('goldchain_trade');
        $user = get_user_info($user_id);
        $floatRatio = empty($config['float_ratio']) ? 2 : $config['float_ratio']; //系统没设置就默认取2%
        $floatRatio /= 100;
        $limit_ratio = empty($config['limit_ratio']) ? 0 : $config['limit_ratio'] ;
        $limit_ratio /= 100;
        $trade_qty = number_format($trade_qty, $decimalScale, '.', '');
        //挂单价格检测
        $checkResult = $this->tradePriceCheck($way, $price, $user);
        if ($checkResult['code'] == 0) {
            return $checkResult;
        }
        //挂卖数量检测
        $tradePoundage = 0;
        if ($way == GoldchainTrade::TRADE_SOLD_WAY) {
            $rechargePayMoney = getUserRechargePayMoney($user_id);
            if ($rechargePayMoney < 50) {
                return array(
                    'code' => 0,
                    'msg' => '您的实际充值金额小于50,不能进行挂卖',
                    'data' => null,
                );
            }
            //挂卖不能超过当前持有数量的百分比
            //今日已挂卖数量
            $publishQty = GoldchainTrade::where(function ($query) use ($user_id, $nowDate) {
                $query->where('user_id', $user_id)
                    ->where('create_time', '>=', $nowDate)
                    ->where('way', GoldchainTrade::TRADE_SOLD_WAY);
            })->sum('trade_qty');
            //今日已挂卖数量和已售出数量
            $todaySoldQty = GoldchainTrade::where(function ($query) use ($user_id, $nowDate) {
                $query->whereOr(function ($query) use ($user_id, $nowDate) {
                    $query->where('way', GoldchainTrade::TRADE_SOLD_WAY)
                        ->where('user_id', $user_id)
                        ->where('create_time', '>=', $nowDate);
                })->whereOr(function ($query) use ($user_id, $nowDate) {
                    $query->where('status', 1)
                        ->where('way', GoldchainTrade::TRADE_BUY_WAY)
                        ->where('relation_user_id', $user_id)
                        ->where('complete_time', '>=', $nowDate);
                });
            })->sum('trade_qty');

            $todayJinnum = bcadd($todaySoldQty, $user['jin_num'], $decimalScale); //今日新淘链数量
            $totalLimitQty = bcmul($todayJinnum, strval($limit_ratio), $decimalScale); //今日一共能挂卖数量
            $remainLimitQty = bcsub($totalLimitQty, $todaySoldQty); //今日剩余可挂卖数量
            $nowQty = bcadd($todaySoldQty, $trade_qty, $decimalScale); //本次交易之后总出售数量
            if ($limit_ratio != 0) {
                if (bccomp($totalLimitQty, $nowQty, $decimalScale) == -1 ||
                    bccomp($remainLimitQty, '0', $decimalScale) <= 0) {
                    return array(
                        'code' => 0,
                        'msg' => '挂单失败,您当日所能挂单数量已超过持有数量' . ($limit_ratio * 100) . '%限制(' . $totalLimitQty . ')',
                        'data' => null,
                    );
                }
            }
            //手续费计算
            $factTradeRatio = bcdiv($trade_qty, $todayJinnum, $decimalScale); //计算本次挂卖数量占比
            $factTradeRatio = bcmul($factTradeRatio, '100', $decimalScale);
            $tradePoundage = $this->calcTradePoundage($trade_qty, $factTradeRatio); //这里算出来是数量
            $tradePoundage = bcmul($tradePoundage, $price, $decimalScale); //数量乘以单价是手续费
        }
        
        $amount = bcmul($trade_qty, $price, $decimalScale);
        $data = array(
            'type' => 0,
            'way' => $way,
            'user_id' => $user_id,
            'trade_qty' => $trade_qty,
            'price' => $price,
            'poundage' => $tradePoundage,
        );
        //启动事务
        Db::startTrans();
        $goldchainTrade = GoldchainTrade::create($data);
        if ($goldchainTrade->id) {
            $code = 1;
            $msg = '创建交易成功';
            $return = $goldchainTrade;
            if ($way == GoldchainTrade::TRADE_SOLD_WAY) {
                //冻结新淘链
                $factAmount = $trade_qty;
            } elseif ($way == GoldchainTrade::TRADE_BUY_WAY) {
                //冻结算力
                $factAmount = $amount;
            } else {
                Db::rollback();
                //throw new Exception('交易方式(way)异常');
                return array(
                    'code' => 0,
                    'msg' => '交易方式(way)异常',
                    'data' => null,
                );
            }
            //从余额冻结
            $result = $this->balanceToFrozen($user_id, $type, $factAmount);
            if ($result['code'] == 0) {
                Db::rollback();
                return $result;
            }
        } else {
            $code = 0;
            $msg = '创建交易失败';
            $return = null;
        }
        Db::commit();
        return array(
            'code' => $code,
            'msg' => $msg,
            'data' => $return,
        );
    }

    /**
     * 取消用户发起的交易(只能取消自己发起的)
     * @param integer 交易id
     * @param integer 交易发起人的用户id
     * @return array 返回数组
     */
    public function cancelTrade($trade_id, $user_id)
    {
        $goldchainTrade = GoldchainTrade::where('id', $trade_id)->where('user_id', $user_id)->find();
        if (!$goldchainTrade) {
            return array(
                'code' => 0,
                'msg' => '交易不存在',
                'data' => null,
            );
        }
        if ($goldchainTrade->status != 0) {
            return array(
                'code' => 0,
                'msg' => '交易状态异常不能取消',
                'data' => null,
            );
        }

        if ($goldchainTrade->way == 1) {
            $type = 1;
        } elseif ($goldchainTrade->way == 2) {
            $type = 3;  //算力改为余额
        } else {
            $type = 0;
        }

        if ($goldchainTrade->way == GoldchainTrade::TRADE_SOLD_WAY) {
            //原冻结新淘链
            $factAmount = $goldchainTrade->trade_qty;
        } elseif ($goldchainTrade->way == GoldchainTrade::TRADE_BUY_WAY) {
            //原冻结算力或余额
            $factAmount = $goldchainTrade->amount;
        } else {
            //throw new Exception('交易方式(way)异常');
            return array(
                'code' => 0,
                'msg' => '交易方式(way)异常',
                'data' => null,
            );
        }
        //启动事务
        Db::startTrans();
        //撤销冻结
        $result = $this->frozenToBalance($user_id, $type, $factAmount);
        if ($result['code'] == 0) {
            Db::rollback();
            return $result;
        }
        //变更交易状态
        $goldchainTrade->status = 2;
        $res = $goldchainTrade->save();
        if (!$res) {
            Db::rollback();
            return array(
                'code' => 0,
                'msg' => '交易取消失败',
                'data' => null,
            );
        }
        Db::commit();
        return array(
            'code' => 1,
            'msg' => '交易取消成功',
            'data' => null,
        );
    }

    /**
     * 处理普通交易
     * @param integer $trade_id 交易id
     * @param integer $relation_user_id 对方用户id
     * @param integer $status 交易状态
     */
    public function handleTrade($trade_id, $relation_user_id, $status)
    {
        $nowDate = strtotime(date('Y-m-d'));
        $decimalScale = config('default_decimal_scale');
        $relation_user = get_user_info($relation_user_id);
        $config = tpCache('goldchain_trade');
        $limit_ratio = empty($config['limit_ratio']) ? 0 : $config['limit_ratio'] ;
        $limit_ratio /= 100;
        
        //交易检测
        if (!$this->isAllowTrade($relation_user_id)) {
            return array(
                'code' => 0,
                'msg' => '当前系统暂未开放交易',
                'data' => null,
            );
        }

        $goldchainTrade = GoldchainTrade::get($trade_id);
        if (!$goldchainTrade) {
            return array(
                'code' => 0,
                'msg' => '指定交易不存在',
                'data' => null,
            );
        }
        $trade_qty = $goldchainTrade->trade_qty;
        if ($goldchainTrade->status == $status) {
            return array(
                'code' => 0,
                'msg' => '交易状态异常',
                'data' => null,
            );
        }
        //不允许和自己交易
        if ($goldchainTrade->user_id == $relation_user_id) {
            return array(
                'code' => 0,
                'msg' => '交易异常:不允许向自己交易',
                'data' => null,
            );
        }
        if ($goldchainTrade->way == GoldchainTrade::TRADE_BUY_WAY) {
            //匹配者手续费计算
            //挂卖不能超过当前持有数量的百分比
            //今日已挂卖数量
            $tradePoundage = 0;
            $publishQty = GoldchainTrade::where(function ($query) use ($relation_user_id, $nowDate) {
                $query->where('user_id', $relation_user_id)
                    ->where('create_time', '>=', $nowDate)
                    ->where('way', GoldchainTrade::TRADE_SOLD_WAY);
            })->sum('trade_qty');
            //今日已挂卖数量和已售出数量
            $todaySoldQty = GoldchainTrade::where(function ($query) use ($relation_user_id, $nowDate) {
                $query->whereOr(function ($query) use ($relation_user_id, $nowDate) {
                    $query->where('way', GoldchainTrade::TRADE_SOLD_WAY)
                        ->where('user_id', $relation_user_id)
                        ->where('create_time', '>=', $nowDate);
                })->whereOr(function ($query) use ($relation_user_id, $nowDate) {
                    $query->where('status', 1)
                        ->where('way', GoldchainTrade::TRADE_BUY_WAY)
                        ->where('relation_user_id', $relation_user_id)
                        ->where('complete_time', '>=', $nowDate);
                });
            })->sum('trade_qty');

            $todayJinnum = bcadd($todaySoldQty, $relation_user['jin_num'], $decimalScale); //今日新淘链数量
            $totalLimitQty = bcmul($todayJinnum, strval($limit_ratio), $decimalScale); //今日一共能卖数量
            $remainLimitQty = bcsub($totalLimitQty, $todaySoldQty); //今日剩余可挂卖数量
            $nowQty = bcadd($todaySoldQty, $trade_qty, $decimalScale); //本次交易之后总出售数量
            if ($limit_ratio != 0) {
                if (bccomp($totalLimitQty, $nowQty, $decimalScale) == -1 ||
                    bccomp($remainLimitQty, '0', $decimalScale) <= 0) {
                    return array(
                        'code' => 0,
                        'msg' => '交易失败,您当日所能卖出数量已超过持有数量' . ($limit_ratio * 100) . '%限制(' . $totalLimitQty . ')',
                        'data' => null,
                    );
                }
            }
            //手续费计算
            $factTradeRatio = bcdiv($trade_qty, $todayJinnum, $decimalScale); //计算本次挂卖数量占比
            $factTradeRatio = bcmul($factTradeRatio, '100', $decimalScale);
            $tradePoundage = $this->calcTradePoundage($trade_qty, $factTradeRatio); //这里算出来是数量
            $tradePoundage = bcmul($tradePoundage, $goldchainTrade->price, $decimalScale); //数量乘以单价是手续费
            $goldchainTrade->poundage = $tradePoundage;
            //旧系统导入会员交易判断
            if ($this->isLimitPrice($relation_user_id)) {
                $importGoldchainPrice = tpCache('goldchain_trade.import_goldchain_price');
                $priceResult = bccomp($goldchainTrade, $importGoldchainPrice, config('default_decimal_scale'));
                if ($priceResult != 0) {
                    return array(
                        'code' => 0,
                        'msg' => '从旧系统接入的新淘链交易价格必须是:' . $importGoldchainPrice . '元',
                        'data' => null,
                    );
                }
            }
        }
        //启动事务
        Db::startTrans();
        $goldchainTrade->relation_user_id = $relation_user_id;
        $goldchainTrade->status = $status;
        $result = $goldchainTrade->save();
        if (!$result) {
            Db::rollback();
            return array(
                'code' => 0,
                'msg' => '交易状态变更失败',
                'data' => null,
            );
        }
        //新淘链,提现币,算力,余额相关处理
        if ($status == 1) {
            $afterResult = $this->afterTrade($trade_id);
            if ($afterResult['code'] == 0) {
                Db::rollback();
                //throw new Exception('交易失败(扣除资金失败)');
                return array(
                    'code' => 0,
                    'msg' => $afterResult['msg'],
                    'data' => null,
                );
            }
        }
        Db::commit();
        return array(
            'code' => 1,
            'msg' => '交易成功!',
            'data' => $goldchainTrade,
        );
    }

    /**
     * 普通交易后事件
     * @param integer $trade_id 交易id
     * @return bool 成功返回真,失败返回假
     */
    private function afterTrade($trade_id)
    {
        $decimalScale = config('default_decimal_scale');
        $goldchainTrade = GoldchainTrade::get($trade_id);
        Db::startTrans();
        if ($goldchainTrade->way == GoldchainTrade::TRADE_SOLD_WAY) {
            $result = $this->afterSoldTrade($goldchainTrade);
            if ($result['code'] == 0) {
                Db::rollback();
                return $result;
            }
        } elseif ($goldchainTrade->way == GoldchainTrade::TRADE_BUY_WAY) {
            $result = $this->afterBuyTrade($goldchainTrade);
            if ($result['code'] == 0) {
                Db::rollback();
                return $result;
            }
        } else {
            Db::rollback();
            //throw new Exception('交易方式(way)异常');
            $result = array(
                'code' => 0,
                'msg' => '交易方式(way)异常',
                'data' => null,
            );
            return $result;
        }

        //交易后刷新收盘价、最低价、最高价
        $goldchainDaysum = GoldchainDaysum::get(function ($query) {
            $time = date('Y-m-d');
            $query->where('date', $time);
        });
        if ($goldchainDaysum) {
            //更新新淘链日交易统计表
            if (bccomp($goldchainDaysum->min_price, '0', $decimalScale) == 0 ||
                bccomp($goldchainDaysum->min_price, $goldchainTrade->price, $decimalScale) == 1) {
                $goldchainDaysum->min_price = $goldchainTrade->price;
            }
            
            bccomp($goldchainTrade->price, $goldchainDaysum->max_price) == 1 && $goldchainDaysum->max_price = $goldchainTrade->price;
            $goldchainDaysum->close_price = $goldchainTrade->price;
            $res = $goldchainDaysum->save();
            if ($res === false) {
                Db::rollback();
                //throw new Exception('更新新淘链日交易统计表异常');
                $result = array(
                    'code' => 0,
                    'msg' => '更新新淘链日交易统计表异常',
                    'data' => null,
                );
                return $result;
            }
        }
        Db::commit();
        $result = array(
            'code' => 1,
            'msg' => '执行成功',
            'data' => null,
        );
        //购买成功钩子
        $param = $trade_id;
        Hook::listen('user_buy_chain', $param);
        return $result;
    }

    /**
     * 卖方发起的交易完成后事件
     */
    private function afterSoldTrade($goldchainTrade)
    {
        $buy_user_id = $goldchainTrade->relation_user_id;
        $sold_user_id = $goldchainTrade->user_id;
        $data = array();
        if (empty($buy_user_id) || empty($sold_user_id)) {
            //throw new Exception('交易信息中买家和卖家id不能为空');
            $data = array(
                'code' => 0,
                'msg' => '交易信息中买家和卖家id不能为空',
                'data' => null,
            );
            return $data;
        }
        Db::startTrans();
        //1.扣除买家的消费余额,增加买家的新淘链
        $res = $this->addBalance($buy_user_id, 3, -$goldchainTrade->amount, $goldchainTrade->trade_no, '交易成功扣除消费余额');
        if ($res['code'] == 0) {
            Db::rollback();
            //throw new Exception('交易时扣除买方消费余额异常');
            $data = array(
                'code' => 0,
                'msg' => '交易时扣除买方消费余额异常('. $res['msg'] .')',
                'data' => null,
            );
            return $data;
        }
        $res = $this->addBalance($buy_user_id, 1, $goldchainTrade->trade_qty, $goldchainTrade->trade_no, '交易成功增加新淘链');
        if ($res['code'] == 0) {
            Db::rollback();
            //throw new Exception('交易时增加买方新淘链异常');
            $data = array(
                'code' => 0,
                'msg' => '交易时增加买方新淘链异常('. $res['msg'] .')',
                'data' => null,
            );
            return $data;
        }
        //2.扣除卖方的冻结新淘链,增加卖方的提现币
        $res = $this->frozenBalance($sold_user_id, 1, -$goldchainTrade->trade_qty, $goldchainTrade->trade_no, '交易成功扣除冻结新淘链');
        if ($res['code'] == 0) {
            Db::rollback();
            //throw new Exception('交易时扣除卖方冻结新淘链');
            $data = array(
                'code' => 0,
                'msg' => '交易时增加买方新淘链异常(' . $res['msg'] .')',
                'data' => null,
            );
            return $data;
        }
        $factWithdrawCoin = bcsub($goldchainTrade->amount, $goldchainTrade->poundage, config('default_decimal_scale'));
        if (!accountLog($sold_user_id, 0, 0, '交易成功结算提现币,手续费:'.$goldchainTrade->poundage, 0, 0, '', 0, $factWithdrawCoin)) {
            Db::rollback();
            //throw new Exception('交易时给卖方结算提现币失败');
            $data = array(
                'code' => 0,
                'msg' => '交易时增加卖方提现币异常',
                'data' => null,
            );
            return $data;
        }
        Db::commit();
        $data = array(
            'code' => 1,
            'msg' => '执行成功',
            'data' => null,
        );
        return $data;
    }

    /**
     * 买方发起的交易完成后事件
     */
    private function afterBuyTrade($goldchainTrade)
    {
        $buy_user_id = $goldchainTrade->user_id;
        $sold_user_id = $goldchainTrade->relation_user_id;
        $rechargePayMoney = getUserRechargePayMoney($sold_user_id);
        if ($rechargePayMoney < 50) {
            return array(
                'code' => 0,
                'msg' => '您的实际充值金额小于50,不能进行卖出',
                'data' => null,
            );
        }
        if (empty($buy_user_id) || empty($sold_user_id)) {
            //throw new Exception('交易信息中买家和卖家id不能为空');
            $data = array(
                'code' => 0,
                'msg' => '交易信息中买家和卖家id不能为空',
                'data' => null,
            );
            return $data;
        }
        Db::startTrans();
        //1.扣除卖方的新淘链,增加卖方的提现币
        $res = $this->addBalance($sold_user_id, 1, -$goldchainTrade->trade_qty, $goldchainTrade->trade_no, '交易成功扣除新淘链');
        if ($res['code'] == 0) {
            Db::rollback();
            //throw new Exception('交易时扣除卖方新淘链异常');
            $data = array(
                'code' => 0,
                'msg' => '交易信息中买家和卖家id不能为空(' . $res['msg'] . ')',
                'data' => null,
            );
            return $data;
        }
        $factWithdrawCoin = bcsub($goldchainTrade->amount, $goldchainTrade->poundage, config('default_decimal_scale'));
        if (!accountLog($sold_user_id, 0, 0, '交易成功结算提现币,手续费:'.$goldchainTrade->poundage, 0, 0, '', 0, $factWithdrawCoin)) {
            Db::rollback();
            //throw new Exception('交易时给卖方结算提现币失败');
            $data = array(
                'code' => 0,
                'msg' => '交易时给卖方结算提现币失败',
                'data' => null,
            );
            return $data;
        }
        //2.扣除买方冻结的消费余额,增加买方的新淘链
        $res = $this->frozenBalance($buy_user_id, 3, -$goldchainTrade->amount, $goldchainTrade->trade_no, '交易成功扣除冻结消费余额');
        if ($res['code'] == 0) {
            Db::rollback();
            //throw new Exception('交易时扣除买方冻结消费余额');
            $data = array(
                'code' => 0,
                'msg' => '交易时扣除买方冻结消费余额(' . $res['msg'] . ')',
                'data' => null,
            );
            return $data;
        }
        $res = $this->addBalance($buy_user_id, 1, $goldchainTrade->trade_qty, $goldchainTrade->trade_no, '交易成功增加新淘链');
        if ($res['code'] == 0) {
            Db::rollback();
            //throw new Exception('交易时增加买方新淘链异常');
            $data = array(
                'code' => 0,
                'msg' => '交易时增加买方新淘链异常(' . $res['msg'] . ')',
                'data' => null,
            );
            return $data;
        }
        Db::commit();
        $data = array(
            'code' => 1,
            'msg' => '执行成功',
            'data' => null,
        );
        return $data;
    }

    /**
     * 获得开盘价格
     */
    public function getOpenPrice()
    {
        $time = date('Y-m-d');
        $goldchainDaysum = GoldchainDaysum::where('date', $time)->find();
        if ($goldchainDaysum) {
            if (bccomp($goldchainDaysum->open_price, '0', config('default_decimal_scale')) == 0) {
                //如果当前开盘价为0,就往前查找,找到有效就返回,否则查找不到就取初始
                $lastPrice = $this->getLastOpenPrice($time);
                $goldchainDaysum->open_price = $lastPrice['open_price'];
                $goldchainDaysum->save();
                return $lastPrice['open_price'];
            } else {
                return $goldchainDaysum->open_price;
            }
        } else {
            $lastPrice = $this->getLastOpenPrice($time);
            $goldchainDaysum = GoldchainDaysum::create($lastPrice);
            return $goldchainDaysum->open_price;
        }
    }

    /**
     * 获得最近开盘价
     * @param string $time
     * @return array
     */
    private function getLastOpenPrice($time)
    {
        $data = array();
        $decimalScale = config('default_decimal_scale');
        //取最近日期的信息
        $goldchainDaysums = GoldchainDaysum::where('date', '<', $time)->order('date', 'desc')->select();
        if ($goldchainDaysums) {
            //遍历找到最近的有效的开盘价信息(设置过明日继承开盘价的或者收盘价不为０的)
            foreach ($goldchainDaysums as $key => $value) {
                $isSetPrice = bccomp($value->inherit_price, '0', $decimalScale); //是否人工设置过明日开盘价
                $isZero = bccomp($value->close_price, '0', $decimalScale); //收盘价是否为0
                //如果没有设置过开盘价,并且收盘价为0就继续查找
                if ($isSetPrice == 0 && $isZero == 0) {
                    continue;
                } else {
                    $data = array(
                        'date' => $time,
                        'open_price' => $isSetPrice != 0 ? $value->inherit_price : $value->close_price,
                    );
                    break;
                }
            }
        }
        //如果data为从默认设置初始化一条
        if (empty($data)) {
            $config = tpCache('goldchain_trade');
            $initPrice = empty($config['init_price']) ? 1.2 : $config['init_price'];
            $data = array(
                'date' => $time,
                'open_price' => $initPrice,
            );
        }
        return $data;
    }
}
