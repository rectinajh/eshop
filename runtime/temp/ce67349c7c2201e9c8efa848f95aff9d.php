<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:38:"./template/pc/rainbow/index/index.html";i:1532228868;s:40:"./template/pc/rainbow/public/header.html";i:1532228868;s:47:"./template/pc/rainbow/public/header_search.html";i:1532228868;s:40:"./template/pc/rainbow/public/footer.html";i:1532228868;s:46:"./template/pc/rainbow/public/sidebar_cart.html";i:1532228868;}*/ ?>
<!DOCTYPE html>

<html>

	<head>

		<meta charset="UTF-8">

		<title>首页-<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <meta name="keywords" content="<?php echo $tpshop_config['shop_info_store_keyword']; ?>"/>

		<meta name="description" content="<?php echo $tpshop_config['shop_info_store_desc']; ?>"/>

		<link rel="stylesheet" type="text/css" href="__STATIC__/css/tpshop.css"/>

		<script src="__STATIC__/js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>

		<script src="__PUBLIC__/js/global.js"></script>
		<!-- <script type="text/javascript">
			var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1265282947'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s19.cnzz.com/z_stat.php%3Fid%3D1265282947%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));
		</script> -->
	</head>

	<body>

		<!--顶部广告-s-->

		<?php $pid =1;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532300400 and end_time > 1532300400 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
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

					<a href="<?php echo $v['ad_link']; ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?>>

						<img src="<?php echo $v[ad_code]; ?>"/>

					</a>

					<i onclick="$('.topic-banner').hide();"></i>

				</div>

			</div>

		<?php endforeach; ?>

		<!--顶部广告-e-->

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

		<div id="myCarousel" class="carousel slide p header-tp tpshop2_0_carousel">

			<ol class="carousel-indicators"></ol>

			<div class="carousel-inner">

				<?php $pid =10;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532300400 and end_time > 1532300400 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("6")->select();
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


$c = 6- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
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

					<div class="item <?php if($key == 0): ?>active<?php endif; ?>" style="background-color:<?php echo (isset($v['bgcolor']) && ($v['bgcolor'] !== '')?$v['bgcolor']:gray); ?>;" >

						<a class="item-image" href="<?php echo $v['ad_link']; ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?> ><img src="<?php echo $v[ad_code]; ?>" alt="" /></a>

					</div>

				<?php endforeach; ?>

			</div>

		</div>

