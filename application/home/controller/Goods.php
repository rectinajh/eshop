<?php
namespace app\home\controller;





use app\common\logic\CommentLogic;

use app\common\logic\GoodsPromFactory;

use app\common\logic\SearchWordLogic;

use app\common\logic\StoreLogic;

use app\common\logic\GoodsLogic;

use app\common\logic\ReplyLogic;

use app\common\model\SpecGoodsPrice;

use think\AjaxPage;

use think\Cookie;

use think\Db;

use think\Page;

use think\Verify;





class Goods extends Base

{

    public function index()

    {

        return $this->fetch();

    }



    

    /**

     * 商品详情页

     */

    public function goodsInfo()

    {

        //  form表单提交

        C('TOKEN_ON', true);

        $goodsLogic = new GoodsLogic();

        $goodsPromFactory = new GoodsPromFactory();

        $goods_id = I("get.id/d", 0);
        $user_id=cookie('user_id');
        
        $Goods = new \app\common\model\Goods();

        $goods = $Goods::get($goods_id);     
		
        if ($goods['is_virtual']==1 && $goods['virtual_indate'] <= time()) {

            //虚拟商品过期，就下架

            $goods->save(['is_on_sale'=>0]);

        }

        if (empty($goods) || ($goods['is_on_sale'] != 1) && I('identity')!='admin') {

            $this->error('该商品已经下架', U('Index/index'));

        }

        if (!empty($goods['prom_id']) && $goodsPromFactory->checkPromType($goods['prom_type'])) {

            $goodsPromLogic = $goodsPromFactory->makeModule($goods, null);//这里会自动更新商品活动状态，所以商品需要重新查询

            $goods = $goodsPromLogic->getGoodsInfo();//上面更新商品信息后需要查询

        }
       
        if (cookie('user_id')) {
	
            $goodsLogic->add_visit_log(cookie('user_id'), $goods);
            $user_id=cookie('user_id');
            //获取当前月的第一天和最后一天
            $point_day=tpCache('basic.point_day');
            $BeginDate=date('Y-m-d', strtotime(date("Y-m-d")));
            
            $enddate=date('Y-m-d', strtotime("$BeginDate +0 month -$point_day day"));
            $begindata=strtotime($BeginDate);
            $enddate=strtotime($enddate);
            $member_order= M('order')->where("(order_status!=3 and order_status!=5) and user_id={$user_id} and add_time > {$enddate}")->select();
           
            $sum=0;
            foreach ($member_order as $k=>$v){
            	$member_goods=M('order_goods')->where("order_id={$v['order_id']}")->select();
            	foreach ($member_goods as $kal=>$val){
            		if($val['goods_id']==$goods_id){
            			$sum+=$val['goods_num'];
            		}
            	}
            }
         
         if($goods['shop_price']==$goods['exchange_integral']){
        		
        		$cart=M('cart')->where("user_id={$user_id} and goods_id={$goods_id}")->find();//查询该商品在购物车没去结算的数量
        		$cart_num=$cart['goods_num']+0;
        		if($cart_num>=$goods['member_xianzhi']){
        			$sum=0;
        		}else{
        			$point_day=tpCache('basic.point_day');//全积分限制天数
        			//$point_number=tpCache('basic.point_number');//全积分限制次数
        			$point_time=$point_day*24*3600;
        			//查询全积分的订单
        			$res=M('order')->where("(order_status!=3 and order_status!=5) and user_id={$user_id} and order_amount=0")->order('add_time desc')->find();
        			if($res){
        				if((time()-$res['add_time'])>$point_time){
        					$pay=1;
        				}else{
        					$no_pay=1;
        				}
        			}else{
        				$pay=1;
        			}
        			$car=M('cart')->where("user_id={$user_id}")->select();
        			foreach ($car as $kk=>$row){
        				if($row['goods_price']==$row['hcredit']){
        					$a=1;
        				}else{
        					$b=1;
        				}
        			}
        			if($no_pay || $a){
        				$sum=0;
        			}else{
        				$sum=$goods['member_xianzhi']-$cart_num-$sum;
        			}
        			
        		}
          }
          $this->assign('sum',$sum);
        }
		
        if ($goods['brand_id']) {

            $brand = M('brand')->where("id", $goods['brand_id'])->find();

            $goods['brand_name'] = $brand['name'];

            $this->assign('brand', $brand);

        }

        $goods_images_list = M('GoodsImages')->where(array('goods_id' => $goods_id))->order("img_sort asc")->select(); // 商品 图册

        $goods_attribute = M('GoodsAttribute')->getField('attr_id,attr_name'); // 查询属性

        $goods_attr_list = M('GoodsAttr')->where("goods_id", $goods_id)->select(); // 查询商品属性表

        $filter_spec = $goodsLogic->get_spec($goods_id);

        $point_rate = tpCache('shopping.point_rate');

        $spec_goods_price = M('spec_goods_price')->where(array('goods_id' => $goods_id))->getField("key,item_id,price,store_count"); // 规格 对应 价格 库存表

        M('Goods')->where("goods_id", $goods_id)->save(array('click_count' => $goods['click_count'] + 1)); //统计点击数

        $commentStatistics = $goodsLogic->commentStatistics($goods_id);// 获取某个商品的评论统计

        $store_logic = new StoreLogic();

        $commentStoreStatistics = $store_logic->storeCommentStatistics($goods['store_id']);//获取商家的评论统计

        $goodsTotalComment = $goodsLogic->getGoodsTotalComment($goods_id); //获取商品达人评价

        $store = M('store')->where(array('store_id' => $goods['store_id']))->find();

        $comparisonStoreStatistics = $store_logic->storeComparison($store['sc_id']);//获取业内的评论统计

        $comparisonStatistics = $store_logic->storeMatch($comparisonStoreStatistics, $comparisonStoreStatistics);//获取商家的评论统计

        $store_goods_class_list = M('store_goods_class')->where(array('store_id' => $goods['store_id']))->cache(true)->select();

        if ($store_goods_class_list) {

            $sub_cat = $main_cat = array();

            foreach ($store_goods_class_list as $val) {

                if ($val['parent_id'] == 0) {

                    $main_cat[] = $val;

                } else {

                    $sub_cat[$val['parent_id']][] = $val;

                }

            }

            $this->assign('main_cat', $main_cat);

            $this->assign('sub_cat', $sub_cat);

        }

        $region_id = Cookie::get('district_id');

        if ($region_id) {

            $dispatching = $goodsLogic->getGoodsDispatching($goods['goods_id'], $region_id);

            $this->assign('dispatching', $dispatching);

        }

        $commentLogic = new CommentLogic();

        $goodsCommentList = $commentLogic->getGoodsComment($goods_id, 1);

        $this->assign('commentlist', $goodsCommentList['list']);// 商品评论

        $this->assign('page', $goodsCommentList['page']);// 赋值分页输出

        $this->assign('commentStoreStatistics', $commentStoreStatistics); // 商家评论概览

        $this->assign('commentStoreStatistics', $commentStoreStatistics); // 商家评论概览

        $this->assign('commentStoreStatistics', $commentStoreStatistics); // 商家评论概览

        $this->assign('spec_goods_price', json_encode($spec_goods_price, true)); // 规格 对应 价格 库存表

        $this->assign('navigate_goods', navigate_goods($goods_id, 1));// 面包屑导航

        $this->assign('commentStatistics', $commentStatistics);//评论概览

        $this->assign('goods_attribute', $goods_attribute);//属性值

        $this->assign('goods_attr_list', $goods_attr_list);//属性列表

        $this->assign('filter_spec', $filter_spec);//规格参数

        $this->assign('goods_images_list', $goods_images_list);//商品缩略图

        $this->assign('siblings_cate', $goodsLogic->get_siblings_cate($goods['cat_id2']));//相关分类

        $this->assign('look_see', $goodsLogic->get_look_see($goods));//看了又看

        $this->assign('goods', $goods->toArray());

        $this->assign('point_rate', $point_rate);

        $this->assign('goodsTotalComment', $goodsTotalComment);

        $this->assign('comparisonStoreStatistics', $comparisonStoreStatistics); // 行业评论概览

        $this->assign('comparisonStatistics', $comparisonStatistics); // 商家行业百分比
       
        $this->assign('store', $store);

        return $this->fetch();

    }



