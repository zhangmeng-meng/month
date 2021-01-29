<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Article extends Migrator
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
        // create the table
        $table = $this->table('articles',array('engine'=>'MyISAM'));
        $table->addColumn('title', 'string',array('limit' => 20,'comment'=>'文章标题'))
            ->addColumn('look', 'integer',array('limit' => 11,'comment'=>'文章浏览数'))
            ->addColumn('img', 'string',array('limit' => 255,'comment'=>"文章图片"))
            ->create();
    }
}
