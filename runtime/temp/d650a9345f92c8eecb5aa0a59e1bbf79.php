<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:48:"./application/admin/view2/tlflash/add_flash.html";i:1532661068;s:44:"./application/admin/view2/public/layout.html";i:1532661068;}*/ ?>
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

<script type="text/javascript" src="__ROOT__/public/plugins/Ueditor/ueditor.config.js"></script>

<script type="text/javascript" src="__ROOT__/public/plugins/Ueditor/ueditor.all.min.js"></script>

<script type="text/javascript" charset="utf-8" src="__ROOT__/public/plugins/Ueditor/lang/zh-cn/zh-cn.js"></script>

<script src="__ROOT__/public/static/js/layer/laydate/laydate.js"></script>



<style type="text/css">

html, body {overflow: visible;}

</style>  

<body style="background-color: #FFF; overflow: auto;">

<div id="toolTipLayer" style="position: absolute; z-index: 9999; display: none; visibility: visible; left: 95px; top: 573px;"></div>

<div id="append_parent"></div>

<div id="ajaxwaitid"></div>

<div class="page">

  <div class="fixed-bar">

    <div class="item-title"><a class="back" href="javascript:history.back();" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>

      <div class="subject">

        <h3>文章管理 - 新增文章</h3>

        <h5>网站系统文章索引与管理</h5>

      </div>

    </div>

  </div>

  <form class="form-horizontal" action="<?php echo U('Article/aticleHandle'); ?>" id="add_post" method="post">    

    <div class="ncap-form-default">

      <dl class="row">

        <dt class="tit">

          <label><em>*</em>快讯内容</label>

        </dt>

        <dd class="opt">

          <input type="text" value="<?php echo $flash['content']; ?>" name="content" class="input-txt">

          <span class="err" id="err_title"></span>

          <p class="notic"></p>

        </dd>

        

      </dl>

     
    <dl class="row">

        <!-- <dt class="tit">

          <label for="articleForm">发布时间</label>

        </dt> -->

        <!-- <dd class="opt">

            <input type="text" class="input-txt" id="publish_time" name="publish_time"  value="<?php echo date("Y-m-d",$flash['addtime']); ?>">        

            <span class="add-on input-group-addon">

                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>

            </span> 

          <span class="err"></span>

        </dd> -->

      </dl>       

      <dl class="row">

        <dt class="tit">

          <label>显示</label>

        </dt>

        <dd class="opt">

          <div class="onoff">

            <label for="article_show1" class="cb-enable <?php if($flash[is_open] == 1): ?>selected<?php endif; ?>">是</label>

            <label for="article_show0" class="cb-disable <?php if($flash[is_open] == 0): ?>selected<?php endif; ?>">否</label>

            <input id="article_show1" name="is_open" value="1" type="radio" <?php if($flash[is_open] == 1): ?> checked="checked"<?php endif; ?>>

            <input id="article_show0" name="is_open" value="0" type="radio" <?php if($flash[is_open] == 0): ?> checked="checked"<?php endif; ?>>

          </div>

          <p class="notic"></p>

        </dd>

      </dl>

      <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a></div>

    </div>

        <input type="hidden" name="id" value="<?php echo $flash['id']; ?>"></label>    

  </form>

</div>

<script type="text/javascript">

   

    $(function () {

        $('#publish_time').layDate(); 

    });

 

    $(document).on("click", '#submitBtn', function () {

        verifyForm();

    });

    function verifyForm(){

        $('span.err').hide();

        $.ajax({

            type: "POST",

            url: "<?php echo U('Tlflash/add_flash'); ?>",

            data: $('#add_post').serialize(),

            dataType: "",

            error: function () {

                layer.alert("服务器繁忙, 请联系管理员!");

            },

            success: function (data) {

                if (data == 1) {

                    layer.msg('快讯上传成功', {icon: 1,time: 1000}, function() {

                        location.href = "<?php echo U('Admin/Tlflash/tllist'); ?>";

                    });

                } else {

                    layer.msg('快讯上传失败', {icon: 2,time: 1000});

                }

            }

        });

    }



    
</script>

</body>

</html>