<!-- 		<div class="right-sidebar tpshop2_0_rs p">

			<div class="usertpshop">

				<div class="head_index">

					<a href="<?php echo U('Home/User/index'); ?>" target="_blank">

						<img class="head_pic" src="__STATIC__/images/default.jpg" alt="" />

					</a>

				</div>

				<p class="welcome nologin">您好，欢迎来到优品贡社商城！</p>

				<p class="welcome islogin">HI，<span class="userinfo"></span></p>

				<div class="login_index">

					<a class="nologin" href="<?php echo U('Home/User/login'); ?>" target="_blank">请登录</a>

					<a class="add_newperson" href="">新人有礼</a>

					<a class="islogin add_newperson" href="<?php echo U('Home/User/index'); ?>" target="_blank">会员中心</a>

				</div>

			</div>

			<div class="bulletin">

					<div class="tit_notice">

						<div class="bn_box">

							<?php
                                   
                                $md5_key = md5("select * from `__PREFIX__article` where cat_id = 24 and is_open=1 limit 4");
                                $box_ad = $sql_result_item = S("sql_".$md5_key);
                                if(empty($sql_result_item))
                                {                            
                                    $box_ad = $sql_result_item = \think\Db::query("select * from `__PREFIX__article` where cat_id = 24 and is_open=1 limit 4"); 
                                    S("sql_".$md5_key,$sql_result_item,31104000);
                                }    
                              foreach($sql_result_item as $key=>$item): endforeach;                                    
                                $md5_key = md5("select * from `__PREFIX__article` where cat_id = 20 and is_open=1 limit 4");
                                $box_prom = $sql_result_item = S("sql_".$md5_key);
                                if(empty($sql_result_item))
                                {                            
                                    $box_prom = $sql_result_item = \think\Db::query("select * from `__PREFIX__article` where cat_id = 20 and is_open=1 limit 4"); 
                                    S("sql_".$md5_key,$sql_result_item,31104000);
                                }    
                              foreach($sql_result_item as $key=>$item): endforeach; if(!(empty($box_ad) || (($box_ad instanceof \think\Collection || $box_ad instanceof \think\Paginator ) && $box_ad->isEmpty()))): ?>

								<span class="action box_ad">公告</span>

							<?php endif; if(!(empty($box_prom) || (($box_prom instanceof \think\Collection || $box_prom instanceof \think\Paginator ) && $box_prom->isEmpty()))): ?>

								<span class="box_prom">促销</span>

							<?php endif; ?>

						</div>

					</div>

					<div class="content box_ad_content">

						<?php if(is_array($box_ad) || $box_ad instanceof \think\Collection || $box_ad instanceof \think\Paginator): $i = 0; $__LIST__ = $box_ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>

							<a href="<?php echo U('Home/Article/detail',array('article_id'=>$v[article_id])); ?>" target="_blank"><?php echo $v[title]; ?></a>

						<?php endforeach; endif; else: echo "" ;endif; ?>

					</div>

					<div class="content box_prom_content" style="display: none">

						<?php if(is_array($box_prom) || $box_prom instanceof \think\Collection || $box_prom instanceof \think\Paginator): $i = 0; $__LIST__ = $box_prom;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>

							<a href="<?php echo U('Home/Article/detail',array('article_id'=>$v[article_id])); ?>" target="_blank"><?php echo $v[title]; ?></a>

						<?php endforeach; endif; else: echo "" ;endif; ?>

					</div>

					<div class="tit_notice">

						<div class="bn_box">

							<span>快捷入口</span>

						</div>

					</div>

					<div class="six_entrance">

						<table border="" cellspacing="0" cellpadding="0">

							<tr>

								<td>

									<div class="access">

										<a href="<?php echo U('Home/User/visit_log'); ?>" target="_blank">

											<i class="mybrowse"></i>

											<span>我的浏览</span>

										</a>

									</div>

								</td>

								<td>

									<div class="access">

										<a href="<?php echo U('Home/User/goods_collect'); ?>" target="_blank">

											<i class="mycollect"></i>

											<span>我的收藏</span>

										</a>

									</div>

								</td>

								<td class="lastcol">

									<div class="access">

										<a href="<?php echo U('Home/Order/order_list'); ?>" target="_blank">

											<i class="myorders"></i>

											<span>我的订单</span>

										</a>

									</div>

								</td>

							</tr>

							<tr class="lastcow">

								<td>

									<div class="access">

										<a href="<?php echo U('Home/User/safety_settings'); ?>" target="_blank">

											<i class="account_security"></i>

											<span>账号安全</span>

										</a>

									</div>

								</td>

								<td>

									<div class="access">

										<a href="<?php echo U('Home/User/recharge'); ?>" target="_blank">

											<i class="myshares"></i>

											<span>账户余额</span>

										</a>

									</div>

								</td>

								<td class="lastcol">

									<div class="access">

										<a href="<?php echo U('Home/Newjoin/index'); ?>" target="_blank">

											<i class="seller_enter"></i>

											<span>商家入驻</span>

										</a>

									</div>

								</td>

							</tr>

						</table>

					</div>

			</div>

		</div> -->
		<!--秒杀  -->
		<!-- <div class="fn-mall p ma-to-20">
			<div class="w1224">
				<div class="diamond_line">

					<div class="line_lim"></div>

					<div class="diamond">

						<i></i>

						<span>秒杀专场</span>

					</div>

				</div>
				 <div class="time p">

		            <div class="djs lightning fl" style="padding: 10px 0">
		
		                <span class="add"  style="font-size: 20px;font-weight: bold;">秒杀</span>
		
		                <span class="red" id=""><?php echo date('H',$start_time); ?>点场</span>
		
		                <span class="hms" style="color: red;"></span>
		
		            </div>
		
		        </div>	
				<div class="scroll"> 
						<div class="box"> 
							
							<?php if($flash_sale_list==null): ?>
								<input type="hidden" name="ceshi" id="ce" value="11">
								<div style="width: 250px;height: 30px;line-height: 30px;margin:0 auto;margin-top:105px; color: #2A81F4;font-size: 20px; ">暂时没有秒杀产品~</div>
							<?php else: ?>
							<ul class="scroll_list"> 
								<?php if(is_array($flash_sale_list) || $flash_sale_list instanceof \think\Collection || $flash_sale_list instanceof \think\Paginator): if( count($flash_sale_list)==0 ) : echo "" ;else: foreach($flash_sale_list as $key=>$v): ?>
								<li>
					                <a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$v[goods_id],'item_id'=>$v[item_id])); ?>">
					
					                    <img src="<?php echo goods_thum_images($v[goods_id],200,200); ?>"/>
											
										<p  style="color:red; height: 40px;line-height: 40px;font-size: 20px;">￥<span><?php echo $v[price]; ?></span>元</p>
											
					                </a>
								</li>
								<?php endforeach; endif; else: echo "" ;endif; ?>
								</ul> 
							<?php endif; ?>
							
							
						<span class="prev"><</span> 
					    <span class="next">></span> 
						</div> 
				</div> 
				
			</div>
		</div> -->
		<!--精品推荐  -->
		<!-- <div class="fn-mall p ma-to-20">

			<div class="w1224">

				<div class="diamond_line">

					<div class="line_lim"></div>

					<div class="diamond">

						<i></i>

						<span>精品推荐</span>

					</div>

				</div>

				<div class="advertisement p">

					<ul>

						<?php $pid =50;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532300400 and end_time > 1532300400 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("5")->select();
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


