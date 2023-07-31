<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:41:"./template/mobile/default/gold/index.html";i:1593766028;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>交易中心--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

            <span>交易中心</span>

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
<!--顶部开始-->
<style>
    .demo-hidden {
        display:none;
    }
    div.layui-m-layercont {
        font-size: .653333rem;
        line-height: 1rem;
    }
    #chartitem .charts{
        height:  10.932rem
    }
</style>
<section  style="background: #fff;width: 100%;overflow: hidden;">
<div class="row">
    <div style="width:100%;padding:15px 15px 0 15px;box-sizing: border-box">
        <div class="box box-info">
            <div id="chartbox">
                <div id="mynav">
                    <a class="active">k线图</a>
                    <a>折线图</a>
                </div>
            </div> 
            <div id="chartitem" style="height:10.932rem;">
                <div id="chart1" class="charts chart-active"></div>
                <div id="chart2" class="charts"></div>
            </div>            
        </div>
        <div id="myhend">
            <div id=kdatas>
                <p>开盘:<span></span></p>
                <p>最高:<span></span></p>
                <p>收盘:<span></span></p>
                <p>最低:<span></span></p>
            </div>
        </div>
    </div>
</div>
</section>
<section>
<form action="" submit-type="ajax">
    <div class="sellgec">
        <div class="sell-box">
            <p class="sell-active">卖出XTC</p>
            <p>买入XTC</p>
         </div>
         <div class="take-goods">
            <div class="takeitem take-active">
                <div class="input-sell">
                    <input type="number" id="mcnum" placeholder="请输入出售数量">
                    <input type="number" id="mcpis" placeholder="请输入出售单价">
                </div>
                <div class="btn-sell">
                    <input type="submit" id="mc" value="我要卖出" style="background: #f10215">
                </div>
            </div>
            <div class="takeitem">

                                <div class="input-sell">
                    <input type="number" id="gmnum" placeholder="请输入购买数量">
                    <input type="number" id="gmpis" placeholder="请输入购买单价">
                </div>
                <div class="btn-sell">
                    <input type="submit" id="gm" value="我要买入">
                </div>
            </div>
         </div>
    </div>
</form>
</section>
<style>
    
</style>
<section>
<div class="demodata demo-hidden" id="app">
    <ul class="demo data-active" style="background: #f7f7f7;margin-bottom: 2rem">
        <li v-for="item in selists">
            <div class="sell-data">
                    <div class="left-sell">
                        <p>昵称：<span>{{item.nickname}}</span></p>
                        <p>单价：<span>{{item.price}}G</span></p>
                    </div>
                    <div class="middle-sell">
                        <p style="font-size: .547rem;color: #2A81F4"><span>{{item.amount}}G</span></p>
                        <p style="margin-top: .213rem">数量：<span>{{item.trade_qty}}</span></p>
                        <p style="margin-top: .213rem">{{item.create_time}}</p>
                    </div>
                <div class="right-sell gm-btn" :data-id="item.id" :data-way="item.way">交易</div>
            </div>
        </li>
    </ul>
    <ul class="demo"  style="background: #f7f7f7; margin-bottom: 2rem">
        <li v-for="item in gmlists">
            <div class="sell-data">
                <div class="left-sell">
                    <p>昵称：<span>{{item.nickname}}</span></p>
                    <p>单价：<span>{{item.price}}G</span></p>
                </div>
                <div class="middle-sell">
                    <p style="font-size: .547rem;color: #f10215"><span>{{item.amount}}G</span></p>
                    <p style="margin-top: .213rem">数量：<span>{{item.trade_qty}}</span></p>
                    <p style="margin-top: .213rem">{{item.create_time}}</p>
                </div>
                <div class="right-sell gm-btn" :data-id="item.id" :data-way="item.way"  style="background: #f10215">购买</div>
            </div>
        </li>
    </ul>
</div>
</section>
<style>
   .pwdBox{
       display: none;
   }
   .labelPwd{
      line-height: 2rem;
      font-size: .6rem;
   }
     .pwd{
       border:none;
       border-bottom: 1px solid #909090;
       outline: none;
       text-indent: .5rem;
   }
 .btnPwd{
       margin-top: 1rem;
        width: 40%;
        height: 1.5rem;
        border-radius: .2rem;
        background-color: #2A81F4;
        color:#fff;
        text-align: center;
        border:none;
        outline: none;
   }
   .btnCancel{
    width: 40%;
        height: 1.5rem;
        border-radius: .2rem;
        background-color:  #b9b9b9;
;
        color:#fff;
        text-align: center;
        border:none;
        outline: none;
        margin-right: 1rem;
   }
</style>
<div class="pwdBox">
    <form action="" method="POST" class="showPwd">
       <label class="labelPwd">
        请输入密码：<input type="password" class="pwd" name="password" placeholder="请输入密码">
       </label>
       <div>
        <input type="button" class="btnCancel" value="取消"><input type="submit" class="btnPwd" value="确定">
       </div>
    </form>
</div>
 <!--底部-start-->
    
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

 <!--底部-end-->
