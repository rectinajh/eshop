<?php

/**
 * 新淘链商城
 * ============================================================================
 * * 版权所有 2015-2027 新淘链，并保留所有权利。
 * 网站地址: 
 * ----------------------------------------------------------------------------
 * 这是一个商业软件，您必须购买授权才能使用.
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 请支持正版, 以免引起不必要的法律纠纷.
 * ============================================================================
 * 订单以及售后中心
 * @author soubao 
 *  @Date: 2016-12-20
 */
namespace app\mobile\controller;

use app\common\logic\OrderLogic;
use app\common\logic\OrderGoodsLogic;
use app\common\logic\StoreLogic;
use app\common\logic\CommentLogic;
use app\common\logic\UsersLogic;
use think\Db;
use think\Page;

class Order extends MobileBase
{

    public $user_id = 0;
    public $user = array();

    public function _initialize()
    {
        parent::_initialize();
        if (session('?user')) {
            $user = session('user');
            $user = M('users')->where("user_id", $user['user_id'])->find();
            session('user', $user);  //覆盖session 中的 user               
            $this->user = $user;
            $this->user_id = $user['user_id'];
            $this->assign('user', $user); //存储用户信息
            $this->assign('user_id', $this->user_id);
        } else {
            header("location:" . U('User/login'));
            exit;
        }
    }

    /*
     * 订单列表
     */
    public function order_list()
    {
        $order = new \app\common\model\Order();
        $where = ' user_id=:user_id';
        $bind['user_id'] = $this->user_id;
        //条件搜索
        $start_time = I('start_time');
        $end_tine = I('end_time');
        if (!empty($start_time) ^ !empty($start_time)) {
            $this->error('下单时间查询条件不完整');
        }
        if (!empty($start_time) && !empty($start_time)) {
            $add_start_time = strtotime($start_time);
            $add_end_time = strtotime($end_tine);
            if ($add_start_time > $add_end_time) {
                $this->error('下单时间查询条件有误');
            }
            $where .= " and add_time >= :add_start_time and add_time <= :add_end_time";
            $bind['add_start_time'] = $add_start_time;
            $bind['add_end_time'] = $add_end_time;
        }

        if (I('get.type')) {
            $where .= C(strtoupper(I('get.type')));
        }
        $where .= ' and deleted = 0 ';;//删除的订单不列出来
        $where .= ' and order_status <> 5 ';//作废订单不列出来
        // 搜索订单 根据商品名称 或者 订单编号
        $search_key = trim(I('search_key'));
        if ($search_key) {
            $where .= " and (order_sn like :search_key1 or order_id in (select order_id from `" . C('database.prefix') . "order_goods` where goods_name like :search_key2) ) ";
            $bind['search_key1'] = '%' . $search_key . '%';
            $bind['search_key2'] = '%' . $search_key . '%';
        }
        $count = M('order')->where($where)->bind($bind)->count();
        $Page = new Page($count, 10);
        $show = $Page->show();
        $order_str = "order_id DESC";
        //获取订单
        $order_list_obj = M('order')->order($order_str)->where($where)->bind($bind)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        if ($order_list_obj) {
            foreach ($order_list_obj as $k => $v) {
                $v['order_status_detail'] = $order->getOrderStatusDetailAttr(null, $v);
                $v['order_button'] = $order->getOrderButtonAttr(null, $v);
                $v['order_goods'] = M('order_goods' . $select_year)->cache(true, 3)->where('order_id = ' . $v['order_id'])->select();
                $v['store'] = M('store')->cache(true)->where('store_id = ' . $v['store_id'])->field('store_id,store_name,store_qq')->find();
                foreach ($v['order_goods'] as $kk => $vv) {
                    $goods_id = $vv['goods_id'];
                    $re = M('goods')->where("goods_id=$goods_id")->find();
                    $v['cat_id1'] = $re['cat_id1'];
                    $v['hcredit'] = $re['hcredit'];
                }
                $order_list[] = $v;

            }
        }
        $this->assign('order_status', C('ORDER_STATUS'));
        $this->assign('shipping_status', C('SHIPPING_STATUS'));
        $this->assign('pay_status', C('PAY_STATUS'));
        $this->assign('page', $show);
        $this->assign('order_list', $order_list);
        $this->assign('active', 'order_list');
        $this->assign('active_status', I('get.type'));
        $this->assign('now', time());
        if ($_GET['is_ajax']) {
            return $this->fetch('ajax_order_list');
        }
        return $this->fetch();
    }
    /**
     * 易物列表
     */
    public function yiwu_list()
    {
        $order = new \app\common\model\Order();

        $where = ' user_id=:user_id';
        $bind['user_id'] = $this->user_id;
        //条件搜索
        $start_time = I('start_time');
        $end_tine = I('end_time');
        if (!empty($start_time) ^ !empty($start_time)) {
            $this->error('下单时间查询条件不完整');
        }
        if (!empty($start_time) && !empty($start_time)) {
            $add_start_time = strtotime($start_time);
            $add_end_time = strtotime($end_tine);
            if ($add_start_time > $add_end_time) {
                $this->error('下单时间查询条件有误');
            }
            $where .= " and add_time >= :add_start_time and add_time <= :add_end_time";
            $bind['add_start_time'] = $add_start_time;
            $bind['add_end_time'] = $add_end_time;
        }


        $where .= ' and deleted = 0 ';;//删除的订单不列出来
        $where .= ' and order_status <> 5 ';//作废订单不列出来
        if (I('get.order_status')) {
            $order_status = I('get.order_status');
            $where .= "and order_status=$order_status";
        }
        // 搜索订单 根据商品名称 或者 订单编号
        $search_key = trim(I('search_key'));
        if ($search_key) {
            $where .= " and (order_sn like :search_key1 or id in (select id from `" . C('database.prefix') . "changegoods` where goods_name like :search_key2) ) ";
            $bind['search_key1'] = '%' . $search_key . '%';
            $bind['search_key2'] = '%' . $search_key . '%';
        }
        $count = M('changegoods')->where($where)->bind($bind)->count();
        $Page = new Page($count, 10);
        $show = $Page->show();
        $order_str = "id DESC";
        //获取订单
       // $order_list_obj = $order->order($order_str)->where($where)->bind($bind)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $order_list_obj = M('changegoods')->order($order_str)->where($where)->bind($bind)->limit($Page->firstRow . ',' . $Page->listRows)->select();

        if ($order_list_obj) {
            //转为数字，并获取订单状态，订单状态显示按钮，订单商品

            //$order_list=collection($order_list_obj)->append(['order_status_detail','order_button','order_goods','store'])->toArray();
            foreach ($order_list_obj as $k => $v) {
                $v['order_status_detail'] = $order->getOrderStatusDetailAttr(null, $v);
                $v['order_button'] = $order->getOrderButtonAttr(null, $v);
                $v['order_goods'] = M('goods')->cache(true, 3)->where(array('ywuser_id' => $v['change_user_id'], 'goods_id' => $v['goods_id']))->select();

                $v['order_user'] = M('users')->cache(true, 3)->where('user_id = ' . $v['change_user_id'])->find();
                //$v['store'] = M('store')->cache(true)->where('store_id = '.$v['store_id'])->field('store_id,store_name,store_qq')->find();
                $order_list[] = $v;
            }
        }

        $this->assign('order_status', C('ORDER_STATUS'));
        $this->assign('shipping_status', C('SHIPPING_STATUS'));
        $this->assign('pay_status', C('PAY_STATUS'));
        $this->assign('page', $show);
        $this->assign('lists', $order_list);
        $this->assign('active', 'order_list');
        $this->assign('active_status', I('get.type'));
        $this->assign('now', time());
        if ($_GET['is_ajax']) {
            return $this->fetch('ajax_order_list');
        }

        return $this->fetch();
    }
    /*
     * 待收货
     */
    public function wait_receive()
    {
        $Order = new \app\common\model\Order();
        $where = ' user_id=' . $this->user_id;
        //条件搜索
        if (in_array(strtoupper(I('type')), array('WAITCCOMMENT', 'COMMENTED'))) {
            $where .= " AND order_status in(1,4) "; //待评价 和 已评价
        } elseif (I('type')) {
            $where .= C(strtoupper(I('type')));
        }
        $count = M('order')->where($where)->count();
        $Page = new Page($count, 10);

        $order_str = "order_id DESC";
        //获取订单
        $order_list_obj = $Order->order($order_str)->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        if ($order_list_obj) {
            //转为数字，并获取订单状态，订单状态显示按钮，订单商品
            $order_list = collection($order_list_obj)->append(['order_status_detail', 'order_button', 'order_goods', 'store'])->toArray();
        }
        if ($order_list) {
            foreach ($order_list as $k => $v) {

                $invoice_no = M('DeliveryDoc')->where("order_id", $v['order_id'])->getField('invoice_no', true);
                $order_list[$k]['invoice_no'] = implode(' , ', $invoice_no);
            }
        }
        $this->assign('order_list', $order_list);

        $storeList = M('store')->getField('store_id,store_name,store_qq'); // 找出所有商品对应的店铺id
        $this->assign('storeList', $storeList); // 店铺列表

        if ($_GET['is_ajax']) {
            return $this->fetch('ajax_wait_receive');
        }
        return $this->fetch();
    }

