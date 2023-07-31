<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:50:"./template/mobile/default/goods/ajaxGoodsList.html";i:1532661070;}*/ ?>
<?php if(is_array($goods_list) || $goods_list instanceof \think\Collection || $goods_list instanceof \think\Paginator): if( count($goods_list)==0 ) : echo "" ;else: foreach($goods_list as $k=>$vo): ?>

    <div class="orderlistshpop p">

        <div class="maleri30">

            <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$vo[goods_id])); ?>" class="item">

                <div class="sc_list se_sclist">

                    <div class="shopimg fl">

                        <img src="<?php echo goods_thum_images($vo['goods_id'],400,400); ?>">

                    </div>

                    <div class="deleshow fr">

                        <div class="deletes">

                            <span class="similar-product-text fl"><?php echo getSubstr($vo['goods_name'],0,20); ?></span>

                        </div>

                        <div class="prices">

                            
                            <p class="sc_pri fl">
                                <span>￥</span><span><?php echo $vo[shop_price]; ?></span>
                            </p>
                            <!-- <p class="sc_pri fl">
                                <span>会员价：￥</span><span><?php echo $vo[shop_price]-$vo['exchange_integral']/tpCache('shopping.point_rate'); ?>+<?php echo $vo['exchange_integral']; ?>积分</span>
                            </p> -->
                            

                        </div>

                        <p class="weight"><span><?php echo $vo[comment_count]; ?></span><span>条评价</span></p>

                    </div>

                </div>

            </a>

        </div>

    </div>

<?php endforeach; endif; else: echo "" ;endif; ?>