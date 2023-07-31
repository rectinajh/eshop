<?php

namespace app\common\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use app\common\model\RecognizeTrade;

class Recognize extends Command
{
    protected function configure()
    {
        $this->setName('check')->setDescription('检查众筹/认筹订单未支付的任务');
    }

    protected function execute(Input $input, Output $output)
    {
        $recognizeTrade = RecognizeTrade::all(function ($query) {
            $query->where('status', 0);
        });
        foreach ($recognizeTrade as $key => $trade) {
            $interval = time() - $trade->getData('create_time');
            if ($interval > 1800) {
                $result = action('common/Recognize/cancelTrade', array($trade->id), 'logic', true);
                if ($result['code'] == 0) {
                    error_log(date('Y-m-d H:i:s') . ' 交易id:'. $trade->id . "自动取消失败\n", 3, 'cancel_recognize.log');
                    $output->writeln(date('Y-m-d H:i:s') . ' 交易id:'. $trade->id . "自动取消失败");
                } else {
                    error_log(date('Y-m-d H:i:s') . ' 交易id:'. $trade->id . "自动取消成功\n", 3, 'cancel_recognize.log');
                    $output->writeln(date('Y-m-d H:i:s') . ' 交易id:'. $trade->id . "自动取消成功");
                }
            }
        }
    }
}
