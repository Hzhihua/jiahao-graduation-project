<?php

use hzhihua\dump\Migration;

/**
 * Class m180507_132739_1_tableData_file
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180507_132739_1_tableData_file extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->_transaction = $this->getDb()->beginTransaction();
        $this->batchInsert('{{%file}}', 
            ['id', 'name', 'size', 'url', 'created_at', 'updated_at'],
            [
                [1, '查重.doc', 227328, '20180424/665a3abd55c0eb9242ae61187b48cd7b.doc', 1524580647, 1524580647],
                [23, 'file.png', 0, '/date/file.png', 1508777151, 1508777151],
                [24, '1508778241420', 0, '20171024/d6c9615406c8aa61281a822c105eca1d.pdf', 1508778273, 1508778273],
                [25, 'CentOS Nginx PHP JAVA多语言镜像使用手册V1.6.pdf', 0, '20171024/a4150ea0e7e0e1b5b010a49c299908d5.pdf', 1508778573, 1508778573],
                [26, 'CentOS Nginx PHP JAVA多语言镜像使用手册V1.6.pdf', 0, '20171024/22d678be7a9d7a7c93aeba10534258f0.pdf', 1508778728, 1508778728],
                [27, 'CentOS Nginx PHP JAVA多语言镜像使用手册V1.6.pdf', 0, '20171024/b0319756f1b74c1e00fa6bfe56dfcfbd.pdf', 1508852465, 1508852465],
                [28, 'CentOS Nginx PHP JAVA多语言镜像使用手册V1.6.pdf', 0, '20171024/cdb5266d5819ca54354be6704a220b17.pdf', 1508852476, 1508852476],
                [34, '查重.doc', 227328, '20180424/20c8cf27a6d521affeee64697b2ab864.doc', 1524581264, 1524581264],
            ]
        );
        $this->_transaction->commit();

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        $this->_transaction->rollBack();

    }
}
