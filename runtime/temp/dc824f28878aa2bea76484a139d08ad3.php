<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:47:"./application/admin/view2/goods/_goodsType.html";i:1532661068;s:44:"./application/admin/view2/public/layout.html";i:1532661068;}*/ ?>
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
<body style="background-color: #FFF; overflow: auto;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title"><a class="back" href="javascript:history.back();" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
      <div class="subject">
        <h3>类型关联 - 添加修改模型</h3>
        <h5>添加修改模型</h5>
      </div>
    </div>
  </div>
  <div class="explanation" id="explanation">
    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
      <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
      <span id="explanationZoom" title="收起提示"></span>
    </div>
    <ul>
      <li>商品模型是一种产品的统称. 例如：手机、衣服等</li>
      <li>商品模型关联某一产品的规格、属性</li>
      <li>发布某一个商品时，将其关联商品模型就知道该商品有哪里规格属性</li>
    </ul>
  </div>
	<form method="post" id="addEditGoodsTypeForm" onsubmit="return checkgoodsTypeName();">
    <div class="ncap-form-default">
<!--商品类型-->     
      <dl class="row">
        <dt class="tit">
          <label for="t_mane"><em>*</em>类型名称:</label>
        </dt>
        <dd class="opt">
            <input type="text" value="<?php echo $goodsType['name']; ?>" name="name" class="input-txt" style="width:300px;"/>
            <span class="err" id="err_name" style="color:#F00; display:none;">商品类型名称不能为空!!</span>         
            <p class="notic"></p>
        </dd>
      </dl>      
      <dl class="row">
        <dt class="tit" colspan="2">
          <label class="" for="s_sort">所属分类</label>
        </dt>
        <dd class="opt">
          <div id="gcategory"> 
              <select name="cat_id1" id="cat_id1" onblur="get_category(this.value,'cat_id2','0');"  class="class-select valid">
                <option value="0">请选择商品分类</option>                                      
                     <?php if(is_array($cat_list) || $cat_list instanceof \think\Collection || $cat_list instanceof \think\Paginator): if( count($cat_list)==0 ) : echo "" ;else: foreach($cat_list as $k=>$v): ?>                                                                                          
                       <option value="<?php echo $v['id']; ?>" <?php if($v['id'] == $goodsType[cat_id1]): ?>selected="selected"<?php endif; ?> >
                            <?php echo $v['name']; ?>
                       </option>
                     <?php endforeach; endif; else: echo "" ;endif; ?>
              </select>
              <select name="cat_id2" id="cat_id2" onblur="get_category(this.value,'cat_id3','0');" class="class-select valid">
                <option value="0">请选择商品分类</option>
              </select>    
              <select name="cat_id3" id="cat_id3" class="class-select valid">
                <option value="0">请选择商品分类</option>
              </select>
              <span id="err_cat_id" style="color:#F00; display:none;"></span>                                 
          </div>
          <p class="notic">这个模型归属哪个分类下, 仅仅方便检索用</p>
        </dd>
      </dl>
<!--商品类型 end-->       
<!--关联规格-->	      
<dl class="row">
        <dt class="tit">
          <label>关联规格</label>
        </dt>
        <dd class="opt">
          <div>
              <select name="spec_cat_id1" id="spec_cat_id1" onblur="get_category(this.value,'spec_cat_id2','0');spec_scroll(this);" class="class-select valid">
                <option value="0">请选择商品分类</option>
                     <?php if(is_array($cat_list) || $cat_list instanceof \think\Collection || $cat_list instanceof \think\Paginator): if( count($cat_list)==0 ) : echo "" ;else: foreach($cat_list as $k=>$v): ?>
                       <option value="<?php echo $v['id']; ?>">
                            <?php echo $v['name']; ?>
                       </option>
                     <?php endforeach; endif; else: echo "" ;endif; ?>
              </select>
              <select name="spec_cat_id2" id="spec_cat_id2" onblur="get_category(this.value,'spec_cat_id3','0');" class="class-select valid">
                <option value="0">请选择商品分类</option>
              </select> 
              <select name="spec_cat_id3" id="spec_cat_id3"  class="class-select valid">
                <option value="0">请选择商品分类</option>
              </select>  
              <p class="notic">此处选择分类仅仅方便筛选以下规格, 此分类不与模型关联  </p>
              <span id="spec_cat_id" style="color:#F00; display:none;"></span>              
           </div>
          <div class="scrollbar-box ps-container ps-active-y">
            <div class="ncap-type-spec-list" id="ajax_specList" class="ajax_bradnlist" style="height:160px;overflow: auto;"></div>
          </div>
        </dd>
      </dl>           
