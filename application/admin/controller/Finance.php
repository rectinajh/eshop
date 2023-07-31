<?php
namespace app\admin\controller;
use think\Page;
use think\Db;

class Finance extends Base {
    
    /*
     * 初始化操作
     */
    public function _initialize() {
       parent::_initialize();
    }    
 
    /**
     *  店家转账汇款记录
     */
    public function store_remittance(){
    	$status = I('status',1);
    	$this->assign('status',$status);
		$this->get_store_withdrawals($status);
        return $this->fetch();
    }
    /**
     *  转账汇款记录
     */
    public function remittance(){
    	$status = I('status',1);
    	$this->assign('status',$status);
    	$this->get_withdrawals_list($status);
        return $this->fetch();
    }
    /**
     *  转账汇款记录
     */
    public function jifenlog(){
    	$status = I('status',1);
    	$this->assign('status',$status);
    	$this->get_jifen_list($status);
    	return $this->fetch();
    }
    /**
     * 余额提现申请记录
     */
    public function withdrawals()
    {
    	$this->get_withdrawals_list();
        return $this->fetch();
    }
    
    public function get_withdrawals_list($status=''){
    	$user_id = I('user_id/d');
    	$realname = I('realname');
    	$bank_card = I('bank_card');
    	$create_time = I('create_time');
    	$create_time = str_replace("+"," ",$create_time);
    	$create_time2 = $create_time  ? $create_time  : date('Y-m-d',strtotime('-1 year')).' - '.date('Y-m-d',strtotime('+1 day'));
    	$create_time3 = explode(' - ',$create_time2);
    	$this->assign('start_time',$create_time3[0]);
    	$this->assign('end_time',$create_time3[1]);
    	$where['w.create_time'] =  array(array('gt', strtotime(strtotime($create_time3[0])), array('lt', strtotime($create_time3[1]))));
    	$status = empty($status) ? I('status') : $status;
    	if(empty($status) || $status === '0'){
    		$where['w.status'] =  array('lt',1);
    	}
    	if($status === '0' || $status > 0) {
    		$where['w.status'] = $status;
    	}
    	$user_id && $where['u.user_id'] = $user_id;
    	$realname && $where['w.realname'] = array('like','%'.$realname.'%');
    	$bank_card && $where['w.bank_card'] = array('like','%'.$bank_card.'%');
    	$export = I('export');
    	if($export == 1){
    		$strTable ='<table width="500" border="1">';
    		$strTable .= '<tr>';
    		$strTable .= '<td style="text-align:center;font-size:12px;width:120px;">申请人</td>';
			$strTable .= '<td style="text-align:center;font-size:12px;" width="100">申请金额</td>';
			$strTable .= '<td style="text-align:center;font-size:12px;" width="100">手续费</td>';
			$strTable .= '<td style="text-align:center;font-size:12px;" width="100">到账金额</td>';
    		$strTable .= '<td style="text-align:center;font-size:12px;" width="*">银行名称</td>';
    		$strTable .= '<td style="text-align:center;font-size:12px;" width="*">银行账号</td>';
    		$strTable .= '<td style="text-align:center;font-size:12px;" width="*">开户人姓名</td>';
    		$strTable .= '<td style="text-align:center;font-size:12px;" width="*">申请时间</td>';
    		$strTable .= '<td style="text-align:center;font-size:12px;" width="*">提现备注</td>';
    		$strTable .= '</tr>';
    		$remittanceList = Db::name('withdrawals')->alias('w')->field('w.*,u.nickname')->join('__USERS__ u', 'u.user_id = w.user_id', 'INNER')->where($where)->order("w.id desc")->select();
    		if(is_array($remittanceList)){
    			foreach($remittanceList as $k=>$val){
    				$strTable .= '<tr>';
					$strTable .= '<td style="text-align:center;font-size:12px;">'.$val['nickname'].'</td>';
					$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['shen_money'].' </td>';
					$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['fee'].' </td>';
					$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['money'].' </td>';
    				$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['bank_name'].'</td>';
    				$strTable .= '<td style="vnd.ms-excel.numberformat:@">'.$val['bank_card'].'</td>';
    				$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['realname'].'</td>';
    				$strTable .= '<td style="text-align:left;font-size:12px;">'.date('Y-m-d H:i:s',$val['create_time']).'</td>';
    				$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['remark'].'</td>';
    				$strTable .= '</tr>';
    			}
    		}
    		$strTable .='</table>';
    		unset($remittanceList);
    		downloadExcel($strTable,'remittance');
    		exit();
    	}
    	$count = Db::name('withdrawals')->alias('w')->join('__USERS__ u', 'u.user_id = w.user_id', 'INNER')->where($where)->count();
    	$Page  = new Page($count,20);
    	$list = Db::name('withdrawals')->alias('w')->field('w.*,u.nickname')->join('__USERS__ u', 'u.user_id = w.user_id', 'INNER')->where($where)->order("w.id desc")->limit($Page->firstRow.','.$Page->listRows)->select();
    	$this->assign('create_time',$create_time2);
    	$show  = $Page->show();
    	$this->assign('show',$show);
    	$this->assign('list',$list);
    	$this->assign('pager',$Page);
    	$this->assign('count',$count);
    	C('TOKEN_ON',false);
    }
    /**
     * 积分提现申请记录
     */
    public function jifen()
    {
    	$this->get_jifen_list();
    	return $this->fetch();
    }
    public function get_jifen_list($status=''){
    	$user_id = I('user_id/d');
    	//$realname = I('realname');
    	//$bank_card = I('bank_card');
    	$create_time = I('create_time');
    	$create_time = str_replace("+"," ",$create_time);
    	$create_time2 = $create_time  ? $create_time  : date('Y-m-d',strtotime('-1 year')).' - '.date('Y-m-d',strtotime('+1 day'));
    	$create_time3 = explode(' - ',$create_time2);
    	$this->assign('start_time',$create_time3[0]);
    	$this->assign('end_time',$create_time3[1]);
    	$where['w.create_time'] =  array(array('gt', strtotime(strtotime($create_time3[0])), array('lt', strtotime($create_time3[1]))));
    	$status = empty($status) ? I('status') : $status;
    	if(empty($status) || $status === '0'){
    		$where['w.status'] =  array('lt',1);
    	}
    	if($status === '0' || $status > 0) {
    		$where['w.status'] = $status;
    	}
    	$user_id && $where['u.user_id'] = $user_id;
    	
    	$export = I('export');
    	if($export == 1){
    		$strTable ='<table width="500" border="1">';
    		$strTable .= '<tr>';
    		$strTable .= '<td style="text-align:center;font-size:12px;width:120px;">申请人</td>';
    		$strTable .= '<td style="text-align:center;font-size:12px;" width="100">申请提现积分</td>';
    		$strTable .= '<td style="text-align:center;font-size:12px;" width="*">申请时间</td>';
    		$strTable .= '<td style="text-align:center;font-size:12px;" width="*">提现备注</td>';
    		$strTable .= '</tr>';
    		$remittanceList = Db::name('jifenlog')->alias('w')->field('w.*,u.nickname')->join('__USERS__ u', 'u.user_id = w.user_id', 'INNER')->where($where)->order("w.id desc")->select();
    		if(is_array($remittanceList)){
    			foreach($remittanceList as $k=>$val){
    				$strTable .= '<tr>';
    				$strTable .= '<td style="text-align:center;font-size:12px;">'.$val['nickname'].'</td>';
    				$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['jifen'].' </td>';
    				$strTable .= '<td style="text-align:left;font-size:12px;">'.date('Y-m-d H:i:s',$val['create_time']).'</td>';
    				$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['remark'].'</td>';
    				$strTable .= '</tr>';
    			}
    		}
    		$strTable .='</table>';
    		unset($remittanceList);
    		downloadExcel($strTable,'remittance');
    		exit();
    	}
    	$count = Db::name('jifenlog')->alias('w')->join('__USERS__ u', 'u.user_id = w.user_id', 'INNER')->where($where)->count();
    	$Page  = new Page($count,20);
    	$list = Db::name('jifenlog')->alias('w')->field('w.*,u.nickname')->join('__USERS__ u', 'u.user_id = w.user_id', 'INNER')->where($where)->order("w.id desc")->limit($Page->firstRow.','.$Page->listRows)->select();
    	$this->assign('create_time',$create_time2);
    	$show  = $Page->show();
    	$this->assign('show',$show);
    	$this->assign('list',$list);
    	$this->assign('pager',$Page);
    	$this->assign('count',$count);
    	C('TOKEN_ON',false);
    }
    /**
     * 商家提现申请记录
     */
    public function store_withdrawals()
    {
		$this->get_store_withdrawals(null);
        return $this->fetch();
    }
    
