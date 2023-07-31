<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:36:"./template/pc/rainbow/user/info.html";i:1532661070;s:38:"./template/pc/rainbow/user/header.html";i:1532661070;s:36:"./template/pc/rainbow/user/menu.html";i:1532661070;s:38:"./template/pc/rainbow/user/footer.html";i:1532661070;s:40:"./template/pc/rainbow/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>个人信息 - www.ohbbs.cn 欧皇源码论坛 </title>
		<link rel="stylesheet" type="text/css" href="__STATIC__/css/tpshop.css" />
		<link rel="stylesheet" type="text/css" href="__STATIC__/css/myaccount.css" />
		<script src="__STATIC__/js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="__ROOT__/public/static/js/layer/laydate/laydate.js"></script>
	</head>
	<body class="bg-f5">
	<script src="__PUBLIC__/js/global.js" type="text/javascript"></script>
<link rel="stylesheet" href="__STATIC__/css/location.css" type="text/css"><!-- 收货地址，物流运费 -->
<script src="__PUBLIC__/static/js/layer/layer.js" type="text/javascript"></script>
<style>
	.list1 li{float:left;}
</style>
<div class="top-hander home-index-top p">
	<div class="w1224 pr">
		<div class="fl">
			<?php if(!(empty($user) || (($user instanceof \think\Collection || $user instanceof \think\Paginator ) && $user->isEmpty()))): ?>
			<div class="fl ler">
				<a href="<?php echo U('Home/User/index'); ?>"><?php echo $user['nickname']; ?></a>
			</div>
			<div class="fl ler">
				<a href="<?php echo U('Home/User/message_notice'); ?>">
					消息<?php if($user_message_count > 0): ?>（<span class="red"> <?php echo $user_message_count; ?> </span>）<?php endif; ?>
				</a>
			</div>
			<div class="fl ler">
				<a href="<?php echo U('Home/User/logout'); ?>">退出</a>
			</div>
			<?php else: ?>
			<div class="fl ler">
		        <a class="red" href="<?php echo U('Home/user/login'); ?>">登录</a>
		        <span class="spacer"></span>
		        <a href="<?php echo U('Home/user/reg'); ?>">注册</a>
		    </div>
			<?php endif; ?>
			<div class="fl spc"></div>
			<div class="sendaddress pr fl">
				<!-- 收货地址，物流运费 -start-->
				<ul class="list1">
					<li class="jaj"><span>配&nbsp;&nbsp;送：</span></li>
					<li class="summary-stock though-line" style="margin-top:2px">
						<div class="dd" style="border-right:0px;">
							<div class="store-selector add_cj_p">
								<div class="text" style="width: 150px;margin-top:2px;"><div></div><b></b></div>
								<div onclick="$(this).parent().removeClass('hover')" class="close"></div>
							</div>
						</div>
					</li>
				</ul>
				<!--<i class="jt-x"></i>-->
				<!-- 收货地址，物流运费 -end-->
				<!--<span>深圳<i class="jt-x"></i></span>-->
			</div>
		</div>
		<div class="top-ri-header fr">
			<ul>
				<li><a href="<?php echo U('Home/Order/order_list'); ?>">我的订单</a></li>
				<li class="spacer"></li>
				<li><a href="<?php echo U('Home/User/visit_log'); ?>">我的浏览</a></li>
				<li class="spacer"></li>
				<li><a href="<?php echo U('Home/User/goods_collect'); ?>">我的收藏</a></li>
				<li class="spacer"></li>
				<li>客户服务</li>
				<li class="spacer"></li>
				<li class="hover-ba-navdh">
					<div class="nav-dh">
						<span>网站导航</span>
						<i class="jt-x"></i>
						<div class="conta-hv-nav">
							<ul>
								<li>
									<a href="<?php echo U('/Home/Activity/group_list'); ?>">团购</a>
								</li>
								<li>
									<a href="<?php echo U('Home/Activity/flash_sale_list'); ?>">抢购</a>
								</li>
							</ul>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="nav-middan-z p home-index-head">
	<div class="header w1224">
		<div class="ecsc-logo">
			<a href="/" class="logo">
                <!-- <img src="<?php echo $tpshop_config['shop_info_store_logo']; ?>" style="max-width: 240px;max-height: 70px;"> -->
                <img src="__STATIC__/images/logowhite.png" style="max-width: 230px;max-height: 70px;margin-top:10px;">
            </a>
		</div>
		<div class="m-index">
			<a href="<?php echo U('Home/User/index'); ?>" class="index">我的商城</a>
			<a href="/" class="home">返回商城首页</a>
		</div>
		<div class="m-navitems">
			<ul class="fixed p">
				<li><a href="<?php echo U('Home/User/index'); ?>">首页</a></li>
				<li>
					<div class="u-dl">
						<div class="u-dt">
							<span>账户设置</span>
							<i></i>
						</div>
						<div class="u-dd">
							<a href="<?php echo U('Home/User/info'); ?>">个人信息</a>
							<a href="<?php echo U('Home/User/safety_settings'); ?>">安全设置</a>
							<a href="<?php echo U('Home/User/address_list'); ?>">收货地址</a>
						</div>
					</div>
				</li>
				<li class="u-msg"><a class="J-umsg" href="<?php echo U('Home/User/message_notice'); ?>">消息<span><?php if($user_message_count > 0): ?><?php echo $user_message_count; endif; ?></span></a></li>
				<li><a href="<?php echo U('Home/Goods/integralMall'); ?>">积分商城</a></li>
				<li class="search_li">
				   <form id="sourch_form" id="sourch_form" method="post" action="<?php echo U('Home/Goods/search'); ?>">
		           	<input class="search_usercenter_text" name="q" id="q" type="text" value="<?php echo \think\Request::instance()->param('q'); ?>"  />
		           	<a class="search_usercenter_btn" href="javascript:;" onclick="if($.trim($('#q').val()) != '') $('#sourch_form').submit();">搜索</a>
		           </form>
		        </li>
			</ul>
		</div>
		<div class="shopingcar-index fr">
			<div class="u-g-cart fr fixed" id="hd-my-cart">
				<a href="<?php echo U('Home/Cart/index'); ?>">
					<p class="c-n fl">我的购物车</p>

					<p class="c-num fl">(<span class="count cart_quantity" id="cart_quantity">0</span>)
						<i class="i-c oh"></i>
					</p>
				</a>

				<div class="u-fn-cart u-mn-cart" id="show_minicart">
					<div class="minicartContent" id="minicart">
					</div>
					<!--有商品时-e-->
				</div>
			</div>
		</div>
	</div>
