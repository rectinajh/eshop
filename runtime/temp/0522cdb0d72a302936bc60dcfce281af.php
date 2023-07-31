<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:37:"./template/pc/rainbow/cart/cart2.html";i:1531973018;s:45:"./template/pc/rainbow/public/cart_topbar.html";i:1531973018;s:40:"./template/pc/rainbow/public/footer.html";i:1531973018;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>购物车结算-<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>
		<link rel="stylesheet" type="text/css" href="__STATIC__/css/tpshop.css" />
		<link rel="stylesheet" type="text/css" href="__STATIC__/css/myaccount.css" />
		<script src="__STATIC__/js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="__PUBLIC__/js/layer/layer.js"></script>
		<script src="__PUBLIC__/js/global.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<!--顶部广告-s-->
		<?php $pid =1;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1532178000 and end_time > 1532178000 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
  \think\Cache::clear();
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
			<div class="topic-banner" style="background: #f37c1e;">
				<div class="w1224">
					<a href="<?php echo $v['ad_link']; ?>">
						<img src="<?php echo $v[ad_code]; ?>"/>
					</a>
					<i onclick="$('.topic-banner').hide();"></i>
				</div>
			</div>
		<?php endforeach; ?>
		<!--顶部广告-e-->
		<!--header-s-->
		<div class="sett_hander p">
			<div class="top-hander p">

    <div class="w1224 pr">

        <div class="fl">

            <div class="ls-dlzc fl nologin">

                <a href="<?php echo U('Home/user/login'); ?>">Hi,请登录</a>

                <a class="red" href="<?php echo U('Home/user/reg'); ?>">免费注册</a>

            </div>

            <div class="ls-dlzc fl islogin">

                <a class="red userinfo" href="<?php echo U('Home/user/index'); ?>"></a>

                <a href="<?php echo U('Home/user/logout'); ?>">退出</a>

            </div>

            <div class="fl spc" style="margin-top:10px"></div>

            <div class="sendaddress pr fl">

            </div>

        </div>

        <div class="top-ri-header fr">

            <ul>

                <li><a target="_blank" href="<?php echo U('Home/Order/order_list'); ?>">我的订单</a></li>

                <li class="spacer"></li>

                <li><a target="_blank" href="<?php echo U('Home/User/account'); ?>">我的积分</a></li>

                <li class="spacer"></li>

                <li><a target="_blank" href="<?php echo U('Home/User/coupon'); ?>">我的优惠券</a></li>

                <li class="spacer"></li>

                <li><a target="_blank" href="<?php echo U('Home/User/goods_collect'); ?>">我的收藏</a></li>

                <li class="spacer"></li>

                <li class="hover-ba-navdh">

                    <div class="nav-dh">

                        <span>客户服务</span>

                        <i class="jt-x"></i>

                        <div class="conta-hv-nav">

                            <ul>

                               <!--  <li><a href="<?php echo U('Seller/Index/index'); ?>">商家后台</a></li> -->

                                <li><a href="<?php echo U('Home/Newjoin/index'); ?>">商家帮助</a></li>

                            </ul>

                        </div>

                    </div>

                </li>

                <!-- <li class="spacer"></li> -->

                <li class="navoxth">

                    <!-- <div class="nav-dh">

                        <i class="fl ico"></i>

                        <span>手机TPshop网</span>

                        <i class="jt-x"></i>

                    </div> -->

                    <!-- <div class="sub-panel m-lst">

                        <p>扫一扫，下载TPshop客户端</p>

                        <dl>

                            <dt class="fl mr10"><a target="_blank" href=""><img height="80" width="80" src="/Template/pc/soubao/Static/images/qrcode_vmall_app01.png"></a></dt>

                            <dd class="fl mb10"><a target="_blank" href=""><i class="andr"></i> Andiord</a></dd>

                            <dd class="fl"><a target="_blank" href=""><i class="iph"></i> iPhone</a></dd>

                        </dl>

                    </div> -->

                </li>

                <!-- <li class="spacer"></li> -->

                <!-- <li class="wxbox-hover">

                    <a target="_blank" href="">关注我们：</a>

                    <img class="wechat-top" src="__STATIC__/images/wechat.png" alt="">

                    <div class="sub-panel wx-box">

                        <span class="arrow-b">◆</span>

                        <span class="arrow-a">◆</span>

                        <p class="n"> 扫描二维码 <br>  关注TPshop网官方微信 </p>

                        <img src="__STATIC__/images/qrcode_vmall_app01.png">

                    </div>

                </li> -->

            </ul>

        </div>

    </div>

