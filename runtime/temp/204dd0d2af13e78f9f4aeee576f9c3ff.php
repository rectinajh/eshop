<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:41:"./template/mobile/default/user/login.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>登录--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

            <a href="javascript:history.back(-1);"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

        </div>

        <div class="ds-in-bl search center">

            <span>登录</span>

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
		<div class="flool loginsignup2">
            <!--LOGO-->
			<img src="__STATIC__/images/logo-login.png" alt="LOGO" style="height: auto;"/>
		</div>
		<div class="loginsingup-input">
            <!--登录表单-s-->
			<form  onsubmit="return false;"  method="post"  >
				<div class="content30">
					<div class="lsu">
						<span>账号</span>
						<input type="text" name="username" id="username" value=""  placeholder="请输入邮箱/手机号"/>
					</div>
					<div class="lsu">
						<span>密码</span>
						<input type="password" name="password" id="password" value="" placeholder="请输入密码"/>
						<i></i>
					</div>
                   <!--  <?php if(!(empty($first_login) || (($first_login instanceof \think\Collection || $first_login instanceof \think\Paginator ) && $first_login->isEmpty()))): ?>
					<div class="lsu test">
						<span>验证码</span>
						<input type="text" name="verify_code" id="verify_code" value="" placeholder="请输入验证码"/>
						<img  id="verify_code_img" src="<?php echo U('Mobile/User/verify'); ?>" onClick="verify()" style="width:3rem;"/>
					</div>
                    <?php endif; ?> -->
					<div class="lsu submit">
						<input type="button"  value="提交"  onclick="submitverify()" class="btn_big1"  />
                        <input type="hidden" name="referurl" id="referurl" value="<?php echo $referurl; ?>">
					</div>
					<div class="radio">
                        <!--<lable>-->
                         <!--<span class="che check_t" onclick="remember(this)">-->
							<!--<i><input type="checkbox" name="remember" value="1" checked="" style="display: none"> </i>-->
							<!--<span>自动登录</span>-->
						<!--</span>-->
                        <!--</lable>-->
					</div>
					<div class="signup-find p">
						<div class="note fl">
							<img src="__STATIC__/images/not.png"/>
							<a href="<?php echo U('User/reg'); ?>"><span>快速注册</span></a>
						</div>
						<div class="note fr">
							<img src="__STATIC__/images/ru.png"/>
							<a href="<?php echo U('User/forget_pwd'); ?>"><span>找回密码</span>
						</div>
					</div>
				</div>
			</form>
            <!--登录表单-e-->
		</div>

        <!--第三方登陆-s-->
		<div class="thirdlogin">
			<!-- <h4>第三方登陆</h4> -->
			<ul>
                <?php
                                   
                                $md5_key = md5("select * from __PREFIX__plugin where type='login' AND status = 1");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from __PREFIX__plugin where type='login' AND status = 1"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>
                <!--    <?php if($v['code'] == 'weixin' AND is_weixin() != 1): ?>
                        <li>
                            <a class="ta-weixin" href="<?php echo U('LoginApi/login',array('oauth'=>'weixin')); ?>" target="_blank" title="weixin">
                                <div class="icon">
                                    <img src="__STATIC__/images/wechat.png"/>
                                    <p>微信登陆</p>
                                </div>
                            </a>
                        </li>
                    <?php endif; ?>-->
                    <?php if($v['code'] == 'alipay' AND is_alipay() != 1): ?>
                        <li>
                            <a href="<?php echo U('LoginApi/login',array('oauth'=>'alipay')); ?>">
                                <div class="icon">
                                    <img src="__STATIC__/images/alpay.png"/>
                                    <p>支付宝</p>
                                </div>
                            </a>
                        </li>
                    <?php endif; if($v['code'] == 'qq' AND is_qq() != 1): ?>
                        <li>
                            <a class="ta-qq" href="<?php echo U('LoginApi/login',array('oauth'=>'qq')); ?>" target="_blank" title="QQ">
                                <div class="icon">
                                    <img src="__STATIC__/images/qq.png"/>
                                    <p>qq登陆</p>
                                </div>
                            </a>
                        </li>
                    <?php endif; endforeach; ?>
			</ul>		
		</div>
        <!--第三方登陆-e-->
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
<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
   /*  function verify(){
        $('#verify_code_img').attr('src','/index.php?m=Mobile&c=User&a=verify&r='+Math.random());
    } */

    //复选框状态
    function remember(obj){
         var che= $(obj).attr("class");
        if ( che == 'che'){
            $('#remember').val(1);
        }else if(che == 'che check_t'){
            $('#remember').val(0);
        }
    }
    function submitverify()
    {
        var username = $.trim($('#username').val());
        var password = $.trim($('#password').val());
        var remember = $('#remember').val();
        var referurl = $('#referurl').val();
        //var verify_code = $.trim($('#verify_code').val());
        if(username == ''){
            showErrorMsg('用户名不能为空!');
            return false;
        }
        
        if(password == ''){
            showErrorMsg('密码不能为空!');
            return false;
        }
        /* var codeExist = $('#verify_code').length;
        if (codeExist && verify_code == ''){
            showErrorMsg('验证码不能为空!');
            return false;
        } */
        var data = {username:username,password:password,referurl:referurl};
        if(!checkMobile(username) && !checkEmail(username)){
            showErrorMsg('账号格式不匹配!');
            return false;
        }
            $.ajax({
                type : 'post',
                url : '/index.php?m=Mobile&c=User&a=do_login&t='+Math.random(),
                data : data,
                dataType : 'json',
                success : function(res){
                    if(res.status == 1){
                        var url = res.url.toLowerCase();
                        if (url.indexOf('user') !==  false && url.indexOf('login') !== false || url == '') {
                            window.location.href = '/index.php/mobile';
                        }
                        window.location.href = res.url;
                    }else{
                        showErrorMsg(res.msg);
                        if (codeExist) {
                            verify();
                        } else {
                            location.reload();
                        }
                    }
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {
                    showErrorMsg('网络失败，请刷新页面后重试');
                }
            })
       
        /* if (codeExist) {
            data.verify_code = verify_code;
        } */
       
    }
        //切换密码框的状态
        $(function(){
            $('.loginsingup-input .lsu i').click(function(){
                $(this).toggleClass('eye');
                if ($(this).hasClass('eye')) {
                    $(this).siblings('input').attr('type','text')
                } else{
                    $(this).siblings('input').attr('type','password')
                }
            });
        })
    /**
     * 提示弹窗
     * @param msg
     */
    function showErrorMsg(msg){
        layer.open({content:msg,time:2});
    }
    </script>
</body>
</html>
