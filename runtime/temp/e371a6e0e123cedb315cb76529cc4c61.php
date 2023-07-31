<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:45:"./template/mobile/default/article/detail.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>新闻公告详情--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

            <span>公告详情</span>

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
   .notice_detail{
       padding: .5rem .3rem;
   }
  
   .imgtext-title{
        font-size:1rem;
        padding-bottom:.8rem;
        text-align: center;
        font-weight: 400;
        line-height: 1.4;
    }
    .img-text-box img{
        max-width:100%;
        margin:0.5rem 0;
    }
    .notice_detail .date{
        font-size: .6rem;
        color:#666;
        font-weight: normal;
      text-align:right;
      display:flex;
      align-items:center;
      justify-content: flex-end;
      margin-top:.5rem;
    }
    .notice_detail .date span{
        margin-left: .5rem;
    }
    .content{
        word-break: break-all;
        word-wrap:break-word;
        overflow: hidden;
        width: 100%;
        font-size: .56rem !important;
      	margin:0 auto;
    }
  .content img{
      width: 100%;
  }
  .content p{
    line-height:1rem;
    color:#666;
    margin-bottom:.3rem;
  }
    
</style>
<div class="notice_detail">
    <div class="header">
        <h3 class="imgtext-title"><?php echo $article['title']; ?></h3>
    </div>
    <div class="content">
            <?php echo htmlspecialchars_decode($article['content']); ?>
    </div>
    <h4 class="date"><?php echo date('Y-m-d',$article['publish_time']); ?> <span>新淘链</span></h4>

</div>