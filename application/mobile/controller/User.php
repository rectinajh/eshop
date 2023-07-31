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

class User extends MobileBase
{
    public $user_id = 0;
    public $user = array();

    public function woka1()
    {
        update_pay_status('rechargeDN889Se5qg', '1');
    }

    /*
     * 初始化操作
     */
    public function _initialize()
    {
        parent::_initialize();
        if (session('?user')) {
            $user = session('user');
            if (isset($user['user_id'])) {
                $user = M('users')->where("user_id", $user['user_id'])->find();
                session('user', $user);  //覆盖session 中的 user
                $this->user = $user;
                $this->user_id = $user['user_id'];
                $this->assign('user', $user); //存储用户信息
            } else {
                $this->user_id = 0;
            }
        }
        $nologin = array(
            'login', 'pop_login', 'do_login', 'logout', 'verify', 'set_pwd', 'finished',
            'verifyHandle', 'reg', 'send_sms_reg_code', 'find_pwd', 'check_validate_code',
            'forget_pwd', 'check_captcha', 'check_username', 'send_validate_code', 'express',
        );
        if (!$this->user_id && !in_array(ACTION_NAME, $nologin)) {
            header("location:" . U('Mobile/User/login'));
            exit;
        }
        $order_status_coment = array(
            'WAITPAY' => '待付款 ', //订单查询状态 待支付
            'WAITSEND' => '待发货', //订单查询状态 待发货
            'WAITRECEIVE' => '待收货', //订单查询状态 待收货
            'WAITCCOMMENT' => '待评价', //订单查询状态 待评价
        );
        $this->assign('order_status_coment', $order_status_coment);
    }

    /*
     * 用户中心首页
     */
    public function index()
    {
        $user_id = $this->user_id;
        if ($user_id) {
            $info = M('users')->where("user_id=$user_id")->find();
            $tuimobile = $info['tuimobile'];
            $res = M('users')->where("mobile='{$tuimobile}'")->find();
            $nickname = $res['nickname'];
            $this->assign('nickname', $nickname);
        }

        $logic = new UsersLogic();
        $user = $logic->getMobileUserInfo($user_id); //当前登录用户信息
        $comment_count = M('comment')->where("user_id", $user_id)->count();   // 我的评论数
        $level_name = M('user_level')->where("level_id", $this->user['level'])->getField('level_name'); // 等级名称
        $this->assign('level_name', $level_name);
        $this->assign('comment_count', $comment_count);
        $this->assign('user', $user['result']);
        $storeLogic = new StoreLogic();
        $storeNum = $storeLogic->getCollectNum($this->user_id);//店铺收藏数量
        //查询新增业绩
        $where['user_id'] = $user_id;
        $where['year'] = date("Y");
        $where['month'] = date('m');
        $yeji = Db::name('new_yeji')->where($where)->find();
        $this->assign('yeji', $yeji);
        $this->assign('storeNum', $storeNum);
        return $this->fetch();
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        setcookie('cn', '', time() - 3600, '/');
        setcookie('user_id', '', time() - 3600, '/');
        //$this->success("退出成功",U('Mobile/Index/index'));
        header("Location:" . U('Mobile/Index/index'));
        exit();
    }

    /**
     * 切换账号
     */
    public function shift()
    {
        session_unset();
        session_destroy();
        setcookie('cn', '', time() - 3600, '/');
        setcookie('user_id', '', time() - 3600, '/');
        //$this->success("退出成功",U('Mobile/Index/index'));
        header("Location:" . U('Mobile/User/login'));
        exit();
    }

    /*
     * 账户资金
     */
    public function account()
    {
        $user = session('user');
        //获取账户资金记录
        $logic = new UsersLogic();
        $data = $logic->get_account_log($this->user_id, I('get.type'));
        $account_log = $data['result'];
        $this->assign('user', $user);
        $this->assign('account_log', $account_log);
        $this->assign('page', $data['show']);
        if ($_GET['is_ajax']) {
            return $this->fetch('ajax_account_list');
        }
        return $this->fetch();
    }

    public function coupon()
    {
        //
        $logic = new UsersLogic();
        $data = $logic->get_coupon($this->user_id, $_REQUEST['type']);
        foreach ($data['result'] as $k => $v) {
            if ($v['use_type'] == 1) { //指定商品
                $data['result'][$k]['goods_id'] = M('goods_coupon')->field('goods_id')->where(['coupon_id' => $v['cid']])->getField('goods_id');
            }
            if ($v['use_type'] == 2) { //指定分类
                $data['result'][$k]['category_id'] = Db::name('goods_coupon')->where(['coupon_id' => $v['cid']])->getField('goods_category_id');
            }
        }
        $coupon_list = $data['result'];
        $store_id = get_arr_column($coupon_list, 'store_id');
        if (!empty($store_id)) {
            $store = M('store')->where("store_id in (" . implode(',', $store_id) . ")")->getField('store_id,store_name');
        }
        $this->assign('store', $store);
        $this->assign('coupon_list', $coupon_list);
        $this->assign('page', $data['show']);
        if ($_GET['is_ajax']) {
            return $this->fetch('ajax_coupon_list');
        }
        return $this->fetch();
    }

    /**
     * 确定订单的使用优惠券
     */
    public function checkcoupon()
    {
        $type = input('type');
        $now = time();
        $cartLogic = new \app\common\logic\CartLogic();
        // 找出这个用户的优惠券 没过期的  并且 订单金额达到 condition 优惠券指定标准的
        $cartLogic->setUserId($this->user_id);
        $result = $cartLogic->getUserCartList(1);//获取购物车商品
        $where = '';
        if (empty($type)) {
            $where = " c2.uid = {$this->user_id} and {$now} < c1.use_end_time and {$now} > c1.use_start_time and c1.condition <= {$result['total_price']['total_fee']} ";
        }
        if ($type == 1) {
            $where = " c2.uid = {$this->user_id} or c1.use_end_time < {$now} and c1.use_start_time > {$now} and c1.condition >= {$result['total_price']['total_fee']}";
        }
        $coupon_list = DB::name('coupon')
            ->alias('c1')
            ->field('c1.name,c1.money,c1.condition,c1.use_end_time, c2.*')
            ->join('coupon_list c2', 'c2.cid = c1.id and c1.type in(0,1,2,3) and order_id = 0', 'LEFT')
            ->where($where)
            ->select();
        $this->assign('coupon_list', $coupon_list); // 优惠券列表
        return $this->fetch();
    }

    /**
     *  登录
     */
    public function login()
    {

        if ($this->user_id > 0) {
            $sell_id = I('sell_id');
            if ($sell_id) {
                $store = session('store');
                $this->redirect(U('Mobile/User/giveshopmoney', array('store' => $store)));
            }
            $this->redirect(U('Mobile/User/index'));
        }
        $referurl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : U("Mobile/User/index");
        $this->assign('referurl', $referurl);
        return $this->fetch();
    }

    public function do_login()
    {
        $username = I('post.username');
        $password = I('post.password');
        $username = trim($username);
        $password = trim($password);
        //验证码验证
        /* if (isset($_POST['verify_code'])) {
            $verify_code = I('post.verify_code');
            $verify = new Verify();
            if (!$verify->check($verify_code, 'user_login')) {
                $res = array('status' => 0, 'msg' => '验证码错误');
                exit(json_encode($res));
            }
        } */
        $logic = new UsersLogic();

        $res = $logic->login($username, $password);


        if ($res['status'] == 1) {
            $res['url'] = urldecode(I('post.referurl'));
            session('user', $res['result']);
            setcookie('user_id', $res['result']['user_id'], null, '/');
            setcookie('is_distribut', $res['result']['is_distribut'], null, '/');
            $nickname = empty($res['result']['nickname']) ? $username : $res['result']['nickname'];
            setcookie('uname', urlencode($nickname), null, '/');
            setcookie('cn', 0, time() - 3600, '/');
            $cartLogic = new CartLogic();
            $cartLogic->doUserLoginHandle($this->session_id, $res['result']['user_id']);  //用户登录后 需要对购物车 一些操作
        }
        exit(json_encode($res));
    }

