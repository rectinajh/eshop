<?php
namespace app\common\logic;

use think\Db;
use think\Hook;
use app\common\model\Recognize;
use app\common\model\RecognizeTrade;
use app\common\model\Users;

class RecognizeLogic
{
    /**
     * 添加一个认筹活动
     * @param string $title 认筹活动标题
     * @param float $price 单价
     * @param float $qty 发行数量
     * @param float $limit 限购数量
     * @param integer $status 状态[0.未开启1.已开启2.已结束3.已取消]
     * @param integer $startTime 开始时间
     * @param integer $endTime 结束时间
     */
    public function addPlan($title, $price, $qty, $limit, $status, $startTime, $endTime, $content)
    {
        $data = [
            'title' => $title,
            'price' => $price,
            'total_qty' => $qty,
            'limit_qty' => $limit,
            'status' => $status,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'content' => $content,
        ];
        $result = [];
        $recognize = Recognize::create($data);
        $result = isset($recognize->id) ? [
            'code' => 1,
            'msg' => '添加成功',
            'data' => [
                'url' => url('Recognize/plan'),
            ],
        ] : [
            'code' => 0,
            'msg' => '添加失败',
            'data' => null,
        ];
        return $result;
    }

    /**
     * 检查认筹活动是否有效(状态、日期、剩余数量)
     * @param integer $recognize_id 认筹活动id
     * @return array
     */
    public function checkRecognize($recognize_id)
    {
        $recognize = Recognize::get($recognize_id);
        $now = time();
        if (!$recognize) {
            return [
                'code' => 0,
                'msg' => '指定认筹不存在',
                'data' => null,
            ];
        }
        if ($recognize->status != 1) {
            return [
                'code' => 0,
                'msg' => '当前认筹活动' . $recognize->status_text,
                'data' => null,
            ];
        }
        if ($recognize->getData('start_time') > $now || $recognize->getData('end_time') < $now) {
            return [
                'code' => 0,
                'msg' => '当前不在活动时间范围',
                'data' => null,
            ];
        }
        if ($recognize->remain_qty <=0) {
            return [
                'code' => 0,
                'msg' => '您来得太晚，已售罄',
                'data' => null,
            ];
        }
        return [
            'code' => 1,
            'msg' => '',
            'data' => $recognize,
        ];
    }

    /**
     * 添加交易
     * @param integer $user_id 用户id
     * @param integer $recognize_id 认筹id
     * @param integer $buy_qty 购买数量
     * @return array
     */
    public function addTrade($user_id, $recognize_id, $buy_qty)
    {
        Db::startTrans();
        $checkResult = $this->checkRecognize($recognize_id);
        if ($checkResult['code'] == 0) {
            return $checkResult;
        }
        $recognize = $checkResult['data'];
        //检查认筹剩余数量是否满足要购买数量
        if ($recognize->remain_qty < $buy_qty) {
            return [
                'code' => 0,
                'msg' => '购买数量超过认筹剩余数量',
                'data' => null,
            ];
        }
        //检查自己购买数量是否超限
        $bought_qty = RecognizeTrade::where(function ($query) use ($user_id, $recognize_id) {
            $query->where('status', 'neq', 2)->where('recognize_id', $recognize_id)->where('user_id', $user_id);
        })->sum('hold_qty');
        if (($buy_qty + $bought_qty) > $recognize->limit_qty && !empty(floatval($recognize->limit_qty))) {
            return [
                'code' => 0,
                'msg' => '超过购买数量限制',
                'data' => null,
            ];
        }
        $data = [
            'user_id' => $user_id,
            'recognize_id' => $recognize_id,
            'buy_qty' => $buy_qty,
            'hold_qty' => $buy_qty,
        ];
        $recognizeTrade = RecognizeTrade::create($data);
        if (!isset($recognizeTrade->id)) {
            Db::rollback();
            return [
                'code' => 0,
                'msg' => '提交失败，请稍后再试',
                'data' => null,
            ];
        }
        $recognize->sold_qty +=  $buy_qty;
        $synResult = $recognize->save();
        if (!$synResult) {
            Db::rollback();
            return [
                'code' => 0,
                'msg' => '提交失败:同步失败，请稍后再试',
                'data' => null,
            ];
        }
        Db::commit();
        return [
            'code' => 1,
            'msg' => '提交成功，请尽完成快支付',
            'data' => $recognizeTrade,
        ];
    }

