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
class ActivityLogic extends Model
{
    /**
     * 团购列表
     * @param type $sort_type
     * @param type $page_index
     * @param type $page_size
     */
    public function getGroupBuyList($sort_type = '', $page_index = 1, $page_size = 20)
    {
        if ($sort_type == 'new') {
            $type = 'start_time';
        } elseif ($sort_type == 'comment') {
            $type = 'g.comment_count';
        } else {
            $type = '';
        }
        
        $group_by_where = array(
            'start_time'=>array('lt',time()),
            'end_time'=>array('gt',time()),
            'status' =>1
        );
        $list = M('group_buy')->alias('b')
                ->field('b.goods_id,b.rebate,b.virtual_num,b.buy_num,b.title,b.goods_price,b.end_time,b.price,g.comment_count')
                ->join('__GOODS__ g', 'b.goods_id=g.goods_id AND g.prom_type=2')
                ->where($group_by_where)->page($page_index, $page_size)
                ->order($type, 'desc')
                ->select(); // 找出这个商品
        
        $groups = array();
        $server_time = time();
        foreach ($list as $v) {
            $v["server_time"] = $server_time;
            $groups[] = $v;
        }

        return $groups;
    }
    
    /**
     * 优惠券列表
     * @param type $atype 排序类型 1:默认id排序，2:即将过期，3:面值最大
     * @param type $p 第几页
     */
    public function getCouponList($atype, $user_id, $p = 1)
    {
        $where = array('type' => 2,'status'=>1,'send_start_time'=>['elt',time()],'send_end_time'=>['egt',time()]);
        $order = array('id' => 'desc');
        if ($atype == 2) {
            //即将过期
            $order = ['spacing_time' => 'asc'];
            $where['send_end_time-UNIX_TIMESTAMP()'] = ['egt', 0];
        } elseif ($atype == 3) {
            //面值最大
            $order = ['money' => 'desc'];
        }

        $coupon_list = M('coupon')
            ->field('*,send_end_time-UNIX_TIMESTAMP() as spacing_time')
            ->where($where)
            ->page($p, 15)
            ->order($order)->select();
        if (is_array($coupon_list) && count($coupon_list) > 0) {
            $store_id_arr = get_arr_column($coupon_list, 'store_id');
            $store_arr = M('store')->where("store_id in (" . implode(',', $store_id_arr) . ")")->getField('store_id,store_name,store_logo');
            if ($user_id) {
                $user_coupon = M('coupon_list')->where(['uid' => $user_id, 'type' => 2,'status'=>0,'deleted'=>0])->getField('cid',true);
            }
            if (!empty($user_coupon)) {
                foreach ($coupon_list as $k => $val) {
                    $coupon_list[$k]['isget'] = 0;
                    if (in_array($val['id'],$user_coupon)) {
                        $coupon_list[$k]['isget'] = 1;
                    }
                    if($coupon_list[$k]['use_type'] == 0)$coupon_list[$k]['use_scope'] = '全店通用';
                    if($coupon_list[$k]['use_type'] == 1)$coupon_list[$k]['use_scope'] = '指定商品';
                    if($coupon_list[$k]['use_type'] == 2)$coupon_list[$k]['use_scope'] = '指定分类';
                }
            }
        }
        return [
            'store_arr' => $store_arr ?: [],
            'coupon_list' => $coupon_list,
        ];
    }
    
