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

class Service extends Validate
{
    //验证规则
    protected $rule = [
        'expose_type_name'   => 'require|notEmpty|unique:expose_type',
        'expose_type_desc'   => 'require|notEmpty',
    ];
    
    //错误消息
    protected $message = [
        'expose_type_name'  => '举报类型不能为空',
        'expose_type_name.unique' => '举报类型已存在',
        'expose_type_desc'  => '举报类型描述不能为空',
    ];
    
    //验证场景
    protected $scene = [
        'add'  => ['expose_type_name', 'expose_type_desc'],
    ];
    
    protected function notEmpty($value)
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
