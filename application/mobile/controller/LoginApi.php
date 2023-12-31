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
 * 微信交互类
 */
namespace app\mobile\controller;

use app\common\logic\UsersLogic;
use app\common\logic\CartLogic;


class LoginApi extends MobileBase{
    public $config;
    public $oauth;
    public $class_obj;

    public function __construct(){
        parent::__construct();
        $this->oauth = I('get.oauth');
        //获取配置
        $data = M('Plugin')->where("code",$this->oauth)->where('type','login')->find();
        $this->config = unserialize($data['config_value']); // 配置反序列化
        if(!$this->oauth)
            $this->error('非法操作',U('Home/User/login'));
        include_once  "plugins/login/{$this->oauth}/{$this->oauth}.class.php";
        $class = '\\'.$this->oauth; //
        $login = new $class($this->config); //实例化对应的登陆插件
        $this->class_obj = $login;
    }

    public function login(){
        if(!$this->oauth)
            $this->error('非法操作',U('Home/User/login'));
        include_once  "plugins/login/{$this->oauth}/{$this->oauth}.class.php";
        $this->class_obj->login();
    }

    public function callback(){
        $data = $this->class_obj->respon();
        $logic = new UsersLogic();
        $data = $logic->thirdLogin($data);
        if($data['status'] != 1)
            $this->error($data['msg']);
        session('user',$data['result']);
        // 登录后将购物车的商品的 user_id 改为当前登录的id            
        M('cart')->where("session_id" , $this->session_id)->save(array('user_id'=>$data['result']['user_id']));
        $cartLogic = new CartLogic();
        $cartLogic->doUserLoginHandle($this->session_id,$data['result']['user_id']);  //用户登录后 需要对购物车 一些操作
        
        $this->success('登陆成功',U('Mobile/User/index'));
    }
}