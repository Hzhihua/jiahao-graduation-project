<?php

use hzhihua\dump\Migration;

/**
 * Class m180507_132739_0_table_announcement
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180507_132739_0_table_announcement extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->runSuccess['createTable'] = $this->createTable('{{%announcement}}', [
            'id' => $this->integer(11)->unsigned()->notNull(),
            'title' => $this->string(255)->notNull()->comment('公告标题'),
            'author_id' => $this->integer(11)->unsigned()->notNull()->comment('发布人ID'),
            'picture_id' => $this->integer(10)->unsigned()->notNull()->comment('公告预览图'),
            'description' => $this->string(255)->notNull()->comment('公告简介'),
            'content' => $this->text()->notNull()->comment('公告内容'),
            'created_at' => $this->integer(10)->unsigned()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer(10)->unsigned()->notNull()->comment('修改时间'),
        ], $this->tableOptions);

        $this->runSuccess['addTableComment'] = $this->addCommentOnTable('{{%announcement}}', '公告表');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        foreach ($this->runSuccess as $keyName => $value) {
            if ('createTable' === $keyName) {
                $this->dropTable('{{%announcement}}');
            } elseif ('addTableComment' === $keyName) {
                $this->dropCommentFromTable('{{%announcement}}');
            } else {
                throw new \yii\db\Exception('only support "dropTable" and "dropCommentFromTable"');
            }
        }
    }
}
