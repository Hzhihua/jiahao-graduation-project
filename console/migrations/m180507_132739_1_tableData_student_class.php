<?php

use hzhihua\dump\Migration;

/**
 * Class m180507_132739_1_tableData_student_class
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180507_132739_1_tableData_student_class extends Migration
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
                [1, '1402', 123, 123],
                [2, '1403', 1524537979, 1524537979],
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
