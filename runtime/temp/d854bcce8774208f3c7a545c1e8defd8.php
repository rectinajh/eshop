<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:48:"./application/admin/view2/user/account_edit.html";i:1532661069;s:44:"./application/admin/view2/public/layout.html";i:1532661069;}*/ ?>
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
                <h3>会员管理 - 资金调节</h3>
                <h5>网站系统会员管理</h5>
            </div>
        </div>
    </div>
    <form class="form-horizontal" id="delivery-form" method="post">
        <input type="hidden" name="uid" value="<?php echo $user['user_id']; ?>" >
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">金额</dt>
                <dd class="opt">
                    <select id="money_act_type" name="money_act_type">
                        <option value="1">增加</option>
                        <option value="0">减少</option>
                    </select>
                    <input id="user_money" name="user_money" onkeyup="this.value=/^\d+\.?\d{0,2}$/.test(this.value) ? this.value : ''" onfocus="clearInput('frozen_money')" value="0" class="input-txt" type="text">可用余额：￥<?php echo $user['user_money']; ?>
                    <p class="notic">单位元</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">积分</dt>
                <dd class="opt">
                    <select id="point_act_type" name="point_act_type">
                        <option value="1">增加</option>
                        <option value="0">减少</option>
                    </select>
                    <input id="pay_points" name="pay_points" value="0" class="input-txt" type="text">可用积分：<?php echo $user['pay_points']; ?>
                    <p class="notic">整数</p>
                </dd>
            </dl>    
            <dl class="row">
                <dt class="tit">提现币</dt>
                <dd class="opt">
                    <select id="withdraw_act_type" name="withdraw_act_type">
                        <option value="1">增加</option>
                        <option value="0">减少</option>
                    </select>
                    <input id="withdraw_money" name="withdraw_money" value="0" class="input-txt" type="text">可用提现币：<?php echo $user['withdraw_money']; ?>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">新淘链</dt>
                <dd class="opt">
                    <select id="jin_act_type" name="jin_act_type">
                        <option value="1">增加</option>
                        <option value="0">减少</option>
                    </select>
                    <input id="jin_num" name="jin_num" value="0" class="input-txt" type="text">可用新淘链：<?php echo $user['jin_num']; ?>(<label><input type="checkbox" name="jin_num_is_import" value="1" >限制本次操作的交易价格</label>)
                    <p class="notic"></p>
                </dd>
            </dl> 
            <dl class="row">
                <dt class="tit">奉献值</dt>
                <dd class="opt">
                    <select id="dedication_act_type" name="dedication_act_type">
                        <option value="1">增加</option>
                        <option value="0">减少</option>
                    </select>
                    <input id="dedication_money" name="dedication_money" value="0" class="input-txt" type="text">可用奉献值：<?php echo $user['dedication_money']; ?>
                    <p class="notic"></p>
                </dd>
            </dl> 
            <dl class="row">
                <dt class="tit">算力</dt>
                <dd class="opt">
                    <select id="consume_act_type" name="consume_act_type">
                        <option value="1">增加</option>
                        <option value="0">减少</option>
                    </select>
                    <input id="consume_cp" name="consume_cp" value="0" class="input-txt" type="text">可用算力：<?php echo $user['consume_cp']; ?>
                    <p class="notic"></p>
                </dd>
            </dl>             
            <dl class="row">
                <dt class="tit">冻结资金</dt>
                <dd class="opt">
                    <select id="frozen_act_type" name="frozen_act_type">
                        <option value="1">增加冻结资金</option>
                        <option value="0">减少冻结资金</option>
                    </select>
                    <input id="frozen_money" name="frozen_money" onkeyup="this.value=/^\d+\.?\d{0,2}$/.test(this.value) ? this.value : ''" onfocus="clearInput('user_money')" value="0" class="input-txt" type="text">冻结资金：<?php echo $user['frozen_money']; ?>
                    <p class="notic">单位元, 当操作冻结资金时，金额那一栏不用填写数值。</p>
                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">
                    操作备注
                </dt>
                <dd class="opt">
                    <textarea name="desc" class="tarea" rows="6"><?php echo $_REQUEST['desc']; ?></textarea>
                    <span class="err"></span>
                    <p class="notic">请输入操作备注</p>
                </dd>
            </dl>
            <div class="bot"><a href="JavaScript:void(0);" onclick="accountForm()" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a></div>
        </div>
    </form>
</div>
<script type="text/javascript">
    function clearInput(id){
        $('#'+id).val(0);
    }
    function accountForm(){
        $.ajax({
            type:'post',
            data:$('#delivery-form').serialize(),
            url: "<?php echo U('Admin/User/account_edit'); ?>",
            dataType:'JSON',
            success: function(data) {
                if(data.status == 1){
                    alert(data.msg);
                    window.location.href=data.url;
                }else{
                    alert(data.msg);
                }
            },
            error:function(){
                alert('网络连接失败，请稍后再试！');
            }
        });
    }
</script>
</body>
</html>