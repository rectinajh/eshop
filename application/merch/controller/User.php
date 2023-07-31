<?php

namespace app\merch\controller;



use think\AjaxPage;

use think\Db;

use think\Page;



class User extends Base

{

    
    public function index()

    {
 
        $store_id=STORE_ID;
        $store=M('store')->where('store_id',$store_id)->getField('store_name');
        $todaystart = strtotime(date('Y-m-d'.'00:00:00',time()));
        $todayend = strtotime(date('Y-m-d'.'00:00:00',time()+3600*24));

        $no_shopping_order_num=M('order')->where(array('store_id'=>$store_id,'shipping_status'=>0,'pay_status'=>1,'order_status'=>0))->count();//待确认订单

        $no_pay_order=M('order')->where(array('store_id'=>$store_id,'pay_status'=>0))->count();//待付款

        $wait_order=M('order')->where(array('store_id'=>$store_id,'pay_status'=>1,'order_status'=>1,'shipping_status'=>0))->count();//待发货

        $shouhua_order=M('order')->where(array('store_id'=>$store_id,'pay_status'=>1,'order_status'=>1,'shipping_status'=>1))->count();//待收货

        $success_order=M('order')->query('select * from tp_order where store_id="{$store_id}" and (order_status=2 or order_status=4)');//已完成

        $success_order=count($success_order);

        $order_num=M('order')->where("store_id= '{$store_id}' and add_time>'{$todaystart}' and add_time<'{$todayend}'")->count();
        $order=M('order')->where("store_id= '{$store_id}' and add_time>'{$todaystart}' and add_time<'{$todayend}' and pay_status=1")->select();
        $money=0;
        foreach($order as $v){
            $money+=$v['total_amount'];
        }
        $this->assign('money',$money);
        $this->assign('store',$store);
        $this->assign('order_num',$order_num);
        $this->assign('no_shopping_order_num',$no_shopping_order_num);
        $this->assign('no_pay_order',$no_pay_order);
        $this->assign('shouhua_order',$shouhua_order);
        $this->assign('wait_order',$wait_order);
        $this->assign('success_order',$success_order);

        return $this->fetch();

    }

    public function order_list()

    {
        $store_id=STORE_ID;
        $condition='store_id='.$store_id;
        if(I("order_sn")!=''){
            $order_sn=I("order_sn");
            $condition.=" and order_sn like '%".$order_sn."%'";
        }
        if(I("user_name")!=''){
            $user_name=I("user_name");
            $condition.=" and consignee ='".$user_name."'";
        }
        $a=6;
        if(I('get.pay_status')==4){//待支付
            $a=1;
            $condition.=' and pay_status=0';

        }elseif(I('get.order_status')==6){//已完成
            $a=2;
            $condition.=" and pay_status=1 and shipping_status=1 and (order_status =2 or order_status=4)";

        }elseif(I('get.pay_status')==1 && I('get.order_status')==1 && I('get.shipping_status')==1){//待收货
            $a=3;
            $condition.=' and pay_status=1 and order_status=1 and shipping_status=1';

        }elseif(I('get.pay_status')==1 && I('get.order_status')==1 && I('get.shipping_status')==0){//待发货
            $a=4;
            $condition.=' and pay_status=1 and order_status=1 and shipping_status=0';
           
        }elseif(I('get.order_status')==0 && I('get.pay_status')==1){//待确认
            $a=5;
            $condition.=' and pay_status=1 and order_status=0';

        }
        
        $order_list=M('order')->where($condition)->order('add_time desc')->select();
        foreach($order_list as $k=>$v){
            if($v['pay_status']==0){
                $order_list[$k]['pay_status']='未付款';
            }elseif($v['pay_status']==1){
                $order_list[$k]['pay_status']='已付款';
            }elseif($v['pay_status']==3){
                $order_list[$k]['pay_status']='付款失败';
            }
            if($v['order_status']==0){
                $order_list[$k]['order_status']='待确认';
            }elseif($v['order_status']==1){
                $order_list[$k]['order_status']='已确认';
            }elseif($v['order_status']==2){
                $order_list[$k]['order_status']='已收货';
            }
            elseif($v['order_status']==3){
                $order_list[$k]['order_status']='已取消';
            }
            elseif($v['order_status']==4){
                $order_list[$k]['order_status']='已完成';
            }
            elseif($v['order_status']==5){
                $order_list[$k]['order_status']='已作废';
            }
            if($v['shipping_status']==0){
                $order_list[$k]['shipping_status']='未发货';
            }elseif($v['shipping_status']==1){
                $order_list[$k]['shipping_status']='已发货';
            }
            $order_id=$v['order_id'];
            $order_list[$k]['level']=M('order_goods')->where('order_id',$order_id)->select();
            foreach($order_list[$k]['level'] as $kk=>$vv){
                $original_img=M('goods')->where('goods_id',$vv['goods_id'])->getField('original_img');
                $order_list[$k]['level'][$kk]['original_img']=$original_img;
            }

        }
        $this->assign('a',$a);
        $this->assign('order_list',$order_list);
        return $this->fetch();
    
    }

