<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:42:"./template/mobile/default/index/index.html";i:1593697741;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;s:48:"./template/mobile/default/public/footer_nav.html";i:1532661070;s:46:"./template/mobile/default/public/wx_share.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>首页--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

<!-- <script type="text/javascript">
			var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1265282947'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s19.cnzz.com/z_stat.php%3Fid%3D1265282947%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));
		</script> -->
    <!--顶部搜索栏-s-->
    <header>
        <div class="content">
            <div class="ds-in-bl logo">
                <!-- <a href=""><img src="__STATIC__/images/logo.png" alt="LOGO"></a> -->
                <a href="<?php echo U('User/reg'); ?>" style="color: #fff;font-size: .6rem;display:block;width:2.133rem;text-align: center">注册</a>
            </div>
            <div class="ds-in-bl search">
                <div class="sea-box  ">
                    <span ></span>
                    <form action=""  method="post">
                        <div class="sear-input">
                            <a href="<?php echo U('Goods/ajaxSearch'); ?>">
                                <input type="text" name="q" id="search_text" class="search_text"   value="" placeholder="请输入您所搜索的商品">
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="ds-in-bl login">
                <?php if($user_id > 0): ?> <a href="<?php echo U('User/index'); ?>"><?php else: ?>
                    <a href="<?php echo U('User/login'); ?>"><?php endif; ?>
                    <span><?php if($user_id > 0): ?><img style="width:0.8rem" src="__STATIC__/images/my.png"><?php else: ?>登录<?php endif; ?></span>
                </a>
            </div>
        </div>
    </header>
    <!--顶部搜索栏-e-->
    <!--顶部滚动广告栏-s-->
    <div class="banner ban1">
        <div class="mslide" id="slideTpshop">
            <ul>
                <!--广告表-->
                <?php $pid =2;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1593694800 and end_time > 1593694800 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("5")->select();
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


$c = 5- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
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
                    <li><a href="<?php echo $v['ad_link']; ?>">
                        <img src="<?php echo $v[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>" alt="">
                    </a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <!--顶部滚动广告栏-e-->
    <!--菜单-start-->
    <div class="floor dh">
        <nav>
            <a href="<?php echo U('Mobile/User/qrcode'); ?>">
                <span>
                    <img src="__STATIC__/images/icon_03.png" alt="我的微店" /><br />
                    <span>我的微店</span>
                </span>
            </a>
            <a href="<?php echo U('Index/street'); ?>">
                <span>
                    <img src="__STATIC__/images/icon_05.png" alt="店铺街" /><br />
                    <span>商家联盟</span>
                </span>
            </a>
            <a href="javascript:alert('服务尚未开通');">
                <span>
                    <img src="__STATIC__/images/icon_07.png" alt="品牌街" /><br />
                    <span>本地服务</span>
                </span>
            </a>
            <a href="<?php echo U('Activity/promote_goods'); ?>">
                <span>
                    <img src="__STATIC__/images/icon_09.png" alt="优惠活动" /><br />
                    <span>优惠活动</span>
                </span>
            </a>
            <a href="<?php echo U('Activity/group_list'); ?>">
                <span>
                    <img src="__STATIC__/images/icon_15.png" alt="团购" /><br />
                    <span>团购</span>
                </span>
            </a>
            <a href="<?php echo U('User/ruzhu'); ?>">
                <span>
                    <img src="__STATIC__/images/icon_16.png" alt="商家入驻" /><br />
                    <span>商家入驻</span>
                </span>
            </a>
            <!--<a href="shopcar.html">-->
            <a href="<?php echo U('Goods/integralMall'); ?>">
                <span>
                    <img src="__STATIC__/images/icon_17.png" alt="积分商城" /><br />
                    <span>积分商城</span>
                </span>
            </a>
            <!--<a href="my.html">-->
            <a href="<?php echo U('User/index'); ?>">
                <span>
                    <img src="__STATIC__/images/icon_19.png" alt="个人中心" /><br />
                    <span>个人中心</span>
                </span>
            </a>
             <!-- <a href="javascript:alert('服务尚未开通');">
                <span>
                    <img src="__STATIC__/images/icon_yanglaobaoxian.png" alt="众筹专区" /><br />
                    <span>众筹专区</span>
                </span>
            </a> -->
            <a href="<?php echo U('Store/index',array('store_id'=>1)); ?>">
                <span>
                    <img src="__STATIC__/images/icon_jinrong.png" alt="自营专区" /><br />
                    <span>自营专区</span>
                </span>
            </a>
            <!-- <a href="javascript:alert('服务尚未开通');">
                <span>
                    <img src="__STATIC__/images/icon_falvfuwu.png" alt="积分抽奖" /><br />
                    <span>积分抽奖</span>
                </span>
            </a> -->
              <a href="<?php echo U('Article/articleList'); ?>">
                <span>
                    <img src="__STATIC__/images/icon_jiaoyouhunlian.png" alt="新淘公告" /><br />
                    <span>新淘公告</span>
                </span>
            </a>
