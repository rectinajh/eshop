<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:46:"./template/mobile/default/recognize/index.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;}*/ ?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>新淘链--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

            <span>新淘链</span>

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
		overflow: hidden;
	}
	#site-landing {
		position:relative;
		height: 100%;
		width: 100%;
	   background-image: linear-gradient(to top, #060606 0%, #03a3df 100%);
	}
	#particles{
		height: 100%;
		width: 100%;
		position: absolute;
		top: 1.8rem;
		left: 0;
		right: 0;
		bottom: 0;
	}
	 #particles .xintao {
	  width: 100%;
	  height: 100%;
	  padding-top: 10px;
	  position: relative;
	}
	.xintao .header{
		height: 2.6rem;
		text-align: center;
		display: flex;
		justify-content: center;
		align-items: flex-start;
	}
	.xintao .header .sheng{
		font-size: .65rem;
		border:.1rem solid #fff;
		border-radius: .6rem;
		margin-top: -.5rem;
		padding:.8rem .8rem .5rem ;
		color:#fff;
	}
	.xintao .tip{
		color: #fff;
		font-size: .5rem;
		text-align: center;
		margin: .5rem 0;
	}
	.xintao .flex{
		display: flex;
		flex-direction: column;
		justify-content: space-around;
		align-items: center;
		position: relative;
	}

	.xintao .center{
		flex: 1;
		font-size: .5rem;
		color: #fff;
		/* #E2B574 */
		background-color: #74c5e2;
		padding: .5rem 1rem;
		border-radius: .3rem;
	}
	.xintao .center span{
		font-size: 1.5rem;
		margin: 0 .3rem;
		color: #E2B574;
	}
	.xintao .right{
		width: 100%;
		display: flex;
		justify-content: space-between;
		font-size: .5rem;
		align-items: center;
		margin-top: .6rem;
	}
	.xintao .right a{
		color: #fff;
	}
	.xintao .right .link{
		margin-top: .5rem;
		display: flex;
		flex-direction: column;
		justify-content: space-around;
		align-items: flex-end;
	}
	.xintao .right .introduce{
		border: .1rem solid #78D2FF;
		padding: .4rem 1rem .4rem .5rem;
		border-radius: 1rem;
		text-align: left;
		color: #fff;
		margin-right: -.8rem;
		margin-top: .5rem;	
		display: flex;
		flex-direction: column;
	}
	.xintao .right .balance{
		margin-top: .5rem;
		display: flex;
		flex-direction: column;
		align-items: center;
		color: #fff;
		font-size: .5rem;
		align-items: flex-start;
	}
	
	.xintao .right .progress{
		width: 4rem;
		height: .5rem;
		border-radius: .3rem;
		background:#78D2FF;
		margin-top: .5rem;
	}
	.xintao .right .progress .inner{
		width: <?php echo $remainRatio; ?>%;
		height: .4rem;
		background-color: #02f3f9;
		/* background-color: #2a81f4; */
		border-radius: .3rem;
		margin-top: .05rem;
		margin-left: .1rem;
	}
	.xintao .joinIn{
		/* border: .1rem solid #00fdfd; */
		background: linear-gradient(to bottom, #039cd5 0%,#74c5e2 50%,#039ed9 100%);
		border-radius: 1rem;
		margin-right: .5rem;
		margin-top: 1rem;
		padding: .5rem 1.6rem;
		font-weight: bold;
		font-size: .8rem;
		letter-spacing: .1rem;
		color: #fff;
		position: absolute;
		top: 40%;
		left: 50%;
		transform: translateX(-50%);
		z-index: 5;
	}
	.xintao .bg{
		width: 100%;
		text-align: center;
		position: absolute;
		bottom: 0;
		left: 0;
		right: 0;
		height: 50%;
		perspective: 1000px;
	}
	.xintao .bg .logo{
		width: 30%;
		
	}
	.xintao .bg .bgImg{
		width: 12rem;
		position: absolute;
		bottom: 28%;
		left: 50%;
		margin-left: -6rem;
		/* animation: runImg 2s linear infinite; */
	}
	.xintao .bg .logo{
		z-index: 10;
		animation:  run  1s linear  infinite;
		margin-top: 1.2rem;
	}
	@keyframes run{
		from{
			transform: rotate(0deg) scale(0.5, 0.5)
		}
		to{
			transform: rotateZ(360deg) scale(1.5, 1.5)
			
		}
	}
	@keyframes run2{
		from{
			transform: rotate(0deg)
		}
		to{
			transform: rotate(360deg)
		}
	}
	@keyframes runImg{
		from{
			transform: rotateY(0deg) 
		}
		to{
			transform: rotateY(360deg) 
		}
	}
	.daojishi{
		margin-top: .5rem;
		font-size: .5rem;
		color: #fff;
		display: flex;
		flex-direction: column;
		align-items: center;
		 border: .1rem solid #78D2FF;
	    padding: .2rem .2rem .3rem .3rem;
	    border-radius: 1rem;
	    text-align: left;
	    color: #fff;
	    margin-left: -.8rem;
	}
	.daojishi .time{
		margin-top: .5rem;
		font-size: .5rem;
		margin-left: .5rem;
		
	}
	.success{
		font-size: .6rem;
		color: #fff;
		margin-top: .5rem;
		position: absolute;
		bottom: 2.6rem;
		left: 0;
		width: 100%;
	}
	.success ul{
		height: 1rem;
		overflow: hidden;
	}
	.success .flex-box{
		display: flex;
		flex-direction: row;
		align-items: center;
		padding-left: .5rem;
		height: 1rem;
		justify-content: center;
	}
	.mask {
	    position: fixed;
	    bottom: 0;
	    left: 0;
	    width: 100%;
	    height: 100%;
	    text-align: center;
	    background: rgba(0,0,0,0.6);
	    z-index: 9;
	}
	.hide {
	    display: none;
	}
	.chain .chainBox {
	    width: 85%;
	    height: 30%;
	    position: absolute;
	    top: 25%;
	    left: 50%;
	    z-index: 1000;
	   transform: translateX(-50%)
	}
	.chain .chainBox .chainText {
	    color: black;
	    background-color: #fff;
	    border: .2rem solid #30cfd0;
	    border-radius: .5rem;
	    padding:0  2%;
	    text-align: center;
	    height: 100%;
	}
	.chainText h1 {
	    color: #2A81F4;
	    font-size:.66rem;
	    padding-bottom: .6rem;
	    border-bottom: 1px solid #2A81F4;
		padding-top: .3rem;
	}

	.chainText h2 {
	    /* padding: 4% 0; */
	    font-weight: normal;
	    font-size: .5rem;
	    margin-bottom: .5rem;
	}
	.chainText .input {
	    margin-bottom: .5rem;
	    width: 100%;
	    justify-content: center;
	    margin-top: 1rem;
	}
	.chainBox .chainText .input span {
	    display: inline-block;
	    width: 1rem;
	    height: 1rem;
	    margin: 0 .3rem;
	}
	.chainText .input .cut {
	    background: url(__STATIC__/images/ico/ico_chain_cut1.png) no-repeat center center;
	    background-size: 100% 100%;
	}
	.flex-box {
	    display: -webkit-box;
	    display: -webkit-flex;
	    display: flex;
	    -webkit-box-align: center;
	    -webkit-align-items: center;
	    align-items: center;
	}
	.chainText .input input {
	    -webkit-appearance: none;
	    appearance: none;
	    outline: none;
	    text-decoration: none;
	    border: 1px solid #757575;
	    border-radius: .3rem;
	    width: 75%;
	    height: 1.3rem;
	    text-align: center;
	    font-size: .6rem;
	}
	 .chainText .input .add {
	    background: url(__STATIC__/images/ico/ico_chain_add1.png) no-repeat center center;
	    background-size: 100% 100%;
	}
	.chainBox .chainText p.pricemoney {
	    font-size: .55rem;
	    color: #2A81F4;
	    justify-content: center;
	    margin-top: .8rem;
	}
	.chain .chainBox .btn {
	    width: 70%;
	    height: 2.4rem;
	    background: url(__STATIC__/images/ico/ico_chain_btn.png) no-repeat center center;
	    background-size: 100% 100%;
	    margin: 5% auto 0;
	    font-size: 1rem;
	}

</style>	

	<div id="site-landing"></div>
	<div id="particles">
	    <div class="xintao">
	     	<div class="header">
	     		<p class="sheng">新淘链数量剩余：<?php echo $recognize['remain_qty']; ?> 个</p>
	     	</div>
	     	<!-- <p class="tip">新淘链总量恒定，支持商城购物，升值空间巨大</p> -->
	     	<div class="flex">
	     		<!-- <div class="left"></div> -->
	     		<div class="center">众筹抢购价:<span><?php echo $recognize['price']; ?></span>元/个</div>
	     		
				<div class="right">
					<div class="daojishi">
						<span>倒计时</span>
						<span class="time">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;天&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;时&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;分&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;秒
						</span>
					</div>
					<div class="balance" href="javascript:;">
						<div class="title">众筹数量剩余<?php echo $remainRatio; ?>%</div>
						
						<div class="progress"><div class="inner"></div></div>

					</div>
					<div class="link">
						<a class="introduce mingdan" href="javascript:;">众筹参与名单</a>

						<a class="introduce jieshao" href="javascript:;">查看新淘链介绍</a>
						<a class="introduce" href="<?php echo U('Recognize/buyhistory'); ?>">购买记录</a>
					</div>
				</div>
				
	     	</div>	
	     	<div class="success">
                <ul>
							<?php if(is_array($buyList) || $buyList instanceof \think\Collection || $buyList instanceof \think\Paginator): if( count($buyList)==0 ) : echo "" ;else: foreach($buyList as $key=>$buy): ?>
								<li class="flex-box">
									恭喜<span>会员<?php echo $buy['safe_mobile']; ?></span>成功购买
									<span><?php echo $buy['buy_qty']; ?></span>个新淘链
								</li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
            </div>
				<a href="javascript:;" class="joinIn">加入新淘</a>

	     	<div class="bg">
	     		<img src="__STATIC__/images/ico/ico_chain_bean.png" alt="" class="logo">
	     		<img src="__STATIC__/images/ico/ico_chain_beanBg.png" alt="" class="bgImg">
	     	</div>
	    </div>
	    <div class="mask hide" onclick="$('.mask').fadeOut();
		$('.chain').fadeOut()" style="background: rgba(0, 0, 0, 0.6);"></div>
		<div class="chain hide">
            <div class="chainBox">
                <div class="chainText">
                    <h1>请输入购买新淘数量</h1>
                    <h2>众筹期间时间和数量有限，抓住机会！</h2>
                    <div class="input flex-box">
                        <!-- <span class="cut"></span> -->
                        <input id="numinput" type="number" value="100">
                        <!-- <span class="add"></span> -->
                    </div>
                    <p class="flex-box pricemoney"><span class="price"><?php echo $recognize['price']; ?> </span>元/个，共需花费 <span class="money">10</span> 元</p>
                </div>
                <div class="btn" id="buy_lido" data-place-url="/lido/place_buy_order.html">
                </div>
            </div>
		</div>
		<style>
			.lay_mingdan{
				position: fixed;
				top: 0;
				left: 0;
				height: 100%;
				width: 100%;
				background-color: #333;
				z-index: 6;
				display: none;
			}
			.lay_mingdan .box{
				position: absolute;
				top: 30%;
				left: 50%;
				transform: translateX(-50%);
				width: 80%;
				background-color: #fff;
				font-size: .56rem;
				border-radius: .3rem;
				padding-bottom: .5rem;
				/* max-height: 50%;
				overflow-y: scroll; */
			}
			.lay_mingdan .box .top{
				/* position: relative; */
				position: fixed;
				width: 100%;
			}
			.lay_mingdan .box .title{
				font-size: .6rem;
				padding: .5rem;
				background-color: #2A81F4;
				border-top-left-radius: .3rem;
				border-top-right-radius: .3rem;
				text-align: center;
				color:#fff;
			}
			.lay_mingdan .box .close{
				position: absolute;
				right: .3rem;
				bottom: .3rem;
				width: .8rem;
				height: .8rem;
				background: url(__STATIC__/images/ico/close.png) no-repeat center;
			}
			.lay_mingdan .box .mingdan_content{
				margin-top: 1.5rem;
				height: 10rem;
				overflow-y: scroll;
			}
			.lay_mingdan .box ul{
				padding: .5rem 0;
			}
			.lay_mingdan .box .flex-box {
				line-height: 1.5rem;
				padding-left: .5rem;
			}
			.lay_mingdan .data_none{
				margin-top: 1.5rem;
				text-align: center;
				background-color: #fff;
			}
			.lay_mingdan .data_none img{
				width: 4rem;
				height: 4rem;
			}
			.lay_mingdan .data_none p{
				margin-top: .6rem;
				font-size: .7rem;
				color:#a0a0a0;
			}
		</style>
		<div class="lay_mingdan">
			<div class="box">
				<div class="top">
						<p class="title">众筹参与名单</p>
						<span class="close"></span>
				</div>
				<div class="mingdan_content">
					<ul>
						<?php if(empty($buyList) || (($buyList instanceof \think\Collection || $buyList instanceof \think\Paginator ) && $buyList->isEmpty())): ?>
							<div class="data_none">
								<img src="__STATIC__/images/ico/none_data.png" alt="">
								<p>还没有数据呢！</p>
							</div>
						<?php else: if(is_array($buyList) || $buyList instanceof \think\Collection || $buyList instanceof \think\Paginator): if( count($buyList)==0 ) : echo "" ;else: foreach($buyList as $key=>$buy): ?>
								<li class="flex-box">
									恭喜<span>会员<?php echo $buy['safe_mobile']; ?></span>成功购买
									<span><?php echo $buy['buy_qty']; ?></span>个新淘链
								</li>
							<?php endforeach; endif; else: echo "" ;endif; endif; ?>
					</ul>	
				</div>
				
			</div>
		</div>
		<style>
			.lay_jieshao{
				position: fixed;
				top: 0;
				left: 0;
				height: 100%;
				width: 100%;
				background-color: #333;
				z-index: 6;
				display: none;
			}
			.lay_jieshao .intorBox{
				position: absolute;
				top: 20%;
				left: 50%;
				transform: translateX(-50%);
				width: 90%;
				background-color: #fff;
				font-size: .56rem;
				border-radius: .3rem;
				padding: .5rem;
				height: 60%;
				overflow-y:scroll;
			}
			
			.lay_jieshao .intorBox .close{
				position: absolute;
				right: .3rem;
				top: .3rem;
				width: .8rem;
				height: .8rem;
				background: url(__STATIC__/images/ico/guanbi.png) no-repeat center;
			}
			.lay_jieshao .intorBox img{
                display: block;
            }
            .lay_jieshao .intorBox p {
                line-height: 1rem;
                 
            }
            .lay_jieshao .intorBox p span{
                font-size: .56rem !important;
            }
           
		</style>
		<div class="lay_jieshao">
			<div class="intorBox">		
				<span class="close"></span>
				<?php echo htmlspecialchars_decode($recognize['content']); ?>
			</div>
		</div>
		<style>
				.pwdBox{
					display: none;
				}
			
				.labelPwd{
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
			<style>
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
			</style>
			<div class="lay_chong">
				<div class="chong_box">
					<span class="close"></span>
					<p>对不起,您的余额不足,当前余额:<?php echo $user['user_money']; ?></p>
					<a href="<?php echo url('Mobile/User/recharge'); ?>" style="background: #31addc;color: #fff;padding: 0.2rem 0.5rem;border-radius: 0.4rem;">立即充值</a>
				</div>
			</div>
	</div>
<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>

<script src="__STATIC__/js/polygonizr.min.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
	var recognize_id = parseInt("<?php echo $recognize['id']; ?>");
	var limit_qty = parseInt("<?php echo $recognize['limit_qty']; ?>");
	console.log(limit_qty);
	$(function(){
		var times = <?php echo $remainTime; ?>;
		cuntDown();
		timeDown();		
		$('#site-landing').polygonizr();
		
		// 立即够买
		var $price=$('.chainBox .price');
		var $numinput=$('#numinput');
		var $money=$('.chainBox .money');
		$money.html($price.html()*$numinput.val());
		$numinput.keyup(function (e) {
			console.log(e.keyCode);
			if($(this).val()>limit_qty){
				$(this).val(limit_qty)
			}
			$money.html($price.html()*$(this).val());
			
		})
		$numinput.keydown(function (e) {
			console.log(e.keyCode)
			if(e.keyCode>=48&&e.keyCode<=57 || e.keyCode>=96 && e.keyCode<=105 || e.keyCode==8 ){
				
			}else{
				return false;
			}
			
		})
		// 介绍
		$('.introduce.jieshao').click(function(){
			$('.lay_jieshao').show();
		})
		$('.lay_jieshao .close').click(function(){
			$('.lay_jieshao').hide();
		})
		$('.lay_jieshao').click(function () {
			$(this).hide();
		})
		$('.lay_chong .close').click(function(){
			$('.lay_chong').hide();
		})
		$('.lay_chong .btn_go').click(function(){
			
		})
		
		//恭喜轮播
		 var adtimer;
	     var wrap = $(".success ul");
	     var len = $(".success ul li").length;
	     if (len > 1) {
	        $(".success").hover(function () {
	                clearInterval(adtimer);
	            },
	            function () {
	                adtimer = setInterval(function () {
	                    var first = wrap.find("li:first");
	                    var HEIGHT = first.height();
	                    first.animate({
	                        marginTop: -HEIGHT + 'px'
	                    }, 500, function () {
	                        first.css('marginTop', 0).appendTo(wrap);
	                    })
	                }, 3000)
	            }).trigger('mouseleave');
	    }
	    //倒计时
		function timeDown() {
			var timer = null;
			timer = setInterval(cuntDown, 1000);
			if (times < 0) {
				clearInterval(timer)
			}
		}

		function cuntDown() {
			var day = 0, hour = 0, minute = 0, second = 0;
			if (times > 0) {
				day = Math.floor(times / (60 * 60 * 24));
				hour = Math.floor(times / (60 * 60)) - (day * 24);
				minute = Math.floor(times / 60) - (day * 24 * 60) - (hour * 60);
				second = Math.floor(times) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
			}
			if (day <= 9) {
				day = '0' + day;
			}
			if (hour <= 9) {
				hour = '0' + hour;
			}
			if (minute <= 9) {
				minute = '0' + minute;
			}
			if (second <= 9) {
				second = '0' + second;
			}
			$('.time').text(day + ' 天 ' + hour + ' 时 ' + minute + ' 分 ' + second + ' 秒');
			times--;
		}
	    
	    
	    //加入新淘按钮
	    $('.joinIn').click(function(){
	    	$('.chain').fadeIn();
			$('.mask').fadeIn();
	    });
		// 名单
		$('.introduce.mingdan').click(function () {		
			$('.lay_mingdan').show();
		})
		$('.lay_mingdan .close').click(function(){
			$('.lay_mingdan').hide();
		})
		$('.lay_mingdan').click(function(){
			$(this).hide();
		})

		//够买
		function checkPwdCode(trade_id, successCallback) {
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
							successCallback(trade_id, value);
							$(document).off('click', '.btnPwd');
						}
					}
				});
			})
			$(document).one('click', '.btnCancel', function () {
				$(document).off('click', '.btnPwd');
				layer.close(layerIndex)
			})
		}
		
		
		$('#buy_lido').click(function () {
			var numinput = $('#numinput').val();
			$.ajax({
				url: '/Mobile/Recognize/buy',
				type: 'POST',
				data: {numinput: numinput, recognize_id:recognize_id},
				success: function (res) {
					console.log(res);
					switch (res.code) {
						case -1:
							$('.mask,.chain').hide();
							$('.lay_chong').show();
							break;
						case 0:
							alert(res.msg);
							break;
						case -2:
							layer.open({
								content:res.msg,
								time:2,
								end:function(){
									window.location.href="<?php echo U('Recognize/buyhistory'); ?>"
								}
							})
							break;
						default:
							$('.mask,.chain').hide();
							layer.open({
								content:res.msg,
								time:2,
								end:function(){
									checkPwdCode(res.data.id, function (trade_id, password) {
										$.ajax({
											url: '/Mobile/Recognize/pay',
											type: 'POST',
											data: {
												trade_id: trade_id,
												password:password
											},
											success: function (datas) {
												console.log(datas)
												if (datas.code == 0) {
													showErrorMsg(datas.msg);
												} else {
													showErrorMsg(datas.msg, true);
												}
											}
										});
									});
								}
							})
							break;
							
					}
					
				}
			});
			return false;
		});
		function showErrorMsg(msg, reload) {
			layer.open({
				content: msg,
				time: 3,
				end: function () {
					if (reload) {
						$('.sell-box>p').eq(1).hasClass('sell-red') ? setCookies('stype', 1) : setCookies('stype', 0);
						window.location.reload();
					}
				}
			});
		}
	})
</script>
</body>
</html>
