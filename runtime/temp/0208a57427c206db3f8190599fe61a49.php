<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:47:"./application/admin/view2/admin/forget_pwd.html";i:1532661068;}*/ ?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>找回密码 - www.ohbbs.cn 欧皇源码论坛 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="__PUBLIC__/static/css/login.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="__PUBLIC__/static/js/jquery.js"></script>
	<script type="text/javascript" src="__PUBLIC__/static/js/jquery.SuperSlide.2.1.2.js"></script>
	<script type="text/javascript" src="__PUBLIC__/static/js/jquery.validation.min.js"></script>
</head>

<body>
<div class="backPwd_layout">
        <form action="" method="post" id="theForm">
        <div class="backPwd_form">
            <div class="title">找回密码</div>
            <div id="error"></div>
            <div class="formInfo">
                <div class="formText">
                    <input type="text" name="user_name" autocomplete="off" class="input-text" value="" placeholder="输入管理员账号" />
                </div>
                <div class="formText">
                    <input type="text" name="email" autocomplete="off" class="input-text" value="" placeholder="输入电子邮箱" />
                </div>
                <div class="formText btn_div">
                    <input type="submit" name="submit" class="sub" value="找回密码" />
                    <input type="reset" name="qx" class="cancel" value="取消" />
                </div>
                <div class="formText">
                    <a href="<?php echo U('Admin/login'); ?>" class="return">返回登录</a>
                </div>
            </div>
        </div>
        <input type="hidden" name="action" value="get_pwd" />
        <input type="hidden" name="act" value="forget_pwd" />
    </form>

    <script type="text/javascript">
        /*  @author-bylu 找回密码输入验证 start  */
        $('#theForm input[name=submit]').on('click',function(){
            var username=true;
            var email=true;

            if($('#theForm input[name=user_name]').val() == ''){
                $('#error').html('<span class="error_msg">管理员用户名不能为空!</span>');
                $('#theForm input[name=user_name]').focus();
                username = false;
                return false;
            }

            if($('#theForm input[name=email]').val() == ''){
                $('#error').html('<span class="error_msg">邮箱不能为空!</span>');
                $('#theForm input[name=email]').focus();
                email = false;
                return false;
            }

            if(CheckMail($('#theForm input[name=email]').val()) == false){
                $('#error').html('<span class="error_msg">邮箱格式不正确!</span>');
                $('#theForm input[name=email]').focus();
                email = false;
                return false;
            }

            function CheckMail(mail) {
                var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (filter.test(mail)) return true;
                else { return false;}
            }

            if(username && email){
                $('#theForm').submit();
            }else{
                return false;
            }
        });
        /*  @author-bylu  end  */
    </script>

    
    </div>
<div id="bannerBox">
    <ul id="slideBanner" class="slideBanner">
        <li><img src="__PUBLIC__/static/images/banner_1.jpg"></li>
        <li><img src="__PUBLIC__/static/images/banner_2.jpg"></li>
        <li><img src="__PUBLIC__/static/images/banner_3.jpg"></li>
        <li><img src="__PUBLIC__/static/images/banner_4.jpg"></li>
        <li><img src="__PUBLIC__/static/images/banner_5.jpg"></li>
    </ul>
</div>
<script type="text/javascript">
    $("#bannerBox").slide({mainCell:".slideBanner",effect:"fold",interTime:3500,delayTime:500,autoPlay:true,autoPage:true,endFun:function(i,c,s){
        $(window).resize(function(){
            var width = $(window).width();
            var height = $(window).height();
            s.find(".slideBanner,.slideBanner li").css({"width":width,"height":height});
        });
    }});
</script>
</body>
</html>