$c = 5- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
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

							<li>

								<a href="<?php echo $v['ad_link']; ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?>><img src="<?php echo $v[ad_code]; ?>"/></a>

							</li>

						<?php endforeach; ?>

					</ul>

				</div>

				<div class="feture-cates ma-to-20 p">

					<ul class="cates-left">

						<?php $pid =51;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532300400 and end_time > 1532300400 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("6")->select();
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


$c = 6- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
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

							<li class="item">

								<a href="<?php echo $v['ad_link']; ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?>>

									<img class="img100 prod" src="<?php echo $v[ad_code]; ?>">

								</a>

							</li>

						<?php endforeach; ?>

					</ul>

					<div id="myCarouselq" class="carousel slide p w408 fl">

						<ol class="carousel-indicators">

							<li data-target="#myCarouselq" data-slide-to="0" class="active"></li>

							<li data-target="#myCarouselq" data-slide-to="1"></li>

						</ol>

						<div class="carousel-inner">

							<div class="item active">

                                <?php $pid =52;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532300400 and end_time > 1532300400 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("2")->select();
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


$c = 2- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
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

                                    <a href="<?php echo $v['ad_link']; ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?>> <img src="<?php echo $v[ad_code]; ?>" style="width: 408px; height: 198px;"></a>

                                <?php endforeach; ?>

							</div>

							<div class="item">

                                <?php $pid =53;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532300400 and end_time > 1532300400 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("2")->select();
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


$c = 2- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
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

                                    <a href="<?php echo $v['ad_link']; ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?>> <img src="<?php echo $v[ad_code]; ?>" style="width: 408px; height: 198px;"></a>

                                <?php endforeach; ?>

							</div>

						</div>

						<a class="left carousel-control" href="#myCarouselq" data-slide="prev">&lsaquo;</a>

						<a class="right carousel-control" href="#myCarouselq" data-slide="next">&rsaquo;</a>

					</div>

					<ul class="cates-right">

                        <?php $pid =54;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532300400 and end_time > 1532300400 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("2")->select();
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


$c = 2- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
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

                            <div class="item">

                                <a href="<?php echo $v['ad_link']; ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?>>

                                    <img class="img100 prod" src="<?php echo $v[ad_code]; ?>">

                                </a>

                            </div>

                        <?php endforeach; ?>

					</ul>

				</div>

			</div>

		</div> -->

		<!-- <div class="underheader-floor tpshop2_0_uf ma-to-20 p">

			<div class="w1224">

				<div class="layout-title">

					<span class="fl">好货上新</span>

				</div>

				<div class="goodsnew">

					<ul>

                            <li>

                                <div class="tit">

                                    <i class="fashion1"></i>

                                    <span>时尚潮流</span>

                                </div>

                                <div class="boxforborder">

                                    <?php $pid =105;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532300400 and end_time > 1532300400 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("2")->select();
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


