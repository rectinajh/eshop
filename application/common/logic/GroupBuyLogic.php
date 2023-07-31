<?php
/**
 * 新淘链商城
 * ============================================================================
 * 版权所有 2015-2027 新淘链，并保留所有权利。
 * 网站地址: 
 * ----------------------------------------------------------------------------
 * 这是一个商业软件，您必须购买授权才能使用.
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 请支持正版, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 新淘链
 * Date: 2015-09-09
 */

namespace app\common\logic;

use app\common\model\GroupBuy;
use app\common\model\SpecGoodsPrice;
use think\Model;
use think\db;
use app\common\model\Goods;

/**
 * 团购逻辑定义
 * Class CatsLogic
 * @package common\Logic
 */
class GroupBuyLogic extends Model
{
    protected $GroupBuy;//团购模型
    protected $goods;//商品模型
    protected $specGoodsPrice;//商品规格模型

    public function __construct($goods,$specGoodsPrice)
    {
        parent::__construct();
        $this->goods = $goods;
        $this->specGoodsPrice = $specGoodsPrice;
        if($this->specGoodsPrice){
            //活动商品有规格，规格和活动是一对一
            $this->GroupBuy = GroupBuy::get($specGoodsPrice['prom_id'],'',true);
        }else{
            //活动商品没有规格，活动和商品是一对一
            $this->GroupBuy = GroupBuy::get($this->goods['prom_id'],'',true);
        }
        if ($this->GroupBuy) {
            //每次初始化都检测活动是否失效，如果失效就更新活动和商品恢复成普通商品
            if ($this->checkActivityIsEnd() && $this->GroupBuy['is_end'] == 0) {
                if($this->specGoodsPrice){
                    Db::name('spec_goods_price')->where('item_id', $this->specGoodsPrice['item_id'])->save(['prom_type' => 0, 'prom_id' => 0]);
                    $goodsPromCount = Db::name('spec_goods_price')->where('goods_id', $this->specGoodsPrice['goods_id'])->where('prom_type','>',0)->count('item_id');
                    if($goodsPromCount == 0){
                        Db::name('goods')->where("goods_id", $this->specGoodsPrice['goods_id'])->save(['prom_type' => 0, 'prom_id' => 0]);
                    }
                    unset($this->specGoodsPrice);
                    $this->specGoodsPrice = SpecGoodsPrice::get($specGoodsPrice['item_id'],'',true);
                }else{
                    Db::name('goods')->where("goods_id", $this->GroupBuy['goods_id'])->save(['prom_type' => 0, 'prom_id' => 0]);
                }
                //顺便把购物车里面的这个活动商品删除
                Db::name('cart')->where(['goods_id'=>$this->GroupBuy['goods_id'],'prom_id'=>$this->GroupBuy['id']])->delete();
                $this->GroupBuy->is_end = 1;
                $this->GroupBuy->save();
                unset($this->goods);
                $this->goods = Goods::get($goods['goods_id']);
            }
        }
    }

    /**
     * 获取团购剩余库存
     */
    public function getPromotionSurplus(){
        return $this->GroupBuy['goods_num'] - $this->GroupBuy['buy_num'];
    }
    public function getPromModel(){
        return $this->GroupBuy;
    }
    
    /**
     * 活动是否正在进行
     * @return bool
     */
    public function checkActivityIsAble(){
        if (empty($this->GroupBuy)) {
            return false;
        }
        if(time() > $this->GroupBuy['start_time'] && time() < $this->GroupBuy['end_time' ]&& $this->GroupBuy['status'] == 1){
            return true;
        }
        return false;
    }
    /**
     * 活动是否结束
     * @return bool
     */
    public function checkActivityIsEnd(){
        if(empty($this->GroupBuy)){
            return true;
        }
        if($this->GroupBuy['buy_num'] >= $this->GroupBuy['goods_num']){
            return true;
        }
        if(time() > $this->GroupBuy['end_time']){
            return true;
        }
        if($this->GroupBuy['status'] > 2){
            return true;
        }
        return false;
    }
    /**
     * 获取商品原始数据
     * @return Goods
     */
    public function getGoodsInfo()
    {
       return $this->goods;
    }

    /**
     * 获取商品转换活动商品的数据
     * @return static
     */
    public function getActivityGoodsInfo(){
        if($this->specGoodsPrice){
            //活动商品有规格，规格和活动是一对一
            $activityGoods = $this->specGoodsPrice;
        }else{
            //活动商品没有规格，活动和商品是一对一
            $activityGoods = $this->goods;
        }
        $activityGoods['activity_title'] = $this->GroupBuy['title'];
        $activityGoods['market_price'] = $this->goods['shop_price'];
        $activityGoods['shop_price'] = $this->GroupBuy['price'];
        $activityGoods['store_count'] = $this->GroupBuy['store_count'];
        $activityGoods['start_time'] = $this->GroupBuy['start_time'];
        $activityGoods['end_time'] = $this->GroupBuy['end_time'];
        return $activityGoods;
    }
}