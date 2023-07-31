<?php
namespace app\mobile\controller;

use app\common\logic\CartLogic;
use app\common\logic\StoreLogic;
use app\common\logic\UsersLogic;
use app\common\logic\OrderGoodsLogic;
use app\common\logic\MessageLogic;
use app\common\logic\CommentLogic;
use think\Page;
use think\Verify;
use think\Db;

class Dynamic extends MobileBase
{
    public $user_id = 0;
    public $user = array();
    /*
     * 每日新淘链记录
     */
    public function index()
    {
        $user=session('user');
        $id=$user["user_id"];
        if($_GET["begintime"]){
            $begintimes=$_GET["begintime"];
            $finishtime=$_GET["finishtime"];
    $date = M('jinnum_log')->where("creat_time BETWEEN '".$begintimes."' AND date_add('".$finishtime."',interval 1 day) and uid={$id}")->select();
        }else{
            $time=date("Y-m-d",time());
            $date = M('jinnum_log')->where("creat_time LIKE '".$time."%' and uid={$id}")->select();
        }
        foreach($date as $k=>$v){
            if($v["son_uid"] > 0){
        $dates = M('users')->where(array("user_id"=>$v["son_uid"]))->find();
        $date[$k]["u_mobile"]=$dates["mobile"];
        $date[$k]["u_consume_cp"]=$dates["consume_cp"];  
            }else{
            $date[$k]["u_mobile"]="无";
            $date[$k]["u_consume_cp"]="无";   
            }
           
        }
        $this->assign("date",$date);
        return $this->fetch();
    }
}
