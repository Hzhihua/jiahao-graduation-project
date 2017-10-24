<?php

use hzhihua\dump\Migration;

/**
 * Class m171024_230758_1_tableData_simulation
 * @property yii\db\Transaction $_transaction
 * @Author Hzhihua <cnzhihua@gmail.com>
 */
class m171024_230758_1_tableData_simulation extends Migration
{

	/**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->_transaction = $this->getDb()->beginTransaction();
        $this->batchInsert('{{%simulation}}', 
            ['id', 'category', 'file_id', 'author_id', 'created_at', 'updated_at'], 
            [
                ['1', '1', '25', '1', '123', '123'],
                ['2', '1', '26', '1', '123', '123'],
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
