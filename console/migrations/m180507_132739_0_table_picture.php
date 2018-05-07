<?php

use hzhihua\dump\Migration;

/**
 * Class m180507_132739_0_table_picture
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180507_132739_0_table_picture extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->runSuccess['createTable'] = $this->createTable('{{%picture}}', [
            'id' => $this->integer(11)->unsigned()->notNull(),
            'file_key' => $this->string(255)->notNull()->comment('文件key'),
            'new_name' => $this->string(255)->notNull()->comment('新文件名称'),
            'origin_name' => $this->string(255)->notNull()->comment('原始名称'),
            'size' => $this->integer(11)->notNull()->comment('大小'),
            'extension' => $this->string(10)->notNull()->comment('文件类型'),
            'type' => $this->string(20)->notNull()->comment('文件MIME type'),
            'new_directory' => $this->string(255)->notNull()->comment('新目录,05/05/2018'),
            'created_at' => $this->integer(10)->unsigned()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer(10)->unsigned()->notNull()->comment('修改时间'),
        ], $this->tableOptions);

        $this->runSuccess['addTableComment'] = $this->addCommentOnTable('{{%picture}}', '图片表');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        foreach ($this->runSuccess as $keyName => $value) {
            if ('createTable' === $keyName) {
                $this->dropTable('{{%picture}}');
            } elseif ('addTableComment' === $keyName) {
                $this->dropCommentFromTable('{{%picture}}');
            } else {
                throw new \yii\db\Exception('only support "dropTable" and "dropCommentFromTable"');
            }
        }
    }
}
