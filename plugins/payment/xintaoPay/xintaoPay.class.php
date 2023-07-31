<?php
/**
 * 新淘链支付
 * @author 新淘链商城
 */
class xintaoPay
{
    public function get_code($order, $config)
    {
        return [
            'status' => 1,
            'msg' => '测试支付',
            'jump_url' => '/mobile/xintao_payment/index/order_id/' . $order['order_id'],
            'result' => array(
                'pay_code'=>'xintaoPay',
                'order_id'=> $order['order_id'],
                'order_sn' => $order['order_sn'],
            ),
        ];
    }
}
