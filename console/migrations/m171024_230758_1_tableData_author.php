<?php

use hzhihua\dump\Migration;

/**
 * Class m171024_230758_1_tableData_author
 * @property yii\db\Transaction $_transaction
 * @Author Hzhihua <cnzhihua@gmail.com>
 */
class m171024_230758_1_tableData_author extends Migration
{

	/**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->_transaction = $this->getDb()->beginTransaction();
        $this->batchInsert('{{%author}}', 
            ['id', 'name', 'created_at', 'updated_at'], 
            [
                ['1', 'haha', '333', '333'],
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