<!--关联规格 end-->       
      
<!--关联品牌-->
<dl class="row">
        <dt class="tit">
          <label>关联品牌</label>
        </dt>
        <dd class="opt">
          <div>
              <select name="brand_cat_id1" id="brand_cat_id1" onblur="get_category(this.value,'brand_cat_id2','0');brand_scroll(this);" class="class-select valid">
                <option value="0">请选择商品分类</option>
                     <?php if(is_array($cat_list) || $cat_list instanceof \think\Collection || $cat_list instanceof \think\Paginator): if( count($cat_list)==0 ) : echo "" ;else: foreach($cat_list as $k=>$v): ?>
                       <option value="<?php echo $v['id']; ?>">
                            <?php echo $v['name']; ?>
                       </option>
                     <?php endforeach; endif; else: echo "" ;endif; ?>
              </select>
              <select name="brand_cat_id2" id="brand_cat_id2" onblur="get_category(this.value,'brand_cat_id3','0');" class="class-select valid">
                <option value="0">请选择商品分类</option>
              </select>  
              <select name="brand_cat_id3" id="brand_cat_id3" class="form-control" class="class-select valid">
                <option value="0">请选择商品分类</option>
              </select> 
              <p class="notic">此处选择分类仅仅方便筛选以下品牌, 此分类不与模型关联 </p>
           </div>
          <div class="scrollbar-box ps-container ps-active-y">
            <div class="ncap-type-spec-list" id="ajax_brandList" class="ajax_bradnlist" style="height:160px;overflow: auto;"></div>
          </div>
        </dd>
      </dl>
<!--关联品牌 end-->

<!--添加属性-->
	 <dl class="row">
        <dt class="tit">添加属性</dt>
        <dd class="opt">
          <ul class="ncap-ajax-add" id="ul_attr">
              <?php if(is_array($attributeList) || $attributeList instanceof \think\Collection || $attributeList instanceof \think\Paginator): if( count($attributeList)==0 ) : echo "" ;else: foreach($attributeList as $k=>$v): ?>  
                 <li>
	                 <input type="text" name="attr_id[]" value="<?php echo $v['attr_id']; ?>"  class="form-control" style="display:none;"/>
                     
                     <label title="排序"><input type="text" class="w30" name="order[]" value="<?php echo $v['order']; ?>"  /></label>
                     
                     <label><input type="text" class="w150" name="attr_name[]" value="<?php echo $v['attr_name']; ?>" placeholder="输入属性名称" /></label>
                     
                     <label><input type="text" class="w300" name="attr_values[]" value="<?php echo $v['attr_values']; ?>" placeholder="输入属性可选值"></label>
                       
                     <label>显示&nbsp;<input type="checkbox" name="attr_index[]" value="1" <?php if($v['attr_index'] == 1): ?>checked="checked"<?php endif; ?> /></label>
                     
                     <label><a class="ncap-btn ncap-btn-red del_attr" href="JavaScript:void(0);">移除</a></label>
                 </li>
               <?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
          <a id="add_type" class="ncap-btn" href="JavaScript:void(0);" onclick="add_attribute(this);"><i class="fa fa-plus"></i>添加一个属性</a> 
          <p class="notic">多个属性值需要用英文逗号","隔开,商家发布商品是即可下拉选择属性值</p>  
          </dd>
      </dl>     
      
<!--添加属性 end-->	         
                   
      <div class="bot"><a id="submitBtn" class="ncap-btn-big ncap-btn-green" href="JavaScript:void(0);" onClick="$('#addEditGoodsTypeForm').submit();">确认提交</a></div>
    </div>
	 <input type="hidden" name="id" value="<?php echo $goodsType['id']; ?>">
  </form>
  
<!--添加属性模板-->
<ul id="attribute_html" style="display:none;">      
    <li>
         <input type="text" style="display:none;" class="form-control" value="" name="attr_id[]">
         
         <label title="排序"><input type="text" value="0" name="order[]" class="w30"></label>
         
         <label><input type="text" placeholder="输入属性名称" value="" name="attr_name[]" class="w150"></label>
         
         <label><input type="text" placeholder="输入属性可选值" value="" name="attr_values[]" class="w300"></label>
           
         <label>显示&nbsp;<input type="checkbox" value="1" name="attr_index[]"></label>
         
         <label><a href="JavaScript:void(0);" class="ncap-btn ncap-btn-red del_attr">移除</a></label>
         
     </li>  
     
