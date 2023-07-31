<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:50:"./application/seller/new/plugin/shipping_list.html";i:1532228866;s:41:"./application/seller/new/public/head.html";i:1532228866;s:41:"./application/seller/new/public/left.html";i:1532228866;s:41:"./application/seller/new/public/foot.html";i:1532228866;}*/ ?>
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
        <div class="ncsc-path"><i class="icon-desktop"></i>商家管理中心<i class="icon-angle-right"></i>发货设置<i class="icon-angle-right"></i><?php echo $plugin['name']; ?>
        </div>
        <div class="main-content" id="mainContent">
            <div class="tabmenu">
                <ul class="tab pngFix">
                    <li class="active"><a><?php echo $plugin['name']; ?>配送列表</a></li>
                </ul>
                <a href="<?php echo U('Plugin/shipping_list_edit',array('id'=>$list[shipping_area_id],'type'=>$plugin['type'],'code'=>$plugin['code'])); ?>" class="ncbtn ncbtn-mint" title="添加配送区">添加配送区</a>
            </div>
            <form method="post" id="addEditGoodsForm">
                <table class="ncsc-default-table">
                    <thead>
                    <tr>
                        <th class="w20"></th>
                        <th class="w200 tl">配送区名称 </th>
                        <th class="w200 tl">配送区域 </th>
                        <th class="w100">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($shipping_list) || $shipping_list instanceof \think\Collection || $shipping_list instanceof \think\Paginator): $i = 0; $__LIST__ = $shipping_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
                        <tr class="bd-line">
                            <td></td>
                            <td class="tl"><?php echo $list['shipping_area_name']; ?></td>
                            <td class="tl"><?php echo $list['region_list']; if($list['is_default'] == 1): ?>全国其他地区<?php endif; ?></td>
                            <td class="nscs-table-handle">
                                <span><a href="<?php echo U('Plugin/shipping_list_edit',array('id'=>$list[shipping_area_id],'type'=>$plugin['type'],'code'=>$plugin['code'],'edit'=>1,'default'=>$list['is_default'])); ?>" class="btn-bluejeans"><i class="icon-edit"></i><p>编辑</p></a></span>
                                <?php if($list['is_default'] != 1): ?>
                                <span><a data-href="<?php echo U('Plugin/del_area',array('id'=>$list[shipping_area_id],'type'=>$plugin['type'],'code'=>$plugin['code'])); ?>" onclick="del(this)" class="btn-grapefruit"><i class="icon-trash"></i><p>删除</p></a></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </form>
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
    function del(obj) {
        layer.confirm('确认删除？', {
                    btn: ['确定', '取消'] //按钮
                }, function () {
                    // 确定
                    location.href = $(obj).data('href');
                }, function (index) {
                    layer.close(index);
                }
        );
    }
</script>
</body>
</html>
