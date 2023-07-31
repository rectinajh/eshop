<?php

namespace app\common\model;

use think\Model;

class RecognizeTrade extends Model
{
    protected $autoWriteTimestamp = true;
    protected $append = [
        'safe_mobile'
    ];
    protected $type = [
        'create_time' => 'timestamp',
        'complete_time' => 'timestamp',
        'pay_time' => 'timestamp',
    ];

    protected $insert = [
        'trade_no',
        'hold_qty',
        'money',
        'status' => 0,
        'pay_status' => 0,
        'pay_type' => 0,
    ];

    protected static $status = [
        '未完成',
        '已完成',
        '已取消',
    ];

    protected static $payStatus = [
        '未支付',
        '成功',
        '失败',
    ];
    
    protected static $payType = [
        '无',
        '余额',
        '微信',
        '支付宝',
    ];
    
    public static function enumStatus()
    {
        return self::$status;
    }

    public static function enumPayStatus()
    {
        return self::$payStatus;
    }

    public static function enumPayType()
    {
        return self::$payType;
    }

    public function user()
    {
        return $this->belongsTo('Users', 'user_id', 'user_id');
    }

    public function setHoldQty($value, $data)
    {
        return $this->getAttr('buy_qty');
    }

    public function setTradeNoAttr($value, $data)
    {
        do {
            $tradeNo = make_trade_no('RT');
        } while ($this->where('trade_no', $tradeNo)->find());
        return $tradeNo;
    }

    public function setMoneyAttr($value, $data)
    {
        $recognize_id = $this->getAttr('recognize_id');
        $buy_qty = $this->getAttr('buy_qty');
        $recognize = Recognize::get($recognize_id);
        if (!$recognize) {
            return 0;
        }
        $price = $recognize->price;
        $money = $price * $buy_qty;
        return $money;
    }

    public function getStatusNameAttr($value, $data)
    {
        return self::$status[$data['status']];
    }

    public function getPayStatusNameAttr($value, $data)
    {
        return self::$payStatus[$data['pay_status']];
    }

    public function getPayTypeNameAttr($value, $data)
    {
        return self::$payType[$data['pay_type']];
    }

    public function getSafeMobileAttr($value, $data)
    {
        return substr_replace($this->user->mobile, '****', 3, 4);
    }
}
