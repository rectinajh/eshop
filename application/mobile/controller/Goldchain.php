<?php
/**
 * 新淘链API接口
 * Author: 新淘链
 */
namespace app\mobile\controller;

use think\Db;
use think\Request;
use app\common\model\GoldchainTrade;
use app\common\model\Users;

class Goldchain extends MobileBase
{
    public $user_id = 0;
    public $user = array();
    
    /*
     * 初始化操作
     */
    public function _initialize()
    {
        parent::_initialize();
        if (session('?user')) {
            $user = session('user');
            $user = M('users')->where("user_id", $user['user_id'])->find();
            session('user', $user);  //覆盖session 中的 user
            $this->user = $user;
            $this->user_id = $user['user_id'];
            $this->assign('user', $user); //存储用户信息
        }
        $nologin = array();
        if (!$this->user_id && !in_array(ACTION_NAME, $nologin)) {
            header("location:" . U('Mobile/User/login'));
            exit;
        }
        $this->assign('order_status_coment', $order_status_coment);
    }

    /**
     * 我要买入
     */
    public function buy(Request $request)
    {
        config('default_ajax_return', 'json');
        if ($request->isPost()) {
            $post = $request->post();
            $data = action('common/Goldchain/addTrade', array(GoldchainTrade::TRADE_BUY_WAY, $this->user_id, $post['buy_qty'], $post['price']), 'logic', true);
            return json($data);
        } else {
            $this->error('非法提交');
        }
    }

    /**
     * 我要卖出
     */
    public function sold(Request $request)
    {
        config('default_ajax_return', 'json');
        if ($request->isPost()) {
            $post = $request->post();
            $data = action('common/Goldchain/addTrade', array(GoldchainTrade::TRADE_SOLD_WAY, $this->user_id, $post['sold_qty'], $post['price']), 'logic', true);
            return json($data);
        } else {
            $this->error('非法提交');
        }
    }

    /**
     * 从指定交易买入(买别人卖的)
     */
    public function buyTrade(Request $request)
    {
        if ($request->isPost()) {
            $post = $request->post();
            $trade_id = $post['trade_id'];
            $goldchainTrade = GoldchainTrade::get($trade_id);
            if ($goldchainTrade->way != 1) {
                return json(array(
                    'code' => 0,
                    'msg' => '该笔交易不是卖出,不能买入',
                    'data' => null,
                ));
            }
            $data = action('common/Goldchain/handleTrade', array($trade_id, $this->user_id, 1), 'logic', true);
            return json($data);
        } else {
            $this->error('非法请求');
        }
    }

    /**
     * 从指定交易卖出(卖给求购的人)
     */
    public function soldTrade(Request $request)
    {
        if ($request->isPost()) {
            $post = $request->post();
            $trade_id = $post['trade_id'];
            $goldchainTrade = GoldchainTrade::get($trade_id);
            if ($goldchainTrade->way != 2) {
                return json(array(
                    'code' => 0,
                    'msg' => '该笔交易不是买入,不能向其卖出',
                    'data' => null,
                ));
            }
            $data = action('common/Goldchain/handleTrade', array($trade_id, $this->user_id, 1), 'logic', true);
            return json($data);
        } else {
            $this->error('非法请求');
        }
    }

    /**
     * 买入需求列表(交易大厅)
     */
    public function buyList(Request $request)
    {
        if ($request->isGet()) {
            $limit = $request->has('limit') ? $request->param('limit') : 1000;
            $goldchainTrade = GoldchainTrade::where(function ($query) use ($request) {
                $startTime = $request->has('startTime') ? strtotime($request->param('startTime')) : 0;
                $endTime = $request->has('endTime') ? strtotime($request->param('endTime')) : 0;
                $startTime !== 0 && $query->where('create_time', '>=', $startTime);
                $endTime !== 0 && $query->where('create_time', '<=', $endTime);
                $query->where('way', 2)->where('status', 0);
            })->order('price')->order('create_time', 'desc')->paginate($limit);
            return json(collection($goldchainTrade->items()));
        } else {
            $this->error('非法请求');
        }
    }

    /**
     * 卖出需求列表(交易大厅)
     */
    public function soldList(Request $request)
    {
        config('default_ajax_return', 'json');
        if ($request->isGet()) {
            $limit = $request->has('limit') ? $request->param('limit') : 1000;
            $goldchainTrade = GoldchainTrade::where(function ($query) use ($request) {
                $startTime = $request->has('startTime') ? strtotime($request->param('startTime')) : 0;
                $endTime = $request->has('endTime') ? strtotime($request->param('endTime')) : 0;
                $startTime !== 0 && $query->where('create_time', '>=', $startTime);
                $endTime !== 0 && $query->where('create_time', '<=', $endTime);
                $query->where('way', 1)->where('status', 0);
            })->order('price')->order('create_time', 'desc')->paginate($limit);
            return json(collection($goldchainTrade->items()));
        } else {
            $this->error('非法请求');
        }
    }

