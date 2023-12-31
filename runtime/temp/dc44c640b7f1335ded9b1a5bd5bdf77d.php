<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:47:"./application/admin/view2/system/shop_info.html";i:1532661069;s:44:"./application/admin/view2/public/layout.html";i:1532661069;}*/ ?>
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
    <form method="post" id="handlepost" action="<?php echo U('System/handle'); ?>" enctype="multipart/form-data" name="form1">
        <input type="hidden" name="form_submit" value="ok" />
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label for="record_no">网站备案号</label>
                </dt>
                <dd class="opt">
                    <input id="record_no" name="record_no" value="<?php echo $config['record_no']; ?>" class="input-txt" type="text" />
                    <p class="notic">网站备案号，将显示在前台底部欢迎信息等位置</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="store_name">网站名称</label>
                </dt>
                <dd class="opt">
                    <input id="store_name" name="store_name" value="<?php echo $config['store_name']; ?>" class="input-txt" type="text" />
                    <p class="notic">网站名称，将显示在前台顶部欢迎信息等位置</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="store_logo">网站Logo</label>
                </dt>
                <dd class="opt">
                    <div class="input-file-show">
                        <span class="show">
                            <a id="img_a" target="_blank" class="nyroModal" rel="gal" href="<?php echo $config['store_logo']; ?>">
                                <i id="img_i" class="fa fa-picture-o" onmouseover="layer.tips('<img src=<?php echo $config['store_logo']; ?>>',this,{tips: [1, '#fff']});" onmouseout="layer.closeAll();"></i>
                            </a>
                        </span>
           	            <span class="type-file-box">
                            <input type="text" id="store_logo" name="store_logo" value="<?php echo $config['store_logo']; ?>" class="type-file-text">
                            <input type="button" name="button" id="button1" value="选择上传..." class="type-file-button">
                            <input class="type-file-file" onClick="GetUploadify(1,'','logo','img_call_back')" size="30" hidefocus="true" nc_type="change_site_logo" title="点击前方预览图可查看大图，点击按钮选择文件并提交表单后上传生效">
                        </span>
                    </div>
                    <span class="err"></span>
                    <p class="notic">默认网站LOGO,通用头部显示，最佳显示尺寸为240*60像素</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="store_title">网站标题</label>
                </dt>
                <dd class="opt">
                    <input id="store_title" name="store_title" value="<?php echo $config['store_title']; ?>" class="input-txt" type="text" />
                    <p class="notic">网站标题，将显示在前台顶部欢迎信息等位置</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="store_desc">网站描述</label>
                </dt>
                <dd class="opt">
                    <input id="store_desc" name="store_desc" value="<?php echo $config['store_desc']; ?>" class="input-txt" type="text" />
                    <p class="notic">网站描述，将显示在前台顶部欢迎信息等位置</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="store_keyword">网站关键字</label>
                </dt>
                <dd class="opt">
                    <input id="store_keyword" name="store_keyword" value="<?php echo $config['store_keyword']; ?>" class="input-txt" type="text" />
                    <p class="notic">网站关键字，便于SEO</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="contact">联系人</label>
                </dt>
                <dd class="opt">
                    <input id="contact" name="contact" value="<?php echo $config['contact']; ?>" class="input-txt" type="text" />
                    <p class="notic">联系人</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="phone">联系电话</label>
                </dt>
                <dd class="opt">
                    <input id="phone" autocomplete="off"  onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" onpaste="this.value=this.value.replace(/[^\d]/g,'')" name="phone" value="<?php echo $config['phone']; ?>" class="input-txt" type="text" />
                    <p class="notic">商家中心右下侧显示，方便商家遇到问题时咨询</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="address">具体地址</label>
                </dt>
                <dd class="opt">
                    <input id="address" name="address" value="<?php echo $config['address']; ?>" class="input-txt" type="text" />
                    <p class="notic">具体地址</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="qq">平台客服QQ1</label>
                </dt>
                <dd class="opt">
                    <input id="qq" name="qq" value="<?php echo $config['qq']; ?>" class="input-txt" type="text">
                    <span class="err"></span>
                    <p class="notic">商家中心右下侧显示，方便商家遇到问题时咨询</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="qq2">平台客服QQ2</label>
                </dt>
                <dd class="opt">
                    <input id="qq2" name="qq2" value="<?php echo $config['qq2']; ?>" class="input-txt" type="text">
                    <span class="err"></span>
                    <p class="notic">商家中心右下侧显示，方便商家遇到问题时咨询</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="qq3">平台客服QQ3</label>
                </dt>
                <dd class="opt">
                    <input id="qq3"  name="qq3" value="<?php echo $config['qq3']; ?>" class="input-txt" type="text">
                    <span class="err"></span>
                    <p class="notic">商家中心右下侧显示，方便商家遇到问题时咨询</p>
                </dd>
            </dl>
            <div class="bot">
                <input type="hidden" name="inc_type" value="<?php echo $inc_type; ?>">
                <a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" onclick="check_form();">确认提交</a>
            </div>
        </div>
    </form>
</div>
<div id="goTop"> <a href="JavaScript:void(0);" id="btntop"><i class="fa fa-angle-up"></i></a><a href="JavaScript:void(0);" id="btnbottom"><i class="fa fa-angle-down"></i></a></div>
</body>
<script type="text/javascript">
    function check_form()
    {
        var phone = $('#phone').val();
      
        document.form1.submit()
    }
    function img_call_back(fileurl_tmp)
    {
        $("#store_logo").val(fileurl_tmp);
        $("#img_a").attr('href', fileurl_tmp);
        $("#img_i").attr('onmouseover', "layer.tips('<img src="+fileurl_tmp+">',this,{tips: [1, '#fff']});");
    }
</script>
</html>