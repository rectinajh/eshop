<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"./template/mobile/default/activity/ajax_group_list.html";i:1532661070;}*/ ?>
<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $k=>$v): ?>
    <li>
        <!--<a href="javascript:void(0);">-->
        <a href="<?php echo U('Goods/goodsInfo',array('id'=>$v[goods_id],'item_id'=>$v[item_id])); ?>">
            <div class="similer-product">
                <div class="zjj close">
                    <img src="<?php echo goods_thum_images($v['goods_id'],200,200); ?>">
                    <div class="sale onsale">
                        <p><?php echo $v[rebate]; ?>折</p>
                    </div>
                </div>
                <span class="similar-product-text"><?php echo $v[goods_name]; ?></span>
                <span class="cy"><i><?php echo $v[buy_num]; ?></i>人参与</span>
                <span class="similar-product-price">
                    ¥
                    <span class="big-price"><?php echo $v[price]; ?>元</span>
                    <!--未打折价格<span class="small-price"  style="display:;">￥<?php echo $v[goods_price]; ?>元</span> -->
                    <span class="fr sg_g_time last_g_time" id="jstimerBox<?php echo $v[goods_id]; ?>"></span>
                </span>
            </div>
        </a>
    </li>
    <script>
        Tday['<?php echo $v[goods_id]; ?>'] = new Date('<?php echo date("Y/m/d H:i:s",$v['end_time']); ?>');
        window.setInterval(function() {clock11('<?php echo $v[goods_id]; ?>');}, 1000);
    </script>
<?php endforeach; endif; else: echo "" ;endif; ?>
