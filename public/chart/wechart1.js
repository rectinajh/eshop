$(function() {
    $.ajax({
        url: '/Mobile/Goldchain/kChart',
        type: 'GET',
        success: function(res) {
            var num = res.data, date = res.date;
            var weChart = echarts.init(document.getElementById("chart1")); 
            option = {
                tooltip : {
                    trigger: 'axis',
                    formatter: function (params) {
                        var res = params[0].seriesName + ' ' + params[0].name;
                        res += '<br/>  开盘 : ' + params[0].value[1] + '  最高 : ' + params[0].value[4];
                        res += '<br/>  收盘 : ' + params[0].value[2] + '  最低 : ' + params[0].value[3];
                        return res;
                    },
                    extraCssText:'font-size:30',
                    textStyle: {
                        // fontSize: 22,
                    },
                },
                toolbox: {
                    show : false,
                    feature : {
                        mark : {show: true},
                        dataZoom : {show: true},
                        dataView : {show: true, readOnly: false},
                        magicType: {show: true, type: ['line', 'bar']},
                        restore : {show: true},
                        saveAsImage : {show: true}
                    }
                },
                dataZoom : {
                    show : true,
                    realtime: true,
                    start : 50,
                    end : 100
                },
                xAxis : [
                    {
                        type : 'category',
                        boundaryGap : true,
                        axisTick: {onGap:false},
                        splitLine: {show:false},
                        // axisLabel: {fontSize:30},
                        data :date
                    }
                ],
                yAxis : [
                    {
                        type : 'value',
                        scale:true,
                        axisLabel: {
                            // fontSize:30
                        },
                        boundaryGap: [0.01, 0.01]
                    }
                ],
                series : [
                    {
                        name:'',
                        type:'k',
                        data:num
                    }
                ]
            };                   
            weChart.setOption(option,true);   
            weChart.on('click', function(param) {
                console.log(param);
                $("#kdatas p").eq(0).children("span").text(param.data[1]);
                $("#kdatas p").eq(1).children("span").text(param.data[4]);
                $("#kdatas p").eq(2).children("span").text(param.data[2]);
                $("#kdatas p").eq(3).children("span").text(param.data[3]);
        
            });
        }
    });
    
});
