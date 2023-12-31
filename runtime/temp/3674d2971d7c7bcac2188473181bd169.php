<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"./application/admin/view2/goods/brandList.html";i:1532661068;s:44:"./application/admin/view2/public/layout.html";i:1532661068;}*/ ?>
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
<body style="background-color: rgb(255, 255, 255); overflow: auto; cursor: default; -moz-user-select: inherit;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>品牌列表</h3>
        <h5>网站系统文章索引与管理</h5>
      </div>
    </div>
  </div>
  <!-- 操作说明 -->
  <div id="explanation" class="explanation" style="color: rgb(44, 188, 163); background-color: rgb(237, 251, 248); width: 99%; height: 100%;">
    <div id="checkZoom" class="title"><i class="fa fa-lightbulb-o"></i>
      <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
      <span title="收起提示" id="explanationZoom" style="display: block;"></span>
    </div>
    <ul>
      <li>同一个品牌可以添加多次.</li>
      <li>比如卖笔记本下面一个苹果品牌. 卖手机下面也有苹果牌,卖箱包下面也有苹果牌.</li>      
    </ul>
  </div>
  <div class="flexigrid">
    <div class="mDiv">
      <div class="ftitle">
        <h3>品牌列表</h3>
        <h5>(共<?php echo $pager->totalRows; ?>条记录)</h5>
      </div>
      <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>	   
	<form id="search-form2" class="navbar-form form-inline"  method="post" action="<?php echo U('/Admin/Goods/brandList'); ?>">
      <div class="sDiv">
        <span>待审核：</span>
        <input type="checkbox" name="status" value="1" style="vertical-align: middle;" />      
        <div class="sDiv2">
		      <input type="text" class="qsbox" id="input-order-id" placeholder="搜索词" value="<?php echo $_POST['keyword']; ?>" name="keyword">                                        
          <input type="submit" class="btn" value="搜索">
        </div>
      </div>
     </form>
    </div>
    <div class="hDiv">
      <div class="hDivBox">
        <table cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <th class="sign" axis="col0">
                <div style="width: 24px;"><i class="ico-check"></i></div>
              </th>
              <th align="left" abbr="article_title" axis="col3" class="">
                <div style="text-align: left; width: 200px;" class="">品牌名称</div>
              </th>
              <th align="left" abbr="ac_id" axis="col4" class="">
                <div style="text-align: left; width: 100px;" class="">Logo</div>
              </th>
              <th align="center" abbr="article_show" axis="col5" class="">
                <div style="text-align: center; width: 200px;" class="">品牌分类</div>
              </th>
              <th align="center" abbr="article_time" axis="col6" class="">
                <div style="text-align: center; width: 100px;" class="">是否推荐</div>
              </th>
              <th align="center" abbr="article_time" axis="col6" class="">
                <div style="text-align: center; width: 100px;" class="">状态</div>
              </th>        
              <th align="center" abbr="article_time" axis="col6" class="">
                <div style="text-align: center; width: 100px;" class="">排序</div>
              </th>                      
              <th align="center" axis="col1" class="handle">
                <div style="text-align: center; width: 100px;">操作</div>
              </th>
              <th style="width:100%" axis="col7">
                <div></div>
              </th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <div class="tDiv">
      <div class="tDiv2">
        <div class="fbutton"> <a href="<?php echo U('Admin/Goods/addEditBrand'); ?>">
          <div class="add" title="新增品牌">
            <span><i class="fa fa-plus"></i>新增品牌</span>
          </div>
          </a> 
          </div>
      </div>
      <div style="clear:both"></div>
    </div>
    <div class="bDiv" style="height: auto;">
      <div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
        <table>
          <tbody>
            <?php if(is_array($brandList) || $brandList instanceof \think\Collection || $brandList instanceof \think\Paginator): $i = 0; $__LIST__ = $brandList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
              <tr>
                <td class="sign">
                  <div style="width: 24px;"><i class="ico-check"></i></div>
                </td>
                <td align="left" class="">
                  <div style="text-align: left; width: 200px;"><?php echo $list['name']; ?></div>
                </td>
                <td align="left" class="">
                  <div style="text-align: left; width: 100px;">
	                  <a href="<?php echo $list['logo']; ?>" target="_blank"><img onMouseOver="$(this).attr('width','80').attr('height','45');" onMouseOut="$(this).attr('width','40').attr('height','30');" width="40" height="30" src="<?php echo $list['logo']; ?>"/></a>
                  </div>
                </td>
                <td align="center" class="">
                  <div style="text-align: center; width: 200px;"><?php echo $cat_list[$list[cat_id1]]; ?> <?php echo $cat_list[$list[cat_id2]]; ?></div>
                </td>                
                <td align="center" class="">
                  <div style="text-align: center; width: 100px;">
                    <?php if($list[is_hot] == 1): ?>
                      <span class="yes" onClick="changeTableVal('brand','id','<?php echo $list['id']; ?>','is_hot',this)" ><i class="fa fa-check-circle"></i>是</span>
                      <?php else: ?>
                      <span class="no" onClick="changeTableVal('brand','id','<?php echo $list['id']; ?>','is_hot',this)" ><i class="fa fa-ban"></i>否</span>
                    <?php endif; ?>
                  </div>
                </td>
                <td align="center" class="">
                  <div style="text-align: center; width: 100px;">
                      <?php if($list[status] == 0): ?>正常<?php endif; if($list[status] == 1): ?>审核中<?php endif; if($list[status] == 2): ?>审核失败<?php endif; ?>                   
                  </div>
                </td>                
              <td align="center">
                <div style="text-align: center; width: 100px;">
                  <input type="text" onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" onpaste="this.value=this.value.replace(/[^\d]/g,'')" onblur="changeTableVal('brand','id','<?php echo $list['id']; ?>','sort',this)" size="4" value="<?php echo $list['sort']; ?>" />
                </div>
              </td>
                <td align="center" class="handle">
                  <div style="text-align: center; width: 100px;">                    
                    <a class="btn red"  href="javascript:void(0)"  onclick="del('<?php echo $list[id]; ?>')"><i class="fa fa-trash-o"></i>删除</a>                                                            
                    <a href="<?php echo U('Admin/goods/addEditBrand',array('id'=>$list['id'],'p'=>$_GET[p])); ?>" class="btn blue"><i class="fa fa-pencil-square-o"></i>编辑</a> </div>
                  </div>
                </td>
                <td align="" class="" style="width: 100%;">
                  <div>&nbsp;</div>
                </td>
              </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
        </table>
	 <!--分页位置--> 
    <?php echo $pager->show(); ?> </div>        
      </div>       
    </div>    
</div>
<script>
	 // 删除操作
	function del(id){
      layer.confirm('确定要删除吗？', {
                btn: ['确定','取消'] //按钮
              }, function(){
                // 确定
                layer.closeAll();
                $.ajax({
                  url:"/index.php?m=Admin&c=goods&a=delBrand&id="+id,
                  success: function(v){
                    layer.closeAll();
                    var v =  eval('('+v+')');
                    if(v.hasOwnProperty('status') && (v.status == 1))
                      location.href='<?php echo U('Admin/goods/brandList'); ?>';
                    else
                    layer.msg(v.msg, {icon: 2,time: 1000}); //alert(v.msg);
                  }
                });
              }, function(index){
                layer.close(index);
              }
      );
	}
 
    $(document).ready(function(){	
	    // 表格行点击选中切换
	    $('#flexigrid > table>tbody >tr').click(function(){
		    $(this).toggleClass('trSelected');
		});
		
		// 点击刷新数据
		$('.fa-refresh').click(function(){
			location.href = location.href;
		});
		
	}); 
</script>
</body>
</html>