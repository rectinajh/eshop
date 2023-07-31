$(function () {
    var tips = [ "0.1颗链豆", "0.2颗链豆", "0.3颗链豆", "0.2颗链豆","1颗链豆"],//中奖提示
        $ring = $(".ring"),
        $prize = $(".prize"),//转盘
        $btn = $("#btn"),//按钮
        $chance = $("#chance"),//显示剩余抽奖机会
        $li = $(".success li"),//中奖信息滚动的盒子
        $sNum = $(".start-num"),//手机头号，三位数
        $eNum = $(".end-num"),//手机尾号，四位数
        $info = $(".info"),//中奖提示信息
        lotteryChance =  parseInt($chance.html()),//次数
        bool = false,//判断是否在旋转，true表示是，false表示否
        timer;//定时器
    init();
    function init() {
        timer = setInterval(function () {
            $ring.toggleClass("light");
        }, 1000);
    }

    //点击抽奖
    $btn.click(function () {
        if (bool) return false; // 如果在执行就退出
        bool = true; // 标志为 在执行
        lottery_click();
        /*
        layer.open({content:"抱歉，抽奖暂未开放",time:3});
        return false;
        */      
    });

    function lottery_click() {
        if (lotteryChance <= 0) { //当抽奖次数为0时
            $chance.html(0);//次数显示为0
            bool = false;
            layer.open({content:"没有次数了，推广好友注册可获得抽奖次数",time:3});
        } else {
            //还有次数就执行
            lotteryChance--;
            lotteryChance <= 0 && (lotteryChance = 0);
            $chance.html(lotteryChance);//显示剩余次数
            $prize.removeClass("running");
            $.ajax({
                url: '/mobile/lottery/prizeDraw',
                type: 'GET',
                data: {},
                success: function (res) {
                    if (res.code == 1) {
                        rotateFn(180, res.data.prize_value + '颗链豆');
                    } else {
                        layer.open({
                            content: res.msg
                        });
                    }
                }
            });
        }
    }

    //选中函数。参数：奖品序号、角度、提示文字
    function rotateFn(angle, text) {
        bool = true;
        $prize.stopRotate();
        $prize.rotate({
            angle: 0,//旋转的角度数
            duration: 4000, //旋转时间
            animateTo: angle + 1440, //给定的角度,让它根据得出来的结果加上1440度旋转。也就是至少转4圈
            callback: function () {
                bool = false; // 标志为 执行完毕
                win(text);            
            }
        });
    }

    //中奖信息提示
    $("#close,.win,.btn").click(function () {
        init();
    });
});

