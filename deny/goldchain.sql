/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 导出  表 goldchain.tp-account_log 结构
DROP TABLE IF EXISTS `tp_account_log`;
CREATE TABLE IF NOT EXISTS `tp_account_log` (
  `log_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '用户金额',
  `frozen_money` decimal(10,2) DEFAULT '0.00' COMMENT '冻结金额',
  `pay_points` mediumint(9) NOT NULL DEFAULT '0' COMMENT '支付积分',
  `change_time` int(10) unsigned NOT NULL COMMENT '变动时间',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `order_sn` varchar(50) DEFAULT NULL COMMENT '订单编号',
  `order_id` int(10) DEFAULT NULL COMMENT '订单id',
  `mobile` varchar(11) DEFAULT NULL COMMENT '收款人手机号',
  `shouxu` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '手续费',
  `jstranser` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '转账积分数额',
  `change_id` int(10) NOT NULL DEFAULT '0' COMMENT '易物区订单id',
  `withdraw_money` decimal(10,2) DEFAULT '0.00' COMMENT '提现币',
  `jin_num` decimal(20,6) DEFAULT '0.000000' COMMENT '新淘链',
  `dedication_money` decimal(10,2) DEFAULT '0.00' COMMENT '奉献值',
  `consume_cp` decimal(20,8) DEFAULT '0.00000000' COMMENT '算力',
  `type` tinyint(2) DEFAULT '0' COMMENT '默认0算力获得新淘链;1购买或者商城后台增加',
  PRIMARY KEY (`log_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-account_log 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_account_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_account_log` ENABLE KEYS */;

-- 导出  表 goldchain.tp-account_log_store 结构
DROP TABLE IF EXISTS `tp_account_log_store`;
CREATE TABLE IF NOT EXISTS `tp_account_log_store` (
  `log_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int(8) unsigned NOT NULL,
  `store_money` decimal(10,2) NOT NULL COMMENT '店铺金额',
  `pending_money` decimal(10,2) NOT NULL COMMENT '店铺未结算金额',
  `change_time` int(10) unsigned NOT NULL COMMENT '变动时间',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `order_sn` varchar(50) DEFAULT NULL COMMENT '订单编号',
  `order_id` int(10) DEFAULT NULL COMMENT '订单id',
  PRIMARY KEY (`log_id`) USING BTREE,
  KEY `user_id` (`store_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-account_log_store 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_account_log_store` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_account_log_store` ENABLE KEYS */;

-- 导出  表 goldchain.tp-account_log_store11 结构
DROP TABLE IF EXISTS `tp_account_log_store11`;
CREATE TABLE IF NOT EXISTS `tp_account_log_store11` (
  `log_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int(8) unsigned NOT NULL,
  `store_money` decimal(10,2) NOT NULL COMMENT '店铺金额',
  `pending_money` decimal(10,2) NOT NULL COMMENT '店铺未结算金额',
  `change_time` int(10) unsigned NOT NULL COMMENT '变动时间',
  `desc` varchar(255) NOT NULL COMMENT '描述',
  `order_sn` varchar(50) DEFAULT NULL COMMENT '订单编号',
  `order_id` int(10) DEFAULT NULL COMMENT '订单id',
  PRIMARY KEY (`log_id`) USING BTREE,
  KEY `user_id` (`store_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-account_log_store11 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_account_log_store11` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_account_log_store11` ENABLE KEYS */;

-- 导出  表 goldchain.tp-ad 结构
DROP TABLE IF EXISTS `tp_ad`;
CREATE TABLE IF NOT EXISTS `tp_ad` (
  `ad_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '广告id',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '广告位置ID',
  `media_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '广告类型',
  `ad_name` varchar(60) NOT NULL DEFAULT '' COMMENT '广告名称',
  `ad_link` varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `ad_code` text NOT NULL COMMENT '图片地址',
  `start_time` int(11) NOT NULL DEFAULT '0' COMMENT '投放时间',
  `end_time` int(11) NOT NULL DEFAULT '0' COMMENT '结束时间',
  `link_man` varchar(60) NOT NULL DEFAULT '' COMMENT '添加人',
  `link_email` varchar(60) NOT NULL DEFAULT '' COMMENT '添加人邮箱',
  `link_phone` varchar(60) NOT NULL DEFAULT '' COMMENT '添加人联系电话',
  `click_count` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '点击量',
  `enabled` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `orderby` smallint(6) DEFAULT '50' COMMENT '排序',
  `target` tinyint(1) DEFAULT '0' COMMENT '是否开启浏览器新窗口',
  `bgcolor` varchar(20) DEFAULT NULL COMMENT '背景颜色',
  PRIMARY KEY (`ad_id`) USING BTREE,
  KEY `enabled` (`enabled`) USING BTREE,
  KEY `position_id` (`pid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-ad 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_ad` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_ad` ENABLE KEYS */;

-- 导出  表 goldchain.tp-admin 结构
DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE IF NOT EXISTS `tp_admin` (
  `admin_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `user_name` varchar(60) NOT NULL DEFAULT '' COMMENT '用户名',
  `email` varchar(60) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `ec_salt` varchar(10) DEFAULT NULL COMMENT '秘钥',
  `add_time` int(11) NOT NULL DEFAULT '0',
  `last_login` int(11) NOT NULL DEFAULT '0',
  `last_ip` varchar(15) NOT NULL DEFAULT '',
  `nav_list` text,
  `lang_type` varchar(50) NOT NULL DEFAULT '',
  `paypwd` varchar(50) NOT NULL DEFAULT '' COMMENT '支付密码',
  `suppliers_id` smallint(5) unsigned DEFAULT '0',
  `todolist` longtext,
  `role_id` smallint(5) DEFAULT '0' COMMENT '角色id',
  PRIMARY KEY (`admin_id`) USING BTREE,
  KEY `user_name` (`user_name`) USING BTREE,
  KEY `agency_id` (`paypwd`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-admin 的数据：~1 rows (大约)
/*!40000 ALTER TABLE `tp_admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_admin` ENABLE KEYS */;

-- 导出  表 goldchain.tp-admin_log 结构
DROP TABLE IF EXISTS `tp_admin_log`;
CREATE TABLE IF NOT EXISTS `tp_admin_log` (
  `log_id` bigint(16) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) DEFAULT NULL,
  `log_info` varchar(255) DEFAULT NULL,
  `log_ip` varchar(30) DEFAULT NULL,
  `log_url` varchar(255) DEFAULT NULL,
  `log_time` int(10) DEFAULT NULL,
  `log_type` tinyint(2) DEFAULT '0' COMMENT '0默认1操作店铺2审核活动3处理投诉4其他',
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-admin_log 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_admin_log` DISABLE KEYS */;
INSERT INTO `tp_admin_log` (`log_id`, `admin_id`, `log_info`, `log_ip`, `log_url`, `log_time`, `log_type`) VALUES
	(1, 1, '后台登录', '', '/index.php?m=Admin&c=Admin&a=login&t=0.5953272718358149', 1527216387, 0);
/*!40000 ALTER TABLE `tp_admin_log` ENABLE KEYS */;

-- 导出  表 goldchain.tp-admin_role 结构
DROP TABLE IF EXISTS `tp_admin_role`;
CREATE TABLE IF NOT EXISTS `tp_admin_role` (
  `role_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `role_name` varchar(30) DEFAULT NULL COMMENT '角色名称',
  `act_list` text COMMENT '权限列表',
  `role_desc` varchar(255) DEFAULT NULL COMMENT '角色描述',
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-admin_role 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_admin_role` DISABLE KEYS */;
INSERT INTO `tp_admin_role` (`role_id`, `role_name`, `act_list`, `role_desc`) VALUES
	(1, '超级管理员', 'all', '管理全站');
/*!40000 ALTER TABLE `tp_admin_role` ENABLE KEYS */;

-- 导出  表 goldchain.tp-ad_position 结构
DROP TABLE IF EXISTS `tp_ad_position`;
CREATE TABLE IF NOT EXISTS `tp_ad_position` (
  `position_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `position_name` varchar(60) NOT NULL DEFAULT '' COMMENT '广告位置名称',
  `ad_width` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '广告位宽度',
  `ad_height` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '广告位高度',
  `position_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '广告描述',
  `position_style` text COMMENT '模板',
  `is_open` tinyint(1) DEFAULT '0' COMMENT '0关闭1开启',
  PRIMARY KEY (`position_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-ad_position 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_ad_position` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_ad_position` ENABLE KEYS */;

-- 导出  表 goldchain.tp-area_region 结构
DROP TABLE IF EXISTS `tp_area_region`;
CREATE TABLE IF NOT EXISTS `tp_area_region` (
  `shipping_area_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '物流配置id',
  `region_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '地区id对应region表id',
  `store_id` int(11) DEFAULT '0' COMMENT '店铺id',
  PRIMARY KEY (`shipping_area_id`,`region_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-area_region 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_area_region` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_area_region` ENABLE KEYS */;

-- 导出  表 goldchain.tp-article 结构
DROP TABLE IF EXISTS `tp_article`;
CREATE TABLE IF NOT EXISTS `tp_article` (
  `article_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` smallint(5) NOT NULL DEFAULT '0' COMMENT '类别ID',
  `title` varchar(150) NOT NULL DEFAULT '' COMMENT '文章标题',
  `content` longtext NOT NULL,
  `author` varchar(30) NOT NULL DEFAULT '' COMMENT '文章作者',
  `author_email` varchar(60) NOT NULL DEFAULT '' COMMENT '作者邮箱',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `article_type` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `is_open` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `file_url` varchar(255) NOT NULL DEFAULT '' COMMENT '附件地址',
  `open_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `link` varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `description` mediumtext COMMENT '文章摘要',
  `click` int(11) DEFAULT '0' COMMENT '浏览量',
  `publish_time` int(11) DEFAULT NULL COMMENT '文章预告发布时间',
  `thumb` varchar(255) DEFAULT '' COMMENT '文章缩略图',
  PRIMARY KEY (`article_id`) USING BTREE,
  KEY `cat_id` (`cat_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-article 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_article` ENABLE KEYS */;

-- 导出  表 goldchain.tp-article_cat 结构
DROP TABLE IF EXISTS `tp_article_cat`;
CREATE TABLE IF NOT EXISTS `tp_article_cat` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(20) DEFAULT NULL COMMENT '类别名称',
  `cat_type` smallint(6) DEFAULT '0' COMMENT '默认分组',
  `parent_id` smallint(6) DEFAULT '0' COMMENT '夫级ID',
  `show_in_nav` tinyint(1) DEFAULT '0' COMMENT '是否导航显示',
  `sort_order` smallint(6) DEFAULT '50' COMMENT '排序',
  `cat_desc` varchar(255) DEFAULT NULL COMMENT '分类描述',
  `keywords` varchar(30) DEFAULT NULL COMMENT '搜索关键词',
  `cat_alias` varchar(20) DEFAULT NULL COMMENT '别名',
  PRIMARY KEY (`cat_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-article_cat 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_article_cat` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_article_cat` ENABLE KEYS */;

-- 导出  表 goldchain.tp-barter 结构
DROP TABLE IF EXISTS `tp_barter`;
CREATE TABLE IF NOT EXISTS `tp_barter` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `barter_img` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '易物图片',
  `barter_price` decimal(10,2) NOT NULL COMMENT '易物价格',
  `barter_title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '易物标题',
  `sort` int(3) NOT NULL DEFAULT '999' COMMENT '排序0最大，默认999',
  `is_via` int(1) NOT NULL DEFAULT '0' COMMENT '是否通过：0审核中；1通过；2不通过',
  `is_shelf` int(1) NOT NULL DEFAULT '1' COMMENT '是否上架：1上架；0下架',
  `clicks` int(11) NOT NULL DEFAULT '0' COMMENT '点击量',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `savetime` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-barter 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_barter` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_barter` ENABLE KEYS */;

-- 导出  表 goldchain.tp-brand 结构
DROP TABLE IF EXISTS `tp_brand`;
CREATE TABLE IF NOT EXISTS `tp_brand` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '品牌表',
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '品牌名称',
  `logo` varchar(80) NOT NULL DEFAULT '' COMMENT '品牌logo',
  `desc` text NOT NULL COMMENT '品牌描述',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '品牌地址',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  `cat_name` varchar(128) DEFAULT '' COMMENT '品牌分类',
  `cat_id1` int(11) DEFAULT '0' COMMENT '一级分类id',
  `cat_id2` int(10) DEFAULT '0' COMMENT '二级分类id',
  `cat_id3` int(11) DEFAULT '0' COMMENT '三级分类id',
  `is_hot` tinyint(1) DEFAULT '0' COMMENT '是否推荐',
  `store_id` int(10) DEFAULT '0' COMMENT '商家ID',
  `status` tinyint(1) DEFAULT '0' COMMENT '0正常 1审核中 2审核失败 审核状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-brand 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_brand` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_brand` ENABLE KEYS */;

-- 导出  表 goldchain.tp-brand_type 结构
DROP TABLE IF EXISTS `tp_brand_type`;
CREATE TABLE IF NOT EXISTS `tp_brand_type` (
  `type_id` int(10) unsigned NOT NULL COMMENT '类型id',
  `brand_id` int(10) unsigned NOT NULL COMMENT '品牌id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='商品类型与品牌对应表';

-- 正在导出表  goldchain.tp-brand_type 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_brand_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_brand_type` ENABLE KEYS */;

-- 导出  表 goldchain.tp-cart 结构
DROP TABLE IF EXISTS `tp_cart`;
CREATE TABLE IF NOT EXISTS `tp_cart` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '购物车表',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `session_id` char(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT 'session',
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `goods_sn` varchar(60) NOT NULL DEFAULT '' COMMENT '商品货号',
  `goods_name` varchar(120) NOT NULL DEFAULT '' COMMENT '商品名称',
  `market_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '本店价',
  `member_goods_price` decimal(10,2) DEFAULT '0.00' COMMENT '会员折扣价',
  `goods_num` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '购买数量',
  `spec_key` varchar(64) DEFAULT '' COMMENT '商品规格key 对应tp_spec_goods_price 表',
  `spec_key_name` varchar(64) DEFAULT '' COMMENT '商品规格组合名称',
  `bar_code` varchar(64) DEFAULT '' COMMENT '商品条码',
  `selected` tinyint(1) DEFAULT '1' COMMENT '购物车选中状态',
  `add_time` int(11) DEFAULT '0' COMMENT '加入购物车的时间',
  `prom_type` tinyint(1) DEFAULT '0' COMMENT '0 普通订单,1 限时抢购, 2 团购 , 3 促销优惠',
  `prom_id` int(11) DEFAULT '0' COMMENT '活动id',
  `sku` varchar(128) DEFAULT '' COMMENT 'sku',
  `store_id` int(10) DEFAULT '0' COMMENT '商家店铺ID',
  `hcredit` decimal(10,2) DEFAULT '0.00' COMMENT '红积分',
  `user_price` decimal(10,2) DEFAULT '0.00' COMMENT '会员价时，商城价减去积分的部分',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `session_id` (`session_id`) USING BTREE,
  KEY `goods_id` (`goods_id`) USING BTREE,
  KEY `spec_key` (`spec_key`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-cart 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_cart` ENABLE KEYS */;

-- 导出  表 goldchain.tp-changegoods 结构
DROP TABLE IF EXISTS `tp_changegoods`;
CREATE TABLE IF NOT EXISTS `tp_changegoods` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `master_order_sn` varchar(255) DEFAULT NULL COMMENT '主订单号',
  `order_sn` varchar(50) NOT NULL COMMENT '订单编号',
  `user_id` int(5) NOT NULL COMMENT '用户ID',
  `add_time` varchar(10) NOT NULL COMMENT '添加订单时间',
  `goods_id` int(11) NOT NULL COMMENT '商品ID',
  `goods_name` varchar(50) DEFAULT NULL COMMENT '商品名称',
  `goods_num` int(2) DEFAULT '1' COMMENT '商品数量',
  `province` varchar(50) NOT NULL COMMENT '省份id',
  `city` varchar(50) DEFAULT NULL COMMENT '城市id',
  `district` varchar(50) DEFAULT NULL COMMENT '县',
  `twon` varchar(255) DEFAULT NULL COMMENT '街道',
  `address` varchar(255) DEFAULT NULL COMMENT '详细地址',
  `mobile` varchar(11) NOT NULL COMMENT '手机号',
  `email` varchar(20) DEFAULT NULL COMMENT '邮箱',
  `zipcode` varchar(10) DEFAULT NULL COMMENT '邮编',
  `consignee` varchar(20) NOT NULL COMMENT '收货人',
  `goods_price` decimal(10,2) DEFAULT '0.00' COMMENT '每个商品价格',
  `cost_price` decimal(10,2) DEFAULT '0.00' COMMENT '成本价',
  `total_goods_price` decimal(10,2) DEFAULT '0.00' COMMENT '订单总价',
  `change_user_id` int(5) NOT NULL COMMENT '物品原会员id',
  `order_status` smallint(2) DEFAULT '0' COMMENT '订单状态.0待确认，1已确认，2已收货，3已取消，4已完成，5已作废',
  `pay_status` smallint(2) NOT NULL DEFAULT '1' COMMENT '支付状态.0待支付，1已支付，2支付失败',
  `order_statis_id` int(1) DEFAULT '0' COMMENT '结算id如果为0为未结算',
  `shipping_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '发货状态',
  `shipping_time` int(11) DEFAULT '0' COMMENT '最新发货时间',
  `deleted` tinyint(1) unsigned zerofill NOT NULL DEFAULT '0' COMMENT '用户假删除标识,1:删除,0未删除',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-changegoods 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_changegoods` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_changegoods` ENABLE KEYS */;

-- 导出  表 goldchain.tp-chat_log 结构
DROP TABLE IF EXISTS `tp_chat_log`;
CREATE TABLE IF NOT EXISTS `tp_chat_log` (
  `m_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '记录ID',
  `f_id` int(10) unsigned NOT NULL COMMENT '会员ID',
  `f_name` varchar(50) NOT NULL DEFAULT '' COMMENT '会员名',
  `f_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '发自IP',
  `t_id` int(10) unsigned NOT NULL COMMENT '接收会员ID',
  `t_name` varchar(50) NOT NULL DEFAULT '' COMMENT '接收会员名',
  `t_msg` varchar(300) DEFAULT NULL COMMENT '消息内容',
  `add_time` int(10) unsigned DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`m_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='消息记录表';

-- 正在导出表  goldchain.tp-chat_log 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_chat_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_chat_log` ENABLE KEYS */;

-- 导出  表 goldchain.tp-chat_msg 结构
DROP TABLE IF EXISTS `tp_chat_msg`;
CREATE TABLE IF NOT EXISTS `tp_chat_msg` (
  `m_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '记录ID',
  `f_id` int(10) unsigned NOT NULL COMMENT '会员ID',
  `f_name` varchar(50) NOT NULL DEFAULT '' COMMENT '会员名',
  `f_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '发自IP',
  `t_id` int(10) unsigned NOT NULL COMMENT '接收会员ID',
  `t_name` varchar(50) NOT NULL DEFAULT '' COMMENT '接收会员名',
  `t_msg` varchar(300) DEFAULT NULL COMMENT '消息内容',
  `r_state` tinyint(1) unsigned DEFAULT '2' COMMENT '状态:1为已读,2为未读,默认为2',
  `add_time` int(10) unsigned DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`m_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='消息表';

-- 正在导出表  goldchain.tp-chat_msg 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_chat_msg` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_chat_msg` ENABLE KEYS */;

-- 导出  表 goldchain.tp-comment 结构
DROP TABLE IF EXISTS `tp_comment`;
CREATE TABLE IF NOT EXISTS `tp_comment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id自增',
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `order_id` mediumint(8) NOT NULL DEFAULT '0' COMMENT '订单id',
  `store_id` int(10) NOT NULL DEFAULT '0' COMMENT '店铺id',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `content` text COMMENT '评论内容',
  `add_time` int(11) unsigned DEFAULT NULL COMMENT '评论时间',
  `ip_address` varchar(15) NOT NULL DEFAULT '' COMMENT '评论ip地址',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示;0:不显示；1:显示',
  `img` text COMMENT '晒单图片',
  `spec_key_name` varchar(255) NOT NULL DEFAULT '',
  `goods_rank` decimal(2,1) NOT NULL DEFAULT '0.0' COMMENT '商品评价等级，好 中 差',
  `zan_num` int(10) DEFAULT NULL,
  `zan_userid` varchar(255) NOT NULL DEFAULT '',
  `reply_num` int(10) DEFAULT NULL COMMENT '评论回复数',
  `is_anonymous` tinyint(1) DEFAULT '0' COMMENT '是否匿名评价0:是；1不是',
  `impression` varchar(50) DEFAULT NULL COMMENT '印象标签',
  `deleted` tinyint(1) unsigned zerofill NOT NULL DEFAULT '0' COMMENT '假删除标识;1:删除,0:未删除',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '上级评论ID',
  PRIMARY KEY (`comment_id`) USING BTREE,
  KEY `id_value` (`goods_id`) USING BTREE,
  KEY `order_id` (`order_id`) USING BTREE,
  KEY `store_id` (`store_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-comment 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_comment` ENABLE KEYS */;

-- 导出  表 goldchain.tp-complain 结构
DROP TABLE IF EXISTS `tp_complain`;
CREATE TABLE IF NOT EXISTS `tp_complain` (
  `complain_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '投诉id',
  `order_id` int(11) DEFAULT NULL COMMENT '订单id',
  `order_sn` varchar(20) DEFAULT '' COMMENT '订单编号',
  `order_goods_id` int(10) unsigned DEFAULT '0' COMMENT '订单商品ID',
  `user_id` int(11) DEFAULT NULL COMMENT '原告id',
  `user_name` varchar(50) DEFAULT NULL COMMENT '原告名称',
  `user_contact` varchar(100) DEFAULT NULL COMMENT '原告联系方式',
  `store_id` int(11) DEFAULT NULL COMMENT '被告id',
  `store_name` varchar(50) NOT NULL DEFAULT '' COMMENT '被告名称',
  `complain_subject_name` varchar(50) NOT NULL DEFAULT '' COMMENT '投诉主题',
  `complain_subject_id` int(11) DEFAULT NULL COMMENT '投诉主题id',
  `complain_content` varchar(255) NOT NULL DEFAULT '' COMMENT '投诉内容',
  `complain_pic` text COMMENT '投诉图片',
  `complain_time` int(11) DEFAULT NULL COMMENT '投诉时间',
  `complain_handle_time` int(11) NOT NULL DEFAULT '0' COMMENT '投诉处理时间',
  `complain_handle_admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '投诉处理人id',
  `appeal_msg` varchar(255) NOT NULL DEFAULT '' COMMENT '申诉内容',
  `appeal_time` int(11) DEFAULT NULL COMMENT '申诉时间',
  `appeal_pic` text COMMENT '申诉图片',
  `final_handle_msg` varchar(255) DEFAULT '' COMMENT '最终处理意见',
  `final_handle_time` int(11) DEFAULT NULL COMMENT '最终处理时间',
  `final_handle_admin_id` int(11) DEFAULT NULL COMMENT '最终处理人id',
  `complain_state` tinyint(2) NOT NULL DEFAULT '1' COMMENT '投诉状态(1待处理2对话中3待仲裁4已完成)',
  `user_handle_time` int(11) DEFAULT '0' COMMENT '用户提交仲裁时间',
  PRIMARY KEY (`complain_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='投诉表';

-- 正在导出表  goldchain.tp-complain 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_complain` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_complain` ENABLE KEYS */;

-- 导出  表 goldchain.tp-complain_subject 结构
DROP TABLE IF EXISTS `tp_complain_subject`;
CREATE TABLE IF NOT EXISTS `tp_complain_subject` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '投诉主题id',
  `subject_name` varchar(50) NOT NULL DEFAULT '' COMMENT '投诉主题',
  `subject_desc` varchar(100) NOT NULL DEFAULT '' COMMENT '投诉主题描述',
  `subject_state` tinyint(4) NOT NULL DEFAULT '1' COMMENT '投诉主题状态(1-有效/2-失效)',
  PRIMARY KEY (`subject_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='投诉主题表';

-- 正在导出表  goldchain.tp-complain_subject 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_complain_subject` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_complain_subject` ENABLE KEYS */;

-- 导出  表 goldchain.tp-complain_talk 结构
DROP TABLE IF EXISTS `tp_complain_talk`;
CREATE TABLE IF NOT EXISTS `tp_complain_talk` (
  `talk_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '投诉对话id',
  `complain_id` int(11) NOT NULL COMMENT '投诉id',
  `talk_member_id` int(11) NOT NULL COMMENT '发言人id',
  `talk_member_name` varchar(50) NOT NULL DEFAULT '' COMMENT '发言人名称',
  `talk_member_type` varchar(10) NOT NULL DEFAULT '' COMMENT '发言人类型(1-投诉人/2-被投诉人/3-平台)',
  `talk_content` varchar(255) NOT NULL DEFAULT '' COMMENT '发言内容',
  `talk_state` tinyint(4) NOT NULL DEFAULT '0' COMMENT '发言状态(1-显示/2-不显示)',
  `talk_admin` int(11) NOT NULL DEFAULT '0' COMMENT '对话管理员，屏蔽对话人的id',
  `talk_time` int(11) NOT NULL COMMENT '对话发表时间',
  PRIMARY KEY (`talk_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='投诉对话表';

-- 正在导出表  goldchain.tp-complain_talk 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_complain_talk` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_complain_talk` ENABLE KEYS */;

-- 导出  表 goldchain.tp-config 结构
DROP TABLE IF EXISTS `tp_config`;
CREATE TABLE IF NOT EXISTS `tp_config` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `value` varchar(2048) DEFAULT NULL,
  `inc_type` varchar(20) DEFAULT NULL,
  `desc` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-config 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_config` ENABLE KEYS */;

-- 导出  表 goldchain.tp-coupon 结构
DROP TABLE IF EXISTS `tp_coupon`;
CREATE TABLE IF NOT EXISTS `tp_coupon` (
  `id` int(8) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '优惠券名字',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发放类型 0下单赠送 1 按用户发放 2 免费领取 3 线下发放',
  `use_type` tinyint(1) DEFAULT '0' COMMENT '使用范围：0全店通用1指定商品可用2指定分类商品可用',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '优惠券金额',
  `condition` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '使用条件',
  `createnum` int(11) DEFAULT '10' COMMENT '发放数量',
  `send_num` int(11) DEFAULT '0' COMMENT '已领取数量',
  `use_num` int(11) DEFAULT '0' COMMENT '已使用数量',
  `send_start_time` int(11) DEFAULT NULL COMMENT '发放开始时间',
  `send_end_time` int(11) DEFAULT NULL COMMENT '发放结束时间',
  `use_start_time` int(11) DEFAULT NULL COMMENT '使用开始时间',
  `use_end_time` int(11) DEFAULT NULL COMMENT '使用结束时间',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `store_id` int(10) DEFAULT '0' COMMENT '商家店铺ID',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态：1有效2无效',
  `coupon_info` varchar(255) DEFAULT NULL COMMENT '优惠券描述',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `store_id` (`store_id`) USING BTREE,
  KEY `use_end_time` (`use_end_time`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='优惠券表';

-- 正在导出表  goldchain.tp-coupon 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_coupon` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_coupon` ENABLE KEYS */;

-- 导出  表 goldchain.tp-coupon_list 结构
DROP TABLE IF EXISTS `tp_coupon_list`;
CREATE TABLE IF NOT EXISTS `tp_coupon_list` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `cid` int(8) NOT NULL DEFAULT '0' COMMENT '优惠券 对应coupon表id',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发放类型 0下单赠送 1 按用户发放 2 免费领取 3 线下发放',
  `uid` int(8) NOT NULL DEFAULT '0' COMMENT '用户id',
  `order_id` int(8) NOT NULL DEFAULT '0' COMMENT '订单id',
  `use_time` int(11) NOT NULL DEFAULT '0' COMMENT '使用时间',
  `code` varchar(10) DEFAULT '' COMMENT '优惠券兑换码',
  `send_time` int(11) NOT NULL DEFAULT '0' COMMENT '发放时间',
  `store_id` int(10) DEFAULT '0' COMMENT '商家店铺ID',
  `status` tinyint(4) DEFAULT '0' COMMENT '0未使用1已使用2已过期',
  `deleted` tinyint(1) DEFAULT '0' COMMENT '删除标识;1:删除,0未删除',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `cid` (`cid`) USING BTREE,
  KEY `code` (`code`) USING BTREE,
  KEY `store_id` (`store_id`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE,
  KEY `order_id` (`order_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-coupon_list 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_coupon_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_coupon_list` ENABLE KEYS */;

-- 导出  表 goldchain.tp-coupon_price 结构
DROP TABLE IF EXISTS `tp_coupon_price`;
CREATE TABLE IF NOT EXISTS `tp_coupon_price` (
  `coupon_price_id` smallint(4) NOT NULL AUTO_INCREMENT,
  `coupon_price_value` smallint(4) NOT NULL DEFAULT '0' COMMENT '优惠券面额',
  PRIMARY KEY (`coupon_price_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='优惠券面额表';

-- 正在导出表  goldchain.tp-coupon_price 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_coupon_price` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_coupon_price` ENABLE KEYS */;

-- 导出  表 goldchain.tp-delivery_doc 结构
DROP TABLE IF EXISTS `tp_delivery_doc`;
CREATE TABLE IF NOT EXISTS `tp_delivery_doc` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '发货单ID',
  `order_id` int(11) unsigned NOT NULL COMMENT '订单ID',
  `order_sn` varchar(64) NOT NULL DEFAULT '',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `admin_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `consignee` varchar(64) NOT NULL DEFAULT '' COMMENT '收货人',
  `zipcode` varchar(6) DEFAULT NULL COMMENT '邮编',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '联系手机',
  `country` int(11) unsigned NOT NULL COMMENT '国ID',
  `province` int(11) unsigned NOT NULL COMMENT '省ID',
  `city` int(11) unsigned NOT NULL COMMENT '市ID',
  `district` int(11) unsigned NOT NULL COMMENT '区ID',
  `address` varchar(255) NOT NULL DEFAULT '',
  `shipping_code` varchar(32) DEFAULT NULL COMMENT '物流code',
  `shipping_name` varchar(64) DEFAULT NULL COMMENT '快递名称',
  `shipping_price` decimal(10,2) DEFAULT '0.00' COMMENT '运费',
  `invoice_no` varchar(255) NOT NULL DEFAULT '' COMMENT '物流单号',
  `tel` varchar(64) DEFAULT NULL COMMENT '座机电话',
  `note` text COMMENT '管理员添加的备注信息',
  `best_time` int(11) DEFAULT NULL COMMENT '友好收货时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `is_del` tinyint(1) DEFAULT '0' COMMENT '是否已经删除',
  `store_id` int(11) DEFAULT '0' COMMENT '店铺商家id',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `order_id` (`order_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='发货单';

-- 正在导出表  goldchain.tp-delivery_doc 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_delivery_doc` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_delivery_doc` ENABLE KEYS */;

-- 导出  表 goldchain.tp-expense_log 结构
DROP TABLE IF EXISTS `tp_expense_log`;
CREATE TABLE IF NOT EXISTS `tp_expense_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL COMMENT '操作管理员',
  `money` decimal(10,2) DEFAULT NULL COMMENT '支出金额',
  `type` tinyint(1) DEFAULT '0' COMMENT '支出类型0商家提现1用户提现2订单退款3其他',
  `addtime` int(11) DEFAULT NULL COMMENT '日志记录时间',
  `log_type_id` int(11) DEFAULT '0' COMMENT '业务关联ID',
  `user_id` int(10) DEFAULT '0' COMMENT '涉及会员id',
  `store_id` int(10) DEFAULT '0' COMMENT '涉及商家id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='平台支出记录日志';

-- 正在导出表  goldchain.tp-expense_log 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_expense_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_expense_log` ENABLE KEYS */;

-- 导出  表 goldchain.tp-expose 结构
DROP TABLE IF EXISTS `tp_expose`;
CREATE TABLE IF NOT EXISTS `tp_expose` (
  `expose_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '举报id',
  `expose_user_id` int(11) NOT NULL COMMENT '举报人id',
  `expose_user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '举报人会员名',
  `expose_order_sn` varchar(20) DEFAULT '0' COMMENT '相关订单号',
  `expose_goods_id` int(11) NOT NULL COMMENT '被举报的商品id',
  `expose_goods_name` varchar(100) NOT NULL DEFAULT '' COMMENT '被举报的商品名称',
  `expose_type_id` int(11) DEFAULT NULL COMMENT '举报类型',
  `expose_type_name` varchar(50) DEFAULT NULL COMMENT '举报类型名称',
  `expose_subject_id` int(11) DEFAULT NULL COMMENT '举报主题id',
  `expose_subject_name` varchar(100) DEFAULT NULL COMMENT '举报主题',
  `expose_content` varchar(255) DEFAULT NULL COMMENT '举报信息',
  `expose_pic` text COMMENT '图片1',
  `expose_time` int(11) NOT NULL COMMENT '举报时间',
  `expose_store_id` int(11) NOT NULL COMMENT '被举报商品的店铺id',
  `expose_store_name` varchar(100) DEFAULT NULL COMMENT '店铺名',
  `expose_state` tinyint(4) NOT NULL DEFAULT '1' COMMENT '举报状态(1未处理/2已处理)',
  `expose_handle_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '举报处理结果(1无效举报/2恶意举报/3有效举报)',
  `expose_handle_msg` varchar(100) DEFAULT '' COMMENT '举报处理信息',
  `expose_handle_time` int(11) DEFAULT '0' COMMENT '举报处理时间',
  `expose_handle_admin_id` int(11) DEFAULT '0' COMMENT '管理员id',
  PRIMARY KEY (`expose_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='举报表';

-- 正在导出表  goldchain.tp-expose 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_expose` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_expose` ENABLE KEYS */;

-- 导出  表 goldchain.tp-expose_subject 结构
DROP TABLE IF EXISTS `tp_expose_subject`;
CREATE TABLE IF NOT EXISTS `tp_expose_subject` (
  `expose_subject_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '举报主题id',
  `expose_subject_content` varchar(100) NOT NULL DEFAULT '' COMMENT '举报主题内容',
  `expose_subject_type_id` int(11) NOT NULL COMMENT '举报类型id',
  `expose_subject_type_name` varchar(50) NOT NULL DEFAULT '' COMMENT '举报类型名称 ',
  `expose_subject_state` tinyint(11) NOT NULL DEFAULT '0' COMMENT '举报主题状态(1可用/2失效)',
  PRIMARY KEY (`expose_subject_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='举报主题表';

-- 正在导出表  goldchain.tp-expose_subject 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_expose_subject` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_expose_subject` ENABLE KEYS */;

-- 导出  表 goldchain.tp-expose_type 结构
DROP TABLE IF EXISTS `tp_expose_type`;
CREATE TABLE IF NOT EXISTS `tp_expose_type` (
  `expose_type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '举报类型id',
  `expose_type_name` varchar(50) NOT NULL DEFAULT '' COMMENT '举报类型名称 ',
  `expose_type_desc` varchar(100) NOT NULL DEFAULT '' COMMENT '举报类型描述',
  `expose_type_state` tinyint(4) NOT NULL DEFAULT '0' COMMENT '举报类型状态(1有效/2失效)',
  PRIMARY KEY (`expose_type_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='举报类型表';

-- 正在导出表  goldchain.tp-expose_type 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_expose_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_expose_type` ENABLE KEYS */;

-- 导出  表 goldchain.tp-feedback 结构
DROP TABLE IF EXISTS `tp_feedback`;
CREATE TABLE IF NOT EXISTS `tp_feedback` (
  `msg_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '默认自增ID',
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '回复留言ID',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `user_name` varchar(60) NOT NULL DEFAULT '',
  `msg_title` varchar(200) NOT NULL DEFAULT '' COMMENT '留言标题',
  `msg_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '留言类型',
  `msg_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '处理状态',
  `msg_content` text NOT NULL COMMENT '留言内容',
  `msg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '留言时间',
  `message_img` varchar(255) NOT NULL DEFAULT '',
  `order_id` int(11) unsigned NOT NULL DEFAULT '0',
  `msg_area` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`msg_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-feedback 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_feedback` ENABLE KEYS */;

-- 导出  表 goldchain.tp-flash_sale 结构
DROP TABLE IF EXISTS `tp_flash_sale`;
CREATE TABLE IF NOT EXISTS `tp_flash_sale` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL DEFAULT '' COMMENT '活动标题',
  `goods_id` int(10) NOT NULL COMMENT '参团商品ID',
  `item_id` bigint(20) DEFAULT '0' COMMENT '对应spec_goods_price商品规格id',
  `price` decimal(10,2) NOT NULL COMMENT '活动价格',
  `goods_num` int(10) DEFAULT '1' COMMENT '商品参加活动数',
  `buy_limit` int(11) NOT NULL DEFAULT '1' COMMENT '每人限购数',
  `buy_num` int(11) NOT NULL DEFAULT '0' COMMENT '已购买人数',
  `order_num` int(10) DEFAULT '0' COMMENT '已下单数',
  `description` text COMMENT '活动描述',
  `start_time` int(11) NOT NULL COMMENT '开始时间',
  `end_time` int(11) NOT NULL COMMENT '结束时间',
  `is_end` tinyint(1) DEFAULT '0' COMMENT '是否已结束',
  `goods_name` varchar(255) DEFAULT NULL COMMENT '商品名称',
  `store_id` int(10) DEFAULT '0',
  `recommend` tinyint(1) DEFAULT '0' COMMENT '是否推荐',
  `status` tinyint(1) DEFAULT '0' COMMENT '抢购状态：1正常，0待审核，2审核拒绝，3关闭活动，4商品售馨',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-flash_sale 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_flash_sale` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_flash_sale` ENABLE KEYS */;

-- 导出  表 goldchain.tp-flowstat 结构
DROP TABLE IF EXISTS `tp_flowstat`;
CREATE TABLE IF NOT EXISTS `tp_flowstat` (
  `stattime` int(11) unsigned NOT NULL COMMENT '访问日期',
  `clicknum` int(11) unsigned NOT NULL COMMENT '访问量',
  `store_id` int(11) unsigned NOT NULL COMMENT '店铺ID',
  `type` varchar(10) NOT NULL DEFAULT '' COMMENT '类型',
  `goods_id` int(11) unsigned NOT NULL COMMENT '商品ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='访问量统计表';

-- 正在导出表  goldchain.tp-flowstat 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_flowstat` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_flowstat` ENABLE KEYS */;

-- 导出  表 goldchain.tp-friend_link 结构
DROP TABLE IF EXISTS `tp_friend_link`;
CREATE TABLE IF NOT EXISTS `tp_friend_link` (
  `link_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_logo` varchar(255) NOT NULL DEFAULT '',
  `orderby` tinyint(3) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  `is_show` tinyint(1) DEFAULT '1' COMMENT '是否显示',
  `target` tinyint(1) DEFAULT '1' COMMENT '是否新窗口打开',
  PRIMARY KEY (`link_id`) USING BTREE,
  KEY `show_order` (`orderby`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-friend_link 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_friend_link` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_friend_link` ENABLE KEYS */;

-- 导出  表 goldchain.tp-goldchain_daysum 结构
DROP TABLE IF EXISTS `tp_goldchain_daysum`;
CREATE TABLE IF NOT EXISTS `tp_goldchain_daysum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL COMMENT '日期',
  `min_price` decimal(20,8) NOT NULL DEFAULT '0.00000000' COMMENT '最低价',
  `max_price` decimal(20,8) NOT NULL DEFAULT '0.00000000' COMMENT '最高价',
  `open_price` decimal(20,8) NOT NULL DEFAULT '0.00000000' COMMENT '开盘价',
  `close_price` decimal(20,8) NOT NULL DEFAULT '0.00000000' COMMENT '收盘价',
  `inherit_price` decimal(20,8) NOT NULL DEFAULT '0.00000000' COMMENT '次日开盘价',
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='新淘链日交易统计表';

-- 正在导出表  goldchain.tp-goldchain_daysum 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_goldchain_daysum` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_goldchain_daysum` ENABLE KEYS */;

-- 导出  表 goldchain.tp-goldchain_entrust 结构
DROP TABLE IF EXISTS `tp_goldchain_entrust`;
CREATE TABLE IF NOT EXISTS `tp_goldchain_entrust` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trade_no` varchar(50) NOT NULL DEFAULT '' COMMENT '业务单号',
  `user_id` int(11) NOT NULL COMMENT '委托人ID',
  `type` tinyint(4) NOT NULL COMMENT '业务类型[1.出售委托 2.购买委托]',
  `total_qty` decimal(20,6) NOT NULL COMMENT '委托总数量',
  `price` decimal(20,8) NOT NULL COMMENT '委托价格',
  `finish_qty` decimal(20,6) NOT NULL COMMENT '完成数量',
  `surplus_qty` decimal(20,6) NOT NULL COMMENT '剩余数量',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态[0.未完成1.已完成2.已取消]',
  `create_time` int(11) DEFAULT NULL COMMENT '业务申请时间',
  `complete_time` int(11) DEFAULT NULL COMMENT '业务完成时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='新淘链交易委托';

-- 正在导出表  goldchain.tp-goldchain_entrust 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_goldchain_entrust` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_goldchain_entrust` ENABLE KEYS */;

-- 导出  表 goldchain.tp-goldchain_log 结构
DROP TABLE IF EXISTS `tp_goldchain_log`;
CREATE TABLE IF NOT EXISTS `tp_goldchain_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '关联用户id',
  `chain` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '太金链',
  `frozen_chain` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '冻结太金链',
  `power` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '算力',
  `frozen_power` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '冻结算力',
  `trade_no` varchar(50) NOT NULL DEFAULT '' COMMENT '相关业务单号',
  `memo` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `create_time` int(11) DEFAULT NULL COMMENT '业务时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='新淘链日志';

-- 正在导出表  goldchain.tp-goldchain_log 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_goldchain_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_goldchain_log` ENABLE KEYS */;

-- 导出  表 goldchain.tp-goldchain_trade 结构
DROP TABLE IF EXISTS `tp_goldchain_trade`;
CREATE TABLE IF NOT EXISTS `tp_goldchain_trade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trade_no` varchar(50) NOT NULL DEFAULT '' COMMENT '交易流水号',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0.普通交易 1.委托交易',
  `way` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1.卖出 2.买入',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '交易发起人id',
  `relation_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '交易完成人id',
  `sold_entrust_id` int(11) NOT NULL DEFAULT '0' COMMENT '售出方委托id',
  `buy_entrust_id` int(11) NOT NULL DEFAULT '0' COMMENT '购买方委托id',
  `trade_qty` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '交易数量',
  `price` decimal(20,8) NOT NULL DEFAULT '0.00000000' COMMENT '单价',
  `amount` decimal(20,8) NOT NULL DEFAULT '0.00000000' COMMENT '金额',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态0.未完成1.已完成2.已取消3.已冻结',
  `create_time` int(11) DEFAULT NULL COMMENT '业务时间',
  `complete_time` int(11) DEFAULT NULL COMMENT '完成时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='新淘链交易表';

-- 正在导出表  goldchain.tp-goldchain_trade 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_goldchain_trade` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_goldchain_trade` ENABLE KEYS */;

-- 导出  表 goldchain.tp-goods 结构
DROP TABLE IF EXISTS `tp_goods`;
CREATE TABLE IF NOT EXISTS `tp_goods` (
  `goods_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `cat_id1` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '一级分类id',
  `cat_id2` int(11) DEFAULT '0' COMMENT '二级分类',
  `cat_id3` int(11) DEFAULT '0' COMMENT '三级分类',
  `store_cat_id1` int(11) DEFAULT '0' COMMENT '本店一级分类',
  `store_cat_id2` int(11) DEFAULT '0' COMMENT '本店二级分类',
  `goods_sn` varchar(60) NOT NULL DEFAULT '' COMMENT '商品编号',
  `goods_name` varchar(120) NOT NULL DEFAULT '' COMMENT '商品名称',
  `click_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击数',
  `brand_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '品牌id',
  `store_count` smallint(5) unsigned NOT NULL DEFAULT '10' COMMENT '库存数量',
  `collect_sum` int(10) DEFAULT '0' COMMENT '商品收藏数',
  `comment_count` smallint(5) DEFAULT '0' COMMENT '商品评论数',
  `weight` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商品重量克为单位',
  `market_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `shop_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '本店价',
  `cost_price` decimal(10,2) DEFAULT '0.00' COMMENT '商品成本价',
  `exchange_integral` int(10) NOT NULL DEFAULT '0' COMMENT 'COMMENT ''积分兑换：0不参与积分兑换',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '商品关键词',
  `goods_remark` varchar(420) NOT NULL DEFAULT '' COMMENT '商品简单描述',
  `goods_content` text COMMENT '商品详细描述',
  `original_img` varchar(255) NOT NULL DEFAULT '' COMMENT '商品上传原始图',
  `is_virtual` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否为虚拟商品 1是，0否',
  `virtual_indate` int(11) DEFAULT '0' COMMENT '虚拟商品有效期',
  `virtual_limit` smallint(6) DEFAULT '0' COMMENT '虚拟商品购买上限',
  `virtual_refund` tinyint(1) DEFAULT '1' COMMENT '是否允许过期退款， 1是，0否',
  `is_on_sale` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0下架1上架2违规下架',
  `is_free_shipping` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否包邮0否1是',
  `on_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品上架时间',
  `sort` smallint(4) unsigned NOT NULL DEFAULT '50' COMMENT '商品排序',
  `is_recommend` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `is_new` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否新品',
  `is_hot` tinyint(1) DEFAULT '0' COMMENT '是否热卖',
  `last_update` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `goods_type` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商品所属类型id，取值表goods_type的id',
  `give_integral` int(11) DEFAULT '0' COMMENT '购买商品赠送积分',
  `sales_sum` int(11) DEFAULT '0' COMMENT '商品销量',
  `prom_type` tinyint(1) DEFAULT '0' COMMENT '0默认1抢购2团购3优惠促销',
  `prom_id` int(11) DEFAULT '0' COMMENT '优惠活动id',
  `distribut` decimal(10,2) DEFAULT '0.00' COMMENT '佣金用于分销分成',
  `store_id` int(11) DEFAULT '0' COMMENT '商家店铺ID',
  `spu` varchar(128) DEFAULT '' COMMENT 'SPU',
  `sku` varchar(128) DEFAULT '' COMMENT 'SKU',
  `goods_state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0待审核1审核通过2审核失败',
  `close_reason` varchar(255) DEFAULT NULL COMMENT '违规下架原因',
  `suppliers_id` smallint(5) unsigned DEFAULT '0' COMMENT '供应商ID',
  `shipping_area_ids` varchar(255) NOT NULL DEFAULT '' COMMENT '配送物流shipping_area_id,以逗号分隔',
  `is_own_shop` tinyint(1) DEFAULT '0' COMMENT '1:第三方自营店,2:总平台自营店',
  `ywuser_id` int(11) DEFAULT '0' COMMENT '易物区，供货会员id',
  `deduct` int(5) NOT NULL DEFAULT '0' COMMENT '平台对商家抽成比例',
  `fewnew` varchar(255) DEFAULT '' COMMENT '表示物品几成新',
  `chact` varchar(255) DEFAULT '' COMMENT '联系人',
  `hcredit` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '红积分',
  `goods_xianzhi` varchar(10) NOT NULL DEFAULT '0' COMMENT '商品限制兑换数量，为0时该商品不可兑换',
  `member_xianzhi` varchar(10) NOT NULL DEFAULT '0' COMMENT '会员可兑换限制',
  `goods_label` varchar(100) DEFAULT NULL COMMENT '商品标签',
  PRIMARY KEY (`goods_id`) USING BTREE,
  KEY `goods_sn` (`goods_sn`) USING BTREE,
  KEY `cat_id` (`cat_id1`) USING BTREE,
  KEY `last_update` (`last_update`) USING BTREE,
  KEY `brand_id` (`brand_id`) USING BTREE,
  KEY `goods_number` (`store_count`) USING BTREE,
  KEY `goods_weight` (`weight`) USING BTREE,
  KEY `sort_order` (`sort`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-goods 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_goods` ENABLE KEYS */;

-- 导出  表 goldchain.tp-goods_attr 结构
DROP TABLE IF EXISTS `tp_goods_attr`;
CREATE TABLE IF NOT EXISTS `tp_goods_attr` (
  `goods_attr_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品属性id自增',
  `goods_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `attr_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '属性id',
  `attr_value` text NOT NULL COMMENT '属性值',
  `attr_price` varchar(255) NOT NULL DEFAULT '' COMMENT '属性价格',
  PRIMARY KEY (`goods_attr_id`) USING BTREE,
  KEY `goods_id` (`goods_id`) USING BTREE,
  KEY `attr_id` (`attr_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-goods_attr 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_goods_attr` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_goods_attr` ENABLE KEYS */;

-- 导出  表 goldchain.tp-goods_attribute 结构
DROP TABLE IF EXISTS `tp_goods_attribute`;
CREATE TABLE IF NOT EXISTS `tp_goods_attribute` (
  `attr_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '属性id',
  `attr_name` varchar(60) NOT NULL DEFAULT '' COMMENT '属性名称',
  `type_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '属性分类id',
  `attr_index` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0不需要检索 1关键字检索',
  `attr_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '下拉框展示给商家选择',
  `attr_input_type` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '2多行文本框,平台属性录入方式',
  `attr_values` text NOT NULL COMMENT '可选值列表',
  `order` tinyint(3) unsigned NOT NULL DEFAULT '50' COMMENT '属性排序',
  PRIMARY KEY (`attr_id`) USING BTREE,
  KEY `cat_id` (`type_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-goods_attribute 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_goods_attribute` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_goods_attribute` ENABLE KEYS */;

-- 导出  表 goldchain.tp-goods_browse 结构
DROP TABLE IF EXISTS `tp_goods_browse`;
CREATE TABLE IF NOT EXISTS `tp_goods_browse` (
  `goods_id` int(11) NOT NULL COMMENT '商品ID',
  `member_id` int(11) NOT NULL COMMENT '会员ID',
  `browsetime` int(11) NOT NULL COMMENT '浏览时间',
  `gc_id` int(11) NOT NULL COMMENT '商品分类',
  `gc_id_1` int(11) NOT NULL COMMENT '商品一级分类',
  `gc_id_2` int(11) NOT NULL COMMENT '商品二级分类',
  `gc_id_3` int(11) NOT NULL COMMENT '商品三级分类',
  PRIMARY KEY (`goods_id`,`member_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='商品浏览历史表';

-- 正在导出表  goldchain.tp-goods_browse 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_goods_browse` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_goods_browse` ENABLE KEYS */;

-- 导出  表 goldchain.tp-goods_category 结构
DROP TABLE IF EXISTS `tp_goods_category`;
CREATE TABLE IF NOT EXISTS `tp_goods_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品分类id',
  `name` varchar(90) NOT NULL DEFAULT '' COMMENT '商品分类名称',
  `mobile_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '手机端显示的商品分类名',
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  `parent_id_path` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '家族图谱',
  `level` tinyint(1) DEFAULT '0' COMMENT '等级',
  `sort_order` tinyint(1) unsigned NOT NULL DEFAULT '50' COMMENT '顺序排序',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `image` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '分类图片',
  `is_hot` tinyint(1) DEFAULT '0' COMMENT '是否推荐为热门分类',
  `cat_group` tinyint(1) DEFAULT '0' COMMENT '分类分组默认0',
  `commission` tinyint(2) DEFAULT '0' COMMENT '佣金比例',
  `commission_rate` tinyint(1) DEFAULT '0' COMMENT '分佣比例用于分销',
  `type_id` int(11) DEFAULT '0' COMMENT '对应的类型id',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `parent_id` (`parent_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-goods_category 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_goods_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_goods_category` ENABLE KEYS */;

-- 导出  表 goldchain.tp-goods_collect 结构
DROP TABLE IF EXISTS `tp_goods_collect`;
CREATE TABLE IF NOT EXISTS `tp_goods_collect` (
  `collect_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `cat_id3` mediumint(8) NOT NULL DEFAULT '0',
  `add_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`collect_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `goods_id` (`goods_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-goods_collect 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_goods_collect` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_goods_collect` ENABLE KEYS */;

-- 导出  表 goldchain.tp-goods_consult 结构
DROP TABLE IF EXISTS `tp_goods_consult`;
CREATE TABLE IF NOT EXISTS `tp_goods_consult` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品咨询id',
  `goods_id` int(11) DEFAULT '0' COMMENT '商品id',
  `username` varchar(32) DEFAULT '' COMMENT '网名',
  `add_time` int(11) DEFAULT '0' COMMENT '咨询时间',
  `consult_type` tinyint(1) DEFAULT '1' COMMENT '1 商品咨询 2 支付咨询 3 配送 4 售后',
  `content` varchar(1024) DEFAULT '' COMMENT '咨询内容',
  `parent_id` int(11) DEFAULT '0' COMMENT '父id 用于管理员回复',
  `store_id` int(11) DEFAULT '0' COMMENT '店铺id',
  `is_show` tinyint(1) DEFAULT '0' COMMENT '是否显示',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-goods_consult 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_goods_consult` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_goods_consult` ENABLE KEYS */;

-- 导出  表 goldchain.tp-goods_coupon 结构
DROP TABLE IF EXISTS `tp_goods_coupon`;
CREATE TABLE IF NOT EXISTS `tp_goods_coupon` (
  `coupon_id` int(8) NOT NULL COMMENT '优惠券id',
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '指定的商品id：为零表示不指定商品',
  `goods_category_id` smallint(5) NOT NULL DEFAULT '0' COMMENT '指定的商品分类：为零表示不指定分类',
  PRIMARY KEY (`coupon_id`,`goods_id`,`goods_category_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-goods_coupon 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_goods_coupon` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_goods_coupon` ENABLE KEYS */;

-- 导出  表 goldchain.tp-goods_images 结构
DROP TABLE IF EXISTS `tp_goods_images`;
CREATE TABLE IF NOT EXISTS `tp_goods_images` (
  `img_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '图片id 自增',
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `image_url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片地址',
  `img_sort` tinyint(1) unsigned zerofill DEFAULT '0' COMMENT '商品缩略图排序,最小的拍最前面',
  PRIMARY KEY (`img_id`) USING BTREE,
  KEY `goods_id` (`goods_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-goods_images 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_goods_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_goods_images` ENABLE KEYS */;

-- 导出  表 goldchain.tp-goods_type 结构
DROP TABLE IF EXISTS `tp_goods_type`;
CREATE TABLE IF NOT EXISTS `tp_goods_type` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id自增',
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '类型名称',
  `cat_id1` smallint(5) DEFAULT '0' COMMENT '一级分类id',
  `cat_id2` smallint(5) DEFAULT '0' COMMENT '二级分类id',
  `cat_id3` smallint(5) DEFAULT '0' COMMENT '三级分类id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-goods_type 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_goods_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_goods_type` ENABLE KEYS */;

-- 导出  表 goldchain.tp-goods_visit 结构
DROP TABLE IF EXISTS `tp_goods_visit`;
CREATE TABLE IF NOT EXISTS `tp_goods_visit` (
  `goods_id` int(11) NOT NULL COMMENT '商品ID',
  `user_id` int(11) NOT NULL COMMENT '会员ID',
  `visittime` int(11) NOT NULL COMMENT '浏览时间',
  `cat_id1` int(11) NOT NULL COMMENT '商品一级分类',
  `cat_id2` int(11) NOT NULL COMMENT '商品二级分类',
  `cat_id3` int(11) NOT NULL COMMENT '商品三级分类',
  `visit_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  PRIMARY KEY (`goods_id`,`user_id`,`visit_id`) USING BTREE,
  KEY `visit_id` (`visit_id`) USING BTREE,
  KEY `goods_id` (`goods_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='商品浏览历史表';

-- 正在导出表  goldchain.tp-goods_visit 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_goods_visit` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_goods_visit` ENABLE KEYS */;

-- 导出  表 goldchain.tp-group_buy 结构
DROP TABLE IF EXISTS `tp_group_buy`;
CREATE TABLE IF NOT EXISTS `tp_group_buy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '团购ID',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '活动名称',
  `start_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  `end_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `item_id` bigint(20) DEFAULT '0' COMMENT '对应spec_goods_price商品规格id',
  `price` decimal(10,2) NOT NULL COMMENT '团购价格',
  `goods_num` int(10) DEFAULT '0' COMMENT '商品参团数',
  `buy_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品已购买数',
  `order_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '已下单人数',
  `virtual_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '虚拟购买数',
  `rebate` decimal(10,1) NOT NULL COMMENT '折扣',
  `intro` text COMMENT '本团介绍',
  `goods_price` decimal(10,2) NOT NULL COMMENT '商品原价',
  `goods_name` varchar(200) NOT NULL DEFAULT '' COMMENT '商品名称',
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否推荐 0.未推荐 1.已推荐',
  `views` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '查看次数',
  `store_id` int(10) DEFAULT '0' COMMENT '商家店铺ID',
  `status` tinyint(1) DEFAULT '0' COMMENT '团购状态，0待审核，1正常2拒绝3关闭',
  `is_end` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否结束,1结束 ，0正常',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='团购商品表';

-- 正在导出表  goldchain.tp-group_buy 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_group_buy` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_group_buy` ENABLE KEYS */;

-- 导出  表 goldchain.tp-jifenlog 结构
DROP TABLE IF EXISTS `tp_jifenlog`;
CREATE TABLE IF NOT EXISTS `tp_jifenlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '提现申请表',
  `user_id` int(11) DEFAULT '0' COMMENT '用户id',
  `jifen` decimal(10,2) DEFAULT '0.00' COMMENT '提现金额',
  `create_time` int(11) DEFAULT '0' COMMENT '申请时间',
  `check_time` int(11) DEFAULT '0' COMMENT '审核时间',
  `pay_time` int(11) DEFAULT '0' COMMENT '支付时间',
  `refuse_time` int(11) DEFAULT '0' COMMENT '拒绝时间',
  `bank_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '银行名称 如支付宝 微信 中国银行 农业银行等',
  `bank_card` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '银行账号或支付宝账号',
  `realname` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '提款账号真实姓名',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '提现备注',
  `taxfee` decimal(10,2) DEFAULT '0.00' COMMENT '税收',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态：-2删除作废-1审核失败0申请中1审核通过2付款成功3付款失败',
  `pay_code` varchar(100) DEFAULT NULL COMMENT '付款对账流水号',
  `error_code` varchar(255) DEFAULT NULL COMMENT '付款失败错误代码',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-jifenlog 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_jifenlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_jifenlog` ENABLE KEYS */;

-- 导出  表 goldchain.tp-jinnum_log 结构
DROP TABLE IF EXISTS `tp_jinnum_log`;
CREATE TABLE IF NOT EXISTS `tp_jinnum_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jin_num` varchar(255) NOT NULL COMMENT '新淘链数量',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `creat_time` datetime NOT NULL COMMENT '创建时间',
  `type` varchar(255) NOT NULL COMMENT '奖励类型',
  `son_uid` int(11) NOT NULL DEFAULT '0' COMMENT '子类的id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 正在导出表  goldchain.tp-jinnum_log 的数据：0 rows
/*!40000 ALTER TABLE `tp_jinnum_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_jinnum_log` ENABLE KEYS */;

-- 导出  表 goldchain.tp-jin_transfer_log 结构
DROP TABLE IF EXISTS `tp_jin_transfer_log`;
CREATE TABLE IF NOT EXISTS `tp_jin_transfer_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '转账人的ID',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '转账类型1：新淘链转账 2其他',
  `money` decimal(20,6) unsigned NOT NULL DEFAULT '0.000000' COMMENT '转账金额',
  `shouxu` decimal(20,8) unsigned NOT NULL DEFAULT '0.00000000' COMMENT '手续费',
  `shi_money` decimal(20,8) unsigned NOT NULL DEFAULT '0.00000000' COMMENT '实际到账',
  `desc` varchar(255) NOT NULL DEFAULT '0' COMMENT '备注',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '收款人的ID',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '转账状态 0未转账 1成功 2失败',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '转账时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='新淘链转账';

-- 正在导出表  goldchain.tp-jin_transfer_log 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_jin_transfer_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_jin_transfer_log` ENABLE KEYS */;

-- 导出  表 goldchain.tp-loves 结构
DROP TABLE IF EXISTS `tp_loves`;
CREATE TABLE IF NOT EXISTS `tp_loves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL COMMENT '用户id',
  `name` varchar(255) NOT NULL COMMENT '用户名称',
  `identitynum` varchar(255) NOT NULL COMMENT '身份证号',
  `sex` varchar(2) NOT NULL COMMENT '性别',
  `uhome` varchar(255) NOT NULL COMMENT '用户籍贯',
  `uwork` varchar(255) NOT NULL COMMENT '用户工作',
  `constellation` varchar(255) NOT NULL COMMENT '用户星座',
  `height` int(11) NOT NULL COMMENT '用户身高',
  `interests` longtext NOT NULL COMMENT '兴趣爱好',
  `explain` longtext NOT NULL COMMENT '个人说明',
  `hope` varchar(255) NOT NULL COMMENT '心中的她',
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `image4` varchar(255) NOT NULL,
  `image5` varchar(255) NOT NULL,
  `isout` int(11) NOT NULL DEFAULT '1' COMMENT '是否审核通过(1为正在审核,2为审核通过,3为已结婚)',
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '注册时间',
  `mobile` varchar(11) NOT NULL COMMENT '联系方式',
  `isdelete` int(1) NOT NULL DEFAULT '1' COMMENT '0为平台删除',
  `ishot` varchar(5) NOT NULL DEFAULT '1' COMMENT '是否受欢迎',
  `sort` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '99' COMMENT '排序：越大排名越靠后',
  `age` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '年龄',
  `is_marry` int(1) DEFAULT '0' COMMENT '婚姻状况1,未婚2，已婚3，离异4，丧偶',
  `toupic` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '头像',
  `gain` decimal(8,2) DEFAULT '0.00' COMMENT '月收入',
  `record` int(1) DEFAULT '0' COMMENT '1,专科 2，本科 3，研究生 4，硕士 5，博士',
  `workstatus` varchar(255) DEFAULT NULL COMMENT '工作状况',
  `brithday` date DEFAULT NULL COMMENT '生日',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-loves 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_loves` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_loves` ENABLE KEYS */;

-- 导出  表 goldchain.tp-marry 结构
DROP TABLE IF EXISTS `tp_marry`;
CREATE TABLE IF NOT EXISTS `tp_marry` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `marry_img` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '婚恋图片',
  `marry_price` decimal(10,2) NOT NULL COMMENT '婚恋价格',
  `marry_title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '婚恋标题',
  `sort` int(3) NOT NULL DEFAULT '999' COMMENT '排序0最大，默认999',
  `is_via` int(1) NOT NULL DEFAULT '0' COMMENT '是否通过：0审核中；1通过；2不通过',
  `is_shelf` int(1) NOT NULL DEFAULT '1' COMMENT '是否上架：1上架；0下架',
  `clicks` int(11) NOT NULL DEFAULT '0' COMMENT '点击量',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `savetime` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-marry 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_marry` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_marry` ENABLE KEYS */;

-- 导出  表 goldchain.tp-member_msg_tpl 结构
DROP TABLE IF EXISTS `tp_member_msg_tpl`;
CREATE TABLE IF NOT EXISTS `tp_member_msg_tpl` (
  `mmt_code` varchar(50) NOT NULL DEFAULT '' COMMENT '用户消息模板编号',
  `mmt_name` varchar(50) NOT NULL DEFAULT '' COMMENT '模板名称',
  `mmt_message_switch` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '站内信接收开关',
  `mmt_message_content` varchar(255) NOT NULL DEFAULT '' COMMENT '站内信消息内容',
  `mmt_short_switch` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '短信接收开关',
  `mmt_short_content` varchar(255) NOT NULL DEFAULT '' COMMENT '短信接收内容',
  `mmt_mail_switch` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '邮件接收开关',
  `mmt_mail_subject` varchar(255) NOT NULL DEFAULT '' COMMENT '邮件标题',
  `mmt_mail_content` text NOT NULL COMMENT '邮件内容',
  PRIMARY KEY (`mmt_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='用户消息模板';

-- 正在导出表  goldchain.tp-member_msg_tpl 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_member_msg_tpl` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_member_msg_tpl` ENABLE KEYS */;

-- 导出  表 goldchain.tp-message 结构
DROP TABLE IF EXISTS `tp_message`;
CREATE TABLE IF NOT EXISTS `tp_message` (
  `message_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '消息ID',
  `admin_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '管理员id',
  `seller_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商家管理员id',
  `message` text NOT NULL COMMENT '站内信内容',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '个体消息：0，全体消息：1',
  `category` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0系统消息，1物流通知，2优惠促销，3商品提醒，4我的资产，5商城好店',
  `send_time` int(10) unsigned NOT NULL COMMENT '发送时间',
  `data` text NOT NULL COMMENT '消息序列化内容',
  PRIMARY KEY (`message_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-message 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_message` ENABLE KEYS */;

-- 导出  表 goldchain.tp-navigation 结构
DROP TABLE IF EXISTS `tp_navigation`;
CREATE TABLE IF NOT EXISTS `tp_navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '前台导航表',
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '导航名称',
  `is_show` tinyint(1) DEFAULT '1' COMMENT '是否显示',
  `is_new` tinyint(1) DEFAULT '1' COMMENT '是否新窗口',
  `sort` smallint(6) DEFAULT '50' COMMENT '排序',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '链接地址',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-navigation 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_navigation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_navigation` ENABLE KEYS */;

-- 导出  表 goldchain.tp-new_yeji 结构
DROP TABLE IF EXISTS `tp_new_yeji`;
CREATE TABLE IF NOT EXISTS `tp_new_yeji` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '新增业绩',
  `year` varchar(50) NOT NULL DEFAULT '0' COMMENT '年',
  `month` varchar(11) NOT NULL DEFAULT '0' COMMENT '月',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='新增业绩表';

-- 正在导出表  goldchain.tp-new_yeji 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_new_yeji` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_new_yeji` ENABLE KEYS */;

-- 导出  表 goldchain.tp-offpay_area 结构
DROP TABLE IF EXISTS `tp_offpay_area`;
CREATE TABLE IF NOT EXISTS `tp_offpay_area` (
  `store_id` int(8) unsigned NOT NULL COMMENT '商家ID',
  `area_id` text COMMENT '县ID组合',
  PRIMARY KEY (`store_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='货到付款支持地区表';

-- 正在导出表  goldchain.tp-offpay_area 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_offpay_area` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_offpay_area` ENABLE KEYS */;

-- 导出  表 goldchain.tp-order 结构
DROP TABLE IF EXISTS `tp_order`;
CREATE TABLE IF NOT EXISTS `tp_order` (
  `order_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `order_sn` varchar(20) NOT NULL DEFAULT '' COMMENT '订单编号',
  `master_order_sn` varchar(20) DEFAULT '' COMMENT '主订单号',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `order_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '订单状态.0待确认，1已确认，2已收货，3已取消，4已完成，5已作废',
  `shipping_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '发货状态',
  `pay_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '支付状态.0待支付，1已支付，2支付失败',
  `consignee` varchar(60) NOT NULL DEFAULT '' COMMENT '收货人',
  `country` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '国家',
  `province` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '省份',
  `city` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '城市',
  `district` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '县区',
  `twon` int(11) NOT NULL DEFAULT '0' COMMENT '乡镇',
  `address` varchar(255) DEFAULT '' COMMENT '地址',
  `zipcode` varchar(60) NOT NULL DEFAULT '' COMMENT '邮政编码',
  `mobile` varchar(60) NOT NULL DEFAULT '' COMMENT '手机',
  `email` varchar(60) NOT NULL DEFAULT '' COMMENT '邮件',
  `shipping_code` varchar(32) NOT NULL DEFAULT '' COMMENT '物流code',
  `shipping_name` varchar(120) NOT NULL DEFAULT '' COMMENT '物流名称',
  `pay_code` varchar(32) NOT NULL DEFAULT '' COMMENT '支付code',
  `pay_name` varchar(120) NOT NULL DEFAULT '' COMMENT '支付方式名称',
  `invoice_title` varchar(256) DEFAULT '' COMMENT '发票抬头',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品总价',
  `shipping_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '邮费',
  `user_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '使用余额',
  `coupon_price` decimal(10,2) DEFAULT '0.00' COMMENT '优惠了多少',
  `integral` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '使用积分',
  `integral_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '使用积分抵多少钱',
  `order_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '应付款金额',
  `total_amount` decimal(10,2) DEFAULT '0.00' COMMENT '订单总价',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下单时间',
  `confirm_time` int(11) DEFAULT '0' COMMENT '收货确认时间',
  `pay_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '支付时间',
  `transaction_id` varchar(100) DEFAULT NULL COMMENT '第三方平台交易流水号',
  `shipping_time` int(11) DEFAULT '0' COMMENT '最新发货时间',
  `order_prom_id` int(10) NOT NULL DEFAULT '0' COMMENT '订单活动id',
  `order_prom_type` tinyint(2) DEFAULT '0' COMMENT '订单类型：0默认1抢购2团购3优惠4预售5虚拟',
  `order_prom_amount` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '订单活动优惠金额',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格调整',
  `user_note` varchar(255) NOT NULL DEFAULT '' COMMENT '用户备注',
  `admin_note` varchar(255) DEFAULT '' COMMENT '管理员备注',
  `parent_sn` varchar(100) DEFAULT NULL COMMENT '父单单号',
  `store_id` int(10) DEFAULT '0' COMMENT '店铺ID',
  `is_comment` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否评价（0：未评价；1：已评价）',
  `deleted` tinyint(1) unsigned zerofill NOT NULL DEFAULT '0' COMMENT '用户假删除标识,1:删除,0未删除',
  `order_statis_id` int(1) DEFAULT '0' COMMENT '结算id如果为0为未结算',
  `commission` decimal(10,2) DEFAULT '0.00' COMMENT '平台抽取的管理费，佣金',
  `hcredit` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '红积分',
  PRIMARY KEY (`order_id`) USING BTREE,
  UNIQUE KEY `order_sn` (`order_sn`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `master_order_sn` (`master_order_sn`) USING BTREE,
  KEY `store_id` (`store_id`) USING BTREE,
  KEY `add_time` (`add_time`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-order 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_order` ENABLE KEYS */;

-- 导出  表 goldchain.tp-order_action 结构
DROP TABLE IF EXISTS `tp_order_action`;
CREATE TABLE IF NOT EXISTS `tp_order_action` (
  `action_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '订单ID',
  `action_user` int(11) NOT NULL DEFAULT '0' COMMENT '操作人 0 为用户操作，其他为管理员id',
  `order_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `shipping_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pay_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `action_note` varchar(255) NOT NULL DEFAULT '' COMMENT '操作备注',
  `log_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '操作时间',
  `status_desc` varchar(255) NOT NULL COMMENT '状态描述',
  `user_type` tinyint(1) DEFAULT '0' COMMENT '0管理员1商家2前台用户',
  `store_id` int(11) DEFAULT '0' COMMENT '商家店铺ID',
  `change_type` int(2) DEFAULT '0' COMMENT '0为其他商品下单，1为易物区商品下单',
  `change_id` int(11) DEFAULT '0' COMMENT '易物区订单id',
  PRIMARY KEY (`action_id`) USING BTREE,
  KEY `order_id` (`order_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-order_action 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_order_action` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_order_action` ENABLE KEYS */;

-- 导出  表 goldchain.tp-order_bill 结构
DROP TABLE IF EXISTS `tp_order_bill`;
CREATE TABLE IF NOT EXISTS `tp_order_bill` (
  `ob_no` int(11) NOT NULL AUTO_INCREMENT COMMENT '结算单编号(年月店铺ID)',
  `ob_start_date` int(11) NOT NULL COMMENT '开始日期',
  `ob_end_date` int(11) NOT NULL COMMENT '结束日期',
  `ob_order_totals` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单金额',
  `ob_shipping_totals` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '运费',
  `ob_order_return_totals` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '退单金额',
  `ob_commis_totals` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '佣金金额',
  `ob_commis_return_totals` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '退还佣金',
  `ob_store_cost_totals` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '店铺促销活动费用',
  `ob_result_totals` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '应结金额',
  `ob_create_date` int(11) DEFAULT '0' COMMENT '生成结算单日期',
  `os_month` mediumint(6) unsigned NOT NULL DEFAULT '0' COMMENT '结算单年月份',
  `ob_state` enum('1','2','3','4') DEFAULT '1' COMMENT '1默认2店家已确认3平台已审核4结算完成',
  `ob_pay_date` int(11) DEFAULT '0' COMMENT '付款日期',
  `ob_pay_content` varchar(200) DEFAULT '' COMMENT '支付备注',
  `ob_store_id` int(11) NOT NULL COMMENT '店铺ID',
  `ob_store_name` varchar(50) DEFAULT NULL COMMENT '店铺名',
  PRIMARY KEY (`ob_no`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-order_bill 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_order_bill` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_order_bill` ENABLE KEYS */;

-- 导出  表 goldchain.tp-order_comment 结构
DROP TABLE IF EXISTS `tp_order_comment`;
CREATE TABLE IF NOT EXISTS `tp_order_comment` (
  `order_commemt_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单评论索引id',
  `order_id` int(11) NOT NULL COMMENT '订单id',
  `store_id` int(11) NOT NULL COMMENT '店铺id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `describe_score` decimal(2,1) NOT NULL COMMENT '描述相符分数（0~5）',
  `seller_score` decimal(2,1) NOT NULL COMMENT '卖家服务分数（0~5）',
  `logistics_score` decimal(2,1) NOT NULL COMMENT '物流服务分数（0~5）',
  `commemt_time` int(10) unsigned DEFAULT NULL COMMENT '评分时间',
  `deleted` tinyint(1) unsigned zerofill NOT NULL DEFAULT '0' COMMENT '不删除0；删除：1',
  PRIMARY KEY (`order_commemt_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='订单评分表';

-- 正在导出表  goldchain.tp-order_comment 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_order_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_order_comment` ENABLE KEYS */;

-- 导出  表 goldchain.tp-order_extend 结构
DROP TABLE IF EXISTS `tp_order_extend`;
CREATE TABLE IF NOT EXISTS `tp_order_extend` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单索引id',
  `store_id` int(10) unsigned NOT NULL COMMENT '店铺ID',
  `shipping_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '配送时间',
  `shipping_express_id` tinyint(1) NOT NULL DEFAULT '0' COMMENT '配送公司ID',
  `evaluation_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评价时间',
  `evalseller_state` enum('0','1') NOT NULL DEFAULT '0' COMMENT '卖家是否已评价买家',
  `evalseller_time` int(10) unsigned NOT NULL COMMENT '卖家评价买家的时间',
  `order_message` varchar(300) DEFAULT NULL COMMENT '订单留言',
  `order_pointscount` int(11) NOT NULL DEFAULT '0' COMMENT '订单赠送积分',
  `voucher_price` int(11) DEFAULT NULL COMMENT '代金券面额',
  `voucher_code` varchar(32) DEFAULT NULL COMMENT '代金券编码',
  `deliver_explain` text COMMENT '发货备注',
  `daddress_id` mediumint(9) NOT NULL DEFAULT '0' COMMENT '发货地址ID',
  `reciver_name` varchar(50) NOT NULL DEFAULT '' COMMENT '收货人姓名',
  `reciver_info` varchar(500) NOT NULL DEFAULT '' COMMENT '收货人其它信息',
  `reciver_province_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '收货人省级ID',
  `reciver_city_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '收货人市级ID',
  `invoice_info` varchar(500) DEFAULT '' COMMENT '发票信息',
  `promotion_info` varchar(500) DEFAULT '' COMMENT '促销信息备注',
  `dlyo_pickup_code` varchar(4) DEFAULT NULL COMMENT '提货码',
  PRIMARY KEY (`order_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-order_extend 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_order_extend` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_order_extend` ENABLE KEYS */;

-- 导出  表 goldchain.tp-order_goods 结构
DROP TABLE IF EXISTS `tp_order_goods`;
CREATE TABLE IF NOT EXISTS `tp_order_goods` (
  `rec_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id自增',
  `order_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '订单id',
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `goods_name` varchar(120) NOT NULL DEFAULT '' COMMENT '商品名称',
  `goods_sn` varchar(60) NOT NULL DEFAULT '' COMMENT '商品货号',
  `goods_num` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '购买数量',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '本店价',
  `cost_price` decimal(10,2) DEFAULT '0.00' COMMENT '商品成本价',
  `member_goods_price` decimal(10,2) DEFAULT '0.00' COMMENT '会员折扣价',
  `give_integral` mediumint(8) DEFAULT '0' COMMENT '购买商品赠送积分',
  `spec_key` varchar(128) DEFAULT '' COMMENT '商品规格key',
  `spec_key_name` varchar(128) DEFAULT '' COMMENT '规格对应的中文名字',
  `bar_code` varchar(64) NOT NULL DEFAULT '' COMMENT '条码',
  `is_comment` tinyint(1) DEFAULT '0' COMMENT '是否评价',
  `prom_type` tinyint(1) DEFAULT '0' COMMENT '0 普通订单,1 限时抢购, 2 团购 , 3 促销优惠, 4 预售',
  `prom_id` int(11) DEFAULT '0' COMMENT '活动id',
  `is_send` tinyint(1) DEFAULT '0' COMMENT '0未发货，1已发货，2已换货，3已退货',
  `delivery_id` int(11) DEFAULT '0' COMMENT '发货单ID',
  `sku` varchar(128) DEFAULT '' COMMENT 'sku',
  `store_id` int(10) DEFAULT '0' COMMENT '商家店铺id',
  `commission` tinyint(1) DEFAULT NULL COMMENT '商家抽成比例',
  `is_checkout` tinyint(1) DEFAULT '0' COMMENT '是否已跟商家结账0 否1是',
  `deleted` tinyint(1) unsigned zerofill NOT NULL DEFAULT '0' COMMENT '0:为删除；1：已删除',
  `distribut` decimal(10,2) DEFAULT '0.00' COMMENT '三级分销的金额',
  `confirm_time` int(11) DEFAULT NULL COMMENT '订单确认收货时间',
  PRIMARY KEY (`rec_id`) USING BTREE,
  KEY `order_id` (`order_id`) USING BTREE,
  KEY `goods_id` (`goods_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-order_goods 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_order_goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_order_goods` ENABLE KEYS */;

-- 导出  表 goldchain.tp-order_statis 结构
DROP TABLE IF EXISTS `tp_order_statis`;
CREATE TABLE IF NOT EXISTS `tp_order_statis` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `start_date` int(11) NOT NULL COMMENT '开始日期',
  `end_date` int(11) NOT NULL COMMENT '结束日期',
  `order_totals` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单商品金额',
  `shipping_totals` decimal(10,2) DEFAULT '0.00' COMMENT '物流运费',
  `return_totals` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '退款金额',
  `return_integral` int(11) DEFAULT '0' COMMENT '退还积分',
  `commis_totals` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '平台抽成',
  `give_integral` decimal(10,2) DEFAULT '0.00' COMMENT '送出积分金额',
  `result_totals` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '本期应结',
  `create_date` int(11) DEFAULT NULL COMMENT '创建记录日期',
  `store_id` int(11) DEFAULT '0' COMMENT '店铺id',
  `order_prom_amount` decimal(10,2) DEFAULT '0.00' COMMENT '优惠价',
  `coupon_price` decimal(10,2) DEFAULT '0.00' COMMENT '优惠券抵扣',
  `integral` int(11) DEFAULT '0' COMMENT '订单使用积分',
  `distribut` decimal(10,2) DEFAULT '0.00' COMMENT '分销金额',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='商家订单结算表';

-- 正在导出表  goldchain.tp-order_statis 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_order_statis` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_order_statis` ENABLE KEYS */;

-- 导出  表 goldchain.tp-pany 结构
DROP TABLE IF EXISTS `tp_pany`;
CREATE TABLE IF NOT EXISTS `tp_pany` (
  `pany_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '分公司ID',
  `pany_name` varchar(255) NOT NULL DEFAULT '' COMMENT '分公司名称',
  `pany_desc` mediumtext NOT NULL COMMENT '分公司描述',
  `is_check` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '分公司状态',
  `pany_contacts` varchar(255) NOT NULL DEFAULT '' COMMENT '分公司联系人',
  `pany_phone` varchar(20) NOT NULL DEFAULT '' COMMENT '分公司电话',
  `store_id` int(10) DEFAULT '0' COMMENT '所属商家id',
  `add_time` int(11) DEFAULT NULL COMMENT '结算时间',
  `money` decimal(11,2) DEFAULT '0.00' COMMENT '月营业额',
  `jiemoney` decimal(10,2) DEFAULT '0.00' COMMENT '结算金额',
  PRIMARY KEY (`pany_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-pany 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_pany` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_pany` ENABLE KEYS */;

-- 导出  表 goldchain.tp-payment 结构
DROP TABLE IF EXISTS `tp_payment`;
CREATE TABLE IF NOT EXISTS `tp_payment` (
  `pay_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `pay_code` varchar(20) NOT NULL DEFAULT '',
  `pay_name` varchar(120) NOT NULL DEFAULT '' COMMENT '支付方式名称',
  `pay_fee` varchar(10) NOT NULL DEFAULT '' COMMENT '手续费',
  `pay_desc` text NOT NULL COMMENT '描述',
  `pay_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `pay_config` text NOT NULL COMMENT '配置',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '开启',
  `is_cod` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否货到付款',
  `is_online` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否在线支付',
  PRIMARY KEY (`pay_id`) USING BTREE,
  UNIQUE KEY `pay_code` (`pay_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-payment 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_payment` ENABLE KEYS */;

-- 导出  表 goldchain.tp-plugin 结构
DROP TABLE IF EXISTS `tp_plugin`;
CREATE TABLE IF NOT EXISTS `tp_plugin` (
  `code` varchar(13) DEFAULT NULL COMMENT '插件编码',
  `name` varchar(55) DEFAULT NULL COMMENT '中文名字',
  `version` varchar(255) DEFAULT NULL,
  `author` varchar(30) DEFAULT NULL,
  `config` text COMMENT '配置信息',
  `config_value` text COMMENT '配置值信息',
  `desc` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '是否启用',
  `type` varchar(50) DEFAULT NULL COMMENT '插件类型 payment支付 login 登陆 shipping物流',
  `icon` varchar(255) DEFAULT NULL COMMENT '图标',
  `bank_code` text COMMENT '网银配置信息',
  `scene` tinyint(1) DEFAULT '0' COMMENT '使用场景 0 PC+手机 1 手机 2 PC'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-plugin 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_plugin` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_plugin` ENABLE KEYS */;

-- 导出  表 goldchain.tp-prom_goods 结构
DROP TABLE IF EXISTS `tp_prom_goods`;
CREATE TABLE IF NOT EXISTS `tp_prom_goods` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '活动ID',
  `title` varchar(60) NOT NULL DEFAULT '' COMMENT '促销活动名称',
  `type` int(2) NOT NULL DEFAULT '0' COMMENT '促销类型:0直接打折,1减价优惠,2固定金额出售,3买就赠优惠券',
  `expression` varchar(100) NOT NULL DEFAULT '' COMMENT '优惠体现',
  `description` text COMMENT '活动描述',
  `start_time` int(11) NOT NULL COMMENT '活动开始时间',
  `end_time` int(11) NOT NULL COMMENT '活动结束时间',
  `status` tinyint(1) DEFAULT '1' COMMENT '1正常，0管理员关闭',
  `is_end` tinyint(1) DEFAULT '0' COMMENT '是否已结束',
  `group` varchar(255) DEFAULT NULL COMMENT '适用范围',
  `store_id` int(10) DEFAULT '0' COMMENT '商家店铺id',
  `orderby` int(10) DEFAULT '0' COMMENT '排序',
  `prom_img` varchar(150) DEFAULT NULL COMMENT '活动宣传图片',
  `recommend` tinyint(1) DEFAULT '0' COMMENT '是否推荐',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-prom_goods 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_prom_goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_prom_goods` ENABLE KEYS */;

-- 导出  表 goldchain.tp-prom_order 结构
DROP TABLE IF EXISTS `tp_prom_order`;
CREATE TABLE IF NOT EXISTS `tp_prom_order` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL DEFAULT '' COMMENT '活动名称',
  `type` int(2) NOT NULL DEFAULT '0' COMMENT '活动类型 0满额打折,1满额优惠金额,2满额送积分,3满额送优惠券',
  `money` float(10,2) DEFAULT '0.00' COMMENT '最小金额',
  `expression` varchar(100) DEFAULT NULL COMMENT '优惠体现',
  `description` text COMMENT '活动描述',
  `start_time` int(11) DEFAULT NULL COMMENT '活动开始时间',
  `end_time` int(11) DEFAULT NULL COMMENT '活动结束时间',
  `status` tinyint(1) DEFAULT '1' COMMENT '1正常，0管理员关闭',
  `group` varchar(255) DEFAULT NULL COMMENT '适用范围',
  `prom_img` varchar(255) DEFAULT NULL COMMENT '活动宣传图',
  `store_id` int(11) DEFAULT '0' COMMENT '商家店铺id',
  `orderby` int(10) DEFAULT '0' COMMENT '排序',
  `recommend` tinyint(4) DEFAULT '0' COMMENT '是否推荐',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-prom_order 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_prom_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_prom_order` ENABLE KEYS */;

-- 导出  表 goldchain.tp-proportion 结构
DROP TABLE IF EXISTS `tp_proportion`;
CREATE TABLE IF NOT EXISTS `tp_proportion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `one_consume` varchar(255) NOT NULL COMMENT '一级算力要求',
  `one_percent` varchar(255) NOT NULL COMMENT '一级算力百分比奖励',
  `two_consume` varchar(255) NOT NULL COMMENT '二级算力要求',
  `two_percent` varchar(255) NOT NULL COMMENT '二级算力百分比奖励',
  `three_consume` varchar(255) NOT NULL COMMENT '三级算力要求',
  `three_percent` varchar(255) NOT NULL COMMENT '三级算力百分比奖励',
  `four_consume` varchar(255) NOT NULL COMMENT '四级算力要求',
  `four_percent` varchar(255) NOT NULL COMMENT '四级算力百分比奖励',
  `five_consume` varchar(255) NOT NULL COMMENT '五级算力要求',
  `five_percent` varchar(255) NOT NULL COMMENT '五级算力百分比奖励',
  `global_consume` varchar(255) NOT NULL COMMENT '全球算力百分比',
  `one_role` varchar(255) NOT NULL COMMENT '直接分享区块动能算力额外奖励百分比',
  `two_role` varchar(255) NOT NULL COMMENT '创业合伙区块动能算力额外奖励百分比',
  `three_role` varchar(255) NOT NULL COMMENT '经销推广区块动能算力额外奖励百分比',
  `four_role` varchar(255) NOT NULL COMMENT '代理区域区块动能算力额外奖励百分比',
  `five_role` varchar(255) NOT NULL COMMENT '股东合伙区块动能算力额外奖励百分比',
  `vis_role` varchar(255) NOT NULL COMMENT '平级算力',
  `static_deduct` varchar(255) NOT NULL COMMENT '静态超额扣除百分比',
  `static_capping` varchar(255) NOT NULL COMMENT '静态封顶',
  `two_capping` varchar(255) NOT NULL COMMENT '创业合伙人封顶',
  `three_capping` varchar(255) NOT NULL COMMENT '经销商封顶',
  `four_capping` varchar(255) NOT NULL COMMENT '代理商封顶',
  `five_capping` varchar(255) NOT NULL COMMENT '股东合伙人封顶',
  `dynamic_day_capping` varchar(255) NOT NULL COMMENT '动态算力日封顶',
  `one_min_consume` varchar(255) NOT NULL COMMENT '一级算力最低要求',
  `two_min_consume` varchar(255) NOT NULL COMMENT '二级算力最低要求',
  `three_min_consume` varchar(255) NOT NULL COMMENT '三级算力最低要求',
  `four_min_consume` varchar(255) NOT NULL COMMENT '四级算力最低要求',
  `five_min_consume` varchar(255) NOT NULL COMMENT '五级算力最低要求',
  `all_one` varchar(255) NOT NULL COMMENT '创业合伙区算力要求',
  `all_two` varchar(255) NOT NULL COMMENT '经销推广区算力要求',
  `all_three` varchar(255) NOT NULL COMMENT '代理区算力要求',
  `all_fore` varchar(255) NOT NULL COMMENT '股东合伙算力要求',
  `ti_money` varchar(255) NOT NULL COMMENT '提现上限',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 正在导出表  goldchain.tp-proportion 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_proportion` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_proportion` ENABLE KEYS */;

-- 导出  表 goldchain.tp-rebate_log 结构
DROP TABLE IF EXISTS `tp_rebate_log`;
CREATE TABLE IF NOT EXISTS `tp_rebate_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分成记录表',
  `user_id` int(11) DEFAULT '0' COMMENT '获佣用户',
  `buy_user_id` int(11) DEFAULT '0' COMMENT '购买人id',
  `nickname` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '购买人名称',
  `order_sn` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '订单编号',
  `order_id` int(11) DEFAULT '0' COMMENT '订单id',
  `goods_price` decimal(10,2) DEFAULT '0.00' COMMENT '订单商品总额',
  `money` decimal(10,2) DEFAULT '0.00' COMMENT '获佣金额',
  `level` tinyint(1) DEFAULT '1' COMMENT '获佣用户级别',
  `create_time` int(11) DEFAULT '0' COMMENT '分成记录生成时间',
  `confirm` int(11) DEFAULT '0' COMMENT '确定收货时间',
  `status` tinyint(1) DEFAULT '0' COMMENT '0未付款,1已付款, 2等待分成(已收货) 3已分成, 4已取消',
  `confirm_time` int(11) DEFAULT '0' COMMENT '确定分成或者取消时间',
  `remark` varchar(1024) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '如果是取消, 有取消备注',
  `store_id` int(11) DEFAULT '0' COMMENT '店铺id',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `order_id` (`order_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-rebate_log 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_rebate_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_rebate_log` ENABLE KEYS */;

-- 导出  表 goldchain.tp-recharge 结构
DROP TABLE IF EXISTS `tp_recharge`;
CREATE TABLE IF NOT EXISTS `tp_recharge` (
  `order_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `nickname` varchar(50) DEFAULT NULL COMMENT '会员昵称',
  `order_sn` varchar(30) NOT NULL DEFAULT '' COMMENT '充值单号',
  `account` decimal(10,2) DEFAULT '0.00' COMMENT '充值金额',
  `ctime` int(11) DEFAULT NULL COMMENT '充值时间',
  `pay_time` int(11) DEFAULT NULL COMMENT '支付时间',
  `pay_code` varchar(20) DEFAULT NULL,
  `pay_name` varchar(80) DEFAULT NULL COMMENT '支付方式',
  `pay_status` tinyint(1) DEFAULT '0' COMMENT '充值状态0:待支付 1:充值成功 2:交易关闭',
  `transaction_id` varchar(100) DEFAULT NULL COMMENT '第三方平台交易流水号',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`order_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-recharge 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_recharge` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_recharge` ENABLE KEYS */;

-- 导出  表 goldchain.tp-region 结构
DROP TABLE IF EXISTS `tp_region`;
CREATE TABLE IF NOT EXISTS `tp_region` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` longtext,
  `level` tinyint(4) DEFAULT '0',
  `parent_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-region 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_region` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_region` ENABLE KEYS */;

-- 导出  表 goldchain.tp-remittal 结构
DROP TABLE IF EXISTS `tp_remittal`;
CREATE TABLE IF NOT EXISTS `tp_remittal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT '用户ID',
  `total_amount` decimal(10,2) DEFAULT NULL COMMENT '订单金额',
  `max_point` decimal(10,2) DEFAULT NULL COMMENT '最多返多少积分',
  `remittal_point` decimal(10,2) DEFAULT '0.00' COMMENT '已经返的积分',
  `notremittal_point` decimal(10,2) DEFAULT '0.00' COMMENT '没有返还的积分',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '返还状态，1未返完；2已返还完成',
  `addtime` int(11) NOT NULL,
  `finishtime` int(11) DEFAULT '0' COMMENT '返还积分完成时间',
  `hcredit` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '红积分',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-remittal 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_remittal` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_remittal` ENABLE KEYS */;

-- 导出  表 goldchain.tp-remittance 结构
DROP TABLE IF EXISTS `tp_remittance`;
CREATE TABLE IF NOT EXISTS `tp_remittance` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分销用户转账记录表',
  `user_id` int(11) DEFAULT '0' COMMENT '汇款的用户id',
  `bank_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '收款银行名称',
  `account_bank` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '银行账号',
  `account_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '开户人名称',
  `money` decimal(10,2) DEFAULT '0.00' COMMENT '汇款金额',
  `status` tinyint(1) DEFAULT '0' COMMENT '0汇款失败 1汇款成功',
  `handle_time` int(11) DEFAULT '0' COMMENT '处理时间',
  `create_time` int(11) DEFAULT '0' COMMENT '申请时间',
  `remark` varchar(1024) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '汇款备注',
  `admin_id` int(11) DEFAULT '0' COMMENT '处理人管理员id',
  `withdrawals_id` int(11) DEFAULT '0' COMMENT '提现申请表id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-remittance 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_remittance` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_remittance` ENABLE KEYS */;

-- 导出  表 goldchain.tp-reply 结构
DROP TABLE IF EXISTS `tp_reply`;
CREATE TABLE IF NOT EXISTS `tp_reply` (
  `reply_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '回复id',
  `comment_id` int(10) NOT NULL COMMENT '评论id：关联评论表',
  `parent_id` int(10) NOT NULL DEFAULT '0' COMMENT '父类id，0为最顶级',
  `content` text NOT NULL COMMENT '回复内容',
  `user_name` varchar(255) NOT NULL DEFAULT '' COMMENT '回复人的昵称',
  `to_name` varchar(255) NOT NULL DEFAULT '' COMMENT '被回复人的昵称',
  `deleted` tinyint(1) unsigned zerofill NOT NULL DEFAULT '0' COMMENT '未删除0；删除：1',
  `reply_time` int(10) unsigned NOT NULL COMMENT '回复时间',
  PRIMARY KEY (`reply_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-reply 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_reply` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_reply` ENABLE KEYS */;

-- 导出  表 goldchain.tp-return_goods 结构
DROP TABLE IF EXISTS `tp_return_goods`;
CREATE TABLE IF NOT EXISTS `tp_return_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '退货申请表id自增',
  `rec_id` int(11) NOT NULL DEFAULT '0' COMMENT '对应订单商品表ID',
  `order_id` int(11) DEFAULT '0' COMMENT '订单id',
  `order_sn` varchar(50) DEFAULT '' COMMENT '订单编号',
  `goods_id` int(11) DEFAULT '0' COMMENT '商品id',
  `goods_num` smallint(6) DEFAULT '1' COMMENT '退货数量',
  `type` tinyint(1) DEFAULT '0' COMMENT '0仅退款 1退货退款  2换货 3维修',
  `reason` varchar(255) DEFAULT NULL COMMENT '退换货退款申请原因',
  `describe` text COMMENT '问题描述',
  `evidence` varchar(255) DEFAULT '1' COMMENT '申请凭据',
  `imgs` text COMMENT '上传图片路径',
  `status` tinyint(1) DEFAULT '0' COMMENT '-2用户取消-1不同意0待审核1通过2已发货3已收货4换货完成5退款完成6申诉仲裁',
  `remark` varchar(255) DEFAULT '' COMMENT '卖家审核进度说明',
  `user_id` int(11) DEFAULT '0' COMMENT '用户id',
  `store_id` int(10) DEFAULT '0' COMMENT '商家店铺ID',
  `spec_key` varchar(64) DEFAULT '' COMMENT '商品规格',
  `consignee` varchar(20) DEFAULT NULL COMMENT '客户姓名',
  `mobile` varchar(20) DEFAULT NULL COMMENT '手机号码',
  `refund_integral` int(10) DEFAULT '0' COMMENT '退还积分',
  `refund_deposit` decimal(10,2) DEFAULT '0.00' COMMENT '退还预存款',
  `refund_money` decimal(10,2) DEFAULT '0.00' COMMENT '退款金额',
  `refund_type` tinyint(1) DEFAULT '0' COMMENT '0退到用户余额 1支付原路退回',
  `refund_mark` varchar(255) DEFAULT NULL COMMENT '管理员退款备注',
  `refund_time` int(11) DEFAULT '0' COMMENT '退款时间',
  `addtime` int(11) DEFAULT '0' COMMENT '售后申请时间',
  `checktime` int(11) DEFAULT '0' COMMENT '卖家审核时间',
  `receivetime` int(11) DEFAULT '0' COMMENT '卖家收货时间',
  `canceltime` int(11) DEFAULT '0' COMMENT '用户取消时间',
  `seller_delivery` text COMMENT '换货服务，卖家重新发货信息',
  `delivery` text COMMENT '用户发货信息',
  `gap` decimal(10,2) DEFAULT '0.00' COMMENT '退款差额',
  `gap_reason` varchar(255) DEFAULT NULL COMMENT '差额原因',
  `is_receive` tinyint(1) DEFAULT '0' COMMENT '申请售后时是否已收货0未收货1已收货',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `rec_id` (`rec_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-return_goods 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_return_goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_return_goods` ENABLE KEYS */;

-- 导出  表 goldchain.tp-search_word 结构
DROP TABLE IF EXISTS `tp_search_word`;
CREATE TABLE IF NOT EXISTS `tp_search_word` (
  `id` int(8) NOT NULL AUTO_INCREMENT COMMENT '搜索表ID',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '搜索关键词，商品关键词',
  `pinyin_full` varchar(255) NOT NULL DEFAULT '' COMMENT '拼音全拼',
  `pinyin_simple` varchar(255) NOT NULL DEFAULT '' COMMENT '拼音简写',
  `search_num` int(8) NOT NULL DEFAULT '0' COMMENT '搜索次数',
  `goods_num` int(8) NOT NULL DEFAULT '0' COMMENT '商品数量',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='搜索关键词表';

-- 正在导出表  goldchain.tp-search_word 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_search_word` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_search_word` ENABLE KEYS */;

-- 导出  表 goldchain.tp-seller 结构
DROP TABLE IF EXISTS `tp_seller`;
CREATE TABLE IF NOT EXISTS `tp_seller` (
  `seller_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '卖家编号',
  `seller_name` varchar(50) DEFAULT '' COMMENT '卖家用户名',
  `user_id` int(10) unsigned DEFAULT NULL COMMENT '用户编号',
  `group_id` int(10) unsigned DEFAULT NULL COMMENT '卖家组编号',
  `store_id` int(10) unsigned DEFAULT NULL COMMENT '店铺编号',
  `is_admin` tinyint(3) unsigned DEFAULT '0' COMMENT '是否管理员(0-不是 1-是)',
  `seller_quicklink` varchar(255) DEFAULT NULL COMMENT '卖家快捷操作',
  `last_login_time` int(11) unsigned DEFAULT NULL COMMENT '最后登录时间',
  `enabled` tinyint(1) DEFAULT '0' COMMENT '激活状态 0启用1关闭',
  `add_time` int(11) DEFAULT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '密码',
  PRIMARY KEY (`seller_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='卖家用户表';

-- 正在导出表  goldchain.tp-seller 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_seller` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_seller` ENABLE KEYS */;

-- 导出  表 goldchain.tp-seller_group 结构
DROP TABLE IF EXISTS `tp_seller_group`;
CREATE TABLE IF NOT EXISTS `tp_seller_group` (
  `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '卖家组编号',
  `group_name` varchar(50) NOT NULL DEFAULT '' COMMENT '组名',
  `act_limits` text NOT NULL COMMENT '权限',
  `smt_limits` text NOT NULL COMMENT '消息权限范围',
  `store_id` int(10) NOT NULL COMMENT '店铺编号',
  PRIMARY KEY (`group_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='卖家用户组表';

-- 正在导出表  goldchain.tp-seller_group 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_seller_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_seller_group` ENABLE KEYS */;

-- 导出  表 goldchain.tp-seller_log 结构
DROP TABLE IF EXISTS `tp_seller_log`;
CREATE TABLE IF NOT EXISTS `tp_seller_log` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '日志编号',
  `log_content` varchar(50) NOT NULL DEFAULT '' COMMENT '日志内容',
  `log_time` int(10) unsigned NOT NULL COMMENT '日志时间',
  `log_seller_id` int(10) unsigned NOT NULL COMMENT '卖家编号',
  `log_seller_name` varchar(50) NOT NULL DEFAULT '' COMMENT '卖家帐号',
  `log_store_id` int(10) unsigned NOT NULL COMMENT '店铺编号',
  `log_seller_ip` varchar(50) NOT NULL DEFAULT '' COMMENT '卖家ip',
  `log_url` varchar(50) NOT NULL DEFAULT '' COMMENT '日志url',
  `log_state` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '日志状态(0-失败 1-成功)',
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='卖家日志表';

-- 正在导出表  goldchain.tp-seller_log 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_seller_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_seller_log` ENABLE KEYS */;

-- 导出  表 goldchain.tp-service 结构
DROP TABLE IF EXISTS `tp_service`;
CREATE TABLE IF NOT EXISTS `tp_service` (
  `service_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '服务中心ID',
  `service_name` varchar(255) NOT NULL DEFAULT '' COMMENT '服务中心名称',
  `service_desc` mediumtext NOT NULL COMMENT '服务中心描述',
  `is_check` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '供应商状态',
  `service_contacts` varchar(255) NOT NULL DEFAULT '' COMMENT '服务中心联系人',
  `service_phone` varchar(20) NOT NULL DEFAULT '' COMMENT '隶属哪个分公司',
  `store_id` int(10) DEFAULT '0' COMMENT '所属商家id',
  `pany_name` varchar(255) NOT NULL COMMENT '隶属分公司',
  `add_time` int(11) DEFAULT '0' COMMENT '结算时间',
  `money` decimal(11,2) DEFAULT '0.00' COMMENT '服务中心月销售额',
  `jiemoney` decimal(10,2) DEFAULT '0.00' COMMENT '结算金额',
  PRIMARY KEY (`service_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-service 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_service` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_service` ENABLE KEYS */;

-- 导出  表 goldchain.tp-shiming 结构
DROP TABLE IF EXISTS `tp_shiming`;
CREATE TABLE IF NOT EXISTS `tp_shiming` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '用户姓名',
  `identitynum` varchar(255) NOT NULL COMMENT '身份证号',
  `sex` varchar(255) NOT NULL COMMENT '性别(1代表男,2代表女)',
  `userid` int(11) NOT NULL COMMENT '用户id',
  `age` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '年龄',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-shiming 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_shiming` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_shiming` ENABLE KEYS */;

-- 导出  表 goldchain.tp-shipping 结构
DROP TABLE IF EXISTS `tp_shipping`;
CREATE TABLE IF NOT EXISTS `tp_shipping` (
  `shipping_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `shipping_code` varchar(20) NOT NULL DEFAULT '' COMMENT '快递代号',
  `shipping_name` varchar(120) NOT NULL DEFAULT '' COMMENT '快递名称',
  `shipping_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `insure` varchar(10) NOT NULL DEFAULT '' COMMENT '保险',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否开启',
  PRIMARY KEY (`shipping_id`) USING BTREE,
  KEY `shipping_code` (`shipping_code`,`enabled`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-shipping 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_shipping` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_shipping` ENABLE KEYS */;

-- 导出  表 goldchain.tp-shipping_area 结构
DROP TABLE IF EXISTS `tp_shipping_area`;
CREATE TABLE IF NOT EXISTS `tp_shipping_area` (
  `shipping_area_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id自增',
  `shipping_area_name` varchar(150) NOT NULL DEFAULT '' COMMENT '配送模板名称',
  `shipping_code` varchar(50) NOT NULL DEFAULT '' COMMENT '物流公司',
  `config` text NOT NULL COMMENT '物流配置',
  `update_time` int(11) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT '0' COMMENT '是否默认',
  `is_close` tinyint(1) DEFAULT '1' COMMENT '是否关闭：1开启，0关闭',
  `store_id` int(11) DEFAULT '0' COMMENT '商家id',
  PRIMARY KEY (`shipping_area_id`) USING BTREE,
  KEY `shipping_id` (`shipping_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-shipping_area 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_shipping_area` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_shipping_area` ENABLE KEYS */;

-- 导出  表 goldchain.tp-sms_log 结构
DROP TABLE IF EXISTS `tp_sms_log`;
CREATE TABLE IF NOT EXISTS `tp_sms_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `mobile` varchar(11) CHARACTER SET latin1 DEFAULT '' COMMENT '手机号',
  `session_id` varchar(128) CHARACTER SET latin1 DEFAULT '' COMMENT 'session_id',
  `add_time` int(11) DEFAULT '0' COMMENT '发送时间',
  `code` varchar(10) CHARACTER SET latin1 DEFAULT '' COMMENT '验证码',
  `seller_id` int(10) DEFAULT '0',
  `status` int(1) DEFAULT '0' COMMENT '1:发送成功,0:发送失败',
  `msg` varchar(255) DEFAULT NULL COMMENT '短信内容',
  `scene` int(1) DEFAULT '0' COMMENT '发送场景,1:用户注册,2:找回密码,3:客户下单,4:客户支付,5:商家发货,6:身份验证',
  `error_msg` text COMMENT '发送短信异常内容',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-sms_log 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_sms_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_sms_log` ENABLE KEYS */;

-- 导出  表 goldchain.tp-sms_template 结构
DROP TABLE IF EXISTS `tp_sms_template`;
CREATE TABLE IF NOT EXISTS `tp_sms_template` (
  `tpl_id` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `sms_sign` varchar(50) NOT NULL DEFAULT '' COMMENT '短信签名',
  `sms_tpl_code` varchar(100) NOT NULL DEFAULT '' COMMENT '短信模板ID',
  `tpl_content` varchar(512) NOT NULL DEFAULT '' COMMENT '发送短信内容',
  `send_scene` varchar(100) NOT NULL DEFAULT '' COMMENT '短信发送场景',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`tpl_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='短信模板配置表';

-- 正在导出表  goldchain.tp-sms_template 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_sms_template` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_sms_template` ENABLE KEYS */;

-- 导出  表 goldchain.tp-spec 结构
DROP TABLE IF EXISTS `tp_spec`;
CREATE TABLE IF NOT EXISTS `tp_spec` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '规格表',
  `name` varchar(55) DEFAULT NULL COMMENT '规格名称',
  `order` int(11) DEFAULT '50' COMMENT '排序',
  `search_index` tinyint(1) DEFAULT '0' COMMENT '是否需要检索',
  `cat_id1` int(11) DEFAULT '0' COMMENT '一级分类',
  `cat_id2` int(11) DEFAULT '0' COMMENT '二级分类',
  `cat_id3` int(11) DEFAULT '0' COMMENT '三级分类',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-spec 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_spec` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_spec` ENABLE KEYS */;

-- 导出  表 goldchain.tp-spec_goods_price 结构
DROP TABLE IF EXISTS `tp_spec_goods_price`;
CREATE TABLE IF NOT EXISTS `tp_spec_goods_price` (
  `item_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '规格商品id',
  `goods_id` int(11) DEFAULT '0' COMMENT '商品id',
  `goods_mark` varchar(255) DEFAULT NULL COMMENT '商品规格备注',
  `key` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '规格键名',
  `key_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '规格键名中文',
  `price` decimal(10,2) DEFAULT NULL COMMENT '价格',
  `store_count` int(11) unsigned DEFAULT '10' COMMENT '库存数量',
  `bar_code` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '商品条形码',
  `sku` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT 'SKU',
  `store_id` int(11) DEFAULT '0' COMMENT '店铺商家id',
  `spec_img` varchar(255) DEFAULT NULL COMMENT '规格商品主图',
  `prom_id` int(10) DEFAULT '0' COMMENT '参加活动id',
  `prom_type` tinyint(2) DEFAULT '0' COMMENT '参加活动类型',
  PRIMARY KEY (`item_id`) USING BTREE,
  KEY `gk` (`goods_id`,`key`) USING BTREE,
  KEY `goods_id` (`goods_id`) USING BTREE,
  KEY `store_id` (`store_id`) USING BTREE,
  KEY `key` (`key`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-spec_goods_price 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_spec_goods_price` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_spec_goods_price` ENABLE KEYS */;

-- 导出  表 goldchain.tp-spec_image 结构
DROP TABLE IF EXISTS `tp_spec_image`;
CREATE TABLE IF NOT EXISTS `tp_spec_image` (
  `goods_id` int(11) DEFAULT '0' COMMENT '商品规格图片表id',
  `spec_image_id` int(11) DEFAULT '0' COMMENT '规格项id',
  `src` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '商品规格图片路径',
  `store_id` int(11) DEFAULT '0' COMMENT '商家id',
  KEY `goods_id` (`goods_id`) USING BTREE,
  KEY `spec_img_id` (`spec_image_id`) USING BTREE,
  KEY `store_id` (`store_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-spec_image 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_spec_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_spec_image` ENABLE KEYS */;

-- 导出  表 goldchain.tp-spec_item 结构
DROP TABLE IF EXISTS `tp_spec_item`;
CREATE TABLE IF NOT EXISTS `tp_spec_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '规格项id',
  `spec_id` int(11) DEFAULT NULL COMMENT '规格id',
  `item` varchar(54) DEFAULT NULL COMMENT '规格项',
  `store_id` int(11) DEFAULT '0' COMMENT '商家id',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `spec_id` (`spec_id`) USING BTREE,
  KEY `item` (`item`) USING BTREE,
  KEY `store_id` (`store_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-spec_item 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_spec_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_spec_item` ENABLE KEYS */;

-- 导出  表 goldchain.tp-spec_type 结构
DROP TABLE IF EXISTS `tp_spec_type`;
CREATE TABLE IF NOT EXISTS `tp_spec_type` (
  `type_id` int(10) unsigned NOT NULL COMMENT '类型id',
  `spec_id` int(10) unsigned NOT NULL COMMENT '规格id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='商品类型与规格对应表';

-- 正在导出表  goldchain.tp-spec_type 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_spec_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_spec_type` ENABLE KEYS */;

-- 导出  表 goldchain.tp-stock_log 结构
DROP TABLE IF EXISTS `tp_stock_log`;
CREATE TABLE IF NOT EXISTS `tp_stock_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) DEFAULT NULL COMMENT '商品ID',
  `goods_name` varchar(100) DEFAULT NULL COMMENT '商品名称',
  `goods_spec` varchar(50) DEFAULT NULL COMMENT '商品规格',
  `order_sn` varchar(30) DEFAULT NULL COMMENT '订单编号',
  `store_id` int(11) DEFAULT NULL COMMENT '商家ID',
  `muid` int(11) DEFAULT NULL COMMENT '操作用户ID',
  `stock` int(11) DEFAULT NULL COMMENT '更改库存',
  `ctime` int(11) DEFAULT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-stock_log 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_stock_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_stock_log` ENABLE KEYS */;

-- 导出  表 goldchain.tp-store 结构
DROP TABLE IF EXISTS `tp_store`;
CREATE TABLE IF NOT EXISTS `tp_store` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '店铺索引id',
  `store_name` varchar(50) NOT NULL DEFAULT '' COMMENT '店铺名称',
  `grade_id` int(11) NOT NULL DEFAULT '0' COMMENT '店铺等级',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员id',
  `user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '会员名称',
  `seller_name` varchar(50) DEFAULT NULL COMMENT '店主卖家用户名',
  `sc_id` int(11) NOT NULL DEFAULT '0' COMMENT '店铺分类',
  `company_name` varchar(50) DEFAULT NULL COMMENT '店铺公司名称',
  `province_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '店铺所在省份ID',
  `city_id` mediumint(8) NOT NULL DEFAULT '0' COMMENT '店铺所在城市ID',
  `district` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '店铺所在地区ID',
  `store_address` varchar(100) NOT NULL DEFAULT '' COMMENT '详细地区',
  `longitude` decimal(10,7) DEFAULT '0.0000000' COMMENT '商家地址经度',
  `latitude` decimal(10,7) DEFAULT '0.0000000' COMMENT '商家地址纬度',
  `store_zip` varchar(10) NOT NULL DEFAULT '' COMMENT '邮政编码',
  `store_state` tinyint(1) NOT NULL DEFAULT '2' COMMENT '店铺状态，0关闭，1开启，2审核中',
  `store_close_info` varchar(255) DEFAULT NULL COMMENT '店铺关闭原因',
  `store_sort` int(11) NOT NULL DEFAULT '0' COMMENT '店铺排序',
  `store_rebate_paytime` varchar(10) NOT NULL DEFAULT '' COMMENT '店铺结算类型',
  `store_time` int(11) DEFAULT NULL COMMENT '开店时间',
  `store_end_time` int(11) DEFAULT NULL COMMENT '店铺关闭时间',
  `store_logo` varchar(255) DEFAULT NULL COMMENT '店铺logo',
  `store_banner` varchar(255) DEFAULT NULL COMMENT '店铺横幅',
  `store_avatar` varchar(150) DEFAULT NULL COMMENT '店铺头像',
  `seo_keywords` varchar(255) DEFAULT NULL COMMENT '店铺seo关键字',
  `seo_description` varchar(255) DEFAULT NULL COMMENT '店铺seo描述',
  `store_aliwangwang` varchar(64) DEFAULT NULL COMMENT '阿里旺旺',
  `store_qq` varchar(50) DEFAULT NULL COMMENT 'QQ',
  `store_phone` varchar(20) DEFAULT NULL COMMENT '商家电话',
  `store_zy` text COMMENT '主营商品',
  `store_domain` varchar(50) DEFAULT NULL COMMENT '店铺二级域名',
  `store_recommend` tinyint(1) NOT NULL DEFAULT '0' COMMENT '推荐，0为否，1为是，默认为0',
  `store_theme` varchar(50) NOT NULL DEFAULT 'default' COMMENT '店铺当前主题',
  `store_credit` int(10) NOT NULL DEFAULT '0' COMMENT '店铺信用',
  `store_desccredit` decimal(3,2) NOT NULL DEFAULT '0.00' COMMENT '描述相符度分数',
  `store_servicecredit` decimal(3,2) NOT NULL DEFAULT '0.00' COMMENT '服务态度分数',
  `store_deliverycredit` decimal(3,2) NOT NULL DEFAULT '0.00' COMMENT '发货速度分数',
  `store_collect` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '店铺收藏数量',
  `store_slide` text COMMENT '店铺幻灯片',
  `store_slide_url` text COMMENT '店铺幻灯片链接',
  `store_printdesc` varchar(500) DEFAULT NULL COMMENT '打印订单页面下方说明文字',
  `store_sales` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '店铺销量',
  `store_presales` text COMMENT '售前客服',
  `store_aftersales` text COMMENT '售后客服',
  `store_workingtime` varchar(100) DEFAULT NULL COMMENT '工作时间',
  `store_free_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '超出该金额免运费，大于0才表示该值有效',
  `store_warning_storage` int(10) DEFAULT '0' COMMENT ' 库存预警数',
  `store_decoration_switch` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '店铺装修开关(0-关闭 装修编号-开启)',
  `store_decoration_only` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '开启店铺装修时，仅显示店铺装修(1-是 0-否',
  `is_own_shop` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否自营店铺 1是 0否',
  `bind_all_gc` tinyint(1) DEFAULT '0' COMMENT '自营店是否绑定全部分类 0否1是',
  `qitian` tinyint(1) DEFAULT '0' COMMENT '7天退换',
  `certified` tinyint(1) DEFAULT '0' COMMENT '正品保障',
  `returned` tinyint(1) DEFAULT '0' COMMENT '退货承诺',
  `store_free_time` varchar(10) DEFAULT NULL COMMENT '商家配送时间',
  `mb_slide` text COMMENT '手机店铺 轮播图链接地址',
  `mb_slide_url` text COMMENT '手机版广告链接',
  `deliver_region` varchar(50) DEFAULT NULL COMMENT '店铺默认配送区域',
  `cod` tinyint(1) DEFAULT '0' COMMENT '货到付款',
  `two_hour` tinyint(1) DEFAULT '0' COMMENT '两小时发货',
  `ensure` tinyint(1) DEFAULT '0' COMMENT '保证服务开关',
  `deposit` decimal(10,2) DEFAULT '0.00' COMMENT '保证金额',
  `deposit_icon` tinyint(1) DEFAULT '0' COMMENT '保证金显示开关',
  `store_money` decimal(12,2) DEFAULT '0.00' COMMENT '店铺可用资金',
  `pending_money` decimal(12,2) DEFAULT '0.00' COMMENT '待结算资金',
  `deleted` tinyint(1) unsigned zerofill NOT NULL DEFAULT '0' COMMENT '未删除0，已删除1',
  `goods_examine` tinyint(1) DEFAULT '0' COMMENT '店铺发布商品是否需要审核',
  `service_phone` varchar(20) DEFAULT NULL COMMENT '客户下单, 接收下单提醒短信',
  `deduct` int(5) NOT NULL DEFAULT '0' COMMENT '平台对商家抽成比例',
  `service_id` int(10) DEFAULT NULL COMMENT '服务中心ID',
  PRIMARY KEY (`store_id`) USING BTREE,
  KEY `store_name` (`store_name`) USING BTREE,
  KEY `sc_id` (`sc_id`) USING BTREE,
  KEY `store_state` (`store_state`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='店铺数据表';

-- 正在导出表  goldchain.tp-store 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_store` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_store` ENABLE KEYS */;

-- 导出  表 goldchain.tp-store_apply 结构
DROP TABLE IF EXISTS `tp_store_apply`;
CREATE TABLE IF NOT EXISTS `tp_store_apply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '申请人会员ID',
  `contacts_name` varchar(20) DEFAULT NULL COMMENT '联系人姓名',
  `contacts_mobile` varchar(20) DEFAULT NULL COMMENT '联系人手机',
  `contacts_email` varchar(50) DEFAULT NULL COMMENT '联系人邮箱',
  `company_name` varchar(30) DEFAULT NULL COMMENT '公司名称',
  `company_type` tinyint(1) DEFAULT '1' COMMENT '公司性质',
  `company_website` varchar(50) DEFAULT NULL COMMENT '公司网址',
  `company_province` mediumint(8) DEFAULT '0' COMMENT '公司所在省份',
  `company_city` mediumint(8) DEFAULT '0' COMMENT '公司所在城市',
  `company_district` mediumint(8) DEFAULT '0' COMMENT '公司所在地区',
  `company_address` varchar(100) DEFAULT NULL COMMENT '公司详细地址',
  `company_telephone` varchar(20) DEFAULT NULL COMMENT '固定电话',
  `company_email` varchar(50) DEFAULT NULL COMMENT '电子邮箱',
  `company_fax` varchar(30) DEFAULT NULL COMMENT '传真',
  `company_zipcode` varchar(20) DEFAULT NULL COMMENT '邮政编码',
  `business_licence_number` varchar(20) DEFAULT NULL COMMENT '营业执照注册号/统一社会信用代码',
  `business_licence_cert` varchar(100) DEFAULT NULL COMMENT '营业执照电子版',
  `threeinone` tinyint(1) DEFAULT '1' COMMENT '是否为一证一码商家',
  `reg_capital` varchar(10) DEFAULT NULL COMMENT '注册资金',
  `legal_person` varchar(20) DEFAULT NULL COMMENT '法人代表',
  `legal_identity_cert` varchar(100) DEFAULT NULL COMMENT '法人身份证照片',
  `legal_identity` varchar(50) DEFAULT NULL COMMENT '法人身份证号',
  `business_date_start` varchar(20) DEFAULT NULL COMMENT '营业执照有效期',
  `business_date_end` varchar(20) DEFAULT NULL,
  `orgnization_code` varchar(20) DEFAULT NULL COMMENT '组织机构代码',
  `orgnization_cert` varchar(100) DEFAULT NULL COMMENT '组织机构代码证',
  `attached_tax_number` varchar(30) DEFAULT NULL COMMENT '纳税人识别号',
  `tax_rate` tinyint(2) DEFAULT '0' COMMENT '纳税类型税码',
  `taxpayer` tinyint(1) DEFAULT '1' COMMENT '纳税人类型',
  `taxpayer_cert` varchar(100) DEFAULT NULL COMMENT '一般纳税人资格证书',
  `business_scope` text COMMENT '营业执照经营范围',
  `store_name` varchar(30) DEFAULT NULL COMMENT '店铺名称',
  `seller_name` varchar(30) DEFAULT NULL COMMENT '卖家账号',
  `store_type` tinyint(1) DEFAULT '0' COMMENT '店铺性质',
  `store_address` varchar(100) DEFAULT NULL,
  `store_person_name` varchar(20) DEFAULT NULL COMMENT '店铺负责人姓名',
  `store_person_mobile` varchar(20) DEFAULT NULL COMMENT '店铺负责人手机',
  `store_person_qq` varchar(20) DEFAULT NULL COMMENT '店铺联系人QQ',
  `store_person_email` varchar(50) DEFAULT NULL COMMENT '店铺负责人邮箱',
  `store_person_cert` varchar(100) DEFAULT NULL COMMENT '店铺负责人身份证照片',
  `store_person_identity` varchar(50) DEFAULT NULL COMMENT '店铺负责人身份证号',
  `bank_account_name` varchar(50) DEFAULT NULL COMMENT '结算银行名称',
  `bank_account_number` varchar(50) DEFAULT NULL COMMENT '结算银行账号',
  `bank_branch_name` varchar(50) DEFAULT NULL COMMENT '开户银行支行名称',
  `bank_province` mediumint(8) DEFAULT '0' COMMENT '开户银行支行所在地',
  `bank_city` mediumint(8) DEFAULT '0' COMMENT '开户银行支行所在城市',
  `main_channel` tinyint(1) DEFAULT '0' COMMENT '近一年主营渠道',
  `sales_volume` varchar(255) DEFAULT NULL COMMENT '近一年销售额',
  `sku_num` mediumint(8) DEFAULT '1' COMMENT '可网售商品数量',
  `ec_experience` tinyint(1) DEFAULT '0' COMMENT '同类电子商务网站经验',
  `avg_price` decimal(10,2) DEFAULT '0.00' COMMENT '预计平均客单价',
  `ware_house` tinyint(1) DEFAULT '0' COMMENT '仓库情况',
  `entity_shop` tinyint(1) DEFAULT '0' COMMENT '有无实体店',
  `sc_name` varchar(50) DEFAULT NULL COMMENT '店铺分类名称',
  `sc_id` int(10) DEFAULT NULL COMMENT '店铺分类编号',
  `sc_bail` mediumint(8) DEFAULT '0' COMMENT '店铺分类保证金',
  `sg_id` tinyint(2) DEFAULT '0' COMMENT '店铺等级编号',
  `sg_name` varchar(30) DEFAULT NULL COMMENT '店铺等级名称',
  `store_class_ids` varchar(255) DEFAULT '' COMMENT '申请分类佣金信息',
  `paying_amount` decimal(10,2) DEFAULT '0.00' COMMENT '付款金额',
  `paying_amount_cert` varchar(100) DEFAULT NULL COMMENT '付款凭证',
  `apply_state` tinyint(2) DEFAULT '0' COMMENT '店铺申请状态',
  `review_msg` varchar(255) DEFAULT NULL COMMENT '管理员审核信息',
  `add_time` int(11) DEFAULT '0' COMMENT '提交申请时间',
  `apply_type` tinyint(1) DEFAULT '0' COMMENT '申请类型默认0企业1个人',
  `service_id` int(10) DEFAULT NULL COMMENT '服务中心ID',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-store_apply 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_store_apply` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_store_apply` ENABLE KEYS */;

-- 导出  表 goldchain.tp-store_bind_class 结构
DROP TABLE IF EXISTS `tp_store_bind_class`;
CREATE TABLE IF NOT EXISTS `tp_store_bind_class` (
  `bid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int(11) unsigned DEFAULT '0' COMMENT '店铺ID',
  `commis_rate` tinyint(4) unsigned DEFAULT '0' COMMENT '佣金比例',
  `class_1` mediumint(9) unsigned DEFAULT '0' COMMENT '一级分类',
  `class_2` mediumint(9) unsigned DEFAULT '0' COMMENT '二级分类',
  `class_3` mediumint(9) unsigned DEFAULT '0' COMMENT '三级分类',
  `state` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态0审核中1审核通过 2审核失败',
  PRIMARY KEY (`bid`) USING BTREE,
  KEY `store_id` (`store_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='店铺可发布商品类目表';

-- 正在导出表  goldchain.tp-store_bind_class 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_store_bind_class` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_store_bind_class` ENABLE KEYS */;

-- 导出  表 goldchain.tp-store_class 结构
DROP TABLE IF EXISTS `tp_store_class`;
CREATE TABLE IF NOT EXISTS `tp_store_class` (
  `sc_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '索引ID',
  `sc_name` varchar(50) NOT NULL DEFAULT '' COMMENT '分类名称',
  `sc_bail` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '保证金数额',
  `sc_sort` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`sc_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='店铺分类表';

-- 正在导出表  goldchain.tp-store_class 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_store_class` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_store_class` ENABLE KEYS */;

-- 导出  表 goldchain.tp-store_collect 结构
DROP TABLE IF EXISTS `tp_store_collect`;
CREATE TABLE IF NOT EXISTS `tp_store_collect` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `store_id` int(10) DEFAULT NULL,
  `add_time` int(11) DEFAULT NULL COMMENT '收藏店铺时间',
  `store_name` varchar(100) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL COMMENT '收藏会员名称',
  PRIMARY KEY (`log_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-store_collect 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_store_collect` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_store_collect` ENABLE KEYS */;

-- 导出  表 goldchain.tp-store_decoration 结构
DROP TABLE IF EXISTS `tp_store_decoration`;
CREATE TABLE IF NOT EXISTS `tp_store_decoration` (
  `decoration_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '装修编号',
  `decoration_name` varchar(50) NOT NULL DEFAULT '' COMMENT '装修名称',
  `store_id` int(10) unsigned NOT NULL COMMENT '店铺编号',
  `decoration_setting` varchar(500) DEFAULT NULL COMMENT '装修整体设置(背景、边距等)',
  `decoration_nav` varchar(5000) DEFAULT NULL COMMENT '装修导航',
  `decoration_banner` varchar(255) DEFAULT NULL COMMENT '装修头部banner',
  PRIMARY KEY (`decoration_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='店铺装修表';

-- 正在导出表  goldchain.tp-store_decoration 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_store_decoration` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_store_decoration` ENABLE KEYS */;

-- 导出  表 goldchain.tp-store_decoration_block 结构
DROP TABLE IF EXISTS `tp_store_decoration_block`;
CREATE TABLE IF NOT EXISTS `tp_store_decoration_block` (
  `block_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '装修块编号',
  `decoration_id` int(10) unsigned NOT NULL COMMENT '装修编号',
  `store_id` int(10) unsigned NOT NULL COMMENT '店铺编号',
  `block_layout` varchar(50) NOT NULL DEFAULT '' COMMENT '块布局',
  `block_content` text COMMENT '块内容',
  `block_module_type` varchar(50) DEFAULT NULL COMMENT '装修块模块类型',
  `block_full_width` tinyint(3) unsigned DEFAULT '0' COMMENT '是否100%宽度(0-否 1-是)',
  `block_sort` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '块排序',
  PRIMARY KEY (`block_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='店铺装修块表';

-- 正在导出表  goldchain.tp-store_decoration_block 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_store_decoration_block` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_store_decoration_block` ENABLE KEYS */;

-- 导出  表 goldchain.tp-store_distribut 结构
DROP TABLE IF EXISTS `tp_store_distribut`;
CREATE TABLE IF NOT EXISTS `tp_store_distribut` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id自增',
  `switch` tinyint(1) DEFAULT '0' COMMENT '分销开关',
  `condition` tinyint(1) DEFAULT '0' COMMENT '成为分销商条件 0 直接成为分销商,1成功购买商品后成为分销商',
  `distribut_pattern` tinyint(1) DEFAULT '0' COMMENT '分销模式 0 按商品设置的分成金额 1 按订单设置的分成比例',
  `first_rate` tinyint(1) DEFAULT '0' COMMENT '一级分销商比例',
  `second_rate` tinyint(1) DEFAULT '0' COMMENT '二级分销商名称',
  `third_rate` tinyint(1) DEFAULT '0' COMMENT '三级分销商名称',
  `date` tinyint(1) DEFAULT '15' COMMENT '订单收货确认后多少天可以分成',
  `store_id` int(11) DEFAULT '0' COMMENT '店铺id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-store_distribut 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_store_distribut` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_store_distribut` ENABLE KEYS */;

-- 导出  表 goldchain.tp-store_extend 结构
DROP TABLE IF EXISTS `tp_store_extend`;
CREATE TABLE IF NOT EXISTS `tp_store_extend` (
  `store_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '店铺ID',
  `express` text COMMENT '快递公司ID的组合',
  `pricerange` text COMMENT '店铺统计设置的商品价格区间',
  `orderpricerange` text COMMENT '店铺统计设置的订单价格区间',
  PRIMARY KEY (`store_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-store_extend 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_store_extend` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_store_extend` ENABLE KEYS */;

-- 导出  表 goldchain.tp-store_goods_class 结构
DROP TABLE IF EXISTS `tp_store_goods_class`;
CREATE TABLE IF NOT EXISTS `tp_store_goods_class` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '索引ID',
  `cat_name` varchar(50) NOT NULL DEFAULT '' COMMENT '店铺商品分类名称',
  `parent_id` int(11) NOT NULL COMMENT '父级id',
  `store_id` int(11) NOT NULL DEFAULT '0' COMMENT '店铺id',
  `cat_sort` int(11) NOT NULL DEFAULT '0' COMMENT '商品分类排序',
  `is_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '分类显示状态',
  `is_nav_show` tinyint(1) DEFAULT '0' COMMENT '是否显示在导航栏',
  `is_recommend` tinyint(1) DEFAULT '0' COMMENT '是否首页推荐',
  `show_num` smallint(4) DEFAULT '4' COMMENT '首页此类商品显示数量',
  PRIMARY KEY (`cat_id`) USING BTREE,
  KEY `stc_parent_id` (`parent_id`,`cat_sort`) USING BTREE,
  KEY `store_id` (`store_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='店铺商品分类表';

-- 正在导出表  goldchain.tp-store_goods_class 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_store_goods_class` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_store_goods_class` ENABLE KEYS */;

-- 导出  表 goldchain.tp-store_grade 结构
DROP TABLE IF EXISTS `tp_store_grade`;
CREATE TABLE IF NOT EXISTS `tp_store_grade` (
  `sg_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '索引ID',
  `sg_name` char(50) DEFAULT NULL COMMENT '等级名称',
  `sg_goods_limit` mediumint(10) unsigned NOT NULL DEFAULT '0' COMMENT '允许发布的商品数量',
  `sg_album_limit` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '允许上传图片数量',
  `sg_space_limit` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传空间大小，单位MB',
  `sg_template_limit` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '选择店铺模板套数',
  `sg_template` varchar(255) DEFAULT NULL COMMENT '模板内容',
  `sg_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '开店费用(元/年)',
  `sg_description` text COMMENT '申请说明',
  `sg_function` varchar(255) DEFAULT NULL COMMENT '附加功能',
  `sg_sort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '级别，数目越大级别越高',
  PRIMARY KEY (`sg_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='店铺等级表';

-- 正在导出表  goldchain.tp-store_grade 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_store_grade` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_store_grade` ENABLE KEYS */;

-- 导出  表 goldchain.tp-store_msg 结构
DROP TABLE IF EXISTS `tp_store_msg`;
CREATE TABLE IF NOT EXISTS `tp_store_msg` (
  `sm_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '店铺消息id',
  `store_id` int(10) unsigned NOT NULL COMMENT '店铺id',
  `content` varchar(512) NOT NULL DEFAULT '' COMMENT '消息内容',
  `addtime` int(10) unsigned NOT NULL COMMENT '发送时间',
  `open` tinyint(1) NOT NULL DEFAULT '0' COMMENT '消息是否已被查看',
  PRIMARY KEY (`sm_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='店铺消息表';

-- 正在导出表  goldchain.tp-store_msg 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_store_msg` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_store_msg` ENABLE KEYS */;

-- 导出  表 goldchain.tp-store_msg_setting 结构
DROP TABLE IF EXISTS `tp_store_msg_setting`;
CREATE TABLE IF NOT EXISTS `tp_store_msg_setting` (
  `smt_code` varchar(100) NOT NULL DEFAULT '' COMMENT '模板编码',
  `store_id` int(10) unsigned NOT NULL COMMENT '店铺id',
  `sms_message_switch` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '站内信接收开关，0关闭，1开启',
  `sms_short_switch` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '短消息接收开关，0关闭，1开启',
  `sms_mail_switch` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '邮件接收开关，0关闭，1开启',
  `sms_short_number` varchar(11) NOT NULL DEFAULT '' COMMENT '手机号码',
  `sms_mail_number` varchar(100) NOT NULL DEFAULT '' COMMENT '邮箱号码',
  PRIMARY KEY (`smt_code`,`store_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='店铺消息接收设置';

-- 正在导出表  goldchain.tp-store_msg_setting 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_store_msg_setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_store_msg_setting` ENABLE KEYS */;

-- 导出  表 goldchain.tp-store_msg_tpl 结构
DROP TABLE IF EXISTS `tp_store_msg_tpl`;
CREATE TABLE IF NOT EXISTS `tp_store_msg_tpl` (
  `smt_code` varchar(100) NOT NULL DEFAULT '' COMMENT '模板编码',
  `smt_name` varchar(100) NOT NULL DEFAULT '' COMMENT '模板名称',
  `smt_message_switch` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '站内信默认开关，0关，1开',
  `smt_message_content` varchar(255) NOT NULL DEFAULT '' COMMENT '站内信内容',
  `smt_message_forced` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '站内信强制接收，0否，1是',
  `smt_short_switch` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '短信默认开关，0关，1开',
  `smt_short_content` varchar(255) NOT NULL DEFAULT '' COMMENT '短信内容',
  `smt_short_forced` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '短信强制接收，0否，1是',
  `smt_mail_switch` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '邮件默认开，0关，1开',
  `smt_mail_subject` varchar(255) NOT NULL DEFAULT '' COMMENT '邮件标题',
  `smt_mail_content` text NOT NULL COMMENT '邮件内容',
  `smt_mail_forced` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '邮件强制接收，0否，1是',
  PRIMARY KEY (`smt_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='商家消息模板';

-- 正在导出表  goldchain.tp-store_msg_tpl 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_store_msg_tpl` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_store_msg_tpl` ENABLE KEYS */;

-- 导出  表 goldchain.tp-store_navigation 结构
DROP TABLE IF EXISTS `tp_store_navigation`;
CREATE TABLE IF NOT EXISTS `tp_store_navigation` (
  `sn_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '导航ID',
  `sn_title` varchar(50) NOT NULL DEFAULT '' COMMENT '导航名称',
  `sn_store_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '卖家店铺ID',
  `sn_content` text COMMENT '导航内容',
  `sn_sort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '导航排序',
  `sn_is_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '导航是否显示',
  `sn_add_time` int(11) NOT NULL COMMENT '添加时间',
  `sn_url` varchar(255) DEFAULT NULL COMMENT '店铺导航的外链URL',
  `sn_new_open` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '店铺导航外链是否在新窗口打开：0不开新窗口1开新窗口，默认是0',
  PRIMARY KEY (`sn_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='卖家店铺导航信息表';

-- 正在导出表  goldchain.tp-store_navigation 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_store_navigation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_store_navigation` ENABLE KEYS */;

-- 导出  表 goldchain.tp-store_remittance 结构
DROP TABLE IF EXISTS `tp_store_remittance`;
CREATE TABLE IF NOT EXISTS `tp_store_remittance` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商家转账记录表',
  `store_id` int(11) DEFAULT '0' COMMENT '汇款的商家id',
  `bank_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '收款银行名称',
  `account_bank` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '银行账号',
  `account_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '开户人名称',
  `money` decimal(10,2) DEFAULT '0.00' COMMENT '汇款金额',
  `status` tinyint(1) DEFAULT '0' COMMENT '0汇款失败 1汇款成功',
  `create_time` int(11) DEFAULT '0' COMMENT '汇款时间',
  `remark` varchar(1024) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '汇款备注',
  `admin_id` int(11) DEFAULT '0' COMMENT '管理员id',
  `withdrawals_id` int(11) DEFAULT '0' COMMENT '提现申请表id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-store_remittance 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_store_remittance` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_store_remittance` ENABLE KEYS */;

-- 导出  表 goldchain.tp-store_reopen 结构
DROP TABLE IF EXISTS `tp_store_reopen`;
CREATE TABLE IF NOT EXISTS `tp_store_reopen` (
  `re_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `re_grade_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '店铺等级ID',
  `re_grade_name` varchar(30) DEFAULT NULL COMMENT '等级名称',
  `re_grade_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '等级收费(元/年)',
  `re_year` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '续签时长(年)',
  `re_pay_amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '应付总金额',
  `re_store_name` varchar(50) DEFAULT NULL COMMENT '店铺名字',
  `re_store_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '店铺ID',
  `re_state` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态0默认，未上传凭证1审核中2审核通过',
  `re_start_time` int(10) unsigned DEFAULT NULL COMMENT '有效期开始时间',
  `re_end_time` int(10) unsigned DEFAULT NULL COMMENT '有效期结束时间',
  `re_create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '记录创建时间',
  `re_pay_cert` varchar(50) DEFAULT NULL COMMENT '付款凭证',
  `re_pay_cert_explain` varchar(200) DEFAULT NULL COMMENT '付款凭证说明',
  PRIMARY KEY (`re_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='续签内容表';

-- 正在导出表  goldchain.tp-store_reopen 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_store_reopen` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_store_reopen` ENABLE KEYS */;

-- 导出  表 goldchain.tp-store_watermark 结构
DROP TABLE IF EXISTS `tp_store_watermark`;
CREATE TABLE IF NOT EXISTS `tp_store_watermark` (
  `wm_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '水印id',
  `jpeg_quality` int(3) NOT NULL DEFAULT '90' COMMENT 'jpeg图片质量',
  `wm_image_name` varchar(255) DEFAULT NULL COMMENT '水印图片的路径以及文件名',
  `wm_image_pos` tinyint(1) NOT NULL DEFAULT '1' COMMENT '水印图片放置的位置',
  `wm_image_transition` int(3) NOT NULL DEFAULT '20' COMMENT '水印图片与原图片的融合度 ',
  `wm_text` text COMMENT '水印文字',
  `wm_text_size` int(3) NOT NULL DEFAULT '20' COMMENT '水印文字大小',
  `wm_text_angle` tinyint(1) NOT NULL DEFAULT '4' COMMENT '水印文字角度',
  `wm_text_pos` tinyint(1) NOT NULL DEFAULT '3' COMMENT '水印文字放置位置',
  `wm_text_font` varchar(50) DEFAULT NULL COMMENT '水印文字的字体',
  `wm_text_color` varchar(7) NOT NULL DEFAULT '#CCCCCC' COMMENT '水印字体的颜色值',
  `wm_is_open` tinyint(1) NOT NULL DEFAULT '0' COMMENT '水印是否开启 0关闭 1开启',
  `store_id` int(11) DEFAULT NULL COMMENT '店铺id',
  PRIMARY KEY (`wm_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='店铺水印图片表';

-- 正在导出表  goldchain.tp-store_watermark 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_store_watermark` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_store_watermark` ENABLE KEYS */;

-- 导出  表 goldchain.tp-store_waybill 结构
DROP TABLE IF EXISTS `tp_store_waybill`;
CREATE TABLE IF NOT EXISTS `tp_store_waybill` (
  `store_waybill_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '店铺运单模板编号',
  `store_id` int(10) unsigned NOT NULL COMMENT '店铺编号',
  `express_id` int(10) unsigned NOT NULL COMMENT '物流公司编号',
  `waybill_id` int(10) unsigned NOT NULL COMMENT '运单模板编号',
  `waybill_name` varchar(50) NOT NULL DEFAULT '' COMMENT '运单模板名称',
  `store_waybill_data` varchar(2000) DEFAULT NULL COMMENT '店铺自定义设置',
  `is_default` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否默认模板',
  `store_waybill_left` int(11) NOT NULL DEFAULT '0' COMMENT '店铺运单左偏移',
  `store_waybill_top` int(11) NOT NULL DEFAULT '0' COMMENT '店铺运单上偏移',
  PRIMARY KEY (`store_waybill_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='店铺运单模板表';

-- 正在导出表  goldchain.tp-store_waybill 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_store_waybill` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_store_waybill` ENABLE KEYS */;

-- 导出  表 goldchain.tp-store_withdrawals 结构
DROP TABLE IF EXISTS `tp_store_withdrawals`;
CREATE TABLE IF NOT EXISTS `tp_store_withdrawals` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商家提现申请表',
  `store_id` int(11) DEFAULT '0' COMMENT '商家id',
  `create_time` int(11) DEFAULT '0' COMMENT '申请日期',
  `refuse_time` int(11) DEFAULT '0' COMMENT '拒绝时间',
  `pay_time` int(11) DEFAULT '0' COMMENT '支付时间',
  `check_time` int(11) DEFAULT '0' COMMENT '审核时间',
  `money` decimal(10,2) DEFAULT '0.00' COMMENT '提现金额',
  `bank_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '银行名称 如支付宝 微信 中国银行 农业银行等',
  `bank_card` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '银行账号',
  `realname` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '银行账户名 可以是支付宝可以其他银行',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '提现备注',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态：-2删除作废-1审核失败0申请中1审核通过2已转款完成',
  `pay_code` varchar(100) DEFAULT NULL COMMENT '付款对账流水号',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-store_withdrawals 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_store_withdrawals` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_store_withdrawals` ENABLE KEYS */;

-- 导出  表 goldchain.tp-submit_errorlog 结构
DROP TABLE IF EXISTS `tp_submit_errorlog`;
CREATE TABLE IF NOT EXISTS `tp_submit_errorlog` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '日志id',
  `member_name` varchar(50) NOT NULL COMMENT '产生错误会员',
  `credit` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '产生错误时的积分数',
  `addtime` varchar(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 正在导出表  goldchain.tp-submit_errorlog 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_submit_errorlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_submit_errorlog` ENABLE KEYS */;

-- 导出  表 goldchain.tp-suppliers 结构
DROP TABLE IF EXISTS `tp_suppliers`;
CREATE TABLE IF NOT EXISTS `tp_suppliers` (
  `suppliers_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '供应商ID',
  `suppliers_name` varchar(255) NOT NULL DEFAULT '' COMMENT '供应商名称',
  `suppliers_desc` mediumtext NOT NULL COMMENT '供应商描述',
  `is_check` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '供应商状态',
  `suppliers_contacts` varchar(255) NOT NULL DEFAULT '' COMMENT '供应商联系人',
  `suppliers_phone` varchar(20) NOT NULL DEFAULT '' COMMENT '供应商电话',
  `store_id` int(10) DEFAULT '0' COMMENT '所属商家id',
  PRIMARY KEY (`suppliers_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-suppliers 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_suppliers` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_suppliers` ENABLE KEYS */;

-- 导出  表 goldchain.tp-system_menu 结构
DROP TABLE IF EXISTS `tp_system_menu`;
CREATE TABLE IF NOT EXISTS `tp_system_menu` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '权限名字',
  `group` varchar(20) DEFAULT NULL COMMENT '所属分组',
  `right` text COMMENT '权限码(控制器+动作)',
  `type` tinyint(1) DEFAULT '0' COMMENT '所属后台：0系统后台，1商家后台',
  `is_del` tinyint(1) DEFAULT '0' COMMENT '删除状态 1删除,0正常',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-system_menu 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_system_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_system_menu` ENABLE KEYS */;

-- 导出  表 goldchain.tp-table_index 结构
DROP TABLE IF EXISTS `tp_table_index`;
CREATE TABLE IF NOT EXISTS `tp_table_index` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '索引表自增id',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '表名字',
  `min_id` int(11) NOT NULL DEFAULT '0' COMMENT '表最小id',
  `max_id` int(11) NOT NULL DEFAULT '0' COMMENT '表最大id',
  `min_order_sn` varchar(20) NOT NULL DEFAULT '' COMMENT '最小订单编号',
  `max_order_sn` varchar(20) DEFAULT '' COMMENT '最大订单编号',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-table_index 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_table_index` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_table_index` ENABLE KEYS */;

-- 导出  表 goldchain.tp-tlflash 结构
DROP TABLE IF EXISTS `tp_tlflash`;
CREATE TABLE IF NOT EXISTS `tp_tlflash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_open` int(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `content` varchar(255) NOT NULL COMMENT '内容',
  `addtime` varchar(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 正在导出表  goldchain.tp-tlflash 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_tlflash` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_tlflash` ENABLE KEYS */;

-- 导出  表 goldchain.tp-topic 结构
DROP TABLE IF EXISTS `tp_topic`;
CREATE TABLE IF NOT EXISTS `tp_topic` (
  `topic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `topic_title` varchar(100) DEFAULT NULL COMMENT '专题标题',
  `topic_image` varchar(100) DEFAULT NULL COMMENT '专题封面',
  `topic_background_color` varchar(20) DEFAULT NULL COMMENT '专题背景颜色',
  `topic_background` varchar(100) DEFAULT NULL COMMENT '专题背景图',
  `topic_content` text COMMENT '专题详情',
  `topic_repeat` varchar(20) DEFAULT '背景重复方式',
  `topic_state` tinyint(1) DEFAULT '1' COMMENT '专题状态1-草稿、2-已发布',
  `topic_margin_top` tinyint(3) DEFAULT '0' COMMENT '正文距顶部距离',
  `ctime` int(11) DEFAULT NULL COMMENT '专题创建时间',
  PRIMARY KEY (`topic_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-topic 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_topic` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_topic` ENABLE KEYS */;

-- 导出  表 goldchain.tp-transfer_log 结构
DROP TABLE IF EXISTS `tp_transfer_log`;
CREATE TABLE IF NOT EXISTS `tp_transfer_log` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL COMMENT '转账人id',
  `mobile` varchar(11) NOT NULL COMMENT '收款人手机号',
  `shouxu` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '手续费',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '转账金额',
  `addtime` varchar(10) DEFAULT NULL COMMENT '转账时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-transfer_log 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_transfer_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_transfer_log` ENABLE KEYS */;

-- 导出  表 goldchain.tp-transport 结构
DROP TABLE IF EXISTS `tp_transport`;
CREATE TABLE IF NOT EXISTS `tp_transport` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '售卖区域ID',
  `title` varchar(30) NOT NULL DEFAULT '' COMMENT '售卖区域名称',
  `send_tpl_id` mediumint(8) unsigned DEFAULT '0' COMMENT '发货地区模板ID',
  `store_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '店铺ID',
  `update_time` int(10) unsigned DEFAULT '0' COMMENT '最后更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='售卖区域';

-- 正在导出表  goldchain.tp-transport 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_transport` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_transport` ENABLE KEYS */;

-- 导出  表 goldchain.tp-transport_extend 结构
DROP TABLE IF EXISTS `tp_transport_extend`;
CREATE TABLE IF NOT EXISTS `tp_transport_extend` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '运费模板扩展ID',
  `area_id` text COMMENT '市级地区ID组成的串，以，隔开，两端也有，',
  `top_area_id` text COMMENT '省级地区ID组成的串，以，隔开，两端也有，',
  `area_name` text COMMENT '地区name组成的串，以，隔开',
  `sprice` decimal(10,2) DEFAULT '0.00' COMMENT '首件运费',
  `transport_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '运费模板ID',
  `transport_title` varchar(60) DEFAULT NULL COMMENT '运费模板',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='运费模板扩展表';

-- 正在导出表  goldchain.tp-transport_extend 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_transport_extend` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_transport_extend` ENABLE KEYS */;

-- 导出  表 goldchain.tp-uloves 结构
DROP TABLE IF EXISTS `tp_uloves`;
CREATE TABLE IF NOT EXISTS `tp_uloves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL COMMENT '用户id',
  `lovesid` int(11) NOT NULL COMMENT '购买的用户资料id',
  `addtime` datetime NOT NULL COMMENT '添加的时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-uloves 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_uloves` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_uloves` ENABLE KEYS */;

-- 导出  表 goldchain.tp-users 结构
DROP TABLE IF EXISTS `tp_users`;
CREATE TABLE IF NOT EXISTS `tp_users` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '手机号码',
  `email` varchar(60) NOT NULL DEFAULT '' COMMENT '邮件',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0 保密 1 男 2 女',
  `birthday` int(11) NOT NULL DEFAULT '0' COMMENT '生日',
  `user_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '用户金额',
  `frozen_money` decimal(10,2) DEFAULT '0.00' COMMENT '冻结金额',
  `distribut_money` decimal(10,2) DEFAULT '0.00' COMMENT '累积分佣金额',
  `pay_points` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '消费积分',
  `paypwd` varchar(128) DEFAULT NULL COMMENT '支付密码',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `qq` varchar(20) NOT NULL DEFAULT '' COMMENT 'QQ',
  `mobile_validated` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否验证手机',
  `oauth` varchar(10) DEFAULT '' COMMENT '第三方来源 wx weibo alipay',
  `openid` varchar(100) DEFAULT NULL COMMENT '第三方唯一标示',
  `unionid` varchar(100) DEFAULT NULL,
  `head_pic` varchar(255) DEFAULT NULL COMMENT '头像',
  `bank_name` varchar(150) DEFAULT NULL COMMENT '银行名称',
  `bank_card` varchar(50) DEFAULT NULL COMMENT '银行账号',
  `realname` varchar(50) DEFAULT NULL COMMENT '用户真实姓名',
  `idcard` varchar(100) DEFAULT NULL COMMENT '身份证号',
  `email_validated` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否验证电子邮箱',
  `nickname` varchar(50) DEFAULT NULL COMMENT '第三方返回昵称',
  `level` tinyint(1) DEFAULT '1' COMMENT '会员等级',
  `discount` decimal(10,2) DEFAULT '1.00' COMMENT '会员折扣，默认1不享受',
  `total_amount` decimal(10,2) DEFAULT '0.00' COMMENT '消费累计额度',
  `is_lock` tinyint(1) DEFAULT '0' COMMENT '是否被锁定冻结',
  `is_distribut` tinyint(1) DEFAULT '0' COMMENT '是否为分销商 0 否 1 是',
  `first_leader` int(11) DEFAULT '0' COMMENT '第一个上级',
  `second_leader` int(11) DEFAULT '0' COMMENT '第二个上级',
  `third_leader` int(11) DEFAULT '0' COMMENT '第三个上级',
  `token` varchar(64) DEFAULT '' COMMENT '用于app 授权类似于session_id',
  `underling_number` int(5) DEFAULT '0' COMMENT '用户下线数',
  `message_mask` bit(6) NOT NULL DEFAULT b'111111' COMMENT '消息掩码',
  `push_id` varchar(30) NOT NULL DEFAULT '' COMMENT '推送id',
  `uid_level` varchar(11) DEFAULT '0' COMMENT '1:一级;2:二级;3:三级',
  `tuimobile` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '推荐人手机号',
  `grade` smallint(2) NOT NULL DEFAULT '0' COMMENT '1为服务中心，2为分公司',
  `is_usercenter` int(1) NOT NULL DEFAULT '2' COMMENT '判断是否为导入会员，1是，2为商城会员',
  `member_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '会员系统名字',
  `id_number` varchar(20) DEFAULT NULL COMMENT '身份证号',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '直推人ID',
  `import_jin_num` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '初始导入新淘链',
  `jin_num` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '新淘链数量',
  `jin_total` varchar(255) NOT NULL DEFAULT '0' COMMENT '累积获得新淘链数量',
  `consume_total` varchar(255) NOT NULL DEFAULT '0' COMMENT '累计消费金额',
  `consume_cp` decimal(20,8) NOT NULL DEFAULT '0.00000000' COMMENT '消费算力',
  `team_performance` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '团队业绩',
  `team_jin_num` decimal(20,6) NOT NULL DEFAULT '0.000000' COMMENT '团队新淘链数量',
  `role_level` varchar(255) NOT NULL DEFAULT '0' COMMENT '会员角色等级',
  `max_parents` varchar(2048) NOT NULL DEFAULT '0' COMMENT '无限极分类字段',
  `frost_jin_num` varchar(255) NOT NULL DEFAULT '0' COMMENT '冻结新淘链数量',
  `frost_consume_cp` varchar(255) NOT NULL DEFAULT '0' COMMENT '冻结消费算力',
  `withdraw_money` decimal(20,8) NOT NULL DEFAULT '0.00000000' COMMENT '提现币',
  `dedication_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '奉献值',
  `user_performance` varchar(255) NOT NULL COMMENT '用户的消费总金额',
  `static_time` varchar(255) NOT NULL COMMENT '获得静态奖励的时间',
  `dynamic_time` varchar(255) NOT NULL COMMENT '动态奖励时间',
  `calculate` int(11) NOT NULL COMMENT '手动点击计算时间',
  `dynamic_jintai` varchar(255) NOT NULL COMMENT '今日获得的新淘链数量',
  `dynamic_shangxian` decimal(20,8) NOT NULL COMMENT '新淘链的每日动态上限',
  `public_key` varchar(255) NOT NULL COMMENT '公钥',
  `private_key` varchar(255) NOT NULL COMMENT '私钥',
  `child_num` int(11) NOT NULL DEFAULT '0' COMMENT '直推人数',
  PRIMARY KEY (`user_id`) USING BTREE,
  UNIQUE KEY `mobile_unique` (`mobile`),
  KEY `email` (`email`) USING BTREE,
  KEY `mobile` (`mobile_validated`) USING BTREE,
  KEY `openid` (`openid`) USING BTREE,
  KEY `unionid` (`unionid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-users 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_users` ENABLE KEYS */;

-- 导出  表 goldchain.tp-users_bak 结构
DROP TABLE IF EXISTS `tp_users_bak`;
CREATE TABLE IF NOT EXISTS `tp_users_bak` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id',
  `email` varchar(60) NOT NULL DEFAULT '' COMMENT '邮件',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0 保密 1 男 2 女',
  `birthday` int(11) NOT NULL DEFAULT '0' COMMENT '生日',
  `user_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '用户金额',
  `frozen_money` decimal(10,2) DEFAULT '0.00' COMMENT '冻结金额',
  `distribut_money` decimal(10,2) DEFAULT '0.00' COMMENT '累积分佣金额',
  `pay_points` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '消费积分',
  `paypwd` varchar(128) DEFAULT NULL COMMENT '支付密码',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `qq` varchar(20) NOT NULL DEFAULT '' COMMENT 'QQ',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '手机号码',
  `mobile_validated` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否验证手机',
  `oauth` varchar(10) DEFAULT '' COMMENT '第三方来源 wx weibo alipay',
  `openid` varchar(100) DEFAULT NULL COMMENT '第三方唯一标示',
  `unionid` varchar(100) DEFAULT NULL,
  `head_pic` varchar(255) DEFAULT NULL COMMENT '头像',
  `bank_name` varchar(150) DEFAULT NULL COMMENT '银行名称',
  `bank_card` varchar(50) DEFAULT NULL COMMENT '银行账号',
  `realname` varchar(50) DEFAULT NULL COMMENT '用户真实姓名',
  `idcard` varchar(100) DEFAULT NULL COMMENT '身份证号',
  `email_validated` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否验证电子邮箱',
  `nickname` varchar(50) DEFAULT NULL COMMENT '第三方返回昵称',
  `level` tinyint(1) DEFAULT '1' COMMENT '会员等级',
  `discount` decimal(10,2) DEFAULT '1.00' COMMENT '会员折扣，默认1不享受',
  `total_amount` decimal(10,2) DEFAULT '0.00' COMMENT '消费累计额度',
  `is_lock` tinyint(1) DEFAULT '0' COMMENT '是否被锁定冻结',
  `is_distribut` tinyint(1) DEFAULT '0' COMMENT '是否为分销商 0 否 1 是',
  `first_leader` int(11) DEFAULT '0' COMMENT '第一个上级',
  `second_leader` int(11) DEFAULT '0' COMMENT '第二个上级',
  `third_leader` int(11) DEFAULT '0' COMMENT '第三个上级',
  `token` varchar(64) DEFAULT '' COMMENT '用于app 授权类似于session_id',
  `underling_number` int(5) DEFAULT '0' COMMENT '用户下线数',
  `message_mask` bit(6) NOT NULL DEFAULT b'111111' COMMENT '消息掩码',
  `push_id` varchar(30) NOT NULL DEFAULT '' COMMENT '推送id',
  `uid_level` varchar(11) DEFAULT '0' COMMENT '1:一级;2:二级;3:三级',
  `tuimobile` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '推荐人手机号',
  `grade` smallint(2) NOT NULL DEFAULT '0' COMMENT '1为服务中心，2为分公司',
  `is_usercenter` int(1) NOT NULL DEFAULT '2' COMMENT '判断是否为会员系统会员，1是，0为商城会员',
  `member_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '会员系统名字',
  `id_number` varchar(20) DEFAULT NULL COMMENT '身份证号',
  `jin_num` varchar(255) NOT NULL DEFAULT '0' COMMENT '新淘链数量',
  `jin_total` varchar(255) NOT NULL DEFAULT '0' COMMENT '累积获得新淘链数量',
  `consume_total` varchar(255) NOT NULL DEFAULT '0' COMMENT '累计消费金额',
  `consume_cp` varchar(255) NOT NULL DEFAULT '0' COMMENT '消费算力',
  `team_performance` varchar(255) NOT NULL DEFAULT '0' COMMENT '团队业绩',
  `role_level` varchar(255) NOT NULL DEFAULT '0' COMMENT '会员角色等级',
  `max_parents` varchar(255) NOT NULL DEFAULT '0' COMMENT '无限极分类字段',
  `frost_jin_num` varchar(255) NOT NULL DEFAULT '0' COMMENT '冻结新淘链数量',
  `frost_consume_cp` varchar(255) NOT NULL DEFAULT '0' COMMENT '冻结消费算力',
  `withdraw_money` varchar(255) NOT NULL DEFAULT '0' COMMENT '提现币',
  PRIMARY KEY (`user_id`) USING BTREE,
  KEY `email` (`email`) USING BTREE,
  KEY `mobile` (`mobile_validated`) USING BTREE,
  KEY `openid` (`openid`) USING BTREE,
  KEY `unionid` (`unionid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-users_bak 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_users_bak` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_users_bak` ENABLE KEYS */;

-- 导出  表 goldchain.tp-user_address 结构
DROP TABLE IF EXISTS `tp_user_address`;
CREATE TABLE IF NOT EXISTS `tp_user_address` (
  `address_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `consignee` varchar(60) NOT NULL DEFAULT '' COMMENT '收货人',
  `email` varchar(60) NOT NULL DEFAULT '' COMMENT '邮箱地址',
  `country` int(11) NOT NULL DEFAULT '0' COMMENT '国家',
  `province` int(11) NOT NULL DEFAULT '0' COMMENT '省份',
  `city` int(11) NOT NULL DEFAULT '0' COMMENT '城市',
  `district` int(11) NOT NULL DEFAULT '0' COMMENT '地区',
  `twon` int(11) DEFAULT '0' COMMENT '乡镇',
  `address` varchar(250) NOT NULL DEFAULT '' COMMENT '地址',
  `zipcode` varchar(60) NOT NULL DEFAULT '' COMMENT '邮政编码',
  `mobile` varchar(60) NOT NULL DEFAULT '' COMMENT '手机',
  `is_default` tinyint(1) DEFAULT '0' COMMENT '默认收货地址',
  PRIMARY KEY (`address_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-user_address 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_user_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_user_address` ENABLE KEYS */;

-- 导出  表 goldchain.tp-user_distribution 结构
DROP TABLE IF EXISTS `tp_user_distribution`;
CREATE TABLE IF NOT EXISTS `tp_user_distribution` (
  `user_id` int(11) DEFAULT NULL COMMENT '分销会员id',
  `user_name` varchar(50) DEFAULT NULL COMMENT '会员昵称',
  `goods_id` int(11) DEFAULT NULL COMMENT '商品id',
  `goods_name` varchar(150) DEFAULT NULL COMMENT '商品名称',
  `cat_id` smallint(6) DEFAULT '0' COMMENT '商品分类ID',
  `brand_id` mediumint(8) DEFAULT '0' COMMENT '商品品牌',
  `share_num` int(10) DEFAULT '0' COMMENT '分享次数',
  `sales_num` int(11) DEFAULT '0' COMMENT '分销销量',
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `addtime` int(11) DEFAULT NULL COMMENT '加入个人分销库时间',
  `store_id` int(11) NOT NULL COMMENT '商品对应的店铺ID',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `goods_id` (`goods_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='用户选择分销商品表';

-- 正在导出表  goldchain.tp-user_distribution 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_user_distribution` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_user_distribution` ENABLE KEYS */;

-- 导出  表 goldchain.tp-user_level 结构
DROP TABLE IF EXISTS `tp_user_level`;
CREATE TABLE IF NOT EXISTS `tp_user_level` (
  `level_id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `level_name` varchar(30) DEFAULT NULL COMMENT '头衔名称',
  `amount` decimal(10,2) DEFAULT NULL COMMENT '等级必要金额',
  `discount` smallint(4) DEFAULT '0' COMMENT '折扣',
  `describe` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`level_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-user_level 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_user_level` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_user_level` ENABLE KEYS */;

-- 导出  表 goldchain.tp-user_message 结构
DROP TABLE IF EXISTS `tp_user_message`;
CREATE TABLE IF NOT EXISTS `tp_user_message` (
  `rec_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `message_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '消息id',
  `category` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0系统消息，1物流通知，2优惠促销，3商品提醒，4我的资产，5商城好店',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '查看状态：0未查看，1已查看',
  PRIMARY KEY (`rec_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `message_id` (`message_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-user_message 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_user_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_user_message` ENABLE KEYS */;

-- 导出  表 goldchain.tp-user_role 结构
DROP TABLE IF EXISTS `tp_user_role`;
CREATE TABLE IF NOT EXISTS `tp_user_role` (
  `role_id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(30) DEFAULT NULL COMMENT '角色名称',
  `level` tinyint(2) DEFAULT NULL COMMENT '级别(越大级别越高)',
  `describe` varchar(200) NOT NULL COMMENT '描述',
  `grant_list` varchar(200) NOT NULL DEFAULT '' COMMENT '权限列表',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 正在导出表  goldchain.tp-user_role 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_user_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_user_role` ENABLE KEYS */;

-- 导出  表 goldchain.tp-user_store 结构
DROP TABLE IF EXISTS `tp_user_store`;
CREATE TABLE IF NOT EXISTS `tp_user_store` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `store_name` varchar(50) DEFAULT NULL COMMENT '店铺名',
  `true_name` varchar(50) DEFAULT NULL COMMENT '真名',
  `qq` varchar(20) NOT NULL DEFAULT '' COMMENT 'QQ',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '手机号码',
  `store_img` varchar(255) DEFAULT NULL COMMENT '店铺图片',
  `store_time` int(11) NOT NULL DEFAULT '0' COMMENT '开店时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `mobile` (`mobile`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='用户店铺信息表';

-- 正在导出表  goldchain.tp-user_store 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_user_store` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_user_store` ENABLE KEYS */;

-- 导出  表 goldchain.tp-vr_order_code 结构
DROP TABLE IF EXISTS `tp_vr_order_code`;
CREATE TABLE IF NOT EXISTS `tp_vr_order_code` (
  `rec_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '兑换码表索引id',
  `order_id` int(11) NOT NULL COMMENT '虚拟订单id',
  `store_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '店铺ID',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '买家ID',
  `vr_code` varchar(18) NOT NULL DEFAULT '' COMMENT '兑换码',
  `vr_state` tinyint(4) NOT NULL DEFAULT '0' COMMENT '使用状态 0:(默认)未使用1:已使用2:已过期',
  `vr_usetime` int(11) NOT NULL DEFAULT '0' COMMENT '使用时间',
  `pay_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际支付金额(结算)',
  `vr_indate` int(11) NOT NULL DEFAULT '0' COMMENT '过期时间',
  `refund_lock` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '退款锁定状态:0为正常,1为锁定,2为同意,默认为0',
  `vr_invalid_refund` tinyint(4) NOT NULL DEFAULT '1' COMMENT '允许过期退款1是0否',
  PRIMARY KEY (`rec_id`) USING BTREE,
  KEY `order_id` (`order_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='兑换码表';

-- 正在导出表  goldchain.tp-vr_order_code 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_vr_order_code` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_vr_order_code` ENABLE KEYS */;

-- 导出  表 goldchain.tp-web 结构
DROP TABLE IF EXISTS `tp_web`;
CREATE TABLE IF NOT EXISTS `tp_web` (
  `web_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '模块ID',
  `web_name` varchar(20) DEFAULT '' COMMENT '模块名称',
  `style_name` varchar(20) DEFAULT 'orange' COMMENT '风格名称',
  `web_page` varchar(10) DEFAULT 'index' COMMENT '所在页面(暂时只有index)',
  `update_time` int(10) unsigned NOT NULL COMMENT '更新时间',
  `web_sort` tinyint(1) unsigned DEFAULT '9' COMMENT '排序',
  `web_show` tinyint(1) unsigned DEFAULT '1' COMMENT '是否显示，0为否，1为是，默认为1',
  `web_html` text COMMENT '模块html代码',
  PRIMARY KEY (`web_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='页面模块表';

-- 正在导出表  goldchain.tp-web 的数据：0 rows
/*!40000 ALTER TABLE `tp_web` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_web` ENABLE KEYS */;

-- 导出  表 goldchain.tp-web_block 结构
DROP TABLE IF EXISTS `tp_web_block`;
CREATE TABLE IF NOT EXISTS `tp_web_block` (
  `block_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '内容ID',
  `web_id` int(10) unsigned NOT NULL COMMENT '模块ID',
  `block_type` varchar(10) NOT NULL DEFAULT 'array' COMMENT '数据类型:array,html,json',
  `var_name` varchar(20) NOT NULL COMMENT '变量名称',
  `block_info` text COMMENT '内容数据',
  `show_name` varchar(20) DEFAULT '' COMMENT '页面名称',
  PRIMARY KEY (`block_id`) USING BTREE,
  KEY `web_id` (`web_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='模块内容表';

-- 正在导出表  goldchain.tp-web_block 的数据：0 rows
/*!40000 ALTER TABLE `tp_web_block` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_web_block` ENABLE KEYS */;

-- 导出  表 goldchain.tp-web_channel 结构
DROP TABLE IF EXISTS `tp_web_channel`;
CREATE TABLE IF NOT EXISTS `tp_web_channel` (
  `channel_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '频道ID',
  `channel_name` varchar(50) DEFAULT '' COMMENT '频道名称',
  `channel_style` varchar(20) DEFAULT '' COMMENT '颜色风格',
  `gc_id` int(10) unsigned DEFAULT '0' COMMENT '绑定分类ID',
  `gc_name` varchar(50) DEFAULT '' COMMENT '分类名称',
  `keywords` varchar(255) DEFAULT '' COMMENT '关键词',
  `description` varchar(255) DEFAULT '' COMMENT '描述',
  `top_id` int(10) unsigned DEFAULT '0' COMMENT '顶部楼层编号',
  `floor_ids` varchar(100) DEFAULT '' COMMENT '中部楼层编号',
  `update_time` int(10) unsigned NOT NULL COMMENT '更新时间',
  `channel_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '启用状态，0为否，1为是，默认为1',
  PRIMARY KEY (`channel_id`) USING BTREE,
  KEY `gc_id` (`gc_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='商城频道表';

-- 正在导出表  goldchain.tp-web_channel 的数据：0 rows
/*!40000 ALTER TABLE `tp_web_channel` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_web_channel` ENABLE KEYS */;

-- 导出  表 goldchain.tp-web_message 结构
DROP TABLE IF EXISTS `tp_web_message`;
CREATE TABLE IF NOT EXISTS `tp_web_message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '短消息索引id',
  `message_parent_id` int(11) NOT NULL COMMENT '回复短消息message_id',
  `from_member_id` int(11) NOT NULL COMMENT '短消息发送人',
  `to_member_id` varchar(1000) NOT NULL DEFAULT '' COMMENT '短消息接收人',
  `message_title` varchar(50) DEFAULT NULL COMMENT '短消息标题',
  `message_body` varchar(255) NOT NULL DEFAULT '' COMMENT '短消息内容',
  `message_time` varchar(10) NOT NULL DEFAULT '' COMMENT '短消息发送时间',
  `message_update_time` varchar(10) DEFAULT NULL COMMENT '短消息回复更新时间',
  `message_open` tinyint(1) NOT NULL DEFAULT '0' COMMENT '短消息打开状态',
  `message_state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '短消息状态，0为正常状态，1为发送人删除状态，2为接收人删除状态',
  `message_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0为私信、1为系统消息、2为留言',
  `read_member_id` varchar(1000) DEFAULT NULL COMMENT '已经读过该消息的会员id',
  `del_member_id` varchar(1000) DEFAULT NULL COMMENT '已经删除该消息的会员id',
  `message_ismore` tinyint(1) NOT NULL DEFAULT '0' COMMENT '站内信是否为一条发给多个用户 0为否 1为多条 ',
  `from_member_name` varchar(100) DEFAULT NULL COMMENT '发信息人用户名',
  `to_member_name` varchar(100) DEFAULT NULL COMMENT '接收人用户名',
  PRIMARY KEY (`message_id`) USING BTREE,
  KEY `from_member_id` (`from_member_id`) USING BTREE,
  KEY `to_member_id` (`to_member_id`(255)) USING BTREE,
  KEY `message_ismore` (`message_ismore`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='短消息';

-- 正在导出表  goldchain.tp-web_message 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_web_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_web_message` ENABLE KEYS */;

-- 导出  表 goldchain.tp-withdrawals 结构
DROP TABLE IF EXISTS `tp_withdrawals`;
CREATE TABLE IF NOT EXISTS `tp_withdrawals` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '提现申请表',
  `user_id` int(11) DEFAULT '0' COMMENT '用户id',
  `money` decimal(10,2) DEFAULT '0.00' COMMENT '到账金额',
  `create_time` int(11) DEFAULT '0' COMMENT '申请时间',
  `check_time` int(11) DEFAULT '0' COMMENT '审核时间',
  `pay_time` int(11) DEFAULT '0' COMMENT '支付时间',
  `refuse_time` int(11) DEFAULT '0' COMMENT '拒绝时间',
  `bank_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '银行名称 如支付宝 微信 中国银行 农业银行等',
  `bank_card` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '银行账号或支付宝账号',
  `realname` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '提款账号真实姓名',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '提现备注',
  `taxfee` decimal(10,2) DEFAULT '0.00' COMMENT '税收',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态：-2删除作废-1审核失败0申请中1审核通过2付款成功3付款失败',
  `pay_code` varchar(100) DEFAULT NULL COMMENT '付款对账流水号',
  `error_code` varchar(255) DEFAULT NULL COMMENT '付款失败错误代码',
  `fee` decimal(10,2) DEFAULT '0.00' COMMENT '手续费',
  `shen_money` decimal(10,2) DEFAULT '0.00' COMMENT '申请金额',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-withdrawals 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_withdrawals` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_withdrawals` ENABLE KEYS */;

-- 导出  表 goldchain.tp-wx_img 结构
DROP TABLE IF EXISTS `tp_wx_img`;
CREATE TABLE IF NOT EXISTS `tp_wx_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` char(255) NOT NULL,
  `desc` text NOT NULL COMMENT '简介',
  `pic` char(255) NOT NULL COMMENT '封面图片',
  `url` char(255) NOT NULL COMMENT '图文外链地址',
  `createtime` varchar(13) NOT NULL DEFAULT '',
  `uptatetime` varchar(13) NOT NULL DEFAULT '',
  `token` char(30) NOT NULL,
  `title` varchar(60) NOT NULL DEFAULT '',
  `goods_id` int(11) NOT NULL DEFAULT '0',
  `goods_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='微信图文';

-- 正在导出表  goldchain.tp-wx_img 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_wx_img` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_wx_img` ENABLE KEYS */;

-- 导出  表 goldchain.tp-wx_keyword 结构
DROP TABLE IF EXISTS `tp_wx_keyword`;
CREATE TABLE IF NOT EXISTS `tp_wx_keyword` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` char(255) NOT NULL,
  `pid` int(11) NOT NULL COMMENT '对应表ID',
  `token` varchar(60) NOT NULL DEFAULT '',
  `type` varchar(30) DEFAULT 'TEXT' COMMENT '关键词操作类型',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `pid` (`pid`) USING BTREE,
  KEY `token` (`token`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-wx_keyword 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_wx_keyword` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_wx_keyword` ENABLE KEYS */;

-- 导出  表 goldchain.tp-wx_menu 结构
DROP TABLE IF EXISTS `tp_wx_menu`;
CREATE TABLE IF NOT EXISTS `tp_wx_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` tinyint(1) DEFAULT '1' COMMENT '菜单级别',
  `name` varchar(50) NOT NULL DEFAULT '',
  `sort` int(5) DEFAULT '0' COMMENT '排序',
  `type` varchar(20) DEFAULT '' COMMENT '0 view 1 click',
  `value` varchar(255) DEFAULT NULL,
  `token` varchar(50) NOT NULL DEFAULT '',
  `pid` int(11) DEFAULT '0' COMMENT '上级菜单',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-wx_menu 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_wx_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_wx_menu` ENABLE KEYS */;

-- 导出  表 goldchain.tp-wx_news 结构
DROP TABLE IF EXISTS `tp_wx_news`;
CREATE TABLE IF NOT EXISTS `tp_wx_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` char(255) NOT NULL,
  `createtime` varchar(13) NOT NULL DEFAULT '',
  `uptatetime` varchar(13) NOT NULL DEFAULT '',
  `token` char(30) NOT NULL,
  `img_id` varchar(50) DEFAULT NULL COMMENT '图文组合id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='微信图文';

-- 正在导出表  goldchain.tp-wx_news 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_wx_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_wx_news` ENABLE KEYS */;

-- 导出  表 goldchain.tp-wx_text 结构
DROP TABLE IF EXISTS `tp_wx_text`;
CREATE TABLE IF NOT EXISTS `tp_wx_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `uname` varchar(90) NOT NULL DEFAULT '',
  `keyword` char(255) NOT NULL,
  `precisions` tinyint(1) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `createtime` varchar(13) NOT NULL DEFAULT '',
  `updatetime` varchar(13) NOT NULL DEFAULT '',
  `click` int(11) NOT NULL,
  `token` char(30) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='文本回复表';

-- 正在导出表  goldchain.tp-wx_text 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_wx_text` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_wx_text` ENABLE KEYS */;

-- 导出  表 goldchain.tp-wx_user 结构
DROP TABLE IF EXISTS `tp_wx_user`;
CREATE TABLE IF NOT EXISTS `tp_wx_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `uid` int(11) NOT NULL COMMENT 'uid',
  `wxname` varchar(60) NOT NULL DEFAULT '' COMMENT '公众号名称',
  `aeskey` varchar(256) NOT NULL DEFAULT '' COMMENT 'aeskey',
  `encode` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'encode',
  `appid` varchar(50) NOT NULL DEFAULT '' COMMENT 'appid',
  `appsecret` varchar(50) NOT NULL DEFAULT '' COMMENT 'appsecret',
  `wxid` varchar(64) NOT NULL DEFAULT '' COMMENT '公众号原始ID',
  `weixin` char(64) NOT NULL COMMENT '微信号',
  `headerpic` char(255) NOT NULL COMMENT '头像地址',
  `token` char(255) NOT NULL COMMENT 'token',
  `w_token` varchar(150) NOT NULL DEFAULT '' COMMENT '微信对接token',
  `create_time` int(11) NOT NULL COMMENT 'create_time',
  `updatetime` int(11) NOT NULL COMMENT 'updatetime',
  `tplcontentid` varchar(2) NOT NULL DEFAULT '' COMMENT '内容模版ID',
  `share_ticket` varchar(150) NOT NULL DEFAULT '' COMMENT '分享ticket',
  `share_dated` char(15) NOT NULL COMMENT 'share_dated',
  `authorizer_access_token` varchar(200) NOT NULL DEFAULT '' COMMENT 'authorizer_access_token',
  `authorizer_refresh_token` varchar(200) NOT NULL DEFAULT '' COMMENT 'authorizer_refresh_token',
  `authorizer_expires` char(10) NOT NULL COMMENT 'authorizer_expires',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型',
  `web_access_token` varchar(200) DEFAULT '' COMMENT ' 网页授权token',
  `web_refresh_token` varchar(200) DEFAULT '' COMMENT 'web_refresh_token',
  `web_expires` int(11) NOT NULL COMMENT '过期时间',
  `qr` varchar(200) NOT NULL DEFAULT '' COMMENT 'qr',
  `menu_config` text COMMENT '菜单',
  `wait_access` tinyint(1) DEFAULT '0' COMMENT '微信接入状态,0待接入1已接入',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE,
  KEY `uid_2` (`uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='微信公共帐号';

-- 正在导出表  goldchain.tp-wx_user 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_wx_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_wx_user` ENABLE KEYS */;

-- 导出  表 goldchain.tp-ywgoods 结构
DROP TABLE IF EXISTS `tp_ywgoods`;
CREATE TABLE IF NOT EXISTS `tp_ywgoods` (
  `ywgoods_id` int(5) NOT NULL AUTO_INCREMENT,
  `cat_id1` int(5) NOT NULL COMMENT '一级分类',
  `cat_id2` int(5) NOT NULL COMMENT '二级分类',
  `cat_id3` int(5) NOT NULL COMMENT '三级分类',
  `ywgoods_sn` varchar(20) NOT NULL COMMENT '商品编号',
  `ywgoods_name` varchar(20) NOT NULL COMMENT '商品名称',
  `brand_id` int(5) DEFAULT NULL COMMENT '品牌id',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品原价',
  `sale_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品售价',
  `goods_detail` text COMMENT '商品详情',
  `original_img` varchar(255) NOT NULL COMMENT '原始商品图',
  `used_time` varchar(50) NOT NULL COMMENT '已经使用时间',
  `ywgoods_state` int(2) NOT NULL DEFAULT '0' COMMENT '0待审核1审核通过2审核失败',
  `ywgoods_type` varchar(255) NOT NULL COMMENT '商品所属类型',
  `user_id` int(5) NOT NULL COMMENT '商品上传人',
  `mobile` varchar(11) NOT NULL COMMENT '联系人手机号',
  `goods_num` int(8) NOT NULL DEFAULT '0' COMMENT '商品库存',
  `click_count` int(10) DEFAULT '0' COMMENT '点击数',
  `keyword` varchar(255) DEFAULT NULL COMMENT '商品关键字',
  `is_on_sale` int(2) NOT NULL DEFAULT '1' COMMENT '1上架，2下架',
  `on_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '上架时间',
  `is_recommend` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `is_hot` tinyint(1) DEFAULT '0' COMMENT '是否热卖',
  PRIMARY KEY (`ywgoods_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-ywgoods 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_ywgoods` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_ywgoods` ENABLE KEYS */;

-- 导出  表 goldchain.tp-ywgoods_image 结构
DROP TABLE IF EXISTS `tp_ywgoods_image`;
CREATE TABLE IF NOT EXISTS `tp_ywgoods_image` (
  `yimg_id` int(5) NOT NULL AUTO_INCREMENT COMMENT '易物区，商品图片ID',
  `yw_goods_id` int(5) NOT NULL COMMENT '易物区商品ID',
  `yimage_url` mediumint(50) NOT NULL COMMENT '易物区商品图片路由',
  `yimg_sort` int(2) NOT NULL DEFAULT '0' COMMENT '图片排序',
  PRIMARY KEY (`yimg_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- 正在导出表  goldchain.tp-ywgoods_image 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `tp_ywgoods_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `tp_ywgoods_image` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
