<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:48:"./application/seller/new/order/virtual_list.html";i:1531973016;s:41:"./application/seller/new/public/head.html";i:1531973016;s:41:"./application/seller/new/public/left.html";i:1531973016;s:41:"./application/seller/new/public/foot.html";i:1531973016;}*/ ?>
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
    <div class="ncsc-path"><i class="icon-desktop"></i>商家管理中心<i class="icon-angle-right"></i>订单物流<i class="icon-angle-right"></i>虚拟兑码订单</div>
    <div class="main-content" id="mainContent">
      
<div class="tabmenu">
  <ul class="tab pngFix">
  <li class="<?php if($pay_status == -1): ?>active<?php else: ?>normal<?php endif; ?>"><a  href="<?php echo U('Order/virtual_list'); ?>">所有订单</a></li>
  <li class="<?php if($pay_status == 0): ?>active<?php else: ?>normal<?php endif; ?>"><a  href="<?php echo U('Order/virtual_list',array('pay_status'=>0)); ?>">待付款</a></li>
  <li class="<?php if($pay_status == 1): ?>active<?php else: ?>normal<?php endif; ?>"><a  href="<?php echo U('Order/virtual_list',array('pay_status'=>1)); ?>">已付款</a></li>
  <li class="<?php if($pay_status == 4): ?>active<?php else: ?>normal<?php endif; ?>"><a  href="<?php echo U('Order/virtual_list',array('order_status'=>4)); ?>">已完成</a></li>
  <li class="<?php if($pay_status == 3): ?>active<?php else: ?>normal<?php endif; ?>"><a  href="<?php echo U('Order/virtual_list',array('order_status'=>3)); ?>">已取消</a></li></ul>
  <a href="<?php echo U('verify_code'); ?>" class="ncbtn ncbtn-bittersweet"><i class="icon-edit"></i>兑换兑换码</a> </div>
  <form method="get" action="<?php echo U('seller/Order/virtual_list'); ?>" target="_self">
  <table class="search-form">
     <tr>
      <td>&nbsp;</td>
      <th>下单时间</th>
      <td class="w378">
      	<input type="text" class="text w70" name="add_time_begin" id="add_time_begin" value="<?php echo $begin; ?>" />
      	<label class="add-on"><i class="icon-calendar"></i></label>&nbsp;&#8211;&nbsp;
      	<input id="add_time_end" class="text w70" type="text" name="add_time_end" value="<?php echo $end; ?>" />
      	<label class="add-on"><i class="icon-calendar"></i></label>
      </td>
      <th>手机号</th>
      <td class="w100"><input type="text" class="text w80" name="mobile" value="<?php echo $_GET['mobile']; ?>" /></td>
      <th>订单编号</th>
      <td class="w160"><input type="text" class="text w150" name="order_sn" value="<?php echo $_GET['order_sn']; ?>" /></td>
      <td class="w70 tc"><label class="submit-border">
          <input type="submit" class="submit" value="搜索" />
        </label></td>
    </tr>
  </table>
   <input type="hidden" name="pay_status" value="<?php echo $_GET['pay_status']; ?>" />
