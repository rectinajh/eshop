<?php

namespace app\admin\controller;

use think\Db;
use think\Controller;
use think\Request;
use think\Validate;
use app\common\model\Lottery as LotteryModel;
use app\common\model\LotteryChance;
use app\common\model\LotteryRecord;
use app\common\model\LotteryPrize;
use app\common\model\Users;

class Lottery extends Controller
{
    public function activity()
    {
        return $this->fetch();
    }

    public function activityAdd(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $result = $this->validate($data, 'Lottery');
            if ($result !== true) {
                return json([
                    'code' => 0,
                    'msg' => $result,
                    'data' => null,
                ]);
            }
            $lottery = LotteryModel::create($data);
            if (!isset($lottery->id)) {
                return json([
                    'code' => 0,
                    'msg' => '添加失败',
                    'data' => null,
                ]);
            }
            return json([
                'code' => 1,
                'msg' => '添加成功',
                'data' => null,
            ]);
        } else {
            return $this->fetch('activity_add');
        }
    }

    public function activityEdit(Request $request, $id = 0)
    {
        $lottery = LotteryModel::get($id);
        if ($request->isPost()) {
            $data = $request->post();
            $validateResult = $this->validate($data, 'Lottery');
            if ($validateResult !== true) {
                return json([
                    'code' => 0,
                    'msg' => $validateResult,
                    'data' => null,
                ]);
            }
            $result = $lottery->save($data);
            if ($result === false) {
                return json([
                    'code' => 0,
                    'msg' => '编辑失败',
                    'data' => null,
                ]);
            }
            return json([
                'code' => 1,
                'msg' => '编辑成功',
                'data' => null,
            ]);
        } else {
            $this->assign('lottery', $lottery);
            return $this->fetch('activity_add');
        }
    }

    public function lotteryList(Request $request)
    {
        $limit = $request->param('limit', 10, 'intval');
        $lottery = LotteryModel::where(function ($query) use ($request) {
            $status = $request->param('status', '-1', 'intval');
            $title = $request->param('title', '', 'trim');
            $status != -1 && $query->where('status', $status);
            $title != '' && $query->where('title', 'like', '%' . $title . '%');
        })->paginate($limit);

        $result = [
            'code' => 0,
            'msg' => '',
            'count' => $lottery->total(),
            'data' => $lottery->items(),
        ];
        return json($result);
    }

    public function prize()
    {
        return $this->fetch();
    }

    public function prizeAdd(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $result = $this->validate($data, 'Lottery');
            if ($result !== true) {
                return json([
                    'code' => 0,
                    'msg' => $result,
                    'data' => null,
                ]);
            }
            $lottery = LotteryModel::create($data);
            if (!isset($lottery->id)) {
                return json([
                    'code' => 0,
                    'msg' => '添加失败',
                    'data' => null,
                ]);
            }
            return json([
                'code' => 1,
                'msg' => '添加成功',
                'data' => null,
            ]);
        } else {
            return $this->fetch('prize_add');
        }
    }

    public function prizeEdit(Request $request, $id = 0)
    {
        $lottery = LotteryModel::get($id);
        if ($request->isPost()) {
            $data = $request->post();
            $validateResult = $this->validate($data, 'Lottery');
            if ($validateResult !== true) {
                return json([
                    'code' => 0,
                    'msg' => $validateResult,
                    'data' => null,
                ]);
            }
            $result = $lottery->save($data);
            if ($result === false) {
                return json([
                    'code' => 0,
                    'msg' => '编辑失败',
                    'data' => null,
                ]);
            }
            return json([
                'code' => 1,
                'msg' => '编辑成功',
                'data' => null,
            ]);
        } else {
            $this->assign('lottery', $lottery);
            return $this->fetch('prize_add');
        }
    }

    public function prizeList(Request $request, $lottery_id = 0)
    {
        $limit = $request->param('limit', 10, 'intval');
        $lottery = LotteryPrize::where(function ($query) use ($request) {
            $isShow = $request->param('is_show', '-1', 'intval');
            $isShow != -1 && !$query->where('is_show', $isShow);
            $name = $request->param('name', '', 'trim');
            $name != '' && $query->where('name', 'like', '%' . $name . '%');
        })->where('lottery_id', $lottery_id)->paginate($limit);
        $result = [
            'code' => 0,
            'msg' => '',
            'count' => $lottery->total(),
            'data' => $lottery->items(),
        ];
        return json($result);
    }
}
