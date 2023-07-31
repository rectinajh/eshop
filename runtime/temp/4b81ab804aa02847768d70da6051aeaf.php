<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:50:"./template/mobile/default/activity/group_list.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>团购--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

            <a href="javascript:history.back(-1)"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

        </div>

        <div class="ds-in-bl search center">

            <span>团购</span>

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

<!--倒计时-->

<script>

    var Tday = new Array();

    var daysms = 24 * 60 * 60 * 1000

    var hoursms = 60 * 60 * 1000

    var Secondms = 60 * 1000

    var microsecond = 1000

    var DifferHour = -1

    var DifferMinute = -1

    var DifferSecond = -1

    function clock11(key){

        var time = new Date()

        var hour = time.getHours()

        var minute = time.getMinutes()

        var second = time.getSeconds()

        var timevalue = ""+((hour > 12) ? hour-12:hour)

        timevalue +=((minute < 10) ? ":0":":")+minute

        timevalue +=((second < 10) ? ":0":":")+second

        timevalue +=((hour >12 ) ? " PM":" AM")

        var convertHour = DifferHour

        var convertMinute = DifferMinute

        var convertSecond = DifferSecond

        var Diffms = Tday[key].getTime() - time.getTime()

        DifferHour = Math.floor(Diffms / daysms)

        Diffms -= DifferHour * daysms

        DifferMinute = Math.floor(Diffms / hoursms)

        Diffms -= DifferMinute * hoursms

        DifferSecond = Math.floor(Diffms / Secondms)

        Diffms -= DifferSecond * Secondms

        var dSecs = Math.floor(Diffms / microsecond)



        if(convertHour != DifferHour) e="<span class=hour>"+DifferHour+"</span>天";

        if(convertMinute != DifferMinute) f="<span class=min>"+DifferMinute+"</span>时";

        if(convertSecond != DifferSecond) g="<span class=sec>"+DifferSecond+"</span>分";

        h="<span class=msec>"+dSecs+"</span>秒";

        if (DifferHour>0) {e=e}

        else {e=''}

        document.getElementById("jstimerBox"+key).innerHTML = '剩余<br />'+e + f + g + h;

    }

