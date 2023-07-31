<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:50:"./template/mobile/default/article/articleList.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>新闻公告--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

            <span>公告</span>

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
    .notice{
        background-color: #F1F1F1;
        font-size: .5rem;
        height: 100%;
        width: 100%;
        position: absolute;
    }
    .notice li{
        margin-bottom: .3rem;
    }
    .notice ul li a {
        background-color: white;
        display: -webkit-box;
        display: -webkit-flex;
        display: flex;
        -webkit-box-align: center;
        -webkit-align-items: center;
        padding: .4rem;
        align-items: center;
        border-bottom: 1px solid #eee;
    }
    .media_hd {
        margin-right: 0.5rem;
        width: 4rem;
        height: 3rem;
        text-align: center;
    }
    .media_hd img {
        width: 100%;
        border-radius: .2rem;
        height: 100%;
    }
    
    .media_bd {
        -webkit-box-flex: 1;
        -webkit-flex: 1;
        flex: 1;
        min-width: 0;
    }

    .media_title {
        font-weight: 400;
        width: auto;
        font-size: .56rem;
        overflow: hidden;
        text-overflow: ellipsis;
        word-wrap: break-word;
        word-break: break-all;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        line-height: 1rem;
    }
    .text-right {
        text-align: right;
    }
    .media_bd h4.date {
        font-size: .5rem;
    }

    .media_bd h4:last-child {
        color: #999;
        margin-top: .5rem;
    }

    .media_bd p {
        color: #999;
        font-size:.56rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        height: 1rem;
        line-height:1rem;

    }
  	.media_content{
      margin-top:.3rem;
      height:2rem;
      overflow:hidden;
  	}
</style>
<div class="notice">
    <ul class="article">
<?php if(is_array($article) || $article instanceof \think\Collection || $article instanceof \think\Paginator): if( count($article)==0 ) : echo "" ;else: foreach($article as $key=>$article): ?>
        <li>
            <a href="<?php echo U('Article/detail',array('article_id'=>$article[article_id])); ?>">
                <div class="media_hd">
                    <img src="__STATIC__/images/xtgg.png" alt="">
                </div>
                <div class="media_bd">

                    <h4 class="media_title"><?php echo $article['title']; ?></h4>
                  	<div class="media_content">
                    	<?php echo htmlspecialchars_decode($article['content']); ?>
                  	</div>
                    <h4 class="text-right date"><?php echo date('Y-m-d',$article['publish_time']); ?></h4>
                </div>
            </a>
        </li>
 <?php endforeach; endif; else: echo "" ;endif; ?>       
    </ul>
</div>