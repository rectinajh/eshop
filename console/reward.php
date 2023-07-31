<?php
function reward_log($content)
{
    $time = date('Y-m-d H:i:s');
    $path = __DIR__ . '/log/';
    file_exists($path) || @mkdir($path);
    $fileName = date('Y-m-d') . '.log';
    $fullPath = $path . $fileName;
    error_log('=========================================================================' . PHP_EOL, 3, $fullPath);
    error_log($time . PHP_EOL, 3, $fullPath);
    error_log($content . PHP_EOL, 3, $fullPath);
    error_log('=========================================================================' . PHP_EOL, 3, $fullPath);
}

date_default_timezone_set("Asia/Shanghai");
ini_set('max_execution_time', 0);
set_time_limit(0);
ini_set('memory_limit', '2048M');
//header('content-type:text/html; charset=utf-8');
//实例化pdo对象

error_log(date('Y-m-d H:i:s') . "开始执行\n", 3, __DIR__ . '/log/' . date('Y-m-d') . '.log');
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=xintaotest;', 'xintaotest', 'xintao5050');
//通过query函数执行sql命令
$pdo->query('set names utf8');

/*
 *静态收益
 */

$award_time = date("Y-m-d", time());
$sql = "select `user_id`, `pid`, `consume_cp`, `user_money`, `jin_num`, `jin_total`, `consume_cp`, `recognize_num`, `user_performance`, `team_jin_num`, `static_time`, `dynamic_time`, `dynamic_jintai`, `dynamic_shangxian` from tp_users where static_time != '" . $award_time . "' and consume_cp > 0 order by user_id asc;";
$res = $pdo->query($sql);
$arr = $res->fetchAll(PDO::FETCH_ASSOC);

$sql = "select * from tp_proportion where id=1;";
$res = $pdo->query($sql);
$proportion = $res->fetch(PDO::FETCH_ASSOC);
$static_minimum_guarantee = $proportion['static_minimum_guarantee']; //静态最低保底奖励
reward_log('比例参数:' . var_export($proportion, true));

