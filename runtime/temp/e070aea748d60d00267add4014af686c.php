<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:45:"./template/pc/rainbow/newjoin/apply_info.html";i:1532661070;s:45:"./template/pc/rainbow/public/sign-header.html";i:1532661070;s:40:"./template/pc/rainbow/public/footer.html";i:1532661070;}*/ ?>
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
	<link href="__STATIC__/css/common.min.css" rel="stylesheet" type="text/css" />
	<link href="__STATIC__/css/qt_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<script src="__PUBLIC__/js/layer/layer.js"></script><!--弹窗js 参考文档 http://layer.layui.com/-->
<div class="m-top-bar editable" moduleid="1539923" style="position:relative;min-height:25px;">
    <div class="container">
        <ul class="fl">
            <?php if($user[user_id] > 0): ?>
                <li class="fl J_login_status">
                    <a href="<?php echo U('Home/user/index'); ?>" alt="" title="" target="_self"><?php echo (isset($user['nickname']) && ($user['nickname'] !== '')?$user['nickname']:$user['mobile']); ?></a>
                    <a  href="<?php echo U('Home/user/logout'); ?>" style="margin:0 10px;" title="退出" target="_self">退出</a></li>
                <?php else: ?>
                <li class="fl J_login_status"><a class="menu-item fl J_do_login J_chgurl" href="<?php echo U('Home/user/login'); ?>">
                    <span>Hi，请登录</span> </a><a class="menu-item fl ht" href="<?php echo U('Home/user/reg'); ?>">免费注册</a>
            <?php endif; ?>
            <li class="fl sep"></li>
            <li class="fl select-city dropdown">
        <!--<span class="menu-item">-->
        <!--<span>送货至：</span>-->
        <!--<a title="" alt="" href="" class="J_cur_place"></a><i class="dd"></i></span>-->
            </li>
        </ul>
        <ul class="fr bar-right">
            <li class="fl dropdown my-feiniu"><a class="menu-item" target="_blank" href="<?php echo U('/Home/User/index'); ?>">
                <span>我的商城</span><i class="dd"></i></a>
                <ul class="sub-panel">
                    <li><a class="J_chgurl" target="_blank" href="<?php echo U('/Home/Order/order_list'); ?>">我的订单</a></li>
                    <li><a class="J_chgurl" target="_blank" href="<?php echo U('/Home/User/account'); ?>">我的积分</a></li>
                    <li><a class="J_chgurl" target="_blank" href="<?php echo U('/Home/User/coupon'); ?>">我的优惠券</a></li>
                    <li><a class="J_chgurl" target="_blank" href="<?php echo U('/Home/User/goods_collect'); ?>">我的收藏夹</a></li>
                    <li><a class="J_chgurl" target="_blank" href="<?php echo U('/Home/Order/comment'); ?>">我的评论</a></li>
                </ul>
            </li>
            <li class="fl sep"></li>
            <!-- <li class="fl dropdown mobile-feiniu"><a class="menu-item" href=""><i class="fl ico"></i>
                <span class="fl">手机TPshop网</span>
                <i class="dd"></i></a>
                <div class="sub-panel m-lst">
                    <p>扫一扫，下载TPshop客户端</p>
                    <dl>
                        <dt class="fl mr10"><a target="_blank" href=""><img height="80" width="80" src="__STATIC__/images/qrcode_vmall_app01.png"></a></dt>
                        <dd class="fl mb10"><a target="_blank" href=""><i class="andr"></i> Andiord</a></dd>
                        <dd class="fl"><a target="_blank" href=""><i class="iph"></i> iPhone</a></dd>
                    </dl>
                </div>
            </li> -->
            <li class="fl sep"></li>
            <li class="fl"><a class="menu-item" href="<?php echo U('Home/Article/detail'); ?>" target="_blank">
                <span>帮助中心</span>
            </a></li>
            <li class="fl sep"></li>
            <li class="fl about-us"><a class="txt fl" style="line-height:unset;" href="">关注我们：</a></li>
            <li class="fl dropdown weixin"><a href="" class="fl ico"></a>
                <div class="sub-panel wx-box">
                    <span class="arrow-b">◆</span>
                    <span class="arrow-a">◆</span>
                    <p class="n"> 扫描二维码 <br>	关注新淘链商城官方微信 </p>
                    <img src="__STATIC__/images/weixin.png"></div>
            </li>
        </ul>
    </div>
