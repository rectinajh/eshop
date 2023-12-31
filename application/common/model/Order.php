<?php
namespace app\common\model;

use think\Model;
use think\Db;

/**
 * @package Home\Model
 */
class Order extends Model
{
    //自定义初始化
    protected function initialize()
    {
        parent::initialize();
        $select_year = select_year(); // 查询 三个月,今年内,2016年等....订单
        $prefix = C('database.prefix');  //获取表前缀
        $this->table = $prefix . 'order' . $select_year;
    }

    //获取订单商品
    public function OrderGoods()
    {
        return $this->hasMany('OrderGoods', 'order_id', 'order_id');
    }

    //获取订单店铺
    public function store()
    {
        return $this->hasone('store', 'store_id', 'store_id')->field('store_id,store_name,store_qq');
    }

    /**
     * 获取订单状态对应的中文
     * @param $value
     * @param $data
     * @return mixed
     */
    public function getOrderStatusDetailAttr($value, $data)
    {
        $data_status_arr = C('ORDER_STATUS_DESC');
        // 货到付款
        if ($data['pay_code'] == 'cod') {
            if (in_array($data['order_status'], array(0, 1)) && $data['shipping_status'] == 0) {
                return $data_status_arr['WAITSEND']; //'待发货',
            }
        } else {
            // 非货到付款
            if ($data['pay_status'] == 0 && $data['order_status'] == 0) {
                return $data_status_arr['WAITPAY']; //'待支付',
            }
                
            if ($data['pay_status'] == 1 && in_array($data['order_status'], array(0, 1)) && $data['shipping_status'] != 1) {
                return $data_status_arr['WAITSEND']; //'待发货',
            }
        }
        if (($data['shipping_status'] == 1) && ($data['order_status'] == 1)) {
            return $data_status_arr['WAITRECEIVE']; //'待收货',
        }

        if ($data['order_status'] == 2 && $data['is_comment'] == 1) {
            return $data_status_arr['FINISH']; //'待评价',
        }
        if ($data['order_status'] == 2) {
            return $data_status_arr['WAITCCOMMENT']; //'待评价',
        }
        if ($data['order_status'] == 3) {
            return $data_status_arr['CANCEL']; //'已取消',
        }
            
        if ($data['order_status'] == 4) {
            return $data_status_arr['FINISH']; //'已完成',
        }  
        return $data_status_arr['OTHER'];
    }

    /**
     * 获取订单状态的 显示按钮
     * @param $value
     * @param $data
     * @return mixed
     */
    public function getOrderButtonAttr($value, $data)
    {
        /**
         *  订单用户端显示按钮
         * 去支付     AND pay_status=0 AND order_status=0 AND pay_code ! ="cod"
         * 取消按钮  AND pay_status=0 AND shipping_status=0 AND order_status=0
         * 确认收货  AND shipping_status=1 AND order_status=0
         * 评价      AND order_status=1
         * 查看物流  if(!empty(物流单号))
         */
        $btn_arr = array(
            'pay_btn' => 0, // 去支付按钮
            'cancel_btn' => 0, // 取消按钮
            'receive_btn' => 0, // 确认收货
            'comment_btn' => 0, // 评价按钮
            'shipping_btn' => 0, // 查看物流
            'return_btn' => 0, // 退货按钮 (联系客服)
        );
        // 三个月(90天)内的订单才可以进行有操作按钮. 三个月(90天)以外的过了退货 换货期, 即便是保修也让他联系厂家, 不走线上
        if (time() - $data['add_time'] > 86400 * 90) {
            return $btn_arr;
        }
        // 货到付款
        if ($data['pay_code'] == 'cod') {
            if (($data['order_status'] == 0 || $data['order_status'] == 1) && $data['shipping_status'] == 0) // 待发货
            {
                $btn_arr['cancel_btn'] = 1; // 取消按钮 (联系客服)
            }
            if ($data['shipping_status'] == 1 && $data['order_status'] == 1) {
                //待收货
                $btn_arr['receive_btn'] = 1;  // 确认收货
                $btn_arr['return_btn'] = 1; // 退货按钮 (联系客服)
            }
        } else {
            // 非货到付款
            if ($data['pay_status'] == 0 && $data['order_status'] == 0) {
                // 待支付
                $btn_arr['pay_btn'] = 1; // 去支付按钮
                $btn_arr['cancel_btn'] = 1; // 取消按钮
            }
            if ($data['pay_status'] == 1 && $data['order_status'] < 2 && $data['shipping_status'] == 0) {
                // 待发货
                $btn_arr['cancel_btn'] = 1; // 取消按钮
            }
            if ($data['pay_status'] == 1 && $data['order_status'] == 1 && $data['shipping_status'] == 1) {
                //待收货
                $btn_arr['receive_btn'] = 1;  // 确认收货
            }
        }
        if ($data['order_status'] == 2) {
            $data['is_comment'] == 0 && $btn_arr['comment_btn'] = 1;  // 评价按钮
            $btn_arr['return_btn'] = 1; // 退货按钮 (联系客服)
        }
        if ($data['shipping_status'] > 0 && $data['order_status'] == 1) {
            $btn_arr['shipping_btn'] = 1; // 查看物流
        }
        if ($data['shipping_status'] == 2 && $data['order_status'] == 1) {
            // 部分发货
            $btn_arr['return_btn'] = 1; // 退货按钮 (联系客服)
        }
        if ($data['order_status'] == 3 && ($data['pay_status'] == 1 || $data['pay_status'] == 4)) {
            $btn_arr['cancel_info'] = 1; // 取消订单详情
        }

        return $btn_arr;
    }
}