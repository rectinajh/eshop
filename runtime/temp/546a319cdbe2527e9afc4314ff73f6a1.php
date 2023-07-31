<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:41:"./template/mobile/default/cart/index.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>购物车--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

    <link rel="stylesheet" href="__STATIC__/css/style.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" type="text/css" href="__STATIC__/css/iconfont.css?v=<?php echo time(); ?>"/>

    <!-- <link rel="stylesheet" type="text/css" href="__STATIC__/css/iconfont2.css?v=<?php echo time(); ?>"/> -->

    <link rel="stylesheet" type="text/css" href="__ROOT__/public/css/style.css?v=<?php echo time(); ?>"/>

    <script src="__STATIC__/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>

    <script src="__STATIC__/js/mobile-util.js" type="text/javascript" charset="utf-8"></script>


    <script src="__STATIC__/js/layer/layer.js" type="text/javascript" charset="utf-8"></script>
    <script src="__PUBLIC__/js/global.js"></script>
    

    <script src="__STATIC__/js/swipeSlide.min.js" type="text/javascript" charset="utf-8"></script>

    <script src="__PUBLIC__/js/mobile_common.js"></script>

</head>

<body class="">


<div class="classreturn">

    <div class="content">

        <div class="ds-in-bl return">

            <a href="javascript:history.back(-1);"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

        </div>

        <div class="ds-in-bl search center">

            <span>购物车</span>

        </div>

        <div class="ds-in-bl menu">

            <!-- <a href="javascript:void(0);"><img src="__STATIC__/images/class1.png" alt="菜单"></a> -->

        </div>

    </div>

</div>
<div style="height: 1.8rem;"></div>
<div class="flool tpnavf">

    <div class="footer">

        <ul>

            <li>

                <a class="yello" href="<?php echo U('Index/index'); ?>">

                    <div class="icon">

                        <i class="icon-shouye iconfont"></i>

                        <p>首页</p>

                    </div>

                </a>

            </li>

            <li>

                <a href="<?php echo U('Goods/categoryList'); ?>">

                    <div class="icon">

                        <i class="icon-fenlei iconfont"></i>

                        <p>分类</p>

                    </div>

                </a>

            </li>

            <li>

                <!--<a href="shopcar.html">-->

                <a href="<?php echo U('Cart/index'); ?>">

                    <div class="icon">

                        <i class="icon-gouwuche iconfont"></i>

                        <p>购物车</p>

                    </div>

                </a>

            </li>

            <li>

                <a href="<?php echo U('User/index'); ?>">

                    <div class="icon">

                        <i class="icon-wode iconfont"></i>

                        <p>我的</p>

                    </div>

                </a>

            </li>

        </ul>

    </div>

</div>

<style>

    .get_mp span.disable {

        cursor: default;

        color: #e9e9e9;

    }
.group_ord .sc_list .deleshow .prices .sc_pri {
    font-size: 0.48rem;
}
</style>

<!--

<div class="bulletin_car">

    <div class="maleri30">

        <div class="news_car">

            <i class="carnew bell"></i>

            <p id="container_car"><span id="content">购物车中有5件商品已降价，快去看看吧</span></p>

            <span><a href="">&#10006;</a></span>

        </div>

    </div>

</div>

-->



<?php if(\think\Cookie::get('uname') == ''): ?>

    <div class="loginlater">

        <img src="__STATIC__/images/small_car.png">

        <span>登录后可同步电脑和手机购物车</span>

        <a href="<?php echo U('Mobile/User/login'); ?>">登录</a>

    </div>

    <?php else: if(empty($storeCartList) || (($storeCartList instanceof \think\Collection || $storeCartList instanceof \think\Paginator ) && $storeCartList->isEmpty())): ?>

        <div class="loginlater">

            <img src="__STATIC__/images/small_car.png">

            <span>购物车空空如也，赶紧逛逛吧~</span>

        </div>

        <div class="operating-floor-two p">

            <a class="item" href="<?php echo U('Mobile/Activity/coupon_list'); ?>">

                <div class="operating-floor-txt">

                    <span>每日神券</span>

                    <span class="second">限量发送，快去抢</span>

                </div>

                <div class="operating-floor-pic">

                    <img src="__STATIC__/images/act-coupon.png" alt="">

                </div>

            </a>

            <a class="item" href="<?php echo U('Mobile/User/collect_list'); ?>">

                <div class="operating-floor-txt">

                    <span style="color:#f23030;">我的收藏</span>

                    <span class="second" style="color:#999;">你收藏的都在这里</span>

                </div>

                <div class="operating-floor-pic">

                    <img src="__STATIC__/images/act-attention.png" alt="">

                </div>

            </a>

        </div>

    <?php endif; endif; ?>