    public function activity(){

        $goods_id = input('goods_id/d');//商品id

        $item_id = input('item_id/d');//规格id

        $Goods = new \app\common\model\Goods();

        $goods = $Goods::get($goods_id,'',true);

        $goodsPromFactory = new GoodsPromFactory();

        if ($goodsPromFactory->checkPromType($goods['prom_type'])) {

            //这里会自动更新商品活动状态，所以商品需要重新查询

            if($item_id){

                $specGoodsPrice = SpecGoodsPrice::get($item_id,'',true);

                $goodsPromLogic = $goodsPromFactory->makeModule($goods,$specGoodsPrice);

            }else{

                $goodsPromLogic = $goodsPromFactory->makeModule($goods,null);

            }

            //检查活动是否有效

            if($goodsPromLogic->checkActivityIsAble()){

                $goods = $goodsPromLogic->getActivityGoodsInfo();

                $goods['activity_is_on'] = 1;

                $this->ajaxReturn(['status'=>1,'msg'=>'该商品参与活动','result'=>['goods'=>$goods]]);

            }else{

                $goods['activity_is_on'] = 0;

                $this->ajaxReturn(['status'=>1,'msg'=>'该商品没有参与活动','result'=>['goods'=>$goods]]);

            }

        }

        $this->ajaxReturn(['status'=>1,'msg'=>'该商品没有参与活动','result'=>['goods'=>$goods]]);

    }



    /**

     *  查询配送地址，并执行回调函数

     */

    public function region()

    {

        $fid = I('fid/d');

        $callback = I('callback');



        $parent_region_code = $parent_region = Db::name('region')->field('id,name')->where(array('parent_id' => $fid))->cache(true)->select();

        foreach($parent_region_code as $key=>$val){

            $parent_region_code[$key]['name'] = urlencode($val['name']);

        }

//        Cookie::set('parent_region', $parent_region_code);

        echo $callback . '(' . json_encode($parent_region) . ')';

        exit;

    }



    /**

     * 商品物流配送和运费

     */

    public function dispatching()

    {        

        $goods_id = I('goods_id/d');//143

        $region_id = I('region_id/d');//28242

        $dispatching_data = S("goods_dispatching_{$goods_id}_$region_id");

        if($dispatching_data)

           $this->ajaxReturn($dispatching_data);         

        

        $goods_logic = new GoodsLogic();

        $dispatching_data = $goods_logic->getGoodsDispatching($goods_id, $region_id);

        S("goods_dispatching_{$goods_id}_$region_id", $dispatching_data ,60);

        $this->ajaxReturn($dispatching_data);

    }

        

