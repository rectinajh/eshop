<?php

namespace app\mobile\controller;

use think\Db;
use think\Request;
use app\common\model\AccountLog;
use app\common\model\Recognize as RecognizeModel;
use app\common\model\RecognizeTrade;
use app\common\model\Users;
use think\Validate;

class Recognize extends MobileBase
{
    public $user_id = 0;
    public $user = array();

    public function _initialize()
    {
        parent::_initialize();
        if (session('?user')) {
            $user = session('user');
            if (isset($user['user_id'])) {
                $user = M('users')->where("user_id", $user['user_id'])->find();
                session('user', $user);  //覆盖session 中的 user
                $this->user = $user;
                $this->user_id = $user['user_id'];
                $this->assign('user', $user); //存储用户信息
            } else {
                $this->user_id = 0;
            }
        }
        if (!$this->user_id) {
            header("location:" . U('Mobile/User/login'));
            exit;
        }
    }

    /**
     * 首页
     */
    public function index(Request $request)
    {
        $recognize = RecognizeModel::order('id', 'desc')->find();
        $remainRatio = number_format($recognize->remain_qty / $recognize->total_qty * 100, 2);
        $remainTime = $recognize->getData('end_time') - time();
        $buyList = $this->getBuyList($request, $recognize->id);
        $this->assign('buyList', $buyList);
        $this->assign('remainRatio', $remainRatio);
        $this->assign('remainTime', $remainTime);
        $this->assign('recognize', $recognize);
        return $this->fetch();
    }

    public function buy(Request $request)
    {
        $buy_qty = $request->post('numinput', '0', 'intval');
        $recognize_id = $request->post('recognize_id', '0', 'intval');
        $validate = new Validate([
            'numinput' => 'require|integer|gt:0',
            'recognize_id' => 'require|integer|gt:0',
        ], [
            'numinput.integer' => '认购数量必须是大于0的整数',
            'recognize_id' => '众筹活动id无效',
        ], [
            'numinput' => '认购数量',
        ]);
        if (!$validate->check($request->param())) {
            return json([
                'code' => 0,
                'msg' => $validate->getError(),
                'data' => null,
                'jump' => '',
            ]);
        }
        $recognize = RecognizeModel::get($recognize_id);
        $price = $recognize->price;
        $money = round($buy_qty * $price, 2);
        $user = get_user_info($this->user_id);
        if ($money > $user['user_money']) {
            return json([
                'code' => -1,
                'msg' => '您的余额不足,请先充值',
                'data' => null,
                'jump' => url('Mobile/User/recharge', '', false, true),
            ]);
        }
        $recognize = RecognizeTrade::where('user_id', $this->user_id)
            ->where('status', 0)
            ->where('pay_status', 0)
            ->select();
        if (count($recognize) > 0) {
            return json([
                'code' => -2,
                'msg' => '您有未支付的交易,请先在购买记录中完成支付',
                'data' => null,
                'jump' => url('Mobile/User/recharge', '', false, true),
            ]);
        }
        $result = action('common/Recognize/addTrade', array($this->user_id, $recognize_id, $buy_qty), 'logic', true);
        return json($result);
    }

    public function buyhistory(Request $request)
    {
        $recognizeTrade = RecognizeTrade::where('user_id', $this->user_id)->select();
        $this->assign('recognizeTrade', $recognizeTrade);
        return $this->fetch();
    }

    /**
     * 取消交易
     */
    public function cancel($trade_id)
    {
        $result = action('common/Recognize/cancelTrade', array($trade_id), 'logic', true);
        return json($result);
    }
  
    /**
     * 支付
     */
    public function pay(Request $request)
    {
        if ($request->isPost()) {
            $trade_id = $request->post('trade_id', 0, 'intval');
            $password = $request->post('password');
            $recognizeTrade = RecognizeTrade::get($trade_id);
            $result = $this->balancePay($trade_id, $password);
            if ($result['code'] == 0) {
                return json($result);
            }
            //同步支付信息到订单
            $synPayResult = action('common/Recognize/payTrade', array(
                $trade_id,
                1,
                $recognizeTrade['money'],
                1,
                $result['data']
            ), 'logic', true);
            if ($synPayResult['code'] == 0) {
                return json($synPayResult);
            }
            //完成订单
            $completeResult = action('common/Recognize/completeTrade', array($trade_id), 'logic', true);
            if ($completeResult['code'] == 0) {
                return json($completeResult);
            }
            return json($completeResult);
        } else {
            $this->error('非法请求');
        }
    }

    /**
     * 使用余额支付
     * @param integer $trade_id 交易id
     * @param string $password 支付密码
     */
    private function balancePay($trade_id, $password)
    {
        Db::startTrans();
        $recognizeTrade = RecognizeTrade::get($trade_id);
        $user = Users::get($this->user_id);
        if (!$recognizeTrade || $recognizeTrade['user_id'] != $this->user_id) {
            Db::rollback();
            return [
                'code' => 0,
                'msg' => '指定交易不存在',
                'data' => null,
            ];
        }
        if (!$this->validatePayPassword($password)) {
            Db::rollback();
            return [
                'code' => 0,
                'msg' => '支付密码不匹配',
                'data' => null,
            ];
        }
        if ($user['user_money'] < $recognizeTrade['money']) {
            Db::rollback();
            return [
                'code' => -1,
                'msg' => '余额不足',
                'data' => null,
            ];
        }
        //订单状态检测,已完成的\已取消的\已支付的均不能重复支付
        if ($recognizeTrade['status'] != 0 || $recognizeTrade['pay_status'] != 0) {
          	Db::rollback();
            return [
                'code' => 0,
                'msg' => '交易状态异常,不能支付',
                'data' => null,
            ];
        }
        //扣除余额
      	$result = $user->where('user_id', $this->user_id)
            ->where('user_money', '>=', $recognizeTrade['money'])
            ->setDec('user_money', $recognizeTrade['money']);
        if (!$result) {
            Db::rollback();
            return [
                'code' => 0,
                'msg' => '支付失败',
                'data' => null,
            ];
        }
        //记录日志
        $data = [
            'user_id' => $user['user_id'],
            'user_money' => -$recognizeTrade['money'],
            'desc' => '认筹交易,扣除支付金额',
            'order_sn' => $recognizeTrade['trade_no'],
            'order_id' => $trade_id,
        ];
        $log = AccountLog::create($data);
        if (!isset($log->log_id)) {
            Db::rollback();
            return [
                'code' => 0,
                'msg' => '支付失败,记录日志失败',
                'data' => null,
            ];
        }
        Db::commit();
        return [
            'code' => 1,
            'msg' => '支付成功',
            'data' => $log->log_id,
        ];
    }

    /**
     * 取已购买订单
     */
    public function getBuyList(Request $request, $recognize_id = 0)
    {
        $limit = $request->param('limit', 20);
        $recognizeTrade = RecognizeTrade::where('recognize_id', $recognize_id)
            ->where('status', '<>', '2')
            ->order('create_time', 'desc')
            ->limit($limit)
            ->select();
        return $recognizeTrade;
    }

    /**
     * 验证当前用户的支付密码
     */
    private function validatePayPassword($password = '')
    {
        $user = $this->user;
        if (encrypt($password) != $user['paypwd']) {
            return false;
        } else {
            return true;
        }
    }
  
    public function choujiang()
    {
		return $this->fetch();
    }
}
