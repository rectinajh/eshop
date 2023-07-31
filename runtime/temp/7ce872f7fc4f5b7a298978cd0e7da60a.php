<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:40:"./template/pc/rainbow/newjoin/index.html";i:1532661070;s:40:"./template/pc/rainbow/public/header.html";i:1532661070;s:47:"./template/pc/rainbow/public/header_search.html";i:1532661070;s:40:"./template/pc/rainbow/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

	<meta charset="UTF-8">

	<title>商家入驻 - www.ohbbs.cn 欧皇源码论坛 </title>

	<link rel="stylesheet" type="text/css" href="__STATIC__/css/tpshop.css" />

	<script src="__STATIC__/js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>

	<script src="__PUBLIC__/js/layer/layer-min.js"></script>

	<script src="__PUBLIC__/js/global.js"></script>

	<script src="__PUBLIC__/js/pc_common.js"></script>

</head>

<body>

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


<style type="text/css">

.gome-layout-area {width: 990px;margin: 0 auto;overflow: hidden;margin-bottom:30px;}

.gome-part {width: 990px;overflow: hidden;margin-top: 50px;}

.gome-merchants-settled {float: left;width: 290px;overflow: hidden;}

.mr60 {margin-right: 60px;}

.mt45 {margin-top: 45px;}

.gome-merchants-settled span {float: left;}

.settled-list { float: left;margin: 0 0 0 19px;width: 181px; height: 90px;}

.settled-list li.list-title {font: bold 16px/16px '微软雅黑';background: none;padding: 0;height: 24px;margin-bottom: 3px;}

.settled-list li {list-style: none;background: url(__STATIC__/images/list-point.jpg) no-repeat center left;padding: 0 0 0 14px;font: normal 12px/22px '新宋体';overflow: hidden;height: 22px;}

