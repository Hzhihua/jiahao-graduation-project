<?php

use hzhihua\dump\Migration;

/**
 * Class m180507_132739_1_tableData_links
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180507_132739_1_tableData_links extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->_transaction = $this->getDb()->beginTransaction();
        $this->batchInsert('{{%links}}', 
            ['id', 'name', 'url', 'created_at', 'updated_at'],
            [
                [3, 'proteus官网', 'https://www.labcenter.com/', 1524748738, 1524748738],
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
