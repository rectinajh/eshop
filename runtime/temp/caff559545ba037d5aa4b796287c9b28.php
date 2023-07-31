<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:37:"./template/pc/rainbow/cart/index.html";i:1532228868;s:40:"./template/pc/rainbow/public/footer.html";i:1532228868;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>我的购物车列表 - www.ohbbs.cn 欧皇源码论坛 </title>
		<link rel="stylesheet" type="text/css" href="__STATIC__/css/tpshop.css" />
		<script src="__STATIC__/js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="__PUBLIC__/js/global.js" type="text/javascript" charset="utf-8"></script>
		<script src="__PUBLIC__/js/locationJson.js"></script>
		<script src="__STATIC__/js/location.js" type="text/javascript" charset="utf-8"></script>
		<script src="__PUBLIC__/js/layer/layer.js" type="text/javascript" charset="utf-8"></script>
		<script src="__PUBLIC__/js/pc_common.js"></script>
		<link rel="stylesheet" href="__STATIC__/css/location.css" type="text/css"><!-- 收货地址，物流运费 -->
	</head>
        <style>
            .coupon_whether{ overflow:auto; height: 500px; width:400px; }
        </style>
	<body>
		<!--顶部广告-s-->
		<?php $pid =1;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532343600 and end_time > 1532343600 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
  \think\Cache::clear();
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
			<div class="topic-banner" style="background: #f37c1e;">
				<div class="w1224">
					<a href="<?php echo $v['ad_link']; ?>">
						<img src="<?php echo $v[ad_code]; ?>"/>
					</a>
					<i onclick="$('.topic-banner').hide();"></i>
				</div>
			</div>
		<?php endforeach; ?>
		<!--顶部广告-e-->
		<!--header-s-->
		<div class="tpshop-tm-hander p" style="border-bottom: 0;">
			<div class="top-hander p">
				<div class="w1224 pr">
					<div class="fl">
						<div class="ls-dlzc fl nologin">
							<a href="<?php echo U('Home/user/login'); ?>">Hi,请登录</a>
							<a class="red" href="<?php echo U('Home/user/reg'); ?>">免费注册</a>
						</div>
						<div class="ls-dlzc fl islogin">
							<a class="red userinfo" href="<?php echo U('Home/user/index'); ?>"></a>
							<a href="<?php echo U('Home/user/logout'); ?>">退出</a>
						</div>
						<div class="fl spc" style="margin-top:10px"></div>
					</div>
					<div class="top-ri-header fr">
						<ul>
							<li><a target="_blank" href="<?php echo U('Home/Order/order_list'); ?>">我的订单</a></li>
							<li class="spacer"></li>
							<li><a target="_blank" href="<?php echo U('Home/User/account'); ?>">我的积分</a></li>
							<li class="spacer"></li>
							<li><a target="_blank" href="<?php echo U('Home/User/coupon'); ?>">我的优惠券</a></li>
							<li class="spacer"></li>
							<li><a target="_blank" href="<?php echo U('Home/User/goods_collect'); ?>">我的收藏</a></li>
							<li class="spacer"></li>
							<li class="hover-ba-navdh">
								<div class="nav-dh">
									<span>客户服务</span>
									<i class="jt-x"></i>
									<div class="conta-hv-nav">
										<ul>
											<!-- <li><a href="<?php echo U('Seller/Index/index'); ?>">商家后台</a></li> -->
											<li><a href="<?php echo U('Home/Newjoin/index'); ?>">商家入驻</a></li>
										</ul>
									</div>
								</div>
							</li>
							<li class="spacer"></li>
							<li class="navoxth">
								<div class="nav-dh">
									<i class="fl ico"></i>
									<span>手机新淘链</span>
									<i class="jt-x"></i>
								</div>
								<div class="sub-panel m-lst">
									<p>扫一扫，下载新淘链客户端</p>
									<dl>
										<dt class="fl mr10"><a target="_blank" href=""><img height="80" width="80" src="/Template/pc/soubao/Static/images/qrcode_vmall_app01.png"></a></dt>
										<dd class="fl mb10"><a target="_blank" href=""><i class="andr"></i> Andiord</a></dd>
										<dd class="fl"><a target="_blank" href=""><i class="iph"></i> iPhone</a></dd>
									</dl>
								</div>
							</li>
							<li class="spacer"></li>
							<li class="wxbox-hover">
								<a target="_blank" href="">关注我们：</a>
								<img class="wechat-top" src="__STATIC__/images/wechat.png" alt="">
								<div class="sub-panel wx-box">
									<span class="arrow-b">◆</span>
									<span class="arrow-a">◆</span>
									<p class="n"> 扫描二维码 <br>  关注新淘链官方微信 </p>
									<img src="__STATIC__/images/qrcode_vmall_app01.png">
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="nav-middan-z p tphsop2_0">
				<div class="header w1224">
					<div class="ecsc-logo fon_gwcshcar">
						<a href="/" class="logo">
                            <img src="<?php echo $tpshop_config['shop_info_store_logo']; ?>" style="max-width: 240px;max-height: 80px;">
                        </a>
						<span>购物车</span>
					</div>
					<div class="ecsc-search mycarlist_search">
						<form id="sourch_form" name="sourch_form" method="post" action="<?php echo U('Home/Goods/search'); ?>" class="ecsc-search-form">
							<input autocomplete="off" name="q" id="q" type="text" value="<?php echo \think\Request::instance()->param('q'); ?>" placeholder="搜索关键字" class="ecsc-search-input">
							<button type="submit" class="ecsc-search-button" onclick="if($.trim($('#q').val()) != '') $('#sourch_form').submit();">搜索</button>
							<div class="candidate p">
								<ul id="search_list"></ul>
							</div>
							<script type="text/javascript">
								;(function($){
									$.fn.extend({
										donetyping: function(callback,timeout){
											timeout = timeout || 1e3;
											var timeoutReference,
													doneTyping = function(el){
														if (!timeoutReference) return;
														timeoutReference = null;
														callback.call(el);
													};
											return this.each(function(i,el){
												var $el = $(el);
												$el.is(':input') && $el.on('keyup keypress',function(e){
													if (e.type=='keyup' && e.keyCode!=8) return;
													if (timeoutReference) clearTimeout(timeoutReference);
													timeoutReference = setTimeout(function(){
														doneTyping(el);
													}, timeout);
												}).on('blur',function(){
													doneTyping(el);
												});
											});
										}
									});
								})(jQuery);

								$('.ecsc-search-input').donetyping(function(){
									search_key();
								},500).focus(function(){
									var search_key = $.trim($('#q').val());
									if(search_key != ''){
										$('.candidate').show();
									}
								});
								$('.candidate').mouseleave(function(){
									$(this).hide();
								});

								function searchWord(words){
									$('#q').val(words);
									$('#sourch_form').submit();
								}
								function search_key(){
									var search_key = $.trim($('#q').val());
									if(search_key != ''){
										$.ajax({
											type:'post',
											dataType:'json',
											data: {key: search_key},
											url:"<?php echo U('Home/Api/searchKey'); ?>",
											success:function(data){
												if(data.status == 1){
													var html = '';
													$.each(data.result, function (n, value) {
														html += '<li onclick="searchWord(\''+value.keywords+'\');"><div class="search-item">'+value.keywords+'</div><div class="search-count">约'+value.goods_num+'个商品</div></li>';
													});
													html += '<li class="close"><div class="search-count">关闭</div></li>';
													$('#search_list').empty().append(html);
													$('.candidate').show();
												}else{
													$('#search_list').empty();
												}
											}
										});
									}
								}
							</script>
						</form>
						<div class="keyword">
							<ul>
								<?php if(is_array($tpshop_config['hot_keywords']) || $tpshop_config['hot_keywords'] instanceof \think\Collection || $tpshop_config['hot_keywords'] instanceof \think\Paginator): if( count($tpshop_config['hot_keywords'])==0 ) : echo "" ;else: foreach($tpshop_config['hot_keywords'] as $k=>$wd): ?>
									<li>
										<a href="<?php echo U('Home/Goods/search',array('q'=>$wd)); ?>" target="_blank"><?php echo $wd; ?></a>
									</li>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="tips_logininfo">
				<div class="w1224">
					<?php if(\think\Cookie::get('uname') == ''): ?>
						<div class="cont_aloinfon">
							<i class="tit_sad"></i>
							<span class="nitp">您还没有登录！登录后购物车的商品将保存在您的账号中</span>
							<a class="loging_ex" href="<?php echo U('Home/User/login'); ?>">立即登录</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<!--header-e-->
		<div class="shopcar_empty" <?php if(!(empty($storeCartList) || (($storeCartList instanceof \think\Collection || $storeCartList instanceof \think\Paginator ) && $storeCartList->isEmpty()))): ?>style="display: none"<?php endif; ?>>
			<div class="w1224">
				<div class="cart-empty">
					<div class="message">
						<ul>
							<li class="txt nologin">
								购物车内暂时没有商品，登录后将显示您之前加入的商品
							</li>
							<li class="txt islogin">
								购物车空空的哦~，去看看心仪的商品吧~
							</li>
							<li class="mt10" style="padding-left: 100px;">
								<a href="<?php echo U('Home/User/login'); ?>" class="btn-1 login-btn nologin">登录</a>&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="/" class="btn-1 login-btn islogin">去购物</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- 购物车列表 -->
		<?php if(!(empty($storeCartList) || (($storeCartList instanceof \think\Collection || $storeCartList instanceof \think\Paginator ) && $storeCartList->isEmpty()))): ?>
			<div id="tpshop-cart">
				<div class="main_shopcarlist">
					<div class="w1224">
						<div class="li3_address p">
							<ul>
								<li class="current"><a>全部商品数<em>（<?php echo $userCartGoodsTypeNum; ?>）</em></a></li>
							</ul>
						<!--	<div class="address_ri_ps">
								<ul class="list1" >
									<li class="jaj"><span>配&nbsp;&nbsp;送：</span></li>
									<li class="summary-stock though-line" style="margin-top:-1px">
										<div class="dd" style="border-right:0px;"  onmouseout="closeContent()">
											<div class="store-selector add_cj_p">
												<div class="text" style="margin-top:3px;border-left: 0 !important;"><div></div><b></b></div>
												<div onclick="$(this).parent().removeClass('hover')" class="close"></div>
											</div>
										</div>
									</li>
								</ul>
							</div>-->
						</div>
					</div>
				</div>
				<div class="shoplist_deta p">
					<div class="w1224">
						<div class="cart-thead p">
							<div class="column cart-checkbox">
								<input class="check-box" name="checkboxes" type="checkbox" style="display: none;">
								<i class="checkall checkFull"></i>全选
							</div>
							<div class="column t-goods">商品</div>
							<div class="column t-props"></div>
							<div class="column t-price">单价</div>
							<div class="column t-quantity">数量</div>
							<div class="column t-sum">小计</div>
							<div class="column t-action">操作</div>
						</div>
					</div>
				</div>
				<?php if(is_array($storeCartList) || $storeCartList instanceof \think\Collection || $storeCartList instanceof \think\Paginator): $i = 0; $__LIST__ = $storeCartList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$store): $mod = ($i % 2 );++$i;?>
					<div class="shoplist_detail_a" data-store-id="<?php echo $store[store_id]; ?>">
						<div class="w1224">
							<div class="tit_carttop p">
								<div class="column cart-checkbox wptez">
									<input class="check-box" name="checkShop" type="checkbox" style="display: none;">
									<i class="checkall checkShop"></i>
									<a href="<?php echo U('Home/Store/index',array('store_id'=>$store[store_id])); ?>"><?php echo $store['store_name']; ?></a>
									<!--有货时class为shp-ear,无货时在后面加上shp-none-->
									<i class="shp-ear "></i>
								</div>
								<div class="boximg_coupon">
									<i class="img_coupon"></i>
									<div class="coupon_whether" data-store-id="<?php echo $store[store_id]; ?>"></div>
								</div>

								<div class="ljadd">
									<span id="store_<?php echo $store['store_id']; ?>_total_price" class="f total_price"></span>
									<span id="store_<?php echo $store['store_id']; ?>_cut_price" class="l cut_price"></span>
								</div>
							</div>                                              
							<?php if(is_array($store[cartList]) || $store[cartList] instanceof \think\Collection || $store[cartList] instanceof \think\Paginator): $i = 0; $__LIST__ = $store[cartList];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cart): $mod = ($i % 2 );++$i;?>

								<div class="edge_tw" id="edge_<?php echo $cart['id']; ?>">
									<div>
										<?php if(!(empty($cart['prom_goods']) || (($cart['prom_goods'] instanceof \think\Collection || $cart['prom_goods'] instanceof \think\Paginator ) && $cart['prom_goods']->isEmpty()))): ?>
											<div class="brim_top">
												<!--满减和换购两种-->
												<span class="act_mjhg">促销</span>
												<a class="condi" href="<?php echo U('Home/Store/index',array('store_id'=>$store[store_id])); ?>"><?php echo $cart['prom_goods']['title']; ?>></a>
											</div>
										<?php endif; ?>
										<div class="item-single p">
											<div class="breadth_phase">
												<div class="column ">
													<input class="check-box" name="checkItem" value="<?php echo $cart['id']; ?>" type="checkbox" <?php if($cart[selected] == 1): ?>checked="checked"<?php endif; ?> style="display: none;">
													<i data-goods-id="<?php echo $cart['goods_id']; ?>" data-goods-cat-id3="<?php echo $cart['goods']['cat_id3']; ?>" data-cart-id="<?php echo $cart['id']; ?>" class="checkall checkItem <?php if($cart[selected] == 1): ?>checkall-true<?php endif; ?>"></i>
													<img class="msp_picture" src="<?php echo goods_thum_images($cart['goods_id'],82,82); ?>"/>
												</div>
												<div class="column t-goods">
													<p class="msp_spname"><a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$cart[goods_id])); ?>"><?php echo $cart['goods_name']; ?></a></p>
													<div class="msp_return">
														<?php if($store['qitian']): ?>
															<i class="return7"></i><span class="f_blue">支持七天无理由退货</span>
															<?php else: ?>
															<i class="return7 return7-dark"></i><span class="f_dark">不支持七天无理由退货</span>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<div class="column t-props he87 stang">
												<?php if(is_array($cart[spec_key_name_arr]) || $cart[spec_key_name_arr] instanceof \think\Collection || $cart[spec_key_name_arr] instanceof \think\Paginator): $i = 0; $__LIST__ = $cart[spec_key_name_arr];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$spec_key_name): $mod = ($i % 2 );++$i;?>
													<p><?php echo $spec_key_name; ?></p>
												<?php endforeach; endif; else: echo "" ;endif; ?>
											</div>
											<div class="column t-price">
												<span id="cart_<?php echo $cart['id']; ?>_goods_price">￥<?php echo $cart['goods_price']; ?></span>
												<?php if(!(empty($cart['prom_goods']) || (($cart['prom_goods'] instanceof \think\Collection || $cart['prom_goods'] instanceof \think\Paginator ) && $cart['prom_goods']->isEmpty()))): ?>
													<div class="promptions_in">
														<span class="cx"><em>促销详情</em><i></i></span>
														<div class="promotion-cont">
															<ul>
																<li><?php echo $cart['prom_goods']['prom_detail']; ?></li>
															</ul>
														</div>
													</div>
												<?php endif; ?>
											</div>
											<!--积分兑换值  -->
											<input type="hidden" name="sum" value="<?php echo $sum; ?>"/>
											<input type="hidden" name="member_xianzhi" value="<?php echo $member_xianzhi; ?>"/>
											<input type="hidden" name="exchange_integral" value="<?php echo $exchange_integral; ?>"/>
											<input type="hidden" name="shop_price" value="<?php echo $cart['goods_price']; ?>"/>
											<div class="column t-quantity mtp quantity-form">
												<a href="javascript:void(0);" class="decrement" id="decrement_<?php echo $cart['id']; ?>">-</a>
												
													<input name="changeQuantity_<?php echo $cart['id']; ?>" type="text" class="add2" id="changeQuantity_<?php echo $cart['id']; ?>" value="<?php echo $cart['goods_num']; ?>">
												<a href="javascript:void(0);" class="increment addnum" id="increment_<?php echo $cart['id']; ?>">+</a>
												<!--无货时隐藏数量选择，显示无货-->
												<!--<span>无货</span>-->
											</div>
											<div class="column t-sum sumpri" id="cart_<?php echo $cart['id']; ?>_total_price">￥<?php echo $cart['goods_price']*$cart['goods_num']; ?></div>
											<div class="column t-action">
												<p><a href="javascript:void(0);" class="deleteGoods deleteItem" data-cart-id="<?php echo $cart['id']; ?>">删除</a></p>
												<p><a class="moveCollect collectItem" data-id="<?php echo $cart['goods_id']; ?>">移到我的收藏</a></p>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
				<?php endforeach; endif; else: echo "" ;endif; ?>
				<div class="shoplist_deta floatflex">
					<div class="w1224">
						<div class="edge_tw_foot">
							<div class="item-single p">
								<div class="breadth_phase vermidd">
									<div class="column">
										<input class="check-box" name="checkboxes" type="checkbox" style="display: none;">
										<i class="checkall checkFull"></i>
										全选
										<a class="mal18 deleteGoods deleteAll" href="javascript:void(0);">删除选中的商品</a>
										<a class="mal18 moveCollect collectAll">移到我的收藏</a>
									</div>
								</div>
								<div class="row_foot_last">
									<div class="column t-quantity">
										<span class="chosewell chosew-add">已选择<em id="goods_num"></em>件商品</i></span>
									</div>
									<div class="column widallr">
										<div class="butpayin">
											<a class="paytotal" href="javascript:void(0)" data-url="<?php echo U('Home/Cart/cart2'); ?>">去结算</a>
										</div>
										<div class="totalprice">
											<span class="car_sumprice">总价：<em id="total_fee">￥0</em><i class="bulb"></i></span>
											<div class="price-tipsbox">
												<div class="ui-tips-main">不含运费及送装服务费</div>
												<span class="price-tipsbox-arrow"></span>
											</div>
											<span class="car_conta">已节省：<em id="goods_fee">-￥0</em></span>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					//去结算旁边的小图标
					$(function(){
						$('.bulb').hover(function(){
							$('.price-tipsbox').show();
						},function(){
							$('.price-tipsbox').hide();
						})
					})
					//购物车商品高度超过屏幕时去结算浮动
					$(function(){
						var wi = $(window).height();
						var ff = $('.floatflex').offset().top - wi;
						if(wi > ff){
							$('.floatflex').removeClass('fdix');
						}else{
							$('.floatflex').addClass('fdix');
						}
						$(window).scroll(function(){
							var scr = $(document).scrollTop()
							if(scr > ff){
								$('.floatflex').removeClass('fdix');
							}else{
								$('.floatflex').addClass('fdix');
							}
						});
					})
					$(document).ready(function(){
						initDecrement();
						initCheckBox();
						getStoreCoupon();
					});
				</script>
			</div>
		<?php endif; ?>
		<div class="shoplist_guess">
			<div class="w1224">
				<div class="main_shopcarlist">
					<div class="li3_address folahov p">
						<ul>
							<li class="current" data-id="guess-products"><a href="javascript:void(0);">猜你喜欢</a></li>
							<li data-id="collect-products"><a href="javascript:void(0);">我的收藏</a></li>
							<li data-id="history-products"><a href="javascript:void(0);">最近浏览</a></li>
						</ul>
					</div>

					<div class="totalswitch">
						<div class="switchable-panel" id="guess-products">
							<div class="goods-list-tab">
								<a href="#none" class="s-item curr">&nbsp;</a>
								<a href="#none" class="s-item">&nbsp;</a>
								<a href="#none" class="s-item">&nbsp;</a>
							</div>
							<div class="s-panel-main">
								<?php
                                   
                                $md5_key = md5("select * from `__PREFIX__goods` where is_recommend = 1 AND is_virtual=0 AND is_on_sale = 1 AND goods_state = 1 order by sort DESC limit 12");
                                $goods_likes = $sql_result_item = S("sql_".$md5_key);
                                if(empty($sql_result_item))
                                {                            
                                    $goods_likes = $sql_result_item = \think\Db::query("select * from `__PREFIX__goods` where is_recommend = 1 AND is_virtual=0 AND is_on_sale = 1 AND goods_state = 1 order by sort DESC limit 12"); 
                                    S("sql_".$md5_key,$sql_result_item,31104000);
                                }    
                              foreach($sql_result_item as $key=>$item): endforeach; ?>
								<div class="goods-panel jsaddsucc p">
									<ul>
										<?php if(is_array($goods_likes) || $goods_likes instanceof \think\Collection || $goods_likes instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($goods_likes) ? array_slice($goods_likes,0,4, true) : $goods_likes->slice(0,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$like): $mod = ($i % 2 );++$i;?>
											<li>
												<div class="itemgoodbox">
													<div class="p-img" >
														<a target="_blank" href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$like['goods_id'])); ?>">
															<img src="<?php echo goods_thum_images($like['goods_id'],160,160); ?>">
														</a>
													</div>
													<div class="p-name">
														<a target="_blank" href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$like['goods_id'])); ?>"><?php echo $like['goods_name']; ?></a>
													</div>
													<!-- <div class="p-price">
													    <strong>市场价：<em>￥</em><i><?php echo $like['market_price']; ?></i></strong>
													     
													</div> -->
													<div class="p-price"><strong>商城价：<em>￥</em><i><?php echo $like['shop_price']; ?></i></strong></div>
													<!-- <div class="p-price"><strong>会员价：<em>￥</em><i><?php echo $like['shop_price']-$like['exchange_integral']/$point_rate; ?>+<?php echo $like['exchange_integral']; ?>积分</i></strong></div> -->
													<div class="p-btn-adc">
														<a onclick="javascript:AjaxAddCart(<?php echo $like['goods_id']; ?>,1,0);" class="btn-append"><b></b>加入购物车</a>
													</div>
												</div>
											</li>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div>
								<div class="goods-panel p">
									<ul>
										<?php if(is_array($goods_likes) || $goods_likes instanceof \think\Collection || $goods_likes instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($goods_likes) ? array_slice($goods_likes,4,4, true) : $goods_likes->slice(4,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$like): $mod = ($i % 2 );++$i;?>
											<li>
												<div class="itemgoodbox">
													<div class="p-img" >
														<a target="_blank" href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$like['goods_id'])); ?>">
															<img src="<?php echo goods_thum_images($like['goods_id'],160,160); ?>">
														</a>
													</div>
													<div class="p-name">
														<a target="_blank" href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$like['goods_id'])); ?>"><?php echo $like['goods_name']; ?></a>
													</div>
													<div class="p-price">
													    <strong>市场价：<em>￥</em><i><?php echo $like['market_price']; ?></i></strong>
													     
													</div>
													<div class="p-price"><strong>商城价：<em>￥</em><i><?php echo $like['shop_price']; ?></i></strong></div>
													<!-- <div class="p-price"><strong>会员价：<em>￥</em><i><?php echo $like['shop_price']-$like['exchange_integral']/$point_rate; ?>+<?php echo $like['exchange_integral']; ?>积分</i></strong></div> -->
													<div class="p-btn-adc">
														<a onclick="javascript:AjaxAddCart(<?php echo $like['goods_id']; ?>,1,0);" class="btn-append"><b></b>加入购物车</a>
													</div>
												</div>
											</li>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div>
								<div class="goods-panel p">
									<ul>
										<?php if(is_array($goods_likes) || $goods_likes instanceof \think\Collection || $goods_likes instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($goods_likes) ? array_slice($goods_likes,8,4, true) : $goods_likes->slice(8,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$like): $mod = ($i % 2 );++$i;?>
											<li>
												<div class="itemgoodbox">
													<div class="p-img" >
														<a target="_blank" href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$like['goods_id'])); ?>">
															<img src="<?php echo goods_thum_images($like['goods_id'],160,160); ?>">
														</a>
													</div>
													<div class="p-name">
														<a target="_blank" href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$like['goods_id'])); ?>"><?php echo $like['goods_name']; ?></a>
													</div>
													<div class="p-price">
													    <strong>市场价：<em>￥</em><i><?php echo $like['market_price']; ?></i></strong>
													     
													</div>
													<div class="p-price"><strong>商城价：<em>￥</em><i><?php echo $like['shop_price']; ?></i></strong></div>
													<!-- <div class="p-price"><strong>会员价：<em>￥</em><i><?php echo $like['shop_price']-$like['exchange_integral']/$point_rate; ?>+<?php echo $like['exchange_integral']; ?>积分</i></strong></div> -->
													<div class="p-btn-adc">
														<a onclick="javascript:AjaxAddCart(<?php echo $like['goods_id']; ?>,1,0);" class="btn-append"><b></b>加入购物车</a>
													</div>
												</div>
											</li>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div>
								<div class="c-page-acar">
									<a href="javascript:void(0)" class="c-prev">&lt;</a>
									<a href="javascript:void(0)" class="c-next">&gt;</a>
								</div>
							</div>
						</div>
						<div class="switchable-panel" id="collect-products" style="display: none">
							<div class="goods-list-tab" ></div>
							<div class="s-panel-main"></div>
						</div>
						<div class="switchable-panel" id="history-products" style="display: none">
							<div class="goods-list-tab" ></div>
							<div class="s-panel-main"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!--删除商品弹窗-s-->
		<div class="ui-dialog">
			<div class="ui-dialog-title" style="width: 380px;">      
				<span>删除</span>     
			</div>    
			<div class="ui-dialog-content" style="height: 128px; width: 380px; overflow: hidden;">
				<div class="tip-box icon-box">
					<span class="warn-icon m-icon"></span>
					<div class="item-fore">
						<h3 class="ftx-04">删除商品？</h3>
						<div class="ftx-03">您可以选择添加到收藏，或删除商品。</div>
					</div>
					<div class="op-btns ac">
						<a href="javascript:void(0);" id="removeGoods" class="btn-9 select-remove" >删除</a>
						<a href="javascript:void(0);" id="addCollect" class="btn-1 ml10 re-select-follow moveCollect">添加我的收藏</a>
					</div>
				</div>
			</div>
			<a class="ui-dialog-close" title="关闭">
				<span class="ui-icon ui-icon-delete"></span>
			</a>
		</div>			
		<!--删除商品弹窗-e-->
		<div class="ui-mask"></div>
		<!--footer-s-->
		<div class="footer p">

    <div class="mod_service_inner">

        <div class="w1224">

            <ul>

                <li>

                    <div class="mod_service_unit">

                        <h5 class="mod_service_duo">多</h5>

                        <p>品类齐全，轻松购物</p>

                    </div>

                </li>

                <li>

                    <div class="mod_service_unit">

                        <h5 class="mod_service_kuai">快</h5>

                        <p>多仓直发，极速配送</p>

                    </div>

                </li>

                <li>

                    <div class="mod_service_unit">

                        <h5 class="mod_service_hao">好</h5>

                        <p>正品行货，精致服务</p>

                    </div>

                </li>

                <li>

                    <div class="mod_service_unit">

                        <h5 class="mod_service_sheng">省</h5>

                        <p>天天低价，畅选无忧</p>

                    </div>

                </li>

            </ul>

        </div>

    </div>

    <div class="w1224">

        <div class="footer-ewmcode">

		    <div class="foot-list-fl">

		        <?php
                                   
                                $md5_key = md5("select * from `__PREFIX__article_cat` where parent_id = 2");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from `__PREFIX__article_cat` where parent_id = 2"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>

		            <ul>

		                <li class="foot-th">

		                    <?php echo $v[cat_name]; ?>

		                </li>

		                <?php
                                   
                                $md5_key = md5("select * from `__PREFIX__article` where cat_id = $v[cat_id]  and is_open=1");
                                $result_name = $sql_result_v2 = S("sql_".$md5_key);
                                if(empty($sql_result_v2))
                                {                            
                                    $result_name = $sql_result_v2 = \think\Db::query("select * from `__PREFIX__article` where cat_id = $v[cat_id]  and is_open=1"); 
                                    S("sql_".$md5_key,$sql_result_v2,31104000);
                                }    
                              foreach($sql_result_v2 as $k2=>$v2): ?>

		                    <li>

		                        <a href="<?php echo U('Home/Article/detail',array('article_id'=>$v2[article_id])); ?>"><?php echo $v2[title]; ?></a>

		                    </li>

		                <?php endforeach; ?>

		            </ul>

		        <?php endforeach; ?>

		    </div>

		    <!-- <div class="QRcode-fr">

		        <ul>

		            <li class="foot-th">客户端</li>

		            <li><img src="__STATIC__/images/qrcode.png"/></li>

		        </ul>

		        <ul>

		            <li class="foot-th">微信</li>

		            <li><img src="__STATIC__/images/qrcode.png"/></li>

		        </ul>

		    </div> -->

		</div>

		<div class="mod_copyright p">

		    <div class="grid-top">

		        <?php
                                   
                                $md5_key = md5("select * from `__PREFIX__article` where cat_id = 5 and is_open=1");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from `__PREFIX__article` where cat_id = 5 and is_open=1"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>

		            <a href="<?php echo U('Home/Article/detail',array('article_id'=>$v[article_id])); ?>"><?php echo $v[title]; ?></a>

		            <span>|</span>

		        <?php endforeach; ?>

		        <a href="javascript:void (0);">客服热线:<?php echo $tpshop_config['shop_info_phone']; ?></a>

		    </div>

		    <p>Copyright © 2016-2025 新淘链商城 版权所有 保留一切权利 备案号:<?php echo $tpshop_config['shop_info_record_no']; ?></p>

		

		    <p class="mod_copyright_auth">

		        <a class="mod_copyright_auth_ico mod_copyright_auth_ico_1" href="" target="_blank">经营性网站备案中心</a>

		        <a class="mod_copyright_auth_ico mod_copyright_auth_ico_2" href="" target="_blank">可信网站信用评估</a>

		        <a class="mod_copyright_auth_ico mod_copyright_auth_ico_3" href="" target="_blank">网络警察提醒你</a>

		        <a class="mod_copyright_auth_ico mod_copyright_auth_ico_4" href="" target="_blank">诚信网站</a>

		        <a class="mod_copyright_auth_ico mod_copyright_auth_ico_5" href="" target="_blank">中国互联网举报中心</a>

		        <a class="mod_copyright_auth_ico mod_copyright_auth_ico_6" href="" target="_blank">APP下载</a>

		    </p>

		</div>

    </div>

