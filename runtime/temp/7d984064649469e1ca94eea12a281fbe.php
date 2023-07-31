<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:44:"./template/mobile/default/gold/business.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>交易明细--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

            <a href="javascript:history.back(-1)"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

        </div>

        <div class="ds-in-bl search center">

            <span>交易明细</span>

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
<div id="#app">  
<style>
    .demo-hidden{
        display: none
    }
</style>
<section>
        <form action="" submit-type="ajax">
            <div class="sellgec">
                <div class="sell-box">
                    <p class="sell-active">买入交易</p>
                    <p>卖出交易</p>
                 </div>          
            </div>
        </form>
    </section>
    <section>
        <div class="demodata demo-hidden" id="app">
            <ul class="demo data-active" style="background: #f7f7f7;margin-bottom: 2rem">
                    <li v-for="item in selists">
                        <div class="sell-data">
                            <div class="left-sell">
                                <p>对方昵称：<span>{{item.relation_nickname}}</span></p>
                                <p>单价：<span>{{item.price}}G</span></p>
                            </div>
                            <div class="middle-sell">
                                    <p style="font-size: .547rem;color: #2A81F4"><span>{{item.amount}}G</span></p>
                                    <p style="margin-top: .213rem">数量：<span>{{item.trade_qty}}</span></p>
                                    <p style="margin-top: .213rem">{{item.create_time}}</p>
                            </div>
                            <div class="right-sell gm-btn" :data-id="item.id">{{status[item.status]}}</div>
                        </div>
                    </li>
                </ul>
                <ul class="demo" style="background: #f7f7f7;margin-bottom: 2rem">
                    <li v-for="item in gmlists">
                        <div class="sell-data">
                            <div class="left-sell">
                                <p>对方昵称：<span>{{item.relation_nickname}}</span></p>
                                <p>单价：<span>{{item.price}}G</span></p>
                            </div>
                            <div class="middle-sell">
                                <p style="font-size: .547rem;color: #2A81F4"><span>{{item.amount}}G</span></p>
                                <p style="margin-top: .213rem">数量：<span>{{item.trade_qty}}</span></p>
                                <p style="margin-top: .213rem">{{item.create_time}}</p>
                            </div>
                            <div class="right-sell gm-btn" :data-id="item.id">{{status[item.status]}}</div>
                        </div>
                    </li>
                </ul>
        </div>
    </section>
</div>

<script src="__PUBLIC__/js/vue.min.js"></script>
<script>
$(function () {
    $(".sell-box p").bind("click",function(){
        var n = $(".sell-box p").index($(this));
        $(".sell-box p").removeClass("sell-active");
        $(this).addClass("sell-active");
        $(".take-goods .takeitem").removeClass("take-active");
        $(".take-goods .takeitem").eq(n).addClass("take-active");
        $(".demodata>.demo").removeClass("data-active");
        $(".demodata>.demo").eq(n).addClass("data-active");
    })
    var app = new Vue({
        el: '#app',
        data: {
            selists: [],
            gmlists:[],
            status:['未完成','已完成','已取消']
        },
        methods:{
            getData:function(){ 
                var that= this;
                $.ajax({
                    url:'/Mobile/goldchain/myBuyTradeList/',
                    type:"GET",
                    success:function(datas){
                        that.selists=datas;
                        console.log(datas);
                    }
                });
                $.ajax({
                    url:'/Mobile/goldchain/MySoldTradeList/',
                    type:"GET",
                    success:function(datas){
                        that.gmlists=datas;
                        console.log(datas);
                        
                    }
                })   
               
            }
             
        },
        created: function () {
            $(".demo-hidden").removeClass("demo-hidden");
        },
        mounted:function(){
            this.getData();
        },
    })
   
})     
   
</script>
</body>
</html>
