<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:46:"./template/mobile/default/gold/gold_chain.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:44:"./template/mobile/default/public/footer.html";i:1532661070;}*/ ?>
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

<style>
.title-money-box .money-usable{
        text-align: left;
        padding-right: 0;
    }
</style>
    <div class="myhearder bankhearder">
        <div class="top_nav_back">
            <a href="javascript:history.go(-1);">
                <img src="__STATIC__/images/newBack.png" alt="返回">
             </a>
             <span>新淘链</span>
        </div>
        <div class="title-money-box" style="bottom: 0">
            <div class="xiaofei">
                <div class="money-name">我的资产(XTC)</div>
                <div class="money-value"><?php echo $user['jin_num']; ?></div>
                <div style="display: flex;justify-content: space-around">                 
                    <div class="money-usable" style="padding-top: 1rem">冻结资产(<?php echo number_format($user['frost_jin_num'],6); ?>)</div>
                    <div>
                        <div class="money-usable">今日单价(<?php echo number_format($price,2); ?>)</div>
                       <div class="money-usable">总价值(<?php echo number_format($value,6); ?>)</div>
                    </div>
                </div>
            </div>
            <div class="profit">
                <div>
                    <a href="<?php echo U('Mobile/Dynamic/index'); ?>">
                        <p>今日收益</p>
                        <p><?php echo $yestday; ?></p>
                    </a>
                </div>
                <div>
                    <a href="javascript:;" class="showDate">
                        <p>累计收益</p>
                        <p><?php echo $user['jin_total']; ?></p>
                        
                            <form action="" class="frm">
                               <label class="dateItem" ><span>开始日期：</span><input type="date" class="fromDate" name="fromDate"></label>
                               <label class="dateItem"><span>结束日期：</span> <input type="date" class="toDate" name="toDate"></label>
                                <input type="button" value="提交" class="btnSubTime"/>
                            </form>
                       
                        <span id="time" ></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="sell-box flex">
        <a href="<?php echo U('Mobile/Gold/index'); ?>">
            <i class="iconfont icon-18" style="color: #74d96c"></i>
            <span>买入</span>
        </a>
        <a href="<?php echo U('Mobile/Gold/index'); ?>">
            <i class="iconfont icon-19" style="color: #e94948"></i>
            <span>出售</span>
        </a>
    </div>
    <div class="floor-floor"style="padding-bottom:2rem;">
        <ul class="floor-items">
            <li><a href="<?php echo U('Mobile/Gold/consume_list'); ?>">
                <div class="itlt">
                    <i class="iconfont icon-iconfontcolor64" style="color: #ff864d"></i>
                    <span>我的消费算力</span>
                </div>
                <div class="itrt">
                    <i style="font-size: .64rem;"><?php echo $user['consume_cp']; ?>G</i>
                </div>
            </a></li>
            <li>
                <a href="<?php echo U('Mobile/Gold/wakuang'); ?>">
                    <div class="itlt">
                        <i class="iconfont icon-qian2" style="color: #ebd82a"></i>
                        <span>我的钱包</span>
                    </div>
                    <div class="itrt">
                        <i class="Mright"></i>
                    </div>
                </a>
            </li>
            <li>
                    <a href="<?php echo U('Mobile/Gold/transfer'); ?>">
                        <div class="itlt">
                            <i class="iconfont icon-qian2" style="color: #2abdeb"></i>
                            <span>我要转账</span>
                        </div>
                        <div class="itrt">
                            <i class="Mright"></i>
                        </div>
                    </a>
            </li>
            <li>
                <a href="<?php echo U('Mobile/Gold/transfer_list'); ?>">
                <div class="itlt">
                    <i class="iconfont icon-mingxi" style="color: #f96363"></i>
                    <span>转账记录</span>
                </div>
                <div class="itrt">
                    <i class="Mright"></i>
                </div>
                </a>
            </li>
            <li>
                <a href="<?php echo U('Mobile/Gold/wallet_address'); ?>">
                    <div class="itlt">
                        <i class="iconfont icon-qianbao" style="color: #50c65f"></i>
                        <span>钱包地址</span>
                    </div>
                    <div class="itrt">
                        <i class="Mright"></i>
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo U('Mobile/Gold/index'); ?>">
                    <div class="itlt">
                        <i class="iconfont icon-shouhuo" style="color: #ec7104"></i>
                        <span>交易大厅</span>
                    </div>
                    <div class="itrt">
                        <i class="Mright"></i>
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo U('Mobile/Gold/demand'); ?>">
                    <div class="itlt">
                        <i class="iconfont icon-mingxi" style="color: #606bfa"></i>
                        <span>我的挂单</span>
                    </div>
                    <div class="itrt">
                        <i class="Mright"></i>
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo U('Mobile/Gold/business'); ?>">
                    <div class="itlt">
                        <i class="iconfont icon-mingxi" style="color: #68fa60"></i>
                        <span>交易记录</span>
                    </div>
                    <div class="itrt">
                        <i class="Mright"></i>
                    </div>
                </a>
            </li>
            <li><a href="<?php echo U('Mobile/Gold/consume_list'); ?>">
                <div class="itlt">
                    <i class="iconfont icon-mingxi" style="color: #d563f9"></i>
                    <span>算力明细</span>
                </div>
                <div class="itrt">
                    <i class="Mright"></i>
                </div>
            </a></li>
            <li><a href="<?php echo U('Mobile/Gold/dedication'); ?>">
                <div class="itlt">
                    <i class="iconfont icon-aixinfengxian" style="color: #fa6468"></i>
                    <span>捐献消费算力</span>
                </div>
                <div class="itrt">
                    <i class="Mright"></i>
                </div>
            </a></li>
        </ul>
    </div>
    <style>
    #gotop{opacity: 0;}
    </style>
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

    <script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
   <style>
       .profit{
           position: relative;
       }
       .showDate .frm{
           position: absolute;
           font-size: .5rem;
           color:#666;
           width: 80%;
           display: flex;
           display: -webkit-flex;
           flex-direction: column;
           justify-content: space-between;
           padding:.6rem .8rem  .8rem .6rem;
           top:2.8rem;
           left: 50%;
           transform: translateX(-50%);
           border-radius: .2rem;
           display: none;
           background-color: #f5f5f5;
       }
       .showDate .dateItem{
           width: 100%;
           display: flex;
           display: -webkit-flex;
           align-items: center;
           padding: .8rem 0;
       }
       .profit .dateItem:first-child{
           border-right: none;
       }
       .showDate .dateItem span{
           width: 30%;
       }
       .showDate .dateItem input{
           flex: 1;
           border:none;
           outline: none;
           height:1.5rem;
           padding-left: .3rem;
           background-color: #fff;
       }
       .frm input.btnSubTime{
           background-color: #58ACFB;
           line-height: 1.5rem;
           height: 1.5rem;
           font-size: .5rem;
           color: #fff;
           border:none;
           outline: none;
           margin-top: .5rem;
           width: 80%;
            align-self:center;
       }
   </style>
    <script>
        $(function () {
            var isShow=false;
           $('.showDate').click(function () {
            if(isShow){
                    $('.frm').hide();
                    isShow=false;
            }else{
                    $('.frm').show();
                    isShow=true;
                    $('.btnSubTime').click(function (event) {
                        var time1=$.trim($('.fromDate').val());
                        var time2=$.trim($('.toDate').val());
                        console.log(time1);
                        console.log(time2);
                        if (!time1) {
                            layer.open({
                                content: '开始时间不能为空'
                                ,skin: 'msg'
                                ,time: 2 //2秒后自动关闭
                            });	
                            return false; 
                        }
                        if(!time2){
                            layer.open({
                                content:'结束时间不能为空！'
                                ,skin: 'msg'
                                
                                ,time:2
                            })
                            return false;
                        }
                        if(!compare_time(time1,time2)){
                            var url="<?php echo U('Mobile/Dynamic/index','',false); ?>"+"/begintime/"+time1+"/finishtime/"+time2
                            console.log(url)
                            location.href=url;
                        }
                        // event.stopPropagation();
                    })
                }
           })
        
           $('.dateItem').click(function (event) {
            event.stopPropagation();
               
           })
        })
     
    </script>