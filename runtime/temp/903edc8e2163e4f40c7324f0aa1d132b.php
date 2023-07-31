<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:48:"./template/mobile/default/user/collect_list.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>我的收藏--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

            <span>我的收藏</span>

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



<?php if(empty($lists)): ?>

    <!--没有收藏-s-->

    <div class="comment_con p">

        <div class="none"><img src="__STATIC__/images/none.png"><br><br>亲，此处还没有收藏哦~</div>

    </div>

    <!--没有收藏-e-->

<?php else: ?>

    <div class="floor guesslike">

        <div class="likeshop">

            <ul id="lists">

                <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$goods): ?>

                    <li id="cancel_<?php echo $goods['collect_id']; ?>">

                        <div class="similer-product">

                            <a class="simidibl" href="<?php echo U('Goods/goodsInfo',array('id'=>$goods[goods_id])); ?>">

                                <img src="<?php echo goods_thum_images($goods['goods_id'],400,400); ?>"/>

                                <span class="similar-product-text"><?php echo getSubstr($goods[goods_name],0,20); ?></span>

                            </a>

                            <span class="similar-product-price">

                                ¥

                                <span class="big-price"><?php echo $goods[shop_price]; ?></span>

                                  <a href="<?php echo U('Mobile/Goods/goodsList',array('id'=>$goods[cat_id3])); ?>">

                                      <span class="guess-button J_ping">看相似</span>

                                  </a>

                                <a href="javascript:;" onclick="cancel_collect(<?php echo $goods['collect_id']; ?>)">

                                    <span class="guess-button dele-button J_ping">删除</span>

                                </a>

                            </span>

                        </div>

                    </li>

                <?php endforeach; endif; else: echo "" ;endif; ?>

            </ul>

        </div>

    </div>

<?php endif; ?>

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

<script  type="text/javascript" charset="utf-8">

    /**

     * ajax加载更多

     * */

    var page = 1;

    function ajax_sourch_submit()

    {

        page += 1;

        $.ajax({

            type : "GET",

            url:"/index.php/Mobile/User/collect_list?is_ajax=1&p="+page,

            success: function(data)

            {

                if($.trim(data) == '')

                    $('#getmore').show();

                else

                    $("#lists").append(data);

            }

        });

    }

    //删除

    function cancel_collect(collect_id){

        $.ajax({

            type : "GET",

            url:"<?php echo U('Mobile/User/cancel_collect'); ?>",

            data:{collect_id:collect_id},

            dataType:'json',

            success: function(data)

            {

                if(data.status == 1)

                {

                    layer.open({content:data.msg,time:2});

//                    location.href = data.url;

                    $('#cancel_'+collect_id).hide();

                }else{

                    layer.open({content:data.msg,time:2});

                }

            }

        });

    }

</script>

</body>

</html>

