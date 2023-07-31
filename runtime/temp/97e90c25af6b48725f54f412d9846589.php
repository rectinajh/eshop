<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:54:"./template/mobile/default/gold/ajax_transfer_list.html";i:1531973018;}*/ ?>
<?php if(is_array($account_log) || $account_log instanceof \think\Collection || $account_log instanceof \think\Paginator): if( count($account_log)==0 ) : echo "" ;else: foreach($account_log as $key=>$v): ?>  
    <div class="tr_box">
        <div class="tr_item time "><span class="line"></span><?php echo $v['nickname']; ?><span class="time2"> <?php echo date('Y.m.d H:i',$v[add_time]); ?></span>  </div>
            <div class="tr_item2"><div class="left">转账金额</div> <div class="right"><?php echo $v['money']; ?></div></div>
            <div class="tr_item2"><div class="left">手续费</div> <div class="right"><?php echo $v['shouxu']; ?></div></div>
            <div class="tr_item2"><div class="left">实际到账</div> <div class="right"><?php echo $v['shi_money']; ?></div></div>
            <div class="tr_item2"><div class="left">备注</div> <div class="right"><?php echo $v['desc']; ?></div></div>
            
    </div>
<?php endforeach; endif; else: echo "" ;endif; ?>