    /**
     * 我发布的买入需求
     */
    public function myBuyList(Request $request)
    {
        if ($request->isGet()) {
            $limit = $request->has('limit') ? $request->param('limit') : 1000;
            $goldchainTrade = GoldchainTrade::where(function ($query) use ($request) {
                $status = $request->has('status') ? $request->param('status') : -1;
                $startTime = $request->has('startTime') ? strtotime($request->param('startTime')) : 0;
                $endTime = $request->has('endTime') ? strtotime($request->param('endTime')) : 0;
                $startTime !== 0 && $query->where('create_time', '>=', $startTime);
                $endTime !== 0 && $query->where('create_time', '<=', $endTime);
                $query->where('user_id', $this->user_id)->where('way', GoldchainTrade::TRADE_BUY_WAY);
                $status != -1 && $query->where('status', $status); //状态过滤
            })->order('create_time', 'desc')->paginate($limit);
            return json(collection($goldchainTrade->items()));
        } else {
            $this->error('非法请求');
        }
    }

    /**
     * 我发布的卖出需求
     */
    public function mySoldList(Request $request)
    {
        if ($request->isGet()) {
            $limit = $request->has('limit') ? $request->param('limit') : 1000;
            $goldchainTrade = GoldchainTrade::where(function ($query) use ($request) {
                $status = $request->has('status') ? $request->param('status') : -1;
                $startTime = $request->has('startTime') ? strtotime($request->param('startTime')) : 0;
                $endTime = $request->has('endTime') ? strtotime($request->param('endTime')) : 0;
                $startTime !== 0 && $query->where('create_time', '>=', $startTime);
                $endTime !== 0 && $query->where('create_time', '<=', $endTime);
                $query->where('user_id', $this->user_id)->where('way', GoldchainTrade::TRADE_SOLD_WAY);
                $status != -1 && $query->where('status', $status); //状态过滤
            })->order('create_time', 'desc')->paginate($limit);
            return json(collection($goldchainTrade->items()));
        } else {
            $this->error('非法请求');
        }
    }

    /**
     * 我的买入记录
     */
    public function myBuyTradeList(Request $request)
    {
        if ($request->isGet()) {
            $limit = $request->has('limit') ? $request->param('limit') : 1000;
            $goldchainTrade = GoldchainTrade::where(function ($query) use ($request) {
                $startTime = $request->has('startTime') ? strtotime($request->param('startTime')) : 0;
                $endTime = $request->has('endTime') ? strtotime($request->param('endTime')) : 0;
                $startTime !== 0 && $query->where('complete_time', '>=', $startTime);
                $endTime !== 0 && $query->where('complete_time', '<=', $endTime);
                $query->where('relation_user_id', $this->user_id)->where('way', GoldchainTrade::TRADE_BUY_WAY);
            })->order('complete_time', 'desc')->paginate($limit);
            return json(collection($goldchainTrade->items()));
        } else {
            $this->error('非法请求');
        }
    }

    /**
     * 我的卖出记录
     */
    public function mySoldTradeList(Request $request)
    {
        if ($request->isGet()) {
            $limit = $request->has('limit') ? $request->param('limit') : 1000;
            $goldchainTrade = GoldchainTrade::where(function ($query) use ($request) {
                $startTime = $request->has('startTime') ? strtotime($request->param('startTime')) : 0;
                $endTime = $request->has('endTime') ? strtotime($request->param('endTime')) : 0;
                $startTime !== 0 && $query->where('complete_time', '>=', $startTime);
                $endTime !== 0 && $query->where('complete_time', '<=', $endTime);
                $query->where('relation_user_id', $this->user_id)->where('way', GoldchainTrade::TRADE_SOLD_WAY);
            })->order('complete_time', 'desc')->paginate($limit);
            return json(collection($goldchainTrade->items()));
        } else {
            $this->error('非法请求');
        }
    }