    public function del_order()
    {
        $order_id = I('order_id/d', 0);
        $order_type = I('type/s');
        $row = M('order')->where('order_id', $order_id)->update(['deleted' => 1]);
        if ($row) {
            //删除成功
            $this->success('删除成功', U('Order/order_list', array('type' => $order_type)));
        } else {
            //删除失败
            $this->error('删除失败');
        }
    }
    /*
     * 订单详情
     */
    public function order_detail()
    {
        $select_year = select_year(); // 查询 三个月,今年内,2016年等....订单 
        $id = I('get.id/d');
        if (empty($id)) {
            $this->error('参数错误');
        }
        $map['order_id'] = $id;
        $map['user_id'] = $this->user_id;
        $order_info = M('order' . $select_year)->where($map)->find();
        $order_info = set_btn_order_status($order_info);  // 添加属性  包括按钮显示属性 和 订单状态显示属性
        if (!$order_info) {
            $this->error('没有获取到订单信息');
            exit;
        }
        //获取订单商品
        //$model = new UsersLogic();		
        $order_info['goods_list'] = M('order_goods' . $select_year)->where("order_id", $order_info['order_id'])->select();
        $order_info['total_fee'] = $order_info['goods_price'] + $order_info['shipping_price'] - $order_info['integral_money'] - $order_info['coupon_price'] - $order_info['discount'];
        $store = M('store')->where(['store_id' => $order_info['store_id']])->find(); // 找出这个商家
        // 店铺地址id
        $ids[] = $store['province_id'];
        $ids[] = $store['city_id'];
        $ids[] = $store['district'];
        $ids[] = $order_info['province'];
        $ids[] = $order_info['city'];
        $ids[] = $order_info['district'];

        foreach ($ids as &$id_v) {
            if (!$id_v) $id_v = "''";
        }
        //$region_list = get_region_list();
        if (!empty($ids))
            $region_list = M('region')->where("id in (" . implode(',', $ids) . ")")->getField("id,name");

        $invoice_no = M('delivery_doc' . $select_year)->where("order_id", $id)->getField('invoice_no', true);
        $order_info['invoice_no'] = implode(' , ', $invoice_no);
        //获取订单操作记录
        $order_action = M('order_action' . $select_year)->where(array('order_id' => $id))->select();
        $this->assign('store', $store);
        $this->assign('order_status', C('ORDER_STATUS'));
        $this->assign('shipping_status', C('SHIPPING_STATUS'));
        $this->assign('pay_status', C('PAY_STATUS'));
        $this->assign('region_list', $region_list);
        $this->assign('order_info', $order_info);
        $this->assign('order_action', $order_action);
        return $this->fetch();
    }


