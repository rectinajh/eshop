<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:51:"./template/mobile/default/recognize/buyhistory.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>购买记录--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

    <link rel="stylesheet" href="__STATIC__/css/style.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" type="text/css" href="__STATIC__/css/iconfont.css?v=<?php echo time(); ?>"/>

    <!-- <link rel="stylesheet" type="text/css" href="__STATIC__/css/iconfont2.css?v=<?php echo time(); ?>"/> -->

    <link rel="stylesheet" type="text/css" href="__ROOT__/public/css/style.css?v=<?php echo time(); ?>"/>

    <script src="__STATIC__/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>

    <script src="__STATIC__/js/mobile-util.js" type="text/javascript" charset="utf-8"></script>


    <script src="__STATIC__/js/layer/layer.js" type="text/javascript" charset="utf-8"></script>
    <script src="__PUBLIC__/js/global.js"></script>
    

    <script src="__STATIC__/js/swipeSlide.min.js" type="text/javascript" charset="utf-8"></script>

    <script src="__PUBLIC__/js/mobile_common.js"></script>

</head>

<body class="[body]">

<div class="classreturn">

    <div class="content">

        <div class="ds-in-bl return">

            <a href="javascript:history.go(-1);"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

        </div>

        <div class="ds-in-bl search center">

            <span>购买记录</span>

        </div>

        <div class="ds-in-bl menu">

            <!-- <a href="javascript:void(0);"><img src="__STATIC__/images/class1.png" alt="菜单"></a> -->

        </div>

    </div>

</div>
<div style="height: 1.8rem;"></div>
<div class="flool tpnavf">

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

                <!--<a href="shopcar.html">-->

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

</div>
<style>
html, body {
    height: 100%;
    width: 100%;
    margin: 0;
}
.history{
    background-color: #EBEBEB;	
}
.history .box{

}
.history .box .item{
    display: flex;
    height: 4rem;
    padding-left: .5rem;
    background-color: #fff;
    border-bottom: .1rem solid #ebebeb;
}
.history .box .item .left{
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    align-items: flex-start;
    flex: 1;
    font-size: .56rem;
}
.history .box .item .left .time{
    font-size: .5rem;
    color:#a0a0a0;
}
.history .box .item .right{
    width: 22%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
}
.history .box .item .right .status{
    display: inline-block;
    color:#2A81F4;
    font-size: .56rem;
}
.history .box .item .right .status.active{
    background-color: #2a81f4;
    padding: .3rem .4rem;
    color:#fff;
    border-radius: .3rem;
}
.history .data_none{
    margin-top: 2rem;
    text-align: center;
    background-color: #fff;
}
.history .data_none img{
    width: 4rem;
    height: 4rem;
}
.history .data_none p{
    margin-top: .6rem;
    font-size: .7rem;
    color:#a0a0a0;
}
.payBtn {
    color: #fff;
    background: #43c2e8;
    border: none;
    padding: 30px 10px;
    border-radius: 6px;
}
.cancelBtn {
    width: 50%;
    background: transparent;
    border: none;
    color: #9c9c9c;
}	
.lay_chong{
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background-color: #333;
    z-index: 8;
    display: none;
}
.lay_chong .chong_box{
    position: absolute;
    top: 20%;
    left: 50%;
    transform: translateX(-50%);
    width: 90%;
    background-color: #fff;
    font-size: .56rem;
    border-radius: .3rem;
    padding: 1.5rem .5rem;
    text-align: center;
}
.lay_chong .chong_box p{
    font-size: .56rem;
    color: #333;
    margin-bottom: 1rem;
    text-align: center;
}
.lay_chong .chong_box .btn_go{
    font-size: .5rem;
    background-color: #2A81F4;
    padding: .3rem ;
    width: 80%;
    color:#fff;
    border-radius: .3rem;
}
.lay_chong .chong_box .close{
    position: absolute;
    right: .3rem;
    top: .3rem;
    width: .8rem;
    height: .8rem;
    background: url(__STATIC__/images/ico/guanbi.png) no-repeat center;
}
.pwdBox{
    display: none;
}

.labelPwd {
    line-height: 2rem;
    font-size: .6rem;
}

.pwd {
    border: none;
    border-bottom: 1px solid #909090;
    outline: none;
    text-indent: .5rem;
}

.btnPwd {
    margin-top: 1rem;
    width: 40%;
    height: 1.5rem;
    border-radius: .2rem;
    background-color: #2A81F4;
    color: #fff;
    text-align: center;
    border: none;
    outline: none;
}

