<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:44:"./application/admin/view2/web/editFloor.html";i:1532661068;s:44:"./application/admin/view2/public/layout.html";i:1532661068;}*/ ?>
<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link href="__PUBLIC__/static/css/main.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/static/css/page.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/static/font/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="__PUBLIC__/static/font/css/font-awesome-ie7.min.css">
<![endif]-->
<link href="__PUBLIC__/static/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
<link href="__PUBLIC__/static/js/perfect-scrollbar.min.css" rel="stylesheet" type="text/css"/>
<style type="text/css">html, body { overflow: visible;}</style>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/layer/layer.js"></script><!-- 弹窗js 参考文档 http://layer.layui.com/-->
<script type="text/javascript" src="__PUBLIC__/static/js/admin.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.validation.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.mousewheel.js"></script>
<script src="__PUBLIC__/js/myFormValidate.js"></script>
<script src="__PUBLIC__/js/myAjax2.js"></script>
<script src="__PUBLIC__/js/global.js"></script>
<script type="text/javascript">
function delfunc(obj){
	layer.confirm('确认删除？', {
		  btn: ['确定','取消'] //按钮
		}, function(){
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
		}
	);
}

function delAll(obj,name){
	var a = [];
	$('input[name*='+name+']').each(function(i,o){
		if($(o).is(':checked')){
			a.push($(o).val());
		}
	})
	if(a.length == 0){
		layer.alert('请选择删除项', {icon: 2});
		return;
	}
	layer.confirm('确认删除？', {btn: ['确定','取消'] }, function(){
			$.ajax({
				type : 'get',
				url : $(obj).attr('data-url'),
				data : {act:'del',del_id:a},
				dataType : 'json',
				success : function(data){
					layer.closeAll();
					if(data == 1){
						layer.msg('操作成功', {icon: 1});
						$('input[name*='+name+']').each(function(i,o){
							if($(o).is(':checked')){
								$(o).parent().parent().remove();
							}
						})
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

//表格列表全选反选
$(document).ready(function(){
	$('.hDivBox .sign').click(function(){
	    var sign = $('#flexigrid > table>tbody>tr');
	   if($(this).parent().hasClass('trSelected')){
	       sign.each(function(){
	           $(this).removeClass('trSelected');
	       });
	       $(this).parent().removeClass('trSelected');
	   }else{
	       sign.each(function(){
	           $(this).addClass('trSelected');
	       });
	       $(this).parent().addClass('trSelected');
	   }
	})
});

//获取选中项
function getSelected(){
	var selectobj = $('.trSelected');
	var selectval = [];
    if(selectobj.length > 0){
        selectobj.each(function(){
        	selectval.push($(this).attr('data-id'));
        });
    }
    return selectval;
}

function selectAll(name,obj){
    $('input[name*='+name+']').prop('checked', $(obj).checked);
}   

function get_help(obj){
    layer.open({
        type: 2,
        title: '帮助手册',
        shadeClose: true,
        shade: 0.3,
        area: ['70%', '80%'],
        content: $(obj).attr('data-url'), 
    });
}
</script>
</head>

<script type="text/javascript" src="__PUBLIC__/js/dialog/dialog.js" id="dialog_js"></script>

</head>

<body style="background-color: #FFF; overflow: auto;">

<div id="append_parent"></div>

<div id="ajaxwaitid"></div>

<div class="page">

  <div class="fixed-bar">

    <div class="item-title"><a class="back" href="<?php echo U('Web/floorList'); ?>" title="返回板块区列表"><i class="fa fa-arrow-circle-o-left"></i></a>

      <div class="subject">

        <h3>首页管理 - 设计“红色”板块</h3>

        <h5>商城首页模板及广告设计</h5>

      </div>

    </div>

  </div>

  <!-- 操作说明 -->

  <div class="explanation" id="explanation">

    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>

      <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>

      <span id="explanationZoom" title="收起提示"></span> </div>

    <ul>

      <li>所有相关设置完成，使用底部的“更新板块内容”前台展示页面才会变化。</li>

      <li>左侧的“推荐分类”没有个数限制，但是如果太多会不显示(已选择的子分类可以拖动进行排序，单击选中，双击删除)。</li>

      <li>中部的“商品推荐模块”由于页面宽度只能加5个，商品数为10个；右侧的品牌最多为10个(已选择的可以拖动进行排序，单击选中，双击删除)。</li>

    </ul>

  </div>

  <div class="ncap-form-all">

    <dl class="row">

      <dt class="tit">

        <label>板块内容设置：</label>

        <label>色彩风格:<?php echo $web_config['web_name']; ?></label>

        <label><a href="<?php echo U('Web/settingFloor',array('web_id'=>$web_config[web_id])); ?>">设置该板块色彩</a></label>

      </dt>

      <dd class="opt">

        <div class="home-templates-board-layout style-<?php echo $web_config['style_name']; ?>">

          <div class="left">

            <dl id="left_tit">

              <dt>

                <h4>标题图片</h4>

                <a href="JavaScript:show_dialog('upload_tit');"><i class="fa fa-pencil-square-o"></i>编辑</a></dt>

            <dd class="tit-txt" >

                <div id="picture_floor" class="txt-type">

                    <span><?php echo $block_tit[block_info][floor]; ?></span>

                    <h2><?php echo $block_tit[block_info][title]; ?></h2>

                </div>

            </dd>

            <dd class="tit-pic" <?php if(empty($block_tit[block_info][pic])): ?>hidden<?php endif; ?>>

                <div id="picture_tit" class="picture"> <img src="<?php echo $block_tit[block_info][pic]; ?>"/> </div>

            </dd>

            </dl>

            <dl>

              <dt>

                <h4>活动图片</h4>

                <a href="JavaScript:show_dialog('upload_act');"><i class="fa fa-picture-o"></i>编辑</a></dt>

              <dd class="act-pic">

                <div id="picture_act" class="picture">

                   <img src="<?php echo $block_act[block_info][pic]; ?>"/>

                </div>

              </dd>

            </dl>

            <dl>

              <dt>

                <h4>推荐分类</h4><a href="JavaScript:show_dialog('category_list');"><i class="icon-th"></i>编辑</a></dt>

              <dd class="category-list">

                    <ul>

                       <?php if(is_array($block_category_list[block_info][goods_class]) || $block_category_list[block_info][goods_class] instanceof \think\Collection || $block_category_list[block_info][goods_class] instanceof \think\Paginator): if( count($block_category_list[block_info][goods_class])==0 ) : echo "" ;else: foreach($block_category_list[block_info][goods_class] as $key=>$vv): ?>

                       <li title="<?php echo $vv['gc_name']; ?>"><a href="javascript:void(0);"><?php echo $vv['gc_name']; ?></a></li>

                       <?php endforeach; endif; else: echo "" ;endif; ?>

                    </ul>

              </dd>

            </dl>

          </div>

          <div class="middle">

            <div>

               <dl recommend_id="11111" class="ui-sortable-handle">

                <dt>

                  <h4>精选推荐</h4>

                  <!--<a href="JavaScript:del_recommend(1);"><i class="fa fa-ban"></i>显示</a>--> 

                  <!--<a href="JavaScript:show_recommend_pic_dialog(1);"><i class="fa fa-pencil-square-o"></i>编辑广告</a>-->

                  <!--<a href="JavaScript:toggle_theme();"><i class="fa fa-refresh"></i>切换样式</a>-->

                  </dt>

                <dd>

                <div class="middle-banner" id="bestgoods">

                  <?php if(empty($block_adv[block_info]) || (($block_adv[block_info] instanceof \think\Collection || $block_adv[block_info] instanceof \think\Paginator ) && $block_adv[block_info]->isEmpty())): ?>

                  	 <script>toggle_theme();</script>

                  <?php else: if(is_array($block_adv[block_info]) || $block_adv[block_info] instanceof \think\Collection || $block_adv[block_info] instanceof \think\Paginator): if( count($block_adv[block_info])==0 ) : echo "" ;else: foreach($block_adv[block_info] as $ak=>$adv): ?>          

                  <a href="javascript:;" onclick="show_adv_dialog(this);" class="<?php echo $adv['adv_class']; ?>" slide_id="<?php echo $ak; ?>" rel="<?php echo $adv['adv_type']; ?>">

                  	 <?php if($adv[adv_type] == 'upload_advbig'): ?>

                  	 <img pic_url="<?php echo $adv[adv_info][1][pic_url]; ?>" title="<?php echo $adv[adv_info][1][pic_name]; ?>" src="<?php echo $adv[adv_info][1][pic_img]; ?>">

                     <?php else: ?>

                     <img pic_url="<?php echo $adv[adv_info][pic_url]; ?>" title="<?php echo $adv[adv_info][pic_name]; ?>" src="<?php echo $adv[adv_info][pic_img]; ?>">

                     <?php endif; ?>

                  </a> 

                  <?php endforeach; endif; else: echo "" ;endif; endif; ?>

                </div>

                </dd>

              </dl>

              <?php if(is_array($block_recommend_list[block_info]) || $block_recommend_list[block_info] instanceof \think\Collection || $block_recommend_list[block_info] instanceof \think\Paginator): if( count($block_recommend_list[block_info])==0 ) : echo "" ;else: foreach($block_recommend_list[block_info] as $rk=>$recg): ?>

              <dl recommend_id="<?php echo $rk; ?>" class="ui-sortable-handle">

                <dt>

                  <h4><?php echo $recg[recommends][name]; ?></h4>

                  <a href="JavaScript:del_recommend(<?php echo $rk; ?>);"><i class="fa fa-trash"></i>删除</a> <a href="JavaScript:show_recommend_dialog(<?php echo $rk; ?>);"><i class="fa fa-shopping-cart"></i>编辑商品</a></dt>

                <dd>

                   <ul class="goods-list">

                   	 <?php if(is_array($recg[goods_list]) || $recg[goods_list] instanceof \think\Collection || $recg[goods_list] instanceof \think\Paginator): if( count($recg[goods_list])==0 ) : echo "" ;else: foreach($recg[goods_list] as $key=>$gd): ?>

                     <li><span><a href="javascript:void(0);"> <img title="<?php echo $gd['goods_name']; ?>" src="<?php echo $gd['goods_pic']; ?>"></a></span> </li>

					 <?php endforeach; endif; else: echo "" ;endif; ?>

                   </ul>

                </dd>

              </dl>

              <?php endforeach; endif; else: echo "" ;endif; ?>

              <div class="add-tab" id="btn_add_list"><a href="JavaScript:add_recommend();"><i class="fa fa-plus"></i>新增商品推荐模块</a>(最多5个)</div>

            </div>

          </div>

		  <div class="hao-btbrand"><dl>

              <dt>

                <h4>推荐品牌</h4>

                <a href="JavaScript:show_dialog('brand_list');"><i class="icon-ticket"></i>编辑</a></dt>

              <dd>

                <ul class="brands">

                  <?php if(is_array($block_brand_list[block_info]) || $block_brand_list[block_info] instanceof \think\Collection || $block_brand_list[block_info] instanceof \think\Paginator): if( count($block_brand_list[block_info])==0 ) : echo "" ;else: foreach($block_brand_list[block_info] as $key=>$bd): ?>

                  <li><span><img title="<?php echo $bd['brand_name']; ?>" src="<?php echo $bd['brand_pic']; ?>"/> </span></li>

				  <?php endforeach; endif; else: echo "" ;endif; ?>

                 </ul>

              </dd>

            </dl>

          </div>

        </div>

      </dd>

    </dl>

  </div>

  <div class="bot"><a href="" class="ncap-btn-big ncap-btn-green" id="submitBtn">更新板块内容</a> </div>

</div>



<!-- 标题图片 -->

<div id="upload_tit_dialog" style="display:none;">

  <div class="s-tips"><i class="fa fa-lightbulb-o"></i>请按照操作注释要求，上传设置板块区域左上角的标题图片。</div>

  <form id="upload_tit_form" name="upload_tit_form" enctype="multipart/form-data" method="post" action="<?php echo U('Web/uploadPic'); ?>" target="upload_pic">

    <input type="hidden" name="web_id" value="<?php echo $block_tit['web_id']; ?>">

    <input type="hidden" name="block_id" value="<?php echo $block_tit['block_id']; ?>">

    <input type="hidden" name="tit[pic]" value="">

    <input type="hidden" name="tit[url]" value="">

    <div class="ncap-form-default">

      <dl class="row">

        <dt class="tit">选择类型：</dt>

        <dd class="opt">

          <label title="图片上传">

            <input type="radio" name="tit[type]" value="pic" onclick="upload_type('tit');" >

            <span>图片上传</span></label>

          <label title="文字类型">

            <input type="radio" name="tit[type]" value="txt" onclick="upload_type('tit');" checked="checked">

            <span>文字类型</span></label>

          <p class="notic"></p>

        </dd>

      </dl>

      <dl id="upload_tit_type_pic" class="row" style="display:none;">

        <dt class="tit">标题图片上传：</dt>

        <dd class="opt">

          <div class="input-file-show"> <span class="type-file-box">

            <input type='text' name='textfield' id='textfield1' class='type-file-text' />

            <input type='button' name='button' id='button1' value='选择上传...' class='type-file-button' />

            <input name="pic" id="pic" type="file" class="type-file-file" size="30">

            </span></div>

          <p class="notic">建议上传宽210*高40像素GIF\JPG\PNG格式图片，超出规定范围的图片部分将被自动隐藏。</p>

        </dd>

      </dl>

      <div id="upload_tit_type_txt" >

        <dl class="row">

          <dt class="tit">楼层编号</dt>

          <dd class="opt">

            <input class="input-txt" type="text" name="tit[floor]" id="tit_floor" value="<?php echo $block_tit[block_info][floor]; ?>">

            <p class="notic">如1F、2F、3F。</p>

          </dd>

        </dl>

        <dl class="row">

          <dt class="tit">版块标题</dt>

          <dd class="opt">

            <input class="input-txt" type="text" name="tit[title]" id="tit_title" value="<?php echo $block_tit[block_info][title]; ?>">

            <p class="notic">如鞋包配饰、男女服装、运动户外。</p>

          </dd>

        </dl>

      </div>

      <div class="bot"><a href="JavaScript:void(0);" onclick="$('#upload_tit_form').submit();" class="ncap-btn-big ncap-btn-green">确认提交</a></div>

    </div>

  </form>

</div>





<!-- 推荐分类模块 -->

<div id="category_list_dialog" style="display:none;">

  <div class="s-tips"><i class="fa fa-lightbulb-o"></i>小提示：双击分类名称可删除不想显示的分类</div>

  <form id="category_list_form">

    <input type="hidden" name="web_id" value="<?php echo $block_category_list['web_id']; ?>">

    <input type="hidden" name="block_id" value="<?php echo $block_category_list['block_id']; ?>">

    <div class="ncap-form-all">

      <dl class="row">

        <dt class="tit">已选商品分类</dt>

        <dd class="opt">

          <div class="category-list category-list-edit">

            <ul>

            	<?php if(is_array($block_category_list[block_info][goods_class]) || $block_category_list[block_info][goods_class] instanceof \think\Collection || $block_category_list[block_info][goods_class] instanceof \think\Paginator): if( count($block_category_list[block_info][goods_class])==0 ) : echo "" ;else: foreach($block_category_list[block_info][goods_class] as $key=>$vv): ?>

                <li gc_id="<?php echo $vv['gc_id']; ?>" gc_name="<?php echo $vv['gc_name']; ?>" title="<?php echo $vv['gc_name']; ?>" ondblclick="del_goods_class(<?php echo $vv['gc_id']; ?>);"><i onclick="del_goods_class(<?php echo $vv['gc_id']; ?>);"></i><?php echo $vv['gc_name']; ?>    

                <input name="category_list[goods_class][<?php echo $vv['gc_id']; ?>][gc_id]" value="<?php echo $vv['gc_id']; ?>" type="hidden">

                <input name="category_list[goods_class][<?php echo $vv['gc_id']; ?>][gc_name]" value="<?php echo $vv['gc_name']; ?>" type="hidden">

                 </li>

                 <?php endforeach; endif; else: echo "" ;endif; ?>

               </ul>

          </div>

        </dd>

      </dl>

      <dl class="row">

        <dt class="tit">添加推荐分类</dt>

        <dd class="opt">

        	<div class="search-bar">商品分类：

          	 <select name="gc_parent_id" id="gc_parent_id" onblur="get_goods_class();">

                 <option value="0">-请选择-</option>

                 <?php if(is_array($parent_goods_class) || $parent_goods_class instanceof \think\Collection || $parent_goods_class instanceof \think\Paginator): if( count($parent_goods_class)==0 ) : echo "" ;else: foreach($parent_goods_class as $key=>$pgc): ?>

                 <option value="<?php echo $pgc['id']; ?>"><?php echo $pgc['name']; ?></option>

                 <?php endforeach; endif; else: echo "" ;endif; ?>

             </select>

           </div>

          <p class="notic">从分类下拉菜单中选择该板块要推荐的分类，选择父级分类将包含子分类。</p>

        </dd>

      </dl>

    </div>

    <div class="bot"><a href="JavaScript:void(0);" onclick="update_category();" class="ncap-btn-big ncap-btn-green">保存</a></div>

  </form>

</div>

<!-- 活动图片 -->

<div id="upload_act_dialog" class="upload_act_dialog" style="display:none;">

  <div class="s-tips"><i class="fa fa-lightbulb-o"></i>请按照操作注释要求，上传设置板块区域左侧的活动图片。</div>

  <form id="upload_act_form" name="upload_act_form" enctype="multipart/form-data" method="post" action="<?php echo U('Web/uploadPic'); ?>" target="upload_pic">

    <input type="hidden" name="web_id" value="<?php echo $block_act['web_id']; ?>">

    <input type="hidden" name="block_id" value="<?php echo $block_act['block_id']; ?>">

    <input type="hidden" name="act[pic]" value="<?php echo $block_act[block_info][pic]; ?>">

    <input type="hidden" name="act[type]" value="pic">

    <div class="ncap-form-default" id="upload_act_type_pic" >

      <dl class="row">

        <dt class="tit">活动名称</dt>

        <dd class="opt">

          <input class="input-txt" type="text" name="act[title]" value="<?php echo $block_act[block_info][title]; ?>">

          <p class="notic"></p>

        </dd>

      </dl>

      <dl class="row">

        <dt class="tit">

          <label>图片跳转链接：</label>

        </dt>

        <dd class="opt">

          <input name="act[url]" value="<?php echo $block_act[block_info][url]; ?>" class="input-txt" type="text">

          <p class="notic">输入以http://开头的网址作为点击该图片后所要跳转的链接地址。</p>

        </dd>

      </dl>

      <dl class="row">

        <dt class="tit">

          <label>活动图片上传</label>

        </dt>

        <dd class="opt">

          <div class="input-file-show"><span class="type-file-box">

            <input type='text' name='textfield' id='textfield1' class='type-file-text' />

            <input type='button' name='button' id='button1' value='选择上传...' class='type-file-button' />

            <input name="pic" id="pic" type="file" class="type-file-file" size="30">

            </span></div>

          <p class="notic">建议上传宽212*高280像素GIF\JPG\PNG格式图片，超出规定范围的图片部分将被自动隐藏。</p>

        </dd>

      </dl>

      <dl class="row">

        <dt class="tit">促销名称一</dt>

        <dd class="opt">

          <input class="input-txt" type="text" name="act[titlea]" value="<?php echo $block_act[block_info][titlea]; ?>">

          <p class="notic"></p>

        </dd>

      </dl>

      <dl class="row">

        <dt class="tit">

          <label>促销连接一</label>

        </dt>

        <dd class="opt">

          <input name="act[urla]" value="<?php echo $block_act[block_info][urla]; ?>" class="input-txt" type="text">

          <p class="notic">输入以http://开头的网址作为点击该图片后所要跳转的链接地址。</p>

        </dd>

      </dl>

      <dl class="row">

        <dt class="tit">促销名称二</dt>

        <dd class="opt">

          <input class="input-txt" type="text" name="act[titleb]" value="<?php echo $block_act[block_info][titleb]; ?>">

          <p class="notic"></p>

        </dd>

      </dl>

      <dl class="row">

        <dt class="tit">

          <label>促销连接二</label>

        </dt>

        <dd class="opt">

          <input name="act[urlb]" value="<?php echo $block_act[block_info][urlb]; ?>" class="input-txt" type="text">

          <p class="notic">输入以http://开头的网址作为点击该图片后所要跳转的链接地址。</p>

        </dd>

      </dl>

      <div class="bot"><a href="JavaScript:void(0);" onclick="$('#upload_act_form').submit();" class="ncap-btn-big ncap-btn-green">确认提交</a></div>

    </div>

  </form>

</div>

<!-- 商品推荐模块 -->

<div id="recommend_list_dialog" style="display:none;">

  <div class="s-tips"><i></i>小提示：单击查询出的商品选中，双击已选择的可以删除，最多10个，保存后生效。</div>

  <form id="recommend_list_form">

    <input type="hidden" name="web_id" value="<?php echo $block_recommend_list['web_id']; ?>">

    <input type="hidden" name="block_id" value="<?php echo $block_recommend_list['block_id']; ?>">

    <div id="recommend_input_list" style="display:none;"><!-- 推荐拖动排序 --></div>

    <?php if(is_array($block_recommend_list[block_info]) || $block_recommend_list[block_info] instanceof \think\Collection || $block_recommend_list[block_info] instanceof \think\Paginator): if( count($block_recommend_list[block_info])==0 ) : echo "" ;else: foreach($block_recommend_list[block_info] as $rk=>$recg): ?>

    <div class="ncap-form-default" select_recommend_id="<?php echo $rk; ?>">

      <dl class="row">

        <dt class="tit"> 商品推荐模块标题名称</dt>

        <dd class="opt">

          <input name="recommend_list[<?php echo $rk; ?>][recommend][name]" value="<?php echo $recg[recommends][name]; ?>" type="text" class="input-txt">

          <p class="notic">修改该区域中部推荐商品模块选项卡名称，控制名称字符在4-8字左右，超出范围自动隐藏</p>

        </dd>

      </dl>

    </div>

    <div class="ncap-form-all" select_recommend_id="<?php echo $rk; ?>">

      <dl class="row">

        <dt class="tit">推荐商品</dt>

        <dd class="opt">

          <ul class="dialog-goodslist-s1 goods-list">

          	<?php if(is_array($recg[goods_list]) || $recg[goods_list] instanceof \think\Collection || $recg[goods_list] instanceof \think\Paginator): if( count($recg[goods_list])==0 ) : echo "" ;else: foreach($recg[goods_list] as $gk=>$gd): ?>

            <li id="select_recommend_<?php echo $reck; ?>_goods_<?php echo $gk; ?>">

              <div ondblclick="del_recommend_goods(<?php echo $gk; ?>);" class="goods-pic"> <span class="ac-ico" onclick="del_recommend_goods(<?php echo $gk; ?>);"></span> 

              <span class="thumb size-72x72"><i></i><img select_goods_id="<?php echo $gk; ?>" title="<?php echo $gd['goods_name']; ?>" src="<?php echo $gd['goods_pic']; ?>" onload="javascript:DrawImage(this,72,72);" /></span></div>

              <div class="goods-name"><a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$gk)); ?>" target="_blank"><?php echo $gd['goods_name']; ?></a></div>

              <input name="recommend_list[<?php echo $rk; ?>][goods_list][<?php echo $gk; ?>][goods_id]" value="<?php echo $gk; ?>" type="hidden">

              <input name="recommend_list[<?php echo $rk; ?>][goods_list][<?php echo $gk; ?>][market_price]" value="<?php echo $gd['market_price']; ?>" type="hidden">

              <input name="recommend_list[<?php echo $rk; ?>][goods_list][<?php echo $gk; ?>][goods_name]" value="<?php echo $gd['goods_name']; ?>" type="hidden">

              <input name="recommend_list[<?php echo $rk; ?>][goods_list][<?php echo $gk; ?>][goods_price]" value="<?php echo $gd['goods_price']; ?>" type="hidden">

              <input name="recommend_list[<?php echo $rk; ?>][goods_list][<?php echo $gk; ?>][goods_pic]" value="<?php echo $gd['goods_pic']; ?>" type="hidden">

              <input name="recommend_list[<?php echo $rk; ?>][goods_list][<?php echo $gk; ?>][pay_points]" value="<?php echo $gd['pay_points']; ?>" type="hidden">

            </li>

            <?php endforeach; endif; else: echo "" ;endif; ?>

            </ul>

        </dd>

      </dl>

    </div>

    <?php endforeach; endif; else: echo "" ;endif; ?>

    <div id="add_recommend_list" style="display:none;"></div>

    <div class="ncap-form-all">

      <dl class="row">

        <dt class="tit">选择要展示的推荐商品</dt>

        <dd class="opt">

          <div class="search-bar">

            <label id="recommend_gcategory">商品分类

              <select onclick="get_category2(this.value,1);">

                <option value="0">-请选择-</option>

                <?php if(is_array($goods_class) || $goods_class instanceof \think\Collection || $goods_class instanceof \think\Paginator): if( count($goods_class)==0 ) : echo "" ;else: foreach($goods_class as $key=>$vg): ?>

                <option value="<?php echo $vg['id']; ?>"><?php echo $vg['name']; ?></option>

                <?php endforeach; endif; else: echo "" ;endif; ?>

               </select>

            </label>

            <input type="text" value="" name="recommend_goods_name" id="recommend_goods_name" placeholder="输入商品名称或SKU编号" class="txt w150">

            <a href="JavaScript:void(0);" onclick="get_recommend_goods();" class="ncap-btn">查询</a></div>

          <div id="show_recommend_goods_list" class="show-recommend-goods-list"></div>

        </dd>

      </dl>

    </div>

    <div class="bot"><a href="JavaScript:void(0);" onclick="update_recommend();" class="ncap-btn-big ncap-btn-green"><span>保存</span></a></div>

  </form>

</div>

<!-- 品牌模块 -->

<div id="brand_list_dialog" class="brand_list_dialog" style="display:none;">

  <div class="s-tips"><i class="fa fa-lightbulb-o"></i>小提示：单击候选品牌选中，双击已选择的可以删除，最多10个，保存后生效。</div>

  <form id="brand_list_form">

    <input type="hidden" name="web_id" value="<?php echo $block_brand_list['web_id']; ?>">

    <input type="hidden" name="block_id" value="<?php echo $block_brand_list['block_id']; ?>">

    <div class="ncap-form-all">

      <dl class="row">

        <dt class="tit">已选择品牌</dt>

        <dd class="opt">

          <ul class="brands dialog-brandslist-s1">

           <?php if(is_array($block_brand_list[block_info]) || $block_brand_list[block_info] instanceof \think\Collection || $block_brand_list[block_info] instanceof \think\Paginator): if( count($block_brand_list[block_info])==0 ) : echo "" ;else: foreach($block_brand_list[block_info] as $bk=>$bd): ?>

            <li>

              <div class="brands-pic"><span class="ac-ico" onclick="del_brand(<?php echo $bk; ?>);"></span>

              <span class="thumb size-88x29"><i></i>

              <img ondblclick="del_brand(<?php echo $bk; ?>);" select_brand_id="<?php echo $bk; ?>" src="<?php echo $bd['brand_pic']; ?>" onload="javascript:DrawImage(this,88,30);" /></span></div>

              <div class="brands-name"><?php echo $bd['brand_name']; ?></div>

              <input name="brand_list[<?php echo $bk; ?>][brand_id]" value="<?php echo $bd['brand_id']; ?>" type="hidden">

              <input name="brand_list[<?php echo $bk; ?>][brand_name]" value="<?php echo $bd['brand_name']; ?>" type="hidden">

              <input name="brand_list[<?php echo $bk; ?>][brand_pic]" value="<?php echo $bd['brand_pic']; ?>" type="hidden">

            </li>

            <?php endforeach; endif; else: echo "" ;endif; ?>

		  </ul>

        </dd>

      </dl>

      <dl class="row">

        <dt class="tit">候选推荐品牌列表</dt>

        <dd class="opt">

          <div class="search-bar">

            <input type="text" value="" name="recommend_brand_name" id="recommend_brand_name" placeholder="请输入品牌名称" class="txt w100">

            <select name="recommend_brand_initial" id="recommend_brand_initial">

              <option value="">首字母</option>

                            <option value="A">A</option>

                            <option value="B">B</option>

                            <option value="C">C</option>

                            <option value="D">D</option>

                            <option value="E">E</option>

                            <option value="F">F</option>

                            <option value="G">G</option>

                            <option value="H">H</option>

                            <option value="I">I</option>

                            <option value="J">J</option>

                            <option value="K">K</option>

                            <option value="L">L</option>

                            <option value="M">M</option>

                            <option value="N">N</option>

                            <option value="O">O</option>

                            <option value="P">P</option>

                            <option value="Q">Q</option>

                            <option value="R">R</option>

                            <option value="S">S</option>

                            <option value="T">T</option>

                            <option value="U">U</option>

                            <option value="V">V</option>

                            <option value="W">W</option>

                            <option value="X">X</option>

                            <option value="Y">Y</option>

                            <option value="Z">Z</option>

                          </select>

            <a href="JavaScript:void(0);" onclick="get_recommend_brand();" class="ncap-btn">查询</a> </div>

          <div id="show_brand_list"></div>

        </dd>

      </dl>

      <div class="bot"> <a href="JavaScript:void(0);" onclick="update_brand();" class="ncap-btn-big ncap-btn-green">保存</a></div>

    </div>

  </form>

</div>

<!-- 切换广告图片 -->

<div id="upload_advbig_dialog" class="upload_adv_dialog" style="display:none;">

  <div class="s-tips"><i class="fa fa-lightbulb-o"></i>小提示：单击图片选中修改，拖动可以排序，最少保留1个，最多可加5个，保存后生效。</div>

  <form id="upload_advbig_form" name="upload_advbig_form" enctype="multipart/form-data" method="post" action="<?php echo U('web/advSave'); ?>" target="upload_pic">

    <input type="hidden" name="web_id" value="<?php echo $block_adv['web_id']; ?>">

    <input type="hidden" name="block_id" value="<?php echo $block_adv['block_id']; ?>">

    <div class="ncap-form-all">

      <dl class="row">

        <dt class="tit">已上传图片</dt>

        <dd class="opt">

          <ul class="adv dialog-adv-s1 advbig_dialog">

          <?php if(is_array($block_adv[block_info]) || $block_adv[block_info] instanceof \think\Collection || $block_adv[block_info] instanceof \think\Paginator): if( count($block_adv[block_info])==0 ) : echo "" ;else: foreach($block_adv[block_info] as $bk=>$bad): if($bad[adv_type] == 'upload_advbig'): if(is_array($bad[adv_info]) || $bad[adv_info] instanceof \think\Collection || $bad[adv_info] instanceof \think\Paginator): $i = 0; $__LIST__ = $bad[adv_info];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>

            <li slide_adv_id="<?php echo $item['pic_id']; ?>">

              <div class="adv-pic">

              	<span class="ac-ico" onclick="del_slide_adv(<?php echo $item['pic_id']; ?>);"></span>

              	<img onclick="select_slide_adv(<?php echo $item['pic_id']; ?>);" title="<?php echo $item['pic_name']; ?>" src="<?php echo (isset($item['pic_img']) && ($item['pic_img'] !== '')?$item['pic_img']:'/public/static/images/picture.gif'); ?>"/>

              </div>

              <input name="adv[<?php echo $item['pic_id']; ?>][pic_id]" value="<?php echo $item['pic_id']; ?>" type="hidden">

              <input name="adv[<?php echo $item['pic_id']; ?>][pic_name]" value="<?php echo $item['pic_name']; ?>" type="hidden">

              <input name="adv[<?php echo $item['pic_id']; ?>][pic_url]" value="<?php echo $item['pic_url']; ?>" type="hidden">

              <input name="adv[<?php echo $item['pic_id']; ?>][pic_img]" value="<?php echo $item['pic_img']; ?>" type="hidden"> 

            </li>

            <?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>

           </ul>

          <a class="ncap-btn" href="JavaScript:add_slide_adv();"><i class="fa fa-plus"></i>新增图片&nbsp;(最多5个)</a></dd>

      </dl>

    </div>

    <div id="upload_slide_advbig" class="ncap-form-default" style="display:none;">

      <dl class="row">

        <dt class="tit">文字标题</dt>

        <dd class="opt">

          <input type="hidden" name="slide_id" value="">

          <input type="hidden" name="pic_id" value="">

          <input type="hidden" name="adv_class" value="">

          <input class="input-txt" type="text" name="slide_pic[pic_name]" value="">

          <p class="notic"></p>

        </dd>

      </dl>

      <dl class="row">

        <dt class="tit">

          <label>图片跳转链接</label>

        </dt>

        <dd class="opt">

          <input name="slide_pic[pic_url]" value="" class="input-txt" type="text">

          <p class="notic"></p>

        </dd>

      </dl>

      <dl class="row">

        <dt class="tit">广告图片上传：</dt>

        <dd class="opt">

          <div class="input-file-show"><span class="type-file-box">

            <input type='text' name='textfield' id='textfield1' class='type-file-text' />

            <input type='button' name='button' id='button1' value='选择上传...' class='type-file-button' />

            <input name="pic" id="pic" type="file" class="type-file-file" size="30">

            </span></div>

          <p class="notic">建议上传宽212*高241像素GIF\JPG\PNG格式图片，超出规定范围的图片部分将被自动隐藏。</p>

        </dd>

      </dl>

      <div class="bot"><a href="JavaScript:void(0);" onclick="$('#upload_advbig_form').submit();" class="ncap-btn-big ncap-btn-green">保存</a></div>

    </div>

  </form>

</div>



<div id="upload_advmin_dialog" class="upload_adv_dialog" style="display:none;">

  <div class="s-tips"><i class="fa fa-lightbulb-o"></i>小提示：单击图片选中修改，保存后生效。</div>

  <form id="upload_advmin_form" name="upload_advmin_form" enctype="multipart/form-data" method="post" action="<?php echo U('web/advSave'); ?>" target="upload_pic">

    <input type="hidden" name="web_id" value="<?php echo $block_adv['web_id']; ?>">

    <input type="hidden" name="block_id" value="<?php echo $block_adv['block_id']; ?>">

    <div class="ncap-form-all">

      <dl class="row">

        <dt class="tit">已上传图片</dt>

        <dd class="opt">

          <ul class="adv dialog-adv-s1 advmin_dialog">

	          <?php if(is_array($block_adv[block_info]) || $block_adv[block_info] instanceof \think\Collection || $block_adv[block_info] instanceof \think\Paginator): if( count($block_adv[block_info])==0 ) : echo "" ;else: foreach($block_adv[block_info] as $mk=>$mad): if($mad[adv_type] == 'upload_advmin'): ?>

	            <li slide_adv_id="<?php echo $mk; ?>" style="display:none;">

	              <div class="adv-pic">

	              	<span class="ac-ico" onclick="del_slide_adv(<?php echo $mk; ?>);"></span>

	              	<img onclick="select_slide_adv(<?php echo $mk; ?>);" title="<?php echo $mad[adv_info][pic_name]; ?>" src="<?php echo $mad[adv_info][pic_img]; ?>"/>

	              </div>

	              <input name="adv[<?php echo $mk; ?>][pic_id]" value="<?php echo $mad[adv_info][pic_id]; ?>" type="hidden">

	              <input name="adv[<?php echo $mk; ?>][pic_name]" value="<?php echo $mad[adv_info][pic_name]; ?>" type="hidden">

	              <input name="adv[<?php echo $mk; ?>][pic_url]" value="<?php echo $mad[adv_info][pic_url]; ?>" type="hidden">

	              <input name="adv[<?php echo $mk; ?>][pic_img]" value="<?php echo $mad[adv_info][pic_img]; ?>" type="hidden"> 

	            </li>

	            <?php endif; endforeach; endif; else: echo "" ;endif; ?>

           </ul>

         </dd>

      </dl>

    </div>

    <div id="upload_slide_advmin" class="ncap-form-default" style="">

      <dl class="row">

        <dt class="tit">文字标题</dt>

        <dd class="opt">

          <input type="hidden" name="slide_id" value="">

          <input type="hidden" name="adv_class" value="">

          <input class="input-txt" type="text" name="slide_pic[pic_name]" value="">

          <p class="notic"></p>

        </dd>

      </dl>

      <dl class="row">

        <dt class="tit">

          <label>图片跳转链接</label>

        </dt>

        <dd class="opt">

          <input name="slide_pic[pic_url]" value="" class="input-txt" type="text">

          <p class="notic"></p>

        </dd>

      </dl>

      <dl class="row">

        <dt class="tit">广告图片上传：</dt>

        <dd class="opt">

          <div class="input-file-show"><span class="type-file-box">

            <input type='text' name='textfield' id='textfield1' class='type-file-text' />

            <input type='button' name='button' id='button1' value='选择上传...' class='type-file-button' />

            <input name="pic" id="pic" type="file" class="type-file-file" size="30">

            </span></div>

          <p class="notic">建议上传宽212*高241像素GIF\JPG\PNG格式图片，超出规定范围的图片部分将被自动隐藏。</p>

        </dd>

      </dl>

      <div class="bot"><a href="JavaScript:void(0);" onclick="$('#upload_advmin_form').submit();" class="ncap-btn-big ncap-btn-green">保存</a></div>

    </div>

  </form>

</div>



<iframe style="display:none;" src="" name="upload_pic"></iframe>

<script src="__PUBLIC__/static/js/waypoints.js"></script>

<script type="text/javascript">

var GET_GOODS_URL="<?php echo U('Web/getGoodsList'); ?>";

var GET_BRAND_URL="<?php echo U('Web/getBrandList'); ?>";

var UPLOAD_SITE_URL = '/public/upload/adv';

function get_category2(id,level) {

    var url = '/index.php?m=Admin&c=Index&a=get_category&parent_id=' + id;

    $.ajax({

        type: "GET",

        url: url,

        error: function (request) {

            layer.alert("服务器繁忙, 请联系管理员!",{icon:2});

            return;

        },

        success: function (v) {

        	if(v != ''){

        		if(level == 1){

        			$('.class-select').remove();

        			v = "<select class='class-select' onchange='get_category2(this.value,2)'><option value='0'>请选择</option>" + v +'<select>';

        		}else{

        			$('.class-select2').remove();

        			v = "<select class='class-select class-select2' onchange='get_category2(this.value,3)'><option value='0'>请选择</option>" + v +'<select>';

        		}

                $('#recommend_gcategory').append(v);

        	}

        }

    });

}

</script>

<script src="__PUBLIC__/static/js/web_block.js"></script>

<div id="goTop"> 

<a href="JavaScript:void(0);" id="btntop"><i class="fa fa-angle-up"></i></a>

<a href="JavaScript:void(0);" id="btnbottom"><i class="fa fa-angle-down"></i></a>

</div>

</body>

</html>