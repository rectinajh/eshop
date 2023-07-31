<?php

namespace app\common\model;

use think\Model;

class GoldchainTrade extends Model
{
    const TRADE_SOLD_WAY = 1; //卖出
    const TRADE_BUY_WAY = 2; //买入

    protected $autoWriteTimestamp = true;
    protected $type = array(
        'complete_time' => 'timestamp'
    );
    protected $insert = array(
        'trade_no',
        'status',
        'price',
        'amount',
    );
    protected $append = array(
        'nickname',
        'relation_nickname',
    );

    /**
     * 自动生成交易号
     */
    public function setTradeNoAttr($value, $data)
    {
        do {
            $tradeNo = make_trade_no('TR');
        } while ($this->where('trade_no', $tradeNo)->find());
        return $tradeNo;
    }

    public function setPriceAttr($value, $data)
    {
        //如果是委托交易走卖家委托交易的价格
        return  $data['type'] != 0 ? $this->soldEntrust()->getRelation()->getAttr('price') : $value;
    }

    public function setAmountAttr($value, $data)
    {
        $price = number_format($this->getAttr('price'), config('default_decimal_scale'), '.', '');
        $tradeQty = number_format($this->getAttr('trade_qty'), config('default_decimal_scale'), '.', '');
        $amount = bcmul($tradeQty, $price, config('default_decimal_scale'));
        return $amount;
    }

    public function setStatusAttr($value, $data)
    {
        if ($this->isUpdate) {
            $originStatus = $this->getAttr('status');
            if ($originStatus != 0) {
                return $originStatus;
            } else {
                //订单完成时同步更新完成时间
                if ($value == 1) {
                    $this->setAttr('complete_time', time());
                }
                return $value;
            }
        } else {
            return 0;
        }
    }

    public function getNicknameAttr($value, $data)
    {
        $user = $this->user()->getRelation();
        if ($user) {
            return $user->nickname;
        } else {
            return '';
        }
    }

    public function getRelationNicknameAttr($value, $data)
    {
        if (empty($value)) {
            return '';
        }
        $user = $this->relationUser()->getRelation();
        if ($user) {
            return $user->nickname;
        } else {
            return '';
        }
    }

    //定义表间关联
    public function soldEntrust()
    {
        return $this->belongsTo('GoldchainEntrust', 'sold_entrust_id', 'id');
    }

    public function buyEntrust()
    {
        return $this->belongsTo('GoldchainEntrust', 'buy_entrust_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('Users', 'user_id', 'user_id');
    }
    
    public function relationUser()
    {
        return $this->belongsTo('Users', 'relation_user_id', 'user_id');
    }
}
