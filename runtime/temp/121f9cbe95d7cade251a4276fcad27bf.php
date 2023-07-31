<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:49:"./application/admin/view2/goods/ajaxSpecList.html";i:1532661068;}*/ ?>
<table>
       <tbody>
            <?php if(is_array($specList) || $specList instanceof \think\Collection || $specList instanceof \think\Paginator): $i = 0; $__LIST__ = $specList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
              <tr>
                <td class="sign" axis="col6">
                  <div style="width: 24px;"><i class="ico-check"></i></div>
                </td>
                <td align="center" axis="col0">
                  <div style="width: 50px;"><?php echo $list['id']; ?></div>
                </td>                
                <td align="center" axis="col0">
                  <div style="text-align: left; width: 150px;"><?php echo $list['name']; ?></div>
                </td>
                <td align="center" axis="col0">
                  <div style="text-align: left; width: 200px;"><?php echo $cat_list[$list[cat_id1]]; ?></div>
                </td>
                       
                <td align="center" axis="col0">
                  <div style="text-align: left; width: 50px;">
    	              <input type="text" onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" onpaste="this.value=this.value.replace(/[^\d]/g,'')" onblur="changeTableVal('spec','id','<?php echo $list['id']; ?>','order',this)" size="4" value="<?php echo $list['order']; ?>" />
                  </div>
                </td>                 
				<td align="center" class="col0">
                    <div style="text-align: center; width: 130px;">
                        <a class="btn red" href="javascript:del_fun('<?php echo U('Goods/delGoodsSpec',array('id'=>$list['id'])); ?>');"><i class="fa fa-trash-o"></i>删除</a>
                        <a class="btn blue" href="<?php echo U('Admin/goods/addEditSpec',array('id'=>$list['id'])); ?>"><i class="fa fa-pencil-square-o"></i>编辑</a>
                    </div>
                </td> 
                <td align="" class="" style="width: 100%;">
                  <div>&nbsp;</div>
                </td>
              </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>             
          </tbody>
        </table>
        <!--分页位置--> <?php echo $pager->show(); ?>
		<script>
            // 点击分页触发的事件
            $(".pagination  a").click(function(){
                cur_page = $(this).data('p');
                ajax_get_table('search-form2',cur_page);
            });
        </script>        