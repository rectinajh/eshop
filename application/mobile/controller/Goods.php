<?php
namespace app\mobile\controller;

use app\common\logic\GoodsLogic;
use app\common\logic\ReplyLogic;
use app\common\logic\GoodsPromFactory;

use app\common\model\SpecGoodsPrice;
use think\AjaxPage;
use think\Page;
use think\Db;

class Goods extends MobileBase
{
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 分类列表显示
     */
    public function categoryList()
    {
        return $this->fetch();
    }
    public function ywsqings()
    {//易物申请页面
        $num = $_POST["num"];
        $erji = M("goods_category")->where(array("parent_id" => $num))->select();
        foreach ($erji as $k => $v) {
            $str .= "<option value='" . $v["id"] . "'>" . $v['name'] . "</option>";
        }
        echo $str;
    }

    public function ywsqing()
    {//易物申请页面
        $yiji = M("goods_category")->where(array("parent_id" => 850))->select();
        foreach ($yiji as $kk => $vv) {
            if ($kk < 1) {
                $erji = M("goods_category")->where(array("parent_id" => $vv["id"]))->select();
            }

        }
        $this->assign("yiji", $yiji);
        $this->assign("erji", $erji);
        return $this->fetch();

    }
    public function ywsqadd()
    {
        if ($_POST) {
            $data["original_img"] = $_POST["image1"];
            $data["goods_name"] = $_POST["goods_name"];
            $data["cat_id2"] = $_POST["cat_id2"];
            $data["cat_id3"] = $_POST["cat_id3"];
            $data["fewnew"] = $_POST["fewnew"];
            $data["store_count"] = $_POST["store_count"];
            $data["shop_price"] = $_POST["shop_price"];
            $data["exchange_integral"] = $_POST["exchange_integral"];
            $data["market_price"] = $_POST["market_price"];
            $data["keywords"] = $_POST["keywords"];
            $data["goods_remark"] = $_POST["goods_remark"];
            $data["goods_content"] = $_POST["goods_content"];
            $data["chact"] = $_POST["chact"];
            $add = M("goods")->add($data);
            if ($add) {
                $date[1]["image_url"] = $_POST["image1"];
                $date[2]["image_url"] = $_POST["image2"];
                $date[3]["image_url"] = $_POST["image3"];
                $date[4]["image_url"] = $_POST["image4"];
                $date[5]["image_url"] = $_POST["image5"];
                $i = 0;
                foreach ($date as $k => $v) {
                    $adds = M("goods_images")->add(array("image_url" => $v["image_url"], "goods_id" => $add));
                    if ($adds) {
                        $i++;
                    }
                }
                if ($i == 5) {
                    echo 1;
                } else {
                    echo 2;
                }
            }
        }
    }
    /**
     * 商品列表页
     */
    public function goodsList()
    {

        $filter_param = array(); // 帅选数组
        $id = I('get.id/d', 0); // 当前分类id
        $brand_id = I('brand_id', 0);
        //$spec = I('spec',0); // 规格
        $attr = I('attr', ''); // 属性
        $sort = I('sort', 'goods_id'); // 排序
        $sort_asc = I('sort_asc', 'asc'); // 排序
        //$sort_asc = substr($sort_asc, 0, 20);
        $price = I('price', ''); // 价钱
        $start_price = trim(I('start_price', '0')); // 输入框价钱
        $end_price = trim(I('end_price', '0')); // 输入框价钱
        $sel = trim(I('sel')); //筛选货到付款,仅看有货,促销商品
        if ($start_price && $end_price) $price = $start_price . '-' . $end_price; // 如果输入框有价钱 则使用输入框的价钱   	 
        $filter_param['id'] = $id; //加入帅选条件中
        $brand_id && ($filter_param['brand_id'] = $brand_id); //加入帅选条件中
        // $spec  && ($filter_param['spec'] = $spec); //加入帅选条件中
        $attr && ($filter_param['attr'] = $attr); //加入帅选条件中
        $price && ($filter_param['price'] = $price); //加入帅选条件中
        $sel && ($filter_param['sel'] = $sel); //加入帅选条件中

        $goodsLogic = new GoodsLogic(); // 前台商品操作逻辑类
        // 分类菜单显示
        $goodsCate = M('GoodsCategory')->where("id", $id)->find();// 当前分类
        //($goodsCate['level'] == 1) && header('Location:'.U('Home/Channel/index',array('cat_id'=>$id))); //一级分类跳转至大分类馆
        $cateArr = $goodsLogic->get_goods_cate($goodsCate);
         
        // 帅选 品牌 规格 属性 价格
        $cat_id_arr = getCatGrandson($id);
        
        //$filter_goods_id = M('goods')->where("is_on_sale=1 and cat_id in(".  implode(',', $cat_id_arr).") ")->cache(true)->getField("goods_id",true);
        if ($goodsCate)
            $filter_goods_id = M('goods')->where(" goods_state = 1 and is_on_sale=1 and cat_id{$goodsCate['level']} = $id")->cache(true)->getField("goods_id", true);
        else
            $filter_goods_id = M('goods')->where(" goods_state = 1 and is_on_sale=1 ")->cache(true)->getField("goods_id", true);      
        
        // 过滤帅选的结果集里面找商品
        if ($brand_id || $price)// 品牌或者价格
        {
            $goods_id_1 = $goodsLogic->getGoodsIdByBrandPrice($brand_id, $price); // 根据 品牌 或者 价格范围 查找所有商品id
            $filter_goods_id = array_intersect($filter_goods_id, $goods_id_1); // 获取多个帅选条件的结果 的交集
        }
        //if($spec)// 规格
        //{
        //	$goods_id_2 = $goodsLogic->getGoodsIdBySpec($spec); // 根据 规格 查找当所有商品id
        //	$filter_goods_id = array_intersect($filter_goods_id,$goods_id_2); // 获取多个帅选条件的结果 的交集
        //}
        if ($sel) {
            $goods_id_4 = $goodsLogic->getFilterSelected($sel, $cat_id_arr);
            $filter_goods_id = array_intersect($filter_goods_id, $goods_id_4);
        }
        if ($attr)// 属性
        {
            $goods_id_3 = $goodsLogic->getGoodsIdByAttr($attr); // 根据 规格 查找当所有商品id
            $filter_goods_id = array_intersect($filter_goods_id, $goods_id_3); // 获取多个帅选条件的结果 的交集
        }

        $filter_menu = $goodsLogic->get_filter_menu($filter_param, 'goodsList'); // 获取显示的帅选菜单
        $filter_price = $goodsLogic->get_filter_price($filter_goods_id, $filter_param, 'goodsList'); // 帅选的价格期间
        $filter_brand = $goodsLogic->get_filter_brand($filter_goods_id, $filter_param, 'goodsList'); // 获取指定分类下的帅选品牌
        //$filter_spec  = $goodsLogic->get_filter_spec($filter_goods_id,$filter_param,'goodsList',1); // 获取指定分类下的帅选规格
        $filter_attr = $goodsLogic->get_filter_attr($filter_goods_id, $filter_param, 'goodsList', 1); // 获取指定分类下的帅选属性

        $count = count($filter_goods_id);
        $page_count = 20;
        $page = new Page($count, $page_count);
        if ($count > 0) {
            $goods_list = M('goods')->where("goods_id in (" . implode(',', $filter_goods_id) . ")")->order($sort, $sort_asc)->limit($page->firstRow . ',' . $page->listRows)->select();

            $filter_goods_id2 = get_arr_column($goods_list, 'goods_id');

            if ($filter_goods_id2)
                $goods_images = M('goods_images')->where("goods_id in (" . implode(',', $filter_goods_id2) . ")")->cache(true)->select();
        }
        $goods_category = M('goods_category')->where('is_show=1')->cache(true)->getField('id,name,parent_id,level'); // 键值分类数组
        $point_rate = tpCache('shopping.point_rate'); //多少积分抵1元

        $this->assign('point_rate', $point_rate);
        $this->assign('goods_list', $goods_list);
        $this->assign('goods_category', $goods_category);
        $this->assign('goods_images', $goods_images);  // 相册图片
        $this->assign('filter_menu', $filter_menu);  // 帅选菜单
        //$this->assign('filter_spec',$filter_spec);  // 帅选规格
        $this->assign('filter_attr', $filter_attr);  // 帅选属性
        $this->assign('filter_brand', $filter_brand);// 列表页帅选属性 - 商品品牌
        $this->assign('filter_price', $filter_price);// 帅选的价格期间
        $this->assign('goodsCate', $goodsCate);
        $this->assign('cateArr', $cateArr);
        $this->assign('filter_param', $filter_param); // 帅选条件
        $this->assign('cat_id', $id);
        $this->assign('page', $page);// 赋值分页输出
        $this->assign('page_count', $page_count);//一页显示多少条
        $this->assign('sort_asc', $sort_asc == 'asc' ? 'desc' : 'asc');
        C('TOKEN_ON', false);

        if (request()->isAjax())
            return $this->fetch('ajaxGoodsList');
        else
            return $this->fetch();
    }

