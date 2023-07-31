<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:42:"./template/mobile/default/store/about.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title><?php echo $store['store_name']; ?>--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

            <a href="javascript:history.back(-1)"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

        </div>

        <div class="ds-in-bl search center">

            <span>店铺详情</span>

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

		<div class="top-detailstore">

			<div class="maleri30">

				<div class="de_img_le">

                    <img src="<?php echo (isset($store['store_logo']) && ($store['store_logo'] !== '')?$store['store_logo']:'__STATIC__/images/v-shop/logo.png'); ?>" alt="<?php echo $store['store_name']; ?>"/>

                </div>

				<div class="de_font-midd">

					<h3><?php echo $store['store_name']; ?></h3>

					<!--<p>已有<span>1088</span>人关注</p>-->

				</div>

				<div class="de-butt-ygz">

					<!--<div class="payclos">-->

						<!--<i class="red"></i>-->

						<!--<span>已关注</span>-->

					<!--</div>-->

				</div>

			</div>

		</div>

		<div class="leve-trhee">

			<div class="maleri30">

				<ul>

					<li class="te-left">

						<span>商品</span>

                        <?php if($store['store_desccredit'] <= 2): ?><span class="red"><?php endif; if($store['store_desccredit'] > 2 and $store['store_desccredit'] < 4): ?><span class="pink"><?php endif; if($store['store_desccredit'] >= 4): ?><span class="green"><?php endif; ?><?php echo $store['store_desccredit']; ?>分</span>

						<!--<span class="gr">高</span>-->

					</li>

					<li class="te-midden">

						<span>服务</span>

                        <?php if($store['store_servicecredit'] <= 2): ?><span class="red"><?php endif; if($store['store_servicecredit'] > 2 and $store['store_servicecredit'] < 4): ?><span class="pink"><?php endif; if($store['store_servicecredit'] >= 4): ?><span class="green"><?php endif; ?><?php echo $store['store_servicecredit']; ?>分</span>

						<!--<span class="gr ba-green">高</span>-->

					</li>

					<li class="te-right">

						<!--<span class="gr ba-pink">高</span>-->

                        <?php if($store['store_deliverycredit'] <= 2): ?><span class="red"><?php endif; if($store['store_deliverycredit'] > 2 and $store['store_deliverycredit'] < 4): ?><span class="pink"><?php endif; if($store['store_deliverycredit'] >= 4): ?><span class="green"><?php endif; ?><?php echo $store['store_deliverycredit']; ?>分</span>

						<span>物流</span>

					</li>

				</ul>

			</div>

		</div>

		<div class="my sinhert setting g4">

			<div class="content">

				<div class="floor w3">

					<ul>

						<li>

							<a href="<?php echo U('Store/goods_list',['store_id'=>$store['store_id']]); ?>">

								<h2><?php echo $total_goods; ?></h2>

								<p>全部商品</p>

							</a>

						</li>

						<li>

							<a href="<?php echo U('Store/goods_list',['store_id'=>$store['store_id'],'sta'=>is_new]); ?>">

								<h2><?php echo count($new_goods); ?></h2>

								<p>新品</p>

							</a>

						</li>

						<li>

							<a href="<?php echo U('Store/goods_list',['store_id'=>$store['store_id'],'sta'=>is_recommend]); ?>">

								<h2><?php echo count($hot_goods); ?></h2>

								<p>热销</p>

							</a>

						</li>

					</ul>

				</div>

			</div>

			<div class="list7 detailsfloo ma-to-20">

				<div class="myorder p">

					<div class="content30">

						<a href="tel:<?php echo $store['store_phone']; ?>">

							<div class="order">

								<div class="fl">

									<span class="firde">在线客服</span>

									<span></span>

								</div>

								<div class="fr">

									<i class="Mright sto_kf"></i>

								</div>

							</div>

						</a>

					</div>

				</div>

				<div class="myorder p">

					<div class="content30">

						<a href="<?php echo U('Store/qrcode',['store_id'=>$store['store_id']]); ?>">

							<div class="order">

								<div class="fl">

									<span class="firde">店铺二维码</span>

									<span></span>

								</div>

								<div class="fr">

									<i class="Mright sto_kf sto_ewm"></i>

								</div>

							</div>

						</a>

					</div>

				</div>

				<div class="myorder p">

					<div class="content30">

						<a href="tel:<?php echo $store['store_phone']; ?>">

							<div class="order">

								<div class="fl">

									<span class="firde">在线客服</span>

									<span><?php echo $store['store_phone']; ?></span>

								</div>

								<div class="fr">

									<i class="Mright sto_kf sto_phone"></i>

								</div>

							</div>

						</a>

					</div>

				</div>

			</div>

			<div class="list7 detailsfloo ma-to-20">

				<!--<div class="myorder p">-->

					<!--<div class="content30">-->

						<!--<a href="javascript:void(0)">-->

							<!--<div class="order">-->

								<!--<div class="fl">-->

									<!--<span class="firde">店铺简介</span>-->

									<!--<span><?php echo $store['store_name']; ?></span>-->

								<!--</div>-->

							<!--</div>-->

						<!--</a>-->

					<!--</div>-->

				<!--</div>-->

                <?php if(!(empty($store['company_name']) || (($store['company_name'] instanceof \think\Collection || $store['company_name'] instanceof \think\Paginator ) && $store['company_name']->isEmpty()))): ?>

                    <div class="myorder p">

                        <div class="content30">

                            <a href="javascript:void(0)">

                                <div class="order">

                                    <div class="fl">

                                        <span class="firde">公司名称</span>

                                        <span><?php echo $store['company_name']; ?></span>

                                    </div>

                                </div>

                            </a>

                        </div>

                    </div>

                <?php endif; ?>



				<div class="myorder p">

					<div class="content30">

						<a href="javascript:void(0)">

							<div class="order">

								<div class="fl">

									<span class="firde">开店时间</span>

									<span><?php echo date('Y-m-d',$store['store_time']); ?></span>

								</div>

							</div>

						</a>

					</div>

				</div>

				<div class="myorder p">

					<div class="content30">

						<a href="javascript:void(0)">

							<div class="order">

								<div class="fl">

									<span class="firde">店铺地址</span>

                                    <span><?php echo $store['region']; ?>，<?php echo $store['store_address']; ?></span>

                                </div>

							</div>

						</a>

					</div>

				</div>

			</div>

		</div>
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

	</body>

</html>

