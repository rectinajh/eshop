<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:44:"./template/mobile/default/order/comment.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>我的评价--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

            <a href="javascript:history.back(-1)"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

        </div>

        <div class="ds-in-bl search center">

            <span>我的评价</span>

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

<div class="pjiscion p after-set-li">

    <ul>

        <a href="<?php echo U('Mobile/Order/comment',array('status'=>-1)); ?>">

            <li <?php if(\think\Request::instance()->param('status') == -1): ?>class="red"<?php endif; ?>>

                <p>全部评价</p><p></p>

            </li>

        </a>

        <a href="<?php echo U('Mobile/Order/comment',array('status'=>0)); ?>" >

            <li <?php if(\think\Request::instance()->param('status') == 0): ?>class="red"<?php endif; ?>>

                <p>待评价</p><p></p>

            </li>

        </a>

        <a href="<?php echo U('Mobile/Order/comment',array('status'=>1)); ?>">

            <li <?php if(\think\Request::instance()->param('status') == 1): ?>class="red"<?php endif; ?>>

                <p>已评价</p><p></p>

            </li>

        </a>

    </ul>

</div>

<div class="quedbox bg_white" style="margin-bottom:60px;">

    <!--<div class="sonfbst">-->

        <!--<div class="maleri30">-->

            <!--<span><i class="fbs"></i>立即发表评价晒图，最多可获得50积分</span>-->

        <!--</div>-->

    <!--</div>-->

    <?php if(empty($comment_list)): ?>

        <div class="nonenothing">

            <img src="__STATIC__/images/nothing.png"/>

            <p>没找到相关记录</p>

            <a href="<?php echo U('Mobile/Index/index'); ?>">去逛逛</a>

        </div>

    <?php else: ?>

    <div class="fukcuid mae">

        <div class="maleri30" id="maleri30">

            <?php if(is_array($comment_list) || $comment_list instanceof \think\Collection || $comment_list instanceof \think\Paginator): if( count($comment_list)==0 ) : echo "" ;else: foreach($comment_list as $key=>$comment): ?>

                <div class="shopprice dapco p">

                    <div class="sonfbst">

                        <div class="maleri30">

                            <span>订单编号：<?php echo $comment[order_sn]; ?></span>

                        </div>

                    </div>

                    <div class="img_or fl"><img src="<?php echo goods_thum_images($comment[goods_id],200,200); ?>"></div>

                    <div class="fon_or fl">

                        <h2 class="similar-product-text">

                            <a href="<?php echo U('Goods/goodsInfo',array('id'=>$comment[goods_id])); ?>"><?php echo $comment[goods_name]; ?></a>

                        </h2>

                        <p class="pall0">购买时间：<?php echo date('Y-m-d H:i',$comment['add_time']); ?></p>

                    </div>

                    <div class="dyeai">

                        <?php if($comment[goods_comment] == 0): ?>

                            <a class="compj" href="<?php echo U('Mobile/Order/comment_list',array('order_id'=>$comment['order_id'],'store_id'=>$comment['store_id'],'goods_id'=>$comment['goods_id'])); ?>"><i class="said"></i>评价订单</a>

                        <?php else: ?>

                            <a class="compj nomar" href="<?php echo U('Mobile/Order/comment_info',array('comment_id'=>$comment[comment_id])); ?>"><i class="said c23"></i>查看评价</a>

                        <?php endif; ?>

                    </div>

                </div>

            <?php endforeach; endif; else: echo "" ;endif; ?>

        </div>

    </div>

    <?php endif; ?>

</div>



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

    /**

     * ajax加载更多商品

     */

    var  page = 1;

    function ajax_sourch_submit()

    {

        ++page;

        $.ajax({

            type : "GET",

            url:"/index.php?m=Mobile&c=Order&a=comment&is_ajax=1&status=<?php echo \think\Request::instance()->param('status'); ?>&p="+page,

            success: function(data) {

                if ($.trim(data) == '') {

                    $('#getmore').show();

                    return false;

                } else {

                    $('#maleri30').append(data);

                }

            }

        });

    }

</script>

</body>

</html>

