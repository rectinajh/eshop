<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:50:"./application/admin/view2/user/ajaxmember_log.html";i:1532661069;}*/ ?>
<div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
    <table>
        <tbody>
        <?php if(is_array($userList) || $userList instanceof \think\Collection || $userList instanceof \think\Paginator): $i = 0; $__LIST__ = $userList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
            <tr data-id="<?php echo $list['user_id']; ?>">
                <td class="sign">
                    <div style="width: 24px;"><i class="ico-check"></i></div>
                </td>
                <td align="left" class="">
                    <div style="text-align: center; width: 80px;"><?php echo $list['user_id']; ?></div>
                </td>
                <td align="left" class="">
                    <div style="text-align: center; width: 80px;"><?php echo $list['desc']; ?></div>
                </td>
                <td align="left" class="">
                    <div style="text-align: center; width: 80px;"><?php echo (isset($list['order_sn']) && ($list['order_sn'] !== '')?$list['order_sn']:0); ?></div>
                </td>
                <td align="left" class="">
                    <div style="text-align: center; width: 80px;"><?php echo $list['user_money']; ?></div>
                </td>
               <!--  <td align="left" class="">
                    <div style="text-align: center; width: 50px;"><?php echo $list['pay_points']; ?></div>
                </td> -->
                <td align="left" class="">
                    <div style="text-align: center; width: 80px;"><?php echo $list['withdraw_money']; ?></div>
                </td>
                <td align="left" class="">
                    <div style="text-align: center; width: 80px;"><?php echo $list['jin_num']; ?></div>
                </td>
                <td align="left" class="">
                    <div style="text-align: center; width: 80px;"><?php echo $list['dedication_money']; ?></div>
                </td>
                <td align="left" class="">
                    <div style="text-align: center; width: 80px;"><?php echo $list['consume_cp']; ?></div>
                </td>
                <td align="left" class="">
                    <div style="text-align: center; width: 120px;"><?php echo date('Y-m-d H:i',$list['change_time']); ?></div>
                </td>
                
                <td align="" class="" style="width: 100%;">
                    <div>&nbsp;</div>
                </td>
            </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>
<!--分页位置-->
<?php echo $page; ?>
<script>
    $(".pagination  a").click(function(){
        var page = $(this).data('p');
        ajax_get_table('search-form2',page);
    });
    $(document).ready(function(){
        // 表格行点击选中切换
        $('#flexigrid >table>tbody>tr').click(function(){
            $(this).toggleClass('trSelected');
        });
        $('#user_count').empty().html("<?php echo $pager->totalRows; ?>");
    });
    function delfun(obj) {
        // 删除按钮
        layer.confirm('确认删除？', {
            btn: ['确定', '取消'] //按钮
        }, function () {
            $.ajax({
                type: 'post',
                url: $(obj).attr('data-url'),
                data: {id : $(obj).attr('data-id')},
                dataType: 'json',
                success: function (data) {
                    layer.closeAll();
                    if (data.status == 1) {
                        $(obj).parent().parent().parent().remove();
                    } else {
                        layer.alert(data.msg, {icon: 2});
                    }
                }
            })
        }, function () {
        });
    }
</script>