<!--购物车有商品-s-->

<?php if(!(empty($storeCartList) || (($storeCartList instanceof \think\Collection || $storeCartList instanceof \think\Paginator ) && $storeCartList->isEmpty()))): if(is_array($storeCartList) || $storeCartList instanceof \think\Collection || $storeCartList instanceof \think\Paginator): $i = 0; $__LIST__ = $storeCartList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$store): $mod = ($i % 2 );++$i;?>

        <div class="allshoporder newallshoporder ma-to-20" data-store-id="<?php echo $store['store_id']; ?>">

            <div class="maleri30 p">

                <div class="radio fl top_radio_store_<?php echo $store['store_id']; ?>">

                    <input class="check-box" name="checkShop"  value="<?php echo $store['store_id']; ?>" type="checkbox" style="display: none;">

                    <span class="che checkShop"><i></i></span>

                </div>

                <div class="logoshopcar fl">

                    <i class="carnew lsc"></i>

                    <a class="s_name" href="<?php echo U('Mobile/Store/index',array('store_id'=>$store[store_id])); ?>"><?php echo $store['store_name']; ?></a>

                    <i class="Mright"></i>

                </div>

                <div class="fr">

                    <!--<a class="spea" href="">已免运费<i class="carnew tycor"></i></a>-->

                    <a class="coupon_click" data-storeid="<?php echo $store['store_id']; ?>" data-storename="<?php echo $store['store_name']; ?>" href="javascript:">优惠券</a>

                </div>

            </div>

        </div>

        <?php if(is_array($store[cartList]) || $store[cartList] instanceof \think\Collection || $store[cartList] instanceof \think\Paginator): $i = 0; $__LIST__ = $store[cartList];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cart): $mod = ($i % 2 );++$i;?>

            <div class="orderlistshpop group_ord" id="cart_list_<?php echo $cart['id']; ?>">

                    <div class="maleri30 p">

                        <div class="fullm">

                            <div class="mi">

                                <?php if(!(empty($cart['PromGoods']) || (($cart['PromGoods'] instanceof \think\Collection || $cart['PromGoods'] instanceof \think\Paginator ) && $cart['PromGoods']->isEmpty()))): ?>

                                    <a href="<?php echo U('mobile/Activity/promote_goods'); ?>">促销</a>

                                    <span><?php echo $cart['PromGoods']['title']; ?></span>

                                <?php endif; ?>

                            </div>

                        </div>

                    </div>

                <div class="sc_list p">

                    <div class="radio fl radio_store_<?php echo $store['store_id']; ?>">

                        <input class="check-box" name="checkItem" value="<?php echo $cart['id']; ?>" type="checkbox" style="display: none;" <?php if($cart[selected] == 1): ?>checked="checked"<?php endif; ?>>

                            <span data-goods-id="<?php echo $cart['goods_id']; ?>" data-goods-cat-id3="<?php echo $cart['goods']['cat_id3']; ?>" class="che <?php if($cart[selected] == 1): ?>check_t<?php endif; ?> checkItem">

                                <i></i>

                            </span>

                    </div>

                    <div class="shopimg fl">

                        <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$cart[goods_id])); ?>">

                            <!--商品图片-->

                            <img src="<?php echo goods_thum_images($cart['goods_id'],108,108); ?>"/>

                        </a>



                    </div>

                    <div class="deleshow fr">

                        <div class="deletes">

                            <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$cart[goods_id])); ?>">

                            <span class="similar-product-text fl"><?php echo $cart['goods_name']; ?></span>

                            </a>

                        </div>

                       <!--  <p class="weight">

                            <span style="width: 8.84rem;">

                                <?php if(is_array($cart[spec_key_name_arr]) || $cart[spec_key_name_arr] instanceof \think\Collection || $cart[spec_key_name_arr] instanceof \think\Paginator): $i = 0; $__LIST__ = $cart[spec_key_name_arr];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$spec_key_name): $mod = ($i % 2 );++$i;?><?php echo $spec_key_name; ?>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>

                            </span>

                        </p> -->
						<!--积分兑换值  -->
						<input type="hidden" name="sum" value="<?php echo $sum; ?>"/>
					
						<input type="hidden" name="exchange_integral" value="<?php echo $exchange_integral; ?>"/>
						<input type="hidden" name="shop_price" value="<?php echo $cart['goods_price']; ?>"/>
                        <div class="prices" style="margin-top: 0.2rem;">

                            <!-- <p class="sc_pri">市场价：<span class="m">￥</span><span><?php echo $cart['market_price']; ?></span></p> -->
                            <p class="sc_pri">商城价：<span class="m">￥</span><span><?php echo $cart['goods_price']; ?></span></p>
                            <!-- <?php if($cart['hcredit'] > 0): ?>
                            	<p class="sc_pri">会员价：<span class="m">￥</span><span><?php echo $cart['goods_price']-$cart['hcredit']/tpCache('shopping.point_rate'); ?>+<?php echo $cart['hcredit']; ?>积分</span></p>
							<?php endif; ?> -->
                            <div class="plus fr get_mp">

                                <span class="mp_minous m_reply">-</span>

                                <span class="mp_mp"><input name="changeQuantity_<?php echo $cart['id']; ?>" type="text" id="changeQuantity_<?php echo $cart['id']; ?>" value="<?php echo $cart['goods_num']; ?>"></span>

                                <span class="mp_plus m_reply">+</span>

                            </div>

                        </div>

                    </div>

                    <div class="givejf edit-btn p edit-change">

                        <ul class="edit-list">

                            <li><a class="moveCollect" data-goods-id="<?php echo $cart['goods_id']; ?>" href="javascript:;">添加收藏</a></li>

                            <li><a class="deleteGoods" data-store-id="<?php echo $store['store_id']; ?>" data-cart-id="<?php echo $cart['id']; ?>" href="javascript:;">删除</a></li>

                        </ul>

                    </div>

                </div>

            </div>

        <?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endif; ?>

