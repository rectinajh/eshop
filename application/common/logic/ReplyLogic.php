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

use think\Model;

/**
 * 回复
 * Class CatsLogic
 * @package common\Logic
 */
class ReplyLogic extends Model
{
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
            $thisArr =& $result[];
            $cm['children'] = $this->getReplylist($comment_id, $cm['reply_id'], $thisArr);
            $thisArr = $cm;
        }
		
       	return $result;
    }
}