if ($arr) {
    reward_log('未返静态奖的全部用户' .var_export($arr, true));
    foreach ($arr as $k => $v) {
        reward_log('当前用户信息:' . var_export($v, true));
        $jintai = 0; //本次应返静态金额
        if ($v["consume_cp"] >= $proportion["one_min_consume"] && $proportion["one_consume"] >= $v["consume_cp"]) {//应该奖励的新淘链值
            $jintai = $v["consume_cp"] * $proportion["one_percent"] / 100;
        } elseif ($v["consume_cp"] >= $proportion["two_min_consume"] && $proportion["two_consume"] >= $v["consume_cp"]) {
            $jintai = $v["consume_cp"] * $proportion["two_percent"] / 100;
        } elseif ($v["consume_cp"] >= $proportion["three_min_consume"] && $proportion["three_consume"] >= $v["consume_cp"]) {
            $jintai = $v["consume_cp"] * $proportion["three_percent"] / 100;
        } elseif ($v["consume_cp"] >= $proportion["four_min_consume"] && $proportion["four_consume"] >= $v["consume_cp"]) {
            $jintai = $v["consume_cp"] * $proportion["four_percent"] / 100;
        } elseif ($v["consume_cp"] >= $proportion["five_min_consume"]) {
            $jintai = $v["consume_cp"] * $proportion["five_percent"] / 100;
        }
        $jintais = $v["jin_num"] + $jintai;
        $jin_total = $v["jin_total"] + $jintai;
        $jin_num = $jintai;
        $userStaticExcessStandard = $static_minimum_guarantee + $v["user_performance"] + $v["recognize_num"]; //静态最低保底+用户个人消费额+认筹数量
        $userStaticBase = $static_minimum_guarantee + $v["recognize_num"];
        if ($jin_total > $staticExcessStandard) {
            //即将获得的新淘链大于投资本金和保底
            reward_log(
                '用户id:' . $v['user_id']
                .'即将获得的新淘链大于投资本金jin_total:' . $jin_total
                . ', user_performance:' . $v['user_performance']
                . ', recognize_num:' . $v['recognize_num']
            );
            $totals = $userStaticBase + $v["user_performance"] * $proportion["static_capping"];//上限数量
            if ($jin_total >= $totals) {//即将获得的新淘链大于封顶值
                $shengyus = $jintai * $proportion["static_deduct"] / 100;//应当扣除的额外比例新淘链
                $shengyu = $jintai - $shengyus;//应当获得的新淘链
                $shengyu < 0 && $shengyu = 0;
                $suoyou = $v["jin_total"] + $shengyu;//获得后的新淘链数量
                if ($suoyou >= $totals) {//是否已经超出封顶
                    $xiaosheng = $totals - $v["jin_total"];//获得超出的数量
                    if ($xiaosheng > 0) {//数量大于零说明还有未超出封顶
                        $jintais = $v["jin_num"] + $xiaosheng;//减去超出的数量
                        $jin_total = $v["jin_total"] + $xiaosheng;
                        $jin_num = $xiaosheng;
                    } else {//完全超出封顶
                        $jintais = $v["jin_num"] + 0;
                        $jin_total = $v["jin_total"] + 0;
                        $jin_num = 0;
                    }
                } else {
                    $jintais = $v["jin_num"] + $shengyu;
                    $jin_total = $v["jin_total"] + $shengyu;
                    $jin_num = $shengyu;
                }
            } else {
                if ($v["jin_total"] >= $userStaticExcessStandard) {
                    $kexcess = $jintai * $proportion["static_deduct"] / 100;//超出的新淘链扣除比例
                    $jin_num = $jintai - $kexcess;
                    $jintais = $v["jin_num"] + $jin_num;
                    $jin_total = $v["jin_total"] + $jin_num;
                } else {
                    $excess = $jin_total - $userStaticExcessStandard;
                    $kexcess = $excess * $proportion["static_deduct"] / 100;//超出的新淘链扣除比例
                    $jin_num = $jintai - $kexcess;
                    $jintais = $v["jin_num"] + $jin_num;
                    $jin_total = $v["jin_total"] + $jin_num;
                }
            }
        }

        $param = compact('jin_num', 'jin_total');
        reward_log('最终静态奖参数:'. var_export($param, true));
        $log_jinnum["jin_num"] = $jin_num;
        $log_jinnum["uid"] = $v["user_id"];
        $time = date("Y-m-d h:i:s", time());
        $sqls = "update tp_users set jin_num=" . $jintais . ", jin_total=" . $jin_total . ", static_time='" . $award_time . "' where user_id = " . $v["user_id"] . ";";
        $res = $pdo->query($sqls);
        if ($jin_num > 0) {
            $in_sql = "insert into tp_jinnum_log (jin_num,uid,creat_time,type) values (" . $jin_num . "," . $v['user_id'] . ",'" . $time . "','" . "静态收益" . "');";
            $in_res = $pdo->query($in_sql);
        }
    }
} else {
    reward_log('未获取到未返静态奖的用户');
}

/*
 *动态收益
 */