</form>
<table class="ncsc-default-table order">
  <thead>
    <tr>
      <th class="w10"></th>
      <th colspan="2">商品</th>
      <th class="w100">单价（元）</th>
      <th class="w40">数量</th>
      <th class="w110">买家</th>
      <th class="w120">订单金额</th>
      <th class="w100">交易状态</th>
      <th class="w150">交易操作</th>
    </tr>
  </thead>
  	<?php if(is_array($orderList) || $orderList instanceof \think\Collection || $orderList instanceof \think\Paginator): if( count($orderList)==0 ) : echo "" ;else: foreach($orderList as $key=>$vo): ?>
      <tbody>
    <tr><td colspan="20" class="sep-row"></td></tr>
    <tr>
      <th colspan="20"><span class="ml10">订单编号：<em><?php echo $vo['order_sn']; ?></em>
      </span> <span>下单时间：<em class="goods-time"><?php echo date('Y-m-d H:i:s',$vo['add_time']); ?></em></span> </th>
    </tr>
    <?php $goodsList = $goodsArr[$vo['order_id']]; if(is_array($goodsList) || $goodsList instanceof \think\Collection || $goodsList instanceof \think\Paginator): $k = 0; $__LIST__ = $goodsList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good): $mod = ($k % 2 );++$k;?>
    <tr>
      <td class="bdl"></td>
      <td class="w70"><div class="ncsc-goods-thumb">
      <a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$good['goods_id'])); ?>" target="_blank"><img src="<?php echo goods_thum_images($good['goods_id'],240,240); ?>"/></a></div></td>
      <td class="tl">
      	<dl class="goods-name">
          <dt><a target="_blank" href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$good['goods_id'])); ?>"><?php echo $good['goods_name']; ?></a></dt>
          <dd><?php echo $good['spec_key_name']; ?></dd>
        </dl>
      </td>
      <td><p><?php echo $good['goods_price']; ?></p></td>
      <td><?php echo $good['goods_num']; ?></td>
      <td class="bdl"><div class="buyer"><?php echo $userArr[$vo[user_id]]; ?><p member_id="3"></p>
          <div class="buyer-info"><em></em>
            <div class="con">
              <h3><i></i><span>联系信息</span></h3>
              <dl><dt>姓名：</dt><dd><?php echo $vo['consignee']; ?></dd></dl>
              <dl><dt>电话：</dt><dd><?php echo $vo['mobile']; ?></dd></dl>
            </div>
          </div>
        </div>
      </td>
      <td class="bdl"><p class="ncsc-order-amount"><?php echo $vo['total_amount']; ?></p>
      <p class="goods-pay" title="支付方式："></p></td>
      <td class="bdl bdr">
      	<p><?php if($vo[pay_status] == 0): ?>未支付<?php else: ?>已支付<?php endif; ?></p>
      	<?php if($vo['order_status'] == 3): ?><p>已取消</p><?php endif; ?>
        <!-- 订单查看 -->
        <p><a href="<?php echo U('Order/virtual_info',array('order_id'=>$vo[order_id])); ?>" target="_blank">订单详情</a></p>
      </td>
      <td class="bdl bdr"><!-- 取消订单 -->
      	 <?php if(($vo[order_status] == 0) && (time() - $vo['add_time'] < (86400 * 90))): ?>
         	<p><a href="javascript:void(0)" onclick="virtual_cancel(this)" class="ncbtn ncbtn-grapefruit mt5" data-url="<?php echo U('Order/virtual_cancel',array('order_id'=>$vo[order_id])); ?>"/><i class="icon-remove-circle"></i>取消订单</a></p>
      	<?php endif; ?>
      </td>
      </tr>
      <?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
      <?php endforeach; endif; else: echo "" ;endif; ?>
  	  <tfoot>
        <tr>
      	<td colspan="20"><?php echo $page; ?></td>
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
<script>
$(document).ready(function(){	 
 	$('#add_time_begin').layDate(); 
 	$('#add_time_end').layDate();
});

function virtual_cancel(obj){
    layer.open({
        type: 2,
        title: '取消订单',
        shadeClose: true,
        shade: 0.2,
        area: ['420px', '330px'],
        skin: 'layui-layer-rim',
        content: [$(obj).attr('data-url'),'no'], 
    });
}

    // 起始位置日历控件
	laydate.skin('molv');//选择肤色
	laydate({
	  elem: '#add_time_begin',
	  format: 'YYYY-MM-DD', // 分隔符可以任意定义，该例子表示只显示年月
	  festival: true, //显示节日
	  istime: false,
	  choose: function(datas){ //选择日期完毕的回调
		 compare_time($('#add_time_begin').val(),$('#add_time_end').val());
	  }
	});
	 
	 // 结束位置日历控件
	laydate({
	  elem: '#add_time_end',
	  format: 'YYYY-MM-DD', // 分隔符可以任意定义，该例子表示只显示年月
	  festival: true, //显示节日
	  istime: false,
	  choose: function(datas){ //选择日期完毕的回调
		   compare_time($('#add_time_begin').val(),$('#add_time_end').val());
	  }
	});	 
	
</script>
</body>
</html>
