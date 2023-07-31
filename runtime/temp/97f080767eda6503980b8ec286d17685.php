<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:42:"./template/mobile/default/store/index.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title><?php echo $store['store_name']; ?>--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

    <link rel="stylesheet" href="__STATIC__/css/style.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" type="text/css" href="__STATIC__/css/iconfont.css?v=<?php echo time(); ?>"/>

    <!-- <link rel="stylesheet" type="text/css" href="__STATIC__/css/iconfont2.css?v=<?php echo time(); ?>"/> -->

    <link rel="stylesheet" type="text/css" href="__ROOT__/public/css/style.css?v=<?php echo time(); ?>"/>

    <script src="__STATIC__/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>

    <script src="__STATIC__/js/mobile-util.js" type="text/javascript" charset="utf-8"></script>


    <script src="__STATIC__/js/layer/layer.js" type="text/javascript" charset="utf-8"></script>
    <script src="__PUBLIC__/js/global.js"></script>
    

    <script src="__STATIC__/js/swipeSlide.min.js" type="text/javascript" charset="utf-8"></script>

    <script src="__PUBLIC__/js/mobile_common.js"></script>

</head>

<body class="[body]">


<div class="classreturn">

    <div class="content">

        <div class="ds-in-bl return">

            <a href="javascript:history.back(-1)"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

        </div>

        <div class="ds-in-bl search center">

            <span><?php echo $store['store_name']; ?></span>

        </div>

        <div class="ds-in-bl menu">

            <!-- <a href="javascript:void(0);"><img src="__STATIC__/images/class1.png" alt="菜单"></a> -->

        </div>

    </div>

</div>
<div style="height: 1.8rem;"></div>
<div class="flool tpnavf">

    <div class="footer">

        <ul>

            <li>

                <a class="yello" href="<?php echo U('Index/index'); ?>">

                    <div class="icon">

                        <i class="icon-shouye iconfont"></i>

                        <p>首页</p>

                    </div>

                </a>

            </li>

            <li>

                <a href="<?php echo U('Goods/categoryList'); ?>">

                    <div class="icon">

                        <i class="icon-fenlei iconfont"></i>

                        <p>分类</p>

                    </div>

                </a>

            </li>

            <li>

                <!--<a href="shopcar.html">-->

                <a href="<?php echo U('Cart/index'); ?>">

                    <div class="icon">

                        <i class="icon-gouwuche iconfont"></i>

                        <p>购物车</p>

                    </div>

                </a>

            </li>

            <li>

                <a href="<?php echo U('User/index'); ?>">

                    <div class="icon">

                        <i class="icon-wode iconfont"></i>

                        <p>我的</p>

                    </div>

                </a>

            </li>

        </ul>

    </div>

</div>

<div class="dp_head" style="background: url(<?php echo $store['mb_slide'][0]; ?>) no-repeat;">

    <div class="maleri30">

        <div class="dp_logo">

            <img src="<?php echo (isset($store['store_logo']) && ($store['store_logo'] !== '')?$store['store_logo']:'__STATIC__/images/logo.png'); ?>" alt="<?php echo $store['store_name']; ?>"/>

        </div>

        <div class="dp_dis">

            <div class="dp_dis_s">

                <span><?php echo $store['store_name']; ?></span>

                <i></i>

            </div>

            <div class="dp_dis_x">

                <!--<div class="dp_gz">-->

                    <!--1.8万人关注-->

                <!--</div>-->

                <div class="dp_clic" data-id="<?php echo \think\Request::instance()->param('store_id'); ?>" id="favoriteStore">

                    <i <?php if($user_collect > 0): ?>class="red"<?php endif; ?>></i>

                    <span>关注</span>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="my sinhert dp_myshin ">

    <div class="content">

        <div class="floor w3">

            <ul>

                <li>

                    <a href="<?php echo U('Store/goods_list',['store_id'=>$store['store_id']]); ?>">

                        <h2><?php echo $total_goods; ?></h2>

                        <p>全部商品</p>

                    </a>

                </li>

                <li>

                    <a href="<?php echo U('Store/goods_list',['store_id'=>$store['store_id'],'sta'=>is_new]); ?>">

                        <h2><?php echo count($new_goods); ?></h2>

                        <p>新品</p>

                    </a>

                </li>

                <li>

                    <a href="<?php echo U('Store/goods_list',['store_id'=>$store['store_id'],'sta'=>is_hot]); ?>">

                        <h2><?php echo count($hot_goods); ?></h2>

                        <p>热销</p>

                    </a>

                </li>

            </ul>

        </div>

    </div>

</div>

<!--<div class="dp_adcer ma-to-20 ">-->

   <!--<li><a href="<?php echo $store[mb_slide_url][$key]; ?>"><img src="<?php echo $vimg; ?>" width="100%" /></a></li>-->

<!--</div>-->

