<?php

/**
 * 新淘链商城
 * ============================================================================
 * * 版权所有 2015-2027 新淘链，并保留所有权利。
 * 网站地址: 
 * ----------------------------------------------------------------------------
 * 这是一个商业软件，您必须购买授权才能使用.
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 请支持正版, 以免引起不必要的法律纠纷.
 * ============================================================================
 * 订单以及售后中心
 * @author soubao 
 *  @Date: 2016-12-20
 */
namespace app\home\controller;

use app\common\logic\MessageLogic;
use app\common\logic\OrderLogic;
use app\common\logic\OrderGoodsLogic;
use app\common\logic\StoreLogic;
use app\common\logic\CommentLogic;
use app\common\logic\UsersLogic;
use app\common\model\Store;
use think\Db;
use think\Page;

class Hunlian extends Base
{

    public $user_id = 0;
    public $user = array();

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
            $this->assign('user_id', $this->user_id);
            //获取用户信息的数量
            $messageLogic = new MessageLogic();
            $user_message_count = $messageLogic->getUserMessageCount();
            $this->assign('user_message_count', $user_message_count);
        } else {
            header("location:" . U('Home/User/login'));
            exit;
        }
        //用户中心面包屑导航
        $navigate_user = navigate_user();
        $this->assign('navigate_user', $navigate_user);
    }

    /*
     * 订单列表
     */
    public function index()
    {
        //首页调取
        //$images=M("loves")->where(array("ishot"=>2,"isout"=>2))->limit(3)->select();

        $count = DB::name('loves')->where(array("ishot" => 2, "isout" => 2))->count();
        $page = new Page($count, 12);
        $show = $page->show();
        $images = DB::name('loves')
            ->limit($page->firstRow, $page->listRows)
            ->where(array("ishot" => 2, "isout" => 2))
            ->select();
        $this->assign('page', $show);
        $this->assign('pager', $page);
        $this->assign("images", $images);
        return $this->fetch();
    }
    public function more_member()
    {
        $count = DB::name('loves')->where(array("isout" => 2))->count();
        $page = new Page($count, 12);
        $show = $page->show();
        $images = DB::name('loves')
            ->limit($page->firstRow, $page->listRows)
            ->where(array("isout" => 2))
            ->select();
        $this->assign('page', $show);
        $this->assign('pager', $page);
        $this->assign("images", $images);
        return $this->fetch();
    }
    public function huoqu()
    {
        //购买用户联系方式
        $id = $_GET["id"];
        $user = session('user');
        $user = M('users')->where("user_id", $user['user_id'])->find();
        if ($user["pay_points"] >= 100) {
            $jian = M("users")->where("user_id", $user['user_id'])->setDec("pay_points", 100);
            if ($jian) {
                $data["userid"] = $user["user_id"];
                $data["lovesid"] = $id;
                $data["addtime"] = date("Y-m-d H:i:s", time());
                $add = M("uloves")->add($data);
                if ($add) {
                    echo 1;
                } else {
                    echo 2;
                }
            }
        } else {
            echo 3;
        }
    }
    public function xindong()
    {
        $user = session('user');
        $suoyou = M("uloves")->where(array("userid" => $user["user_id"]))->select();
        foreach ($suoyou as $k => $v) {
            $count = DB::name('loves')->where(array("id" => $v["lovesid"], "isout" => 2))->count();
            $page = new Page($count, 12);
            $show = $page->show();
            $images[$k] = DB::name('loves')
                ->limit($page->firstRow, $page->listRows)
                ->where(array("id" => $v["lovesid"], "isout" => 2))
                ->find();
        }
        $this->assign("images", $images);
        $this->assign('page', $show);
        $this->assign('pager', $page);
        return $this->fetch();
    }
    public function imans()
    {
        //我是男生
        $count = DB::name('loves')->where(array("sex" => 1, "isout" => 2))->count();
        $page = new Page($count, 12);
        $show = $page->show();
        $images = DB::name('loves')
            ->limit($page->firstRow, $page->listRows)
            ->where(array("sex" => 1, "isout" => 2))
            ->select();
        $this->assign('page', $show);
        $this->assign('pager', $page);
        $this->assign("images", $images);
        return $this->fetch();
    }
    public function igirls()
    {
        //我是女生
        $count = DB::name('loves')->where(array("sex" => 2, "isout" => 2))->count();
        $page = new Page($count, 12);
        $show = $page->show();
        $images = DB::name('loves')
            ->limit($page->firstRow, $page->listRows)
            ->where(array("sex" => 2, "isout" => 2))
            ->select();
        $this->assign('page', $show);
        $this->assign('pager', $page);
        $this->assign("images", $images);
        return $this->fetch();
    }
    public function topic()
    {
        //新闻列表
        return $this->fetch();
    }
    public function peopleNews()
    {
        //个人详情
        $id = $_GET["id"];
        $user = session('user');
        $suoyou = M("users")->where(array("user_id" => $user["user_id"]))->find();
        $queding = M("uloves")->where(array("userid" => $suoyou["user_id"], "lovesid" => $id))->find();
        if ($queding) {
            $mmp = 1;
        } else {
            $mmp = 2;
        }
        $image = M("loves")->where(array("id" => $id))->find();
        $this->assign("mmp", $mmp);
        $this->assign("image", $image);
        return $this->fetch();
    }

    public function upload()
    {
        //个人资料
        $user = session('user');
        $user = M('users')->where("user_id", $user['user_id'])->find();
        $uuser = M("loves")->where("userid", $user['user_id'])->find();
        $uusers = M("shiming")->where("userid", $user['user_id'])->find();

        if ($uuser) {
            $this->assign("uuser", $uuser);
        }
        if ($uusers) {
            $this->assign("uusers", $uusers);
        }
        return $this->fetch();
    }
    public function uploads()
    {
        $user = session('user');
        $user = M('users')->where("user_id", $user['user_id'])->find();
        $uuser = M("shiming")->where("userid", $user['user_id'])->find();
        if ($uuser) {
            $uusers = M("loves")->where("userid", $user['user_id'])->find();
            if ($uusers) {
                $add = M("loves")->where("userid", $user['user_id'])->save($_POST);
            } else {
                $_POST["name"] = $uuser["name"];
                $_POST["identitynum"] = $uuser["identitynum"];
                $_POST["sex"] = $uuser["sex"];
                $_POST["userid"] = $uuser["userid"];
                $add = M("loves")->add($_POST);
            }
            if ($add) {
                echo 1;
            } else {
                echo 2;
            }
        } else {
            echo "请先进行实名认证，再上传资料";
        }
    }

    public function is_idcard($id) //验证身份证信息
    {
        $id = strtoupper($id);
        $regx = "/(^\d{15}$)|(^\d{17}([0-9]|X)$)/";
        $arr_split = array();
        if (!preg_match($regx, $id)) {
            return false;
        }
        if (15 == strlen($id)) {
            //检查15位
            $regx = "/^(\d{6})+(\d{2})+(\d{2})+(\d{2})+(\d{3})$/";
            @preg_match($regx, $id, $arr_split);
            //检查生日日期是否正确
            $dtm_birth = "19" . $arr_split[2] . '/' . $arr_split[3] . '/' . $arr_split[4];
            if (!strtotime($dtm_birth)) {
                return false;
            } else {
                return true;
            }
        } else {
            //检查18位
            $regx = "/^(\d{6})+(\d{4})+(\d{2})+(\d{2})+(\d{3})([0-9]|X)$/";
            @preg_match($regx, $id, $arr_split);
            $dtm_birth = $arr_split[2] . '/' . $arr_split[3] . '/' . $arr_split[4];
            if (!strtotime($dtm_birth)) {
                //检查生日日期是否正确
                return false;
            } else {
                //检验18位身份证的校验码是否正确
                //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10
                $arr_int = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
                $arr_ch = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
                $sign = 0;
                for ($i = 0; $i < 17; $i++) {
                    $b = (int)$id {
                        $i};
                    $w = $arr_int[$i];
                    $sign += $b * $w;
                }
                $n = $sign % 11;
                $val_num = $arr_ch[$n];
                if ($val_num != substr($id, 17, 1)) {
                    return false;
                } else {
                    //phpfensi.com
                    return true;
                }
            }
        }
    }

    public function getrenzheng()
    {
        if ($_POST) {
            $num = $_POST["num"];
            $date = strtotime(substr($num, 6, 8));//获得出生年月日的时间戳
            $today = time();//获得今日的时间戳
            $diff = floor(($today - $date) / 86400 / 365);//得到两个日期相差的大体年数
            //strtotime加上这个年数后得到那日的时间戳后与今日的时间戳相比
            $age = strtotime(substr($num, 6, 8) . ' +' . $diff . 'years') > $today ? ($diff + 1) : $diff;
            $name = $_POST["name"];
            $true = $this->is_idcard($num);
            if ($true) {
                $user = session('user');
                $user = M('users')->where("user_id", $user['user_id'])->find();
                $uuser = M("shiming")->where("userid", $user['user_id'])->find();
                $ppser = M("shiming")->where("identitynum", $num)->find();
                if ($uuser || $ppser) {
                    echo 4;
                } else {
                    $length = strlen($num);
                    if ($length == 15) {
                        $sexs = substr($num, 14, 1);
                        if ($sexs % 2 == 1) {
                            $data["sex"] = 1;
                        } else {
                            $data["sex"] = 2;
                        }
                    } else {
                        $sexs = substr($num, 16, 1);
                        if ($sexs % 2 != 0) {
                            $data["sex"] = 1;
                        } else {
                            $data["sex"] = 2;
                        }
                    }
                    $data["userid"] = $user["user_id"];
                    $data["name"] = $name;
                    $data["identitynum"] = $num;
                    $data['age'] = $age;
                    $add = M('shiming')->add($data);
                    if ($add) {
                        echo 1;
                    } else {
                        echo 2;
                    }
                }
            } else {
                echo 3;
            }
        } else {
            $user = session('user');
            $user = M('users')->where("user_id", $user['user_id'])->find();
            $uuser = M("shiming")->where("userid", $user['user_id'])->find();
            if ($uuser) {
                $this->assign("user", $uuser);
            }
            return $this->fetch();
        }
    }
}