    /**
     * 商品列表页 ajax 翻页请求 搜索
     */
    public function ajaxGoodsList()
    {
        $where = '';

        $cat_id = I("id/d", 0); // 所选择的商品分类id
        if ($cat_id > 0) {
            $grandson_ids = getCatGrandson($cat_id);
            $where .= " WHERE cat_id in(" . implode(',', $grandson_ids) . ") "; // 初始化搜索条件
        }

        $result = Db::query("select count(1) as count from __PREFIX__goods $where ");
        $count = $result[0]['count'];
        $page = new AjaxPage($count, 10);

        $order = " order by goods_id desc"; // 排序
        $limit = " limit " . $page->firstRow . ',' . $page->listRows;
        $list = Db::query("select *  from __PREFIX__goods $where $order $limit");

        $this->assign('lists', $list);
        $html = $this->fetch('ajaxGoodsList'); //return $this->fetch('ajax_goods_list');
        exit($html);
    }

    /**
     * 商品详情页
     */
    public function goodsInfo()
    {
        C('TOKEN_ON', true);
        $goodsLogic = new GoodsLogic();
        $goods_id = I("get.id/d", 0);

        $Goods = new \app\common\model\Goods();
        $goods = $Goods::get($goods_id);
        $cat_id1 = $goods['cat_id1'];

        if ($goods['is_virtual'] == 1 && $goods['virtual_indate'] <= time()) {
            //虚拟商品过期，就下架
            $goods->save(['is_on_sale' => 0]);
        }
        if (empty($goods) || $goods['is_on_sale'] != 1) {
            $this->error('此商品不存在或者已下架');
        }
        $goodsPromFactory = new GoodsPromFactory();
        if (!empty($goods['prom_id']) && $goodsPromFactory->checkPromType($goods['prom_type'])) {
            $goodsPromLogic = $goodsPromFactory->makeModule($goods, null);//这里会自动更新商品活动状态，所以商品需要重新查询
            $goods = $goodsPromLogic->getGoodsInfo();//上面更新商品信息后需要查询
        }
        if (cookie('user_id')) {

            $user_id = cookie('user_id');
             //获取当前月的第一天和最后一天
            $point_day = tpCache('basic.point_day');
            $BeginDate = date('Y-m-d', strtotime(date("Y-m-d")));

            $enddate = date('Y-m-d', strtotime("$BeginDate +0 month -$point_day day"));
            $begindata = strtotime($BeginDate);
            $enddate = strtotime($enddate);
            $member_order = M('order')->where("(order_status!=3 and order_status!=5) and user_id={$user_id} and add_time > {$enddate}")->select();

            $sum = 0;
            foreach ($member_order as $k => $v) {
                $member_goods = M('order_goods')->where("order_id={$v['order_id']}")->select();
                foreach ($member_goods as $kal => $val) {

                    if ($val['goods_id'] == $goods_id) {
                        $sum += $val['goods_num'];
                    }
                }
            }

            if ($goods['shop_price'] == $goods['exchange_integral']) {

                $cart = M('cart')->where("user_id={$user_id} and goods_id={$goods_id}")->find();//查询该商品在购物车没去结算的数量
                $cart_num = $cart['goods_num'] + 0;
                if ($cart_num >= $goods['member_xianzhi']) {
                    $sum = 0;
                } else {
                    $point_day = tpCache('basic.point_day');//全积分限制天数
                    //$point_number=tpCache('basic.point_number');//全积分限制次数
                    $point_time = $point_day * 24 * 3600;
                    //查询全积分的订单
                    $res = M('order')->where("(order_status!=3 and order_status!=5) and user_id={$user_id} and order_amount=0")->order('add_time desc')->find();
                    if ($res) {
                        if ((time() - $res['add_time']) > $point_time) {
                            $pay = 1;
                        } else {
                            $no_pay = 1;
                        }
                    } else {
                        $pay = 1;
                    }
                    $car = M('cart')->where("user_id={$user_id}")->select();
                    foreach ($car as $kk => $row) {
                        if ($row['goods_price'] == $row['hcredit']) {
                            $a = 1;
                        } else {
                            $b = 1;
                        }
                    }
                    if ($no_pay || $a) {
                        $sum = 0;
                    } else {
                        $sum = $goods['member_xianzhi'] - $cart_num - $sum;
                    }

                }
            }
            $this->assign('sum', $sum);

            $goodsLogic->add_visit_log(cookie('user_id'), $goods);
        }
        if ($goods['brand_id']) {
            $brand = M('brand')->where("id ", $goods['brand_id'])->find();
            $goods['brand_name'] = $brand['name'];
        }
        $goods_images_list = M('GoodsImages')->where("goods_id", $goods_id)->select(); // 商品图册        
        $goods_attribute = M('GoodsAttribute')->getField('attr_id,attr_name'); // 查询属性
        $goods_attr_list = M('GoodsAttr')->where("goods_id", $goods_id)->select(); // 查询商品属性表                        
        $filter_spec = $goodsLogic->get_spec($goods_id);
        $spec_goods_price = M('spec_goods_price')->where("goods_id", $goods_id)->getField("key,price,store_count,item_id"); // 规格 对应 价格 库存表
        //M('Goods')->where("goods_id=$goods_id")->save(array('click_count'=>$goods['click_count']+1 )); //统计点击数
        $commentStatistics = $goodsLogic->commentStatistics($goods_id);// 获取某个商品的评论统计
        $this->assign('spec_goods_price', json_encode($spec_goods_price, true)); // 规格 对应 价格 库存表
        $goods['sale_num'] = M('order_goods')->where(['goods_id' => $goods_id, 'is_send' => 1])->count();
        $this->assign('commentStatistics', $commentStatistics);//评论概览
        $this->assign('goods_attribute', $goods_attribute);//属性值     
        $this->assign('goods_attr_list', $goods_attr_list);//属性列表
        $this->assign('filter_spec', $filter_spec);//规格参数
        $this->assign('goods_images_list', $goods_images_list);//商品缩略图
        $point_rate = tpCache('shopping.point_rate'); //多少积分抵1元
        $this->assign('point_rate', $point_rate);
        $goods['market_price'] = $goods['market_price'] ? $goods['market_price'] : $goods['shop_price']; // 仿制除数为0的情况
        $goods['discount'] = round($goods['shop_price'] / $goods['market_price'], 2) * 10;

        $this->assign('goods', $goods->toArray());
        $store = M('store')->where(array('store_id' => $goods['store_id']))->find();
        $this->assign('store', $store);
        $this->assign('cat_id1', $cat_id1);
        $user_id = cookie('user_id');
        $collect = M('goods_collect')->where(array("goods_id" => $goods_id, "user_id" => $user_id))->count();
        $this->assign('collect', $collect);
        return $this->fetch();
    }

