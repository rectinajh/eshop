<?php
namespace app\common\logic;

class RebateLogic
{
    /**
     * 返利主程序
     */
    public function rebateMaster($recognizeTrade)
    {
        $l1_pid = 0;
        $l2_pid = 0;
        $l3_pid = 0;

        $user_id = $recognizeTrade->user_id;
        $user = get_user_info($user_id);

        $l1_parent = $this->getParent($user);
        
        if ($l1_parent) {
            $l1_pid = $l1_parent['user_id'];
            $this->rebateLevel1Parent($recognizeTrade, $l1_pid);
            $l2_parent = $this->getParent($l1_parent);
        }
        if ($l2_parent) {
            $l2_pid = $l2_parent['user_id'];
            $this->rebateLevel2Parent($recognizeTrade, $l2_pid);
            $l3_parent = $this->getParent($l2_parent);
        }
        if ($l3_parent) {
            $l3_pid = $l3_parent['user_id'];
            $this->rebateLevel3Parent($recognizeTrade, $l3_pid);
        }
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
            $parentUser = get_user_info($pid);
            return $parentUser;
        } else {
            return null;
        }
    }

    /**
     * 直推奖
     * @param object $recognizeTrade 认购交易
     */
    public function rebateLevel1Parent($recognizeTrade, $user_id)
    {
        $rebateRatio = 0.2;
        $this->rebateUserWithdraw($recognizeTrade, $user_id, $rebateRatio, '一级推荐人');
    }

    public function rebateLevel2Parent($recognizeTrade, $user_id)
    {
        $rebate_ratio = 0.1;
        $this->rebateUserWithdraw($recognizeTrade, $user_id, $rebate_ratio, '二级推荐人');
    }

    public function rebateLevel3Parent($recognizeTrade, $user_id)
    {
        $rebate_ratio = 0.05;
        $this->rebateUserWithdraw($recognizeTrade, $user_id, $rebate_ratio, '三级推荐人');
    }

    /**
     * 向用户返提现币
     * @param object $recognize_trade 认购交易
     * @param integer $user_id 要返提现币的用户id
     * @param float $rebate_ratio 返利比率
     * @param string $memo 备注
     */
    private function rebateUserWithdraw($recognize_trade, $user_id, $rebate_ratio, $memo = '')
    {
        $pay_money = $recognize_trade->pay_money;
        $from_user_id = $recognize_trade->user_id;
        $rebateWithdraw = round($pay_money * $rebate_ratio, 2);
        accountLog(
            $user_id,
            0,
            0,
            'id:' . $from_user_id . '的用户,认筹交易完成，向' . $memo . ' (id:' . $user_id . ')返提现币',
            0,
            $recognize_trade->id,
            $recognize_trade->trade_no,
            0,
            $rebateWithdraw
        );
    }
}
