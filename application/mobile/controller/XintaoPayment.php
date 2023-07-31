<?php

namespace app\mobile\controller;

use think\Db;
use think\Controller;
use think\Request;
use app\common\model\Order;

class XintaoPayment extends MobileBase
{
    public $user_id = 0;
    public $user = array();

    /*
     * 初始化操作
     */
    public function _initialize()
    {
        parent::_initialize();
        if (session('?user')) {
            $user = session('user');
            $user = M('users')->where("user_id", $user['user_id'])->find();
            session('user', $user);  //覆盖session 中的 user
            $this->user = $user;
            $this->user_id = $user['user_id'];
            $this->assign('user', $user); //存储用户信息
        }
        $nologin = array();
        if (!$this->user_id && !in_array(ACTION_NAME, $nologin)) {
            header("location:" . U('Mobile/User/login'));
            exit;
        }
    }

    public function index(Request $request)
    {
        if (!$request->has('order_id')) {
            $this->error('订单参数传递错误');
        }
        $decimalScale = config('default_decimal_scale');
        $order_id = $request->param('order_id');

        $order = Order::where('order_id', $order_id)
            ->where('user_id', $this->user_id)
            ->find();
        //订单如果不等于未确认或者不竽于未支付,就不让继续支付
        if ($order->order_status  != 0 || $order->pay_status != 0) {
            $this->error('订单状态异常,不能继续支付', '/Mobile/Cart/cart4/order_id/'. $order_id);
        }
        !$order && $this->error('未获取到有效订单');
        $rechargePayMoney = getUserRechargePayMoney($this->user_id);
        if ($rechargePayMoney < 50) {
            $this->error('您的实际充值金额小于50,不能使用新淘链进行支付');
        }
        $openPrice = action('common/Goldchain/getOpenPrice', array(), 'logic', true);
        $needUseQty = $this->getNeedUseChainQty($order->order_amount);

        if (bccomp($this->user['jin_num'], $needUseQty, $decimalScale) < 0) {
            $this->error('您的可用新淘链余额不足,请重新选择支付方式', '/Mobile/Cart/cart4/order_id/'. $order_id);
        }

        $this->assign('max_use', $needUseQty);
        $this->assign('open_price', $openPrice);
        $this->assign('order', $order);
        return $this->fetch();
    }

    private function getNeedUseChainQty(String $money)
    {
        $decimalScale = config('default_decimal_scale');
        $openPrice = action('common/Goldchain/getOpenPrice', array(), 'logic', true);
        $needUseQty = bcdiv($money, $openPrice, $decimalScale); //本次订单使用数量
        $decimalScale++;
        //统一做向上舍入
        $baseNumber = bcdiv('5', number_format(pow(10, $decimalScale), $decimalScale, '.', ''), $decimalScale);
        $addNumber = number_format($baseNumber, $decimalScale, '.', '');
        $needUseQty = round(bcadd($needUseQty, $addNumber, $decimalScale), --$decimalScale);
        return $needUseQty;
    }

    public function pay(Request $request)
    {
        $decimalScale = config('default_decimal_scale');
        $openPrice = action('common/Goldchain/getOpenPrice', array(), 'logic', true);
        if ($request->isPost()) {
            if (!$request->has('order_id')) {
                return json([
                    'code' => 0,
                    'msg' => '订单参数传递错误',
                    'data' => null,
                ]);
            }
            $order_id = $request->param('order_id');

            //验证
            $order = Order::where('user_id', $this->user_id)
                ->where('order_id', $order_id)
                ->find();
            if (!$order) {
                return json([
                    'code' => 0,
                    'msg' => '未获取到有效订单',
                    'data' => null,
                ]);
            }
            
            //订单如果不等于未确认或者不竽于未支付,就不让继续支付
            if ($order->order_status  != 0 || $order->pay_status != 0) {
                return json([
                    'code' => 0,
                    'msg' => '订单状态异常,不能继续支付',
                    'data' => null,
                ]);
            }

            $rechargePayMoney = getUserRechargePayMoney($this->user_id);
            if ($rechargePayMoney < 50) {
                return json([
                    'status' => 0,
                    'msg' => '您的实际充值金额小于50,不能使用新淘链进行支付',
                    'data' => null,
                ]);
            }

            $postData = $request->post();
            $password = $postData['password'];

            //验证支付密码
            if (empty($this->user['paypwd'])) {
                return json([
                    'code' => -1,
                    'msg' => '您还未设置支付密码,请先在个人中心设置支付密码',
                    'data' => null,
                ]);
            }
            if ($password == '') {
                return json([
                    'code' => 0,
                    'msg' => '密码不能为空',
                    'data' => null,
                ]);
            }
            if (encrypt($password) != $this->user['paypwd']) {
                return json([
                    'code' => 0,
                    'msg' => '支付密码不正确',
                    'data' => null,
                ]);
            }

            $needUseQty = $this->getNeedUseChainQty($order->order_amount);

            if (bccomp($this->user['jin_num'], $needUseQty, $decimalScale) < 0) {
                return json([
                    'code' => 0,
                    'msg' =>'您的可用新淘链余额不足',
                    'data' => null,
                ]);
            }

            //扣除金额
            Db::startTrans();
            $res = accountLog($this->user_id, 0, 0, '订单支付,开盘价:' . $openPrice, 0, 0, $order['order_sn'], 0, 0, -$needUseQty);
            if (!$res) {
                Db::rollback();
                return json([
                    'code' => 1,
                    'msg' => '扣除新淘链失败',
                    'data' => null,
                ]);
            }
            $pay_info = array(
                'open_price' => $openPrice,
                'use_qty ' => $needUseQty,
            );

            $order->pay_status = 1;
            $order->pay_code = 'xintaoPay';
            $order->pay_name = '新淘链支付';
            $order->pay_detail = serialize($pay_info);
            $order->pay_time = time();
            $res = $order->save();
            if ($res === false) {
                Db::rollback();
                return json([
                    'code' => 0,
                    'msg' => '支付失败',
                    'data' => null,
                ]);
            }
            //更新订单支付方式
            Db::commit();
            return json([
                'code' => 1,
                'msg' => '支付成功',
                'data' => null,
            ]);
        } else {
            $this->error('非法请求');
        }
    }
}
