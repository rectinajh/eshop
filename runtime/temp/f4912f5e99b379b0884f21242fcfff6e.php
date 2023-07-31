<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:50:"./application/admin/view2/user/add_Importuser.html";i:1532661068;s:44:"./application/admin/view2/public/layout.html";i:1532661068;}*/ ?>
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
                <h3>会员管理 - 导入会员</h3>
                <h5>网站系统导入会员</h5>
            </div>
        </div>
    </div>
    <form class="form-horizontal" method="post" id="add_form">
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label for="nickname"><em>*</em>会员昵称</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="nickname" id="nickname" class="input-txt">
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="password"><em>*</em>登录密码</label>
                </dt>
                <dd class="opt">
                    <input type="password" name="password" id="password" class="input-txt">
                    <span class="err"></span>
                    <p class="notic">6-16位字母数字符号组合</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="mobile"><em>*</em>手机号码</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="mobile" id="mobile" class="input-txt" maxlength="11" onkeyup="this.value=this.value.replace(/[^\d]/g,'')">
                    <span class="err"></span>
                    <p class="notic">前台登陆账号，手机邮箱任意一项都可以</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="email"><em>*</em>邮件地址</label>
                </dt>
                <dd class="opt">
                     <input type="text" name="email" id="email" class="input-txt" >
                    <span class="err"></span>
                    <p class="notic">前台登陆账号，手机邮箱任意一项都可以</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="jin_num"><em>*</em>新淘链</label>
                </dt>
                <dd class="opt">
                     <input type="text" name="jin_num" id="jin_num" class="input-txt" >
                    <span class="err"></span>
                    <p class="notic">给用户直接充值的新淘链</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="id_number"><em>*</em>身份证号</label>
                </dt>
                <dd class="opt">
                     <input type="text" name="id_number" id="id_number" class="input-txt" >
                    <span class="err"></span>
                    <p class="notic">该用户身份证号</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="mobile"><em>*</em>推荐人手机号码</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="tuimobile" id="tuimobile" class="input-txt" maxlength="11" onkeyup="this.value=this.value.replace(/[^\d]/g,'')">
                    <span class="err"></span>
                    <p class="notic">推荐人手机号码必填</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="paypwd"><em>*</em>支付密码</label>
                </dt>
                <dd class="opt">
                    <input type="password" name="paypwd" id="paypwd" class="input-txt">
                    <span class="err"></span>
                    <p class="notic">6-16位字母数字符号组合</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="qq"><em>*</em>QQ</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo $navigation['url']; ?>" name="qq" id="qq" class="input-txt">
                    <span class="err"></span>
                    <p class="notic">QQ</p>
                </dd>
            </dl>
            <div class="bot"><a href="JavaScript:void(0);" onclick="checkUserUpdate();" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a></div>
        </div>
    </form>
</div>
<script type="text/javascript">
    function checkUserUpdate(){
        var email = $('input[name="email"]').val();
        var mobile = $('input[name="mobile"]').val();
        var tuimobile = $('input[name="tuimobile"]').val();
        var password = $('input[name="password"]').val();
        var nickname = $.trim($('input[name="nickname"]').val());
        var jin_num = $.trim($('input[name="jin_num"]').val());
        var paypwd = $.trim($('input[name="paypwd"]').val());
        var id_number = $.trim($('input[name="id_number"]').val());
        var error ='';
        if(nickname == ''){
            error += "昵称不能为空\n";
        }
        if(password == ''){
            error += "密码不能为空\n";
        }
        if(password.length<6 || password.length>16){
            error += "密码长度不正确\n";
        }
        if(!checkEmail(email) && email != ''){
            error += "邮箱地址有误\n";
        }
        if(!checkMobile(mobile) && mobile != ''){
            error += "手机号码填写有误\n";
        }
        if(!checkMobile(tuimobile) && tuimobile != ''){
            error += "手机号码填写有误\n";
        }
        if(email == '' && mobile ==''){
            error += "手机和邮箱请至少填一项\n";
        }
        if(jin_num < 0){
            error += "新淘链不能小于0\n";
        }
        if(paypwd == ''){
            error += "支付密码不能为空\n";
        }
        if(paypwd.length<6 || paypwd.length>16){
            error += "密码长度不正确\n";
        }
        if(id_number == ''){
            error += "身份证号不能为空\n";
        }
        if(error){
            layer.alert(error, {icon: 2});  //alert(error);
            return false;
        }
        $('#add_form').submit();
    }
</script>
</body>
</html>