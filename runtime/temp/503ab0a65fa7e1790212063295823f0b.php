<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:52:"./application/admin/view2/service/complain_list.html";i:1532661068;s:44:"./application/admin/view2/public/layout.html";i:1532661068;}*/ ?>
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
    <div class="item-title">
      <div class="subject">
        <h3>投诉管理</h3>
        <h5>商城对商品交易投诉管理及仲裁</h5>
      </div>
      <ul class="tab-base nc-row">
      <li><a href="<?php echo U('Service/complain_list',array('complain_state'=>1)); ?>" class="<?php if($complain_state == 1): ?>current<?php endif; ?>"><span>新投诉</span></a></li>
      <li><a href="<?php echo U('Service/complain_list',array('complain_state'=>2)); ?>" class="<?php if($complain_state == 2): ?>current<?php endif; ?>"><span>对话中</span></a></li>
      <li><a href="<?php echo U('Service/complain_list',array('complain_state'=>3)); ?>" class="<?php if($complain_state == 3): ?>current<?php endif; ?>"><span>待仲裁</span></a></li>
      <li><a href="<?php echo U('Service/complain_list',array('complain_state'=>4)); ?>" class="<?php if($complain_state == 4): ?>current<?php endif; ?>"><span>已完成</span></a></li>
      <li><a href="<?php echo U('Service/complain_subject_list'); ?>" ><span>主题设置</span></a></li>
      <li><a href="<?php echo U('Service/complain_setting'); ?>" ><span>时效设置</span></a></li></ul>    
   	</div>
  </div>
  <!-- 操作说明 -->
  <div class="explanation" id="explanation">
    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
      <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
      <span id="explanationZoom" title="收起提示"></span> </div>
    <ul>
      <li>在投诉时效内，买家可对订单进行投诉，投诉主题由管理员在后台统一设置</li>
      <li>投诉时效可在系统设置处进行设置</li>
      <li>点击详细，可查看投诉。被投诉店铺可进行回复进行申诉。申诉成功后，投诉双方进行对话</li>
      <li>会员可确认结束纠纷单，若会员对于卖家的处理不满意可以申请仲裁，最后由后台管理员进行仲裁操作</li>
    </ul>
  </div>
   <div class="flexigrid">
		<div class="mDiv">
			<div class="ftitle">
				<h3>商家投诉列表</h3>
				<h5>(共<?php echo $pager->totalRows; ?>条记录)</h5>
			</div>
			<div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
			<div class="sDiv">
                <form method="post">
                    <div class="sDiv2">
                    <select name="qtype" class="select">
                        <option value="user_name">投诉人&nbsp;&nbsp;</option>
                        <option value="store_name">被投商家&nbsp;&nbsp;</option>
                    </select>
                    <input type="text" size="30" name="q" class="qsbox" placeholder="搜索相关数据...">
                    <input type="submit" class="btn" value="搜索">
                    </div>
                </form>
			</div>
		</div>
		<div class="hDiv">
			<div class="hDivBox">
				<table cellspacing="0" cellpadding="0">
					<thead>
					<tr>
						<th class="sign" axis="col0">
							<div style="width: 24px;"><i class="ico-check"></i></div>
						</th>
						<th align="center" abbr="article_title" axis="col3" class="">
							<div style="text-align: center; width: 100px;" class="">投诉人</div>
						</th>
						<th align="center" abbr="ac_id" axis="col4" class="">
							<div style="text-align: center; width: 200px;" class="">投诉内容</div>
						</th>
						<th align="center" abbr="article_show" axis="col5" class="">
							<div style="text-align: center; width: 100px;" class="">投诉图片</div>
						</th>
						<th align="center" abbr="article_time" axis="col6" class="">
							<div style="text-align: center; width: 150px;" class="">投诉时间</div>
						</th>
						<th align="center" abbr="article_time" axis="col6" class="">
							<div style="text-align: center; width: 100px;" class="">投诉主题</div>
						</th>
						<th align="center" abbr="article_time" axis="col6" class="">
							<div style="text-align: center; width: 100px;" class="">被投商家</div>
						</th>
						<th align="center" abbr="article_time" axis="col6" class="">
							<div style="text-align: center; width: 50px;" class="">投诉人ID</div>
						</th>
						<th align="center" abbr="article_time" axis="col6" class="">
							<div style="text-align: center; width: 50px;" class="">商家ID</div>
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
		<div class="bDiv" style="height: auto;">
			<div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
				<table>
					<tbody>
					<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $k=>$vo): ?>
						<tr>
							<td class="sign">
								<div style="width: 24px;"><i class="ico-check"></i></div>
							</td>
							<td align="center" class="">
								<div style="text-align: center; width: 100px;"><?php echo $vo['user_name']; ?></div>
							</td>
							<td align="center" class="">
								<div style="text-align: center; width: 200px;"><?php echo $vo['complain_content']; ?></div>
							</td>
							<td align="center" class="">
								<div style="text-align: center; width: 100px;">
								<?php if(is_array($vo['complain_pic']) || $vo['complain_pic'] instanceof \think\Collection || $vo['complain_pic'] instanceof \think\Paginator): if( count($vo['complain_pic'])==0 ) : echo "" ;else: foreach($vo['complain_pic'] as $key=>$vr): ?>
								<a href="<?php echo $vr; ?>" target="_blank" class="pic-thumb-tip"><img src="<?php echo $vr; ?>" height="36" width="36"></a>
								<?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</td>
							<td align="center" class="">
								<div style="text-align: center; width: 150px;"><?php echo date('Y-m-d H:i:s',$vo['complain_time']); ?></div>
							</td>
							<td align="center" class="">
								<div style="text-align: center; width: 100px;"><?php echo $vo['complain_subject_name']; ?></div>
							</td>
							<td align="center" class="">
								<div style="text-align: center; width: 100px;"><?php echo $vo['store_name']; ?></div>
							</td>
							<td align="center" class="">
								<div style="text-align: center; width: 50px;"><?php echo $vo['user_id']; ?></div>
							</td>
							<td align="center" class="">
								<div style="text-align: center; width: 50px;"><?php echo $vo['store_id']; ?></div>
							</td>
							<td align="center" class="handle">
								<div style="text-align: center; width: 170px; max-width:170px;">
									<?php if($vo[complain_state] < 4): ?>
									<a class="btn orange" href="<?php echo U('Service/complain_detail',array('complain_id'=>$vo[complain_id])); ?>"><i class="fa fa-gavel"></i>处理</a>
									<?php else: ?>
									<a class="btn orange" href="<?php echo U('Service/complain_detail',array('complain_id'=>$vo[complain_id])); ?>"><i class="fa fa-list-alt"></i>查看</a>
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
		<!--分页位置--><?php echo $page; ?> 
	</div>
</div>
<script type="text/javascript">

</script> 
</body>
</html>