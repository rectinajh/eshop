<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"./template/mobile/default/payment/recharge_error.html";i:1532661070;}*/ ?>
<html>
<head>
<meta charset="utf-8">
<title>支付失败-<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>
<meta name="keywords" content="<?php echo $tpshop_config['shop_info_store_keyword']; ?>" />
<meta name="description" content="<?php echo $tpshop_config['shop_info_store_desc']; ?>" />
<link rel="stylesheet" href="__STATIC__/css/success_index.css" type="text/css">
</head>
<body>
<script src="__PUBLIC__/js/jquery-3.1.1.min.js"></script>
    <div class="order-header">
    	<div class="layout after">
        	<div class="fl">
            	<div class="logo pa-to-36 wi345">
                	<a href="<?php echo U('Mobile/User/index'); ?>"><img src="<?php echo $tpshop_config['shop_info_store_logo']; ?>" alt=""></a>
                </div>
            </div>
        	<div class="fr">
            	<div class="pa-to-36 progress-area">
           			<div class="progress-area-wd" style="display:none">我的充值</div>
                	<div class="progress-area-tx" style="display:none">填写充值金额，选择支付</div>
                	<div class="progress-area-cg">成功提交订单</div>
                </div>
            </div>
        </div>
    </div>
    <div class="layout after-ta order-ha">
    	<div class="erhuh">
        	<i class="icon-sucsa"></i>
            <h3 style="color:#e01d20">抱歉支付失败！</h3>
            <p class="succ-p">充值单号：&nbsp;&nbsp;<?php echo $order['order_sn']; ?>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;付款金额（元）：&nbsp;&nbsp;<b><?php echo $order['order_amount']; ?></b>&nbsp;<b>元</b></p>
            <div class="succ-tip">
            	你可以重新支付
            </div>
        </div>
        <div class="ddxq-xiaq">
        	<a href="<?php echo U('/Mobile/User/recharge',array('order_id'=>$order['order_id'])); ?>">充值详情<i></i></a>
        </div>

    </div>
</body>
</html>
