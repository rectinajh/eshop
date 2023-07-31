<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"./application/admin/view2/admin/role_info.html";i:1532661068;s:44:"./application/admin/view2/public/layout.html";i:1532661068;}*/ ?>
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
				<h3>权限管理 - 管理角色</h3>
				<h5>网站系统角色管理</h5>
			</div>
		</div>
	</div>
	<form class="form-horizontal" action="<?php echo U('Admin/Admin/roleSave'); ?>" id="roleform" method="post">
		<input type="hidden" name="role_id" value="<?php echo $detail['role_id']; ?>" />
		<div class="ncap-form-default">
			<dl class="row">
				<dt class="tit">
					<label for="role_name"><em>*</em>角色名称</label>
				</dt>
				<dd class="opt">
					<input type="text" name="data[role_name]" id="role_name" value="<?php echo $detail['role_name']; ?>" <?php if(!empty($detail['role_id'])): ?>disabled<?php endif; ?> class="input-txt">
					<span class="err" id="err_role_name">导航名称不能为空!!</span>
					<p class="notic"></p>
				</dd>
			</dl>
			<dl class="row">
				<dt class="tit">
					<label for="role_desc"><em>*</em>角色描述</label>
				</dt>
				<dd class="opt">
					<textarea id="role_desc" name="data[role_desc]" class="tarea" rows="6"><?php echo $detail['role_desc']; ?></textarea>
					<span class="err" id="err_role_desc">短信内容不能为空</span>
					<p class="notic"></p>
				</dd>
			</dl>
			<dl class="row">
				<dt class="tit">
					<label for="cls_full"><em>*</em>权限分配</label>
				</dt>
				<dd style="margin-left:200px;">
					<div class="ncap-account-container" style="border-top:none;">
						<h4>
							<input id="cls_full" onclick="choosebox(this)" type="checkbox">
							<label>全选</label>
						</h4>
					</div>
					<?php if(is_array($modules) || $modules instanceof \think\Collection || $modules instanceof \think\Paginator): if( count($modules)==0 ) : echo "" ;else: foreach($modules as $kk=>$menu): ?>
						<div class="ncap-account-container" style="border-top:none;">
							<h4>
								<label><?php echo $group[$kk]; ?></label>
								<input value="1" cka="mod-<?php echo $kk; ?>" type="checkbox">
								<label>全部</label>
							</h4>
							<ul class="ncap-account-container-list">
								<?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vv): ?>
									<li>
										<label><input class="checkbox" name="right[]" value="<?php echo $vv['id']; ?>" <?php if($vv['enable'] == 1): ?>checked<?php endif; ?> ck="mod-<?php echo $kk; ?>" type="checkbox"><?php echo $vv['name']; ?></label>
									</li>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					<?php endforeach; endif; else: echo "" ;endif; ?>
                    <h4><span class="err" id="err_act_list"></span></h4>
				</dd>
			</dl>

			<div class="bot"><a href="JavaScript:void(0);" onclick="submitForm();" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a></div>
		</div>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$(":checkbox[cka]").click(function(){
			var $cks = $(":checkbox[ck='"+$(this).attr("cka")+"']");
			if($(this).is(':checked')){
				$cks.each(function(){$(this).prop("checked",true);});
			}else{
				$cks.each(function(){$(this).removeAttr('checked');});
			}
		});
	});

	function choosebox(o){
		var vt = $(o).is(':checked');
		if(vt){
			$('input[type=checkbox]').prop('checked',vt);
		}else{
			$('input[type=checkbox]').removeAttr('checked');
		}
	}

    function submitForm(){
        $('span.err').hide();
        $.ajax({
            type: "POST",
            url: "<?php echo U('Admin/roleSave'); ?>",
            data: $('#roleform').serialize(),
            dataType: "json",
            error: function () {
                layer.alert("服务器繁忙, 请联系管理员!");
            },
            success: function (data) {
                if (data.status === 1) {
                    layer.msg(data.msg, {icon: 1,time: 1000}, function() {
                        location.href = "<?php echo U('Admin/role'); ?>";
                    });
                } else if(data.status === 0) {
                    layer.msg(data.msg, {icon: 2,time: 1000});
                    $.each(data.result, function(index, item) {
                        $('#err_' + index).text(item).show();
                    });
                } else {
                    layer.msg(data.msg, {icon: 2,time: 1000});
                }
            }
        });
    }
</script>
</body>
</html>