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
 * Date: 2017-05-15
 */

namespace app\common\logic;

use think\Model;

/**
 * 活动逻辑类
 */
class StoreGoodsClass extends Model
{
    /**
     * 获取店铺商品分类
     * @param $store_id
     * @param int $parent_id
     * @param array $result
     * @return array
     */
    public function getStoreGoodsClass($store_id, $parent_id = 0, &$result = array())
    {
        $store_goods_class_where = array(
            'store_id' => $store_id,
            'parent_id' => $parent_id,
        );
        $arr = M('store_goods_class')->where($store_goods_class_where)->order('cat_sort desc')->select();
        if (empty($arr)) {
            return array();
        }
        foreach ($arr as $cm) {
            $thisArr =& $result[];
            $cm['children'] = $this->getStoreGoodsClass($store_id, $cm['cat_id'], $thisArr);
            $thisArr = $cm;
        }
        return $result;
    }
}