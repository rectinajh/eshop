<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:39:"./template/mobile/default/user/reg.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>注册--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

<body class="g4">

<div class="classreturn">

    <div class="content">

        <div class="ds-in-bl return">

            <a href="javascript:history.back(-1)"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

        </div>

        <div class="ds-in-bl search center">

            <span>注册</span>

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
    #verify_code_img {
        padding: .55467rem .21333rem;
        width: 4.6rem;
        height: 2.9rem;
        color: white;
        border-radius: .128rem;
    }

    #sendcode {
        pointer-events: none;
        background-color: #666;
    }

    .loginsingup-input .content30 .myflex {
        display: flex;
        display: -webkit-box;
        align-items: center;
    }

    .f-left {
        width: 30%;
        height: 1.83467rem;
        line-height: 1.83467rem;
    }

    .f-right {
        width: 70%;
    }

    .loginsingup-input .content30 .wicheck input {
        width: 100%;
    }
</style>
<!--注册表单-s-->
<div class="loginsingup-input singupphone">
    <form action="" method="post" id="regFrom">
        <div class="content30">
            <div class="lsu boo wicheck myflex">
                <div class="f-left">手机号：</div>
                <div class="f-right">
                    <input type="text" name="username" id="username" value="" placeholder="请输入手机号" maxlength="11" class="c-form-txt-normal" onBlur="checkMobilePhone(this.value);">
                    <span id="mobile_phone_notice"></span>
                </div>
            </div>
            <div class="lsu boo wicheck myflex">
                <div class="f-left">身份证号：</div>
                <div class="f-right">
                    <input type="text" name="id_number" id="id_number" value="" placeholder="请输入身份证号" maxlength="18" class="c-form-txt-normal"
                        onBlur="check_id_number(this.value);">
                    <span id="id_number_notice"></span>
                </div>
            </div>
            <div class="lsu boo wicheck myflex">
                <div class="f-left">密码：</div>
                <div class="f-right">
                    <input type="password" name="password" id="password" value="" maxlength="16" placeholder="请设置6-16位登录密码" class="c-form-txt-normal"
                        onBlur="check_password(this.value);">
                    <span id="password_notice"></span>
                </div>
            </div>
            <div class="lsu boo wicheck myflex">
                <div class="f-left">确认密码：</div>
                <div class="f-right">
                    <input type="password" id="password2" name="password2" value="" maxlength="16" placeholder="确认密码" onBlur="check_confirm_password(this.value);">
                    <span id="confirm_password_notice"></span>
                </div>
            </div>
            <div class="lsu boo wicheck myflex">
                <div class="f-left">支付密码：</div>
                <div class="f-right">
                    <input type="password" name="paypwd" id="paypwd" value="" maxlength="16" placeholder="请设置支付密码" class="c-form-txt-normal"
                        onBlur="check_paypwd(this.value);">
                    <span id="paypwd_notice"></span>
                </div>
            </div>
            <div class="lsu boo wicheck myflex">
                <div class="f-left">确认支付密码：</div>
                <div class="f-right">
                    <input type="password" id="paypwd2" name="paypwd2" value="" maxlength="16" placeholder="确认支付密码" onBlur="check_confirm_paypwd(this.value);">
                    <span id="confirm_paypwd_notice"></span>
                </div>
            </div>
            <?php if($tuimobile!=''): ?>
                <div class="lsu boo wicheck myflex">
                    <div class="f-left">推荐人手机号：</div>
                    <div class="f-right">
                        <input type="text" value="<?php echo $tuimobile; ?>" name="mobile" id="tuimobile" title="推荐人手机号" maxlength="11" readonly="readonly">
                    </div>
                </div>
                <?php else: ?>
                <div class="lsu boo wicheck myflex">
                    <div class="f-left">推荐人手机号：</div>
                    <div class="f-right">
                        <input type="text" value="" name="mobile" id="tuimobile" placeholder="请输入推荐人手机号" maxlength="11">
                    </div>
                </div>
            <?php endif; ?>
            <div class="lsu boo zc_se">
                <input type="text"  value="" id="verify_code" name="verify_code" placeholder="请输入图像验证码">
                <img src="" id="verify_code_img" onclick="verify()">
            </div>

            <?php if($regis_sms_enable == 1): ?>
                <div class="lsu boo zc_se">
                    <input type="text" id="mobile_code" value="" name="mobile_code" placeholder="请输入短信验证码">
                    <a rel="mobile" onClick="sendcode(this)">获取短信验证码</a>
                </div>
            <?php endif; ?>
            <div class="lsu submit">
                <!-- <button name="" id="" onclick="checkSubmit()" value="注册"/> -->
                <button type="button" name="" id="" onclick="checkSubmit()">注册</button>
            </div>
            <div class="signup-find" style="padding-bottom: 120px;">

                <p class="recept">注册即视为同意
                    <a href="">《新淘链网用户注册协议》</a>
                </p>
            </div>
        </div>
        <input type="hidden" name="tuimobile" value="<?php echo $tuimobile; ?>" />
    </form>