    /**
     * K线图
     */
    public function kChart(Request $request)
    {
        /*
        array(
            'date' => array(开盘, 收盘, 最低, 最高),
            'num' => array('2018-04-01', '2018-04-02', '2018-04-03', '2018-04-04'),
        );
        */
        /*
        SELECT
        FROM_UNIXTIME(`complete_time`, '%Y-%m-%d') as `date`,
        MAX(`price`) AS `max_price`,
        MIN(`price`) AS `min_price`,
        (SELECT `price` FROM tp_goldchain_trade WHERE id = MIN(A.id)) AS `open_price`,
        (SELECT `price` FROM tp_goldchain_trade WHERE id = MAX(A.id)) AS `close_price`
        FROM tp_goldchain_trade A
        WHERE `status`=1
        GROUP BY `date`
        */
        if ($request->isGet()) {
            //返回指定格式数据
            $openPriceSql = Db::name('goldchain_trade')->field('price')->where('id', 'exp', '=MIN(A.`id`)')->buildSql();
            $closePriceSql = Db::name('goldchain_trade')->field('price')->where('id', 'exp', '=MAX(A.`id`)')->buildSql();
            $result = Db::name('goldchain_trade')->alias('A')->field(array(
                "FROM_UNIXTIME(`complete_time`, '%Y-%m-%d')" => 'date',
                $openPriceSql => 'open_price',
                $closePriceSql => 'close_price',
                "MIN(`price`)" => 'min_price',
                "MAX(`price`)" => 'max_price',
            ))->where(function ($query) use ($request) {
                $startTime = $request->has('startTime') ? $request->param('startTime', 0, 'strtotime') : 0;
                $endTime = $request->has('endTime') ? $request->param('endTime', 0, 'strtotime') : 0;
                $startTime !== 0 && $query->where('complete_time', '>=', $startTime);
                $endTime !== 0 && $query->where('complete_time', '<=', $endTime);
                $query->where('status', 1);
            })->group('date')->select();
            $date = array();
            $data = array();
            foreach ($result as $key => $value) {
                $date[] = $value['date'];
                $data[] = array(
                    $value['open_price'],
                    $value['close_price'],
                    $value['min_price'],
                    $value['max_price'],
                );
            }
            return json(array(
                'date' => $date,
                'data' => $data,
            ));
        } else {
            $this->error('非法请求');
        }
    }

    /**
     * 折线图
     */
    public function lineChart(Request $request)
    {
        if ($request->isGet()) {
            $max = date('H');
            $time = date('Y-m-d');
            $base = strtotime($time);
            $data = array();
            $date = array();
            $values = array();
            for ($i=0; $i <= $max; $i++) {
                $trade = GoldchainTrade::where(function ($query) use ($base, $i) {
                    $time = $base + ($i + 1) * 3600;
                    $query->where('complete_time', '<', $time);
                })->order('complete_time', 'desc')->order('id', 'desc')->find();
                $date[] = $i . '点';
                $values[] = $trade['price'];
            }
            $data = array(
                'date'=> $date,
                'value' => $values,
            );
            return json($data);
        } else {
            $this->error('非法请求');
        }
    }

    /**
     * 取开始计算状态
     * @return integer 执行过返回1,没执行过返回0
     */
    public function calculate(Request $request)
    {
        $time = strtotime(date('Y-m-d'));
        if ($request->has('update', 'get')) {
            $user = Users::get($this->user_id);
            $user->calculate = time();
            $user->save();
        }
        $user = get_user_info($this->user_id);
        if ($user['calculate'] >= $time) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * 验证支付密码
     * @return array 返回JSON
     */
    public function validateSafePassword(Request $request)
    {
        if ($request->isPost()) {
            $password = $request->param('password');
            $password = encrypt($password);
            $user = Users::get($this->user_id);
            if ($user->paypwd == $password) {
                return json(array(
                    'code' => 1,
                    'msg' => '验证成功',
                    'data' => null,
                ));
            } else {
                return json(array(
                    'code' => 0,
                    'msg' => '验证失败',
                    'data' => null,
                ));
            }
        } else {
            $this->error('非法请求');
        }
    }

    /**
     * 取消用户发起的交易
     * @return array 返回JSON
     */
    public function cancelTrade(Request $request)
    {
        if ($request->isPost()) {
            $trade_id = $request->param('trade_id');
            $result = action('common/Goldchain/cancelTrade', array($trade_id, $this->user_id), 'logic', true);
            return json($result);
        } else {
            $this->error('非法提交');
        }
    }

    /**
     * 获得新淘链单价（其实就是开盘价）
     */
    public function getPrice(Request $request)
    {
        if ($request->isGet()) {
            $res = action('common/Goldchain/getOpenPrice', array(), 'logic', true);
            $user = Users::get($this->user_id);
            $price = number_format($res, config('default_decimal_scale'), '.', '');
            $jin_num = number_format($user->jin_num, config('default_decimal_scale'), '.', '');
            $value = bcmul(
                $price,
                $jin_num,
                config('default_decimal_scale')
            );
            $data = array(
                'price' => $price,
                'jin_num' => $jin_num,
                'value' => $value,
            );
            return json($data);
        } else {
            $this->error('非法提交');
        }
    }
}
