<?php

use hzhihua\dump\Migration;

/**
 * Class m180507_132739_2_key_rolling_map
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180507_132739_2_key_rolling_map extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->runSuccess['PRIMARY'] = $this->addPrimaryKey(null, '{{%rolling_map}}', 'id');
        $this->runSuccess['addAutoIncrement'] = $this->addAutoIncrement('{{%rolling_map}}', 'id', 'integer', 'unsigned', 8);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        foreach ($this->runSuccess as $keyName => $value) {
            if ('addAutoIncrement' === $keyName) {
                continue;
            } elseif ('PRIMARY' === $keyName) {
                // must be remove auto_increment before drop primary key
                if (isset($this->runSuccess['addAutoIncrement'])) {
                    $value = $this->runSuccess['addAutoIncrement'];
                    $this->dropAutoIncrement("{$value['table_name']}", $value['column_name'], $value['column_type'], $value['property']);
                }
                $this->dropPrimaryKey(null, '{{%rolling_map}}');
            } elseif (!empty($keyName)) {
                $this->dropIndex("`$keyName`", '{{%rolling_map}}');
            }
        }

    }
}