    public function express()
    {
        $order_id = I('get.order_id/d', 0);
        $order_goods = M('order_goods')->where("order_id", $order_id)->select();
        $delivery = M('delivery_doc')->where("order_id", $order_id)->limit(1)->find();
        $this->assign('order_goods', $order_goods);
        $this->assign('delivery', $delivery);
        return $this->fetch();
    }


    public function virtual_order()
    {
        $Order = new \app\common\model\Order();
        $order_id = I('get.order_id/d');
        $map['order_id'] = $order_id;
        $map['user_id'] = $this->user_id;
        $orderobj = $Order->where($map)->find();
        if (!$orderobj) $this->error('没有获取到订单信息');
        // 添加属性  包括按钮显示属性 和 订单状态显示属性
        $order_info = $orderobj->append(['order_status_detail', 'order_button', 'order_goods', 'store'])->toArray();
        //获取订单操作记录
        $order_action = M('order_action')->where(array('order_id' => $order_id))->select();
        $this->assign('order_status', C('ORDER_STATUS'));
        $this->assign('pay_status', C('PAY_STATUS'));
        $this->assign('order_info', $order_info);
        $this->assign('order_action', $order_action);

        if ($order_info['pay_status'] == 1 && $order_info['order_status'] != 3) {
            $vrorder = M('vr_order_code')->where(array('order_id' => $order_id))->select();
            $this->assign('vrorder', $vrorder);
        }
        return $this->fetch();
    }

    /*
     * 取消订单
     */
    public function cancel_order()
    {
        $id = I('get.id');
        //检查是否有积分，余额支付
        $logic = new OrderLogic();
        $data = $logic->cancel_order($this->user_id, $id);
        if ($data['status'] < 0)
            $this->ajaxReturn(['status' => 0, 'msg' => $data['msg']]);
        $this->ajaxReturn(['status' => 1, 'msg' => $data['msg']]);
    }
        
    /*
     * 评论晒单
     */
    public function comment()
    {
        $user_id = $this->user_id;
        $status = I('get.status', -1);
        $logic = new CommentLogic;
        $data = $logic->getComment($user_id, $status); //获取评论列表
        $this->assign('page', $data['show']);// 赋值分页输出
        $this->assign('comment_page', $data['page']);
        $this->assign('comment_list', $data['result']);
        $this->assign('active', 'comment');
        if (I('is_ajax')) {
            return $this->fetch('ajax_comment_list');
        }
        return $this->fetch();
    }

    /**
     * 删除评价
     */
    public function delComment()
    {
        $comment_id = I('comment_id');
        if (empty($comment_id)) {
            $this->error('参数错误');
        }
        $comment = Db::name('comment')->where('comment_id', $comment_id)->find();
        if ($this->user_id != $comment['user_id']) {
            $this->error('不能删除别人的评论');
        }
        Db::name('reply')->where('comment_id', $comment_id)->delete();
        Db::name('comment')->where('comment_id', $comment_id)->delete();
        $this->success('删除评论成功');
    }

    /**
     * @time 2016/8/5
     * @author dyr
     * 订单评价列表
     */
    public function comment_list()
    {
        $order_id = I('get.order_id/d');
        $store_id = I('get.store_id/d');
        $goods_id = I('get.goods_id/d');
        $part_finish = I('get.part_finish', 0);
        if (empty($order_id) || empty($store_id)) {
            $this->error("参数错误");
        } else {
            //查找店铺信息
            $store_where['store_id'] = $store_id;
            $store_info = M('store')->field('store_id,store_name,store_phone,store_address,store_logo')->where($store_where)->find();
            if (empty($store_info)) {
                $this->error("该商家不存在");
            }
            //查找订单是否已经被用户评价
            $order_comment_where['order_id'] = $order_id;
            $order_comment_where['deleted'] = 0;
            $order_info = M('order')->field('order_id,order_sn,is_comment,add_time')->where($order_comment_where)->find();
            //查找订单下的所有未评价的商品
            $order_goods_logic = new OrderGoodsLogic();
            $no_comment_goods = $order_goods_logic->get_no_comment_goods($order_id, $goods_id);
            $this->assign('store_info', $store_info);
            $this->assign('order_info', $order_info);
            $this->assign('no_comment_goods', $no_comment_goods);
            $this->assign('part_finish', $part_finish);
            return $this->fetch();
        }
    }

    /**
     * @time 2016/8/5
     * @author dyr
     *  添加评论
     */
    public function addComment()
    {
        $order_id = I('post.order_id/d', 0);
        $goods_id = I('post.goods_id/d', 0);
        $service_rank = I('post.store_speed_hidden', 0);
        $deliver_rank = I('post.store_sever_hidden', 0);
        $goods_rank = I('post.store_packge_hidden', 0);
        $goods_score = I('post.rank', 0);
        $anonymous = I('post.anonymous');
        $content = I('post.content', '');
        $tag = I('post.tag', '');
        $spec_key_name = I('post.spec_key_name', '');

        $impression = (empty($tag[0])) ? '' : implode(',', $tag);
        $is_anonymous = empty($anonymous) ? 1 : 0;

        $commentLogic = new CommentLogic;
        $return = $commentLogic->addGoodsAndServiceComment(
            $this->user_id,
            $order_id,
            $goods_id,
            $content,
            $is_anonymous,
            $spec_key_name,
            $impression,
            $goods_score,
            $service_rank,
            $deliver_rank,
            $goods_rank
        );

        if ($return['status'] == 1) {
            return $this->success("评论成功", U('Mobile/Order/comment', ['status' => 0]));
        }
        return $this->error("评论失败", U('Mobile/Order/comment', ['status' => 0]));
    }

