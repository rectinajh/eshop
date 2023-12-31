<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"./application/admin/view2/finance/store_withdrawals.html";i:1532661069;s:44:"./application/admin/view2/public/layout.html";i:1532661069;}*/ ?>
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
<script src="__ROOT__/public/static/js/layer/laydate/laydate.js"></script>
<body style="background-color: rgb(255, 255, 255); overflow: auto; cursor: default; -moz-user-select: inherit;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>提现申请管理</h3>
                <h5>网站系统提现申请索引与管理</h5>
            </div>
        </div>
    </div>
    <!-- 操作说明 -->
    <div id="explanation" class="explanation" style="color: rgb(44, 188, 163); background-color: rgb(237, 251, 248); width: 99%; height: 100%;">
        <div id="checkZoom" class="title"><i class="fa fa-lightbulb-o"></i>
            <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
            <span title="收起提示" id="explanationZoom" style="display: block;"></span>
        </div>
        <ul>
        	<li>支付宝，微信在线转账需要申请相关支付接口以及设置管理员支付密码</li>
        	<li>拒绝提现的申请记录才能删除</li>
			<li>审核通过的提现申请会进入待付款列表</li>
        </ul>
    </div>
    <div class="flexigrid">
        <div class="mDiv">
            <div class="ftitle">
                <h3>店铺列表</h3>
                <h5>(共<?php echo $pager->totalRows; ?>条记录)</h5>
            </div>
            <div title="刷新数据" class="pReload"><a href=""><i class="fa fa-refresh"></i></a></div>
            <form class="navbar-form form-inline" id="search-form" method="get" action="<?php echo U('store_withdrawals'); ?>" onsubmit="return check_form();">
                <input type="hidden" name="create_time" id="create_time" value="<?php echo $create_time; ?>">
                <div class="sDiv">
                    <div class="sDiv2" style="margin-right: 10px;">
                        <input type="text" size="30" id="start_time" value="<?php echo $start_time; ?>" placeholder="起始时间" class="qsbox">
                        <input type="button" class="btn" value="起始时间">
                    </div>
                    <div class="sDiv2" style="margin-right: 10px;">
                        <input type="text" size="30" id="end_time" value="<?php echo $end_time; ?>" placeholder="截止时间" class="qsbox">
                        <input type="button" class="btn" value="截止时间">
                    </div>
                    <div class="sDiv2" style="margin-right: 10px;border: none;">
                        <select id="status" name="status" class="form-control">
                            <option value="">状态</option>
                            <option value="0" <?php if($_REQUEST['status'] === '0'): ?>selected<?php endif; ?>>申请中</option>
                            <option value="1" <?php if($_REQUEST['status'] == 1): ?>selected<?php endif; ?>>申请成功</option>
                            <option value="2" <?php if($_REQUEST['status'] == 2): ?>selected<?php endif; ?>>申请失败</option>
                        </select>
                    </div>
                    <div class="sDiv2" style="margin-right: 10px;">
                        <input size="30" id="store_id" name="store_id" value="<?php echo $_GET[store_id]; ?>" placeholder="店铺ID" class="qsbox" type="text">
                    </div>
                    <div class="sDiv2" style="margin-right: 10px;">
                        <input size="30" placeholder="银行账户" value="<?php echo $_GET[realname]; ?>" name="realname" class="qsbox" type="text">
                    </div>
                    <div class="sDiv2">
                        <input size="30" value="<?php echo $_GET[bank_card]; ?>" name="bank_card" placeholder="银行账号" class="qsbox" type="text">
                        <input class="btn" value="搜索" type="submit">
                    </div>
                </div>
            </form>
        </div>
        <div class="hDiv">
            <div class="hDivBox">
                <table cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th align="center" abbr="article_title" axis="col3" class="">
                            <div style="text-align: center; width: 50px;" class="">
                                <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);">
                            </div>
                        </th>
                        <th align="center" abbr="article_title" axis="col3" class="">
                            <div style="text-align: center; width: 50px;" class="">申请ID</div>
                        </th>
                        <th align="center" abbr="ac_id" axis="col4" class="">
                            <div style="text-align: center; width: 50px;" class="">店铺id</div>
                        </th>
                        <th align="center" abbr="article_show" axis="col5" class="">
                            <div style="text-align: center; width: 100px;" class="">店铺名称</div>
                        </th>
                        <th align="center" abbr="article_time" axis="col6" class="">
                            <div style="text-align: center; width: 80px;" class="">申请时间</div>
                        </th>
                        <th align="center" abbr="article_time" axis="col6" class="">
                            <div style="text-align: center; width: 100px;" class="">申请金额</div>
                        </th>
                        <th align="center" abbr="article_time" axis="col6" class="">
                            <div style="text-align: center; width: 100px;" class="">银行名称</div>
                        </th>
                        <th align="center" abbr="article_time" axis="col6" class="">
                            <div style="text-align: center; width: 100px;" class="">银行账号</div>
                        </th>
                        <th align="center" abbr="article_time" axis="col6" class="">
                            <div style="text-align: center; width: 100px;" class="">银行账户</div>
                        </th>
                        <th align="center" abbr="article_time" axis="col6" class="">
                            <div style="text-align: center; width: 50px;" class="">状态</div>
                        </th>
                        <th align="center" axis="col1" class="handle">
                            <div style="text-align: center; width: 150px;">操作</div>
                        </th>
                        <th style="width:100%" axis="col7">
                            <div></div>
                        </th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="tDiv">
            <div class="tDiv2">
                <div class="fbutton">
                    <a onclick="act_submit(1)">
                        <div class="add" title="审核通过">
                            <span><i class="fa fa-check"></i>审核通过</span>
                        </div>
                    </a>
                </div>
                <div class="fbutton">
                    <a onclick="act_submit(-1)">
                        <div class="add" title="拒绝提现">
                            <span><i class="fa fa-ban"></i>审核失败</span>
                        </div>
                    </a>
                </div>
                <div class="fbutton">
                    <a onclick="act_submit(-2)">
                        <div class="add" title="无效作废">
                            <span><i class="fa fa-close"></i>无效作废</span>
                        </div>
                    </a>
                </div>
            </div>
            <div style="clear:both"></div>
        </div>
        <div class="bDiv" style="height: auto;">
            <div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
                <table>
                    <tbody>
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td align="center" class="">
                                <div style="text-align: center; width: 50px;">
                                    <?php if($v['status'] == 0): ?><input type="checkbox" name="selected[]" value="<?php echo $vo['id']; ?>"><?php endif; ?>
                                </div>
                            </td>
                            <td align="center" class="">
                                <div style="text-align: center; width: 50px;"><?php echo $vo['id']; ?></div>
                            </td>
                            <td align="center" class="">
                                <div style="text-align: center; width: 50px;"><?php echo $vo['store_id']; ?></div>
                            </td>
                            <td align="center" class="">
                                <div style="text-align: center; width: 100px;"><?php echo $vo['store_name']; ?></div>
                            </td>
                            <td align="center" class="">
                                <div style="text-align: center; width: 80px;"><?php echo date("Y-m-d",$vo['create_time']); ?></div>
                            </td>
                            <td align="center" class="">
                                <div style="text-align: center; width: 100px;"><?php echo $vo['money']; ?></div>
                            </td>
                            <td align="center" class="">
                                <div style="text-align: center; width: 100px;"><?php echo $vo['bank_name']; ?></div>
                            </td>
                            <td align="center" class="">
                                <div style="text-align: center; width: 100px;"><?php echo $vo['bank_card']; ?></div>
                            </td>
                            <td align="center" class="">
                                <div style="text-align: center; width: 100px;"><?php echo $vo['realname']; ?></div>
                            </td>
                            <td align="center" class="">
                                <div style="text-align: center; width: 50px;">
                                    <?php if($vo[status] == 0): ?>待审核<?php endif; if($vo[status] == 1): ?>审核通过<?php endif; if($vo[status] == -1): ?>审核失败<?php endif; if($vo[status] == -2): ?>无效作废<?php endif; ?>
                                </div>
                            </td>
                            <td align="left" class="handle">
                                <div style="text-align: left; width: 170px; max-width:170px;">
                                    <a href="<?php echo U('editStoreWithdrawals',array('id'=>$vo['id'])); ?>" class="btn blue"><i class="fa fa-pencil-square-o"></i>编辑</a>
                                    <?php if($vo[status] <= -1): ?>
                                        <a class="btn red"  href="javascript:void(0)" data-id="<?php echo $vo[id]; ?>" onclick="delfunc(this)" data-url="<?php echo U('delStoreWithdrawals'); ?>"><i class="fa fa-trash-o"></i>删除</a>
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
        <!--分页位置-->
        <?php echo $page; ?> </div>
