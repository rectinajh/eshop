<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:44:"./template/mobile/default/user/find_pwd.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>验证账户--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

<div class="classreturn">

    <div class="content">

        <div class="ds-in-bl return">

            <a href="javascript:history.back(-1)"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

        </div>

        <div class="ds-in-bl search center">

            <span>验证账户</span>

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
    .fetchcode{
        background-color: #ec5151;
        border-radius: 0.128rem;
        color: white;
        padding: 0.55467rem 0.21333rem;
        vertical-align: middle;
        font-size: 0.59733rem;
    }
    #fetchcode{
        background:#898995;
        border-radius: 0.128rem;
        color: white;
        padding: 0.55467rem 0.21333rem;
        vertical-align: middle;
        font-size: 0.59733rem;
    }
</style>
<div class="loginsingup-input singupphone">
    <form action="" method="post">
        <div class="content30">
           <!--  <?php if(strstr($user['username'],'@')): ?>
            邮箱
                <p class="checkcodes">
                    <span id="validate_type_email" value="email" val="<?php echo $user['email']; ?>">邮箱号码：</span>
                    <span><?php echo $user['email']; ?></span>
                </p>
                <div class="lsu boo zc_se">
                    <input type="text" id="email_code" name="email_code" class="hq_phone" value=""  placeholder="请输入验证码"/>
                    <a id="zemail" type="email"  class="m_phone" onclick="sendcode(this)">获取验证码</a>
                </div>
            <?php else: ?> -->
            <!--手机-->
                <p class="checkcodes">
                    <span id="validate_type_phone" value="phone" val="<?php echo $user['mobile']; ?>">手机号：</span>
                    <span><?php echo $user['mobile']; ?></span>
                </p>
                <div class="lsu boo zc_se">
                    <input type="text" id="mobile_code" name="mobile_code" value="" class="hq_phone" placeholder="请输入验证码"/>
                    <a id="zphone" type="phone" class="m_phone" onclick="sendcode(this)">获取验证码</a>
                </div>
           <!--  <?php endif; ?> -->
            <div class="lsu submit">
                <input type="button" name="button" id="btn_submit" class="btn_big1" value="提 交" />
            </div>
        </div>
    </form>
</div>
<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
</body>
<script>
    //获取验证码
    function sendcode(o){
        var type = $(o).attr('type');
        var send = $("#validate_type_"+type).attr("val");
        $.ajax({
            url:'/index.php?m=Home&c=Api&a=send_validate_code&t='+Math.random(),
            type:'post',
            dataType:'json',
            data:{type:type,send:send,scene:2},
            success:function(res){
                if(res.status==1){
                    showErrorMsg(res.msg);
                    countdown(o);
                }else{
                    showErrorMsg(res.msg);
                }
            },
            error:function(){
                showErrorMsg('网络错误，请稍后再试！');
            }
        })
    }

    //倒计时
    function countdown(obj){
        var obj = $(obj);
        var s = <?php echo $tpshop_config['sms_sms_time_out']; ?>;
        //添加样式
        obj.attr('id','fetchcode');
        //改变按钮状态
        obj.unbind("click");
        callback();
        //循环定时器
        var T = window.setInterval(callback,1000);
        function callback()
        {
            if(s <= 1){
                //移除定时器
                window.clearInterval(T);
                obj.text('获取验证码');
                obj.bind("click", countdown)
                $(obj).removeAttr('id','fetchcode');
            }else{
                if(s<=10){
                    obj.text( '0'+ --s + '秒后再获取');
                }else{
                    obj.text( --s + '秒后再获取');
                }
            }
        }
    }

    //提交
    $("#btn_submit").click(function(){
        var type = $(".m_phone").attr('type');
        var send = $("#validate_type_"+type).attr("val");
        var tpcode = $("#mobile_code").val();
        if(type == 'mobile'){
            if($("#mobile_code").val().length == 0){
                $("#mobile_code").focus();
                showErrorMsg("验证码不能为空！");
                return false;
            }
           
        }/* else if(type == 'email'){
            if($("#email_code").val().length == 0){
                $("#email_code").focus();
                showErrorMsg("验证码不能为空！");
                return false;
            }
            var tpcode = $("#email_code").val();
        } */
        $.ajax({
            url:'/index.php?m=Home&c=Api&a=check_validate_code&t='+Math.random(),
            type:'post',
            dataType:'json',
			data:{code:tpcode,send:send,type:type,scene:2},
            success:function(res){
                if(res.status==1){
                    window.location.href = '/index.php?m=Mobile&c=User&a=set_pwd';
                }else{
                    showErrorMsg(res.msg);
                }
            }
        })
    });
    /**
     * 提示弹窗
     * @param msg
     */
    function showErrorMsg(msg){
        layer.open({content:msg,time:2});
    }
</script>
</html>
