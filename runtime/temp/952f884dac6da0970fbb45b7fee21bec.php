<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:47:"./template/pc/rainbow/public/dispatch_jump.html";i:1532661070;s:40:"./template/pc/rainbow/public/header.html";i:1532661070;s:47:"./template/pc/rainbow/public/header_search.html";i:1532661070;s:40:"./template/pc/rainbow/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>系统提示-<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>
    <meta name="keywords" content="<?php echo $tpshop_config['shop_info_store_keyword']; ?>"/>
    <meta name="description" content="<?php echo $tpshop_config['shop_info_store_desc']; ?>"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/tpshop.css"/>
    <script src="__STATIC__/js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="__PUBLIC__/js/global.js"></script>
</head>
<style>
    .box-ts{width:500px; padding:60px 0; background-color:rgba(105, 95, 95, 0.06); text-align:center; margin:0 auto; overflow:hidden; margin-top:100px; margin-bottom:100px; font-family:simsun,tahoma,arial,sans-serif; color:#555555}
    .box-ts i{ display:inline-block; vertical-align:middle;}
    .box-ts ul{display:inline-block; text-align:left; vertical-align:middle}
    .box-ts ul li{line-height:2.4}
    .box-ts ul li h3{font-size:18px; font-weight:bold}
    .box-ts:after{content:''; clear:both}
</style>
<body class="detailfont">
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

	<div class="operation_success_fail">
		<!--操作成功-s--->
		<?php if($code == 1) {?>
		<div class="boxoperation p" style="display: ;">
			<div class="success_fial_img fl">
				<img src="__STATIC__/images/right_06.jpg"/>
			</div>
			<div class="success_describe fl">
				<div class="sd1">
					<i class="suc"></i>
					<span><?php echo(strip_tags($msg)); ?></span>
				</div>
				<div class="sd2">
					<a id="href" href="<?php echo($url); ?>">页面跳转中...</a>
					<span>等待时间：<em id="wait"><?php echo($wait); ?></em></span>
				</div>
				<div class="sd3">
					<a href="/">首页</a>
					<a href="/index.php?m=Home&c=Cart&a=index">购物车</a>
					<a href="/index.php?m=Home&c=User&a=index">用户中心</a>
				</div>
			</div>
		</div>
		<!--操作成功-s--->
		<?php }else{?>
		<!--操作失败-s--->
		<div class="boxoperation p" style="display:;">
			<div class="success_fial_img fl">
				<img src="__STATIC__/images/wrong_05.jpg"/>
			</div>
			<div class="success_describe fl">
				<div class="sd1">
					<i class="wro"></i>
					<span><?php echo(strip_tags($msg)); ?></span>
				</div>
				<div class="sd2">
					<a id="href" href="<?php echo($url); ?>">页面跳转中...</a>
					<span>等待时间：<em id="wait"><?php echo($wait); ?></em></span>
				</div>
				<div class="sd3">
					<a href="/">首页</a>
					<a href="/index.php?m=Home&c=Cart&a=index">购物车</a>
					<a href="/index.php?m=Home&c=User&a=index">用户中心</a>
				</div>
			</div>
		</div>
		<!--操作失败-e--->
		<?php }?>
	</div>
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
<script type="text/javascript">
    (function () {
        var wait = document.getElementById('wait'), href = document.getElementById('href').href;
        var interval = setInterval(function () {
            var time = --wait.innerHTML;
            if (time <= 0) {
                window.location.href = href;
                clearInterval(interval);
            }
            ;
        }, 1000);
    })();
    
    /*******用户登录变化class****/
    function user_login_or_no()
    {
    	var uname = getCookie('uname');
    	if (uname == '') {
    		$('.islogin').remove();
    		$('.nologin').show();
    	} else {
    		$('.nologin').remove();
    		$('.islogin').show();
    		$('.userinfo').html(decodeURIComponent(uname));
    	}
    }
	
    $(document).ready(function(){
    	user_login_or_no();
    })
    
</script>
</body>
</html>