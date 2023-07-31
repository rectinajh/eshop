<?php
namespace app\common\validate;

use think\Validate;

class Lottery extends Validate
{
    protected $rule = [
        'title' => 'require|min:1',
        'total_limit' => 'require|integer|egt:0',
        'step' => 'require|integer|egt:0',
        'status' => 'require|integer|in:0,1',
    ];

    protected $message = [
        'total_limit.integer' => ':attribute必须是整数',
        'step.integer' => ':attribute必须是整数',
        'status' => ':attribute必须选择一个有效值',
    ];

    protected $field = [
        'title' => '标题',
        'total_limit' => '每人可抽奖总次数',
        'step' => '直推成功可获得抽奖次数',
        'status' => '状态',
    ];
}
