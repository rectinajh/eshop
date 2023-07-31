<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:41:"./template/mobile/default/user/index.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>个人中心--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

<style>
    .myhearder .person{
        position: relative;
    }
</style>
    <div class="myhearder" >
        <div class="person">
                <div class="personicon">
                    <img src="<?php echo (isset($user[head_pic]) && ($user[head_pic] !== '')?$user[head_pic]:"__STATIC__/images/user68.jpg"); ?>"/>
                </div>
                <div class="lors">
                    <span style="font-size:.7rem"><?php echo $user['nickname']; ?></span>
                    <?php if($nickname != ''): ?>
                        <br />
                        <span style="font-size:.512rem">由(<?php echo $nickname; ?>)推荐</span>
                    <?php endif; ?>
                </div>
                <div class="performance">
                    <p >团队业绩：<?php echo $user['team_performance']; ?></p>
                    <p >本月新增业绩：<?php echo (isset($yeji['money']) && ($yeji['money'] !== '')?$yeji['money']:0); ?></p>
                </div>
        </div>
        <div class="set">  
             <!--我的留言-->
            <a class="massage iconfont icon-xiaoxi002" href="<?php echo U('User/message_notice'); ?>"></a>
            <!--设置--> 
            <a class="setting iconfont icon-tubiaolunkuo-" href="<?php echo U('Mobile/User/userinfo'); ?>"></a>
        </div>
        <div class="head_money">
            <ul>
                <li>
                <a href="<?php echo U('Mobile/User/account'); ?>">
                   <span><?php echo $user['user_money']; ?></span>
                   <p>账户余额(元)</p>
                </a>
               </li>
               <li>
                <a href="<?php echo U('Mobile/Gold/gold_chain'); ?>">
                    <span><?php echo $user['jin_num']; ?></span>
                    <p>新淘链</p>
                </a>
                </li>
                <li>
                    <a href="<?php echo U('Mobile/User/cash'); ?>">
                    <span><?php echo $user['withdraw_money']; ?></span>
                    <p>可提现金额(元)</p>
                </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="floor my p">
        <div class="content">
            <!--订单管理模块-s-->
            <div class="floor myorder ma-to-20 p">
                <div class="content30">
                    <div class="order">
                        <div class="fl order-left">
                            <!-- <img src="__STATIC__/images/mlist.png"/> -->
                            <span>我的订单</span>
                        </div>
                        <div class="fr">
                            <a href="<?php echo U('Mobile/Order/order_list'); ?>">
                                <span style="color: #999;font-size: .512rem ">全部订单>></span>
                                <!-- <i class="Mright"></i> -->
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="floor nav-list">
                <ul>
                    <li>
                        <a href="<?php echo U('Mobile/Order/order_list',array('type'=>'WAITPAY')); ?>">
                            <?php if($user['waitPay']!=0): ?><span><?php echo $user['waitPay']; ?></span><?php endif; ?>
                            <i class="iconfont icon-zhifu"></i>
                            
                            <p>待付款</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('Mobile/Order/order_list',array('type'=>'WAITSEND')); ?>">
                            <?php if($user['waitSend']!=0): ?><span><?php echo $user['waitSend']; ?></span><?php endif; ?>
                                <i class="iconfont icon-wuliuguanli"></i>
                            <!--<img src="__STATIC__/images/ka.png" alt="" />-->
                            <p>待发货</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('Mobile/Order/order_list',array('type'=>'WAITRECEIVE')); ?>">
                            <?php if($user['waitReceive']!=0): ?><span><?php echo $user['waitReceive']; ?></span><?php endif; ?>
                            <i class="iconfont icon-shouhuo"></i>
                            <p>待收货</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('Mobile/Order/comment',array('status'=>0)); ?>">
                            <?php if($user['uncomment_count']!=0): ?><span><?php echo $user['uncomment_count']; ?></span><?php endif; ?>
                            <i class="iconfont icon-pingjia-tianchong"></i>
                            <p>待评价</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('Mobile/Order/return_goods_list'); ?>">
                            <?php if($user['return_count']!=0): ?><span><?php echo $user['return_count']; ?></span><?php endif; ?>
                            <i class="iconfont icon-kefu"></i>
                            <p>退款/退货</p>
                        </a>
                    </li>
                </ul>
            </div>
        <div class="mycenter ma-to-20">
            <ul class="center-list">
                <li><a href="<?php echo U('Mobile/User/userinfo'); ?>">
                    <i class="iconfont icon-gerenxinxi" style="color: #ffd730"></i>
                    <span>个人资料</span>
                </a></li>
                <li><a href="<?php echo U('Mobile/User/visit_log'); ?>">
                    <i class="iconfont icon-jiaoyin" style="color: #c69df9"></i>
                    <span>我的足迹</span>
                </a></li>
                <li><a href="<?php echo U('Mobile/User/collect_list'); ?>">
                    <i class="iconfont icon-shoucang" style="color: #4bbafc "></i>
                    <span>我的收藏</span>
                </a></li>
                <li><a href="<?php echo U('Mobile/User/myfocus'); ?>">
                    <i class="iconfont icon-guanzhu" style="color: #ff5d5d"></i>
                    <span>我的关注</span>
                </a></li>
                <li><a href="<?php echo U('Mobile/User/coupon'); ?>">
                    <i class="iconfont icon-youhuiquan" style="color: #f96594"></i>
                    <span>优惠券</span>
                </a></li>
                <li><a href="<?php echo U('Mobile/Order/comment',array('status'=>1)); ?>">
                    <i class="iconfont icon-pinglun" style="color: #7297fc"></i>
                    <span>我的评论</span>
                </a></li>
                <li><a href="<?php echo U('Mobile/User/userclass',array('status'=>1)); ?>">
                    <i class="iconfont icon-tuandui" style="color: #fe8d5e"></i>
                    <span>我的盟友</span>
                </a></li>
                <li><a href="<?php echo U('Mobile/User/qrcode'); ?>">
                    <i class="iconfont icon-fenxiang" style="color: #9179fe"></i>
                    <span>我的推广码</span>
                </a></li>
            </ul>

         </div>
<style>
.my .content .floor ul li a span{
	width: 0.6rem;
	height: 0.6rem;
	line-height:0.6rem;
	font-size: 0.4rem;
}
</style>
    <div class="floor list7 ma-to-20">
        <div class="myorder p">
            <div class="content30">
                <a href="<?php echo U('Mobile/User/address_list'); ?>">
                    <div class="order">
                        <div class="fl">
                            <!-- <img src="__STATIC__/images/w8.png"/> -->
                            <i class="iconfont iconfont-size iconfont-color-meihong">&#xe600;</i>
                            <span>地址管理</span>
                        </div>
                        <div class="fr">
                            <i class="Mright"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
      
<div class="floor list7 ma-to-20">
        <div class="myorder p">
            <div class="content30">
              	<a href="https://pubres.aihecong.com/web/link/chatLink.html?entId=10205"  target="_blank" >
                    <div class="order">
                        <div class="fl">
                            <!-- <img src="__STATIC__/images/w8.png"/> -->
                            <i class="iconfont icon-kefu iconfont-color-meihong"></i>
                            <span>在线客服</span>
                        </div>
                        <div class="fr">
                            <i class="Mright"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="setting">
    <div class="close">
        <a href="<?php echo U('Mobile/User/logout'); ?>" id="logout">安全退出</a>
    </div>     
</div>
</div>

    <!--底部导航-start-->
    <style>
    #gotop{opacity: 0;}
    </style>
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
