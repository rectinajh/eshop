<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:49:"./template/mobile/default/order/comment_list.html";i:1532529448;s:44:"./template/mobile/default/public/header.html";i:1532529448;s:44:"./template/mobile/default/public/footer.html";i:1532529448;}*/ ?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />

    <title>评论晒单--<?php echo $tpshop_config['shop_info_store_title']; ?> - www.ohbbs.cn 欧皇源码论坛 </title>

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


<form id="add_comment" method="post" enctype="multipart/form-data" action="<?php echo U('Mobile/Order/addComment'); ?>">

    <input type="hidden" name="order_id" value="<?php echo $order_info['order_id']; ?>">

    <input type="hidden" name="goods_id" value="<?php echo $no_comment_goods['goods_id']; ?>">

    <input type="hidden" name="spec_key_name" value="<?php echo $no_comment_goods['spec_key_name']; ?>">

    <input type="hidden" name="anonymous"  value="0">

<!--顶部-s-->

    <div class="classreturn loginsignup">

        <div class="content">

            <div class="ds-in-bl return">

                <a href="javascript:history.back(-1);"><img src="__STATIC__/images/newBack.png" alt="返回"></a>

            </div>

            <div class="ds-in-bl search ">

                <span>评价晒单</span>

            </div>

            <div class="ds-in-bl menu">

                <a class="submit_com" href="javascript:void(0);" onclick="return validate_comment()">提交</a>

            </div>

        </div>

    </div>
<div style="height: 1.92rem;"></div>
<!--顶部-e-->

<!--评分-s-->

    <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$no_comment_goods['goods_id'])); ?>">

        <div class="sp_idear">

            <div class="maleri30">

                <img src="<?php echo goods_thum_images($no_comment_goods['goods_id'],100,100); ?>"/>



                <div class="com_igy p">

                    <p class="confine-wsp"><?php echo $no_comment_goods['goods_name']; ?></p>



                    <p class="confine-wsp  shuxg"><?php echo $no_comment_goods['spec_key_name']; ?></p>

                </div>

            </div>

        </div>

    </a>

<!--评分-e-->

<!--评论-s-->

    <div class="customer-messa comm_text_goods">

        <div class="maleri30">

            <textarea class="tapassa" onkeyup="checkfilltextarea('.tapassa','500')" id="content_13" name="content" placeholder="写下购买体会和使用感受来帮助其他小伙伴~                    评价大于20元的商品超过10个字就有机会获得积分~"></textarea>

            <span class="xianzd"><em id="zero">500</em>/500</span>

        </div>

    </div>

<!--评论-e-->

<!--上传图片-s-->

    <div class="seravetype">

        <div class="maleri30">

            <ul id="imglen">

                <label>

                    <li class="file">

                        <div class="shcph" id="fileList0">

                            <img src="__STATIC__/images/camera.png">

                        </div>

                        <input  type="file" accept="image/*" name="comment_img_file[]"  onchange="handleFiles(this,0)" style="display:none">

                    </li>

                </label>

                <label>

                    <li class="file">

                        <div class="shcph" id="fileList1">

                            <img src="__STATIC__/images/camera.png">

                        </div>

                        <input  type="file" accept="image/*" name="comment_img_file[]"  onchange="handleFiles(this,1)" style="display:none">

                    </li>

                </label>

                <label>

                    <li class="file">

                        <div class="shcph" id="fileList2">

                            <img src="__STATIC__/images/camera.png">

                        </div>

                        <input  type="file" accept="image/*" name="comment_img_file[]"  onchange="handleFiles(this,2)" style="display:none">

                    </li>

                </label>

                <label>

                    <li class="file">

                        <div class="shcph" id="fileList3">

                            <img src="__STATIC__/images/camera.png">

                        </div>

                        <input  type="file" accept="image/*" name="comment_img_file[]"  onchange="handleFiles(this,3)" style="display:none">

                    </li>

                </label>

                <label>

                    <li class="file">

                        <div class="shcph" id="fileList4">

                            <img src="__STATIC__/images/camera.png">

                        </div>

                        <input  type="file" accept="image/*" name="comment_img_file[]"  onchange="handleFiles(this,4)" style="display:none">

                    </li>

                </label>

            </ul>

            <div class="inspectrepot p">

                <div class="radio">

                    <span class="che" onclick="hideUserName(this)">

                        <input type="checkbox" name="anonymous" style="display:none;" id="hide_username" value="1">

                        <i></i>

                        <span>匿名评价</span>

                    </span>

                </div>

            </div>

        </div>

    </div>

