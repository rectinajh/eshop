<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:50:"./template/mobile/default/user/message_notice.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>[title]--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

<body class="">

<div class="classreturn loginsignup">
    <div class="content">
        <div class="ds-in-bl return">
            <a href="javascript:history.back(-1);"><img src="__STATIC__/images/newBack.png" alt="返回"></a>
        </div>
        <div class="ds-in-bl search center">
            <span>消息中心</span>
        </div>
        <div class="ds-in-bl menu newsset">
               <!-- <a href="<?php echo U('Mobile/User/message_switch'); ?>"><img src="__STATIC__/images/newsset.png" alt="菜单"></a>-->
        </div>
    </div>
</div>
<div class="news_center">
    <?php if(is_array($messages) || $messages instanceof \think\Collection || $messages instanceof \think\Paginator): $i = 0; $__LIST__ = $messages;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$message): $mod = ($i % 2 );++$i;?>
        <div class="news_list_fll">
            <div class="maleri30">
                <div class="fl news_c_img">
                    <?php if($message['category'] == 0): ?>
                        <img src="__STATIC__/images/news1.png"/>
                    <?php else: ?>
                        <img src="__STATIC__/images/news2.png"/>
                    <?php endif; ?>
                </div>
                <div class="fl  news_c_tit">
                    <p><span class="news_h fl"><?php echo $message['category_name']; ?></span><span class="yestertime fr"><?php echo date('Y-m-d',$message['send_time']); ?></span></p>
                    <p><?php echo $message['message']; ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    <!--没有消息-s--->
    <?php if(empty($messages) || (($messages instanceof \think\Collection || $messages instanceof \think\Paginator ) && $messages->isEmpty())): ?>
		<div class="comment_con p">
			<div class="none">
				<img src="__STATIC__/images/none2.png">
				<br><br>
				目前没有消息
			</div>
		</div>
    <?php endif; ?>
	<!--没有消息-e--->
</div>
<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
