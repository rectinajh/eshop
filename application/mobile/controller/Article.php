<?php
namespace app\mobile\controller;
use think\Db;
 
class Article extends MobileBase
{
  
      public function index()
    {
        $article_id = I('article_id/d', 38);
        $article = D('article')->where("article_id", $article_id)->find();
        $this->assign('article', $article);
        return $this->fetch();
    }
    /**
     * 文章内容页
     */
    public function detail()
    {
        $article_id = I('article_id/d', 1);
        $article = D('article')->where("article_id", $article_id)->find();
        if ($article) {
            $parent = D('article_cat')->where("cat_id", $article['cat_id'])->find();
            $this->assign('cat_name', $parent['cat_name']);
            $this->assign('article', $article);
        }
        return $this->fetch();
    }
    /**
     * 文章内列表页
     */
    public function articleList()
    {
        $article = M('article')->where("open_type = 0")->order('article_id desc')->select();
        $this->assign('article', $article);
    	return $this->fetch();
    }

}