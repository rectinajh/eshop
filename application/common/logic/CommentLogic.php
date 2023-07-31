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
 * Date: 2016-08-09
 */
namespace app\common\logic;

use think\AjaxPage;
use think\Model;
use think\Db;

/**
 * 回复
 * Class CatsLogic
 * @package common\Logic
 */
class CommentLogic extends Model
{
    public function getCommentInfo($comment_id)
    {
        $comment_info = M('comment')->where(array('comment_id' => $comment_id))->find();
        if ($comment_info) {
            $reply = $this->getReplyPage($comment_id);
            return array('comment_info' => $comment_info, 'reply' => $reply);
        } else {
            return '';
        }
    }
    /**
     * 获取评论数
     * @param type $user_id
     * @return type
     */
    public function getCommentNum($user_id)
    {
        //已评价
        $data['had'] = $this->getHadCommentNum($user_id);
        //待评价
        $data['no'] = $this->getWaitCommentNum($user_id);
        //服务评价
        $data['serve'] = $this->getWaitServiceCommentNum($user_id);
        return $data;
    }
    /**
     * 添加商品评论
     * @param $order_id  订单id
     * @param $goods_id  商品id
     * @param $user_email用户邮箱地址
     * @param $username  用户名
     * @return bool
     */
    public function addGoodsComment($add)
    {
        if (!$add['order_id'] || !$add['goods_id']) {
            return array('status' => -1, 'msg' => '非法操作');
        }
        //检查订单是否已完成
        $order = M('order')->where(['order_id' => $add['order_id'], 'user_id' => $add['user_id']])->find();
        if ($order['order_status'] != 2) {
            return ['status' => -1, 'msg' => '该笔订单还未完成'];
        }
        //检查是否已评论过
        $goods = M('comment')->where(['order_id' => $add['order_id'], 'goods_id' => $add['goods_id']])->find();
        if ($goods) {
            return ['status' => -1, 'msg' => '您已经评论过该商品'];
        }
        $row = M('comment')->add($add);
        if (!$row) {
            return ['status' => -1, 'msg' => '评论失败'];
        }
        
        //更新订单商品表状态
        M('order_goods')->where(['goods_id' => $add['goods_id'], 'order_id' => $add['order_id']])->save(['is_comment' => 1]);
        M('goods')->where(['goods_id' => $add['goods_id']])->setInc('comment_count', 1); // 评论数加一
        //
        // 查看这个订单是否全部已经评论,如果全部评论了 修改整个订单评论状态
        $comment_count = M('order_goods')->where(['order_id' => $add['order_id'], 'is_comment' => 0])->count();
        if ($comment_count == 0) {
            // 如果所有的商品都已经评价了 订单状态改成已评价
            M('order')->where("order_id ='{$add['order_id']}'")->save(['order_status' => 4]);
        }
        return ['status' => 1, 'msg' => '评论成功'];
    }
    /**
     * 添加服务评论
     * @param type $user_id
     * @param type $order_id
     * @param type $service_rank
     * @param type $deliver_rank
     * @param type $goods_rank
     * @return type
     */
    public function addServiceComment($user_id, $order_id, $store_id, $service_rank, $deliver_rank, $goods_rank)
    {
        if (!$order_id) {
            return ['status' => -1, 'msg' => '订单id不为空'];
        }
        if (!$service_rank || !$deliver_rank || !$goods_rank) {
            return ['status' => -1, 'msg' => '评分不能为空'];
        }
        $score['describe_score'] = $goods_rank;
        $score['seller_score'] = $service_rank;
        $score['logistics_score'] = $deliver_rank;
        $score['order_id'] = $order_id;
        $score['user_id'] = $user_id;
        $score['store_id'] = $store_id;
        $score['commemt_time'] = time();
        $usersLogic = new UsersLogic;
        $usersLogic->save_store_score($user_id, $order_id, $store_id, $score);
        return ['status' => 1, 'msg' => '评论成功'];
    }
    /**
     * 添加商品和服务评价
     * @param type $order_id
     * @param type $goods_id
     * @param type $content
     * @param type $is_anonymous
     * @param type $goods_score
     * @param type $service_rank
     * @param type $deliver_rank
     * @param type $goods_rank
     */
    public function addGoodsAndServiceComment(
        $user_id,
        $order_id,
        $goods_id,
        $content = '',
        $is_anonymous = 1,
        $spec_key_name = '',
        $impression = '',
        $goods_score = 0,
        $service_rank = 0,
        $deliver_rank = 0,
        $goods_rank = 0
    ) { 
        // 晒图片
        $img = $this->uploadCommentImgFile('comment_img_file');
        if ($img['status'] !== 1) {
            return $img;
        }
        $store_id = M('order')->where(array('order_id' => $order_id))->getField('store_id');
        $add['store_id'] = $store_id;
        $add['goods_id'] = $goods_id;
        $add['order_id'] = $order_id;
        $add['user_id'] = $user_id;
        $add['goods_rank'] = $goods_score;
        $add['content'] = $content;//$add['content'] = htmlspecialchars(I('post.content'));
        $add['img'] = $img['result'];
        $add['add_time'] = time();
        $add['ip_address'] = getIP();
        $add['is_anonymous'] = $is_anonymous ? 1 : 0;
        $add['spec_key_name'] = $spec_key_name;
        $add['impression'] = $impression;
        $add['zan_num'] = 0;
        $add['reply_num'] = 0;
        $add['parent_id'] = 0;
        //添加评论
        $return = $this->addGoodsComment($add);
        if ($return['status'] != 1) {
            return $return;
        }
        
        //添加服务评论
        if ($service_rank && $deliver_rank && $goods_rank) {
            $return = $this->addServiceComment($user_id, $order_id, $store_id, $service_rank, $deliver_rank, $goods_rank);
        }
        return $return;
    }
    /**
     * 获取服务评论（目前是未评论列表）
     * @param type $user_id
     */
    public function getServiceComment($user_id)
    {
        $count = M('order_goods')->alias('og')
            ->join('__ORDER__ o', 'o.order_id = og.order_id AND o.deleted = 0', 'inner')
            ->where("og.is_send = 1 and o.is_comment = 0 and o.user_id = $user_id")
            ->group('og.order_id,og.store_id')
            ->count();
        $page = new \think\Page($count, 50);
        $comment_list = M('order_goods')->alias('og')
            ->field('o.order_amount,o.add_time,o.order_sn,og.order_id,og.goods_id,og.goods_name,
                       o.store_id,o.goods_price,og.goods_num,og.is_comment,og.rec_id,s.store_name')
            ->join('__ORDER__ o', 'o.order_id = og.order_id AND o.deleted = 0')
            ->join('__STORE__ s', 's.store_id = o.store_id')
            ->where("og.is_send = 1 and o.is_comment = 0 and o.user_id = $user_id")
            ->order('o.order_id', 'desc')
            ->limit($page->firstRow, $page->listRows)
            ->select();
        $list = [];
        foreach ($comment_list as $v) {
            $index = $v['order_id'] . ',' . $v['store_name'];
            $list[$index][] = $v;
        }
        $stores = [];
        foreach ($list as $k => $s) {
            $index = explode(',', $k, 2);
            $stores[] = ['store_name' => $index[1], 'order_list' => $s];
        }
        $return['result'] = $stores;
        $return['page'] = $page;
        return $return;
    }
    /**
     * 获取评论列表
     * @param $user_id 用户id
     * @param $status  状态 0 未评论 1 已评论 ,其他 全部
     * @return mixed
     */
    public function getComment($user_id, $status = 2)
    {
        if ($status == 1) {
            //已评论
            $query = M('comment')->alias('c')
                ->join('__ORDER__ o', 'o.order_id = c.order_id AND o.deleted = 0')
                ->join('__ORDER_GOODS__ og', 'c.goods_id = og.goods_id AND c.order_id = og.order_id AND og.is_comment=1')
                ->where('c.user_id', $user_id);
            $query2 = clone ($query);
            $commented_count = $query->count();
            $page = new \think\Page($commented_count, 10);
            $comment_list = $query2->field('og.*,og.is_comment as goods_comment,c.comment_id,o.*,o.is_comment as is_service_comment')
                ->order('c.add_time', 'desc')
                ->limit($page->firstRow, $page->listRows)
                ->select();
        } else {
            $comment_where = ['og.is_send' => 1];
            if ($status == 0) {
                $comment_where['og.is_comment'] = 0;
            }
            $query = M('order_goods')->alias('og')
                ->join('__ORDER__ o', "o.order_id = og.order_id AND o.user_id=$user_id AND o.deleted = 0 AND o.order_status IN (2,4)")
                ->join('__COMMENT__ c', 'c.order_id = og.order_id AND c.goods_id=og.goods_id', 'LEFT')
                ->where($comment_where);
            $query2 = clone ($query);
            $comment_count = $query->count();
            $page = new \think\Page($comment_count, 10);
            $comment_list = $query2->field('og.*,og.is_comment as goods_comment,c.comment_id,o.*,o.is_comment as is_service_comment')
                ->order('o.order_id', 'desc')
                ->limit($page->firstRow, $page->listRows)
                ->select();
        }
        $show = $page->show();
        $return['result'] = $comment_list;
        $return['show'] = $show; //分页
        $return['page'] = $page; //分页
        return $return;
    }
    /**
     * 获取下级同盟列表
     * @param $user_id 用户id
     * @param $status  状态 0 未评论 1 已评论 ,其他 全部
     * @return mixed
     */
    public function getComments($user_id, $status = 1)
    {
        //已评论
        $mobile = M('users')->where('user_id', $user_id)->getField('mobile');
        //我的一级盟友
        if ($status == 1) {
            $commented_count = M('users')->where(array('tuimobile' => $mobile))->count();
            $page = new \think\Page($commented_count, 10);
            $comment_list = M('users')->where(array('tuimobile' => $mobile))->field('nickname,mobile,reg_time,team_performance')->order('reg_time', 'desc')
                ->limit($page->firstRow, $page->listRows)
                ->select();
            $show = $page->show();
        } elseif ($status == 2) {
            $mobile = M('users')->field('mobile')->where(array('tuimobile' => $mobile))->select();
            foreach ($mobile as $v) {
                $a[] = $v['mobile'];
            }
            if ($a) {
                $a = implode(',', $a);
                $commented_count = M('users')->where("tuimobile in ({$a})")->count();
                $page = new \think\Page($commented_count, 10);
                $comment_list = M('users')->where("tuimobile in ({$a})")->field('nickname,mobile,reg_time,team_performance')->order('reg_time', 'desc')
                    ->limit($page->firstRow, $page->listRows)
                    ->select();
                $show = $page->show();
            }
        } elseif ($status == 3) {
            $mobile = M('users')->field('mobile')->where(array('tuimobile' => $mobile))->select();
            foreach ($mobile as $v) {
                $a[] = $v['mobile'];
            }
            if ($a) {
                $a = implode(',', $a);
                $commented = M('users')->field('mobile')->where("tuimobile in ({$a})")->select();
                foreach ($commented as $v) {
                    $b[] = $v['mobile'];
                }
                if ($b) {
                    $b = implode(',', $b);
                    $commented_count = M('users')->where("tuimobile in ({$b})")->count();
                    $commented_count = M('users')->where("tuimobile in ({$b})")->count();
                    $page = new \think\Page($commented_count, 10);
                    $comment_list = M('users')->where("tuimobile in ({$b})")->field('nickname,mobile,reg_time,team_performance')->order('reg_time', 'desc')
                        ->limit($page->firstRow, $page->listRows)
                        ->select();
                    $show = $page->show();
                }
            }
        }
        $return['result'] = $comment_list;
        $return['show'] = $show; //分页
        $return['page'] = $page; //分页
        return $return;
    }
    /**
     * 把回复树状数组转换成二维数组
     * @param $comment_id 回复id
     * @param int $item_num 条数
     * @return array
     */
    public function getReplyListToArray($comment_id, $item_num = 0)
    {
        $reply_tree = $this->getReplyList($comment_id);
        if (empty($reply_tree)) {
            return $reply_tree;
        }
        $reply_flat_list = $this->treeToArray($reply_tree);
        if ($item_num == 0 || count($reply_flat_list) <= $item_num) {
            $res = $reply_flat_list;
        } else {
            $res = array_slice($reply_flat_list, 0, $item_num);
        }
        return $res;
    }
    /**
     * 回复分页
     * @param $comment_id
     * @param int $page
     * @param int $item_num
     * @return mixed
     */
    public function getReplyPage($comment_id, $page = 0, $item_num = 20)
    {
        $reply_tree = $this->getReplyList($comment_id);
        $reply_flat_list = $this->treeToArray($reply_tree);
        $count = count($reply_flat_list);
        $list['list'] = array_slice($reply_flat_list, $page * $item_num, $item_num);
        $list['count'] = $count;
        return $list;
    }
    /**
     * 将树状数组转换二维数组
     * @param $tree
     * @return array
     */
    public function treeToArray($tree)
    {
        $list = array();
        foreach ($tree as $key) {
            $node = $key['children'];
            unset($key['children']);
            $list[] = $key;
            if ($node) $list = array_merge($list, $this->treeToArray($node));
        }
        return $list;
    }
    /**
     * 根据评论id获取评论下的所有回复
     * @param $comment_id
     * @param int $parent_id
     * @param array $result
     * @return array
     */
    private function getReplyList($comment_id, $parent_id = 0, &$result = array())
    {
        $reply_where = array(
            'comment_id' => $comment_id,
            'parent_id' => $parent_id,
            'deleted' => 0,
        );
        $arr = M('reply')->where($reply_where)->order('reply_time desc')->select();
        if (empty($arr)) {
            return array();
        }
        foreach ($arr as $cm) {
            $thisArr = &$result[];
            $cm['children'] = $this->getReplylist($comment_id, $cm['reply_id'], $thisArr);
            $thisArr = $cm;
        }
        return $result;
    }
    /**
     * 获取已评论数
     * @param type $user_id
     * @return type
     */
    public function getHadCommentNum($user_id)
    {
        $num = M('comment')->alias('c')
            ->join('__ORDER__ o', 'o.order_id = c.order_id AND o.deleted = 0')
            ->join('__ORDER_GOODS__ g', 'c.goods_id = g.goods_id AND c.order_id = g.order_id AND g.is_comment=1')
            ->where('c.user_id', $user_id)
            ->count();
        return $num;
    }
    /**
     * 获取未(待)评论数
     */
    public function getWaitCommentNum($user_id)
    {
        (!$user_id) && $user_id = 0;
        $num = M('order_goods')->alias('og')
            ->join('__ORDER__ o', "o.order_id = og.order_id AND o.user_id=$user_id AND o.deleted = 0 AND o.order_status IN (2,4)", 'inner')
            ->where(['og.is_send' => 1, 'og.is_comment' => 0])
            ->count();
        return $num;
    }
    /**
     * 获取未(待)服务评论数
     */
    public function getWaitServiceCommentNum($user_id)
    {
        $num = M('order_goods')->alias('og')
            ->join('__ORDER__ o', 'o.order_id = og.order_id AND o.deleted = 0', 'inner')
            ->where("og.is_send = 1 and o.is_comment = 0 and o.user_id = $user_id")
            ->group('og.order_id,og.store_id')
            ->count();
        return $num;
    }
    /**
     * 上传评论图片
     * @return type
     */
    public function uploadCommentImgFile($name)
    {
        $comments = '';
        if ($_FILES[$name]['tmp_name'][0]) {
            $files = request()->file($name);
            $validate = ['size' => 1024 * 1024 * 3, 'ext' => 'jpg,png,gif,jpeg'];
            $dir = 'public/upload/comment/';
            if (!($_exists = file_exists($dir))) {
                mkdir($dir);
            }
            $parentDir = date('Ymd');
            foreach ($files as $file) {
                $info = $file->validate($validate)->move($dir, true);
                if ($info) {
                    $filename = $info->getFilename();
                    $new_name = '/' . $dir . $parentDir . '/' . $filename;
                    $comment_img[] = $new_name;
                } else {
                    return ['status' => -1, 'msg' => $info->getError()];
                }
            }
            $comments = serialize($comment_img); // 上传的图片文件
        }
        return ['status' => 1, 'msg' => '上传成功', 'result' => $comments];
    }
    public function getGoodsComment($goods_id, $commentType)
    {
        if ($commentType == 5) {
            $where = array(
                'c.is_show' => 1,
                'c.goods_id' => $goods_id,
                'c.parent_id' => 0,
                'c.img' => ["exp", "!='' and c.img NOT LIKE 'N;%'"],
                'c.deleted' => 0
            );
        } else {
            $typeArr = array('1' => '0,1,2,3,4,5', '2' => '4,5', '3' => '3', '4' => '0,1,2');
            $where = array(
                'c.is_show' => 1,
                'c.goods_id' => $goods_id,
                'c.parent_id' => 0,
                'ceil(c.goods_rank)' => ["IN", $typeArr[$commentType]],
                'c.deleted' => 0
            );
        }
        $count = M('comment')->alias('c')->where($where)->count();
        $page = new AjaxPage($count, 5);
        $show = $page->show();
        $list = M('comment')->alias('c')
            ->field("u.head_pic,u.nickname,c.add_time,c.spec_key_name,c.content,
                    c.impression,c.comment_id,c.zan_num,c.is_anonymous,c.reply_num,c.goods_rank,
                    c.img,c.parent_id,o.pay_time,o.pay_time as seller_comment")
            ->join('__USERS__ u', 'u.user_id = c.user_id', 'LEFT')
            ->join('__ORDER__ o ', 'o.order_id = c.order_id', 'LEFT')
            ->where($where)
            ->order("c.add_time desc")
            ->limit($page->firstRow . ',' . $page->listRows)->select();
        $reply_logic = new ReplyLogic();
        foreach ($list as $k => $v) {
            $list[$k]['img'] = unserialize($v['img']); // 晒单图片
            $list[$k]['parent_id'] = $reply_logic->getReplyListToArray($v['comment_id'], 5);
            $list[$k]['seller_comment'] = Db::name('comment')->where(['goods_id' => $goods_id, 'parent_id' => $list[$k]['comment_id']])->order("add_time desc")->select();
        }
        return ['list' => $list, 'page' => $show];
    }
}
