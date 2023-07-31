<?php
namespace app\common\behavior;

use think\Db;
use app\common\model\AccountLog;
use app\common\model\GoldchainTrade;
use app\common\model\Users;

class UserBuyChain
{
    public function run(&$param)
    {
        //在这里写代码
        $goldchainTrade = GoldchainTrade::get($param);
        //取买家id
        if ($goldchainTrade->way == 1) {
            $user_id = $goldchainTrade->relation_user_id;
        } else {
            $user_id = $goldchainTrade->user_id;
        }
        $user = Users::get($user_id);
        $this->rebateMaster($user, $goldchainTrade);
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
     * @param GoldchainTrade $order
     * @return void
     */
    public function rebateMaster(Users $user, GoldchainTrade $order)
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
    public function rebateLevel1Parent(Users $user, GoldchainTrade $order)
    {
        $rebateRatio = 0.10;
        $money = $order->amount * $rebateRatio;
        $this->rebateUserWithdaw($user, $order, $money, '交易市场购买新淘链成功,向一级推荐人返提现币');
    }

    public function rebateLevel2Parent(Users $user, GoldchainTrade $order)
    {
        $rebateRatio = 0.05;
        $money = $order->amount * $rebateRatio;
        $this->rebateUserWithdaw($user, $order, $money, '交易市场购买新淘链成功,向二级推荐人返提现币');
    }

    public function rebateLevel3Parent(Users $user, GoldchainTrade $order)
    {
        $rebateRatio = 0.03;
        $money = $order->amount * $rebateRatio;
        $this->rebateUserWithdaw($user, $order, $money, '交易市场购买新淘链成功,向三级推荐人返提现币');
    }

    /**
     * 给用户返提现币
     *
     * @param Users $user 用户模型
     * @param Float $money 提现币
     * @param String $memo 说明
     * @return void
     */
    public function rebateUserWithdaw(Users $user, GoldchainTrade $order, Float $money = 0, String $memo = '')
    {
        $openPrice = action('common/Goldchain/getOpenPrice', array(), 'logic', true);
        Db::startTrans();
        $user->withdraw_money += $money;
        $result = $user->save();
        if ($result === false) {
            Db::rollback();
            return false;
        }
        $logData = array(
            'user_id' => $user->user_id,
            'withdraw_money' => $money,
            'order_sn' => $order->trade_no,
            'order_id' => $order->id,
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