<script src="__PUBLIC__/js/vue.min.js"></script>
<script src="__PUBLIC__/chart/echarts.js"></script>
<script src="__PUBLIC__/chart/wechart1.js"></script>
<script src="__PUBLIC__/chart/wechart2.js"></script>
<script> 

    // 线图选项卡
    $("#mynav a").bind("click",function(){
        var n = $("#mynav>a").index($(this));
        $("#mynav a").removeClass("active");
        $(this).addClass("active");
        $("#chartitem>.charts").removeClass("chart-active");
        $("#chartitem>div").eq(n).addClass("chart-active");
        console.log(n);
        if(n==1){
            $("#myhend").css("opacity","0");
        }
        else{
            $("#myhend").css("opacity","1");
        }
    })
    // 买卖选项卡
    $(".sell-box p").bind("click",function(){
        var n = $(".sell-box p").index($(this));
        $(".sell-box p").removeClass("sell-active sell-red");
        // $(this).addClass("sell-active");
        if(n==0){
         $(".sell-box p").eq(0).addClass("sell-active");
        }else{
         $(".sell-box p").eq(1).addClass("sell-red");   
        }


        $(".take-goods .takeitem").removeClass("take-active");
        $(".take-goods .takeitem").eq(n).addClass("take-active");
        $(".demodata>.demo").removeClass("data-active");
        $(".demodata>.demo").eq(n).addClass("data-active");
    })
    //<!-- 买入 -->
    $(function(){
        
        $("#gm").bind("click",function(){
            var num=$("#gmnum").val();
            var price=$("#gmpis").val();
            var reg = /^[1-9]\d*$/;
            if($("#gmnum").val()==''){
                showErrorMsg("请输入数量"); 
				return false;
			}
			if(reg.test($("#gmnum").val())){
			}else{
				showErrorMsg("请输入整数"); 
				return false;
			}
            if(price==""){
                showErrorMsg("请输入价格"); 
                return false;
            }
            if(!isNaN(price)){
            }else{
                showErrorMsg("请输入数字"); 
                return false;
            }
            checkPwdCode(null,null,function () {
                $.ajax({
                    url: '/Mobile/goldchain/buy/',
                    type: 'POST',
                    data: {
                        buy_qty:num,
                        price:price
                    },
                    success: function (datas) {  
                        console.log(datas)
                        if(datas.code == 0){
                            showErrorMsg(datas.msg); 
                        }else{
                            showErrorMsg(datas.msg, true);
                        }
                    }
                });
            })
           
            return false;
        })
    })
    //<!-- 卖出 -->
    $(function(){
        $("#mc").bind("click",function(){
            var num=$("#mcnum").val();
            var price=$("#mcpis").val();
            var reg = /^[1-9]\d*$/;
            if($("#mcnum").val()==''){
				showErrorMsg("请输入数量"); 
				return false;
			}
			if(reg.test($("#mcnum").val())){
			}else{
				showErrorMsg("请输入整数"); 
				return false;
			}
            if(price==""){
                showErrorMsg("请输入价格"); 
                return false;
            }
            if(!isNaN(price)){
            }else{
                showErrorMsg("请输入数字"); 
                return false;
            }
           checkPwdCode(null,null,function () {
            $.ajax({
                url: '/Mobile/goldchain/sold/',
                type: 'POST',
                data: {
                    sold_qty:num,
                    price:price
                },
                success: function (datas) {  
                    console.log(datas)
                    if(datas.code == 0){
                        showErrorMsg(datas.msg); 
                    }else{
                        showErrorMsg(datas.msg, true); 
                    }
                  
                }
            });
           })
            return false;
        })
    });
    var app = new Vue({
  el: '#app',
  data: {
    selists: [],
    gmlists:[]
  },
  methods:{
    getData:function(){
        var that= this;
       $.ajax({
           url:'/Mobile/goldchain/buyList/',
           type:"GET",
           success:function(datas){
             that.selists=datas;
           }
       });
       $.ajax({
           url:'/Mobile/goldchain/soldList/',
           type:"GET",
           success:function(datas){
             that.gmlists=datas;
           }
       })         
    }
  },
  created: function () {
     $(".demo-hidden").removeClass("demo-hidden");
     getCookieByName('stype')=='1'?$('.sell-box p').eq(1).trigger('click'):$('.sell-box p').eq(0).trigger('click'); 
        setCookies('stype','');
  },
  mounted:function(){
    this.getData();
  },
})
function checkPwdCode(id, way, successCallback) {
    
   var layerIndex = layer.open({
        title: [
        '输入密码',
        'background-color: #2A81F4; color:#fff;font-size:.7rem;height:1.6rem;line-height:1.6rem;'
        ],
        content: $('.showPwd').html(),
    });
    //确定按钮
    $(document).on('click', '.btnPwd', function () {
        var value=$('.layui-m-layer input[type=password]').val();
        $.ajax({
            url:'/Mobile/goldchain/validateSafePassword/',
            type:'POST',
            data:{password:value},
            success:(res) => {
              if (res.code == 0) {
                alert(res.msg);
              } else {
                successCallback(id, way);
                $(document).off('click','.btnPwd');
              }
            }
        })
    })
    $(document).one('click','.btnCancel',function () {
        $(document).off('click','.btnPwd');
        layer.close(layerIndex)
    })
}
$('body').on('click', ".gm-btn" , function() {
    var id = $(this).data().id, way = $(this).data().way;
    checkPwdCode(id, way, function(id, way) {
        $.ajax({
            url: way == 1 ? '/Mobile/goldchain/buyTrade/' : '/Mobile/goldchain/soldTrade/',
            type: 'POST',
            data: {
                trade_id:id
            },
            success: function (datas) {  
                console.log(datas)
                if(datas.code == 0){
                    showErrorMsg(datas.msg); 
                }else{
                    showErrorMsg(datas.msg, true); 
                }
            }
        });
    });
    
    return false;
});
function showErrorMsg(msg, reload) {
    layer.open({
        content: msg,
        time: 3,
        end: function() {
            
            if (reload) {
                $('.sell-box>p').eq(1).hasClass('sell-red')?setCookies('stype',1):setCookies('stype',0); 
                window.location.reload()
            }
        }
    });
}
</script>
</body>
</html>