<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:44:"./template/mobile/default/lottery/index.html";i:1532661070;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>转盘 - www.ohbbs.cn 欧皇源码论坛 </title>
    <link rel="stylesheet" href="__STATIC__/zhuanpan/game/common/css/common_mobile.css?version=1.0.0">
    <link rel="stylesheet" href="__STATIC__/zhuanpan/index/css/index.css?version=1.0.0">
    <!-- 移动端适配 -->
    <script>
        var html = document.querySelector('html');
        chanceRem();
        window.addEventListener('resize', chanceRem);
        function chanceRem() {
            var width = html.getBoundingClientRect().width;
            html.style.fontSize = width / 10 + 'px';
        }
    </script>
   
</head>
<body>
<div class="classreturn">
    <div class="content">
        <div class="ds-in-bl ">
            <a href="javascript:history.go(-1);"><img src="__STATIC__/images/newBack.png" alt="返回"></a>
        </div>
        <div class="ds-in-bl ">
            <span>新淘链抽奖</span>
        </div>
        <div class="ds-in-bl menu">
        </div>
    </div>
</div>
<div id="wrap">
    <div class="caidai"></div>
    <div class="header clearfix">           
        <div class="title"></div>
        <p class="rule">查看规则</p>
    </div>
    <!--轮盘-->
    <div class="rotate">
        <div class="lunpai">
            <ul class="prize ">
                <li>
                    <span></span>
                    <p>特别奖励</p>
                </li>
                <li>
                    <span></span>
                    <p>二等奖</p>
                </li>
                <li>
                    <span></span>
                    <p>三等奖</p>
                </li>
                <li>
                    <span></span>
                    <p>特别奖励</p>
                </li>
                <li>
                    <span></span>
                    <p>一等奖</p>
                </li>
                <li>
                    <span></span>
                    <p>三等奖</p>
                </li>
            </ul>
        </div>
        <div class="ring"></div>
        <div id="btn"></div>
    </div>
    <div class="border">
        您还有 <span id="chance"><?php echo $chance; ?></span> 次抽奖机会
    </div>
    <p class="border2">推广好友注册激活可获得抽奖次数</p>
    <div class="success">
        <ul>
            <?php if(empty($record) || (($record instanceof \think\Collection || $record instanceof \think\Paginator ) && $record->isEmpty())): else: if(is_array($record) || $record instanceof \think\Collection || $record instanceof \think\Paginator): if( count($record)==0 ) : echo "" ;else: foreach($record as $key=>$vo): ?>
                    <li class="flex-box">
                        恭喜会员<span class="start-num"><?php echo $vo['user']['safe_Mobile']; ?></span>抽中
                        <span  class="info"><?php echo $vo['prize_value']; ?></span>个新淘链
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </ul>
    </div>
    <!--游戏规则弹窗-->
    <div id="mask-rule">
        <div class="box-rule">
            <span class="star"></span>
            <h2>活动规则说明</h2>
            <span id="close-rule"></span>
            <div class="con">
                <div class="text">
                    <?php echo htmlspecialchars_decode($lottery->rule_content); ?>
                </div>
            </div>
        </div>
    </div>
    <!--中奖提示-->
    <div id="mask">
        <div class="blin"></div>
        <div class="caidai"></div>
        <div class="winning">
            <div class="red-head"></div>
            <div class="red-body"></div>
            <div id="card">
                <a href="" target="_self" class="win"></a>
            </div>
            <p class="btn">恭喜你获得0.1颗新淘链</p>
            <!-- <a href="" target="_self" class="btn"></a> -->
            <span id="close"></span>
        </div>
    </div>
</div>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script src="__STATIC__/zhuanpan/game/common/js/jquery.rotate.js"></script>
<script src="__STATIC__/js/layer/layer.js"  charset="utf-8"></script>
<script src="__STATIC__/zhuanpan/game/common/js/h5_game_common.js?version=1.0.0"></script>
<script src="__STATIC__/zhuanpan/index/js/index.js?version=1.0.0"></script>
<script>
    $(function(){
      
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
    })
</script>
</body>
</html>
