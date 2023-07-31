<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:51:"./application/admin/view2/promotion/flash_sale.html";i:1532661068;s:44:"./application/admin/view2/public/layout.html";i:1532661068;}*/ ?>
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
<body style="background-color: rgb(255, 255, 255); overflow: auto; cursor: default; -moz-user-select: inherit;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
	<div class="fixed-bar">
		<div class="item-title">
			<div class="subject">
				<h3>抢购管理</h3>
				<h5>网站系统抢购活动审核与管理</h5>
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
			<li>抢购管理, 由总平台设置管理.</li>
		</ul>
	</div>
	<div class="flexigrid">
		<div class="mDiv">
			<div class="ftitle">
				<h3>抢购活动列表</h3>
				<h5>(共<?php echo $pager->totalRows; ?>条记录)</h5>
			</div>
			<div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
			<form class="navbar-form form-inline" id="search-form" action="<?php echo U('Promotion/flash_sale'); ?>" method="get" onsubmit="return check_form();">
				<input type="hidden" name="timegap" id="timegap" value="<?php echo $timegap; ?>">
				<div class="sDiv">
					<div class="sDiv2" style="margin-right: 10px;">
						<input type="text" size="30" id="start_time" value="<?php echo $start_time; ?>" placeholder="起始时间" class="qsbox">
						<input type="button" class="btn" value="起始时间">
					</div>
					<div class="sDiv2" style="margin-right: 10px;">
						<input type="text" size="30" id="end_time" value="<?php echo $end_time; ?>" placeholder="截止时间" class="qsbox">
						<input type="button" class="btn" value="截止时间">
					</div>
					<div class="sDiv2">
						<select name="status" class="select">
							<option value="">活动状态</option>
							<?php if(is_array($state) || $state instanceof \think\Collection || $state instanceof \think\Paginator): if( count($state)==0 ) : echo "" ;else: foreach($state as $key=>$st): ?>
								<option value="<?php echo $key; ?>" <?php if(\think\Request::instance()->param('status') === $key.''): ?>selected<?php endif; ?>><?php echo $st; ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<input size="30" name="title" value="<?php echo \think\Request::instance()->param('title'); ?>" class="qsbox" placeholder="输入活动名称" type="text">
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
							<div style="text-align: left; width: 240px;" class="">活动名称</div>
						</th>
						<th align="left" abbr="ac_id" axis="col4" class="">
							<div style="text-align: left; width: 80px;" class="">抢购总量</div>
						</th>
						<th align="center" abbr="article_show" axis="col5" class="">
							<div style="text-align: center; width: 80px;" class="">抢购价格</div>
						</th>
						<th align="center" abbr="article_time" axis="col6" class="">
							<div style="text-align: center; width: 240px;" class="">活动商品</div>
						</th>
						<th align="center" abbr="article_time" axis="col6" class="">
							<div style="text-align: center; width: 120px;" class="">开始时间</div>
						</th>
						<th align="center" abbr="article_time" axis="col6" class="">
							<div style="text-align: center; width: 120px;" class="">结束时间</div>
						</th>
						<th align="center" abbr="article_time" axis="col6" class="">
							<div style="text-align: center; width: 80px;" class="">已购买</div>
						</th>
						<th align="center" abbr="article_time" axis="col6" class="">
							<div style="text-align: center; width: 80px;" class="">抢购状态</div>
						</th>
						<th align="center" abbr="article_time" axis="col6" class="">
							<div style="text-align: center; width: 80px;" class="">推荐</div>
						</th>

						<th align="left" axis="col1" class="handle">
							<div style="text-align: center; width: 150px;">操作</div>
						</th>
						<th style="width:100%" axis="col7">
							<div></div>
						</th>
					</tr>
					</thead>
				</table>
			</div>
		</div>
		<div class="bDiv" style="height: auto;">
			<div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
				<table>
					<tbody>
					<?php if(is_array($prom_list) || $prom_list instanceof \think\Collection || $prom_list instanceof \think\Paginator): if( count($prom_list)==0 ) : echo "" ;else: foreach($prom_list as $k=>$vo): ?>
						<tr>
							<td class="sign">
								<div style="width: 24px;"><i class="ico-check"></i></div>
							</td>
							<td align="left" class="">
								<div style="text-align: left; width: 240px;"><?php echo $vo['title']; ?></div>
							</td>
							<td align="left" class="">
								<div style="text-align: center; width: 80px;"><?php echo $vo['goods_num']; ?></div>
							</td>
							<td align="left" class="">
								<div style="text-align: center; width: 80px;"><?php echo $vo['price']; ?></div>
							</td>
							<td align="left" class="">
								<div style="text-align: left; width: 240px;"><?php echo $vo['goods_name']; ?></div>
							</td>
							<td align="left" class="">
								<div style="text-align: center; width: 120px;"><?php echo date('Y-m-d H:i:s',$vo['start_time']); ?></div>
							</td>
							<td align="left" class="">
								<div style="text-align: center; width: 120px;"><?php echo date('Y-m-d H:i:s',$vo['end_time']); ?></div>
							</td>
							<td align="left" class="">
								<div style="text-align: center; width: 80px;"><?php echo $vo['buy_num']; ?></div>
							</td>
							<td align="left" class="">
								<div style="text-align: center; width: 80px;">
                                    <?php if($vo[end_time] < time()): ?>已结束<?php else: ?><?php echo $state[$vo[status]]; endif; ?>
                                </div>
							</td>
							<td align="center" class="">
								<div style="text-align: center; width: 80px;">
									<?php if($vo[recommend] == 1): ?>
										<span class="yes" onClick="changeTableVal('flash_sale','id','<?php echo $vo['id']; ?>','recommend',this)" ><i class="fa fa-check-circle"></i>是</span>
										<?php else: ?>
										<span class="no" onClick="changeTableVal('flash_sale','id','<?php echo $vo['id']; ?>','recommend',this)" ><i class="fa fa-ban"></i>否</span>
									<?php endif; ?>
								</div>
							</td>
							<td align="left" class="handle">
								<div style="text-align: left; width: 170px; max-width:170px;">
									<?php if($vo['status'] == 0): ?>
										<a class="btn blue" onclick="changeStatus(1,'<?php echo $vo['id']; ?>','flash_sale',1)"><i class="fa fa-check"></i>通过</a>
										<a class="btn red" onclick="changeStatus(2,'<?php echo $vo['id']; ?>','flash_sale',1)"><i class="fa fa-ban"></i>拒绝</a>
									<?php endif; if($vo['status'] == 1): ?>
										<a class="btn red" onclick="changeStatus(3,'<?php echo $vo['id']; ?>','flash_sale',1)"><i class="fa fa-close"></i>取消</a>
									<?php endif; ?>
									<a class="btn red" href="javascript:void(0)" data-url="<?php echo U('Promotion/flash_sale_del'); ?>" data-id="<?php echo $vo['id']; ?>" onClick="delfun(this)"><i class="fa fa-trash-o"></i>删除</a>
								</div>
							</td>
							<td align="" class="" style="width: 100%;">
								<div>&nbsp;</div>
							</td>
						</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
			</div>
			<div class="iDiv" style="display: none;"></div>
		</div>
		<!--分页位置-->
		<?php echo $page; ?> </div>
