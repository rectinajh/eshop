<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:47:"./template/mobile/default/store/goods_list.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:45:"./template/mobile/default/public/top_nav.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
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


<!--搜索栏-s-->
<style>
html{
    margin-bottom: 64px;
}
</style>
<div class="classreturn">

    <div class="content">

        <!--<div class="ds-in-bl return">-->

            <!--<a href="javascript:history.back(-1);"><img src="__STATIC__/images/return.png" alt="返回"></a>-->

        <!--</div>-->

        <div class="ds-in-bl search">

            <form action="" method="post" id="secrchForm">

                <div class="sear-input">

                    <input type="text" name="keywords" value="<?php echo I('keywords')?>" style="border: 1px solid #DEDEDE">

                </div>

            </form>

        </div>

        <div class="ds-in-bl" >

            <a href="javascript:;" onclick="ajaxsecrch()" >

                <div class="ri_ss"><img src="__STATIC__/images/sea.png" style="width:1.23733rem;height:1.23733rem;margin-left:0.6rem; "/></div>

            </a>

        </div>

    </div>

</div>

<!--搜索栏-e-->



<!--顶部隐藏菜单-s-->

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
<div style="height: 1.8rem"></div>
<!--顶部隐藏菜单-e-->

		<nav class="storenav p search_list_dump">

			<ul>

                <li <?php if(\think\Request::instance()->param('sort') == null): ?>class='red'<?php endif; ?>>

                    <span class="lb">综合</span>

                    <i></i>

                </li>

                <li <?php if(\think\Request::instance()->param('sort') == sales_sum): ?>class='red'<?php endif; ?>>

                    <a href="<?php echo U('Store/goods_list',['store_id'=>$store['store_id'],'sort'=>'sales_sum']); ?>"><span class="dq">销量</span></a>

                </li>

                <li <?php if(\think\Request::instance()->param('sort') == shop_price): ?>class='red'<?php endif; ?>>

                    <a href="<?php echo U('Store/goods_list',['store_id'=>$store['store_id'],'sort'=>'shop_price','sort_asc'=>$sort_asc]); ?>"><span class="jg">价格</span></a>

                     <i class="pr <?php if(\think\Request::instance()->param('sort_asc') == 'asc'): ?>bpr2<?php endif; if(\think\Request::instance()->param('sort_asc') == 'desc'): ?> bpr1 <?php endif; ?>"></i>

                </li>

                <li <?php if(\think\Request::instance()->param('sort') == comment_count): ?>class='red'<?php endif; ?>>

                    <a href="<?php echo U('Store/goods_list',['store_id'=>$store['store_id'],'sort'=>'comment_count','sort_asc'=>'desc']); ?>">

                        <span class="sx">评论</span>

                    </a>

                </li>

				<li >

					<i class="listorimg"></i>

				</li>

			</ul>

		</nav>

		<div id="goods_list" class="addimgchan">

            <?php if(is_array($goods_list) || $goods_list instanceof \think\Collection || $goods_list instanceof \think\Paginator): $i = 0; $__LIST__ = $goods_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>

                <div class="orderlistshpop p">

                    <div class="maleri30">

                        <a href="<?php echo U('Goods/goodsInfo',array('id'=>$vo[goods_id])); ?>">

                            <div class="sc_list se_sclist">

                                <div class="shopimg fl">

                                    <img src="<?php echo goods_thum_images($vo['goods_id'],100,100); ?>">

                                </div>

                                <div class="deleshow fr">

                                    <div class="deletes">

                                        <span class="similar-product-text fl"><?php echo $vo['goods_name']; ?></span>

                                    </div>

                                    <div class="prices">

                                        <p class="sc_pri fl"><span>￥</span><span><?php echo $vo['shop_price']; ?></span></p>

                                    </div>

                                    <p class="weight"><span><?php echo $vo['comment_count']; ?></span><span>条评价</span></p>

                                </div>

                            </div>

                        </a>

                    </div>

                </div>

            <?php endforeach; endif; else: echo "" ;endif; ?>

		</div>





<!--综合筛选弹框-s-->

<div class="fil_all_comm">

    <div class="maleri30">

        <ul>

            <li >

                <a href="<?php echo U('Store/goods_list',['store_id'=>$store['store_id']]); ?>">综合</a>

            </li>

            <li <?php if(\think\Request::instance()->param('key') == 'is_new'): ?>class='red'<?php endif; ?>>

                <a href="<?php echo U('Store/goods_list',['store_id'=>$store['store_id'],'sta'=>'is_new']); ?>">新品</a>

            </li>

            <li <?php if(\think\Request::instance()->param('key') == 'is_hot'): ?>class='red'<?php endif; ?>>

                <a href="<?php echo U('Store/goods_list',['store_id'=>$store['store_id'],'sta'=>'is_hot']); ?>">热销</a>

            </li>

        </ul>

    </div>

</div>

<!--综合弹框-e-->

<div class="mask-filter-div" style="display: none;"></div>
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

    //综合

    $('.search_list_dump .lb').click(function(){

        $('.fil_all_comm').show();

        cover();

        $('.classreturn,.search_list_dump').addClass('pore');

    });

    //切换

    $(function(){

        $('.listorimg').click(function(){

            $(this).toggleClass('orimg');

            $('#goods_list').toggleClass('addimgchan');

        })

    })

    //搜索

    function ajaxsecrch(){

        $('#secrchForm').submit()

    }



    var  page = 1;

    var cat_id = '<?php echo $cat_id; ?>';

    var sta = '<?php echo $sta; ?>';  //状态

    var sort = '<?php echo $sort; ?>';

    var sort_asc = '<?php echo $sort_asc; ?>';

    var keywords = '<?php echo $keywords; ?>';

    var store_id = "<?php echo $store['store_id']; ?>";

    /**

     * ajax加载更多商品

     */

    function ajax_sourch_submit()

    {

        page ++;

        $.ajax({

            type : "get",

            url: "/index.php?m=Mobile&c=Store&a=goods_list",

            data: {p: page, cat_id: cat_id, sta: sta, sort: sort, keywords: keywords ,store_id:store_id},

            success: function(data)

            {

                if($.trim(data) == ''){

                    $('#getmore').show();

                    return false;

                } else{

                    $("#goods_list").append(data);

                }

            }

        });

    }

</script>

	</body>

</html>