<!--             <a href="<?php echo U('Recognize/index'); ?>">
                <span>
                    <img src="__STATIC__/images/ico/ico_chain_bean.png" alt="新淘链" style="height: auto;background-color: #1c7aef;border-radius: 50%"/><br />
                    <span>新淘认筹</span>
                </span>
            </a> -->
            <a href="<?php echo U('lottery/index'); ?>">
				<span>
                    <img src="__STATIC__/images/ico/choujiang2.png" alt="抽奖" /><br/>
                    <span>推广抽奖</span>
                </span>
            </a>
        </nav>
    </div>
      <style>
             .news {
               margin: 0 auto 0.1rem;
               font-size: 15px;
               color: #666;
               display: -webkit-flex;
               display: flex;
               justify-content: flex-start;
               align-items: center;
               padding: 0 .1rem;
               background-color: #fff;
               border-top: 1px solid #eee;
               padding: .1rem .2rem;
               border-bottom: .2rem solid #f8f8f8;
           }
           .news>a{
               width: 25%;
               border-right: .1rem solid #2196f3;
               height: 1rem;
               line-height: 1rem;
               margin-right: .3rem;
               padding-right: .3rem;
           }
           .news img{
               width: 100%;
               min-height: .8rem;
           }
           .news ul{
               height: 1.5rem;
               overflow: hidden;
           }
           .news ul li{
               font-size: .7rem;
               height: 1.5rem;
               line-height: 1.5rem;
           }
       </style>
       <div class="news flex-box">
           <a href="<?php echo U('Article/articleList'); ?>"><img src="__STATIC__/images/ico/ico_chain_text.png" alt=""></a>
           <ul class="box-1">
             <?php if(is_array($article) || $article instanceof \think\Collection || $article instanceof \think\Paginator): if( count($article)==0 ) : echo "" ;else: foreach($article as $key=>$article): ?>
               <li><a href="<?php echo U('Article/articleList'); ?>"><?php echo $article['title']; ?></a></li> 
              <?php endforeach; endif; else: echo "" ;endif; ?>
           </ul>
       </div>
       <script>
           setInterval(function () {
                $('.news ul>li:first-child').animate({'margin-top':'-1rem'},500,function () {
                    $(this).css('marginTop',0).appendTo($('.news ul'))
                })
           },2000)
       </script>
    <!--菜单-end-->
