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
 * Date: 2017-05-11
 */
namespace app\common\logic;
/**
 * 商品活动工厂类
 * Class CatsLogic
 * @package common\Logic
 */
class GoodsPromFactory
{
    /**
     * @param $goods|商品实例
     * @param $spec_goods_price|规格实例
     * @return FlashSaleLogic|GroupBuyLogic|PromGoodsLogic
     */
    public function makeModule($goods, $spec_goods_price)
    {
        switch ($goods['prom_type']) {
            case 1:
                return new FlashSaleLogic($goods, $spec_goods_price);
            case 2:
                return new GroupBuyLogic($goods, $spec_goods_price);
            case 3:
                return new PromGoodsLogic($goods, $spec_goods_price);
        }
    }

    /**
     * 检测是否符合商品活动工厂类的使用
     * @param $promType |活动类型
     * @return bool
     */
    public function checkPromType($promType)
    {
        if (in_array($promType, array_values([1, 2, 3]))) {
            return true;
        } else {
            return false;
        }
    }

}
