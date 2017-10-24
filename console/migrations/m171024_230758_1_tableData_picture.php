<?php

use hzhihua\dump\Migration;

/**
 * Class m171024_230758_1_tableData_picture
 * @property yii\db\Transaction $_transaction
 * @Author Hzhihua <cnzhihua@gmail.com>
 */
class m171024_230758_1_tableData_picture extends Migration
{

	/**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->_transaction = $this->getDb()->beginTransaction();
        $this->batchInsert('{{%picture}}', 
            ['id', 'url', 'created_at', 'updated_at'], 
            [
                ['1', 'i/f12.jpg', '123', '123'],
                ['2', 'i/f12.jpg', '123', '123'],
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
