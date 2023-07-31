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
class Topic extends Validate
{
    //验证规则
    protected $rule = [
        'topic_title'  => 'require|checkEmpty',
    ];
    
    //错误消息
    protected $message = [
        'topic_title'    => '标题不能为空',
    ];
    
    //验证场景
    protected $scene = [
        'add'  => ['topic_title'],
        'edit' => ['topic_title'],
        'del'  => ['']
    ];
    
    protected function checkEmpty($value)
    {
        if (is_string($value)) {
            $value = trim($value);
        }
        if (empty($value)) {
            return false;
        }
        return true;
    }
}
