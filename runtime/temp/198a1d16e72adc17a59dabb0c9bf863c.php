<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:42:"./template/pc/rainbow/goods/goodsInfo.html";i:1532661070;s:40:"./template/pc/rainbow/public/header.html";i:1532661070;s:47:"./template/pc/rainbow/public/header_search.html";i:1532661070;s:46:"./template/pc/rainbow/public/footer_index.html";i:1532661070;s:46:"./template/pc/rainbow/public/sidebar_cart.html";i:1532661070;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>商品详情 - www.ohbbs.cn 欧皇源码论坛 </title>
		<link rel="stylesheet" type="text/css" href="__STATIC__/css/tpshop.css" />
		<link rel="stylesheet" type="text/css" href="__STATIC__/css/jquery.jqzoom.css">
		<script src="__STATIC__/js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="__PUBLIC__/js/layer/layer-min.js"></script>
		<script type="text/javascript" src="__STATIC__/js/jquery.jqzoom.js"></script>
		<script src="__PUBLIC__/js/global.js"></script>
		<script src="__PUBLIC__/js/pc_common.js"></script>
		<link rel="stylesheet" href="__STATIC__/css/location.css" type="text/css"><!-- 收货地址，物流运费 -->
		<script src="__PUBLIC__/js/viewer/viewer.min.js"></script>
		<link rel="stylesheet" href="__PUBLIC__/css/viewer.min.css">
	</head>
	<body>
	<!--header-s-->
	<!-- 新浪获取ip地址 -start-->
<?php if(\think\Cookie::get('province_id') <= 0): ?>
	<script src="http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=<?php echo \think\Request::instance()->ip(); ?>"></script>
	<script type="text/JavaScript">
		doCookieArea(remote_ip_info);
	</script>
<?php endif; ?>
<div class="tpshop-tm-hander p">
	<div class="top-hander p">
		<div class="w1224 pr">
			<link rel="stylesheet" href="__STATIC__/css/location.css" type="text/css"><!-- 收货地址，物流运费 -->
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
				<div class="sendaddress pr fl">
					<?php if(strtolower(ACTION_NAME) != 'goodsinfo'): ?>
						<!-- 收货地址，物流运费 -start-->
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
						<!--<i class="jt-x"></i>-->
						<!-- 收货地址，物流运费 -end-->
						<!--------收货地址，物流运费-开始-------------->
						<script src="__PUBLIC__/js/locationJson.js"></script>
						<script src="__STATIC__/js/location.js"></script>
						<!--------收货地址，物流运费--结束-------------->
					<?php endif; ?>
				</div>
			</div>
			<div class="top-ri-header fr">
				<ul>
					<li><a target="_blank" href="<?php echo U('Home/Order/order_list'); ?>">我的订单</a></li>
					<!-- <li><a target="_blank" href="<?php echo U('Home/Goods/add_goods'); ?>">我要易物</a></li> -->
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
							<span>手机新淘链网</span>
							<i class="jt-x"></i>
						</div>
						<div class="sub-panel m-lst">
							<p>扫一扫，下载新淘链客户端</p>
							<dl>
								<dt class="fl mr10"><a target="_blank" href=""><img height="80" width="80" src="__STATIC__/images/qrcode_app.png"></a></dt>
								<!-- <dd class="fl mb10"><a target="_blank" href=""><i class="andr"></i> Andiord</a></dd>
								<dd class="fl"><a target="_blank" href=""><i class="iph"></i> iPhone</a></dd> -->
							</dl>
						</div>
					</li>
					<li class="spacer"></li>
					<!-- <li class="wxbox-hover">
						<a target="_blank" href="">关注我们：</a>
						<img class="wechat-top" src="__STATIC__/images/wechat.png" alt="">
						<div class="sub-panel wx-box">
							<span class="arrow-b">◆</span>
							<span class="arrow-a">◆</span>
							<p class="n"> 扫描二维码 <br>  关注TPshop网官方微信 </p>
							<img src="__STATIC__/images/qrcode_vmall_app01.png">
						</div>
					</li> -->
				</ul>
			</div>
		</div>
	</div>
	<div class="nav-middan-z tphsop2_0 p">
		<div class="header w1224">
			<div class="ecsc-logo">
	<a href="/" class="logo">
        <img src="<?php echo $tpshop_config['shop_info_store_logo']; ?>" style="max-width: 240px;max-height: 80px;margin-top: 9px">
    </a>
    </div>
<div class="ecsc-search">
	<form id="sourch_form" name="sourch_form" method="post" action="<?php echo U('Home/Goods/search'); ?>" class="ecsc-search-form">
		<input autocomplete="off" name="q" id="q" type="text" value="<?php echo \think\Request::instance()->param('q'); ?>" placeholder="搜索关键字" class="ecsc-search-input">
		<button type="button" class="ecsc-search-button" >搜索</button>
		<div class="candidate p">
			<ul id="search_list"></ul>
		</div>
		<script type="text/javascript">

            $('.ecsc-search-button').on('click',function(){
                if($.trim($('#q').val()) != ''){
                    $('#sourch_form').submit();
                }else{
                    $('#q').css('background-color','#F6D4CB');
                    $('#q').attr('placeholder','请输入关键字');
                }
            })
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
//								html += '<li class="close"><div class="search-count">关闭</div></li>';
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
<div class="shopingcar-index fr">
	<div class="u-g-cart fr fixed" id="hd-my-cart">
		<a href="<?php echo U('Home/Cart/index'); ?>">
			<p class="c-num">
				<i class="car2_0"></i>
				<span>我的购物车</span>
				<span class="count cart_quantity" id="cart_quantity"></span>
			</p>
		</a>
		<div class="u-fn-cart u-mn-cart" id="show_minicart">
			<div class="minicartContent" id="minicart">
			</div>
		</div>
	</div>