    public function activity()
    {
        $goods_id = input('goods_id/d');//商品id
        $item_id = input('item_id/d');//规格id
        $Goods = new \app\common\model\Goods();
        $goods = $Goods::get($goods_id, '', true);
        $goodsPromFactory = new GoodsPromFactory();
        if ($goodsPromFactory->checkPromType($goods['prom_type'])) {
            //这里会自动更新商品活动状态，所以商品需要重新查询
            if ($item_id) {
                $specGoodsPrice = SpecGoodsPrice::get($item_id, '', true);
                $goodsPromLogic = $goodsPromFactory->makeModule($goods, $specGoodsPrice);
            } else {
                $goodsPromLogic = $goodsPromFactory->makeModule($goods, null);
            }
            //检查活动是否有效
            if ($goodsPromLogic->checkActivityIsAble()) {
                $goods = $goodsPromLogic->getActivityGoodsInfo();
                $goods['activity_is_on'] = 1;
                $this->ajaxReturn(['status' => 1, 'msg' => '该商品参与活动', 'result' => ['goods' => $goods]]);
            } else {
                $goods['activity_is_on'] = 0;
                $this->ajaxReturn(['status' => 1, 'msg' => '该商品没有参与活动', 'result' => ['goods' => $goods]]);
            }
        }
        $this->ajaxReturn(['status' => 1, 'msg' => '该商品没有参与活动', 'result' => ['goods' => $goods]]);
    }

