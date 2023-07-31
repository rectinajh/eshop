<?php

namespace app\admin\controller;

use think\AjaxPage;
use think\Page;
use think\Loader;
use think\Db;
use app\admin\logic\UsersLogic;
use app\common\logic\UsersLogic as CommonUser;
use app\common\model\UserRole;
use app\common\model\Users;

class User extends Base
{
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 会员列表
     */
    public function ajaxindex()
    {
        // 搜索条件
        $condition = array();
        I('mobile') ? $condition['mobile'] = I('mobile') : false;
        I('email') ? $condition['nickname'] = I('email') : false;
        I('first_leader') && ($condition['first_leader'] = I('first_leader')); // 查看一级下线人有哪些
        I('second_leader') && ($condition['second_leader'] = I('second_leader')); // 查看二级下线人有哪些
        I('third_leader') && ($condition['third_leader'] = I('third_leader')); // 查看三级下线人有哪些
        $sort_order = I('order_by') . ' ' . I('sort');
        $model = M('users');
        $count = $model->where($condition)->count();
        $Page = new AjaxPage($count, 10);
        //  搜索条件下 分页赋值
        foreach ($condition as $key => $val) {
            $Page->parameter[$key] = urlencode($val);
        }
        $userList = $model->where($condition)->order($sort_order)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $user_id_arr = get_arr_column($userList, 'user_id');
        if (!empty($user_id_arr)) {
            $first_leader = DB::query("select first_leader,count(1) as count  from __PREFIX__users where first_leader in(" . implode(',', $user_id_arr) . ")  group by first_leader");
            $first_leader = convert_arr_key($first_leader, 'first_leader');
            $second_leader = DB::query("select second_leader,count(1) as count  from __PREFIX__users where second_leader in(" . implode(',', $user_id_arr) . ")  group by second_leader");
            $second_leader = convert_arr_key($second_leader, 'second_leader');
            $third_leader = DB::query("select third_leader,count(1) as count  from __PREFIX__users where third_leader in(" . implode(',', $user_id_arr) . ")  group by third_leader");
            $third_leader = convert_arr_key($third_leader, 'third_leader');
        }
        $proportion = Db::name('proportion')->find();
        foreach ($userList as $k => $v) {
            $str = '';
            if ($v['consume_cp'] > $proportion['one_min_consume'] && $v['consume_cp'] < $proportion['one_consume']) {
                $userList[$k]['levelname'] = '一星会员';
            } elseif ($v['consume_cp'] > $proportion['two_min_consume'] && $v['consume_cp'] < $proportion['two_consume']) {
                $userList[$k]['levelname'] = '二星会员';
            } elseif ($v['consume_cp'] > $proportion['three_min_consume'] && $v['consume_cp'] < $proportion['three_consume']) {
                $userList[$k]['levelname'] = '三星会员';
            } elseif ($v['consume_cp'] > $proportion['four_min_consume'] && $v['consume_cp'] < $proportion['four_consume']) {
                $userList[$k]['levelname'] = '四星会员';
            } elseif ($v['consume_cp'] > $proportion['five_min_consume']) {
                $userList[$k]['levelname'] = '五星会员';
            } else {
                $userList[$k]['levelname'] = '普通会员';
            }
        }
        $this->assign('first_leader', $first_leader);
        $this->assign('second_leader', $second_leader);
        $this->assign('third_leader', $third_leader);
        $show = $Page->show();
        $this->assign('pager', $Page);
        $this->assign('userList', $userList);
        $this->assign('page', $show);// 赋值分页输出
        $this->assign('level', M('user_level')->getField('level_id,level_name'));
        return $this->fetch();
    }
    /**
     * 会员日志
     */
    public function member_log()
    {
        return $this->fetch();
    }
    public function ajaxmember_log()
    {
         // 搜索条件
        $condition = array();
        //I('mobile') ? $condition['mobile'] = I('mobile') : false;
        I('mobile') ? $condition['mobile'] = I('mobile') : [];
        $mobile = I('mobile');
        $member = Db::name('users')->where(array('mobile' => $mobile))->find();
        if ($member) {
            $condition['user_id'] = $member['user_id'];
        }
        $nickname = I('nickname');
        $member2 = Db::name('users')->where(array('nickname' => $nickname))->find();
        if ($member2) {
            $condition['user_id'] = $member2['user_id'];
        }

        $sort_order = I('order_by') . ' ' . I('sort');
        $model = M('account_log');
        $count = $model->where($condition)->count();
        $Page = new AjaxPage($count, 10);
        //  搜索条件下 分页赋值
        foreach ($condition as $key => $val) {
            $Page->parameter[$key] = urlencode($val);
        }
        $userList = $model->where($condition)->order($sort_order)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $show = $Page->show();
        $this->assign('pager', $Page);
        $this->assign('userList', $userList);
        $this->assign('page', $show);// 赋值分页输出
        return $this->fetch();
    }
    /**
     * 会员详细信息查看
     */
    public function detail()
    {
        if (IS_POST) {
            //  会员信息编辑
            $password = I('post.password');
            $password2 = I('post.password2');
            $user_id = I('post.user_id');
            $force_modify_parent = input('?post.force_modify_parent');
            if ($password != '' && $password != $password2) {
                $this->ajaxReturn(['status' => 0, 'msg' => '两次输入密码不同']);
            }
            if ($password == '' && $password2 == '') {
                unset($_POST['password']);
            } else {
                $_POST['password'] = encrypt($_POST['password']);
            }
            if (!empty($_POST['email'])) {
                $email = trim($_POST['email']);
                $c = M('users')->where("user_id != $user_id and email = '$email'")->count();
                $c && $this->ajaxReturn(['status' => 0, 'msg' => '邮箱不得和已有用户重复']);
            }
            if (!empty($_POST['mobile'])) {
                $mobile = trim($_POST['mobile']);
                $c = M('users')->where("user_id != $user_id and mobile = '$mobile'")->count();
                $c && $this->ajaxReturn(['status' => 0, 'msg' => '手机号不得和已有用户重复']);
            }
            if ($force_modify_parent) {
                $changeResult = action('common/Users/changeUserParent', array($user_id, $_POST['tuimobile']), 'logic', true);
                if ($changeResult['code'] == 0) {
                    $this->ajaxReturn(['status' => 0, 'msg' => $changeResult['msg']]);
                }
            } else {
                unset($_POST['tuimobile']);
            }
            $_POST['is_test'] = array('exp', $_POST['is_test']);
            $row = M('users')->where(array('user_id' => $user_id))->save($_POST);
            if ($row || $changeResult['code'] == 1) {
                $this->ajaxReturn(['status' => 1, 'msg' => '修改成功']);
            }
            $this->ajaxReturn(['status' => 0, 'msg' => '未作内容修改或修改失败']);
        }
        $uid = I('id/d', 0);
        $user = D('User')->where(array('user_id' => $uid))->find();
        if (!$user) {
            $this->ajaxReturn(['status' => 0, 'msg' => '会员不存在']);
        }
        $user['first_lower'] = M('users')->where("first_leader = {$user['user_id']}")->count();
        $user['second_lower'] = M('users')->where("second_leader = {$user['user_id']}")->count();
        $user['third_lower'] = M('users')->where("third_leader = {$user['user_id']}")->count();
        //会员角色显示
        $roles = UserRole::all();
        //会员等级显示
        $levels = M('user_level')->column('level_name', 'level_id');
        $levelName = M('user_level')->where(array('level_id' => $user['level']))->find();
        $user['level_name'] = $levelName['level_name'];
        $this->assign('roles', $roles);
        $this->assign('levels', $levels);
        $this->assign('user', $user);
        return $this->fetch();
    }

