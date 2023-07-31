<?php

namespace app\common\model;

use think\Model;

class Lottery extends Model
{
    protected $autoWriteTimestamp = true;

    public function record()
    {
        return $this->hasMany('LotteryRecord', 'lottery_id', 'id');
    }
}
