<?php

use hzhihua\dump\Migration;

/**
 * Class m171024_230758_1_tableData_links
 * @property yii\db\Transaction $_transaction
 * @Author Hzhihua <cnzhihua@gmail.com>
 */
class m171024_230758_1_tableData_links extends Migration
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
                ['1', 'baidu', 'https://www.baidu.com', '123', '123'],
                ['2', 'google', 'https://www.google.com', '123', '123'],
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
