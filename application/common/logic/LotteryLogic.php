<?php
namespace app\common\logic;

use think\Db;
use app\common\model\Lottery;
use app\common\model\LotteryChance;
use app\common\model\LotteryRecord;
use app\common\model\LotteryPrize;
use app\common\model\Users;

class LotteryLogic
{
    /**
     * 增加抽奖次数
     * @param integer $user_id 用户id
     * @param integer $lotteryId 抽奖活动id
     * @param integer $step 增加次数，默认1
     * @return bool 成功返回true，失败返回false
     */
    public function increaseUserChance($userId, $lotteryId, $step = 1)
    {
        $lotteryChance = new LotteryChance();
        $chance = $lotteryChance->getUserChance($userId, $lotteryId);
        if (!$chance) {
            return [
                'code' => 0,
                'msg' => '读取可用抽奖次数失败',
                'data' => null,
            ];
        }
        if ($step <= 0) {
            return [
                'code' => 0,
                'msg' => '增加抽奖次数传参错误',
                'data' => null,
            ];
        }
        $lottery = Lottery::get($lotteryId);
        if ($chance->total_chance > $lottery->total_limit || $chance->remain_chance > $lottery->total_limit) {
            $savePath = RUNTIME_PATH . 'log/lottery/';
            file_exists($savePath) || @mkdir($savePath);
            $logContent = date('Y-m-d H:i:s'). 'id:'. $user_Id . '的用户推荐奖励获得可抽奖次数已达到上限';
            error_log($logContent, 3, $savePath . date('Ymd').'.log');
            return [
                'code' => 0,
                'msg' => '已达到最高抽奖次数上限',
                'data' => null,
            ];
        }
        $chance->total_chance += $step;
        $chance->remain_chance += $step;
        $result = $chance->save();
        if (!$result) {
            return [
                'code' => 0,
                'msg' => '更新抽奖次数失败',
                'data' => null,
            ];
        }
        return [
            'code' => 1,
            'msg' => '更新次奖次数成功',
            'data' => $chance,
        ];
    }

    /**
     * 减少抽奖次数
     * @param integer $user_id 用户id
     * @param integer $lotteryId 抽奖活动id
     * @param integer $step 减少次数，默认1
     * @return bool 成功返回true，失败返回false
     */
    public function decreaseUserChance($userId, $lotteryId, $step = 1)
    {
        $lotteryChance = new LotteryChance();
        $lottery = Lottery::get($lotteryId);
        $chance = $lotteryChance->getUserChance($userId, $lotteryId);
        if (!$chance) {
            return [
                'code' => 0,
                'msg' => '读取可用抽奖次数失败',
                'data' => null,
            ];
        }
        if ($step <= 0) {
            return [
                'code' => 0,
                'msg' => '使用抽奖次数传参错误',
                'data' => null,
            ];
        }
        
        if ($chance->used_chance >= $lottery->total_limit) {
            $savePath = RUNTIME_PATH . 'log/lottery/';
            file_exists($savePath) || @mkdir($savePath);
            $logContent = date('Y-m-d H:i:s'). 'id:'. $userId . '的用户可抽奖次数达到上限' . "\n";
            error_log($logContent, 3, $savePath . date('Ymd').'.log');
            return [
                'code' => 0,
                'msg' => '已达到最高抽奖次数上限',
                'data' => null,
            ];
        }
        
        $chance->remain_chance -= $step;
        $chance->used_chance += $step;
        if ($chance->remain_chance < 0) {
            return [
                'code' => 0,
                'msg' => '对不起,您的可用抽奖次数不足',
                'data' => null,
            ];
        }
        $result = $chance->save();
        if (!$result) {
            return [
                'code' => 0,
                'msg' => '更新抽奖次数失败',
                'data' => null,
            ];
        }
        return [
            'code' => 1,
            'msg' => '更新次奖次数成功',
            'data' => $chance,
        ];
    }

    /**
     * 取有效的抽奖活动
     */
    public function getAvailableLottery()
    {
        $lottery = Lottery::where('status', 1)
            ->order('id', 'desc')
            ->find();
        return $lottery;
    }

    /**
     * 抽奖
     */
    public function luckyDraw($user_id)
    {
        $lottery = $this->getAvailableLottery();
        if (!$lottery) {
            return array(
                'code' => 0,
                'msg' => '当前活动还未开启',
                'data' => $lotteryResult,
            );
        }
        Db::startTrans();
        $result = $this->decreaseUserChance($user_id, $lottery->id);
        if ($result['code'] == 0) {
            Db::rollback();
            return $result;
        }
        $number = mt_rand(1, 100) / 100;
        $data = array(
            'lottery_id' => $lottery->id,
            'user_id' => $user_id,
            'prize_id' => 0,
            'prize_value' => $number,
        );
        $lotteryResult = LotteryRecord::create($data);
        if (!isset($lotteryResult->id)) {
            Db::rollback();
            return array(
                'code' => 0,
                'msg' => '记录抽奖失败',
                'data' => null
            );
        }
        $result = accountLog(
            $user_id,
            0,
            0,
            '抽奖活动,喜中' . $number . '个新淘链',
            0,
            $lotteryResult->id,
            '',
            0,
            0,
            $number
        );
        if (!$result) {
            Db::rollback();
            return array(
                'code' => 0,
                'msg' => '新淘链到账失败!',
                'data' => $lotteryResult,
            );
        }
        Db::commit();
        return array(
            'code' => 1,
            'msg' => '恭喜您抽中'. $number . '个新淘链',
            'data' => $lotteryResult,
        );
    }
}
