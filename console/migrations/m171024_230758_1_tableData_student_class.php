<?php

use hzhihua\dump\Migration;

/**
 * Class m171024_230758_1_tableData_student_class
 * @property yii\db\Transaction $_transaction
 * @Author Hzhihua <cnzhihua@gmail.com>
 */
class m171024_230758_1_tableData_student_class extends Migration
{

	/**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->_transaction = $this->getDb()->beginTransaction();
        $this->batchInsert('{{%student_class}}', 
            ['id', 'class_name', 'created_at', 'updated_at'], 
            [
                ['1', '1402', '123', '123'],
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