</div>
		</div>
	</div>
	<div class="nav tpshop2_0_nav p">
		<div class="w1224 p">
			<div class="categorys home_categorys">
				<div class="dt">
					<a href="<?php echo U('Home/Goods/goodsList'); ?>" target="_blank">全部商品分类</a>
				</div>
				<!--全部商品分类-s-->
				<div class="dd">
					<div class="cata-nav">
						<?php if(is_array($goods_category_tree) || $goods_category_tree instanceof \think\Collection || $goods_category_tree instanceof \think\Paginator): $k = 0; $__LIST__ = $goods_category_tree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
							<div class="item fore1">
							<div class="item-left">
								<div class="cata-nav-name">
									<h3>
										<div class="naviconbox"><em class="navicon nav-<?php echo $k; ?>"></em></div>
										<a href="<?php echo U('Home/Goods/goodsList',array('id'=>$vo[id])); ?>" title="<?php echo $vo['name']; ?>"><?php echo $vo['name']; ?></a>
									</h3>
								</div>

							</div>
							<div class="cata-nav-layer">
								<div class="cata-nav-left">
									<div class="item-channels">
										<div class="channels">
											<?php if(is_array($vo['hmenu']) || $vo['hmenu'] instanceof \think\Collection || $vo['hmenu'] instanceof \think\Paginator): if( count($vo['hmenu'])==0 ) : echo "" ;else: foreach($vo['hmenu'] as $key=>$hm): ?>
												<a href="<?php echo U('Home/Goods/goodsList',array('id'=>$hm[id])); ?>" target="_blank"><?php echo $hm['name']; ?><i>&gt;</i></a>
											<?php endforeach; endif; else: echo "" ;endif; ?>
										</div>
									</div>
									<div class="subitems">
										<?php if(is_array($vo['tmenu']) || $vo['tmenu'] instanceof \think\Collection || $vo['tmenu'] instanceof \think\Paginator): if( count($vo['tmenu'])==0 ) : echo "" ;else: foreach($vo['tmenu'] as $k2=>$v2): ?>
										<dl>
											<dt><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v2[id])); ?>" target="_blank"><?php echo $v2['name']; ?><i>&gt;</i></a></dt>
											<?php if(!(empty($v2['sub_menu']) || (($v2['sub_menu'] instanceof \think\Collection || $v2['sub_menu'] instanceof \think\Paginator ) && $v2['sub_menu']->isEmpty()))): ?>
												<dd>
													<?php if(is_array($v2['sub_menu']) || $v2['sub_menu'] instanceof \think\Collection || $v2['sub_menu'] instanceof \think\Paginator): if( count($v2['sub_menu'])==0 ) : echo "" ;else: foreach($v2['sub_menu'] as $key=>$v3): ?>
														<a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v3[id])); ?>" target="_blank"><?php echo $v3['name']; ?></a>
													<?php endforeach; endif; else: echo "" ;endif; ?>
												</dd>
											<?php endif; ?>
										</dl>
										<?php endforeach; endif; else: echo "" ;endif; ?>
										<div class="item-brands">
											<ul>
											</ul>
										</div>
										<div class="item-promotions">
										</div>
									</div>
								</div>
								<div class="cata-nav-rigth">
									<div class="item-brands">
										<ul>
											<?php if(is_array($brand_list) || $brand_list instanceof \think\Collection || $brand_list instanceof \think\Paginator): $i = 0; $__LIST__ = $brand_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;if(($v2[cat_id1] == $vo[id]) AND ($v2[is_hot] == 1)): ?>
													<li>
														<a href="<?php echo U('Home/Goods/goodsList',array('brand_id'=>$v2[id])); ?>" target="_blank" title="<?php echo $v2['name']; ?>">
															<img src="<?php echo $v2['logo']; ?>" width="91" height="40">
														</a>
													</li>
												<?php endif; endforeach; endif; else: echo "" ;endif; ?>
										</ul>
									</div>
									<div class="item-promotions">
										<?php
                                   
                                $md5_key = md5("select * from __PREFIX__goods g inner join __PREFIX__flash_sale as f on g.goods_id = f.goods_id where start_time < $template_now_time and end_time > $template_now_time and status = 1 and cat_id1 = $vo[id] limit 2");
                                $result_name = $sql_result_promote = S("sql_".$md5_key);
                                if(empty($sql_result_promote))
                                {                            
                                    $result_name = $sql_result_promote = \think\Db::query("select * from __PREFIX__goods g inner join __PREFIX__flash_sale as f on g.goods_id = f.goods_id where start_time < $template_now_time and end_time > $template_now_time and status = 1 and cat_id1 = $vo[id] limit 2"); 
                                    S("sql_".$md5_key,$sql_result_promote,31104000);
                                }    
                              foreach($sql_result_promote as $promote_key=>$promote): ?>
											<a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$promote[goods_id])); ?>" target="_blank">
												<img width="181" height="120" src="<?php echo goods_thum_images($promote['goods_id'],181,120); ?>">
											</a>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
				<!--全部商品分类-e-->
			</div>
			<div class="navitems" id="nav">
				<ul>
					<li>
						<a href="/" >首页</a>
					</li>
					<?php
                                   
                                $md5_key = md5("SELECT * FROM `__PREFIX__navigation` where is_show = 1 ORDER BY `sort` DESC");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("SELECT * FROM `__PREFIX__navigation` where is_show = 1 ORDER BY `sort` DESC"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>
						<li>
                            <a href="<?php echo $v[url]; ?>" <?php  if($_SERVER['REQUEST_URI']==str_replace('&amp;','&',$v[url])){ echo "class='selected'";} ?> ><?php echo $v[name]; ?></a>
                        </li>

					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</div>

		<!--header-e-->
		<div class="search-box p">
			<div class="w1224">
				<div class="search-path fl">
					<a>全部结果</a>
					<i class="litt-xyb"></i>
					<?php if(is_array($navigate_goods) || $navigate_goods instanceof \think\Collection || $navigate_goods instanceof \think\Paginator): if( count($navigate_goods)==0 ) : echo "" ;else: foreach($navigate_goods as $k=>$v): ?>
						<a href="<?php echo U('Home/Goods/goodsList',array('id'=>$k)); ?>"><?php echo $v; ?></a>
						<i class="litt-xyb"></i>
					<?php endforeach; endif; else: echo "" ;endif; ?>
					<div class="havedox">
						<span><?php echo $goods['goods_name']; ?></span>
					</div>
				</div>
			</div>
		</div>
		<div class="details-bigimg p">
			<div class="w1224">
				<div class="detail-img">
					<div class="product-gallery">
						<div class="product-photo" id="photoBody">
							<!-- 商品大图介绍 start [[-->
							<div class="product-img jqzoom">
								<img id="zoomimg" src="<?php echo goods_thum_images($goods['goods_id'],400,400); ?>" jqimg="<?php echo goods_thum_images($goods['goods_id'],800,800); ?>">
							</div>
							<!-- 商品大图介绍 end ]]-->
							<!-- 商品小图介绍 start [[-->
							<div class="product-small-img fn-clear"> <a href="javascript:;" class="next-left next-btn fl disabled"></a>
								<div class="pic-hide-box fl">
									<ul class="small-pic" style="left:0;">
										<?php if(is_array($goods_images_list) || $goods_images_list instanceof \think\Collection || $goods_images_list instanceof \think\Paginator): if( count($goods_images_list)==0 ) : echo "" ;else: foreach($goods_images_list as $k=>$v): ?>
											<li class="small-pic-li <?php if($k == 0): ?>active<?php endif; ?>">
											<a href="javascript:;"><img src="<?php echo get_sub_images($v,$v[goods_id],60,60); ?>" data-img="<?php echo get_sub_images($v,$v[goods_id],400,400); ?>" data-big="<?php echo get_sub_images($v,$v[goods_id],800,800); ?>"> <i></i></a>
											</li>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div>
								<a href="javascript:;" class="next-right next-btn fl"></a> </div>
							<!-- 商品小图介绍 end ]]-->
						</div>
						<!-- 收藏商品 start [[-->
						<div class="collect">
							<a href="javascript:void(0);" id="collectLink"><i class="collect-ico collect-ico-null"></i>
								<span class="collect-text">收藏商品</span>
								<em class="J_FavCount">（<?php echo $goods['collect_sum']; ?>）</em></a>
							<!--<a href="javascript:void(0);" id="collectLink"><i class="collect-ico collect-ico-ok"></i>已收藏<em class="J_FavCount">(20)</em></a>-->
						</div>
						<!-- 分享商品 -->
						<div class="share">
							<div class="jiathis_style">
								<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt fl" target="_blank"><img src="/public/plugins/jiathis/jiathis1.gif" border="0" /></a>
								<?php if($goods['is_own_shop'] < 2): ?>&nbsp;&nbsp;<a href="<?php echo U('Order/expose',array('goods_id'=>$goods[goods_id])); ?>" class="next-right fr">举报</a><?php endif; ?>
							</div>
							<script>
								var jiathis_config = {
									url:"http://<?php echo $_SERVER[HTTP_HOST]; ?>/index.php?m=Home&c=Goods&a=goodsInfo&id=<?php echo $_GET[id]; ?>",
									pic:"http://<?php echo $_SERVER[HTTP_HOST]; ?><?php echo goods_thum_images($goods[goods_id],400,400); ?>",
								}
								var is_distribut = getCookie('is_distribut');
								var user_id = getCookie('user_id');
								// 如果已经登录了, 并且是分销商
								if(parseInt(is_distribut) == 1 && parseInt(user_id) > 0)
								{
									jiathis_config.url = jiathis_config.url + "&first_leader="+user_id;
								}
								//alert(jiathis_config.url);
							</script>
							<script type="text/javascript" data-url="http://v3.jiathis.com/code_mini/jia.js" charset="utf-8"></script>                                    <script>
										// 延时加载第三方js  参考文章 https://mo2g.com/view/102/
										 jQuery(function($) {
											$('script[data-url]').each(function() {
												var _this = $(this),
													url = _this.attr('data-url');
												_this.attr('src',url); 
											});
										});
							 </script>   
						</div>
					</div>
				</div>
				<form id="buy_goods_form" name="buy_goods_form" method="post" <?php if($goods['is_virtual'] == 1): ?>action="<?php echo U('Home/Virtual/buy_virtual'); ?>"<?php endif; ?>>
					<input type="hidden" name="sum" value="<?php echo $sum; ?>"/><!--会员购买数量限制  -->
					<input type="hidden" name="member_xianzhi" value="<?php echo $goods['member_xianzhi']; ?>"/><!--会员购买数量限制  -->
					<input type="hidden" name="goods_prom_type" value="<?php echo $goods['prom_type']; ?>"/><!-- 活动类型 -->
					<input type="hidden" name="shop_price" value="<?php echo $goods['shop_price']; ?>"/><!-- 活动价格 -->
					<input type="hidden" name="exchange_integral" value="<?php echo $goods['exchange_integral']; ?>"/><!--会员可兑换的积分数量  -->
					<input type="hidden" name="store_count" value="<?php echo $goods['store_count']; ?>"/><!-- 活动库存 -->
					<input type="hidden" name="market_price" value="<?php echo $goods['market_price']; ?>"/><!-- 商品原价 -->
					<input type="hidden" name="start_time" value="<?php echo $goods['start_time']; ?>"/><!-- 活动开始时间 -->
					<input type="hidden" name="end_time" value="<?php echo $goods['end_time']; ?>"/><!-- 活动结束时间 -->
					<input type="hidden" name="activity_title" value="<?php echo $goods['activity_title']; ?>"/><!-- 活动标题 -->
					<input type="hidden" name="prom_detail" value="<?php echo $goods['prom_detail']; ?>"/><!-- 促销活动的促销类型 -->
					<input type="hidden" name="activity_is_on" value=""/><!-- 活动是否正在进行中 -->
					<input type="hidden" name="item_id" value="<?php echo \think\Request::instance()->param('item_id'); ?>"/><!-- 商品规格id -->
					<div class="detail-ggsl">
						<h1><?php echo $goods['goods_name']; ?></h1>
						<div class="presale-time" style="display: none">
							<div class="pre-icon fl">
								<span class="ys"><i class="detai-ico"></i><span id="activity_type">抢购活动</span></span>
							</div>
							<div class="pre-icon fr">
								<span class="per" style="display: none"><i class="detai-ico"></i><em id="order_user_num">0</em>人预定</span>
								<span class="ti" id="activity_time"><i class="detai-ico"></i>剩余时间：<span id="overTime"></span></span>
								<span class="ti" id="prom_detail"></span>
							</div>
						</div>
						<div class="shop-price-cou">
							<div class="shop-price-le">
							  <?php if($goods['prom_type']!=1): ?>
								<!-- <ul>
									<li class="jaj"><span id="goods_price_title">会员价：</span></li>
									<li>
										<span class="bigpri_jj" id="user_price"><em class="li_xfo">￥<?php echo $goods['shop_price']-$goods['exchange_integral']/$point_rate; ?>+<?php echo $goods['exchange_integral']; ?>积分</em>
							
										</span>
									</li>
								</ul> -->
							 <?php endif; ?>	
								<ul>
									<li class="jaj"><span id="goods_price_title">商城价：</span></li>
									<li>
										<span class="bigpri_jj" id="goods_price"><em>￥</em>
										<!--<a href=""><em class="sale">（降价通知）</em></a>-->
										</span>
									</li>
								</ul>
								<ul>
									<li class="jaj"><span id="market_price_title">市场价：</span></li>
									<li class="though-line"><span><em>￥</em><span id="market_price"><?php echo $goods['market_price']; ?></span></span></li>
								</ul>
								<ul id="activity_title_div" style="display: none">
									<li class="jaj"><span id="activity_label"></span></li>
									<li><span id="activity_title" style="color: #df3033;background: 0 0;border: 1px solid #df3033;padding: 2px 3px;"></span></li>
								</ul>
								<?php if($cat_ids!=850 && $goods['give_integral'] > 0 && $cat_ids!=1066): ?>
									<ul>
										<li class="jaj ls4"><span>赠送积分：</span></li>
										<li><span class="fullminus"><?php echo $goods['give_integral']; ?></span></li>
									</ul>
								<?php endif; ?>
							</div>
							<div class="shop-cou-ri">
								<div class="allcomm"><p>累计评价</p><p class="f_blue"><?php echo $commentStatistics['c0']; ?></p></div>
								<div class="br1"></div>
								<div class="allcomm"><p>累计销量</p><p class="f_blue"><?php echo $goods['sales_sum']; ?></p></div>
							</div>
						</div>
						<?php if($goods[is_virtual] == 0): ?>
							<div class="standard p">
							<!-- 收货地址，物流运费 -start-->
							<ul class="list1">
								<li class="jaj"><span>配&nbsp;&nbsp;送：</span></li>
								<li class="summary-stock though-line">
									<div class="dd shd_address">
										<!--<div class="addrID"><div></div><b></b></div>-->
										<div class="store-selector add_cj_p">
											<div class="text" style="width: 150px;"><div></div><b></b></div>
											<div onclick="$(this).parent().removeClass('hover')" class="close"></div>
										</div>
										<span id="dispatching_msg" <?php if($dispatching[status] != 1): ?>style="display: none;"<?php endif; ?>>有货</span>
										<select id="dispatching_select" <?php if(empty($dispatching[result]) || (($dispatching[result] instanceof \think\Collection || $dispatching[result] instanceof \think\Paginator ) && $dispatching[result]->isEmpty())): ?>style="display: none;"<?php endif; ?>>
											<?php if(is_array($dispatching[result]) || $dispatching[result] instanceof \think\Collection || $dispatching[result] instanceof \think\Paginator): $i = 0; $__LIST__ = $dispatching[result];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$patching): $mod = ($i % 2 );++$i;?>
												<option><?php echo $patching['shipping_name']; ?> ￥<?php echo $patching['freight']; ?></option>
											<?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
									</div>
								</li>

							</ul>
							<!-- 收货地址，物流运费 -end-->
							<!--------收货地址，物流运费-开始-------------->
							<script src="__PUBLIC__/js/locationJson.js"></script>
							<script src="__STATIC__/js/location.js"></script>
							<!--------收货地址，物流运费--结束-------------->
						</div>
						<?php endif; ?>
						<div class="standard p">
							<ul>
								<li class="jaj"><span>服&nbsp;&nbsp;务：</span></li>
								<li class="lawir"><span class="service">由<a href="<?php echo U('Home/Store/index',['store_id'=>$store['store_id']]); ?>"><?php echo $store['store_name']; ?></a>发货并提供售后服务</span></li>
							</ul>
						</div>
						<div class="standard p">
							<ul>
								<li class="jaj"><span>品&nbsp;&nbsp;牌：</span></li>
								<li class="lawir"><span class="service"><?php echo $goods['brand_name']; ?></span></li>
							</ul>
						</div>
						<?php if($goods['exchange_integral'] == $goods['shop_price']): ?>
							<div class="standard p">
								<ul>
									<li class="jaj"><span>可&nbsp;&nbsp;用：</span></li>
									<li class="lawir"><span class="service"><?php echo $goods['shop_price']-$goods['exchange_integral']/$point_rate; ?>+<?php echo $goods['exchange_integral']; ?>积分</span></li>
								</ul>
							</div>
							<div class="standard p">
								<ul>
									<li class="jaj"><span>可&nbsp;&nbsp;买：</span></li>
									<li class="lawir"><span class="service"><?php echo $sum; ?>个</span></li>
								</ul>
							</div>
						<?php endif; ?>
						<!-- 规格 start [[-->
						<?php if(is_array($filter_spec) || $filter_spec instanceof \think\Collection || $filter_spec instanceof \think\Paginator): if( count($filter_spec)==0 ) : echo "" ;else: foreach($filter_spec as $k=>$v): ?>
							<div class="spec_goods_price_div standard p">
								<ul>
									<li class="jaj <?php if(mb_strlen($k) > 4): ?>ls4<?php endif; ?>"><span><?php echo $k; ?>：</span></li>
									<li class="lawir colo">
										<?php if(is_array($v) || $v instanceof \think\Collection || $v instanceof \think\Paginator): if( count($v)==0 ) : echo "" ;else: foreach($v as $k2=>$v2): ?>
											<input type="radio" style="display: none" id="goods_spec_<?php echo $v2[item_id]; ?>" name="goods_spec[<?php echo $k; ?>]" value="<?php echo $v2[item_id]; ?>"/>
											<a id="goods_spec_a_<?php echo $v2[item_id]; ?>" onclick="switch_zooming('<?php echo $v2[src]; ?>'); select_filter(this);" <?php if(!empty($v2['src'])): ?>onclick="$('#zoomimg').attr('src','<?php echo $v2[src]; ?>');"<?php endif; ?>><?php echo $v2[item]; ?></a>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</li>
								</ul>
							</div>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						<!-- 规格end ]]-->
						<div class="standard p">
							<ul>
								<li class="jaj"><span>数&nbsp;&nbsp;量：</span></li>
								<li class="lawir">
									<div class="minus-plus">
										<a class="mins" href="javascript:void(0);" onclick="altergoodsnum(-1)">-</a>
										<?php if($goods['exchange_integral'] == $goods['shop_price'] && $sum ==0): ?>
											<input class="buyNum" id="number" type="text" name="goods_num" value="0" onblur="altergoodsnum(0)" max=""/>
										<?php else: ?>
											<input class="buyNum" id="number" type="text" name="goods_num" value="1" onblur="altergoodsnum(0)" max=""/>
										<?php endif; ?>
											
										<a class="add" href="javascript:void(0);" onclick="altergoodsnum(1)">+</a>
									</div>
									<div class="sav_shop">库存：<span id="spec_store_count"><?php echo $goods['store_count']; ?></span></div>
								</li>
							</ul>
						</div>
						<div class="standard p">
							<input type="hidden" name="goods_id" value="<?php echo $goods['goods_id']; ?>"/>
							<?php if($goods[is_virtual] == 1): ?>
								<input type="hidden" name="virtual_limit" id="virtual_limit" value="<?php echo $goods['virtual_limit']; ?>"/>
								<a class="paybybill" href="javascript:;" onclick="virtual_buy();">立即购买</a>
							<?php else: if($goods['exchange_integral'] == $goods['shop_price']): ?>
									<a id="join_cart_now" class="paybybill" href="javascript:;" onclick="AjaxAddCart(<?php echo $goods['goods_id']; ?>,1,1,<?php echo $goods['member_xianzhi']; ?>);">立即兑换</a>
									<a id="join_cart" class="addcar" href="javascript:;" onclick="AjaxAddCart(<?php echo $goods['goods_id']; ?>,1,0,<?php echo $goods['member_xianzhi']; ?>);"><i class="sk"></i>加入购物车</a>
								<?php else: ?>
									<a id="join_cart_now" class="paybybill" href="javascript:;" onclick="AjaxAddCart(<?php echo $goods['goods_id']; ?>,1,1);">立即购买</a>
									<a id="join_cart" class="addcar" href="javascript:;" onclick="AjaxAddCart(<?php echo $goods['goods_id']; ?>,1,0);"><i class="sk"></i>加入购物车</a>
								<?php endif; ?>
								    
									<a id="no_join_cart_now" class="paybybill" style="display:none;background: #ebebeb;color: #999;cursor: not-allowed">立即购买</a>
								    <a id="no_join_cart" class="addcar" style="display:none;background: #ebebeb;color: #999;cursor: not-allowed"><i class="sk"></i>加入购物车</a>
							<?php endif; ?>
						</div>
					</div>
				</form>
				<!--自营-s-->
				<?php if($store['store_id'] == 1): ?>
					<div class="detail-ry p">
						<div class="delogo">
							<p class="ownsj teace"><a class="byouself" href="#">平台自营</a></p>
						</div>
						<div class="quality">
							<p><i class="z-qui"></i>平台保障</p>
                            <?php if($store['certified'] == 1): ?><p><i class="z-qui"></i>正品保障</p><?php endif; if($store['qitian'] == 1): ?><p><i class="t-qui"></i>七天无理由退货</p><?php endif; ?>
						</div>
						<div class="reception p">
							<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $store['store_qq']; ?>&amp;site=qq&amp;menu=yes" target="_blank">
								<i class="detai-ico"></i>在线客服
							</a>
						</div>
						<div class="guaz_jd"></div>
					</div>
				<?php endif; ?>
				<!--自营-e-->

				<!--进驻店铺-s-->
				<?php if($store['is_own_shop'] == 1 AND $store['store_id'] > 1): ?>
					<div class="detail-ry p">
						<div class="delogo">
							<a href="<?php echo U('Home/Store/index',['store_id'=>$store['store_id']]); ?>">
								<img src="<?php echo (isset($store['store_logo']) && ($store['store_logo'] !== '')?$store['store_logo']:'__STATIC__/images/icon_store_thumb_empty.png'); ?>" />
							</a>
							<p class="ownsj cooperation">
								<a class="co_blue" href="<?php echo U('Home/Store/index',['store_id'=>$store['store_id']]); ?>"><span><?php echo $store['store_name']; ?></span></a>
	                            <?php
                                   
                                $md5_key = md5("select * from __PREFIX__store_class where sc_id = $store[sc_id]");
                                $result_name = $sql_result_s = S("sql_".$md5_key);
                                if(empty($sql_result_s))
                                {                            
                                    $result_name = $sql_result_s = \think\Db::query("select * from __PREFIX__store_class where sc_id = $store[sc_id]"); 
                                    S("sql_".$md5_key,$sql_result_s,31104000);
                                }    
                              foreach($sql_result_s as $key=>$s): ?>
	                                <a class="byouself">平台自营</a>
	                            <?php endforeach; ?>
							</p>
						</div>
						<div class="quality">
                            <p><i class="z-qui"></i>平台保障</p>
                            <?php if($store['certified'] == 1): ?><p><i class="z-qui"></i>正品保障</p><?php endif; if($store['qitian'] == 1): ?><p><i class="t-qui"></i>七天无理由退货</p><?php endif; ?>
						</div>
						<div class="reception p">
							<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $store['store_qq']; ?>&amp;site=qq&amp;menu=yes" target="_blank">
								<i class="detai-ico"></i>在线客服
							</a>
						</div>
						<div class="intoshop p">
							<a href="<?php echo U('Home/Store/index',['store_id'=>$store['store_id']]); ?>">
								进入店铺
							</a>
						</div>
						<div class="guaz_jd"></div>
					</div>
				<?php endif; ?>
				<!--进驻店铺-e-->

				<!--合作商家自营-s-->
				<?php if($store['is_own_shop'] == 0 AND $store['store_id'] > 1): ?>
					<div class="detail-ry p">
					<div class="delogo">
						<a href="<?php echo U('Home/Store/index',['store_id'=>$store['store_id']]); ?>">
							<img src="<?php echo $store['store_logo']; ?>"/>
							<span><?php echo $store['store_name']; ?></span>
						</a>
					</div>
					<div class="line1 p">
						<span class="f_voc">店铺总分：</span>
						<a class="nel_tt" href="javascript:void(0);"><i style="width: <?php echo $commentStoreStatistics['store_servicecredit']*20; ?>%;"></i></a>
						<span class="lasen"><em><?php echo $commentStoreStatistics['store_servicecredit']; ?></em>分</span>
					</div>
					<div class="comment_pen p">
						<ul>
							<li><span>评分明细</span></li>
							<li><span>与行业相比</span></li>
						</ul>
						<ul>
							<li><span>商品<em><?php echo $commentStoreStatistics['store_desccredit']; ?></em></span></li>
							<li><span><?php echo abs($comparisonStatistics['desccredit_match'] ); ?>%<i class="detai-ico <?php if($comparisonStatistics[desccredit_match] <= 0): ?>ruin<?php endif; ?>"></i></span></li>
						</ul>
						<ul>
							<li><span>服务<em><?php echo $commentStoreStatistics['store_servicecredit']; ?></em></span></li>
							<li><span><?php echo abs($comparisonStatistics['servicecredit_match'] ); ?>%<i class="detai-ico <?php if($comparisonStatistics[servicecredit_match] <= 0): ?>ruin<?php endif; ?>"></i></span></li>
						</ul>
						<ul>
							<li><span>时效<em><?php echo $commentStoreStatistics['store_deliverycredit']; ?></em></span></li>
							<li><span><?php echo abs($comparisonStatistics['deliverycredit_match'] ); ?>%<i class="detai-ico <?php if($comparisonStatistics[deliverycredit_match] <= 0): ?>ruin<?php endif; ?>"></i></span></li>
						</ul>
					</div>
					<div class="address_com p">
						<ul>
							<li class="compan"><span>公司：</span></li>
							<li class="pan_add"><span><?php echo $store['company_name']; ?></span></li>
						</ul>
						<ul>
							<li class="compan"><span>所在地：</span></li>
							<li class="pan_add area_add">
								<span>
									<?php
                                   
                                $md5_key = md5("select * from __PREFIX__region where id = $store[province_id]");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from __PREFIX__region where id = $store[province_id]"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $key=>$v): ?>
										<?php echo $v['name']; endforeach; ?>
								</span>
								<span>
									<?php
                                   
                                $md5_key = md5("select * from __PREFIX__region where id = $store[city_id]");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from __PREFIX__region where id = $store[city_id]"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $key=>$v): ?>
										<?php echo $v['name']; endforeach; ?>
								</span>
							</li>
						</ul>
					</div>
					<div class="reception p">
						<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $store['store_qq']; ?>&amp;site=qq&amp;menu=yes" target="_blank">
							<i class="detai-ico"></i>在线客服
						</a>
					</div>
					<div class="guaz_jd">
						<a href="<?php echo U('Home/Store/index',['store_id'=>$store['store_id']]); ?>">进店逛逛</a>
						<a id="favoriteStore" data-id="<?php echo $store['store_id']; ?>">关注店铺</a>
					</div>
				</div>
				<?php endif; ?>
				<!--合作商家自营-e-->
			</div>
		</div>
		<div class="detail-main p">
			<div class="w1224">
				<div class="deta-le-ma">
					<div class="type_more">
						<div class="type-top">
							<h2>店铺搜索</h2>
						</div>
						<div class="type-bot">
							<form action="<?php echo U('Home/Goods/search'); ?>" method="post">
								<input type="hidden" name="store_id" value="<?php echo $store['store_id']; ?>">
								<div class="gjz_de">
									<span class="gjz_fi">关键字</span>
									<input class="srk_fi" type="text" name="q" id="q" value="" />
								</div>
								<div class="gjz_de">
									<span class="gjz_fi">价&nbsp;&nbsp;&nbsp;&nbsp;格</span>
									<input class="pr_fi" type="text" name="start_price" id="start_price" value="" placeholder="￥" />
									<span>-</span>
									<input class="pr_fi" type="text" name="end_price" id="end_price" value="" placeholder="￥" />
								</div>
								<div class="gjz_de">
									<span class="gjz_fi"></span>
									<input class="sub_tj" type="submit" value="搜索"/>
								</div>
								<!--
								<p class="ti_litt">
									<?php if(is_array($tpshop_config['hot_keywords']) || $tpshop_config['hot_keywords'] instanceof \think\Collection || $tpshop_config['hot_keywords'] instanceof \think\Paginator): if( count($tpshop_config['hot_keywords'])==0 ) : echo "" ;else: foreach($tpshop_config['hot_keywords'] as $k=>$wd): ?>
										<a href="<?php echo U('Home/Goods/search',array('q'=>$wd)); ?>"><?php echo $wd; ?></a>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</p>
								-->
							</form>
						</div>
					</div>
					<div class="type_more ma-to-20">
						<div class="type-top">
							<h2>相关分类</h2>
						</div>
						<div class="type-bot">
							<ul class="xg_typ">
								<?php if(is_array($main_cat) || $main_cat instanceof \think\Collection || $main_cat instanceof \think\Paginator): if( count($main_cat)==0 ) : echo "" ;else: foreach($main_cat as $key=>$vo): ?>
								<li><a href="<?php echo U('Store/goods_list',array('cat_id'=>$vo[cat_id],'store_id'=>$store[store_id])); ?>"><?php echo $vo['cat_name']; ?></a></li>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
					<div class="type_more ma-to-20">
						<div class="type-top">
							<h2>品牌推荐</h2>
						</div>
						<div class="type-bot">
							<ul class="xg_typ">
								<?php
                                   
                                $md5_key = md5("select * from __PREFIX__brand where cat_name = '$brand[cat_name]' and status = 0 ORDER BY sort");
                                $result_name = $sql_result_brand_list = S("sql_".$md5_key);
                                if(empty($sql_result_brand_list))
                                {                            
                                    $result_name = $sql_result_brand_list = \think\Db::query("select * from __PREFIX__brand where cat_name = '$brand[cat_name]' and status = 0 ORDER BY sort"); 
                                    S("sql_".$md5_key,$sql_result_brand_list,31104000);
                                }    
                              foreach($sql_result_brand_list as $key=>$brand_list): ?>
									<li><a href="<?php echo U('Home/Goods/goodsList',['id'=>$goods['cat_id1'],'brand_id'=>$brand_list['id']]); ?>"><?php echo $brand_list['name']; ?></a></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
					<div class="type_more ma-to-20">
						<div class="type-top">
							<h2>热搜推荐</h2>
						</div>
						<div class="type-bot">
							<ul class="xg_typ">
								<?php if(is_array($tpshop_config['hot_keywords']) || $tpshop_config['hot_keywords'] instanceof \think\Collection || $tpshop_config['hot_keywords'] instanceof \think\Paginator): if( count($tpshop_config['hot_keywords'])==0 ) : echo "" ;else: foreach($tpshop_config['hot_keywords'] as $k=>$wd): ?>
									<li><a href="<?php echo U('Home/Goods/search',array('q'=>$wd)); ?>"><?php echo $wd; ?></a></li>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
					<div class="type_more ma-to-20">
						<div class="type-top">
							<h2>看了又看</h2>
						</div>
						<div class="tjhot-shoplist type-bot">
							<?php if(is_array($look_see) || $look_see instanceof \think\Collection || $look_see instanceof \think\Paginator): if( count($look_see)==0 ) : echo "" ;else: foreach($look_see as $key=>$look): ?>
								<div class="alone-shop">
									<a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$look[goods_id])); ?>"><img src="<?php echo goods_thum_images($look['goods_id'],206,206); ?>" style="display: inline;"></a>
									<p class="line-two-hidd"><a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$look[goods_id])); ?>"><?php echo getSubstr($look['goods_name'],0,30); ?></a></p>
									<!-- <div><p class="price-tag">市场价：<span class="li_xfo">￥</span><span><?php echo $look['market_price']; ?></span></p></div> -->
									<div><p class="price-tag">商城价：<span class="li_xfo">￥</span><span><?php echo $look['shop_price']; ?></span></p></div>
									<!-- <div><p class="price-tag">会员价：<span class="li_xfo"><em class="li_xfo">￥<?php echo $goods['shop_price']-$goods['exchange_integral']/$point_rate; ?>+<?php echo $goods['exchange_integral']; ?>积分</em></span></p></div> -->
									    
									
									
									<!--<p class="store-alone"><a href="">恒要达食品专享店</a></p>-->
								</div>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
				</div>
				<div class="deta-ri-ma">
					<div class="introduceshop">
						<div class="datail-nav-top">
							<ul>
								<li class="red"><a href="javascript:void(0);">商品介绍</a></li>
								<li><a href="javascript:void(0);">规格及包装</a></li>
								<li><a href="javascript:void(0);">评价<em>(<?php echo $commentStatistics['c0']; ?>)</em></a></li>
								<li><a href="javascript:void(0);">售后服务</a></li>
							</ul>
						</div>
						<!--<div class="he-nav"></div>-->
						<div class="shop-describe shop-con-describe p">
							<div class="deta-descri">
								<p class="shopname_de"><span>商品名称：</span><span><?php echo $goods['goods_name']; ?></span></p>
								<div class="ma-d-uli p">
									<ul>
										<li><span>品牌：</span><span><?php echo $goods['brand_name']; ?></span></li>
										<li><span>货号：</span><span><?php echo $goods['goods_sn']; ?></span></li>
										<?php if(is_array($goods_attr_list) || $goods_attr_list instanceof \think\Collection || $goods_attr_list instanceof \think\Paginator): if( count($goods_attr_list)==0 ) : echo "" ;else: foreach($goods_attr_list as $k=>$v): ?>
										<li><span><?php echo $goods_attribute[$v[attr_id]]; ?>：</span><span><?php echo $v[attr_value]; ?></span></li>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div>

								<div class="moreparameter">
									<!--
									<a href="">跟多参数<em>>></em></a>
									-->
								</div>
							</div>
							<div class="detail-img-b">
								<?php echo htmlspecialchars_decode($goods['goods_content']); ?>
							</div>
						</div>
						<div class="shop-describe shop-con-describe p" style="display: none;">
							<div class="deta-descri">
								<!--
								<p class="shopname_de"><span>如果您发现商品信息不准确，<a class="de_cb" href="">欢迎纠错</a></span></p>
								-->
								<h2 class="shopname_de">属性</h2>
								<?php if(is_array($goods_attr_list) || $goods_attr_list instanceof \think\Collection || $goods_attr_list instanceof \think\Paginator): if( count($goods_attr_list)==0 ) : echo "" ;else: foreach($goods_attr_list as $k=>$v): ?>
									<div class="twic_a_alon">
										<p class="gray_t"><?php echo $goods_attribute[$v[attr_id]]; ?></p>
										<p><?php echo $v[attr_value]; ?></p>
									</div>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
						</div>
						<div class="shop-con-describe p" style="display: none;">
							<div class="shop-describe p">
								<div class="comm_stsh ma-to-20">
									<div class="deta-descri">
										<h2>商品评价</h2>
									</div>
								</div>
								<div class="deta-descri p">
									<ul class="tebj">
										<li class="percen"><span><?php echo $commentStatistics['rate1']; ?>%</span></li>
										<li class="co-cen">
											<div class="comm_gooba">
												<div class="gg_c">
													<span class="hps">好评</span>
													<span class="hp">（<?php echo $commentStatistics['rate1']; ?>%）</span>
													<span class="zz_rg"><i style="width: <?php echo $commentStatistics['rate1']; ?>%;"></i></span>
												</div>
												<div class="gg_c">
													<span class="hps">中评</span>
													<span class="hp">（<?php echo $commentStatistics['rate2']; ?>%）</span>
													<span class="zz_rg"><i style="width: <?php echo $commentStatistics['rate2']; ?>%;"></i></span>
												</div>
												<div class="gg_c">
													<span class="hps">差评</span>
													<span class="hp">（<?php echo $commentStatistics['rate3']; ?>%）</span>
													<span class="zz_rg"><i style="width: <?php echo $commentStatistics['rate3']; ?>%;"></i></span>
												</div>
											</div>
										</li>
										<li class="tjd-sum">
											<p class="tjd">推荐点：</p>
											<div class="tjd-a">
												<?php if(is_array($goodsTotalComment) || $goodsTotalComment instanceof \think\Collection || $goodsTotalComment instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($goodsTotalComment) ? array_slice($goodsTotalComment,0,8, true) : $goodsTotalComment->slice(0,8, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
													<a><?php echo $key; ?></a>
												<?php endforeach; endif; else: echo "" ;endif; if(!(empty($goodsTotalComment) || (($goodsTotalComment instanceof \think\Collection || $goodsTotalComment instanceof \think\Paginator ) && $goodsTotalComment->isEmpty()))): ?>
													<a><?php echo $key; ?></a>
												<?php endif; ?>
											</div>
										</li>
										<li class="te-cen">
											<div class="nchx_com">
												<p>您可以对已购的商品进行评价</p>
												<a class="jfnuv" href="<?php echo U('Home/Order/comment'); ?>">发表评论</a>
												<!--<p class="xja"><span>详见</span><a class="de_cb" href="">积分规则</a></p>-->
											</div>
										</li>
									</ul>
								</div>
								<div class="deta-descri p">
									<div class="cte-deta">
										<ul id="fy-comment-list">
											<li data-t="1" class="red">
												<a href="javascript:void(0);" class="selected">全部评论（<?php echo $commentStatistics['c0']; ?>）</a>
											</li>
											<li data-t="2">
												<a href="javascript:void(0);">好评（<?php echo $commentStatistics['c1']; ?>）</a>
											</li>
											<li data-t="3">
												<a href="javascript:void(0);">中评（<?php echo $commentStatistics['c2']; ?>）</a>
											</li>
											<li data-t="4">
												<a href="javascript:void(0);">差评（<?php echo $commentStatistics['c3']; ?>）</a>
											</li>
											<li data-t="5">
												<a href="javascript:void(0);">晒单（<?php echo $commentStatistics['c4']; ?>）</a>
											</li>

										</ul>
									</div>
								</div>
								<div class="line-co-sunall"  id="ajax_comment_return">
									<?php if(is_array($commentlist) || $commentlist instanceof \think\Collection || $commentlist instanceof \think\Paginator): $i = 0; $__LIST__ = $commentlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
										<div class="people-comment">
											<div class="deta-descri p">
												<div class="person-ph-name">
													<div class="per-img-n p">
														<div class="img-aroun"><img src="<?php echo (isset($v['head_pic']) && ($v['head_pic'] !== '')?$v['head_pic']:'__STATIC__/images/defaultface_user_small.png'); ?>"/></div>
														<div class="menb-name">
															<?php if($v['is_anonymous'] == 0): ?>
																匿名用户
																<?php else: ?>
																<?php echo $v['nickname']; endif; ?>
														</div>
													</div>
													<!--<p class="member">金牌会员</p>-->
												</div>
												<div class="person-com">
													<div class="lifr4 p">
														<div class="dstar start5">
															<i class="start start<?php echo floor($v['goods_rank']); ?>"></i>
														</div>
														<div class="star-aftr">
															<?php $impression_arr= explode(',',$v['impression']);
																if(empty($v['impression'])){
																}else{
																foreach($impression_arr as $key)
																{
																echo "<a>".$key."</a>";
																}
																}
															 ?>
															<!--<a href="javascript:void(0);">非常漂亮</a>-->
														</div>
													</div>
													<div class="lifr4 comfis p">
														<span class="faisf"><?php echo htmlspecialchars_decode($v['content']); ?></span>
													</div>
													<div class="lifr4 requiimg p">
														<ul class="comment_images" id="comment_images_<?php echo $v[comment_id]; ?>">
															<?php if(is_array($v['img']) || $v['img'] instanceof \think\Collection || $v['img'] instanceof \think\Paginator): if( count($v['img'])==0 ) : echo "" ;else: foreach($v['img'] as $key=>$v2): ?>
																<a><li><img data-original="<?php echo $v2; ?>" src="<?php echo $v2; ?>"/></li></a>
															<?php endforeach; endif; else: echo "" ;endif; ?>
														</ul>
														<script>
															var viewer = new Viewer(document.getElementById('comment_images_<?php echo $v[comment_id]; ?>'), {
																url: 'data-original',
																show: function() {
																	$('.soubao-sidebar').hide();
																},
																hide: function() {
																	$('.soubao-sidebar').show();
																}
															});
														</script>
													</div>
													<div class="lifr4 bolist p">
														<span><?php echo date("Y-m-d H:i:s",$v['pay_time']); ?></span>
														<span><?php echo htmlspecialchars_decode($v['spec_key_name']); ?></span>
														<span>购买<?php echo round(($v['add_time']-$v['pay_time'])/3600/24); ?>天后评价</span>
														<!--<span>来自Android客户端</span>-->
													</div>
												</div>
												<div class="g_come">
													<a href="javascript:void(0);"><i class="detai-ico c-cen"></i><?php echo $v['reply_num']; ?></a>
													<a href="javascript:void(0);" onclick="zan(this);"  data-comment-id="<?php echo $v['comment_id']; ?>"><i class="detai-ico z-ten"></i><span id="span_zan_<?php echo $v['comment_id']; ?>" data-io="<?php echo $v['zan_num']; ?>"><?php echo $v['zan_num']; ?></span></a>
												</div>
											</div>
											<div class="reply-textarea">
												<div class="reply-arrow"><b class="layer1"></b><b class="layer2"></b></div>
												<div class="inner">
													<textarea class="reply-input J-reply-input" data-id="replytext_<?php echo $v['comment_id']; ?>" placeholder="回复 <?php echo $v['nick_name']; ?>：" maxlength="120"></textarea>
													<div class="operate-box">
														<span class="txt-countdown">还可以输入<em>120</em>字</span>
														<a class="reply-submit J-submit-reply J-submit-reply-lz" href="javascript:void(0);" target="_self">提交</a>
													</div>
												</div>
											</div>
											<!-- 商家回复-s -->
											<?php if(is_array($v['seller_comment']) || $v['seller_comment'] instanceof \think\Collection || $v['seller_comment'] instanceof \think\Paginator): $k = 0; $__LIST__ = $v['seller_comment'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sc): $mod = ($k % 2 );++$k;?>
												<div class="comment-replylist">
													<div class="comment-reply-item hide" style="display: block;">
														<div class="reply-infor clearfix">
															<div class="main">
                            <span class="user-name" style="color: red;">商家回复
                            </span> ：
																<span class="words"><?php echo $sc['content']; ?></span>
															</div>
															<div class="side">
																<span class="date"><?php echo date('Y-m-d H:i:s',$sc['add_time']); ?></span>
															</div>
														</div>
													</div>
												</div>
											<?php endforeach; endif; else: echo "" ;endif; ?>
											<!-- 商家回复-d -->
											<!--用户回复评论-s-->
											<div class="comment-replylist">
												<?php if(is_array($v['parent_id']) || $v['parent_id'] instanceof \think\Collection || $v['parent_id'] instanceof \think\Paginator): $k = 0; $__LIST__ = $v['parent_id'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$reply_list): $mod = ($k % 2 );++$k;if($k < 6): ?>
														<div class="comment-reply-item hide" data-vender="0" data-name="<?php echo $reply_list['user_name']; ?>" data-uid="" style="display: block;">
															<div class="reply-infor clearfix">
																<div class="main">
                  <span class="user-name"><?php echo $reply_list['user_name']; if(strtoupper($reply_list['to_name']) != ''): ?>&nbsp;<font style="color: #1a2226">回复</font>&nbsp;<?php echo $reply_list['to_name']; endif; ?>
                  </span> ：
																	<span class="words"><?php echo $reply_list['content']; ?></span>
																</div>
																<div class="side">
																	<span class="date"><?php echo date('Y-m-d H:i:s',$reply_list['reply_time']); ?></span>
																</div>
															</div>
															<div class="comment-operate">
																<a class="reply J-reply-trigger" href="#none" target="_self">回复</a>
																<div class="reply-textarea">
																	<div class="reply-arrow"><b class="layer1"></b><b class="layer2"></b></div>
																	<div class="inner">
																		<textarea class="reply-input J-reply-input" data-id="replytext_<?php echo $v['comment_id']; ?>" placeholder="回复<?php echo $reply_list['user_name']; ?>：" maxlength="120"></textarea>
																		<div class="operate-box">
																			<span class="txt-countdown">还可以输入<em>120</em>字</span>
																			<a class="reply-submit J-submit-reply J-submit-reply-lz" href="javascript:void(0);" data-id="<?php echo $reply_list['reply_id']; ?>" onclick="" target="_self">提交</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													<?php endif; endforeach; endif; else: echo "" ;endif; if($v['reply_num'] > 5): ?>
													<div class="view-all-reply show">
														<a href="<?php echo U('Home/Goods/reply',array('comment_id'=>$v['comment_id'])); ?>" class="view-link reply">查看全部回复</a>
													</div>
												<?php endif; ?>
											</div>
											<!--用户回复评论-e-->
										</div>
									<?php endforeach; endif; else: echo "" ;endif; ?>
									<div class="operating fixed" id="bottom">
										<div class="fn_page clearfix">
											<?php echo $page; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="shop-con-describe p" style="display: none;">
							<div class="shop-describe p">
								<div class="comm_stsh ma-to-20">
									<div class="deta-descri">
										<h2>售后保障</h2>
									</div>
								</div>
								<div class="deta-descri p">
									<div class="securi-afr">
										<ul>
											<li class="frhe"><i class="detai-ico msz1"></i></li>
											<li class="wnuzsuhe">
												<h2>卖家服务</h2>
												<p>全国联保一年</p>
											</li>
										</ul>
										<ul>
											<li class="frhe"><i class="detai-ico msz2"></i></li>
											<li class="wnuzsuhe">
												<h2>商城承诺</h2>
												<p>商城平台卖家销售并发货的商品，由平台卖家提供发票和相应的售后服务。请您放心购买！
注：因厂家会在没有任何提前通知的情况下更改产品包装、产地或者一些附件，本司不能确保客户收到的货物与商城图片、产地、附件说明完全一致。
只能确保为原厂正货！并且保证与当时市场上同样主流新品一致。若本商城没有及时更新，请大家谅解！</p>
											</li>
										</ul>
										<ul>
											<li class="frhe"><i class="detai-ico msz3"></i></li>
											<li class="wnuzsuhe">
												<h2>正品行货</h2>
												<p>商城向您保证所售商品均为正品行货，商城自营商品开具机打发票或电子发票。</p>
											</li>
										</ul>
										<ul>
											<li class="frhe"><i class="detai-ico msz4"></i></li>
											<li class="wnuzsuhe">
												<h2>全国联保</h2>
												<p>凭质保证书及商城发票，可享受全国联保服务（奢侈品、钟表除外；奢侈品、钟表由联系保修，享受法定三包售后服务），与您亲临商场选购的商品享
受相同的质量保证。商城还为您提供具有竞争力的商品价格和运费政策，请您放心购买！ </p>
											</li>
										</ul>
										<ul>
											<li class="frhe"><i class="detai-ico msz5"></i></li>
											<li class="wnuzsuhe">
												<h2>退货无忧</h2>
												<p>客户购买商城自营商品7日内（含7日，自客户收到商品之日起计算），在保证商品完好的前提下，可无理由退货。（部分商品除外，详情请见各商品细则）</p>
											</li>
										</ul>
									</div>
								</div>
								<div class="comm_stsh ma-to-20">
									<div class="deta-descri">
										<h2>退款说明</h2>
									</div>
								</div>
								<div class="deta-descri p">
									<div class="fetbajc">
										<p>1.若您购买的家电商品已经拆封过，需要退换货，需请联系原厂开具鉴定检测单</p>
										<p>2.签收商品隔日起七日内提交退货申请，2-3天快递员与您联系安排取回商品</p>
										<p>3.商品退回检验，且必须附上检测单</p>
										<p>5.若退回商品有缺件、影响二次销售状况时，退款作业将暂时停止，飞牛网会依商品状况报价，后由客服人员与您联系说明并于订单内扣除费用后退回剩余款项，
或您可以取消退货申请；若符合退货条件者将于商品取回后约1-2个工作日内完成退款</p>
										<p>4.通过线上支付的订单办理退货，商品退回检验无误后，商城将提交退款申请, 实际款项会依照各银行作业时间返还至您原支付方式 若您采用货到付款，请于
办理退货时提供退款账户，亦于商品退回检验无误后，将退款汇至您的银行账户中</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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
        <a class="mod_copyright_auth_ico mod_copyright_auth_ico_6" href="" target="_blank">网络举报APP下载</a>
    </p>
</div>
			</div>
			<div class="soubao-sidebar">
    <div class="soubao-sidebar-bg"></div>
    <div class="sidertabs tab-lis-1">
        <div class="sider-top-stra sider-midd-1">
            <div class="icon-tabe-chan">
                <a href="<?php echo U('Home/User/index'); ?>">
                    <i class="share-side share-side1"></i>
                    <i class="share-side tab-icon-tip triangleshow"></i>
                </a>
                <div class="dl_login">
                    <div class="hinihdk">
                        <img class="head_pic" src="__STATIC__/images/dl.png"/>
                        <p class="loginafter nologin"><span>你好，请先</span><a href="<?php echo U('Home/user/login'); ?>">登录</a>！</p>
                        <!--未登录-e--->
                        <!--登录后-s--->
                        <p class="loginafter islogin"><span class="id_jq userinfo">陈xxxxxxx</span><span>点击</span><a href="<?php echo U('Home/user/logout'); ?>">退出</a>！</p>
                        <!--未登录-s--->
                    </div>
                </div>
            </div>
            <div class="icon-tabe-chan shop-car">
                <a href="javascript:void(0);" onclick="ajax_side_cart_list()">
                    <div class="tab-cart-tip-warp-box">
                        <div class="tab-cart-tip-warp">
                            <i class="share-side share-side1"></i>
                            <i class="share-side tab-icon-tip"></i>
                            <span class="tab-cart-tip">购物车</span>
                            <span class="tab-cart-num J_cart_total_num" id="tab_cart_num">0</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="icon-tabe-chan massage">
                <a href="<?php echo U('Home/User/message_notice'); ?>" target="_blank">
                    <i class="share-side share-side1"></i>
                    <!--<i class="share-side tab-icon-tip"></i>-->
                    <span class="tab-tip">消息</span>
                </a>
            </div>
        </div>
        <div class="sider-top-stra sider-midd-2">
            <div class="icon-tabe-chan mmm">
                <a href="<?php echo U('Home/User/goods_collect'); ?>" target="_blank">
                    <i class="share-side share-side1"></i>
                    <!--<i class="share-side tab-icon-tip"></i>-->
                    <span class="tab-tip">收藏</span>
                </a>
            </div>
            <div class="icon-tabe-chan hostry">
                <a href="<?php echo U('Home/User/visit_log'); ?>" target="_blank">
                    <i class="share-side share-side1"></i>
                    <!--<i class="share-side tab-icon-tip"></i>-->
                    <span class="tab-tip">足迹</span>
                </a>
            </div>
            <!-- <div class="icon-tabe-chan sign">
                 <a href="" target="_blank">
                    <i class="share-side share-side1"></i>
                    <i class="share-side tab-icon-tip"></i>
                    <span class="tab-tip">签到</span>
                </a> 
            </div> -->
        </div>
    </div>
    <div class="sidertabs tab-lis-2">
        <div class="icon-tabe-chan advice">
            <a href="tencent://message/?uin=<?php echo $tpshop_config['shop_info_qq']; ?>&amp;Site=<?php echo $tpshop_config['shop_info_store_name']; ?>&amp;Menu=yes">
                <i class="share-side share-side1"></i>
                <!--<i class="share-side tab-icon-tip"></i>-->
                <span class="tab-tip">在线咨询</span>
            </a>
        </div>
        <!-- <div class="icon-tabe-chan request">
            <a href="" target="_blank">
                <i class="share-side share-side1"></i>
                <i class="share-side tab-icon-tip"></i>
                <span class="tab-tip">意见反馈</span>
            </a>
        </div> -->
       <!--  <div class="icon-tabe-chan qrcode">
            <a href="" target="_blank">
                <i class="share-side share-side1"></i>
                <i class="share-side tab-icon-tip triangleshow"></i>
				<span class="tab-tip qrewm">
					<img src="__STATIC__/images/qrcode.png"/>
					扫一扫下载APP
				</span>
            </a>
        </div> -->
        <div class="icon-tabe-chan comebacktop">
            <a href="" target="_blank">
                <i class="share-side share-side1"></i>
                <!--<i class="share-side tab-icon-tip"></i>-->
                <span class="tab-tip">返回顶部</span>
            </a>
        </div>
    </div>
    <div class="shop-car-sider">

    </div>
</div>
<script src="__STATIC__/js/common.js"></script>
<script>
    //侧边栏
    $(function(){
        $('.shop-car').click(function(){
            //购物车
            if($('.shop-car-sider').hasClass('sh-hi')){
                $('.shop-car-sider').animate({left:'35px',opacity:'hide'},'normal',function(){
                    $('.shop-car-sider').removeClass('sh-hi');
                    $('.shop-car .tab-cart-tip-warp-box').css('background-color','');
                    $('.shop-car .tab-icon-tip').removeClass('jsshow');
                });
            }else{
                $('.shop-car-sider').animate({left:'-280px',opacity:'show'},'normal',function(){
                    $('.shop-car-sider').addClass('sh-hi');
                    $('.shop-car .tab-cart-tip-warp-box').css('background-color','#e23435');
                    $('.shop-car .tab-icon-tip').addClass('jsshow');
                });
            }

        })
        $(".comebacktop").click(function () {
            //回到顶部
            var speed=300;//滑动的速度
            $('body,html').animate({ scrollTop: 0 }, speed);
            return false;
        });
    });
</script>

		</div>
		<!--footer-e-->
		<script src="__STATIC__/js/lazyload.min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="__STATIC__/js/headerfooter.js" ></script>
		<script type="text/javascript">
			var commentType = 1;// 默认评论类型
			var spec_goods_price = <?php echo (isset($spec_goods_price) && ($spec_goods_price !== '')?$spec_goods_price:'null'); ?>;//规格库存价格

			$(document).ready(function () {
				/*商品缩略图放大镜*/
				$(".jqzoom").jqueryzoom({
					xzoom: 500,
					yzoom: 500,
					offset: 1,
					position: "right",
					preload: 1,
					lens: 1
				});
				initSpec();
				initGoodsPrice();
			});
			//有规格id的时候，解析规格id选中规格
			function initSpec(){
				var item_id = $("input[name='item_id']").val();
				$.each(spec_goods_price,function(i, o){
					if(o.item_id == item_id){
						var spec_key_arr = o.key.split("_");
						$.each(spec_key_arr,function(index,item){
							var spec_radio = $("#goods_spec_"+item);
							var goods_spec_a = $("#goods_spec_a_"+item);
							spec_radio.attr("checked","checked");
							goods_spec_a.addClass('red');
						})
					}
				})
				if(item_id > 0 && spec_goods_price.length != 0){
					var item_arr = [];
					$.each(spec_goods_price,function(i, o){
						item_arr.push(o.item_id);
					})
					//规格id不存在商品里
					if($.inArray(parseInt(item_id), item_arr) < 0){
						initFirstSpec();
					}else{
						$.each(spec_goods_price,function(i, o){
							if(o.item_id == item_id){
								var spec_key_arr = o.key.split("_");
								$.each(spec_key_arr,function(index,item){
									var spec_radio = $("#goods_spec_"+item);
									var goods_spec_a = $("#goods_spec_a_"+item);
									spec_radio.attr("checked","checked");
									goods_spec_a.addClass('red');
								})
							}
						})
					}
				}else{
					initFirstSpec();
				}
			}
			//默认让每种规格第一个选中
			function initFirstSpec(){
				$('.spec_goods_price_div').each(function (i, o) {
					var firstSpecRadio = $(this).find("input[type='radio']").eq(0);
					firstSpecRadio.attr('checked','checked');
					firstSpecRadio.parent().find('a').eq(0).addClass('red');
				})
			}
            /**
             * 切换规格
             * @author lxl
             */
            function select_filter(obj)
            {
                $(obj).addClass('red').siblings('a').removeClass('red');
                $(obj).siblings('input').removeAttr('checked');
                $(obj).prev('input').attr('checked','checked'); // 让隐藏的 单选按钮选中
                // 更新商品价格
				initGoodsPrice();
            }
            
			//缩略图切换
			$('.small-pic-li').each(function (i, o) {
				var lilength = $('.small-pic-li').length;
				$(o).hover(function () {
					$(o).siblings().removeClass('active');
					$(o).addClass('active');
					$('#zoomimg').attr('src', $(o).find('img').attr('data-img'));
					$('#zoomimg').attr('jqimg', $(o).find('img').attr('data-big'));

					$('.next-btn').removeClass('disabled');
					if (i == 0) {
						$('.next-left').addClass('disabled');
					}
					if (i + 1 == lilength) {
						$('.next-right').addClass('disabled');
					}
				});
			})

            function virtual_buy() {
                var store_count = $("input[name='store_count']").attr('value');// 商品原始库存
                var buynum = parseInt($('.buyNum').val());
                var virtual_limit = parseInt($('#virtual_limit').val());
                if ((buynum <= store_count && buynum <= virtual_limit) || (buynum < store_count && virtual_limit == 0)) {
                    $('#buy_goods_form').submit();
                } else {
                    layer.msg('购买数量超过此商品购买上限', {icon: 3});
                }
            }

			//前一张缩略图
			$('.next-left').click(function () {
				var newselect = $('.small-pic>.active').prev();
				$('.small-pic>.active').removeClass('active');
				$(newselect).addClass('active');
				$('#zoomimg').attr('src', $(newselect).find('img').attr('data-img'));
				$('#zoomimg').attr('jqimg', $(newselect).find('img').attr('data-big'));
				var index = $('.small-pic>li').index(newselect);
				if (index == 0) {
					$('.next-left').addClass('disabled');
				}
				$('.next-right').removeClass('disabled');
			})

			//后前一张缩略图
			$('.next-right').click(function () {
				var newselect = $('.small-pic>.active').next();
				$('.small-pic>.active').removeClass('active');
				$(newselect).addClass('active');
				$('#zoomimg').attr('src', $(newselect).find('img').attr('data-img'));
				$('#zoomimg').attr('jqimg', $(newselect).find('img').attr('data-big'));
				var index = $('.small-pic>li').index(newselect);
				if (index + 1 == $('.small-pic>li').length) {
					$('.next-right').addClass('disabled');
				}
				$('.next-left').removeClass('disabled');
			})
			
			$(function() {
				$("#area").click(function (e) {
					SelCity(this,e);
				});
				
				$('.colo a').click(function(){
					$(this).addClass('red').siblings('a').removeClass('red');
				})
				// 好评差评 切换
				$('.cte-deta ul li').click(function(){
					$(this).addClass('red').siblings().removeClass('red');
					commentType = $(this).data('t');// 评价类型   好评 中评  差评
					ajaxComment(commentType,1);
				})
				
				$('.datail-nav-top ul li').click(function(){
					$(this).addClass('red').siblings().removeClass('red');
					var er = $('.datail-nav-top ul li').index(this);
					$('.shop-con-describe').eq(er).show().siblings('.shop-con-describe').hide();
				})
			});

            /**
             * 加减数量
             * n 点击一次要改变多少
             * maxnum 允许的最大数量(库存)
             * number ，input的id
             */
            function altergoodsnum(n){
                var num = parseInt($('#number').val());
                var maxnum = parseInt($('#number').attr('max'));
                var sum= $('input[name="sum"]').attr('value');//会员限制购买数量
                var exchange_integral = $("input[name='exchange_integral']").attr('value');
                var member_xianzhi= $('input[name="member_xianzhi"]').attr('value');//会员限制购买数量
                var shop_price= $('input[name="shop_price"]').attr('value');//商品价格
                var ab_str = shop_price.toString();
                var ab_num = parseInt(ab_str.substring(0,ab_str.indexOf('.')));
                if(sum==0){
                	layer.msg('本商品为全积分购买，每人限购'+member_xianzhi+'件', {icon: 2});
                }
                if(exchange_integral==ab_num){
                	num += n;
                    num <= 0 ? num = 1 :  num;
                    if(num >= sum){
                        $(this).addClass('no-mins');
                        num = sum;
                    }
                    
                    $('#store_count').text(sum-num); //更新库存数量
                    $('#number').val(num)
                }else{
                	 num += n;
                     num <= 0 ? num = 1 :  num;
                     if(num >= maxnum){
                         $(this).addClass('no-mins');
                         num = maxnum;
                     }
                     $('#store_count').text(maxnum-num); //更新库存数量
                     $('#number').val(num)
                }
               
            }

			//初始化商品价格库存
			function initGoodsPrice() {
				var goods_id = $('input[name="goods_id"]').val();
				if (spec_goods_price.length != 0) {
					var goods_spec_arr = [];
					$("input[name^='goods_spec']").each(function () {
						if($(this).attr('checked') == 'checked'){
							goods_spec_arr.push($(this).val());
						}
					});
					var spec_key = goods_spec_arr.sort(sortNumber).join('_');  //排序后组合成 key
					var item_id = spec_goods_price[spec_key]['item_id'];
					$('input[name=item_id]').val(item_id);
				}
				$.ajax({
					type: 'post',
					dataType: 'json',
					data: {goods_id: goods_id, item_id: item_id},
					url: "<?php echo U('Home/Goods/activity'); ?>",
					success: function (data) {
						if (data.status == 1) {
							$('input[name="goods_prom_type"]').attr('value', data.result.goods.prom_type);//商品活动类型
							$('input[name="shop_price"]').attr('value', data.result.goods.shop_price);//商品价格
							$('input[name="store_count"]').attr('value', data.result.goods.store_count);//商品库存
							$('input[name="market_price"]').attr('value', data.result.goods.market_price);//商品原价
							$('input[name="start_time"]').attr('value', data.result.goods.start_time);//活动开始时间
							$('input[name="end_time"]').attr('value', data.result.goods.end_time);//活动结束时间
							$('input[name="activity_title"]').attr('value', data.result.goods.activity_title);//活动标题
							$('input[name="prom_detail"]').attr('value', data.result.goods.prom_detail);//促销详情
							$('input[name="activity_is_on"]').attr('value', data.result.goods.activity_is_on);//活动是否正在进行中
							goods_activity_theme();
						}
					}
				});
			}

			//商品价格库存显示
			function goods_activity_theme(){
				var goods_prom_type = $('input[name="goods_prom_type"]').attr('value');
				var activity_is_on = $('input[name="activity_is_on"]').attr('value');
				if(activity_is_on == 0){
					setNormalGoodsPrice();
				}else{
					if(goods_prom_type == 0){
						//普通商品
						setNormalGoodsPrice();
					}else if(goods_prom_type == 1){
						//抢购
						setFlashSaleGoodsPrice();
					}else if(goods_prom_type == 2){
						//团购
						setGroupByGoodsPrice();
					}else if(goods_prom_type == 3){
						//优惠促销
						setPromGoodsPrice();
					}else{

					}
				}
				var buy_num  = $('#number').val();//购买数
				var store = $('#spec_store_count').html();//实际库存数量
				if(buy_num > store){
					$('.buyNum').val(store);
				}
			}

			//普通商品库存和价格
			function setNormalGoodsPrice(){
				var goods_price =  $("input[name='shop_price']").attr('value');// 商品本店价
				var market_price =  $("input[name='market_price']").attr('value');// 商品市场价
				var store_count = $("input[name='store_count']").attr('value');// 商品库存
				var sum= $('input[name="sum"]').attr('value');//会员限制购买数量
                var exchange_integral = $("input[name='exchange_integral']").attr('value');
                var shop_price= $('input[name="shop_price"]').attr('value');//商品价格
				// 如果有属性选择项
				if(spec_goods_price.length != 0)
				{
					var goods_spec_arr = [];
					$("input[name^='goods_spec']").each(function () {
						if($(this).attr('checked') == 'checked'){
							goods_spec_arr.push($(this).val());
						}
					});
					var spec_key = goods_spec_arr.sort(sortNumber).join('_');  //排序后组合成 key
					goods_price = spec_goods_price[spec_key]['price']; // 找到对应规格的价格
					store_count = spec_goods_price[spec_key]['store_count']; // 找到对应规格的库存
				}
				$('#market_price_title').empty().html('市场价：');
				$('#market_price').empty().html(market_price);
				$("#goods_price").html("<em>￥</em>"+goods_price); //变动价格显示
				$('#spec_store_count').html(store_count);
				$('.presale-time').hide();
				if(exchange_integral==shop_price){
					 $('#number').attr('max',sum);
				}else{
					 $('#number').attr('max',store_count);
				}
               
			}

			//秒杀商品库存和价格
			function setFlashSaleGoodsPrice(){
				var flash_sale_price = $("input[name='shop_price']").attr('value');
				var flash_sale_count = $("input[name='store_count']").attr('value');
				var market_price = $("input[name='market_price']").attr('value');
				var start_time = $("input[name='start_time']").attr('value');
				var end_time = $("input[name='end_time']").attr('value');
				var activity_title = $("input[name='activity_title']").attr('value');
				var exchange_integral = $("input[name='exchange_integral']").attr('value');
                
                var ab_str = market_price.toString();
                var ab_num = parseInt(ab_str.substring(0,ab_str.indexOf('.')));
                
                if(exchange_integral==ab_num){
                	/**/
                	$("#goods_price").html(flash_sale_price+'积分'); //变动价格显示
                }else{
                	$("#goods_price").html("<em>￥</em>"+flash_sale_price); //变动价格显示
                }
				$('#spec_store_count').html(flash_sale_count);
				$('#goods_price_title').html('抢购价：');
				$('#market_price_title').empty().html('原&nbsp;&nbsp;价：');
				$('#activity_label').empty().html('抢&nbsp;&nbsp;购：');
				$('#activity_title').empty().html(activity_title);
				$('#activity_title_div').show();
				$('#market_price').empty().html(market_price);
                $('.presale-time').show();
				$('#prom_detail').hide();
                $('#number').attr('max',flash_sale_count);
				setInterval(activityTime, 1000);
			}

			//团购商品库存和价格
			function setGroupByGoodsPrice(){
				var group_by_price = $("input[name='shop_price']").attr('value');
				var group_by_count = $("input[name='store_count']").attr('value');
				var market_price = $("input[name='market_price']").attr('value');
				var start_time = $("input[name='start_time']").attr('value');
				var end_time = $("input[name='end_time']").attr('value');
				var activity_title = $("input[name='activity_title']").attr('value');
				$("#goods_price").empty().html("<em>￥</em>"+group_by_price); //变动价格显示
				$('#spec_store_count').empty().html(group_by_count);
				$('#activity_type').empty().html('团购');
				$('#goods_price_title').empty().html('团购价：');
				$('#market_price_title').empty().html('原&nbsp;&nbsp;价：');
				$('#activity_label').empty().html('团&nbsp;&nbsp;购：');
				$('#activity_title').empty().html(activity_title);
				$('#activity_title_div').show();
				$('#market_price').empty().html(market_price);
				$('.presale-time').show();
				$('#prom_detail').hide();
				$('#number').attr('max',group_by_count);
				setInterval(activityTime, 1000);
			}

			//促销商品库存和价格
			function setPromGoodsPrice(){
				var prom_goods_price = $("input[name='shop_price']").attr('value');
				var prom_goods_count = $("input[name='store_count']").attr('value');
				var market_price = $("input[name='market_price']").attr('value');
				var start_time = $("input[name='start_time']").attr('value');
				var end_time = $("input[name='end_time']").attr('value');
				var activity_title = $("input[name='activity_title']").attr('value');
				var prom_detail = $("input[name='prom_detail']").attr('value');
				$("#goods_price").empty().html("<em>￥</em>"+prom_goods_price); //变动价格显示
				$('#spec_store_count').empty().html(prom_goods_count);
				$('#activity_type').empty().html('促销');
				$('.presale-time').show();
				$('#prom_detail').empty().html(prom_detail).show();
				$('#activity_time').hide();
				$('#goods_price_title').empty().html('促销价：');
				$('#market_price_title').empty().html('原&nbsp;&nbsp;价：');
				$('#activity_label').empty().html('促&nbsp;&nbsp;销：');
				$('#activity_title').empty().html(activity_title);
				$('#activity_title_div').show();
				$('#market_price').empty().html(market_price);
				$('#number').attr('max',prom_goods_count);
			}

			// 倒计时
			function activityTime() {
				var end_time = parseInt($("input[name='end_time']").attr('value'));
				var timestamp = Date.parse(new Date());
				var now = timestamp/1000;
				var end_time_date = formatDate(end_time*1000);
				var text = GetRTime(end_time_date);
				//活动时间到了就刷新页面重新载入
				if(now > end_time){
					layer.msg('该商品活动已结束',function(){
						location.reload();
					});
				}
				$("#overTime").text(text);
			}
			//时间戳转换
			function add0(m){return m<10?'0'+m:m }
			function  formatDate(now)   {
				var time = new Date(now);
				var y = time.getFullYear();
				var m = time.getMonth()+1;
				var d = time.getDate();
				var h = time.getHours();
				var mm = time.getMinutes();
				var s = time.getSeconds();
				return y+'/'+add0(m)+'/'+add0(d)+' '+add0(h)+':'+add0(mm)+':'+add0(s);
			}

			//排序
			function sortNumber(a,b)
			{
				return a - b;
			}

			//收藏商品
			$('#collectLink').click(function(){
				if(getCookie('user_id') == ''){
					pop_login();
				}else{
					$.ajax({
						type:'post',
						dataType:'json',
						data:{goods_id:$('input[name="goods_id"]').val()},
						url:"<?php echo U('Home/Goods/collect_goods'); ?>",
						success:function(res){
							if(res.status == 1){
								layer.msg('成功添加至收藏夹', {icon: 1});
							}else{
								layer.msg(res.msg, {icon: 3});
							}
						}
					});
				}
			});

			//收藏店铺
			$('#favoriteStore').click(function () {
				if (getCookie('user_id') == '') {
					pop_login();
				} else {
					$.ajax({
						type: 'post',
						dataType: 'json',
						data: {store_id: $(this).attr('data-id')},
						url: "<?php echo U('Home/Store/collect_store'); ?>",
						success: function (res) {
							if (res.status == 1) {
								layer.msg('成功添加至收藏夹', {icon: 1});
							} else {
								layer.msg(res.msg, {icon: 3});
							}
						}
					});
				}
			});

			//切换图片
			function switch_zooming(img)
			{
				if(img != ''){
					$('#zoomimg').attr('jqimg', img);
					$('#zoomimg').attr('src', img);
				}
			}

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

			//用ajax分页显示评论
			function ajaxComment(commentType,page){
				$.ajax({
					type : "GET",
					url:"/index.php?m=Home&c=goods&a=ajaxComment&goods_id=<?php echo $goods['goods_id']; ?>&commentType="+commentType+"&p="+page,//+tab,
					success: function(data){
						$("#ajax_comment_return").html('');
						$("#ajax_comment_return").append(data);
					}
				});
			}
			/****************************************   评论js  ****************************************/
			/****************************************   评论js  ****************************************/
			/****************************************   评论js  ****************************************/
				// 点击分页触发的事件
			$("#ajax_comment_return .pagination  a").click(function(){
				ajaxComment(commentType,$(this).data('p'));
			});
			/**
			 * 点赞ajax
			 * dyr
			 * @param obj
			 */
			function zan(obj) {
				var comment_id = $(obj).attr('data-comment-id');
				var zan_num = parseInt($("#span_zan_" + comment_id).text());
				$.ajax({
					type: "POST",
					data: {comment_id: comment_id},
					dataType: 'json',
					url: "/index.php?m=Home&c=Order&a=ajaxZan",//
					success: function (res) {
						if (res.success) {
							$("#span_zan_" + comment_id).text(zan_num + 1);
						} else {
							layer.msg('只能点赞一次哟~', {icon: 2});
						}
					},
					error : function(res) {
						if( res.status == "200"){ // 兼容调试时301/302重定向导致触发error的问题
							layer.msg("请先登录!", {icon: 2});
							return;
						}
						layer.msg("请求失败!", {icon: 2});
						return;
					}
				});
			}
			//字数限制
			$(function() {
				$('.c-cen').click(function() {
					$(this).parents('.deta-descri').siblings('.reply-textarea').toggle();
				})
				$('.J-reply-trigger').click(function(){
					$(this).siblings('.reply-textarea').toggle();
				})
				$('.reply-input').keyup(function() {
					var nums = 120;
					var len = $(this).val().length;
					if(len > nums) {
						$(this).val($(this).val().substring(0, nums));
						layer.msg("超过字数限制！" , {icon: 2});
					}
					var num = nums - len;
					var su = $(this).siblings().find('.txt-countdown em');
					su.text(num);
				})

				$(document).on('click','.operate-box .reply-submit',function() {
					var content = $(this).parents('.inner').find('.reply-input').val();
					var comment_id = $(this).parents('.inner').find('.reply-input').attr('data-id').substr(10);
					var comment_name = $(this).parents('.comment-operate').siblings('.reply-infor').find('.main .user-name').text();
					var reply_id = $(this).attr('data-id');
					submit_reply(comment_id,content,comment_name,reply_id);
					$(this).parents('.reply-textarea').hide();
				});
			})

			/**
			 * 回复
			 * @param comment_id
			 * @param content
			 * @param to_name
			 * @param reply_id
			 */
			function submit_reply(comment_id,content,to_name,reply_id)
			{
				var goods_id = $('input[name="goods_id"]').val();
				if(getCookie('user_id') == ''){
					pop_login();
				}else {
					$.ajax({
						type: 'post',
						dataType: 'json',
						data: {comment_id: comment_id, content: content, to_name: to_name, reply_id: reply_id, goods_id: goods_id},
						url: "<?php echo U('Home/Order/reply_add'); ?>",
						success: function (res) {
							if (res.status == 1) {
								layer.msg(res.msg, {icon: 1});
							} else {
								layer.msg(res.msg, {icon: 2});
							}
						},
						error: function (res) {
							if (res.status == "200") { // 兼容调试时301/302重定向导致触发error的问题
								layer.msg("请先登录!", {icon: 2});
								return;
							}
							layer.msg("请求失败!", {icon: 2});
						}
					});
				}
			}
			/****************************************   评论js  ****************************************/
			/****************************************   评论js  ****************************************/
			/****************************************   评论js  ****************************************/
		</script>
	</body>
</html>