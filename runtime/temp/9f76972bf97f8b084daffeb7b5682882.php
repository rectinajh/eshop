<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"./template/mobile/default/gold/dedication.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>我的奉献值--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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


    <div class="myhearder bankhearder">
        <div class="top_nav_back">
            <a href="javascript:history.back(-1);">
                <img src="__STATIC__/images/newBack.png" alt="返回">
             </a>
             <span>我的奉献值</span>
        </div>
        
        <div class="title-money-box2" >
           <div class="dication">
                <div class="dication-name">我的奉献值</div>
                <a href="<?php echo U('Mobile/Gold/dedication_list'); ?>">明细</a>
           </div>
                <div class="dication-value "><?php echo $dedication_money; ?></div>
        </div>
    </div>
    <style>
      
        .d_boxInfo{
            padding: 1rem .8rem ;
            background-color: #fff;
        }
        .d_boxInfo .d_title{
            color: #BCBCBC;
            font-size: .5rem;
            text-align: center
        }
      
        .d_title p:first-child{
            font-size: 1rem;
            line-height: 1.5rem;
        }
        .d_title a.getconsume{
            color: #BCBCBC;
            line-height: 1rem;
            margin-bottom: .5rem;
            display:block;
        }
        .d_num{
            border:1px solid #BCBCBC;
            border-radius: .2rem;
            height: 1.6rem;
            display: flex;
            display: -webkit-flex;
            font-size: .5rem;
            padding-right: .5rem;            
        }
        .d_box input{
            border:none;
            outline: none;
        }

        .d_num .allDonate{
            color:#53A9F9;
            width: 2rem;
            height: 1.6rem;
            line-height:1.6rem;
        }
        .d_num .donate{
            flex: 1;
            padding-left: .5rem;
        }
        .d_box .btnDonate{
            margin: 5rem auto ;
            width: 80%;
            font-size: .8rem;
            padding: .5rem;
            color:#fff;
            background-color: #53A9F9;
            border-radius: .2rem;
            display: block;
        }
    </style>
   <div class="d_box">
        <div class="d_boxInfo">
            <div class="d_title">
                <p class="num"><?php echo $consume_cp; ?></p>
                <a class="getconsume" href="suanli_withdraw.html">我的消费算力</a>
            </div>
            <div class="d_num">
                <input type="number" name="donate" class="donate" placeholder="请输入您的算力">
                <a class="allDonate" href="javascript:;">全部捐献</a>
            </div>
        </div>
        <input type="button" value="我要捐献" class="btnDonate">
   </div>
   <script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
   <script>
       $('.allDonate').click(function () {
           var value=$.trim($('.d_box .num').html());
           $('input[name=donate]').val(value);
       })
       
       $('.btnDonate').click(function () {
           var num=$.trim($('input[name=donate]').val());
           if(!num){
                showErrorMsg('请输入要捐赠值');
                $('input[name=donate]').focus();
           }
           if(!/^-?[1-9]*(\.\d*)?$|^-?0(\.\d*)?$/.test(num)){
               showErrorMsg('请输入数字');
               $('input[name=donate]').val('').focus();
           }
           $.ajax({
                type : 'post',
                url : '/index.php?m=Mobile&c=Gold&a=dedication',
                data : {dedication_money:num},
                dataType : 'json',
                success : function(res){
                    if(res.status == 1){
                        showErrorMsg(res.msg);
                        window.location.href = '/index.php?m=Mobile&c=Gold&a=dedication_list';
                    }else{
                        showErrorMsg(res.msg);
                       
                    }
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {
                    showErrorMsg('网络失败，请刷新页面后重试');
                }
            })
       })
      
       function showErrorMsg(msg){
        layer.open({content:msg,time:2});
        }
   </script>