<?php
namespace app\common\behavior;

use app\common\model\Users;

class UserReg
{
    public function run(&$param)
    {
        $lottery = action('common/Lottery/getAvailableLottery', array(), 'logic', true);
        //取有效的抽奖活动
        if (!$lottery) {
            $logContent = date('Y-m-d H:i:s') . '未找到有效的抽奖活动';
            $savePath = RUNTIME_PATH . 'log/lottery/invitereg/';
            !file_exists($savePath) && @mkdir($savePath);
            error_log($logContent, 3, $savePath);
            return false;
        }
        $user = $param;
        $user_id = $user['user_id'];
        $pid = $user['pid'];
        $lottery_id = $lottery->id;
        action('common/Lottery/increaseUserChance', array($user_id, $lottery_id ), 'logic', true); //给自己添加抽奖次数
        if ($pid > 0) {
            action('common/Lottery/increaseUserChance', array($pid , $lottery_id ), 'logic', true); //给推荐人添加抽奖次数
        }
        //给自己增加算力
        $this->rebateUserPower($user['user_id'], 500, '用户注册赠送算力');
        //给上级增加算力
        if ($pid > 0) {
            $this->rebateUserPower($pid, 50, '新用户注册,给直推上级增加算力');
        }
    }

    public function rebateUserPower($user_id, $power, $memo)
    {
        accountLog(
            $user_id,
            0,
            0,
            $memo,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            $power
        );
    }
}