</div>
<script>
    $(document).ready(function(){
        // 表格行点击选中切换
        $('#flexigrid > table>tbody >tr').click(function(){
            $(this).toggleClass('trSelected');
        });

        // 点击刷新数据
        $('.fa-refresh').click(function(){
            location.href = location.href;
        });

        $('#start_time').layDate();
        $('#end_time').layDate();
    });


    function check_form(){
        var start_time = $.trim($('#start_time').val());
        var end_time =  $.trim($('#end_time').val());
        if(start_time == '' ^ end_time == ''){
            layer.alert('请选择完整的时间间隔', {icon: 2});
            return false;
        }
        if(start_time !== '' && end_time !== ''){
            $('#create_time').val(start_time+" - "+end_time);
        }
        if(start_time == '' && end_time == ''){
            $('#create_time').val('');
        }
        return true;
    }
    
    //批量操作提交
    function act_submit(wst) {
        var chks = [];
        $('input[name*=selected]').each(function (i, o) {
            if ($(o).is(':checked')) {
                chks.push($(o).val());
            }
        })
        if (chks.length == 0) {
            layer.alert('少年，请至少选择一项', {icon: 2});
            return;
        }
        var remark = "审核通过";
        if(wst != 1 ){
            layer.prompt({title: '请填写备注', formType: 2}, function(text, index){
                layer.close(index);
                remark = text;
                audit(chks , wst ,  remark);
            });
        }else{
            audit(chks , wst ,  remark);
        }
    }
    function audit(chks , wst ,  remark){
        $.ajax({
            type: "POST",
            url: "/index.php?m=Admin&c=Finance&a=store_withdrawals_update",//+tab,
            data: {id:chks,status:wst,remark:remark},
            dataType: 'json',
            success: function (data) {
                if(data.status == 1){
                    layer.alert(data.msg, {
                        icon: 1,
                        closeBtn: 0
                    }, function(){
                        window.location.reload();
                    });
                }else{
                    layer.alert(data.msg, {icon: 2,time: 3000});
                }
            },
            error:function(){
                layer.alert('网络异常', {icon: 2,time: 3000});
            }
        });
    }
</script>
</body>
</html>