    /**
     * 评论别的用户评论
     */
    public function replyComment()
    {
        $data = I('post.');
        $data['reply_time'] = time();
        $data['deleted'] = 0;
        $return = Db::name('reply')->add($data);
        if ($return) {
            Db::name('comment')->where(['comment_id' => $data['comment_id']])->setInc('reply_num');
            $data['reply_time'] = date('Y-m-d H:m', $data['reply_time']);
            $this->ajaxReturn(['status' => 1, 'msg' => '评论成功！', 'result' => $data]);
            exit;
        } else {
            $this->ajaxReturn(['status' => 0, 'msg' => "评论失败"]);
        }
    }

    /**
     * @time 2016/8/5
     * @author dyr
     *  添加评论
     */
    public function comment_add()
    {
        $remark = I("post.remark/a");
        $anonymous = I('post.anonymous');
        $store_score['describe_score'] = I('post.store_packge_hidden');
        $store_score['seller_score'] = I('post.store_speed_hidden');
        $store_score['logistics_score'] = I('post.store_sever_hidden');
        $order_id = $store_score['order_id'] = $store_score_where['order_id'] = I('post.order_id/d');
        $store_score['user_id'] = $store_score_where['user_id'] = $this->user_id;
        $store_score_where['deleted'] = 0;
        $store_id = M('order')->where(array('order_id' => $store_score_where['order_id']))->getField('store_id');
        $store_score['store_id'] = $store_id;
        //处理订单评价
        if (!empty($store_score['describe_score']) && !empty($store_score['seller_score']) && !empty($store_score['logistics_score'])) {
            $order_comment = M('order_comment')->where($store_score_where)->find();
            if ($order_comment) {
                M('order_comment')->where($store_score_where)->save($store_score);
                M('order')->where(array('order_id' => $order_id))->save(array('is_comment' => 1));
            } else {
                M('order_comment')->add($store_score);//订单打分
                M('order')->where(array('order_id' => $order_id))->save(array('is_comment' => 1));
            }
            //订单打分后更新店铺评分
            $store_logic = new StoreLogic();
            $store_logic->updateStoreScore($store_id);
        }
        //处理商品评价
        if (is_array($remark)) {
            foreach ($remark as $key => $value) {
                if (!empty($value['rank']) && !empty($value['content'])) {
                    $comment['goods_id'] = $key;
                    $comment['order_id'] = $store_score['order_id'];
                    $comment['store_id'] = $store_id;
                    $comment['user_id'] = $this->user_id;
                    $comment['content'] = $value['content'];
                    $comment['ip_address'] = getIP();
                    $comment['spec_key_name'] = $value['spec_key_name'];
                    $comment['goods_rank'] = $value['rank'];
                    $comment['img'] = (empty($value['commment_img'][0])) ? '' : serialize($value['commment_img']);
                    $comment['impression'] = (empty($value['tag'][0])) ? '' : implode(',', $value['tag']);
                    $comment['is_anonymous'] = empty($anonymous) ? 1 : 0;
                    $comment['add_time'] = time();
                    M('comment')->add($comment);//想评论表插入数据
                    M('order_goods')->where(array('order_id' => $store_score['order_id'], 'goods_id' => $key))->save(array('is_comment' => 1));
                    M('goods')->where(array('goods_id' => $key))->setInc('comment_count', 1);
                    unset($comment);
                }
            }
        }
        //查找订单下是否有没有评价的商品
        $order_goods_logic = new OrderGoodsLogic();
        $no_comment_goods_list = $order_goods_logic->get_no_comment_goods_list($order_id);
        $no_comment_goods_count = count($no_comment_goods_list);
        if ($no_comment_goods_count > 0) {
            $this->redirect(U('Order/comment_list', array('part_finish' => 1, 'order_id' => $order_id, 'store_id' => $store_id)));
        } else {
            $this->redirect(U('Order/comment_list', array('order_id' => $order_id, 'store_id' => $store_id)));
        }
    }


    public function comment_info()
    {
        $commentLogic = new \app\common\logic\CommentLogic;
        $comment_id = I('comment_id/d');
        $res = $commentLogic->getCommentInfo($comment_id);
        if (empty($res)) {
            $this->error('参数错误！！');
        }
        if (!empty($res['comment_info']['img'])) $res['comment_info']['img'] = unserialize($res['comment_info']['img']);
        $user = get_user_info($res['comment_info']['user_id']);
        $res['comment_info']['nickname'] = $user['nickname'];
        $this->assign('comment_info', $res['comment_info']);
        $this->assign('comment_id', $comment_id);
        $this->assign('reply', $res['reply']);
        return $this->fetch();
    }
    /**
     *  点赞
     * @author dyr
     */
    public function ajaxZan()
    {
        $comment_id = I('post.comment_id/d');
        $user_id = $this->user_id;
        $comment_info = M('comment')->where(array('comment_id' => $comment_id))->find();
        $comment_user_id_array = explode(',', $comment_info['zan_userid']);
        if (in_array($user_id, $comment_user_id_array)) {
            $result = ['status' => 0, 'msg' => '您已经点过赞了~', 'result' => ''];
        } else {
            array_push($comment_user_id_array, $user_id);
            $comment_user_id_string = implode(',', $comment_user_id_array);
            $comment_data['zan_num'] = $comment_info['zan_num'] + 1;
            $comment_data['zan_userid'] = $comment_user_id_string;
            M('comment')->where(array('comment_id' => $comment_id))->save($comment_data);
            $result['success'] = 1;
            $result = ['status' => 1, 'msg' => '点赞成功~', 'result' => ''];
        }
        exit(json_encode($result));
    }
    public function order_confirm()
    {
        $id = I('post.order_id/d', 0);
        $tuijian = tpCache('basic.tuijian');//转账手续费比例
        $jiamengbili = tpCache('basic.jiamengbili');//推荐加盟店总订单额的比例
        $jiamengticheng = tpCache('basic.jiamengticheng');//推荐加盟店拿订单比例的提成
        $zengsongxianzhi = tpCache('basic.zengsongxianzhi');//赠送积分的限制
        $xianzhi = tpCache('basic.xianzhi');//返还积分的限制
        $data = confirm_order($id, $this->user_id, $tuijian, $jiamengbili, $jiamengticheng, $zengsongxianzhi, $xianzhi);
        $this->ajaxReturn($data);
    }
    /**
     * 签约调理区
     * @不满意的退款
     */
    public function order_notconfirm()
    {
        $id = I('post.order_id/d', 0);

        $data = notconfirm_order($id, $this->user_id);
        $this->ajaxReturn($data);
    }
    /**
     * 易物订单确认
     * 
     */
    public function yworder_confirm()
    {
        $id = I('post.order_id/d', 0);
        $data = confirm_yworder($id, $this->user_id);
        $this->ajaxReturn($data);
    }
    public function return_goods_index()
    {
        $sale_t = I('sale_t/i', 0);
        $keywords = I('keywords');

        $logic = new OrderLogic;
        $data = $logic->getReturnGoodsIndex($sale_t, $keywords, $this->user_id);

        $this->assign('order_list', $data['order_list']);
        $this->assign('page', $data['page']);
        $this->assign('keywords', $keywords);

        if (I('get.is_ajax', 0)) {
            return $this->fetch('ajax_return_goods_index');
        }
        return $this->fetch();
    }