    /**
     *  注册
     */
    public function reg()
    {
        if ($this->user_id > 0) {
            $this->redirect(U('Mobile/User/index'));
        }
        $reg_sms_enable = tpCache('sms.regis_sms_enable');
        $reg_smtp_enable = tpCache('sms.regis_smtp_enable');

        $tuimobile = input('get.tuimobile');//推荐人id
        if (IS_POST) {
            $logic = new UsersLogic();
            //验证码检验
            //$this->verifyHandle('user_reg');
            $username = I('post.username', '');
            $password = I('post.password', '');
            $password2 = I('post.password2', '');

            $tuimobile = I('post.mobile', '');//推荐人手机号
            $paypwd = I('post.paypwd', '');
            $paypwd2 = I('post.paypwd2', '');

            $id_number = I('post.id_number', '');
            //是否开启注册验证码机制
            $code = I('post.mobile_code', '');
            $scene = I('post.scene', 1);
            //判断推荐人手机号
            $tui = M('users')->where("mobile", $tuimobile)->find();
            if (!$tui) {
                $this->ajaxReturn(['status' => 0, 'msg' => '推荐人不存在']);
            }
            $session_id = session_id();
            // if ($this->verifyHandle('user_reg') == false) {
            //     $this->ajaxReturn(['status'=>0,'msg'=>'图像验证码错误']);
            // }
            //是否开启注册验证码机制
            if (check_mobile($username)) {
                if ($reg_sms_enable) {
                    //手机功能没关闭
                    $check_code = $logic->check_validate_code($code, $username, 'phone', $session_id, $scene);
                    if ($check_code['status'] != 1) {
                        $this->ajaxReturn($check_code);
                    }
                }
            }
            //是否开启注册邮箱验证码机制
            if (check_email($username)) {
                if ($reg_smtp_enable) {
                    //邮件功能未关闭
                    $check_code = $logic->check_validate_code($code, $username);
                    if ($check_code['status'] != 1) {
                        $this->ajaxReturn($check_code);
                    }
                }
            }
            $data = $logic->reg($username, $password, $password2, $paypwd, $paypwd2, $id_number, $tuimobile);
            if ($data['status'] != 1) {
                $this->ajaxReturn($data);
            }
            session('user', $data['result']);
            setcookie('user_id', $data['result']['user_id'], null, '/');
            setcookie('is_distribut', $data['result']['is_distribut'], null, '/');
            $cartLogic = new CartLogic();
            $cartLogic->doUserLoginHandle($this->session_id, $data['result']['user_id']);  //用户登录后 需要对购物车 一些操作
            $this->ajaxReturn($data);
            exit;
        }
        $this->assign('tuimobile', $tuimobile);
        $this->assign('regis_sms_enable', $reg_sms_enable); // 注册启用短信：
        $this->assign('regis_smtp_enable', $reg_smtp_enable); // 注册启用邮箱：
        $sms_time_out = tpCache('sms.sms_time_out') > 0 ? tpCache('sms.sms_time_out') : 120;
        $this->assign('sms_time_out', $sms_time_out); // 手机短信超时时间
        return $this->fetch();
    }

    public function express()
    {
        $order_id = I('get.order_id/d', 0);
        $order_goods = M('order_goods')->where("order_id", $order_id)->select();
        $delivery = M('delivery_doc')->where("order_id", $order_id)->limit(1)->find();
        $this->assign('order_goods', $order_goods);
        $this->assign('delivery', $delivery);
        return $this->fetch();
    }

    /*
     * 用户地址列表
     */
    public function address_list()
    {
        $address_lists = Db::name('user_address')->where(array('user_id' => $this->user_id))->select();
        $region_list = Db::name('region')->cache(true)->getField('id,name');
        $this->assign('region_list', $region_list);
        $this->assign('lists', $address_lists);
        return $this->fetch();
    }

    /*
     * 添加地址
     */
    public function add_address()
    {
        if (IS_POST) {
            $logic = new UsersLogic();
            $data = $logic->add_address($this->user_id, 0, I('post.'));
            if ($data['status'] != 1)
                $this->ajaxReturn($data);
            elseif ($_POST['source'] == 'cart2') {
                $data['url'] = U('/Mobile/Cart/cart2', array('address_id' => $data['result']));
                $this->ajaxReturn($data);
            }
            $data['url'] = U('/Mobile/User/address_list');
            $this->ajaxReturn($data);
        }
        $p = M('region')->where(array('parent_id' => 0, 'level' => 1))->select();
        $this->assign('province', $p);
        return $this->fetch();
    }

    /*
     * 地址编辑
     */
    public function edit_address()
    {
        $id = I('id/d');
        $address = M('user_address')->where(array('address_id' => $id, 'user_id' => $this->user_id))->find();
        if (IS_POST) {
            $logic = new UsersLogic();
            $data = $logic->add_address($this->user_id, $id, I('post.'));
            if ($data['status'] != 1)
                $this->ajaxReturn($data);
            elseif ($_POST['source'] == 'cart2') {
                $data['url'] = U('/Mobile/Cart/cart2', array('address_id' => $data['result']));
                $this->ajaxReturn($data);
            }
            $data['url'] = U('/Mobile/User/address_list');
            $this->ajaxReturn($data);
        }
        //获取省份
        $p = M('region')->where(array('parent_id' => 0, 'level' => 1))->select();
        $c = M('region')->where(array('parent_id' => $address['province'], 'level' => 2))->select();
        $d = M('region')->where(array('parent_id' => $address['city'], 'level' => 3))->select();
        if ($address['twon']) {
            $e = M('region')->where(array('parent_id' => $address['district'], 'level' => 4))->select();
            $this->assign('twon', $e);
        }
        $this->assign('province', $p);
        $this->assign('city', $c);
        $this->assign('district', $d);

        $this->assign('address', $address);
        return $this->fetch();
    }

    /*
     * 设置默认收货地址
     */
    public function set_default()
    {
        $id = I('get.id/d');
        $source = I('get.source');
        M('user_address')->where(array('user_id' => $this->user_id))->save(array('is_default' => 0));
        $row = M('user_address')->where(array('user_id' => $this->user_id, 'address_id' => $id))->save(array('is_default' => 1));
        if ($source == 'cart2') {
            header("Location:" . U('Mobile/Cart/cart2'));
        } else {
            header("Location:" . U('Mobile/User/address_list'));
        }
        exit();
    }

    /*
     * 地址删除
     */
    public function del_address()
    {
        $id = I('id/d', '');

        $address = M('user_address')->where("address_id", $id)->find();
        $row = M('user_address')->where(array('user_id' => $this->user_id, 'address_id' => $id))->delete();                
        // 如果删除的是默认收货地址 则要把第一个地址设置为默认收货地址
        if ($address['is_default'] == 1) {
            $address2 = M('user_address')->where("user_id", $this->user_id)->find();
            $address2 && M('user_address')->where("address_id", $address2['address_id'])->save(array('is_default' => 1));
        }
        if (!$row)
            $this->ajaxReturn(['status' => 0, 'msg' => '操作失败', 'url' => U('User/address_list')]);
        else
            $this->ajaxReturn(['status' => 1, 'msg' => '操作成功', 'url' => U('User/address_list')]);
    }

    /**
     * @time 2016/8/5
     * @author dyr
     * 订单评价列表
     */
    public function comment_list()
    {
        $order_id = I('get.order_id/d');
        $store_id = I('get.store_id/d');
        $goods_id = I('get.goods_id/d');
        $part_finish = I('get.part_finish/d', 0);
        if (empty($order_id) || empty($store_id)) {
            $this->error("参数错误");
        } else {
            //查找店铺信息
            $store_where['store_id'] = $store_id;
            $store_info = M('store')->field('store_id,store_name,store_phone,store_address,store_logo')->where($store_where)->find();
            if (empty($store_info)) {
                $this->error("该商家不存在");
            }
            //查找订单是否已经被用户评价
            $order_comment_where['order_id'] = $order_id;
            $order_comment_where['deleted'] = 0;
            $order_info = M('order')->field('order_id,order_sn,is_comment,add_time')->where($order_comment_where)->find();
            //查找订单下的所有未评价的商品
            $order_goods_logic = new OrderGoodsLogic();
            $no_comment_goods = $order_goods_logic->get_no_comment_goods($order_id, $goods_id);
            $this->assign('store_info', $store_info);
            $this->assign('order_info', $order_info);
            $this->assign('no_comment_goods', $no_comment_goods);
            $this->assign('part_finish', $part_finish);
            return $this->fetch();
        }
    }

