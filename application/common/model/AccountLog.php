<?php

namespace app\common\model;

use think\Model;

class AccountLog extends Model
{
    protected $autoWriteTimestamp = true;
    protected $createTime = 'change_time';
}
