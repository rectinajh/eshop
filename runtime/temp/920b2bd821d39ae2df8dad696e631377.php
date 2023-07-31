<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"./application/admin/view2/system/shopping.html";i:1532661068;s:44:"./application/admin/view2/public/layout.html";i:1532661068;}*/ ?>
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
                <h3>商城设置</h3>
                <h5>网站全局内容基本选项设置</h5>
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
            <span id="explanationZoom" title="收起提示"></span> </div>
        <ul>
            <li>网站全局基本设置，商城及其他模块相关内容在其各自栏目设置项内进行操作。</li>
        </ul>
    </div>
    <form method="post" enctype="multipart/form-data" name="form1" action="<?php echo U('System/handle'); ?>">
        <input type="hidden" name="form_submit" value="ok" />
        <div class="ncap-form-default">
            <!-- <dl class="row">
                <dt class="tit">
                    <label for="point_rate">积分换算比例</label>
                </dt>
                <dd class="opt">
                    <input type="radio" id="point_rate" name="point_rate" value="1"  <?php if($config[point_rate] == 1): ?> checked <?php endif; ?> >1元 = 1积分  &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="point_rate" value="10" <?php if($config[point_rate] == 10): ?> checked <?php endif; ?> >1元 = 10积分  &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="point_rate" value="100"<?php if($config[point_rate] == 100): ?> checked <?php endif; ?> >1元 = 100积分
                    <p class="notic">积分换算比例</p>
                </dd>
            </dl> -->
                      <dl class="row">
                <dt class="tit">
                    <label for="point_rate">积分换算比例</label>
                </dt>
                <dd class="opt">
                    <input type="radio" id="point_rate" name="point_rate" value="1"  <?php if($config[point_rate] == 1): ?> checked <?php endif; ?> >1元 = 1积分  &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="point_rate" value="10" <?php if($config[point_rate] == 10): ?> checked <?php endif; ?> >1元 = 10积分  &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="point_rate" value="100"<?php if($config[point_rate] == 100): ?> checked <?php endif; ?> >1元 = 100积分
                    <p class="notic">积分换算比例</p >
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="consume_cp">算力换算比例</label>
                </dt>
                <dd class="opt">
                    <input type="text" id="consume_cp" name="consume_cp" value="<?php echo (isset($config['consume_cp']) && ($config['consume_cp'] !== '')?$config['consume_cp']:'0'); ?>" class="input-txt">1元 = <?php echo (isset($config['consume_cp']) && ($config['consume_cp'] !== '')?$config['consume_cp']:'0'); ?>算力
                    <p class="notic">积分换算比例</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>赠送积分比例</label>
                </dt>
                <dd class="opt">
                    <input pattern="^\d{1,}$" name="point_send_limit" value="<?php echo (isset($config['point_send_limit']) && ($config['point_send_limit'] !== '')?$config['point_send_limit']:'50'); ?>" class="input-txt" type="text">
                    <span class="err">%</span>
                    <p class="notic">发布商品, 赠送积分限制: 100表示不限制, 50时购买该商品赠送的积分所抵扣金额不能超过商品价格的50%</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>最低使用限制</label>
                </dt>
                <dd class="opt">
                    <input pattern="^\d{1,}$" name="point_min_limit" value="<?php echo (isset($config['point_min_limit']) && ($config['point_min_limit'] !== '')?$config['point_min_limit']:'0'); ?>" class="input-txt" type="text">
                    <p class="notic">购买商品, 使用积分时: 0表示不限制, 大于0时, 用户积分小于该值将不能使用积分</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>使用比例</label>
                </dt>
                <dd class="opt">
                    <input pattern="^\d{1,}$" name="point_use_percent" value="<?php echo (isset($config['point_use_percent']) && ($config['point_use_percent'] !== '')?$config['point_use_percent']:'50'); ?>" class="input-txt" type="text">
                    <span class="err">%</span>
                    <p class="notic">购买商品, 使用积分时: 100时不限制, 为0时不能使用积分, 50时积分抵扣金额不能超过该笔订单应付金额的50%</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="distribut_date">发货后多少天自动收货</label>
                </dt>
                <dd class="opt">
                    <select name="auto_confirm_date" id="distribut_date">
                        <?php $__FOR_START_1586358244__=1;$__FOR_END_1586358244__=31;for($i=$__FOR_START_1586358244__;$i < $__FOR_END_1586358244__;$i+=1){ ?>
                            <option value="<?php echo $i; ?>" <?php if($config[auto_confirm_date] == $i): ?>selected="selected"<?php endif; ?>><?php echo $i; ?>天</option>
                        <?php } ?>
                    </select>
                    <p class="notic">发货后多少天自动收货</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="auto_transfer_date">收货多少天后订单结算</label>
                </dt>
                <dd class="opt">
                    <select  name="auto_transfer_date" id="auto_transfer_date">
                        <?php $__FOR_START_990625366__=1;$__FOR_END_990625366__=31;for($i=$__FOR_START_990625366__;$i < $__FOR_END_990625366__;$i+=1){ ?>
                            <option value="<?php echo $i; ?>" <?php if($config[auto_transfer_date] == $i): ?>selected="selected"<?php endif; ?>><?php echo $i; ?>天</option>
                        <?php } ?>
                    </select>
                    <p class="notic">收货多少天后,订单结算金额转入卖家平台预存款</p>
                </dd>
            </dl>
            
            <dl class="row">
                <dt class="tit">
                    <label for="distribut_date">申请售后时间段</label>
                </dt>
                <dd class="opt">
                    <select name="auto_service_date" id="auto_service_date">
                        <?php $__FOR_START_1966152860__=1;$__FOR_END_1966152860__=31;for($i=$__FOR_START_1966152860__;$i < $__FOR_END_1966152860__;$i+=1){ ?>
                            <option value="<?php echo $i; ?>" <?php if($config[auto_service_date] == $i): ?>selected="selected"<?php endif; ?>><?php echo $i; ?>天</option>
                        <?php } ?>
                    </select>
                    <p class="notic">申请售后的时间段（交易完成多少天内），换货或维修</p>
                </dd>
            </dl>
            <div class="bot">
                <input type="hidden" name="inc_type" value="<?php echo $inc_type; ?>">
                <a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" onclick="document.form1.submit()">确认提交</a>
            </div>
        </div>
    </form>
</div>
<div id="goTop"> <a href="JavaScript:void(0);" id="btntop"><i class="fa fa-angle-up"></i></a><a href="JavaScript:void(0);" id="btnbottom"><i class="fa fa-angle-down"></i></a></div>
</body>
</html>