    /**
     * 获取优惠券查询对象
     * @param int $queryType 0:count 1:select
     * @param type $user_id
     * @param type $type 查询类型 0:未使用，1:已使用，2:已过期
     * @param type $orderBy 排序类型，use_end_time、send_time,默认send_time
     * @param type $belone 0:具体商家，1:自营, 2:所有商家
     * @param type $store_id
     * @return Query
     */
    public function getCouponQuery($queryType, $user_id, $type = 0, $orderBy = null, $belone = 0, $store_id = 0)
    {
        $where['l.uid'] = $user_id;
        $where['l.deleted'] = 0;

        //查询条件
        if (empty($type)) {
            // 未使用
//            $where['l.order_id'] = 0;
            $where['c.use_end_time'] = array('gt', time());
            $where['c.status'] = 1;
            $where['l.status'] = 0;
        } elseif ($type == 1) {
            //已使用
            $where['l.order_id'] = array('gt', 0);
            $where['l.use_time'] = array('gt', 0);
        } elseif ($type == 2) {
            //已过期
            $where['c.use_end_time'] = array('lt', time());
        }

        if ($orderBy == 'use_end_time') {
            //即将过期，$type = 0 AND $orderBy = 'use_end_time'
            $order['c.use_end_time'] = 'asc';
        } elseif ($orderBy == 'send_time') {
            //最近到账，$type = 0 AND $orderBy = 'send_time'
            $where['l.send_time'] = array('lt',time());
            $order['l.send_time'] = 'desc';
        } elseif (empty($orderBy)) {
            $order = array('l.send_time' => 'DESC', 'l.use_time');
        }

        $query = M('coupon_list')->alias('l')
            ->join('__COUPON__ c','l.cid = c.id')
            ->join('__STORE__ s','s.store_id = c.store_id')
            ->where($where)
            ->where(function($query) use ($belone, $store_id) {
                if ($belone == 1) {   //自营
                    $query->where("s.is_own_shop",1)->whereOr('s.store_id = 1');
                } elseif ($belone == 2) { //商家
                    $query->where("s.is_own_shop",0);
                } elseif ($store_id) {
                    $query->where("l.store_id", $store_id);
                }
            });
        
        if ($queryType != 0) {
            $query = $query->field('l.*,c.name,c.use_type,c.money,c.use_start_time,c.use_end_time,c.condition')
                    ->order($order);
        }

        return $query;
    }
    
    /**
     * 获取优惠券数目
     */
    public function getUserCouponNum($user_id, $type = 0, $orderBy = null, $belone = 0, $store_id = 0)
    {
        $query = $this->getCouponQuery(0, $user_id, $type, $orderBy, $belone, $store_id);
        return $query->count();
    }
    
    /**
     * 获取用户优惠券列表
     */
    public function getUserCouponList($firstRow, $listRows, $user_id, $type = 0, $orderBy = null, $belone = 0, $store_id = 0)
    {
        $query = $this->getCouponQuery(1, $user_id, $type, $orderBy, $belone, $store_id);
        return $query->limit($firstRow, $listRows)->select();
    }
    
