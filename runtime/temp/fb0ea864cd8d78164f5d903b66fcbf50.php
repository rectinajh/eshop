<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:55:"./template/mobile/default/order/return_goods_index.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>退换货列表--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

            <a href="javascript:history.back(-1);"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

        </div>

        <div class="ds-in-bl search center">

            <span>退换货列表</span>

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
    <div class="two-bothshop rechange">
        <div class="maleri30">
            <ul>
                <li class="red"><span><a href="<?php echo U('Order/return_goods_index'); ?>" class="tab_head">售后申请</a></span></li>
                <li><span><a href="<?php echo U('Order/return_goods_list'); ?>" class="tab_head">进度查询</a></span></li>
            </ul>
        </div>
    </div>
    <div class="attention-shoppay">
        <!--没有售后-s-->
        <!--<div class="comment_con p">
                <div class="none"><img src="__STATIC__/images/none.png"><br><br>亲，此处还没有申请的售后哦~</div>
        </div>-->
        <!--没有售后-e-->
        <div class="searchsh">
            <form action="" method="post" id="searchform">
                <div class="seac_noord">
                    <img src="__STATIC__/images/search.png" onclick="return $('#searchform').submit()"/>
                    <input type="text" name="keywords" value="<?php echo $_POST['keywords']; ?>" placeholder="商品名称、订单编号" />
                </div>
            </form>
        </div>
        <?php if(is_array($order_list) || $order_list instanceof \think\Collection || $order_list instanceof \think\Paginator): if( count($order_list)==0 ) : echo "" ;else: foreach($order_list as $key=>$vo): ?>
        <div class="orderlistshpop tuharecha mabo20 p">
            <div class="maleri30">
                <div class="returntolist">
                    <div class="list-top-re">
                        <span class="fl">订单编号：<?php echo $vo['order_sn']; ?></span>
                        <span class="red fr"><?php echo $vo['order_status_desc']; ?></span>
                    </div>
                    <div class="list-top-re als">
                        <span>下单时间：<?php echo date('Y-m-d H:i:s',$vo['add_time']); ?></span>
                    </div>
                </div>
                <?php if(is_array($vo['goods_list']) || $vo['goods_list'] instanceof \think\Collection || $vo['goods_list'] instanceof \think\Paginator): if( count($vo['goods_list'])==0 ) : echo "" ;else: foreach($vo['goods_list'] as $key=>$goods): ?>
                <div class="sc_list se_sclist paycloseto">
                    <div class="shopimg fl">
                        <img src="<?php echo goods_thum_images($goods['goods_id'],100,100); ?>">
                    </div>
                    <div class="deleshow fr">
                        <div class="deletes">
                            <a class="daaloe"><?php echo $goods['goods_name']; ?></a>
                        </div>
                        <div class="qxatten">
                            <p class="weight"><span>数量：</span><span>x<?php echo $goods['goods_num']; ?></span></p>
                            <a class="closeannten" href="<?php echo U('Order/return_goods',array('rec_id'=>$goods[rec_id])); ?>">申请售后</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div id="notmore"  style="font-size:.32rem;text-align: center;color:#888;padding:.25rem .24rem .4rem; clear:both;display: none">
        <a style="font-size:.50rem;">没有更多了</a>
    </div>
    <script type="text/javascript" src="__STATIC__/js/sourch_submit.js"></script>
<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(function(){
            $('.two-bothshop ul li').click(function(){
                $(this).addClass('red').siblings().removeClass('red');
                var gs = $('.two-bothshop ul li').index(this);
                $('.attention-shoppay').eq(gs).show().siblings('.attention-shoppay').hide();
            })
        })
        var page = 1;
        var finish = 0;
        function ajax_sourch_submit() {
            if (finish) {
                return true;
            }
            page += 1;
            $.ajax({
                type : "get",
                url:"<?php echo U('Order/return_goods_index'); ?>?is_ajax=1&p=" + page,
                success: function(data) {
                    if ($.trim(data) === '') {
                        finish = 1;
                        $('#notmore').show();
                        return false;
                    } else {
                        $(".attention-shoppay").append(data);
                    }
                }
            });
        }
    </script>
    </body>
</html>