    /**
     * 申请退货
     */
    public function return_goods()
    {
        $rec_id = I('rec_id', 0);
        $return_goods = M('return_goods')->where(array('rec_id' => $rec_id))->find();
        $order_goods = M('order_goods')->where(array('rec_id' => $rec_id))->find();
        $order = M('order')->where(array('order_id' => $order_goods['order_id'], 'user_id' => $this->user_id))->find();
        if (!$order) $this->error('非法操作');
        if (IS_POST) {
            $model = new OrderLogic();
            $res = $model->addReturnGoods($rec_id, $order);  //申请售后
            if ($res['result'] == 1) {
                $this->success($res['msg'], U('Order/return_goods_list'));
            }
            $this->error($res['msg']);
        }
        $confirm_time_config = tpCache('shopping.auto_service_date');
        $confirm_time = $confirm_time_config * 24 * 60 * 60;
        if ((time() - $order['confirm_time']) > $confirm_time && !empty($order['confirm_time'])) {
            $this->error('已经超过' . $confirm_time_config . "天内退货时间");
        }
        $store = M('store')->where(array('store_id' => $order['store_id']))->find();
        $this->assign('store', $store);
        $this->assign('order', $order);
        $this->assign('goods', $order_goods);
        $this->assign('return_goods', $return_goods);
        $address = M('user_address')->where(array('is_default' => 1, 'user_id' => $this->user_id))->find();
        $map['id'] = array('in', array($address['province'], $address['city'], $address['district'], $address['twon']));
        $region = M('region')->where($map)->getField('id,name');
        $order['address'] = $region[$address['province']] . $region[$address['city']] . $region[$address['district']] . $region[$address['twon']] . $address['address'];
        return $this->fetch();
    }

    /**
     * 退换货列表
     */
    public function return_goods_list()
    {
        $keywords = I('keywords');
        $addtime = I('addtime');
        $status = I('status');

        $logic = new OrderLogic;
        $data = $logic->getReturnGoodsList($keywords, $addtime, $status, $this->user_id);

        $this->assign('goodsList', $data['goodsList']);
        $this->assign('return_list', $data['return_list']);
        $this->assign('rtype', array('仅退款', '退货退款', '换货', '维修'));
        $this->assign('state', C('REFUND_STATUS'));
        $this->assign('page', $data['page']);// 赋值分页输出
        $this->assign('keywords', $keywords);

        if (I('get.is_ajax', 0)) {
            return $this->fetch('ajax_return_goods_list');
        }
        return $this->fetch();
    }

    /**
     *  退货详情
     */
    public function return_goods_info()
    {
        $id = I('id/d', 0);
        $user_id = $this->user_id;
        $return_goods = M('return_goods')->where(['id' => $id, 'user_id' => $user_id])->find();
        if (empty($return_goods)) $this->error('参数错误');
        if (IS_POST) {
            $data = I('post.');
            $data['delivery'] = serialize($data['delivery']);
            $data['status'] = 2;
            M('return_goods')->where(['id' => $data['id'], 'user_id' => $user_id])->save($data);
            $this->success('发货提交成功', U('Home/Order/return_goods_info', array('id' => $data['id'])));
        }
        if ($return_goods['imgs']) $return_goods['imgs'] = explode(',', $return_goods['imgs']);
        if ($return_goods['seller_delivery']) {
            $return_goods['seller_delivery'] = unserialize($return_goods['seller_delivery']);
        }
        if ($return_goods['delivery']) {
            $return_goods['delivery'] = unserialize($return_goods['delivery']);
        }
        $goods = M('goods')->where("goods_id = {$return_goods['goods_id']} ")->find();
        $this->assign('goods', $goods);
        $this->assign('return_goods', $return_goods);
        $store = M('store')->where(array('store_id' => $return_goods['store_id']))->find();
        if ($store['district']) {
            $region = M('region')->where("id in({$store['province_id']},{$store['city_id']},{$store['district']})")->getField('id,name');
            $store['store_address'] = $region[$store['province_id']] . $region[$store['city_id']] . $region[$store['district']] . $store['store_address'];
        }
        $this->assign('store', $store);
        return $this->fetch();
    }

