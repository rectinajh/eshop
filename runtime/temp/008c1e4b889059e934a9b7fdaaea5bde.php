<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:42:"./template/pc/rainbow/payment/payment.html";i:1531973018;}*/ ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>支付页面-<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

    <meta name="keywords" content="<?php echo $tpshop_config['shop_info_store_keyword']; ?>"/>

    <meta name="description" content="<?php echo $tpshop_config['shop_info_store_desc']; ?>"/>

    <script src="__STATIC__/js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>

    <style type="text/css">

        * {

            margin: 0;

            padding: 0

        }



        .wihe-ee {

            width: 560px;

            height: 420px;

            background: #FFF;

            padding: 25px;

            color: #666;

            font-family: song, arial;

            font-size: 14px;

            box-sizing: border-box;

            border-radius: 6px;

            margin: 0 auto;

            margin-top: 10%

        }



        .wihe-ee p {

            text-align: center

        }



        .co999 {

            color: #999

        }



        .fo-si-18 {

            font-size: 18px

        }



        .fail-fasu {

            float: left;

            width: 200px;

            height: 180px;

            padding-top: 100px;

            background: url(__STATIC__/images/icon-pay.png) 50px 0 no-repeat;

            text-align: center

        }



        .success-fasu {

            float: right;

            width: 200px;

            height: 180px;

            padding-top: 100px;

            background: url(__STATIC__/images/icon-pay.png) -220px 0 no-repeat;

            text-align: center

        }



        .fail-fasu a:hover {

            background-color: #ee9775

        }



        .fail-fasu a {

            padding: 8px 24px;

            background-color: #f8a584;

            display: table;

            margin: 0 auto;

            color: #fff;

            text-decoration: none;

            margin-top: 10px

        }



        .re-qtzfgg a, .success-fasu a {

            padding: 8px 24px;

            background-color: #eee;

            display: table;

            margin: 0 auto;

            color: #999;

            text-decoration: none;

            margin-top: 10px

        }



        .re-qtzfgg a {

            padding: 8px 140px

        }



        .re-qtzfgg a:hover, .success-fasu a:hover {

            background-color: #ddd;

        }



        .fail-success {

            overflow: hidden;

            height: 185px

        }

    </style>

</head>

<body style="background-color:#666">

<div class="tac-sd">

    <div class="wihe-ee">

        <p>

            <span class="fo-si-18">请您在新打开的页面上完成付款!</span>

            <br>

            <span class="co999">付款完成前请不要关闭此窗口。完成付款后请根据您的情况点击下面的按钮。</span>

        </p>

        <br>

        <br>



        <div class="fail-success">

            <div class="fail-fasu">

                支付完成

                <br>

                <a href="<?php echo U('Home/Cart/cart4',array('order_id'=>$order_id,'master_order_sn'=>$master_order_sn)); ?>">支付成功</a>

            </div>

            <div class="fail-I-success" style="float:left">

                <!--<img src="__STATIC__/images/qrcode_vmall_app01.png" width="110" height="110"/>-->

                <?php echo $code_str; ?>

            </div>

            <div class="success-fasu">

                支付遇到问题

                <br>

                <a href="<?php echo U('Home/Cart/cart4',array('order_id'=>$order_id,'master_order_sn'=>$master_order_sn)); ?>">支付失败</a>

            </div>

        </div>

        <div class="re-qtzfgg">

            <a href="<?php echo U('Home/Cart/cart4',array('order_id'=>$order_id,'master_order_sn'=>$master_order_sn)); ?>">返回选择其他支付方式</a>

        </div>

    </div>

</div>

</body>

<script type="text/javascript">

    /**

     * 检查订单状态

     */
    var interval = setInterval(ajax_check_pay_status, 2000);

    function ajax_check_pay_status() {

        $.ajax({

            type: "post",

            url: "<?php echo U('Home/Api/check_order_pay_status'); ?>",

            data: {master_order_id: "<?php echo $master_order_sn; ?>", order_id: "<?php echo $order_id; ?>"},

            dataType: 'json',

            success: function (data) {
               // console.log(data);
                if (data.status == 1) {
                    clearInterval(interval);
                    window.location.href = "<?php echo U('Home/Order/order_detail',array('id'=>$order_id,'master_order_sn'=>$master_order_sn)); ?>";

                }

            }

        });

    }

    



</script>

</html>