<!--购物车有商品-e-->



<!--看看热卖-start-->

<?php if(empty($storeCartList) || (($storeCartList instanceof \think\Collection || $storeCartList instanceof \think\Paginator ) && $storeCartList->isEmpty())): ?>

    <div class="hotshop">

        <div class="thirdlogin">

            <h4>看看热卖</h4>

        </div>

    </div>

    <div class="floor guesslike" style="margin-bottom:90px;">

        <div class="likeshop">

            <ul>

                <?php
                                   
                                $md5_key = md5("select * from __PREFIX__goods where is_recommend=1 and is_on_sale = 1 and goods_state = 1 order by sort desc limit 30");
                                $result_name = $sql_result_goods = S("sql_".$md5_key);
                                if(empty($sql_result_goods))
                                {                            
                                    $result_name = $sql_result_goods = \think\Db::query("select * from __PREFIX__goods where is_recommend=1 and is_on_sale = 1 and goods_state = 1 order by sort desc limit 30"); 
                                    S("sql_".$md5_key,$sql_result_goods,31104000);
                                }    
                              foreach($sql_result_goods as $k=>$goods): ?>

                    <li>

                        <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$goods[goods_id])); ?>">

                            <div class="similer-product" style="padding-bottom: .42667rem;">

                                <img src="<?php echo goods_thum_images($goods[goods_id],192,192); ?>">

                                <span class="similar-product-text" style="font-size: .5rem;"><?php echo $goods['goods_name']; ?></span>
                               <!--  <span class="similar-product-price">市场价：¥<span class="big-price"><?php echo $goods['market_price']; ?></span></span> -->
                                <span class="similar-product-price" style="padding: 0.2rem;">¥<span class="big-price"><?php echo $goods['shop_price']; ?></span></span>
                                <span style="font-size: .4rem;color:#999;padding: 10px;">好评率99%</span>
                                <!-- <?php if($goods['exchange_integral'] > 0): ?>
                                	<span class="similar-product-price" style="color: #f23030">会员价：¥<span class="big-price"><?php echo $goods['shop_price']-$goods['exchange_integral']/tpCache('shopping.point_rate'); ?>+<?php echo $goods['exchange_integral']; ?>积分</span></span>
                            	<?php endif; ?> -->
                            </div>

                        </a>

                    </li>

                <?php endforeach; ?>

            </ul>

        </div>

        <div class="add">热卖商品实时更新，常回来看看哟~</div>

    </div>

<?php endif; ?>

