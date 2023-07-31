<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:51:"./template/mobile/default/gold/suanli_withdraw.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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
             <span>算力提现</span>
        </div>
        
        <div class="title-money-box2" >
           <div class="dication">
                <div class="dication-name">可提现算力</div>
                <a href="<?php echo U('Mobile/Gold/dedication_list'); ?>">明细</a>
           </div>
                <div class="dication-value"><?php echo $withdraw_consume; ?></div>
        </div>
    </div>
    <style>
      
        .d_boxInfo{
            padding: 1rem .8rem .5rem ;
            background-color: #fff;
        }
        .d_boxInfo .d_title{
            color: #BCBCBC;
            font-size: .5rem;
            text-align: center
        }
      .d_box .sunli_beizhu{
          color:#FE2D2C;
          font-size: .5rem;
         margin-top: .5rem;
      }
      .d_box .sunli_beizhu p{
          line-height: 1rem;
          text-align: center;
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
        .d_money{
            font-size: .5rem;
             margin-top: .5rem;
             color:#666;
             display: flex;
            display: -webkit-flex;
            justify-content: space-between;
            padding: .3rem 0;
            align-items: center;
        }
        
    </style>
   <div class="d_box">
        <div class="d_boxInfo">
            
            <div class="d_num">
                <input type="number" name="donate" class="donate" placeholder="请输入提现算力">
                <a class="allDonate" href="javascript:;">全部提现</a>
            </div>
            <div class="d_money">
                <p class="realMoney">实际到账金额：</p>
                <p class="serviceMoney">手续费：</p>  
            </div>
        </div>
       
        <div class="sunli_beizhu">
            <p class="consumeToWithdrawRebate">注：消费算力转换提现币比例为<span><?php echo $consumeToWithdrawRebate; ?></span></p>
            <p>交易平台收取<?php echo $consumeToWithdrawFee; ?>%手续费</p>            
        </div>
        <input type="submit" value="我要提现" class="btnDonate">
   </div>
  
   <script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
   <script>
       $('.allDonate').click(function () {
           var value = $.trim($('.dication-value').html());
           $('input[name=donate]').val(value);
           $('.donate').trigger('keyup'); 
       })

       
       $('.btnDonate').click(function () {
           var num = $.trim($('input[name=donate]').val());
           if(!num){
                showErrorMsg('请输入要捐赠值');
                $('input[name=donate]').focus();
                
           }
           if(!/^-?[1-9]*(\.\d*)?$|^-?0(\.\d*)?$/.test(num)){
               showErrorMsg('请输入数字');
               $('input[name=donate]').val('').focus();
              
           }
           var service=num*0.3;
           var real=num -service;
           $('.realMoney').append(real);
           $('.serviceMoney').append(service);
           $.ajax({
                url: '/Mobile/Gold/doct',
                type: 'POST',
                data: {donate: num},
                success: function(res) {
                    if (res.code == 1) {
                        layer.open({
                            content: res.msg,
                            time: 3,
                            end: function() {
                                window.location.reload();
                            }
                        });
                    } else {
                        layer.open({
                            content: res.msg,
                            time: 3
                        });
                    }
                }
           });
       })
      
        function showErrorMsg(msg)
        {
            layer.open({content:msg,time:2});
        }

        $(".donate").keyup(function(){
            var str = "<?php echo $consumeToWithdrawRebate; ?>";
            var ratio = str.split(':');
            var num = parseInt($(this).val());
            console.log(num);
            if (!isNaN(num)) {
                var withdraw_money = num * parseInt(ratio[1]) / parseInt(ratio[0]);
                var serviceRatio = parseInt("<?php echo $consumeToWithdrawFee; ?>");
                var serviceFee = withdraw_money * serviceRatio / 100;
                var factWithdrwaMoney = withdraw_money - serviceFee;          
                $('.realMoney').html("实际到账金额：" + factWithdrwaMoney);
                $('.serviceMoney').html("手续费：" + serviceFee);
            } else {
                $('.realMoney').html("实际到账金额：0.00" );
                $('.serviceMoney').html("手续费：0.00" );
            }
        });
       
   </script>