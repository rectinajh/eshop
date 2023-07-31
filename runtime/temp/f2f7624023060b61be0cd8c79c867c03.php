<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:47:"./application/admin/view2/admin/admin_info.html";i:1532661068;s:44:"./application/admin/view2/public/layout.html";i:1532661068;}*/ ?>
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
                <h3>管理员 - 编辑管理员</h3>
                <h5>网站系统管理员资料</h5>
            </div>
        </div>
    </div>
    <form class="form-horizontal" id="adminHandle" action="<?php echo U('Admin/adminHandle'); ?>" method="post">
        <input type="hidden" name="act" value="<?php echo $act; ?>">
        <input type="hidden" name="admin_id" value="<?php echo $info['admin_id']; ?>">
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label for="user_name"><em>*</em>用户名</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="user_name" value="<?php echo $info['user_name']; ?>" id="user_name" class="input-txt">
                    <span class="err">用户名不能为空!</span>
                    <p class="notic">用户名</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="email"><em>*</em>Email地址</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="email" value="<?php echo $info['email']; ?>" id="email" class="input-txt">
                    <span class="err">Email地址不能为空!</span>
                    <p class="notic">Email地址</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="password"><em>*</em>登陆密码</label>
                </dt>
                <dd class="opt">
                    <input type="password" name="password" value="<?php echo $info['password']; ?>" id="password" class="input-txt">
                    <span class="err">登陆密码不能为空!</span>
                    <p class="notic">登陆密码</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="password"><em>*</em>确认登录密码</label>
                </dt>
                <dd class="opt">
                    <input type="password" name="password2" value="<?php echo $info['password']; ?>" id="password2" class="input-txt">
                    <span class="err">登陆密码不能为空!</span>
                    <p class="notic">登陆密码</p>
                </dd>
            </dl>
            <?php if($info['admin_id'] == 1): ?>
            <dl class="row">
                <dt class="tit">
                    <label for="password"><em>*</em>支付密码</label>
                </dt>
                <dd class="opt">
                    <input type="password" name="paypwd" value="<?php echo $info['paypwd']; ?>" id="paypwd" class="input-txt">
                    <span class="err">支付密码不能为空!</span>
                    <p class="notic">支付密码</p>
                </dd>
            </dl>
            <?php endif; if(($act == 'add') OR ($info['admin_id'] > 1)): ?>
                <dl class="row">
                    <dt class="tit">
                        <label for="role_id"><em>*</em>所属角色</label>
                    </dt>
                    <dd class="opt">
                        <select name="role_id">
                            <?php if(is_array($role) || $role instanceof \think\Collection || $role instanceof \think\Paginator): $i = 0; $__LIST__ = $role;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo $item['role_id']; ?>" <?php if($item[role_id] == $info[role_id]): ?> selected="selected"<?php endif; ?> ><?php echo $item['role_name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <span class="err"></span>
                        <p class="notic">所属角色</p>
                    </dd>
                </dl>
            <?php endif; ?>
            <div class="bot"><a href="JavaScript:void(0);" onclick="adsubmit();" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a></div>
        </div>
    </form>
</div>
<script type="text/javascript">
    // 判断输入框是否为空
    function adsubmit(){
        var password =$('input[name=password]').val();
        var password2 =$('input[name=password2]').val();
        if($('input[name=user_name]').val() == ''){
            layer.msg('用户名不能为空！', {icon: 2,time: 1000});   //alert('少年，用户名不能为空！');
            return false;
        }
        if($('input[name=email]').val() == ''){
            layer.msg('邮箱不能为空！', {icon: 2,time: 1000});//alert('少年，邮箱不能为空！');
            return false;
        }
        if($('input[name=password]').val() == ''){
            layer.msg('密码不能为空！', {icon: 2,time: 1000});//alert('少年，密码不能为空！');
            return false;
        }
        if(password != password2){
            layer.msg('两次输入登录密码不一致！', {icon: 2,time: 1000});
            return false;
        }
        $.ajax({
            type:'POST',
            url:"<?php echo U('Admin/Admin/adminHandle'); ?>",
            data:$('#adminHandle').serialize(),
            dataType:'JSON',
            success:function(data){
                if(data.status == 1){
                    layer.alert(data.msg, {icon: 1});
                    window.location.href=data.url;
                }else{
                    layer.alert(data.msg, {icon: 2});
                }
            },
            error:function(){
                layer.alert('网络连接失败，请稍后再试', {icon: 2});
            }
        })
    }
</script>
</body>
</html>