    public function return_goods_progress()
    {
        $id = I('id/d', 0);
        if (IS_POST) {
            $data = I('post.');
            $return_goods = M('return_goods')->where(array('id' => $data['id'], 'user_id' => $this->user_id))->find();
            if (empty($return_goods)) $this->error('参数错误');
            $data['delivery'] = serialize($data['delivery']);
            $data['status'] = 2;
            M('return_goods')->where(array('id' => $data['id']))->save($data);
        }
        $return_goods = M('return_goods')->where("id = $id")->find();
        if (empty($return_goods)) $this->error('参数错误');
        if ($return_goods['imgs']) $return_goods['imgs'] = explode(',', $return_goods['imgs']);
        if ($return_goods['seller_delivery']) $return_goods['seller_delivery'] = unserialize($return_goods['seller_delivery']);
        $goods = M('goods')->where("goods_id = {$return_goods['goods_id']} ")->find();
        $this->assign('goods', $goods);
        $this->assign('return_goods', $return_goods);
        $this->assign('state', C('REFUND_STATUS'));
        $store = M('store')->where(array('store_id' => $return_goods['store_id']))->find();
        $this->assign('store', $store);
        return $this->fetch();
    }

    public function return_goods_refund()
    {
        $order_sn = I('order_sn');
        $where = array('user_id' => $this->user_id);
        if ($order_sn) {
            $where['order_sn'] = $order_sn;
        }
        $where['status'] = 5;
        $count = M('return_goods')->where($where)->count();
        $page = new Page($count, 10);
        $list = M('return_goods')->where($where)->order("id desc")->limit($page->firstRow, $page->listRows)->select();
        $goods_id_arr = get_arr_column($list, 'goods_id');
        if (!empty($goods_id_arr))
            $goodsList = M('goods')->where("goods_id in (" . implode(',', $goods_id_arr) . ")")->getField('goods_id,goods_name');
        $this->assign('goodsList', $goodsList);
        $state = C('REFUND_STATUS');
        $this->assign('list', $list);
        $this->assign('state', $state);
        $this->assign('page', $page->show());// 赋值分页输出
        return $this->fetch();
    }

    public function return_goods_cancel()
    {
        $id = I('id', 0);
        if (empty($id)) $this->error('参数错误');
        $return_goods = M('return_goods')->where(array('id' => $id, 'user_id' => $this->user_id))->find();
        if (empty($return_goods)) $this->error('参数错误');
        M('return_goods')->where(array('id' => $id))->save(array('status' => -2, 'canceltime' => time()));
        $this->success('取消成功', U('Order/return_goods_list'));
        exit;
    }

    public function dispute()
    {
        $Order = new \app\common\model\Order();
        $condition['user_id'] = $this->user_id;
        $condition['pay_status'] = 1;
        //查找申请过的订单ID
        $complain_order_ids = DB::name('complain')->where(['user_id' => $condition['user_id']])->getField('order_id', true);
        //申请过的订单不显示
        $count = DB::name('order')
            ->whereNotIn('order_id', $complain_order_ids, 'and')
            ->where($condition)->count();
        $Page = new Page($count, 5);
        $show = $Page->show();
        $order_str = "order_id DESC";
        //获取订单
        $order_list_obj = $Order->order($order_str)
            ->whereNotIn('order_id', $complain_order_ids, 'and')
            ->where($condition)->limit($Page->firstRow . ',' . $Page->listRows)
            ->select();
        if ($order_list_obj) {
            //转为数组，并获取订单状态，订单状态显示按钮，订单商品
            $order_list = collection($order_list_obj)->append(['order_status_detail', 'order_button', 'order_goods', 'store'])->toArray();
        }
        $this->assign('order_list', $order_list);
        $this->assign('page', $show);
        return $this->fetch();
    }

    public function dispute_list()
    {
        $complain_time_out = input('complain_time_out');
        $complain_state_type = input('complain_state_type');
        $where = array('user_id' => $this->user_id);
        $three_months_ago = strtotime(date("Y-m-d", strtotime("-3 months", strtotime(date("Y-m-d", time())))));
        if (empty($complain_time_out)) {
            //三个月内纠纷单
            $where['complain_time'] = ['>', $three_months_ago];
        }
        if ($complain_time_out) {
            //三个月前纠纷单
            $where['complain_time'] = ['<', $three_months_ago];
        }
        if ($complain_state_type == 1) {
            //处理中
            $where['complain_state'] = ['<', 4];
        }
        if ($complain_state_type == 2) {
            //已完成
            $where['complain_state'] = 4;
        }
        $count = M('complain')->where($where)->count();
        $page = new Page($count, 10);
        $list = M('complain')->where($where)->order("complain_id desc")->limit($page->firstRow, $page->listRows)->select();
        $complain_state = array(1 => '待处理', 2 => '对话中', 3 => '待仲裁', 4 => '已完成');
        if (!empty($list)) {
            foreach ($list as $k => $val) {
                $list[$k]['complain_state'] = $complain_state[$val['complain_state']];
                if ($val['complain_pic']) {
                    $list[$k]['complain_pic'] = unserialize($val['complain_pic'])[0];
                }
            }
        }
        $goods_id_arr = get_arr_column($list, 'order_goods_id');
        if (!empty($goods_id_arr)) {
            $goodsList = M('goods')->where("goods_id in (" . implode(',', $goods_id_arr) . ")")->getField('goods_id,goods_name');
            $this->assign('goodsList', $goodsList);
        }
        if (!empty($goods_id_arr)) {
            $goodsList = M('goods')->where("goods_id", "in", implode(',', $goods_id_arr))->getField('goods_id,goods_name');
            $this->assign('goodsList', $goodsList);
        }
        $this->assign('list', $list);
        $this->assign('page', $page->show());
        return $this->fetch();
    }