    /**
     * 领券中心
     * @param type $cat_id 领券类型id
     * @param type $user_id 用户id
     * @param type $p 第几页
     * @return type
     */
    public function getCouponCenterList($cat_id, $user_id, $p = 1)
    {
        /* 获取优惠券列表 */
        $cur_time = time();
        $coupon_where = ['type'=>2, 'status'=>1, 'send_start_time'=>['elt',time()], 'send_end_time'=>['egt',time()]];
        $query = M('coupon')->alias('c')
            ->field('c.id,c.money,c.condition,c.createnum,c.send_num,c.store_id,c.send_end_time-'.$cur_time.' as spacing_time')
            ->where('((createnum-send_num>0 AND createnum>0) OR (createnum=0))')    //领完的也不要显示了
            ->where($coupon_where)->page($p, 15)
            ->order('spacing_time', 'asc');
        if ($cat_id > 0) {
            $query = $query->join('__GOODS_COUPON__ gc', 'gc.coupon_id=c.id AND gc.goods_category_id='.$cat_id);
        }
        $coupon_list = $query->select();
        
        if (!(is_array($coupon_list) && count($coupon_list) > 0)) {
            return [];
        }
        
        $store_id_arr = get_arr_column($coupon_list, 'store_id');
        $store_arr = M('store')->where('store_id', 'in', $store_id_arr)->getField('store_id,store_name,store_logo');
        
        $user_coupon = [];
        if ($user_id) {
            $user_coupon = M('coupon_list')->where(['uid' => $user_id, 'type' => 2])->column('cid');
        }

        $types = [];
        if ($cat_id) {
            /* 优惠券类型格式转换 */
            $couponType = $this->getCouponTypes();
            foreach ($couponType as $v) {
                $types[$v['id']] = $v['name'];
            }
        }

        foreach ($coupon_list as $k => $val) {
            /* 是否已获取 */
            $coupon_list[$k]['isget'] = 0;
            if (in_array($val['id'], $user_coupon)) {
                $coupon_list[$k]['isget'] = 1;
            }

            /* 构造封面和标题 */
            $store_id = $coupon_list[$k]['store_id'];
            if ($store_id > 0) {
                $coupon_list[$k]['image'] = $store_arr[$store_id]['store_logo'] ?: '';
                if ($cat_id) {
                    $coupon_list[$k]['title'] = '可购买'.$store_arr[$store_id]['store_name'].'的'.$types[$cat_id].'类等商品';
                } else {
                    $coupon_list[$k]['title'] = '仅限购买'.$store_arr[$store_id]['store_name'].'的商品';
                }
            } else {
                $coupon_list[$k]['image'] = '';
                if ($cat_id) {
                    $coupon_list[$k]['title'] = '可购买'.$types[$cat_id].'类等商品';
                } else {
                    $coupon_list[$k]['title'] = '可用于全平台的商品';
                }
            }
        }
        
        return  $coupon_list;
    }
    
    /**
     * 优惠券类型列表
     * @param type $p 第几页
     * @param type $num 每页多少，null表示全部
     * @return type
     */
    public function getCouponTypes($p = 1, $num = null)
    {
        $list = M('coupon')->alias('c')
                ->join('__GOODS_COUPON__ gc', 'gc.coupon_id=c.id AND gc.goods_category_id!=0')
                ->where(['type' => 2, 'status' => 1])
                ->column('gc.goods_category_id');
        
        $result = M('goods_category')->field('id, mobile_name')->where("id", "IN", $list)->page($p, $num)->select();
        $result = $result ?: [];
        array_unshift($result, ['id'=>0, 'mobile_name'=>'精选']);

        return $result;
    }
    
    /**
     * 领券
     * @param $id 优惠券id
     * @param $user_id
     */
    public function get_coupon($id, $user_id)
    {
        if (empty($id)){
            $return = ['status' => 0, 'msg' => '参数错误'];
        }
        if ($user_id) {
            $coupon_info = M('coupon')->where(array('id' => $id, 'status' => 1))->find();
            if (empty($coupon_info)) {
                $return = ['status' => 0, 'msg' => '活动已结束或不存在，看下其他活动吧~'];
            } elseif ($coupon_info['send_end_time'] < time()) {
                //来晚了，过了领取时间
                $return = ['status' => 0, 'msg' => '抱歉，已经过了领取时间'];
            } elseif ($coupon_info['send_num'] >= $coupon_info['createnum'] and $coupon_info['createnum'] != 0) {
                //来晚了，优惠券被抢完了
                $return = ['status' => 0, 'msg' => '来晚了，优惠券被抢完了'];
            } else {
                if (M('coupon_list')->where(array('cid' => $id, 'uid' => $user_id))->count() > 0) {
                    //已经领取过
                    $return = ['status' => 2, 'msg' => '您已领取过该优惠券'];
                } else {
                    $data = array('uid' => $user_id, 'cid' => $id, 'type' => 2, 'send_time' => time(), 'store_id' => $coupon_info['store_id']);
                    M('coupon_list')->add($data);
                    M('coupon')->where(array('id' => $id, 'status' => 1))->setInc('send_num');
                    $return = ['status' => 1, 'msg' => '恭喜您，抢到' . $coupon_info['money'] . '元优惠券!'];
                }
            }
        } else {
            $return = ['status' => 0, 'msg' => '请先登录'];
        }
        
        return $return;
    }
}