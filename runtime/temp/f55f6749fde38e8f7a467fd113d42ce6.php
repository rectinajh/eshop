<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:52:"./template/mobile/default/order/ajax_order_list.html";i:1532661070;}*/ ?>
<?php if(is_array($order_list) || $order_list instanceof \think\Collection || $order_list instanceof \think\Paginator): $i = 0; $__LIST__ = $order_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?>
    <div class="mypackeg ma-to-20 getmore">
        <div class="packeg p">
            <div class="maleri30">
                <div class="fl">
                    <h1><span class="bg"></span><span class="bgnum"><?php echo $order['store']['store_name']; ?></span></h1>
                    <p class="bgnum"><span>订单编号:</span><span><?php echo $order['order_sn']; ?></span></p>
                </div>
                <div class="fr">
                    支付总金额：<span><?php echo $order['order_status_detail']; ?></span>
                </div>
            </div>
        </div>
        <div class="shop-mfive p">
            <div class="maleri30">
                    <?php if(is_array($order['order_goods']) || $order['order_goods'] instanceof \think\Collection || $order['order_goods'] instanceof \think\Paginator): if( count($order['order_goods'])==0 ) : echo "" ;else: foreach($order['order_goods'] as $key=>$good): ?>
                        <div class="sc_list se_sclist paycloseto">
                            <a <?php if($order['receive_btn'] == 1): ?>href="<?php echo U('/Mobile/Order/order_detail',array('id'=>$order['order_id'],'waitreceive'=>1)); ?>" <?php else: ?> href="<?php echo U('/Mobile/Order/order_detail',array('id'=>$order['order_id'])); ?>"<?php endif; ?>>
                            <div class="shopimg fl">
                                <img src="<?php echo goods_thum_images($good[goods_id],200,200); ?>">
                            </div>
                            <div class="deleshow fr">
                                <div class="deletes">
                                    <span class="similar-product-text"><?php echo getSubstr($good[goods_name],0,20); ?></span>
                                </div>
                                <div class="prices  wiconfine">
                                    <p class="sc_pri"><span>￥</span><span><?php echo $good[member_goods_price]; ?></span></p>
                                </div>
                                <div class="qxatten  wiconfine">
                                    <p class="weight"><span>数量</span>&nbsp;<span><?php echo $good[goods_num]; ?></span></p>
                                </div>
                                <div class="buttondde">
                                    <?php if(($order['order_button'][return_btn] == 1) and ($good[is_send] < 2)): ?>
                                        <!--<a href="<?php echo U('Mobile/User/return_goods',array('order_id'=>$order[order_id],'order_sn'=>$order[order_sn],'goods_id'=>$good[goods_id],'spec_key'=>$good['spec_key'])); ?>">申请售后</a>-->
                                        <a href="<?php echo U('Mobile/Order/return_goods',['rec_id'=>$good['rec_id']]); ?>">申请售后</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            </a>
                        </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="shop-rebuy-price p">
            <div class="maleri30">
                <span class="price-alln">
                    <!--<span class="red">￥<?php echo $order['order_amount']; ?></span><span class="threel">共<?php echo count($order['goods_list']); ?>件</span>-->
                    <span class="red">￥<?php echo $order['order_amount']; ?></span>
                </span>
                <?php if($order['order_button'][pay_btn] == 1): ?>
                        <a class="shop-rebuy paysoon" href="<?php echo U('Mobile/Cart/cart4',array('order_id'=>$order['order_id'])); ?>">立即付款</a>
                <?php endif; if($order['order_button'][cancel_btn] == 1 && $order['pay_status'] == 0): ?>
                    <a class="shop-rebuy " onClick="cancel_order(<?php echo $order['order_id']; ?>)">取消订单</a>
                <?php endif; if($order['order_button'][cancel_btn] == 1 && $order['pay_status'] == 1): ?>
                    <a class="shop-rebuy" href="<?php echo U('Order/refund_order', ['order_id'=>$order['order_id']]); ?>">取消订单</a>
                <?php endif; if($order['order_button'][receive_btn] == 1): ?>
                    <a class="shop-rebuy paysoon"  onclick="order_confirm(<?php echo $order['order_id']; ?>)">确认收货</a>
                <?php endif; if($order['order_button'][comment_btn] == 1): ?>
                    <a class="shop-rebuy" href="<?php echo U('/Mobile/User/comment'); ?>">评价</a>
                <?php endif; if($order['order_button'][shipping_btn] == 1): ?>
                    <a class="shop-rebuy" class="shop-rebuy" href="<?php echo U('Mobile/Order/express',array('order_id'=>$order['order_id'])); ?>">查看物流</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endforeach; endif; else: echo "" ;endif; ?>
