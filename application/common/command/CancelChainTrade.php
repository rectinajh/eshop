<?php
namespace app\common\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use app\common\model\GoldchainTrade;

class CancelChainTrade extends Command
{
    protected function configure()
    {
        $this->setName('chain:canceltrade')->setDescription('取消所有未完成挂单');
    }

    protected function execute(Input $input, Output $output)
    {
        $trades = GoldchainTrade::where('status', 0)->select();
        foreach ($trades as $key => $trade) {
            $result = action('common/Goldchain/cancelTrade', array($trade->id, $trade->user_id), 'logic', true);
            var_dump($result);
            if ($result['code'] == 1) {
                $output->writeln(date('Y-m-d H:i:s') . ' 交易id:'. $trade->id . "自动取消成功");
            } else {
                $output->writeln(date('Y-m-d H:i:s') . ' 交易id:'. $trade->id . "自动取消失败");
            }
        }
    }
}
