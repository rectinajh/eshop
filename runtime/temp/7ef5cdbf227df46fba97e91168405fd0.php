<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:42:"./application/seller/new/report/index.html";i:1532228866;s:41:"./application/seller/new/public/head.html";i:1532228866;s:41:"./application/seller/new/public/left.html";i:1532228866;s:41:"./application/seller/new/public/foot.html";i:1532228866;}*/ ?>
<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>商家中心 - www.ohbbs.cn 欧皇源码论坛 </title>

<link href="__PUBLIC__/static/css/base.css" rel="stylesheet" type="text/css">

<link href="__PUBLIC__/static/css/seller_center.css" rel="stylesheet" type="text/css">

<link href="__PUBLIC__/static/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />


<!--[if IE 7]>

  <link rel="stylesheet" href="__PUBLIC__/static/font/font-awesome/css/font-awesome-ie7.min.css">

<![endif]-->

<script type="text/javascript" src="__PUBLIC__/static/js/jquery.js"></script>

<script type="text/javascript" src="__PUBLIC__/static/js/seller.js"></script>

<script type="text/javascript" src="__PUBLIC__/static/js/waypoints.js"></script>

<script type="text/javascript" src="__PUBLIC__/static/js/jquery-ui/jquery-ui.min.js"></script>

<script type="text/javascript" src="__PUBLIC__/static/js/jquery.validation.min.js"></script>

<script type="text/javascript" src="__PUBLIC__/static/js/layer/layer.js"></script>

<script type="text/javascript" src="__PUBLIC__/js/dialog/dialog.js" id="dialog_js"></script>

<script type="text/javascript" src="__PUBLIC__/js/global.js"></script>

<script type="text/javascript" src="__PUBLIC__/js/myAjax.js"></script>

<script type="text/javascript" src="__PUBLIC__/js/myFormValidate.js"></script>

<script type="text/javascript" src="__ROOT__/public/static/js/layer/laydate/laydate.js"></script>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

<!--[if lt IE 9]>

      <script src="__PUBLIC__/static/js/html5shiv.js"></script>

      <script src="__PUBLIC__/static/js/respond.min.js"></script>

<![endif]-->

</head>

<body>

<div id="append_parent"></div>

<div id="ajaxwaitid"></div>

