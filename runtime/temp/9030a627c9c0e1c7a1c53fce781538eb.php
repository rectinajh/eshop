<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:49:"./template/mobile/default/order/refund_order.html";i:1532661070;s:44:"./template/mobile/default/public/header.html";i:1532661070;s:48:"./template/mobile/default/public/header_nav.html";i:1532661070;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>取消订单--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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

            <a href="javascript:history.back(-1);"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

        </div>

        <div class="ds-in-bl search center">

            <span>取消订单</span>

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
<div class="n_hadgetgoods">
    <div class="reminder">
        <div class="maleri30 bop">
            <div class="message">
                <p>温馨提示：</p>
                <p>1.限时特价、预约资格等购买优惠可能一并取消</p>
                <p>2.如遇订单拆分、使用优惠券无法返还</p>
                <p>3.支付金额，抵扣余额积分都按原路退款</p>
                <p>4.订单一旦取消，无法恢复</p>
            </div>
        </div>
    </div>
    <div class="resonalist list7 detailsfloo loginsingup-input">
        <div class="maleri30">
            <div class="myorder returnreson p">
                <div class="content30">
                    <a href="javascript:void(0)">
                        <div class="order">
                            <div class="fl">
                                <span class="firde">退款原因：</span>
                                <span id="user_note">订单不能按时送达</span>
                            </div>
                            <div class="fr">
                                <i class="Mright"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            
            <div class="myorder p">
                <div class="content30">
                    <div class="lsu">
                        <span class="firde">联系人</span>
                        <input type="text" name="consignee" id="consignee" value="<?php echo (isset($user['realname']) && ($user['realname'] !== '')?$user['realname']:$user['nickname']); ?>">
                    </div>
                </div>
            </div>
            
            <div class="myorder p">
                <div class="content30">
                    <div class="lsu">
                        <span class="firde">手机号</span>
                        <input type="text" name="mobile" id="mobile" value="<?php echo $user['mobile']; ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="applyandreyurn ma-to-30">
        <button onclick="btnSubmit()" class="applymoney">申请退款</button>
    </div>
</div>
<div class="y_hadgetgoods">
    <div class="reminder">
        <div class="maleri30 bop">
            <div class="message">
                <p>若您对已收到的货的商品质量不满意，您可以提交返修/退换货申请，订单状态将自动设置为"已完成"</p>
            </div>
        </div>
    </div>
    <div class="reminder reminder_r">
        <div class="maleri30">
            <div class="message">
                <p>您的商品已出库，订单拦截可能不成功，您可到订单详情页关注最新进度。</p>
            </div>
        </div>
    </div>
    <div class="applyandreyurn ma-to-30">
        <a href="">申请返修/退换货</a>
    </div>
</div>
<!--取消订单-s-->
<div class="losepay closeorder">
    <div class="maleri30">
        <div class="l_top">
            <span>取消原因</span>
            <em class="turenoff"></em>
        </div>
        <div class="resonco">
            <div class="radio">
                <span class="che">
                    <i></i>
                    <span>订单不能按时送达</span>
                </span>
            </div>
            <div class="radio">
                <span class="che">
                    <i></i>
                    <span>操作有误(商品、地址等选错)</span>
                </span>
            </div>
            <div class="radio">
                <span class="che">
                    <i></i>
                    <span>重复下单/误下单</span>
                </span>
            </div>
            <div class="radio">
                <span class="che">
                    <i></i>
                    <span>其他渠道价格更低</span>
                </span>
            </div>
            <div class="radio">
                <span class="che">
                    <i></i>
                    <span>该商品降价了</span>
                </span>
            </div>
            <div class="radio">
                <span class="che">
                    <i></i>
                    <span>不想买了</span>
                </span>
            </div>
            <div class="radio">
                <span class="che">
                    <i></i>
                    <span>其他原因</span>
                </span>
            </div>
        </div>
    </div>	
    <a href="javascript:;" onclick="btnConfirm()"><div class="submits_de">确定</div></a>
</div>
<!--取消订单-e-->
<div class="mask-filter-div" style="display: none;"></div>
<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(function(){
        //弹出层
        $('.returnreson').click(function(){
            $('.mask-filter-div').show();
            $('.losepay').show();
        });
        $('.turenoff').click(function(){
            $('.mask-filter-div').hide();
            $('.losepay').hide();
        });
        //未/已收到货切换
        $('.item_ask_2 .n').click(function(){
            $(this).addClass('action').siblings().removeClass('action');
            $('.n_hadgetgoods').show();
            $('.y_hadgetgoods').hide();
        });
        $('.item_ask_2 .y').click(function(){
            $(this).addClass('action').siblings().removeClass('action');
            $('.n_hadgetgoods').hide();
            $('.y_hadgetgoods').show();
        });
        $('.che').on('click', function() {
           if ($(this).hasClass('check_t')) {
               $('.check_t').removeClass('check_t');
               $(this).addClass('check_t');
           }
           if ($('.check_t').length > 0) {
               $('.submits_de').addClass('bagrr');
           } else {
               $('.submits_de').removeClass('bagrr');
           }
        });
        $('.turenoff').on('click', function () {
            if ($('.check_t span').text() !== '') {
                $('#user_note').text($('.check_t span').text());
            }
        });
    });
    function btnSubmit() {
        $.ajax({
            url:"<?php echo U('Order/record_refund_order'); ?>",
            method:'POST',
            data: {
                'order_id' : "<?php echo $order['order_id']; ?>",
                'user_note' : $('#user_note').text(),
                'consignee' : $('#consignee').val(),
                'mobile' :    $('#mobile').val()
            },
            dataType:'json',
            error: function () {
               
                layer.open({content:"服务器繁忙, 请联系管理员!", time:2});
            },
            success: function (data) {
                //console.log(data);
                
                if (data.status == 1) {
                    layer.open({content:data.msg, time:2});
                    
                    location.href = "<?php echo U('Order/order_list'); ?>";
                } else {
                    layer.open({content:data.msg, time:2});
                  
                }
            }
        });
    }
    function btnConfirm() {
        if ($('.submits_de').hasClass('bagrr')) {
            $('.turenoff').click();
        }
    }
</script>
</body>
</html>
