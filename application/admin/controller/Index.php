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

namespace app\admin\controller; 



use think\Db;

class Index extends Base {



    public function index(){

        $this->pushVersion();

        $act_list = session('act_list');

        $menu_list = getMenuList($act_list);

        $this->assign('menu_list',$menu_list);

        $admin_info = getAdminInfo(session('admin_id'));

		$order_amount = M('order')->where("order_status=0 and (pay_status=1 or pay_code='cod')")->count();

		$this->assign('order_amount',$order_amount);

		$this->assign('admin_info',$admin_info);

		$this->assign('menu',getMenuArr());

        return $this->fetch();

    }

   

    public function welcome(){

    	$this->assign('sys_info',$this->get_sys_info());

//    	$today = strtotime("-1 day");

    	$today = strtotime(date('y-m-d'));

    	$count['handle_order'] = M('order')->where("order_status=0 and (pay_status=1 or pay_code='cod')")->count();//待处理订单

    	$count['new_order'] = M('order')->where("add_time>$today")->count();//今天新增订单

    	$count['goods'] =  M('goods')->where("1=1")->count();//商品总数

    	$count['article'] =  M('article')->where("1=1")->count();//文章总数

    	$count['users'] = M('users')->where("1=1")->count();//会员总数

    	$count['today_login'] = M('users')->where("last_login>$today")->count();//今日访问

    	$count['new_users'] = M('users')->where("reg_time>$today")->count();//新增会员

    	$count['comment'] = M('comment')->where("is_show=0")->count();//最新评论

    	$count['store'] = M('store_apply')->where("apply_state=0")->count();//店铺审核

    	$count['bind_class'] = M('store_bind_class')->where("state=0")->count();//申请经营类目

    	$count['brand'] = M('brand')->where("status=0 and store_id>0")->count();//申请品牌
		
    	$re=M('order')->where('order_status=2 || order_status=4')->select();
    	foreach ($re as $v){
    		$count['money']+=$v['goods_price'];//订单总额
    	}
    	$res=M('remittal')->where("addtime < $today and status=1")->select();//超过600的订单额
    	foreach ($res as $v){
    		$count['moremoney']+=$v['total_amount'];
    	}
    	//统计月销售额
    	$lastmonth_start=mktime(0,0,0,date('m')-1,1,date('Y'));
    	$lastmonth_end=mktime(0,0,0,date('m'),1,date('Y'))-24*3600;
    	$where='1=1';
    	$where.=" and order_status=2 || order_status=4 ";
    	$where.=" and confirm_time >$lastmonth_start and confirm_time<$lastmonth_end";
    	$res2=M('order')->where("$where")->select();//月销售额
    	foreach ($res2 as $v){
    		$count['yuemoney']+=$v['total_amount'];
    	}
    	$this->assign('count',$count);

        return $this->fetch();

    }

    

    public function get_sys_info(){

		$sys_info['os']             = PHP_OS;

		$sys_info['zlib']           = function_exists('gzclose') ? 'YES' : 'NO';//zlib

		$sys_info['safe_mode']      = (boolean) ini_get('safe_mode') ? 'YES' : 'NO';//safe_mode = Off		

		$sys_info['timezone']       = function_exists("date_default_timezone_get") ? date_default_timezone_get() : "no_timezone";

		$sys_info['curl']			= function_exists('curl_init') ? 'YES' : 'NO';	

		$sys_info['web_server']     = $_SERVER['SERVER_SOFTWARE'];

		$sys_info['phpv']           = phpversion();

		$sys_info['ip'] 			= GetHostByName($_SERVER['SERVER_NAME']);

		$sys_info['fileupload']     = @ini_get('file_uploads') ? ini_get('upload_max_filesize') :'unknown';

		$sys_info['max_ex_time'] 	= @ini_get("max_execution_time").'s'; //脚本最大执行时间

		$sys_info['set_time_limit'] = function_exists("set_time_limit") ? true : false;

		$sys_info['domain'] 		= $_SERVER['HTTP_HOST'];

		$sys_info['memory_limit']   = ini_get('memory_limit');		

                $sys_info['version']   	    = file_get_contents(APP_PATH.'admin/conf/version.php');

		$mysqlinfo = Db::query("SELECT VERSION() as version");

		$sys_info['mysql_version']  = $mysqlinfo[0]['version'];

		if(function_exists("gd_info")){

			$gd = gd_info();

			$sys_info['gdinfo'] 	= $gd['GD Version'];

		}else {

			$sys_info['gdinfo'] 	= "未知";

		}

		return $sys_info;

    }

    

    