    public function dispute_apply()
    {
        if (IS_POST) {
            $data = I('post.');
            $order = Db::name('order')->where(array('order_id' => $data['order_id']))->find();
            if ($order['store_id'] != $data['store_id'] || $order['user_id'] != $this->user_id) {
                $this->error('严禁非法提交数据');
            }
            $complain = M('complain')->where(array('order_id' => $data['order_id'], 'user_id' => $this->user_id, 'order_goods_id' => $data['order_goods_id']))->find();
            if ($complain) $this->error('此服务单您已申请过交易投诉');
            if (!empty($data['complain_pic'])) {
                $data['complain_pic'] = serialize($data['complain_pic']);
            }
            $complain_subject = M('complain_subject')->where(array('subject_id' => $data['complain_subject_id']))->find();
            $data['complain_subject_name'] = $complain_subject['subject_name'];
            $data['user_id'] = $this->user_id;
            $data['user_name'] = $this->user['nickname'];
            $data['complain_time'] = time();
            if (M('complain')->add($data)) {
                $this->success('投诉成功', U('Order/dispute_list'));
            } else {
                $this->error('投诉失败，请联系平台客服', U('Order/dispute'));
            }
        }
        $order_id = I('order_id');
        $order = M('order')->where(array('order_id' => $order_id, 'user_id' => $this->user_id))->find();
        $order_goods = M('order_goods')->where(array('order_id' => $order_id))->select();
        $this->assign('order', $order);
        $this->assign('order_goods', $order_goods);
        $complain_subject = M('complain_subject')->where(array('subject_state' => 1))->select();
        $this->assign('complain_subject', $complain_subject);
        $store = M('store')->where(array('store_id' => $order['store_id']))->find();
        $this->assign('store', $store);
        return $this->fetch();
    }

    public function checkType()
    {
        $order_id = I('order_id/d');
        $complain_subject_id = I('complain_subject_id/d');
        if ($order_id && $complain_subject_id) {
            $orderLogic = new OrderLogic();
            $res = $orderLogic->check_dispute_order($order_id, $complain_subject_id, $this->user_id);
            exit(json_encode($res));
        } else {
            exit(json_encode("参数错误，非法操作"));
        }
    }

    public function dispute_info()
    {
        $complain_id = I('complain_id/d');
        $complain = M('complain')->where(array('complain_id' => $complain_id, 'user_id' => $this->user_id))->find();
        if ($complain) {
            if (!empty($complain['complain_pic'])) {
                $complain['complain_pic'] = unserialize($complain['complain_pic']);
            }
            if (!empty($complain['appeal_pic'])) {
                $complain['appeal_pic'] = unserialize($complain['appeal_pic']);
            }
        } else {
            $this->error("您的投诉单不存在");
        }
        $order = M('order')->where(array('order_id' => $complain['order_id']))->find();
        $order_goods = M('order_goods')->where(array('order_id' => $complain['order_id'], 'goods_id' => $complain['order_goods_id']))->find();
        $this->assign('complain', $complain);
        $this->assign('order', $order);
        $this->assign('order_goods', $order_goods);
        $complain_state = array(1 => '待卖家处理', 2 => '待客户确认', 3 => '待管理员仲裁', 4 => '已关闭完成');
        $this->assign('state', $complain_state);
        return $this->fetch();
    }

    public function get_complain_talk()
    {
        $complain_id = I('complain_id/d');
        $complain_info = M('complain')->where(array('complain_id' => $complain_id, 'user_id' => $this->user_id))->find();
        $talkhtml = '';
        if (!$complain_info) {
            $talkhtml = '';
        } else {
            $complain_info['member_status'] = 'accused';
            $complain_talk_list = M('complain_talk')->where(array('complain_id' => $complain_id))->order('talk_id asc')->select();
            if (!empty($complain_talk_list)) {
                foreach ($complain_talk_list as $i => $talk) {
                    $talk_time = date("Y-m-d H:i:s", $talk['talk_time']);
                    $myself_right = '';
                    $talker_name = $talk['talk_member_name'];
                    $path = C('view_replace_str.__STATIC__');
                    switch ($talk['talk_member_type']) {
                        case 'accuser':
                            $talker = '我';
                            $talker_pic = empty($this->user['head_pic']) ? $path . '/images/peri.jpg' : $this->user['head_pic'];
                            $myself_right = 'myself_right';
                            break;
                        case 'accused':
                            $talker = '卖家';
                            $talker_pic = $path . '/images/oppositehead.png';
                            break;
                        case 'admin':
                            $talker = '管理员';
                            $talker_pic = $path . '/images/pers.png';
                            break;
                    }
                    if (intval($talk['talk_state']) === 2) {
                        $talk['talk_content'] = '<该对话被管理员屏蔽>';
                    }
                    $talkhtml .= '<div class="opposite_left ' . $myself_right . ' p">
                    <div class="sales_head p"><div class="sales_head_logo">
                        <img class="" src="' . $talker_pic . '">
                    </div>
                    <div class="explay_sales_head">
                    <i></i>
                    <span class="sales_manage">' . $talker . '</span>
                    <span class="store_name">' . $talker_name . '&nbsp;&nbsp;' . $talk_time . '</span>
                    </div></div>
                    <div class="myself_head">' . $talk['talk_content'] . '</div></div>';
                }
            }
        }

        echo json_encode($talkhtml);
    }

    public function publish_complain_talk()
    {
        $complain_id = I('complain_id/d');
        $complain_talk = trim(I('complain_talk'));
        $complain_info = M('complain')->where(array('complain_id' => $complain_id, 'user_id' => $this->user_id))->find();
        $complain_state = intval($complain_info['complain_state']);
        if (is_array($complain_info) && $complain_state == 2) {
            $talk_len = strlen($complain_talk);
            if ($talk_len > 0 && $talk_len < 255) {
                $param = array();
                $param['complain_id'] = $complain_id;
                $param['talk_member_id'] = $this->user_id;
                $param['talk_member_name'] = $this->user['nickname'];
                $param['talk_member_type'] = 'accuser';
                $param['talk_content'] = $complain_talk;
                $param['talk_state'] = 1;
                $param['talk_admin'] = 0;
                $param['talk_time'] = time();
                if (M('complain_talk')->add($param)) {
                    echo json_encode('success');
                } else {
                    echo json_encode('error2');
                }
            } else {
                echo json_encode('error1');
            }
        } else {
            echo json_encode('error');
        }
    }

