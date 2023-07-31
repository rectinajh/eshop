<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:49:"./template/mobile/default/goods/categoryList.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:45:"./template/mobile/default/public/top_nav.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>所有分类--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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


    <div class="classreturn">

        <div class="content">

            <div class="ds-in-bl return">

                <a href="javascript:history.back(-1);"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

            </div>

            <div class="ds-in-bl search">

                <form action="" method="post">

                    <div class="sear-input">

                        <a href="<?php echo U('Goods/ajaxSearch'); ?>">

                            <input type="text" value="" placeholder="请输入您所搜索的商品">

                        </a>

                    </div>

                </form>

            </div>

            <div class="ds-in-bl menu">

                <!-- <a href="javascript:void(0);"><img src="__STATIC__/images/class1.png" alt="菜单"></a> -->

            </div>

        </div>

    </div>



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

    <!--顶部隐藏菜单-e-->
	<div style="height:1.92rem;"></div>


    <div class="flool classlist">

        <div class="fl category1">

            <ul>

                <?php $m = '0'; if(is_array($goods_category_tree) || $goods_category_tree instanceof \think\Collection || $goods_category_tree instanceof \think\Paginator): if( count($goods_category_tree)==0 ) : echo "" ;else: foreach($goods_category_tree as $k=>$vo): if($vo[level] == 1): ?>

                        <li >

                           <a href="javascript:void(0);" <?php if($m == 0): endif; ?> data-id="<?php echo $m++; ?>"><?php echo getSubstr($vo['mobile_name'],0,12); ?></a>

                        </li>

                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>

            </ul>

        </div>

        <div class="fr category2">

            <?php $j = '0'; if(is_array($goods_category_tree) || $goods_category_tree instanceof \think\Collection || $goods_category_tree instanceof \think\Paginator): if( count($goods_category_tree)==0 ) : echo "" ;else: foreach($goods_category_tree as $kk=>$vo): ?>

                <div class="branchList" >

                    <!--广告图-s-->

                    <div class="tp-bann"  data-id="<?php echo $j++; ?>">

                        <?php $pid =400;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532660400 and end_time > 1532660400 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
  \think\Cache::clear();
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>

                            <a href="<?php echo $v['ad_link']; ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?> >

                                <img src="<?php echo $v[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>">

                            </a>

                        <?php endforeach; ?>

                    </div>

                    <!--广告图-e-->

                    <!--分类-s-->

                    <div class="tp-class-list">

                        <?php if(is_array($vo['tmenu']) || $vo['tmenu'] instanceof \think\Collection || $vo['tmenu'] instanceof \think\Paginator): if( count($vo['tmenu'])==0 ) : echo "" ;else: foreach($vo['tmenu'] as $k2=>$v2): ?>

                                <h4><a href="<?php echo U('Mobile/Goods/goodsList',array('id'=>$v2[id])); ?>" ><?php echo $v2['name']; ?></a></h4>

                                <ul class="tp-category">

                                    <?php if(is_array($v2['sub_menu']) || $v2['sub_menu'] instanceof \think\Collection || $v2['sub_menu'] instanceof \think\Paginator): if( count($v2['sub_menu'])==0 ) : echo "" ;else: foreach($v2['sub_menu'] as $key=>$v3): ?>

                                            <li>

                                                <a href="<?php echo U('Mobile/Goods/goodsList',array('id'=>$v3[id])); ?>">

                                                    <img src="<?php echo (isset($v3['image']) && ($v3['image'] !== '')?$v3['image']:'__STATIC__/images/zy.png'); ?>"/>

                                                    <p><?php echo $v3['name']; ?></p>

                                                </a>

                                            </li>

                                    <?php endforeach; endif; else: echo "" ;endif; ?>

                                </ul>

                        <?php endforeach; endif; else: echo "" ;endif; ?>

                    </div>

                    <!--分类-e-->

                </div>

            <?php endforeach; endif; else: echo "" ;endif; ?>

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
<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>

<script>

    $(function () {

        //点击切换2 3级分类

        var array=new Array();

        $('.category1 li').each(function(){

            array.push($(this).position().top-0);

        });

        $('.branchList').eq(0).show().siblings().hide();

        $('.category1 li').click(function() {

            var index = $(this).index() ;

            $('.category1').delay(200).animate({scrollTop:array[index]},300);

            $(this).addClass('cur').siblings().removeClass();

            $('.branchList').eq(index).show().siblings().hide();

            $('.category2').scrollTop(0);

        });

    });

</script>

	</body>

</html>