    /**

     * 商品列表页

     */

    public function goodsList()

    {



        $key = md5($_SERVER['REQUEST_URI'] . $_POST['start_price'] . '_' . $_POST['end_price']);

        $html = S($key);

        if (!empty($html)) {

            exit($html);

        }



        $filter_param = array(); // 帅选数组                        

        $id = I('get.id/d', 0); // 当前分类id

        $brand_id = I('get.brand_id',0);



        $own_shop = I('get.own_shop/d', 0);     //自营商品

        $recommend = I('get.recommend/d', 0);    //推荐商品

        $stock = I('get.stock/d', 0);    //显示有货

        $promotion = I('get.promotion/d', 0);    //促销商品

        

        //$spec = I('get.spec',0); // 规格 

        $attr = I('get.attr', ''); // 属性

        $sort = I('get.sort', 'goods_id'); // 排序

        $sort_asc = I('get.sort_asc', 'asc'); // 排序

        $price = I('get.price', ''); // 价钱

        $start_price = trim(I('post.start_price', '0')); // 输入框价钱

        $end_price = trim(I('post.end_price', '0')); // 输入框价钱

        if ($start_price && $end_price) $price = $start_price . '-' . $end_price; // 如果输入框有价钱 则使用输入框的价钱



        $filter_param['id'] = $id; //加入帅选条件中                       

        $brand_id && ($filter_param['brand_id'] = $brand_id); //加入帅选条件中

        //$spec  && ($filter_param['spec'] = $spec); //加入帅选条件中

        $attr && ($filter_param['attr'] = $attr); //加入帅选条件中

        $price && ($filter_param['price'] = $price); //加入帅选条件中



        $goodsLogic = new GoodsLogic(); // 前台商品操作逻辑类



        // 分类菜单显示

        $goodsCate = M('GoodsCategory')->where("id", $id)->find();// 当前分类

        //($goodsCate['level'] == 1) && header('Location:'.U('Home/Channel/index',array('cat_id'=>$id))); //一级分类跳转至大分类馆

        $cateArr = $goodsLogic->get_goods_cate($goodsCate);



        // 帅选 品牌 规格 属性 价格

        //$cat_id_arr = getCatGrandson ($id);        

        if ($goodsCate) {

            $filter_goods_id = M('goods')->where(['is_on_sale' => 1, 'goods_state' => 1, 'cat_id' . $goodsCate['level'] => $id])->cache(true)->getField("goods_id", true);

        } else {

            $filter_goods_id = M('goods')->where("is_on_sale=1 and goods_state = 1")->cache(true)->getField("goods_id", true);

        }

        $this->assign('filter_goods_id_str', implode(',', $filter_goods_id) ? implode(',', $filter_goods_id) : 0);

        // 过滤筛选的结果集里面找商品

        if ($brand_id || $price)// 品牌或者价格

        {

            $goods_id_1 = $goodsLogic->getGoodsIdByBrandPrice($brand_id, $price); // 根据 品牌 或者 价格范围 查找所有商品id

            $filter_goods_id = array_intersect($filter_goods_id, $goods_id_1); // 获取多个帅选条件的结果 的交集

        }

        

        if ($own_shop || $recommend || $stock || $promotion)// 自营商品 , 是否推荐 , 促销商品 , 显示有货

        {

            $goods_id_1 = $goodsLogic->getGoodsIdByCheckbox($own_shop, $recommend, $promotion, $stock);//根据自营商品 , 是否推荐 , 促销商品 , 显示有货 条件帅选出 商品id

            $filter_goods_id = array_intersect($filter_goods_id, $goods_id_1); // 获取多个帅选条件的结果 的交集

        }

        

        //if($spec)// 规格

        //{

        //    $goods_id_2 = $goodsLogic->getGoodsIdBySpec($spec); // 根据 规格 查找当所有商品id

        //    $filter_goods_id = array_intersect($filter_goods_id,$goods_id_2); // 获取多个帅选条件的结果 的交集

        //}

        if ($attr)// 属性

        {

            $goods_id_3 = $goodsLogic->getGoodsIdByAttr($attr); // 根据 规格 查找当所有商品id

            $filter_goods_id = array_intersect($filter_goods_id, $goods_id_3); // 获取多个帅选条件的结果 的交集

        }



        // 如果商品id 过多 分多次查询

        $s = 1000;

        $p = count($filter_goods_id)/$s;

        $p = ceil($p); 

        $filter_price = $filter_brand = $filter_attr = [];

        for($i=0; $i<$p; $i++)

        {   

            $start =  $p * $s;

            $filter_goods_id2 = array_slice($filter_goods_id,$p,$s);            

            

            $filter_price2 = $goodsLogic->get_filter_price($filter_goods_id2, $filter_param, 'goodsList'); // 帅选的价格期间

            $filter_price = array_merge($filter_price,$filter_price2);

            $filter_price = array_unique($filter_price);

            

            $filter_brand2 = $goodsLogic->get_filter_brand($filter_goods_id2, $filter_param, 'goodsList'); // 获取指定分类下的帅选品牌            

            $filter_brand = array_merge($filter_brand,$filter_brand2);

            $filter_brand = array_unique($filter_brand);            

            

            $filter_attr2 = $goodsLogic->get_filter_attr($filter_goods_id2, $filter_param, 'goodsList', 1); // 获取指定分类下的帅选属性

            $filter_attr = array_merge($filter_attr,$filter_attr2);

            $filter_attr = array_unique($filter_attr);             

  

        }    

        

        $filter_menu = $goodsLogic->get_filter_menu($filter_param, 'goodsList'); // 获取显示的帅选菜单

        

        $count = count($filter_goods_id);

        $page = new Page($count, 40);

        if ($count > 0) {
            $goods_list = M('goods')->alias('g')

            ->join('__STORE__ s', 's.store_id = g.store_id')

            ->where("goods_id", "in", implode(',', $filter_goods_id))

            ->order("$sort $sort_asc")->limit($page->firstRow . ',' . $page->listRows)->select();
            
        }
            

            $filter_goods_id2 = get_arr_column($goods_list, 'goods_id');

            if ($filter_goods_id2)

                $goods_images = M('goods_images')->where("goods_id", "in", implode(',', $filter_goods_id2))->cache(true)->select();

        $goods_category = M('goods_category')->where('is_show=1')->cache(true)->getField('id,name,parent_id,level'); // 键值分类数组

        $navigate_cat = navigate_goods($id); // 面包屑导航
        $point_rate = tpCache('shopping.point_rate'); //多少积分抵1元
        $this->assign('point_rate', $point_rate);
        $this->assign('goods_list', $goods_list);

        $this->assign('navigate_cat', $navigate_cat);

        $this->assign('goods_category', $goods_category);

        $this->assign('goods_images', $goods_images);  // 相册图片

        $this->assign('filter_menu', $filter_menu);  // 帅选菜单

        //$this->assign('filter_spec', $filter_spec);  // 帅选规格

        $this->assign('filter_attr', $filter_attr);  // 帅选属性

        $this->assign('filter_brand', $filter_brand);  // 列表页帅选属性 - 商品品牌

        $this->assign('filter_price', $filter_price);// 帅选的价格期间

        $this->assign('goodsCate', $goodsCate);

        $this->assign('cateArr', $cateArr);

        $this->assign('filter_param', $filter_param); // 帅选条件

        $this->assign('cat_id', $id);

        $this->assign('page', $page);// 赋值分页输出

        C('TOKEN_ON', false);

        $html = $this->fetch();

        S($key, $html);

        echo $html;

    }



