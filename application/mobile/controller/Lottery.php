<?php

namespace app\mobile\controller;

use think\Db;
use think\Controller;
use think\Request;
use app\common\model\LotteryRecord;
use app\common\model\LotteryChance;

class Lottery extends Controller
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
            if (isset($user['user_id'])) {
                $user = get_user_info($user['user_id']);
                session('user', $user);  //覆盖session 中的 user
                $this->user = $user;
                $this->user_id = $user['user_id'];
                $this->assign('user', $user); //存储用户信息
            } else {
                $this->user_id = 0;
            }
        }
        $nologin = array();
        if (!$this->user_id && !in_array(ACTION_NAME, $nologin)) {
            header("location:" . U('Mobile/User/login'));
            exit;
        }
    }

    public function index()
    {
        $lottery = action('common/Lottery/getAvailableLottery', array(), 'logic', true);
        $userId = $this->user_id;
        if (!$lottery) {
            $chance = 0;
        } else {
            $lotteryChance = new LotteryChance();
            $chance = $lotteryChance->getUserChance($userId, $lottery->id);
            $chance = $chance['remain_chance'];
        }
        $record = $lottery->record()->order('id', 'desc')->limit(30)->select(); //只显示最近50条
        $this->assign('record', $record);
        $this->assign('lottery', $lottery);
        $this->assign('chance', $chance);
        return $this->fetch();
    }

    public function prizeDraw()
    {
        $result = action('common/Lottery/luckyDraw', array($this->user_id), 'logic', true);
        return json($result);
    }

    private function daozhang()
    {
        echo '执行开始' . "\n";
        $lotteryRecord = LotteryRecord::where('status', 0)->select();
        
        foreach ($lotteryRecord as $key => $value) {
            Db::startTrans();
            $number = $value->prize_value;
            $user_id = $value->user_id;
            $result = accountLog(
                $user_id,
                0,
                0,
                '抽奖活动,喜中' . $number . '个新淘链',
                0,
                $lotteryResult->id,
                '',
                0,
                0,
                $number
            );
            if (!$result) {
                Db::rollback();
                error_log(date('Y-m-d H:i:s'). $user_id . '处理抽奖到账失败' . "\n", 3, RUNTIME_PATH.'daozhang.log');
            }
            $value->status = 1;
            $value->create_time = time();
            $value->complete_time = time();
            $res = $value->save();
            if (!$res) {
                Db::rollback();
                error_log(date('Y-m-d H:i:s'). $user_id . '变更投奖到账记录状态失败' . "\n", 3, RUNTIME_PATH.'daozhang.log');
            }
            Db::commit();
        }
        echo '执行完成' . "\n";
    }
}