    public function get_store_withdrawals($status){
    	$store_id = I('store_id');
    	$realname = I('realname');
    	$bank_card = I('bank_card');
    	$create_time = I('create_time');
    	
    	$create_time = str_replace("+"," ",$create_time);
    	$create_time2 = $create_time  ? $create_time  : date('Y-m-d',strtotime('-1 year')).' - '.date('Y-m-d',strtotime('+1 day'));
    	$create_time3 = explode(' - ',$create_time2);
    	$this->assign('start_time', $create_time3[0]);
    	$this->assign('end_time', $create_time3[1]);
    	$where['sw.create_time'] =  array(array('gt', strtotime($create_time3[0])), array('lt', strtotime($create_time3[1])));
    	$store_id && $where['sw.store_id'] = $store_id;
        $status = empty($status) ? I('status') : $status;
    	if(empty($status) || $status === '0'){
    		$where['sw.status'] =  array('lt',1);
    	}
    	if($status === '0' || $status > 0) {
    		$where['sw.status'] = $status;
    	}
    	$bank_card && $where['sw.bank_card'] = array('like','%'.$bank_card.'%');
    	$realname && $where['sw.realname'] = array('like','%'.$realname.'%');
    	$export = I('export');
    	if($export == 1){
    		$strTable ='<table width="500" border="1">';
    		$strTable .= '<tr>';
    		$strTable .= '<td style="text-align:center;font-size:12px;width:120px;">申请人</td>';
    		$strTable .= '<td style="text-align:center;font-size:12px;" width="100">提现金额</td>';
    		$strTable .= '<td style="text-align:center;font-size:12px;" width="*">银行名称</td>';
    		$strTable .= '<td style="text-align:center;font-size:12px;" width="*">银行账号</td>';
    		$strTable .= '<td style="text-align:center;font-size:12px;" width="*">开户人姓名</td>';
    		$strTable .= '<td style="text-align:center;font-size:12px;" width="*">申请时间</td>';
    		$strTable .= '<td style="text-align:center;font-size:12px;" width="*">提现备注</td>';
    		$strTable .= '</tr>';
    		$remittanceList = Db::name('store_withdrawals')->alias('sw')->field('sw.*,s.store_name')->join('__STORE__ s','s.store_id = sw.store_id', 'INNER')->where($where)->order("sw.id desc")->select();
    		if(is_array($remittanceList)){
    			foreach($remittanceList as $k=>$val){
    				$strTable .= '<tr>';
    				$strTable .= '<td style="text-align:center;font-size:12px;">'.$val['store_name'].'</td>';
    				$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['money'].' </td>';
    				$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['bank_name'].'</td>';
    				$strTable .= '<td style="vnd.ms-excel.numberformat:@">'.$val['bank_card'].'</td>';
    				$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['realname'].'</td>';
    				$strTable .= '<td style="text-align:left;font-size:12px;">'.date('Y-m-d H:i:s',$val['create_time']).'</td>';
    				$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['remark'].'</td>';
    				$strTable .= '</tr>';
    			}
    		}
    		$strTable .='</table>';
    		unset($remittanceList);
    		downloadExcel($strTable,'remittance');
    		exit();
    	}
    	$count = Db::name('store_withdrawals')->alias('sw')->field('sw.id')->join('__STORE__ s','s.store_id = sw.store_id', 'INNER')->where($where)->count();
    	$Page  = new Page($count,20);
    	$list = Db::name('store_withdrawals')->alias('sw')->field('sw.*,s.store_name')->join('__STORE__ s','s.store_id = sw.store_id', 'INNER')->where($where)->order("`id` desc")->limit($Page->firstRow.','.$Page->listRows)->select();
    	
    	$this->assign('create_time',$create_time2);
    	$show  = $Page->show();
    	$this->assign('show',$show);
    	$this->assign('list',$list);
    	//dump($list);
    	$this->assign('pager',$Page);
    	C('TOKEN_ON',false);
    }
    /**
     * 删除申请记录
     */
    public function delStoreWithdrawals()
    {                        
        $model = M("store_withdrawals"); 
        $model->where(['id'=>$_POST['del_id'],'status'=>['lt'=>0]])->delete();
        $this->ajaxReturn(1);
    }

