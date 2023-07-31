<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Recognize as RecognizeModel;
use app\common\model\RecognizeTrade;

class Recognize extends Controller
{
    public function plan()
    {
        $limit = input('limit', 10);
        $status = input('status', -1);
        $start_time = input('start_time', '', 'strtotime');
        $end_time = input('end_time', '', 'strtotime');
        $title= input('title', '');

        $lists = RecognizeModel::where(function ($query) use ($status, $start_time, $end_time, $title) {
            $status != -1 && $query->where('status', $status);
            !empty($start_time) && $query->where('start_time', '>=', $start_time);
            !empty($end_time) && $query->where('end_time', '<=', $end_time);
            $title != '' &&  $query->where('title', 'like', '%'. $title .'%');
        })->paginate($limit);
        $statusList = RecognizeModel::getStatusList();
        
        $this->assign('statusList', $statusList);
        $this->assign('lists', $lists);
        return $this->fetch();
    }

    public function planAdd(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $validate = validate('Recognize');
            if (!$validate->check($data)) {
                return json(
                    [
                        'code' => 0,
                        'msg' => $validate->getError(),
                        'data' => null
                    ]
                );
            }
            $result = action('common/Recognize/addPlan', [
                $data['title'],
                $data['price'],
                $data['total_qty'],
                $data['limit_qty'],
                $data['status'],
                $data['start_time'],
                $data['end_time'],
                $data['content'],
            ], 'logic', true);
            return json($result);
        } else {
            $statusList = RecognizeModel::getStatusList();
            $this->assign('statusList', $statusList);
            return $this->fetch('plan_add');
        }
    }

    public function planEdit(Request $request, $id = 0)
    {
        $recognize = RecognizeModel::get($id);
        if ($request->isPost()) {
            $data = $request->post();
            $result = $recognize->save($data);
            $result === false ?
                $this->result(null, 0, '编辑失败', 'json') :
                $this->result(['url' => url('Recognize/plan')], 1, '编辑成功', 'json');
        } else {
            $statusList = RecognizeModel::getStatusList();
            $this->assign('recognize', $recognize);
            $this->assign('statusList', $statusList);
            return $this->fetch('plan_add');
        }
    }

    public function trade(Request $request)
    {
        $limit = $request->param('limit', 10);
        $mobile = $request->param('mobile', '', 'trim');
        $trade_no = $request->param('trade_no', '', 'trim');
        $status = $request->param('status', '-1', 'intval');
        $pay_status = $request->param('pay_status', '-1', 'intval');
        $pay_type = $request->param('pay_type', '-1', 'intval');
        $start_time = input('start_time', '', 'strtotime');
        $end_time = input('end_time', '', 'strtotime');

        $statusList = RecognizeTrade::enumStatus();
        $payStatusList = RecognizeTrade::enumPayStatus();
        $payTypeList = RecognizeTrade::enumPayType();

        $recognizeTrade = RecognizeTrade::hasWhere('user', function ($query) use ($mobile) {
            $mobile != '' && $query->where('mobile', $mobile);
        })->where(function ($query) use ($trade_no, $status, $pay_status, $pay_type, $start_time, $end_time) {
            !empty($start_time) && $query->where('start_time', '>=', $start_time);
            !empty($end_time) && $query->where('end_time', '<=', $end_time);
            $status != -1 && $query->where('status', $status);
            $pay_status != -1 && $query->where('pay_status', $pay_status);
            $pay_type != -1 && $query->where('pay_type', $pay_type);
            $trade_no != '' && $query->where('trade_no', $trade_no);
        })->paginate($limit);

        $this->assign('statusList', $statusList);
        $this->assign('payStatusList', $payStatusList);
        $this->assign('payTypeList', $payTypeList);
        $this->assign('lists', $recognizeTrade);
        return $this->fetch();
    }

    public function cancelTrade(Request $request, $trade_id = 0)
    {
        $result = action('common/Recognize/cancelTrade', [$trade_id], 'logic', true);
        return json($result);
    }

    public function test()
    {
        dump(action('common/Recognize/addTrade', [1, 1, 100], 'logic', true));
        //dump(action('common/Recognize/cancelTrade', [2], 'logic', true));
        //dump(action('common/Recognize/payTrade', [1, 1, 500, 1], 'logic', true));
        //dump(action('common/Recognize/completeTrade', [2], 'logic', true));
    }
}
