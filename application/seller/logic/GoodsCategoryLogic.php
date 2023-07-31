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

namespace app\seller\logic;

use think\Model;
use think\Db;

/**
 * 分类逻辑定义
 * Class CatsLogic
 * @package Home\Logic
 */
class GoodsCategoryLogic extends Model
{
    protected $store;

    public function setStore($store){
        $this->store = $store;
    }

    /**
     * 获取店铺的商品分类
     * @param int $parent_id
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getStoreGoodsCategory($parent_id = 0){
        $goods_category_list = Db::name('goods_category')->where(array('parent_id' => $parent_id))->order('sort_order desc')->select();
        if($this->store['bind_all_gc'] == 0){
            $bind_class_where = ['store_id' => $this->store['store_id'], 'state' => 1];
            if($goods_category_list[0]['level'] == 1){
                $class_id = Db::name('store_bind_class')->where($bind_class_where)->getField('class_1', true);
            }elseif($goods_category_list[0]['level'] == 2){
                $class_id = Db::name('store_bind_class')->where($bind_class_where)->getField('class_2', true);
            }else{
                $class_id = Db::name('store_bind_class')->where($bind_class_where)->getField('class_3', true);
            }
            if($class_id){
                $store_category_list = [];
                foreach ($goods_category_list as $categoryKey => $categoryItem) {
                    // 如果是某个店铺登录的, 那么这个店铺只能看到自己申请的分类,其余的看不到
                    if (in_array($categoryItem['id'], $class_id)){
                        $store_category_list[] = $goods_category_list[$categoryKey];
                    }
                }
                return $store_category_list;
            }
        }
        return $goods_category_list;
    }
}