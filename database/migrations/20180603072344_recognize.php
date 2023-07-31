<?php

use think\migration\Migrator;
use think\migration\db\Column;
use SebastianBergmann\GlobalState\CodeExporter;

class Recognize extends Migrator
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
        $this->table('recognize')
            ->addColumn(Column::string('plan_no', 50)->setDefault('')->setComment('认筹计划编号'))
            ->addColumn(Column::string('title', 50)->setDefault('')->setComment('认筹计划标题'))
            ->addColumn(Column::decimal('price', 10, 2)->setDefault(0)->setComment('单价'))
            ->addColumn(Column::decimal('total_qty', 10, 2)->setDefault(0)->setComment('本次计划发行数量'))
            ->addColumn(Column::decimal('limit_qty', 10, 2)->setDefault(0)->setComment('每人限购数量,0为不限制'))
            ->addColumn(Column::decimal('sold_qty', 10, 2)->setDefault(0)->setComment('已售出数量'))
            ->addColumn(Column::decimal('remain_qty', 10, 2)->setDefault(0)->setComment('剩余数量'))
            ->addColumn(Column::text('content', 10, 2)->setDefault('')->setComment('活动内容及介绍'))
            ->addColumn(Column::tinyInteger('status')->setDefault(0)->setComment('状态[0.未开启1.已开启2.已结束3.已取消]'))
            ->addColumn(Column::integer('create_time')->setNullable()->setComment('创建时间'))
            ->addColumn(Column::integer('start_time')->setNullable()->setComment('开始时间'))
            ->addColumn(Column::integer('end_time')->setNullable()->setComment('结束时间'))
            ->addColumn(Column::integer('complete_time')->setNullable()->setComment('完成时间'))
            ->create();
    }
}
