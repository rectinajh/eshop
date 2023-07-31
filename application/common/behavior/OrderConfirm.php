<?php

namespace app\common\behavior;

use think\Db;
use app\common\model\AccountLog;
use app\common\model\Order;
use app\common\model\Users;

class OrderConfirm
{
    public function run(&$param)
    {
        $order = Order::get($param);
        $user_id = $order->user_id;
        $user = Users::get($user_id);
        $this->rebateMaster($user, $order);
    }

    /**
     * 取上级
     * @param array $user 用户信息
     * @return mixed 成功返回array,失败返回null
     */
    public function getParent($user)
    {
        $pid = $user['pid'];
        if ($pid > 0) {
            $parentUser = Users::get($pid);
            return $parentUser;
        } else {
            return null;
        }
    }

    /**
     * 返利程序
     *
     * @param Users $user
     * @param Order $order
     * @return void
     */
    public function rebateMaster(Users $user, Order $order)
    {
        $l1_pid = 0;
        $l2_pid = 0;
        $l3_pid = 0;

        $user_id = $user->user_id;
        $user = Users::get($user_id);

        $l1_parent = $this->getParent($user);
        
        if ($l1_parent) {
            $l1_pid = $l1_parent['user_id'];
            $this->rebateLevel1Parent($l1_parent, $order);
            $l2_parent = $this->getParent($l1_parent);
        }
        if ($l2_parent) {
            $l2_pid = $l2_parent['user_id'];
            $this->rebateLevel2Parent($l2_parent, $order);
            $l3_parent = $this->getParent($l2_parent);
        }
        if ($l3_parent) {
            $l3_pid = $l3_parent['user_id'];
            $this->rebateLevel3Parent($l3_parent, $order);
        }
    }

    /**
     * 直推奖
     * @param object $recognizeTrade 认购交易
     */
    public function rebateLevel1Parent(Users $user, Order $order)
    {
        $rebateRatio = 0.05;
        $money = $order->order_amount * $rebateRatio;
        $this->rebateUserMoney($user, $order, $money, '一级推荐购物奖');
    }

    public function rebateLevel2Parent($user, $order)
    {
        $rebateRatio = 0.03;
        $money = $order->order_amount * $rebateRatio;
        $this->rebateUserMoney($user, $order, $money, '二级推荐购物奖');
    }

    public function rebateLevel3Parent($user, $order)
    {
        $rebateRatio = 0.01;
        $money = $order->order_amount * $rebateRatio;
        $this->rebateUserMoney($user, $order, $money, '三级推荐购物奖');
    }

    /**
     * 给用户返余额
     *
     * @param Users $user 用户模型
     * @param Float $money 金额
     * @param String $memo 说明
     * @return void
     */
    public function rebateUserMoney(Users $user, Order $order, Float $money = 0, String $memo = '')
    {
        Db::startTrans();
        $user->user_money += $money;
        $result = $user->save();
        if ($result === false) {
            Db::rollback();
            return false;
        }
        $logData = array(
            'user_id' => $user->user_id,
            'user_money' => $money,
            'order_sn' => $order->order_sn,
            'order_id' => $order->order_id,
            'desc' => $memo,
        );
        $accountLog = AccountLog::create($logData);
        if (!isset($accountLog->log_id)) {
            Db::rollback();
            return false;
        }
        Db::commit();
        return true;
    }
}