    /**

     * @author dyr

     * 回复显示页

     */

    public function reply()

    {

        $comment_id = I('get.comment_id/d', 1);

        $page = (I('get.page', 1) <= 0) ? 1 : I('get.page', 1);//页数

        $list_num = 10;//每页条数

        $reply_logic = new ReplyLogic();

        $reply_list = $reply_logic->getReplyPage($comment_id, $page - 1, $list_num);

        $page_sum = ceil($reply_list['count'] / $list_num);

        $comment_info = M('comment')->where(array('comment_id' => $comment_id))->find();

        if (empty($comment_info)) {

            $this->error('找不到该商品');

        }

        $comment_info['img'] = unserialize($comment_info['img']);

        $goods_info = M('goods')->where(array('goods_id' => $comment_info['goods_id']))->find();

        $order_info = M('order')->where(array('order_id' => $comment_info['order_id']))->find();

        $goods_rank = M('comment')->where(array('goods_id' => $comment_info['goods_id'], 'store_id' => $comment_info['store_id']))->avg('goods_rank');

        $order_goods_info = M('order_goods')->where(array('goods_id' => $comment_info['goods_id'], 'order_id' => $comment_info['order_id']))->find();

        $this->assign('goods_rank', number_format($goods_rank, 1));

        $this->assign('goods_info', $goods_info);

        $this->assign('order_info', $order_info);

        $this->assign('order_goods_info', $order_goods_info);

        $this->assign('comment_info', $comment_info);

        $this->assign('page_sum', intval($page_sum));//总页数

        $this->assign('page_current', intval($page));//当前页

        $this->assign('reply_count', $reply_list['count']);//总回复数

        $this->assign('reply_list', $reply_list['list']);//回复列表

        return $this->fetch();

    }



    /**

     * @author dyr

     * 获取回复

     */

    public function ajaxReply()

    {

        $comment_id = I('post.comment_id/d', 1);

        $reply_logic = new ReplyLogic();

        $reply_list = $reply_logic->getReplyListToArray($comment_id, 4);

        exit(json_encode($reply_list));

    }





    /**

     * 商品搜索列表页

     */

    public function search()

