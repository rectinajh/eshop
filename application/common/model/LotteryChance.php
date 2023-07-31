<?php

namespace app\common\model;

use think\Model;
use think\Db;

class LotteryChance extends Model
{
    protected $autoWriteTimestamp = true;
    protected $insert = [
        'total_chance' => 0,
        'used_chance' => 0,
        'remain_chance' => 0,
    ];

    public function getUserChance($userId, $lotteryId)
    {
        $chance = self::where('lottery_id', $lotteryId)
            ->where('user_id', $userId)
            ->find();
        return $chance ? $chance : $this->createUserChance($userId, $lotteryId);
    }

    private function createUserChance($userId, $lotteryId)
    {
        $newChance = self::create([
            'lottery_id' => $lotteryId,
            'user_id' => $userId,
        ]);
        return isset($newChance->id) ? $newChance : null;
    }
}
