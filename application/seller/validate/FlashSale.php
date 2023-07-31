<?php
namespace app\seller\validate;
use think\Validate;
use think\Db;
class FlashSale extends Validate
{
    // 验证规则
    protected $rule = [
        ['title', 'require'],
        ['goods_id', 'require'],
        ['price','require|number|checkPrice'],
        ['goods_num','require|number|checkGoodsNum'],
        ['buy_limit','require|number|checkLimit'],
        ['start_time','require'],
        ['end_time','require|checkEndTime'],
    ];
    //错误信息
    protected $message  = [
        'title.require'         => '抢购标题必须',
        'goods_id.require'      => '请选择参与抢购的商品',
        'price.require'         => '请填写限时抢购价格',
        'price.number'          => '限时抢购价格必须是数字',
        'price.checkPrice'      => '限时抢购价格必须小于商品原价',
        'goods_num.require'     => '请填写参加抢购数量',
        'goods_num.number'      => '抢购数量必须为数字',
        'goods_num.checkGoodsNum' => '抢购数量不能大于库存数量',
        'buy_limit.require'     => '请填写限购数量',
        'buy_limit.number'      => '限购数量必须为数字',
        'buy_limit.checkLimit'  => '限购数量不能超过抢购数量',
        'start_time.require'    => '请选择开始时间',
        'end_time.require'      => '请选择结束时间',
        'end_time.checkEndTime' => '结束时间不能早于开始时间',
    ];

    /**
     * 检查限购数量
     * @param $value|验证数据
     * @param $rule|验证规则
     * @param $data|全部数据
     * @return bool|string
     */
    protected function checkLimit($value, $rule ,$data)
    {
        return ($value > $data['goods_num']) ? false : true;
    }
    /**
     * 检查结束时间
     * @param $value|验证数据
     * @param $rule|验证规则
     * @param $data|全部数据
     * @return bool|string
     */
    protected function checkEndTime($value, $rule ,$data)
    {
        return ($value < $data['start_time']) ? false : true;
    }
    /**
     * 检查抢购价格
     * @param $value|验证数据
     * @param $rule|验证规则
     * @param $data|全部数据
     * @return bool|string
     */
    protected function checkPrice($value, $rule ,$data)
    {
        if($data['item_id'] > 0){
            //商品规格
            $price = Db::name("spec_goods_price")->where(['item_id'=>$data['item_id']])->getField('price');
        }else{
            $price = Db::name('goods')->where('goods_id',$data['goods_id'])->getField('shop_price');
        }
        return ($value > $price) ? false : true;
    }
    /**
     * 检查参与抢购数量
     * @param $value|验证数据
     * @param $rule|验证规则
     * @param $data|全部数据
     * @return bool|string
     */
    protected function checkGoodsNum($value, $rule ,$data)
    {
        if($data['item_id'] > 0){
            //商品规格
            $store_count = Db::name("spec_goods_price")->where(['item_id'=>$data['item_id']])->getField('store_count');
        }else{
            $store_count = Db::name("goods")->where(['goods_id'=>$data['goods_id']])->getField('store_count');
        }
        return ($value > $store_count) ? false : true;
    }

}