<!--<div class="madearea ma-to-20">-->

    <!--<div class="maleri30">-->

        <!--<p>三大自然稻米带-东北产区</p>-->

        <!--<img src="__STATIC__/images/dol.png"/>-->

    <!--</div>-->

<!--</div>-->

<div class="nav-item ma-to-20">

    <div class="maleri30">

        <span>热卖单品 精挑细选</span>

    </div>

</div>

<div class="floor guesslike dp_mb0">

    <div class="likeshop">

        <ul>

            <?php if(is_array($hot_goods) || $hot_goods instanceof \think\Collection || $hot_goods instanceof \think\Paginator): if( count($hot_goods)==0 ) : echo "" ;else: foreach($hot_goods as $key=>$vo): ?>

                <li>

                    <div class="similer-product">

                        <a href="<?php echo U('Goods/goodsInfo',array('id'=>$vo[goods_id])); ?>">

                            <img src="<?php echo goods_thum_images($vo['goods_id'],200,200); ?>">

                            <span class="similar-product-text"><?php echo $vo['goods_name']; ?></span>

                        </a>

                        <span class="similar-product-price">

                            ¥<span class="big-price"><?php echo $vo['shop_price']; ?></span>

                        </span>

                    </div>

                </li>

            <?php endforeach; endif; else: echo "" ;endif; ?>

        </ul>

    </div>

</div>

<div class="nav-item more_dp">

    <div class="maleri30">

        <a href="<?php echo U('Store/goods_list',array('store_id'=>$store[store_id])); ?>">

            <span>更多</span>

            <i></i>

        </a>

    </div>

</div>

<div class="store_nav p"  style="margin-bottom:60px !important">

    <ul>

        <li>

            <div class="n">

                <a href="<?php echo U('Store/about',array('store_id'=>$store[store_id])); ?>">

                    <span>店铺详情</span>

                </a>

            </div>

        </li>

        <li>

            <div class="n">

                <a href="">

                    <img src="__STATIC__/images/class1.png"/>

                    <span>店铺分类</span>

                </a>

            </div>

        </li>

        <li>

            <div class="n">

                <a href="tel:<?php echo $store['store_phone']; ?>">

                    <span>联系客服</span>

                </a>

            </div>

        </li>

    </ul>

</div>
<!--底部导航-start-->

        <!-- 
    <a id="gotop" href="javascript:$('html,body').animate({'scrollTop':0},600);" style="display: block;width: 0.853rem;height: 0.853rem;position: fixed; bottom: 2.027rem;right: 8px; background-color: rgba(243,241,241,0.5);border: 1px solid #CCC;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;">

        <img src="__STATIC__/images/topup.png" style="display: block;width: 0.853rem;height: 0.853rem;">

    </a> -->
    
</footer>
<div id="footers" style="z-index: 9999999;">
    <a <?php if(CONTROLLER_NAME == 'Index'): ?> class="on" <?php endif; ?> href="<?php echo U('Index/index'); ?>">
        <p><i class="iconfont icon-size icon-dingbu_shouye" ></i></p>
        <span>首页</span>
    </a>
    <a <?php if(CONTROLLER_NAME == 'Goods'): ?> class="on" <?php endif; ?> href="<?php echo U('Goods/categoryList'); ?>">
        <p><i class="iconfont icon-size icon-fenlei"></i></p>
        <span>分类</span>
    </a>
     <a <?php if(CONTROLLER_NAME == 'Gold'): ?> class="on" <?php endif; ?> href="<?php echo U('Gold/gold_chain'); ?>">
        <p><i class="iconfont icon-size icon-jifen"></i></p>
        <span>新淘链</span>
    </a>
    <a <?php if(CONTROLLER_NAME == 'Cart'): ?> class="on" <?php endif; ?> href="<?php echo U('Cart/index'); ?>">
        <p><i class="iconfont icon-size icon-gouwuche"></i></p>
        <span>购物车</span>
    </a>
    <a <?php if(CONTROLLER_NAME == 'User'): ?> class="on" <?php endif; ?> href="<?php echo U('User/index'); ?>">
        <p><i class="iconfont icon-size icon-wode"></i></p>
        <span>我的</span>
    </a>
</div>

        <!--底部导航-end-->
<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>

</body>

</html>

<script>

    //收藏店铺

    $('#favoriteStore').click(function () {

        if (getCookie('user_id') == '') {

            if(confirm('请先登录')){

                window.location.href = "<?php echo U('Mobile/User/login'); ?>";

            }

        } else {

            $.ajax({

                type: 'post',

                dataType: 'json',

                data: {store_id: $(this).attr('data-id')},

                url: "<?php echo U('Home/Store/collect_store'); ?>",

                success: function (data) {

                    if (data.status == 1) {

                        $('#favoriteStore').find('i').addClass('red');

                        layer.open({content:data.msg,time:2});

                    } else {

                        layer.open({content:data.msg,time:2});

                    }

                }

            });

        }

    });

</script>