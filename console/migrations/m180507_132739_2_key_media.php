<?php

use hzhihua\dump\Migration;

/**
 * Class m180507_132739_2_key_media
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180507_132739_2_key_media extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->runSuccess['PRIMARY'] = $this->addPrimaryKey(null, '{{%media}}', 'id');
        $this->runSuccess['addAutoIncrement'] = $this->addAutoIncrement('{{%media}}', 'id', 'integer', 'unsigned', 6);
        $this->runSuccess['file_key'] = $this->createIndex('file_key', '{{%media}}', 'file_key', 1);

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
                $this->dropPrimaryKey(null, '{{%media}}');
            } elseif (!empty($keyName)) {
                $this->dropIndex("`$keyName`", '{{%media}}');
            }
        }

    }
}
