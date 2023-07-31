<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:50:"./template/mobile/default/user/ajax_visit_log.html";i:1532661070;}*/ ?>
<?php if(is_array($visit_list) || $visit_list instanceof \think\Collection || $visit_list instanceof \think\Paginator): if( count($visit_list)==0 ) : echo "" ;else: foreach($visit_list as $curdate=>$list): ?>
    <div class="daterecord">
        <div class="maleri30">
            <?php echo $curdate; ?>
        </div>
    </div>
    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$goods): ?>
    <div class="orderlistshpop dejsshort p">
        <div class="maleri30">
            <div class="sc_list se_sclist">
                <div class="radio fl">
                    <span class="che " data-id="<?php echo $goods['visit_id']; ?>">
                        <i></i>
                    </span>
                </div>
                <div class="shopimg fl">
                    <a href="<?php echo U('Goods/goodsInfo',['id'=>$goods['goods_id']]); ?>">
                        <img src="<?php echo goods_thum_images($goods['goods_id'],200,200); ?>">
                    </a>
                </div>
                <div class="deleshow fr">
                    <div class="deletes p">
                        <a href="<?php echo U('Goods/goodsInfo',['id'=>$goods['goods_id']]); ?>">
                            <span class="similar-product-text fl"><?php echo $goods['goods_name']; ?></span>
                        </a>
                    </div>
                    <div class="prices lookalike">
                        <p class="sc_pri fl"><span>￥</span><span><?php echo $goods['shop_price']; ?></span></p>
                        <a href="<?php echo U('Goods/goodsList',['id'=>$goods['cat_id3']]); ?>">看相似</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>