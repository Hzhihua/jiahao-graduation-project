<?php

use hzhihua\dump\Migration;

/**
 * Class m180507_132739_0_table_introduction
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180507_132739_0_table_introduction extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->runSuccess['createTable'] = $this->createTable('{{%introduction}}', [
            'id' => $this->integer(11)->unsigned()->notNull(),
            'title' => $this->string(255)->notNull()->comment('标题'),
            'content' => $this->text()->notNull()->comment('简介文章内容'),
            'author_id' => $this->integer(11)->unsigned()->notNull()->comment('发布人ID'),
            'created_at' => $this->integer(10)->unsigned()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer(10)->unsigned()->notNull()->comment('修改时间'),
        ], $this->tableOptions);

        $this->runSuccess['addTableComment'] = $this->addCommentOnTable('{{%introduction}}', '简介表');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        foreach ($this->runSuccess as $keyName => $value) {
            if ('createTable' === $keyName) {
                $this->dropTable('{{%introduction}}');
            } elseif ('addTableComment' === $keyName) {
                $this->dropCommentFromTable('{{%introduction}}');
            } else {
                throw new \yii\db\Exception('only support "dropTable" and "dropCommentFromTable"');
            }
        }
    }
}