    public function add_user()
    {
        if (IS_POST) {
            $data = I('post.');
            $user_obj = new UsersLogic();
            $res = $user_obj->addUser($data);
            if ($res['status'] == 1) {
                $this->success('添加成功', U('User/index'));
                exit;
            } else {
                $this->error('添加失败,' . $res['msg'], U('User/index'));
            }
        }
        return $this->fetch();
    }

    /**
     * 添加导入会员
     */
    public function add_Importuser()
    {
        if (IS_POST) {
            $data = I('post.');
            /* $tui = M('users')->where("mobile", $data['tuimobile'])->find();
            if(!$tui){
                $this->ajaxReturn(['status'=>-1,'msg'=>'推荐人不存在']);
            } */
            $logic = new CommonUser();
            $res = $logic->reg($data['mobile'], $data['password'], $data['password'], $data['paypwd'], $data['paypwd'], $data['id_number'], $data['tuimobile'], $data['jin_num']);
            if ($res['status'] == 1) {
                Db::name('users')->where("user_id", $res['result']['user_id'])->update(array('is_usercenter' => 1, 'nickname' => $data['nickname']));
                if ($data['jin_num'] > 0) {
                    accountLog($res['result']['user_id'], 0, 0, '导入增加新淘链', 0, 0, '', 0, 0, $data['jin_num']);
                }
                $this->success('添加成功', U('User/index'));
                exit;
            } else {
                $this->error('添加失败,' . $res['msg'], U('User/index'));
            }
        }
        return $this->fetch();
    }
    public function role()
    {
        $limit = input('get.limit', 10, 'intval');
        $userRole = UserRole::order('level', 'desc')->paginate($limit);
        $this->assign('list', $userRole);
        return $this->fetch();
    }