    {

        //C('URL_MODEL',0);

        $filter_param = array(); // 帅选数组                        

        $id = I('get.id/d', 0); // 当前分类id

        $brand_id = I('brand_id', 0);



        $own_shop = I('get.own_shop/d', 0);     //自营商品

        $recommend = I('get.recommend/d', 0);    //推荐商品

        $stock = I('get.stock/d', 0);    //显示有货

        $promotion = I('get.promotion/d', 0);    //促销商品



        $sort = I('sort', 'goods_id'); // 排序

        $sort_asc = I('sort_asc', 'asc'); // 排序

        $price = I('price', ''); // 价钱

        $start_price = trim(I('start_price', '0')); // 输入框价钱

        $end_price = trim(I('end_price', '0')); // 输入框价钱

        $store_id = I('store_id/d');

        if ($start_price && $end_price) $price = $start_price . '-' . $end_price; // 如果输入框有价钱 则使用输入框的价钱

        $q = urldecode(trim(I('q', ''))); // 关键字搜索

//        empty($q) && $this->error('请输入搜索词');

        $id && ($filter_param['id'] = $id); //加入帅选条件中

        $brand_id && ($filter_param['brand_id'] = $brand_id); //加入帅选条件中

        $price && ($filter_param['price'] = $price); //加入帅选条件中

        $q && ($_GET['q'] = $filter_param['q'] = $q); //加入帅选条件中



        $goodsLogic = new GoodsLogic(); // 前台商品操作逻辑类

        $SearchWordLogic = new SearchWordLogic();

        $where = $SearchWordLogic->getSearchWordWhere($q);

        $where['is_on_sale'] = 1;

        $where['goods_state'] = 1;

        if ($store_id) {

            $where['store_id'] = $store_id;

        }

        Db::name('search_word')->where('keywords', $q)->setInc('search_num');

        $goodsHaveSearchWord = Db::name('goods')->where($where)->count();

        if ($goodsHaveSearchWord) {

            $SearchWordIsHave = Db::name('search_word')->where('keywords',$q)->find();

            if($SearchWordIsHave){

                Db::name('search_word')->where('id',$SearchWordIsHave['id'])->update(['goods_num'=>$goodsHaveSearchWord]);

            }else{

                $SearchWordData = [

                    'keywords' => $q,

                    'pinyin_full' => $SearchWordLogic->getPinyinFull($q),

                    'pinyin_simple' => $SearchWordLogic->getPinyinSimple($q),

                    'search_num' => 1,

                    'goods_num' => $goodsHaveSearchWord

                ];

                Db::name('search_word')->insert($SearchWordData);

            }

        }

        if ($id) {

            // 分类菜单显示

            $goodsCate = M('GoodsCategory')->where("id", $id)->find();// 当前分类

//            $cat_id_arr = getCatGrandson ($id);

            $where['cat_id' . $goodsCate['level']] = $id;

        }



        $search_goods = M('goods')->where($where)->getField('goods_id,cat_id3');

        $filter_goods_id = array_keys($search_goods);

        $filter_cat_id = array_unique($search_goods); // 分类需要去重

        if ($filter_cat_id) {

            $cateArr = M('goods_category')->where("id", "in", implode(',', $filter_cat_id))->select();

            $tmp = $filter_param;

            foreach ($cateArr as $k => $v) {

                $tmp['id'] = $v['id'];

                $cateArr[$k]['href'] = U("/Home/Goods/search", $tmp);

            }

        }

        // 过滤帅选的结果集里面找商品        

        if ($brand_id || $price)// 品牌或者价格

        {

            $goods_id_1 = $goodsLogic->getGoodsIdByBrandPrice($brand_id, $price); // 根据 品牌 或者 价格范围 查找所有商品id

            $filter_goods_id = array_intersect($filter_goods_id, $goods_id_1); // 获取多个帅选条件的结果 的交集

        }

        $this->assign('filter_goods_id_str', implode(',', $filter_goods_id) ? implode(',', $filter_goods_id) :1);

        if ($own_shop || $recommend || $stock || $promotion)// 自营商品 , 是否推荐 , 促销商品 , 显示有货

        {

            $goods_id_1 = $goodsLogic->getGoodsIdByCheckbox($own_shop, $recommend, $promotion, $stock);//根据自营商品 , 是否推荐 , 促销商品 , 显示有货 条件帅选出 商品id

            $filter_goods_id = array_intersect($filter_goods_id, $goods_id_1); // 获取多个帅选条件的结果 的交集

        }

        $filter_menu = $goodsLogic->get_filter_menu($filter_param, 'search'); // 获取显示的帅选菜单

        $filter_price = $goodsLogic->get_filter_price($filter_goods_id, $filter_param, 'search'); // 帅选的价格期间

        $filter_brand = $goodsLogic->get_filter_brand($filter_goods_id, $filter_param, 'search'); // 获取指定分类下的帅选品牌



        $count = count($filter_goods_id);

        $page = new Page($count, 20);

        if ($count > 0) {

            $goods_list = M('goods')->where(['is_on_sale' => 1, 'goods_id' => ['in', implode(',', $filter_goods_id)]])->order("$sort $sort_asc")->limit($page->firstRow . ',' . $page->listRows)->select();

            $filter_goods_id2 = get_arr_column($goods_list, 'goods_id');

            if ($filter_goods_id2)

                $goods_images = M('goods_images')->where("goods_id", "in", implode(',', $filter_goods_id2))->select();

        }



        $this->assign('goods_list', $goods_list);

        $this->assign('goods_images', $goods_images);  // 相册图片

        $this->assign('filter_menu', $filter_menu);  // 帅选菜单

        $this->assign('filter_brand', $filter_brand);  // 列表页帅选属性 - 商品品牌

        $this->assign('filter_price', $filter_price);// 帅选的价格期间

        $this->assign('cateArr', $cateArr);

        $this->assign('filter_param', $filter_param); // 帅选条件

        $this->assign('cat_id', $id);

        $this->assign('q', I('q'));

        $this->assign('page', $page);// 赋值分页输出

        C('TOKEN_ON', false);

        return $this->fetch();

    }



    /**

     * 商品咨询ajax分页

     */

    public function ajax_consult()