</div>
<script src="__STATIC__/js/common.js"></script>
<!--------收货地址，物流运费-开始-------------->
<script src="__PUBLIC__/js/locationJson.js"></script>
<script src="__STATIC__/js/location.js"></script>
<!--------收货地址，物流运费--结束-------------->

		<div class="home-index-middle">
			<div class="w1224">
				<div class="g-crumbs">
			       	<a href="<?php echo U('Home/User/index'); ?>">我的商城</a>
			       	<i class="litt-xyb"></i>
			       	<span>个人信息</span>
			    </div>
			    <div class="home-main">
					<style>
.menu_check{
	color:#2a81f4  !important; font-weight:bold
}
</style>
<div class="le-menu fl">
	<div class="menu-ul">
		<ul>
			<li class="ma"><i class="account-acc1"></i>交易中心</li>
			<li><a <?php if(\think\Request::instance()->action() == 'order_list'): ?>class ="menu_check"<?php endif; ?> href="<?php echo U('Home/Order/order_list'); ?>">我的订单</a></li>
			<!--<li><a href="">我的预售</a></li>-->
			
			<li><a <?php if(\think\Request::instance()->action() == 'comment'): ?>class ="menu_check"<?php endif; ?> href="<?php echo U('Home/Order/comment'); ?>">我的评价</a></li>
		
		</ul>
		<ul>
			<li class="ma"><i class="account-acc2"></i>资产中心</li>
			<li><a <?php if(\think\Request::instance()->action() == 'coupon'): ?>class ="menu_check"<?php endif; ?> href="<?php echo U('Home/User/coupon'); ?>">我的优惠券</a></li>
			<li><a <?php if(\think\Request::instance()->action() == 'recharge'): ?>class ="menu_check"<?php endif; ?> href="<?php echo U('Home/User/recharge'); ?>">账户余额</a></li>
			<li><a <?php if(\think\Request::instance()->action() == 'account'): ?>class ="menu_check"<?php endif; ?> href="<?php echo U('Home/User/account'); ?>">我的积分</a></li>
		</ul>
		<ul>
			<li class="ma"><i class="account-acc3"></i>关注中心</li>
			<li><a <?php if(\think\Request::instance()->action() == 'goods_collect'): ?>class ="menu_check"<?php endif; ?> href="<?php echo U('Home/User/goods_collect'); ?>">我的收藏</a></li>
			<!--<li><a href="">曾经购买</a></li>-->
			<li><a <?php if(\think\Request::instance()->action() == 'visit_log'): ?>class ="menu_check"<?php endif; ?> href="<?php echo U('Home/User/visit_log'); ?>">我的足迹</a></li>
		</ul>
		<ul>
			<li class="ma"><i class="account-acc4"></i>个人中心</li>
			<li><a <?php if(\think\Request::instance()->action() == 'info'): ?>class ="menu_check"<?php endif; ?> href="<?php echo U('Home/User/info'); ?>">个人信息</a></li>
			<li><a <?php if(\think\Request::instance()->action() == 'bind_auth'): ?>class ="menu_check"<?php endif; ?> href="<?php echo U('Home/User/bind_auth'); ?>">账号绑定</a></li>
			<li><a <?php if(\think\Request::instance()->action() == 'address_list'): ?>class ="menu_check"<?php endif; ?> href="<?php echo U('Home/User/address_list'); ?>">地址管理</a></li>
			<li><a <?php if(\think\Request::instance()->action() == 'safety_settings'): ?>class ="menu_check"<?php endif; ?> href="<?php echo U('Home/User/safety_settings'); ?>">安全设置</a></li>
			<li><a <?php if(\think\Request::instance()->action() == 'qrcode'): ?>class ="menu_check"<?php endif; ?> href="<?php echo U('Home/User/qrcode'); ?>">我的推广码</a></li>
			
		</ul>
		<ul>
			<li class="ma"><i class="account-acc5"></i>客户服务</li>
			<!--<li><a href="">我的发票</a></li>-->
			<li><a <?php if(\think\Request::instance()->action() == 'return_goods_index'): ?>class ="menu_check"<?php endif; ?> href="<?php echo U('Home/Order/return_goods_index'); ?>">退款换货</a></li>
			<!--<li><a <?php if(\think\Request::instance()->action() == 'consult'): ?>class ="menu_check"<?php endif; ?> href="<?php echo U('Home/Order/consult'); ?>">购买咨询</a></li>-->
			<li><a <?php if(\think\Request::instance()->action() == 'dispute'): ?>class ="menu_check"<?php endif; ?> href="<?php echo U('Home/Order/dispute'); ?>">交易投诉</a></li>
			<li><a <?php if(\think\Request::instance()->action() == 'expose_list'): ?>class ="menu_check"<?php endif; ?> href="<?php echo U('Home/Order/expose_list'); ?>">违规举报</a></li>
		</ul>
	</div>
