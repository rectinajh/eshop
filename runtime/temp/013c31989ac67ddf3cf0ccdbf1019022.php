<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:48:"./application/admin/view2/system/edit_right.html";i:1532661068;s:44:"./application/admin/view2/public/layout.html";i:1532661068;}*/ ?>
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
<div id="toolTipLayer" style="position: absolute; z-index: 9999; display: none; visibility: visible; left: 95px; top: 573px;"></div>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
	<div class="fixed-bar">
		<div class="item-title"><a class="back" href="javascript:history.back();" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
			<div class="subject">
				<h3>权限资源管理 - 编辑权限</h3>
				<h5>网站系统权限资源管理</h5>
			</div>
		</div>
	</div>
	<form class="form-horizontal" id="adminHandle" method="post">
		<input type="hidden" name="type" value="<?php echo $_GET[type]; ?>">
		<input type="hidden" name="id" value="<?php echo $info['id']; ?>">
		<div class="ncap-form-default">
			<dl class="row">
				<dt class="tit">
					<label for="name"><em>*</em>权限资源名称</label>
				</dt>
				<dd class="opt">
					<input type="text" value="<?php echo $info['name']; ?>" name="name" id="name" class="input-txt">
					<span class="err">权限资源名称不能为空</span>
					<p class="notic"></p>
				</dd>
			</dl>
			<dl class="row">
				<dt class="tit">
					<label for="group"><em>*</em>所属分组</label>
				</dt>
				<dd class="opt">
					<select id="group" name="group">
						<?php if(is_array($group) || $group instanceof \think\Collection || $group instanceof \think\Paginator): if( count($group)==0 ) : echo "" ;else: foreach($group as $key=>$vo): ?>
							<option value="<?php echo $key; ?>" <?php if($info[group] == $key): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					<span class="err"></span>
					<p class="notic">所属分组</p>
				</dd>
			</dl>
			<dl class="row">
				<dt class="tit">
					<label for="group"><em>*</em>添加权限码</label>
				</dt>
				<dd class="opt">
					<select class="small form-control" id="controller" onblur="get_act_list(this)">
						<option value="">选择控制器</option>
						<?php if(is_array($planList) || $planList instanceof \think\Collection || $planList instanceof \think\Paginator): if( count($planList)==0 ) : echo "" ;else: foreach($planList as $key=>$vo): ?>
							<option value="<?php echo $vo; ?>"><?php echo $vo; ?></option>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					<span class="err">@</span>
					<ul class="ncap-account-container-list">
						<?php if(is_array($planList) || $planList instanceof \think\Collection || $planList instanceof \think\Paginator): if( count($planList)==0 ) : echo "" ;else: foreach($planList as $key=>$vo): ?>
							<li>
								<label><input class="checkbox" name="act_item" value="<?php echo $vo; ?>" type="checkbox"><?php echo $vo; ?></label>
							</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</dd>
			</dl>
			<dl class="row">
				<dt class="tit">
					<label for="name"><em>*</em>权限码</label>
				</dt>
				<dd class="opt">
					<table>
						<tr><th style="width:80%">权限码</th><th style="width: 50px;text-align: center;" >操作</th></tr>
						<tbody id="rightList">
						<?php if(is_array($info[right]) || $info[right] instanceof \think\Collection || $info[right] instanceof \think\Paginator): if( count($info[right])==0 ) : echo "" ;else: foreach($info[right] as $key=>$vo): ?>
							<tr id='<?php echo $vo; ?>'><td><input name="right[]" type="text" value="<?php echo $vo; ?>" class="form-control" style="width:300px;"></td>
								<td style="text-align: center;"><a class="ncap-btn" href="javascript:;" onclick="$(this).parent().parent().remove();">删除</a></td></tr>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
				</dd>
			</dl>
			<div class="bot"><a href="JavaScript:void(0);" onclick="adsubmit();" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a></div>
		</div>
	</form>
</div>
<script type="text/javascript">
 	
	function chkbox_bind(){
			$('input:checkbox').change(function () { 
				var is_check = $(this).is(':checked');
				var row_id = ncode+'_'+ $(this).val();
				if(is_check){
					var a = [];
					$('#rightList .form-control').each(function(i,o){
						if($(o).val() != ''){
							a.push($(o).val());
						}
					})
					var ncode = $('#controller').val();
					if(ncode !== ''){
						var temp = ncode+'@'+ $(this).val();
						if($.inArray(temp,a) != -1){
							return ;
						}
					}else{
						layer.alert("请选择控制器" , {icon:2,time:1000});
						return;
					}
					var strtr = "<tr id="+row_id+">";
					if(ncode!= ''){
						strtr += '<td><input type="text" name="right[]" value="'+ncode+'@'+ $(this).val()+'" class="form-control" style="width:300px;"></td>';
					}else{
						strtr += '<td><input type="text" name="right[]" value="" class="form-control" style="width:300px;"></td>';
					}
					strtr += '<td style="text-align: center;"><a href="javascript:;" class="ncap-btn" onclick="$(this).parent().parent().remove();">删除</a></td>';
					$('#rightList').append(strtr);	
				}else{
					$("#"+row_id).remove();
				}
			}); 
	}
	chkbox_bind();
	function get_act_list(obj){
		$.ajax({
			url: "<?php echo U('system/ajax_get_action',array('type'=>$_GET[type])); ?>",
			type:'get',
			data: {'controller':$(obj).val()},
			dataType:'html',
			success:function(res){
				$('.ncap-account-container-list').empty().append(res);
				chkbox_bind();
			}
		});
	}
	function adsubmit(){
		if($('input[name=name]').val() == ''){
			layer.msg('权限名称不能为空！', {icon: 2,time: 1000});
			return false;
		}

		if($('input[name="right[]"').val() == ''){
			layer.msg('权限码不能为空！', {icon: 2,time: 1000});
			return false;
		}

		$('#adminHandle').submit();
	}
</script>
</body>
</html>