    public function roleAdd()
    {
        if (request()->isPost()) {
            $data = [
                'role_name' => input('post.role_name', '', 'trim'),
                'describe' => input('post.describe', '', 'trim'),
            ];
            $result = $this->validate($data, 'UserRole');
            if (true !== $result) {
                $this->result(null, 0, $result, 'json');
                return false;
            }
            $userRole = UserRole::create($data);
            if ($userRole) {
                $this->result($userRole, 1, '添加成功！', 'json');
            } else {
                $this->result(null, 0, '添加失败！', 'json');
            }
        } else {
            return $this->fetch();
        }
    }

    public function roleEdit($role_id = 0)
    {
        $userRole = UserRole::get($role_id);
        if (request()->isPost()) {
            $data = [
                'role_id' => $role_id,
                'level' => input('post.level', '', 'trim'),
                'role_name' => input('post.role_name', '', 'trim'),
                'describe' => input('post.describe', '', 'trim'),
            ];
            $validateResult = $this->validate($data, 'UserRole');
            if (true !== $validateResult) {
                $this->result(null, 0, $result, 'json');
                return false;
            }
            $dbResult = $userRole->save($data);
            $dbResult !== false ? $this->result($userRole, 1, '保存成功！', 'json') : $this->result($userRole, 0, '保存失败！', 'json');
        } else {
            $this->assign('info', $userRole);
            return $this->fetch('addRole');
        }
    }

    public function roleDel($role_id = 0)
    {
        $roleUserNum = Users::where('role_id', $role_id)->count();
        if ($roleUserNum <= 0) {
            $result = UserRole::destroy($role_id);
            $result !== false ? $this->result($userRole, 1, '删除成功', 'json') : $this->result($userRole, 0, '删除失败！', 'json');
        } else {
            $this->result(null, 0, '不能删除，该角色下有会员！', 'json');
        }
    }