<header class="ncsc-head-layout w">

  <div class="wrapper">

    <div class="ncsc-admin w252">

      <dl class="ncsc-admin-info">

        <dt class="admin-avatar"><img src="__PUBLIC__/static/images/seller/default_user_portrait.gif" width="32" class="pngFix" alt=""/></dt>

      </dl>

      <div class="ncsc-admin-function">



      <div class="index-search-container">

      <p class="admin-name"><a class="seller_name" href=""><?php echo $store['store_name']; ?></a></p>

      <div class="index-sitemap"><a class="iconangledown" href="javascript:void(0);">快捷导航 <i class="icon-angle-down"></i></a>

          <div class="sitemap-menu-arrow"></div>

          <div class="sitemap-menu">

              <div class="title-bar">

                <h2>管理导航</h2>

                <p class="h_tips"><em>小提示：添加您经常使用的功能到首页侧边栏，方便操作。</em></p>

                <img src="__PUBLIC__/static/images/obo.png" alt="">

                <span id="closeSitemap" class="close">X</span>

              </div>

              <div id="quicklink_list" class="content">

	          	<?php if(is_array($menuArr) || $menuArr instanceof \think\Collection || $menuArr instanceof \think\Paginator): if( count($menuArr)==0 ) : echo "" ;else: foreach($menuArr as $k2=>$v2): ?>

	             <dl>

	              <dt><?php echo $v2['name']; ?></dt>

	                <?php if(is_array($v2['child']) || $v2['child'] instanceof \think\Collection || $v2['child'] instanceof \think\Paginator): if( count($v2['child'])==0 ) : echo "" ;else: foreach($v2['child'] as $key=>$v3): ?>

	                <dd class="<?php if(!empty($quicklink)){if(in_array($v3['op'].'_'.$v3['act'],$quicklink)){echo 'selected';}} ?>">

	                	<i nctype="btn_add_quicklink" data-quicklink-act="<?php echo $v3[op]; ?>_<?php echo $v3[act]; ?>" class="icon-check" title="添加为常用功能菜单"></i>

	                	<a href=<?php echo U("$v3[op]/$v3[act]"); ?>> <?php echo $v3['name']; ?> </a>

	                </dd>

	            	<?php endforeach; endif; else: echo "" ;endif; ?>

	             </dl>

	            <?php endforeach; endif; else: echo "" ;endif; ?>      

              </div>

          </div>

        </div>

      </div>



      <a class="iconshop" href="<?php echo U('Home/Store/index',array('store_id'=>STORE_ID)); ?>" title="前往店铺" ><i class="icon-home"></i>&nbsp;店铺</a>

      <a class="iconshop" href="<?php echo U('Admin/admin_info',array('seller_id'=>$seller['seller_id'])); ?>" title="修改密码" target="_blank"><i class="icon-wrench"></i>&nbsp;设置</a>

      <a class="iconshop" href="<?php echo U('Admin/logout'); ?>" title="安全退出"><i class="icon-signout"></i>&nbsp;退出</a></div>

    </div>

    <div class="center-logo"> <a href="/" target="_blank">

    	<img src="__PUBLIC__/static/images/seller/seller_center_logo.png" class="pngFix" alt=""/></a>

      <h1>商家中心</h1>

    </div>

    <nav class="ncsc-nav">

      <dl <?php if(ACTION_NAME == 'index' AND CONTROLLER_NAME == 'Index'): ?>class="current"<?php endif; ?>>

        <dt><a href="<?php echo U('Index/index'); ?>">首页</a></dt>

        <dd class="arrow"></dd>

      </dl>

      

      <?php if(is_array($menuArr) || $menuArr instanceof \think\Collection || $menuArr instanceof \think\Paginator): if( count($menuArr)==0 ) : echo "" ;else: foreach($menuArr as $kk=>$vo): ?>

      <dl <?php if(ACTION_NAME == $vo[child][0][act] AND CONTROLLER_NAME == $vo[child][0][op]): ?>class="current"<?php endif; ?>>

        <dt><a href="/index.php?m=Seller&c=<?php echo $vo[child][0][op]; ?>&a=<?php echo $vo[child][0][act]; ?>"><?php echo $vo['name']; ?></a></dt>

        <dd>

          <ul>	

          		<?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): if( count($vo['child'])==0 ) : echo "" ;else: foreach($vo['child'] as $key=>$vv): ?>

                <li> <a href='<?php echo U("$vv[op]/$vv[act]"); ?>'> <?php echo $vv['name']; ?> </a> </li>

				<?php endforeach; endif; else: echo "" ;endif; ?>

           </ul>

        </dd>

        <dd class="arrow"></dd>

      </dl>

      <?php endforeach; endif; else: echo "" ;endif; ?>

	</nav>

  </div>

</header>
<style>
    .ncsc-goods-sku.ps-container {
        height: 1px;
        border: 0;
        border-bottom: solid 1px #E6E6E6;
        background: inherit;
        box-shadow: inherit;
    }

    a.ncbtn {
        cursor: default;
    }