	/**
	 * 修改编辑商家 申请提现
	 */
	public function editStoreWithdrawals()
	{
		$id = I('id');
		$withdrawals = Db::name('store_withdrawals')->where('id', $id)->find();
		$store = M('store')->where("store_id", $withdrawals['store_id'])->find();
		$this->assign('store', $store);
		$this->assign('data', $withdrawals);
		return $this->fetch();
	}

    /**
     * 删除申请记录
     */
    public function delWithdrawals()
    {                        
        $model = M("withdrawals"); 
        $model->where(['id '=>$_POST['del_id'],'status'=>['lt'=>0]])->delete();
        $this->ajaxReturn(1);
    } 
    
    /**
     * 修改编辑 申请余额提现
     */
    public  function editWithdrawals(){        
       $id = I('id');
       $model = M("withdrawals");
       $withdrawals = $model->find($id);
       $user = M('users')->where("user_id = {$withdrawals[user_id]}")->find();     
       if($user['nickname'])        
           $withdrawals['user_name'] = $user['nickname'];
       elseif($user['email'])        
           $withdrawals['user_name'] = $user['email'];
       elseif($user['mobile'])        
           $withdrawals['user_name'] = $user['mobile'];            
       
       $this->assign('user',$user);
       $this->assign('data',$withdrawals);
       return $this->fetch();
    }      
    /**
     * 修改编辑 申请积分提现
     */
    public  function editjifen(){
    	$id = I('id');
    	$model = M("jifenlog");
    	$withdrawals = $model->find($id);
    	$user = M('users')->where("user_id = {$withdrawals[user_id]}")->find();
    	if($user['nickname'])
    		$withdrawals['user_name'] = $user['nickname'];
    	elseif($user['email'])
    	$withdrawals['user_name'] = $user['email'];
    	elseif($user['mobile'])
    	$withdrawals['user_name'] = $user['mobile'];
    	 
    	$this->assign('user',$user);
    	$this->assign('data',$withdrawals);
    	return $this->fetch();
    }
    /**
     *  商家结算记录
     */
    public function order_statis(){
        $store_id = I('store_id');
        $create_date = I('create_date');
        $create_date = str_replace("+"," ",$create_date);
        $create_date2 = $create_date  ? $create_date  : date('Y-m-d',strtotime('-1 month')).' - '.date('Y-m-d',strtotime('+1 month'));
        $create_date3 = explode(' - ',$create_date2);
        $where = " create_date >= '".strtotime($create_date3[0])."' and create_date <= '".strtotime($create_date3[1])."' ";
        $this->assign('start_time',$create_date3[0]);
        $this->assign('end_time',$create_date3[1]);
        $store_id && $where .= " and store_id = $store_id ";
                        
        $count = Db::name('order_statis')->where($where)->count();
        $Page  = new Page($count,16);
        $list = Db::name('order_statis')->alias('os')->join('__STORE__ s','s.store_id = os.store_id')->where($where)->order("`id` desc")->limit($Page->firstRow.','.$Page->listRows)->select();
        
        $this->assign('create_date',$create_date2);
        $show  = $Page->show();
        $this->assign('pager',$Page);
        $this->assign('show',$show);
        $this->assign('list',$list);
        C('TOKEN_ON',false);
        return $this->fetch();
    }

