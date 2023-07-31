<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:53:"./application/admin/view2/system/goldchain_trade.html";i:1532661069;s:44:"./application/admin/view2/public/layout.html";i:1532661069;}*/ ?>
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
<style>
    .fanui-btn {
        background:#fff;
        border: 1px solid #dcdcdc;
        border-radius: 6px;
        padding: 4px 20px;
    }
    .fanui-btn-primary {
        border: 1px solid transparent;
        color: #fff;
        background: #2cbca3;
    }
    .fanui-btn-primary:hover {
        background: #03dab5; 
    }
    .fanui-btn-danger {
        border: 1px solid transparent;
        color: #fff;
        background: #fba20a;
    }
    .fanui-btn-danger:hover {
        background: #FF5722;
    }

    #btnAddRatio {
        margin-left:20px;
    }
    #tradeRatio {
        width: 360px;
    }
    #tradeRatio input[type=text] {
        width: 60px;
        text-align: right;
    }
    #tradeRatio th {
        width: 100px;
    }
</style>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>新淘链交易设置</h3>
                <h5>新淘链交易参数</h5>
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
    <form method="post" enctype="multipart/form-data" name="form1" action="<?php echo U('System/goldchain_trade'); ?>">
        <input type="hidden" name="inc_type" value="<?php echo $inc_type; ?>">
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label for="distribut_min">交易开关</label>
                </dt>
                <dd class="opt">
                    <input name="allowTrade" value="1" type="radio" <?php echo !empty($config['allowTrade']) && $config['allowTrade']==1?' checked' : ''; ?>>开启
                    <input name="allowTrade" value="0" type="radio" <?php echo !empty($config['allowTrade']) && $config['allowTrade']==1?'' : ' checked'; ?>>关闭
                    <p class="notic">关闭后将仅允许测试人员交易</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="init_price">初始开盘价</label>
                </dt>
                <dd class="opt">
                    <input  id="init_price" name="init_price" value="<?php echo $config['init_price']; ?>" class="input-txt" type="text" <?php echo $disabled; ?> >
                    <p class="notic">系统初始开盘价(系统没有任何一笔交易时取的价格，一旦产生交易就不可再更改)</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="tomorrow_open_price">明日开盘价</label>
                </dt>
                <dd class="opt">
                    <input  id="tomorrow_open_price" name="inherit_price" value="<?php echo $inherit_price; ?>" class="input-txt" type="text">
                    <span>当前参考价格：<?php echo $close_price; ?></span>
                    <p class="notic">如需要人工干预，则需要每天设定，不设定默认取今日收盘价</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="float_ratio">价格浮动比例</label>
                </dt>
                <dd class="opt">
                    <input  id="float_ratio" name="float_ratio" value="<?php echo $config['float_ratio']; ?>" class="input-txt" type="text"><span>%</span>
                    <p class="notic">正常挂卖时，用户输入价格的可浮动比例</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="import_goldchain_price">导入会员交易价格</label>
                </dt>
                <dd class="opt">
                    <input  id="import_goldchain_price" name="import_goldchain_price" value="<?php echo $config['import_goldchain_price']; ?>" class="input-txt" type="text"><span></span>
                    <p class="notic">导入的旧系统会员挂卖交易时新淘链的价格</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="import_goldchain_limit_day">导入会员交易限制天数</label>
                </dt>
                <dd class="opt">
                    <input  id="import_goldchain_limit_day" name="import_goldchain_limit_day" value="<?php echo $config['import_goldchain_limit_day']; ?>" class="input-txt" type="text"><span>%</span>
                    <p class="notic">导入会员交易限制天数</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="float_ratio">每日最高挂卖限制</label>
                </dt>
                <dd class="opt">
                    <input  id="limit_ratio" name="limit_ratio" value="<?php echo $config['limit_ratio']; ?>" class="input-txt" type="text"><span>%</span>
                    <p class="notic">每天最高挂卖持有数量的百分比,如果不设置或为0则不限制</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="float_ratio">手续费</label>
                </dt>
                <dd class="opt">
                    <div style="background:#fff">
                        <div style="clear:both;"></div>
                        <p class="notic">说明：手续费是在交易成功之后才从提现币中扣除</p>
                        <table id="tradeRatio" class="store-joinin" cellspacing="0" cellpadding="0" border="0">
                            <thead>
                                <tr>
                                    <th>挂卖比例(大于等于)</th>
                                    <th>手续费</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($trade_limit) || $trade_limit instanceof \think\Collection || $trade_limit instanceof \think\Paginator): $i = 0; $__LIST__ = $trade_limit;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <tr>
                                        <td><input name="trade_limit[ratio][]" type="text" value="<?php echo $vo['ratio']; ?>">%</td>
                                        <td><input name="trade_limit[poundage][]" type="text" value="<?php echo $vo['poundage']; ?>">%</td>
                                        <td><button class="delRatio fanui-btn fanui-btn-danger" type="button">删除</button></td>
                                    </tr>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <label><span>交易比例：</span><input id="trade_limit_ratio" type="text" value="" placeholder="请输入比例">% ， </label>
                        <label><span>手续费比例：</span><input id="trade_limit_poundage" type="text" value="" placeholder="请输入手续费">%</label>
                        <button id="btnAddRatio" class="fanui-btn" type="button">添加</button>
                        <div style="clear:both;"></div>
                    </div>
                </dd>
            </dl>
            <div class="bot">
                <a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" onclick="document.form1.submit()">确认提交</a>
            </div>
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
<script>
    $(function() {
        $(document).on('click', 'button.delRatio', function() {
            $(this).parent().parent().remove();
        });
        $('#btnAddRatio').click(function() {
            var ratio = $('#trade_limit_ratio').val(), poundage = $('#trade_limit_poundage').val();
            var str = 
            `<tr>
                <td><input name="trade_limit[ratio][]" type="text" value="${ratio}">%</td>
                <td><input name="trade_limit[poundage][]" type="text" value="${poundage}">%</td>
                <td><button class="delRatio fanui-btn fanui-btn-danger" type="button">删除</button></td>
            </tr>`;
            $('#tradeRatio tbody').append(str);
        });
    });
</script>
</html>