</style>
<script src="__ROOT__/public/static/js/layer/laydate/laydate.js"></script>
<div class="ncsc-layout wrapper">
     <div id="layoutLeft" class="ncsc-layout-left">
   <div id="sidebar" class="sidebar">
     <div class="column-title" id="main-nav"><span class="ico-<?php echo $leftMenu['icon']; ?>"></span>
       <h2><?php echo $leftMenu['name']; ?></h2>
     </div>
     <div class="column-menu">
       <ul id="seller_center_left_menu">
      	 <?php if(is_array($leftMenu['child']) || $leftMenu['child'] instanceof \think\Collection || $leftMenu['child'] instanceof \think\Paginator): if( count($leftMenu['child'])==0 ) : echo "" ;else: foreach($leftMenu['child'] as $key=>$vu): ?>
           <li class="<?php if(ACTION_NAME == $vu[act] AND CONTROLLER_NAME == $vu[op]): ?>current<?php endif; ?>">
           		<a href="<?php echo U("$vu[op]/$vu[act]"); ?>"> <?php echo $vu['name']; ?></a>
           </li>
	 	<?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
     </div>
   </div>
 </div>
    <div id="layoutRight" class="ncsc-layout-right">
        <div class="ncsc-path"><i class="icon-desktop"></i>商家管理中心<i class="icon-angle-right"></i>统计结算<i class="icon-angle-right"></i>店铺概况</div>
        <div class="main-content" id="mainContent">
            <div class="tabmenu">
                <ul class="tab pngFix">
                    <li class="active"><a href="<?php echo U('Seller/Report/index'); ?>">店铺概况</a></li>
                </ul>
                <a class="ncbtn ncbtn-aqua" style="right:600px">今日销售总额：￥
                    <?php if(empty($today['today_amount']) || (($today['today_amount'] instanceof \think\Collection || $today['today_amount'] instanceof \think\Paginator ) && $today['today_amount']->isEmpty())): ?>0
                        <?php else: ?>
                        <?php echo $today['today_amount']; endif; ?>
                </a>
                <a class="ncbtn ncbtn-mint" style="right:400px"> 人均客单价：￥<?php echo $today['sign']; ?></a>
                <a class="ncbtn ncbtn-aqua" style="right:200px">今日订单数：<?php echo $today['today_order']; ?></a>
                <a class="ncbtn ncbtn-mint"> 今日取消订单：<?php echo $today['cancel_order']; ?></a>
            </div>
            <form method="post" id="search-form2" action="<?php echo U('Report/index'); ?>" onsubmit="check_form();">
                <input type="hidden" name="timegap" id="timegap" value="<?php echo $timegap; ?>">
                <table class="search-form">
                    <tr>
                        <td>&nbsp;</td>
                        <th>开始时间</th>
                        <td class="w100">
                            <input type="text" style="width: 90px;" class="text w90" name="start_time" id="start_time" value="<?php echo $start_time; ?>" placeholder="记录开始时间"/>
                        </td>
                        <th>截止时间</th>
                        <td class="w100">
                            <input type="text" style="width: 90px;" class="text w90" name="end_time" id="end_time" value="<?php echo $end_time; ?>" placeholder="记录截止时间"/>
                        </td>
                        <td class="tc w70">
                            <label class="submit-border"><input type="submit" class="submit" value="搜索"/></label>
                        </td>
                    </tr>
                </table>
            </form>
            <div id="statistics" style="height: 400px;"></div>
            <table class="ncsc-default-table">
                <thead>
                <tr nc_type="table_header">
                    <th class="w200">时间</th>
                    <th class="w100">订单数</th>
                    <th class="w100">销售总额</th>
                    <th class="w100">客单价</th>
                    <th class="w120">查看</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $k=>$vo): ?>
                    <tr class="bd-line">
                        <td><?php echo $vo['day']; ?></td>
                        <td><?php echo $vo['amount']; ?></td>
                        <td><?php echo $vo['sign']; ?></td>
                        <td><?php echo $vo['order_num']; ?></td>
                        <td class="nscs-table-handle">
                        <span><a href="<?php echo U('Report/saleList',array('start_time'=>$vo['day'],'end_time'=>$vo['end'])); ?>" class="btn-bluejeans"><i class="icon-search"></i>

                            <p>订单列表</p></a></span>
                        </td>
                    </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="20">
                        <?php echo $page; ?>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<div id="cti">

  <div class="wrapper">

    <ul>

          </ul>

  </div>

</div>

