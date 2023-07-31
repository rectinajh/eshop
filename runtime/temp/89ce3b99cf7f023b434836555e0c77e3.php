<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:46:"./template/mobile/default/user/forget_pwd.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>找回密码--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

            <a href="javascript:history.back(-1)"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

        </div>

        <div class="ds-in-bl search center">

            <span>找回密码</span>

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
    <div class="loginsingup-input singupphone findpassword">
        <form action="<?php echo U('User/forget_pwd'); ?>" method="post" id="fpForm">
            <div class="content30">
                <div class="lsu bk">
                    <span>账号</span>
                    <input type="text" name="username" id="username" value="" placeholder="用户名  / 手机号"/>
                </div>
                <div class="lsu bk ma">
                    <input type="text" name="verify_code" id="verify_code" value="" placeholder="请输入验证码"/>
                    <span><img src="/index.php?m=Mobile&c=User&a=verify&type=forget" id="verify_code_img" onclick="verify()"></span>
                </div>
                <div class="lsu submit">
                    <input type="button" id="btn_submit"  value="下一步" />
                </div>
            </div>
        </form>
    </div>
<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
</body>
<script>
    //加载验证码
    function verify(){
        $('#verify_code_img').attr('src','/index.php?m=Mobile&c=User&a=verify&type=forget&r='+Math.random());
    }

    $("#btn_submit").click(function(){
        var username = $.trim($('#username').val());
        var verify_code = $.trim($('#verify_code').val());
        if(username == ' '){
            showErrorMsg('账号不能为空');
            return false;
        }
       if(verify_code == ''){
           showErrorMsg('验证码不能为空');
           return false;
       }

        $.ajax({
            type:'POST',
            url:"<?php echo U('mobile/User/forget_pwd'); ?>",
            dataType:'JSON',
            data:$("#fpForm").serialize(),
            success:function(data){
                if(data.status == 1){
                    location.href=data.url;
                }else {
                    showErrorMsg(data.msg);
                    verify();
                }
            },
            error:function(){
                showErrorMsg('网络错误，请刷新后再试！');
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