</div>
			    	<div class="ri-menu fr">
						<div class="menumain p">
							<div class="goodpiece">
								<h1>个人信息</h1>
								<!--<a href=""><span class="co_blue">帮助</span></a>-->
							</div>
							<div class="personerinfro">
								<form action="" method="post">
									<ul class="hend_jz">
										<li class="infor_wi_le"><a href="javascript:void(0);">头像：</a></li>
										<li class="infor_img">
											<a href="javascript:void(0);">
												<img id="preview" src="<?php echo (isset($user['head_pic']) && ($user['head_pic'] !== '')?$user['head_pic']:'__STATIC__/images/headPic.jpg'); ?>" onClick="GetUploadify2(1,'head_pic','head_pic','add_img')"/>
											</a>
											<input type="hidden" name="head_pic" id="head_pic" value="<?php echo $user['head_pic']; ?>">
										</li>
									</ul>
									<ul class="name_jz">
										<li class="infor_wi_le"><a href="javascript:void(0);">昵称：</a></li>
										<li><a href="javascript:void(0);"><input class="name_zjxs" type="text" name="nickname" id="nickname" value="<?php echo $user['nickname']; ?>" maxlength="8"/></a></li>
									</ul>
									<!--<ul class="name_jz">-->
										<!--<li class="infor_wi_le"><a href="javascript:void(0);">真实姓名：</a></li>-->
										<!--<li><a href="javascript:void(0);"><input class="name_zjxs" type="text" name="" id="" value="" /></a></li>-->
									<!--</ul>-->
									<ul class="sex_jz">
										<li class="infor_wi_le"><a href="javascript:void(0);">性别：</a></li>
										<li>
											<a href="javascript:void(0);">
												<input type="radio" name="sex" id="secret" <?php if($user['sex'] == '0'): ?>checked<?php endif; ?> value="0"/><label for="secret">保密</label>
												<input type="radio" name="sex" id="man" <?php if($user['sex'] == '1'): ?>checked<?php endif; ?> value="1"/><label for="man">男</label>
												<input type="radio" name="sex" id="woman" <?php if($user['sex'] == '2'): ?>checked<?php endif; ?> value="2"/><label for="woman">女</label>
											</a>
										</li>
									</ul>
									<ul class="birth_jz">
										<li class="infor_wi_le"><a href="javascript:void(0);">生日：</a></li>
										<li>
											<a href="javascript:void(0);">
												<input type="text" name="birthday" id="birthday" value="<?php echo date('Y-m-d',$user['birthday']); ?>" />
											</a>
										</li>
									</ul>
									<ul class="hobby_jz">
										<li class="infor_wi_le"></li>
										<li class="infor_wi_ri">
											<div class="pcews">
												<span><i class="ph_c"></i>手机</span>
												<span class="<?php if($user[mobile_validated] == 0): ?>change_e<?php else: ?>change_p<?php endif; ?>">
                                                    <a style="cursor: pointer;" href="<?php echo U('Home/User/mobile_validate',array('type'=>'mobile','step'=>1)); ?>"><?php if($user['mobile_validated'] == 0): ?>未绑定<?php else: ?>更换绑定<?php endif; ?></a>
                                                </span>
												<span><i class="em_c"></i>邮箱</span>
												<span class="<?php if($user[email_validated] == 0): ?>change_e<?php else: ?>change_p<?php endif; ?>">
                                                    <a style="cursor: pointer;" href="<?php echo U('Home/User/email_validate',array('type'=>'email','step'=>1)); ?>"><?php if($user['email_validated'] == 0): ?>未绑定<?php else: ?>更换绑定<?php endif; ?></a>
                                                </span>
											</div>
											<div class="careful">
												<span class="fir_sen">注：修改密码、手机等信息到</span>
												<span class="co_blue"><a href="<?php echo U('Home/User/safety_settings'); ?>">安全设置</a></span>
											</div>
											<div class="save_s">
												<input class="save" type="submit" id="" name="" value="确认保存" />
											</div>
										</li>
									</ul>
								</form>
							</div>
						</div>
			    	</div>
			    </div>
			</div>
		</div>
		<!--footer-s-->
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
<!--侧边栏-s-->
<div class="slidebar_alo">
	<ul>
		<li class="re_cuso"><a target="_blank" href="" >客服服务</a></li>
		<li class="re_wechat">
			<a target="_blank" href="" >微信关注</a>
			<div class="rtipscont" style=""> 
				<span class="arrowr-bg"></span> 
				<span class="arrowr"></span> 
				<img src="__STATIC__/images/qrcode.png" /> 
				<p class="tiptext">扫码关注官方微信<br>先人一步知晓促销活动</p>
			</div>
		</li>
		<li class="re_phone">
			<a target="_blank" href="" >手机商城</a>
			<div class="rtipscont rstoretips" style=""> 
				<span class="arrowr-bg"></span> 
				<span class="arrowr"></span> 
				<img src="__STATIC__/images/qrcode.png" /> 
				<p class="tiptext">扫码关注官方微信<br>先人一步知晓促销活动</p>
			</div>
		</li>
		<li class="re_top"><a target="_blank" href="javascript:void(0);" >回到顶部</a></li>
	</ul>
