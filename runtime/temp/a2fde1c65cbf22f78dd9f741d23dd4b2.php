<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:54:"./template/mobile/default/user/ajax_recharge_list.html";i:1532661070;}*/ ?>
        <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$v): ?>
            <ul>
                <li class="li3"><span><?php echo $v[pay_name]; ?></span></li>
                <li class="li2"><span><?php echo date('Y-m-d', $v[ctime]); ?></span></li>
                <li class="li1"><span><?php echo $v[account]; ?></span></li>
                <li class="li4"><span class="red">
                    <?php if($v[pay_status] == 0): ?>待支付<?php endif; if($v[pay_status] == 1): ?>已支付<?php endif; if($v[pay_status] == 2): ?>支付失败<?php endif; ?>
                </span></li>
            </ul>
        <?php endforeach; endif; else: echo "" ;endif; ?>