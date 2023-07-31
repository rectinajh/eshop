<?php

/**

 * 新淘链商城

 * ============================================================================

 * * 版权所有 2015-2027 新淘链，并保留所有权利。

 * 网站地址: 

 * ----------------------------------------------------------------------------

 * 这是一个商业软件，您必须购买授权才能使用.

 * 不允许对程序代码以任何形式任何目的的再发布。

 * 请支持正版, 以免引起不必要的法律纠纷.

 * ============================================================================

 * $Author:  2016-01-09

 */ 

namespace app\mobile\controller;

use app\common\logic\JssdkLogic;

use app\common\logic\StoreLogic;

use Think\Db;

class Index extends MobileBase {



    public function test(){

        

        echo " name : ".MODULE_NAME;

        

    }
	public function notice(){
        return $this->fetch();
    }
    public function notice_detail(){
        return $this->fetch();
    }
    public function index(){                
        
        $hot_goods = M('goods')->where("is_hot=1 and is_on_sale=1")->order('goods_id DESC')->limit(20)->cache(true,TPSHOP_CACHE_TIME)->select();//首页热卖商品

        $thems = M('goods_category')->where('level=1')->order('sort_order')->limit(9)->cache(true,TPSHOP_CACHE_TIME)->select();

        $this->assign('thems',$thems);

        $this->assign('hot_goods',$hot_goods);

        $favourite_goods = M('goods')->where("is_recommend=1 and is_on_sale=1")->order('goods_id DESC')->limit(20)->cache(true,TPSHOP_CACHE_TIME)->select();//首页推荐商品

        //秒杀商品

        $now_time = time();  //当前时间

        if(is_int($now_time/7200)){      //双整点时间，如：10:00, 12:00

            $start_time = $now_time;

        }else{

            $start_time = floor($now_time/7200)*7200; //取得前一个双整点时间

        }

        $end_time = $start_time+7200;   //结束时间
        
        $point_rate = tpCache('shopping.point_rate'); //多少积分抵1元

        $this->assign('point_rate', $point_rate);

        $flash_sale_list = M('goods')->alias('g')

            ->field('g.goods_id,f.price,s.item_id')

            ->join('__FLASH_SALE__ f','g.goods_id = f.goods_id','LEFT')

            ->join('__SPEC_GOODS_PRICE__ s','s.prom_id = f.id AND g.goods_id = s.goods_id','LEFT')

            ->where('f.status', 1)

            ->where("f.start_time = '{$start_time}' and f.end_time = '{$end_time}'")

            ->limit(3)->select();
       
		$flash=M('tlflash')->where('is_open=1')->order('addtime desc')->select();
      
        $article = M('article')->where("open_type = 0")->order('article_id desc')->select();
        $this->assign('article', $article);
      
        $this->assign('flash',$flash);
        $this->assign('flash_sale_list',$flash_sale_list);

        $this->assign('start_time',$start_time);

        $this->assign('end_time',$end_time);

        $this->assign('favourite_goods',$favourite_goods);

        return $this->fetch();

    }


    /**

     * 分类列表显示

     */

    public function categoryList(){

        return $this->fetch();

    }



    /**

     * 模板列表

     */

    public function mobanlist(){

        $arr = glob("D:/wamp/www/svn_tpshop/mobile--html/*.html");

        foreach($arr as $key => $val)

        {

            $html = end(explode('/', $val));

            echo "<a href='http://www.php.com/svn_tpshop/mobile--html/{$html}' target='_blank'>{$html}</a> <br/>";            

        }        

    }

    

    /**

     * 商品列表页

     */

    public function goodsList(){

        $id = I('get.id/d',0); // 当前分类id

        $lists = getCatGrandson($id);

        $this->assign('lists',$lists);

        return $this->fetch();

    }

    

    public function ajaxGetMore(){

    	$p = I('p/d',1);

    	$favourite_goods = M('goods')->where("is_recommend=1 and is_on_sale=1  and goods_state = 1 ")->order('sort DESC')->page($p,10)->cache(true,TPSHOP_CACHE_TIME)->select();//首页推荐商品

    	$this->assign('favourite_goods',$favourite_goods);

    	echo $this->fetch();

    }



    /**

     * 店铺街

     * @author dyr

     * @time 2016/08/15

     */

    public function street()

    {

        $store_class = M('store_class')->where('')->select();

        $this->assign('store_class', $store_class);//店铺分类

        return $this->fetch();

    }



    /**

     * ajax 获取店铺街

     */

    public function ajaxStreetList()

    {

        $p = I('p',1);

        $sc_id = I('get.sc_id/d',0);

        $province_id = I('province_id');

        $city_id = I('city_id');

        $district_id = I('district_id');

        $order = I('order', 0);

        $user_id = cookie('user_id') ? cookie('user_id'):0;

        if (empty($province_id) && empty($city_id) && empty($district_id) && $sc_id != 0) {

            $province_id = cookie('province_id');

            $city_id =  cookie('city_id');

            $district_id =  cookie('district_id');

        }

        //地区ID,目前搜索时只精确到市

        $address=['province_id'=>$province_id, 'city_id'=>$city_id, 'district_id'=>$district_id];

        $storeLogic = new StoreLogic();

        $store_list = $storeLogic->getStreetList($sc_id,$p,10, $order, $user_id,$address);

        foreach($store_list as $key=>$value){

            $store_list[$key]['goods_array'] = $storeLogic->getStoreGoods($value['store_id'],3);

        }

        $this->assign('province_id', $province_id);

        $this->assign('city_id', $city_id);

        $this->assign('district_id', $district_id);

        $this->assign('store_list',$store_list);

        echo $this->fetch();

      

    }



