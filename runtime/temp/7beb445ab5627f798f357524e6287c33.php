<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:45:"./template/mobile/default/user/visit_log.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>浏览记录 - www.ohbbs.cn 欧皇源码论坛 </title>
		<link rel="stylesheet" href="__STATIC__/css/style.css">
		<link rel="stylesheet" type="text/css" href="__STATIC__/css/iconfont.css"/>
        <link rel="stylesheet" type="text/css" href="__ROOT__/public/css/style.css"/>
		<script src="__STATIC__/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="__STATIC__/js/mobile-util.js" type="text/javascript" charset="utf-8"></script>
        <style>
            #visit_list{
                margin-bottom: 30px;
            }
        </style>
	</head>
	<body>
		<div class="classreturn loginsignup">
			<div class="content">
				<div class="ds-in-bl return">
					<a href="<?php echo U('User/index'); ?>"><img src="__STATIC__/images/newBack.png" alt="返回"></a>
				</div>
				<div class="ds-in-bl search center">
					<span>浏览记录</span>
				</div>
				<div class="ds-in-bl emptyedit">
					<a href="javascript:void(0);" onclick="clearempty();">清空</a>
					<a href="javascript:void(0);" onclick="editalone();">编辑</a>
				</div>
			</div>
		</div>
        <?php if(empty($visit_list) || (($visit_list instanceof \think\Collection || $visit_list instanceof \think\Paginator ) && $visit_list->isEmpty())): ?>
            <!--没有内容时-s--->
            <div class="comment_con p">
                <div class="none">
                    <img src="__STATIC__/images/none2.png">
                    <br><br>
                    还没有浏览记录
                </div>
            </div>
            <!--没有内容时-e--->
        <?php else: ?>
            <div id="visit_list">
            <?php if(is_array($visit_list) || $visit_list instanceof \think\Collection || $visit_list instanceof \think\Paginator): if( count($visit_list)==0 ) : echo "" ;else: foreach($visit_list as $curdate=>$list): ?>
                <div class="daterecord">
                    <div class="maleri30">
                        <?php echo $curdate; ?>
                    </div>
                </div>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$goods): ?>
                <div class="orderlistshpop dejsshort p">
                    <div class="maleri30">
                        <div class="sc_list se_sclist">
                            <div class="radio fl">
                                <span class="che " data-id="<?php echo $goods['visit_id']; ?>">
                                    <i></i>
                                </span>
                            </div>
                            <div class="shopimg fl">
                                <a href="<?php echo U('Goods/goodsInfo',['id'=>$goods['goods_id']]); ?>">
                                    <img src="<?php echo goods_thum_images($goods['goods_id'],200,200); ?>">
                                </a>
                            </div>
                            <div class="deleshow fr">
                                <div class="deletes p">
                                    <a href="<?php echo U('Goods/goodsInfo',['id'=>$goods['goods_id']]); ?>">
                                        <span class="similar-product-text fl"><?php echo $goods['goods_name']; ?></span>
                                    </a>
                                </div>
                                <div class="prices lookalike">
                                    <p class="sc_pri fl"><span>￥</span><span><?php echo $goods['shop_price']; ?></span></p>
                                    <a href="<?php echo U('Goods/goodsList',['id'=>$goods['cat_id3']]); ?>">看相似</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
            </div>
        <?php endif; ?>

        <div id="getmore"  style="font-size:.32rem;text-align: center;color:#888;padding:.25rem .24rem .4rem; clear:both;display: none">
            <a >已显示完所有记录</a>
        </div>


		<div class="foohi foohiext a_emptyall">
			<div class="payit ma-to-20 payallb">
				<div class="fl alllef">
					<div class="radio fl">
						<span class="che alltoggle">
							<i></i>
						</span>
						<span class="all">全选</span>
					</div>
				</div>
				<div class="fr">
                    <a href="javascript:void(0);" onclick="delSelect()">删除</a>
				</div>
			</div>
		</div>
		<!--删除浏览记录-s-->
		<div class="cuidd delbrowser">
			<p>确定要清空全部浏览记录？</p>
			<div class="weiyi p">
				<a class="qx" href="javascript:void(0);">取消</a>
                <a class="eno" href="javascript:void(0);" onclick="clearAll()">确定</a>
			</div>
		</div>
		<!--删除浏览记录-e-->
		<div class="mask-filter-div" style="display: none;"></div>
