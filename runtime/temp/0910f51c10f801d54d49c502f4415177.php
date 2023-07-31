<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"./template/mobile/default/payment/recharge_success.html";i:1532661070;}*/ ?>
<html>
<head>
<meta charset="utf-8">
<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport">
<title>支付成功-<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>
<meta name="keywords" content="<?php echo $tpshop_config['shop_info_store_keyword']; ?>" />
<meta name="description" content="<?php echo $tpshop_config['shop_info_store_desc']; ?>" />
<link rel="stylesheet" href="__STATIC__/css/success_index.css" type="text/css">
</head>
<body>
<script src="__PUBLIC__/js/jquery-1.10.2.min.js"></script>
    <div class="order-header">
    	<div class="layout after">
        	<div class="fl">
            	<div class="logo pa-to-36 wi345">
                	<a href="/"><img src="<?php echo $tpshop_config['shop_info_store_logo']; ?>" alt="" width="50%"></a>
                </div>
            </div>
        	<div class="fr">
            	<div class="pa-to-36 progress-area">
            	    <div class="progress-area-wd" style="display:none">充值</div>
                	<div class="progress-area-tx" style="display:none">填写充值金额，选择支付</div>
                	<div class="progress-area-cg">成功提交充值单</div>
                </div>
            </div>
        </div>
    </div>
    <div class="layout after-ta order-ha">
    	<div class="erhuh">
        	<i class="icon-succa"></i>
            <h3>恭喜您，充值成功！</h3>
            <p class="succ-p">充值单号：&nbsp;&nbsp;<?php echo $order['order_sn']; ?><br/>付款金额（元）：&nbsp;&nbsp;<b><?php echo $order['account']; ?></b>&nbsp;<b>元</b></p>
            <div class="succ-tip">
            	您的充值金额已到账，您可以使用余额支付订单，祝您生活愉快！ 
            </div>
        </div>
        <div class="ddxq-xiaq">
            <a href="<?php echo U('/Mobile/User/recharge',array('order_id'=>$order['order_id'])); ?>">订单详情<i></i></a>
        </div>
    </div>
</body>
</html>
