<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:47:"./application/admin/view2/store/store_info.html";i:1532661068;s:44:"./application/admin/view2/public/layout.html";i:1532661068;}*/ ?>
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
<div id="toolTipLayer" style="position: absolute; z-index: 9999; display: none; visibility: visible; left: 95px; top: 573px;"></div>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title"><a class="back" href="javascript:history.back();" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <div class="subject">
                <h3>店铺管理 - 查看会员“<?php echo $apply['seller_name']; ?>”的店铺注册信息</h3>
                <h5>店铺的审核续费及经营类目结算周期操作</h5>
            </div>
        </div>
    </div>
    <table class="store-joinin" cellspacing="0" cellpadding="0" border="0">
        <thead>
        <tr>
            <th colspan="20">公司及联系人信息</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th class="">公司名称：</th>
            <td><?php echo $apply['company_name']; ?></td>
            <th>公司网址：</th>
            <td colspan="20"><?php echo $apply['company_website']; ?></td>
        </tr>
        <tr>
            <th>公司所在地：</th>
            <td><?php echo $province_name; ?>,<?php echo $city_name; ?>,<?php echo $district_name; ?></td>
            <th>公司详细地址：</th>
            <td><?php echo $apply['company_address']; ?></td>
            <th>固定电话：</th>
            <td><?php echo $apply['company_telephone']; ?></td>
        </tr>
        <tr>
            <th>邮政编码：</th>
            <td><?php echo $apply['company_zipcode']; ?></td>
            <th>电子邮箱：</th>
            <td><?php echo $apply['company_email']; ?></td>
            <th>传真：</th>
            <td><?php echo $apply['company_fax']; ?></td>
        </tr>
        <tr>
            <th>联系人姓名：</th>
            <td><?php echo $apply['contacts_name']; ?></td>
            <th>联系人电话：</th>
            <td><?php echo $apply['contacts_mobile']; ?></td>
            <th>联系人邮箱：</th>
            <td><?php echo $apply['contacts_email']; ?></td>
        </tr>
        </tbody>
    </table>
    <table class="store-joinin" cellspacing="0" cellpadding="0" border="0">
        <thead>
        <tr>
            <th colspan="20">营业执照信息（副本）</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>营业执照号：</th>
            <td><?php echo $apply['business_licence_number']; ?></td>
            <th>营业执照有效期：</th>
            <td><?php echo $apply['business_date_start']; ?> - <?php echo $apply['business_date_end']; ?></td>
            <th>法定经营范围：</th>
            <td><?php echo $apply['business_scope']; ?></td>
        </tr>
        <tr>
            <th>注册资本:</th><td><?php echo $apply['reg_capital']; ?></td>
            <th>组织机构代码:</th><td><?php echo $apply['orgnization_code']; ?></td>
            <th>一般纳税人证明:</th><td><?php echo $apply['reg_capital']; ?></td>
        </tr>
        <tr>
            <th>法人代表姓名:</th><td><?php echo $apply['legal_person']; ?></td>
            <th>纳税类型税码:</th><td><?php echo $apply['tax_rate']; ?>%</td>
            <th>税务登记号码:</th><td><?php echo $apply['attached_tax_number']; ?></td>
        </tr>
        </tbody>
    </table>
    <table class="store-joinin" cellspacing="0" cellpadding="0" border="0">
        <thead>
        <tr>
            <th colspan="20">开户银行信息：</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th class="w150">银行开户名：</th>
            <td><?php echo $apply['bank_account_name']; ?></td>
        </tr>
        <tr>
            <th>公司银行账号：</th>
            <td><?php echo $apply['bank_account_number']; ?></td>
        </tr>
        <tr>
            <th>开户银行支行名称：</th>
            <td><?php echo $apply['bank_branch_name']; ?></td>
        </tr>
        <tr>
            <th>开户银行所在地：</th>
            <td colspan="20"><?php echo $bank_province_name; ?>,<?php echo $bank_city_name; ?></td>
        </tr>
        </tbody>
    </table>

    <table class="store-joinin" cellspacing="0" cellpadding="0" border="0">
        <thead>
        <tr>
            <th colspan="20">店铺经营信息</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th class="w150">卖家账号：</th>
            <td><?php echo $apply['seller_name']; ?></td>
        </tr>
        <tr>
            <th class="w150">店铺名称：</th>
            <td><?php echo $apply['store_name']; ?></td>
        </tr>
        <tr>
            <th>店铺等级：</th>
            <td>（开店费用：<?php echo $store_grade['sg_price']; ?> 元/年）</td>
        </tr>
        <tr>
            <th class="w150">店铺负责人：</th>
            <td><?php echo $apply['store_person_name']; ?></td>
        </tr>
        <tr>
            <th>负责人手机号码：</th>
            <td><?php echo $apply['store_person_mobile']; ?></td>
        </tr>
        <tr>
            <th>负责人QQ号码：</th>
            <td><?php echo $apply['store_person_qq']; ?></td>
        </tr>
        <tr>
            <th>负责人邮箱：</th>
            <td><?php echo $apply['store_person_email']; ?></td>
        </tr>
        <tr>
            <th>店铺分类：</th>
            <td><?php echo $apply['sc_name']; ?>
            </td>
        </tr>
        <tr>
            <th>经营类目：</th>
            <td colspan="2"><table id="table_category" class="type" cellspacing="0" cellpadding="0" border="0">
                <thead>
                <tr>
                    <th>分类1</th>
                    <th>分类2</th>
                    <th>分类3</th>
                    <th>比例</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($bind_class_list) || $bind_class_list instanceof \think\Collection || $bind_class_list instanceof \think\Paginator): if( count($bind_class_list)==0 ) : echo "" ;else: foreach($bind_class_list as $key=>$vo): ?>
                    <tr>
                        <td><?php echo $vo['class_1_name']; ?></td>
                        <td><?php echo $vo['class_2_name']; ?></td>
                        <td><?php echo $vo['class_3_name']; ?></td>
                        <td><?php echo $vo['commis_rate']; ?>%</td>
                    </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table></td>
        </tr>
        </tbody>
    </table>

    <table class="store-joinin" cellspacing="0" cellpadding="0" border="0">
        <thead>
        <tr>
            <th colspan="20">证件信息：</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>企业营业执照副本：</th>
            <td colspan="20"><a nctype="nyroModal" href="<?php echo $apply['business_licence_cert']; ?>"> <img src="<?php echo $apply['business_licence_cert']; ?>" alt=""> </a></td>
        </tr>
        <tr>
            <th>税务登记证复印件：</th>
            <td colspan="20"><a nctype="nyroModal" href="<?php echo $apply['taxpayer_cert']; ?>"> <img src="<?php echo $apply['taxpayer_cert']; ?>" alt=""> </a></td>
        </tr>
        <tr>
            <th>织机构代码证复印件：</th>
            <td colspan="20"><a nctype="nyroModal" href="<?php echo $apply['orgnization_cert']; ?>"> <img src="<?php echo $apply['orgnization_cert']; ?>" alt=""> </a></td>
        </tr>
        <tr>
            <th>法人身份证：</th>
            <td colspan="20"><a nctype="nyroModal" href="<?php echo $apply['legal_identity_cert']; ?>"> <img src="<?php echo $apply['legal_identity_cert']; ?>" alt=""> </a></td>
        </tr>
        <tr>
            <th>店铺负责人身份证：</th>
            <td colspan="20"><a nctype="nyroModal" href="<?php echo $apply['store_person_cert']; ?>"> <img src="<?php echo $apply['store_person_cert']; ?>" alt=""> </a></td>
        </tr>
        </tbody>
    </table>
</div>
<script type="text/javascript">

</script>
</body>
</html>