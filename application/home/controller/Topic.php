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
 * Author: 新淘链
 */
namespace app\home\controller;

class Topic extends Base
{
    /*
     * 专题列表
     */
    public function topicList()
    {
        $topicList = M('topic')->where("topic_state=2")->select();
        $this->assign('topicList', $topicList);
        return $this->fetch();
    }

    /*
     * 专题详情
     */
    public function detail()
    {
        $topic_id = I('topic_id/d', 1);
        $topic = D('topic')->where("topic_id", $topic_id)->find();
        $this->assign('topic', $topic);
        return $this->fetch();
    }

    public function info()
    {
        $topic_id = I('topic_id/d', 1);
        $topic = D('topic')->where("topic_id", $topic_id)->find();
        echo htmlspecialchars_decode($topic['topic_content']);
        exit;
    }
}