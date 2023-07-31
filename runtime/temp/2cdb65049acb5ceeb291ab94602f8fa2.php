<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:43:"./template/mobile/default/gold/wakuang.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>我的钱包--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

<body class="g4">

<div class="classreturn">

    <div class="content">

        <div class="ds-in-bl return">

            <a href="javascript:history.go(-1);"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

        </div>

        <div class="ds-in-bl search center">

            <span>我的钱包</span>

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
<link href="__STATIC__/circle/css/style-rj.css" rel="stylesheet" type="text/css" />
<link href="__STATIC__/circle/css/style.css" rel="stylesheet" type="text/css" />
<style>
    .classreturn{
        border-bottom: none;
        /* background: #2d5379 */
        background: #2a81f4
    }
</style>
<div style="position:absolute;z-index:-1;width: 100%;height: 100%;background: url(__STATIC__/images/circle_bgd.png) no-repeat;background-size: cover;">
   <!-- <canvas id="canvas" width="100%;height:100%"></canvas> -->
</div>
<div class="box-a" style="display: none">  
    <div class="m-12-k" style="top: 9rem">
        <div class="m-12xz1 xzleft"></div>
        <div class="m-12xz2"></div>
        <div class="m-12xz3 xzleft"></div>
        <div class="m-12zt2" id="sx2" style="color: #fff;font-size:.8rem">运算中</div>
    </div>
</div>
<div id="btn-go" style="width: 100%;height:100%;padding-top:9rem;display: none">
     <div style="position: relative;width:5.2rem;height:5.2rem;line-height:5.2rem;text-align: center;color: #fff;font-size: .8rem;margin:0 auto;border-radius: 50%;background: rgba(42,129,244,.5)"> 点击计算
     </div>
</div>
<div style="position: fixed;bottom: 60px;">
    <p style="color: #fff;font-size:.8rem;padding:.427rem">我的算力:<span><?php echo $user['consume_cp']; ?>G</span></p>
    <p style="color: #fff;font-size:.8rem;padding:.427rem">全网算力:<span><?php echo $all_consume_cp; ?>G</span></p>
    <p style="color: #fff;font-size:.8rem;padding:.427rem">我的新淘链:<span><?php echo $user['jin_num']; ?></span></p>
</div>
<script>
     $.ajax({
        url:"/Mobile/Goldchain/calculate",
        type:"GET",
        dataType:"json",
        success:function(data){
            console.log(data)
            if(data==1){
                $("#btn-go").css("display","none");
                $(".box-a").css("display","block");
            }else{
                $("#btn-go").css("display","block");
            }
        }
    })

$("#btn-go").click(function(){
    $.ajax({
        url:"/Mobile/Goldchain/calculate",
        type:"GET",
        data:{
          update:1
        },
        dataType:"json",
        success:function(data){
            console.log(data)
            if(data==1){
                $("#btn-go").css("display","none");
                $(".box-a").css("display","block");
            }else{
                $("#btn-go").css("display","block");
            }
        }
    })
})
</script>
</body>
</html>