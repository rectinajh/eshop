<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:42:"./template/mobile/default/user/paypwd.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>设置支付密码--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

<body class="">

<div class="classreturn">

    <div class="content">

        <div class="ds-in-bl return">

            <a href="<?php echo U('Mobile/User/userinfo'); ?>"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

        </div>

        <div class="ds-in-bl search center">

            <span>设置支付密码</span>

        </div>

        <div class="ds-in-bl menu">

            <!-- <a href="javascript:void(0);"><img src="__STATIC__/images/class1.png" alt="菜单"></a> -->

        </div>

    </div>

</div>
<div style="height: 1.8rem;"></div>
<div class="flool tpnavf">

    <div class="footer">

        <ul>

            <li>

                <a class="yello" href="<?php echo U('Index/index'); ?>">

                    <div class="icon">

                        <i class="icon-shouye iconfont"></i>

                        <p>首页</p>

                    </div>

                </a>

            </li>

            <li>

                <a href="<?php echo U('Goods/categoryList'); ?>">

                    <div class="icon">

                        <i class="icon-fenlei iconfont"></i>

                        <p>分类</p>

                    </div>

                </a>

            </li>

            <li>

                <!--<a href="shopcar.html">-->

                <a href="<?php echo U('Cart/index'); ?>">

                    <div class="icon">

                        <i class="icon-gouwuche iconfont"></i>

                        <p>购物车</p>

                    </div>

                </a>

            </li>

            <li>

                <a href="<?php echo U('User/index'); ?>">

                    <div class="icon">

                        <i class="icon-wode iconfont"></i>

                        <p>我的</p>

                    </div>

                </a>

            </li>

        </ul>

    </div>

</div>
<style>
    .fetchcode {
        background-color: #ec5151;
        border-radius: 0.128rem;
        color: white;
        padding: 0.55467rem 0.21333rem;
        vertical-align: middle;
        font-size: 0.59733rem;
    }
    #fetchcode {
        background: #898995;
        border-radius: 0.128rem;
        color: white;
        padding: 0.55467rem 0.21333rem;
        vertical-align: middle;
        font-size: 0.59733rem;
    }
</style>
<?php if($step == 1): ?>
    <div class="loginsingup-input singupphone findpassword">
        <form method="post">
            <div class="content30">
                <div class="lsu bk">
                    <span>手机号</span>
                    <input type="text" name="mobile" id="tel" value="<?php echo $user['mobile']; ?>" placeholder="请输入您的手机号" onBlur="checkMobilePhone(this.value);"/>
                </div>
                <div class="lsu boo zc_se">
                    <input type="text" name="mobile_code" id="tpcode" value="" placeholder="请输入验证码">
                    <a href="javascript:void(0);" rel="mobile" id="fcode" onclick="sendcode(this)">获取短信验证码</a>
                </div>
                <div class="lsu submit">
                    <input type="button" onclick="nextstep()" value="确认修改" />
                </div>
            </div>
        </form>
    </div>
<?php endif; if($step == 2): ?>
    <div class="loginsingup-input singupphone findpassword">
        <form method="post" id="payform">
            <div class="content30">
                <?php if($user['paypwd'] != ''): ?>
                    <div class="lsu bk">
                        <span>旧密码</span>
                        <input type="password" name="oldpaypwd" id="oldpaypwd" placeholder="请输入您的支付密码" />
                    </div>
                <?php endif; ?>
                <div class="lsu bk">
                    <span>密码</span>
                    <input type="password" name="new_password" id="new_password" placeholder="请输入新密码" />
                </div>
                <div class="lsu bk">
                    <span>确认</span>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="再次输入新密码" />
                </div>
                <div class="lsu submit">
                    <input type="button" onclick="submitverify()" value="确认修改" />
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>
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
<script>
    //手机验证
    function checkMobilePhone(mobile) {
        if (mobile == '') {
            showErrorMsg('请输入您的手机号');
            return false;
        } else if (!checkMobile(mobile)) {
            showErrorMsg('手机号码格式不正确！');
            return false;
        }
    }
    //发送短信验证码
    function sendcode(obj) {
        var tel = $.trim($('#tel').val());
        var obj = $(obj);
        if (tel == '') {
            showErrorMsg('请输入您的号码！');
            return false;
        }
        var s = 60;
        //改变按钮状态
        obj.unbind('click');
        //添加样式
        obj.attr('id', 'fetchcode');
        callback();
        //循环定时器
        var T = window.setInterval(callback, 1000);
        function callback() {
            if (s <= 0) {
                //移除定时器
                window.clearInterval(T);
                obj.bind('click', sendcode)
                obj.removeAttr('id', 'fetchcode');
                obj.text('获取短信验证码');
            } else {
                obj.text(--s + '秒后再获取');
            }
        }
        $.ajax({
            //url:'/index.php?m=Mobile&c=User&a=send_validate_code&t='+Math.random(), //原获取短信验证码方法
            url: "/index.php?m=Home&c=Api&a=send_validate_code&scene=6&type=mobile&send=" + tel,
            type: 'post',
            dataType: 'json',
            data: { type: obj.attr('rel'), send: tel },
            success: function (res) {
                if (res.status == 1) {
                    //成功
                    showErrorMsg(res.msg);
                } else {
                    //失败
                    showErrorMsg(res.msg);
                    //移除定时器
                    window.clearInterval(T);
                    obj.removeAttr('id', 'fetchcode');
                    obj.text('获取短信验证码');
                }
            }
        })
    }
    //第一步验证
    function nextstep() {
        var tpcode = $('#tpcode').val();
        if (tpcode == '') {
            showErrorMsg('验证码不能为空');
            return false;
        }
        if (tpcode.length != 4) {
            showErrorMsg('验证码错误');
            return false;
        }
        $.ajax({
            url: '/index.php?m=Home&c=Api&a=check_validate_code&t=' + Math.random(),
            type: 'post',
            dataType: 'json',
            data: { type: $('#sender').val(), code: tpcode, send: $('#tel').val(), scene: 2 },
            success: function (data) {
                if (data.status == 1) {
                    is_check = true;
                    window.location.href = '/index.php?m=Mobile&c=User&a=paypwd&step=2&t=' + Math.random();
                } else {
                    showErrorMsg(data.msg);
                    return false;
                }
            }
        })
    }
    //提交前验证表单
    function submitverify() {
        var new_password = $('#new_password').val();
        var confirm_password = $('#confirm_password').val();
        if (new_password == '') {
            showErrorMsg('新支付密码不能为空');
            return false;
        }
        if (new_password.length < 6 || new_password.length > 18) {
            showErrorMsg('密码长度不符合规范');
            return false;
        }
        if (new_password != confirm_password) {
            showErrorMsg('两次密码不一致');
            return false;
        }
        $.ajax({
            url: '/index.php?m=Mobile&c=User&a=paypwd&step=2&t=' + Math.random(),
            type: 'post',
            dataType: 'json',
            data: $('#payform').serialize(),
            success: function (data) {
                if (data.status == 1) {
                    showErrorMsg(data.msg);
                } else {
                    showErrorMsg(data.msg);
                    return false;
                }
            }
        })
    }
    /**
     * 提示弹窗
     * */
    function showErrorMsg(msg) {
        layer.open({ content: msg, time: 2 });
    }
</script>
</body>
</html>