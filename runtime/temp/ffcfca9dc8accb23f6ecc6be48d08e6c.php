<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"./template/mobile/default/goods/ajaxIntegralMall.html";i:1532661070;}*/ ?>
<?php if(is_array($goods_list) || $goods_list instanceof \think\Collection || $goods_list instanceof \think\Paginator): if( count($goods_list)==0 ) : echo "" ;else: foreach($goods_list as $key=>$good): ?>

            <div class="sc_list se_sclist paycloseto">

                <div class="maleri30">

                    <div class="shopimg fl">

                        <img src="<?php echo goods_thum_images($good['goods_id'],400,400); ?>">
                        
                        <?php if($good['goods_label']!=''): ?>
		                 	<p class="biao"><?php echo $good['goods_label']; ?></p>
		                 <?php endif; ?>

                    </div>

                    <div class="deleshow fr">

                        <a href="<?php echo U('Mobile/Goods/goodsInfo', array('id'=>$good[goods_id])); ?>">

                            <div class="deletes">

                                <span class="similar-product-text"><?php echo $good[goods_name]; ?></span>

                            </div>
							
                            <div class="prices" style="margin-top:0.12rem;">

                                <p class="sc_pri"><span><?php echo $good[shop_price]-$good[exchange_integral]/$point_rate; ?></span><span class="cobl">+<?php echo $good[exchange_integral]; ?>积分</span></p>

                            </div>

                        </a>
						<div class="qxatten" style="">

                            <p class="weight"><span>可兑换</span>&nbsp;<span><?php echo $good[goods_xianzhi]; ?></span></p>
                            <a class="closeannten" href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$good['goods_id'])); ?>" >立即兑换</a>
                           

                        </div>
                     
                    </div>

                </div>

            </div>

        <?php endforeach; endif; else: echo "" ;endif; ?>