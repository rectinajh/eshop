<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"./template/mobile/default/activity/flash_sale_list.html";i:1532661070;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>秒杀 - www.ohbbs.cn 欧皇源码论坛 </title>
	</head>
	<link rel="stylesheet" href="__STATIC__/css/style.css">
	<link rel="stylesheet" type="text/css" href="__STATIC__/css/iconfont.css"/>
	<script src="__STATIC__/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="__STATIC__/js/mobile-util.js" type="text/javascript" charset="utf-8"></script>
	<script src="__PUBLIC__/js/global.js"></script>
	<body>
		<div class="classreturn loginsignup">
			<div class="content">
				<div class="ds-in-bl return">
					<a href="javascript:history.back(-1)"><img src="__STATIC__/images/newBack.png" alt="返回"></a>
				</div>
				<div class="ds-in-bl search center">
					<span>秒杀</span>
				</div>
				<!-- <div class="ds-in-bl menu">
					<a href="javascript:void(0);"><img src="__STATIC__/images/class1.png" alt="菜单"></a>
				</div> -->
			</div>
		</div>
		<!-- <div class="flool tpnavf">
			<div class="footer">
				<ul>
					<li>
						<a class="yello" href="<?php echo U('Index/index'); ?>">
							<div class="icon">
								<i class="icon-shouye iconfont"></i>
								<p>首页</p>
							</div>
						</a>
					</li>
					<li>
						<a href="<?php echo U('Goods/categoryList'); ?>">
							<div class="icon">
								<i class="icon-fenlei iconfont"></i>
								<p>分类</p>
							</div>
						</a>
					</li>
					<li>
						<a href="<?php echo U('Cart/index'); ?>">
							<div class="icon">
								<i class="icon-gouwuche iconfont"></i>
								<p>购物车</p>
							</div>
						</a>
					</li>
					<li>
						<a href="<?php echo U('User/index'); ?>">
							<div class="icon">
								<i class="icon-wode iconfont"></i>
								<p>我的</p>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div> -->
		<div style="height: 1.92rem;"></div>
		<div class="floor killtime p">
			<div class="content30">
				<ul style="display: none;">
					<?php if(is_array($time_space) || $time_space instanceof \think\Collection || $time_space instanceof \think\Paginator): $i = 0; $__LIST__ = $time_space;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<li onclick="reload_flash_sale_list(this);" <?php if((time() >= $vo['start_time']) AND (time() < $vo['end_time'])): ?>class="red"<?php endif; ?> start-data="<?php echo date("Y/m/d H:i:s",$vo['start_time']); ?>" end-data="<?php echo date("Y/m/d H:i:s",$vo['end_time']); ?>" data-start-time="<?php echo $vo['start_time']; ?>" data-end-time="<?php echo $vo['end_time']; ?>">
							<h3><?php echo $vo['font']; ?></h3>
							<p><?php if(time() < $vo['start_time']): ?>即将开场<?php elseif((time() >= $vo['start_time']) AND (time() < $vo['end_time'])): ?>秒杀中<?php else: ?>已经结束<?php endif; ?></p>
						</li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<div class="nowkill">
					<span class="fl"><?php if(time() < $time_space[0]['start_time']): ?>秒杀活动即将开场~<?php else: ?>正在秒杀，先下单先得哦~<?php endif; ?></span>
					<span class="fr"></span>
				</div>
				<script>
					function GetRTime2(){
						var start_time_data = $('.content30').find('.red').attr('data-start-time');
						var timestamp   = Date.parse(new Date()).toString().substring(0,10);
						if(start_time_data > timestamp){
							var start_time = GetRTime($('.content30').find('.red').attr('start-data'));
							var start_time_index =  start_time.indexOf("天");
							$('.nowkill').find(".fl").text("秒杀活动即将开场~");
							$('.nowkill').find(".fr").html('距离开始'+start_time.substr(start_time_index+1));
						}else{
							var end_time = GetRTime($('.content30').find('.red').attr('end-data'));
							var end_time_index =  end_time.indexOf("天");
							$('.nowkill').find(".fl").text("正在秒杀，先下单先得哦~");
							$('.nowkill').find(".fr").html('距离结束'+end_time.substr(end_time_index+1));
						}

					}
				setInterval(GetRTime2,1000);
				</script>
			</div>
		</div>
		<div class="floor shopkill">
			<ul id="flash_sale_list">
			</ul>
		</div>
		<script type="text/javascript">
			$(function () {
				ajax_sourch_submit();
			});
			var page = 0;//页数
			var start_time = $('.content30').find('.red').attr('data-start-time');
			var end_time = $('.content30').find('.red').attr('data-end-time');
			function reload_flash_sale_list(obj)
			{
				page = 0;
				$(obj).parent().children().removeClass('red');
				$(obj).addClass('red');
				start_time = $(obj).attr('data-start-time');
				end_time = $(obj).attr('data-end-time');
				setInterval(GetRTime2,1000);
				$("#flash_sale_list").empty();
				ajax_sourch_submit();
			}

			/**
			 * 加载店铺
			 */
			function ajax_sourch_submit() {
                page++;
				$('.get_more').show();
				$.ajax({
					type: "get",
					url: "/index.php?m=Mobile&c=Activity&a=ajax_flash_sale&p=" + page + "&start_time=" + start_time + "&end_time=" + end_time,
					success: function (data) {
						if (data) {
							$("#flash_sale_list").append(data);
							$('.get_more').hide();
						} else {
							$('.get_more').hide();
							$('#getmore').remove();
						}
					}
				});
			}
		</script>
		<div class="floor_body2">
			<div id="J_ItemList">
				<ul class="product single_item info">
				</ul>
				<a href="javascript:;" class="get_more" style="text-align:center; display:block;">
					<img src='__STATIC__/images/category/loader.gif' width="12" height="12"> </a>
			</div>
		</div>
        <script type="text/javascript" src="__STATIC__/js/sourch_submit.js"></script>
		<script src="__STATIC__/js/swipeSlide.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>