$c = 2- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
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
foreach($result as $k=>$v105):       
    
    $v105[position] = $ad_position[$v105[pid]]; 
    if(I("get.edit_ad") && $v105[not_adv] == 0 )
    {
        $v105[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v105[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v105[ad_id]";        
        $v105[title] = $ad_position[$v105[pid]][position_name]."===".$v105[ad_name];
        $v105[target] = 0;
    }
    ?>

                                        <div class="twicef">

                                            <p> <?php if($k+1 == 1): ?>

                                                    <span class="item">上新</span><span>品牌精选新品</span>

                                                <?php else: ?>

                                                   <span class="item">尖货优选</span><span>感受时尚的气息</span>

                                                <?php endif; ?></p>

                                            <div class="per_img">

                                                <a href="<?php echo $v105['ad_link']; ?>" <?php if($v105['target'] == 1): ?>target="_blank"<?php endif; ?>>

                                                    <img src="<?php echo $v105['ad_code']; ?>"/>

                                                </a>

                                            </div>

                                            <div class="line_lim w_limit"></div>

                                        </div>

                                    <?php endforeach; ?>

                                </div>

                            </li>

                        <li>

							<div class="tit">

								<i class="fashion2"></i>

								<span>手机数码</span>

							</div>

                            <div class="boxforborder">

                            <?php $pid =106;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532300400 and end_time > 1532300400 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("2")->select();
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


$c = 2- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
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
foreach($result as $k=>$v106):       
    
    $v106[position] = $ad_position[$v106[pid]]; 
    if(I("get.edit_ad") && $v106[not_adv] == 0 )
    {
        $v106[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v106[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v106[ad_id]";        
        $v106[title] = $ad_position[$v106[pid]][position_name]."===".$v106[ad_name];
        $v106[target] = 0;
    }
    ?>

                                <div class="twicef">

                                    <p></p>

                                    <div class="per_img">

                                        <a href="<?php echo $v106['ad_link']; ?>" <?php if($v106['target'] == 1): ?>target="_blank"<?php endif; ?>>

                                            <img src="<?php echo $v106['ad_code']; ?>"/>

                                        </a>

                                    </div>

                                    <div class="line_lim w_limit"></div>

                                </div>

                            <?php endforeach; ?>

                            </div>

						</li>

                        <li>

							<div class="tit">

								<i class="fashion3"></i>

								<span>享受生活</span>

							</div>

                            <div class="boxforborder">

                            <?php $pid =107;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532300400 and end_time > 1532300400 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("2")->select();
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


$c = 2- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
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
foreach($result as $k=>$v107):       
    
    $v107[position] = $ad_position[$v107[pid]]; 
    if(I("get.edit_ad") && $v107[not_adv] == 0 )
    {
        $v107[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v107[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v107[ad_id]";        
        $v107[title] = $ad_position[$v107[pid]][position_name]."===".$v107[ad_name];
        $v107[target] = 0;
    }
    ?>

                                <div class="twicef">

                                    <p></p>

                                    <div class="per_img">

                                        <a href="<?php echo $v107['ad_link']; ?>" <?php if($v107['target'] == 1): ?>target="_blank"<?php endif; ?>>

                                            <img src="<?php echo $v107['ad_code']; ?>"/>

                                        </a>

                                    </div>

                                    <div class="line_lim w_limit"></div>

                                </div>

                            <?php endforeach; ?>

                            </div>

						</li>

						    <li>

							<div class="tit">

								<i class="fashion4"></i>

								<span>全球好货</span>

							</div>

                            <div class="boxforborder">

                            <?php $pid =108;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532300400 and end_time > 1532300400 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("2")->select();
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


$c = 2- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
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
foreach($result as $k=>$v108):       
    
    $v108[position] = $ad_position[$v108[pid]]; 
    if(I("get.edit_ad") && $v108[not_adv] == 0 )
    {
        $v108[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v108[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v108[ad_id]";        
        $v108[title] = $ad_position[$v108[pid]][position_name]."===".$v108[ad_name];
        $v108[target] = 0;
    }
    ?>

                                <div class="twicef">

                                    <p></p>

                                    <div class="per_img">

                                        <a href="<?php echo $v108['ad_link']; ?>" <?php if($v108['target'] == 1): ?>target="_blank"<?php endif; ?>>

                                            <img src="<?php echo $v108['ad_code']; ?>"/>

                                        </a>

                                    </div>

                                    <div class="line_lim w_limit"></div>

                                </div>

                            <?php endforeach; ?>

                            </div>

						</li>

                        <li>

                            <div class="tit">

                                <i class="fashion5"></i>

                                <span>为你精选</span>

                            </div>

                            <div class="boxforborder">

                            <?php $pid =109;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532300400 and end_time > 1532300400 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("2")->select();
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


$c = 2- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
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
foreach($result as $k=>$v109):       
    
    $v109[position] = $ad_position[$v109[pid]]; 
    if(I("get.edit_ad") && $v109[not_adv] == 0 )
    {
        $v109[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v109[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v109[ad_id]";        
        $v109[title] = $ad_position[$v109[pid]][position_name]."===".$v109[ad_name];
        $v109[target] = 0;
    }
    ?>

                                <div class="twicef">

                                    <p></p>

                                    <div class="per_img">

                                        <a href="<?php echo $v109['ad_link']; ?>" <?php if($v109['target'] == 1): ?>target="_blank"<?php endif; ?>>

                                            <img src="<?php echo $v109['ad_code']; ?>"/>

                                        </a>

                                    </div>

                                    <div class="line_lim w_limit"></div>

                                </div>

                            <?php endforeach; ?>

                            </div>

						</li>

					</ul>

				</div>

			</div>

		</div> -->

		<div class="floor-advert p">

			<div class="w1224">

                <?php $pid =99;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532300400 and end_time > 1532300400 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
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

				    <a href="<?php echo $v['ad_link']; ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?>> <img class="" src="<?php echo $v[ad_code]; ?>" /></a>

                <?php endforeach; ?>

			</div>

		</div>



		<!--1F-s-->

		<?php if(is_array($web_list) || $web_list instanceof \think\Collection || $web_list instanceof \think\Paginator): if( count($web_list)==0 ) : echo "" ;else: foreach($web_list as $wk=>$wb): ?>

		<div class="tpshop2_0_floor p" id="floor<?php echo $wk+1; ?>">

			<div class="w1224">

				<div class="uantit fixedu p" >

					<h3 class="fl"><?php echo $wb[tit][title]; ?> <i><?php echo $wb[tit][floor]; ?></i></h3>

					<ul class="f-tab fr">

						<li class="z-select">

							<a href="javascript:;" rel="0" fid="<?php echo $wk+1; ?>"  onmouseover="showul(this)">精选推荐</a>

							<span></span>

						</li>

						<?php if(is_array($wb[recommend_list]) || $wb[recommend_list] instanceof \think\Collection || $wb[recommend_list] instanceof \think\Paginator): if( count($wb[recommend_list])==0 ) : echo "" ;else: foreach($wb[recommend_list] as $rck=>$rcd): ?>

						<li>

							<a href="javascript:;" rel="<?php echo $rck+1; ?>" fid="<?php echo $wk+1; ?>" onmouseover="showul(this)"><?php echo $rcd[recommend][name]; ?></a>

							<span></span>

						</li>

						<?php endforeach; endif; else: echo "" ;endif; ?>

					</ul>

				</div>

				<div class="uanmain fixedu p">

					<div class="leftcol fl">

						<div class="lc_top">

							<a href="<?php echo $wb[act][url]; ?>" class="adlight" target="_blank">

								<img src="<?php echo $wb[act][pic]; ?>" alt="" title="<?php echo $wb[act][title]; ?>">

							</a>

						</div>

						<div class="lc_bot">

							<ul>

								<li class="rowhr">

									<a href="<?php echo $wb[act][urla]; ?>"><span><?php echo $wb[act][titlea]; ?></span></a>

									<a href="<?php echo $wb[act][urlb]; ?>"><span><?php echo $wb[act][titleb]; ?></span><i class="r_arrow"></i></a>

								</li>

								<li class="lemain">

									<?php if(is_array($wb[category_list][goods_class]) || $wb[category_list][goods_class] instanceof \think\Collection || $wb[category_list][goods_class] instanceof \think\Paginator): if( count($wb[category_list][goods_class])==0 ) : echo "" ;else: foreach($wb[category_list][goods_class] as $key=>$gc): ?>

									<a href="<?php echo U('Goods/goodsList',array('id'=>$gc[gc_id])); ?>"><?php echo $gc['gc_name']; ?></a>

									<?php endforeach; endif; else: echo "" ;endif; ?>

									<!--<a class="sp" href="">奇异果</a>-->

								</li>

							</ul>

						</div>

					</div>



					<div class="rightcol fl">

						<div class="content_goods_sh" id="wbg0">

						  <?php if($wb[adv][0][adv_type] == 'upload_advmin'): ?>

							<ul class="floor-list hasSlide floor-list2">

							    <?php if(is_array($wb[adv]) || $wb[adv] instanceof \think\Collection || $wb[adv] instanceof \think\Paginator): if( count($wb[adv])==0 ) : echo "" ;else: foreach($wb[adv] as $key=>$ad): if($ad[adv_type] == 'upload_advbig'): ?>

							    	<li>

										<div id="myCarouselq<?php echo $wk; ?>" class="carousel slide w399 p">

											<ol class="carousel-indicators">

											<?php if(is_array($ad[adv_info]) || $ad[adv_info] instanceof \think\Collection || $ad[adv_info] instanceof \think\Paginator): if( count($ad[adv_info])==0 ) : echo "" ;else: foreach($ad[adv_info] as $sk=>$sd): if(!empty($sd['pic_img'])): ?>

											<li data-target="#myCarouselq<?php echo $wk; ?>" data-slide-to="<?php echo $sk-1; ?>" class="<?php if($sk-1 == 0): ?>active<?php endif; ?>"></li>

                                                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>

											</ol>

											<div class="carousel-inner">

												<?php if(is_array($ad[adv_info]) || $ad[adv_info] instanceof \think\Collection || $ad[adv_info] instanceof \think\Paginator): if( count($ad[adv_info])==0 ) : echo "" ;else: foreach($ad[adv_info] as $sk=>$sd): if(!empty($sd['pic_img'])): ?>

												<div class="item <?php if($sk == 1): ?>active<?php endif; ?>">

													<a href="<?php echo $sd['pic_url']; ?>">

                                                        <img src="<?php echo (isset($sd['pic_img']) && ($sd['pic_img'] !== '')?$sd['pic_img']:'/public/images/icon_goods_thumb_empty_300.png'); ?>">

                                                    </a>

												</div>

                                                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>

											</div>

										</div>

									</li>

							    	<?php else: ?>

							    	<li>

                                    <a href="<?php echo $ad['adv_info'][pic_url]; ?>">

    <img data-original="<?php echo (isset($ad[adv_info][pic_img]) && ($ad[adv_info][pic_img] !== '')?$ad[adv_info][pic_img]:'/public/images/icon_goods_thumb_empty_300.png'); ?>" class="lazy" width="199" height="243"/>

                                    </a>

									</li>

							    	<?php endif; endforeach; endif; else: echo "" ;endif; ?>

							</ul>

						  <?php else: ?>

						 	<ul class="floor-list floor-list1 hasSlide">

						 	<?php if(is_array($wb[adv]) || $wb[adv] instanceof \think\Collection || $wb[adv] instanceof \think\Paginator): if( count($wb[adv])==0 ) : echo "" ;else: foreach($wb[adv] as $ak=>$ad): if($ad[adv_type] == 'upload_advbig'): ?>

								<li>

									<div id="myCarouselq<?php echo $wk; ?>" class="carousel slide w399 p">

										<ol class="carousel-indicators">

											<?php if(is_array($ad[adv_info]) || $ad[adv_info] instanceof \think\Collection || $ad[adv_info] instanceof \think\Paginator): if( count($ad[adv_info])==0 ) : echo "" ;else: foreach($ad[adv_info] as $sk=>$sd): if(!empty($sd['pic_img'])): ?>

                                        <li data-target="#myCarouselq<?php echo $wk; ?>" data-slide-to="<?php echo $sk-1; ?>" class="<?php if($sk-1 == 0): ?>active<?php endif; ?>"></li>

                                                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>

										</ol>

										<div class="carousel-inner">

											<?php if(is_array($ad[adv_info]) || $ad[adv_info] instanceof \think\Collection || $ad[adv_info] instanceof \think\Paginator): if( count($ad[adv_info])==0 ) : echo "" ;else: foreach($ad[adv_info] as $sk=>$sd): if(!empty($sd['pic_img'])): ?>

                                                <div class="item <?php if($sk == 1): ?>active<?php endif; ?>">

                                                    <a href="<?php echo $sd['pic_url']; ?>">

                                                        <img src="<?php echo (isset($sd['pic_img']) && ($sd['pic_img'] !== '')?$sd['pic_img']:'/public/images/icon_goods_thumb_empty_300.png'); ?>">

                                                    </a>

                                                </div>

                                                <?php endif; endforeach; endif; else: echo "" ;endif; ?>

										</div>

									</div>

								</li>

								<?php else: ?>

								<li>

									<a href="<?php echo $ad['pic_url']; ?>"><img src="<?php echo (isset($ad[adv_info][pic_img]) && ($ad[adv_info][pic_img] !== '')?$ad[adv_info][pic_img]:'/public/images/icon_goods_thumb_empty_300.png'); ?>" class="lazy" /></a>

								</li>

								<?php endif; endforeach; endif; else: echo "" ;endif; ?>

							</ul>

						 <?php endif; ?>

						</div>



						<?php if(is_array($wb[recommend_list]) || $wb[recommend_list] instanceof \think\Collection || $wb[recommend_list] instanceof \think\Paginator): if( count($wb[recommend_list])==0 ) : echo "" ;else: foreach($wb[recommend_list] as $gk=>$wg): ?>

						<div class="content_goods_sh content_goods_list" id="wbg<?php echo $gk+1; ?>" style="display:none;">

							<ul class="floor-list-cont">

								<?php if(is_array($wg[goods_list]) || $wg[goods_list] instanceof \think\Collection || $wg[goods_list] instanceof \think\Paginator): if( count($wg[goods_list])==0 ) : echo "" ;else: foreach($wg[goods_list] as $key=>$pd): ?>

								<li>

									<a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$pd[goods_id])); ?>">

										<img src="<?php echo $pd['goods_pic']; ?>" width="160px" height="135px">

										<p class="goods_name_tp2"><?php echo $pd['goods_name']; ?></p>
										<!-- <div><p class="goods_price_tp2">市场价：<em>￥</em><span><?php echo $pd['market_price']; ?></span></p></div> -->
										<div><p class="goods_price_tp2">商城价：<em>￥</em><span><?php echo $pd['goods_price']; ?></span></p></div>
										<!-- <?php if($pd['pay_points'] > 0): ?>
											<div><p class="goods_price_tp2" style="color: red;">会员价：<em>￥</em><span><?php echo $pd['goods_price']-$pd['pay_points']/$point_rate; ?>+<?php echo $pd['pay_points']; ?>积分</span></p></div>
										<?php endif; ?> -->

									</a>

								</li>

								<?php endforeach; endif; else: echo "" ;endif; ?>

							</ul>

						</div>

						<?php endforeach; endif; else: echo "" ;endif; ?>

					</div>

				</div>

			</div>

		</div>

		<!--1F-e-->

		<div class="tpshop2_0_brand ma-to-10 p">

			<div class="w1224 bggc">

				<ul>

					<?php if(is_array($wb[brand_list]) || $wb[brand_list] instanceof \think\Collection || $wb[brand_list] instanceof \think\Paginator): if( count($wb[brand_list])==0 ) : echo "" ;else: foreach($wb[brand_list] as $key=>$bd): ?>

					<li>

						<a href="<?php echo U('Goods/goodsList',array('brand_id'=>$bd[brand_id])); ?>"><img class="lazy" data-original="<?php echo (isset($bd['brand_pic']) && ($bd['brand_pic'] !== '')?$bd['brand_pic']:'/public/images/icon_goods_thumb_empty_300.png'); ?>" src="" title="<?php echo $bd['brand_name']; ?>"/></a>

					</li>

					<?php endforeach; endif; else: echo "" ;endif; ?>

				</ul>

			</div>

		</div>

		<?php endforeach; endif; else: echo "" ;endif; ?>

		<!--左侧边栏-->

		<div class="sideleft-nav" id="sideleft">

			<div class="first-l">楼层导航</div>

			<ul>

				<?php if(is_array($web_list) || $web_list instanceof \think\Collection || $web_list instanceof \think\Paginator): if( count($web_list)==0 ) : echo "" ;else: foreach($web_list as $k=>$vo): ?>

					<li class="<?php if($k == 0): ?>sid-red<?php endif; ?>">

						<a href="#floor<?php echo $k+1; ?>"><i></i><?php echo $vo[tit][title]; ?></a>

					</li>

				<?php endforeach; endif; else: echo "" ;endif; ?>

			</ul>

		</div>

		<!--左侧边栏-->

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


		<script src="__STATIC__/js/lazyload.min.js" type="text/javascript" charset="utf-8"></script>

		<script src="__STATIC__/js/headerfooter.js" type="text/javascript" charset="utf-8"></script>

		<script src="__STATIC__/js/carousel.js" type="text/javascript" charset="utf-8"></script>

		<script type="text/javascript">

			function sidebarRollChange() {  //首页侧边栏滚动改变楼层

				var $_floorList=$('.tpshop2_0_floor');

				var $_sidebar=$('#sideleft');

				var arr=[];

				var toggle=true;

				$_floorList.each(function (){ //获取楼层高度信息

					var json={};

					json.name=parseInt($(this).find('h3.fl>i').text())-1;

					json.offsetTop=$(this).offset().top;

					arr.push(json);

				})

				$_sidebar.find('li').click(function () { //点击切换楼层

					toggle=false;

					$(this).addClass('sid-red').siblings().removeClass('sid-red');

					$('html,body').stop().animate({'scrollTop':$_floorList.eq($(this).index()).offset().top},500,function () {

						toggle=true;

					})

				});

				$(window).scroll(function(){

					if(!toggle){ //点击滚动时阻止触发这里的滚动

						return;

					}

					var scrollTop=$(window).scrollTop();

					/*显示左边侧边栏*/

					if(scrollTop<$_floorList.eq(0).offset().top-$(window).height()/2){ //还没滚到到楼层或向上滚出楼层隐藏侧边栏

						$_sidebar.hide();

						return;

					}

					$_sidebar.show(); //左边侧边栏显示

					/*滚动改变侧边栏的状态*/

					var last_arr=[];

					for(var j=0; j<arr.length; j++){

						if(scrollTop>arr[j].offsetTop-$(window).height()/2){

							last_arr.push(arr[j].name);

						}

					};

					$_sidebar.find('li').eq(last_arr[last_arr.length-1]).addClass('sid-red').siblings().removeClass('sid-red');

				})

			}

			sidebarRollChange();



			$(function() {

				$('.categorys .dd').show();//首页商品分类显示

				$(".carousel").carousel();//轮播自动播放

			});



			//轮播图小圆点

			$(function() {

				var imgle = $("#myCarousel .carousel-inner .item").length;

				for(var i = 0; i < imgle; i++) {

					$('#myCarousel ol.carousel-indicators').append("<li data-target=" + "#myCarousel" + " data-slide-to=" + i + " class=" + "" + "></li>")

				}

				$('ol.carousel-indicators li:first').addClass('active');

			});



			//品牌logo

			$(function() {

				var op = 500;

				$('.tpshop2_0_brand ul li').hover(function() {

					if(!$(this).hasClass('b')) {

						$(this).stop().animate({

							opacity: "1"

						}, op).siblings().stop().animate({

							opacity: "0.5"

						}, op);

					}

				}, function() {

					if(!$(this).hasClass('b')) {

						$(this).stop().animate({

							opacity: "1"

						}, op).siblings().stop().animate({

							opacity: "1"

						}, op);

					}

				})

			})

			//楼层横向导航

			$(function(){

				$('ul.f-tab li').hover(function(){

					$(this).addClass('z-select').siblings().removeClass('z-select');

					var page_id = $(this).data('id');

					var floot_page = $(this).data('floot');

					$('.'+floot_page).hide();

					$('#'+page_id).show();

				})

			})

			//公告/促销切换

			$(function(){

				$('.bn_box span').hover(function(){

					$(this).addClass('action').siblings().removeClass('action');

					$('.bulletin .content').hide();

					if($(this).hasClass('box_prom')){

						$('.box_prom_content').show();

					}else{

						$('.box_ad_content').show();

					}

				})

			})



			function showul(obj){

				var fid = $(obj).attr('fid');

				var nky = $(obj).attr('rel');

				$('#floor'+fid).find('.content_goods_sh').hide();

				$('#floor'+fid).find('#wbg'+nky).show();

			}
			 /**

		     * 秒杀模块倒计时

		     * */

		    function GetRTime(end_time){

		        var NowTime = new Date();

		        var t = (end_time*1000) - NowTime.getTime();

		        var d=Math.floor(t/1000/60/60/24);

		        var h=Math.floor(t/1000/60/60%24);

		        var m=Math.floor(t/1000/60%60);

		        var s=Math.floor(t/1000%60);

		        if(s >= 0)

		            return (d * 24 + h) + '时' + m + '分' +s+'秒';

		    }

		    

		    function GetRTime2(){

		        var text = GetRTime('<?php echo $end_time; ?>');
		        var ce=$('#ce').val();		
		        if (ce== 11){

		            $(".hms").text('活动已结束');

		        }else{

		            $(".hms").text(text);

		        }

		    }

		    setInterval(GetRTime2,1000);
		</script>
<script type="text/javascript"> 
$(function(){ 
var page= 1; 
var i = 6;//每版四个图片 
//向右滚动 
$(".next").click(function(){ //点击事件 
var v_wrap = $(this).parents(".scroll"); // 根据当前点击的元素获取到父元素 
var v_show = v_wrap.find(".scroll_list"); //找到视频展示的区域 
var v_cont = v_wrap.find(".box"); //找到视频展示区域的外围区域 
var v_width = v_cont.width(); 
var len = v_show.find("li").length; //我的视频图片个数 
var page_count = Math.ceil(len/i); //只要不是整数，就往大的方向取最小的整数 
if(!v_show.is(":animated")){ 
if(page == page_count){ 
v_show.animate({left:'0px'},"slow"); 
page =1; 
}else{ 
v_show.animate({left:'-='+v_width},"slow"); 
page++; 
} 
} 
}); 
//向左滚动 
$(".prev").click(function(){ //点击事件 
var v_wrap = $(this).parents(".scroll"); // 根据当前点击的元素获取到父元素 
var v_show = v_wrap.find(".scroll_list"); //找到视频展示的区域 
var v_cont = v_wrap.find(".box"); //找到视频展示区域的外围区域 
var v_width = v_cont.width(); 
var len = v_show.find("li").length; //我的视频图片个数 
var page_count = Math.ceil(len/i); //只要不是整数，就往大的方向取最小的整数 
if(!v_show.is(":animated")){ 
if(page == 1){ 
v_show.animate({left:'-='+ v_width*(page_count-1)},"slow"); 
page =page_count; 
}else{ 
v_show.animate({left:'+='+ v_width},"slow"); 
page--; 
} 
} 
}); 
}); 
</script>   
	</body>

</html>