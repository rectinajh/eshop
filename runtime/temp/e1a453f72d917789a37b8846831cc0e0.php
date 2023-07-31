<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:41:"./template/pc/rainbow/user/pop_login.html";i:1532228868;}*/ ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="UTF-8">
   <title>登录-<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>
   <meta name="keywords" content="<?php echo $tpshop_config['shop_info_store_keyword']; ?>" />
   <meta name="description" content="<?php echo $tpshop_config['shop_info_store_desc']; ?>" />
  <link rel="stylesheet" href="__STATIC__/css/base.css">
  <link rel="stylesheet" href="__STATIC__/css/fn_login.css">
</head>
<body>
<div class="u-diaolog-login-content">
  <form action="#" name="" class="J-login" method="post">
    <input type="hidden" value="" id="refer">
    <div class="u-reg mb13"><a class="f12" href="<?php echo U('Home/User/reg'); ?>" target="_blank">免费注册</a></div>
    <div class="u-message-error mb10 pl30 f12 u-msg-wrap" id="u-mb-msg" ><i></i>
    	<span class="J-errorMsg">公共场所不建议自动登录，以防帐号丢失</span>
    </div>
    <div class="u-input mb20">
      <label for="loginname" class="u-label u-name"></label>
      <input id="username" type="text" class="u-txt J-txt"   value="" name="username" tabindex="1" placeholder="用户名/手机号">
    </div>
    <div class="u-input mb10">
      <label for="loginpwd" class="u-label u-pwd"></label>
      <input id="password" type="password" class="u-txt J-txt" name="password" tabindex="2" placeholder="密码">
    </div>
    <div class="u-forget fn-clear">
      <p class="ltxt">
      	<label><input type="hidden" name="referurl" id="referurl" value="<?php echo $referurl; ?>">
      	<input type="checkbox" class="ainput" name="chkRememberMe" />自动登录</label>
      </p>
      <a class="f12" href="<?php echo U('Home/User/forget_pwd'); ?>" target="_blank">忘记密码了？</a>
    </div>
  
    <div class="u-btn mt20">
  <input id="J_sbmbtn" type="button" tabindex="4" onclick="checkSubmit()" value="登  录">
</div>
</form>

</div>
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.10.2.min.js"></script>
</body>
<script>	
function checkSubmit()
{
	$('.u-msg-wrap').hide();
	$('.J-errorMsg').empty();
	var username = $.trim($('#username').val());
	var password = $.trim($('#password').val());
	var referurl = $('#referurl').val();
	
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
	//$('#login-form').submit();
	$.ajax({
		type : 'post',
		url : '/index.php?m=Home&c=User&a=do_login&t='+Math.random(),
		data : {username:username,password:password,referurl:referurl},		
		dataType : 'json',
		success : function(res){
			if(res.status == 1){
				top.location.href = res.url;
			}else{
				showErrorMsg(res.msg);
				
			}
		},
		error : function(XMLHttpRequest, textStatus, errorThrown) {
			showErrorMsg('网络失败，请刷新页面后重试');
		}
	})
	
	
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
	$('.u-msg-wrap').show();
	$('.J-errorMsg').html(msg);
}



</script>
</html>