<!--底部导航-start-->

        <!-- 
    <a id="gotop" href="javascript:$('html,body').animate({'scrollTop':0},600);" style="display: block;width: 0.853rem;height: 0.853rem;position: fixed; bottom: 2.027rem;right: 8px; background-color: rgba(243,241,241,0.5);border: 1px solid #CCC;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;">

        <img src="__STATIC__/images/topup.png" style="display: block;width: 0.853rem;height: 0.853rem;">

    </a> -->
    
</footer>
<div id="footers" style="z-index: 9999999;">
    <a <?php if(CONTROLLER_NAME == 'Index'): ?> class="on" <?php endif; ?> href="<?php echo U('Index/index'); ?>">
        <p><i class="iconfont icon-size icon-dingbu_shouye" ></i></p>
        <span>首页</span>
    </a>
    <a <?php if(CONTROLLER_NAME == 'Goods'): ?> class="on" <?php endif; ?> href="<?php echo U('Goods/categoryList'); ?>">
        <p><i class="iconfont icon-size icon-fenlei"></i></p>
        <span>分类</span>
    </a>
     <a <?php if(CONTROLLER_NAME == 'Gold'): ?> class="on" <?php endif; ?> href="<?php echo U('Gold/gold_chain'); ?>">
        <p><i class="iconfont icon-size icon-jifen"></i></p>
        <span>新淘链</span>
    </a>
    <a <?php if(CONTROLLER_NAME == 'Cart'): ?> class="on" <?php endif; ?> href="<?php echo U('Cart/index'); ?>">
        <p><i class="iconfont icon-size icon-gouwuche"></i></p>
        <span>购物车</span>
    </a>
    <a <?php if(CONTROLLER_NAME == 'User'): ?> class="on" <?php endif; ?> href="<?php echo U('User/index'); ?>">
        <p><i class="iconfont icon-size icon-wode"></i></p>
        <span>我的</span>
    </a>
</div>

        <!--底部导航-end-->
		<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" src="__STATIC__/js/sourch_submit.js"></script>
		<script type="text/javascript">
			//编辑
			function editalone(){
				$('.dejsshort').toggleClass('hiradio');
				$('.a_emptyall').toggle();
			}
            //取消
            $(document).on('click','.weiyi .qx',function(){
                undercover()
                $('.delbrowser').hide();
            })
			//清空
			function clearempty(){
				cover();
				$('.cuidd').show();
			}
			//全选
			$(function(){
				$('.alltoggle,.radio .all').click(function(){
					allchk();
				});
			})
			function allchk(){ 
			    var chknum = $('.che').length - 2;
			    var chk = 0; 
			    $('.che').each(function () {   
			        if($(this).hasClass('check_t')){ 
			            chk++; 
			        } 
			    }); 
			    //alert(chknum + '-' + (chk - 1))
			    if(chknum==(chk - 1)){
			        $(".che").removeClass('check_t'); //全取消 
			    }else{
			        $(".che").addClass('check_t'); //全选 
			    } 
			} 
            function delSelect() {
                var visit_ids = [];
                $(' .check_t').each(function(){
                    visit_ids.push($(this).attr('data-id'));
                });
                location.href = "<?php echo U('Mobile/User/del_visit_log'); ?>?visit_ids="+String(visit_ids);
            }
            function clearAll() {
                location.href = "<?php echo U('Mobile/User/clear_visit_log'); ?>";
            }
            var page = 1;
            function ajax_sourch_submit()
            {
                page += 1;
                $.ajax({
                    type : "get",
                    url:"<?php echo U('Mobile/User/visit_log'); ?>?is_ajax=1&p=" + page,
                    success: function(data)
                    {
                        if($.trim(data) == ''){
//                            $("#visit_list").append('<div class="score enkecor">已显示完所有记录</div>');
                            $('#getmore').show();
                            return false;
                        } else {
                            $("#visit_list").append(data);
                        }
                    }
                });
            }
		</script>
	</body>
</html>
