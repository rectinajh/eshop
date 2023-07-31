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

namespace app\common\validate;

use think\Validate;

/**
 * Description of Article
 *
 * @author Administrator
 */
class Order extends Validate
{
    //验证规则
    protected $rule = [
        'order_id' => 'require',
    ];
    
    //错误消息
    protected $message = [
        'order_id.require'    => '订单id不能为空',
    ];
    
    //验证场景
    protected $scene = [
        'del'  => ['order_id' =>  'require|checkDelOrder'],
    ];
    
    protected function checkDelOrder($value)
    {
        $data = M('order')->field('deleted, order_status')->where('order_id', $value)->find();
        //halt($data);
        if (!$data) {
            return '订单不存在';
        } elseif ($data['deleted']) {
            return '订单已经删除过了';
        } elseif (in_array($data['order_status'], [0, 1])) { //待确认，已确认
            return '订单未完成，不能删除';
        }
        
        return true;
    }
}