    /**
     * @time 2016/8/5
     * @author dyr
     *  添加评论
     */
    public function addComment()
    {
        $order_id = I('post.order_id/d', 0);
        $goods_id = I('post.goods_id/d', 0);
        $service_rank = I('post.store_speed_hidden', 0);
        $deliver_rank = I('post.store_sever_hidden', 0);
        $goods_rank = I('post.store_packge_hidden', 0);
        $goods_score = I('post.rank', 0);
        $anonymous = I('post.anonymous');
        $content = I('post.content', '');
        $tag = I('post.tag', '');
        $spec_key_name = I('post.spec_key_name', '');
        $impression = (empty($tag[0])) ? '' : implode(',', $tag);
        $is_anonymous = empty($anonymous) ? 1 : 0;
        $commentLogic = new CommentLogic;
        $return = $commentLogic->addGoodsAndServiceComment(
            $this->user_id,
            $order_id,
            $goods_id,
            $content,
            $is_anonymous,
            $spec_key_name,
            $impression,
            $goods_score,
            $service_rank,
            $deliver_rank,
            $goods_rank
        );
        if ($return['status'] !== 1) {
            return $this->error($return['msg']);
        }
        $this->success("评论成功", U('User/comment'));
    }
    public function comment_info()
    {
        $commentLogic = new \app\common\logic\CommentLogic;
        $comment_id = I('comment_id/d');
        $res = $commentLogic->getCommentInfo();
        if (!empty($res['comment_info']['img'])) $res['comment_info']['img'] = unserialize($res['comment_info']['img']);
        $this->assign('comment_info', $res['comment_info']);
        $this->assign('reply', $res['reply']);
        return $this->fetch();
    }

    /*
     * 个人信息
     */
    public function userinfo()
    {
        $userLogic = new UsersLogic();
        $user_info = $userLogic->get_info($this->user_id); // 获取用户信息
        $user_info = $user_info['result'];
        if (IS_POST) {
            $return = $userLogic->upload_headpic(false);
            if ($return['status'] !== 1) {
                $this->error($return['msg']);
            }
            $post['head_pic'] = $return['result'] ? : $user_info['head_pic'];
            I('post.nickname') ? $post['nickname'] = I('post.nickname') : false; //昵称
            I('post.qq') ? $post['qq'] = I('post.qq') : false;  //QQ号码
            I('post.head_pic') ? $post['head_pic'] = I('post.head_pic') : false; //头像地址
            I('post.sex') ? $post['sex'] = I('post.sex') : false;  // 性别
            I('post.birthday') ? $post['birthday'] = strtotime(I('post.birthday')) : false;  // 生日
            I('post.province') ? $post['province'] = I('post.province') : false;  //省份
            I('post.city') ? $post['city'] = I('post.city') : false;  // 城市
            I('post.district') ? $post['district'] = I('post.district') : false;  //地区
            I('post.email') ? $post['email'] = I('post.email') : false; //邮箱
            I('post.mobile') ? $post['mobile'] = I('post.mobile') : false; //手机
            $email = I('post.email');
            $mobile = I('post.mobile');
            $code = I('post.mobile_code', '');
            $scene = I('post.scene', 6);
            if (!empty($email)) {
                $c = M('users')->where(['email' => input('post.email'), 'user_id' => ['<>', $this->user_id]])->count();
                $c && $this->error("邮箱已被使用");
            }
            if (!empty($mobile)) {
                $c = M('users')->where(['mobile' => input('post.mobile'), 'user_id' => ['<>', $this->user_id]])->count();
                $c && $this->error("手机已被使用");
                if (!$code)
                    $this->error('请输入验证码');
                $check_code = $userLogic->check_validate_code($code, $mobile, 'phone', $this->session_id, $scene);
                if ($check_code['status'] != 1)
                    $this->error($check_code['msg']);
            }
            if (!$userLogic->update_info($this->user_id, $post))
                $this->error("保存失败");
            $this->success("操作成功");
            exit;
        }
        //  获取省份
        $province = M('region')->where(array('parent_id' => 0, 'level' => 1))->select();
        //  获取订单城市
        $city = M('region')->where(array('parent_id' => $user_info['province'], 'level' => 2))->select();
        //  获取订单地区
        $area = M('region')->where(array('parent_id' => $user_info['city'], 'level' => 3))->select();
        $this->assign('province', $province);
        $this->assign('city', $city);
        $this->assign('area', $area);
        $this->assign('user', $user_info);
        $this->assign('sex', C('SEX'));

        $action = I('get.action');
        if ($action != '') {
            return $this->fetch("$action");
        }
        return $this->fetch();
    }

    /*
     * 邮箱验证
     */
    public function email_validate()
    {
        $userLogic = new UsersLogic();
        $user_info = $userLogic->get_info($this->user_id); // 获取用户信息
        $user_info = $user_info['result'];
        $step = I('get.step', 1);
        //验证是否未绑定过
        if ($user_info['email_validated'] == 0)
            $step = 2;
        //原邮箱验证是否通过
        if ($user_info['email_validated'] == 1 && session('email_step1') == 1)
            $step = 2;
        if ($user_info['email_validated'] == 1 && session('email_step1') != 1)
            $step = 1;
        if (IS_POST) {
            $email = I('post.email');
            $code = I('post.code');
            $info = session('email_code');
            if (!$info)
                $this->error('非法操作');
            if ($info['email'] == $email || $info['code'] == $code) {
                if ($user_info['email_validated'] == 0 || session('email_step1') == 1) {
                    session('email_code', null);
                    session('email_step1', null);
                    if (!$userLogic->update_email_mobile($email, $this->user_id))
                        $this->error('邮箱已存在');
                    $this->success('绑定成功', U('Home/User/index'));
                } else {
                    session('email_code', null);
                    session('email_step1', 1);
                    redirect(U('Home/User/email_validate', array('step' => 2)));
                }
                exit;
            }
            $this->error('验证码邮箱不匹配');
        }
        $this->assign('step', $step);
        return $this->fetch();
    }

    /*
     * 手机验证
     */
    public function mobile_validate()
    {
        $userLogic = new UsersLogic();
        $user_info = $userLogic->get_info($this->user_id); // 获取用户信息
        $user_info = $user_info['result'];
        $step = I('get.step', 1);
        //验证是否未绑定过
        if ($user_info['mobile_validated'] == 0)
            $step = 2;
        //原手机验证是否通过
        if ($user_info['mobile_validated'] == 1 && session('mobile_step1') == 1)
            $step = 2;
        if ($user_info['mobile_validated'] == 1 && session('mobile_step1') != 1)
            $step = 1;
        if (IS_POST) {
            $mobile = I('post.mobile');
            $code = I('post.code');
            $info = session('mobile_code');
            if (!$info)
                $this->error('非法操作');
            if ($info['email'] == $mobile || $info['code'] == $code) {
                if ($user_info['email_validated'] == 0 || session('email_step1') == 1) {
                    session('mobile_code', null);
                    session('mobile_step1', null);
                    if (!$userLogic->update_email_mobile($mobile, $this->user_id, 2))
                        $this->error('手机已存在');
                    $this->success('绑定成功', U('Home/User/index'));
                } else {
                    session('mobile_code', null);
                    session('email_step1', 1);
                    redirect(U('Home/User/mobile_validate', array('step' => 2)));
                }
                exit;
            }
            $this->error('验证码手机不匹配');
        }
        $this->assign('step', $step);
        return $this->fetch();
    }

    /**
     *  我的收藏
     * @author lxl
     * @time17-3-28
     */
    public function collect_list()
    {
        $type = I('get.collect_type/d', '');
        if ($type == '') {
            //商品收藏
            $userLogic = new UsersLogic();
            $data = $userLogic->get_goods_collect($this->user_id);
            $this->assign('page', $data['show']);// 赋值分页输出
        } else {
            //店铺收藏
            $sc_id = I('get.sc_id/d');
            $storeLogic = new StoreLogic();
            $data = $storeLogic->getCollectStore($this->user_id, $sc_id);
        }
        $this->assign('lists', $data['result']);
        if ($_GET['is_ajax']) {
            return $this->fetch('ajax_collect_list');
        }
        return $this->fetch();
    }