    /**
     *  处理会员余额提现申请
     */
    public function withdrawals_update(){
    	$id = I('id/a');
        $data['status']=$status = I('status');
    	$data['remark'] = I('remark');
        if($status == 1) $data['check_time'] = time();
        if($status != 1) $data['refuse_time'] = time();
        $r = M('withdrawals')->where('id in ('.implode(',', $id).')')->update($data);
    	if($r){
    		$this->ajaxReturn(array('status'=>1,'msg'=>"操作成功"),'JSON');
    	}else{
    		$this->ajaxReturn(array('status'=>0,'msg'=>"操作失败"),'JSON');
    	}  	
    }
    /**
     *  处理会员积分提现申请
     */
    public function jifen_update(){
    	$id = I('id/a');
    	$data['status']=$status = I('status');
    	$data['remark'] = I('remark');
    	if($status == 1) $data['check_time'] = time();
    	if($status != 1) $data['refuse_time'] = time();
    	$r = M('jifenlog')->where('id in ('.implode(',', $id).')')->update($data);
    	if($r){
    		
    		$this->ajaxReturn(array('status'=>1,'msg'=>"操作成功"),'JSON');
    	}else{
    		$this->ajaxReturn(array('status'=>0,'msg'=>"操作失败"),'JSON');
    	}
    }
    /**
     *  处理店铺提现申请
     */
    public function store_withdrawals_update(){
    	$id = I('id/a');
        $data['status']= $status = I('status');
        if($status == 1) $data['check_time'] = time();
        if($status != 1) $data['refuse_time'] = time();
        $data['remark'] = I('remark');
        $r = M('store_withdrawals')->where('id in ('.implode(',', $id).')')->save($data);
    	if($r){
    		$this->ajaxReturn(array('status'=>1,'msg'=>"操作成功"),'JSON');
    	}else{
    		$this->ajaxReturn(array('status'=>0,'msg'=>"操作失败"),'JSON');
    	}
    }
    /**
     * 余额转账操作
     *   */
    public function transfer(){
    	$id = I('selected/a');
    	if(empty($id)){
    		$this->error('请至少选择一条记录');
    	}
    	$atype = I('atype');
    	if(is_array($id)){
    		$withdrawals = M('withdrawals')->where('id in ('.implode(',', $id).')')->select();
    	}else{
    		$withdrawals = M('withdrawals')->where(array('id'=>$id))->select();
    	}
    	foreach($withdrawals as $val){
    		$user = M('users')->where(array('user_id'=>$val['user_id']))->find();
    		if($user['withdraw_money'] < $val['money'])
    		{
    			$data['status'] = -2;
    			$data['remark'] = '账户提现币不足';
    			M('withdrawals')->where(array('id'=>$val['id']))->save($data);
    			$this->error('账户提现币不足');
    		}else{
    			if($atype == 'online'){
    				if($val['bank_name'] == '支付宝'){
    					//数据格式为：流水号1^收款方账号1^收款账号姓名1^付款金额1^备注说明1|流水号2^收款方账号2^收款账号姓名2^付款金额2^备注说明2
    					$alipay['batch_no'] = date('YmdHis');
    					$alipay['batch_fee'] += $val['money'];
    					$alipay['batch_num'] += 1;
    					$str = isset($alipay['detail_data']) ? '|' : '';
    					$alipay['detail_data'] .= $str.$val['id'].'^'.$val['bank_card'].'^'.$val['realname'].'^'.$val['money'].'^'.$val['remark'];
    				}else if($val['bank_name'] == '微信'){
    					$wxpay = array(
    							'userid' => $val['user_id'],//用户ID做更新状态使用
    							'openid' => $user['openid'],//收款人微信号对应的 OPENID
    							'pay_code'=>$val['user_id'].'_'.$val['id'].'_'.$val['money'],//商户订单号，需要唯一
    							'money' => $val['money'],//金额
    							'desc' => '恭喜您提现申请成功!'
    					);
    					include_once  PLUGIN_PATH."payment/weixin/weixin.class.php";
    					$wxpay_obj = new \weixin();
    					$res = $wxpay_obj->transfer($wxpay);//微信在线付款转账
    					if($res['partner_trade_no']){
							accountLog($val['user_id'], 0, 0,"平台处理用户提现申请", 0, 0, 0, 0,($val['shen_money'] * -1));
    						M('withdrawals')->where(array('id'=>$val['id']))->save(array('status'=>2,'pay_time'=>time(),'pay_code'=>$res['partner_trade_no']));
    					}else{
    						$this->error($res['msg']);
    					}
    				}else{
    					$this->error('由于银联不提供在线付款接口，所以银行卡提现不支持在线转账');
    				}
    				if(is_array($alipay)){
    					//支付宝在线批量付款
    					include_once  PLUGIN_PATH."payment/alipay/alipay.class.php";
    					$alipay_obj = new \alipay();
    					$alipay_obj->transfer($alipay);
    				}
    				$this->success("操作成功!",U('remittance'),3); exit;
    			}else{
    				//会员提现
    				$log=accountLog($val['user_id'], 0, 0,"管理员处理用户提现申请", 0, 0, 0, 0, ($val['shen_money'] * -1));//手动转账，默认视为已通过线下转方式处理了该笔提现申请
					if($log){
						$r = M('withdrawals')->where(array('id'=>$val['id']))->save(array('status'=>2,'pay_time'=>time()));
						$data['type'] = 1;
						$data['log_type_id'] = $val['id'];
						$data['user_id'] = $val['user_id'];
						$data['money'] = $val['money'];
						expenseLog($data);//支出记录日志
						$this->success("操作成功!",U('remittance'),3); exit;
					}else{
						$this->error("操作失败!",U('remittance'),3); exit;
					}
					
    			}
    		}
    	}
    }
    /**
     * 积分提现操作
     *   */
    public function transfer_jifen(){
    	$id = I('selected/a');
    	if(empty($id)){
    		$this->error('请至少选择一条记录');
    	}
    	$atype = I('atype');
    	if(is_array($id)){
    		$withdrawals = M('jifenlog')->where('id in ('.implode(',', $id).')')->select();
    	}else{
    		$withdrawals = M('jifenlog')->where(array('id'=>$id))->select();
    	}
    	foreach($withdrawals as $val){
    		$user = M('users')->where(array('user_id'=>$val['user_id']))->find();
    		if($user['pay_points'] < $val['jifen'])
    		{
    			$data['status'] = -2;
    			$data['remark'] = '账户积分不足';
    			M('jifenlog')->where(array('id'=>$val['id']))->save($data);
    			$this->error('账户积分不足');
    		}else{
    			if($atype != 'online'){
    				//会员提现
    				$normjifen=tpCache('basic.jifen');//限制额度
    				$shou3=tpCache('basic.shou3');//超过限额的手续费
    				$jifen=$val['jifen'];//申请提现的积分
    				
    				
    				if($jifen>=$normjifen){
    					$shoujifen=$jifen*$shou3/100;//手续费
    					$money=$jifen-$shoujifen;
    					$user_id=$val['user_id'];
    					$info['pay_points']=$jifen*-1;//提现到余额的积分
    					$info['user_id']=$val['user_id'];
    					$info['change_time']=time();
    					$info['desc']="积分提现";
    					$r = M('jifenlog')->where(array('id'=>$val['id']))->save(array('status'=>2,'pay_time'=>time()));
    					//accountJifen($val['user_id'], ($val['jifen'] * -1),"积分提现");//手动转账，默认视为已通过线下转方式处理了该笔提现申请
    					$update = Db::name('users')->where('user_id', $user_id)->setInc('user_money',$money);
    					$update = Db::name('users')->where('user_id', $user_id)->setDec('pay_points',$jifen);
    					if ($update) {
    						M('account_log')->add($info);
    						$this->success("操作成功!",U('jifenlog'),3); exit;
    					} else {
    						return false;
    					}
    				}else{
    					$this->error('您提现的积分没有超过最低限度!');
    				}
    				
    			}
    			
    		}
    	}
    }
    
