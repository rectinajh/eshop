<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:50:"./template/mobile/default/store/ajaxGoodsList.html";i:1532661070;}*/ ?>
<?php if(is_array($goods_list) || $goods_list instanceof \think\Collection || $goods_list instanceof \think\Paginator): $i = 0; $__LIST__ = $goods_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <div class="orderlistshpop p">
        <div class="maleri30">
            <a href="<?php echo U('Goods/goodsInfo',array('id'=>$vo[goods_id])); ?>">
                <div class="sc_list se_sclist">
                    <div class="shopimg fl">
                        <img src="<?php echo goods_thum_images($vo['goods_id'],100,100); ?>">
                    </div>
                    <div class="deleshow fr">
                        <div class="deletes">
                            <span class="similar-product-text fl"><?php echo $vo['goods_name']; ?></span>
                        </div>
                        <div class="prices">
                            <p class="sc_pri fl"><span>￥</span><span><?php echo $vo['shop_price']; ?></span></p>
                        </div>
                        <p class="weight"><span><?php echo $vo['comment_count']; ?></span><span>条评价</span></p>
                    </div>
                </div>
            </a>
        </div>
    </div>
<?php endforeach; endif; else: echo "" ;endif; ?>