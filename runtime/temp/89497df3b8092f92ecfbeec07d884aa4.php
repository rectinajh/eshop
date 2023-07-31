<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:47:"./template/mobile/default/cart/checkcoupon.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>使用优惠券--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

<body class="f3">

<div class="classreturn">

    <div class="content">

        <div class="ds-in-bl return">

            <a href="<?php echo U('Mobile/Cart/cart2'); ?>"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

        </div>

        <div class="ds-in-bl search center">

            <span>使用优惠券</span>

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
<div class="two-bothshop">
    <div class="maleri30">
        <ul>
            <li class="couponstatus red" data-show="able"><a href="javascript:;"><span>可用优惠券</span></a></li>
            <li class="couponstatus " data-show="unusable"><a href="javascript:;"><span>不可用优惠券</span></a></li>
        </ul>
    </div>
</div>
<div class="coupon_csswri">
    <div class="maleri30">
        <ul class="able">
            <?php if(is_array($userCartCouponList) || $userCartCouponList instanceof \think\Collection || $userCartCouponList instanceof \think\Paginator): $i = 0; $__LIST__ = $userCartCouponList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$userCoupon): $mod = ($i % 2 );++$i;if($userCoupon[coupon][able] == 1): ?>
                    <li  data-date="<?php echo $userCoupon[coupon][is_expiring]; ?>" data-coupon-id="<?php echo $userCoupon[id]; ?>" data-shopid="<?php echo $userCoupon[coupon][store_id]; ?>">
                        <div class="cp_alo">
                            <div class="pon_top">
                                <h1><em class="fosi">￥</em><em><?php echo $userCoupon['coupon'][money]; ?></em></h1>
                                <p>满￥<?php echo $userCoupon[coupon][condition]; ?>使用</p>
                            </div>
                            <div class="pon_dow">
                                <p><?php echo $userCoupon['coupon'][name]; ?></p>
                                <?php if(\think\Request::instance()->param('id') == $userCoupon['coupon']['id']): ?>
                                    <a class="usecoupon" href="<?php echo U('Mobile/cart/cart2'); ?>">取消使用</a>
                                <?php else: ?>
                                    <a class="usecoupon" href="<?php echo U('Mobile/cart/cart2',array('cid'=>$userCoupon['cid'],'lid'=>$userCoupon['id'])); ?>">立即使用</a>
                                <?php endif; ?>
                            </div>
                            <p class="xd_time">限<?php echo date('Y.m.d',$userCoupon['coupon'][use_end_time]); ?>前使用</p>
                        </div>
                    </li>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <ul class="unusable" hidden>
            <?php if(is_array($userCartCouponList) || $userCartCouponList instanceof \think\Collection || $userCartCouponList instanceof \think\Paginator): $i = 0; $__LIST__ = $userCartCouponList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$userCoupon): $mod = ($i % 2 );++$i;if($userCoupon[coupon][able] == 0): ?>
                    <li>
                        <div class="cp_alo">
                            <div class="pon_top" style="background-color:#CDCDCD;">
                                <h1><em class="fosi">￥</em><em><?php echo $userCoupon['coupon'][condition]; ?></em></h1>
                                <p>满￥<?php echo $userCoupon[coupon][condition]; ?>使用</p>
                            </div>
                            <div class="pon_dow">
                                <p><?php echo $userCoupon['coupon'][name]; ?></p>
                                <a class="usecoupon" disabled>当前订单不可用</a>
                            </div>
                            <p class="xd_time">限<?php echo date('Y.m.d',$userCoupon['coupon'][use_end_time]); ?>前使用</p>
                        </div>
                    </li>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>


<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
<script>
    $(document).on('click','.couponstatus',function(){
        $(this).addClass('red').siblings('li').removeClass('red');
        var  a= $(this).data('show');
        $('.'+a).show().siblings('ul').hide();
    })
</script>
</body>
</html>