    public function store_transfer(){
    	$id = I('selected/a');
    	if(empty($id)){
    		$this->error('请至少选择一条记录');
    	}
    	$atype = I('atype');
    	if(is_array($id)){
    		$withdrawals = M('store_withdrawals')->where('id in ('.implode(',', $id).')')->select();
    	}else{
    		$withdrawals = M('store_withdrawals')->where(array('id'=>$id))->select();
    	}
    	foreach($withdrawals as $val){
    		$store = M('store')->where(array('store_id'=>$val['store_id']))->find();
    		if($store['store_money'] < $val['money'])
    		{
    			$data['status'] = -2;
    			$data['remark'] = '账户余额不足';
    			M('store_withdrawals')->where(array('id'=>$val['id']))->save($data);
    			$this->error('账户余额不足');
    		}else{
    			if($atype == 'online'){
    				if($val['bank_name'] == '支付宝'){
    					//数据格式为：流水号1^收款方账号1^收款账号姓名1^付款金额1^备注说明1|流水号2^收款方账号2^收款账号姓名2^付款金额2^备注说明2
    					$alipay['batch_no'] = time();
    					$alipay['batch_fee'] += $val['money'];
    					$alipay['batch_num'] += 1;
    					$str = isset($alipay['detail_data']) ? '|' : '';
    					$alipay['detail_data'] .= $str.$val['id'].'^'.$val['bank_card'].'^'.$val['realname'].'^'.$val['money'].'^'.$val['remark'];
    				}else if($val['bank_name'] == '微信'){
    					$wxpay = array(
    							'userid' => $val['user_id'],//用户ID做更新状态使用
    							'openid' => M('users')->where(array('user_id'=>$store['user_id']))->getField('openid'),//收款人微信号对应的 OPENID
    							'pay_code'=>$val['store_id'].'_'.$val['id'].'_'.$val['money'],//商户订单号，需要唯一
    							'money' => $val['money'],//金额
    							'desc' => '恭喜您提现申请成功!'
    					);
    					include_once  PLUGIN_PATH."payment/weixin/weixin.class.php";
    					$wxpay_obj = new \weixin();
    					$res = $wxpay_obj->transfer($wxpay);//微信在线付款转账
    					if($res['partner_trade_no']){
    						storeAccountLog($val['store_id'], ($val['money'] * -1), 0,"平台处理商家提现申请");
    						M('store_withdrawals')->where(array('id'=>$val['id']))->save(array('status'=>2,'pay_time'=>time(),'pay_code'=>$res['partner_trade_no']));
    					}else{
    						$this->error($res['msg']);
    					}
    				}else{
    					$this->error('由于银联不提供在线付款接口，所以银行卡提现不支持在线转账');
    				}
    				if(is_array($alipay)){
    					//支付宝在线批量付款
    					include_once  PLUGIN_PATH."payment/alipay/alipay.class.php";
    					$alipay_obj = new \alipay();
    					$alipay_obj->transfer($alipay);
    				}
    				$this->success("操作成功!",U('store_remittance'),3); exit;
    			}else{
    				storeAccountLog($val['store_id'], ($val['money'] * -1), 0,"管理员处理商家提现申请");//手动转账，默认视为已通过线下转方式处理了该笔提现申请    	
    				$r = M('store_withdrawals')->where(array('id'=>$val['id']))->save(array('status'=>2,'pay_time'=>time()));
    				$data['type'] = 0;
    				$data['log_type_id'] = $val['id'];
    				$data['user_id'] = $val['store_id'];
    				$data['money']=$val['money'];
    				expenseLog($data);//支出记录日志    				
    				$this->success("操作成功!",U('store_remittance'),3); exit;
    			}
    		}
    	}
    }
    /**
     * 积分返还操作
     *   */
 public function remittal(){
    	$status = I('status',1);
    	$this->assign('status',$status);
    	$this->get_remittal_list($status);
        return $this->fetch();
    }
    public function get_remittal_list($status=''){
    	$user_id = I('user_id/d');
    	$realname = I('realname');
    	$bank_card = I('bank_card');
    	$create_time = I('create_time');
    	$create_time = str_replace("+"," ",$create_time);
    	$create_time2 = $create_time  ? $create_time  : date('Y-m-d',strtotime('-1 year')).' - '.date('Y-m-d',strtotime('+1 day'));
    	$create_time3 = explode(' - ',$create_time2);
    	$this->assign('start_time',$create_time3[0]);
    	$this->assign('end_time',$create_time3[1]);
    	$where['w.addtime'] =  array(array('gt', strtotime(strtotime($create_time3[0])), array('lt', strtotime($create_time3[1]))));
    	$status = empty($status) ? I('status') : $status;
    	if(empty($status) || $status === '0'){
    		$where['w.status'] =  array('lt',1);
    	}
    	if($status === '0' || $status > 0) {
    		$where['w.status'] = $status;
    	}
    	$user_id && $where['u.user_id'] = $user_id;
    	
    	
    	$export = I('export');
    	if($export == 1){
    		$strTable ='<table width="500" border="1">';
    		$strTable .= '<tr>';
    		$strTable .= '<td style="text-align:center;font-size:12px;width:120px;">申请人</td>';
    		$strTable .= '<td style="text-align:center;font-size:12px;" width="100">订单金额</td>';
    		$strTable .= '<td style="text-align:center;font-size:12px;" width="*">最大返还积分</td>';
    		$strTable .= '<td style="text-align:center;font-size:12px;" width="*">已返积分</td>';
    		$strTable .= '<td style="text-align:center;font-size:12px;" width="*">未返积分</td>';
    		$strTable .= '<td style="text-align:center;font-size:12px;" width="*">时间</td>';
    		$strTable .= '</tr>';
    		$remittanceList = Db::name('remittal')->alias('w')->field('w.*,u.nickname')->join('__USERS__ u', 'u.user_id = w.user_id', 'INNER')->where($where)->order("w.id desc")->select();
    		if(is_array($remittanceList)){
    			foreach($remittanceList as $k=>$val){
    				$strTable .= '<tr>';
    				$strTable .= '<td style="text-align:center;font-size:12px;">'.$val['nickname'].'</td>';
    				$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['total_amount'].' </td>';
    				$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['max_point'].'</td>';
    				$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['remittal_point'].'</td>';
    				$strTable .= '<td style="text-align:left;font-size:12px;">'.$val['notremittal_point'].'</td>';
    				if($status==0){
    					$strTable .= '<td style="text-align:left;font-size:12px;">'.date('Y-m-d H:i:s',$val['addtime']).'</td>';
    				}else{
    					$strTable .= '<td style="text-align:left;font-size:12px;">'.date('Y-m-d H:i:s',$val['finishtime']).'</td>';
    				}
    				
    				
    				$strTable .= '</tr>';
    			}
    		}
    		$strTable .='</table>';
    		unset($remittanceList);
    		downloadExcel($strTable,'remittance');
    		exit();
    	}
    	$count = Db::name('remittal')->alias('w')->join('__USERS__ u', 'u.user_id = w.user_id', 'INNER')->where($where)->count();
    	$Page  = new Page($count,20);
    	$list = Db::name('remittal')->alias('w')->field('w.*,u.nickname')->join('__USERS__ u', 'u.user_id = w.user_id', 'INNER')->where($where)->order("w.id desc")->limit($Page->firstRow.','.$Page->listRows)->select();
    	$this->assign('create_time',$create_time2);
    	$show  = $Page->show();
    	$this->assign('show',$show);
    	$this->assign('list',$list);
    	$this->assign('pager',$Page);
    	$this->assign('count',$count);
    	C('TOKEN_ON',false);
    }
    /**
     * 积分返还操作
     *   */
    public function transfer_remittal(){
    	$id = I('selected/a');
    	if(empty($id)){
    		$this->error('请至少选择一条记录');
    	}
    	$atype = I('atype');
    	$jifen=I('jifen');
    	if($jifen==''){
    		$this->error('返还积分不能为空!');
    	}
    	if(!(is_numeric($jifen))){
    		$this->error('您必须输入数字!');
    	}
    	if(is_array($id)){
    		$withdrawals = M('remittal')->where('id in ('.implode(',', $id).')')->select();
    	}else{
    		$withdrawals = M('remittal')->where(array('id'=>$id))->select();
    	}
    	
    	foreach($withdrawals as $val){
    		$total_amount=0;
    			if($atype != 'online'){
    				//购买商品积分返还
    				//$Yesterday = strtotime( date("Y-m-d",strtotime("-1 day")) ); //昨天
    				$today = strtotime( date("Y-m-d") ); //今天
    				$user=M('remittal')->where("status=1 and addtime <$today")->select();
    				if($user){
    					foreach ($user as $v){
    						$total_amount+=$v['total_amount'];//订单总额
    					}
    					
    					$bili=$val['total_amount']/$total_amount;//这个订单消费额度占此次返积分的比例
    					
    					$remittal_point=$jifen*$bili;//要返还的积分
    					$user_id=$val['user_id'];
    					$notremittal_point['notremittal_point']=$val['max_point']-$remittal_point;//未返积分
    					if($val['remittal_point']+$remittal_point>$val['max_point']){
    						$remittal_point=$val['notremittal_point'];
    						$update = Db::name('remittal')->where(array('id'=>$val['id']))->setInc('remittal_point',$remittal_point);
    						$r = M('remittal')->where(array('id'=>$val['id']))->save(array('status'=>2,'finishtime'=>time(),'notremittal_point'=>0));
    					
    					}
    					if($val['remittal_point']==$val['max_point']){
    						$update = M('remittal')->where(array('id'=>$val['id']))->save(array('status'=>2,'finishtime'=>time(),'notremittal_point'=>0));
    						$this->success("操作成功!",U('remittal'),3);
    					}
    					$update = Db::name('remittal')->where(array('id'=>$val['id']))->setInc('remittal_point',$remittal_point);
    					$update = Db::name('remittal')->where(array('id'=>$val['id']))->save($notremittal_point);
    					$update = Db::name('users')->where('user_id', $user_id)->setInc('pay_points',$remittal_point);
    					$info['pay_points']=$remittal_point;//购物返还积分
    					$info['user_id']=$val['user_id'];
    					$info['change_time']=time();
    					$info['desc']="购物返还积分";
    				}else{
    					$this->error('sorry,昨天什么都没卖出去哦~');
    				}
    				
    				/* if($val['remittal_point']<$val['max_point']){
    					$user_id=$val['user_id'];
    					$remittal_point=$total_amount*($val['total_amount']/$total_amount)*$fanhuan/100;//已返积分
    					$notremittal_point['notremittal_point']=$val['max_point']-$remittal_point;//未返积分
    					//如果这次返的积分超过了限定积分,那么直接把剩余积分返到账户同时把状态改为2
    					if($val['remittal_point']+$remittal_point>$val['max_point']){
    						$remittal_point=$val['notremittal_point'];
    						$update = Db::name('remittal')->where('user_id', $user_id)->setInc('remittal_point',$remittal_point);
    						$r = M('remittal')->where(array('id'=>$val['id']))->save(array('status'=>2,'finishtime'=>time(),'notremittal_point'=>0));
    						
    					}
    					$update = Db::name('remittal')->where('user_id', $user_id)->setInc('remittal_point',$remittal_point);
    					$update = Db::name('remittal')->where('user_id', $user_id)->save($notremittal_point);
    					$info['pay_points']=$remittal_point;//购物返还积分
    					$info['user_id']=$val['user_id'];
    					$info['change_time']=time();
    					$info['desc']="购物返还积分";
    					
    					
    					//accountJifen($val['user_id'], ($val['jifen'] * -1),"积分提现");//手动转账，默认视为已通过线下转方式处理了该笔提现申请
    					$update = Db::name('users')->where('user_id', $user_id)->setInc('pay_points',$remittal_point);
    					
    				}else if($val['remittal_point']==$val['max_point']){
    					$update = M('remittal')->where(array('id'=>$val['id']))->save(array('status'=>2,'finishtime'=>time(),'notremittal_point'=>0));
    					$this->success("操作成功!",U('remittal'),3);
    				} */
    
    			}
    			 
    			if ($update) {
    				M('account_log')->add($info);
    				
    			} else {
    				return false;
    			}
    			
    	}
    	$this->success("操作成功!",U('remittal'),3);
    }
    /**
     * 平台支出记录
     *   */
    public function expense_log(){
    	$map = array();
    	$begin = strtotime(I('add_time_begin'));
    	$end = strtotime(I('add_time_end'));
    	if($begin && $end){
    		$map['addtime'] = array('between',"$begin,$end");
    	}
    	$count = M('expense_log')->where($map)->count();
    	$page = new Page($count);
    	$lists  = M('expense_log')->where($map)->limit($page->firstRow.','.$page->listRows)->select();
    	$this->assign('page',$page->show());
    	$this->assign('total_count',$count);
    	$this->assign('list',$lists);
    	$admin = M('admin')->getField('admin_id,user_name');
    	$this->assign('admin',$admin);
    	$typeArr = array('商家提现','会员提现','订单退款','其他');
    	$this->assign('typeArr',$typeArr);
    	return $this->fetch();
    }
}