<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:43:"./application/seller/new/order/picking.html";i:1532661069;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLIC__/static/css/base.css" rel="stylesheet" type="text/css"/>
<link href="__PUBLIC__/static/css/seller_center.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
body { background: #FFF none;}
.ncsc-order-details{width: 50%;box-sizing: border-box;}
.ncsc-order-details:last-child{border-right: 0}
.ncsc-order-details .content dl dd a, .ncsc-order-contnet .daddress-info dd a{float: none;padding-left: 0}
</style>
<title>配货单打印 - www.ohbbs.cn 欧皇源码论坛 </title>
</head>

<body>
<div class="print-layout">
  <div class="print-btn" id="printbtn" title="选择喷墨或激光打印机<br/>根据下列纸张描述进行<br/>设置并打印发货单据"><i></i><a href="javascript:void(0);" onclick="window.print();">打印</a></div>
  <div class="a5-size"></div>
  <dl class="a5-tip">
    <dt>
      <h1>A5</h1>
      <em>Size: 210mm x 148mm</em></dt>
    <dd>当打印设置选择A5纸张、横向打印、无边距时每张A5打印纸可输出1页订单。</dd>
  </dl>
  <div class="a4-size"></div>
  <dl class="a4-tip">
    <dt>
      <h1>A4</h1>
      <em>Size: 210mm x 297mm</em></dt>
    <dd>当打印设置选择A4纸张、竖向打印、无边距时每张A4打印纸可输出2页订单。</dd>
  </dl>
  <div class="print-page">
    <div id="printarea">
            <div class="orderprint">
        <div class="top">
             <div class="full-title"><?php echo $store['store_name']; ?> 配货单</div>
        </div>
        
		<table class="buyer-info">
          <tr>
            <td class="w300">收货人：<?php echo $order['consignee']; ?></td>
            <td>电话：<?php echo $order['mobile']; ?></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="3">地址：<?php echo $order['province']; ?>&nbsp;&nbsp;<?php echo $order['city']; ?>&nbsp;&nbsp;<?php echo $order['district']; ?>&nbsp;&nbsp;<?php echo $order['address']; ?></td>
          </tr>
        </table>
         <div class="ncsc-order-info">
		    <div class="ncsc-order-details">
		      <div class="title">发货来源</div>
		      <div class="content">
		        <dl>
		          <dt>店铺名称：</dt>
		          <dd><strong><?php echo $store['store_name']; ?></strong></dd>
		        </dl>
		        <dl>
		          <dt>店铺地址：</dt>
		          <dd><?php echo $store['full_address']; ?> <?php echo $store['store_address']; ?></dd>
		        </dl>
		           <dl>
		          <dt>电&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;话：</dt>
		          <dd><?php echo $store['store_phone']; ?></dd>
		        </dl>
		        <dl>
		          <dt>邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;编：</dt>
		          <dd>
					<?php echo $store['store_zip']; ?>
		          </dd>
		        </dl>
		        <dl>
		          <dt>网&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址：</dt>
		          <dd>
		          	<?php if(empty($store['store_domain']) || (($store['store_domain'] instanceof \think\Collection || $store['store_domain'] instanceof \think\Paginator ) && $store['store_domain']->isEmpty())): ?>
						<a style="padding:0px float:left" href="<?php echo $shop['site_url']; ?>"><?php echo $shop['site_url']; ?></a>
					<?php else: ?>
						<a style="padding:0px float:left" href="<?php echo $store['store_domain']; ?>"><?php echo $store['store_domain']; ?></a>
					<?php endif; ?>
		          </dd>
		        </dl>
		      </div>
		    </div> 
		    <div class="ncsc-order-details">
		      <div class="title">订单详情</div>
		      <div class="content">
		        <dl>
		          <dt>下单日期：</dt>
		          <dd><?php echo date('Y-m-d H:i:s',$order['add_time']); ?></dd>
		        </dl>
		        <dl>
		          <dt>订单编号：</dt>
		          <dd><?php echo $order['order_sn']; ?></dd>
		        </dl>
		           <dl>
		          <dt>支付方式：</dt>
		          <dd><?php echo $order['pay_name']; ?></dd>
		        </dl>
		        <dl>
		          <dt>配送方式：</dt>
		          <dd><?php echo $order['shipping_name']; ?></dd>
		        </dl>
		        <dl>
		          <dt>&nbsp;</dt>
		          <dd>&nbsp;</dd>
		        </dl>
		      </div>
		    </div>
    	</div>
        <table class="order-info" style="margin-top:10px">
          <thead>
            <tr>
              <th class="w40">序号</th>
              <th class="tl">商品名称</th>
              <th class="w150 tl">规格属性</th>
              <th class="w70">单价(元)</th>
              <th class="w50">数量</th>
              <th class="w70 tl">小计(元)</th>
            </tr>
          </thead>
          <tbody>
          <?php if(is_array($orderGoods) || $orderGoods instanceof \think\Collection || $orderGoods instanceof \think\Paginator): $k = 0; $__LIST__ = $orderGoods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good): $mod = ($k % 2 );++$k;?>
          	<tr>
              <td><?php echo $k; ?></td>
              <td class="tl"><?php echo $good['goods_name']; if($good['is_send'] == 3): ?>（已退货）<?php endif; ?></td>
              <td class="tl"><?php echo $good['spec_key_name']; ?></td>
              <td >&yen;<?php echo $good['goods_price']; ?></td>
              <td><?php echo $good['goods_num']; ?></td>
              <td class="tl">&yen;<?php echo $good['goods_total']; ?></td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          	<tr>
              <th></th>
              <th colspan="3" class="tl">合计</th>
              <th><?php echo $goods_count; ?></th>
              <th class="tl">&yen;<?php echo $order['goods_price']; ?></th>
            </tr>
          </tbody>
        </table>
      </div>
          </div>
      </div>
</div>
</body>
</html>