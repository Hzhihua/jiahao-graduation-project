<?php

use hzhihua\dump\Migration;

/**
 * Class m171024_230758_1_tableData_rolling_map
 * @property yii\db\Transaction $_transaction
 * @Author Hzhihua <cnzhihua@gmail.com>
 */
class m171024_230758_1_tableData_rolling_map extends Migration
{

	/**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->_transaction = $this->getDb()->beginTransaction();
        $this->batchInsert('{{%rolling_map}}', 
            ['id', 'picture_id', 'created_at', 'updated_at'], 
            [
                ['1', '1', '123', '123'],
                ['2', '2', '123', '123'],
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
