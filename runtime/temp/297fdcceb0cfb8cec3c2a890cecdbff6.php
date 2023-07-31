<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:51:"./template/mobile/default/xintao_payment/index.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
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
    .layui-m-layercont {
        line-height: 1rem;
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
        <form method="post" id="returnform" submit-type="ajax">
            <div class="content30">
                <input type="hidden" id="order_id" name="order_id" value="<?php echo $order['order_id']; ?>">
                <div class="lsu">
                    <span>订单号：</span>
                    <input type="text" name="order_sn" id="order_sn" value="<?php echo $order['order_sn']; ?>"  placeholder="" readonly>
                </div>
                <div class="lsu">
                    <span>订单金额：</span>
                    <input type="text" name="order_amount" id="order_amount" value="<?php echo $order['order_amount']; ?>"  placeholder="" readonly>
                </div>
                <div class="lsu">
                    <span>开盘价</span>
                    <input type="text" name="price" id="price" value="<?php echo $open_price; ?>"  placeholder="" readonly>
                </div>
                <div class="lsu">
                    <span>新淘链余额：</span>
                    <input type="text" name="jin_num" id="jin_num" value="<?php echo $user['jin_num']; ?>" readonly>
                </div>
                <div class="lsu">
                    <span>本次需使用：</span>
                    <input type="text" name="max_use" id="max_use" value="<?php echo $max_use; ?>"  placeholder="" readonly>
                </div>
                <div class="lsu">
                    <span>支付密码:</span>
                    <input type="password" name="password" id="password" value="" placeholder="请输入支付密码">
                </div>
                <div class="lsu submit">
                    <input type="submit" value="确认支付">
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
</body>
<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
$('form[submit-type=ajax]').submit(function () {
    var formObj = $(this)
        ,order_id = $('#order_id').val()
    if (!validateForm(formObj)) {
        return false;
    }
    $.ajax({
        url: '/mobile/xintao_payment/pay'
        ,type: 'POST'
        ,data: formObj.serialize()
        ,success: function (res) {
            if (res.code != 1) {
                layer.open({
                    content: res.msg,
                    time: 3
                });
            } else {
                layer.open({
                    content: res.msg,
                    time: 2,
                    end: function() {
                        window.location.href = "/Mobile/Cart/cart4/order_id/" + order_id;
                    }
                });
            }
        }
        ,error:  function (res) {
            layer.open({
                content: '网络错误',
            });
        }
    });
    return false;
});

/**
 * 验证表单
 */
function validateForm(formObj) {
    var password = formObj.find('#password');
    if (password == '') {
        return false;
    }
    return true;
}
</script>
</html>