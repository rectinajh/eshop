<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:43:"./application/admin/view2/system/basic.html";i:1547036508;s:44:"./application/admin/view2/public/layout.html";i:1532661068;}*/ ?>
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
            <span id="explanationZoom" title="收起提示"></span></div>
        <ul>
            <li>网站全局基本设置，商城及其他模块相关内容在其各自栏目设置项内进行操作。</li>
        </ul>
    </div>
    <form method="post" enctype="multipart/form-data" name="form1" action="<?php echo U('System/handle'); ?>">
        <input type="hidden" name="inc_type" value="<?php echo $inc_type; ?>">
        <div class="ncap-form-default">
            <!-- <dl class="row">
                <dt class="tit">
                    <label for="reg_integral">会员注册赠送积分</label>
                </dt>
                <dd class="opt">
                    <input onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" onpaste="this.value=this.value.replace(/[^\d]/g,'')" pattern="^\d{1,}$" id="reg_integral" name="reg_integral" value="<?php echo $config['reg_integral']; ?>" class="input-txt" type="text">
                    <span class="err">只能输入整数</span>

                    <p class="notic">会员注册赠送积分</p>
                </dd>
            </dl> -->
            <dl class="row">
                <dt class="tit">
                    <label for="file_size">附件上传大小</label>
                </dt>
                <dd class="opt">
                    <select id="file_size" name="file_size">
                        <option value="1" <?php if($config[file_size] == 1): ?>selected="selected"<?php endif; ?>>1M</option>
                        <option value="2" <?php if($config[file_size] == 2): ?>selected="selected"<?php endif; ?>>2M</option>
                        <option value="3" <?php if($config[file_size] == 3): ?>selected="selected"<?php endif; ?>>3M</option>
                        <option value="5" <?php if($config[file_size] == 4): ?>selected="selected"<?php endif; ?>>5M</option>
                        <option value="10" <?php if($config[file_size] == 10): ?>selected="selected"<?php endif; ?>>10M</option>
                        <option value="50" <?php if($config[file_size] == 50): ?>selected="selected"<?php endif; ?>>50M</option>
                        <option value="100" <?php if($config[file_size] == 100): ?>selected="selected"<?php endif; ?>>100M</option>
                    </select>

                    <p class="notic">附件上传大小限制</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="default_storage">注册后跳转</label>
                </dt>
                <dd class="opt">
                    <input id="reg_jump" class="input-txt" name="reg_jump" type="text" value="<?php echo $config['reg_jump']; ?>">
                    <span class="err">请输入完整URL</span>
                    <p class="notic">留空则跳转至用户中心</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="default_storage">默认库存</label>
                </dt>
                <dd class="opt">
                    <input onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" onpaste="this.value=this.value.replace(/[^\d]/g,'')" pattern="^\d{1,}$" id="default_storage" name="default_storage" value="<?php echo $config['default_storage']; ?>" class="input-txt" type="text">
                    <span class="err">只能输入整数</span>

                    <p class="notic">添加商品的默认库存</p>
                </dd>
            </dl>
            <dl class="row">
                    <dt class="tit">
                        <label for="distribut_min">余额提现是否开启</label>
                    </dt>
                    <dd class="opt">
                        <input name="withdrawals" id="withdrawals" value="1" type="radio" <?php if($config['withdrawals'] == 1): ?>checked<?php endif; ?> >是
                        <input name="withdrawals" id="withdrawals" value="0" type="radio" <?php if($config['withdrawals'] == 0): ?>checked<?php endif; ?> >否
                    </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="distribut_need">提现金额</label>
                </dt>
                <dd class="opt">
                    <input onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" onpaste="this.value=this.value.replace(/[^\d]/g,'')" pattern="^\d{1,}$" name="need" id="distribut_need" value="<?php echo $config['need']; ?>" class="input-txt" type="text">
                    <span class="err">只能输入整数</span>

                    <p class="notic">需超过多少才能提现金额</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="distribut_min">最少提现额度</label>
                </dt>
                <dd class="opt">
                    <input onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" onpaste="this.value=this.value.replace(/[^\d]/g,'')" pattern="^\d{1,}$" name="min" id="distribut_min" value="<?php echo $config['min']; ?>" class="input-txt" type="text">
                    <span class="err">只能输入整数</span>

                    <p class="notic">最少提现多少，才能体现</p>
                </dd>
            </dl>
            <dl class="row">
                    <dt class="tit">
                        <label for="tax">余额提现手续费</label>
                    </dt>
                    <dd class="opt">
                        <input pattern="^(?!0+(?:\.0+)?$)(?:[1-9]\d*|0)(?:\.\d{1,2})?$" onkeyup="this.value=/^\d+\.?\d{0,2}$/.test(this.value) ? this.value : ''" name="fee" id="fee" value="<?php echo $config['fee']; ?>" class="input-txt" type="text">%
                        <span class="err">只能输入数字和小数</span>
                        <p class="notic">当用户提现的时候扣除的费用</p>
                    </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="jin_fee">新淘链转账手续费</label>
                </dt>
                <dd class="opt">
                    <input pattern="^(?!0+(?:\.0+)?$)(?:[1-9]\d*|0)(?:\.\d{1,2})?$" onkeyup="this.value=/^\d+\.?\d{0,2}$/.test(this.value) ? this.value : ''" name="jin_fee" id="jin_fee" value="<?php echo $config['jin_fee']; ?>" class="input-txt" type="text">%
                    <span class="err">只能输入数字和小数</span>
                    <p class="notic">当用户新淘链转账的时候扣除的费用</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="consumeToWithdrawBase">[算力]最小提现基数</label>
                </dt>
                <dd class="opt">
                    <input id="consumeToWithdrawBase" name="consumeToWithdrawBase" value="<?php echo $config['consumeToWithdrawBase']; ?>" class="input-txt" type="text">
                    <span class="err">只能输入整数</span>
                    <p class="notic">算力提现币转换比例</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="consumeToWithdrawRebate">[算力]转换[提现币]比例</label>
                </dt>
                <dd class="opt">
                    <input id="consumeToWithdrawRebate" name="consumeToWithdrawRebate" value="<?php echo $config['consumeToWithdrawRebate']; ?>" class="input-txt" type="text">
                    <span class="err">只能输入整数</span>
                    <p class="notic">算力提现币转换比例</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="consumeToWithdrawFee">算力转提现币手续费</label>
                </dt>
                <dd class="opt">
                    <input id="consumeToWithdrawFee" pattern="^(?!0+(?:\.0+)?$)(?:[1-9]\d*|0)(?:\.\d{1,2})?$" onkeyup="" name="consumeToWithdrawFee" value="<?php echo $config['consumeToWithdrawFee']; ?>" class="input-txt" type="text">%
                    <span class="err">只能输入整数</span>
                    <p class="notic">算力转提现币手续费手续费比例</p>
                </dd>
            </dl>
            <dl class="row">
                    <dt class="tit">
                        <label for="tax">一级认筹推荐奖励百分比</label>
                    </dt>
                    <dd class="opt">
                        <input pattern="^(?!0+(?:\.0+)?$)(?:[1-9]\d*|0)(?:\.\d{1,2})?$" onkeyup="this.value=/^\d+\.?\d{0,2}$/.test(this.value) ? this.value : ''" name="tjone" id="tjone" value="<?php echo $config['tjone']; ?>" class="input-txt" type="text">%
                        <span class="err">只能输入数字和小数</span>
                        <p class="notic">当用户提现的时候扣除的费用</p>
                    </dd>
            </dl>
            <dl class="row">
                    <dt class="tit">
                        <label for="tax">二级认筹推荐奖励百分比</label>
                    </dt>
                    <dd class="opt">
                        <input pattern="^(?!0+(?:\.0+)?$)(?:[1-9]\d*|0)(?:\.\d{1,2})?$" onkeyup="this.value=/^\d+\.?\d{0,2}$/.test(this.value) ? this.value : ''" name="tjtow" id="tjtow" value="<?php echo $config['tjtow']; ?>" class="input-txt" type="text">%
                        <span class="err">只能输入数字和小数</span>
                        <p class="notic">当用户提现的时候扣除的费用</p>
                    </dd>
            </dl>
            <dl class="row">
                    <dt class="tit">
                        <label for="tax">三级认筹推荐奖励百分比</label>
                    </dt>
                    <dd class="opt">
                        <input pattern="^(?!0+(?:\.0+)?$)(?:[1-9]\d*|0)(?:\.\d{1,2})?$" onkeyup="this.value=/^\d+\.?\d{0,2}$/.test(this.value) ? this.value : ''" name="tjthree" id="tjthree" value="<?php echo $config['tjthree']; ?>" class="input-txt" type="text">%
                        <span class="err">只能输入数字和小数</span>
                        <p class="notic">当用户提现的时候扣除的费用</p>
                    </dd>
            </dl>
            <!-- <dl class="row">
                <dt class="tit">
                    <label for="distribut_min">全积分兑换限制</label>
                </dt>
                <dd class="opt">
                    <input onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" onpaste="this.value=this.value.replace(/[^\d]/g,'')" pattern="^\d{1,}$" name="point_day" id="point_day" value="<?php echo $config['point_day']; ?>" class="input-txt" type="text">
                    <span class="err">只能输入整数</span>

                    <p class="notic">限制天数,表示多少天之内能购买</p>
                </dd>
            </dl> -->
            <!-- <dl class="row">
                <dt class="tit">
                    <label for="distribut_min">全积分兑换次数</label>
                </dt>
                <dd class="opt">
                    <input onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" onpaste="this.value=this.value.replace(/[^\d]/g,'')" pattern="^\d{1,}$" name="point_number" id="point_number" value="<?php echo $config['point_number']; ?>" class="input-txt" type="text">
                    <span class="err">只能输入整数</span>

                    <p class="notic">限制次数,表示多少天之内能购买几次</p>
                </dd>
            </dl> -->
            <dl class="row">
                <dt class="tit">
                    <label for="tax">发票税率</label>
                </dt>
                <dd class="opt">
                    <input pattern="^(?!0+(?:\.0+)?$)(?:[1-9]\d*|0)(?:\.\d{1,2})?$" onkeyup="this.value=/^\d+\.?\d{0,2}$/.test(this.value) ? this.value : ''" name="tax" id="tax" value="<?php echo $config['tax']; ?>" class="input-txt" type="text">%
                    <span class="err">只能输入数字和小数</span>
                    <p class="notic">当买家需要发票的时候就要增加[商品金额]*[税率]的费用</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="hot_keywords">首页热门搜索词</label>
                </dt>
                <dd class="opt">
                    <input id="hot_keywords" name="hot_keywords" value="<?php echo $config['hot_keywords']; ?>" class="input-txt" type="text">
                    <span class="err">例如:衣|手机|内衣</span>
                    <p class="notic">商家中心右下侧显示，方便商家遇到问题时咨询</p>
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