    /**

     * 品牌街

     * @author dyr

     * @time 2016/08/15

     */

    public function brand()

    {

        $brand_where['status'] = 0;

        $brand_where['is_hot'] = 1;

        $goods = M('goods')->field('goods_id,shop_price,market_price')->where(['is_on_sale'=> 1,'is_recommend'=>1])->limit(3)->order('sort desc')->select();

        $brand_list = M('brand')->field('id,name,logo,url')->order(array('sort'=>'desc'))->cache(true)->where($brand_where)->select();

        for($i=0;$i<3;$i++)

        {

           $Goods_group[]= array_slice($goods, $i * 3 ,3);//每三个一组，取三组

            if(!empty($Goods_group[$i])){ //去掉空的

                $recommendGoods=$Goods_group;

            }

        }

        $this->assign('brand_list', $brand_list);//品牌列表

        $this->assign('recommendGoods', $recommendGoods);//品牌列表

        return $this->fetch();

    }

    

    //微信Jssdk 操作类 用分享朋友圈 JS

    public function ajaxGetWxConfig(){

    	$askUrl = I('askUrl');//分享URL

    	$weixin_config = M('wx_user')->find(); //获取微信配置

    	$jssdk = new JssdkLogic($weixin_config['appid'], $weixin_config['appsecret']);

    	$signPackage = $jssdk->GetSignPackage(urldecode($askUrl));

    	if($signPackage){

    		$this->ajaxReturn($signPackage,'JSON');

    	}else{

    		return false;

    	}

    }
    //扫码支付页面
    public function giveshopmoney(){
        echo $this->user_id;
        die;
        if($this->user_id){
            if(IS_POST){
                $model=M('users');
                if($_POST['type']==0){
                    show_message('请选择支付方式', L('back_up_page'), url('Mobile/Index/giveshopmoney'), 'info');
                }
                if($_POST['code'] != $_SESSION['gm_code'] ){
                    $_SESSION['gm_code'] = $_POST['code'];
                    $seller_id = (isset($_POST['seller_id']) ? intval($_POST['seller_id']) : '0');
                    $makemoney = (isset($_POST['makemoney']) ? intval($_POST['makemoney']) : '0');
                    //客户信息
                    $userinfo=$model->where("user_id",$this->user_id)->find();
                    if(empty($makemoney)){
                        show_message('请输入金额', L('back_up_page'), url('Mobile/Index/giveshopmoney'), 'info');
                    }
                    if($userinfo['user_money']<$makemoney){
                        show_message('余额不足', url('Mobile/Index/giveshopmoney'), 'info');
                    }else{
                        //商家信息
                        $seller=M('seller')->where('seller_id',$seller_id)->find();
                        
                        $shopInfo=$model->where('user_id',$seller['user_id'])->find();
                        //商家余额增加
                        $user_rs=$model->where('user_id',$shopInfo['user_id'])->setInc('user_money',$makemoney);
                        //会员余额减少
                        $user_rs=$model->where('user_id',$this->user_id)->setDec('user_money',$makemoney);
                        //积分增加
                        $user_re=$model->where('user_id',$this->user_id)->setInc('pay_points',$makemoney);
                        
                        if($user_rs && $user_re){
                            //会员信息添加到account_log表中
                            $data['user_id']=$this->user_id;
                            $data['user_money']=-$makemoney;
                            $data['change_time']=time();
                            $data['desc']='下单消费';
                            $data['order_sn']=date('Ymd',time()).(time()+mt_rand(1,5));
                            M("AccountLog")->add($data);
                            $datas['user_id']=$this->user_id;
                            $datas['pay_points']=$makemoney;
                            $datas['change_time']=time();
                            $datas['desc']='下单赠送积分';
                            $datas['order_sn']=$data['order_sn'];
                            M("AccountLog")->add($datas);
                            if($userinfo['oauth']== 'weixin')
                            {
                                $wx_user = M('wx_user')->find();
                                $jssdk = new JssdkLogic($wx_user['appid'],$wx_user['appsecret']);
                                $wx_content = "你刚刚下了一笔订单:{$datas['order_sn']}!";
                                $jssdk->push_msg($user['openid'],$wx_content);
                            }
                            //商家余额增加
                            $data['user_id']=$seller['user_id'];
                            $data['user_money']=-$makemoney;
                            $data['change_time']=time();
                            $data['desc']='收款成功';
                            $data['order_sn']=$data['order_sn'];
                             M("AccountLog")->add($datas);
                            //用户下单, 发送短信给商家
                            $res = checkEnableSendSms("3");

                            if($res && $res['status'] ==1){
                                $store =M('store')->where('store_id',$seller['store_id']);
                                $sender = (!empty($store) && !empty($store['service_phone'])) ? $store['service_phone'] : false;
                                $params = array('consignee'=>$userinfo['nickname'] , 'mobile' => $userinfo['mobile']);
                                $resp = sendSms("3", $sender, $params);
                            }
                            show_message('付款成功', '', url('user/lettercredit/source'), 'info');
                        }

                    }
                }else{
                    show_message('请刷新重试', '', url('user/lettercredit/giveshopmoneyone'), 'info');
                }
            }
        // $nick_name = $_GET['n'];
        // $mobile_phone = $_GET['p'];
        // $user_id = $_GET['u'];
        // $this->assign('code', rand(100000,999999));
        // $this->assign('mobile_phone', $mobile_phone);
        // $this->assign('nick_name', $nick_name);
        // $this->assign('user_id', $user_id);
        echo 111;
        die;
        return $this->fetch();
        }else{
            header('Location: ' . url('Mobile/user/login'));
        }  
    }
}