.settled-list li a {width: 130px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;color: #888888;float: left;text-decoration: none;}

.settled-process-title {width: 990px;text-align: left;font: normal 24px/24px '微软雅黑';margin-bottom:40px;}

.settled-process {width: 990px;overflow: hidden;margin: 20px 0;background: #fafafa;border-top: 1px solid #e8e8e8;}

.settled-process-title span {float: left;}

.settled-process-title a {float: right;font: normal 12px/12px '新宋体';color: #0066cc;margin: 12px 0 0 0;}

.settled-merchants-title {width: 990px;text-align: left;font: 400 24px/24px '微软雅黑';}

.settled-merchants-title span {float: left;}

.merchants-list {float: left;margin-left: 50px;margin-top: 30px}

.merchants-list li {list-style: none;float: left;font: 400 12px/22px '新宋体';color: #5e5e5e;text-align: center;width: 150px;height: 34px; margin-right: 6px;cursor: pointer;}

.merchants-list li.active {border-bottom: 4px solid #c00;height: 30px; color: #c00;}

.merchants-tab-con {float: left;width: 990px;overflow: hidden;margin: 30px 0 0;display: none;}

.merchants-tab-con img {float: left;margin: 1px 0 0 1px;}

#cms_first_dom{width:100%}

.bgs{width:100%;height:470px;background-position:50% 0px;background-repeat:no-repeat;margin-bottom:20px}

.zs_kv_box{position:relative;width:1224px;height:470px;margin:0 auto}

.p_c_list{position:relative;overflow:hidden}.p_c_list ul{position:absolute}

.p_c_list ul li{display:inline-block;float:left;margin-right:10px}

.p_c_hd{position:absolute;bottom:10px;right:280px;z-index:8}

.p_c_hd ul li{width:12px;height:12px;border-radius:50%;text-indent:-9999px;margin-right:10px;background:#999;border:1px #999 solid;float:left;cursor:pointer}

.p_c_hd ul li.on{background:#fff}.kv_enter{position:absolute;top:0px;right:0px;width:250px;height:470px;z-index:2}

.en_btn{position:absolute;left:35px;top:60px;width:180px;height:40px;background-color:#f93;border-radius:5px;-moz-border-radius:5px;-ms-border-radius:5px;-o-border-radius:5px;-moz-border-radius:5px;line-height:40px;text-align:center;z-index:5}

.en_btn a{font-family:'microsoft yahei';font-size:16px;color:#fff}

.en_btn_check{top:160px}

.en_bg{filter:alpha(opacity=30);-moz-opacity:.3;-khtml-opacity:.3;opacity:.3;width:250px;height:470px;background:#000;z-index:0}

</style>

<div id="cms_first_dom">

	<div id="anchor_div1343768" showbegintime="" showendtime="" isrelatedpro="0" data-tpa="m1343768">

		<div class="bgs" id="bgs" style="background-color: rgb(176, 176, 178);">

			<div class="zs_kv_box" id="pic_change">

				<div class="kv_enter">

					<div class="en_btn"><a href="<?php echo U('Newjoin/agreement'); ?>">立即入驻</a></div>

					<div class="en_btn en_btn_check"><a href="<?php echo U('Newjoin/agreement'); ?>">查询入驻进度</a></div>

					<div class="en_word"></div>

					<div class="en_bg"></div>

				</div>

				<div class="p_c_list" id="p_c_list" style="width: 1224px; height: 470px;">

					<ul style="height: 470px;">

                        <?php $pid =10;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532689200 and end_time > 1532689200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("4")->select();
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


$c = 4- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
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

                            <li style="width: 1224px; height: 470px;">

                                <a href="<?php echo $v['ad_link']; ?>" target="_blank">

                                    <img src="<?php echo $v[ad_code]; ?>" style="width: 980px; height: 470px;">

                                </a>

                            </li>

                        <?php endforeach; ?>

					</ul>

				</div>

				<div class="p_c_hd" id="p_c_hd">

					<ul></ul>

				</div>

			</div>

		</div>

	</div>

</div>



<div class="gome-layout-area">

    	<div class="gome-part">

	    			<div class="gome-merchants-settled   mr60"> 

					<span><img width="90" height="90" src="http://img13.gomein.net.cn/image/prodimg/promimg/topics/201412/20141222113505.jpg"></span>

			            <ul class="settled-list">

			              <li class="list-title"><a target="_blank">信息公告</a></li>

			              		<!--<li><a href="" target="_blank" title="【通知】商品规格参数数据维护工作安排">【通知】商品规格参数数据维护工作安排</a></li>-->

                                <?php
                                   
                                $md5_key = md5("select * from `__PREFIX__article` where cat_id = 24");
                                $result_name = $sql_result_v2 = S("sql_".$md5_key);
                                if(empty($sql_result_v2))
                                {                            
                                    $result_name = $sql_result_v2 = \think\Db::query("select * from `__PREFIX__article` where cat_id = 24"); 
                                    S("sql_".$md5_key,$sql_result_v2,31104000);
                                }    
                              foreach($sql_result_v2 as $k2=>$v2): ?>

                                    <li><a href="<?php echo U('Home/Article/detail',array('article_id'=>$v2[article_id])); ?>"><?php echo $v2[title]; ?></a></li>

                                <?php endforeach; ?>

			            </ul>

          			</div>

	    			<div class="gome-merchants-settled   mr60"> 

							<span><img width="90" height="90" src="http://img14.gomein.net.cn/image/prodimg/promimg/topics/201412/20141222113832.jpg"></span>

			            <ul class="settled-list">

			              <li class="list-title"><a target="_blank">招商标准</a></li>

                            <!--<li><a href="" target="_blank" title="招商方向">招商方向</a></li>-->

                            <!--<li><a href="" target="_blank" title="招商政策">招商政策</a></li>-->

                            <!--<li><a href="" target="_blank" title="入驻资质">入驻资质</a></li>-->

                            <?php
                                   
                                $md5_key = md5("select * from `__PREFIX__article` where cat_id = 25  and is_open=1");
                                $result_name = $sql_result_v2 = S("sql_".$md5_key);
                                if(empty($sql_result_v2))
                                {                            
                                    $result_name = $sql_result_v2 = \think\Db::query("select * from `__PREFIX__article` where cat_id = 25  and is_open=1"); 
                                    S("sql_".$md5_key,$sql_result_v2,31104000);
                                }    
                              foreach($sql_result_v2 as $k2=>$v2): ?>

                                <li>

                                    <a href="<?php echo U('Home/Article/detail',array('article_id'=>$v2[article_id])); ?>"><?php echo $v2[title]; ?></a>

                                </li>

                            <?php endforeach; ?>

			            </ul>

          			</div>

	    			<div class="gome-merchants-settled   "> 

							<span><img width="90" height="90" src="http://img10.gomein.net.cn/image/prodimg/promimg/topics/201412/20141222114426.jpg"></span>

			            <ul class="settled-list">

			              <li class="list-title"><a target="_blank">资费标准</a></li>

			              		<!--<li><a href="" target="_blank" title="资费标准">资费标准</a></li>-->

			              		<!--<li><a href="" target="_blank" title="代运资费">代运资费</a></li>-->

			              		<!--<li><a href="" target="_blank" title="入驻须知">入驻须知</a></li>-->

                            <?php
                                   
                                $md5_key = md5("select * from `__PREFIX__article` where cat_id = 26  and is_open=1");
                                $result_name = $sql_result_v2 = S("sql_".$md5_key);
                                if(empty($sql_result_v2))
                                {                            
                                    $result_name = $sql_result_v2 = \think\Db::query("select * from `__PREFIX__article` where cat_id = 26  and is_open=1"); 
                                    S("sql_".$md5_key,$sql_result_v2,31104000);
                                }    
                              foreach($sql_result_v2 as $k2=>$v2): ?>

                                <li>

                                    <a href="<?php echo U('Home/Article/detail',array('article_id'=>$v2[article_id])); ?>"><?php echo $v2[title]; ?></a>

                                </li>

                            <?php endforeach; ?>

			            </ul>

          			</div>

	    			<div class="gome-merchants-settled mt45 mr60"> 

							<span><img width="90" height="90" src="http://img11.gomein.net.cn/image/prodimg/promimg/topics/201412/20141222114116.jpg"></span>

			            <ul class="settled-list">

			              <li class="list-title">

                              <!--<a href="http://help.gome.com.cn/question/246.html" target="_blank">TPSHOP优势</a>-->

                              <a target="_blank">新淘链优势</a>

                          </li>

			              		<!--<li><a href="" target="_blank" title="发展优势">发展优势</a></li>-->

			              		<!--<li><a href="" target="_blank" title="物流优势">物流优势</a></li>-->

			              		<!--<li><a href="" target="_blank" title="品牌优势">品牌优势</a></li>-->

                            <?php
                                   
                                $md5_key = md5("select * from `__PREFIX__article` where cat_id = 27  and is_open=1");
                                $result_name = $sql_result_v2 = S("sql_".$md5_key);
                                if(empty($sql_result_v2))
                                {                            
                                    $result_name = $sql_result_v2 = \think\Db::query("select * from `__PREFIX__article` where cat_id = 27  and is_open=1"); 
                                    S("sql_".$md5_key,$sql_result_v2,31104000);
                                }    
                              foreach($sql_result_v2 as $k2=>$v2): ?>

                                <li>

                                    <a href="<?php echo U('Home/Article/detail',array('article_id'=>$v2[article_id])); ?>"><?php echo $v2[title]; ?></a>

                                </li>

                            <?php endforeach; ?>

			            </ul>

          			</div>

	    			<div class="gome-merchants-settled mt45 mr60"> 

							<span><img width="90" height="90" src="http://img12.gomein.net.cn/image/prodimg/promimg/topics/201412/20141222114302.jpg"></span>

			            <ul class="settled-list">

			              <li class="list-title"><a href="<?php echo U('Home/Article/detail'); ?>" target="_blank">帮助中心</a></li>

			              		<!--<li><a href="" target="_blank" title="平台总则">平台总则</a></li>-->

			              		<!--<li><a href="" target="_blank" title="业务规范">业务规范</a></li>-->

			              		<!--<li><a href="" target="_blank" title="店铺促销">店铺促销</a></li>-->

                            <?php
                                   
                                $md5_key = md5("select * from `__PREFIX__article` where cat_id = 15  and is_open=1");
                                $result_name = $sql_result_v2 = S("sql_".$md5_key);
                                if(empty($sql_result_v2))
                                {                            
                                    $result_name = $sql_result_v2 = \think\Db::query("select * from `__PREFIX__article` where cat_id = 15  and is_open=1"); 
                                    S("sql_".$md5_key,$sql_result_v2,31104000);
                                }    
                              foreach($sql_result_v2 as $k2=>$v2): ?>

                                <li>

                                    <a href="<?php echo U('Home/Article/detail',array('article_id'=>$v2[article_id])); ?>"><?php echo $v2[title]; ?></a>

                                </li>

                            <?php endforeach; ?>

			            </ul>

          			</div>

			    		<div class="gome-merchants-settled mt45">

			                <span><img src="http://app.gomein.net.cn/images/icon6.jpg" width="90" height="90"></span>

			                <ul class="settled-list">

				              <li class="list-title"><a target="_blank">联系方式</a></li>

				              <!-- <li>入驻咨询QQ群：216961593</li> -->

				              <li><a target="_blank" class="blue" title="招商电话点此链接">招商电话：<?php echo $tpshop_config['shop_info_phone']; ?></a></li>

                                <?php
                                   
                                $md5_key = md5("select * from `__PREFIX__article` where cat_id = 13  and is_open=1");
                                $result_name = $sql_result_v2 = S("sql_".$md5_key);
                                if(empty($sql_result_v2))
                                {                            
                                    $result_name = $sql_result_v2 = \think\Db::query("select * from `__PREFIX__article` where cat_id = 13  and is_open=1"); 
                                    S("sql_".$md5_key,$sql_result_v2,31104000);
                                }    
                              foreach($sql_result_v2 as $k2=>$v2): ?>

                                    <li>

                                        <a href="<?php echo U('Home/Article/detail',array('article_id'=>$v2[article_id])); ?>"><?php echo $v2[title]; ?></a>

                                    </li>

                                <?php endforeach; ?>

			                </ul>

			            </div>

      </div>

      <div class="gome-part">

      	<div class="settled-process-title clearfix"><span>入驻流程</span>

            <a href="<?php echo U('Article/detail',array('article_id'=>6)); ?>" class="blue" target="_blank">查看入驻标准 &gt;</a>

        </div>

          <div class="settled-process mt45">

          		<img src="__STATIC__/images/20141222115236.jpg" width="990" height="225">

          </div>

      </div>

      <div class="gome-part" id="merchants-tab">

        <div class="settled-merchants-title clearfix">

            <span>热招品牌</span>

            <ul class="merchants-list" id="merchants-list">

                <?php
                                   
                                $md5_key = md5("select * from `__PREFIX__brand` where status = 0 and cat_name !='' group by cat_name ");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from `__PREFIX__brand` where status = 0 and cat_name !='' group by cat_name "); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>

                        <li class="<?php if($k == 0): ?>active<?php endif; ?>"><?php echo $v[cat_name]; ?></li>

                        <!--<li class="active">汽车用品</li>-->

                <?php endforeach; ?>

            </ul>

        </div>

		  	<?php
                                   
                                $md5_key = md5("select * from `__PREFIX__brand` group by cat_name");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from `__PREFIX__brand` group by cat_name"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>

                    <div class="merchants-tab-con" style="display: <?php if($k == 0): ?>block <?php else: ?>none<?php endif; ?>;">

						<?php
                                   
                                $md5_key = md5("select * from `__PREFIX__brand` where cat_name = '$v[cat_name]'");
                                $result_name = $sql_result_v2 = S("sql_".$md5_key);
                                if(empty($sql_result_v2))
                                {                            
                                    $result_name = $sql_result_v2 = \think\Db::query("select * from `__PREFIX__brand` where cat_name = '$v[cat_name]'"); 
                                    S("sql_".$md5_key,$sql_result_v2,31104000);
                                }    
                              foreach($sql_result_v2 as $k2=>$v2): ?>

                        <img src="<?php echo $v2[logo]; ?>" width="120" height="85" alt="<?php echo $v2[name]; ?>">

						<?php endforeach; ?>

                    </div>

			  <?php endforeach; ?>

            </div>

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

<script src="__STATIC__/js/common.js"></script>

<script type='text/javascript'>

$(document).ready(function(){

    move_pic();

    $('#merchants-list li').each(function(i,o){

    	$(o).hover(function(){

    		$(o).siblings().removeClass('active');

    		$(o).addClass('active');

    		$('.merchants-tab-con').hide();

    		$('.merchants-tab-con').eq(i).show();

    	});

    })

});

function move_pic() {

	var p_width = 1224;//图片宽度

	var p_height = 470;//图片高度

	var speed = 500;//滑动快慢

	var interval_speed = 5000//自动滑动间隔时间

	

	var p_now = 0;//当前显示第几屏

	var one_pic = 1;//每屏显示图片数量

	var bgs = $("#bgs");

	var pic_change = $("#pic_change");

	var p_c_list = $("#p_c_list");

	var pic_ul = p_c_list.find("ul");

	var pic_li = p_c_list.find("li");

	var p_num = pic_li.length;//屏数，小按钮数量

	var p_c_hd = $("#p_c_hd");

	var hd_ul = p_c_hd.find("ul");

	var k=0;//根据p_num判断小按钮数量

	var html_li = "<li></li>";

	for(k;k<p_num;k++){

		hd_ul.append(html_li);

	}

        

	var hd_li = p_c_hd.find("li");

	var box_width = p_width*one_pic+(one_pic-1)*10;//外框宽度	

	var all_width = (p_width+10)*p_num;//ul框架宽度

	

	//滑动

	function slideAnim(p_now){

		pic_ul.stop(true,false).animate({left:-(p_width+10)*p_now},speed);

		change_hd_li(p_now);

		change_color(p_now);

	}

	//变换背景颜色	

	function change_color(p_now){

		if(p_now==0){

		bgs.css("background-color","#C7422F");	

			}

		else if(p_now==1){

		bgs.css("background-color","#004797");	

			}

		else if(p_now==2){

		bgs.css("background-color","#313b33");	

			}

		else if(p_now==3){

		bgs.css("background-color","#b0b0b2");	

			}

		}	

	//变换小按钮样式	

	function change_hd_li(p_now){

		hd_li.removeClass("on");

    	hd_li.eq(p_now).addClass("on");	

	}

	//点击小按钮滑动

	hd_li.click(function() {

		var li_n = $(this);

    	p_now = li_n.index();

		slideAnim(p_now);

	});	

		

	//鼠标滑上焦点图时停止自动播放，滑出时开始自动播放

 	pic_change.hover(function() {

		clearInterval(picTimer);

	},function() {

		picTimer = setInterval(function() {

			p_now++;

			if(p_now == p_num) {p_now = 0;}

			slideAnim(p_now);

		},interval_speed);

	}).trigger("mouseleave");

	

	//init

	function init(){

		bgs.css("background-color","#C7422F");

		p_c_list.css({

			width:box_width,

			height:p_height

		});

		pic_ul.css({

			width:all_width+10,

			height:p_height

		});

		pic_li.css({

			width:p_width,

			height:p_height

		});	

		pic_li.find("img").css({

			width:p_width,

			height:p_height

		});

		hd_li.eq(p_now).addClass("on");	

	}//init------end

	init();		

}

</script>

</body>

</html>