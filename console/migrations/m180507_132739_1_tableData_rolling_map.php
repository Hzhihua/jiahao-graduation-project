<?php

use hzhihua\dump\Migration;

/**
 * Class m180507_132739_1_tableData_rolling_map
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180507_132739_1_tableData_rolling_map extends Migration
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
                [1, 35, 1525591246, 1525591246],
                [2, 36, 1525591755, 1525591755],
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