</div>
<style>
.store-joinin-apply {
    filter: progid:DXImageTransform.Microsoft.gradient(enabled='true', startColorstr='#D8FFFFFF', endColorstr='#D8FFFFFF');
    background: #fff;opacity: 0.85;width: 790px;padding: 20px 100px;margin: 20px auto;
}
.main {width: 790px;border-radius: 4px;}
.main .explain {font: 16px/32px "microsoft yahei";color: #777;margin: 10px 0 100px 0;}
.main .bottom, .apply-agreement .bottom, .joinin-pay .bottom {text-align: center;height: 30px;margin: 30px 0 10px 0;}
/*操作温馨提示*/
.operat-tips{ color: #666; background: rgba(93,178,255,.1); border: 1px solid #BCE8F1; padding: 20px;margin-top: 20px;}
.operat-tips h4{font-size: 14px; font-weight: normal; line-height: 20px; height: 20px;}
.operat-tips h4 i{background-position: -384px -224px;height: 26px;margin-right: 10px}
.operat-tips ul.operat-panel{ padding: 10px 0px 0px 20px;}
.operat-tips ul.operat-panel li { line-height: 20px; margin-bottom: 2px; list-style-type: disc; padding-left: 3px; list-style-position: outside; font-size: 8px;}
.operat-tips ul.operat-panel li span{ font-size: 12px; color: #999;}
ul, ol, li {list-style-image: none;list-style-type: none;}
/*成功提示*/
.operat-tips.success h4,.operat-tips.lose h4{ font-weight:600; height:30px; font-size:15px; line-height:30px;}
.operat-tips.success h4 i,.operat-tips.lose h4 i{background: url(../images/apply/joinin_pic.png) no-repeat -216px -150px;width: 30px;height: 30px;}
.operat-tips.lose h4 i{ background-position:-135px -150px;}
.operat-tips p,.operat-tips .bottom{ text-align:left; padding: 10px 0px 0px 20px;}
.operat-tips p.handle{ margin-top:20px;}
.operat-tips p.handle span.line{ color:#999; margin:0px 20px}
.bottom {text-align: left;padding: 10px 0px 0px 20px;margin-top: 20px;}
.bottom .btn {margin-right: 5px;}
a.btn-primary, .btn-primary {background-color: #df3434;color: #fff; border-color: #df3434;}
.btn {
    font-family: "Microsoft Yahei", "Lucida Grande", Verdana, Lucida, Helvetica, Arial, sans-serif;
    display: inline-block;padding: 0 10px;height: 32px;line-height: 30px;color: #666;
    min-width: 80px;cursor: pointer;text-align: center;font-size: 12px;font-weight: 400;
    box-sizing: border-box;vertical-align: middle;-webkit-appearance: none;-webkit-user-select: none;
    -moz-user-select: none;-ms-user-select: none;user-select: none;outline: 0; text-decoration: none;
    background-image: none;background-color: #f6f6f6;border: 1px solid #ccc; border-radius: 2px;
}
.btn-link {color: #0579c6;}
.operat-tips a:hover{color: #E31939;text-decoration: none;cursor: pointer;}
.ad-box, .ad-box a {width:100%;margin: 40px auto 10px;}
.ad-box .ad-img {max-width: 100%;max-height: 100%;}
a.btn-primary:hover, .btn-primary:hover {color: #fff;background-color: #ee3f36;border-color: #ee3f36;}
</style>
<div class="gome-wrap bg">
	<div style="position: relative;top: -40px;left: 350px;">
    	<a href="/" target="_blank" class="item fl"><img height="60" width="160" src="<?php echo $tpshop_config['shop_info_store_logo']; ?>"></a>
    </div>
	<div class="gome-layout-area">
        <ul class="gome-nav">
            <li><a href="<?php echo U('Newjoin/index'); ?>" target="_blank">招商首页</a></li>
        	<?php
                                   
                                $md5_key = md5("select * from `__PREFIX__article_cat` where parent_id=2");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from `__PREFIX__article_cat` where parent_id=2"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>
            	<li><a href="<?php echo U('Newjoin/question',array('cat_id'=>$v[cat_id])); ?>" target="_blank"><?php echo $v['cat_name']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<div class="gome-layout-area pb50 clearfix">
    	<ul class="steps clearfix">
        	<li class="first prev ok"><b>1</b><span class="going"></span><em class="f">入驻须知</em></li>
        	<li class="prev ok"><b>2</b><span class="going"></span><em class="f">填写公司信息</em></li>
        	<li class="prev ok"><b>3</b><span class="going"></span><em class="f">填写店铺信息</em></li>
        	<li class="prev ok"><b>4</b><span class="going"></span><em class="f">资质上传</em></li>
			<?php if($apply[apply_state] == 1): ?>
				<li class="last ok"><b>5</b><em class="f" style="color: #c00">审核通过</em></li>
				<?php else: ?>
				<li class="last"><b>5</b><em class="f">等待审核</em></li>
			<?php endif; ?>
        </ul>
<div class="store-joinin-apply">
  <div class="main">
    <div class="main">
		<div class="explain"><i></i>
		<?php if($apply[apply_state] == 0): ?>
		<p style="text-align:center;">入驻申请已经提交，请等待管理员审核</p>
			<?php if($apply[paying_amount] > 0): ?>
			<span>请缴纳入驻费：<?php echo $apply['paying_amount']; ?> 元</span>	
			<form name="" method="post" enctype="multipart/form-data">
         		<input type="text" name="paying_amount_cert" id="paying_amount_cert" class="input260" value="<?php echo $apply['paying_amount_cert']; ?>">
                <input type="button" class="gome-btn-red" onClick="GetUploadify(1,'paying_amount_cert','seller','')"  value="上传付款凭证"/>
               	<input type="submit" class="gome-btn-gray"  value="提交"/>
               	<?php if(!(empty($apply['paying_amount_cert']) || (($apply['paying_amount_cert'] instanceof \think\Collection || $apply['paying_amount_cert'] instanceof \think\Paginator ) && $apply['paying_amount_cert']->isEmpty()))): ?>
                    <div style="width: 640px;height: 320px;">
                    	<img height="320" src="<?php echo $apply['paying_amount_cert']; ?>" nc_type="store_label">
     				</div>
         		<?php endif; ?>
         	</form>
			<?php endif; elseif($apply[apply_state] == 1): ?>
			<div class="operat-tips success">
				<h4>
					<i></i>恭喜您的申请审核通过，店铺创建成功！
				</h4>
				<ul class="operat-panel">
					<li>
						<span>现在您可以去经营您的店铺了，赶紧去发布商品吧；</span>
					</li>
					<li>
						<span>
							您也可以登录
							<a class="btn-link" href="<?php echo U('Seller/Admin/login'); ?>">商家入驻中心</a>
							及时查看审核状态；
						</span>
					</li>
					<li>
						<span> 如有疑问请联系网站客服。 </span>
					</li>
				</ul>
		
				<div class="bottom">
					<a class="btn btn-primary" href="<?php echo U('Seller/Admin/login'); ?>">进入卖家中心 </a>
					<a class="btn" href="<?php echo U('Index/index'); ?>">返回首页 </a>
				</div>
				<p class="handle">
					您还可以：
					<a class="btn-link" href="<?php echo U('Seller/Admin/login'); ?>">进入卖家中心，完善店铺信息</a>
				</p>
			</div>
		<?php else: ?>
			<p style="color:red;">抱歉，您的申请没有通过，<?php echo $apply['review_msg']; ?></p>
			<div class="operat-tips success">
				<div class="bottom">
					<a class="btn btn-primary" href="<?php echo U('Newjoin/basic_info'); ?>">修改申请资料 </a>
					<a class="btn" href="<?php echo U('Index/index'); ?>">返回首页 </a>
				</div>
			</div>
		<?php endif; ?>
		</div>
		<div class="bottom"></div>
	</div>
  </div>
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
</body>
</html>