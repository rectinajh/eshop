<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:37:"./template/pc/rainbow/user/login.html";i:1532661070;s:40:"./template/pc/rainbow/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>登录-<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>
<meta name="keywords" content="<?php echo $tpshop_config['shop_info_store_keyword']; ?>" />
<meta name="description" content="<?php echo $tpshop_config['shop_info_store_desc']; ?>" />
<link rel="stylesheet" type="text/css" href="__STATIC__/css/login.css">
<link rel="stylesheet" type="text/css" href="__STATIC__/css/common.min.css">
<link rel="stylesheet" type="text/css" href="__STATIC__/css/tpshop.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.10.2.min.js"></script>
<script src="__PUBLIC__/js/layer/layer.js"></script>
</head>
<body>
<div class="header area" style="padding: 10px 0; line-height: 65px;">
    <a href="/index.php" class="logo_s" title="首页" style="margin: 10px 0;height: 60px; ">
        <img src="<?php echo $tpshop_config['shop_info_store_logo']; ?>" style="max-width: 240px;"/>
    </a>
    <span class="login-welcome" style="font-size: 28px;font-family:微软雅黑;">
        <span>欢迎登录</span>
    </span>
</div>
<div class="m-login" id="divMLogin">
  <div class="login-wrap">
    <div class="banner">
        <?php $pid =9;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532689200 and end_time > 1532689200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
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
foreach($result as $k=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
            <a href="<?php echo $v[ad_link]; ?>" id="aBanner">
                <img src="<?php echo $v[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>"/>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="login-form">
      <div class="title oh">
        <h1 class="fl">登录新淘链商城</h1>
        <div class="regist-link fr"> <a href="<?php echo U('Home/User/reg'); ?>" style="color: #6596e3;">免费注册</a> </div>
      </div>
      <div class="u-msg-wrap">
        <div class="msg msg-warn" style="display:none;"> <i></i>
          <span>公共场所不建议自动登录，以防帐号丢失</span>
        </div>
        <div class="msg msg-err" style="display:none;"> <i></i>
          <span class="J-errorMsg"></span>
        </div>
      </div>
      <form id="login-form" method="post">
      	
        <div class="u-input mb20">
          <label class="u-label u-name"></label>
          <input type="text" class="u-txt J-input-txt" value="" placeholder="手机号/邮箱" name="username" id="username" autocomplete="off">
        </div>
        <div class="u-input mb15">
          <label class="u-label u-pwd"></label>
          <input type="password" class="u-txt J-input-txt" placeholder="密码"  name="password" id="password" autocomplete="off">
        </div>
       <!--  <div class="u-input mb15">
			<input type="text" placeholder="不区分大小写" name="verify_code" id="verify_code" class="u-txt J-input-txt" style="width:100px; padding:10px;"/>
            <img    onclick="verify(this);" width="140" height="42" src="" id="verify_code_img" class="po-ab to0">
            <a><img onclick="verify(this);" src="__STATIC__/images/chg_image.png" class="ma-le-142 po-ab to18"></a>
        </div>   -->      
        <div class="u-safe">
          <span class="auto">
            <label>
          	    <input type="hidden" name="referurl" id="referurl" value="<?php echo $referurl; ?>">
                <input type="checkbox" class="u-ckb J-auto-rmb"  name="remember" style="visibility:hidden"><!-- 自动登录 -->
            </label>
          </span>
          <span class="forget"><a href="<?php echo U('Home/User/forget_pwd'); ?>">忘记密码？</a></span>
        </div>         
        <div class="u-btn mb20 mt20"> <a href="javascript:void(0);" onClick="checkSubmit();" class="J-login-submit" name="sbtbutton">登&nbsp;&nbsp;&nbsp;&nbsp;录</a> </div>
      </form>
      <!-- <dl class="account">
        <dt class="mr20">使用第三方登录:</dt>
          <?php
                                   
                                $md5_key = md5("select * from __PREFIX__plugin where type='login' AND status = 1");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from __PREFIX__plugin where type='login' AND status = 1"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): if($v['code'] == 'qq'): ?><dd><a href="<?php echo U('LoginApi/login',array('oauth'=>'qq')); ?>" class="qq" title="QQ"></a></dd><?php endif; if($v['code'] == 'weixin'): ?><dd><a href="<?php echo U('LoginApi/login',array('oauth'=>'weixin')); ?>" class="qq weixin" title="weixin"></a></dd><?php endif; if($v['code'] == 'alipay'): ?><dd><a href="<?php echo U('LoginApi/login',array('oauth'=>'alipay')); ?>" class="qq pay" title="支付宝"></a></dd><?php endif; endforeach; ?>
      </dl> -->
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
 <script>
    /*  $(function(){
         verify();
     }) */
	function checkSubmit()
	{
		$('.msg-err').hide();
		$('.J-errorMsg').empty();
		var username = $.trim($('#username').val());
		var password = $.trim($('#password').val());
		var referurl = $('#referurl').val();
		
		//var verify_code = $.trim($('#verify_code').val());
		//r.test(username);
		if(username == ''){
			showErrorMsg('用户名不能为空!');
			return false;
		}
		
		
		if(password == ''){
			showErrorMsg('密码不能为空!');
			return false;
		}
        if(!checkMobile(username) && !checkEmail(username)){
            showErrorMsg('账号格式不匹配!');
            return false;
        }
        $.ajax({
            type : 'post',
            url : '/index.php?m=Home&c=User&a=do_login&t='+Math.random(),
            data : {username:username,password:password,referurl:referurl},	
            dataType : 'json',
            success : function(res){
                if(res.status == 1){
                    window.location.href = res.url;
                }else{
                    showErrorMsg(res.msg);
                    verify();
                }
            },
            error : function(XMLHttpRequest, textStatus, errorThrown) {
                showErrorMsg('网络失败，请刷新页面后重试');
            }
        });
		
		/* if(verify_code == ''){
			showErrorMsg('验证码不能为空!');
			return false;
		} */
		//$('#login-form').submit();
		
		
	}
	
    function checkMobile(tel) {
        var reg = /(^1[3|4|5|7|8][0-9]{9}$)/;
        if (reg.test(tel)) {
            return true;
        }else{
            return false;
        };
    }
    
    function checkEmail(str){
        var reg = /^([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
        if(reg.test(str)){
            return true;
        }else{
            return false;
        }
    }
    
    function showErrorMsg(msg){
    	layer.alert(msg , {icon:2, time:2000});
    }
    
   /*  function verify(){
        $('#verify_code_img').attr('src','/index.php?m=Home&c=User&a=verify&r='+Math.random());
     } */
</script>
</body>
</html>