<!-- 快讯-start -->
<style> 
/* .demo{
height:1.4rem;
width: 100%;
overflow:hidden;
border:1px solid #ddd;
border-left: none;
border-right: none;
display: flex;
box-sizing: border-box;
padding:0.2rem;
}
.demo img{
width: 1.0rem;
height: 1.0rem;
margin:0 0.2rem 0 0.2rem;
}
.demo ul{
width: 90%;
height: auto;
overflow: hidden;
}
.demo ul li{
height:1.0rem;
line-height: 1.0rem;
font-size: 0.44rem;
white-space:nowrap;
overflow:hidden;
text-overflow:ellipsis;
} */
</style>
<!-- <div class="demo">
<img src="__STATIC__/images/gotop.png" alt="">
<ul class="mingdan">
<?php if(is_array($flash) || $flash instanceof \think\Collection || $flash instanceof \think\Paginator): if( count($flash)==0 ) : echo "" ;else: foreach($flash as $key=>$v): ?>
<li><?php echo $v['content']; ?></li>
<?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
</div> -->
<!-- 滚动-end -->
<!--秒杀-start-->
<!-- <div class="floor secondkill">
    <div class="content">
        <div class="time p">
            <div class="djs lightning fl">
                <span class="add">秒杀</span>
                <span class="red" id=""><?php echo date('H',$start_time); ?>点场</span>
                <span class="hms"></span>
            </div>
            <div class="xsxl fr">
                <a href="<?php echo U('Mobile/Activity/flash_sale_list'); ?>">
                    <span>限时限量<img src="__STATIC__/images/or.png" alt="" /></span>
                </a>
            </div>
        </div>
        <div class="shop p">
            <?php if(count($flash_sale_list) == nll): ?>
                <div style="text-align: center;font-size:.512rem; ">暂无抢购商品。。。。</div>
            <?php endif; if(is_array($flash_sale_list) || $flash_sale_list instanceof \think\Collection || $flash_sale_list instanceof \think\Paginator): if( count($flash_sale_list)==0 ) : echo "" ;else: foreach($flash_sale_list as $key=>$v): ?>
                <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v[goods_id],'item_id'=>$v[item_id])); ?>">
                    <div class="timerBox shopnum">
                        <img src="<?php echo goods_thum_images($v[goods_id],200,200); ?>"/>
						
							 <p>￥<span><?php echo $v[price]; ?></span>元</p>
							
                    </div>
                </a>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div> -->
<!--秒杀-end-->
    <!--广告位-start-->
    <div class="banner ma-to-20">
        <?php $pid =400;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1593694800 and end_time > 1593694800 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
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
            <a href="<?php echo $v['ad_link']; ?>">
            <img src="<?php echo $v[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>"/>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="floor advertisement">
        <div class="content">
            <div class="le lefhe fl">
                <?php $pid =301;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1593694800 and end_time > 1593694800 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
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
                    <a href="<?php echo $v['ad_link']; ?>">
                        <div class="td">
                            <img src="<?php echo $v[ad_code]; ?>">
                        </div>
                    </a>
                <?php endforeach; $pid =302;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1593694800 and end_time > 1593694800 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
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
                    <a href="<?php echo $v['ad_link']; ?>">
                        <div class="td">
                            <img src="<?php echo $v[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>">
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="le re fr">
                <?php $pid =300;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1593694800 and end_time > 1593694800 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
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
                    <a href="<?php echo $v['ad_link']; ?>">
                        <div class="td">
                            <img src="<?php echo $v[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>">
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!--广告位-end-->
    <!--新品上市-start-->
    <div class="floor newshop">
        <div class="banner">
            <img src="__STATIC__/images/ind_22.jpg" alt="新品上市"/>
        </div>
        <div class="advertisement">
            <div class="content">
                <div class="le re fl">
                    <?php $pid =303;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1593694800 and end_time > 1593694800 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
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
                        <a href="<?php echo $v[ad_link]; ?>" >
                            <div class="td">
                                <img src="<?php echo $v[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>"/>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
                <div class="le lefhe fr">
                    <?php $pid =304;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1593694800 and end_time > 1593694800 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("2")->select();
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


$c = 2- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
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
                        <a href="<?php echo $v[ad_link]; ?>" >
                            <div class="td">
                                <img src="<?php echo $v[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>"/>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!--新品上市-end-->
    <!--热销商品-start-->
    <div class="floor hotshop index_hot">
        <!--<div class="banner">
            <img src="__STATIC__/images/ind_33.jpg" alt="热销商品"/>
        </div>-->
                <div class="hotsome">
                    <div class="bloc hottop">
                        <?php $pid =305;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1593694800 and end_time > 1593694800 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
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
                            <div class="le fl">
                                <a href="<?php echo $v[ad_link]; ?>" >
                                    <div class="td">
                                        <img src="<?php echo $v[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>"/>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; $pid =306;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1593694800 and end_time > 1593694800 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
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
                            <div class="le fr">
                                <a href="<?php echo $v[ad_link]; ?>" >
                                    <div class="td">
                                        <img src="<?php echo $v[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>"/>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="bloc">
                        <div class="le foura">
                            <?php $pid =307;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1593694800 and end_time > 1593694800 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("4")->select();
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