    public function orderInfo()

    {   
        $store_id=STORE_ID;
        $store=M('store')->where('store_id',$store_id)->getField('store_name');
        $order_id=I('get.order_id');
        $orderInfo=M('order')->where('order_id',$order_id)->find();
        if($orderInfo['pay_status']==0){
                $orderInfo['pay_status']='未付款';
            }elseif($orderInfo['pay_status']==1){
                $orderInfo['pay_status']='已付款';
            }elseif($orderInfo['pay_status']==3){
                $orderInfo['pay_status']='付款失败';
            }
            if($orderInfo['order_status']==0){
                $orderInfo['order_status']='待确认';
            }elseif($orderInfo['order_status']==1){
                $orderInfo['order_status']='已确认';
            }elseif($orderInfo['order_status']==2){
                $orderInfo['order_status']='已收货';
            }
            elseif($orderInfo['order_status']==3){
                $orderInfo['order_status']='已取消';
            }
            elseif($orderInfo['order_status']==4){
                $orderInfo['order_status']='已完成';
            }
            elseif($orderInfo['order_status']==5){
                $orderInfo['order_status']='已作废';
            }
            if($orderInfo['shipping_status']==0){
                $orderInfo['shipping_status']='未发货';
            }elseif($orderInfo['shipping_status']==1){
                $orderInfo['shipping_status']='已发货';
            }
        $userInfo=M('users')->where('user_id',$orderInfo['user_id'])->find();
        $province=M('region')->where('id',$orderInfo['province'])->getField('name');
        $city=M('region')->where('id',$orderInfo['city'])->getField('name');
        $district=M('region')->where('id',$orderInfo['district'])->getField('name');
        $orderInfo['address']=$province.'，'.$city.'，'.$district.'，'.$orderInfo['address'];
        $orderInfo['goods']=M('order_goods')->where('order_id',$order_id)->select();
        
        foreach ($orderInfo['goods'] as $k => $v) {
            $goods=M('goods')->where('goods_id',$v['goods_id'])->find();
            $orderInfo['goods'][$k]['goods_name']=$goods['goods_name'];
            $orderInfo['goods'][$k]['original_img']=$goods['original_img'];
            $orderInfo['goods'][$k]['store_count']=$goods['store_count'];
        }
        $this->assign('orderInfo',$orderInfo);
        $this->assign('userInfo',$userInfo);
        $this->assign('store',$store);
        return $this->fetch();
    
    }
    
    public function goods_num()

    {

        $store_id=STORE_ID;
        $condition='store_id='.$store_id;
        if(I('goods_name')!=''){
            $condition.=" and goods_name like '%".I('goods_name')."%'";
        }elseif(I('goods_sn')!=''){
            $condition.=" and goods_sn like '%".I('goods_sn')."%'";
        }
        $goodsNum=M('goods')->where($condition)->select();

        $this->assign('goodsNum',$goodsNum);
        return $this->fetch();
    
    }

   

    public function logout()

    {

        session_unset();

        session_destroy();

        $this->success("退出成功", U('Merch/Login/login'));

    }

    public function queryOrder()
    {
        $store_id=STORE_ID;

        $order_id=I('order_id');

        $seller_id=M('seller')->where('store_id',$store_id)->getField('seller_id');
        
        $data['order_id']=$order_id;
        $data['cation_user']=$seller_id;
        $data['order_status']=1;
        $data['pay_status']=1;
        $data['shipping_status']=0;
        $data['log_time']=time();
        $data['action_note']='确认订单';
        $data['status_desc']='确认订单';
        $data['store_id']=$store_id;
        $order_action_id=M('order_action')->insertGetId($data);
        $rs=M('order')->where('order_id',$order_id)->save(array('order_status'=>1));
        if($rs && $order_action_id){
            $this->ajaxReturn(['status'=>1,'msg'=>'订单已确认']);
        }else{
            $this->ajaxReturn(['status'=>0,'msg'=>'操作失败，请重试！']);
        }
    }