</div>
		<!--footer-e-->
		<script type="text/javascript">
			$(document).ready(function(){
				user_login_or_no();
				my_collect();
				history_log();
				AsyncUpdateCart();
			});
			//购物车对象
			function CartItem(id, goods_num,selected) {
				this.id = id;
				this.goods_num = goods_num;
				this.selected = selected;
			}
			//初始化计算订单价格
			function AsyncUpdateCart(){
				var cart = new Array();
				var inputCheckItem = $("input[name^='checkItem']");
				inputCheckItem.each(function(i,o){
					var id = $(this).attr("value");
					var goods_num = $(this).parents('.item-single').find("input[id^='changeQuantity']").attr('value');
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
					url:"<?php echo U('Home/Cart/AsyncUpdateCart'); ?>",//,
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
			                	if(data.result.goods_num >= sum ){
			                		$('#goods_num').empty().html(sum);
			                	}else{
			                		 $('#goods_num').empty().html(data.result.goods_num);
			                	}
			                }else{
			                	 $('#goods_num').empty().html(data.result.goods_num);
			                }
			               
							$('#total_fee').empty().html('￥'+data.result.total_fee);
							$('#goods_fee').empty().html('-￥'+data.result.goods_fee);
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
							}else{
								$('.total_price').empty();
								$('.cut_price').empty();
							}
						}
					}
				});
			}

			//关闭优惠券展开状态
			function close_coupon(){
				var coupon = $('.img_coupon');
				coupon.removeClass('img_coupon_show');
				coupon.siblings('.coupon_whether').fadeOut(300);
			}
			//关闭更多促销展开状态
			function close_promption(){
				var promption = $('.promptions_in .cx');
				promption.find('em').html('更多促销');
				promption.removeClass('cx-add');
				promption.siblings('.promotion-cont').fadeOut(100);
			}
			//更多促销点击事件
			$(function(){
				$('.promptions_in .cx').click(function(e){
					e.stopImmediatePropagation();
					$(this).toggleClass('cx-add');
					$(this).siblings('.promotion-cont').fadeToggle(300);
					$(this).parents('.shoplist_detail_a').siblings().find('.cx').removeClass('cx-add').siblings().fadeOut();
					close_coupon();
					if($(this).hasClass('cx-add')){
						$(this).find('em').html('促销信息');
					}else{
						$(this).find('em').html('更多促销');
					}
				})
				$('.promptions_in').click(function(e){
					e.stopImmediatePropagation();
				})
			})
			//优惠券点击事件
			$(function(){
				$('.img_coupon').click(function(e){
					if(getCookie('user_id') == ''){
						pop_login();
						return;
					}
					e.stopImmediatePropagation();
					close_promption();
					$(this).toggleClass('img_coupon_show');
					$(this).siblings('.coupon_whether').fadeToggle(300);
					$(this).parents('.shoplist_detail_a').siblings().find('.img_coupon').removeClass('img_coupon_show').siblings().hide();
				})
				$('.boximg_coupon').click(function(e){
					e.stopImmediatePropagation();
				})
			})

			//猜你喜欢导航滑过状态
			$(function(){
				$('.folahov ul li').hover(function(){
					$(this).addClass('current').siblings().removeClass('current');
					var id = $(this).data('id');
					$('.switchable-panel').hide();
					$('#' + id).show();
				})
			})
			//猜你喜欢点击事件
			$(function(){
				$(document).on("click",'.c-page-acar a',function(){
					var gp = $(this).parents('.s-panel-main').find('.goods-panel');
					var nxt = $(this).parents('.s-panel-main').find('.jsaddsucc');
					var gp_r = $(this).parents('.switchable-panel').find('a');
					var nxt_r = $(this).parents('.switchable-panel').find('.curr');
					//上一页
					if($(this).hasClass('c-prev')){
						nxt.prev().addClass('jsaddsucc').siblings().removeClass('jsaddsucc');
						nxt_r.prev().addClass('curr').siblings().removeClass('curr');
						if($('.hidden').hasClass('jsaddsucc')){
							gp.eq(gp.length - 1).addClass('jsaddsucc').siblings().removeClass('jsaddsucc');
							gp_r.eq(gp.length - 1).addClass('curr').siblings().removeClass('curr');
						}
					}
					//下一页
					if($(this).hasClass('c-next')){
						nxt.next().addClass('jsaddsucc').siblings().removeClass('jsaddsucc');
						nxt_r.next().addClass('curr').siblings().removeClass('curr');
						if($(this).parent().hasClass('jsaddsucc')){
							gp.eq(0).addClass('jsaddsucc').siblings().removeClass('jsaddsucc');
							gp_r.eq(0).addClass('curr').siblings().removeClass('curr');
						}
					}
				})
			})

			//减购买数量事件
			$(function () {
				$(document).on("click", '.decrement', function (e) {
					var changeQuantityNum = $(this).parent().find('input').val();
					if (changeQuantityNum > 1) {
						$(this).parent().find('input').attr('value', parseInt(changeQuantityNum) - 1).val(parseInt(changeQuantityNum) -1);
					}
					initDecrement();
					changeNum(this);
				})
			})
			//加购买数量事件
			$(function () {
				$(document).on("click", '.increment', function (e) {
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
	                	
	                	$(this).parent().find('input').attr('value', parseInt(changeQuantityNum) + 1).val(parseInt(changeQuantityNum) + 1);
	                	
						
	                }
	                initDecrement();
	                changeNum(this);
					
				})
			})
			//手动输入购买数量
			$(function () {
				$(document).on("blur", '.quantity-form input', function (e) {
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
	                		layer.alert('商品数量必须大于0', {icon:2});
							$(this).val($(this).attr('value'));
						}else{
							$(this).attr('value', changeQuantityNum);
						}
	                	
	                	
	                } 
	               
					initDecrement();
	                changeNum(this);
					
				})
			})

			//更改购物车请求事件
			function changeNum(obj){
				var checkall = $(obj).parents('.item-single').find('.checkall');
				if(!checkall.hasClass('checkall-true')){
					checkall.trigger("click");
				}
				var input = $(obj).parents('.quantity-form').find('input');
				var cart_id = input.attr('id').replace('changeQuantity_','');
				var goods_num = input.attr('value');
				var cart = new CartItem(cart_id, goods_num, 1);
				$.ajax({
					type: "POST",
					url: "<?php echo U('Home/Cart/changeNum'); ?>",//+tab,
					dataType: 'json',
					data: {cart: cart},
					success: function (data) {
						if(data.status == 1){
							AsyncUpdateCart();
						}else{
							input.val(data.result.limit_num);
							input.attr('value',data.result.limit_num);
							layer.alert(data.msg,{icon:2});
						}
					}
				});
			}

			//多选框点击事件
			$(function () {
				$(document).on("click", '.checkall', function (e) {
					//模拟checkbox，选中时背景变色
					$(this).toggleClass('checkall-true');
					if($(this).hasClass('checkall-true')){
						$(this).parents('.edge_tw').addClass('edge_tw_bag');
						$(this).parent().find('.check-box').attr('checked', 'checked');
					}else{
						$(this).parents('.edge_tw').removeClass('edge_tw_bag');
						$(this).parent().find('.check-box').removeAttr('checked');
					}
					//选中店铺的多选框
					if($(this).hasClass('checkShop')){
//						alert('gg');
						if($(this).hasClass('checkall-true')){
							$(this).parents('.shoplist_detail_a').find("input[name^='checkItem']").each(function(i,o){
								$(o).attr('checked', 'checked');
								$(o).parent().find('.checkall').addClass('checkall-true');
							})
						}else{
							$(this).parents('.shoplist_detail_a').find("input[name^='checkItem']").each(function(i,o){
								$(o).removeAttr('checked', 'checked');
								$(o).parent().find('.checkall').removeClass('checkall-true');
							})
						}
					}
					//选中全选多选框
					if($(this).hasClass('checkFull')){
						if($(this).hasClass('checkall-true')){
							$(".checkall").each(function(i,o){
								$(this).addClass('checkall-true');
								$(this).parent().find('.check-box').attr('checked', 'checked');
							})
						}else{
							$(".checkall").each(function(i,o){
								$(this).removeClass('checkall-true');
								$(this).parent().find('.check-box').removeAttr('checked');
							})
						}
					}
					initCheckBox();
					AsyncUpdateCart();
				})
			})
			//删除购物车商品
			$(function () {
				//删除购物车商品事件
				$(document).on("click", '.deleteGoods', function (e) {
					var dh = $(document).height();
					var dw = $(document).width();
					$('.ui-mask').height(dh).width(dw).show();
					$('.ui-dialog').show();
					if($(this).hasClass('deleteItem')){
						//删除单个
						$('#removeGoods').removeClass('deleteAll').addClass('deleteItem').attr('data-cart-id',$(this).data('cart-id'));
						$('#addCollect').removeClass('collectAll').addClass('collectItem');
					}else{
						//删除多个
						$('#removeGoods').removeClass('deleteItem').addClass('deleteAll');
						$('#addCollect').removeClass('collectItem').addClass('collectAll');
					}
				})
				//关闭删掉购物车提示框事件
				$(document).on("click", '.ui-dialog-close', function (e) {
					$('.ui-mask').hide();
					$('.ui-dialog').hide();
				})

			})
			//删除购物车商品确定事件
			$(function () {
				$(document).on("click", '#removeGoods', function (e) {
					$('.ui-dialog-close').trigger('click');
					var cart_ids = new Array();
					if($(this).hasClass('deleteItem')){
						//单个删除
						cart_ids.push($('#removeGoods').attr('data-cart-id'));
					}else{
						//多个删除
						$(".checkItem").each(function(i,o){
							if($(this).hasClass('checkall-true')){
								cart_ids.push($(this).data('cart-id'));
							}
						})
					}
					$.ajax({
						type : "POST",
						url:"<?php echo U('Home/Cart/delete'); ?>",//,
						dataType:'json',
						data: {cart_ids: cart_ids},
						success: function(data){
							if(data.status == 1){
								for (var i = 0; i < cart_ids.length; i++) {
									$('#edge_' + cart_ids[i]).remove();
								}
								var inputCheckShop = $("input[name^='checkShop']");
								var inputCheckItemAll = $("input[name^='checkItem']");
								inputCheckShop.each(function(i,o){
									var inputCheckItem = $(this).parents('.shoplist_detail_a').find("input[name^='checkItem']");
									if(inputCheckItem.length == 0){
										$(this).parents('.shoplist_detail_a').remove();
									}
								})
								if(inputCheckItemAll.length == 0){
									$('#tpshop-cart').remove();
									$('.shopcar_empty').show();
								}
							}else{
								layer.msg(data.msg,{icon:2});
							}
							AsyncUpdateCart();
						}
					});
				})
			})

			/**
			 * 检测选项框
			 */
			function initCheckBox(){
				$("input[name^='checkShop']").each(function(i,o){
					var isAllCheck = true;
					$(this).parents('.shoplist_detail_a').find("input[name^='checkItem']").each(function(i,o){
						if ($(this).attr("checked") != 'checked') {
							isAllCheck = false;
						}
					})
					if(isAllCheck == false){
						$(this).removeAttr('checked');
						$(this).parent().find('.checkall').removeClass('checkall-true');
					}else{
						$(this).attr('checked', 'checked');
						$(this).parent().find('.checkall').addClass('checkall-true');
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
						$(this).parent().find('.checkall').removeClass('checkall-true');
					})
				}else{
					$("input[name^='checkboxes']").each(function(i,o){
						$(this).attr('checked', 'checked');
						$(this).parent().find('.checkall').addClass('checkall-true');
					})
				}
			}

			//更改购买数量对减购买数量按钮的操作
			function initDecrement(){
				
				var sum= $('input[name="sum"]').attr('value');//会员限制购买数量
				var exchange_integral = $("input[name='exchange_integral']").attr('value');
                var shop_price= $('input[name="shop_price"]').attr('value');//商品价格
                var ab_str = shop_price.toString();
                var ab_num = parseInt(ab_str.substring(0,ab_str.indexOf('.')));
                
                $("input[id^='changeQuantity']").each(function(i,o){
                	if(exchange_integral==ab_num){
                		if($(o).val() == sum){
                			$(o).parent().find('.decrement').addClass('disable');
                		}else{
                			$(o).parent().find('.decrement').removeClass('disable');
                		}
                	}else{
                		if($(o).val() == 1){
    						$(o).parent().find('.decrement').addClass('disable');
    					}
    					if($(o).val() > 1){
    						$(o).parent().find('.decrement').removeClass('disable');
    					}
                	}
					
				})
			}

			//结算
			$('.paytotal').click(function(){
				if(getCookie('user_id') == ''){
					pop_login();
					return;
				}
				window.location.href = $(this).attr('data-url');
			})
			//用户登录或为登录状态显示
			function user_login_or_no()
			{
				var uname = getCookie('uname');
				var head_pic = getCookie('head_pic');
				if (uname == '') {
					$('.islogin').remove();
					$('.nologin').show();
				} else {
					$('.nologin').remove();
					$('.islogin').show();
					$('.userinfo').html(decodeURIComponent(uname));
					if(head_pic != ''){
						$('.head_pic').attr('src',decodeURIComponent(head_pic));
					}
				}
			}
			//移到我的收藏
			$(function () {
				$(document).on("click", '.moveCollect', function (e) {
					if(getCookie('user_id') == ''){
						pop_login();
						return;
					}
					var goods_arr = new Array();
					if($(this).hasClass('collectItem')){
						//单个收藏
						goods_arr.push($(this).data('id'));
					}else{
						//多个收藏
						$(".checkItem").each(function(i,o){
							if($(this).hasClass('checkall-true')){
								goods_arr.push($(this).data('goods-id'));
							}
						})
					}
					$.ajax({
						type: "POST",
						url: "<?php echo U('Home/Goods/collects'); ?>",//+tab,
						data: {goods_ids: goods_arr},//+tab,
						dataType: 'json',
						success: function (data) {
							if (data.status == 1) {
								layer.msg(data.msg, {icon: 1});
							} else {
								layer.msg('操作失败', {icon: 2});
							}
						}
					});
					$('.ui-dialog-close').trigger('click');
				})
			})
			//登录页面
			function pop_login(){
				layer.open({
					type: 2,
					title: '<b>登陆新淘链商城</b>',
					skin: 'layui-layer-rim',
					shadeClose: true,
					shade: 0.5,
					area: ['490px', '460px'],
					content: "<?php echo U('Home/User/pop_login'); ?>",
				});
			}
			//我的收藏
			function my_collect()
			{
				var point_rate=<?php echo $point_rate; ?>;

				var uname = getCookie('uname');
				if (uname == '') {
					$('#collect-products .s-panel-main').html('<p class="wefoc"><a href="<?php echo U('User/login'); ?>">登录</a>后将显示您之前关注的商品</p>');
				} else {
					$.ajax({
						type : "POST",
						url:"<?php echo U('Home/User/myCollect'); ?>",//+tab,
						dataType:'json',
						success: function(data){
							if(data.status == 1){
								var products_html = '';
								var tab_html = '';
								for(var i = 0; i < data.result.length; i++){
									if(i%4 == 0){
										if(i == 0){
											tab_html += '<a class="s-item curr" href="#none"> </a>';
											products_html += '<div class="goods-panel jsaddsucc p"><ul>';
										}else{
											tab_html += '<a class="s-item" href="#none"> </a>';
											products_html += '<div class="goods-panel p"><ul>';
										}
									}
									var user_price=data.result[i].goods[0].shop_price-data.result[i].goods[0].exchange_integral/point_rate;
									products_html += '<li><div class="itemgoodbox"><div class="p-img" ><a target="_blank" href="'+data.result[i].url+'">' +
											'<img src="'+data.result[i].imgUrl+'"></a></div><div class="p-name"><a target="_blank" href="'+data.result[i].url+'">' +
									''+data.result[i].goods[0].goods_name+'</a></div><div class="p-price"><strong>市场价：<em>￥</em><i>'+data.result[i].goods[0].market_price+'</i></strong></div><div class="p-price"><strong>商城价：<em>￥</em><i>'+data.result[i].goods[0].shop_price+'</i></strong></div><div class="p-btn-adc">';
                                    if(data.result[i].goods[0].is_virtual != 1){
                                        products_html +=  '<a onclick="javascript:AjaxAddCart('+data.result[i].goods_id+',1,0);" class="btn-append"><b></b>加入购物车</a>';
                                    }else{
                                        products_html +=  '<a href="/index.php/home/Goods/goodsInfo/id/'+data.result[i].goods_id+'" class="btn-append"><b></b>加入购物车</a>';
                                    }
                                    products_html += '</div></div></li>';
									if(i%4 == 3){
										products_html += '</ul></div>';
									}
								}
								if(data.result.length > 4){
									products_html += '<div class="c-page-acar"><a href="javascript:void(0)" class="c-prev">&lt;</a><a href="javascript:void(0)" class="c-next">&gt;</a></div>';
								}
								$('#collect-products .s-panel-main').html(products_html);
								$('#collect-products .goods-list-tab').html(tab_html);
							}else{
								$('#collect-products .s-panel-main').html('<p class="wefoc">暂无结果</p>');
							}
						}
					});
				}
			}
			//最近浏览
			function history_log()
			{
				var point_rate=<?php echo $point_rate; ?>;
				var uname = getCookie('uname');
				if (uname == '') {
					$('#history-products .s-panel-main').html('<p class="wefoc"><a href="<?php echo U('User/login'); ?>">登录</a>后将显示您之前浏览的商品</p>');
				} else {
					$.ajax({
						type : "POST",
						url:"<?php echo U('Home/User/historyLog'); ?>",//+tab,
						dataType:'json',
						success: function(data){
							if(data.status == 1){
								var products_html = '';
								var tab_html = '';
								for(var i = 0; i < data.result.length; i++){
									if(i%4 == 0){
										if(i == 0){
											tab_html += '<a class="s-item curr" href="#none"> </a>';
											products_html += '<div class="goods-panel jsaddsucc p"><ul>';
										}else{
											tab_html += '<a class="s-item" href="#none"> </a>';
											products_html += '<div class="goods-panel p"><ul>';
										}
									}
									
									var user_price=data.result[i].goods[0].shop_price-data.result[i].goods[0].exchange_integral/point_rate;
									products_html += '<li><div class="itemgoodbox"><div class="p-img" ><a target="_blank" href="'+data.result[i].url+'">' +
											'<img src="'+data.result[i].imgUrl+'"></a></div><div class="p-name"><a target="_blank" href="'+data.result[i].url+'">' +
											''+data.result[i].goods[0].goods_name+'</a></div><div class="p-price"><strong>市场价：<em>￥</em><i>'+data.result[i].goods[0].market_price+'</i></strong></div><div class="p-price"><strong>商城价：<em>￥</em><i>'+data.result[i].goods[0].shop_price+'</i></strong></div><div class="p-btn-adc">';
                                    if(data.result[i].goods[0].is_virtual != 1){
                                        products_html +=  '<a onclick="javascript:AjaxAddCart('+data.result[i].goods_id+',1,0);" class="btn-append"><b></b>加入购物车</a>';
                                    }else{
                                        products_html +=  '<a href="/index.php/home/Goods/goodsInfo/id/'+data.result[i].goods_id+'" class="btn-append"><b></b>加入购物车</a>';
                                    }
                                    products_html += '</div></div></li>';
									if(i%4 == 3){
										products_html += '</ul></div>';
									}
								}
								if(data.result.length > 4){
									products_html += '<div class="c-page-acar"><a href="javascript:void(0)" class="c-prev">&lt;</a><a href="javascript:void(0)" class="c-next">&gt;</a></div>';
								}
								$('#history-products .s-panel-main').html(products_html);
								$('#history-products .goods-list-tab').html(tab_html);
							}else{
								$('#history-products .s-panel-main').html('<p class="wefoc">暂无结果</p>');
							}
						}
					});
				}
			}
			//获取店铺优惠券
			function getStoreCoupon(){
				var store_ids = new Array();
				var goods_ids = new Array();
				var goods_category_ids = new Array();
				$('.shoplist_detail_a').each(function(i,o){
					store_ids.push($(this).attr('data-store-id'));
				})
				//checkItem
				$('.checkItem').each(function(i,o){
					goods_category_ids.push($(this).attr('data-goods-cat-id3'));
					goods_ids.push($(this).attr('data-goods-id'));
				})
				$.ajax({
					type : "POST",
					url:"<?php echo U('Home/Cart/getStoreCoupon'); ?>",//+tab,
					dataType:'json',
					data:{'store_ids':store_ids,goods_ids:goods_ids,goods_category_ids:goods_category_ids},
					success: function(data){
						var newDate = new Date();
						if(data.status == 1){
							$('.coupon_whether').each(function(i,o){
								var store_id = $(this).attr('data-store-id');
								var coupon_html = '';
								var send_start_time = '';
								var send_end_time = '';
								for(var j = 0;j < data.result.length;j++){
									newDate.setTime(parseInt(data.result[j].send_start_time)*1000)
									send_start_time =newDate.toLocaleDateString();
									newDate.setTime(parseInt(data.result[j].send_end_time)*1000)
									send_end_time = newDate.toLocaleDateString();
									if(data.result[j]['store_id'] == store_id) {
                                        if (data.result[j]['is_get'] == 0) {
                                            coupon_html += '<div class="al_co3"><div class="co_pri"><span>￥' + data.result[j].money + '</span></div>' +
                                                    '<div class="co_des"><span class="sc_coup">商券,满￥' + data.result[j].condition + '减￥' + data.result[j].money + '</span><span class="sc_date">' + send_start_time + '-' + send_end_time + ' </span> </div><div class="co_get"> <a  href="javascript:;" data-coupon-id="' + data.result[j]['id'] + '" onclick="getCoupon(this);" class="coupon_btn">领取</a> </div> </div>';
                                        }
                                    }
								}
								if(coupon_html == ''){
									$(this).empty().html('<span>没有可领取的优惠券</span>');
								}else{
									$(this).empty().html(coupon_html);
								}
							})
						}else{
							$('.coupon_whether').each(function(i,o){
								$(this).empty().html('<span>没有可领取的优惠券</span>');
							})
						}
					}
				});
			}
			//领取优惠券
			function getCoupon(obj){
				var coupon_id = $(obj).attr('data-coupon-id');
				$.ajax({
					type : "POST",
					url:"<?php echo U('Home/User/getCoupon'); ?>",
					dataType:'json',
					data: {coupon_id: coupon_id},
					success: function(data){
						if(data.status == 1){
							$(obj).removeClass('coupon_btn').removeAttr('data-coupon-id').html('已领取');
                            $(obj).removeClass('coupon_btn').removeAttr('data-coupon-id').css('background-color','#999');
						}else{
							layer.msg(data.msg,{icon:2});
						}
					}
				});
			}
		</script>
	</body>
</html>