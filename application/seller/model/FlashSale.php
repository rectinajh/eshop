<?php
/**
 * 新淘链商城
 * ============================================================================
 * 版权所有 2015-2027 新淘链，并保留所有权利。
 * 网站地址: 
 * ----------------------------------------------------------------------------
 * 这是一个商业软件，您必须购买授权才能使用.
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Author: 新淘链
 * Date: 2015-09-09
 */
namespace app\seller\model;
use think\Model;
class FlashSale extends Model {
    //自定义初始化
    protected static function init()
    {
        //TODO:自定义的初始化
    }

    public function specGoodsPrice()
    {
        return $this->hasOne('SpecGoodsPrice','item_id','item_id');
    }

    public function goods()
    {
        return $this->hasOne('goods','prom_id','id');
    }

}
