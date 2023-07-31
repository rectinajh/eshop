<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"./application/admin/view2/user/member_log.html";i:1532661069;s:44:"./application/admin/view2/public/layout.html";i:1532661069;}*/ ?>
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
<body style="background-color: rgb(255, 255, 255); overflow: auto; cursor: default; -moz-user-select: inherit;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>会员日志</h3>
                <h5>网站系统会员索引与管理</h5>
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
            <li>通过会员日志,你可以查看会员的资金动向</li>
			<li>你可以根据条件搜索会员</li>
        </ul>
    </div>
    <div class="flexigrid">
        <div class="mDiv">
            <div class="ftitle">
                <h3>会员列表</h3>
                <h5>(共<span id="user_count"></span>条记录)</h5>
            </div>
            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
            <form class="navbar-form form-inline"  id="search-form2" onsubmit="return false">
                <input type="hidden" name="order_by" value="user_id">
                <input type="hidden" name="sort" value="desc">
                <input type="hidden" name="mobile" value="" id="input-mobile" />
                <input type="hidden" name="nickname" value="" id="input-nickname" />
                <!--分销时查看下级人数都有哪些-->
               
                <div class="sDiv">
                    <div class="sDiv2">
                        <input type="text" id="search_key" size="30" class="qsbox" placeholder="用户手机或是昵称">
                        <input type="submit" class="btn" onclick="ajax_get_table('search-form2',1)" value="搜索">
                    </div>
                </div>
            </form>
        </div>
        <div class="hDiv">
            <div class="hDivBox">
                <table cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th class="sign" axis="col0">
                            <div style="width: 24px;"><i class="ico-check"></i></div>
                        </th>
                        <th align="left" abbr="user_id" axis="col4" class="">
                            <div style="text-align: center; width: 80px;" class="">会员id</div>
                        </th>
                        <th align="center" abbr="desc" axis="col5" class="">
                            <div style="text-align: center; width: 80px;" class="">描述</div>
                        </th>
                        <th align="center" axis="col5" class="">
                            <div style="text-align: center; width: 80px;" class="">订单号</div>
                        </th>
                        <th align="center" abbr="user_money" axis="col6" class="">
                            <div style="text-align: center; width: 80px;" class="">余额</div>
                        </th>
                        <!-- <th align="center" abbr="pay_points" axis="col6" class="">
                            <div style="text-align: center; width: 50px;" class="">积分</div>
                        </th> -->
                        <th align="center" abbr="withdraw_money" axis="col6" class="">
                            <div style="text-align: center; width: 80px;" class="">提现币</div>
                        </th>
                        <th align="center" abbr="jin_num" axis="col6" class="">
                            <div style="text-align: center; width: 80px;" class="">新淘链</div>
                        </th>
                        <th align="center" abbr="dedication_money" axis="col6" class="">
                            <div style="text-align: center; width: 80px;" class="">奉献值</div>
                        </th>
                        <th align="center" abbr="consume_cp" axis="col6" class="">
                            <div style="text-align: center; width: 80px;" class="">算力</div>
                        </th>
                        <th align="center" abbr="change_time" axis="col6" class="">
                            <div style="text-align: center; width: 120px;" class="">变动时间</div>
                        </th>
                        <th style="width:100%" axis="col7">
                            <div></div>
                        </th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="bDiv" style="height: auto;" id="ajax_return">
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        // 点击刷新数据
        var ssort = 'sdesc';
        var on_sclick = 0;
        $('.hDivBox > table>thead>tr>th').hover(
            function () {
                if(typeof($(this).attr('abbr')) == "undefined"){
                    return false;
                }
                $(this).addClass('thOver');
                if($(this).hasClass('sorted')){
                    if(ssort == 'sdesc'){
                        $(this).find('div').removeClass('sdesc');
                        $(this).find('div').addClass('sasc');
                    }else{
                        $(this).find('div').removeClass('sasc');
                        $(this).find('div').addClass('sdesc');
                    }
                }else{
                    $(this).find('div').addClass(ssort);
                }
            }, function () {
                    if(typeof($(this).attr('abbr')) == "undefined"){
                        return false;
                    }
                    if(on_sclick == 0){
                        if($(this).hasClass('sorted')){
                            if(ssort == 'sdesc'){
                                $(this).find('div').removeClass('sasc');
                                $(this).find('div').addClass('sdesc');
                            }else{
                                $(this).find('div').removeClass('sdesc');
                                $(this).find('div').addClass('sasc');
                            }
                        }else{
                            $(this).find('div').removeClass(ssort);
                        }
                    }
                    $(this).removeClass("thOver");
                    on_sclick = 0;
            }
        );
        $('.hDivBox > table>thead>tr>th').click(function(){
            if(typeof($(this).attr('abbr')) == "undefined"){
                return false;
            }
            if($(this).hasClass('sorted')){
                $(this).find('div').removeClass(ssort);
                if(ssort == 'sdesc'){
                    ssort = 'sasc';
                }else{
                    ssort = 'sdesc';
                }
                $(this).find('div').addClass(ssort);
                on_sclick = 1;
            }else{
                $('.hDivBox > table>thead>tr>th').removeClass('sorted');
                $('.hDivBox > table>thead>tr>th').find('div').removeClass(ssort);
                $(this).addClass('sorted');
                $(this).find('div').addClass(ssort);
                var hDivBox_th_index = $(this).index();
                var flexigrid_tr =   $('#flexigrid > table>tbody>tr')
                flexigrid_tr.each(function(){
                    $(this).find('td').removeClass('sorted');
                    $(this).children('td').eq(hDivBox_th_index).addClass('sorted');
                });
            }
            sort($(this).attr('abbr'));
        });

        $('.fa-refresh').click(function(){
            location.href = location.href;
        });
        ajax_get_table('search-form2',1);
    });

    // ajax 抓取页面
    function ajax_get_table(tab,page){
        var search_key = $.trim($('#search_key').val());
        if(search_key.length > 0){
            if(checkMobile(search_key)){
                $('#input-mobile').val(search_key);
            }else{
                $('#input-nickname').val(search_key);
            }
        } else {
            $('#input-mobile').val('');
            $('#input-nickname').val('');
        }
        cur_page = page; //当前页面 保存为全局变量
        $.ajax({
            type : "POST",
            url:"/index.php/Admin/user/ajaxmember_log/p/"+page,//+tab,
            data : $('#'+tab).serialize(),// 你的formid
            success: function(data){
                $("#ajax_return").html('');
                $("#ajax_return").append(data);
            }
        });
    }

    //发送邮件
    function send_mail()
    {
        var obj = $('.trSelected');
        var url = "<?php echo U('Admin/User/sendMail'); ?>";
        if(obj.length > 0){
            var check_val = [];
            obj.each(function(){
                check_val.push($(this).attr('data-id'));
            });
            url += "?user_id_array="+check_val;
            layer.open({
                type: 2,
                title: '发送邮箱',
                shadeClose: true,
                shade: 0.8,
                area: ['580px', '480px'],
                content: url
            });
        }else{
            layer.msg('请选择会员',{icon:2});
        }
    }

    //发送站内信
    function send_message()
    {
        var obj = $('.trSelected');
        var url = "<?php echo U('Admin/User/sendMessage'); ?>";
        if(obj.length > 0){
            var check_val = [];
            obj.each(function(){
                check_val.push($(this).attr('data-id'));
            });
            url += "?user_id_array="+check_val;
            layer.open({
                type: 2,
                title: '站内信',
                shadeClose: true,
                shade: 0.8,
                area: ['580px', '480px'],
                content: url
            });
        }else{
            layer.msg('请选择会员',{icon:2});
        }

    }

    // 点击排序
    function sort(field)
    {
        $("input[name='order_by']").val(field);
        var v = $("input[name='sort']").val() == 'desc' ? 'asc' : 'desc';
        $("input[name='sort']").val(v);
        ajax_get_table('search-form2',cur_page);
    }
    /**
     * 回调函数
     */
    function call_back(v) {
        layer.closeAll();
        if (v == 1) {
            layer.msg('发送成功',{icon:1});
        } else {
            layer.alert('发送失败,可能的错误原因：系统邮箱设置错误或者异常,解决办法：<a target="_blank" href="http://www.tp-shop.cn/Doc/Indexbbc/article/id/1307.html">http://www.tp-shop.cn/Doc/Indexbbc/article/id/1307.html</a>', {icon: 2});
        }
    }

</script>
</body>
</html>