$c = 4- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
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
                                <a href="<?php echo $v[ad_link]; ?>" >
                                    <img src="<?php echo $v[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>"/>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
    </div>
    <!--热销商品-end-->
    <!--猜您喜欢-start-->
    <div class="floor guesslike">
        <div class="banner">
            <img src="__STATIC__/images/ind_52.jpg" alt="猜您喜欢"/>
        </div>
        <div class="likeshop">
            <div id="J_ItemList">
                <ul class="product single_item info">
                </ul>
                <a href="javascript:;" class="get_more" style="text-align:center; display:block;">
                    <img src='__STATIC__/images/category/loader.gif' width="12" height="12">
                </a>
            </div>
        </div>
        <!--<div class="add" onClick="getGoodsList()">点击继续加载</div>-->
        <div class="loadbefore">
            <img class="ajaxloading" src="__STATIC__/images/category/loader.gif" alt="loading...">
        </div>
        <div id="getmore"  style="font-size:.32rem;text-align: center;color:#888;padding:.25rem .24rem .4rem; clear:both;display: none"><a >已显示完所有记录</a></div>
    </div>
    <!--猜您喜欢-end-->
    <!--底部-start-->
    
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
    <!--底部-end-->
    <!--底部导航-start-->
    <!-- <div class="foohi tpnavf">
    <div class="footer">
        <ul>
            <li>
                <a <?php if(CONTROLLER_NAME == 'Index'): ?>class="yello" <?php endif; ?>  href="<?php echo U('Index/index'); ?>">
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
                <a <?php if(CONTROLLER_NAME == 'User'): ?>class="yello" <?php endif; ?> href="<?php echo U('User/index'); ?>">
                    <div class="icon">
                        <i class="icon-wode iconfont"></i>
                        <p>我的</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	  var cart_cn = getCookie('cn');
	  if(cart_cn == ''){
		$.ajax({
			type : "GET",
			url:"/index.php?m=Home&c=Cart&a=header_cart_list",//+tab,
			success: function(data){								 
				cart_cn = getCookie('cn');
				$('#cart_quantity').html(cart_cn);						
			}
		});	
	  }
	  $('#cart_quantity').html(cart_cn);
});
</script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="__PUBLIC__/js/global.js"></script>
<script type="text/javascript">
<?php if(ACTION_NAME == 'qrcode'): ?>
var ShareLink = "http://<?php echo $_SERVER[HTTP_HOST]; ?>/index.php?m=Mobile&c=User&a=reg&tuimobile=<?php echo $mobile; ?>"; //默认分享链接

var ShareImgUrl = "http://<?php echo $_SERVER[HTTP_HOST]; ?><?php echo $pic; ?>"; // 分享图标 

 <?php elseif(ACTION_NAME == 'goodsInfo'): ?>
 var ShareLink = "http://<?php echo $_SERVER[HTTP_HOST]; ?>/index.php?m=Mobile&c=Goods&a=goodsInfo&id=<?php echo $goods[goods_id]; ?>"; //默认分享链接
 var ShareImgUrl = "http://<?php echo $_SERVER[HTTP_HOST]; ?><?php echo goods_thum_images($goods[goods_id],400,400); ?>"; // 分享图标
	
<?php else: ?>
   var ShareLink = "http://<?php echo $_SERVER[HTTP_HOST]; ?>/index.php?m=Mobile&c=Index&a=index"; //默认分享链接
   var ShareImgUrl = "http://<?php echo $_SERVER[HTTP_HOST]; ?><?php echo $tpshop_config['shop_info_store_logo']; ?>"; //分享图标