</ul> 
<!--添加属性模板end -->
</div>
<script>

// 将品牌滚动条里面的 对应分类移动到 最上面
//javascript:document.getElementById('category_id_3').scrollIntoView();
var brandScroll = 0;
function brand_scroll(o){
	var id = $(o).val();
	//if(!$('#category_id_'+id).is('h5')){
	//	return false;
	//}
	$('#ajax_brandList').scrollTop(-brandScroll);
	var sp_top = $('#category_id_'+id).offset().top; // 标题自身往上的 top
	var div_top = $('#ajax_brandList').offset().top; // div 自身往上的top
	$('#ajax_brandList').scrollTop(sp_top-div_top); // div 移动
	brandScroll = sp_top-div_top;
}

 // 将规格滚动条里面的 对应分类移动到 最上面
//javascript:document.getElementById('category_id_3').scrollIntoView();
var specScroll = 0;
function spec_scroll(o){
	var id = $(o).val();

	//if(!$('#categoryId'+id).is('h5')){
		//return false;
	//}
	$('#ajax_specList').scrollTop(-specScroll);
	var sp_top = $('#categoryId'+id).offset().top; // 标题自身往上的 top
	var div_top = $('#ajax_specList').offset().top; // div 自身往上的top
	$('#ajax_specList').scrollTop(sp_top-div_top); // div 移动
	specScroll = sp_top-div_top;
}


// 判断输入框是否为空
function checkgoodsTypeName(){
	var name = $("#addEditGoodsTypeForm").find("input[name='name']").val();
    if($.trim(name) == '')
	{
		$("#err_name").show();
		return false;
	}
	return true;
}



/** 以下是编辑时默认选中某个商品分类*/
$(document).ready(function(){

	<?php if($goodsType['cat_id2'] > 0): ?>
		 // 商品分类第二个下拉菜单
		 get_category('<?php echo $goodsType[cat_id1]; ?>','cat_id2','<?php echo $goodsType[cat_id2]; ?>');
	<?php endif; if($goodsType['cat_id3'] > 0): ?>
		// 商品分类第二个下拉菜单
		 get_category('<?php echo $goodsType[cat_id2]; ?>','cat_id3','<?php echo $goodsType[cat_id3]; ?>');
	<?php endif; ?>

	getSpecList(0,0); // 默认查询所有规格
	getBrandList(0,0); // 默认查出所有品牌

});


/**
*获取筛选规格 查找某个分类下的所有Spec
* v 是分类id  l 是分类等级 比如 1级分类 2级分类 等
*/
function getSpecList(v,l)
{
	$.ajax({
		type : "GET",
		url:"/index.php?m=Admin&c=Goods&a=getSpecByCat&cat_id="+v+"&l="+l+"&type_id=<?php echo $goodsType[id]; ?>",//+tab,
		success: function(data)
		{
		   $("#ajax_specList").html('').append(data);
		}
	});
}

/**
*获取筛选品牌 查找某个分类下的所有品牌
* v 是分类id  l 是分类等级 比如 1级分类 2级分类 等
*/
function getBrandList(v,l)
{
		$.ajax({
			type : "GET",
			url:"/index.php?m=Admin&c=Goods&a=getBrandByCat&cat_id="+v+"&l="+l+"&type_id=<?php echo $goodsType[id]; ?>",//+tab,
			success: function(data)
			{
			   $("#ajax_brandList").html('').append(data);
			}
		});
}

// 添加一行属性
function add_attribute(obj)
{
  var attribute_html = $('#attribute_html').html();
  $(obj).siblings('ul').prepend(attribute_html);
}

// 删除一个 属性
$(document).on("click",".del_attr",function(){
	var _this = this;
    layer.confirm('确定要删除吗？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                //确定
                var attr_id = $(_this).parent().parent().find("input[name='attr_id\[\]']").val();
                $(_this).parent().parent().remove();
                if (attr_id == '')
                    return false;
                $.ajax({
                    type: "GET",
                    url: "/index.php?m=Admin&c=Goods&a=delGoodsAttribute&id=" + attr_id,
                    success: function (data) {
                        layer.closeAll(); // 删除回调
                    }
                });
            }, function (index) {
                layer.close(index);
            }
    );

});
</script>
</body>
</html>