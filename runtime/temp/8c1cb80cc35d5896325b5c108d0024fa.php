<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:47:"./application/admin/view2/user/sendMessage.html";i:1532661068;s:44:"./application/admin/view2/public/layout.html";i:1532661068;}*/ ?>
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
 
<style type="text/css">
html, body {
	overflow: visible;
}
.page{
	padding: 0px !import;
}
</style>  
<body style="background-color: #FFF; overflow: auto; min-width : auto">
<div id="toolTipLayer" style="position: absolute; z-index: 9999; display: none; visibility: visible; left: 95px; top: 573px;"></div>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div >
  <form class="form-horizontal" id="msg_form" action="<?php echo U('Admin/User/doSendMessage'); ?>" method="post"  >    
  	<input name="call_back" type="hidden" value="call_back" />
    <div class="ncap-form-default">
	<dl class="row">
           <dt class="tit">
               <label for="point_rate"></label>
           </dt>
           <dd class="opt">
               <?php if(count($users) > 0): ?><input id="allvip" type="radio"checked="checked" name="type" value="0">发送给以下会员<?php endif; ?>
                <input id="someonevip" type="radio" <?php if(count($users) == 0): ?>checked="checked"<?php endif; ?> name="type" value="1">发送给全部会员
           </dd>
     </dl>
      <dl class="row">
        <dt class="tit">
          <label for="cate_id"><em></em>会员列表:</label>
        </dt>
        <dd class="opt">
        	<?php if(is_array($users) || $users instanceof \think\Collection || $users instanceof \think\Paginator): $i = 0; $__LIST__ = $users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?>
				<input type="hidden" name="user[]" value="<?php echo $user['user_id']; ?>" />
				<p><span><?php echo $user['user_id']; ?></span>&nbsp;<span><?php echo $user['nickname']; ?></span></p>
         	<?php endforeach; endif; else: echo "" ;endif; ?>
        </dd>
      </dl>  
      <dl class="row">
        <dt class="tit">
          <label for="cate_id"><em></em>发送内容:</label>
        </dt>
        <dd class="opt">
         <textarea name="text" rows="6"  placeholder="发送内容" name="text" id="text" class="tarea" id="subject_desc"><?php echo $keyword['text']; ?></textarea>
        </dd>
      </dl>    
      <input type="hidden" value="<?php echo $keyword['id']; ?>" name="kid">
      <div class="bot"><a href="JavaScript:void(0);" onClick="checkForm()" class="ncap-btn-big ncap-btn-green" id="submitBtn">发送</a></div>
    </div>
  </form>
</div>
<script type="text/javascript">
function checkForm(){
    var text = $('#text').val();
    var error = '';
    if(text == ''){
        error += '站内信内容不能为空 ';
    }
    if(error){
		layer.alert(error, {icon: 2});
        return ;
    }
    $('#msg_form').submit();
}
</script>
</body>
</html>