</script>

		<nav class="storenav grst p">

			<ul>

				<li <?php if(\think\Request::instance()->param('type') == ''): ?>class='red'<?php endif; ?>>

                    <a href="<?php echo U('Mobile/Activity/group_list'); ?>">

                        <span >默认</span>

                    </a>

				</li>

				<li <?php if(\think\Request::instance()->param('type') == 'new'): ?>class='red'<?php endif; ?>>

                    <a href="<?php echo U('Mobile/Activity/group_list',array('type'=>'new')); ?>">

					    <span >最新</span>

					<i></i>

					</a>

				</li>

				<li <?php if(\think\Request::instance()->param('type') == 'comment'): ?>class='red'<?php endif; ?>>

                    <a href="<?php echo U('Mobile/Activity/group_list',array('type'=>'comment')); ?>">

                        <span >评论数</span>

					    <i></i>

					</a>

				</li>

			</ul>

		</nav>

		<!--<div class="floor guesslike groupquess">-->

			<!--<div class="likeshop">-->

				<!--<ul>-->

                    <!--&lt;!&ndash;顶部商品列表-s&ndash;&gt;-->

					<!--<li>-->

						<!--<a href="javascript:void(0);">-->

							<!--<div class="similer-product">-->

								<!--<div class="zjj close">-->

									<!--<img src="__STATIC__/images/tg_03.jpg">-->

                                    <!--&lt;!&ndash;活动结束提示图片-s&ndash;&gt;-->

									<!--<img src="__STATIC__/images/close.png" style="position: absolute;z-index: 999;left: 0;top: 0;"/>-->

                                    <!--&lt;!&ndash;活动结束提示图片-e&ndash;&gt;-->

									<!--<div class="sale">-->

										<!--<p>直降</p>-->

										<!--<p>12</p>-->

									<!--</div>-->

								<!--</div>-->

								<!--<span class="similar-product-text">诺贝达灰配枣红间色手提包时尚商务人士首选诺贝达灰配枣红间色手提包时尚商务人士首选诺贝达灰配枣红间色手提包时尚商务人士首选诺贝达灰配枣红间色手提包时尚商务人士首选</span>-->

								<!--<span class="cy"><i>200</i>人参与</span>-->

								<!--<span class="similar-product-price">-->

									<!--¥-->

									<!--<span class="big-price">344</span>-->

									<!--<span class="small-price">.00</span>-->

								<!--</span>-->

							<!--</div>-->

						<!--</a>-->

					<!--</li>-->

                    <!--&lt;!&ndash;顶部商品列表-e&ndash;&gt;-->

				<!--</ul>-->

			<!--</div>-->

		<!--</div>-->



        <!--广告图片-s-->

		<div class="banner">

            <?php $pid =204;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532689200 and end_time > 1532689200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
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
foreach($result as $key=>$v1):       
    
    $v1[position] = $ad_position[$v1[pid]]; 
    if(I("get.edit_ad") && $v1[not_adv] == 0 )
    {
        $v1[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v1[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v1[ad_id]";        
        $v1[title] = $ad_position[$v1[pid]][position_name]."===".$v1[ad_name];
        $v1[target] = 0;
    }
    ?>

                <a href="<?php echo $v['ad_link']; ?>">

                    <img src="<?php echo $v1[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>"/>

                </a>

            <?php endforeach; ?>

		</div>

        <!--中间广告图（2张）-s-->

		<div class="gg2">

			<ul>

                <?php $pid =205;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532689200 and end_time > 1532689200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
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

                    <li>

                        <a href="<?php echo $v['ad_link']; ?>">

                            <img src="<?php echo $v[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>"/>

                        </a>

                    </li>

                <?php endforeach; $pid =206;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532689200 and end_time > 1532689200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
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

                    <li>

                        <a href="<?php echo $v['ad_link']; ?>">

                            <img src="<?php echo $v[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>"/>

                        </a>

                    </li>

                <?php endforeach; ?>

			</ul>

		</div>

        <!--中间广告图（2张）-e-->



        <!--底部广告图-s-->

		<div class="banner borltrt">

            <?php $pid =207;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532689200 and end_time > 1532689200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
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

                    <img class="bor" src="<?php echo $v[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>"/>

                </a>

            <?php endforeach; ?>

		</div>

		<div class="th3 p">

			<ul>

                <!--广告小图（3张）-s-->

                <?php $pid =208;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532689200 and end_time > 1532689200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("3")->select();
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


$c = 3- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
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

                    <li>

                        <a href="<?php echo $v['ad_link']; ?>">

                            <div class="around">

                                <img src="<?php echo $v[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>"/>

                            </div>

                        </a>

                    </li>

                <?php endforeach; ?>

                <!--广告小图（3张）-e-->

			</ul>

		</div>

        <!--底部广告图-e-->

        <!--广告图片-e-->



        <!--底部商品列表-s-->

		<div class="floor guesslike groupquess dic">

			<div class="likeshop">

				<ul>

                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?>

					<li>

						<a href="<?php echo U('Goods/goodsInfo',array('id'=>$group[goods_id],'item_id'=>$group[specGoodsPrice][item_id])); ?>">

							<div class="similer-product">

								<div class="zjj close">

									<img src="<?php echo goods_thum_images($group['goods_id'],200,200); ?>">

									<div class="sale onsale">

										<p><?php echo $group[rebate]; ?>折</p>

									</div>

								</div>

								<span class="similar-product-text"><?php echo $group[goods_name]; ?></span>

								<span class="cy"><i><?php echo $group[virtual_num]; ?></i>人参与</span>

								<span class="similar-product-price">

									¥

									<span class="big-price"><?php echo $group[price]; ?>元</span>

									<!--未打折价格<span class="small-price"  style="display:;">￥<?php echo $v[goods_price]; ?>元</span> -->

									<span class="fr sg_g_time last_g_time" id="jstimerBox<?php echo $group[goods_id]; ?>"></span>

								</span>

							</div>

						</a>

					</li>

                    <script>

                        Tday['<?php echo $group[goods_id]; ?>'] = new Date('<?php echo date("Y/m/d H:i:s",$group['end_time']); ?>');

                        window.setInterval(function() {clock11('<?php echo $group[goods_id]; ?>');}, 1000);

                    </script>

                    <?php endforeach; endif; else: echo "" ;endif; ?>

				</ul>

			</div>

		</div>

        <!--底部商品列表-e-->



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

    //倒计时

    function goTop(){

        $('html,body').animate({'scrollTop':0},600);

    }



    //加载更多商品

    var page = 1;

    function ajax_sourch_submit(){

        ++page;

        $.ajax({

            type:'GET',

            url:"/index.php?m=Mobile&c=Activity&is_ajax=1&a=group_list&p="+page,

            success:function(data){

                if(data){

                    $(".likeshop>ul").append(data);

                    $('.get_more').hide();

                }else{

                    $('.get_more').hide();

                    $('#getmore').remove();

                }

            }

        })

    }

</script>

	</body>

</html>

