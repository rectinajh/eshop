<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"./application/admin/view2/recognize/plan_add.html";i:1532661068;s:44:"./application/admin/view2/public/layout.html";i:1532661068;}*/ ?>
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
<script src="__ROOT__/public/static/js/layer/laydate/laydate.js"></script>
<script src="__ROOT__/public/plugins/Ueditor/ueditor.config.js"></script>
<script src="__ROOT__/public/plugins/Ueditor/ueditor.all.min.js"></script>
<body style="background-color: #FFF; overflow: auto;">
	<div id="append_parent"></div>
	<div id="ajaxwaitid"></div>
	<div class="page">
		<div class="fixed-bar">
			<div class="item-title">
				<a class="back" href="<?php echo U('Recognize/plan'); ?>" title="返回列表">
					<i class="fa fa-arrow-circle-o-left"></i>
				</a>
				<div class="subject">
					<h3>认筹活动 - 添加</h3>
					<h5>商城认筹活动相关设置与管理</h5>
				</div>
			</div>
		</div>
		<!-- 操作说明 -->
		<div class="explanation" id="explanation">
			<div class="title" id="checkZoom">
				<i class="fa fa-lightbulb-o"></i>
				<h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
				<span id="explanationZoom" title="收起提示"></span>
			</div>
			<ul>
				<li>平台可以在此处添加认筹活动，添加的认筹活动默认为开启状态</li>
			</ul>
		</div>
		<form id="recognize_info" method="post">
			<div class="ncap-form-default">
				<dl class="row">
					<dt class="tit">
						<label for="">
							<em>*</em>活动时间</label>
					</dt>
					<dd class="opt">
						<input type="text" value="<?php echo $recognize['start_time']; ?>" id="start_time" name="start_time" class="qsbox" placeholder="请选择开始时间"
						required />
						<span> 至 </span>
						<input type="text" value="<?php echo $recognize['end_time']; ?>" id="end_time" name="end_time" class="qsbox" placeholder="请选择结束时间" required />
						<span class="err"></span>
						<p class="notic">活动时间范围</p>
					</dd>
				</dl>
				<dl class="row">
					<dt class="tit">
						<label for="recognize_name">
							<em>*</em>活动名称</label>
					</dt>
					<dd class="opt">
						<input type="text" value="<?php echo $recognize['title']; ?>" id="recognize_name" name="title" class="input-txt" required />
						<span class="err"></span>
						<p class="notic">认筹活动的名称，便于区分活动</p>
					</dd>
				</dl>
				<dl class="row">
					<dt class="tit">
						<label for="member_name">
							<em>*</em>活动价格</label>
					</dt>
					<dd class="opt">
						<input type="text" value="<?php echo $recognize['price']; ?>" id="recognize_price" name="price" class="input-txt" required />
						<span class="err"></span>
						<p class="notic">活动单价，最多支持两位小数</p>
					</dd>
				</dl>
				<dl class="row">
					<dt class="tit">
						<label for="total_qty">
							<em>*</em>发行数量</label>
					</dt>
					<dd class="opt">
						<input type="text" value="<?php echo $recognize['total_qty']; ?>" id="total_qty" name="total_qty" class="input-txt" required />
						<span class="err"></span>
						<p class="notic">单次活动的发行数总量</p>
					</dd>
				</dl>
				<dl class="row">
					<dt class="tit">
						<label for="">
							<em>*</em>限购数量</label>
					</dt>
					<dd class="opt">
						<input type="text" value="<?php echo $recognize['limit_qty']; ?>" id="limit_qty" name="limit_qty" class="input-txt" required />
						<span class="err"></span>
						<p class="notic">每人允许购买最大数量，设置为0则不限制</p>
					</dd>
				</dl>
				<dl class="row">
					<dt class="tit">
						<label for="">
							<em>*</em>状态
						</label>
					</dt>
					<dd class="opt">
						<select name="status" class="select" style="height: 24px;">
							<?php if(is_array($statusList) || $statusList instanceof \think\Collection || $statusList instanceof \think\Paginator): if( count($statusList)==0 ) : echo "" ;else: foreach($statusList as $key=>$status): ?>
								<option value="<?php echo $key; ?>" <?php if($recognize['status'] == $key): ?>selected<?php endif; ?>><?php echo $status; ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</dd>
				</dl>
				<dl class="row">
					<dt class="tit">
						<label for="">
							<em>*</em>活动介绍
						</label>
					</dt>
					<dd class="opt">
						<script id="container" name="content" type="text/plain"><?php echo htmlspecialchars_decode($recognize['content']); ?></script>
					</dd>
				</dl>
				<div class="bot">
					<a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" onclick="actsubmit()">确认提交</a>
				</div>
			</div>
		</form>
	</div>
	<script type="text/javascript">
        var ue = UE.getEditor('container');
		$('#start_time').layDate();
		$('#end_time').layDate();
		var flag = true;
		function actsubmit() {
			/*
			if ($('input[name=start_time]').val() == '') {
				layer.msg("活动开始时间不能为空", { icon: 2, time: 2000 });
				return;
			}
			if ($('input[name=end_time]').val() == '') {
				layer.msg("活动结束时间不能为空", { icon: 2, time: 2000 });
				return;
			}
			var user_name = $('input[name=title]').val();
			if (user_name == '') {
				layer.msg("活动名称不能为空", { icon: 2, time: 2000 });
				return;
			}
			if ($('input[name=price]').val() == '') {
				layer.msg("活动价格不能为空", { icon: 2, time: 2000 });
				return;
			}
			if ($('input[name=total_qty]').val() == '') {
				layer.msg("活动发行数量不能为空", { icon: 2, time: 2000 });
				return;
			}
			if ($('input[name=limit_buy]').val() == '') {
				layer.msg("活动限购数量不能为空", { icon: 2, time: 2000 });
				return;
			}
			*/
			if (flag) {
				$.ajax({
					type: 'post',
					url: "",
					dataType: 'json',
					data: $('#recognize_info').serialize(),
					success: function (res) {
						if (res.code == 0) {
							layer.msg(res.msg, {icon: 2, time: 2000});
							return false;
						} else {
							layer.msg(res.msg, {
								icon: 1,
								time: 2000,
								end: function () {
									window.location.href = res.data.url;
								}
							});
						}
					}
				});
			}
		}
	</script>
</body>

</html>