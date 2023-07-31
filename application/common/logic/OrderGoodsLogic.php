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

use think\Model;
use think\Db;
/**
 * Class OrderGoodsLogic
 * @package common\Logic
 */
class OrderGoodsLogic extends Model
{
    /**
     * 查找订单下的所有未评价的商品
     * @param $order_id
     * @return mixed
     */
    public function get_no_comment_goods_list($order_id){
        $no_comment_goods_where['og.is_comment'] = 0;
        $no_comment_goods_where['og.order_id'] = $order_id;
        $no_comment_goods_where['og.deleted'] = 0;
        $no_comment_goods_list = Db::name('order_goods')->alias('og')
            ->field('og.rec_id,og.order_id,og.goods_id,og.goods_name,og.spec_key_name,og.goods_price,g.original_img')
            ->join("__GOODS__ g","g.goods_id = og.goods_id","LEFT")
            ->where($no_comment_goods_where)
            ->select();
        return $no_comment_goods_list;
    }

    /**
     * 获取订单里没有被评价的商品（单条）
     * @param $order_id
     * @param $goods_id
     * @return mixed
     */
    public function get_no_comment_goods($order_id,$goods_id){
        $no_comment_goods_where['og.is_comment'] = 0;
        $no_comment_goods_where['og.order_id'] = $order_id;
        $no_comment_goods_where['og.deleted'] = 0;
        $no_comment_goods_where['og.goods_id'] = $goods_id;
        $no_comment_goods_list = DB::name('order_goods')->alias('og')
            ->field('og.rec_id,og.order_id,og.goods_id,og.goods_name,og.spec_key_name,og.goods_price,g.original_img')
            ->join("__GOODS__ g","g.goods_id = og.goods_id","LEFT")
            ->where($no_comment_goods_where)
            ->find();
        return $no_comment_goods_list;
    }

}

 