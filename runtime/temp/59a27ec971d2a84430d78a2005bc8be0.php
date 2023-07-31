<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:43:"./template/mobile/default/user/account.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>我的钱包--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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


<div class="myhearder bankhearder">
    <div class="top_nav_back">
        <a href="javascript:history.back(-1);">
            <img src="__STATIC__/images/newBack.png" alt="返回">
        </a>
        <span>余额</span>
    </div>
    <div class="title-money-box">
        <div class="xiaofei">
            <div class="money-name">余额(元)</div>
            <div class="money-value"><?php echo $user['user_money']; ?></div>
        </div>
    </div>
</div>
<div class="floor-floor">
    <ul class="floor-items">
        <li>
            <a href="<?php echo U('Mobile/User/recharge'); ?>">
                <div class="itlt">
                    <i class="iconfont icon-zhifu" style="color: #ff864d"></i>
                    <span>余额充值</span>
                </div>
                <div class="itrt">
                    <i class="Mright"></i>
                </div>
            </a>
        </li>
        <li>
            <a href="<?php echo U('Mobile/User/account_list'); ?>">
                <div class="itlt">
                    <i class="iconfont icon-mingxi" style="color: #ff864d"></i>
                    <span>余额明细</span>
                </div>
                <div class="itrt">
                    <i class="Mright"></i>
                </div>
            </a>
        </li>
        <li>
            <a href="<?php echo U('Mobile/User/recharge_list'); ?>">
                <div class="itlt">
                    <i class="iconfont icon-5" style="color: #68fa60"></i>
                    <span>充值记录</span>
                </div>
                <div class="itrt">
                    <i class="Mright"></i>
                </div>
            </a>
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