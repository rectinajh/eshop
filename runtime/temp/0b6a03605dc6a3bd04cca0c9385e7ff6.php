<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:43:"./application/admin/view2/article/link.html";i:1532661068;s:44:"./application/admin/view2/public/layout.html";i:1532661068;}*/ ?>
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
                <h3>友情链接管理 - 编辑友情链接</h3>
                <h5>网站系统友情链接管理</h5>
            </div>
        </div>
    </div>
    <form class="form-horizontal" id="handleposition" action="<?php echo U('Admin/Article/linkHandle'); ?>" method="post">
        <input type="hidden" name="act" value="<?php echo $act; ?>">
        <input type="hidden" name="link_id" value="<?php echo $info['link_id']; ?>">
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label for="link_name"><em>*</em>链接名称</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="link_name" value="<?php echo $info['link_name']; ?>" id="link_name" class="input-txt">
                    <span class="err"></span>
                    <p class="notic">请填写友情链接的名称</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="link_url"><em>*</em>链接地址</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="link_url" value="<?php echo $info['link_url']; ?>"id="link_url" class="input-txt">
                    <span class="err"></span>
                    <p class="notic">友情链接跳转地址</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="orderby"><em>*</em>排序</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="orderby" value="<?php echo $info['orderby']; ?>" id="orderby" class="input-txt">
                    <span class="err"></span>
                    <p class="notic">请填写自然数，友情链接会根据排序进行由小到大排列显示</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="link_logo">链接LOGO</label>
                </dt>
                <dd class="opt">
                    <div class="input-file-show">
                        <span class="show">
                            <a class="nyroModal" rel="gal" href="<?php echo $info['link_logo']; ?>" target="_blank">
                                <i class="fa fa-picture-o" onmouseover="layer.tips('<img src=<?php echo $info['link_logo']; ?>>',this,{tips: [1, '#fff']})" onmouseout="layer.closeAll();"></i>
                            </a>
                        </span>
           	            <span class="type-file-box">
                            <input type="text" id="link_logo" name="link_logo" value="<?php echo $info['link_logo']; ?>" class="type-file-text">
                            <input type="button" name="button" id="button1" value="选择上传..." class="type-file-button">
                            <input class="type-file-file" onClick="GetUploadify(1,'link_logo','link','')" size="30" hidefocus="true" nc_type="change_site_logo" title="点击前方预览图可查看大图，点击按钮选择文件并提交表单后上传生效">
                        </span>
                    </div>
                    <span class="err"></span>
                    <p class="notic">默认网站LOGO,通用头部显示，最佳显示尺寸为240*60像素</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>是否新窗口打开</label>
                </dt>
                <dd class="opt">
                    <div class="onoff">
                        <label for="target1" class="cb-enable <?php if($info[target] == 1): ?>selected<?php endif; ?>">是</label>
                        <label for="target0" class="cb-disable <?php if($info[target] == 0): ?>selected<?php endif; ?>">否</label>
                        <input id="target1" name="target" value="1" type="radio" <?php if($info[target] == 1): ?> checked="checked"<?php endif; ?>>
                        <input id="target0" name="target" value="0" type="radio" <?php if($info[target] == 0): ?> checked="checked"<?php endif; ?>>
                    </div>
                    <p class="notic">点击链接是否在新窗口打开</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>是否显示</label>
                </dt>
                <dd class="opt">
                    <div class="onoff">
                        <label for="is_show1" class="cb-enable <?php if($info[is_show] == 1): ?>selected<?php endif; ?>">是</label>
                        <label for="is_show0" class="cb-disable <?php if($info[is_show] == 0): ?>selected<?php endif; ?>">否</label>
                        <input id="is_show1" name="is_show" value="1" type="radio" <?php if($info[is_show] == 1): ?> checked="checked"<?php endif; ?>>
                        <input id="is_show0" name="is_show" value="0" type="radio" <?php if($info[is_show] == 0): ?> checked="checked"<?php endif; ?>>
                    </div>
                    <p class="notic">是否在前台显示</p>
                </dd>
            </dl>
            <div class="bot"><a href="JavaScript:void(0);" onclick="$('#handleposition').submit();" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a></div>
        </div>
    </form>
</div>
<script type="text/javascript">

</script>
</body>
</html>