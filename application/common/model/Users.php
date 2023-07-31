<?php

namespace app\common\model;

use think\Model;

class Users extends Model
{
    //
    public function getSafeMobileAttr($value, $data)
    {
        return substr_replace($data['mobile'], '****', 3, 4);
    }
}
