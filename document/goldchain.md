### **验证支付密码**
### 请求URL:  
*/Mobile/goldchain/validateSafePassword/* 
### 请求方式:POST 
### 请求参数  
参数|是否必填|说明 | 类型
--|--|--|--
password|是|支付密码|文本
### 返回格式:JSON  
```
{
    "code": 0, //0.失败 1.成功
    "msg": '提示信息',
    "data": null
}
```
### **挂买新淘链**
### 请求URL:  
*/Mobile/goldchain/buy/* 
### 请求方式:POST 
### 请求参数  
参数|是否必填|说明 | 类型
--|--|--|--
buy_qty|是|购买数量|float
price|是|购买单价|float
### 返回格式:JSON  
```
{
    "code" : 1, //1.成功 0.失败
    "msg" : "提示信息",
    "data" : null,
}
```
### **挂卖新淘链**
### 请求URL:  
*/Mobile/goldchain/sold/* 
### 请求方式:POST 
### 请求参数  
参数|是否必填|说明|类型
--|--|--|--
sold_qty|是|购买数量|数值
price|是|购买单价|数值
### 返回格式:JSON  
```
{
    "code" : 1, //1.成功 0.失败
    "msg" : "提示信息",
    "data" : null,
}
```
### **撤销挂卖**
### 请求URL:  
*/Mobile/goldchain/cancelTrade/* 
### 请求方式:POST 
### 请求参数  
参数|是否必填|说明|类型
--|--|--|--
trade_id|是|交易id|整数
### 返回格式:JSON  
```
{
    "code" : 1, //1.成功 0.失败
    "msg" : "提示信息",
    "data" : null,
}
```
### **从指定交易买入新淘链**
### 请求URL:  
*/Mobile/goldchain/buyTrade/* 
### 请求方式:POST 
### 请求参数  
参数|是否必填|说明|类型
--|--|--|--
trade_id|是|交易id|整数
### 返回格式:JSON  
```
{
    "code" : 1, //1.成功 0.失败
    "msg" : "提示信息",
    "data" : $trade, //成功返回订单信息,失败返回null
}
```
### **从指定交易卖出新淘链**
### 请求URL:  
*/Mobile/goldchain/soldTrade/* 
### 请求方式:POST 
### 请求参数  
参数|是否必填|说明|类型
--|--|--|--
trade_id|是|交易id|整数
### 返回格式:JSON  
```
{
    "code": 0,
    "msg": "交易异常:不允许向自己交易",
    "data": null
}
```
### **获取新淘链买入列表(交易大厅)**
### 请求URL:  
*/Mobile/goldchain/buyList/* 
### 请求方式:GET 
### 请求参数  
参数|是否必填|说明|类型
--|--|--|--
startTime|否|开始时间|日期格式字符串
endTime|否|结束时间|日期格式字符串
### 返回格式:JSON  
```
[
    {
        "id": 8,
        "trade_no": "TR201804241141384404", //订单号
        "type": 0, //是否是委托交易
        "way": 2, //1.卖出 2.买入
        "user_id": 5, //发起交易用户id
        "relation_user_id": 0, //接受交易用户id
        "sold_entrust_id": 0, //卖出委托业务id
        "buy_entrust_id": 0, //买入委托业务id
        "trade_qty": "1.000000", //交易数量
        "price": "1.00000000", //单价
        "amount": "1.00000000", //金额
        "status": 0, //状态[0.未完成 1.已完成 2.已取消]
        "create_time": "2018-04-24 11:41:38", //业务创建时间
        "complete_time": null //业务完成时间
    },
    {
        "id": 10,
        "trade_no": "TR201804241309533520",
        "type": 0,
        "way": 2,
        "user_id": 5,
        "relation_user_id": 0,
        "sold_entrust_id": 0,
        "buy_entrust_id": 0,
        "trade_qty": "2.000000",
        "price": "11.10000000",
        "amount": "22.20000000",
        "status": 0,
        "create_time": "2018-04-24 13:09:53",
        "complete_time": null
    }
]
```
### **获取新淘链卖出列表(交易大厅)**
### 请求URL:  
*/Mobile/goldchain/soldList/*
### 请求方式:GET  
### 请求参数  
参数|是否必填|说明|类型
--|--|--|--
startTime|否|开始时间|日期格式字符串
endTime|否|结束时间|日期格式字符串
### 返回格式:JSON  
```
[
    {
        "id": 9,
        "trade_no": "TR201804241141384404", //订单号
        "type": 0, //是否是委托交易
        "way": 1, //1.卖出 2.买入
        "user_id": 5, //发起交易用户id
        "relation_user_id": 0, //接受交易用户id
        "sold_entrust_id": 0, //卖出委托业务id
        "buy_entrust_id": 0, //买入委托业务id
        "trade_qty": "1.000000", //交易数量
        "price": "1.00000000", //单价
        "amount": "1.00000000", //金额
        "status": 0, //状态[0.未完成 1.已完成 2.已取消]
        "create_time": "2018-04-24 11:41:38", //业务创建时间
        "complete_time": null //业务完成时间
    }
]
```
### **我的卖出需求**
### 请求URL:  
*/Mobile/goldchain/myBuyList/* 
### 请求方式:GET 
### 请求参数  
参数|是否必填|说明|类型
--|--|--|--
status|否|状态[不填或-1.取所有,0.未完成,1.已完成,2.已取消]|整数
startTime|否|开始时间|日期格式字符串
endTime|否|结束时间|日期格式字符串
### 返回格式:JSON  
```
[
    {
        "id": 8,
        "trade_no": "TR201804241141384404", //订单号
        "type": 0, //是否是委托交易
        "way": 2, //1.卖出 2.买入
        "user_id": 5, //发起交易用户id
        "relation_user_id": 0, //接受交易用户id
        "sold_entrust_id": 0, //卖出委托业务id
        "buy_entrust_id": 0, //买入委托业务id
        "trade_qty": "1.000000", //交易数量
        "price": "1.00000000", //单价
        "amount": "1.00000000", //金额
        "status": 0, //状态[0.未完成 1.已完成 2.已取消]
        "create_time": "2018-04-24 11:41:38", //业务创建时间
        "complete_time": null //业务完成时间
    }
]
```
### **我的买入需求**
### 请求URL:  
*/Mobile/goldchain/mySoldList/* 
### 请求方式:POST 
### 请求参数  
参数|是否必填|说明|类型
--|--|--|--
status|否|状态[不填或-1.取所有,0.未完成,1.已完成,2.已取消,]|整数
startTime|否|开始时间|日期格式字符串
endTime|否|结束时间|日期格式字符串
### 返回格式:JSON  
```
[
    {
        "id": 8,
        "trade_no": "TR201804241141384404", //订单号
        "type": 0, //是否是委托交易
        "way": 2, //1.卖出 2.买入
        "user_id": 5, //发起交易用户id
        "relation_user_id": 0, //接受交易用户id
        "sold_entrust_id": 0, //卖出委托业务id
        "buy_entrust_id": 0, //买入委托业务id
        "trade_qty": "1.000000", //交易数量
        "price": "1.00000000", //单价
        "amount": "1.00000000", //金额
        "status": 0, //状态[0.未完成 1.已完成 2.已取消]
        "create_time": "2018-04-24 11:41:38", //业务创建时间
        "complete_time": null //业务完成时间
    }
]
```
### **我的卖出交易**
### 请求URL:  
*/Mobile/goldchain/myBuyTradeList/* 
### 请求方式:POST 
### 请求参数  
参数|是否必填|说明|类型
--|--|--|--
startTime|否|开始时间|日期格式字符串
endTime|否|结束时间|日期格式字符串
### 返回格式:JSON  
```
[
    {
        "id": 8,
        "trade_no": "TR201804241141384404", //订单号
        "type": 0, //是否是委托交易
        "way": 2, //1.卖出 2.买入
        "user_id": 5, //发起交易用户id
        "relation_user_id": 0, //接受交易用户id
        "sold_entrust_id": 0, //卖出委托业务id
        "buy_entrust_id": 0, //买入委托业务id
        "trade_qty": "1.000000", //交易数量
        "price": "1.00000000", //单价
        "amount": "1.00000000", //金额
        "status": 0, //状态[0.未完成 1.已完成 2.已取消]
        "create_time": "2018-04-24 11:41:38", //业务创建时间
        "complete_time": null //业务完成时间
    }
]
```
### **我的买入交易**
### 请求URL:  
*/Mobile/goldchain/mySoldTradeList/* 
### 请求方式:POST 
### 请求参数  
参数|说明|是否必填| 类型
--|--|--|--
startTime|否|开始时间|日期格式字符串
endTime|否|结束时间|日期格式字符串
### 返回格式:JSON  
```
[
    {
        "id": 8,
        "trade_no": "TR201804241141384404", //订单号
        "type": 0, //是否是委托交易
        "way": 2, //1.卖出 2.买入
        "user_id": 5, //发起交易用户id
        "relation_user_id": 0, //接受交易用户id
        "sold_entrust_id": 0, //卖出委托业务id
        "buy_entrust_id": 0, //买入委托业务id
        "trade_qty": "1.000000", //交易数量
        "price": "1.00000000", //单价
        "amount": "1.00000000", //金额
        "status": 0, //状态[0.未完成 1.已完成 2.已取消]
        "create_time": "2018-04-24 11:41:38", //业务创建时间
        "complete_time": null //业务完成时间
    }
]
```
### **我的买入交易**
### 请求URL:  
*/Mobile/goldchain/getPrice/* 
### 请求方式:GET 
### 请求参数  
参数|说明|是否必填| 类型
--|--|--|--
无|||
### 返回格式:JSON  
```
{
    "price": 8, //单价 
    "jin_num": 10, //数量
    "value": 80, //价值
}
```