<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:36:"./application/admin/view2/ad/ad.html";i:1532661068;s:44:"./application/admin/view2/public/layout.html";i:1532661068;}*/ ?>
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
<body style="background-color: #FFF; overflow: auto;"> 
<div class="page">
  <div class="fixed-bar">
    <div class="item-title"><a class="back" href="javascript:history.back();" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
      <div class="subject">
        <h3> 广告详情</h3>
        <h5>广告添加与管理</h5>
      </div>
    </div>
  </div>
    <!--表单数据-->
    <form method="post" id="handleposition" action="<?php echo U('Admin/Ad/adHandle'); ?>">  
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label><em>*</em>广告名称：</label>
        </dt>
        <dd class="opt">
          <input type="text" placeholder="名称" class="input-txt" name="ad_name" value="<?php echo (isset($info['ad_name']) && ($info['ad_name'] !== '')?$info['ad_name']:'自定义广告名称'); ?>">
		  <span class="err" id="err_ad_name" style="color:#F00; display:none;">广告名称不能为空</span>                                                  
          <p class="notic"></p>
        </dd>
      </dl>	   
	  <dl class="row">
        <dt class="tit" colspan="2">
          <label>广告类型：</label>
        </dt>
        <dd class="opt">
          <div id="gcategory">
            <select name="media_type" class="input-sm" class="form-control">
                 <option value="0">图片</option>                                             
                 <option value="1">flash</option>
            </select>                   
          </div>          
        </dd>
      </dl> 
	  <dl class="row">
        <dt class="tit" colspan="2">
          <label>广告位置：</label>
        </dt>
        <dd class="opt">
          <div>
            <select name="pid" class="input-sm" class="form-control">
                <?php if(is_array($position) || $position instanceof \think\Collection || $position instanceof \think\Paginator): $i = 0; $__LIST__ = $position;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                       <option value="<?php echo $item['position_id']; ?>" <?php if($info[pid] == $item[position_id]): ?>selected<?php endif; ?>><?php echo $item['position_name']; ?></option>
               <?php endforeach; endif; else: echo "" ;endif; ?>                  
            </select>                 
          </div>          
        </dd>
      </dl>       
	  <dl class="row">
        <dt class="tit">
          <label>开始日期：</label>
        </dt>
        <dd class="opt">
            <input type="text" class="input-txt" id="start_time" name="begin"  value="<?php echo (isset($info['start_time']) && ($info['start_time'] !== '')?$info['start_time']:'2016-01-01'); ?>"/>
          <span class="err"></span>
        </dd>
      </dl>    
	  <dl class="row">
        <dt class="tit">
          <label>结束时间：</label>
        </dt>
        <dd class="opt">
            <input type="text" class="input-txt" id="end_time" name="end"  value="<?php echo (isset($info['end_time']) && ($info['end_time'] !== '')?$info['end_time']:'2019-01-01'); ?>"/>
          <span class="err"></span>
        </dd>
      </dl>        
      <dl class="row">
        <dt class="tit">
          <label><em>*</em>广告链接：</label>
        </dt>
        <dd class="opt">
          <input type="text" placeholder="广告链接" class="input-txt" name="ad_link" value="<?php echo $info['ad_link']; ?>">
		  <span class="err" id="err_ad_link" style="color:#F00; display:none;"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label>广告图片</label>
        </dt>
        <dd class="opt">
          <div class="input-file-show">
                        <span class="show">
                            <a id="img_a" target="_blank" class="nyroModal" rel="gal" href="<?php echo $info['ad_code']; ?>">
                              <i id="img_i" class="fa fa-picture-o" onmouseover="layer.tips('<img src=<?php echo $info['ad_code']; ?>>',this,{tips: [1, '#fff']});" onmouseout="layer.closeAll();"></i>
                            </a>
                        </span>
           	            <span class="type-file-box">
                            <input type="text" id="ad_code" name="ad_code" value="<?php echo $info['ad_code']; ?>" class="type-file-text">
                            <input type="button" name="button" id="button1" value="选择上传..." class="type-file-button">
                            <input class="type-file-file" onClick="GetUploadify(1,'','ad','img_call_back')" size="30" hidefocus="true" nc_type="change_site_logo" title="点击前方预览图可查看大图，点击按钮选择文件并提交表单后上传生效">
                        </span>
          </div>
          <span class="err"></span>
          <p class="notic">请上传图片格式文件</p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label><em>*</em>背景颜色：</label>
        </dt>
        <dd class="opt">
          <input type="color" placeholder="背景颜色：" class="input-txt" name="bgcolor" value="<?php echo $info['bgcolor']; ?>"  />
		  <span class="err" id="err_bgcolor" style="color:#F00; display:none;"></span>
          <p class="notic"></p>
        </dd>
      </dl>                 		 		       
      <dl class="row">
        <dt class="tit">
          <label>默认排序：</label>
        </dt>
        <dd class="opt">
          <input type="text" placeholder="排序" name="orderby" value="<?php echo $info['orderby']; ?>" class="input-txt">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <div class="bot"><a href="JavaScript:void(0);" onclick="adsubmit()" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a></div>
    </div>
       <input type="hidden" name="act" value="<?php echo $act; ?>">
       <input type="hidden" name="ad_id" value="<?php echo $info['ad_id']; ?>">
  </form>
</div>
 <script>
	 function adsubmit(){
		$('#handleposition').submit();
	}
	
    $(document).ready(function(){
		$('#start_time').layDate();
		$('#end_time').layDate();
	});
     function img_call_back(fileurl_tmp)
     {
       $("#ad_code").val(fileurl_tmp);
       $("#img_a").attr('href', fileurl_tmp);
       $("#img_i").attr('onmouseover', "layer.tips('<img src="+fileurl_tmp+">',this,{tips: [1, '#fff']});");
     }
 </script>
</body>
</html>