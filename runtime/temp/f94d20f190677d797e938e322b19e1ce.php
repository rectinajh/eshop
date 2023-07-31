<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:44:"./template/mobile/default/user/password.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>修改密码--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

    <link rel="stylesheet" href="__STATIC__/css/style.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" type="text/css" href="__STATIC__/css/iconfont.css?v=<?php echo time(); ?>"/>

    <!-- <link rel="stylesheet" type="text/css" href="__STATIC__/css/iconfont2.css?v=<?php echo time(); ?>"/> -->

    <link rel="stylesheet" type="text/css" href="__ROOT__/public/css/style.css?v=<?php echo time(); ?>"/>

    <script src="__STATIC__/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>

    <script src="__STATIC__/js/mobile-util.js" type="text/javascript" charset="utf-8"></script>


    <script src="__STATIC__/js/layer/layer.js" type="text/javascript" charset="utf-8"></script>
    <script src="__PUBLIC__/js/global.js"></script>
    

    <script src="__STATIC__/js/swipeSlide.min.js" type="text/javascript" charset="utf-8"></script>

    <script src="__PUBLIC__/js/mobile_common.js"></script>

</head>

<body class="[body]">


    <div class="classreturn loginsignup">

        <div class="content">

            <div class="ds-in-bl return">

                <a href="javascript:history.back(-1);"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

            </div>

            <div class="ds-in-bl search center">

                <span>修改密码</span>

            </div>

            <!--<div class="ds-in-bl menu">

                <a href="javascript:void(0);"><img src="__STATIC__/images/class1.png" alt="菜单"></a>

            </div>-->

        </div>

    </div>
	<div style="height:1.92rem;"></div>
    <div class="loginsingup-input ">

        <form action="" method="post" onsubmit="return submitverify(this)">

            <div class="content30">

                <div class="lsu">

                    <span>旧密码</span>

                    <input type="password" name="old_password" id="old_password" value=""  placeholder="旧密码">

                </div>

                <div class="lsu">

                    <span>新密码</span>

                    <input type="password" name="new_password" id="new_password" value=""  placeholder="新密码">

                </div>

                <div class="lsu">

                    <span>确认密码</span>

                    <input type="password" name="confirm_password" id="confirm_password" value=""  placeholder="再次输入新密码">

                </div>



                <div class="lsu submit">

                    <input type="submit" name="" id="sub" value="确认修改">

                </div>

            </div>

        </form>

    </div>
<!--底部导航-start-->

        <!-- 
    <a id="gotop" href="javascript:$('html,body').animate({'scrollTop':0},600);" style="display: block;width: 0.853rem;height: 0.853rem;position: fixed; bottom: 2.027rem;right: 8px; background-color: rgba(243,241,241,0.5);border: 1px solid #CCC;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;">

        <img src="__STATIC__/images/topup.png" style="display: block;width: 0.853rem;height: 0.853rem;">

    </a> -->
    
</footer>
<div id="footers" style="z-index: 9999999;">
    <a <?php if(CONTROLLER_NAME == 'Index'): ?> class="on" <?php endif; ?> href="<?php echo U('Index/index'); ?>">
        <p><i class="iconfont icon-size icon-dingbu_shouye" ></i></p>
        <span>首页</span>
    </a>
    <a <?php if(CONTROLLER_NAME == 'Goods'): ?> class="on" <?php endif; ?> href="<?php echo U('Goods/categoryList'); ?>">
        <p><i class="iconfont icon-size icon-fenlei"></i></p>
        <span>分类</span>
    </a>
     <a <?php if(CONTROLLER_NAME == 'Gold'): ?> class="on" <?php endif; ?> href="<?php echo U('Gold/gold_chain'); ?>">
        <p><i class="iconfont icon-size icon-jifen"></i></p>
        <span>新淘链</span>
    </a>
    <a <?php if(CONTROLLER_NAME == 'Cart'): ?> class="on" <?php endif; ?> href="<?php echo U('Cart/index'); ?>">
        <p><i class="iconfont icon-size icon-gouwuche"></i></p>
        <span>购物车</span>
    </a>
    <a <?php if(CONTROLLER_NAME == 'User'): ?> class="on" <?php endif; ?> href="<?php echo U('User/index'); ?>">
        <p><i class="iconfont icon-size icon-wode"></i></p>
        <span>我的</span>
    </a>
</div>

        <!--底部导航-end-->
<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" charset="utf-8">

    //验证表单

    function submitverify(obj){

        var oldpass = $.trim($('#old_password').val());

        var newpass = $.trim($('#new_password').val());

        var confirmpass = $.trim($('#confirm_password').val());

        if(oldpass == '' || newpass =='' ||  confirmpass == ''){

            layer.open({content:'密码不能为空',time:3});

            return false;

        }

        if(newpass !== confirmpass){

            layer.open({content:'两次密码不一致',time:3});

            return false;

        }

        if(newpass.length < 6 || confirmpass.length < 6){

            layer.open({content:'密码长度不能少于6位',time:3});

            return false;

        }

        $(obj).onsubmit();

    }

</script>

	</body>

</html>

