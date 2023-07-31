<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:49:"./template/mobile/default/goods/integralMall.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>积分商城--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

            <span>积分商城</span>

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
    <nav class="storenav grst p">

        <ul>

            <li <?php if(\think\Request::instance()->param('rank') == ''): ?>class="red"<?php endif; ?>>

               <a href="<?php echo U('Mobile/Goods/integralMall'); ?>"><span>默认 </span></a>

            </li>

            <li <?php if(\think\Request::instance()->param('rank') == 'num'): ?>class="red"<?php endif; ?>>

                <a href="<?php echo U('Mobile/Goods/integralMall',array('rank'=>'num')); ?>"><span>兑换量</span></a>

                <i></i>

            </li>

            <li <?php if(\think\Request::instance()->param('rank') == 'integral'): ?>class="red"<?php endif; ?>>

                <a href="<?php echo U('Mobile/Goods/integralMall',array('rank'=>'integral')); ?>"><span>积分值</span></a>

                <i></i>

            </li>

        </ul>

    </nav>

    <!--换购商品列表-s-->

    <div id="goods_list" style="margin-bottom:60px;">

        <?php if(is_array($goods_list) || $goods_list instanceof \think\Collection || $goods_list instanceof \think\Paginator): if( count($goods_list)==0 ) : echo "" ;else: foreach($goods_list as $key=>$good): ?>

            <div class="sc_list se_sclist paycloseto">

                <div class="maleri30">

                    <div class="shopimg fl">

                        <img src="<?php echo goods_thum_images($good['goods_id'],400,400); ?>">
                        
                        <?php if($good['goods_label']!=''): ?>
		                 	<p class="biao"><?php echo $good['goods_label']; ?></p>
		                 <?php endif; ?>

                    </div>

                    <div class="deleshow fr">

                        <a href="<?php echo U('Mobile/Goods/goodsInfo', array('id'=>$good[goods_id])); ?>">

                            <div class="deletes">

                                <span class="similar-product-text"><?php echo $good[goods_name]; ?></span>

                            </div>
							
                            <div class="prices" style="margin-top:0.12rem;">

                                <p class="sc_pri"><span><?php echo $good[shop_price]-$good[exchange_integral]/$point_rate; ?></span><span class="cobl">+<?php echo $good[exchange_integral]; ?>积分</span></p>

                            </div>

                        </a>
						<div class="qxatten" style="">

                            <p class="weight"><span>可兑换</span>&nbsp;<span><?php echo $good[goods_xianzhi]; ?></span></p>
                            <a class="closeannten" href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$good['goods_id'])); ?>" >立即兑换</a>
                           

                        </div>
                     
                    </div>

                </div>

            </div>

        <?php endforeach; endif; else: echo "" ;endif; ?>

    </div>
    <!--底部导航-start-->
<div id="getmore"  style="font-size: 0.512rem;text-align: center;color: rgb(136, 136, 136);clear: both;margin-bottom: 2.773rem;display:none;">

    <a >已显示完所有记录</a>

</div>
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

    //切换排序

    $(function(){

        $('.storenav ul li span').click(function(){

            $(this).parent().addClass('red').siblings('li').removeClass('red')

        });

    });



    //加载更多

    var page = 1;

    function ajax_sourch_submit(){

        page++;

        $.ajax({

            type: 'GET',

            url:'/index.php/Mobile/Goods/integralMall/p/'+page+'/rank/<?php echo \think\Request::instance()->param('rank'); ?>',

            success:function(data){
				
               if(data == ''){
					
                    $('#getmore').show();

                    return false;

                }else{

                    $('#goods_list').append(data);

                } 

            }

        })

    }

</script>

</body>

</html>