    /*
     *取消收藏
     */
    public function cancel_collect()
    {
        $collect_id = I('collect_id/d');
        $user_id = $this->user_id;
        if (M('goods_collect')->where(["collect_id" => $collect_id, "user_id" => $user_id])->delete()) {
            $this->ajaxReturn(['status' => 1, 'msg' => "取消收藏成功", 'url' => U('User/collect_list')]);
        } else {
            $this->ajaxReturn(['status' => 1, 'msg' => "取消收藏失败", 'url' => U('User/collect_list')]);
        }
    }

    /**
     *  删除一个收藏店铺
     * @author lxl
     * @time17-3-28
     */
    public function del_store_collect()
    {
        $id = I('get.log_id/d');
        if (!$id)
            $this->error("缺少ID参数");
        $store_id = M('store_collect')->where(array('log_id' => $id, 'user_id' => $this->user_id))->getField('store_id');
        $row = M('store_collect')->where(array('log_id' => $id, 'user_id' => $this->user_id))->delete();
        M('store')->where(array('store_id' => $store_id))->setDec('store_collect');
        if ($row) {
            $this->ajaxReturn(['status' => 1, 'msg' => "取消收藏成功", 'url' => U('User/collect_list')]);
        } else {
            $this->ajaxReturn(['status' => 1, 'msg' => "取消收藏失败", 'url' => U('User/collect_list')]);
        }
    }

    public function message_list()
    {
        C('TOKEN_ON', true);
        if (IS_POST) {
            $this->verifyHandle('message');
            $data = I('post.');
            $data['user_id'] = $this->user_id;
            $user = session('user');
            $data['user_name'] = $user['nickname'];
            $data['msg_time'] = time();
            if (M('feedback')->add($data)) {
                $this->success("留言成功", U('User/message_list'));
                exit;
            } else {
                $this->error('留言失败', U('User/message_list'));
                exit;
            }
        }
        $msg_type = array(0 => '留言', 1 => '投诉', 2 => '询问', 3 => '售后', 4 => '求购');
        $count = M('feedback')->where("user_id=" . $this->user_id)->count();
        $Page = new Page($count, 100);
        $Page->rollPage = 2;
        $message = M('feedback')->where("user_id=" . $this->user_id)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $showpage = $Page->show();
        header("Content-type:text/html;charset=utf-8");
        $this->assign('page', $showpage);
        $this->assign('message', $message);
        $this->assign('msg_type', $msg_type);
        return $this->fetch();
    }

    public function points_list()
    {
        $type = I('type', 'all');
        $usersLogic = new UsersLogic;
        $result = $usersLogic->points($this->user_id, $type);

        $this->assign('type', $type);
        $showpage = $result['page']->show();
        $this->assign('account_log', $result['account_log']);
        $this->assign('page', $showpage);
        if ($_GET['is_ajax']) {
            return $this->fetch('ajax_points');
        }
        return $this->fetch();
    }

    public function account_list()
    {
        $type = I('type', 'all');
        $usersLogic = new UsersLogic;
        $result = $usersLogic->account($this->user_id, $type);

        $this->assign('type', $type);
        $showpage = $result['page']->show();
        $this->assign('account_log', $result['account_log']);
        $this->assign('page', $showpage);
        if ($_GET['is_ajax']) {
            return $this->fetch('ajax_acount_list');
        }
        return $this->fetch();
    }

    /*
     * 密码修改
     */
    public function password()
    {
        //检查是否第三方登录用户
        $logic = new UsersLogic();
        $data = $logic->get_info($this->user_id);
        $user = $data['result'];
        if ($user['mobile'] == '' && $user['email'] == '')
            $this->error('请先绑定手机或邮箱', U('/Mobile/User/index'));
        if (IS_POST) {
            $userLogic = new UsersLogic();
            $data = $userLogic->password($this->user_id, I('post.new_password'), I('post.confirm_password')); // 获取用户信息
            if ($data['status'] == -1)
                $this->error($data['msg']);
            $this->success($data['msg']);
            exit;
        }
        return $this->fetch();
    }

    public function forget_pwd()
    {
        if ($this->user_id > 0) {
            header("Location: " . U('User/Index'));
        }
        if (IS_POST) {
            $username = I('username');
            if (!empty($username)) {
                if (!$this->verifyHandle('forget')) {
                    $this->ajaxReturn(['status' => 0, 'msg' => "验证码错误"]);
                    exit;
                }
                $field = 'mobile';
                if (check_email($username)) {
                    $field = 'email';
                }
                $user = M('users')->where(['email' => $username])->whereOr(['mobile' => $username])->find();
                if ($user) {
                    session('find_password', array(
                        'user_id' => $user['user_id'], 'username' => $username,
                        'email' => $user['email'], 'mobile' => $user['mobile'], 'type' => $field
                    ));
                    $this->ajaxReturn(['status' => 1, 'msg' => '', 'url' => U('User/find_pwd')]);
                    exit;
                } else {
                    $this->ajaxReturn(['status' => 0, 'msg' => "用户名不存在，请检查"]);
                }
            }
        }
        return $this->fetch();
    }
    
    public function find_pwd()
    {
        if ($this->user_id > 0) {
            header("Location: " . U('User/Index'));
        }
        $user = session('find_password');
        if (empty($user)) {
            $this->error("请先验证用户名", U('User/forget_pwd'));
        }
        $this->assign('user', $user);
        return $this->fetch();
    }

    public function set_pwd()
    {
        if ($this->user_id > 0) {
            header("Location: " . U('User/Index'));
        }
        $check = session('validate_code');
        if (empty($check)) {
            header("Location:" . U('User/forget_pwd'));
        } elseif ($check['is_check'] == 0) {
            $this->error('验证码还未验证通过', U('User/forget_pwd'));
        }
        if (IS_POST) {
            $password = I('post.password');
            $password2 = I('post.password2');
            if ($password2 != $password) {
                $this->error('两次密码不一致', U('User/forget_pwd'));
            }
            if ($check['is_check'] == 1) {
                $user = M('users')->where("mobile = '{$check['sender']}' or email = '{$check['sender']}'")->find();
                if ($user) {
                    M('users')->where("user_id=" . $user['user_id'])->save(array('password' => encrypt($password)));
                    session('validate_code', null);
                    $this->success('新密码已设置请牢记新密码', U('User/index'));
                    exit;
                } else {
                    $this->error('操作失败，请稍后再试', U('User/forget_pwd'));
                }
            } else {
                $this->error('验证码还未验证通过', U('User/forget_pwd'));
            }
        }
        $is_set = I('is_set', 0);
        $this->assign('is_set', $is_set);
        return $this->fetch();
    }

    /**
     * 验证码验证
     * $id 验证码标示
     */
    private function verifyHandle($id)
    {
        $verify = new Verify();
        if (!$verify->check(I('post.verify_code'), $id ? $id : 'user_login')) {
            return false;
        }
        return true;
    }
    /**
     * 验证码获取
     */
    public function verify()
    {
        //验证码类型
        $type = I('get.type') ? I('get.type') : 'user_login';
        $config = array(
            'fontSize' => 30,
            'length' => 4,
            'imageH' => 60,
            'imageW' => 300,
            'fontttf' => '5.ttf',
            'useCurve' => true,
            'useNoise' => false,
        );
        $Verify = new Verify($config);
        $Verify->entry($type);
        exit();
    }
    /**
     * 账户管理
     */
    public function accountManage()
    {
        return $this->fetch();
    }
    public function order_confirm()
    {
        $id = I('get.id/d', 0);
        $data = confirm_order($id, $this->user_id);
        if ($data['status'] != 1) {
            $this->error($data['msg'], U('Mobile/Order/order_list'));
        } else {
            $this->success($data['msg'], U('Mobile/Order/order_detail', ['id' => $id]));
        }
    }