</div>
<!-- 底部 -->
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
<!--注册表单-s-->
<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(function () {
        verify();
    })
    // 普通 图形验证码
    function verify(){
        $('#verify_code_img').attr('src','/index.php?m=Home&c=User&a=verify&type=user_reg&r='+Math.random());
    }
    var flag = false;
    //手机验证
    function checkMobilePhone(mobile) {
        if (mobile == '') {
            showErrorMsg('手机不能空');
            flag = false;
        } else if (checkMobile(mobile)) { //判断手机格式
            $.ajax({
                type: "GET",
                url: "/index.php?m=Home&c=Api&a=issetMobile",
                data: { mobile: mobile },// 你的formid 搜索表单 序列化提交
                success: function (data) {
                    if (data == '0') {
                        flag = true;
                    } else {
                        showErrorMsg('* 手机号已存在');
                        flag = false;
                    }
                }
            });
        } else {
            showErrorMsg('* 手机号码格式不正确');
            flag = false;
        }
    }

    //密码
    function check_password(password) {
        var password = $.trim(password);
        if (password == '') {
            showErrorMsg("*登录密码不能包含空格");
            flag = false;
        } else if (password.length < 6) {
            showErrorMsg('*登录密码不能少于 6 个字符。');
            flag = false;
        }
    }
    //密码
    function check_paypwd(paypwd) {
        var paypwd = $.trim(paypwd);
        if (paypwd == '') {
            showErrorMsg("*二级支付密码不能包含空格");
            flag = false;
        }
    }

    //验证身份证号
    function check_id_number(id_number) {
        var id_number = $.trim(id_number);
        var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
        if (reg.test(id_number) === false) {
            showErrorMsg('*身份证号输入不正确。');
            flag = false;
        }
    }

    //验证支付密码
    function check_paypwd(confirm_paypwd) {
        var password1 = $.trim($('#paypwd').val());
        var password2 = $.trim(confirm_paypwd);
        if (password2 != password1) {
            showErrorMsg('*两次密码不一致');
            flag = false;
        } else {
            flag = true;
        }
    }

    //验证确认密码
    function check_confirm_password(confirm_password) {
        var password1 = $.trim($('#password').val());
        var password2 = $.trim(confirm_password);
        if (password2.length < 6) {
            showErrorMsg('*登录密码不能少于 6 个字符。');
            flag = false;
        }
        if (password2 != password1) {
            showErrorMsg('*两次密码不一致');
            flag = false;
        } else {
            flag = true;
        }
    }

    //发送短信验证码
    function sendcode(obj) {
        if (flag) {
            $.ajax({
                url: '/index.php?m=Home&c=Api&a=send_validate_code&t=' + Math.random(),
                type: 'post',
                dataType: 'json',
                data: { type: $(obj).attr('rel'), send: $.trim($('#username').val()), scene: 1,verify_code:$.trim($('#verify_code').val())},
                success: function (res) {
                    if (res.status == 1) {
                        //成功
                        showErrorMsg(res.msg);
                        countdown(obj)
                    } else {
                        //失败
                        showErrorMsg(res.msg);
                    }
                },
                error: function () {
                    showErrorMsg('网络错误，请稍后再试');
                }
            });
        } else {
            showErrorMsg('输入信息验证未通过，不能发送验证码');
        }
    }

    //推荐人手机号	
    function countdown(obj) {
        var s = "<?php echo $tpshop_config['sms_sms_time_out']; ?>";
        //改变按钮状态
        $(obj).attr('id', 'sendcode');
        callback();
        //循环定时器
        var T = window.setInterval(callback, 1000);
        function callback() {
            if (s <= 0) {
                //移除定时器
                window.clearInterval(T);
                $(obj).removeAttr('id')
                obj.innerHTML = '获取短信验证码';
            } else {
                if (s <= 10) {
                    obj.innerHTML = '0' + --s + '秒后再获取';
                } else {
                    obj.innerHTML = --s + '秒后再获取';
                }
            }
        }
    }

    //提交表单
    function checkSubmit() {
        $.ajax({
            type: 'POST',
            url: "/index.php?m=Mobile&c=User&a=reg",
            dataType: 'JSON',
            data: $('#regFrom').serialize(),
            success: function (data) {
                if (data.status == 1) {
                    //var jump = '/index.php/Mobile/User/index';
                    var jump = '', reg_jump = "<?php echo tpCache('basic.reg_jump'); ?>";
                    jump = reg_jump == '' ? '/index.php/Mobile/User/index' : reg_jump;
                    showErrorMsg(data.msg, jump);
                } else {
                    showErrorMsg(data.msg);
                    verify();
                }
            }
        });
    }

    /**
     * 提示弹窗
     * @param msg
     */
    function showErrorMsg(msg, jump) {
        layer.open({
            content: msg,
            time: 2,
            end: function () {
                if (jump != '' && jump != undefined) {
                    window.location.href = jump;
                }
            }
        });
    }
</script>
</body>

</html>