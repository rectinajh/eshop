<?php
namespace app\admin\validate;

use think\Validate;

class Recognize extends Validate
{
    protected $rule = [
        'start_time' => 'require|date',
        'end_time' => 'require|date',
        'title' => 'require|min:1|max:50',
        'price' => 'require|number|gt:0',
        'total_qty' => 'require|number|gt:0',
        'limit_qty' => 'require|number|egt:0',
    ];

    protected $field = [
        'start_time' => '开始时间',
        'end_time' => '结束时间',
        'title' => '活动名称',
        'price' => '价格',
        'total_qty' => '发行数量',
        'limit_qty' => '限购数量',
    ];
}