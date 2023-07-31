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

 * Date: 2016-05-28

 */



namespace app\mobile\controller;



class Store extends MobileBase {

	public $store = array();

	public $user_id = '';



	public function _initialize() {

	    parent::_initialize();

		$store_id = I('store_id/d');

		if(empty($store_id)){

			$this->error('参数错误,店铺系列号不能为空',U('Index/index'));

		}

		$store = M('store')->where(array('store_id'=>$store_id))->find();

		if($store){

			if($store['store_state'] == 0){

				$this->error('该店铺不存在或者已关闭', U('Index/index'));

			}

			$store['mb_slide'] = explode(',', $store['mb_slide']);

			$store['mb_slide_url'] = explode(',', $store['mb_slide_url']);

            $store_province = M('region')->where(array('id' => $store['province_id']))->getField('name');

            $store_city = M('region')->where(array('id' => $store['city_id']))->getField('name');

            $store_district = M('region')->where(array('id' => $store['district_id']))->getField('name');

            $store['region'] =$store_province.'，'.$store_city.'，'.$store_district;

			$this->store = $store;

			$this->assign('store',$store);

		}else{

			$this->error('该店铺不存在或者已关闭',U('Index/index'));

		}

		

		if (session('?user')) {

			$user = session('user');

			$this->user_id = $user['user_id'];

			$this->assign('user', $user); //存储用户信息

		}

	}

	

	public function index(){

		//热门商品排行

		$hot_goods = M('goods')->field('goods_content',true)->where(array('store_id'=>$this->store['store_id'],'is_hot'=>1,'is_on_sale'=>1))->order('sales_sum desc')->limit(10)->select();

		//新品

		$new_goods = M('goods')->field('goods_content',true)->where(array('store_id'=>$this->store['store_id'],'is_new'=>1,'is_on_sale'=>1))->order('goods_id desc')->limit(10)->select();

		//推荐商品

		$recomend_goods = M('goods')->field('goods_content',true)

            ->where(array('store_id'=>$this->store['store_id'],'is_recommend'=>1))

            ->order('goods_id desc')->limit(10)->select();

		//所有商品

		$total_goods = M('goods')->where(array('store_id'=>$this->store['store_id'],'is_on_sale'=>1))->count();

        //用户是否收藏

        $user_collect = M('store_collect')->where(['user_id' => $this->user_id, 'store_id' => $this->store['store_id']])->count();

        $this->assign('user_collect',$user_collect);

		$this->assign('hot_goods',$hot_goods);

		$this->assign('new_goods',$new_goods);

		$this->assign('recomend_goods',$recomend_goods);

		$this->assign('total_goods',$total_goods);

		return $this->fetch();

	}

	

	public function goods_list(){

		$cat_id = I('cat_id/d', 0);

        $status = I('sta');  //商品状态

		$p = I('p', '1');

        $sort = I('sort','goods_id'); // 排序条件

        $sort_asc = I('sort_asc','asc'); // 排序

		$keywords = I('keywords');

		$map = ['store_id' => $this->store['store_id'], 'is_on_sale' => 1]; //店铺上架的商品

		$cat_name = "全部商品";

		if ($cat_id > 0) {  //分类

			$cat_name = M('store_goods_class')->where(array('cat_id' => $cat_id))->getField('cat_name');

		}

		if($keywords){  //搜索商品

			$map['goods_name'] = array('like',"%$keywords%");

		}

        if($status){

            $map["$status"]=1;

        }

		$filter_goods_id = M('goods')->where($map)->where(function($query) use($cat_id){

		    if ($cat_id > 0) {

		        $query->where("store_cat_id1",$cat_id)->whereOr("store_cat_id2" , $cat_id);;

		    }else{

		        $query->where("1=1");

		    }

		})->getField("goods_id", true);

		$count = count($filter_goods_id);

		$page_count = 10;//每页多少个商品

		if ($count > 0 && $filter_goods_id>0) {

			$goods_list = M('goods')->where("goods_id in (" . implode(',', $filter_goods_id) . ")")

                ->order("$sort $sort_asc")

                ->page($p,$page_count)->select();

		}



		$this->assign('sort', $sort);

		$this->assign('cat_id', $cat_id);

		$this->assign('sta', $status);

		$this->assign('sort', $sort);

        $sort_asc = ($sort_asc=='asc') ? 'desc' :'asc';

		$this->assign('sort_asc', $sort_asc);

		$this->assign('keywords', $keywords);

		$this->assign('goods_list', $goods_list);

		$this->assign('cat_name', $cat_name);

		$this->assign('goods_list_total_count',$count);

		$this->assign('page_count',$page_count);

		if(IS_AJAX){

			echo $this->fetch('ajaxGoodsList');

		}else{

			echo $this->fetch();

		}

	}

	

	public function about(){

		$total_goods = M('goods')->where(array('store_id'=>$this->store['store_id'],'is_on_sale'=>1))->count();

		$this->assign('total_goods',$total_goods);

		return $this->fetch();

	}

	

	public function store_goods_class(){

		$store_goods_class_list = M('store_goods_class')->where(array('store_id'=>$this->store['store_id']))->select();

		if($store_goods_class_list){

			$sub_cat = $main_cat = array();

			foreach ($store_goods_class_list as $val){

			    if ($val['parent_id'] == 0) {

                    $main_cat[] = $val;

                } else {

                    $sub_cat[$val['parent_id']][] = $val;

                }

			}

			$this->assign('main_cat',$main_cat);

			$this->assign('sub_cat',$sub_cat);

		}

		return $this->fetch();

	}

	/**
     * 生成我的收款二维码
     */
    public function qrcode(){
        $store = M('store')->where(array('store_id'=>$this->store['store_id']))->find();
        $seller = M('seller')->where(array('seller_name'=>$store['seller_name']))->find();
        $info=M('users')->where(array('user_id'=>$seller['user_id']))->find();
        $ur=url('Mobile/User/giveshopmoney');
        $urs = explode("?",$ur);
        $url = url('/', '', true, true).'Mobile/User/giveshopmoney'.'?'.$urs[1]. 'u=' . $seller['seller_id'] .'&n=' . $seller['seller_name'].'&p='.$info['mobile'];
          Vendor('phpqrcode.phpqrcode');
        //生成二维码图片
        $object = new \QRcode();
        $save_path ='public/sj_qrimg/';  //图片存储的绝对路径
        if (!file_exists($save_path)){
            mkdir($save_path,0777,true);
        }
        $level=3;
        $size=4;
        $errorCorrectionLevel =intval($level) ;//容错级别
        $matrixPointSize = intval($size);//生成图片大小
        $filename = $save_path."{$info['mobile']}".'_'."{$seller['seller_id']}".'.png';

        if(!file_exists($filename)){
            $object->png($url,$filename, $errorCorrectionLevel, $matrixPointSize, 2);
        }
        $filenames='/'.$filename;
        $this->assign('pic',$filenames);
        return $this->fetch();
    }  

}