    public function complain_handle()
    {
        $complain_id = I('complain_id/d');
        $complain_state = I('state/d');
        $complain_info = M('complain')->where(array('complain_id' => $complain_id, 'user_id' => $this->user_id))->find();
        if ($complain_info) {
            $updata['complain_state'] = $complain_state;
            if ($complain_state == 3) {
                M('return_goods')->where(array('user_id' => $this->user_id, 'order_id' => $complain_info['order_id']))->save(array('status' => 6));
                $updata['user_handle_time'] = time();
            } else {
                $updata['final_handle_time'] = time();
                $updata['final_handle_msg'] = '用户提交问题已解决';
            }
            M('complain')->where(array('complain_id' => $complain_id, 'user_id' => $this->user_id))->save($updata);
            $this->success('操作成功', U('Order/dispute_list'));
            exit;
        } else {
            $this->error('操作失败，请联系平台客服');
        }
    }

    public function expose()
    {
        if (IS_POST) {
            $data = I('post.');
            if (!empty($data['expose_pic'])) {
                $data['expose_pic'] = serialize($data['expose_pic']);
            }
            $data['expose_user_id'] = $this->user_id;
            $data['expose_user_name'] = empty($this->user['nickname']) ? $this->user['mobile'] : $this->user['nickname'];
            $data['expose_time'] = time();
            if (M('expose')->where(array('expose_user_id' => $this->user_id, 'expose_goods_id' => $data['expose_goods_id']))->count() > 0) {
                $this->error('该商品您已举报过，请不要重复提交');
            } else {
                M('expose')->add($data);
                $this->success('举报成功', U('Order/expose_list'));
                exit;
            }
        }
        $goods_id = I('goods_id/d');
        $goods = M('goods')->where(array('goods_id' => $goods_id))->find();
        if ($goods) {
            $store = M('store')->where(array('store_id' => $goods['store_id']))->find();
            $expose_type = M('expose_type')->cache(true)->select();
            $goods['category'] = M('goods_category')->where(array('id' => $goods['cat_id3']))->getField('name');
            $this->assign('goods', $goods);
            $this->assign('store', $store);
            $this->assign('expose_type', $expose_type);
            return $this->fetch();
        } else {
            $this->error('参数错误');
        }
    }

    public function expose_list()
    {
        $where = array('expose_user_id' => $this->user_id);
        $count = M('expose')->where($where)->count();
        $page = new Page($count, 10);
        $expose_list = M('expose')->where($where)->order("expose_id desc")->limit($page->firstRow, $page->listRows)->select();
        $this->assign('expose_list', $expose_list);
        $this->assign('page', $page->show());
        return $this->fetch();
    }

    public function expose_info()
    {
        $expose_id = I('expose_id/d');
        $expose = M('expose')->where(array('expose_id' => $expose_id, 'expose_user_id' => $this->user_id))->find();
        if (!$expose) {
            $this->error('该举报不存在');
        }
        if (!empty($expose['expose_pic'])) {
            $expose['expose_pic'] = unserialize($expose['expose_pic']);
        }
        $store = M('store')->where(array('store_id' => $expose['expose_store_id']))->find();
        $this->assign('store', $store);
        $this->assign('expose', $expose);
        return $this->fetch();
    }

    public function get_expose_subject()
    {
        $expose_type_id = I('expose_type_id/d');
        $expose_subject = M('expose_subject')->where(array('expose_subject_type_id' => $expose_type_id))->select();
        $subject = '';
        if (empty($expose_subject)) {
            $subject = '<txt style="position: absolute; z-index: 2; line-height: 1; margin-left: 11px; margin-top: 11px; font-size: 13.3333px; font-family: monospace; color: rgb(205, 205, 205); display: inline;"></txt>
                    <textarea name="expose_content" id="note" cols="30" rows="10" style="border: 1px solid #E6E6E6;width: 935px; height: 144px;margin-bottom: 8px;padding: 5px;" placeholder="请填写您认为该商品存在价格违规现象的理由"></textarea>
                    <div class="msg-care">(注意：被举报人能且只能看到此框中的内容，请您注意不要在此框填写会员名、订单号、运单号等任何可能泄露身份的信息)</div>';
        } else {
            $subject .= '<ul class="re-jbtype-box re-jbtype-s01">';
            foreach ($expose_subject as $val) {
                $subject .= '<li class="li-item" onclick="subject_onclick(this)" data-type="' . $val['expose_subject_id'] . '">' . $val['expose_subject_content'] . '<s class="icon-on"></s></li>';
            }
            $subject .= '</ul>';
        }
        exit($subject);
    }

    public function refund_order()
    {
        $order_id = I('get.order_id/d');

        $order = M('order')
            ->field('order_id,pay_code,pay_name,user_money,integral_money,coupon_price,order_amount')
            ->where(['order_id' => $order_id, 'user_id' => $this->user_id])
            ->find();

        $this->assign('user', $this->user);
        $this->assign('order', $order);
        return $this->fetch();
    }

    public function record_refund_order()
    {
        $order_id = input('post.order_id', 0);
        $user_note = input('post.user_note', '');
        $consignee = input('post.consignee', '');
        $mobile = input('post.mobile', '');

        $logic = new \app\common\logic\OrderLogic;
        $return = $logic->recordRefundOrder($this->user_id, $order_id, $user_note, $consignee, $mobile);

        $this->ajaxReturn($return);
    }
}