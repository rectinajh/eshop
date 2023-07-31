<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:47:"./template/mobile/default/user/withdrawals.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>申请提现--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

            <span>申请提现</span>

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
    .layui-m-layercont {
        line-height: 1rem;
    }
</style>

		<div class="loginsingup-input ma-to-20">

			<form method="post" id="returnform">

				<div class="content30">

					<div class="lsu">

						<span>卡号：</span>

						<input type="text" name="account_bank" id="account_bank" maxlength="19" placeholder="银行卡号、支付宝账户" onKeyUp="this.value=this.value.replace(/[^\d]/g,'')">

					</div>

					<div class="lsu">

						<span>开户名：</span>

						<input type="text" name="account_name" id="account_name" value=""  placeholder="持卡人姓名、支付宝姓名">

					</div>

					<div class="lsu">

						<span>银行名称：</span>

						<input type="text" name="bank_name" id="bank_name" value="" placeholder="如：工商银行、支付宝">

					</div>

                    <div class="lsu">

                        <span>提现金额：</span>

                        <input type="text" name="money" id="money" value="" withdraw_money="<?php echo $withdraw_money; ?>" placeholder="可提现币：<?php echo $withdraw_money; ?>元" onKeyUp="this.value=this.value.replace(/[^\d.]/g,'')">

                    </div>
                    <div class="lsu">

                        <span>支付密码：</span>

                        <input type="password" name="paypwd" id="paypwd" value="" placeholder="请输入支付密码">

                    </div>
                    <div id="extre" style="display: none;width: 100%;padding: 10px 0;font-size: 20px;">温馨提示：(提现手续费<span><?php echo $fee; ?>%</span>,共<span id="shou"></span>元,实际到账<span id="fact"></span>元)</div>
                    <!-- <div class="lsu test">

                        <span>验证码：</span>

                        <input type="text" name="verify_code" id="verify_code" value="" placeholder="请输入验证码">

                        <img  id="verify_code_img" src="<?php echo U('User/verify',array('type'=>'withdrawals')); ?>" onClick="verify()" style=""/>

                    </div> -->

					<div class="lsu submit">

                        <input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" />

						<input type="button" onclick="checkSubmit()" value="提交申请">

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
    	$("#money").blur(function(){
                var shou=($("#money").val()*"<?php echo $fee; ?>"/100);
				var fact=($("#money").val()-shou);
				$("#shou").text(shou);
				$("#fact").text(fact);
				$("#extre").show();
			});

    // 验证码切换

    function verify(){

        $('#verify_code_img').attr('src','/index.php?m=Mobile&c=User&a=verify&type=withdrawals&r='+Math.random());

    }



    /**

     * 提交表单

     * */

    function checkSubmit(){

        var bank_name = $.trim($('#bank_name').val());

        var account_bank = $.trim($('#account_bank').val());

        var account_name = $.trim($('#account_name').val());

        var paypwd = $.trim($('#paypwd').val());

        var money = parseFloat($.trim($('#money').val()));

        var withdraw_money = parseFloat(<?php echo $withdraw_money; ?>);  //用户提现币

        var verify_code = $.trim($('#verify_code').val());
        
        var min ="<?php echo tpCache('basic.min'); ?>";

        var min ="<?php echo tpCache('basic.min'); ?>";
        //验证码

       /*  if(verify_code == '' ){

            showErrorMsg('验证码不能空')

            return false;

        } */

        if(bank_name == '' || account_bank == '' || account_name=='' || money == '' || paypwd == ''){

            showErrorMsg("所有信息为必填")

            return false;

        }
        if(money <  min) {
           
            showErrorMsg("每次最少提现额度10")

            return false;
        }
        if(money > withdraw_money){

            showErrorMsg("提现金额大于您的账户提现币")

            return false;

        }
        
        if(money % 10 !=0){
            showErrorMsg("提现金额必须为10的倍数")

            return false;
        }
        $.ajax({

            type: "post",

            url :"<?php echo U('Mobile/User/withdrawals'); ?>",

            dataType:'json',

            data:$('#returnform').serialize(),

            success: function(data)

            {

                showErrorMsg(data.msg);

                if(data.status == 1){

                    window.location.href=data.url;

                } else {

                   // window.location.reload();

                    //verify();

                }

            }

        });

    }

    /**

     * 提示弹窗

     * @param msg

     */

    function showErrorMsg(msg){

        layer.open({content:msg,time:3});

    }

</script>

	</body>

</html>

