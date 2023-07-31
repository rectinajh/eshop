$(function() {
    $.ajax({
        url: '/Mobile/Goldchain/lineChart',
        type: 'GET',
        success: function(res) {
            loadLineChart(res.date, res.value);
            console.log(res);
        }
    });
    function loadLineChart(hours, values) {
        option2 = {
            // title : {
            //     text: '未来一周气温变化',
            //     subtext: '纯属虚构'
            // },
            tooltip : {
                trigger: 'axis',
                extraCssText:'font-size:30',
                textStyle: {
                    // fontSize: 20,
                    fontFamily: 'microsoft yahei light',
                },
            },
            legend: {
                // data:['最高气温','最低气温']
            },
            toolbox: {
                show : false,
                feature : {
                    mark : {show: true},
                    dataView : {show: true, readOnly: false},
                    magicType : {show: true, type: ['line', 'bar']},
                    restore : {show: true},
                    saveAsImage : {show: true}
                }
            },
            calculable : true,
            xAxis : [
                {
                    type : 'category',
                    boundaryGap : false,
                    // axisLabel: {fontSize:22},
                    data :hours
                }
            ],
            yAxis : [
                {
                    type : 'value',
                    // axisLabel: {fontSize:22}
                    // axisLabel : {
                    //     formatter: '{value} °C'
                    // }
                }
            ],
            series : [
                {
                    name:'价格',
                    type:'line',
                    data:values
                },
            ]
        };
        var weChart2 = echarts.init(document.getElementById("chart2")); 
        weChart2.setOption(option2);  
    }
});