    /**
     * 商品详情页
     */
    public function detail()
    {
        //  form表单提交
        C('TOKEN_ON', true);
        $goods_id = I("get.id/d", 0);
        $goods = M('Goods')->where("goods_id", $goods_id)->find();
        $this->assign('goods', $goods);
        return $this->fetch();
    }

    /*
     * 商品评论
     */
    public function comment()
    {
        $goods_id = I("goods_id/d", '0');
        $this->assign('goods_id', $goods_id);
        return $this->fetch();
    }

    /**
     * 商品评论ajax分页
     */
    public function ajaxComment()
    {
        $goods_id = I("goods_id/d", '0');
        $commentType = I('commentType', '1'); // 1 全部 2好评 3 中评 4差评 5晒图
        if ($commentType == 5) {
            $where = "c.is_show = 1 and c.goods_id = :goods_id and c.parent_id = 0 and c.img !='' and c.img NOT LIKE 'N;%' and c.deleted = 0";

        } else {
            $typeArr = array('1' => '0,1,2,3,4,5', '2' => '4,5', '3' => '3', '4' => '0,1,2');
            $where = "c.is_show = 1 and c.goods_id = :goods_id and c.parent_id = 0 and ceil(c.goods_rank) in($typeArr[$commentType]) and c.deleted = 0";
        }
        $count = Db::name('comment')->alias('c')->where($where)->bind(['goods_id' => $goods_id])->count();

        $page_count = 20;
        $page = new AjaxPage($count, $page_count);
        $list = Db::name('comment')->alias('c')
            ->field("u.head_pic,u.nickname,c.add_time,c.spec_key_name,c.content,c.is_anonymous,
                    c.impression,c.comment_id,c.zan_num,c.zan_userid,c.reply_num,c.goods_rank,
                    c.img,c.parent_id,o.pay_time")
            ->join('__USERS__ u', 'u.user_id = c.user_id', 'LEFT')
            ->join('__ORDER__ o', 'o.order_id = c.order_id', 'LEFT')
            ->where($where)
            ->bind(['goods_id' => $goods_id])
            ->order("c.add_time desc")
            ->limit($page->firstRow . ',' . $page->listRows)->select();
        $replyList = M('Comment')->where(['goods_id' => $goods_id, 'parent_id' => ['>', 0]])->order("add_time desc")->select();
        $reply_logic = new ReplyLogic();
        foreach ($list as $k => $v) {
            $list[$k]['img'] = unserialize($v['img']); // 晒单图片
            $list[$k]['parent_id'] = $reply_logic->getReplyListToArray($v['comment_id'], 5);
            $list[$k]['reply_num'] = Db::name('reply')->where(['comment_id' => $v['comment_id'], 'parent_id' => 0])->count();
        }
        $goodsLogic = new GoodsLogic();
        $commentStatistics = $goodsLogic->commentStatistics($goods_id);// 获取某个商品的评论统计
        $this->assign('commentStatistics', $commentStatistics);//评论概览
        $this->assign('commentlist', $list);// 商品评论
        $this->assign('replyList', $replyList); // 管理员回复
        $this->assign('commentType', $commentType);// 1 全部 2好评 3 中评 4差评 5晒图
        $this->assign('count', $count);//总条数
        $this->assign('user_id', cookie('user_id'));//页数
        echo $this->fetch();
    }
    
    /*
     * 获取商品规格
     */
    public function goodsAttr()
    {
        $goods_id = I("get.goods_id/d", '0');
        $goods_attribute = M('GoodsAttribute')->getField('attr_id,attr_name'); // 查询属性
        $goods_attr_list = M('GoodsAttr')->where("goods_id", $goods_id)->select(); // 查询商品属性表
        $this->assign('goods_attr_list', $goods_attr_list);
        $this->assign('goods_attribute', $goods_attribute);
        return $this->fetch();
    }

    /**
     * 积分商城
     */
    public function integralMall()
    {
        $rank = I('get.rank', '');
        $user_id = cookie('user_id');
        $p = I('get.p', '');
        $goodsLogic = new GoodsLogic();
        $result = $goodsLogic->integralMall($rank, $user_id, $p);

        $this->assign('goods_list', $result['goods_list']);
        $this->assign('point_rate', $result['point_rate']);//兑换率

        if (IS_AJAX) {
            return $this->fetch('ajaxIntegralMall'); //获取更多
        }
        return $this->fetch();
    }
    /**
     * 商品搜索列表页
     */
    public function search()
    {

        $filter_param = array(); // 帅选数组
        $id = I('get.id/d', 0); // 当前分类id
        $brand_id = I('brand_id', 0);
        $sort = I('sort', 'goods_id'); // 排序
        $sort_asc = I('sort_asc', 'asc'); // 排序
        $price = I('price', ''); // 价钱
        $start_price = trim(I('start_price', '0')); // 输入框价钱
        $end_price = trim(I('end_price', '0')); // 输入框价钱
        if ($start_price && $end_price) $price = $start_price . '-' . $end_price; // 如果输入框有价钱 则使用输入框的价钱   	 
        $filter_param['id'] = $id; //加入帅选条件中
        $brand_id && ($filter_param['brand_id'] = $brand_id); //加入帅选条件中    	    	
        $price && ($filter_param['price'] = $price); //加入帅选条件中
        $q = urldecode(trim(I('q', ''))); // 关键字搜索
        $q && ($_GET['q'] = $filter_param['q'] = $q); //加入帅选条件中
        //if(empty($q))
        //    $this->error ('请输入搜索关键词');
        $where = array(
            'goods_name' => array('like', '%' . $q . '%'),
            'goods_state' => 1,
            'is_on_sale' => 1,
        );
        $goodsLogic = new GoodsLogic(); // 前台商品操作逻辑类
        $filter_goods_id = M('goods')->where($where)->cache(true)->getField("goods_id", true);  //bind会提示绑定q失败，临时用这个测试
//    	$filter_goods_id = M('goods')->where(" goods_state = 1 and is_on_sale=1 and goods_name like :q  ")->bind(['q'=> "%{$q}%"])->cache(true)->getField("goods_id",true);

        // 过滤帅选的结果集里面找商品
        if ($brand_id || $price)// 品牌或者价格
        {
            $goods_id_1 = $goodsLogic->getGoodsIdByBrandPrice($brand_id, $price); // 根据 品牌 或者 价格范围 查找所有商品id
            $filter_goods_id = array_intersect($filter_goods_id, $goods_id_1); // 获取多个帅选条件的结果 的交集
        }

        $filter_menu = $goodsLogic->get_filter_menu($filter_param, 'search'); // 获取显示的帅选菜单
        $filter_price = $goodsLogic->get_filter_price($filter_goods_id, $filter_param, 'search'); // 帅选的价格期间
        $filter_brand = $goodsLogic->get_filter_brand($filter_goods_id, $filter_param, 'search'); // 获取指定分类下的帅选品牌

        $count = count($filter_goods_id);
        $page = new Page($count, 4);
        if ($count > 0 && $filter_goods_id > 0) {
            $goods_list = M('goods')->where("goods_id in (" . implode(',', $filter_goods_id) . ")")->order("$sort $sort_asc")->limit($page->firstRow . ',' . $page->listRows)->select();
            $filter_goods_id2 = get_arr_column($goods_list, 'goods_id');
            if ($filter_goods_id2)
                $goods_images = M('goods_images')->where("goods_id in (" . implode(',', $filter_goods_id2) . ")")->cache(true)->select();
        }
        $goods_category = M('goods_category')->where('is_show=1')->cache(true)->getField('id,name,parent_id,level'); // 键值分类数组
        $this->assign('goods_list', $goods_list);
        $this->assign('goods_category', $goods_category);
        $this->assign('goods_images', $goods_images);  // 相册图片
        $this->assign('filter_menu', $filter_menu);  // 帅选菜单
        $this->assign('filter_brand', $filter_brand);// 列表页帅选属性 - 商品品牌
        $this->assign('filter_price', $filter_price);// 帅选的价格期间
        $this->assign('filter_param', $filter_param); // 帅选条件    	
        $this->assign('page', $page);// 赋值分页输出
        $this->assign('sort_asc', $sort_asc == 'asc' ? 'desc' : 'asc');
        C('TOKEN_ON', false);

        if ($_GET['is_ajax'])
            return $this->fetch('ajaxGoodsList');
        else
            return $this->fetch();
    }

    /**
     * 回复显示页
     * @author dyr
     */
    public function reply()
    {
        $comment_id = I('get.comment_id/d', 1);
        $page = (I('get.page', 1) <= 0) ? 1 : I('get.page', 1);//页数
        $list_num = 30;//每页条数
        $reply_logic = new ReplyLogic();
        $reply_list = $reply_logic->getReplyPage($comment_id, $page - 1, $list_num);
        $page_sum = ceil($reply_list['count'] / $list_num);
        $comment_info = M('comment')->where(array('comment_id' => $comment_id))->find();
        $comment_info['img'] = unserialize($comment_info['img']);
        if (empty($comment_info)) {
            $this->error('找不到该商品');
        }
        $goods_info = M('goods')->where(array('goods_id' => $comment_info['goods_id']))->find();
        $order_info = M('order')->where(array('order_id' => $comment_info['order_id']))->find();
        $goods_rank = M('comment')->where(array('goods_id' => $comment_info['goods_id'], 'store_id' => $comment_info['store_id']))->avg('goods_rank');
        $order_goods_info = M('order_goods')->where(array('goods_id' => $comment_info['goods_id'], 'order_id' => $comment_info['order_id']))->find();
        $this->assign('goods_rank', number_format($goods_rank, 1));
        $this->assign('goods_info', $goods_info);//商品内容
        $this->assign('order_info', $order_info);//订单内容
        $this->assign('order_goods_info', $order_goods_info);//订单商品内容
        $this->assign('comment_info', $comment_info);//评价内容
        $this->assign('page_sum', intval($page_sum));//总页数
        $this->assign('page_current', intval($page));//当前页
        $this->assign('reply_count', $reply_list['count']);//总回复数
        $this->assign('reply_list', $reply_list['list']);//回复列表
        $this->assign('floor', $reply_list['count'] - (intval($page) - 1) * $list_num);//楼层
        return $this->fetch();
    }

    /**
     * 商品搜索列表页
     */
    public function ajaxSearch()
    {
        return $this->fetch();
    }

    /**
     * 用户收藏某一件商品
     * @param type $goods_id
     */
    public function collect_goods()
    {
        $goods_id = I('goods_id/d');
        $goodsLogic = new GoodsLogic();
        $result = $goodsLogic->collect_goods(cookie('user_id'), $goods_id);
        exit(json_encode($result));
    }
}