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

namespace app\common\logic;

use think\Model;
use think\db;
use app\common\util\ChineseSpell;

/**
 * 秒杀逻辑定义
 * Class CatsLogic
 * @package common\Logic
 */
class SearchWordLogic extends Model
{
    /**
     * 获取全拼
     * @param $keyWord
     * @return string
     */
    public function getPinyinFull($keyWord){
        $chineseSpell = new ChineseSpell();
        $keywords_u8 =iconv('UTF-8','gb2312',$keyWord);
        $py_full = $chineseSpell->getChineseSpells($keywords_u8);
        return $py_full;
    }
    /**
     * 获取全拼
     * @param $keyWord
     * @return string
     */
    public function getPinyinSimple($keyWord){
        return strtolower(pinyin_long($keyWord));
    }

    /**
     * 前台搜索关键词
     * 返回查询数组
     * @param $q|关键词
     * @return array
     */
    public function getSearchWordWhere($q){
        //引入
        $where = [];
        if (file_exists(PLUGIN_PATH . 'coreseek/sphinxapi.php')) {
            require_once(PLUGIN_PATH . 'coreseek/sphinxapi.php');
            $cl = new \SphinxClient();
            $cl->SetServer(C('SPHINX_HOST') . '', intval(C('SPHINX_PORT')));
            $cl->SetConnectTimeout(10);
            $cl->SetArrayResult(true);
            $cl->SetMatchMode(SPH_MATCH_ANY);
            $res = $cl->Query($q, "mysql");
            if ($res) {
                $goods_id_array = array();
                if (array_key_exists('matches', $res)) {
                    foreach ($res['matches'] as $key => $value) {
                        $goods_id_array[] = $value['id'];
                    }
                }
                if (!empty($goods_id_array)) {
                    $where['goods_id'] = array('in', $goods_id_array);
                } else {
                    $where['goods_id'] = 0;
                }
            } else {
                $q_arr = explode(' ', $q);
                foreach ($q_arr as $key => $value) {
                    $q_arr[$key] = '%' . $value . '%';
                }
                $where['goods_name'] = array('like', $q_arr);
            }
        } else {
            $q_arr = explode(' ', $q);
            foreach ($q_arr as $key => $value) {
                $q_arr[$key] = '%' . $value . '%';
            }
            $where['goods_name'] = array('like', '%' . $q . '%');
        }
        return $where;
    }
}