    public function recharge()
    {
        $order_id = I('order_id/d');
        $paymentList = M('Plugin')->where(function ($query) {
            $query->where('type', 'payment')
            ->where('status', 1)
            ->where('code', '<>', 'cod')
            ->where('scene', 'in', [0,1])
            ->where('pay_scene', 'in', [0,2]);
        })->select();
        //微信浏览器
        if (strstr($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')) {
            $paymentList = M('Plugin')->where("`type`='payment' and status = 1 and code='weixin'")->select();
        }
        $paymentList = convert_arr_key($paymentList, 'code');
        foreach ($paymentList as $key => $val) {
            $val['config_value'] = unserialize($val['config_value']);
            if ($val['config_value']['is_bank'] == 2) {
                $bankCodeList[$val['code']] = unserialize($val['bank_code']);
            }
        }
        $bank_img = include APP_PATH . 'home/bank.php'; // 银行对应图片
        $payment = M('Plugin')->where("`type`='payment' and status = 1")->select();
        $this->assign('paymentList', $paymentList);
        $this->assign('bank_img', $bank_img);
        $this->assign('bankCodeList', $bankCodeList);

        if ($order_id > 0) {
            $order = M('recharge')->where("order_id = $order_id")->find();
            $this->assign('order', $order);
        }
        return $this->fetch();
    }

    public function recharge_list()
    {
        $usersLogic = new UsersLogic;
        $result = $usersLogic->get_recharge_log($this->user_id);  //充值记录
        $this->assign('page', $result['show']);
        $this->assign('lists', $result['result']);
        if (I('is_ajax')) {
            return $this->fetch('ajax_recharge_list');
        }
        return $this->fetch();
    }

    /*
       积分转账
     */
    public function jifenTransfer()
    {
        C('TOKEN_ON', true);
        if ($this->user['is_lock'] == 1) $this->error('账号异常已被锁定！');
        $userid = $this->user_id;
        if (IS_POST) {
            if (session('__token__') !== I('post.__token__', '')) {
                $this->ajaxReturn(['status' => 0, 'msg' => '参数错误']);
            };
            $data['jstranser'] = -(trim(I('post.pay_points'), ''));//转账积分数
            $bili = tpCache('basic.jftransfer');//转账手续费比例
            $data['mobile'] = trim(I('post.mobile'));//收款人手机号
            $data['user_id'] = $userid;
            $data['desc'] = '积分转账';
            $data['order_sn'] = date("Ymd", time()) . time();
            $data['change_time'] = time();
            $data['shouxu'] = $data['jstranser'] * ($bili / 100);//转账手续费
            $pay_points = -$data['jstranser'] - $data['shouxu'];
            $data['pay_points'] = -$pay_points;
            $mobile = $data['mobile'];
            $jifen = -$data['jstranser'];
            $userinfo = M('users')->where(array('mobile' => $mobile))->find();
            if (!$userinfo) {
                $this->ajaxReturn(['status' => 0, 'msg' => '收款人账号不存在']);
            }
            $rs = M("account_log")->add($data);
           // $this->ajaxReturn(['status'=>0,'msg'=>$userid]);
            $rss = M('users')->where(array('user_id' => $userid))->setDec('pay_points', $pay_points);
            $rsss = M('users')->where(array('mobile' => $mobile))->setInc('pay_points', $jifen);
            if ($rs && $rss & $rsss) {
                $this->ajaxReturn(['status' => 1, 'msg' => '转账成功!', 'url' => U('Mobile/User/points_list')]);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => '转账失败!']);
            }
        }
        $shouxu = tpCache('basic.jftransfer');
        $this->assign('shouxu', $shouxu);
        $total_jifen = M('users')->where(array('user_id' => $userid))->getField('pay_points');
        $pay_points = $total_jifen * (1 - ($shouxu / 100));
        $this->assign('pay_points', $pay_points);
        return $this->fetch();
    }

    /**
     * 积分提现到余额
     * */
    public function jifenWithdrawal()
    {

        C('TOKEN_ON', true);
        $this->user['is_lock'] == 1 && $this->error('账号异常已被锁定！');
        $userid = $this->user_id;
        $pay_points = $this->user['pay_points'];

        if (IS_POST) {
            if (session('__token__') !== I('post.__token__', '')) {
                $this->ajaxReturn(['status' => 0, 'msg' => '参数错误']);
            };
            //$data = I('post.');
            $data['user_id'] = $userid;
            $data['create_time'] = time();
            $distribut_min = tpCache('basic.jifen'); // 最少提现额度
            $data['jifen'] = trim(I('post.pay_points'));
            if ($data['jifen'] < $distribut_min) {
                $this->ajaxReturn(['status' => 0, 'msg' => "每次最少提现额度' . $distribut_min"]);
            }
            if ($data['jifen'] > $pay_points) {
                $this->ajaxReturn(['status' => 0, 'msg' => "你最多可提现{$pay_points}账户积分."]);
            }
            $jifen = M('jifenlog')->where(array('user_id' => $userid, 'status' => 0))->sum('jifen');
            if ($pay_points < ($jifen + $data['jifen'])) {
                $this->ajaxReturn(['status' => 0, 'msg' => '您有提现申请待处理，本次提现积分不足']);
            }
            if (M('jifenlog')->add($data)) {
                $this->ajaxReturn(['status' => 1, 'msg' => '已提交申请!', 'url' => U('Mobile/User/points_list')]);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => '提交失败,联系客服!']);
            }
        }
        $shouxu = tpCache('basic.shou3');
        $this->assign('shouxu', $shouxu);
        return $this->fetch();

    }
    
    /*
    积分转帐记录
     */
    public function jftransfer_list()
    {
        $userid = $this->user_id;
        $count = M('transfer_log')->where(array('userid' => $userid))->count();
        $pagesize = C('PAGESIZE') == 0 ? 10 : C('PAGESIZE');
        $page = new Page($count, $pagesize);
        $list = M('transfer_log')->where(array('userid' => $userid))->order("id desc")->limit("{$page->firstRow},{$page->listRows}")->select();
        $this->assign('page', $page->show());// 赋值分页输出
        $this->assign('list', $list); // 下线
        if (I('is_ajax')) {
            return $this->fetch('ajax_withdrawals_list');
        }
        return $this->fetch();
    }

    /**
     * cash页面
     */
    public function cash()
    {
        $this->assign('withdraw_money', $this->user['withdraw_money']);
        return $this->fetch();
    }

    /**
     * 申请提现记录
     */
    public function withdrawals()
    {
        C('TOKEN_ON', true);
        if ($this->user['is_lock'] == 1) $this->error('账号异常已被锁定！');
        $fee = tpCache('basic.fee');//余额提现手续费
        if (IS_POST) {
            $unApproveCount = M('withdrawals')
                ->where('user_id', $this->user_id)
                ->where('status', 0)
                ->count(); //未审核的数量
            if ($unApproveCount > 0) {
                $this->ajaxReturn([
                    'status' => 0,
                    'msg' => '您有未处理的申请,不能重复提交,请耐心等待后台处理'
                ]);
            }
            $today = date('Y-m-d');
            $todayCount = M('withdrawals')
                ->where('user_id', $this->user_id)
                ->where('create_time', '>=', strtotime($today))
                ->count(); //今日提交的申请数量
            if ($todayCount > 0) {
                $this->ajaxReturn([
                    'status' => 0,
                    'msg' => '每天只能申请提现一次',
                ]);
            }
            $proportion = M('proportion')->where(array('id' => 1))->find();
            /* if(!$this->verifyHandle('withdrawals')){
                $this->ajaxReturn(['status'=>0,'msg'=>'验证码错误']);
            } */
            if (session('__token__') !== I('post.__token__', '')) {
                $this->ajaxReturn(['status' => 0, 'msg' => '参数错误']);
            };
            $data['bank_name'] = trim(I('post.bank_name', ''));
            $data['bank_card'] = trim(I('post.account_bank/d', ''));
            $data['realname'] = trim(I('post.account_name', ''));
            $data['money'] = trim(I('post.money/f', 0));
            $data['user_id'] = $this->user_id;
            $data['create_time'] = time();
            $data['paypwd'] = trim(I('post.paypwd', ''));  
            //$distribut_min = tpCache('distribut.min'); // 最少提现额度
            //$distribut_need  = tpCache('distribut.need'); //满多少才能提
            $distribut_min = tpCache('basic.min'); // 最少提现额度
            $distribut_need = tpCache('basic.need'); //满多少才能提
            $fee = tpCache('basic.fee');//余额提现手续费
            if ($data['money'] < $distribut_min) {
                $this->ajaxReturn(['status' => 0, 'msg' => '每次最少提现额度' . $distribut_min]);
            }
            if ($data['money'] > $proportion["ti_money"]) {
                $this->ajaxReturn(['status' => 0, 'msg' => "每日上限最多可提现" . $proportion["ti_money"] . "账户提现币."]);
            }
            if ($data['money'] > $this->user['withdraw_money']) {
                $this->ajaxReturn(['status' => 0, 'msg' => "你最多可提现{$this->user['withdraw_money']}账户提现币."]);
            }
            if ($this->user['withdraw_money'] < $distribut_need) {
                $this->ajaxReturn(['status' => 0, 'msg' => '账户提现币最少达到' . $distribut_need . '才能提现']);
            }
            $withdrawal = M('withdrawals')->where(array('user_id' => $this->user_id, 'status' => 0))->sum('shen_money');
            if ($this->user['withdraw_money'] < ($withdrawal + $data['money'])) {
                $this->ajaxReturn(['status' => 0, 'msg' => '您有提现申请待处理，本次提现币不足']);
            }
            //扣除手续费 重新赋值money
            $money = $data['money'];
            $data['fee'] = $money * $fee / 100;//手续费用 
            $data['money'] = $money - $data['fee'];//实际到账
            $data['shen_money'] = $money;//申请金额
            if (encrypt($data['paypwd']) != $this->user['paypwd']) {
                $this->ajaxReturn(['status' => 0, 'msg' => '支付密码错误']);
            } else {
                if (M('withdrawals')->add($data)) {
                    $bank['bank_name'] = $data['bank_name'];
                    $bank['bank_card'] = $data['account_bank'];
                    $bank['realname'] = $data['account_name'];
                    M('users')->where(array('user_id' => $this->user_id))->save($bank);
                    $this->ajaxReturn(['status' => 1, 'msg' => "已提交申请", 'url' => U('Mobile/User/withdrawals_list')]);
                } else {
                    $this->ajaxReturn(['status' => 0, 'msg' => '提交失败,联系客服!']);
                }
            }
            exit;
        }
        
        $where = " user_id = {$this->user_id}";
        $count = M('withdrawals')->where($where)->count();
        $page = new Page($count, 16);
        $list = M('withdrawals')->where($where)->order("id desc")->limit("{$page->firstRow},{$page->listRows}")->select();
        $this->assign('page', $page->show());// 赋值分页输出
        $this->assign('list', $list); // 下线
        if ($_GET['is_ajax']) {
            return $this->fetch('ajax_withdrawals_list');
        }
        $order_count = M('order')->where("user_id = {$this->user_id}")->count(); // 我的订单数
        $goods_collect_count = M('goods_collect')->where("user_id = {$this->user_id}")->count(); // 我的商品收藏
        $comment_count = M('comment')->where("user_id = {$this->user_id}")->count();//  我的评论数
        $coupon_count = M('coupon_list')->where("uid = {$this->user_id}")->count(); // 我的优惠券数量
        $level_name = M('user_level')->where("level_id = '{$this->user['level']}'")->getField('level_name'); // 等级名称
        $withdraw_money = $this->user['withdraw_money'];
        $this->assign('level_name', $level_name);
        $this->assign('order_count', $order_count);
        $this->assign('goods_collect_count', $goods_collect_count);
        $this->assign('comment_count', $comment_count);
        $this->assign('coupon_count', $coupon_count);
        $this->assign('withdraw_money', $withdraw_money);
        $this->assign('fee', $fee);
        return $this->fetch();
    }

    /**
     * 申请提现记录列表
     */
    public function withdrawals_list()
    {
        $withdrawals_where['user_id'] = $this->user_id;
        $count = M('withdrawals')->where($withdrawals_where)->count();
        $pagesize = C('PAGESIZE') == 0 ? 10 : C('PAGESIZE');
        $page = new Page($count, $pagesize);
        $list = M('withdrawals')->where($withdrawals_where)->order("id desc")->limit("{$page->firstRow},{$page->listRows}")->select();
        $this->assign('page', $page->show());// 赋值分页输出
        $this->assign('list', $list); // 下线
        if (I('is_ajax')) {
            return $this->fetch('ajax_withdrawals_list');
        }
        return $this->fetch();
    }

    /**
     * 我的关注
     * @author lhb
     * @time   2017/4
     */
    public function myfocus()
    {
        /* 获取收藏的商家数量 */
        $sc_id = I('get.sc_id/d');
        $storeLogic = new StoreLogic();
        $storeNum = $storeLogic->getCollectNum($this->user_id, $sc_id);
        /* 获取收藏的商品数量 */
        $goodsNum = M('goods_collect')->where(array('user_id' => $this->user_id))->count();
        $this->assign('storeNum', $storeNum);
        $this->assign('goodsNum', $goodsNum);

        $type = I('get.focus_type/d', 0);
        if ($type == 0) {
            //商品收藏
            $userLogic = new UsersLogic();
            $data = $userLogic->get_goods_collect($this->user_id);
            $this->assign('goodsList', $data['result']);
        } else {
            //店铺收藏
            $data = $storeLogic->getCollectStore($this->user_id, $sc_id);
            $this->assign('storeList', $data['result']);
        }

        if (I('get.is_ajax')) {
            return $this->fetch('ajax_myfocus');
        }
        return $this->fetch();
    }
    
    /*
     *取消收藏
     */
    public function del_goods_focus()
    {
        $collect_id = I('collect_id/d');
        $user_id = $this->user_id;
        if (M('goods_collect')->where(["collect_id" => $collect_id, "user_id" => $user_id])->delete()) {
            $this->success("取消收藏成功", U('User/myfocus'));
        } else {
            $this->error("取消收藏失败", U('User/myfocus'));
        }
    }

    /**
     *  删除一个收藏店铺
     * @author lxl
     * @time17-3-28
     */
    public function del_store_focus()
    {
        $id = I('get.log_id/d');
        if (!$id) {
            $this->error("缺少ID参数");
        }
        $store_id = M('store_collect')->where(array('log_id' => $id, 'user_id' => $this->user_id))->getField('store_id');
        $row = M('store_collect')->where(array('log_id' => $id, 'user_id' => $this->user_id))->delete();
        if ($row) {
            M('store')->where(array('store_id' => $store_id))->setDec('store_collect');
            $this->success("取消收藏成功", U('User/myfocus', 'focus_type=1'));
        } else {
            $this->error("取消收藏失败", U('User/myfocus', 'focus_type=1'));
        }
    }

    /**
     *  用户消息通知
     */
    public function message_notice()
    {
        $messageModel = new MessageLogic();
        $messages = $messageModel->getUserAllMaskMessage();
        foreach ($messages as $key => &$message) {
            if ($message['category'] == 1) {
                $message['category_name'] = '物流通知';
            } elseif ($message['category'] == 2) {
                $message['category_name'] = '优惠促销';
            } elseif ($message['category'] == 3) {
                $message['category_name'] = '商品提醒';
            } elseif ($message['category'] == 4) {
                $message['category_name'] = '我的资产';
            } elseif ($message['category'] == 5) {
                $message['category_name'] = '商城好店';
            } else {
                $message['category_name'] = '系统通知';
            }
        }
        $this->assign('messages', $messages);
        return $this->fetch('user/message_notice');
    }

    /**
     * ajax用户消息通知请求
     * @author dyr
     * @time 2016/09/01
     */
    public function ajax_message_notice()
    {
        $type = I('type', 0);
        $user_logic = new UsersLogic();
        $message_model = new MessageLogic();
        if ($type == 1) {
            //系统消息
            $user_sys_message = $message_model->getUserMessageNotice();
            $user_logic->setSysMessageForRead();
        } else if ($type == 2) {
            //活动消息：后续开发
            $user_sys_message = array();
        } else {
            //全部消息：后续完善
            $user_sys_message = $message_model->getUserMessageNotice();
        }
        $this->assign('messages', $user_sys_message);
        return $this->fetch('user/ajax_message_notice');
    }

    /**
     * 消息开关
     */
    public function message_switch()
    {
        $messageModel = new \app\common\logic\MessageLogic;
        $notice = $messageModel->getMessageSwitch($this->user['message_mask']);

        $this->assign('notice', $notice);
        return $this->fetch();
    }

    /**
     * 清除消息
     */
    public function clear_message()
    {
        $messageModel = new \app\common\logic\MessageLogic;
        $messageModel->setMessageRead($this->user_id);
        return $this->redirect('user/message_notice');
    }

    /**
     * 生成我的推广二维码
     */
    public function qrcode()
    {
        $user_id = $this->user_id;
        $info = M('users')->where("user_id=$user_id")->find();

        $mobile = $info['mobile'];
        Vendor('phpqrcode.phpqrcode');
        //生成二维码图片
        $object = new \QRcode();
        $save_path = 'public/qrimg/';  //图片存储的绝对路径
        if (!file_exists($save_path)) {
            mkdir($save_path, 0777, true);
        }
        $filename = $save_path . "$user_id" . '.png';
        $url = url('Mobile/User/reg', '', true, true) . "?tuimobile=$mobile";
        //$url="http://www.tuoldd.com/mobile/User/reg.html?tuimobile=$mobile";//网址或者是文本内容
        $level = 3;
        $size = 4;
        $errorCorrectionLevel = intval($level);//容错级别
        $matrixPointSize = intval($size);//生成图片大小
        $object->png($url, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
        $logo = "public/qrimg/logo.png";//准备好的logo图片
        $QR = $filename;//已经生成的原始二维码图
        if ($logo !== false) {
            $QR = imagecreatefromstring(file_get_contents($QR));
            $logo = imagecreatefromstring(file_get_contents($logo));
            $QR_width = imagesx($QR);//二维码图片宽度
            $QR_height = imagesy($QR);//二维码图片高度
            $logo_width = imagesx($logo);//logo图片宽度
            $logo_height = imagesy($logo);//logo图片高度
            $logo_qr_width = $QR_width / 5;
            $scale = $logo_width / $logo_qr_width;
            $logo_qr_height = $logo_height / $scale;
            $from_width = ($QR_width - $logo_qr_width) / 2;
            //重新组合图片并调整大小
            imagecopyresampled(
                $QR,
                $logo,
                $from_width,
                $from_width,
                0,
                0,
                $logo_qr_width,
                $logo_qr_height,
                $logo_width,
                $logo_height
            );
        }
        imagepng($QR, $filename);
        $filenames = '/' . $save_path . "$user_id" . '.png';
        $this->assign('pic', $filenames);
        $this->assign('mobile', $mobile);
        return $this->fetch();
    }

    /**
     * 异步设置消息
     */
    public function set_message_switch()
    {
        if (!$this->user) {
            ajaxReturn(['status' => -1, 'msg' => '用户不存在']);
        }

        $type = I('post.type/d', 0); //开关类型
        $val = I('post.val', 0); //开关值

        $messageModel = new \app\common\logic\MessageLogic;
        $return = $messageModel->setMessageSwitch($type, $val, $this->user);
        ajaxReturn($return);
    }

    /**
     * 浏览记录
     */
    public function visit_log()
    {
        $p = I('get.p', 1);
        $user_logic = new UsersLogic;
        $visit_list = $user_logic->visit_log($this->user_id, $p);

        $this->assign('visit_list', $visit_list);
        if (I('get.is_ajax', 0)) {
            return $this->fetch('ajax_visit_log');
        }
        return $this->fetch();
    }

    /**
     * 删除浏览记录
     */
    public function del_visit_log()
    {
        $visit_ids = I('get.visit_ids', 0);
        $row = M('goods_visit')->where('visit_id', 'IN', $visit_ids)->delete();

        if (!$row) {
            $this->error('操作失败', U('User/visit_log'));
        } else {
            $this->success("操作成功", U('User/visit_log'));
        }
    }

    /**
     * 清空浏览记录
     */
    public function clear_visit_log()
    {
        $row = M('goods_visit')->where('user_id', $this->user_id)->delete();

        if (!$row) {
            $this->error('操作失败', U('User/visit_log'));
        } else {
            $this->success("操作成功", U('User/visit_log'));
        }
    }

    /**
     * 支付密码
     * @return mixed
     */
    public function paypwd()
    {
        //检查是否第三方登录用户
        $logic = new UsersLogic();
        $data = $logic->get_info($this->user_id);
        $user = $data['result'];
        if ($user['mobile'] == '' && $user['email'] == '')
            $this->ajaxReturn(['status' => -1, 'msg' => '请先绑定手机号或者邮箱', 'result' => '']);
        $step = I('step', 1);
        if ($step > 1) {
            $check = session('validate_code');
            if (empty($check)) {
                $this->error('验证码还未验证通过', U('Home/User/paypwd'));
            }
        }
        if (IS_POST && $step == 2) {
            $oldpaypwd = trim(I('oldpaypwd'));
            $new_password = trim(I('new_password'));
            $confirm_password = trim(I('confirm_password'));
            $user = $this->user;
            //以前设置过就得验证原来密码
            if (!empty($user['paypwd']) && ($user['paypwd'] != encrypt($oldpaypwd))) {
                $this->ajaxReturn(['status' => -1, 'msg' => '原密码验证错误！', 'result' => '']);
            }
            $userLogic = new UsersLogic();
            $data = $userLogic->paypwd($this->user_id, $new_password, $confirm_password);
            $this->ajaxReturn($data);
            exit;
        }
        $this->assign('step', $step);
        return $this->fetch();
    }

    //扫码支付页面
    public function giveshopmoney()
    {
        if ($this->user_id) {
            if (IS_POST) {
                if ($_POST['type'] == 0) {
                    $this->ajaxReturn(['status' => 0, 'msg' => '请选择支付方式!']);
                }
                if ($_POST['code'] != $_SESSION['gm_code']) {
                    $_SESSION['gm_code'] = $_POST['code'];
                    $seller_id = (isset($_POST['seller_id']) ? intval($_POST['seller_id']) : '0');
                    $makemoney = (isset($_POST['makemoney']) ? intval($_POST['makemoney']) : '0');
                    //会员信息
                    $userinfo = M('users')->where("user_id", $this->user_id)->find();
                    if (empty($makemoney)) {
                        $this->ajaxReturn(['status' => 0, 'msg' => '请输入金额!']);
                    }
                    if ($userinfo['user_money'] < $makemoney) {
                        $this->ajaxReturn(['status' => 0, 'msg' => '余额不足!']);
                    }
                    //商家信息
                    $seller = M('seller')->where('seller_id', $seller_id)->find();
                    $shopInfo = M('users')->where('user_id', $seller['user_id'])->find();
                    //会员余额减少
                    $user_rs = M('users')->where("user_id", $this->user_id)->setDec('user_money', $makemoney);
                    //积分增加
                    $user_re = M('users')->where('user_id', $this->user_id)->setInc('pay_points', $makemoney);
                    $order_sn = null;
                    // 保证不会有重复订单号存在
                    while (true) {
                        $order_sn = date('YmdHis') . rand(1000, 9999); // 订单编号
                        $order_sn_count = M('order')->where("order_sn = '$order_sn' or master_order_sn = '$order_sn'")->count();
                        if ($order_sn_count == 0)
                            break;
                    }
                    if ($user_rs && $user_re) {
                        //记录插入order表
                        $order['order_sn'] = $order_sn;
                        $order['pay_status'] = 1;
                        $order['pay_code'] = 'cod';
                        $order['shipping_status'] = 1;
                        $order['order_status'] = 4;
                        $order['consignee'] = $userinfo['nickname'];
                        $order['mobile'] = $userinfo['mobile'];
                        $order['goods_price'] = $makemoney;
                        $order['pay_name'] = '店内扫码，余额支付';
                        $order['user_money'] = $makemoney;
                        $order['total_amount'] = $makemoney;
                        $order['order_amount'] = $makemoney;
                        $order['add_time'] = time();
                        $order['confirm_time'] = time();
                        $order['pay_time'] = time();
                        $order['user_id'] = $this->user_id;
                        $order['store_id'] = $seller_id;
                        $orderid = M('order')->insertGetId($order);
                        //会员信息添加到account_log表中
                        $data['user_id'] = $this->user_id;
                        $data['user_money'] = -$makemoney;
                        $data['change_time'] = time();
                        $data['pay_points'] = 0;
                        $data['desc'] = '到店下单消费';
                        $data['order_id'] = $orderid;
                        $data['order_sn'] = $order_sn;
                        M("account_log")->add($data);
                        $datas['user_id'] = $this->user_id;
                        $datas['pay_points'] = $makemoney;
                        $datas['change_time'] = time();
                        $datas['desc'] = '到店下单赠送积分';
                        $datas['order_id'] = $orderid;
                        $datas['order_sn'] = $order_sn;
                        M("account_log")->add($datas);
                        if ($userinfo['oauth'] == 'weixin') {
                            $wx_user = M('wx_user')->find();
                            $jssdk = new JssdkLogic($wx_user['appid'], $wx_user['appsecret']);
                            $wx_content = "你刚刚下了一笔订单:{$datas['order_sn']}!";
                            $jssdk->push_msg($user['openid'], $wx_content);
                        }
                        
                        //用户下单, 发送短信给商家
                        $res = checkEnableSendSms("3");
                        if ($res && $res['status'] == 1) {
                            $store = M('store')->where('store_id', $seller['store_id']);
                            $sender = (!empty($store) && !empty($store['service_phone'])) ? $store['service_phone'] : false;
                            $params = array('consignee' => $userinfo['nickname'], 'mobile' => $userinfo['mobile']);
                            $resp = sendSms("3", $sender, $params);
                        }
                        $this->ajaxReturn(['status' => 1, 'msg' => '付款成功，信息已发送到您手机', 'url' => U('Mobile/user/index')]);
                    }
                } else {
                    $this->ajaxReturn(['status' => 0, 'msg' => '请刷新重试!', 'url' => U('Mobile/User/giveshopmoneyone')]);
                }
            }
            $nick_name = $_GET['n'];
            $mobile_phone = $_GET['p'];
            $sell_id = $_GET['u'];//店铺ID
            $store = array(
                'nickname' => $nick_name,
                'mobile_phone' => $mobile_phone,
                'sell_id' => $sell_id
            );

            session('store', $store);
            $this->assign('code', rand(100000, 999999));
            $this->assign('mobile_phone', $mobile_phone);
            $this->assign('nick_name', $nick_name);
            $this->assign('user_id', $sell_id);
            return $this->fetch();
        } else {
            header('Location: ' . url("Mobile/user/login?sell_id=$sell_id"));
        }
    }

    public function ruzhu()
    {
        if ($this->user_id) {
            $userinfo = M('store')->where('user_id', $this->user_id)->find();
            $user = M('users')->where('user_id', $this->user_id)->getField('nickname');
            if ($userinfo) {
                $this->error('您已经是商家了', U('Index/index'), 1);
            }
            if (IS_POST) {
                $supplier_name = I('supplier_name');
                $address = I('address');
                $service_id = I('service_id');
                $place = I('demo1');
                $phone = I('phone');
                $name = I('name');
                $sc_id = I('sc_id');
                $dpname = I('dpname');
                $place = explode(',', $place);
                $sc_name = M('store_class')->where('sc_id', $sc_id)->getField('sc_name');
                $provinceId = M('region')->where("name like '%$place[0]%'")->getField('level');
                $cityId = M('region')->where("name like '%$place[1]%'")->getField('id');
                $districtId = M('region')->where("name like '%$place[2]%'")->getField('id');
                //插入店铺申请表
                $data['user_id'] = $this->user_id;
                $data['contacts_name'] = $name;
                $data['contacts_mobile'] = $phone;
                $data['store_name'] = $supplier_name;
                $data['seller_name'] = $dpname;
                $data['store_address'] = $address;
                $data['service_id'] = $service_id;
                $data['sc_name'] = $sc_name;
                $data['sc_id'] = $sc_id;
                $data['add_time'] = time();
                $store_apply = M('store_apply')->add($data);
                $id = M('store_apply')->where(array('user_id' => $this->user_id))->getField('id');
                $data['id'] = $id;
                if ($data['id']) {
                    $data['apply_state'] = 1;
                    $apply = M('store_apply')->where(array('id' => $data['id']))->find();
                    if (empty($apply['store_name'])) {
                        $this->error('店铺名称不能为空.');
                    }
                    if ($apply && M('store_apply')->where("id=" . $data['id'])->save($data)) {
                        if ($data['apply_state'] == 1) {
                            $users = M('users')->where(array('user_id' => $apply['user_id']))->find();
                            $time = time();
                            $store_end_time = $time + 24 * 3600 * 365;//开店时长
                            $store = array(
                                'user_id' => $apply['user_id'], 'seller_name' => $apply['seller_name'], 'goods_examine' => 1, 'user_name' => empty($users['email']) ? $users['mobile'] : $users['email'],
                                'grade_id' => empty($data['sg_id']) ? 1 : $data['sg_id'], 'store_name' => $apply['store_name'], 'sc_id' => $apply['sc_id'],
                                'company_name' => $apply['company_name'], 'store_phone' => $apply['store_person_mobile'],
                                'store_address' => empty($apply['store_address']) ? '待完善' : $apply['store_address'],
                                'store_time' => $time, 'store_state' => 1, 'store_qq' => $apply['store_person_qq'],
                                'store_end_time' => $store_end_time, 'province_id' => $apply['company_province'],
                                'city_id' => $apply['company_city'], 'district' => $apply['company_district']
                            );
                            $store_id = M('store')->add($store);//通过审核开通店铺
                            if ($store_id) {
                                $seller = array(
                                    'seller_name' => $apply['seller_name'], 'user_id' => $apply['user_id'],
                                    'group_id' => 0, 'store_id' => $store_id, 'is_admin' => 1
                                );
                                M('seller')->add($seller);//点击店铺管理员
                                //绑定商家申请类目
                                if (!empty($apply['store_class_ids'])) {
                                    $goods_cates = M('goods_category')->where(array('level' => 3))->getField('id,name,commission');
                                    $store_class_ids = unserialize($apply['store_class_ids']);
                                    foreach ($store_class_ids as $val) {
                                        $cat = explode(',', $val);
                                        $bind_class = array(
                                            'store_id' => $store_id, 'commis_rate' => $goods_cates[$cat[2]]['commission'],
                                            'class_1' => $cat[0], 'class_2' => $cat[1], 'class_3' => $cat[2], 'state' => 1
                                        );
                                        M('store_bind_class')->add($bind_class);
                                    }
                                }
                                $store_logic = new \app\admin\logic\StoreLogic();
                                $store_logic->store_init_shipping($store_id);//初始化店铺物流
                            }
                        }
                    }
                }
                if ($store_apply) {
                    $this->ajaxReturn(['status' => 1, 'msg' => '申请成功，可登陆商家上传商品！', 'url' => U('Index/index')]);
                } else {
                    $this->ajaxReturn(['status' => 0, 'msg' => '操作失败，请重试！']);
                }
            }
            $sc = M('store_class')->select();
            $server = M('service')->select();
            $this->assign('server', $server);
            $this->assign('sc', $sc);
            return $this->fetch();
        } else {
            $this->error('请先登录', U('Mobile/Login/login'), 1);
        }
    }

    public function userclass()
    {
        $user_id = $this->user_id;
        $status = I('get.status');
        $logic = new CommentLogic;
        $data = $logic->getComments($user_id, $status); //获取评论列表
        $this->assign('page', $data['show']);// 赋值分页输出
        $this->assign('comment_page', $data['page']);
        $this->assign('comment_list', $data['result']);
        $this->assign('active', 'comment');
        if (I('is_ajax')) {
            return $this->fetch('ajax_class_list');
        }
        return $this->fetch();
    }
}