<?php endif; ?>

var is_distribut = getCookie('is_distribut'); // 是否分销代理
var user_id = getCookie('user_id'); // 当前用户id
//alert(is_distribut+'=='+user_id);
// 如果已经登录了, 并且是分销商
if(parseInt(is_distribut) == 1 && parseInt(user_id) > 0)
{									
	ShareLink = ShareLink + "&first_leader="+user_id;									
}

$(function() {
	if(isWeiXin() && parseInt(user_id)>0){
		$.ajax({
			type : "POST",
			url:"/index.php?m=Mobile&c=Index&a=ajaxGetWxConfig&t="+Math.random(),
			data:{'askUrl':encodeURIComponent(location.href.split('#')[0])},		
			dataType:'JSON',
			success: function(res)
			{
				
				//微信配置
				wx.config({
				    debug: false, 
				    appId: res.appId,
				    timestamp: res.timestamp, 
				    nonceStr: res.nonceStr, 
				    signature: res.signature,
				    jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage','onMenuShareQQ','onMenuShareQZone','hideOptionMenu'] // 功能列表，我们要使用JS-SDK的什么功能
				});
			},
			error:function(){
				return false;
			}
		}); 

		// config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在 页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready 函数中。
		wx.ready(function(){
		    // 获取"分享到朋友圈"按钮点击状态及自定义分享内容接口
		   
		    wx.onMenuShareTimeline({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
		    });

		    // 获取"分享给朋友"按钮点击状态及自定义分享内容接口
		    wx.onMenuShareAppMessage({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        desc: "<?php echo $tpshop_config['shop_info_store_desc']; ?>", // 分享描述
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
		    });
			// 分享到QQ
			wx.onMenuShareQQ({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        desc: "<?php echo $tpshop_config['shop_info_store_desc']; ?>", // 分享描述
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
			});	
			// 分享到QQ空间
			wx.onMenuShareQZone({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        desc: "<?php echo $tpshop_config['shop_info_store_desc']; ?>", // 分享描述
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
			});
		});
	}
});

function isWeiXin(){
    var ua = window.navigator.userAgent.toLowerCase();
    if(ua.match(/MicroMessenger/i) == 'micromessenger'){
        return true;
    }else{
        return false;
    }
}
</script>
	
