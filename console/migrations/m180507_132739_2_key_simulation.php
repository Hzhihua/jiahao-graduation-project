<?php

use hzhihua\dump\Migration;

/**
 * Class m180507_132739_2_key_simulation
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180507_132739_2_key_simulation extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->runSuccess['PRIMARY'] = $this->addPrimaryKey(null, '{{%simulation}}', 'id');
        $this->runSuccess['addAutoIncrement'] = $this->addAutoIncrement('{{%simulation}}', 'id', 'integer', 'unsigned', 0);

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
                $this->dropPrimaryKey(null, '{{%simulation}}');
            } elseif (!empty($keyName)) {
                $this->dropIndex("`$keyName`", '{{%simulation}}');
            }
        }

    }
}
