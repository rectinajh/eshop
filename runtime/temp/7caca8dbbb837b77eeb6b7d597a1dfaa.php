<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"./application/admin/view2/recognize/trade.html";i:1532661068;s:44:"./application/admin/view2/public/layout.html";i:1532661068;}*/ ?>
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
					<h3>认筹管理</h3>
					<h5>网站系统认筹活动审核与管理</h5>
				</div>
			</div>
		</div>
		<!-- 操作说明 -->
		<div id="explanation" class="explanation" style="color: rgb(44, 188, 163); background-color: rgb(237, 251, 248); width: 99%; height: 100%;">
			<div id="checkZoom" class="title">
				<i class="fa fa-lightbulb-o"></i>
				<h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
				<span title="收起提示" id="explanationZoom" style="display: block;"></span>
			</div>
			<ul>
				<li>认筹管理, 由总平台设置管理.</li>
			</ul>
		</div>
		<div class="flexigrid">
			<div class="mDiv">
				<div class="ftitle">
					<h3>认筹活动列表</h3>
					<h5>(共<?php echo $pager->totalRows; ?>条记录)</h5>
				</div>
				<div title="刷新数据" class="pReload">
					<i class="fa fa-refresh"></i>
				</div>
				<form class="navbar-form form-inline" id="search-form" action="<?php echo url('Recognize/trade'); ?>" method="get" onsubmit="return check_form();">
					<div class="sDiv">
						<div class="sDiv2" style="margin-right: 10px;">
							<input type="text" size="30" id="start_time" name="start_time" value="<?php echo $start_time; ?>" placeholder="起始时间" class="qsbox">
							<input type="button" class="btn" value="起始时间">
						</div>
						<div class="sDiv2" style="margin-right: 10px;">
							<input type="text" size="30" id="end_time" name="end_time" value="<?php echo $end_time; ?>" placeholder="截止时间" class="qsbox">
							<input type="button" class="btn" value="截止时间">
						</div>
						<div class="sDiv2">
							<select name="status" class="select">
								<option value="-1">交易状态</option>
								<?php if(is_array($statusList) || $statusList instanceof \think\Collection || $statusList instanceof \think\Paginator): if( count($statusList)==0 ) : echo "" ;else: foreach($statusList as $key=>$st): ?>
									<option value="<?php echo $key; ?>" <?php if(\think\Request::instance()->param('status') === $key.''): ?>selected<?php endif; ?>><?php echo $st; ?></option>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
							<select name="pay_status" class="select">
								<option value="-1">支付状态</option>
								<?php if(is_array($payStatusList) || $payStatusList instanceof \think\Collection || $payStatusList instanceof \think\Paginator): if( count($payStatusList)==0 ) : echo "" ;else: foreach($payStatusList as $key=>$st): ?>
									<option value="<?php echo $key; ?>" <?php if(\think\Request::instance()->param('pay_status') === $key.''): ?>selected<?php endif; ?>><?php echo $st; ?></option>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
							<select name="pay_type" class="select">
								<option value="-1">支付方式</option>
								<?php if(is_array($payTypeList) || $payTypeList instanceof \think\Collection || $payTypeList instanceof \think\Paginator): if( count($payTypeList)==0 ) : echo "" ;else: foreach($payTypeList as $key=>$st): ?>
									<option value="<?php echo $key; ?>" <?php if(\think\Request::instance()->param('pay_status') === $key.''): ?>selected<?php endif; ?>><?php echo $st; ?></option>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
							<input size="30" name="mobile" value="<?php echo \think\Request::instance()->param('mobile'); ?>" class="qsbox" placeholder="输入手机号" type="text">
							<span> </span>
							<input size="30" name="trade_no" value="<?php echo \think\Request::instance()->param('trade_no'); ?>" class="qsbox" placeholder="交易号" type="text">
							<span> </span>
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
									<div style="width: 24px;">
										<i class="ico-check"></i>
									</div>
								</th>
								<th align="left" abbr="article_title" axis="col3" class="">
									<div style="text-align: left; width: 160px;" class="">交易号</div>
								</th>
								<th align="left" abbr="article_title" axis="col3" class="">
									<div style="text-align: left; width: 60px;" class="">用户id</div>
								</th>
								<th align="left" abbr="ac_id" axis="col4" class="">
									<div style="text-align: center; width: 100px;" class="">用户手机</div>
								</th>
								<th align="center" abbr="article_show" axis="col5" class="">
									<div style="text-align: center; width: 80px;" class="">购买数量</div>
								</th>
								<th align="center" abbr="article_time" axis="col6" class="">
									<div style="text-align: center; width: 90px;" class="">应付金额</div>
								</th>
								<th align="center" abbr="article_time" axis="col6" class="">
									<div style="text-align: center; width: 90px;" class="">支付金额</div>
								</th>
								<th align="center" abbr="article_time" axis="col6" class="">
									<div style="text-align: center; width: 60px;" class="">状态</div>
								</th>
								<th align="center" abbr="article_time" axis="col6" class="">
									<div style="text-align: center; width: 60px;" class="">支付状态</div>
								</th>
								<th align="center" abbr="article_time" axis="col6" class="">
									<div style="text-align: center; width: 80px;" class="">支付方式</div>
								</th>
								<th align="center" abbr="article_time" axis="col6" class="">
									<div style="text-align: center; width: 120px;" class="">支付凭证</div>
								</th>
								<th align="center" abbr="article_time" axis="col6" class="">
									<div style="text-align: center; width: 120px;" class="">创建时间</div>
								</th>
								<th align="center" abbr="article_time" axis="col6" class="">
									<div style="text-align: center; width: 120px;" class="">支付时间</div>
								</th>
								<th align="center" abbr="article_time" axis="col6" class="">
									<div style="text-align: center; width: 120px;" class="">完成时间</div>
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
							<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $k=>$vo): ?>
								<tr>
									<td class="sign">
										<div style="width: 24px;">
											<i class="ico-check"></i>
										</div>
									</td>
									<td align="left" class="">
										<div style="text-align: left; width: 160px;"><?php echo $vo['trade_no']; ?></div>
									</td>
									<td align="left" class="">
										<div style="text-align: left; width: 60px;"><?php echo $vo['user_id']; ?></div>
									</td>
									<td align="left" class="">
										<div style="text-align: center; width: 100px;"><?php echo $vo['user']['mobile']; ?></div>
									</td>
									<td align="left" class="">
										<div style="text-align: right; width: 80px;"><?php echo $vo['buy_qty']; ?></div>
									</td>
									<td align="left" class="">
										<div style="text-align: right; width: 90px;"><?php echo $vo['money']; ?></div>
									</td>
									<td align="left" class="">
										<div style="text-align: right; width: 90px;"><?php echo $vo['pay_money']; ?></div>
									</td>
									<td align="left" class="">
										<div style="text-align: center; width: 60px;"><?php echo $vo['status_name']; ?></div>
									</td>
									<td align="left" class="">
										<div style="text-align: center; width: 60px;"><?php echo $vo['pay_status_name']; ?></div>
									</td>
									<td align="center" class="">
										<div style="text-align: center; width: 80px;"><?php echo $vo['pay_type_name']; ?></div>
									</td>
									<td align="left" class="">
										<div style="text-align: center; width: 120px;"><?php echo $vo['transaction_id']; ?></div>
									</td>
									<td align="left" class="">
										<div style="text-align: center; width: 120px;"><?php echo $vo['create_time']; ?></div>
									</td>
									<td align="left" class="">
										<div style="text-align: center; width: 120px;"><?php echo $vo['pay_time']; ?></div>
									</td>
									<td align="left" class="">
										<div style="text-align: center; width: 120px;"><?php echo $vo['complete_time']; ?></div>
									</td>
									<td align="left" class="handle">
										<div style="text-align: left; width: 170px; max-width:170px;">
											<?php if($vo['pay_status'] == 0 and $vo['status'] == 0): ?>
												<a class="btn blue btn-cancel" href="javascript:;" data-url="<?php echo url('Recognize/cancelTrade'); ?>" data-id="<?php echo $vo['id']; ?>">
													<i class="fa fa-edit"></i>取消</a>
											<?php endif; if($vo['pay_status'] == 1 and $vo['status'] == 0): ?>
												<a class="btn blue btn-refund" href="javascript:;" data-url="<?php echo url('Recognize/refundTrade'); ?>" data-id="<?php echo $vo['id']; ?>">
													<i class="fa fa-edit"></i>退款</a>
											<?php endif; ?>
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
		$(document).ready(function () {
			// 表格行点击选中切换
			$('#flexigrid > table>tbody >tr').click(function () {
				$(this).toggleClass('trSelected');
			});

			// 点击刷新数据
			$('.fa-refresh').click(function () {
				location.href = location.href;
			});

			$('#start_time').layDate();
			$('#end_time').layDate();
		});

		function check_form() {
			var start_time = $.trim($('#start_time').val());
			var end_time = $.trim($('#end_time').val());
			if (start_time == '' ^ end_time == '') {
				layer.alert('请选择完整的时间间隔', { icon: 2 });
				return false;
			}
			if (start_time !== '' && end_time !== '') {
				$('#timegap').val(start_time + " - " + end_time);
			}
			if (start_time == '' && end_time == '') {
				$('#timegap').val('');
			}
			return true;
		}

		$('.btn-cancel').click(function () {
			var url = $(this).data('url'), id = $(this).data('id');
			layer.confirm('确定要取消吗?', {
				title: '提示',
				icon: 3
			}, function() {
				$.ajax({
					url: url,
					type: 'POST',
					data: {trade_id: id},
					success: function (res) {
						if (res.code == 1) {
							layer.msg(res.msg, {
								time: 2000,
								end: function() {
									window.location.reload();
								}
							});
						} else {
							layer.msg(res.msg);
						}
					},
					error: function() {

					}
				});
			});
		});

		$('.btn-refund').click(function () {
			layer.confirm('确定要退款吗?', function() {
				layer.msg('此功能未开发,请人员处理');
			});
		});
	</script>
</body>
</html>