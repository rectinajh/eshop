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
 */

namespace app\admin\validate;

use think\Validate;

/**
 * Description of Article
 *
 * @author Administrator
 */
class ArticleCategory extends Validate
{
    //验证规则
    protected $rule = [
        'cat_name' => 'require|checkEmpty',
    ];
    
    //错误消息
    protected $message = [
        'cat_name.require'  => '分类名不能为空',
        'cat_id.require' => '分类id不能为空'
    ];
    
    //验证场景
    protected $scene = [
        'add'  => ['cat_name'],
        'edit' => ['cat_name', 'cat_id' => 'require|checkEdit'],
        'del'  => ['cat_id' => 'require|checkDel']
    ];
    
    protected function checkEmpty($value)
    {
        if (is_string($value)) {
            $value = trim($value);
        }
        if (empty($value)) {
            return '分类名不能为空白';
        }
        return true;
    }
    
    protected function checkEdit($value, $rule, $data)
    {
        $article_system_id = \app\admin\controller\Article::$article_system_id;
        if (array_key_exists($value, $article_system_id) && $data['parent_id'] > 1) {
            return '不可更改系统预定义分类的上级分类';
        }
        
        if ($value == $data['parent_id']) {
            return '所选分类的上级分类不能是当前分类';
        }
        
        $ArticleCat = new \app\admin\logic\ArticleCatLogic;
        $children = array_keys($ArticleCat->article_cat_list($value, 0, false)); // 获得当前分类的所有下级分类
        if (in_array($data['parent_id'], $children)) {
            return '所选分类的上级分类不能是当前分类的子分类';
        }
        //错误时跳转到：U('Admin/Article/category',array('cat_id'=>$data['cat_id']));
        
        return true;
    }
    
    protected function checkDel($value)
    {
        $article_system_id = \app\admin\controller\Article::$article_system_id;
        if (array_key_exists($value, $article_system_id)){
            return '系统预定义的分类不能删除';
        }
        
        $res = D('article_cat')->where('parent_id', $value)->select();
        if ($res) {
            return '还有子分类，不能删除';
        }
        
        $res = D('article')->where('cat_id', $value)->select();
        if ($res) {
            return '非空的分类不允许删除';
        }
        
        return true;
    }
}
