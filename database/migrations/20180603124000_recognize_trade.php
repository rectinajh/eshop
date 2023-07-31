<?php

use think\migration\Migrator;
use think\migration\db\Column;

class RecognizeTrade extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->table('recognize_trade')
            ->addColumn(Column::string('trade_no', 50)->setDefault('')->setComment('交易号'))
            ->addColumn(Column::integer('recognize_id', 50)->setDefault(0)->setComment('认筹计划id'))
            ->addColumn(Column::integer('user_id', 50)->setDefault(0)->setComment('用户id'))
            ->addColumn(Column::decimal('buy_qty', 10, 2)->setDefault(0)->setComment('购买数量'))
            ->addColumn(Column::decimal('hold_qty', 10, 2)->setDefault(0)->setComment('占有数量'))
            ->addColumn(Column::decimal('money', 10, 2)->setDefault(0)->setComment('应付金额'))
            ->addColumn(Column::tinyInteger('status')->setDefault(0)->setComment('状态[0.未完成1.已完成2.已取消]'))
            ->addColumn(Column::tinyInteger('pay_status')->setDefault(0)->setComment('支付状态[0.未支付1.成功2.失败]'))
            ->addColumn(Column::tinyInteger('pay_type')->setDefault(0)->setComment('支付方式[0.无1.余额 2.微信 3.支付宝]'))
            ->addColumn(Column::decimal('pay_money', 10, 2)->setDefault(0)->setComment('支付金额'))
            ->addColumn(Column::string('transaction_id')->setDefault('')->setComment('支付凭证号'))
            ->addColumn(Column::integer('create_time')->setNullable()->setComment('创建时间'))
            ->addColumn(Column::integer('pay_time')->setNullable()->setComment('支付时间'))
            ->addColumn(Column::integer('complete_time')->setNullable()->setComment('完成时间'))
            ->create();
    }
}