    public function confirmOrder(){
        
        $store_id=STORE_ID;

        $order_id=I('order_id');

        $seller_id=M('seller')->where('store_id',$store_id)->getField('seller_id');
        
        $data['order_id']=$order_id;
        $data['cation_user']=$seller_id;
        $data['order_status']=1;
        $data['pay_status']=1;
        $data['shipping_status']=1;
        $data['log_time']=time();
        $data['action_note']='订单已发货';
        $data['status_desc']='订单已发货';
        $data['store_id']=$store_id;
        $order_action_id=M('order_action')->insertGetId($data);
        $rs=M('order')->where('order_id',$order_id)->save(array('shipping_status'=>1));
        if($rs && $order_action_id){
            $this->ajaxReturn(['status'=>1,'msg'=>'订单已发货']);
        }else{
            $this->ajaxReturn(['status'=>0,'msg'=>'操作失败，请重试！']);
        }
    }

    public function commission()

    {
        //
        if($_POST){
        	$store_id=STORE_ID;
        	$rebate_paytime_start=I('rebate_paytime_start');
        	$rebate_paytime_end=I('rebate_paytime_end');
        	if($rebate_paytime_start){
        		$rebate_paytime_start=strtotime($rebate_paytime_start);
        	}else{
        		$rebate_paytime_start=time();
        	}
        	if($rebate_paytime_end){
        		$rebate_paytime_end=strtotime($rebate_paytime_end);
        	}else{
        		$rebate_paytime_end=time();
        	}
        	
        	$pany_count = DB::name('order')->where("store_id=$store_id and confirm_time>$rebate_paytime_start and confirm_time<$rebate_paytime_end and (order_status=2 || order_status=4)")->count();
        	
        	$page = new Page($pany_count, 10);
        	$show = $page->show();
        	$pany_list = DB::name('order')
        	->where("store_id=$store_id and confirm_time>$rebate_paytime_start and confirm_time<$rebate_paytime_end and (order_status=2 || order_status=4)")
        	->limit($page->firstRow, $page->listRows)
        	->select();
        	
        	foreach ($pany_list as $k=>$v){
        		$pany_list[$k]['money']=$v['total_amount']-$v['commission'];
        		  
        	}
        	 
        	$this->assign('list', $pany_list);
        	$this->assign('page', $show);
        	$this->assign('pager', $page);
        	if($pany_list){
        		if ($_GET['is_ajax']) {
        			return $this->fetch('ajax_commission');
        		}
        	}
         //    else{
        	// 	$this->ajaxReturn(1);
        	// }
        	return $this->fetch();
        }else{
        	$store_id=STORE_ID;
        	$pany_count = DB::name('order')->where("store_id=$store_id and (order_status=2 || order_status=4)")->count();
        	$page = new Page($pany_count, 10);
        	$show = $page->show();
        	$pany_list = DB::name('order')
        	->where("store_id=$store_id and (order_status=2 || order_status=4)")
        	->limit($page->firstRow, $page->listRows)
        	->select();
        	
        	foreach ($pany_list as $k=>$v){
        		$pany_list[$k]['money']=$v['total_amount']-$v['commission'];
        		 
        		 
        	}
        	
        	$this->assign('list', $pany_list);
        	$this->assign('page', $show);
        	$this->assign('pager', $page);
        	if($pany_list){
        		if ($_GET['is_ajax']) {
        			return $this->fetch('ajax_commission');
        		}
        	}
            //else{
        		//$this->ajaxReturn(1);
        	//}
        	
        	
        	return $this->fetch();
        }
        
        
        
        
        
        
    
    }
    /**
     * 修改未收货的用户信息
     */
    public function editinfo(){
    	if($_POST){
    		$order_id=I('order_id');
    		$data['consignee']=I('shouhuoren');//收货人
    		$data['mobile']=I('mobile');//手机号
    		$sheng=I('sheng');//省
    		$shi=I('shi');//市
    		$xian=I('xian');//县
    		$data['address']=I('qu');//详细地址
    		$sheng=M('region')->where("name='{$sheng}'")->find();
    		$shi=M('region')->where("name='{$shi}'")->find();
    		$xian=M('region')->where("name='{$xian}'")->find();
    		$data['province']=$sheng['id'];//省ID
    		$data['city']=$shi['id'];//市ID
    		$data['district']=$xian['id'];//区ID
    		
    		 $info=M('order')->where("order_id={$order_id}")->save($data);
    		 if($info){
    			$this->ajaxReturn(['status'=>1,'msg'=>'修改成功']);
    		}else{
    			$this->ajaxReturn(['status'=>0,'msg'=>'修改失败']);
    		}  
    	}
    }
}