<div id="faq">

  <div class="wrapper">

      </div>

</div>



<div id="footer">

 <!--  <p><a href="/">首页</a>

                | <a  href="http://www.tpshop.cn">招聘英才</a>

                | <a  href="http://www.tpshop.cn">合作及洽谈</a>

                | <a  href="http://www.tpshop.cn">联系我们</a>

                | <a  href="http://www.tpshop.cn">关于我们</a>

                | <a  href="http://www.tpshop.cn">物流自取</a>

                | <a  href="http://www.tpshop.cn">友情链接</a>

  </p>

  Copyright 2017 <a href="" target="_blank">TPshop商城</a> All rights reserved.<br />本演示来源于

  <a href="http://www.tpshop.cn" target="_blank">www.tpshop.cn</a>   -->

</div>

<script type="text/javascript" src="__PUBLIC__/static/js/jquery.cookie.js"></script>

<link href="__PUBLIC__/static/js/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="__PUBLIC__/static/js/perfect-scrollbar.min.js"></script> 

<script type="text/javascript" src="__PUBLIC__/static/js/qtip/jquery.qtip.min.js"></script>

<link href="__PUBLIC__/static/js/qtip/jquery.qtip.min.css" rel="stylesheet" type="text/css">

<div id="tbox">

  <div class="btn" id="msg"><a href="<?php echo U('Seller/index/store_msg'); ?>"><i class="msg"><?php if(!(empty($storeMsgNoReadCount) || (($storeMsgNoReadCount instanceof \think\Collection || $storeMsgNoReadCount instanceof \think\Paginator ) && $storeMsgNoReadCount->isEmpty()))): ?><em><?php echo $storeMsgNoReadCount; ?></em><?php endif; ?></i>站内消息</a></div>

  <div class="btn" id="im"><i class="im"><em id="new_msg" style="display:none;"></em></i><a href="javascript:void(0);">在线联系</a></div>

  <div class="btn" id="gotop" style="display: block;"><i class="top"></i><a href="javascript:void(0);">返回顶部</a></div>

</div>

<script type="text/javascript">

var current_control = '<?php echo CONTROLLER_NAME; ?>/<?php echo ACTION_NAME; ?>';

$(document).ready(function(){

    //添加删除快捷操作

    $('[nctype="btn_add_quicklink"]').on('click', function() {

        var $quicklink_item = $(this).parent();

        var item = $(this).attr('data-quicklink-act');

        if($quicklink_item.hasClass('selected')) {

            $.post("<?php echo U('Seller/Index/quicklink_del'); ?>", { item: item }, function(data) {

                $quicklink_item.removeClass('selected');

                var idstr = 'quicklink_'+ item;

                $('#'+idstr).remove();

            }, "json");

        } else {

            var scount = $('#quicklink_list').find('dd.selected').length;

            if(scount >= 8) {

                layer.msg('快捷操作最多添加8个', {icon: 2,time: 2000});

            } else {

                $.post("<?php echo U('Seller/Index/quicklink_add'); ?>", { item: item }, function(data) {

                    $quicklink_item.addClass('selected');

                    if(current_control=='Index/index'){

                        var $link = $quicklink_item.find('a');

                        var menu_name = $link.text();

                        var menu_link = $link.attr('href');

                        var menu_item = '<li id="quicklink_' + item + '"><a href="' + menu_link + '">' + menu_name + '</a></li>';

                        $(menu_item).appendTo('#seller_center_left_menu').hide().fadeIn();

                    }

                }, "json");

            }

        }

    });

    //浮动导航  waypoints.js

    $("#sidebar,#mainContent").waypoint(function(event, direction) {

        $(this).parent().toggleClass('sticky', direction === "down");

        event.stopPropagation();

        });

    });

    // 搜索商品不能为空

    $('input[nctype="search_submit"]').click(function(){

        if ($('input[nctype="search_text"]').val() == '') {

            return false;

        }

    });



	function fade() {

		$("img[rel='lazy']").each(function () {

			var $scroTop = $(this).offset();

			if ($scroTop.top <= $(window).scrollTop() + $(window).height()) {

				$(this).hide();

				$(this).attr("src", $(this).attr("data-url"));

				$(this).removeAttr("rel");

				$(this).removeAttr("name");

				$(this).fadeIn(500);

			}

		});

	}

	if($("img[rel='lazy']").length > 0) {

		$(window).scroll(function () {

			fade();

		});

	};

	fade();

	

    function delfunc(obj){

    	layer.confirm('确认删除？', {

    		  btn: ['确定','取消'] //按钮

    		}, function(){

    		    // 确定

   				$.ajax({

   					type : 'post',

   					url : $(obj).attr('data-url'),

   					data : {act:'del',del_id:$(obj).attr('data-id')},

   					dataType : 'json',

   					success : function(data){

                        layer.closeAll();

   						if(data==1){

   							layer.msg('操作成功', {icon: 1});

   							$(obj).parent().parent().parent().remove();

   						}else{

   							layer.msg(data, {icon: 2,time: 2000});

   						}

   					}

   				})

    		}, function(index){

    			layer.close(index);

    			return false;// 取消

    		}

    	);

    }

