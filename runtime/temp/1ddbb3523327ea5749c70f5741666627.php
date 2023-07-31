<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:44:"./template/mobile/default/gold/transfer.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
<link rel="shortcut  icon" type="image/x-icon" href="__ROOT__/public/js/layer/skin/layer.css"/>
<script src="__ROOT__/template/mobile/default/static/js/jsbridge-mini.js"></script>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>新淘链转账--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

<style>
   .return a img{
     margin-top:0.55rem;
    }
</style>
<div class="classreturn">

    <div class="content">

        <div class="ds-in-bl return">

            <a href="javascript:history.back(-1)"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

        </div>

        <div class="ds-in-bl search center">

            <span>新淘链转账</span>

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
		<div class="loginsingup-input ma-to-20">
			<form method="post" id="returnform">
				<div class="content30">
                    
					<div class="lsu">
						<span>收款人公钥：</span>
						<input type="text" name="public_key" id="public_key" value=""  placeholder="收款人公钥">
                        <span class="lsuIcon"></span>
					</div>
                    <div class="lsu">
                        <span>可转新淘链：</span>
                        <input type="text" name="jin_num" id="jin_num" value="<?php echo $user['jin_num']; ?>" readonly>
                    </div>
                    <div class="lsu">
                        <span>转账额度：</span>
                        <input type="text" name="money" id="money" value="" placeholder="请输入新淘链" onKeyUp="CheckTransfer()">
                    </div>
                    <div class="lsu">
                        <span class="beizhuText">备注：</span>
                        <textarea name="desc" id="beizhu" cols="35"  class="beizhu" rows="5" placeholder="请输入备注"></textarea>
                    </div>
                    <div class="lsu">
                            <span></span>
                            <input type="text" name="shouxu" id='shouxu' value="" readonly style="width: 10.856rem;">
                            <input type="hidden" name="jin_fee" id='jin_fee' value="<?php echo $jin_fee; ?>" readonly>
                        </div>
					<div class="lsu submit">
                        <input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" />
						<input type="button" onclick="checkSubmit()" value="确认转账">
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
<style>
	/*.layui-layer{
		left: 50%;
	}*/
	body .demo-class .layui-layer-title{
		background: red;
	}
	.layui-layer-dialog .layui-layer-content{
		font-size: 0.5rem;
		line-height: 0.7rem;
		padding: 0.5rem;
	}
	.layui-layer-title{
		font-size: 0.6rem;
		line-height: 1rem;
		height: 1rem;
	}
	.layui-layer-btn a{
		line-height: 1rem;
		font-size: 0.6rem;
		height: 1rem;
	}
	.layui-layer-dialog{
		width: 10rem;
		
		left: 3rem !important;
	}
</style>
<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
<script src="__ROOT__/public/js/layer/layer.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
    /**
     * 提交表单
     * */
     if(<?php echo $jin_fee; ?>==''){
       var jin_fee=0;
    }
    var shou=<?php echo $jin_fee; ?>;
    function CheckTransfer(){
        var money = $.trim($('#money').val());
        var num=money*(shou/100);
      //  num=num.toFixed(2);
        document.getElementById('shouxu').value='转账手续费：'+shou+'%共计'+num+'新淘链';
    }
    function checkSubmit(){
        var money = $.trim($('#money').val());
        var public_key = $.trim($('#public_key').val());
        var jin_num = $.trim($('#jin_num').val());
        var shouxu = $.trim($('#jin_fee').val());
        
        //手机号
        //var str='转'+pay_points+'积分到账户:'+public_key+'需收取：'+shouxu+'%手续费';
        if(public_key == '' ){
            layer.msg('用户不能空')
            return false;
        }
        if(money == '' ){
            layer.msg('转账数额不能为空')
            return false;
        }
        
        if(Number(money) >  Number(jin_num)){
            layer.msg("转账额度大于您的可转新淘链")
            return false;
        }
        var str='转'+money+'新淘链到账户:'+public_key+'需收取：'+shouxu+'%手续费';
        layer.confirm(str,{
                btn:['确定','取消']
                },function(){
                    $.ajax({
                    type: "post",
                    url :"<?php echo U('Gold/transfer'); ?>",
                    dataType:'json',
                    data:$('#returnform').serialize(),
                    success: function(data)
                        {
                            //showErrorMsg(data.msg);
                            layer.msg(data.msg, {icon: 1});
                            if(data.status == 1){
                                window.location.href=data.url;
                            } else {
                                layer.msg(data.msg);
                                //window.location.reload();
                            }
                        }
                    });
                },function(){
                    layer.msg('确定取消转账？', {
                    time: 2000, //20s后自动关闭
                    btn: ['确定']
                  });
                });
    }
    /**
     * 提示弹窗
     * @param msg
     */
    function showErrorMsg(msg){
        layer.open({content:msg,time:3});
    }

    $(function () {
      jsBridge.ready(function() {
        if (jsBridge.inApp) {
            $('.lsuIcon').click(function () {
               jsBridge.scan({
                 needResult: true, //默认为false，扫描结果由App处理；true则直接返回扫描结果
               }, function(code) {
                  if (code) {
                    var resObj = JSON.parse(code);
                    $('#public_key').val(resObj.pub_key); 
                  } else {
                    //alert("扫码失败或取消了扫码");
                  }
                });
           });
        } else {    
            alert("请在app内打开");
        }  
      });
    });
</script>
	</body>
</html>
