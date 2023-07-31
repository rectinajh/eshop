<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:43:"./template/mobile/default/index/street.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>店铺街--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

            <span>店铺街</span>

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
		<!--banner1-start-->

		<div class="banner">

			<img src="__STATIC__/images/fb.jpg"/>

		</div>

		<!--banner1-end-->

		<nav class="storenav p">

			<ul>

				<li>

					<span class="lb">类别</span>

					<i></i>

				</li>

				<li>

				<a href="javascript:void(0)" onclick="locationaddress(this);">

                    <script type="text/javascript">

                        function locationaddress(e){

                            $('.container').animate({width: '14.4rem', opacity: 'show'}, 'normal',function(){

                                $('.container').show();

                            });

                            if(!$('.container').is(":hidden")){

                                $('body').css('overflow','hidden')

                                cover();

                                $('.mask-filter-div').css('z-index','9999');

                            }

                        }

                        function closelocation(){

                            var province_div = $('.province-list');

                            var city_div = $('.city-list');

                            var area_div = $('.area-list');

                            if(area_div.is(":hidden") == false){

                                area_div.hide();

                                city_div.show();

                                province_div.hide();

                                return;

                            }

                            if(city_div.is(":hidden") == false){

                                area_div.hide();

                                city_div.hide();

                                province_div.show();

                                return;

                            }

                            if(province_div.is(":hidden") == false){

                                area_div.hide();

                                city_div.hide();

                                $('.container').animate({width: '0', opacity: 'show'}, 'normal',function(){

                                    $('.container').hide();

                                });

                                undercover();

                                $('.mask-filter-div').css('z-index','inherit');

                                return;

                            }

                        }

                    </script><span class="dq">地区</span></a>

					<i></i>

					<!--地区获取输出-s-->

					<div class="dqs" style="display:none;">

						<input id="address" type="text" readonly="" placeholder="城市选择"  value=""/>

	            		<input id="province_id" type="hidden" value=""/>

	            		<input id="city_id"     type="hidden" value=""/>

	            		<input id="district_id" type="hidden" value=""/>

            		</div>

            		<!--地区获取输出-e-->

				</li>

				<li>

					<span>排序</span>

					<i></i>

				</li>

			</ul>

		</nav>

		<div class="lb_showhide p">

			<ul>

			<li><a href="javascript:setCat_id(0);">全部分类</a></li>

			<?php if(is_array($store_class) || $store_class instanceof \think\Collection || $store_class instanceof \think\Paginator): $i = 0; $__LIST__ = $store_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sc): $mod = ($i % 2 );++$i;?>

				<li><a href="javascript:setCat_id(<?php echo $sc['sc_id']; ?>);"><?php echo $sc['sc_name']; ?></a></li>

			<?php endforeach; endif; else: echo "" ;endif; ?>

			</ul>

		</div>

		<div class="store_info" id="store_list">

		

		</div>

		<!--选择地区-s-->

        <div class="container" >

            <div class="city">

                <div class="screen_wi_loc">

                    <div class="classreturn loginsignup">

                        <div class="content">

                            <div class="ds-in-bl return seac_retu">

                                <a href="javascript:void(0);" onclick="closelocation();"><img src="__STATIC__/images/return.png" alt="返回"></a>

                            </div>

                            <div class="ds-in-bl search center">

                                <span class="sx_jsxz">选择地区</span>

                            </div>

                            <div class="ds-in-bl suce_ok">

                                <a href="javascript:void(0);">&nbsp;</a>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="province-list"></div>

                <div class="city-list" style="display:none"></div>

                <div class="area-list" style="display:none"></div>

            </div>

        </div>

        <!--选择地区-e-->

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

		<div class="mask-filter-div"></div>

<script type="text/javascript" src="__STATIC__/js/mobile-location.js"></script>

<script type="text/javascript" src="__STATIC__/js/sourch_submit.js"></script>

<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>

		<script type="text/javascript">

	    $(function () {

            ajax_sourch_submit();

	    });



	    var page = 0;//页数

	    var cat_id = '';//店铺分类id

	    /**

	     * 加载分类店铺

	     */

	    function setCat_id(cid) {

	        $("#store_list").html('');

	        undercover();

	        $('.lb_showhide').hide();

	        page = 0;

	        cat_id = cid;

            ajax_sourch_submit();

	    }

	    /**

	     * 加载店铺

	     */

	    function ajax_sourch_submit() {

            page++;

            var province_id = $('#province_id').val();

            var city_id = $('#city_id').val();

            var district_id =$('#district_id').val();

	        $.ajax({

	            type: "get",

	            url: "/index.php?m=Mobile&c=Index&a=ajaxStreetList&",

	            dataType: 'html',

                data:{'p':page,'sc_id':cat_id,'province_id':province_id,'city_id':city_id,'district_id':district_id,'order':1},

	            success: function (data) {

	                if (data) {

	                    $("#store_list").append(data);

	                    $('.get_more').hide();

	                } else {

                        $('#getmore').show();

                        return false;

	                }

	            }

	        });

	    }

		

		$(function(){

			$('.storenav ul li').click(function(){

				$(this).addClass('red').siblings('li').removeClass('red')

			});

			

			$('.storenav ul li .lb').click(function(){

				$('.lb_showhide').show();

				cover();

			});

			

			$('.storenav ul li .dq').click(function(){

				$(this).siblings('.dqs').find('#dq').click();

			});

		});

        //收藏店铺

        function favoriteStore(id) {

            if(getCookie('user_id')<=0 || getCookie('user_id')==''){

                layer.open({content:'请先登录',time:1});

                return false;

            }

            $.ajax({

                type: 'post',

                dataType: 'json',

                data: {store_id: id},

                url: "/index.php/Home/Store/collect_store",

                success: function (data) {

                    if (data.status == 1) {

                        layer.open({content:data.msg,time:1});

                        $('#store_'+id).html('<a href="javascript:void(0)" class="collect">已关注</a>')

                    } else {

                        layer.open({content:data.msg,time:1});

                    }

                }

            });

        }

		</script>

	</body>

</html>