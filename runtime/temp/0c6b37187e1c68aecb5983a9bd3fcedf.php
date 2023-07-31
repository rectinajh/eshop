<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"./template/mobile/default/payment/success.html";i:1531973018;s:44:"./template/mobile/default/public/header.html";i:1531973018;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>支付成功--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

<div class="completionpay">
    <div class="maleri30">
        <div class="llog"><img src="<?php echo $tpshop_config['shop_info_store_logo']; ?>"/></div>
        <div class="heses">
            <div class="zbzim"><img src="__STATIC__/images/sbzf.png"/></div>
            <p class="success"><span>订单支付成功，我们将在第一时间给你发货！</span></p>
            <p class="ddnum"><span>订单号：</span><span><?php echo $order['order_sn']; ?></span></p>
            <p class="ddnum"><span>付款金额：</span><span class="red"><?php echo $order['order_amount']; ?></span><span>元</span></p>
            <p class="ddnum"><span>请你保持手机畅通，等待收货。</span></p>
            <div class="ddxq-succ"><a href="<?php echo U('/Mobile/Order/order_detail',array('id'=>$order['order_id'])); ?>">订单详情</a></div>
        </div>
    </div>
</div>
</body>
</html>

