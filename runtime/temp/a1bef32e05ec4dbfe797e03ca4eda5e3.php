<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:43:"./template/mobile/default/user/myfocus.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>我的关注--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

<body class="">


<div class="classreturn">

    <div class="content">

        <div class="ds-in-bl return">

            <a href="javascript:history.back(-1)"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

        </div>

        <div class="ds-in-bl search center">

            <span>我的关注</span>

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

<?php if(($storeNum == 0)	AND	($goodsNum == 0)): ?>

    <!--没有关注-s-->

    <div class="comment_con p">

        <div class="none"><img src="__STATIC__/images/none.png"><br><br>亲，此处还没有关注哦~</div>

    </div>

    <!--没有关注-e-->

<?php else: ?>

    <div class="two-bothshop">

        <div class="maleri30">

            <ul>

                <a href="<?php echo U('User/myfocus',array('focus_type'=>0)); ?>">

                    <li class="<?php if(\think\Request::instance()->param('focus_type') == 0): ?>red<?php endif; ?>">

                        <span>关注的商品</span><span>(<?php echo $goodsNum; ?>)</span>

                    </li>

                </a>

                <a href="<?php echo U('User/myfocus',array('focus_type'=>1)); ?>">

                    <li class="<?php if(\think\Request::instance()->param('focus_type') != 0): ?>red<?php endif; ?>">

                        <span>关注的店铺</span><span>(<?php echo $storeNum; ?>)</span>

                    </li>

                </a>

            </ul>

        </div>

    </div>



    <?php if(\think\Request::instance()->param('focus_type') == 0): ?>

    <!--关注的商品-s-->

    <div class="attention-shoppay" style="margin-bottom: 60px">

        <?php if(is_array($goodsList) || $goodsList instanceof \think\Collection || $goodsList instanceof \think\Paginator): if( count($goodsList)==0 ) : echo "" ;else: foreach($goodsList as $key=>$goods): ?>

            <div class="orderlistshpop p">

                <div class="maleri30">

                    <a href="">

                        <div class="sc_list se_sclist paycloseto">

                            <div class="shopimg fl">

                                <a href="<?php echo U('/Mobile/Goods/goodsInfo',array('id'=>$goods['goods_id'])); ?>">

                                    <img src="<?php echo goods_thum_images($goods['goods_id'],400,400); ?>">

                                </a>

                            </div>

                            <div class="deleshow fr">

                                <div class="deletes">

                                    <a href="<?php echo U('/Mobile/Goods/goodsInfo',array('id'=>$goods['goods_id'])); ?>">

                                        <span class="similar-product-text"><?php echo $goods['goods_name']; ?></span>

                                    </a>

                                </div>

                                <div class="prices">

                                    <p class="sc_pri"><span>￥</span><span><?php echo $goods['shop_price']; ?></span></p>

                                </div>

                                <div class="qxatten">

                                    <p class="weight"><span><?php echo $goods['comment_count']; ?></span><span>条评价</span></p>

                                    <a class="closeannten" href="<?php echo U('/Mobile/User/del_goods_focus',array('collect_id'=>$goods['collect_id'])); ?>">取消关注</a>

                                </div>

                            </div>

                        </div>

                    </a>

                </div>

            </div>

        <?php endforeach; endif; else: echo "" ;endif; ?>

    </div>

    <!--关注的商品-s-->

    <?php else: ?>

    <!--关注的店铺-s-->

    <div class="attention-shoppay" style="margin-bottom: 60px">

        <?php if(is_array($storeList) || $storeList instanceof \think\Collection || $storeList instanceof \think\Paginator): if( count($storeList)==0 ) : echo "" ;else: foreach($storeList as $key=>$store): ?>

            <div class="orderlistshpop p">

                <div class="maleri30">

                    <a href="">

                        <div class="sc_list se_sclist paycloseto mandplea">

                            <div class="shopimg fl">

                                <a href="<?php echo U('/Mobile/Store/index',array('store_id'=>$store['store_id'])); ?>">

                                    <img src="<?php echo goods_thum_images($store['store_logo'],400,400); ?>">

                                </a>

                            </div>

                            <div class="deleshow fr">

                                <div class="deletes">

                                    <a href="<?php echo U('/Mobile/Store/index',array('store_id'=>$store['store_id'])); ?>">

                                        <span class="similar-product-text"><?php echo $store['store_name']; ?></span>

                                    </a>

                                </div>

                                <div class="prices">

                                    <i class="lxx w<?php echo floor($store['store_servicecredit']); ?>"></i><!--w1,w2,w3,w4,w5分别对应1-5颗心-->

                                </div>

                                <div class="qxatten">

                                    <p class="weight"><span><?php echo $store['store_collect']; ?></span><span>人关注</span></p>

                                    <a class="closeannten" href="<?php echo U('/Mobile/User/del_store_focus',array('log_id'=>$store['log_id'])); ?>">取消关注</a>

                                </div>

                            </div>

                        </div>

                    </a>

                </div>

            </div>

        <?php endforeach; endif; else: echo "" ;endif; ?>

    </div>

    <!--关注的店铺-e-->

    <?php endif; endif; ?>

<div id="getmore"  style="font-size:.32rem;text-align: center;color:#888;padding:.25rem .24rem .4rem; clear:both;display: none">

    <a >已显示完所有记录</a>

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
<script type="text/javascript" src="__STATIC__/js/sourch_submit.js"></script>

<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">

    $(function(){

        $('.two-bothshop ul li').click(function(){

            $(this).addClass('red').siblings().removeClass('red');

            var gs = $('.two-bothshop ul li').index(this);

            $('.attention-shoppay').eq(gs).show().siblings('.attention-shoppay').hide();

        });

    });

    

    var page = 1;

    function ajax_sourch_submit()

    {

        page += 1;

        $.ajax({

            type : "GET",

            url:"<?php echo U('Mobile/User/myfocus',null,''); ?>/is_ajax/1/p/"+page+"/focus_type/<?php echo \think\Request::instance()->param('focus_type'); ?>",

            success: function(data) {

                if($.trim(data) === '') {

                    $('#getmore').show();

                } else {

                    $(".attention-shoppay").append(data);

                }

            }

        });

   }

</script>

</body>

</html>