<!--上传图片-e-->

<!--服务评价-s-->

    <div class="wlcomenser ma-to-20">

        <div class="maleri30">

            <div class="p_zyft p">

                <p class="fl">评分</p>

                <p class="fr lifi">满意请给5分哦</p>

            </div>

        </div>

    </div>

    <div class="thirs_commen">

        <div class="maleri30">

            <?php if($order_info['is_comment'] == 0): ?>

                <div class="al_comentaid p">

                    <div class="taidh">与描述相符</div>

                    <div class="star_click">

                   <span class="comment-item-star_wr" title="1">

                        <span class="real-star_wr"></span>

                    </span>

                    <span class="comment-item-star_wr" title="2">

                        <span class="real-star_wr"></span>

                    </span>

                    <span class="comment-item-star_wr" title="3">

                        <span class="real-star_wr"></span>

                    </span>

                    <span class="comment-item-star_wr" title="4">

                        <span class="real-star_wr"></span>

                    </span>

                    <span class="comment-item-star_wr" title="5">

                        <span class="real-star_wr"></span>

                    </span>

                        <input name="store_packge_hidden" value="0" type="hidden">

                    </div>

                </div>

                <div class="al_comentaid p">

                    <div class="taidh">卖家服务</div>

                    <div class="star_click">

                   <span class="comment-item-star_wr" title="1">

                        <span class="real-star_wr"></span>

                    </span>

                    <span class="comment-item-star_wr" title="2">

                        <span class="real-star_wr"></span>

                    </span>

                    <span class="comment-item-star_wr" title="3">

                        <span class="real-star_wr"></span>

                    </span>

                    <span class="comment-item-star_wr" title="4">

                        <span class="real-star_wr"></span>

                    </span>

                    <span class="comment-item-star_wr" title="5">

                        <span class="real-star_wr"></span>

                    </span>

                        <input name="store_speed_hidden" value="0" type="hidden">

                    </div>

                </div>

                <div class="al_comentaid p">

                    <div class="taidh">物流服务</div>

                    <div class="star_click">

                    <span class="comment-item-star_wr" title="1">

                        <span class="real-star_wr"></span>

                    </span>

                    <span class="comment-item-star_wr" title="2">

                        <span class="real-star_wr"></span>

                    </span>

                    <span class="comment-item-star_wr">

                        <span class="real-star_wr" title="3"></span>

                    </span>

                    <span class="comment-item-star_wr" title="4">

                        <span class="real-star_wr"></span>

                    </span>

                    <span class="comment-item-star_wr" title="5">

                        <span class="real-star_wr"></span>

                    </span>

                        <input name="store_sever_hidden" value="0" type="hidden">

                    </div>

                </div>

            <?php endif; ?>

            <div class="al_comentaid p">

                <div class="taidh">商品满意度</div>

                <div class="star_click">

                    <span class="comment-item-star_wr" title="1">

                        <span class="real-star_wr"  ></span>

                    </span>

                    <span class="comment-item-star_wr" title="2">

                        <span class="real-star_wr"  ></span>

                    </span>

                    <span class="comment-item-star_wr" title="3">

                        <span class="real-star_wr"  ></span>

                    </span>

                    <span class="comment-item-star_wr" title="4">

                        <span class="real-star_wr"  ></span>

                    </span>

                    <span class="comment-item-star_wr" title="5">

                        <span class="real-star_wr"  ></span>

                    </span>

                    <input name="rank" value="0" type="hidden">

                </div>

            </div>

        </div>

    </div>

