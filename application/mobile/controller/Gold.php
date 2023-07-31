<?php
namespace app\mobile\controller;

use app\common\logic\CartLogic;
use app\common\logic\StoreLogic;
use app\common\logic\UsersLogic;
use app\common\logic\OrderGoodsLogic;
use app\common\logic\MessageLogic;
use app\common\logic\CommentLogic;
use app\common\model\Users;
use think\Page;
use think\Verify;
use think\Db;

class Gold extends MobileBase
{
    public $user_id = 0;
    public $user = array();

    /*
     * 初始化操作
     */
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
        }
        $nologin = array();
        if (!$this->user_id && !in_array(ACTION_NAME, $nologin)) {
            header("location:" . U('Mobile/User/login'));
            exit;
        }
        $this->assign('order_status_coment', $order_status_coment);
    }

    /*
     * 用户中心首页
     */
    public function index()
    {
        $buyList = action('Goldchain/buyList');
        $soldList = action('Goldchain/soldList');
        $this->assign('soldList', $soldList);
        $this->assign('buyList', $buyList);
        return $this->fetch();
    }

    /**
     * 交易明细
     */
    public function business()
    {
        return $this->fetch();
    }

    /**
     * 挖矿
     */
    public function wakuang()
    {
        $user = session('user');
        $all_consume_cp = Db::name('users')->sum('consume_cp');
        $this->assign('user', $user); //存储用户信息
        $this->assign('all_consume_cp', number_format($all_consume_cp, config('default_decimal_scale'), '.', '')); //全网算力
        return $this->fetch();
    }

    /**
     * gold_chain页面
     */
    public function gold_chain()
    {
        $user = session('user');
        $id = $user["user_id"];
        $time = date("Y-m-d", time());
        $date = M('jinnum_log')->where("creat_time LIKE '" . $time . "%' and uid={$id}")->select();
        $yestday = 0;

        $res = action('common/Goldchain/getOpenPrice', array(), 'logic', true);
        $user = Users::get($this->user_id);

        $price = number_format($res, config('default_decimal_scale'), '.', '');
        $jin_num = number_format($user->jin_num, config('default_decimal_scale'), '.', '');
        $value = bcmul(
            $price,
            $jin_num,
            config('default_decimal_scale')
        );

        foreach ($date as $v) {
            $yestday += $v["jin_num"];
        }
        $this->assign('price', $price);
        $this->assign('value', $value);
        $this->assign("yestday", $yestday);
        $this->assign('user', $user);
        return $this->fetch();
    }

    /**
     * 我要奉献
     */
    public function dedication()
    {
        if (IS_POST) {
            $dedication_money = I('post.dedication_money') ? : 0;
            $consume_cp = $this->user['consume_cp'];
            if ($dedication_money <= 0) {
                $this->ajaxReturn(['status' => 0, 'msg' => '奉献算力必须大于0']);
            }
            if ($dedication_money > $consume_cp) {
                $this->ajaxReturn(['status' => 0, 'msg' => '当前算力不足']);
            }
            $res = accountLog($this->user_id, 0, 0, '奉献减算力', 0, 0, '', 0, 0, 0, 0, -$dedication_money);
            $res = accountLog($this->user_id, 0, 0, '奉献加奉献值', 0, 0, '', 0, 0, 0, $dedication_money, 0);
            if ($res) {
                $this->ajaxReturn(['status' => 1, 'msg' => '奉献成功']);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => '奉献失败']);
            }
        }
        $this->assign('dedication_money', $this->user['dedication_money']);
        $this->assign('consume_cp', $this->user['consume_cp']);
        return $this->fetch();
    }

    /**
     * 奉献值记录
     */
    public function dedication_list()
    {
        $type = I('type', 'all');
        $usersLogic = new UsersLogic;
        $result = $usersLogic->dedication($this->user_id, $type);

        $this->assign('type', $type);
        $showpage = $result['page']->show();
        $this->assign('account_log', $result['account_log']);
        $this->assign('page', $showpage);
        if ($_GET['is_ajax']) {
            return $this->fetch('ajax_dedication_list');
        }
        return $this->fetch();
    }

    /**
     * 算力记录
     */
    public function consume_list()
    {
        $type = I('type', 'plus');
        $usersLogic = new UsersLogic;
        $result = $usersLogic->consume($this->user_id, $type);

        $this->assign('type', $type);
        $showpage = $result['page']->show();
        $this->assign('account_log', $result['account_log']);
        $this->assign('page', $showpage);
        if ($_GET['is_ajax']) {
            return $this->fetch('ajax_consume_list');
        }
        return $this->fetch();
    }
    public function demand()
    {
        return $this->fetch();
    }

    /**
     * 钱包地址
     */
    public function wallet_address()
    {
        $user_id = $this->user_id;
        Vendor('phpqrcode.phpqrcode');
        //生成二维码图片
        $object = new \QRcode();
        $save_path = 'public/pub_key/';  //图片存储的绝对路径
        if (!file_exists($save_path)) {
            mkdir($save_path, 0777, true);
        }
        $filename = $save_path . "$user_id" . '.png';
        //$url= url('Mobile/User/reg','',true,true)."?tuimobile=$mobile";
        $level = 3;
        $size = 4;
        $errorCorrectionLevel = intval($level);//容错级别
        $matrixPointSize = intval($size);//生成图片大小
        $pub_key = $this->user['public_key'];
        $pri_key = $this->user['private_key'];
        if (!$pub_key || !$pri_key) {

            $user = Users::get(function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            });
            $pub_keys = Users::column('public_key');
            $pri_keys = Users::column('private_key');
            do {
                $pub_key = make_nonce_str(32, 6);
                $pri_key = make_nonce_str(32, 6);
            } while (in_array($pub_key, $pub_keys) || in_array($pri_key, $pri_keys));
            $user->public_key = $pub_key;
            $user->private_key = $pri_key;
            $user->save();
        }
        $result = array(
            'name' => $this->user['nickname'],
            'pub_key' => $pub_key,
        );
        $object->png(json_encode($result), $filename, $errorCorrectionLevel, $matrixPointSize, 2);
        $filenames = '/' . $save_path . "$user_id" . '.png';
        $this->assign('pic', $filenames);
        $this->assign('pub_key', $pub_key);
        $this->assign('pri_key', $pri_key);
        return $this->fetch();
    }

    /**
     * 新淘链转账
     */
    public function transfer()
    {
        C('TOKEN_ON', true);
        if ($this->user['is_lock'] == 1) $this->error('账号异常已被锁定！');

        if (IS_POST) {
            if (session('__token__') !== I('post.__token__', '')) {
                $this->ajaxReturn(['status' => 0, 'msg' => '参数错误']);
            };
            $money = I('post.money', 0);//转账的新淘链
            if ($money <= 0) {
                $this->ajaxReturn(['status' => 0, 'msg' => '请确定转账金额大于0 ', 'url' => U('Mobile/Gold/transfer_list')]);
            }
            $rechargePayMoney = getUserRechargePayMoney($this->user_id);
            if ($rechargePayMoney < 50) {
                $this->ajaxReturn(['status' => 0, 'msg' => '您的实际充值金额小于50,不能进行转账', 'url' => U('Mobile/Gold/transfer_list')]);
            }
            $public_key = I('post.public_key');//公钥
            $user_id = $this->user_id;
            $desc = I('post.desc');
            $users = M('users')->where('public_key', $public_key)->find();
            if (!$users) {
                $this->ajaxReturn(['status' => 0, 'msg' => '收款人账号不存在']);
            }
            $money = floatval($money);
            $jin_num = floatval($this->user['jin_num']);
            if ($money > $jin_num) {
                $this->ajaxReturn(['status' => 0, 'msg' => '您的新淘链不足']);
            }
            $log_id = jin_transfer_log($user_id, $money, $desc, $users['user_id'], 1, 0);
            if ($log_id != false) {
                Db::startTrans();
                $re = accountLog($user_id, 0, 0, '新淘链转账', 0, 0, 0, 0, 0, -$money);//扣除转账人的新淘链
                //如果有手续费
                $jin_fee = tpCache('basic.jin_fee') / 100;//新淘链转账手续费比例
                if ($jin_fee <= 0) {
                    $shouxu = 0;
                } else {
                    $shouxu = bcmul(number_format($money, 6, '.', ''), number_format($jin_fee, 2, '.', ''));
                }
                $shi_money = $money - $shouxu;
                $res = accountLog($users['user_id'], 0, 0, '新淘链收账', 0, 0, 0, 0, 0, $shi_money);//增加收账人的新淘链
                if ($re && $res) {
                    $update = Db::name('jin_transfer_log')->where('id', $log_id)->update(array('status' => 1));
                    $update ? Db::commit() : Db::rollback();
                } else {
                    Db::rollback();
                    $updates = Db::name('jin_transfer_log')->where('id', $log_id)->update(array('status' => 2));
                }
                if ($update) {
                    $this->ajaxReturn(['status' => 1, 'msg' => '转账成功', 'url' => U('Mobile/Gold/transfer_list')]);
                }
                $updates && $this->ajaxReturn(['status' => 0, 'msg' => '转账失败', 'url' => U('Mobile/Gold/transfer')]);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => '转账失败,网络异常']);
            }
        }
        $this->assign('user', $this->user);
        $this->assign('jin_fee', tpCache('basic.jin_fee'));
        return $this->fetch();
    }

    /**
     * 转账记录
     */
    public function transfer_list()
    {
        $type = I('type', 'plus');
        $usersLogic = new UsersLogic;
        $result = $usersLogic->transfer($this->user_id, $type);
        foreach ($result['account_log'] as $k => $v) {
            $re = Db::name('users')->where('user_id', $v['user_id'])->find();
            $result['account_log'][$k]['nickname'] = $re['nickname'];
        }
        $this->assign('type', $type);
        $showpage = $result['page']->show();
        $this->assign('account_log', $result['account_log']);
        $this->assign('page', $showpage);
        if ($_GET['is_ajax']) {
            return $this->fetch('ajax_transfer_list');
        }
        return $this->fetch();
    }

    /**
     * 算力转提现币
     */
    public function suanli_withdraw()
    {
        $consumeToWithdrawRebate = tpCache('basic.consumeToWithdrawRebate');
        $consumeToWithdrawFee = tpCache('basic.consumeToWithdrawFee');
        $consumeToWithdrawBase = tpCache('basic.consumeToWithdrawBase');
        $withdrawConsume = number_format($this->calcWidhdrawConsume($this->user_id), 0, '.', '');
        $this->assign('withdraw_consume', $withdrawConsume);
        $this->assign('consumeToWithdrawRebate', $consumeToWithdrawRebate);
        $this->assign('consumeToWithdrawFee', $consumeToWithdrawFee);
        $this->assign('consumeToWithdrawBase', $consumeToWithdrawBase);
        return $this->fetch();
    }
    
    public function doct()
    {
        $request = request();
        if ($request->isPost()) {
            $consumeToWithdrawRebate = tpCache('basic.consumeToWithdrawRebate') == '' ? '2:1' : tpCache('basic.consumeToWithdrawRebate');
            $consumeToWithdrawFee = tpCache('basic.consumeToWithdrawFee') ? : 0;
            $consumeToWithdrawBase = tpCache('basic.consumeToWithdrawBase') ? : 100;
            $withdrawConsume = $this->calcWidhdrawConsume($this->user_id); //可提现算力
            $donate = $request->param('donate');
            if ($donate <= 0) {
                return json(array(
                    'code' => '0',
                    'msg' => '提现算力大于0',
                    'data' => null,
                ));
            }
            if ($donate > $withdrawConsume) {
                return json(array(
                    'code' => '0',
                    'msg' => '提现算力不能大于可提现算力',
                    'data' => null,
                ));
            }
            if ($donate % $consumeToWithdrawBase != 0) {
                return json(array(
                    'code' => '0',
                    'msg' => '提现算力必须是' . $consumeToWithdrawBase . '的整数倍',
                    'data' => null,
                ));
            }
            $ratio = explode(':', $consumeToWithdrawRebate);
            $withdraw_money = round($donate * $ratio[1] / $ratio[0]); //算力按比例转换提现币
            $poundage = $withdraw_money * $consumeToWithdrawFee / 100; //手续费
            $fact_withdraw_money = round($withdraw_money - $poundage); //实际到账提现币

            //减算力，加提现币
            if (!accountLog($this->user_id, 0, 0, '消费算力提现减少算力', 0, 0, '', 0, 0, 0, 0, -$donate)) {
                return json(array(
                    'code' => '0',
                    'msg' => '提现算力失败，原因:扣除算力时发生错误',
                    'data' => null,
                ));
            }
            if (!accountLog($this->user_id, 0, 0, '消费算力提现增加提现币,扣除手续费:' . $poundage, 0, 0, '', 0, $fact_withdraw_money)) {
                return json(array(
                    'code' => '0',
                    'msg' => '提现算力失败，原因:增加提现币失败',
                    'data' => null,
                ));
            }
            return json(array(
                'code' => '1',
                'msg' => '提现成功',
                'data' => array(
                    'donate' => $donate,
                    'withdraw_money' => $withdraw_money,
                    'poundage' => $poundage,
                    'fact_withdraw_money' => $fact_withdraw_money,
                ),
            ));
        } else {
            $this->error('非法提交');
        }
    }

    /**
     * 计算可提现算力
     * @param integer $user_id 用户id
     * @return float 返回可提现算力数值
     */
    private function calcWidhdrawConsume($user_id)
    {
        $user = get_user_info($user_id);
        $consume_cp = $user['consume_cp'];
        $jin_total = $user['jin_total'];
        if (bccomp($jin_total, $consume_cp) >= 0) {
            return 0;
        } else {
            return bcsub($consume_cp, $jin_total);
        }
    }
}