</div>
			<div class="nav-middan-z p">
				<div class="header w1224">
					<div class="ecsc-logo fon_gwcshcar">
						<a href="/" class="logo"> <img src="<?php echo $tpshop_config[shop_info_store_logo]; ?>"></a>
						<span>购物车</span>
					</div>
					<div class="liucsell">
						<div class="line-flowpath">
			    			<span class="green"><i class="las-flo"></i><em>1、我的购物车</em></span>
			    			<span class="green now"><i class="las-flo2"></i><em>2、填写核对订单信息</em></span>
			    			<span><i class="las-flo3"></i><em>3、成功提交订单</em></span>
			    		</div>
					</div>
				</div>
			</div>
		</div>
		<!--header-e-->
		<form name="cart2_form" id="cart2_form" method="post">
			<input type="hidden" name="address_id" value="">
			<input type="hidden" name="pay_points" value="">
			<input type="hidden" name="user_money" value="">
			<input type="hidden" name="invoice_title" value="个人">
			<?php if(is_array($storeShippingCartList) || $storeShippingCartList instanceof \think\Collection || $storeShippingCartList instanceof \think\Paginator): $i = 0; $__LIST__ = $storeShippingCartList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$store): $mod = ($i % 2 );++$i;?>
				<input type="hidden" name="shipping_code[<?php echo $store['store_id']; ?>]" value="">
				<input type="hidden" name="user_note[<?php echo $store['store_id']; ?>]" value="">
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</form>
		<div class="fillorder">
			<div class="w1224">
				<p class="tit">填写并核对订单信息</p>
				<div class="spriteform" id="ajax_address"></div>
			</div>
		</div>

		<div class="sendgoodslist">
			<div class="w1224">
				<div class="top_leg p ma-to-20">
					<span class="paragraph fl"><i class="ddd"></i>送货清单</span>
					<a class="newadd fr" href="<?php echo U('Home/Cart/index'); ?>">返回修改购物车</a>
					<a class="newadd fr hover-y">
						<i class="las-warning"></i>价格说明
						<div class="pairgoods">
							<p class="tit">因可能存在系统缓存、页面更新导致价格变动异常等不确定性情况出现，商品售价以本结算页商品价格为准；如有疑问，请您立即联系销售商咨询</p>
						</div>
					</a>
				</div>
				<?php if(is_array($storeShippingCartList) || $storeShippingCartList instanceof \think\Collection || $storeShippingCartList instanceof \think\Paginator): $i = 0; $__LIST__ = $storeShippingCartList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$store): $mod = ($i % 2 );++$i;?>
					<div class="shopping-listpay ma-to-20">
					<div class="dis-modes-li">
						<div class="modti p">
							<h2>配送方式</h2>
							<span class="newadd hover-y">
								<i class="las-warning"></i>对应商品
								<div class="pairgoods">
									<ul>
										<?php if(is_array($store[cartList]) || $store[cartList] instanceof \think\Collection || $store[cartList] instanceof \think\Paginator): $i = 0; $__LIST__ = $store[cartList];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cart): $mod = ($i % 2 );++$i;?>
											<li>
												<img style="width: 65px;height: 65px;" src="<?php echo goods_thum_images($cart['goods_id'],65,65); ?>"/>
												<p class="shop_name"><a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$cart['goods_id'])); ?>" target="_blank"><?php echo $cart['goods_name']; ?></a></p>
											</li>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div>
							</span>
						</div>
						<div class="item_select_t curtr ma-to-10">
							<div class="check-freight">
								<select class="shippingSelect" data-store-id="<?php echo $store['store_id']; ?>">
									<?php if(is_array($store[shippingAreaList]) || $store[shippingAreaList] instanceof \think\Collection || $store[shippingAreaList] instanceof \think\Paginator): $i = 0; $__LIST__ = $store[shippingAreaList];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shipping): $mod = ($i % 2 );++$i;?>
										<option value="<?php echo $shipping['shipping_code']; ?>"><?php echo $shipping['plugin']['name']; ?></option>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
							</div>
							<div class="free-freight" id="store_shipping_price_<?php echo $store['store_id']; ?>"></div>
							<b></b>
						</div>
						<div class="shipment ma-to-10">
							<div class="fore1 p">
								<span class="mode-label">配送时间：</span>
								<div class="mode-infor hover-y">
									<p><label>工作日、双休日与节假日均可送货</label></p>
									<!--<p><label><input type="checkbox" name="" value="" /> 双休日、假日送</label></p>-->
								</div>
							</div>
						</div>
						<div class="standard_wei buy-remarks">
							<span>备注 :</span> <textarea class="user_note_txt" data-store-id="<?php echo $store['store_id']; ?>" placeholder="最多输入30个字"></textarea>
						</div>
					</div>
					<div class="goods-list-ri">
						<div class="goodsforma">
							<div class="modti p">
								<h2>卖家：<?php echo $store['store_name']; ?></h2>
							</div>
							<div class="goods-last-suit ma-to-10 p">
								<div class="goods-suit-tit" style="display: none">
									<span class="sales-icon">订单优惠</span>
									<strong id="store_order_prom_title_<?php echo $store['store_id']; ?>"></strong>
									<!--<span class="mlstran">&nbsp;返现：<em>￥20.00</em></span>-->
								</div>
							</div>
							<ul class="buy-shopping-list">
								<?php if(is_array($store[cartList]) || $store[cartList] instanceof \think\Collection || $store[cartList] instanceof \think\Paginator): $i = 0; $__LIST__ = $store[cartList];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cart): $mod = ($i % 2 );++$i;?>
								<li>
									<div class="goods-extra clearfix">
										<div class="p-img">
											<a target="_blank" href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$cart['goods_id'])); ?>">
												<img src="<?php echo goods_thum_images($cart['goods_id'],102,102); ?>" alt="">
											</a>
										</div>
										<div class="goods-msg clearfix">
											<div class="goods-msg-gel">
												<div class="p-name">
													<a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$cart['goods_id'])); ?>" target="_blank"><?php echo $cart['goods_name']; ?></a>
												</div>
												<div class="p-price">
													<strong class="tp-price">￥ <?php echo $cart['member_goods_price']; ?></strong>
													<span class="p-num f-l-noe">x<?php echo $cart['goods_num']; ?></span>
													<span class="p-state">有货</span>
													<span class="tp-weight tp-price"><?php echo $cart[goods][weight]; ?>g</span>
												</div>
											</div>
										</div>
										<div class="msp_return">
											<p class="guarantee-item">
												<?php if($store['qitian']): ?>
													<i class="return7"></i><span class="f_blue">支持七天无理由退货</span>
													<?php else: ?>
													<i class="return7 return7-dark"></i><span class="f_dark">不支持七天无理由退货</span>
												<?php endif; ?>
											</p>
											<!--<p class="btn-check-date"><i class="yb-h-gwc return7"></i><span class="f_blue f-999">选延保</span></p>-->
										</div>
									</div>
								</li>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
					<div class="total-weight"><span>总重量 : </span><?php echo $store['store_goods_weight']; ?>g</div>
				</div>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<div class="addremark">
			<div class="w1224">
				<div class="top_leg p ma-to-20">
					<span class="paragraph fl"><i class="ddd"></i>发票信息</span>
				</div>
				<div class="invoice-cont ma-to-20">
					<span>普通发票（纸质）</span>
					<span id="invoice_title">个人</span>
					<span>明细</span>
					<a onclick="invoice_dialog();" href="javascript:void(0);">修改</a>
				</div>
			</div>
		</div>
		
		<div class="usecou-step-tit" id="usecou-step-tit">
			<div class="w1224">
				<div class="top_leg p ma-to-20">
					<span class="paragraph usewhilejs fl"><i class="ddd"></i>使用优惠券/抵用</span>
					<p class="coupon-des">(可用优惠券<i class="coupon-num">0</i>张)</p>
				</div>
				<div class="coupon-detail">
					<div class="detail-title clearfix">
						<ul class="available-title">
							<li class="active"><a href="javascript:;">可用优惠券 ( <i class="available-num">0</i> )</a></li>
							<li><a href="javascript:;">不可用优惠券 ( <i class="unavailable-num">2</i> )</a></li>
						</ul>
						<!--<a class="for-details" href="javascript:;">了解优惠券使用规则</a>-->
					</div>
					<div class="detail-cont">
						<ul class="available">
							<li>
								<div class="coupon-list coupon-able-list p">
									<?php if(is_array($userCartCouponList) || $userCartCouponList instanceof \think\Collection || $userCartCouponList instanceof \think\Paginator): $i = 0; $__LIST__ = $userCartCouponList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$userCoupon): $mod = ($i % 2 );++$i;if($userCoupon[coupon][able] == 1): ?>
											<div class="coupon-item" data-date="<?php echo $userCoupon[coupon][is_expiring]; ?>" data-coupon-id="<?php echo $userCoupon[id]; ?>" data-shopid="<?php echo $userCoupon[coupon][store_id]; ?>">
												<p class="direct"><?php echo $userCoupon[coupon][name]; ?></p>
												<p class="total"><sub>￥</sub><?php echo $userCoupon[coupon][money]; ?></p>
												<p class="des">满<sub>￥</sub><?php echo $userCoupon[coupon][condition]; ?>使用</p>
												<p class="shop-name des"><?php echo $userCoupon[coupon][store][store_name]; ?></p>
												<p class="time-over">有效期:<?php echo date('Y.m.d',$userCoupon[coupon][use_start_time]); ?>-<?php echo date('Y.m.d',$userCoupon[coupon][use_end_time]); ?></p>
												<i class="checked-ico"></i>
											</div>
										<?php endif; endforeach; endif; else: echo "" ;endif; ?>
								</div>
								<p class="coupon-list-des"><i class="ico-warn"></i>部分优惠券不可叠加使用</p>
							</li>
							<li>
								<div class="coupon-list p">
									<?php if(is_array($userCartCouponList) || $userCartCouponList instanceof \think\Collection || $userCartCouponList instanceof \think\Paginator): $i = 0; $__LIST__ = $userCartCouponList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$userCoupon): $mod = ($i % 2 );++$i;if($userCoupon[coupon][able] == 0): ?>
											<div class="coupon-item <?php if($userCoupon[coupon][is_expire] == 1): ?>coupon-invalid<?php else: ?>coupon-useless<?php endif; ?>" data-date="0" data-coupon-id="<?php echo $userCoupon[id]; ?>" data-shopid="1">
												<p class="direct"><?php echo $userCoupon[coupon][name]; ?></p>
												<p class="total"><sub>￥</sub><?php echo $userCoupon[coupon][money]; ?></p>
												<p class="des">满<sub>￥</sub><?php echo $userCoupon[coupon][condition]; ?>使用</p>
												<p class="shop-name des"><?php echo $userCoupon[coupon][store][store_name]; ?></p>
												<p class="time-over">有效期:<?php echo date('Y.m.d',$userCoupon[coupon][use_start_time]); ?>-<?php echo date('Y.m.d',$userCoupon[coupon][use_end_time]); ?></p>
												<i class="checked-ico"></i>
											</div>
										<?php endif; endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</li>
						</ul>
					</div>
					<div class="score-list">
						<!--签约调理区不需要显示  -->
					  <?php if($xianzhi[goods_xianzhi] > 0 && $sum > 0 && $is_usercenter[is_usercenter] == 1): ?>	
						<p class="item">
							<label>
								<!-- <input id="pay_points_checkbox" type="checkbox" <?php if($pay_points > $user['pay_points']): ?>disabled="disabled"<?php endif; ?>> -->
								使用积分余额 :
									   <span><?php echo $pay_points; ?></span>分
								（您当前积分<span><?php echo $user['pay_points']; ?></span>点）
							</label>
							<!--<a href="javascript:;">了解什么是积分？</a>-->
						</p>
						
					  <?php endif; ?>	
					  <p class="item">
							<label>
								<input id="user_money_checkbox" type="checkbox" <?php if($user['user_money'] == 0): ?>disabled="disabled"<?php endif; ?>>
								使用账户余额 :
								<input id="user_money" type="text" onpaste="this.value=this.value.replace(/[^\d\.]/g,'')"
									   onkeyup="this.value=/^\d+\.?\d{0,2}$/.test(this.value) ? this.value : ''">
								元（您当前余额<span><?php echo $user['user_money']; ?></span>元）
							</label>
						</p>
						<p class="item">
							<label>
								<input type="checkbox" id="coupon_code_checkbox">
								使用优惠券券码 :
								<input type="text" id="coupon_code">
								<button class="exchange" id="coupon_exchange">
									兑换
								</button>
							</label>
						</p>
					</div>
				</div>
			</div>
			<script>
				/*
				 * 优惠券列表切换
				 *1、优惠券数量: 根据列表里面的列表项的数量自动填充
				 *2、优惠券选中：优惠券默认可以多选，当时同一种商品优惠券只选一种，默认根据其id判断，页面
				 * 暂时用<div class="coupon-item coupon-invalid" data-date="0" data-shopid="1"> 中的
				 * data-shopid="1"来表示id的值
				 * 3、快过期优惠券和正常优惠券样式区别很大，还自带选中效果，如果是同一个一列表循环出来的
				 * 数据需要带一快过期的标志过来页面暂时用<div class="coupon-item coupon-invalid"
				 * data-date="0" data-shopid="1"> 中的 data-date="0" 来表示，值是1代表是快过期的				 *
				 * */
				function couponChange(){  //优惠券列表切换
					//优惠券数量
					var $_couponWrap=$('#usecou-step-tit');
					var couponNum1=$_couponWrap.find('.available li').eq(0).find('.coupon-item').length;  //获取能使用的优惠券数量
					var couponNum2=$_couponWrap.find('.available li').eq(1).find('.coupon-item').length;  //获取不能使用的优惠券数量
					$_couponWrap.find('.coupon-num').text(couponNum1);
					$_couponWrap.find('.available-num').text(couponNum1);
					$_couponWrap.find('.unavailable-num').text(couponNum2);
					$_couponWrap.find('.available li').eq(0).find('.coupon-item[data-date="1"]').addClass('coupon-invaliding');
					$_couponWrap.find('.available li').eq(0).unbind('click').on("click", '.coupon-item', function(){
						//点击可用优惠券事件
						$(this).toggleClass('checked');
						if($(this).hasClass('checked')){
							var id=$(this).attr('data-shopid');
							$(this).siblings().each(function () {  //同一个商品只能选一个优惠券
								if($(this).attr('data-shopid')==id){
									$(this).removeClass('checked')
								}
							})
						}
						$('#cart2_form').find("input[name^='coupon_id']").remove();
						var couponList = $(this).parents('.coupon-list').find('.coupon-item');
						couponList.each(function () {
							if($(this).hasClass('checked')){
								var store_id = $(this).attr('data-shopid');
								var store_coupon = $("input[name='coupon_id["+store_id+"]']");
								if(store_coupon > 0){
									store_coupon.attr('value',$(this).attr('data-coupon-id'));
								}else{
									var input = document.createElement('input');  //创建input节点
									input.setAttribute('type', 'hidden');  //定义类型是文本输入
									input.setAttribute('value', $(this).attr('data-coupon-id'));
									input.setAttribute('name', "coupon_id["+store_id+"]");
									document.getElementById('cart2_form').appendChild(input); //添加到form中显示
								}
							}
						})
						ajax_order_price();
					});
					//切换优惠券列表
					$_couponWrap.find('.available li').eq(0).show();
					$_couponWrap.find('.available-title li').click(function () {
						$(this).addClass('active').siblings().removeClass('active');
						$_couponWrap.find('.available li').eq($(this).index()).show().siblings().hide();
					})
					//数字输入框智能判断
					$_couponWrap.find('.score-list').find('.txt').blur(function () {
						var val=$(this).val();
						if(isNaN(val)){
							$(this).val('0');
						}else{
							if(val<0){
								$(this).val('0');
							}else{
								val=Math.round(val*100)/100;
								$(this).val(val);
							}
						}
					});
				}
				couponChange();
			</script>
		</div>
		<div class="order-summary p">
			<div class="w1224">
				<div class="statistic fr">
					<div class="list">
						<span><em class="ftx-01"><?php echo $cartGoodsTotalNum; ?></em> 件商品，总商品金额：</span>
						<em class="price">￥<?php echo $storeCartTotalPrice; ?></em>
					</div>
					<div class="list">
						<span>优惠券：</span>
						<em class="price" id="couponFee"> -￥0.00</em>
					</div>
					<div class="list">
						<span>优惠：</span>
						<em class="price" id="order_prom_amount"> -￥0.00</em>
					</div>
					<div class="list">
						<span>运费：</span>
						<em class="price" id="postFee">￥0.00</em>
					</div>
					<div class="list">
						<span>余额支付：</span>
						<em class="price" id="balance">-￥0.00</em>
					</div>
					<div class="list">
						<span>积分支付：</span>
						<em class="price" id="pointsFee">-￥0.00</em>
					</div>
				</div>
			</div>
		</div>
		<div class="trade-foot p">
			<div class="w1224">
				<div class="trade-foot-detail-com">
					<div class="fc-price-info">
						<span class="price-tit">应付总额：</span>
						<span class="price-num" id="payables">￥0.00</span>
					</div>
					<div class="fc-consignee-info">
						<span class="mr20">寄送至： <span id="address_info"></span></span>
						<span id="sendMobile">收货人：<span id="address_user"></span></span>
					</div>
				</div>
			</div>
		</div>
		<div class="submitorder_carpay p">
			<div class="w1224">
				<button type="submit" class="checkout-submit" onclick="submit_order();">
					提交订单
				</button>
			</div>
		</div>
		<!--发票信息弹窗-s--->
		<div class="ui-dialog infom-dia">
			<div class="ui-dialog-title">
				<span>发票信息</span>
				<a class="ui-dialog-close" title="关闭">
					<span class="ui-icon ui-icon-delete"></span>
				</a>
			</div>
			<div class="ui-dialog-content" style="height: 300px">
				<div class="invoice-dialog">
					<!--<div class="tab-nav p">
						<ul>
							<li>
								<div class="item_select_t curtr">
									<span>普通发票</span>
									<b></b>
								</div>
							</li>
							<li>
								<div class="item_select_t">
									<span>电子发票</span>
									<b></b>
								</div>
							</li>
							<li>
								<div class="item_select_t">
									<span>增值税发票</span>
									<b></b>
								</div>
							</li>
						</ul>
					</div>-->
					<div class="zinvoice-tips">
						<i></i>
						<span class="tip-cont">开票金额不包优惠券和积分支付部分。<!--<a target="_blank" class="newadd" href="">发票信息相关问题&gt;&gt;</a>--></span>
					</div>
					<div class="ui-switchable-panel">
						<div class="invoice_title p">
							<span class="label">发票抬头：</span>
							<div class="fl">
								<input class="invoice_tt" type="text" value="个人" />
							</div>
						</div>
						<div class="invoice_title p">
							<span class="label">发票内容：</span>
							<div class="fl">
								<div class="item_select_t curtr">
									<span>明细</span>
									<b></b>
								</div>
							</div>
						</div>
						<div class="invoice_title p">
							<span class="label">&nbsp;</span>
							<div class="fl">
								<div class="op-btns  invoice_sendwithgift">
									<a id="invoiceBtn" class="btn-1">保存</a>
									<a onclick="$('.ui-dialog-close').trigger('click');" class="btn-9">取消</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--发票信息弹窗-e--->
		<div class="ui-mask"></div>
		<!--footer-s-->
		<style>
			.rabbit{position: fixed;left: 50%;right: 50%;top: 50%;bottom:50%;margin-top: -180px;margin-left: -300px;z-index: 9999;display: none;}
			.mask-filter-div {display: none; position: fixed; margin: 0 auto; width: 100%; left: 0; right: 0; top: 0; bottom: 0; z-index: 12; background: rgba(0,0,0,0.4); }
		</style>
		<img class="rabbit" src="/public/images/qw.gif" alt="">
		<div class="mask-filter-div"></div>
		<div class="footer p">

    <div class="mod_service_inner">

        <div class="w1224">

            <ul>

                <li>

                    <div class="mod_service_unit">

                        <h5 class="mod_service_duo">多</h5>

                        <p>品类齐全，轻松购物</p>

                    </div>

                </li>

                <li>

                    <div class="mod_service_unit">

                        <h5 class="mod_service_kuai">快</h5>

                        <p>多仓直发，极速配送</p>

                    </div>

                </li>

                <li>

                    <div class="mod_service_unit">

                        <h5 class="mod_service_hao">好</h5>

                        <p>正品行货，精致服务</p>

                    </div>

                </li>

                <li>

                    <div class="mod_service_unit">

                        <h5 class="mod_service_sheng">省</h5>

                        <p>天天低价，畅选无忧</p>

                    </div>

                </li>

            </ul>

        </div>

    </div>

    <div class="w1224">

        <div class="footer-ewmcode">

		    <div class="foot-list-fl">

		        <?php
                                   
                                $md5_key = md5("select * from `__PREFIX__article_cat` where parent_id = 2");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from `__PREFIX__article_cat` where parent_id = 2"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>

		            <ul>

		                <li class="foot-th">

		                    <?php echo $v[cat_name]; ?>

		                </li>

		                <?php
                                   
                                $md5_key = md5("select * from `__PREFIX__article` where cat_id = $v[cat_id]  and is_open=1");
                                $result_name = $sql_result_v2 = S("sql_".$md5_key);
                                if(empty($sql_result_v2))
                                {                            
                                    $result_name = $sql_result_v2 = \think\Db::query("select * from `__PREFIX__article` where cat_id = $v[cat_id]  and is_open=1"); 
                                    S("sql_".$md5_key,$sql_result_v2,31104000);
                                }    
                              foreach($sql_result_v2 as $k2=>$v2): ?>

		                    <li>

		                        <a href="<?php echo U('Home/Article/detail',array('article_id'=>$v2[article_id])); ?>"><?php echo $v2[title]; ?></a>

		                    </li>

		                <?php endforeach; ?>

		            </ul>

		        <?php endforeach; ?>

		    </div>

		    <!-- <div class="QRcode-fr">

		        <ul>

		            <li class="foot-th">客户端</li>

		            <li><img src="__STATIC__/images/qrcode.png"/></li>

		        </ul>

		        <ul>

		            <li class="foot-th">微信</li>

		            <li><img src="__STATIC__/images/qrcode.png"/></li>

		        </ul>

		    </div> -->

		</div>

		<div class="mod_copyright p">

		    <div class="grid-top">

		        <?php
                                   
                                $md5_key = md5("select * from `__PREFIX__article` where cat_id = 5 and is_open=1");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from `__PREFIX__article` where cat_id = 5 and is_open=1"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>

		            <a href="<?php echo U('Home/Article/detail',array('article_id'=>$v[article_id])); ?>"><?php echo $v[title]; ?></a>

		            <span>|</span>

		        <?php endforeach; ?>

		        <a href="javascript:void (0);">客服热线:<?php echo $tpshop_config['shop_info_phone']; ?></a>

		    </div>

		    <p>Copyright © 2016-2025 新淘链商城 版权所有 保留一切权利 备案号:<?php echo $tpshop_config['shop_info_record_no']; ?></p>

		

		    <p class="mod_copyright_auth">

		        <a class="mod_copyright_auth_ico mod_copyright_auth_ico_1" href="" target="_blank">经营性网站备案中心</a>

		        <a class="mod_copyright_auth_ico mod_copyright_auth_ico_2" href="" target="_blank">可信网站信用评估</a>

		        <a class="mod_copyright_auth_ico mod_copyright_auth_ico_3" href="" target="_blank">网络警察提醒你</a>

		        <a class="mod_copyright_auth_ico mod_copyright_auth_ico_4" href="" target="_blank">诚信网站</a>

		        <a class="mod_copyright_auth_ico mod_copyright_auth_ico_5" href="" target="_blank">中国互联网举报中心</a>

		        <a class="mod_copyright_auth_ico mod_copyright_auth_ico_6" href="" target="_blank">APP下载</a>

		    </p>

		</div>

    </div>

