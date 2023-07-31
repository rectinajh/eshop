<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:48:"./template/mobile/default/index/ajaxGetMore.html";i:1532661070;}*/ ?>
<?php if(is_array($favourite_goods) || $favourite_goods instanceof \think\Collection || $favourite_goods instanceof \think\Paginator): if( count($favourite_goods)==0 ) : echo "" ;else: foreach($favourite_goods as $key=>$v): ?>
    <ul >
        <li>
            <div class="similer-product products_kuang">
                <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v[goods_id])); ?>" title="<?php echo $v['goods_name']; ?>">
                <img src="<?php echo goods_thum_images($v[goods_id],400,400); ?>"/>
                <span class="similar-product-text"><?php echo $v[goods_name]; ?></span>
                </a>
                <span class="similar-product-price">
                <!-- <div>市场价：¥<span class="big-price"><?php echo $v[market_price]; ?></span></div> -->
                <div style="height:78px;">
                    <div>¥<span class="big-price"><?php echo $v[shop_price]; ?></span></div>
                    <div style="font-size:.4rem;color:#999">好评率99%</div>
	                <!-- <?php if($v['exchange_integral'] > 0): ?>
	                	<div style="color: #f23030;">会员价：¥<span class="big-price"><?php echo $v[shop_price]-$v['exchange_integral']/tpCache('shopping.point_rate'); ?></span>+<span><?php echo $v['exchange_integral']; ?>积分</span></div>
						
					<?php endif; ?> -->
				</div>
                    <a href="<?php echo U('Goods/goodsList',['id'=>$v['cat_id3']]); ?>" title="<?php echo $v['goods_name']; ?>">
                        <span class="guess-button J_ping">看相似</span>
                    </a>
                </span>
            </div>
        </li>
    </ul>
<?php endforeach; endif; else: echo "" ;endif; ?>