</div>
<!--侧边栏-e-->
<script>
    //用户中心统一确认提示框
    function verConfirm(msg , callback){
        layer.confirm(msg, {
                btn: ['确定','取消'] //按钮
            }, function(){
                location.href=callback;
            }
        );
    }
    //显示密码安全等级
    function securityLevel(sValue) {
        var modes = 0;
        //正则表达式验证符合要求的
        if (sValue.length < 6 ) return modes;
        if (/\d/.test(sValue)) modes++; //数字
        if (/[a-z]/.test(sValue)) modes++; //小写
        if (/[A-Z]/.test(sValue)) modes++; //大写
        if (/\W/.test(sValue)) modes++; //特殊字符
        $('.lowzg').eq(modes-1).addClass('red').siblings('.lowzg').removeClass('red');
    };
//侧边栏 (单首页)
$(function(){
	//鼠标滑过二维码显示隐藏
	$('.slidebar_alo li').hover(function(){
		$(this).find('.rtipscont').animate({
			opacity:"1",
			left:"-182px"
		})
	},function(){
		$(this).find('.rtipscont').animate({
			opacity:"0",
			left:"0px"
		})
	})
	$(".slidebar_alo .re_top").click(function () {
		//回到顶部
	    var speed=300;//滑动的速度
	    $('body,html').animate({ scrollTop: 0 }, speed);
	    return false;
	});
	//回到顶部显示隐藏
	$(window).scroll(function ()
	{
		var st = $(this).scrollTop();
		if(st == 0){
			$('.re_top').hide(300)
		}else{
			$('.re_top').show(300)
		}
	});
});
</script>
		<!--footer-e-->
		<script type="text/javascript">
			  $(document).ready(function() {
				// 生日时间
				$('#birthday').layDate();
			});
			$(function(){
				$('.choice_hobby').click(function(){
					$(this).toggleClass('red');
				})
			})
			function delimg(file,t){
				$.get(
						"/index.php?m=Admin&c=Uploadify&a=delupload",{action:"del", filename:file},function(){}
				);
				$('#head_pic').val('');
				$('#preview').attr('src','');
				$(t).remove();
			}
			function add_img(str){
				var head_pic = $('#head_pic').val();
				$('#head_pic').val(str);
				$('#preview').attr('src',str);
				$('img[class="headpic"]').attr('src',str);

			}
		</script>
	</body>
</html>