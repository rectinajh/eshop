<?php

namespace app\common\model;

use think\Model;

class LotteryRecord extends Model
{
    protected $autoWriteTimestamp = true;

    public function user()
    {
        return $this->belongsTo('Users', 'user_id');
    }
}
