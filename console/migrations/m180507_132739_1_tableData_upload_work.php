<?php

use hzhihua\dump\Migration;

/**
 * Class m180507_132739_1_tableData_upload_work
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180507_132739_1_tableData_upload_work extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->_transaction = $this->getDb()->beginTransaction();
        $this->batchInsert('{{%upload_work}}', 
            ['id', 'file_id', 'student_name', 'student_class_id', 'created_at', 'updated_at'],
            [
                [1, 23, '张三', 1, 1508777151, 1508777151],
                [2, 24, '123', 1, 1508778273, 1508778273],
                [3, 25, '12', 1, 1508778573, 1508778573],
                [4, 26, '黄志华', 1, 1508778728, 1508778728],
                [5, 27, '1234', 1, 1508852465, 1508852465],
                [6, 28, '123', 1, 1508852476, 1508852476],
                [7, 34, '斯蒂芬', 1, 1524581264, 1524581264],
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
