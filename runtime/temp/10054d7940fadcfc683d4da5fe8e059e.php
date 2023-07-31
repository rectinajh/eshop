<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:42:"./template/mobile/default/user/coupon.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>我的优惠券--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

<body class="g4">


<div class="classreturn">

    <div class="content">

        <div class="ds-in-bl return">

            <a href="javascript:history.back(-1)"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

        </div>

        <div class="ds-in-bl search center">

            <span>我的优惠券</span>

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

<style>.two-bothshop ul li {

    width: 33%;}</style>

<div class="two-bothshop">

    <div class="maleri30">

        <ul>

            <li  <?php if(\think\Request::instance()->param('type') == ''): ?>class="red"<?php endif; ?>">

                <a href="<?php echo U('User/coupon'); ?>"><span>未使用</span></a>

            </li>

            <li  <?php if(\think\Request::instance()->param('type') == 1): ?>class="red"<?php endif; ?>">

                <a href="<?php echo U('User/coupon',array('type'=>1)); ?>"><span>已使用</span></a>

            </li>

            <li  <?php if(\think\Request::instance()->param('type') == 2): ?>class="red"<?php endif; ?>">

                <a href="<?php echo U('User/coupon',array('type'=>2)); ?>"><span>已过期</span></a>

            </li>

        </ul>

    </div>

</div>

<div class="coupon_csswri">

    <div class="maleri30">

        <ul id="user_goods_ka_1">

            <?php if(is_array($coupon_list) || $coupon_list instanceof \think\Collection || $coupon_list instanceof \think\Paginator): $i = 0; $__LIST__ = $coupon_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$coupon): $mod = ($i % 2 );++$i;?>

                <li>

                <div class="cp_alo <?php if(\think\Request::instance()->param('type') != 0): ?>passtime<?php endif; ?>">

                    <div class="pon_top">

                        <h1><em class="fosi">￥</em><em><?php echo intval($coupon['money']); ?></em></h1>

                        <p style="padding-bottom: 0.1rem">满 <?php echo $coupon['condition']; ?> 元使用</p>

                        <p><?php echo $coupon['name']; ?></p>



                    </div>

                    <div class="pon_dow">

                        <p><?php echo $store[$coupon['store_id']]; ?></p>

                        <?php if(\think\Request::instance()->param('type') == null): if($coupon['use_type'] == 1): ?>

                                <!--指定商品-->

                                <a class="usecoupon" href="<?php echo U('Goods/goodsInfo',['id'=>$coupon['goods_id']]); ?>">

                            <?php elseif($coupon['use_type'] == 2): ?>

                                        <!--指定分类-->

                                <a class="usecoupon" href="<?php echo U('Store/goods_list',['store_id'=>$coupon['store_id']]); ?>">

                            <?php else: ?>

                                <a class="usecoupon" href="<?php echo U('Store/goods_list',['store_id'=>$coupon['store_id']]); ?>">

                            <?php endif; ?>

                            立即使用</a>

                        <?php endif; if(\think\Request::instance()->param('type') == 1): ?>

                            <a class="usecoupon" >已使用</a>

                        <?php endif; if(\think\Request::instance()->param('type') == 2): ?>

                            <a class="usecoupon" >已过期</a>

                        <?php endif; ?>

                    </div>

                    <p class="xd_time">限<?php echo date('Y-m-d',$coupon['use_end_time']); ?>前使用</p>

                </div>

            </li>

            <?php endforeach; endif; else: echo "" ;endif; ?>

        </ul>

    </div>

    <div id="getmore"  style="font-size:.32rem;text-align: center;color:#888;padding:.25rem .24rem .4rem; clear:both;display: none">

        <a >已显示完所有记录</a>

    </div>

    <script type="text/javascript" src="__STATIC__/js/sourch_submit.js"></script>

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

<script>

    var  page = 1;

    /*** ajax 提交表单 查询订单列表结果*/

    function ajax_sourch_submit()

    {

        page += 1;

        $.ajax({

            type : "GET",

            url:"/index.php?m=Mobile&c=User&a=coupon&type=<?php echo \think\Request::instance()->param('type'); ?>&is_ajax=1&p="+page,//+tab,

//			url:"<?php echo U('Mobile/User/coupon',array('type'=>$_GET['type']),''); ?>/is_ajax/1/p/"+page,//+tab,

//			data : $('#filter_form').serialize(),// 你的formid 搜索表单 序列化提交

            success: function(data)

            {

                if($.trim(data) == '')

                    $('#getmore').show();

                return false;

                else

                    $("#user_goods_ka_1").append(data);

            }

        });

    }

</script>

<script src="js/style.js" type="text/javascript" charset="utf-8"></script>

</body>

</html>