<!--看看热卖-end-->

<!--编辑-e-->

<?php if(!(empty($storeCartList) || (($storeCartList instanceof \think\Collection || $storeCartList instanceof \think\Paginator ) && $storeCartList->isEmpty()))): ?>

    <div class="foohi foohiext newcarfoo">

        <div class="payit ma-to-20 payallb" style="bottom:0px;">

            <div class="fl alllef">

                <div class="radio fl">

                    <input class="check-box" name="checkboxes" type="checkbox" style="display: none;">

                            <span class="che checkFull">

                                <i></i>

                            </span>

                    <span class="all">全选</span>

                </div>

                <div class="youbia">

                    <p><span class="pmo">总价：</span><span>￥</span><span id="total_fee">0.00</span></p>
                    
                    <p class="lastime"><span id="goods_fee">节省：￥0.00</span></p>

                </div>

            </div>

            <div class="fr">
              
                 <a href="javascript:void(0);" onclick="return cart_submit()"  id="n_show">去结算(<span id="goods_num">0</span>)</a>

            </div>

        </div>

    </div>

<?php endif; ?>

<!--优惠券-s-->

<div class="chooseebitcard newchoosecar coupongg" >

    <div class="choose-titr">

        <span>店铺：<em id="cl"></em></span>

        <i class="closer"></i>

    </div>

    <div class="soldout_cp p" id="emptyCoupon" style="display: none">

        <img class="nmy" src="__STATIC__/images/nmy.png" alt="" />

        <p class="nzw">暂无可领的优惠券</p>

    </div>

    <div class="c_uscoupon">

        <div class="maleri30">

            <div class="no_get_coupon"><p class="canus" id="no_get_coupon">可领优惠劵<span>（以下是您账户可领的优惠劵）</span></p></div>

            <div class="get_coupon"><p class="canus" id="get_coupon">可用优惠劵<span>（以下是您账户可用的优惠劵）</span></p></div>

        </div>

    </div>

</div>

<!--优惠券-e-->



<div class="mask-filter-div" ></div>
<!--底部导航-start-->

   

    <!--底部导航-end-->
<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">

    $(document).ready(function(){

        initDecrement();

        initCheckBox();

    });

</script>
<script type="text/javascript">

    $(document).ready(function(){

        AsyncUpdateCart();

        getStoreCoupon();

    });

    //点击结算
    function cart_submit() {

        //获取选中的商品个数

        var j = 0;

        $('input[name^="checkItem"]:checked').each(function () {

            j++;

        });

        //选择数大于0

        if (j > 0) {

            //跳转订单页面

            window.location.href = "<?php echo U('Mobile/Cart/cart2'); ?>"

        } else {

            layer.open({content: '请选择要结算的商品！', time: 2});

            return false;

        }

    }
window.onload=function(){
$("#n_show").show();
}

