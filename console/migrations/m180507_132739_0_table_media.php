<?php

use hzhihua\dump\Migration;

/**
 * Class m180507_132739_0_table_media
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180507_132739_0_table_media extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->runSuccess['createTable'] = $this->createTable('{{%media}}', [
            'id' => $this->integer(11)->notNull(),
            'picture_url' => $this->string(255)->notNull()->comment('封面图url'),
            'new_name' => $this->string(255)->notNull()->comment('视频名称'),
            'origin_name' => $this->string(255)->notNull()->comment('视频原始名称'),
            'new_directory' => $this->string(255)->notNull()->comment('新目录(a/b/c)'),
            'extension' => $this->string(20)->notNull()->comment('拓展名'),
            'type' => $this->string(50)->notNull()->comment('MIME type'),
            'size' => $this->integer(11)->notNull()->comment('文件大小'),
            'file_key' => $this->string(255)->notNull()->comment('文件key参数'),
            'created_at' => $this->integer(11)->notNull()->comment('创建时间'),
        ], $this->tableOptions);

        $this->runSuccess['addTableComment'] = $this->addCommentOnTable('{{%media}}', '媒体表');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        foreach ($this->runSuccess as $keyName => $value) {
            if ('createTable' === $keyName) {
                $this->dropTable('{{%media}}');
            } elseif ('addTableComment' === $keyName) {
                $this->dropCommentFromTable('{{%media}}');
            } else {
                throw new \yii\db\Exception('only support "dropTable" and "dropCommentFromTable"');
            }
        }
    }
}