<!--服务评价-e-->

</form>
<!--底部导航-start-->

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

        <!--底部导航-end-->
<script src="__STATIC__/js/style.js" type="text/javascript" charset="utf-8"></script>

<script src="__PUBLIC__/js/layer/layer.js"></script>

<script type="text/javascript">

    $(function(){

        //评分

        $('.comment-item-star_wr').click(function(e){

            var obj = $(this);

            obj.find('span').addClass('comment-stars-width5');

            obj.prevAll().find('span').addClass('comment-stars-width5').parent();

            obj.nextAll().find('span').removeClass('comment-stars-width5');

            obj.siblings('input').val(obj.attr('title'));

        })

    })

    function hideUserName(obj){

        if($(obj).hasClass('check_t')){

            $('#hide_username').prop('checked',false);

        }else{

            $('#hide_username').prop('checked',true);

        }



    }



    function validate_comment(){

        var content = $("#content_13").val();

        var error = [];

        var img_num = 0;

        var AllImgExt=".jpg|.jpeg|.gif|.bmp|.png|";//全部图片格式类型

        //var title = document.getElementById("title").value;

        if($('.che').hasClass('check_t')){

            $('input[name="anonymous"]').val('1');

        }else{

            $('input[name="anonymous"]').val('0');

        }

        $(".file input").each(function(index){

            FileExt = this.value.substr(this.value.lastIndexOf(".")).toLowerCase();

            if(this.value!=''){

                img_num++;

                if(AllImgExt.indexOf(FileExt+"|")==-1){

                    error.push("第"+(index+1)+"张图片格式错误");

                }

            }

        });

        $(".jsstar input").each(function(index){

            if(this.value == '0'){

            <?php if($order_info['is_comment'] == 0): ?>

                if(this.name == 'store_packge_hidden'){

                    error.push('请给描述评分！');

                };

                if(this.name == 'store_speed_hidden'){

                    error.push('请给服务评分！');

                };

                if(this.name == 'store_sever_hidden'){

                    error.push('请给物流评分！');

                };

            <?php endif; ?>

                if(this.name == 'rank'){

                    error.push('请给商品评分！');

                };

            }

        });

        if(content == ''){

            error.push('评价内容不能为空！');

        }



        if(error.length>0){

            layer.open({content:error, time: 2});

            return false;

        }else{

            $('#add_comment').submit();

        }

    }



    //显示上传照片

    window.URL = window.URL || window.webkitURL;

    function handleFiles(obj,id) {

        console.log(window.URL);

        fileList = document.getElementById("fileList"+id);

        var files = obj.files;

        img = new Image();

        if(window.URL){



            img.src = window.URL.createObjectURL(files[0]); //创建一个object URL，并不是你的本地路径

            img.width = 60;

            img.height = 60;

            img.onload = function(e) {

                window.URL.revokeObjectURL(this.src); //图片加载后，释放object URL

            }

            if(fileList.firstElementChild){

                fileList.removeChild(fileList.firstElementChild);

            }

            fileList.appendChild(img);

            console.log(img);

        }else if(window.FileReader){

            //opera不支持createObjectURL/revokeObjectURL方法。我们用FileReader对象来处理

            var reader = new FileReader();

            reader.readAsDataURL(files[0]);

            reader.onload = function(e){

                img.src = this.result;

                img.width = 60;

                img.height = 60;

                fileList.appendChild(img);

            }

        }else

        {

            //ie

            obj.select();

            obj.blur();

            var nfile = document.selection.createRange().text;

            document.selection.empty();

            img.src = nfile;

            img.width = 60;

            img.height = 60;

            img.onload=function(){



            }

            fileList.appendChild(img);

        }

    }

</script>

</body>

</html>