$(".m_reply").click(function(){
  setTimeout(function(){
    window.location.reload();
    },1000);   
})

  //红积分商品结算

    function hcart_submit() {

        //获取选中的商品个数

        var j = 0;

        $('input[name^="checkItem"]:checked').each(function () {

            j++;

        });

        //选择数大于0

        if (j > 0) {

            //跳转订单页面

            window.location.href = "<?php echo U('Mobile/Cart/hcart2'); ?>"

        } else {

            layer.open({content: '请选择要结算的商品！', time: 2});

            return false;

        }

    }
    //点击结算

    function ywcart_submit() {

        //获取选中的商品个数

        var j = 0;

        $('input[name^="checkItem"]:checked').each(function () {

            j++;

        });

        //选择数大于0

        if (j > 0) {

            //跳转订单页面

            window.location.href = "<?php echo U('Mobile/Cart/ywcart2'); ?>"

        } else {

            layer.open({content: '请选择要结算的商品！', time: 2});

            return false;

        }

    }

    //购物车对象

    function CartItem(id, goods_num,selected) {

        this.id = id;

        this.goods_num = goods_num;

        this.selected = selected;

    }

    //初始化计算订单价格

    function AsyncUpdateCart(){

        var cart = new Array();
        var cat=<?php echo $cartGoodsCatsId; ?>;
        var inputCheckItem = $("input[name^='checkItem']");

        inputCheckItem.each(function(i,o){

            var id = $(this).attr("value");

            var goods_num = $(this).parents('.sc_list').find("input[id^='changeQuantity']").attr('value');

            if ($(this).attr("checked") == 'checked') {

                var cartItemCheck = new CartItem(id,goods_num,1);

                cart.push(cartItemCheck);

            }else{

                var cartItemNoCheck = new CartItem(id,goods_num,0);

                cart.push(cartItemNoCheck);

            }

        })

        $.ajax({

            type : "POST",

            url:"<?php echo U('Mobile/Cart/AsyncUpdateCart'); ?>",

            dataType:'json',

            data: {cart: cart},

            success: function(data){

                if(data.status == 1){
                	var sum= $('input[name="sum"]').attr('value');//会员限制购买数量
					var exchange_integral = $("input[name='exchange_integral']").attr('value');
	                
	                var shop_price= $('input[name="shop_price"]').attr('value');//商品价格
	                var ab_str = shop_price.toString();
	                var ab_num = parseInt(ab_str.substring(0,ab_str.indexOf('.')));
	                if(exchange_integral==ab_num){
	                	if(data.result.goods_num >= sum){
	                		$('#goods_num').empty().html(sum);
	                	}else{
	                		 $('#goods_num').empty().html(data.result.goods_num);
	                	}
	                }else{
	                	 $('#goods_num').empty().html(data.result.goods_num);
	                }

                    
                    
					$('#total_fee').empty().html(data.result.total_fee);
					
                    $('#goods_fee').empty().html('节省：￥'+data.result.goods_fee);

                    var storeCartList =  data.result.storeCartList;

                    var cartList = null;

                    if(storeCartList.length > 0){

                        for(var i = 0; i < storeCartList.length; i++){

                            cartList = storeCartList[i].cartList;
                            
							$('#store_'+cartList[0].store_id+'_total_price').empty().html('￥'+storeCartList[i].store_total_price);
							
                            

                            if(storeCartList[i].store_cut_price > 0){

                                $('#store_'+cartList[0].store_id+'_cut_price').empty().html('减：'+storeCartList[i].store_cut_price);

                            }else{

                                $('#store_'+cartList[0].store_id+'_cut_price').empty();

                            }

                            for(var j = 0; j < cartList.length; j++){

                               
								$('#cart_'+cartList[j].id+'_goods_price').empty().html('￥'+cartList[j].goods_price);
								$('#cart_'+cartList[j].id+'_total_price').empty().html('￥'+cartList[j].total_fee);
								
                            }

                        }

                    }

                }else{

                    $('#goods_num').empty().html(data.result.goods_num);
					
					$('#total_fee').empty().html(data.result.total_fee);
					
                   

                    $('#goods_fee').empty().html('节省：￥'+data.result.goods_fee);

                }

            }

        });

    }



    //商品数量加减

    $(function(){

        //加数量

        $('.mp_plus').click(function(){

            if(!$(this).hasClass('disable')){
            	var changeQuantityNum = $(this).parent().find('input').val();
				
				var sum= $('input[name="sum"]').attr('value');//会员限制购买数量
                var exchange_integral = $("input[name='exchange_integral']").attr('value');
                
                var shop_price= $('input[name="shop_price"]').attr('value');//商品价格
               	
                var ab_str = shop_price.toString();
                var ab_num = parseInt(ab_str.substring(0,ab_str.indexOf('.')));
                if(exchange_integral==ab_num){
                	if(changeQuantityNum < Number(sum)){
                		$(this).parent().find('input').attr('value', parseInt(changeQuantityNum) + 1).val(parseInt(changeQuantityNum) + 1);
                		
                	}else{
                		$(this).parent().find('input').val(sum);
                		$(this).parent().find('input').attr('value', parseInt(sum)).val();
                		
                	}
                }else{
                	var inputs = $(this).siblings('.mp_mp').find('input');
    				
                    var val = inputs.val();

                    if(val>=0){

                        val++;

                    }

                    inputs.val(val);

                    inputs.attr('value',val);
                }
                

                initDecrement();

                changeNum(this);

            }

        })

        //减数量

        $('.mp_minous').click(function(){

            var inputs = $(this).siblings('.mp_mp').find('input');

            var val = inputs.val();
            if(val>0){
                val--;    
            }    
            
			
            inputs.val(val);

            inputs.attr('value',val);

            initDecrement();

            changeNum(this);

        })

        $(document).on("blur", '.get_mp input', function (e) {

            var changeQuantityNum = parseInt($(this).val());
            var sum= $('input[name="sum"]').attr('value');//会员限制购买数量
			var exchange_integral = $("input[name='exchange_integral']").attr('value');
            var shop_price= $('input[name="shop_price"]').attr('value');//商品价格
            var ab_str = shop_price.toString();
            var ab_num = parseInt(ab_str.substring(0,ab_str.indexOf('.')));
            if(exchange_integral==ab_num){
            	if(changeQuantityNum>sum){
            		
            		$('.add2').val(sum);
            		$(this).attr('value', sum);
            	}else{
            		$(this).attr('value', changeQuantityNum);
            	}
            }else{
            	if(changeQuantityNum <= 0){

                    layer.open({

                        content: '商品数量必须大于0'

                        ,btn: '确定'

                    });

                    $(this).val($(this).attr('value'));

                }else{

                    $(this).attr('value', changeQuantityNum);

                }

            }
            
            initDecrement();

            changeNum(this);

        })

    })



    //公告

    ;(function($){

        $.fn.extend({

            roll:function(options){

                var defaults={speed:1};

                var options=$.extend(defaults, options);

                var speed=(document.all)?options.speed:Math.max(1,options.speed-1);

                if($(this)==null) return ;

                var $container=$(this);

                var $content=$("#content");

                var init_left=$container.width();

                $content.css({left:parseInt(init_left)+"px"});

                var This=this;

                var time=setInterval(function(){This.move($container,$content,speed);},20);

                $container.bind("mouseover",function(){clearInterval(time);});

                $container.bind("mouseout",function(){

                    time=setInterval(function(){This.move($container,$content,speed);},20);

                });

                return this;

            },

            move:function($container,$content,speed){

                var container_width = $container.width();

                var content_width = $content.width();

                if(parseInt($content.css("left")) + content_width > 0){

                    $content.css({left:parseInt($content.css("left")) - speed + "px"});

                }

                else{

                    $content.css({left:parseInt(container_width) + "px"});

                }

            }

        });

    })(jQuery);

    $(document).ready(function(){

        $("#container_car").roll({speed:2});

    });



    //优惠券

    $(function(){

        $(document).on('click','.coupon_click',function(){

            cover();

            $('.coupongg').show();

            $('html,body').addClass('ovfHiden');

            var storeid = $(this).data('storeid');  //当前店铺ID

            var storename = $(this).data('storename');  //当前店铺名

            $('.cuptyp').hide();

            $('.storeid_'+storeid).show();  //显示当前店铺下的优惠券

            var no_get_coupon_length = $('.no_get_coupon').find(".storeid_"+storeid+":visible").length;

            var get_coupon_length = $('.get_coupon').find(".storeid_"+storeid+":visible").length;

            if(no_get_coupon_length == 0){

                $('#no_get_coupon').hide();

            }else{

                $('#no_get_coupon').show();

            }

            if(get_coupon_length == 0){

                $('#get_coupon').hide();

            }else{

                $('#get_coupon').show();

            }

            $('#cl').html(storename);

        })

    })



    //关闭弹窗

    $(function(){

        $(document).on('click','.closer',function(){

            undercover();

            $('.newchoosecar').hide();

            $('html,body').removeClass('ovfHiden');

        })

    })

    //更改购买数量对减购买数量按钮的操作

    function initDecrement(){

        $("input[id^='changeQuantity']").each(function(i,o){

            if($(o).val() <= 1){

                $(o).parents('.get_mp').find('.mp_minous').addClass('disable');

            }

            if($(o).val() > 1){

                $(o).parents('.get_mp').find('.mp_minous').removeClass('disable');

            }

        })

    }

    /**

     * 检测选项框

     */

    function initCheckBox(){

        $("input[name^='checkShop']").each(function(i,o){

            var store_id = $(this).attr('value');

            var isAllCheck = true;

            $('.radio_store_'+store_id).find("input[name^='checkItem']").each(function(i,o){

                if ($(this).attr("checked") != 'checked') {

                    isAllCheck = false;

                }

            })

            if(isAllCheck == false){

                $(this).removeAttr('checked');

                $(this).parent().find('.che').removeClass('check_t');

            }else{

                $(this).attr('checked', 'checked');

                $(this).parent().find('.che').addClass('check_t');

            }

        })

        var checkBoxsFlag = true;

        $("input[name^='checkItem']").each(function(i,o){

            if ($(this).attr("checked") != 'checked') {

                checkBoxsFlag = false;

            }

        })

        if(checkBoxsFlag == false){

            $("input[name^='checkboxes']").each(function(i,o){

                $(this).removeAttr('checked');

                $(this).parent().find('.che').removeClass('check_t');

            })

        }else{

            $("input[name^='checkboxes']").each(function(i,o){

                $(this).attr('checked', 'checked');

                $(this).parent().find('.che').addClass('check_t');

            })

        }

    }



    //多选框点击事件

    $(function () {

        $(document).on("click", '.che', function (e) {

            checkBox($(this));

            initCheckBox();

            AsyncUpdateCart();

        })

    })

    function checkBox(obj){

        //模拟checkbox，选中时背景变色

        if(obj.hasClass('check_t')){

            obj.parent().find('.check-box').attr('checked', 'checked');

        }else{

            obj.parent().find('.check-box').removeAttr('checked');

        }

        //选中店铺的多选框

        if(obj.hasClass('checkShop')){

            var store_id = obj.parent().find("input[name^='checkShop']").attr('value');

            if(obj.hasClass('check_t')){

                $('.radio_store_'+store_id).find("input[name^='checkItem']").each(function(i,o){

                    $(o).attr('checked', 'checked');

                    $(o).parent().find('.che').addClass('check_t');

                })

            }else{

                $('.radio_store_'+store_id).find("input[name^='checkItem']").each(function(i,o){

                    $(o).removeAttr('checked', 'checked');

                    $(o).parent().find('.che').removeClass('check_t');

                })

            }

        }

        //选中全选多选框

        if(obj.hasClass('checkFull')){

            if(obj.hasClass('check_t')){

                $(".che").each(function(i,o){

                    $(this).addClass('check_t');

                    $(this).parent().find('.check-box').attr('checked', 'checked');

                })

            }else{

                $(".che").each(function(i,o){

                    $(this).removeClass('check_t');

                    $(this).parent().find('.check-box').removeAttr('checked');

                })

            }

        }

    }

    //删除购物车商品

    $(function () {

        //删除购物车商品事件

        $(document).on("click", '.deleteGoods', function (e) {

            var store_id = $(this).attr('data-store-id');

            var cart_ids = new Array();

            cart_ids.push($(this).attr('data-cart-id'));

            layer.open({

                content: '确定要删除此商品吗'

                ,btn: ['确定', '取消']

                ,yes: function(index){

                    layer.close(index);

                    $.ajax({

                        type : "POST",

                        url:"<?php echo U('Mobile/Cart/delete'); ?>",

                        dataType:'json',

                        data: {cart_ids: cart_ids},

                        success: function(data){

                            if(data.status == 1){

                                for (var i = 0; i < cart_ids.length; i++) {

                                    $('#cart_list_' + cart_ids[i]).remove();

                                }

                                var radio_store = $('.radio_store_'+store_id);

                                if(radio_store.length == 0){

                                    $('.top_radio_store_'+store_id).parents('.allshoporder').remove();

                                }

                                var store_div = $('.newallshoporder');

                                if(store_div.length == 0){

                                    location.reload();

                                }

                            }else{

                                layer.msg(data.msg,{icon:2});

                            }

                            AsyncUpdateCart();

                        }

                    });

                }

            });

        })

    })

    //更改购物车请求事件

    function changeNum(obj){

        var checkall = $(obj).parents('.orderlistshpop').find('.che');

        if(!checkall.hasClass('check_t')){

            checkall.toggleClass('check_t');

            checkBox(checkall);

            initCheckBox();

        }

        var input = $(obj).parents('.get_mp').find('input');

        var cart_id = input.attr('id').replace('changeQuantity_','');

        var goods_num = input.attr('value');

        var cart = new CartItem(cart_id, goods_num, 1);

        $.ajax({

            type: "POST",

            url: "<?php echo U('Mobile/Cart/changeNum'); ?>",//+tab,

            dataType: 'json',

            data: {cart: cart},

            success: function (data) {

                if(data.status == 1){

                    AsyncUpdateCart();

                }else{

                    input.val(data.result.limit_num);

                    input.attr('value',data.result.limit_num);

                    layer.open({

                        content: data.msg

                        ,btn: '确定'

                    });

                    initDecrement();

                }

            }

        });

    }

    //移到我的收藏

    $(function () {

        $(document).on("click", '.moveCollect', function (e) {

            if(getCookie('user_id') == ''){

                location.href = "<?php echo U('Mobile/User/login'); ?>";

                return;

            }

            var goods_id = $(this).attr('data-goods-id');

            $.ajax({

                type: "POST",

                url: "<?php echo U('Mobile/Goods/collect_goods'); ?>",//+tab,

                data: {goods_id: goods_id},//+tab,

                dataType: 'json',

                success: function (data) {

                    layer.open({

                        content: data.msg

                        ,btn: '确定'

                    });

                }

            });

            $('.ui-dialog-close').trigger('click');

        })

    })

    function getStoreCoupon(){

        var store_ids = new Array();

        var goods_ids = new Array();

        var goods_category_ids = new Array();

        $('.newallshoporder').each(function(i,o){

            store_ids.push($(this).attr('data-store-id'));

        })

        $('.checkItem').each(function(i,o){

            goods_category_ids.push($(this).attr('data-goods-cat-id3'));

            goods_ids.push($(this).attr('data-goods-id'));

        })

        $.ajax({

            type : "POST",

            url:"<?php echo U('Mobile/Cart/getStoreCoupon'); ?>",//+tab,

            dataType:'json',

            data:{'store_ids':store_ids,goods_ids:goods_ids,goods_category_ids:goods_category_ids},

            success: function(data){

                var newDate = new Date();

                if(data.status == 1){

                    var coupon_no_get_html = '';

                    var coupon_get_html = '';

                    var send_start_time = '';

                    var send_end_time = '';

                    for(var j = 0;j < data.result.length;j++){

                        newDate.setTime(parseInt(data.result[j].send_start_time)*1000);

                        send_start_time =newDate.toLocaleDateString();

                        newDate.setTime(parseInt(data.result[j].send_end_time)*1000);

                        send_end_time = newDate.toLocaleDateString();

                        //未领取

                        if(data.result[j].is_get == 0){

                            coupon_no_get_html += '<div class="cuptyp storeid_'+data.result[j].store_id+'"> <div class="le_pri"> <h1><em>￥</em>'+data.result[j].money+'</h1> <p>满'+data.result[j].condition+'元可用</p>' +

                                    ' </div> <div class="ri_int"> <div class="to_two canget"> <span class="ba">商城券</span> <span class="foi">'+data.result[j].name+'</span> </div>' +

                                    ' <div class="bo_two"> <span class="cp9">'+send_start_time+'-'+send_end_time+' </span> ' +

                                    '<a href="javascript:;" data-coupon-id="'+data.result[j]['id']+'" onclick="getCoupon(this);">点击领取</a> </div> </div> </div>';

                        }

                        if(data.result[j].is_get == 1){

                            coupon_get_html += '<div class="cuptyp storeid_'+data.result[j].store_id+'"> <a href=""> <div class="le_pri"> <h1><em>￥</em>'+data.result[j].money+'</h1> ' +

                                    '<p>'+data.result[j].condition+'</p> </div> <div class="ri_int"> <div class="to_two">' +

                                    ' <span class="ba">商城券</span> <span>'+data.result[j].name+'</span> </div> <div class="bo_two"> ' +

                                    '<span class="cp9">'+send_start_time+'-'+send_end_time+' </span> </div> </div> </a> </div>';

                        }

                    }

                    if(coupon_no_get_html == ''){

                        $('#emptyCoupon').show();

                        $('#no_get_coupon').hide();

                    }else{

                        $('#emptyCoupon').hide();

                        $('#no_get_coupon').show().after(coupon_no_get_html);

                    }

                    if(coupon_get_html == ''){

                        $('#get_coupon').hide();

                    }else{

                        $('#get_coupon').show().after(coupon_get_html);

                    }

                }else{

                    $('#emptyCoupon').show();

                    $('#no_get_coupon').hide();

                    $('#get_coupon').hide();

                }

            }

        });

    }

    //领取优惠券

    function getCoupon(obj){

        var coupon_id = $(obj).attr('data-coupon-id');

        $.ajax({

            type : "POST",

            url:"<?php echo U('Mobile/Activity/getCoupon'); ?>",

            dataType:'json',

            data: {coupon_id: coupon_id},

            success: function(data){

                if(data.status == 1){

                    $(obj).removeAttr('onclick').html('已领取');

                }else{

                    layer.open({

                        content: data.msg

                        ,btn: '确定'

                    });

                }

            }

        });

    }

</script>

</body>

</html>

