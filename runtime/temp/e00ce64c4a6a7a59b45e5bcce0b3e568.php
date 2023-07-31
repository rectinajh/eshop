<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"./template/mobile/default/gold/ajax_consume_list.html";i:1532661070;}*/ ?>
<?php if(is_array($account_log) || $account_log instanceof \think\Collection || $account_log instanceof \think\Paginator): if( count($account_log)==0 ) : echo "" ;else: foreach($account_log as $key=>$v): ?>

    <div class="fll_acc">

        <ul>

            <li><?php echo $v[desc]; ?></li>

            <li>

                <span>算力：</span><span class="red"><?php echo $v[consume_cp]; ?></span></li>

            <li>

                <p class="coligh">

                    <span><?php echo date('Y.m.d H:i',$v[change_time]); ?></span>

                </p>

            </li>

        </ul>

    </div>

<?php endforeach; endif; else: echo "" ;endif; ?>