.btnCancel {
    width: 40%;
    height: 1.5rem;
    border-radius: .2rem;
    background-color: #b9b9b9;
    
    color: #fff;
    text-align: center;
    border: none;
    outline: none;
    margin-right: 1rem;
}
</style>
<div class="history">
	<?php if(empty($recognizeTrade) || (($recognizeTrade instanceof \think\Collection || $recognizeTrade instanceof \think\Paginator ) && $recognizeTrade->isEmpty())): ?>
		<div class="data_none">
			<img src="__STATIC__/images/ico/none_data.png" alt="">
			<p>还没有数据呢！</p>
		</div>
	<?php else: ?>
		<div class="box">
			<?php if(is_array($recognizeTrade) || $recognizeTrade instanceof \think\Collection || $recognizeTrade instanceof \think\Paginator): if( count($recognizeTrade)==0 ) : echo "" ;else: foreach($recognizeTrade as $key=>$trade): ?>
				<div class="item">
					<div class="left">
						<p class="no">单号：<?php echo $trade['trade_no']; ?></p>
						<p class="num">数量：<?php echo $trade['buy_qty']; ?></p>
                      <p class="time">时间：<?php echo $trade['create_time']; ?></p>
					</div>
					<div class="right">
						<?php if($trade['pay_status'] == 0 && $trade['status'] == 0): ?>
							<button class="payBtn" data-id="<?php echo $trade['id']; ?>">立即支付</button>
                            <button class="cancelBtn" data-id="<?php echo $trade['id']; ?>">取消</button>
						<?php else: ?>
							<span class="status"><?php echo $trade['status_name']; ?></span>
						<?php endif; ?>	
					</div>
				</div>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	<?php endif; ?>
	<div class="lay_chong">
		<div class="chong_box">
			<span class="close"></span>
			<p>对不起,您的余额不足,当前余额:<?php echo $user['user_money']; ?></p>
			<a href="<?php echo url('Mobile/User/recharge'); ?>" style="background: #31addc;color: #fff;padding: 0.2rem 0.5rem;border-radius: 0.4rem;">立即充值</a>
		</div>
	</div>
	<div class="pwdBox">
		<form action="" method="POST" class="showPwd">
			<label class="labelPwd">
				<input type="password" class="pwd" name="password" placeholder="请输入密码">
			</label>
			<div>
				<input type="button" class="btnCancel" value="取消">
				<input type="submit" class="btnPwd" value="确定">
			</div>
		</form>
	</div>
</div>
<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
<script src="__STATIC__/js/polygonizr.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	$(function () {
		$('.right .payBtn').click(function() {
			var that = this;
			var layerIndex = layer.open({
				title: [
					'输入密码',
					'background-color: #2A81F4; color:#fff;font-size:.7rem;height:1.6rem;line-height:1.6rem;'
				],
				content: $('.showPwd').html(),
		});
		//确定按钮
			$(document).on('click', '.btnPwd', function () {
				var value = $('.layui-m-layer input[type=password]').val();
				$.ajax({
					url: '/Mobile/goldchain/validateSafePassword/',
					type: 'POST',
					data: {password: value},
					success: function (res) {
						if (res.code == 0) {
							alert(res.msg);
						} else {
							$.ajax({
								url: '/Mobile/Recognize/pay',
								type: 'POST',
								data: {
									trade_id: $(that).attr('data-id'),
									password:value
								},
								success: function (datas) {
									switch (datas.code) {
										case -1:
											// $('.mask,.chain').hide();
											$('.lay_chong').show();
											break;
										case 0:
											alert(datas.msg);
											break;
										default:
											layer.close(layerIndex);javascript:;
											// alert(res.msg);
											layer.open({
												content:datas.msg,
												time:2,
												end:function(){
													window.location.reload();
												}
											})
											break;
									}
									
								}
							});
							$(document).off('click', '.btnPwd');
						}
					}
				});
			})
			$(document).one('click', '.btnCancel', function () {
				$(document).off('click', '.btnPwd');
				layer.close(layerIndex)
			});
		});
		$('.right .cancelBtn').click(function() {
			var that = this, id = $(that).data('id');
			$.ajax({
            	url: '/Mobile/Recognize/cancel',
              	type: 'POST',
              	data: {trade_id: id},
              	success: function (res) {
                  	console.log(res);
                  if (res.code == 1) {
                      layer.open({
                          content: res.msg,
                          time: 2,
                          end: function() {
						     window.location.reload();
                          }
                      });
                  } else {
                      layer.open({
                          content: res.msg,
                          time: 3
                      });
                  }
                },
            });
		});
	});
</script>
</body>
</html>
