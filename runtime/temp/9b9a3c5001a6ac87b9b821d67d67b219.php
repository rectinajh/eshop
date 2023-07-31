<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:42:"./application/admin/view2/system/prop.html";i:1532661068;s:44:"./application/admin/view2/public/layout.html";i:1532661068;}*/ ?>
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
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>新淘链比例设置</h3>
                <h5>网站全局内容比例设置</h5>
            </div>
            <ul class="tab-base nc-row">
                <?php if(is_array($group_list) || $group_list instanceof \think\Collection || $group_list instanceof \think\Paginator): if( count($group_list)==0 ) : echo "" ;else: foreach($group_list as $k=>$v): ?>
                    <li><a href="<?php echo U('System/index',['inc_type'=> $k]); ?>" <?php if($k==$inc_type): ?>class="current"<?php endif; ?>><span><?php echo $v; ?></span></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <!-- 操作说明 -->
    <div class="explanation" id="explanation">
        <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
            <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
            <span id="explanationZoom" title="收起提示"></span></div>
        <ul>
            <li>新淘链基本设置，商城及其他模块相关内容在其各自栏目设置项内进行操作。</li>
        </ul>
    </div>
    <form method="post" enctype="multipart/form-data" name="form1" action="<?php echo U('System/prop'); ?>">
        <input type="hidden" name="inc_type" value="<?php echo $inc_type; ?>">
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label for="one_consume">一级算力要求</label>
                </dt>
                <dd class="opt">
                    <input  id="one_consume" name="one_consume" value="<?php echo $prop['one_consume']; ?>" class="input-txt" type="text">
                    <p class="notic">一级算力要求</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="one_percent">一级算力百分比奖励</label>
                </dt>
                <dd class="opt">
                    <input  id="one_percent" name="one_percent" value="<?php echo $prop['one_percent']; ?>" class="input-txt" type="text">
                    <p class="notic">一级算力百分比奖励</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="two_consume">二级算力要求</label>
                </dt>
                <dd class="opt">
                    <input  id="two_consume" name="two_consume" value="<?php echo $prop['two_consume']; ?>" class="input-txt" type="text">
                    <p class="notic">二级算力要求</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="two_percent">二级算力百分比奖励</label>
                </dt>
                <dd class="opt">
                    <input  id="two_percent" name="two_percent" value="<?php echo $prop['two_percent']; ?>" class="input-txt" type="text">
                    <p class="notic">二级算力百分比奖励</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="three_consume">三级算力要求</label>
                </dt>
                <dd class="opt">
                    <input  id="three_consume" name="three_consume" value="<?php echo $prop['three_consume']; ?>" class="input-txt" type="text">
                    <p class="notic">三级算力要求</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="three_percent">三级算力百分比奖励</label>
                </dt>
                <dd class="opt">
                    <input  id="three_percent" name="three_percent" value="<?php echo $prop['three_percent']; ?>" class="input-txt" type="text">
                    <p class="notic">三级算力百分比奖励</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="four_consume">四级算力要求</label>
                </dt>
                <dd class="opt">
                    <input  id="four_consume" name="four_consume" value="<?php echo $prop['four_consume']; ?>" class="input-txt" type="text">
                    <p class="notic">四级算力要求</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="four_percent">四级算力百分比奖励</label>
                </dt>
                <dd class="opt">
                    <input  id="four_percent" name="four_percent" value="<?php echo $prop['four_percent']; ?>" class="input-txt" type="text">
                    <p class="notic">四级算力百分比奖励</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="five_consume">五级算力要求</label>
                </dt>
                <dd class="opt">
                    <input  id="five_consume" name="five_consume" value="<?php echo $prop['five_consume']; ?>" class="input-txt" type="text">
                    <p class="notic">五级算力要求</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="five_percent">五级算力百分比奖励</label>
                </dt>
                <dd class="opt">
                    <input  id="five_percent" name="five_percent" value="<?php echo $prop['five_percent']; ?>" class="input-txt" type="text">
                    <p class="notic">五级算力百分比奖励</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="global_consume">全球算力百分比</label>
                </dt>
                <dd class="opt">
                    <input  id="global_consume" name="global_consume" value="<?php echo $prop['global_consume']; ?>" class="input-txt" type="text">
                    <p class="notic">全球算力百分比</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="one_role">直接奖励百分比</label>
                </dt>
                <dd class="opt">
                    <input  id="one_role" name="one_role" value="<?php echo $prop['one_role']; ?>" class="input-txt" type="text">
                    <p class="notic">直接分享区块动能算力额外奖励百分比</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="two_role">创业奖励百分比</label>
                </dt>
                <dd class="opt">
                    <input  id="two_role" name="two_role" value="<?php echo $prop['two_role']; ?>" class="input-txt" type="text">
                    <p class="notic">创业合伙区块动能算力额外奖励百分比</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="three_role">经销奖励百分比</label>
                </dt>
                <dd class="opt">
                    <input  id="three_role" name="three_role" value="<?php echo $prop['three_role']; ?>" class="input-txt" type="text">
                    <p class="notic">经销推广区块动能算力额外奖励百分比</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="four_role">代理奖励百分比</label>
                </dt>
                <dd class="opt">
                    <input  id="four_role" name="four_role" value="<?php echo $prop['four_role']; ?>" class="input-txt" type="text">
                    <p class="notic">代理区域区块动能算力额外奖励百分比</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="five_role">股东奖励百分比</label>
                </dt>
                <dd class="opt">
                    <input  id="five_role" name="five_role" value="<?php echo $prop['five_role']; ?>" class="input-txt" type="text">
                    <p class="notic">股东合伙区块动能算力额外奖励百分比</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="vis_role">平级算力</label>
                </dt>
                <dd class="opt">
                    <input  id="vis_role" name="vis_role" value="<?php echo $prop['vis_role']; ?>" class="input-txt" type="text">
                    <p class="notic">平级算力</p>
                </dd>
            </dl>
          	<dl class="row">
                <dt class="tit">
                    <label for="static_minimum_guarantee">静态奖励最低保底奖励</label>
                </dt>
                <dd class="opt">
                    <input  id="static_minimum_guarantee" name="static_minimum_guarantee" value="<?php echo $prop['static_minimum_guarantee']; ?>" class="input-txt" type="text">
                    <p class="notic">没有消费业绩时,静态奖励的最小保底奖励值</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="static_deduct">静态超额扣除百分比</label>
                </dt>
                <dd class="opt">
                    <input  id="static_deduct" name="static_deduct" value="<?php echo $prop['static_deduct']; ?>" class="input-txt" type="text">
                    <p class="notic">静态超额扣除百分比</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="static_capping">静态封顶</label>
                </dt>
                <dd class="opt">
                    <input  id="static_capping" name="static_capping" value="<?php echo $prop['static_capping']; ?>" class="input-txt" type="text"><span>倍</span>
                    <p class="notic">静态封顶倍数</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="two_capping">创业合伙人封顶</label>
                </dt>
                <dd class="opt">
                    <input  id="two_capping" name="two_capping" value="<?php echo $prop['two_capping']; ?>" class="input-txt" type="text">
                    <p class="notic">创业合伙人封顶</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="three_capping">经销商封顶</label>
                </dt>
                <dd class="opt">
                    <input  id="three_capping" name="three_capping" value="<?php echo $prop['three_capping']; ?>" class="input-txt" type="text">
                    <p class="notic">经销商封顶</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="four_capping">代理商封顶</label>
                </dt>
                <dd class="opt">
                    <input  id="four_capping" name="four_capping" value="<?php echo $prop['four_capping']; ?>" class="input-txt" type="text">
                    <p class="notic">代理商封顶</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="five_capping">股东合伙人封顶</label>
                </dt>
                <dd class="opt">
                    <input  id="five_capping" name="five_capping" value="<?php echo $prop['five_capping']; ?>" class="input-txt" type="text">
                    <p class="notic">股东合伙人封顶</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="dynamic_day_capping">动态算力日封顶</label>
                </dt>
                <dd class="opt">
                    <input  id="dynamic_day_capping" name="dynamic_day_capping" value="<?php echo $prop['dynamic_day_capping']; ?>" class="input-txt" type="text">
                    <p class="notic">动态算力日封顶</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="one_min_consume">一级算力最低要求</label>
                </dt>
                <dd class="opt">
                    <input  id="one_min_consume" name="one_min_consume" value="<?php echo $prop['one_min_consume']; ?>" class="input-txt" type="text">
                    <p class="notic">一级算力最低要求</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="two_min_consume">二级算力最低要求</label>
                </dt>
                <dd class="opt">
                    <input  id="two_min_consume" name="two_min_consume" value="<?php echo $prop['two_min_consume']; ?>" class="input-txt" type="text">
                    <p class="notic">二级算力最低要求</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="three_min_consume">三级算力最低要求</label>
                </dt>
                <dd class="opt">
                    <input  id="three_min_consume" name="three_min_consume" value="<?php echo $prop['three_min_consume']; ?>" class="input-txt" type="text">
                    <p class="notic">三级算力最低要求</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="four_min_consume">四级算力最低要求</label>
                </dt>
                <dd class="opt">
                    <input  id="four_min_consume" name="four_min_consume" value="<?php echo $prop['four_min_consume']; ?>" class="input-txt" type="text">
                    <p class="notic">四级算力最低要求</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="five_min_consume">五级算力最低要求</label>
                </dt>
                <dd class="opt">
                    <input  id="five_min_consume" name="five_min_consume" value="<?php echo $prop['five_min_consume']; ?>" class="input-txt" type="text">
                    <p class="notic">五级算力最低要求</p>
                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">
                    <label for="ti_money">提现币每日提现上限</label>
                </dt>
                <dd class="opt">
                    <input  id="ti_money" name="ti_money" value="<?php echo $prop['ti_money']; ?>" class="input-txt" type="text">
                    <p class="notic">提现币每日提现上限</p>
                </dd>
            </dl>

            <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" onclick="document.form1.submit()">确认提交</a></div>
        </div>
    </form>
</div>
<script type="text/javascript">

</script>
<div id="goTop">
    <a href="JavaScript:void(0);" id="btntop">
        <i class="fa fa-angle-up"></i>
    </a>
    <a href="JavaScript:void(0);" id="btnbottom">
        <i class="fa fa-angle-down"></i>
    </a>
</div>
</body>
</html>