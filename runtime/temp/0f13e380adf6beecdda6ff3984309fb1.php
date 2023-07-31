<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"./application/admin/view2/order/virtual_list.html";i:1532661068;s:44:"./application/admin/view2/public/layout.html";i:1532661068;}*/ ?>
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
<script type="text/javascript" src="__ROOT__/Public/static/js/layer/laydate/laydate.js"></script>

<body style="background-color: rgb(255, 255, 255); overflow: auto; cursor: default; -moz-user-select: inherit;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>虚拟订单</h3>
        <h5>商城虚拟商品交易订单查询及管理</h5>
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
      <li>点击查看操作将显示订单（包括电子兑换码）的详细信息</li>
      <li>未付款的订单可以点击取消操作来取消订单</li>
      <li>如果平台已确认收到买家的付款，但系统支付状态并未变更，可以点击收到货款操作，并填写相关信息后更改订单支付状态</li>
    </ul>
  </div>
  <div class="flexigrid">
    <div class="mDiv">
      <div class="ftitle">
        <h3>订单列表</h3>
        <h5>(共<?php echo $total_count; ?>条记录)</h5>
      </div>
      <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
	  <form class="navbar-form form-inline"  method="get" action="<?php echo U('Order/virtual_list'); ?>"  name="search-form2" id="search-form2">  
	  		<input type="hidden" name="order_by" value="order_id">
            <input type="hidden" name="sort" value="desc">
            <input type="hidden" name="export" id="export" value="0">
            <input type="hidden" name="user_id" value="<?php echo $_GET[user_id]; ?>">
		  	<input type="hidden" name="order_ids" value="">
            <!--用于查看结算统计 包含了哪些订单-->
            <input type="hidden" value="<?php echo $_GET['order_statis_id']; ?>" name="order_statis_id" />
      <div class="sDiv">
        <div class="sDiv2">
        	<input type="text" size="30" id="add_time_begin" name="add_time_begin" value="<?php echo $begin; ?>" class="qsbox"  placeholder="下单开始时间">
        </div>
        <div class="sDiv2">
        	<input type="text" size="30" id="add_time_end" name="add_time_end" value="<?php echo $end; ?>" class="qsbox"  placeholder="下单结束时间">
        </div>
        <div class="sDiv2">	 
        	<select name="pay_status" class="select" style="width:100px;margin-right:5px;margin-left:5px">
                    <option value="">支付状态</option>
                    <option value="0">未支付</option>
        			<option value="1">已支付</option>
            </select>
        </div>
        <div class="sDiv2">	   
            <select name="pay_code" class="select" style="width:100px;margin-right:5px;margin-left:5px">
                <option value="">支付方式</option>
                <option value="alipay">支付宝支付</option>
				<option value="weixin">微信支付</option>
				<!--<option value="cod">货到付款</option>-->
             </select>
         </div>
         <div class="sDiv2">	                
          <select  name="keytype" class="select">
            <option value="store_name">店铺名称</option>
            <option value="mobile">接收手机</option>
            <option value="order_sn">订单编号</option>
            </foreach>            
          </select>
         </div>
         <div class="sDiv2">	 
          	<input type="text" size="30" name="keywords" class="qsbox" placeholder="搜索相关数据...">
        </div>
        <div class="sDiv2">	 
          <input type="button"  onclick="form_submit(0)" class="btn" value="搜索">
        </div>
      </div>
     </form>
    </div>
    <div class="hDiv">
      <div class="hDivBox" id="ajax_return">
        <table cellspacing="0" cellpadding="0">
          <thead>
	        	<tr>
	              <th class="sign" axis="col0">
	                <div style="width: 24px;"><i class="ico-check"></i></div>
	              </th>
	              <th align="left" abbr="order_sn" axis="col3" class="">
	                <div style="text-align: left; width: 140px;" class="">订单编号</div>
	              </th>
	              <th align="left" abbr="consignee" axis="col4" class="">
	                <div style="text-align: left; width: 100px;" class="">接收手机</div>
	              </th>
	              <th align="center" abbr="article_show" axis="col5" class="">
	                <div style="text-align: center; width: 80px;" class="">订单金额</div>
	              </th>
	              <th align="center" abbr="article_time" axis="col6" class="">
	                <div style="text-align: center; width: 60px;" class="">订单状态</div>
	              </th>
	              <th align="center" abbr="article_time" axis="col6" class="">
	                <div style="text-align: center; width: 60px;" class="">支付状态</div>
	              </th>
	              <th align="center" abbr="article_time" axis="col6" class="">
	                <div style="text-align: center; width: 80px;" class="">支付方式</div>
	              </th>
	              <th align="center" abbr="article_time" axis="col6" class="">
	                <div style="text-align: center; width: 120px;" class="">下单时间</div>
	              </th>
	              <th align="center" abbr="article_time" axis="col6" class="">
	                <div style="text-align: center; width: 120px;" class="">支付时间</div>
	              </th>
	              <!--<th align="center" abbr="article_time" axis="col6" class="">-->
	                <!--<div style="text-align: center; width: 160px;" class="">有效期</div>-->
	              <!--</th>-->
	              <th align="center" abbr="article_time" axis="col6" class="">
	                <div style="text-align: center; width: 160px;" class="">店铺名称</div>
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
        <div class="fbutton"> <a href="javascript:form_submit(1)">
          <div class="add" title="选定行数据导出excel文件,如果不选中行，将导出列表所有数据">
            <span><i class="fa fa-plus"></i>导出数据</span>
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
		 	<?php if(empty($orderList) == true): ?>
		 		<tr data-id="0">
			        <td class="no-data" align="center" axis="col0" colspan="50">
			        	<i class="fa fa-exclamation-circle"></i>没有符合条件的记录
			        </td>
			     </tr>
			<?php else: if(is_array($orderList) || $orderList instanceof \think\Collection || $orderList instanceof \think\Paginator): $i = 0; $__LIST__ = $orderList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
		  	<tr data-order-id="<?php echo $list['order_id']; ?>">
		        <td class="sign" axis="col0">
		          <div style="width: 24px;"><i class="ico-check"></i></div>
		        </td>
		        <td align="left" abbr="order_sn" axis="col3" class="">
		          <div style="text-align: left; width: 140px;" class=""><?php echo $list['order_sn']; ?></div>
		        </td>
		        <td align="left" abbr="consignee" axis="col4" class="">
		          <div style="text-align: left; width: 100px;" class=""><?php echo $list['mobile']; ?></div>
		        </td>
		        <td align="center" abbr="article_time" axis="col6" class="">
		          <div style="text-align: center; width: 80px;" class=""><?php echo $list['order_amount']; ?></div>
		        </td>
		        <td align="center" abbr="article_time" axis="col6" class="">
		          <div style="text-align: center; width: 60px;" class=""><?php echo $order_status[$list[order_status]]; if($list['is_cod'] == '1'): ?><span style="color: red">(货到付款)</span><?php endif; ?></div>
		        </td>
		        <td align="center" abbr="article_time" axis="col6" class="">
		          <div style="text-align: center; width: 60px;" class=""><?php echo $pay_status[$list[pay_status]]; ?></div>
		        </td>
		        <td align="center" abbr="article_time" axis="col6" class="">
		          <div style="text-align: center; width: 80px;" class=""><?php echo (isset($list['pay_name']) && ($list['pay_name'] !== '')?$list['pay_name']:'其他方式'); ?></div>
		        </td>
		        <td align="center" abbr="article_time" axis="col6" class="">
		          <div style="text-align: center; width: 120px;" class=""><?php echo date('Y-m-d H:i',$list['add_time']); ?></div>
		        </td>
		        <td align="center" abbr="article_time" axis="col6" class="">
		          <div style="text-align: center; width: 120px;" class=""><?php if($list['pay_time'] > 0): ?><?php echo date('Y-m-d H:i',$list['pay_time']); else: ?>无<?php endif; ?></div>
		        </td>
		        <!--<td align="center" abbr="article_time" axis="col6" class="">-->
		          <!--<div style="text-align: center; width: 160px;" class=""><?php echo date('Y-m-d H:i',$list['virtual_indate']); ?></div>-->
		        <!--</td>-->
		        <td align="center" abbr="article_time" axis="col6" class="">
		          <div style="text-align: center; width: 160px;" class=""><?php echo $store_arr[$list[store_id]]; ?></div>
		        </td>
		        <td align="center" axis="col1" class="handle" align="center">
		        	<div style="text-align: center; ">
		        		<a class="btn green" href="<?php echo U('Order/virtual_info',array('order_id'=>$list['order_id'])); ?>"><i class="fa fa-list-alt"></i>查看</a>
		        	</div>
		         </td>
		         <td align="" class="" style="width: 100%;">
		            <div>&nbsp;</div>
		          </td>
		      </tr>
		      <?php endforeach; endif; else: echo "" ;endif; endif; ?>
		    </tbody>
		</table>
		<div class="row">
		    <div class="col-sm-6 text-left"></div>
		    <div class="col-sm-6 text-right"><?php echo $page; ?></div>
		</div>
      </div>
      <div class="iDiv" style="display: none;"></div>
    </div>
    <!--分页位置--> 
   	</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){	
	   
    // 起始位置日历控件
	laydate.skin('molv');//选择肤色
	laydate({
	  elem: '#add_time_begin',
	  format: 'YYYY-MM-DD', // 分隔符可以任意定义，该例子表示只显示年月
	  festival: true, //显示节日
	  istime: false,
	  choose: function(datas){ //选择日期完毕的回调
		 compare_time($('#add_time_begin').val(),$('#add_time_end').val());
	  }
	});
	 
	 // 结束位置日历控件
	laydate({
	  elem: '#add_time_end',
	  format: 'YYYY-MM-DD', // 分隔符可以任意定义，该例子表示只显示年月
	  festival: true, //显示节日
	  istime: false,
	  choose: function(datas){ //选择日期完毕的回调
		   compare_time($('#add_time_begin').val(),$('#add_time_end').val());
	  }
	});	
     	
		// 点击刷新数据
		$('.fa-refresh').click(function(){
			location.href = location.href;
		});

		// 表格行点击选中切换
		$('#flexigrid > table>tbody >tr').click(function(){
			$(this).toggleClass('trSelected');
		});
		 
	});
    
	function form_submit(v){
		$('#export').val(v);
		var selected_ids = '';
		$('.trSelected' , '#flexigrid').each(function(i){
			selected_ids += $(this).data('order-id')+',';
		});
		if(selected_ids != ''){
			$('input[name="order_ids"]').val(selected_ids.substring(0,selected_ids.length-1));
		}
		$('#search-form2').submit();
	}
</script>
</body>
</html>