    public function export_user()
    {
        $strTable = '<table width="500" border="1">';
        $strTable .= '<tr>';
        $strTable .= '<td style="text-align:center;font-size:12px;width:120px;">会员ID</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="100">会员昵称</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">会员等级</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">手机号</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">邮箱</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">注册时间</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">最后登陆</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">余额</td>';
        // $strTable .= '<td style="text-align:center;font-size:12px;" width="*">积分</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">提现币</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">新淘链</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">奉献值</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">算力</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">累计消费</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="*">团队业绩</td>';
        $strTable .= '</tr>';
        $count = M('users')->count();
        $p = ceil($count / 5000);
        for ($i = 0; $i < $p; $i++) {
            $start = $i * 5000;
            $end = ($i + 1) * 5000;
            $userList = M('users')->order('user_id')->limit($start . ',' . $end)->select();
            if (is_array($userList)) {
                foreach ($userList as $k => $val) {
                    $strTable .= '<tr>';
                    $strTable .= '<td style="text-align:center;font-size:12px;">' . $val['user_id'] . '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $val['nickname'] . ' </td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $val['level'] . '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $val['mobile'] . '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $val['email'] . '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . date('Y-m-d H:i', $val['reg_time']) . '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . date('Y-m-d H:i', $val['last_login']) . '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $val['user_money'] . '</td>';
                    //$strTable .= '<td style="text-align:left;font-size:12px;">' . $val['pay_points'] . ' </td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $val['withdraw_money'] . '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $val['jin_num'] . '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $val['dedication_money'] . '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $val['consume_cp'] . '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $val['total_amount'] . ' </td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $val['team_performance'] . ' </td>';
                    $strTable .= '</tr>';
                }
                unset($userList);
            }
        }
        $strTable .= '</table>';
        downloadExcel($strTable, 'users_' . $i);
        exit();
    }

    /**
     * 用户收货地址查看
     */
    public function address()
    {
        $uid = I('get.id');
        $lists = D('user_address')->where(array('user_id' => $uid))->select();
        $regionList = Db::name('region')->cache(true)->getField('id,name');
        $this->assign('regionList', $regionList);
        $this->assign('lists', $lists);
        return $this->fetch();
    }

    /**
     * 删除会员
     */
    public function delete()
    {
        $uid = I('get.id');
        $row = M('users')->where(array('user_id' => $uid))->delete();
        if ($row) {
            $this->success('成功删除会员');
        } else {
            $this->error('操作失败');
        }
    }

    /**
     * 删除会员
     */
    public function ajax_delete()
    {
        $uid = I('id');
        if ($uid) {
            $row = M('users')->where(array('user_id' => $uid))->delete();
            if ($row !== false) {
                $this->ajaxReturn(array('status' => 1, 'msg' => '删除成功', 'data' => ''));
            } else {
                $this->ajaxReturn(array('status' => 0, 'msg' => '删除失败', 'data' => ''));
            }
        } else {
            $this->ajaxReturn(array('status' => 0, 'msg' => '参数错误', 'data' => ''));
        }
    }

    /**
     * 账户资金记录
     */
    public function account_log()
    {
        $user_id = I('get.id');
        //获取类型
        $type = I('get.type');
        //获取记录总数
        $count = M('account_log')->where(array('user_id' => $user_id))->count();
        $page = new Page($count);
        $lists = M('account_log')->where(array('user_id' => $user_id))->order('change_time desc')->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign('user_id', $user_id);
        $this->assign('page', $page->show());
        $this->assign('lists', $lists);
        return $this->fetch();
    }