    {

        $goods_id = I("goods_id/d", '0');

        $consult_type = I('consult_type', '0'); // 0全部咨询  1 商品咨询 2 支付咨询 3 配送 4 售后



        $where = ['parent_id' => 0, 'goods_id' => $goods_id];

        if ($consult_type > 0) {

            $where['consult_type'] = $consult_type;

        }



        $count = M('GoodsConsult')->where($where)->count();

        $page = new AjaxPage($count, 5);

        $show = $page->show();

        $list = M('GoodsConsult')->where($where)->order("id desc")->limit($page->firstRow . ',' . $page->listRows)->select();

        $replyList = M('GoodsConsult')->where("parent_id > 0")->order("id desc")->select();



        $this->assign('consultCount', $count);// 商品咨询数量

        $this->assign('consultList', $list);// 商品咨询

        $this->assign('replyList', $replyList); // 管理员回复

        $this->assign('page', $show);// 赋值分页输出

        return $this->fetch();

    }



    /**

     * @author dyr

     * 商品评论ajax分页

     */

    public function ajaxComment()

    {

        $goods_id = I("goods_id/d", '0');

        $commentType = I('commentType', '1'); // 1 全部 2好评 3 中评 4差评 5晒图

        $commentLogic = new CommentLogic();

        $goodsCommentList = $commentLogic->getGoodsComment($goods_id, $commentType);

        $this->assign('commentlist', $goodsCommentList['list']);// 商品评论

//        $this->assign('replyList', $replyList); // 管理员回复

        $this->assign('page', $goodsCommentList['page']);// 赋值分页输出

        return $this->fetch();

    }





    /**

     *  商品咨询

     */

    public function goodsConsult()

    {

        //  form表单提交

        C('TOKEN_ON', true);

        $goods_id = I("goods_id/d", '0'); // 商品id

        $consult_type = I("consult_type", '1'); // 商品咨询类型

        $username = I("username", 'TPshop用户'); // 网友咨询

        $content = I("content"); // 咨询内容



        $verify = new Verify();

        if (!$verify->check(I('post.verify_code'), 'consult')) {

            $this->error("验证码错误");

        }



        $goodsConsult = M('goodsConsult');

        if (!$goodsConsult->autoCheckToken($_POST)) {

            $this->error('你已经提交过了!', U('/Home/Goods/goodsInfo', array('id' => $goods_id)));

            exit;

        }



        $data = array(

            'goods_id' => $goods_id,

            'consult_type' => $consult_type,

            'username' => $username,

            'content' => $content,

            'add_time' => time(),

        );

        $goodsConsult->add($data);

        $this->success('咨询已提交!', U('/Home/Goods/goodsInfo', array('id' => $goods_id)));

    }



    /**

     * 用户收藏某一件商品

     */

    public function collect_goods()

    {

        $goods_id = I('goods_id/d');

        $goodsLogic = new GoodsLogic();

        $result = $goodsLogic->collect_goods(cookie('user_id'), $goods_id);

        exit(json_encode($result));

    }



    public function collects(){

        $goods_ids = I('goods_ids/a',[]);

        if(empty($goods_ids)){

            $this->ajaxReturn(['status'=>0,'msg'=>'请至少选择一个商品','result'=>'']);

        }

        $goodsLogic = new GoodsLogic();

        $result = [];

        foreach($goods_ids as $key=>$val){

            $result[] = $goodsLogic->collect_goods(cookie('user_id'), $val);

        }

        $this->ajaxReturn(['status'=>1,'msg'=>'已添加至我的收藏','result'=>$result]);

    }



    /**

     * 加入购物车弹出

     */

    public function open_add_cart()

    {

        return $this->fetch();

    }



    public function integralMall()

    {

        $cat_id = I('get.id/d');
		
        $minValue = I('get.minValue');

        $maxValue = I('get.maxValue');

        $brandType = I('get.brandType');

        $point_rate = tpCache('shopping.point_rate'); //多少积分抵1元

        $exchange = I('get.exchange', 0);

        $goods_where = ' is_on_sale = 1 and exchange_integral > 0 ';

        //积分兑换筛选

        $exchange_integral_where_array = array(array('gt', 0));

        // 分类id

        if (!empty($cat_id)) {

            $store_id_arr = M('store')->where(array('sc_id' => $cat_id))->cache(true, TPSHOP_CACHE_TIME)->getField('store_id', true);

            if (!empty($store_id_arr)) {

                $store_id_str = implode($store_id_arr, ',');

                $goods_where.=" and store_id in ($store_id_str) ";

            } else {

                $goods_where .= " and store_id = -1 ";

            }

        }

        //积分截止范围

        if (!empty($maxValue)) {

            $goods_where .= " and exchange_integral >= $minValue";

        }

        //积分起始范围

        if (!empty($minValue)) {

            $goods_where .= " and exchange_integral >= $minValue";

        }

        //积分+金额

        if ($brandType == 1) {

            $goods_where .= " and exchange_integral < shop_price * $point_rate ";

        }

        //全部积分

        if ($brandType == 2) {

            $goods_where .= " and exchange_integral = shop_price * $point_rate ";

        }

        //我能兑换

        

       /*  $user_id = cookie('user_id');

        if ($exchange == 1 && !empty($user_id)) {

            $user_pay_points = intval(M('users')->where(array('user_id' => $user_id))->getField('pay_points'));

            if ($user_pay_points !== false) {

                array_push($exchange_integral_where_array, array('lt', $user_pay_points));

            }

        }         

         $goods_where['exchange_integral'] = $exchange_integral_where_array; */

        

        

        $goods_list_count = Db::name('goods')->cache(true)->where($goods_where)->count();
		
        $page = new Page($goods_list_count, 10);
		
        $goods_list = M('goods')

            ->cache(true)

            ->where($goods_where)

            ->limit($page->firstRow . ',' . $page->listRows)

            ->select();
        
		
        $store_category = M('store_class')->cache(true)->select();


		
        $this->assign('goods_list', $goods_list);

        $this->assign('page', $page->show());

        $this->assign('goods_list_count', $goods_list_count);

        $this->assign('store_category', $store_category);//商品1级分类

        $this->assign('point_rate', $point_rate);//兑换率

        $this->assign('pages', $page);

        return $this->fetch();

    }