</div>
<script>
	$(document).ready(function(){
		// 表格行点击选中切换
		$('#flexigrid > table>tbody >tr').click(function(){
			$(this).toggleClass('trSelected');
		});

		// 点击刷新数据
		$('.fa-refresh').click(function(){
			location.href = location.href;
		});

		$('#start_time').layDate();
		$('#end_time').layDate();
	});

	function changeStatus(status,id,tab,prom_type){
		if(status>1){
			var warning_txt = '';
			if(status == 2){
				warning_txt += '确认拒绝?';
			}
			if(status == 3){
				warning_txt += '确认取消?';
			}
			layer.confirm(warning_txt, {btn: ['确定','取消']}, function(){
				$.ajax({
					type : 'GET',
					url : "<?php echo U('Promotion/activity_handle'); ?>",
					data : {'id':id,'tab':tab,'status':status,'prom_type':prom_type},
					dataType :'JSON',
					success : function(res){
						layer.closeAll();
						if(res == 1){
							layer.msg('操作成功', {icon: 1});
							window.location.reload();
						}else{
							layer.msg('操作失败', {icon: 2,time: 2000});
						}
					}
				});
			}, function(index){
				layer.close(index);
			});
		}else{
			$.ajax({
				type : 'GET',
				url : "<?php echo U('Promotion/activity_handle'); ?>",
				data : {'id':id,'tab':tab,'status':status,'prom_type':prom_type},
				dataType :'JSON',
				success : function(res){
					if(res == 1){
						layer.msg('操作成功', {icon: 1});
						window.location.reload();
					}else{
						layer.msg('操作失败', {icon: 2,time: 2000});
					}
					layer.closeAll();
				}
			});
		}
	}

	function delfun(obj) {
		// 删除按钮
		layer.confirm('确认删除？', {
			btn: ['确定', '取消'] //按钮
		}, function () {
			$.ajax({
				type: 'post',
				url: $(obj).attr('data-url'),
				data : {act:'del',del_id:$(obj).attr('data-id')},
				dataType: 'json',
				success: function (data) {
					layer.closeAll();
					if (data) {
						$(obj).parent().parent().parent().remove();
					} else {
						layer.alert('删除失败', {icon: 2});  //alert('删除失败');
					}
				}
			})
		}, function () {
			layer.closeAll();
		});
	}
	function check_form(){
		var start_time = $.trim($('#start_time').val());
		var end_time =  $.trim($('#end_time').val());
		if(start_time == '' ^ end_time == ''){
			layer.alert('请选择完整的时间间隔', {icon: 2});
			return false;
		}
		if(start_time !== '' && end_time !== ''){
			$('#timegap').val(start_time+" - "+end_time);
		}
		if(start_time == '' && end_time == ''){
			$('#timegap').val('');
		}
		return true;
	}
</script>
</body>
</html>