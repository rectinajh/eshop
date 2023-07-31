<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"./template/mobile/default/user/ajax_withdrawals_list.html";i:1532661070;}*/ ?>
<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?>
    <ul>
        <li class="li1"><span><?php echo $v[id]; ?></span></li>
        <li class="li2"><span><?php echo date('Y-m-d', $v[create_time]); ?></span></li>
        <li class="li3"><span><?php echo $v[money]; ?></span></li>
        <li class="li4"><span class="red">
            <?php if($v[status] == 0): ?>申请中<?php endif; if($v[status] == 1): ?>申请成功<?php endif; if($v[status] == 2): ?>申请失败<?php endif; ?>
        </span></li>
    </ul>
<?php endforeach; endif; else: echo "" ;endif; ?>
