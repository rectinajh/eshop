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

class UsersLogic extends Model
{    
    
    /**
     * 获取指定用户信息
     * @param $uid int 用户UID
     * @param bool $relation 是否关联查询
     *
     * @return mixed 找到返回数组
     */
    public function detail($uid, $relation = true)
    {
        $user = M('users')->where(array('user_id' => $uid))->relation($relation)->find();
        return $user;
    }
    
    /**
     * 改变用户信息
     * @param int $uid
     * @param array $data
     * @return array
     */
    public function updateUser($uid = 0, $data = array())
    {
        $db_res = M('users')->where(array("user_id" => $uid))->data($data)->save();
        if ($db_res) {
            return array(1, "用户信息修改成功");
        } else {
            return array(0, "用户信息修改失败");
        }
    }
    
    
    /**
     * 添加用户
     * @param $user
     * @return array
     */
    public function addUser($user)
    {
		$user_count = Db::name('users')
				->where(function($query) use ($user){
					if ($user['email']) {
						$query->where('email',$user['email']);
					}
					if ($user['mobile']) {
						$query->whereOr('mobile',$user['mobile']);
					}
				})
				->count();
		if ($user_count > 0) {
			return array('status' => -1, 'msg' => '账号已存在');
		}

    	$user['password'] = encrypt($user['password']);
    	$user['reg_time'] = time();
    	$user_id = M('users')->add($user);
    	if(!$user_id){
    		return array('status'=>-1,'msg'=>'添加失败');
    	}else{
    		$pay_points = tpCache('basic.reg_integral'); // 会员注册赠送积分
    		if($pay_points > 0)
    			accountLog($user_id, 0 , $pay_points , '会员注册赠送积分'); // 记录日志流水
    		// 会员注册送优惠券
//    		$coupon = M('coupon')->where("send_end_time > ".time()." and ((createnum - send_num) > 0 or createnum = 0) and type = 2")->select();
//    		if(!empty($coupon)){
//    			foreach ($coupon as $key => $val)
//    			{
//    				M('coupon_list')->add(array('cid'=>$val['id'],'type'=>$val['type'],'uid'=>$user_id,'send_time'=>time()));
//    				M('Coupon')->where("id = {$val['id']}")->setInc('send_num'); // 优惠券领取数量加一
//    			}
//    		}
    		return array('status'=>1,'msg'=>'添加成功');
    	}
    }   
   
}