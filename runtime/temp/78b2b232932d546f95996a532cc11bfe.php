<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:45:"./template/pc/rainbow/goods/integralMall.html";i:1532661070;s:40:"./template/pc/rainbow/public/header.html";i:1532661070;s:47:"./template/pc/rainbow/public/header_search.html";i:1532661070;s:46:"./template/pc/rainbow/public/footer_index.html";i:1532661070;s:46:"./template/pc/rainbow/public/sidebar_cart.html";i:1532661070;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>积分商城 - www.ohbbs.cn 欧皇源码论坛 </title>
		<link rel="stylesheet" type="text/css" href="__STATIC__/css/tpshop.css" />
		<script src="__STATIC__/js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="__PUBLIC__/js/layer/layer-min.js"></script>
		<script src="__PUBLIC__/js/global.js"></script>
		<script src="__PUBLIC__/js/pc_common.js"></script>
	</head>
	<style> 
.sbox .contifo p{
    margin: 5px 0;
}
</style>
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
					<a href="<?php echo U('Home/Goods/integralMall'); ?>">全部结果</a>
					<i class="litt-xyb"></i>
					<span>积分商城</span>
				</div>
				<div class="search-clear fr">
					<span><a href="<?php echo U('Home/Goods/integralMall'); ?>">清空筛选条件</a></span>
				</div>
			</div>
		</div>
		<div class="search-opt classify">
			<div class="w1224">
				<div class="opt-list">
					<dl class="brand-section">
						<dt>分类:</dt>
						<dd class="ri-section">
							<div class="lf-list">
								<div class="brand-list">
									<div class="clearfix p">
										<?php
										  unset($_GET['m']);
										  unset($_GET['c']);
										  unset($_GET['a']);
										?>
										<a href="<?php echo U('Home/Goods/integralMall',array_merge($_GET,array('id'=>0))); ?>" <?php if(\think\Request::instance()->param('id') == 0): ?>class="cored"<?php endif; ?>>
											<span>全部</span>
										</a>
										<?php if(is_array($store_category) || $store_category instanceof \think\Collection || $store_category instanceof \think\Paginator): $i = 0; $__LIST__ = $store_category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$store): $mod = ($i % 2 );++$i;?>
											<a href="<?php echo U('Home/Goods/integralMall',array('id'=>$store['sc_id'])); ?>" <?php if(\think\Request::instance()->param('id') == $store['sc_id']): ?>class="cored"<?php endif; ?>>
												<span><?php echo $store['sc_name']; ?></span>
											</a>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
								</div>
							</div>
						</dd>
					</dl>
				</div>
			</div>
		</div>
		<div class="shop-list-tour ma-to-20 p">
			<div class="w1224">
				<div class="stsho pre-sts intergra">
					<div class="sx_topb presellall">
						<div class="f-sort fl">
							<ul>
								<li <?php if(\think\Request::instance()->param('brandType') == 0): ?>class="red"<?php endif; ?>>
                                    <a href="<?php echo U('Home/Goods/integralMall',array('id'=>I('get.id'),'brandType'=>0)); ?>">全部
                                        <i class="jta <?php if(\think\Request::instance()->param('brandType') == 0): ?>jta-w<?php endif; ?>"></i>
                                    </a>
                                </li>
								<li <?php if(\think\Request::instance()->param('brandType') == 1): ?>class="red"<?php endif; ?>>
                                    <a href="<?php echo U('Home/Goods/integralMall',array('id'=>I('get.id'),'brandType'=>1)); ?>">积分+金额
                                        <i class="jta <?php if(\think\Request::instance()->param('brandType') == 1): ?>jta-w<?php endif; ?>"></i>
                                    </a>
                                </li>
								<li <?php if(\think\Request::instance()->param('brandType') == 2): ?>class="red"<?php endif; ?>>
                                    <a href="<?php echo U('Home/Goods/integralMall',array('id'=>I('get.id'),'brandType'=>2)); ?>">全积分
                                        <i class="jta  <?php if(\think\Request::instance()->param('brandType') == 2): ?>jta-w<?php endif; ?>"></i>
                                    </a>
                                </li>
							</ul>
						</div>
						<div class="f-total fr">
							<div class="all-fy">
								<?php $nowPage = $pages->nowPage;$totalPages = $pages->totalPages; ?>
                                <a <?php if($nowPage > 1): ?>href="<?php echo U('Home/Goods/integralMall',array_merge(I('get.'),array('p'=>$pages->nowPage-1))); ?>" <?php endif; ?>>&lt;</a>
                                <p class="fy-y"><span class="z-cur"><?php echo $nowPage; ?></span>/<span><?php echo $totalPages; ?></span></p>
                                <a <?php if(($nowPage+1) < $totalPages): ?>href="<?php echo U('Home/Goods/integralMall',array_merge(I('get.'),array('p'=>$pages->nowPage+1))); ?>"<?php endif; ?>>&gt;</a>
                            </div>
						</div>
					</div>
					<div class="he-rin p"></div>
					<div class="jpateki p">
                        <?php if(empty($goods_list) || (($goods_list instanceof \think\Collection || $goods_list instanceof \think\Paginator ) && $goods_list->isEmpty())): ?>
                            <p class="ncyekjl" style="font-size: 16px;margin:100px auto;text-align: center;">-- 抱歉还没有积分兑换商品，去其他地方逛逛！--</p>
                        <?php else: if(is_array($goods_list) || $goods_list instanceof \think\Collection || $goods_list instanceof \think\Paginator): $i = 0; $__LIST__ = $goods_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;if(($i-1)%3 == 0): ?>
								<ul>
							<?php endif; ?>
								<li <?php if($i%3 == 0): ?>class="mar0"<?php endif; ?>>
									<div class="sbox">
										<div class="contelim">
											<img src="<?php echo goods_thum_images($goods['goods_id'],165,188); ?>"/>
											
                                           <?php if($goods['goods_label']!=''): ?>
							                 	<p class="biao"><?php echo $goods['goods_label']; ?></p>
							                <?php endif; ?>
										</div>
										<div class="contifo">
											<p class="shop_name"><a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$goods['goods_id'])); ?>"><?php echo $goods['goods_name']; ?></a></p>
											<p>参考价：￥<span class="lithe"><?php echo $goods['shop_price']; ?></span></p>
											<p>换购价：<span class="red">￥<em><?php echo $goods['shop_price']-$goods['exchange_integral']/$point_rate; ?>+<?php echo $goods['exchange_integral']; ?></em>积分</span></p>
											<p>可兑换数量：<span class="red"><?php echo $goods['goods_xianzhi']; ?></span></p>
											<div class="duchan">
												<span><em><?php echo $goods['sales_sum']; ?></em>人换购</span>
												<a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$goods['goods_id'])); ?>">立即换购</a>
											</div>
										</div>
									</div>
								</li>
							<?php if($i%3 == 0): ?>
								</ul>
							<?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
					</div>
					<div class="reco-bouti">
						<h2 class="litt-titt">精品推荐</h2>
						<div class="reacommque">
							<ul>
								<?php
                                   
                                $md5_key = md5("select * from `__PREFIX__goods` where is_on_sale = 1 and exchange_integral > 0 and is_recommend = 1 limit 4");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from `__PREFIX__goods` where is_on_sale = 1 and exchange_integral > 0 and is_recommend = 1 limit 4"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>
									<li <?php if(($k+1)%4 == 0): ?>class="mar0"<?php endif; ?>>
									<div class="boxque">
										<img src="<?php echo goods_thum_images($v['goods_id'],165,188); ?>"/>
										<p class="shop_name"><a href=""><?php echo $v['goods_name']; ?></a></p>
										<div class="coan-j p">
											<div class="fl">
												<p class="ckf">参考价：￥<span class="lithe"><?php echo $v['shop_price']; ?></span></p>
												<p class="ckf">换购价：<span class="red">￥<em><?php echo $goods['shop_price']-$goods['exchange_integral']/$point_rate; ?>+<?php echo $goods['exchange_integral']; ?></em>积分</span></p>
											</div>
											<div class="fr">
												<a class="changot" href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$goods['goods_id'])); ?>">立即换购</a>
											</div>
										</div>
									</div>
								</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
					<div class="hotchane">
						<h2 class="litt-titt">热门兑换</h2>
						<div class="hot-change">
							<ul>
								<?php
                                   
                                $md5_key = md5("select * from `__PREFIX__goods` where is_on_sale = 1 and exchange_integral > 0 and is_hot = 1 limit 5");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from `__PREFIX__goods` where is_on_sale = 1 and exchange_integral > 0 and is_hot = 1 limit 5"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>
									<li <?php if(($k+1)%5 == 0): ?>class="mar0"<?php endif; ?>>
										<div class="lit-shcha">
											<img src="<?php echo goods_thum_images($v['goods_id'],165,188); ?>"/>
											<div class="duchan">
												<span><em><?php echo $goods['sales_sum']; ?></em>人换购</span>
												<a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$goods['goods_id'])); ?>">立即换购</a>
											</div>
										</div>
									</li>
								<?php endforeach; ?>
							</ul>
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
		<script src="__STATIC__/js/headerfooter.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$(function(){
				$('.f-sort ul li').click(function(){
					$(this).find('i').addClass('jta-w').parents('li').siblings().find('i').removeClass('jta-w');
				})
			})
		</script>
	</body>
</html>