    /**
     * 账户资金调节
     */
    public function account_edit()
    {
        $user_id = I('uid/d', 0);
        if (!($user_id > 0)) {
            $this->ajaxReturn(['status' => 0, 'msg' => "参数有误"]);
        }
        $user = M('users')->field('user_id, user_money, frozen_money, pay_points, withdraw_money, dedication_money, jin_num, consume_cp, is_lock')->where('user_id', $user_id)->find();
        if (IS_POST) {
            $desc = I('post.desc');
            if (!$desc) {
                $this->ajaxReturn(['status' => 0, 'msg' => '请填写操作说明']);
            }
            //加减用户资金
            $m_op_type = I('post.money_act_type');
            $user_money = I('post.user_money/f');
            if ($m_op_type != 1 and $user_money > $user['user_money']) {
                $this->ajaxReturn(['status' => 0, 'msg' => '用户剩余资金不足！！']);
            }
            $user_money = $m_op_type ? $user_money : 0 - $user_money;
            //加减用户积分
            $p_op_type = I('post.point_act_type');
            $pay_points = I('post.pay_points/d');
            if ($p_op_type != 1 and $pay_points > $user['pay_points']) {
                $this->ajaxReturn(['status' => 0, 'msg' => '用户剩余积分不足！！']);
            }
            $pay_points = $p_op_type ? $pay_points : 0 - $pay_points;
            //加减提现币
            $w_op_type = I('post.withdraw_act_type');
            $withdraw_money = I('post.withdraw_money/d');
            if ($w_op_type != 1 and $withdraw_money > $user['withdraw_money']) {
                $this->ajaxReturn(['status' => 0, 'msg' => '用户提现币不足！！']);
            }
            $withdraw_money = $w_op_type ? $withdraw_money : 0 - $withdraw_money;
            //加减新淘链
            $j_op_type = I('post.jin_act_type');
            $jin_num = I('post.jin_num');
            if ($w_op_type != 1 and $jin_num > $user['jin_num']) {
                $this->ajaxReturn(['status' => 0, 'msg' => '用户新淘链不足！！']);
            }
            $jin_num = $j_op_type ? $jin_num : 0 - $jin_num;
            //加减奉献值
            $d_op_type = I('post.dedication_act_type');
            $dedication_money = I('post.dedication_money/d');
            if ($d_op_type != 1 and $dedication_money > $user['dedication_money']) {
                $this->ajaxReturn(['status' => 0, 'msg' => '用户奉献值不足！！']);
            }
            $dedication_money = $d_op_type ? $dedication_money : 0 - $dedication_money;
             //加减算力
            $co_op_type = I('post.consume_act_type');
            $consume_cp = I('post.consume_cp');
            if ($co_op_type != 1 and $consume_cp > $user['consume_cp']) {
                $this->ajaxReturn(['status' => 0, 'msg' => '用户算力不足！！']);
            }
            $consume_cp = $co_op_type ? $consume_cp : 0 - $consume_cp;
            //加减冻结资金
            $f_op_type = I('post.frozen_act_type');
            $acquire_frozen_money = I('post.frozen_money/f');
            $revision_frozen_money = 0;
            if ($acquire_frozen_money != 0) {    //有加减冻结资金的时候
                $revision_frozen_money = $f_op_type ? $acquire_frozen_money : 0 - $acquire_frozen_money;
                $frozen_money = $user['frozen_money'] + $revision_frozen_money;    //计算用户被冻结的资金
                if ($f_op_type == 1 and $acquire_frozen_money > $user['user_money']) {
                    $this->ajaxReturn(['status' => 0, 'msg' => '用户剩余资金不足！！']);
                }
                if ($f_op_type == 0 and $acquire_frozen_money > $user['frozen_money']) {
                    $this->ajaxReturn(['status' => 0, 'msg' => '冻结的资金不足！！']);
                }
                $user_money = $f_op_type ? 0 - $acquire_frozen_money : $acquire_frozen_money;    //计算用户剩余资金
                M('users')->where('user_id', $user_id)->update(['frozen_money' => $frozen_money]);
            }
            if (accountLog($user_id, $user_money, $pay_points, $desc, 0, 0, '', $revision_frozen_money, $withdraw_money, $jin_num, $dedication_money, $consume_cp)) {
                if (input('?jin_num_is_import')) {
                    $user = Db::name('users');
                    if ($jin_num > 0) {
                        $importResult = $user->where('user_id', $user_id)->setInc('import_jin_num', $jin_num);
                    } elseif ($jin_num < 0) {
                        $importResult = $user->where('user_id', $user_id)->setDec('import_jin_num', abs($jin_num));
                    }
                }
                $this->ajaxReturn(['status' => 1, 'msg' => '操作成功', 'url' => U("Admin/User/account_log", array('id' => $user_id))]);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => '操作失败']);
            }
            exit;
        }
        $this->assign('user', $user);
        return $this->fetch();
    }

    public function recharge()
    {
        $timegap = I('timegap');
        $nickname = I('nickname');
        $map = array();
        if ($timegap) {
            $gap = explode(' - ', $timegap);
            $begin = $gap[0];
            $end = $gap[1];
            $this->assign('start_time', $begin);
            $this->assign('end_time', $end);
            $map['ctime'] = array('between', array(strtotime($begin), strtotime($end)));
        }
        if ($nickname) {
            $map['nickname'] = array('like', "%$nickname%");
        }
        $count = M('recharge')->where($map)->count();
        $page = new Page($count);
        $lists = M('recharge')->where($map)->order('ctime desc')->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign('pager', $page);
        $this->assign('page', $page->show());
        $this->assign('lists', $lists);
        return $this->fetch();
    }

    public function level()
    {
        $act = I('get.act', 'add');
        $this->assign('act', $act);
        $level_id = I('get.level_id');
        $level_info = array();
        if ($level_id) {
            $level_info = D('user_level')->where('level_id=' . $level_id)->find();
            $this->assign('info', $level_info);
        }
        return $this->fetch();
    }

    public function levelList()
    {
        $Ad = M('user_level');
        $p = $this->request->param('p');
        $res = $Ad->order('level_id')->page($p . ',10')->select();
        if ($res) {
            foreach ($res as $val) {
                $list[] = $val;
            }
        }
        $this->assign('list', $list);
        $count = $Ad->count();
        $Page = new Page($count, 10);
        $show = $Page->show();
        $this->assign('page', $show);
        return $this->fetch();
    }

    /**
     * 会员等级添加编辑删除
     */
    public function levelHandle()
    {
        $data = I('post.');
        $userLevelValidate = Loader::validate('UserLevel');
        $return = ['status' => 0, 'msg' => '参数错误', 'result' => ''];//初始化返回信息
        if ($data['act'] == 'add') {
            if (!$userLevelValidate->batch()->check($data)) {
                $return = ['status' => 0, 'msg' => '添加失败', 'result' => $userLevelValidate->getError()];
            } else {
                $r = D('user_level')->add($data);
                if ($r !== false) {
                    $return = ['status' => 1, 'msg' => '添加成功', 'result' => $userLevelValidate->getError()];
                } else {
                    $return = ['status' => 0, 'msg' => '添加失败，数据库未响应', 'result' => ''];
                }
            }
        }
        if ($data['act'] == 'edit') {
            if (!$userLevelValidate->scene('edit')->batch()->check($data)) {
                $return = ['status' => 0, 'msg' => '编辑失败', 'result' => $userLevelValidate->getError()];
            } else {
                $r = D('user_level')->where('level_id=' . $data['level_id'])->save($data);
                if ($r !== false) {
                    $return = ['status' => 1, 'msg' => '编辑成功', 'result' => $userLevelValidate->getError()];
                } else {
                    $return = ['status' => 0, 'msg' => '编辑失败，数据库未响应', 'result' => ''];
                }
            }
        }
        if ($data['act'] == 'del') {
            $r = D('user_level')->where('level_id=' . $data['level_id'])->delete();
            if ($r !== false) {
                $return = ['status' => 1, 'msg' => '删除成功', 'result' => ''];
            } else {
                $return = ['status' => 0, 'msg' => '删除失败，数据库未响应', 'result' => ''];
            }
        }
        $this->ajaxReturn($return);
    }

    /**
     * 搜索用户名
     */
    public function search_user()
    {
        $search_key = trim(I('search_key'));
        if (strstr($search_key, '@')) {
            $list = M('users')->where(" email like '%$search_key%' ")->select();
            foreach ($list as $key => $val) {
                echo "<option value='{$val['user_id']}'>{$val['email']}</option>";
            }
        } else {
            $list = M('users')->where(" mobile like '%$search_key%' ")->select();
            foreach ($list as $key => $val) {
                echo "<option value='{$val['user_id']}'>{$val['mobile']}</option>";
            }
        }
        exit;
    }

    /**
     * 分销树状关系
     */
    public function ajax_distribut_tree()
    {
        $list = M('users')->where("first_leader = 1")->select();
        return $this->fetch();
    }

    /**
     *
     * @time 2016/08/31
     * @author dyr
     * 发送站内信
     */
    public function sendMessage()
    {
        $user_id_array = I('get.user_id_array');
        $users = array();
        if (!empty($user_id_array)) {
            $users = M('users')->field('user_id,nickname')->where(array('user_id' => array('IN', $user_id_array)))->select();
        }
        $this->assign('users', $users);
        return $this->fetch();
    }

    /**
     * 发送系统消息
     */
    public function doSendMessage()
    {
        $call_back = I('call_back');//回调方法
        $type = I('post.type', 0);//个体or全体
        $admin_id = session('admin_id');
        $users = I('post.user/a');//个体id
        $category = I('post.category/d', 0); //0系统消息，1物流通知，2优惠促销，3商品提醒，4我的资产，5商城好店
        $raw_data = [
            'title' => I('post.title', ''),
            'order_id' => I('post.order_id', 0),
            'discription' => I('post.text', ''), //内容
            'goods_id' => I('post.goods_id', 0),
            'change_type' => I('post.change_type/d', 0),
            'money' => I('post.money/d', 0),
            'cover' => I('post.cover', '')
        ];
        $msg_data = [
            'admin_id' => $admin_id,
            'category' => $category,
            'type' => $type
        ];
        $msglogic = new \app\common\logic\MessageLogic;
        $msglogic->sendMessage($msg_data, $raw_data, $users);
        exit("<script>parent.{$call_back}(1);</script>");
    }

    /**
     *
     * @time 2016/09/03
     * @author dyr
     * 发送邮件
     */
    public function sendMail()
    {
        $user_id_array = I('get.user_id_array');
        $users = array();
        if (!empty($user_id_array)) {
            $user_where = array(
                'user_id' => array('IN', $user_id_array),
                'email' => array('neq', '')
            );
            $users = M('users')->field('user_id,nickname,email')->where($user_where)->select();
        }
        $this->assign('smtp', tpCache('smtp'));
        $this->assign('users', $users);
        return $this->fetch();
    }

    /**
     * 发送邮箱
     * @author dyr
     * @time  2016/09/03
     */
    public function doSendMail()
    {
        $call_back = I('call_back');//回调方法
        $message = I('post.text');//内容
        $title = I('post.title');//标题
        $users = I('post.user/a');
        if (!empty($users)) {
            $user_id_array = implode(',', $users);
            $users = M('users')->field('email')->where(array('user_id' => array('IN', $user_id_array)))->select();
            $to = array();
            foreach ($users as $user) {
                if (check_email($user['email'])) {
                    $to[] = $user['email'];
                }
            }
            $res = send_email($to, $title, $message);
            echo "<script>parent.{$call_back}('{$res['status']}');</script>";
            exit();
        }
    }

    /*
     *婚恋区会员列表
     */
    public function hunlian()
    {
        return $this->fetch();
    }

    /**
     * 婚恋区会员列表
     */
    public function ajaxhunlian()
    {
        // 搜索条件
        $condition = array();
        $condition['isdelete'] = 1;
        I('mobile') ? $condition['mobile'] = I('mobile') : false;
        $sort_order = I('order_by') . ' ' . I('sort');
        $model = M('loves');
        $count = $model->where($condition)->count();
        $Page = new AjaxPage($count, 10);
        //  搜索条件下 分页赋值
        foreach ($condition as $key => $val) {
            $Page->parameter[$key] = urlencode($val);
        }
        $userList = $model->where($condition)->order($sort_order)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        foreach ($userList as $k => $v) {
            if ($v['isout'] == 1) {
                $userList[$k]['isouts'] = '待审核';
            } elseif ($v['isout'] == 2) {
                $userList[$k]['isouts'] = '已审核';
            } elseif ($v['isout'] == 3) {
                $userList[$k]['isouts'] = '已注销';
            }
            if ($v['sex'] == 1) {
                $userList[$k]['sex'] = '男';
            } elseif ($v['sex'] == 2) {
                $userList[$k]['sex'] = '女';
            }
            if ($v['ishot'] == 1) {
                $userList[$k]['ishots'] = '否';
            } elseif ($v['ishot'] == 2) {
                $userList[$k]['ishots'] = '是';
            }
        }
        $show = $Page->show();
        $this->assign('pager', $Page);
        $this->assign('userList', $userList);
        $this->assign('page', $show);// 赋值分页输出
        //$this->assign('level',M('user_level')->getField('level_id,level_name'));
        return $this->fetch();
    }

    /*
    婚恋区会员详情
     */
    public function hunliandetail()
    {
        $uid = I('id/d', 0);
        $user = D('loves')->where(array('id' => $uid))->find();
        if (!$user) {
            $this->ajaxReturn(['status' => 0, 'msg' => '会员不存在']);
        }
        if ($user['sex'] == 1) {
            $user['sex'] = '男';
        } elseif ($user['sex'] == 2) {
            $user['sex'] = '女';
        }
        $this->assign('user', $user);
        return $this->fetch();
    }

    /*
    婚恋区会员注册申请审核
     */
    public function ajaxChangeTableVal()
    {
        $id = $_POST['id'];
        $isout = $_POST['isout'];
        if ($isout == '待审核') {
            $rs = M('loves')->where('id', $id)->save(array('isout' => 2));
            if ($rs) {
                echo 1;
            } else {
                echo 2;
            }
        } else {
            echo 3;
        }
    }

    /*
    婚恋区设置热搜会员
     */
    public function ajaxSetTableVal()
    {
        $id = $_POST['id'];
        $ishot = $_POST['ishot'];
        if ($ishot == '否') {
            $count = M('loves')->where('ishot=2')->count();
            if ($count >= 6) {
                echo 3;
            } else {
                $rs = M('loves')->where('id', $id)->save(array('ishot' => 2));
                if ($rs) {
                    echo 1;
                } else {
                    echo 2;
                }
            }
        } else {
            $re = M('loves')->where('id', $id)->save(array('ishot' => 1));
            if ($re) {
                echo 4;
            } else {
                echo 2;
            }
        }
    }

    /*
    婚恋区会员删除
     */
    public function hunlianajax_delete()
    {
        $id = $_POST['id'];
        $rs = M('loves')->where('id', $id)->delete();
        if ($rs) {
            $this->ajaxReturn(['status' => 1, 'msg' => '删除成功']);
        } else {
            $this->ajaxReturn(['status' => 0, 'msg' => '删除失败，请重试!']);
        }
    }

    /*
    婚恋会员排序
     */
    public function ajaxChangeSort()
    {
        $id = $_POST['id'];
        $sort = $_POST['sort'];
        M('loves')->where('id', $id)->save(array('sort' => $sort));
        echo 1;
    }

    /*
    婚恋区导出Excel表格
     */
    public function hunlianexport_user()
    {
        $strTable = '<table width="500" border="1">';
        $strTable .= '<tr>';
        $strTable .= '<td style="text-align:center;font-size:12px;width:30px;">会员ID</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="100px">会员名称</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="130px">会员身份证号</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="60px">性别</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="150px">会员籍贯</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="150px">会员工作</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="80px">手机号</td>';
        $strTable .= '<td style="text-align:center;font-size:12px;" width="120px">注册日期</td>';
        $strTable .= '</tr>';
        $count = M('loves')->where('isdelete', 1)->count();
        $p = ceil($count / 5000);
        for ($i = 0; $i < $p; $i++) {
            $start = $i * 5000;
            $end = ($i + 1) * 5000;
            $userList = M('loves')->where('isdelete', 1)->order('id')->limit($start . ',' . $end)->select();
            if (is_array($userList)) {
                foreach ($userList as $k => $val) {
                    $strTable .= '<tr>';
                    $strTable .= '<td style="text-align:center;font-size:12px;">' . $val['id'] . '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $val['name'] . ' </td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $val['identitynum'] . '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $val['sex'] . ' </td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $val['uhome'] . '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $val['uwork'] . '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $val['mobile'] . '</td>';
                    $strTable .= '<td style="text-align:left;font-size:12px;">' . $val['add_time'] . '</td>';
                    $strTable .= '</tr>';
                }
                unset($userList);
            }
        }
        $strTable .= '</table>';
        downloadExcel($strTable, 'users_' . $i);
        exit();
    }
}
