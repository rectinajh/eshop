<?php
namespace app\mobile\controller;

use app\common\logic\CartLogic;
use app\common\logic\CouponLogic;
use app\common\logic\OrderLogic;
use think\Db;

class Cart extends MobileBase
{
    public $user_id = 0;
    public $user = array();
    /**
     * 构造函数
     */
    public function __construct()
    {
        parent::__construct();
        if (session('?user')) {
            $user = session('user');
    
            $user = M('users')->where("user_id", $user['user_id'])->find();
            session('user', $user);  //覆盖session 中的 user
            $this->user = $user;
            $this->user_id = $user['user_id'];
            $this->assign('user', $user); //存储用户信息
        }
    }
    public function index()
    {
        $cartLogic = new CartLogic();
        $cartLogic->setUserId($this->user_id);
        $cartList = $cartLogic->getCartList();//用户购物车
        $cartGoodsList = get_arr_column($cartList, 'goods');
        $goodsid = get_arr_column($cartGoodsList, 'goods_id'); //获取商品Id
        $cartGoodsCatsId = get_arr_column($cartGoodsList, 'cat_id1'); //获取商品分类的Id
        $member_xianzhi = get_arr_column($cartGoodsList, 'member_xianzhi'); //会员限制数量
        $exchange_integral = get_arr_column($cartGoodsList, 'exchange_integral'); //积分
        $this->assign('cartGoodsCatsId', $cartGoodsCatsId[0]);
        //购物车中的商品分类是否为易物区（850）
        if ($this->user_id) {
            $user_id = $this->user_id;
            $BeginDate = date('Y-m-01', strtotime(date("Y-m-d")));
            $enddate = date('Y-m-d', strtotime("$BeginDate +1 month -1 day"));
            $begindata = strtotime($BeginDate);
            $enddate = strtotime($enddate);
            $member_order = M('order')->where("(order_status!=3 and order_status!=5) and user_id={$user_id} and add_time > {$begindata} and add_time < {$enddate}")->select();
            $sum = 0;
            $cum = 0;
            foreach ($member_order as $k => $v) {
                $member_goods = M('order_goods')->where("order_id={$v['order_id']}")->select();
                foreach ($member_goods as $kal => $val) {
                    if ($val['goods_id'] == $goodsid[0]) {
                        $sum += $val['goods_num'];
                    }
                }
            }
            if ($goodsid[0]) {
                $cart = M('cart')->where("user_id={$user_id} and goods_id={$goodsid[0]}")->find();//查询该商品在购物车没去结算的数量
                if ($cart) {
                    if ($sum == 0) {
                        $cum = $cart['goods_num'];
                    } else {
                        $qum = $sum + $cart['goods_num'];
                    }
                }
            }
            if ($qum >= $member_xianzhi[0]) {
                $sum = $member_xianzhi[0] - $sum;
            } else if ($cum == $member_xianzhi[0]) {
                $sum = $member_xianzhi[0];
            } else {
                $sum = $member_xianzhi[0] - $qum;
            }
            $this->assign('sum', $sum);
            $this->assign('member_xianzhi', $member_xianzhi[0]);
            $this->assign('exchange_integral', $exchange_integral[0]);
        }
        $cartList = $cartLogic->getStoreCartList($cartList);//
        $userCartGoodsTypeNum = $cartLogic->getUserCartGoodsTypeNum();//获取用户购物车商品总数
        $this->assign('userCartGoodsTypeNum', $userCartGoodsTypeNum);
        $this->assign('storeCartList', $cartList);//购物车列表
        return $this->fetch();
    }
    /**
     * 更新购物车，并返回计算结果
     */
    public function AsyncUpdateCart()
    {
        $cart = input('cart/a', []);
        $cartLogic = new CartLogic();
        $cartLogic->setUserId($this->user_id);
        $result = $cartLogic->AsyncUpdateCart($cart);
        $this->ajaxReturn($result);
    }
    /**
     *  购物车加减
     */
    public function changeNum()
    {
        $cart = input('cart/a', []);
        if (empty($cart)) {
            $this->ajaxReturn(['status' => 0, 'msg' => '请选择要更改的商品', 'result' => '']);
        }
        $cartLogic = new CartLogic();
        $result = $cartLogic->changeNum($cart['id'], $cart['goods_num']);
        $this->ajaxReturn($result);
    }
    /**
     * 删除购物车商品
     */
    public function delete()
    {
        $cart_ids = input('cart_ids/a', []);
        $cartLogic = new CartLogic();
        $cartLogic->setUserId($this->user_id);
        $result = $cartLogic->delete($cart_ids);
        if ($result !== false) {
            $this->ajaxReturn(['status' => 1, 'msg' => '删除成功', 'result' => $result]);
        } else {
            $this->ajaxReturn(['status' => 0, 'msg' => '删除失败', 'result' => $result]);
        }
    }
    public function getStoreCoupon()
    {
        $store_ids = input('store_ids/a', []);
        $goods_ids = input('goods_ids/a', []);
        $goods_category_ids = input('goods_category_ids/a', []);
        if (empty($store_ids) && empty($goods_ids) && empty($goods_category_ids)) {
            $this->ajaxReturn(['status' => 0, 'msg' => '获取失败', 'result' => '']);
        }
        $CouponLogic = new CouponLogic();
        $newStoreCoupon = $CouponLogic->getStoreGoodsCoupon($store_ids, $goods_ids, $goods_category_ids);
        if ($newStoreCoupon) {
            $user_coupon = Db::name('coupon_list')->where('uid', $this->user_id)->getField('cid', true);
            foreach ($newStoreCoupon as $key => $val) {
                if (in_array($newStoreCoupon[$key]['id'], $user_coupon)) {
                    $newStoreCoupon[$key]['is_get'] = 1;//已领取
                } else {
                    $newStoreCoupon[$key]['is_get'] = 0;//未领取
                }
            }
        }
        $this->ajaxReturn(['status' => 1, 'msg' => '获取成功', 'result' => $newStoreCoupon]);
    }
    /**
     * ajax 将商品加入购物车
     */
    function AjaxAddCart()
    {
        $goods_id = I("goods_id/d"); // 商品id
        $goods_num = I("goods_num/d");// 商品数量
        $item_id = I("item_id/d"); // 商品规格id
        $member_xianzhi = I("member_xianzhi/d"); // 商品限制
        $goodsCat = M('goods')->where('goods_id', $goods_id)->getField('cat_id1');//查询商品的分类
        $u_goods = M('goods')->where('goods_id', $goods_id)->find();
        if (empty($goods_id)) {
            $this->ajaxReturn(['status' => -1, 'msg' => '请选择要购买的商品', 'result' => '']);
        }
        if ($u_goods['shop_price'] == $u_goods['exchange_integral']) {
            if (empty($goods_num)) {
                $this->ajaxReturn(['status' => -1, 'msg' => "本商品为全积分购买，每人限购{$member_xianzhi}件", 'result' => '']);
            }
        } else {
            if (empty($goods_num)) {
                $this->ajaxReturn(['status' => -1, 'msg' => '购买商品数量不能为0', 'result' => '']);
            }
        }
        $cartLogic = new CartLogic();
        $couponLogic = new CouponLogic();
        if ($u_goods['shop_price'] == $u_goods['exchange_integral']) {
            $result = $cartLogic->cha_cart($this->user_id, $goods_id);
            if ($this->user_id) {
                $user_id = $this->user_id;
                $point_day = tpCache('basic.point_day');
                $BeginDate = date('Y-m-01', strtotime(date("Y-m-d")));
                $enddate = date('Y-m-d', strtotime("$BeginDate +1 month -1 day"));
                $begindata = strtotime($BeginDate);
                $enddate = strtotime($enddate);
                $point_time = $point_day * 24 * 3600;
        		//$member_order= M('order')->where("(order_status!=3 and order_status!=5) and user_id={$user_id} and add_time > {$begindata} and add_time < {$enddate}")->select();
                $sum = 0;
        		/* foreach ($member_order as $k=>$v){
        			$member_goods=M('order_goods')->where("order_id={$v['order_id']}")->select();
        			foreach ($member_goods as $kal=>$val){
        				if($val['goods_id']==$goods_id){
        					$sum+=$val['goods_num'];
        				}
        			}
        			
        		} */
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
            }
            if ($no_pay) {
                $this->ajaxReturn(['status' => -1, 'msg' => "本商品为全积分购买，每人限购{$member_xianzhi}件", 'result' => '']);
            }
        }
        $cartLogic->setUserId($this->user_id);
        $cartLogic->setGoodsModel($goods_id);
        if ($item_id) {
            $cartLogic->setSpecGoodsPriceModel($item_id);
        }
        $cartLogic->setGoodsBuyNum($goods_num);
        if ($cartLogic->getUserCartGoodsTypeNum() > 0) {
            $cartList = $cartLogic->getCartList(0); // 获取用户购物车中的商品
            $cartGoodsList = get_arr_column($cartList, 'goods');
            $cartCageId = get_arr_column($cartGoodsList, 'cat_id1'); //获取z购物车中商品分类的Id
            // foreach ($cartCageId as $v) {
            //     if ($v != $goodsCat) {
            //         $this->ajaxReturn(['status' => -1, 'msg' => '购物车中还有其它未处理商品', 'result' => '']);
            //     }
            // }
        }
        $result = $cartLogic->addGoodsToCart();
        exit(json_encode($result));
    }
    /**
     * 购物车第二步确定页面
     */
    public function cart2()
    {
        if ($this->user_id == 0)
            $this->error('请先登录', U('Mobile/User/login'));
        $is_users = M('users')->where(array('user_id' => $this->user_id))->find();
        $address_id = I('address_id/d');
        if ($address_id)
            $address = M('user_address')->where("address_id", $address_id)->find();
        else
            $address = M('user_address')->where(["user_id" => $this->user_id, "is_default" => 1])->find();
        if (empty($address)) {
            header("Location: " . U('Mobile/User/add_address', array('source' => 'cart2')));
            exit;
        } else {
            $this->assign('address', $address);
        }
        $cartLogic = new CartLogic();
        $cartLogic->setUserId($this->user_id);
        if ($cartLogic->getUserCartOrderCount() == 0)
            $this->error('你的购物车没有选中商品', 'Cart/index');
        $result = $cartLogic->getUserCartList(1); // 获取购物车商品
        $pay_points = 0;
        foreach ($result['cartList'] as $k => $v) {
            $goods_id = $v['goods_id'];
            $re = M('goods')->where("goods_id={$goods_id}")->find();
            if ($re['shop_price'] == $re['exchange_integral']) {
                $flash_sale = M('flash_sale')->where("goods_id ={$goods_id}")->find();
                $pay_points += $flash_sale['price'] * $v['goods_num'];
            } else {
                $pay_points += $v['hcredit'] * $v['goods_num'];
            }
        }
        $this->assign('pay_points', $pay_points);
        $this->assign('re', $re);
        if ($this->user_id) {
            $user_id = $this->user_id;
            $is_usercenter = M('users')->where("user_id={$user_id}")->find();
            $this->assign('is_usercenter', $is_usercenter);
        	//获取当前月的第一天和最后一天
            $BeginDate = date('Y-m-01', strtotime(date("Y-m-d")));
            $enddate = date('Y-m-d', strtotime("$BeginDate +1 month -1 day"));
            $begindata = strtotime($BeginDate);
            $enddate = strtotime($enddate);
            $member_order = M('order')->where("(order_status!=3 and order_status!=5) and user_id={$user_id} and add_time > {$begindata} and add_time < {$enddate}")->select();
            $sum = 0;
            foreach ($member_order as $k => $v) {
                $member_goods = M('order_goods')->where("order_id={$v['order_id']}")->select();
                foreach ($member_goods as $kal => $val) {
                    if ($val['goods_id'] == $goods_id) {
                        $sum += $val['goods_num'];
                    }
                }
            }
            if ($sum >= $re['member_xianzhi']) {
                $sum = 0;
            } else {
                $sum = $re['member_xianzhi'] - $sum;
            }
            $this->assign('sum', $sum);
        }
        $store_id_arr = M('cart')->where("user_id = {$this->user_id} and selected = 1")->getField('store_id', true); // 获取所有店铺id
        $storeList = M('store')->where("store_id in (" . implode(',', $store_id_arr) . ")")->cache(true, TPSHOP_CACHE_TIME)->select(); // 找出所有商品对应的店铺id
        $shippingList = M('shipping_area')
            ->field('shipping_area_id,shipping_code,store_id')
            ->where(" store_id in (" . implode(',', $store_id_arr) . ") and is_default = 1 and is_close = 1")
            ->group("store_id,shipping_code")
            ->select();// 物流公司
        $shippingList2 = M('plugin')->where("type = 'shipping'")->cache(true, TPSHOP_CACHE_TIME)->getField('code,name'); // 查找物流插件
        foreach ($shippingList as $k => $v)
            $shippingList[$k]['name'] = $shippingList2[$v['shipping_code']];
        // 找出这个用户的优惠券 没过期的  并且 订单金额达到 condition 优惠券指定标准的
        $couponWhere = [
            'id' => I('cid'),
            'use_end_time' => ['gt', time()],
            'use_start_time' => ['lt', time()],
        ];
        $checkconpon = Db::name('coupon')->where($couponWhere)->find();
        $this->assign('checkconpon', $checkconpon); // 店铺列表
        $this->assign('storeList', $storeList); // 店铺列表
        $this->assign('shippingList', $shippingList); // 物流公司
        $this->assign('cartList', $result['cartList']); // 购物车的商品
        $this->assign('total_price', $result['total_price']); // 总计
        return $this->fetch();
    }
    /**
     * 确定订单的使用优惠券
     */
    public function checkcoupon()
    {
        $cartLogic = new CartLogic();
        $couponLogic = new CouponLogic();
        $cartList = $cartLogic->getCartList(1); // 获取用户选中的购物车商品
        $cartGoodsList = get_arr_column($cartList, 'goods');
        $cartGoodsId = get_arr_column($cartGoodsList, 'goods_id');
        $cartGoodsCatId = get_arr_column($cartGoodsList, 'cat_id3');
        $storeCartList = $cartLogic->getStoreCartList($cartList);//转换成带店铺数据的购物车商品
        $userCouponList = $couponLogic->getUserAbleCouponList($this->user_id, $cartGoodsId, $cartGoodsCatId);//用户可用的优惠券列表
        $userCartCouponList = $cartLogic->getCouponCartList($storeCartList, $userCouponList);
        $this->assign('userCartCouponList', $userCartCouponList);
        return $this->fetch();
    }
    /**
     * ajax 获取订单商品价格 或者提交 订单
     */
    public function cart3()
    {
        if ($this->user_id == 0) {
            $this->ajaxReturn(['status' => -100, 'msg' => "登录超时请重新登录!", 'result' => null]);
        }
        $address_id = I("address_id/d"); //  收货地址id
        $shipping_code = I("shipping_code/a"); //  物流编号
        $user_note = I('user_note/a'); // 给卖家留言        
        $coupon_id = I("coupon_id/a"); //  优惠券id
        $couponCode = I("couponCode/a"); //  优惠券代码
        $invoice_title = I('invoice_title'); // 发票
        $pay_points = I("pay_points/d", 0); //  使用积分
        $user_money = I("user_money/f", 0); //  使用余额
        $user_money = $user_money ? $user_money : 0;
        $cartLogic = new CartLogic();
        $cartLogic->setUserId($this->user_id);
        if ($cartLogic->getUserCartOrderCount() == 0) exit(json_encode(array('status' => -2, 'msg' => '你的购物车没有选中商品', 'result' => null))); // 返回结果状态
        if (!$address_id) exit(json_encode(array('status' => -3, 'msg' => '请先填写收货人信息', 'result' => null))); // 返回结果状态
        if (!$shipping_code) exit(json_encode(array('status' => -4, 'msg' => '请选择物流信息', 'result' => null))); // 返回结果状态
        $address = M('UserAddress')->where("address_id", $address_id)->find();
        $order_goods = M('cart')->where(["user_id" => $this->user_id, "selected" => 1])->select();
        $pay_points = 0;
        foreach ($order_goods as $k => $v) {
            $goods = M('goods')->where("goods_id={$v['goods_id']}")->find();
            if ($goods['shop_price'] == $v['exchange_integral']) {//如果为全积分
                $pay_points = I("pay_points/d", 0); //  使用积分
            } else {
                $pay_points += $v['hcredit'] * $v['goods_num'];
            }
        }
        $user = M('users')->where("user_id=$this->user_id")->find();
        if ($user['pay_points'] < $pay_points) {
            $pay_points = 0;
        }
        $result = calculate_price($this->user_id, $order_goods, $shipping_code, $address['province'], $address['city'], $address['district'], $pay_points, $user_money, $coupon_id, $couponCode);
        if ($result['status'] < 0) {
            $this->ajaxReturn($result);
        }
        $car_price = array(
            'postFee' => $result['result']['shipping_price'], // 物流费
            'couponFee' => $result['result']['coupon_price'], // 优惠券
            'balance' => $result['result']['user_money'], // 使用用户余额
            'pointsFee' => $result['result']['integral_money'], // 积分支付
            'payables' => array_sum($result['result']['store_order_amount']), // 订单总额 减去 积分 减去余额
            'goodsFee' => $result['result']['goods_price'],// 总商品价格
            'order_prom_amount' => array_sum($result['result']['store_order_prom_amount']), // 总订单优惠活动优惠了多少钱
            'store_order_prom_id' => $result['result']['store_order_prom_id'], // 每个商家订单优惠活动的id号
            'store_order_prom_amount' => $result['result']['store_order_prom_amount'], // 每个商家订单活动优惠了多少钱
            'store_order_amount' => $result['result']['store_order_amount'], // 每个商家订单优惠后多少钱, -- 应付金额
            'store_shipping_price' => $result['result']['store_shipping_price'],  //每个商家的物流费
            'store_coupon_price' => $result['result']['store_coupon_price'],  //每个商家的优惠券抵消金额
            'store_point_count' => $result['result']['store_point_count'], // 每个商家平摊使用了多少积分
            'store_balance' => $result['result']['store_balance'], // 每个商家平摊用了多少余额
            'store_goods_price' => $result['result']['store_goods_price'], // 每个商家的商品总价
        );
        // 提交订单
        if ($_REQUEST['act'] == 'submit_order') {
            if (empty($coupon_id) && !empty($couponCode)) {
                foreach ($couponCode as $k => $v) {
                    $coupon_id[$k] = M('CouponList')->where("code", $v)->where("store_id", $k)->getField('id');
                }
            }
            $orderLogic = new OrderLogic();
            $result = $orderLogic->addOrder($this->user_id, $address_id, $shipping_code, $invoice_title, $coupon_id, $car_price, $user_note); // 添加订单
            exit(json_encode($result));
        }
        $return_arr = array('status' => 1, 'msg' => '计算成功', 'result' => $car_price); // 返回结果状态
        exit(json_encode($return_arr));
    }
    /**
    
     * ajax 获取红积分订单商品价格 或者提交 订单
    
     */
    public function hcart3()
    {
        if ($this->user_id == 0)
            exit(json_encode(array('status' => -100, 'msg' => "登录超时请重新登录!", 'result' => null))); // 返回结果状态
        $address_id = I("address_id/d"); //  收货地址id
        $shipping_code = I("shipping_code/a"); //  物流编号
        $user_note = I('user_note/a'); // 给卖家留言
        $invoice_title = I('invoice_title'); // 发票
        $pay_points = I("pay_points/d", 0); //  使用积分
        $user_money = $user_money ? $user_money : 0;
        $cartLogic = new CartLogic();
        $cartLogic->setUserId($this->user_id);
        if ($cartLogic->getUserCartOrderCount() == 0) exit(json_encode(array('status' => -2, 'msg' => '你的购物车没有选中商品', 'result' => null))); // 返回结果状态
        if (!$address_id) exit(json_encode(array('status' => -3, 'msg' => '请先填写收货人信息', 'result' => null))); // 返回结果状态
        if (!$shipping_code) exit(json_encode(array('status' => -4, 'msg' => '请选择物流信息', 'result' => null))); // 返回结果状态
        $address = M('UserAddress')->where("address_id", $address_id)->find();
        $order_goods = M('cart')->where(['user_id' => $this->user_id, 'selected' => 1])->select();
        $result = hcredit_calculate_price($this->user_id, $order_goods, $shipping_code, $address[province], $address[city], $address[district], $pay_points);
        if ($result['status'] < 0) {
            exit(json_encode($result));
        }
        $car_price = array(
            'postFee' => $result['result']['shipping_price'], // 物流费
            //'couponFee' => $result['result']['coupon_price'], // 优惠券
            //'balance' => $result['result']['user_money'], // 使用用户余额
            'pointsFee' => $result['result']['integral_money'], // 积分支付
            'payables' => number_format(array_sum($result['result']['store_order_amount']), 2, '.', ''), // 订单总额 减去 积分 减去余额 减去优惠券 优惠活动
            'goodsFee' => $result['result']['goods_price'],// 总商品价格
            //'order_prom_amount' => array_sum($result['result']['store_order_prom_amount']), // 总订单优惠活动优惠了多少钱
            //'store_order_prom_id' => $result['result']['store_order_prom_id'], // 每个商家订单优惠活动的id号
            //'store_order_prom_amount' => $result['result']['store_order_prom_amount'], // 每个商家订单活动优惠了多少钱
            //'store_order_prom_money' => $result['result']['store_order_prom_money'], // 每个商家订单活动优惠需满足的金额
            'store_order_amount' => $result['result']['store_order_amount'], // 每个商家订单优惠后多少钱, -- 应付金额
            'store_shipping_price' => $result['result']['store_shipping_price'],  //每个商家的物流费
            //'store_coupon_price' => $result['result']['store_coupon_price'],  //每个商家的优惠券抵消金额
            //'store_point_count' => $result['result']['store_point_count'], // 每个商家平摊使用了多少积分            
            //'store_balance' => $result['result']['store_balance'], // 每个商家平摊用了多少余额
            'store_goods_price' => $result['result']['store_goods_price'], // 每个商家的商品总价
            //'store_order_prom_title'=>$result['result']['store_order_prom_title']
        );
        
        //提交订单
        if ($_REQUEST['act'] == 'submit_order') {
            //排队人数
            // $queue = \think\Cache::get('queue');
            // if($queue >= 100){            
            //     exit(json_encode(array('status' => -99, 'msg' => "当前人数过多请耐心排队!".$queue, 'result' => null))); // 返回结果状态
            // }else{                     
            //     \think\Cache::inc('queue',1);
            // }            
            // sleep(10);            
            if ($this->user['is_lock'] == 1 && ($pay_points > 0 || $user_money > 0))
                exit(json_encode(array('status' => -5, 'msg' => "账号异常已被锁定，不能使用余额支付！", 'result' => null))); // 用户被冻结不能使用余额支付
            $orderLogic = new OrderLogic();
            $result = $orderLogic->h_addOrder($this->user_id, $address_id, $shipping_code, $invoice_title, $coupon_id, $car_price, $user_note); // 添加订单
  
            // 这个人处理完了再减少        
            //\think\Cache::dec('queue');                    
            exit(json_encode($result));
        }
        $return_arr = array('status' => 1, 'msg' => '计算成功', 'result' => $car_price); // 返回结果状态
        exit(json_encode($return_arr));
    }
    /**
    
     * ajax 易物区提交 订单
    
     */
    public function ywcart3()
    {
        if ($this->user_id == 0)
            exit(json_encode(array('status' => -100, 'msg' => "登录超时请重新登录!", 'result' => null))); // 返回结果状态
        $address_id = I("address_id/d"); //  收货地址id
        $car_price = I("total_fee/d", 0);
        $pay_exchange = I("pay_points/d", 0); // 账户积分
        if ($pay_exchange < $car_price)
            exit(json_encode(array('status' => -3, 'msg' => '您的积分不足,无法支付此订单!', 'result' => null)));
        $cartLogic = new CartLogic();
        $cartLogic->setUserId($this->user_id);
        if ($cartLogic->getUserCartOrderCount() == 0) exit(json_encode(array('status' => -2, 'msg' => '你的购物车没有选中商品', 'result' => null))); // 返回结果状态
        if (!$address_id) exit(json_encode(array('status' => -3, 'msg' => '请先填写收货人信息', 'result' => null))); // 返回结果状态
        $address = M('UserAddress')->where("address_id", $address_id)->find();
    	
    	// $result = yw_calculate_prices($this->user_id, $order_goods, $address[province], $address[city], $address[district], $pay_points);
    
    	// $car_price = array(
    
    	//     'pointsFee' => $result['result']['integral_money'], // 积分支付
    
    	//     'goodsFee' => $result['result']['goods_price'],// 总商品价格
    
    	//     'store_point_count' => $result['result']['store_point_count'], // 每个商家平摊使用了多少积分
    
    	//     'store_goods_price' => $result['result']['store_goods_price'], // 每个商家的商品总价
    
    	//     'store_order_amount' => $result['result']['store_order_amount'], // 每个商家订单优惠后多少钱, -- 应付金额
    
    	//     'store_order_prom_title'=>$result['result']['store_order_prom_title']
    
    	// );
    	// 提交订单
        if ($_REQUEST['act'] == 'submit_order') {
    
    		// //排队人数
    
    		// $queue = \think\Cache::get('queue');
    
    		// if($queue >= 100){
    
    		//     exit(json_encode(array('status' => -99, 'msg' => "当前人数过多请耐心排队!".$queue, 'result' => null))); // 返回结果状态
    
    		// }else{
    
    		//     \think\Cache::inc('queue',1);
    
    		// }
    
    		// sleep(10);
            if ($this->user['is_lock'] == 1 && ($car_price > 0))
                exit(json_encode(array('status' => -5, 'msg' => "账号异常已被锁定，不能使用余额支付！", 'result' => null))); // 用户被冻结不能使用余额支付
            $orderLogic = new OrderLogic();
            $result = $orderLogic->addywOrder($this->user_id, $address_id); // 添加订单
    		
    		// 这个人处理完了再减少
            \think\Cache::dec('queue');
            exit(json_encode($result));
        }
        $return_arr = array('status' => 1, 'msg' => '计算成功', 'result' => $car_price); // 返回结果状态
        exit(json_encode($return_arr));
    }
    /*
     * 订单支付页面
     */
    public function cart4()
    {
        $order_id = I('order_id/d');
        $order_sn= I('order_sn/s', '');
        if (empty($this->user_id)) {
            $this->redirect('User/login');
        }

        $order_where = ['user_id'=>$this->user_id];
        if ($order_sn) {
            $order_where['order_sn'] = $order_sn;
        } else {
            $order_where['order_id'] = $order_id;
        }
        $order = M('Order')->where($order_where)->find();
        empty($order) && $this->error('订单不存在！');
        if ($order['order_status'] == 3) {
            $this->error('该订单已取消', U("Mobile/Order/order_detail", array('id'=>$order['order_id'])));
        }
        if (empty($order) || empty($this->user_id)) {
            $order_order_list = U("User/login");
            header("Location: $order_order_list");
            exit;
        }
        // 如果已经支付过的订单直接到订单详情页面. 不再进入支付页面
        if ($order['pay_status'] == 1) {
            $order_detail_url = U("Mobile/Order/order_detail", array('id'=>$order['order_id']));
            header("Location: $order_detail_url");
            exit;
        }
        $orderGoodsPromType = M('order_goods')->where(['order_id' => $order['order_id']])->getField('prom_type', true);
        $payment_where['type'] = 'payment';
        $no_cod_order_prom_type = ['4,5'];//预售订单，虚拟订单不支持货到付款
        if (strstr($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')) {
            //微信浏览器
            if (in_array($order['prom_type'], $no_cod_order_prom_type) || in_array(1, $orderGoodsPromType)) {
                //预售订单和抢购不支持货到付款
                $payment_where['code'] = 'weixin';
            } else {
                $payment_where['code'] = array('in',array('weixin','cod'));
            }
        } else {
            if (in_array($order['prom_type'], $no_cod_order_prom_type) || in_array(1, $orderGoodsPromType)) {
                //预售订单和抢购不支持货到付款
                $payment_where['code'] = array('neq','cod');
            }
            $payment_where['scene'] = array('in',array('0','1'));
        }
        $payment_where['status'] = 1;
        //预售和抢购暂不支持货到付款
        $orderGoodsPromType = M('order_goods')->where(['order_id' => $order['order_id']])->getField('prom_type', true);
        if ($order['prom_type'] == 4 || in_array(1, $orderGoodsPromType)) {
            $payment_where['code'] = array('neq','cod');
        }
        $paymentList = M('Plugin')->where($payment_where)->select();

        foreach ($paymentList as $key => $val) {
            $val['config_value'] = unserialize($val['config_value']);
            if ($val['config_value']['is_bank'] == 2) {
                $bankCodeList[$val['code']] = unserialize($val['bank_code']);
            }
            //判断当前浏览器显示支付方式
            //if (($key == 'weixin' && !is_weixin()) || ($key == 'alipayMobile' && is_weixin())) {
                //unset($paymentList[$key]);
            //}
        }

        $bank_img = include APP_PATH . 'home/bank.php'; // 银行对应图片
        $payment = M('Plugin')->where("`type`='payment' and status = 1")->select();
        $this->assign('paymentList', $paymentList);
        $this->assign('bank_img', $bank_img);
        $this->assign('master_order_sn', $master_order_sn); // 主订单号
        $this->assign('sum_order_amount', $sum_order_amount); // 所有订单应付金额 
        $this->assign('order', $order);
        $this->assign('bankCodeList', $bankCodeList);
        $this->assign('pay_date', date('Y-m-d', strtotime("+1 day")));
        return $this->fetch();
      /*
      $order_id = I('order_id/d', 0);
        $master_order_sn = I('master_order_sn', '');
        if (empty($this->user_id)) {
            $order_order_list = U("User/login");
            header("Location: $order_order_list");
            exit;
        }
        $order = M('Order')->where(['user_id' => $this->user_id, 'order_id' => $order_id])->find();
        if ($order['order_status'] == 3) {
            $this->error('订单已取消', U("Home/Order/virtual_order", array('order_id' => $order_id)));
        }
        if ($order['order_prom_type'] != 4) {
            $userlogic = new OrderLogic();
            $res = $userlogic->abolishOrder($order);  //检测是否超时没支付
            if ($res['status'] == 1) {
                $this->error('订单超时未支付已自动取消', U("Mobile/Order/order_detail", array('id' => $order_id)));
            }
        }
        // 如果是主订单号过来的, 说明可能是合并付款的
        $order_where['user_id'] = $this->user_id;
        if ($master_order_sn) {
            $order_where['master_order_sn'] = $master_order_sn;
            //
            $info = M('order_goods')->where("order_id={$order_id}")->find();
            $store_id = $info['store_id'];//商家店铺ID
            $goods_id = $info['goods_id'];
            $sum_order_amount = M('order')->where($order_where)->sum('order_amount');
            if ($sum_order_amount == 0) {
                $order_order_list = U("Order/order_list");
                header("Location: $order_order_list");
                exit;
            }
        } else {
            $order_where['order_id'] = $order_id;
            $order = M('Order')->where($order_where)->find();
            // 如果已经支付过的订单直接到订单详情页面. 不再进入支付页面
            if ($order['pay_status'] == 1) {
                $order_detail_url = U("Mobile/Order/order_detail", array('id' => $order_id));
                header("Location: $order_detail_url");
            }
        }
        //微信浏览器
        if (strstr($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger'))
            $paymentList = M('Plugin')->where("`type`='payment' and status = 1 and code in('weixin','cod')")->select();
        else
            $paymentList = M('Plugin')->where("`type`='payment' and status = 1 and  scene in(1)")->select();
        $paymentList = convert_arr_key($paymentList, 'code');
        foreach ($paymentList as $key => $val) {
            $val['config_value'] = unserialize($val['config_value']);
            if ($val['config_value']['is_bank'] == 2) {
                $bankCodeList[$val['code']] = unserialize($val['bank_code']);
            }
            //判断当前浏览器显示支付方式
            if (($key == 'weixin' && !is_weixin()) || ($key == 'alipayMobile' && is_weixin())) {
                unset($paymentList[$key]);
            }
        }
        $bank_img = include APP_PATH . 'home/bank.php'; // 银行对应图片
        $payment = M('Plugin')->where("`type`='payment' and status = 1")->select();
        $this->assign('paymentList', $paymentList);
        $this->assign('bank_img', $bank_img);
        $this->assign('master_order_sn', $master_order_sn); // 主订单号
        $this->assign('sum_order_amount', $sum_order_amount); // 所有订单应付金额        
        $this->assign('order', $order);
        $this->assign('bankCodeList', $bankCodeList);
        $this->assign('pay_date', date('Y-m-d', strtotime("+1 day")));
        return $this->fetch();
        */
    }
    /*
     * ajax 请求获取购物车列表
     */
    public function ajaxCartList()
    {
        $post_goods_num = I("goods_num/a"); // goods_num 购物车商品数量
        $post_cart_select = I("cart_select/a"); // 购物车选中状态
        $where['session_id'] = $this->session_id; // 默认按照 session_id 查询
        $this->user_id && $where['user_id'] = $this->user_id; // 如果这个用户已经等了则按照用户id查询
        $cartList = M('Cart')->where($where)->getField("id,goods_num,selected,prom_type,prom_id");
        if ($post_goods_num) {
            // 修改购物车数量 和勾选状态
            foreach ($post_goods_num as $key => $val) {
                $data['goods_num'] = $val < 1 ? 1 : $val;
                if ($cartList[$key]['prom_type'] == 1) //限时抢购 不能超过购买数量
                {
                    $flash_sale = M('flash_sale')->where("id", $cartList[$key]['prom_id'])->find();
                    $residue_num = $flash_sale['goods_num'] - $flash_sale['buy_num']; //剩余库存
                    if ($data['goods_num'] > $flash_sale['buy_limit']) {
                        $data['goods_num'] = $flash_sale['buy_limit'];
                    }
                    if ($residue_num < $data['goods_num']) {
                        $data['goods_num'] = $residue_num;  //剩余库存小于限购数时，按剩余库存购买
                    } else {
                        $data['goods_num'] = $data['goods_num'];
                    }
                }
                $data['selected'] = $post_cart_select[$key] ? 1 : 0;
                if (($cartList[$key]['goods_num'] != $data['goods_num']) || ($cartList[$key]['selected'] != $data['selected']))
                    M('Cart')->where("id", $key)->save($data);
            }
            $this->assign('select_all', $_POST['select_all']); // 全选框
        }
        $cartLogic = new CartLogic();
        $cartLogic->setUserId($this->user_id);
        $result = $cartLogic->getUserCartList(1);
        if (empty($result['total_price']))
            $result['total_price'] = array('total_fee' => 0, 'cut_fee' => 0, 'num' => 0, 'atotal_fee' => 0, 'acut_fee' => 0, 'anum' => 0);
        $storeList = M('store')->getField("store_id,store_name"); // 找出商家
        $this->assign('storeList', $storeList); // 商家列表       
        $this->assign('cartList', $result['cartList']); // 购物车的商品                
        $this->assign('total_price', $result['total_price']); // 总计       
        return $this->fetch('ajax_cart_list');
    }
    /*
     * ajax 获取用户收货地址 用于购物车确认订单页面
     */
    public function ajaxAddress()
    {
        $regionList = Db::name('region')->cache(true)->getField('id,name');
        $address_list = M('UserAddress')->where("user_id ", $this->user_id)->select();
        $c = M('UserAddress')->where(array("user_id" => $this->user_id, 'is_default' => 1))->count(); // 看看有没默认收货地址
        if ((count($address_list) > 0) && ($c == 0)) // 如果没有设置默认收货地址, 则第一条设置为默认收货地址
        $address_list[0]['is_default'] = 1;
        $this->assign('regionList', $regionList);
        $this->assign('address_list', $address_list);
        return $this->fetch('ajax_address');
    }
    /**
     * ajax 删除购物车的商品
     */
    public function ajaxDelCart()
    {
        $ids = I("ids"); // 商品 ids
        $result = M("Cart")->where("id", "in", $ids)->delete(); // 删除id为5的用户数据
        $return_arr = array('status' => 1, 'msg' => '删除成功', 'result' => ''); // 返回结果状态
        exit(json_encode($return_arr));
    }
    public function curl_post($url, $post)
    {
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $post,
        );
        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
