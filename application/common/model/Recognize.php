<?php

namespace app\common\model;

use think\Model;

class Recognize extends Model
{

    protected $autoWriteTimestamp = true;

    protected $type = [
        'complete_time' => 'timestamp',
        'start_time' => 'timestamp',
        'end_time' => 'timestamp',
    ];

    protected $insert = [
        'plan_no',
        'sold_qty' => 0,
        'remain_qty',
    ];

    protected static $status = [
            '未开启',
            '进行中',
            '已结束',
            '已取消',
    ];

    public static function getStatusList()
    {
        return self::$status;
    }
    
    public function setPlanNoAttr($value, $data)
    {
        do {
            $tradeNo = make_trade_no('ZC');
        } while ($this->where('plan_no', $tradeNo)->find());
        return $tradeNo;
    }

    public function setRemainQtyAttr($value, $data)
    {
        if (is_null($value)) {
            return $this->getAttr('total_qty');
        } else {
            return $value;
        }
    }

    public function setSoldQtyAttr($value, $data)
    {
        $total = $this->getAttr('total_qty');
        $remain = $total - $value;
        if ($remain < 0) {
            exception('交易超出总量');
        }
        /*
        //不建议卖完自动关闭活动,因为还有还有人未付款
        if ($remain == 0) {
            $this->setAttr('status', 2); //结束活动
            $this->setAttr('complete_time', time()); //结束活动
        }
        */
        $this->setAttr('remain_qty', $remain);
        return $value;
    }

    public function getStatusTextAttr($value, $data)
    {
        return self::$status[$data['status']];
    }
}
