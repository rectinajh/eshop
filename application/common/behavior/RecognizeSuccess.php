<?php
namespace app\common\behavior;

class RecognizeSuccess
{
    public function run(&$param)
    {
        action('common/Rebate/rebateMaster', array($param), 'logic', true);
    }
}
