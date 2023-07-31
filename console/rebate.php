<?php
/**
 * 连接数据库
 */
function connectDb()
{
    global $pdo;
    try {
        //实例化pdo对象
        $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=jintai;', 'root', 'root');
        //通过query函数执行sql命令
        getDb()->query('set names utf8');
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/**
 * 取数据库连接实例
 */
function getDb()
{
    global $pdo;
    if ($pdo == null) {
        connectDb();
    }
    return $pdo;
}

/**
 * 寻找静态奖用户
 * @param string $award_time Y-m-d格式时间字符串
 * @return array||bool 返回数组或假
 */
function findStaticAwardUser($award_time)
{
    $sql = "select * from tp_users where static_time != '" . $award_time . "' and consume_cp>0 order by user_id asc;";
    $res = getDb()->query($sql);
    if ($res) {
        $arr = $res->fetchAll(PDO::FETCH_ASSOC);
        return $arr;
    } else {
        return $res;
    }
}

/**
 * 取比例参数配置
 * @return array||bool 返回数组或假
 */
function findProportion()
{
    $sql = "select * from tp_proportion where id=1;";
    $res = getDb()->query($sql);
    if ($res) {
        $proportion = $res->fetch(PDO::FETCH_ASSOC);
        return $proportion;
    } else {
        return $res;
    }
}

/**
 * 根据算力计算应返多少新淘链
 * @param float $consume_cp 算力
 * @param array $proportion 比例配置
 * @return integer 返回数量
 */
function calcRebateGoldchain($consume_cp, $proportion, $keyong_jin = null)
{
    $jintai = 0;
    $keyong_jin == null &&  $keyong_jin = $consume_cp;
    if ($consume_cp >= $proportion["one_min_consume"] && $proportion["one_consume"] >= $consume_cp) {
        $jintai = $keyong_jin * $proportion["one_percent"] / 100;
    } elseif ($consume_cp >= $proportion["two_min_consume"] && $proportion["two_consume"] >= $consume_cp) {
        $jintai = $keyong_jin * $proportion["two_percent"] / 100;
    } elseif ($consume_cp >= $proportion["three_min_consume"] && $proportion["three_consume"] >= $consume_cp) {
        $jintai = $keyong_jin * $proportion["three_percent"] / 100;
    } elseif ($consume_cp >= $proportion["four_min_consume"] && $proportion["four_consume"] >= $consume_cp) {
        $jintai = $keyong_jin * $proportion["four_percent"] / 100;
    } elseif ($consume_cp >= $proportion["five_min_consume"]) {
        $jintai = $keyong_jin * $proportion["five_percent"] / 100;
    }
    return $jintai;
}

/**
 * 静态返利
 * @param array $user 用户
 * @param float $rebateGoldchain 应返新淘链
 */
function staticRebate($user, $rebateGoldchain, $award_time)
{
    $goldchainBalance = $user["jin_num"] + $rebateGoldchain; //预计新淘链余额
    $jin_total = $user["jin_total"] + $rebateGoldchain; //预计累计新淘链
    $factGoldchain = $rebateGoldchain; //实际返新淘链
    if ($jin_total > $user["user_performance"]) {
        //即将获得的新淘链大于投资本金
        $staticCapping = $user["user_performance"] * $proportion["static_capping"];//上限数量
        if ($jin_total >= $staticCapping) {
            //即将获得的新淘链大于封顶值
            $shengyus = $rebateGoldchain * $proportion["static_deduct"] / 100;//应当扣除的额外比例新淘链
            $shengyu = $rebateGoldchain - $shengyus;//应当获得的新淘链
            $suoyou = $user["jin_total"] + $shengyu;//获得后的新淘链数量
            if ($suoyou >= $staticCapping) {//是否已经超出封顶
                $xiaosheng = $staticCapping - $user["jin_total"];//获得超出的数量
                if ($xiaosheng > 0) {//数量大于零说明还有未超出封顶
                    $goldchainBalance = $user["jin_num"] + $xiaosheng;//减去超出的数量
                    $jin_total = $user["jin_total"] + $xiaosheng;
                    $factGoldchain = $xiaosheng;
                } else {//完全超出封顶
                    $goldchainBalance = $user["jin_num"] + 0;
                    $jin_total = $user["jin_total"] + 0;
                    $factGoldchain = 0;
                }
            } else {
                $goldchainBalance = $user["jin_num"] + $shengyu;
                $jin_total = $user["jin_total"] + $shengyu;
                $factGoldchain = $shengyu;
            }
        } else {
            if ($user["jin_total"] >= $user["user_performance"]) {
                $kexcess = $rebateGoldchain * $proportion["static_deduct"] / 100;//超出的新淘链扣除比例
                $factGoldchain = $rebateGoldchain - $kexcess;
                $goldchainBalance = $user["jin_num"] + $factGoldchain;
                $jin_total = $user["jin_total"] + $factGoldchain;
            } else {
                $excess = $jin_total - $user["user_performance"];
                $kexcess = $excess * $proportion["static_deduct"] / 100;//超出的新淘链扣除比例
                $factGoldchain = $rebateGoldchain - $kexcess;
                $goldchainBalance = $user["jin_num"] + $factGoldchain;
                $jin_total = $user["jin_total"] + $factGoldchain;
            }
        }
    }
    $log_jinnum["jin_num"] = $factGoldchain;
    $log_jinnum["uid"] = $user["user_id"];
    $time = date("Y-m-d H:i:s");
    $sqls = "update tp_users set jin_num=" . $goldchainBalance . ", jin_total=" . $jin_total . ", static_time='" . $award_time . "' where user_id = " . $user["user_id"] . ";";
    $res = getDb()->query($sqls);
    if ($factGoldchain > 0) {
        $in_sql = "insert into tp_jinnum_log (jin_num,uid,creat_time,type) values (" . $factGoldchain . "," . $user['user_id'] . ",'" . $time . "','" . "静态收益" . "');";
        $in_res = getDb()->query($in_sql);
    }
}

/**
 * 寻找静态奖用户
 * @param string $award_time Y-m-d格式时间字符串
 * @return array||bool 返回数组或假
 */
function findDynamicAwardUser($award_time)
{
    $sql = "select * from tp_users where dynamic_time != '" . $award_time . "' order by user_id asc;";
    $res = getDb()->query($sql);
    if ($res) {
        $arr = $res->fetchAll(PDO::FETCH_ASSOC);
        return $arr;
    } else {
        return $res;
    }
}

/**
 * 设置用户每日动态上限
 */
function setUserDynamicToplimit($user, $dynamicDayCapping)
{
    $shangxian_jin = $user["jin_num"] * $dynamicDayCapping / 100;
    $sqls = "update tp_users set dynamic_jintai='0',dynamic_shangxian='" . $shangxian_jin . "'  where user_id = " . $user["user_id"] . ";";
    $res = getDb()->query($sqls);
}

/**
 * 直接分享区
 */
function directShare($user, $proportion, $award_time)
{
    $sql = "select count(*) from tp_users where pid = '" . $user["user_id"] . "';";
    $res = getDb()->query($sql);
    $count = $res->fetchColumn();
    $all_jin = 0;
    $jintai_one = 0;
    $time = date("Y-m-d H:i:s");
    if ($count > 0) {
        $ssql = "select * from tp_users where pid='" . $user["user_id"] . "';";
        $sres = getDb()->query($ssql);
        $son_users = $sres->fetchall(PDO::FETCH_ASSOC);
        foreach ($son_users as $key => $value) {
            $all_jin += $value["consume_cp"];
        }
        $keyong_jin = $all_jin * $proportion["one_role"] / 100;
        $jintai_one = calcRebateGoldchain($user["consume_cp"], $proportion, $keyong_jin);
    } else {
        $jintai_one = 0;
    }
    if ($user["pid"] < 1 && $jintai_one > 0) {
        if ($user["dynamic_shangxian"] > $user["dynamic_jintai"]) {
            $jintai_numone = $user["jin_num"] + $jintai_one;
            $jintai_total = $user["jin_total"] + $jintai_one;
            $dynamic_jintaione = $user["dynamic_jintai"] + $jintai_one;
            if ($dynamic_jintaione > $user["dynamic_shangxian"]) {
                $jintai_numone = $user["dynamic_shangxian"] - $user["dynamic_jintai"] + $user["jin_num"];
                $jintai_total = $user["dynamic_shangxian"] - $user["dynamic_jintai"] + $user["jin_total"];
                $jintai_one = $user["dynamic_shangxian"] - $user["dynamic_jintai"];
                $dynamic_jintaione = $user["dynamic_shangxian"];
            }

            $sqls = "update tp_users set jin_num='" . $jintai_numone . "',dynamic_jintai='" . $dynamic_jintaione . "',dynamic_time='" . $award_time . "',jin_total='" . $jintai_total . "'  where user_id = " . $user["user_id"] . ";";
            $res = getDb()->query($sqls);


            $in_sql = "insert into tp_jinnum_log (jin_num,uid,creat_time,type) values (" . $jintai_one . "," . $user['user_id'] . ",'" . $time . "','" . "直接分享区动能算力');";
            $in_res = getDb()->query($in_sql);
        }
        $jintai_one = 0;
    }
    return $jintai_one;
}

/**
 * 全球关系算力
 */
function allWorldRelation($user, $award_time, $proportion, $jintai_one)
{
    $time = date("Y-m-d H:i:s");
    if ($user["pid"] > 0) {//全球关系算力
        $jintai_two = 0;
        $sql = "select * from tp_users where user_id = " . $user["pid"] . ";";
        $res = getDb()->query($sql);
        $puser = $res->fetch(PDO::FETCH_ASSOC);
        if ($puser["consume_cp"] > 0) {
            $fan_consume = $puser["consume_cp"] * $proportion["global_consume"] / 100;
            if ($user["consume_cp"] >= $puser["consume_cp"]) {
                $jintai_two = calcRebateGoldchain($puser["consume_cp"], $proportion, $fan_consume);
            } else {
                $jintai_two = calcRebateGoldchain($user["consume_cp"], $proportion, $fan_consume);
            }
            $jintai_twos = $jintai_two;
            $jintai_two += $jintai_one;
            if ($jintai_two > 0) {
                if ($user["dynamic_shangxian"] > $user["dynamic_jintai"]) {
                    $jintai_numtwo = $user["jin_num"] + $jintai_two;
                    $jintai_totaltwo = $user["jin_total"] + $jintai_two;
                    $dynamic_jintaitwo = $user["dynamic_jintai"] + $jintai_two;
                    //echo $jintai_numone."+".$user["jin_num"]."+".$jintai_one."+".$user["user_id"]."---";
                    if ($dynamic_jintaitwo > $user["dynamic_shangxian"]) {
                        $jintai_numtwo = $user["dynamic_shangxian"] - $user["dynamic_jintai"] + $user["jin_num"];
                        $dynamic_jintaitwo = $user["dynamic_shangxian"];

                        $hhjintai = $user["dynamic_shangxian"] - $user["dynamic_jintai"];
                        if ($hhjintai > $jintai_one) {
                            $jintai_twos = $hhjintai - $jintai_one;
                        } else {
                            $jintai_one = $hhjintai;
                            $jintai_twos = 0;
                        }
                        $jintai_totaltwo = $user["dynamic_shangxian"] - $user["dynamic_jintai"] + $user["jin_total"];
                        //echo $dynamic_jintaitwo."+".$user["dynamic_shangxian"]."+".$user["user_id"]."---";
                        $sqls = "update tp_users set jin_num='" . $jintai_numtwo . "',dynamic_jintai='" . $dynamic_jintaitwo . "',dynamic_time='" . $award_time . "',jin_total='" . $jintai_totaltwo . "'  where user_id = " . $user["user_id"] . ";";
                        $res = getDb()->query($sqls);
                    } else {
                        //echo $dynamic_jintaitwo."+".$user["dynamic_shangxian"]."+".$user["user_id"]."---";
                        $sqls = "update tp_users set jin_num='" . $jintai_numtwo . "',dynamic_jintai='" . $dynamic_jintaitwo . "',dynamic_time='" . $award_time . "',jin_total='" . $jintai_totaltwo . "'  where user_id = " . $user["user_id"] . ";";
                        $res = getDb()->query($sqls);
                    }

                    if ($jintai_one > 0) {
                        $in_sql = "insert into tp_jinnum_log (jin_num,uid,creat_time,type) values (" . $jintai_one . "," . $user['user_id'] . ",'" . $time . "','" . "直接分享区动能算力');";
                        $in_res = getDb()->query($in_sql);
                    }

                    if ($jintai_twos > 0) {
                        $in_sqls = "insert into tp_jinnum_log (jin_num,uid,creat_time,type,son_uid) values (" . $jintai_twos . "," . $user['user_id'] . ",'" . $time . "','" . "全球关系算力','" . $puser["user_id"] . "');";
                        $in_ress = getDb()->query($in_sqls);
                    }
                }
            }
        }
    }
}


/**
 * id列表转换为用户数组
 * @param string $parentsIdList user_id列表
 * @return array 返回对应的用户数组
 */
function idListToUser($parentsIdList)
{
    $parent_arrs = array();
    $parent_arr = explode(',', $parentsIdList);
    rsort($parent_arr);
    foreach ($parent_arr as $k => $v) {
        if ($v > 0) {
            $ppsql = "select * from tp_users where user_id=" . $v . ";";
            $ppres = getDb()->query($ppsql);
            $ppp = $ppres->fetch(PDO::FETCH_ASSOC);
            $parent_arrs[$k] = $ppp;
        }
    }
    return $parent_arrs;
}

/**
 * 取直推用户
 * @param integer $user_id 用户id
 * @return array||bool
 */
function getDirectRecommendUser($user_id)
{
    $sql = "select * from tp_users where pid = '" . $user_id . "';";
    $dong_res = getDb()->query($sql);
    if ($dong_res) {
        $dong_arr = $dong_res->fetchAll(PDO::FETCH_ASSOC);
        return $dong_arr;
    } else {
        return $dong_res;
    }
}

/**
 * 动态算力收益
 */
function dynamicConsumeRebate($user)
{
    $time = date("Y-m-d H:i:s");
    $jintai_three = 0;
    $parent_arrs = idListToUser($user["max_parents"]);
    list($a, $b, $c, $d) = array_fill(0, 4, 1);
    foreach ($parent_arrs as $park => $prav) {
        $pingji_suanli = 0;
        $dongtai_suanli = 0;
        $directRecommendUser = getDirectRecommendUser($user['user_id']);
        $dong_arr = $directRecommendUser ? count($directRecommendUser) : 0;
        if ($dong_arr >= 3) {
            if ($prav["team_performance"] >= $proportion["all_one"] && $prav["team_performance"] < $proportion["all_two"]) {
                if ($dong_arr >= 3) {
                    if ($a == 2 && $b == 1 && $c == 1 && $d == 1) {//平级算力
                        $pingji_suanli += $user["consume_cp"] * $proportion["vis_role"] / 100;
                    } elseif ($a == 1 && $b == 1 && $c == 1 && $d == 1) {//创业合伙人动态算力
                        $dongtai_suanli += $user["consume_cp"] * $proportion["two_role"] / 100;
                        $a = 2;
                    }
                }
            } elseif ($prav["team_performance"] >= $proportion["all_two"] && $prav["team_performance"] < $proportion["all_three"]) {
                if ($dong_arr >= 3 && $dong_arr < 5) {
                    if ($a == 2 && $b == 1 && $c == 1 && $d == 1) {//平级算力
                        $pingji_suanli += $user["consume_cp"] * $proportion["vis_role"] / 100;
                    } elseif ($a == 1 && $b == 1 && $c == 1 && $d == 1) {//创业合伙人动态算力
                        $dongtai_suanli += $user["consume_cp"] * $proportion["two_role"] / 100;
                        $a = 2;
                    }
                } elseif ($dong_arr >= 5) {
                    if ($b == 2 && $c == 1 && $d == 1) {//平级算力
                        $pingji_suanli += $user["consume_cp"] * $proportion["vis_role"] / 100;
                    } elseif ($b == 1 && $c == 1 && $d == 1) {//经销商动态算力
                        if ($a > 1) {
                            $dong_bili = $proportion["three_role"] - $proportion["two_role"];
                        } else {
                            $dong_bili = $proportion["three_role"];
                        }
                        $dongtai_suanli += $user["consume_cp"] * $dong_bili / 100;
                        $b = 2;
                        $a = 3;
                    }
                }
            } elseif ($prav["team_performance"] >= $proportion["all_three"] && $prav["team_performance"] < $proportion["all_fore"]) {
                if ($dong_arr >= 3 && $dong_arr < 5) {
                    if ($a == 2 && $b == 1 && $c == 1 && $d == 1) {//平级算力
                        $pingji_suanli += $user["consume_cp"] * $proportion["vis_role"] / 100;
                    } elseif ($a == 1 && $b == 1 && $c == 1 && $d == 1) {//创业合伙人动态算力
                        $dongtai_suanli += $user["consume_cp"] * $proportion["two_role"] / 100;
                        $a = 2;
                    }
                } elseif ($dong_arr >= 5 && $dong_arr < 7) {
                    if ($b == 2 && $c == 1 && $d == 1) {//平级算力
                        $pingji_suanli += $user["consume_cp"] * $proportion["vis_role"] / 100;
                    } elseif ($b == 1 && $c == 1 && $d == 1) {//经销商动态算力
                        if ($a > 1) {
                            $dong_bili = $proportion["three_role"] - $proportion["two_role"];
                        } else {
                            $dong_bili = $proportion["three_role"];
                        }
                        $dongtai_suanli += $user["consume_cp"] * $dong_bili / 100;
                        $b = 2;
                        $a = 3;
                    }
                } elseif ($dong_arr >= 7) {
                    if ($c == 2 && $d == 1) {//平级算力
                        $pingji_suanli += $user["consume_cp"] * $proportion["vis_role"] / 100;
                    } elseif ($c == 1 && $d == 1) {//代理商动态算力
                        if ($b > 1) {
                            $dong_bili = $proportion["four_role"] - $proportion["three_role"];
                        } elseif ($a > 1 && $b == 1) {
                            $dong_bili = $proportion["four_role"] - $proportion["two_role"];
                        } else {
                            $dong_bili = $proportion["four_role"];
                        }
                        $dongtai_suanli += $user["consume_cp"] * $dong_bili / 100;
                        list($a, $b, $c) = array(3, 3, 2);
                    }
                }
            } elseif ($prav["team_performance"] >= $proportion["all_fore"]) {
                if ($dong_arr >= 3 && $dong_arr < 5) {
                    if ($a == 2 && $b == 1 && $c == 1 && $d == 1) {//平级算力
                        $pingji_suanli += $user["consume_cp"] * $proportion["vis_role"] / 100;
                    } elseif ($a == 1 && $b == 1 && $c == 1 && $d == 1) {//创业合伙人动态算力
                        $dongtai_suanli += $user["consume_cp"] * $proportion["two_role"] / 100;
                        $a = 2;
                    }
                } elseif ($dong_arr >= 5 && $dong_arr < 7) {
                    if ($b == 2 && $c == 1 && $d == 1) {//平级算力
                        $pingji_suanli += $user["consume_cp"] * $proportion["vis_role"] / 100;
                    } elseif ($b == 1 && $c == 1 && $d == 1) {//经销商动态算力
                        if ($a > 1) {
                            $dong_bili = $proportion["three_role"] - $proportion["two_role"];
                        } else {
                            $dong_bili = $proportion["three_role"];
                        }
                        $dongtai_suanli += $user["consume_cp"] * $dong_bili / 100;
                        $b = 2;
                        $a = 3;
                    }
                } elseif ($dong_arr >= 7 && $dong_arr < 9) {
                    if ($c == 2 && $d == 1) {//平级算力
                        $pingji_suanli += $user["consume_cp"] * $proportion["vis_role"] / 100;
                    } elseif ($c == 1 && $d == 1) {//代理商动态算力
                        if ($b > 1) {
                            $dong_bili = $proportion["four_role"] - $proportion["three_role"];
                        } elseif ($a > 1 && $b == 1) {
                            $dong_bili = $proportion["four_role"] - $proportion["two_role"];
                        } else {
                            $dong_bili = $proportion["four_role"];
                        }
                        $dongtai_suanli += $user["consume_cp"] * $dong_bili / 100;
                        list($a, $b, $c) = array(3, 3, 2);
                    }
                } elseif ($dong_arr >= 9) {
                    if ($d == 2) {//平级算力
                        $pingji_suanli += $user["consume_cp"] * $proportion["vis_role"] / 100;
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
                        $dongtai_suanli += $user["consume_cp"] * $dong_bili / 100;
                        list($a, $b, $c, $d) = array(3, 3, 3, 2);
                    }
                }
            }

            $jintai_threes = $dongtai_suanli + $pingji_suanli;
            $jintai_three = calcRebateGoldchain($prav["consume_cp"], $proportion, $jintai_threes);
            $jinri_jintais = $prav["dynamic_jintai"] + $jintai_three;
            if ($jintai_three > 0) {
                if ($prav["dynamic_shangxian"] > $prav["dynamic_jintai"]) {
                    if ($jinri_jintais > floatval($prav["dynamic_shangxian"])) {
                        echo $jinri_jintais . "+" . $prav["user_id"] . "+" . $user["user_id"] . "---------";
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
                    //  echo $user_jinnum."+".$jinri_jintai."+".$prav["jin_num"]."+".$prav["user_id"]."+".$jintai_three."----";
                    //}
                    $sqls = "update tp_users set jin_num='" . $user_jinnum . "',dynamic_jintai='" . $jinri_jintai . "',jin_total='" . $jintai_totalthree . "'  where user_id = " . $prav["user_id"] . ";";

                    $res = getDb()->query($sqls);
                    $sqlss = "update tp_users set dynamic_time='" . $award_time . "'  where user_id = " . $user["user_id"] . ";";
                    $ress = getDb()->query($sqlss);

                    $in_sql = "insert into tp_jinnum_log (jin_num,uid,creat_time,type,son_uid) values (" . $jintai_three . "," . $prav['user_id'] . ",'" . $time . "','" . "动态算力收益" . "','" . $user["user_id"] . "');";
                    $in_res = getDb()->query($in_sql);
                } else {
                    //echo $prav["dynamic_shangxian"]."+".$prav["dynamic_jintai"]."-----";
                }
            }
        }
    }
}

function main()
{
    error_log(date('Y-m-d H:i:s') . "开始执行\n", 3, __DIR__ . '/log/' . date('Y-m-d') . '.log');
    date_default_timezone_set("Asia/Shanghai");
    connectDb();
    $award_time = date("Y-m-d");
    $arr = findStaticAwardUser($award_time);
    $proportion = findProportion();
    if ($arr) {
        foreach ($arr as $key => $value) {
            $rebateGoldchain = calcRebateGoldchain($value["consume_cp"], $proportion);
            staticRebate($value, $rebateGoldchain, $award_time);
        }
    } else {
        error_log(date('Y-m-d H:i:s') . "未获取到静态返利对象\n", 3, __DIR__ . '/log/' . date('Y-m-d') . '.log');
    }
    $arr = findDynamicAwardUser($award_time);
    if ($arr) {
        foreach ($arr as $key => $val) {
            setUserDynamicToplimit($val, $proportion["dynamic_day_capping"]);
            //直接分享区
            $jintai_one = directShare($val, $proportion, $award_time);
            //全球关系算力
            allWorldRelation($val, $award_time, $proportion, $jintai_one);
            //动态算力收益
            dynamicConsumeRebate($val);
        }
    } else {
        error_log(date('Y-m-d H:i:s') . "未获取到动态返利对象\n", 3, __DIR__ . '/log/' . date('Y-m-d') . '.log');
    }
    error_log(date('Y-m-d H:i:s') . "执行完毕\n", 3, __DIR__ . '/log/' . date('Y-m-d') . '.log');
}
global $pdo;
$pdo = null;
main();
