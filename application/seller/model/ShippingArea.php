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

namespace app\seller\model;
use think\model;
class ShippingArea extends model {

    /**
     * 获取店铺的配送区域
     * @param $store_id
     * @return mixed
     */
    public function getShippingArea($store_id)
    {
        $shipping_areas = M('shipping_area')->where(array('store_id'=>$store_id))->select();
        foreach($shipping_areas as $key => $val){
            $shipping_areas[$key]['config'] = unserialize($shipping_areas[$key]['config']);
        }
        return $shipping_areas;
    }

}
