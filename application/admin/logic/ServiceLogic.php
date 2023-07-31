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
 * Date: 2015-09-09
 */

namespace app\admin\logic;
use think\Model;
use think\Db;

class ServiceLogic extends Model
{
    /**
     * 获取筛选框搜索条件对应的ID
     * 如store_name就去store表获取store_id
     * @param $type
     * @param $qv
     * @return mixed
     */
    public function getConditionId($type,$qv){
            $where["$type"] = array('like','%'.$qv.'%');
            $model = explode('_',$type);
            $column = $model[0].'_id';
            if($type !='order_sn'){
                $id_arr=Db::name("$model[0]")->where($where)->getField("$column",true);
                $data["$column"]=['in',$id_arr];
            }else{
                $data["$type"] = array('like','%'.$qv.'%');
            }
        return $data;
    }

}