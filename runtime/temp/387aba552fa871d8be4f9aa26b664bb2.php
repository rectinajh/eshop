<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:51:"./template/mobile/default/user/ajax_class_list.html";i:1532661070;}*/ ?>
<?php if(is_array($comment_list) || $comment_list instanceof \think\Collection || $comment_list instanceof \think\Paginator): if( count($comment_list)==0 ) : echo "" ;else: foreach($comment_list as $key=>$comment): ?>

                <div class="shopprice dapco p" style="background:#fff;margin-bottom:0.2rem;padding:0.2rem 0;">

                    <div class="sonfbst" style="padding: 0.2rem 0;">

                        <div class="maleri30">
                            <span>会员昵称：<?php echo $comment[nickname]; ?></span>
                        </div>

                    </div>

                    <div class="fon_or fl" style="width: 100%;">
                        <span class="pall0">手机号：<?php echo $comment['mobile']; ?></span>
                        <span class="pall0">团队业绩:<?php echo $comment['team_performance']; ?></span>
                        <span class="pall0"><?php echo date('Y.m.d H:i',$comment['reg_time']); ?></span>
                    </div> 
                </div>

            <?php endforeach; endif; else: echo "" ;endif; ?>