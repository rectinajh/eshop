<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:42:"./template/mobile/default/user/mobile.html";i:1532228868;s:44:"./template/mobile/default/public/header.html";i:1532228868;s:48:"./template/mobile/default/public/header_nav.html";i:1532228868;s:44:"./template/mobile/default/public/footer.html";i:1532228868;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>手机号--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

            <span>手机号</span>

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

		<div class="loginsingup-input singupphone findpassword">

            <form action="<?php echo U('Mobile/User/userinfo'); ?>" method="post" onsubmit="return submitverify(this)">

				<div class="content30">

					<div class="lsu bk">

						<span>手机号</span>

						<input type="text" name="mobile" id="tel" value="<?php echo $user['mobile']; ?>" placeholder="请输入您的手机号" onBlur="checkMobilePhone(this.value);"/>

					</div>

                    <div class="lsu boo zc_se">

                        <input type="text" name="mobile_code" id="mobile_code" value="" placeholder="请输入验证码">

                        <a href="javascript:void(0);" rel="mobile" id="fcode" onclick="sendcode(this)">获取短信验证码</a>

                    </div>

					<div class="lsu submit">

						<input type="submit" name="" id="" value="确认修改" />

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

<script>

    //手机验证

    function checkMobilePhone(mobile){

        if(mobile == ''){

            showErrorMsg('请输入您的手机号');

            return false;

        }else  if(checkMobile(mobile)) {

            $.ajax({

                type: "GET",

                url: "/index.php?m=Home&c=Api&a=issetMobile",//+tab,

//			url:"<?php echo U('Mobile/User/comment',array('status'=>$_GET['status']),''); ?>/is_ajax/1/p/"+page,//+tab,

                data: {mobile: mobile},// 你的formid 搜索表单 序列化提交

                success: function (data) {

                    if (data == '0') {

                        return true;

                    } else {

                        $('#fcode').attr('id','fetchcode');

                        showErrorMsg('手机号已存在！');

                        return false;

                    }

                }

            });

        }else{

            showErrorMsg('手机号码格式不正确！');

            return false;

        }

    }





    //发送短信验证码

    function sendcode(obj){

        var tel = $.trim($('#tel').val());

        var obj = $(obj);

        if(tel == ''){

            showErrorMsg('请输入您的号码！');

            return false;

        }

        var s = <?php echo $tpshop_config['sms_sms_time_out']; ?>;

        //改变按钮状态

        obj.unbind('click');

        //添加样式

        obj.attr('id','fetchcode');

        callback();

        //循环定时器

        var T = window.setInterval(callback,1000);

        function callback()

        {

            if(s <= 0){

                //移除定时器

                window.clearInterval(T);

                obj.bind('click',sendcode)

                obj.removeAttr('id','fetchcode');

                obj.text('获取短信验证码');

            }else{

                obj.text(--s + '秒后再获取');

            }

        }

        $.ajax({

//            url:'/index.php?m=Mobile&c=User&a=send_validate_code&t='+Math.random(), //原获取短信验证码方法

            url : "/index.php?m=Home&c=Api&a=send_validate_code&scene=6&type=mobile&send="+tel,

            type:'post',

            dataType:'json',

            data:{type:obj.attr('rel'),send:tel},

            success:function(res){

                if(res.status==1){

                    //成功

                    showErrorMsg(res.msg);

                }else{

                    //失败

                    showErrorMsg(res.msg);

                    //移除定时器

                    window.clearInterval(T);

                    obj.removeAttr('id','fetchcode');

                    obj.text('获取短信验证码');

                }

            }

        })

    }



    //提交前验证表单

    function submitverify(obj){

        var tel = $.trim($('#tel').val());

        if(tel == ''){

            showErrorMsg('请输入您的手机号！');

            return false;

        }

        if($('#mobile_code').val() == ''){

            showErrorMsg('验证码不能空！');

            return false;

        }

        $(obj).onsubmit();

    }

</script>

</body>

</html>