<?php if(\think\Session::get('subscribe') == 0): ?>
<style type="text/css">
.guide{width:20px;height:100px;text-align: center;border-radius: 8px ;font-size:12px;padding:8px 0;border:1px solid #adadab;color:#000000;background-color: #fff;position: fixed;right: 6px;bottom: 200px;z-index: 99;}
#cover{display:none;position:absolute;left:0;top:0;z-index:18888;background-color:#000000;opacity:0.7;}
#guide{display:none;position:absolute;top:5px;z-index:19999;}
#guide img{width: 70%;height: auto;display: block;margin: 0 auto;margin-top: 10px;}
</style>
<script type="text/javascript">
  //关注微信公众号二维码	 
function follow_wx()
{
	layer.open({
		type : 1,  
		title: '关注公众号',
		content: '<img src="<?php echo $wechat_config['qr']; ?>" width="200">',
		style: ''
	});
}
</script> 
<?php endif; ?> -->
    <!--底部导航-end-->
<script type="text/javascript" src="__STATIC__/js/sourch_submit.js"></script>
<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    /**
     * 秒杀模块倒计时
     * */
    function GetRTime(end_time){
        var NowTime = new Date();
        var t = (end_time*1000) - NowTime.getTime();
        var d=Math.floor(t/1000/60/60/24);
        var h=Math.floor(t/1000/60/60%24);
        var m=Math.floor(t/1000/60%60);
        var s=Math.floor(t/1000%60);
        if(s >= 0)
            return (d * 24 + h) + '时' + m + '分' +s+'秒';
    }
    
    function GetRTime2(){
        var text = GetRTime('<?php echo $end_time; ?>');
        if (text== 0){
            $(".hms").text('活动已结束');
        }else{
            $(".hms").text(text);
        }
    }
    setInterval(GetRTime2,1000);
    /**
     * 继续加载猜您喜欢
     * */
    var before_request = 1; // 上一次请求是否已经有返回来, 有才可以进行下一次请求
     var page = 0;
     function ajax_sourch_submit(){
         if(before_request == 0)// 上一次请求没回来 不进行下一次请求
             return false;
         before_request = 0;
         ++page;
         $('.get_more').show();
         $.ajax({
             type : "get",
             url:"/index.php?m=Mobile&c=Index&a=ajaxGetMore&p="+page,
             success: function(data)
             {
                 if(data){
                     $("#J_ItemList>ul").append(data);
                     $('.get_more').hide();
                     before_request = 1;
                 }else{
                     $('.get_more').hide();
                 }
             }
         });
     }
// 滚动 
function AutoScroll() {
    $('.mingdan').animate({
    marginTop: "-1.0rem"
    }, 500, function() {
    $(this).css({ marginTop: "0px" }).find("li:first").appendTo(this);
    });
    }
    setInterval('AutoScroll()', 2000);
</script>
<style>
    .xintaoFix{
        position: fixed;
        top: 45%;
        right: .2rem;
        z-index: 100;
        width: 1.8rem;
        height: 1.8rem;
        border-radius: .5rem;
        /* border-radius: 50%; */
        border: .1rem solid #03a3de;
        padding: .1rem;
        background-color: #162123;
        animation: round 2s linear infinite;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .xintaoFix img{
        width: 100%;
    }
    @keyframes round{
        from{
            transform: rotate(0deg)
        }
        to{
            transform: rotate(360deg)
        }
    }
</style>
    <div class="xintaoFix">
        <a href="<?php echo U('Recognize/index'); ?>"><img src="__STATIC__/images/ico/ico_chain_bean.png" alt=""></a>
    </div>
    <style>
        .lay_tanceng{
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: rgba(51, 51, 51, .8);
            z-index: 100;
            /* display: none; */
        }
        .lay_tanceng .tc_box{
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            background-color: transparent;
            text-align: center;
        }
        .lay_tanceng .tc_box .tc_bg{
            text-align: center;
        }
        .lay_tanceng .tc_box .one{
            width: 35%;
        }
        .lay_tanceng .tc_box .two{
            width: 80%;
            margin-top: -1rem;
        }
        .lay_tanceng .tc_box p{
            margin-top: .5rem;
            font-size: 1.2rem;
            color:#1c7aef;
            background: linear-gradient(to bottom, #039cd5, #4bb7de  );
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            color:transparent;
        }
        .lay_tanceng .tc_box a{
            font-size: .6rem;
            color:#fff;
            margin-top: .5rem;
            padding: .3rem 1.5rem;
            background: linear-gradient(to bottom, #039cd5 0%,#74c5e2 50%,#039ed9 100%);
            border-radius: .6rem;
            letter-spacing: .1rem;
            font-weight: bold;
            display: inline-block;
        }
        .lay_tanceng .tc_box .close{
            display: inline-block;
            width: 1rem;
            height: 1rem;
            margin-top: .5rem;
           background: url('__STATIC__/images/ico/close.png') no-repeat 0 0 /100% 100%;
            opacity: .5;
            
        }
        
    </style>
<!--     <div class="lay_tanceng">
        <div class="tc_box">	
            <div class="tc_bg">
                <img src="__STATIC__/images/ico/ico_chain_bean.png" alt="新淘链" class="one">
                <img src="__STATIC__/images/ico/ico_chain_beanBg.png" alt="新淘链" class="two">
            </div>
            <p>立即众筹新淘链</p>
            <a href="<?php echo U('Recognize/index'); ?>">立即众筹</a> <br/>
            <span class="close"></span>
        </div>
    </div> -->
    <script>
        $(function () {
            $('.lay_tanceng .close').click(function(){
                console.log(123)
                $('.lay_tanceng').hide();
            })
        })
    </script>
	</body>
</html>