$award_time = date("Y-m-d", time());
$sql = "select `user_id`, `pid`, `consume_cp`, `user_money`, `jin_num`, `jin_total`, `consume_cp`, `recognize_num`, `user_performance`, `team_jin_num`, `static_time`, `dynamic_time`, `dynamic_jintai`, `dynamic_shangxian` from tp_users where dynamic_time != '" . $award_time . "' order by user_id asc;";
$res = $pdo->query($sql);
$arr = $res->fetchAll(PDO::FETCH_ASSOC);
$time = date("Y-m-d h:i:s", time());
$sql = "select * from tp_proportion where id=1;";
$res = $pdo->query($sql);
$proportion = $res->fetch(PDO::FETCH_ASSOC);
if ($arr) {
    foreach ($arr as $key => $val) {
        $shangxian_jin = $val["jin_num"] * $proportion["dynamic_day_capping"] / 100;
        $sqls = "update tp_users set dynamic_jintai='0',dynamic_shangxian='" . $shangxian_jin . "'  where user_id = " . $val["user_id"] . ";";
        $res = $pdo->query($sqls);

        /*
         *直接分享区
         */
        $counts = "select count(`user_id`) from tp_users where pid = '" . $val["user_id"] . "';";
        $res = $pdo->query($counts);
        $arr = $res->fetchColumn();
        $all_jin = 0;
        $jintai_one = 0;
        if ($arr > 0) {
            $ssql = "select `user_id`, `pid`, `consume_cp`, `user_money`, `jin_num`, `jin_total`, `consume_cp`, `recognize_num`, `user_performance`, `team_jin_num`, `static_time`, `dynamic_time`, `dynamic_jintai`, `dynamic_shangxian` from tp_users where pid='" . $val["user_id"] . "';";
            $sres = $pdo->query($ssql);
            $son_users = $sres->fetchAll(PDO::FETCH_ASSOC);
            foreach ($son_users as $key => $value) {
                $all_jin += $value["consume_cp"];
            }

            $keyong_jin = $all_jin * $proportion["one_role"] / 100;
            if ($val["consume_cp"] >= $proportion["one_min_consume"] && $proportion["one_consume"] >= $val["consume_cp"]) {//应该奖励的新淘链值
                $jintai_one = $keyong_jin * $proportion["one_percent"] / 100;
            } elseif ($val["consume_cp"] >= $proportion["two_min_consume"] && $proportion["two_consume"] >= $val["consume_cp"]) {
                $jintai_one = $keyong_jin * $proportion["two_percent"] / 100;
            } elseif ($val["consume_cp"] >= $proportion["three_min_consume"] && $proportion["three_consume"] >= $val["consume_cp"]) {
                $jintai_one = $keyong_jin * $proportion["three_percent"] / 100;
            } elseif ($val["consume_cp"] >= $proportion["four_min_consume"] && $proportion["four_consume"] >= $val["consume_cp"]) {
                $jintai_one = $keyong_jin * $proportion["four_percent"] / 100;
            } elseif ($val["consume_cp"] >= $proportion["five_min_consume"]) {
                $jintai_one = $keyong_jin * $proportion["five_percent"] / 100;
            }
        } else {
            $jintai_one = 0;
        }

        if ($val["pid"] < 1 && $jintai_one > 0) {
            if ($val["dynamic_shangxian"] > $val["dynamic_jintai"]) {
                $jintai_numone = $val["jin_num"] + $jintai_one;
                $jintai_total = $val["jin_total"] + $jintai_one;
                $dynamic_jintaione = $val["dynamic_jintai"] + $jintai_one;
                if ($dynamic_jintaione > $val["dynamic_shangxian"]) {
                    $jintai_numone = $val["dynamic_shangxian"] - $val["dynamic_jintai"] + $val["jin_num"];
                    $jintai_total = $val["dynamic_shangxian"] - $val["dynamic_jintai"] + $val["jin_total"];
                    $jintai_one = $val["dynamic_shangxian"] - $val["dynamic_jintai"];
                    $dynamic_jintaione = $val["dynamic_shangxian"];
                }

                $sqls = "update tp_users set jin_num='" . $jintai_numone . "',dynamic_jintai='" . $dynamic_jintaione . "',dynamic_time='" . $award_time . "',jin_total='" . $jintai_total . "'  where user_id = " . $val["user_id"] . ";";
                $res = $pdo->query($sqls);


                $in_sql = "insert into tp_jinnum_log (jin_num,uid,creat_time,type) values (" . $jintai_one . "," . $val['user_id'] . ",'" . $time . "','" . "直接分享区动能算力');";
                $in_res = $pdo->query($in_sql);
            }
            $jintai_one = 0;
        }
        

        /*
         *全球关系算力
         */
        if ($val["pid"] > 0) {//全球关系算力
            $jintai_two = 0;
            $sql = "select `user_id`, `pid`, `consume_cp`, `user_money`, `jin_num`, `jin_total`, `consume_cp`, `recognize_num`, `user_performance`, `team_jin_num`, `static_time`, `dynamic_time`, `dynamic_jintai`, `dynamic_shangxian` from tp_users where user_id = " . $val["pid"] . ";";
            $res = $pdo->query($sql);
            $puser = $res->fetch(PDO::FETCH_ASSOC);
            if ($puser["consume_cp"] > 0) {
                $fan_consume = $puser["consume_cp"] * $proportion["global_consume"] / 100;
                if ($val["consume_cp"] >= $puser["consume_cp"]) {
                    if ($puser["consume_cp"] >= $proportion["one_min_consume"] && $proportion["one_consume"] >= $puser["consume_cp"]) {
                        $jintai_two = $fan_consume * $proportion["one_percent"] / 100;
                    } elseif ($puser["consume_cp"] >= $proportion["two_min_consume"] && $proportion["two_consume"] >= $puser["consume_cp"]) {
                        $jintai_two = $fan_consume * $proportion["two_percent"] / 100;
                    } elseif ($puser["consume_cp"] >= $proportion["three_min_consume"] && $proportion["three_consume"] >= $puser["consume_cp"]) {
                        $jintai_two = $fan_consume * $proportion["three_percent"] / 100;
                    } elseif ($puser["consume_cp"] >= $proportion["four_min_consume"] && $proportion["four_consume"] >= $puser["consume_cp"]) {
                        $jintai_two = $fan_consume * $proportion["four_percent"] / 100;
                    } elseif ($puser["consume_cp"] >= $proportion["five_min_consume"]) {
                        $jintai_two = $fan_consume * $proportion["five_percent"] / 100;
                    }
                } else {
                    if ($val["consume_cp"] >= $proportion["one_min_consume"] && $proportion["one_consume"] >= $val["consume_cp"]) {
                        $jintai_two = $fan_consume * $proportion["one_percent"] / 100;
                    } elseif ($val["consume_cp"] >= $proportion["two_min_consume"] && $proportion["two_consume"] >= $val["consume_cp"]) {
                        $jintai_two = $fan_consume * $proportion["two_percent"] / 100;
                    } elseif ($val["consume_cp"] >= $proportion["three_min_consume"] && $proportion["three_consume"] >= $val["consume_cp"]) {
                        $jintai_two = $fan_consume * $proportion["three_percent"] / 100;
                    } elseif ($val["consume_cp"] >= $proportion["four_min_consume"] && $proportion["four_consume"] >= $val["consume_cp"]) {
                        $jintai_two = $fan_consume * $proportion["four_percent"] / 100;
                    } elseif ($val["consume_cp"] >= $proportion["five_min_consume"]) {
                        $jintai_two = $fan_consume * $proportion["five_percent"] / 100;
                    }
                }
                $jintai_twos = $jintai_two;
                $jintai_two += $jintai_one;
                if ($jintai_two > 0) {
                    if ($val["dynamic_shangxian"] > $val["dynamic_jintai"]) {
                        $jintai_numtwo = $val["jin_num"] + $jintai_two;
                        $jintai_totaltwo = $val["jin_total"] + $jintai_two;
                        $dynamic_jintaitwo = $val["dynamic_jintai"] + $jintai_two;
                        //echo $jintai_numone."+".$val["jin_num"]."+".$jintai_one."+".$val["user_id"]."---";
                        if ($dynamic_jintaitwo > $val["dynamic_shangxian"]) {
                            $jintai_numtwo = $val["dynamic_shangxian"] - $val["dynamic_jintai"] + $val["jin_num"];
                            $dynamic_jintaitwo = $val["dynamic_shangxian"];

                            $hhjintai = $val["dynamic_shangxian"] - $val["dynamic_jintai"];
                            if ($hhjintai > $jintai_one) {
                                $jintai_twos = $hhjintai - $jintai_one;
                            } else {
                                $jintai_one = $hhjintai;
                                $jintai_twos = 0;
                            }

                            $jintai_totaltwo = $val["dynamic_shangxian"] - $val["dynamic_jintai"] + $val["jin_total"];
                            //echo $dynamic_jintaitwo."+".$val["dynamic_shangxian"]."+".$val["user_id"]."---";
                            $sqls = "update tp_users set jin_num='" . $jintai_numtwo . "',dynamic_jintai='" . $dynamic_jintaitwo . "',dynamic_time='" . $award_time . "',jin_total='" . $jintai_totaltwo . "'  where user_id = " . $val["user_id"] . ";";
                            $res = $pdo->query($sqls);
                        } else {
                            //echo $dynamic_jintaitwo."+".$val["dynamic_shangxian"]."+".$val["user_id"]."---";
                            $sqls = "update tp_users set jin_num='" . $jintai_numtwo . "',dynamic_jintai='" . $dynamic_jintaitwo . "',dynamic_time='" . $award_time . "',jin_total='" . $jintai_totaltwo . "'  where user_id = " . $val["user_id"] . ";";
                            $res = $pdo->query($sqls);
                        }

                        if ($jintai_one > 0) {
                            $in_sql = "insert into tp_jinnum_log (jin_num,uid,creat_time,type) values (" . $jintai_one . "," . $val['user_id'] . ",'" . $time . "','" . "直接分享区动能算力');";
                            $in_res = $pdo->query($in_sql);
                        }

                        if ($jintai_twos > 0) {
                            $in_sqls = "insert into tp_jinnum_log (jin_num,uid,creat_time,type,son_uid) values (" . $jintai_twos . "," . $val['user_id'] . ",'" . $time . "','" . "全球关系算力','" . $puser["user_id"] . "');";
                            $in_ress = $pdo->query($in_sqls);
                        }
                    }
                }
            }
        }


        /*
         *动态算力收益
         */
        $parent_arrs = array();
        $jintai_three = 0;
        $parent_arr = explode(",", $val["max_parents"]);
        rsort($parent_arr);
        foreach ($parent_arr as $k => $v) {
            if ($v > 0) {
                $ppsql = "select `user_id`, `pid`, `consume_cp`, `user_money`, `jin_num`, `jin_total`, `consume_cp`, `recognize_num`, `user_performance`, `team_jin_num`, `static_time`, `dynamic_time`, `dynamic_jintai`, `dynamic_shangxian` from tp_users where user_id=" . $v . ";";
                $ppres = $pdo->query($ppsql);
                $ppp = $ppres->fetch(PDO::FETCH_ASSOC);
                $parent_arrs[$k] = $ppp;
            }
        }
        $a = 1;
        $b = 1;
        $c = 1;
        $d = 1;
        foreach ($parent_arrs as $park => $prav) {
            $pingji_suanli = 0;
            $dongtai_suanli = 0;
            $dong_counts = "select count(`user_id`) from tp_users where pid = '" . $prav["user_id"] . "';";
            $dong_res = $pdo->query($dong_counts);
            $dong_arr = $dong_res->fetchColumn();
            if ($dong_arr >= 3) {
                if ($prav["team_performance"] >= $proportion["all_one"] && $prav["team_performance"] < $proportion["all_two"]) {
                    if ($dong_arr >= 3) {
                        if ($a == 2 && $b == 1 && $c == 1 && $d == 1) {//平级算力
                            $pingji_suanli += $val["consume_cp"] * $proportion["vis_role"] / 100;
                        } elseif ($a == 1 && $b == 1 && $c == 1 && $d == 1) {//创业合伙人动态算力
                            $dongtai_suanli += $val["consume_cp"] * $proportion["two_role"] / 100;
                            $a = 2;
                        }
                    }
                } elseif ($prav["team_performance"] >= $proportion["all_two"] && $prav["team_performance"] < $proportion["all_three"]) {
                    if ($dong_arr >= 3 && $dong_arr < 5) {
                        if ($a == 2 && $b == 1 && $c == 1 && $d == 1) {//平级算力
                            $pingji_suanli += $val["consume_cp"] * $proportion["vis_role"] / 100;
                        } elseif ($a == 1 && $b == 1 && $c == 1 && $d == 1) {//创业合伙人动态算力
                            $dongtai_suanli += $val["consume_cp"] * $proportion["two_role"] / 100;
                            $a = 2;
                        }
                    } elseif ($dong_arr >= 5) {
                        if ($b == 2 && $c == 1 && $d == 1) {//平级算力
                            $pingji_suanli += $val["consume_cp"] * $proportion["vis_role"] / 100;
                        } elseif ($b == 1 && $c == 1 && $d == 1) {//经销商动态算力
                            if ($a > 1) {
                                $dong_bili = $proportion["three_role"] - $proportion["two_role"];
                            } else {
                                $dong_bili = $proportion["three_role"];
                            }
                            $dongtai_suanli += $val["consume_cp"] * $dong_bili / 100;
                            $b = 2;
                            $a = 3;
                        }
                    }
                } elseif ($prav["team_performance"] >= $proportion["all_three"] && $prav["team_performance"] < $proportion["all_fore"]) {
                    if ($dong_arr >= 3 && $dong_arr < 5) {
                        if ($a == 2 && $b == 1 && $c == 1 && $d == 1) {//平级算力
                            $pingji_suanli += $val["consume_cp"] * $proportion["vis_role"] / 100;
                        } elseif ($a == 1 && $b == 1 && $c == 1 && $d == 1) {//创业合伙人动态算力
                            $dongtai_suanli += $val["consume_cp"] * $proportion["two_role"] / 100;
                            $a = 2;
                        }
                    } elseif ($dong_arr >= 5 && $dong_arr < 7) {
                        if ($b == 2 && $c == 1 && $d == 1) {//平级算力
                            $pingji_suanli += $val["consume_cp"] * $proportion["vis_role"] / 100;
                        } elseif ($b == 1 && $c == 1 && $d == 1) {//经销商动态算力
                            if ($a > 1) {
                                $dong_bili = $proportion["three_role"] - $proportion["two_role"];
                            } else {
                                $dong_bili = $proportion["three_role"];
                            }
                            $dongtai_suanli += $val["consume_cp"] * $dong_bili / 100;
                            $b = 2;
                            $a = 3;
                        }
                    } elseif ($dong_arr >= 7) {
                        if ($c == 2 && $d == 1) {//平级算力
                            $pingji_suanli += $val["consume_cp"] * $proportion["vis_role"] / 100;
                        } elseif ($c == 1 && $d == 1) {//代理商动态算力
                            if ($b > 1) {
                                $dong_bili = $proportion["four_role"] - $proportion["three_role"];
                            } elseif ($a > 1 && $b == 1) {
                                $dong_bili = $proportion["four_role"] - $proportion["two_role"];
                            } else {
                                $dong_bili = $proportion["four_role"];
                            }
                            $dongtai_suanli += $val["consume_cp"] * $dong_bili / 100;
                            $c = 2;
                            $b = 3;
                            $a = 3;
                        }
                    }
                } elseif ($prav["team_performance"] >= $proportion["all_fore"]) {
                    if ($dong_arr >= 3 && $dong_arr < 5) {
                        if ($a == 2 && $b == 1 && $c == 1 && $d == 1) {//平级算力
                            $pingji_suanli += $val["consume_cp"] * $proportion["vis_role"] / 100;
                        } elseif ($a == 1 && $b == 1 && $c == 1 && $d == 1) {//创业合伙人动态算力
                            $dongtai_suanli += $val["consume_cp"] * $proportion["two_role"] / 100;
                            $a = 2;
                        }
                    } elseif ($dong_arr >= 5 && $dong_arr < 7) {
                        if ($b == 2 && $c == 1 && $d == 1) {//平级算力
                            $pingji_suanli += $val["consume_cp"] * $proportion["vis_role"] / 100;
                        } elseif ($b == 1 && $c == 1 && $d == 1) {//经销商动态算力
                            if ($a > 1) {
                                $dong_bili = $proportion["three_role"] - $proportion["two_role"];
                            } else {
                                $dong_bili = $proportion["three_role"];
                            }
                            $dongtai_suanli += $val["consume_cp"] * $dong_bili / 100;
                            $b = 2;
                            $a = 3;
                        }
                    } elseif ($dong_arr >= 7 && $dong_arr < 9) {
                        if ($c == 2 && $d == 1) {//平级算力
                            $pingji_suanli += $val["consume_cp"] * $proportion["vis_role"] / 100;
                        } elseif ($c == 1 && $d == 1) {//代理商动态算力
                            if ($b > 1) {
                                $dong_bili = $proportion["four_role"] - $proportion["three_role"];
                            } elseif ($a > 1 && $b == 1) {
                                $dong_bili = $proportion["four_role"] - $proportion["two_role"];
                            } else {
                                $dong_bili = $proportion["four_role"];
                            }
                            $dongtai_suanli += $val["consume_cp"] * $dong_bili / 100;
                            $c = 2;
                            $b = 3;
                            $a = 3;
                        }
                    } elseif ($dong_arr >= 9) {
                        if ($d == 2) {//平级算力
                            $pingji_suanli += $val["consume_cp"] * $proportion["vis_role"] / 100;
                        } elseif ($d == 1) {//股东合伙人动态算力
                            if ($c > 1) {
                                $dong_bili = $proportion["five_role"] - $proportion["four_role"];
                            } elseif ($b > 1 && $c == 1) {
                                $dong_bili = $proportion["five_role"] - $proportion["three_role"];
                            } elseif ($a > 1 && $b == 1 && $c == 1) {
                                $dong_bili = $proportion["five_role"] - $proportion["two_role"];
                            } else {
                                $dong_bili = $proportion["five_role"];
                            }
                            $dongtai_suanli += $val["consume_cp"] * $dong_bili / 100;
                            $d = 2;
                            $c = 3;
                            $b = 3;
                            $a = 3;
                        }
                    }
                }

                $jintai_threes = $dongtai_suanli + $pingji_suanli;
                if ($prav["consume_cp"] >= $proportion["one_min_consume"] && $proportion["one_consume"] >= $prav["consume_cp"]) {//应该奖励的新淘链值
                    $jintai_three = $jintai_threes * $proportion["one_percent"] / 100;
                } elseif ($prav["consume_cp"] >= $proportion["two_min_consume"] && $proportion["two_consume"] >= $prav["consume_cp"]) {
                    $jintai_three = $jintai_threes * $proportion["two_percent"] / 100;
                } elseif ($prav["consume_cp"] >= $proportion["three_min_consume"] && $proportion["three_consume"] >= $prav["consume_cp"]) {
                    $jintai_three = $jintai_threes * $proportion["three_percent"] / 100;
                } elseif ($prav["consume_cp"] >= $proportion["four_min_consume"] && $proportion["four_consume"] >= $prav["consume_cp"]) {
                    $jintai_three = $jintai_threes * $proportion["four_percent"] / 100;
                } elseif ($prav["consume_cp"] >= $proportion["five_min_consume"]) {
                    $jintai_three = $jintai_threes * $proportion["five_percent"] / 100;
                }
                $jinri_jintais = $prav["dynamic_jintai"] + $jintai_three;

                if ($jintai_three > 0) {
                    if ($prav["dynamic_shangxian"] > $prav["dynamic_jintai"]) {
                        if ($jinri_jintais > floatval($prav["dynamic_shangxian"])) {
                            echo $jinri_jintais . "+" . $prav["user_id"] . "+" . $val["user_id"] . "---------";
                            $user_jinnum = $prav["dynamic_shangxian"] - $prav["dynamic_jintai"] + $prav["jin_num"];
                            $jintai_three = $prav["dynamic_shangxian"] - $prav["dynamic_jintai"];
                            $jintai_totalthree = $prav["jin_total"] + $jintai_three;
                            $jinri_jintai = $prav["dynamic_shangxian"];
                        } else {
                            $user_jinnum = $prav["jin_num"] + $jintai_three;
                            $jintai_totalthree = $prav["jin_total"] + $jintai_three;
                            $jinri_jintai = $prav["dynamic_jintai"] + $jintai_three;
                        }

                        //if($prav["user_id"] == 1){
                            //echo $user_jinnum."+".$jinri_jintai."+".$prav["jin_num"]."+".$prav["user_id"]."+".$jintai_three."----";
                        //}

                        $sqls = "update tp_users set jin_num='" . $user_jinnum . "',dynamic_jintai='" . $jinri_jintai . "',jin_total='" . $jintai_totalthree . "'  where user_id = " . $prav["user_id"] . ";";

                        $res = $pdo->query($sqls);
                        $sqlss = "update tp_users set dynamic_time='" . $award_time . "'  where user_id = " . $val["user_id"] . ";";
                        $ress = $pdo->query($sqlss);

                        $in_sql = "insert into tp_jinnum_log (jin_num,uid,creat_time,type,son_uid) values (" . $jintai_three . "," . $prav['user_id'] . ",'" . $time . "','" . "动态算力收益" . "','" . $val["user_id"] . "');";
                        $in_res = $pdo->query($in_sql);
                    } else {
                        //echo $prav["dynamic_shangxian"]."+".$prav["dynamic_jintai"]."-----";
                    }
                }
            }
        }
    }
} else {
    error_log(date('Y-m-d H:i:s') . "没有获取到未返静态返利的人\n", 3, __DIR__ . '/log/' . date('Y-m-d') . '.log');
}
error_log(date('Y-m-d H:i:s') . "执行完毕\n", 3, __DIR__ . '/log/' . date('Y-m-d') . '.log');