    /**

     * 全部商品分类

     * @author lxl

     * @time17-4-18

     */

    public function all_category(){

        return $this->fetch();

    }



    /**

     * 全部品牌列表

     * @author lxl

     * @time17-4-18

     */

    public function all_brand(){

        return $this->fetch();

    }
    public function ywsqings(){//易物申请页面
                $num=$_POST["num"];
                $erji=M("goods_category")->where(array("parent_id"=>$num))->select();
                foreach($erji as $k=>$v){
                    $str.="<option value='".$v["id"]."'>".$v['name']."</option>";
                }
                echo $str;
        }
    /*
    *会员添加易物区商品
    */
    public function add_goods(){

        $goods_id = I('goods_id/d', 0);
        $goods_cat_id3 = I('cat_id3/d', 0);
        $user_id=cookie('user_id');
        if(!$user_id){
            $this->error("请先登录", U('User/login'));
        }
        //查找易物区下所有分类
        $cat_id1=850;
        $yiji=M("goods_category")->where(array("parent_id"=>850))->select();
            foreach($yiji as $kk=>$vv){
                if($kk < 1){
                    $erji=M("goods_category")->where(array("parent_id"=>$vv["id"]))->select();
                }
                
            }

        if($goods_id){
            $goods = M('goods')->where(['goods_id' => $goods_id, 'ywuser_id' => $user_id])->find();

            if(empty($goods)){

                $this->error("非法操作", U('Goods/goodsList'));

            }else{
                
                $imgs=M('goods_images')->where('goods_id',$goods_id)->select();
                $this->assign('imgs', $imgs);  // 商品缩略图
                $this->assign('goodsInfo', $goods);  // 商品详情
            }

        }
        $this->initEditor(); // 编辑器
        $this->assign('user_id',$user_id);
        $this->assign('erji',$erji);
        $this->assign('yiji',$yiji);
        return $this->fetch();
    }
    /**

     * 商品保存

     */

    public function save(){

        // 数据验证

        $data =input('post.');

        $goods_id = input('post.goods_id')?I('goods_id'):0;

        $car_id11 = input('post.car_id1');

        $car_id22 = input('post.car_id2');

        $car_id33 = input('post.car_id3');

        $spec_goods_item = input('post.item/a',[]);

        $store_count = input('post.store_count');

        $user_id = input('post.user_id');

        $pay_points=input('post.exchange_integral');

        $data['shop_price']=$pay_points;
        $data['ywuser_id']=$user_id;

        if($goods_id){

            $Goods = M('goods')->where(array('goods_id' => $goods_id,'ywuser_id'=>$user_id))->find();

            if(empty($Goods)){

                $this->ajaxReturn(array('status' => 0, 'msg' => '非法操作','result'=>''));

            }

        }else{

            $data['on_time']=time();
            $data['goods_state']=0;
            $data['is_on_sale']=1;
            $data['is_own_shop']=0;
            $data['goods_type']=0;
        }
        
        if ($goods_id > 0) {

            $update = M('goods')->where('goods_id',$goods_id)->save($data); // 写入数据到数据库

            // 更新成功后删除缩略图

            if($update !== false){

                // 修改商品后购物车的商品价格也修改一下

                Db::name('cart')->where("goods_id", $goods_id)->where("spec_key = ''")->save(
                    array(

                    'market_price' => $Goods['cost_price'], //成本价

                    'goods_price' => $Goods['shop_price'], // 售价

                    'member_goods_price'=>$Goods['exchange_integral']));

                delFile("./public/upload/goods/thumb/$goods_id", true);

            }

        } else {
    
           
            $goods_id = M('goods')->insertGetId($data);

        }
        $this->afterSave($goods_id, $user_id);

        //$GoodsLogic = new GoodsLogic();

        //$GoodsLogic->saveGoodsAttr($goods_id, $type_id); // 处理商品 属性

        $this->ajaxReturn([ 'status' => 1, 'msg' => '操作成功', 'result' => ['goods_id'=>$goods_id]]);

    }

    /**

     * 初始化编辑器链接

     * 本编辑器参考 地址 http://fex.baidu.com/ueditor/

     */

    private function initEditor()

    {

        $this->assign("URL_upload", U('Admin/Ueditor/imageUp', array('savepath' => 'goods'))); // 图片上传目录

        $this->assign("URL_imageUp", U('Admin/Ueditor/imageUp', array('savepath' => 'article'))); //  不知道啥图片

        $this->assign("URL_fileUp", U('Admin/Ueditor/fileUp', array('savepath' => 'article'))); // 文件上传s

        $this->assign("URL_scrawlUp", U('Admin/Ueditor/scrawlUp', array('savepath' => 'article')));  //  图片流

        $this->assign("URL_getRemoteImage", U('Admin/Ueditor/getRemoteImage', array('savepath' => 'article'))); // 远程图片管理

        $this->assign("URL_imageManager", U('Admin/Ueditor/imageManager', array('savepath' => 'article'))); // 图片管理

        $this->assign("URL_getMovie", U('Admin/Ueditor/getMovie', array('savepath' => 'article'))); // 视频上传

        $this->assign("URL_Home", "");

    }
    /**

     * 后置操作方法

     * 自定义的一个函数 用于数据保存后做的相应处理操作, 使用时手动调用

     * @param int $goods_id 商品id

     * @param int $store_id 店铺id

     */