    /**
     * 支付订单
     * @param integer $trade_id 交易id
     * @param integer $pay_type 支付方式[0.无1.余额 2.微信 3.支付宝]
     * @param float $pay_money 支付金额
     * @param integer $pay_status 支付状态
     * @param string $transaction_id 支付凭证号
     */
    public function payTrade($trade_id, $pay_type, $pay_money, $pay_status, $transaction_id = '')
    {
        Db::startTrans();
        $recognizeTrade = RecognizeTrade::get($trade_id);
        if (!$recognizeTrade) {
            Db::rollback();
            return [
                'code' => 0,
                'msg' => '交易不存在',
                'data' => null,
            ];
        }
        if ($recognizeTrade->status != 0) {
            Db::rollback();
            return [
                'code' => 0,
                'msg' => '当前交易' . $recognizeTrade->status_name . '，不能支付',
                'data' => null,
            ];
        }
        if (floatval($recognizeTrade->money) == 0) {
            Db::rollback();
            return [
                'code' => 0,
                'msg' => '当前交易金额异常，不能支付',
                'data' => null,
            ];
        }
        if ($recognizeTrade->pay_status != 0 ||
            $recognizeTrade->pay_type != 0 ||
            $recognizeTrade->money == $recognizeTrade->pay_money) {
            Db::rollback();
            return [
                'code' => 0,
                'msg' => '存在异常支付信息，不能支付',
                'data' => null,
            ];
        }
        if ($pay_money != $recognizeTrade->money) {
            Db::rollback();
            return [
                'code' => 0,
                'msg' => '支付金额不匹配，不能完成支付',
                'data' => null,
            ];
        }
        $data = [
            'pay_type' => $pay_type,
            'pay_money' => $pay_money,
            'pay_status' => $pay_status,
            'transaction_id' => $transaction_id,
            'pay_time' => time(),
        ];
        $result = $recognizeTrade->save($data);
        if (!$result) {
            Db::rollback();
            return [
                'code' => 0,
                'msg' => '支付信息同步失败',
                'data' => null,
            ];
        }
        Db::commit();
        return [
            'code' => 1,
            'msg' => '支付信息同步成功',
            'data' => null,
        ];
    }

    /**
     * 完成交易
     * @param integer $trade_id 交易id
     * @return array 返回数组
     */
    public function completeTrade($trade_id)
    {
        Db::startTrans();
        $recognizeTrade = RecognizeTrade::get($trade_id);
        $user_id = $recognizeTrade->user_id;
        $user = Users::get($user_id);
        $pid = $user->pid;
      
        if (!$recognizeTrade) {
            Db::rollback();
            return [
                'code' => 0,
                'msg' => '交易不存在',
                'data' => null,
            ];
        }
        if ($recognizeTrade->status != 0) {
            Db::rollback();
            return [
                'code' => 0,
                'msg' => '交易完成失败,原因:当前交易' . $recognizeTrade->status_name,
                'data' => null,
            ];
        }
        if ($recognizeTrade->pay_status != 1 ||
            $recognizeTrade->pay_type == 0 ||
            $recognizeTrade->money != $recognizeTrade->pay_money) {
            Db::rollback();
            return [
                'code' => 0,
                'msg' => '支付信息异常，交易不能完成',
                'data' => null,
            ];
        }
        $recognizeTrade->status = 1;
        $recognizeTrade->complete_time = time();
        $result = $recognizeTrade->save();
        if (!$result) {
            Db::rollback();
            return [
                'code' => 0,
                'msg' => '交易失败',
                'data' => null,
            ];
        }
        //新淘链到账
        $result = accountLog(
            $user_id,
            0,
            0,
            '认筹交易完成，新淘链到账',
            0,
            $recognizeTrade->id,
            $recognizeTrade->trade_no,
            0,
            0,
            $recognizeTrade->hold_qty
        );
        if (!$result) {
            Db::rollback();
            return [
                'code' => 0,
                'msg' => '交易失败：新淘链到账失败',
                'data' => null,
            ];
        }
        //更新用户表中的累计认筹数量
        $user->recognize_num += $recognizeTrade->hold_qty;
        $result = $user->save();
        if (!$result) {
            Db::rollback();
            return [
                'code' => 0,
                'msg' => '交易失败：更新累计累计认筹数量失败',
                'data' => null,
            ];
        }
        Db::commit();
        $param = $recognizeTrade;
        Hook::listen('recognize_success', $param);
      
        return [
            'code' => 1,
            'msg' => '交易成功，新淘链已成功到账',
            'data' => null,
        ];
    }

    /**
     * 取消交易
     * @param integer $trade_id 交易id
     * @return array 返回数组
     */
    public function cancelTrade($trade_id)
    {
        Db::startTrans();
        $recognizeTrade = RecognizeTrade::get($trade_id);
        if (!$recognizeTrade) {
            return [
                'code' => 0,
                'msg' => '交易不存在',
                'data' => null,
            ];
        }
        $originHoldQty = $recognizeTrade->hold_qty;
        $recognize_id = $recognizeTrade->recognize_id;
        //检测交易状态和支付状态
        if ($recognizeTrade->pay_status == 1 || $recognizeTrade->status != 0 || $recognizeTrade->pay_type != 0) {
            Db::rollback();
            return [
                'code' => 0,
                'msg' => '交易状态异常，取消失败',
                'data' => null,
            ];
        }
        $data = [
            'hold_qty' => 0,
            'status' => 2,
            'complete_time' => time(),
        ];
        $result = $recognizeTrade->save($data);
        if ($result === false) {
            Db::rollback();
            return [
                'code' => 0,
                'msg' => '交易取消失败，更新状态失败',
                'data' => null,
            ];
        }
        //释放占用的数量
        $recognize = Recognize::get($recognize_id);
        $recognize->sold_qty -= $originHoldQty;
        $result = $recognize->save();
        if ($result === false) {
            Db::rollback();
            return [
                'code' => 0,
                'msg' => '交易取消失败，释放数量失败',
                'data' => null,
            ];
        }
        Db::commit();
        return [
            'code' => 1,
            'msg' => '交易取消成功',
            'data' => null,
        ];
    }
}
