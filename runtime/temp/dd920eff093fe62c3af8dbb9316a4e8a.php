<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:49:"./application/admin/view2/goods/getSpecByCat.html";i:1532661068;}*/ ?>
<?php if(is_array($goods_category_list) || $goods_category_list instanceof \think\Collection || $goods_category_list instanceof \think\Paginator): if( count($goods_category_list)==0 ) : echo "" ;else: foreach($goods_category_list as $k=>$v): ?>
  <dl>
    <dt style="display: block;" id="categoryId<?php echo $v[id]; ?>"><?php echo $v[name]; ?></dt>
    <dd>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $k2=>$v2): if($v[id] == $v2['cat_id1']): ?>          
          <label style="display: inline-block;" for="spec_id_<?php echo $v2['id']; ?>">                      
	         <input type="checkbox" id="spec_id_<?php echo $v2['id']; ?>" class="brand_change_default_submit_value"  name="spec_id[]" value="<?php echo $v2['id']; ?>" <?php if(($v2['type_id'] != null) and ($type_id == $v2['type_id'])): ?> checked="checked"<?php endif; ?> />&nbsp;&nbsp;<?php echo $v2['name']; ?>             
          </label>
        <?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </dd>
  </dl>
<?php endforeach; endif; else: echo "" ;endif; ?>