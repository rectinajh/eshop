<?php

namespace app\merch\controller;



use think\Page;

use think\Verify;

use think\Db;

use think\Session;

use app\admin\logic\StoreLogic;



class Login extends Base

{



    // public function index()

    // {

    //     $list = array();

    //     $keywords = I('keywords');

    //     if (empty($keywords)) {

    //         $res = D('seller')->where("store_id", STORE_ID)->select();

    //     } else {

    //         $seller_where = array(

    //             'store_id' => STORE_ID,

    //             'seller_name' => ['like', '%' . $keywords . '%']

    //         );

    //         $res = Db::name('seller')->where($seller_where)->order('seller_id')->select();

    //     }

    //     $group = D('seller_group')->where(array('store_id' => STORE_ID))->getField('group_id,group_name');



    //     if ($res && $group) {

    //         foreach ($res as $val) {

    //             $val['role'] = $group[$val['group_id']];

    //             $val['enabled'] = $val['enabled'] == 0 ? '启用' : '停用';

    //             $val['add_time'] = date('Y-m-d H:i:s', $val['add_time']);

    //             $list[] = $val;

    //         }

    //     }

    //     $this->assign('list', $list);

    //     return $this->fetch();

    // }


    /*

     * 管理员登陆

     */

    public function login()

    {

        if (session('?seller_id') && session('seller_id') > 0) {

            $this->error("您已登录", U('Merch/User/index'));

        }



        if (IS_POST) {


            $seller_name = I('post.username');

            $password = I('post.password');

            if (!empty($seller_name) && !empty($password)) {

                $seller = M('seller')->where(array('seller_name' => $seller_name))->find();

                if ($seller) {

                    $user_where = array(

                        'user_id' => $seller['user_id'],

                        'password' => encrypt($password)

                    );

                    $user = M('users')->where($user_where)->find();

                    if ($user) {

                        if ($seller['is_admin'] == 0 && $seller['enabled'] == 1) {

                            exit(json_encode(array('status' => 0, 'msg' => '该账户还没启用激活')));

                        }

                        if ($seller['group_id'] > 0) {

                            $group = M('seller_group')->where(array('group_id' => $seller['group_id']))->find();

                            $seller['act_limits'] = $group['act_limits'];

                            $seller['smt_limits'] = $group['smt_limits'];

                        } else {

                            $seller['act_limits'] = 'all';

                            $seller['smt_limits'] = 'all';

                        }

                        session('seller', $seller);

                        session('seller_id', $seller['seller_id']);

                        session('store_id', $seller['store_id']);

                        M('seller')->where(array('seller_id' => $seller['seller_id']))->save(array('last_login_time' => time()));

                        sellerLog('商家管理中心登录');

                        $url = session('from_url') ? session('from_url') : U('User/index');

                        exit(json_encode(array('status' => 1, 'url' => $url)));

                    } else {

                        exit(json_encode(array('status' => 0, 'msg' => '账号密码不正确')));

                    }

                } else {

                    exit(json_encode(array('status' => 0, 'msg' => '账号不存在')));

                }

            } else {

                exit(json_encode(array('status' => 0, 'msg' => '请填写账号密码')));

            }

        }

        return $this->fetch();

    }



    /**

     * 退出登陆

     */

    public function logout()

    {

        session_unset();

        session_destroy();

        $this->success("退出成功", U('Merch/Login/login'));

    }


    public function role()

    {

        $list = D('seller_group')->where(array('store_id' => STORE_ID))->order('group_id desc')->select();

        $this->assign('list', $list);

        return $this->fetch();

    }


    public function log()

    {

        $Log = M('seller_log');

        $p = I('p', 1);

        $seller_id = session('seller_id');

        $logs = Db::name('seller_log')->alias('sl')

            ->join('__SELLER__ s', 's.seller_id = sl.log_seller_id')

            ->where('s.seller_id', $seller_id)->order('log_time DESC')

            ->page($p . ',20')

            ->select();

        $this->assign('list', $logs);

        $count = $Log->alias('sl')

            ->join('__SELLER__ s', 's.seller_id = sl.log_seller_id')

            ->where('s.seller_id', $seller_id)

            ->count();

        $Page = new Page($count, 20);

        $show = $Page->show();

        $this->assign('page', $show);

        return $this->fetch();

    }



    /**

     *  商家登录后 处理相关操作

     */

    public function login_task()

    {



        // 多少天后自动分销记录自动分成

        if(file_exists(APP_PATH.'common/logic/DistributLogic.php')){

            $distributLogic = new \app\common\logic\DistributLogic();

            $distributLogic->autoConfirm(STORE_ID); // 自动确认分成

        }



        // 商家结算 

        $storeLogic = new StoreLogic();

        $storeLogic->auto_transfer(STORE_ID); // 自动结算



    }



    /**

     * 清空系统缓存

     */

    public function cleanCache()

    {

        delFile('./public/upload/goods/thumb');// 删除缩略图

        \think\Cache::clear(); 

        //$html_arr = glob("./Application/Runtime/Html/*.html");

        //foreach ($html_arr as $key => $val) {

            // 删除详情页

        //    if (strstr($val, 'Home_Goods_goodsInfo') || strstr($val, 'Home_Goods_ajaxComment') || strstr($val, 'Home_Goods_ajax_consult'))

        //        unlink($val);

        //}

        $this->success("清除成功!!!", U('Index/index'));

    }


}