    public function pushVersion()

    {            

        if(!empty($_SESSION['isset_push']))

            return false;    

        $_SESSION['isset_push'] = 1;    

        error_reporting(0);//关闭所有错误报告

        $app_path = dirname($_SERVER['SCRIPT_FILENAME']).'/';

        $version_txt_path = $app_path.'/application/admin/conf/version.php';

        $curent_version = file_get_contents($version_txt_path);



        $vaules = array(            

                'domain'=>$_SERVER['SERVER_NAME'], 

                'last_domain'=>$_SERVER['SERVER_NAME'], 

                'key_num'=>$curent_version, 

                'install_time'=>INSTALL_DATE,

                'serial_number'=>SERIALNUMBER,

         );     

         $url = "http://service.tp-shop.cn/index.php?m=Home&c=Index&a=user_push&".http_build_query($vaules);

         stream_context_set_default(array('http' => array('timeout' => 3)));

         file_get_contents($url);         

    }

    

    /**

     * ajax 修改指定表数据字段  一般修改状态 比如 是否推荐 是否开启 等 图标切换的

     * table,id_name,id_value,field,value

     */

    public function changeTableVal(){  

            $table = I('table'); // 表名

            $id_name = I('id_name'); // 表主键id名

            $id_value = I('id_value'); // 表主键id值

            $field  = I('field'); // 修改哪个字段

            $value  = I('value'); // 修改字段值                        

            M($table)->where("$id_name = $id_value")->save(array($field=>$value)); // 根据条件保存修改的数据

    }
    
    /**

     * ajax 修改指定表数据字段  一般修改状态 比如 是否推荐 是否开启 等 图标切换的

     * table,id_name,id_value,field,value

     */

    public function hlchangeTableVal(){  

            $table = I('table'); // 表名

            $id_name = I('id_name'); // 表主键id名

            $id_value = I('id_value'); // 表主键id值

            $field  = I('field'); // 修改哪个字段

            $value  = I('value'); // 修改字段值                        
            if($value==1){
                M($table)->where("$id_name = $id_value")->save(array($field=>2)); // 根据条件保存修改的数据
            }

    }   	



    public function get_category(){

    	$parent_id = I('get.parent_id',0); // 商品分类 父id

    	empty($parent_id) && exit('');

    	$list = M('goods_category')->where(array('parent_id'=>$parent_id))->select();

    	// 店铺id

    	$store_id = session('store_id');

    	//如果店铺登录了

    	if($store_id)

    	{

    		$store = M('store')->where("store_id = $store_id")->find();

    		if($store['bind_all_gc'] == 0)

    		{

    			$class_id1 = M('store_bind_class')->where("store_id = $store_id and state = 1")->getField('class_1',true);

    			$class_id2 = M('store_bind_class')->where("store_id = $store_id and state = 1")->getField('class_2',true);

    			$class_id3 = M('store_bind_class')->where("store_id = $store_id and state = 1")->getField('class_3',true);

    			$class_id = array_merge($class_id1,$class_id2,$class_id3);

    			$class_id = array_unique($class_id);

    		}

    	}

    	foreach($list as $k => $v)

    	{

    		// 如果是某个店铺登录的, 那么这个店铺只能看到自己申请的分类,其余的看不到

    		if($class_id && !in_array($v['id'],$class_id))

    			continue;

    		$html .= "<option value='{$v['id']}' rel='{$v['commission']}'>{$v['name']}</option>";

    	}

    

    	exit($html);

    }

	

    public function about(){

    	return $this->fetch();

    }

}