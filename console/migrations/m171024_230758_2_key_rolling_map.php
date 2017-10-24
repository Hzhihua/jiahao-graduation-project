<?php

use hzhihua\dump\Migration;

/**
 * Class m171024_230758_2_key_rolling_map
 * @property yii\db\Transaction $_transaction
 * @Author Hzhihua <cnzhihua@gmail.com>
 */
class m171024_230758_2_key_rolling_map extends Migration
{

	/**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->runSuccess['PRIMARY'] = $this->addPrimaryKey(null, '{{%rolling_map}}', 'id');

    }

	/**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        foreach ($this->runSuccess as $keyName => $value) {
            if ('PRIMARY' === $keyName) {
                $this->dropPrimaryKey(null, '{{%rolling_map}}');
            } else {
                $this->dropIndex($keyName, '{{%rolling_map}}');
            }
        }

    }
}