</script>
<script src="__PUBLIC__/js/echart/echarts.min.js" type="text/javascript"></script>
<script src="__PUBLIC__/js/echart/macarons.js"></script>
<script src="__PUBLIC__/js/echart/china.js"></script>
<script src="__PUBLIC__/dist/js/app.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {        
        
    // 起始位置日历控件
	laydate.skin('molv');//选择肤色
	laydate({
	  elem: '#start_time',
	  format: 'YYYY-MM-DD', // 分隔符可以任意定义，该例子表示只显示年月
	  festival: true, //显示节日
	  istime: false,
	  choose: function(datas){ //选择日期完毕的回调
		 compare_time($('#start_time').val(),$('#end_time').val());
	  }
	});
	 
	 // 结束位置日历控件
	laydate({
	  elem: '#end_time',
	  format: 'YYYY-MM-DD', // 分隔符可以任意定义，该例子表示只显示年月
	  festival: true, //显示节日
	  istime: false,
	  choose: function(datas){ //选择日期完毕的回调
		   compare_time($('#start_time').val(),$('#end_time').val());
	  }
	});	 
	        
        
        
    });
    function check_form() {
        var start_time = $.trim($('#start_time').val());
        var end_time = $.trim($('#end_time').val());
        if (start_time == '' ^ end_time == '') {
            layer.alert('请选择完整的时间间隔', {icon: 2});
            return false;
        }
        if (start_time !== '' && end_time !== '') {
            $('#timegap').val(start_time + " - " + end_time);
        }
        if (start_time == '' && end_time == '') {
            $('#timegap').val('');
        }
    }
    var res = <?php echo $result; ?>;
    var myChart = echarts.init(document.getElementById('statistics'), 'macarons');
    option = {
        tooltip: {
            trigger: 'axis'
        },
        toolbox: {
            show: true,
            feature: {
                mark: {show: true},
                dataView: {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        calculable: true,
        legend: {
            data: ['交易金额', '订单数', '客单价']
        },
        xAxis: [
            {
                type: 'category',
                data: res.time
            }
        ],
        yAxis: [
            {
                type: 'value',
                name: '金额',
                axisLabel: {
                    formatter: '{value} ￥'
                }
            },
            {
                type: 'value',
                name: '客单价',
                axisLabel: {
                    formatter: '{value} ￥'
                }
            }
        ],
        series: [
            {
                name: '交易金额',
                type: 'bar',
                data: res.amount
            },
            {
                name: '订单数',
                type: 'bar',
                data: res.order
            },
            {
                name: '客单价',
                type: 'line',
                yAxisIndex: 1,
                data: res.sign
            }
        ]
    };
    myChart.setOption(option);
</script>
</body>
</html>