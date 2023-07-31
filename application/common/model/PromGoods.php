<?php
/**
 * 新淘链商城
 * ============================================================================
 * 版权所有 2015-2027 新淘链，并保留所有权利。
 * 网站地址: 
 * ----------------------------------------------------------------------------
 * 这是一个商业软件，您必须购买授权才能使用.
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Author: 新淘链
 * Date: 2015-09-09
 */
namespace app\common\model;
use think\Model;
class PromGoods extends Model {
    public function getPromDetailAttr($value,$data)
    {
        switch ($data['type']){
            case 1:
                $title = '优惠￥'.$data['expression'];
                break;
            case 2:
                $title = '促销价￥'.$data['expression'];
                break;
            case 3:
                $title = '买就送优惠券';
                break;
            default:
                $discount = $data['expression']/10;
                $title = $discount.'折';
        }
        return $title;
    }
}
