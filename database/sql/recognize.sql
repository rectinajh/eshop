CREATE TABLE `tp_recognize` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`plan_no` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '认筹计划编号',
	`title` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '认筹计划标题',
	`price` DECIMAL(10,2) NOT NULL DEFAULT '0.00' COMMENT '单价',
	`total_qty` DECIMAL(10,2) NOT NULL DEFAULT '0.00' COMMENT '本次计划发行数量',
	`limit_qty` DECIMAL(10,2) NOT NULL DEFAULT '0.00' COMMENT '每人限购数量,0为不限制',
	`sold_qty` DECIMAL(10,2) NOT NULL DEFAULT '0.00' COMMENT '已售出数量',
	`remain_qty` DECIMAL(10,2) NOT NULL DEFAULT '0.00' COMMENT '剩余数量',
	`content` TEXT NOT NULL COMMENT '活动内容及介绍',
	`status` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '状态[0.未开启1.已开启2.已结束3.已取消]',
	`create_time` INT(11) NULL DEFAULT NULL COMMENT '创建时间',
	`start_time` INT(11) NULL DEFAULT NULL COMMENT '开始时间',
	`end_time` INT(11) NULL DEFAULT NULL COMMENT '结束时间',
	`complete_time` INT(11) NULL DEFAULT NULL COMMENT '完成时间',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE `tp_recognize_trade` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`trade_no` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '交易号',
	`recognize_id` INT(11) NOT NULL DEFAULT '0' COMMENT '认筹计划id',
	`user_id` INT(11) NOT NULL DEFAULT '0' COMMENT '用户id',
	`buy_qty` DECIMAL(10,2) NOT NULL DEFAULT '0.00' COMMENT '购买数量',
	`hold_qty` DECIMAL(10,2) NOT NULL DEFAULT '0.00' COMMENT '占有数量',
	`money` DECIMAL(10,2) NOT NULL DEFAULT '0.00' COMMENT '应付金额',
	`status` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '状态[0.未完成1.已完成2.已取消]',
	`pay_status` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '支付状态[0.未支付1.成功2.失败]',
	`pay_type` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '支付方式[0.无1.余额 2.微信 3.支付宝]',
	`pay_money` DECIMAL(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
	`transaction_id` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '支付凭证号',
	`create_time` INT(11) NULL DEFAULT NULL COMMENT '创建时间',
	`pay_time` INT(11) NULL DEFAULT NULL COMMENT '支付时间',
	`complete_time` INT(11) NULL DEFAULT NULL COMMENT '完成时间',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci' ENGINE=InnoDB;
