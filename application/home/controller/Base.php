<?php

/**
 * 新淘链商城
 * ============================================================================
 * * 版权所有 2015-2027 新淘链，并保留所有权利。
 * 网站地址: 
 * ----------------------------------------------------------------------------
 * 这是一个商业软件，您必须购买授权才能使用.
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 请支持正版, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 新淘链
 */
namespace app\home\controller;

use think\Controller;
use think\Cookie;
use think\Session;
use think\Db;

class Base extends Controller
{
    public $session_id;
    public $cateTrre = array();
    public function __construct()
    {
        parent::__construct();
    }

    /*
     * 初始化操作
     */
    public function _initialize()
    {
        if (input("unique_id")) {
            //兼容手机app
            session_id(input("unique_id"));
            Session::start();
        }
        header("Cache-control: private");  // history.back返回后输入框值丢失问题 参考文章 http://www.tp-shop.cn/article_id_1465.html  http://blog.csdn.net/qinchaoguang123456/article/details/29852881
        $this->session_id = session_id(); // 当前的 session_id
        define('SESSION_ID', $this->session_id); //将当前的session_id保存为常量，供其它方法调用
        $first_leader = I('first_leader');
        $first_leader && setcookie('first_leader', $first_leader);
        $this->public_assign();
    }

    public function curl_post($url, $post)
    {
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $post,
        );
        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /**
     * 保存公告变量到smarty中，比如导航
     */
    public function public_assign()
    {
        $tpshop_config = $this->get_tpshop_config();
        $this->assign('tpshop_config', $tpshop_config);
        $goods_category_tree = get_goods_category_tree();
        $this->cateTrre = $goods_category_tree;
        $this->assign('goods_category_tree', $goods_category_tree);
        $brand_list = $this->get_brand_list();
        $this->assign('brand_list', $brand_list);
    }

    /**
     * ajax返回
     */
    public function ajaxReturn($data)
    {
        exit(json_encode($data, JSON_UNESCAPED_UNICODE));
    }

    /**
     * 获取TPshop 配置信息
     * @return type
     */
    public function get_tpshop_config()
    {
        $tpshop_config = S('get_tpshop_config');
        if ($tpshop_config) {
            return $tpshop_config;
        }

        $tp_config = M('config')->cache(true)->select();
        foreach ($tp_config as $k => $v) {
            if ($v['name'] == 'hot_keywords') {
                $tpshop_config['hot_keywords'] = explode('|', $v['value']);
            }
            $tpshop_config[$v['inc_type'] . '_' . $v['name']] = $v['value'];
        }
        S('get_tpshop_config', $tpshop_config);
        return $tpshop_config;
    }

    /**
     * 获取热门品牌
     */
    function get_brand_list()
    {
        $brand_list = S('base_get_brand_list');
        if ($brand_list) {
            return $brand_list;
        }
        $brand_list = M('brand')->cache(true)->field('id,cat_id1,logo,is_hot')->where("cat_id1>0")->select();
        S('base_get_brand_list', $brand_list);
        return $brand_list;
    }
}
