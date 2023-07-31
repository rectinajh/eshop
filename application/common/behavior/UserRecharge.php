<?php

namespace app\common\behavior;

use think\Db;
use app\common\model\AccountLog;
use app\common\model\Recharge;
use app\common\model\Users;

class UserRecharge
{
    public function run(&$param)
    {
        $order = Recharge::get($param);
        $user_id = $order->user_id;
        $user = Users::get($user_id);
        //$this->rebateMaster($user, $order);
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
     * @param Recharge $order
     * @return void
     */
    public function rebateMaster(Users $user, Recharge $order)
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
    public function rebateLevel1Parent(Users $user, Recharge $order)
    {
        $rebateRatio = tpCache('basic.tjone') / 100;
        $money = $order->account * $rebateRatio;
        $this->rebateUserChain($user, $order, $money, '充值成功向一级推荐人返等值新淘链');
    }

    public function rebateLevel2Parent(Users $user, Recharge $order)
    {
        $rebateRatio = tpCache('basic.tjtow') / 100;
        $money = $order->account * $rebateRatio;
        $this->rebateUserChain($user, $order, $money, '充值成功向二级推荐人返等值新淘链');
    }

    public function rebateLevel3Parent(Users $user, Recharge $order)
    {
        $rebateRatio = tpCache('basic.tjthree') / 100;
        $money = $order->account * $rebateRatio;
        $this->rebateUserChain($user, $order, $money, '充值成功向三级推荐人返等值新淘链');
    }

    /**
     * 给用户等值新淘链
     *
     * @param Users $user 用户模型
     * @param Float $money 价值
     * @param String $memo 说明
     * @return void
     */
    public function rebateUserChain(Users $user, Recharge $order, Float $money = 0, String $memo = '')
    {
        $openPrice = action('common/Goldchain/getOpenPrice', array(), 'logic', true);
        $addJinnum = bcdiv($money, $openPrice, config('default_decimal_scale')); //等值新淘链
        Db::startTrans();
        $user->jin_num += $addJinnum;
        $user->jin_total += $addJinnum;
        $result = $user->save();
        if ($result === false) {
            Db::rollback();
            return false;
        }
        $logData = array(
            'user_id' => $user->user_id,
            'jin_num' => $addJinnum,
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