    public function afterSave($goods_id,$ywuser_id)

    {

        // 商品货号


        $goods_sn = "TP".str_pad($goods_id,7,"0",STR_PAD_LEFT);

        M('goods')->where("goods_id",$goods_id)->save(array("goods_sn"=>$goods_sn)); // 根据条件更新记录

        $goods_images = I('goods_images/a');

        $img_sorts = I('img_sorts/a');

        $original_img = I('original_img');

        $item_img = I('item_img/a');


        // 商品图片相册  图册

        if(count($goods_images) > 1)

        {

            array_pop($goods_images); // 弹出最后一个

            $goodsImagesArr = M('GoodsImages')->where("goods_id = $goods_id")->getField('img_id,image_url'); // 查出所有已经存在的图片



            // 删除图片

            foreach($goodsImagesArr as $key => $val)

            {

                if(!in_array($val, $goods_images)){

                    M('GoodsImages')->where("img_id = {$key}")->delete();



                    //同时删除物理文件

                    $filename = $val;

                    $filename= str_replace('../','',$filename);

                    $filename= trim($filename,'.');

                    $filename= trim($filename,'/');

                    $is_exists = file_exists($filename);



                    //同时删除物理文件

                    if($is_exists){

                        //unlink($filename);

                    }

                }

            }

            $goodsImagesArrRever = array_flip($goodsImagesArr);

            // 添加图片

            foreach($goods_images as $key => $val)

            {

                $sort = $img_sorts[$key];

                if($val == null)  continue;

                if(!in_array($val, $goodsImagesArr))

                {

                    $data = array( 'goods_id' => $goods_id,'image_url' => $val , 'img_sort'=>$sort);

                    M("GoodsImages")->insert($data); // 实例化User对象

                }else{

                    $img_id = $goodsImagesArrRever[$val];

                    //修改图片顺序

                    M('GoodsImages')->where("img_id = {$img_id}")->save(array('img_sort' => $sort));

                }

            }

        }



        // 查看主图是否已经存在相册中

        $c = M('GoodsImages')->where("goods_id = $goods_id and image_url = '{$original_img}'")->count();



        //@modify by wangqh fix:修复删除商品详情的图片(相册图刚好是主图时)删除的图片仍然在相册中显示. 如果主图存物理图片存在才添加到相册 @{

        $deal_orignal_img = str_replace('../','',$original_img);

        $deal_orignal_img= trim($deal_orignal_img,'.');

        $deal_orignal_img= trim($deal_orignal_img,'/');

        if($c == 0 && $original_img && file_exists($deal_orignal_img))//@}

        {

            M("GoodsImages")->add(array('goods_id'=>$goods_id,'image_url'=>$original_img));

        }

        //delFile("./public/upload/goods/thumb/$goods_id"); // 删除缩略图

        //delFile("./runtime");

        \think\Cache::clear();

        // 商品规格价钱处理

        $item = I('item/a');

        M("SpecGoodsPrice")->where('goods_id = '.$goods_id)->delete(); // 删除原有的价格规格对象



        if($item)

        {

            $store_count = 0 ;

            foreach($item as $k => $v)

            {

                //批量添加数据

                $v['price'] = trim($v['price']);

                $store_count += $v['store_count'] ; // 记录商品总库存

                $v['sku'] = trim($v['sku']);



                $data = array('goods_id'=>$goods_id,'key'=>$k,'key_name'=>$v['key_name'],'price'=>$v['price'],'store_count'=>$v['store_count'],'sku'=>$v['sku'],'ywuser_id'=>$ywuser_id);

                if ($item_img) {

                    $spec_key_arr = explode('_',$k);

                    foreach ($item_img as $key => $val) {

                        if(in_array($key,$spec_key_arr)){

                            $data['spec_img'] = $val;

                            break;

                        }

                    }

                }

                $dataList[] = $data;

                // 修改商品后购物车的商品价格也修改一下

                M('cart')->where("goods_id = $goods_id and spec_key = '$k'")->save(array(

                    'market_price'=>$v['price'], //市场价

                    'goods_price'=>$v['price'], // 本店价

                    'member_goods_price'=>$v['price'], // 会员折扣价

                ));

            }

            M("SpecGoodsPrice")->insertAll($dataList);

            //记录库存修改日志

            $goods_stock = $this->where(array('goods_id'=>$goods_id))->getField('store_count');

            if($store_count != $goods_stock){

                $stock = $store_count - $goods_stock;

                update_stock_log($ywuser_id, $stock,array('goods_id'=>$goods_id,'goods_name'=>$_POST['goods_name'],'ywuser_id'=>$ywuser_id));

            }

        }



        // 商品规格图片处理

        if($item_img)

        {

            M('SpecImage')->where("goods_id = $goods_id")->delete(); // 把原来是删除再重新插入

            foreach ($item_img as $key => $val)

            {

                M('SpecImage')->insert(array('goods_id'=>$goods_id ,'spec_image_id'=>$key,'src'=>$val,'ywuser_id'=>$ywuser_id));

            }

        }

        refresh_stock($goods_id); // 刷新商品库存

    }

}