</div>
		<!--footer-e-->
		<script type="text/javascript">
			$(document).ready(function(){
				user_login_or_no();
				initShipping();
				ajax_address();
			});
			;(function($){
				$.fn.extend({
					donetyping: function(callback,timeout){
						timeout = timeout || 1e3;
						var timeoutReference,
								doneTyping = function(el){
									if (!timeoutReference) return;
									timeoutReference = null;
									callback.call(el);
								};
						return this.each(function(i,el){
							var $el = $(el);
							$el.is(':input') && $el.on('keyup keypress',function(e){
								if (e.type=='keyup' && e.keyCode!=8) return;
								if (timeoutReference) clearTimeout(timeoutReference);
								timeoutReference = setTimeout(function(){
									doneTyping(el);
								}, timeout);
							}).on('blur',function(){
								doneTyping(el);
							});
						});
					}
				});
			})(jQuery);
			//积分选项框点击事件
			$(function(){
				$(document).on("click", '#pay_points_checkbox', function (e) {
					if($(this).is(':checked')){
						var input = $(this).parent().find("input[type='text']");
						
						$("input[name='pay_points']").attr('value', input.val());
						if(input.val()!=''){
							ajax_order_price();
						}
					}else{
						var input = $(this).parent().find("input[type='text']");
						
						$("input[name='pay_points']").attr('value', 0);
						
						ajax_order_price();
						
						//$(this).parent().find("input[type='text']").attr('disabled','disabled');
					}
				})
				$(document).on("click", '#user_money_checkbox', function (e) {
					if($(this).is(':checked')){
						var input = $(this).parent().find("input[type='text']");
						input.removeAttr('disabled');
						$("input[name='user_money']").attr('value',input.val());
						if(input.val()!=''){
							ajax_order_price();
						}
					}else{
						$(this).parent().find("input[type='text']").attr('disabled','disabled');
					}
				})
				//优惠券选项框选中事件
				$(document).on("click", '#coupon_code_checkbox', function (e) {
					if($(this).is(':checked')){
						$(this).parent().find("input[type='text']").removeAttr('disabled');
					}else{
						$(this).parent().find("input[type='text']").attr('disabled','disabled');
					}
				})
			})
			//积分输入框keyUp事件
			$(function(){
				$('#pay_points').donetyping(function(){
					if($(this).parent().find("input[type='checkbox']").is(':checked')){
						$("input[name='pay_points']").attr('value', $(this).val());
						ajax_order_price();
					}
				},500);
				$('#user_money').donetyping(function(){
					if($(this).parent().find("input[type='checkbox']").is(':checked')){
						$("input[name='user_money']").attr('value', $(this).val());
						ajax_order_price();
					}
				},500);
				$(document).on("click", '#coupon_exchange', function (e) {
					if ($('#coupon_code_checkbox').is(':checked')) {
						var coupon_code = $('#coupon_code').val();
						if (coupon_code != '') {
							$.ajax({
								type: "POST",
								url: "<?php echo U('Home/Cart/cartCouponExchange'); ?>",
								dataType: 'json',
								data: {coupon_code: coupon_code},
								success: function (data) {
									if (data.status == 1) {
										var coupon = data.result.coupon;
										var coupon_list = data.result.coupon_list;
										var coupon_html = '<div class="coupon-item" data-date="'+coupon.is_expiring+'" data-coupon-id="'+coupon_list.id+'" data-shopid="'+coupon.store_id+'">' +
												' <p class="direct">'+coupon.name+'</p> <p class="total"><sub>￥</sub>'+coupon.money+'</p> <p class="des">满<sub>￥</sub>'+coupon.condition+'使用</p> ' +
												'<p class="shop-name des"></p> <p class="time-over">有效期:'+coupon.use_start_time_format_dot+'-'+coupon.use_end_time_format_dot+'</p> <i class="checked-ico"></i> </div>';
										$('.coupon-able-list').append(coupon_html);
										couponChange();
									} else {
										layer.msg(data.msg, {icon: 2});
									}
								}
							});
						}
					}
				})
			})
			//点击收货地址
			$(function(){
				$(document).on("click", '.addressItem .item_select_t', function (e) {
					//如果本来没被选中
					if(!$(this).hasClass('curtr')){
						$('.addressItem').find('.item_select_t').each(function () {
							$(this).removeClass('curtr');
						})
						$(this).addClass('curtr');
						initAddress();
						ajax_order_price();
					}
				})
			})
			//收货人信息
			$(function(){
				$(document).on("click", '.addr-switch', function (e) {
					if($(this).hasClass('switch-on')){
						$(this).removeClass('switch-on');
						$(this).find('span').text('更多地址');
						$('.consignee-list').css('height','42px');
						var addressItem = $('.consignee-list').find('.curtr').parents('.addressItem');
						$('.consignee-list').find('ul').prepend(addressItem.clone(true));
						addressItem.remove();
					}else{
						$(this).addClass('switch-on');
						$(this).find('span').text('收起地址');
						$('.consignee-list').css('height','inherit');
					}
				})
			})
			//支付方式更多
			$(function(){
				$('.lastist').click(function(){
					if($(this).hasClass('addlastist')){
						$(this).removeClass('addlastist');
						$(this).find('span').text('更多');
						$(this).parents('.payment-list').find('.solwpah').removeClass('moreshow');
					}else{
						$(this).addClass('addlastist');
						$(this).find('span').text('收起');
						$(this).parents('.payment-list').find('.solwpah').addClass('moreshow');
					}
				})
			})
			//对应商品
			$(function(){
				$(document).on('click','.hover-y',function(){
					if($(this).find('.pairgoods').is(":hidden")){
						$(this).find('.pairgoods').show();
					}else{
						$(this).find('.pairgoods').hide();
					}

				});
			})
			$(function(){
				$(document).on('click','#invoiceBtn',function(){
					var input_invoice = $(this).parents('.ui-dialog-content').find('.invoice_tt');
					$('#invoice_title').html(input_invoice.val());
					$('#cart2_form').find("input[name^='invoice_title']").attr('value',input_invoice.val());
					$('.ui-dialog-close').trigger('click');
				});
			})
			//使用优惠券导航切换
			$(function(){
				$('.usewhilejs').click(function(){
					$('.step-cont-virtual').toggle();
					$(this).toggleClass('edg180');
					if($(this).hasClass('edg180')){
						$('.hehr').hide();
					}else{
						$('.hehr').show();
					}
				})
				$('.order-virtual-tabs li').click(function(){
					$(this).addClass('curr').siblings().removeClass('curr');
					var le = $('.order-virtual-tabs li').index(this);
					$('.contac-virtuar').eq(le).show().siblings('.contac-virtuar').hide();
				})
			})
			//配送方式切换
			$(function(){
				$(document).on('change','.shippingSelect',function(){
					initShipping();
					ajax_order_price();
				});
			})

			/**
			 * ajax 获取当前用户的收货地址列表
			 */
			function ajax_address() {
				$.ajax({
					url: "<?php echo U('Home/Cart/ajaxAddress'); ?>",//+tab,
					success: function (data) {
						$("#ajax_address").empty().append(data);
						if (data != '') {
							initAddress();
							ajax_order_price(); // 计算订单价钱
						}
					}
				});
			}
			//设置收货地址
			function initAddress(){
				var address_item = $('.addressItem').find('.curtr').parents('.addressItem');
				var address_id = address_item.attr('data-address-id');
				var address_name = address_item.find('.addr-name').attr('title');
				var address_tel = address_item.find('.addr-tel').attr('title');

				$('#address_info').html(address_item.find('.addr-info').attr('title'));
				$('#address_user').html(address_name + ' '+address_tel);
				$("input[name='address_id']").attr('value',address_id);
			}
			//设置配送方式
			function initShipping(){
				$('.check-freight').each(function () {
					var store_id = $(this).find('select').attr('data-store-id');
					var shopping_code = $(this).find('select').find("option:selected").val();
					$("input[name='shipping_code["+store_id+"]']").attr('value',shopping_code);
				})
			}

			//用户登录或为登录状态显示
			function user_login_or_no()
			{
				var uname = getCookie('uname');
				var head_pic = getCookie('head_pic');
				if (uname == '') {
					$('.islogin').remove();
					$('.nologin').show();
				} else {
					$('.nologin').remove();
					$('.islogin').show();
					$('.userinfo').html(decodeURIComponent(uname));
					if(head_pic != ''){
						$('.head_pic').attr('src',decodeURIComponent(head_pic));
					}
				}
			}
			/**
			 * 获取订单价格
 			 */
			function ajax_order_price() {
				$.ajax({
					type : "POST",
					url:"<?php echo U('Home/Cart/cart3'); ?>",
					dataType:'json',
					data: $('#cart2_form').serialize(),
					success: function(data){
						if (data.status != 1) {
							layer.msg(data.msg, {
								icon: 2,   // 成功图标
								time: 1000 //2秒关闭（如果不配置，默认是3秒）
							});
							// 登录超时
							if (data.status == -100){
								location.href = "<?php echo U('Home/User/login'); ?>";
							}
							return false;
						}
						// console.log(data);
						$("#postFee").text('￥'+data.result.postFee); // 物流费
						if(data.result.couponFee == null){
							$("#couponFee").text('-￥0');// 优惠券
						}else{
							$("#couponFee").text('-￥'+data.result.couponFee);// 优惠券
						}
						$("#balance").text('-￥'+data.result.balance);// 余额
						$("#pointsFee").text('-￥'+data.result.pointsFee);// 积分支付
						$("#payables").text('￥'+data.result.payables);// 应付
						$("#order_prom_amount").text('-￥'+data.result.order_prom_amount);// 订单 优惠活动
						// 显示每个店铺的物流费
						for (v in data.result.store_shipping_price){
							if(data.result.store_shipping_price[v] == 0){
								$('#store_shipping_price_' + v).text('包邮');
							}else{
								$('#store_shipping_price_' + v).text('运费:￥'+data.result.store_shipping_price[v]+'元');
							}
						}
						// 显示每个店铺订单优惠了多少钱
						for (v in data.result.store_order_prom_title){
							if(data.result.store_order_prom_title[v] != '' && data.result.store_order_prom_title[v] != null){
								$('#store_order_prom_title_' + v).text(data.result.store_order_prom_title[v]);
								$('#store_order_prom_title_' + v).parent().show();
							}
						}

					}
				});
			}

			// 提交订单
			var ajax_return_status = 1; // 标识ajax 请求是否已经回来 可以进行下一次请求
			function submit_order() {
				$('.user_note_txt').each(function () {
					var store_id =  $(this).attr('data-store-id');
					$("input[name='user_note["+store_id+"]']").attr('value',$(this).val());
				})
				if (ajax_return_status == 0) {
					return false;
				}
				ajax_return_status = 0;
				$.ajax({
					type: "POST",
					url: "<?php echo U('Home/Cart/cart3'); ?>",//+tab,
					data: $('#cart2_form').serialize() + "&act=submit_order",//
					dataType: "json",
					success: function (data) {

						// 上一次ajax 已经返回, 可以进行下一次 ajax请
						ajax_return_status = 1;

						// 当前人数过多 排队中
						if (data.status == -99) {
							$('.mask-filter-div').show();
							$('.rabbit').show();
							setTimeout("submit_order()", 5000);
							return false;
						} else {
							// 隐藏排队
							$('.mask-filter-div').hide();
							$('.rabbit').hide();
						}

						if (data.status != 1) {
							layer.msg(data.msg, {
								icon: 2,
								time: 1000 //2秒关闭（如果不配置，默认是3秒）
							});
							// 登录超时
							if (data.status == -100){
								location.href = "<?php echo U('Home/User/login'); ?>";
							}
							return false;
						}
						layer.msg('订单提交成功!', {
							icon: 1,   // 成功图标
							time: 2000 //2秒关闭（如果不配置，默认是3秒）
						}, function () { // 关闭后执行的函数
							location.href = "/index.php?m=Home&c=Cart&a=cart4&master_order_sn=" + data.result+"&order_id="+data.order_id; // 跳转到结算页
						});
					}
				});
			}
			//发票弹窗
			function invoice_dialog(){
				var dh = $(document).height();
				var dw = $(document).width();
				$('.ui-mask').height(dh).width(dw);
				$('.ui-dialog').show();
				$('.ui-mask').show();
			}
			//关闭弹窗
			$(function(){
				$('.ui-dialog-close').click(function(){
					$('.ui-dialog').hide();
					$('.ui-mask').hide()
				})
			})
		</script>
	</body>
</html>