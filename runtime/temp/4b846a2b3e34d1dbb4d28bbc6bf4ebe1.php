<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:48:"./template/mobile/default/gold/consume_list.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>算力明细记录--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

            <span>算力明细记录</span>

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

<div class="allaccounted" style="margin-bottom: 65px">

    <div class="maleri30" style="margin: 0.32rem;">

        <div class="head_acc ma-to-20">

            <ul>

                <!-- <li <?php if($type == 'all'): ?>class="red"<?php endif; ?>">

                    <a href="<?php echo U('Gold/consume_list',array('type'=>'all')); ?>"  data-list="1">全部</a>

                </li> -->

                <li <?php if($type == 'plus'): ?>class="red"<?php endif; ?> style="width: 48%;">

                    <a href="<?php echo U('Gold/consume_list',array('type'=>'plus')); ?>"   data-list="2">赚取</a>

                </li>

                <li  <?php if($type == 'minus'): ?>class="red"<?php endif; ?> style="width: 48%;">

                    <a href="<?php echo U('Gold/consume_list',array('type'=>'minus')); ?>"  data-list="3">消费</a>

                </li>


            </ul>

        </div>

        <div class="allpion">

	         <div class="fll_acc" style="text-align: center;">

	         	<ul><li>描述</li><li>算力</li><li>时间</li></ul>

	         </div>

            <?php if($type == 'plus'): if(is_array($account_log) || $account_log instanceof \think\Collection || $account_log instanceof \think\Paginator): if( count($account_log)==0 ) : echo "" ;else: foreach($account_log as $key=>$v): ?>

                 <div class="fll_acc">

                     <ul>

                         <li><?php echo $v[desc]; ?></li>

                         <li><span>算力：</span><span class="red"><?php echo $v[consume_cp]; ?></span></li>

                         <li>

                             <p class="coligh">

                                 <span><?php echo date('Y.m.d H:i',$v[change_time]); ?></span>

                             </p>

                         </li>

                     </ul>

                 </div>

             <?php endforeach; endif; else: echo "" ;endif; elseif($type == 'minus'): if(is_array($account_log) || $account_log instanceof \think\Collection || $account_log instanceof \think\Paginator): if( count($account_log)==0 ) : echo "" ;else: foreach($account_log as $key=>$v): ?>

                 <div class="fll_acc">

                     <ul>

                         <li><?php echo $v[memo]; ?></li>

                         <li><span>算力：</span><span class="red"><?php echo $v[power]; ?></span></li>

                         <li>

                             <p class="coligh">

                                 <span><?php echo date('Y.m.d H:i',$v[create_time]); ?></span>

                             </p>

                         </li>

                     </ul>

                 </div>

             <?php endforeach; endif; else: echo "" ;endif; endif; ?>

         </div>

        <div id="getmore"  style="font-size:.32rem;text-align: center;color:#888;padding:.25rem .24rem .4rem; clear:both;display: none">

            <a >已显示完所有记录</a>

        </div>

    </div>

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


    var page = 0;

    function ajax_sourch_submit()

    {

        page ++;

        $.ajax({

            type : "GET",

            url:"/index.php?m=mobile&c=Gold&a=consume_list&is_ajax=1&type=<?php echo $type; ?>&p="+page,//+tab,

            success: function(data)

            {

                if($.trim(data) == '') {

                    $('#getmore').show();

                    return false;

                }else{

                    $(".allpion").append(data);

                }

            }

        });

    }

</script>

</body>
</html>