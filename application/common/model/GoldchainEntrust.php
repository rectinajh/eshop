<?php

namespace app\common\model;

use think\Model;

class GoldchainEntrust extends Model
{
    protected $autoWriteTimestamp = true;
    
    protected $insert = array(
        'trade_no',
        'finish_qty' => 0,
        'status' => 0,
        'surplus_qty',
    );
    protected $update = array(
        'finish_qty',
        'surplus_qty',
    );

    /**
     * 自动生成交易号
     */
    public function setTradeNoAttr($value, $data)
    {
        do {
            $tradeNo = make_trade_no('EN');
        } while ($this->where('trade_no', $tradeNo)->find());
        return $tradeNo;
    }

    public function setFinishQtyAttr($value, $data)
    {
        $finish_qty = number_format($value, config('default_decimal_scale'), '.', '');
        $total_qty = number_format($data['total_qty'], config('default_decimal_scale'), '.', '');
        //判断完成数量是否大于委托数量,避免异常
        if (bccomp($total_qty, $finish_qty, config('default_decimal_scale')) < 0) {
            throw new \Exception('完成数量不能大于委托数量');
        }
        return $finish_qty;
    }

    public function setSurplusQtyAttr($value, $data)
    {
        //高精度小数运算
        $finish_qty = number_format($data['finish_qty'], config('default_decimal_scale'), '.', '');
        $total_qty = number_format($data['total_qty'], config('default_decimal_scale'), '.', '');
        $surplus_qty = bcsub($total_qty, $finish_qty, config('default_decimal_scale'));
        $surplusResult = bccomp($surplus_qty, '0', config('default_decimal_scale'));
        if ($surplusResult <= 0) {
            $surplus_qty = 0;
            empty($data['status']) && $this->setAttr('status', 1);
        }
        return $surplus_qty;
    }

    public function setStatusAttr($value, $data)
    {
        if ($value == 1) {
            $this->setAttr('complete_time', time());
        }
        return $value;
    }
}
