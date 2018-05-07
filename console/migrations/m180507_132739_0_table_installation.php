<?php

use hzhihua\dump\Migration;

/**
 * Class m180507_132739_0_table_installation
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180507_132739_0_table_installation extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->runSuccess['createTable'] = $this->createTable('{{%installation}}', [
            'id' => $this->integer(11)->unsigned()->notNull(),
            'title' => $this->string(255)->notNull()->comment('标题'),
            'content' => $this->text()->notNull()->comment('安装指南文章内容'),
            'author_id' => $this->integer(11)->unsigned()->notNull()->comment('发布人ID'),
            'created_at' => $this->integer(10)->unsigned()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer(10)->unsigned()->notNull()->comment('修改时间'),
        ], $this->tableOptions);

        $this->runSuccess['addTableComment'] = $this->addCommentOnTable('{{%installation}}', '安装指南表');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        foreach ($this->runSuccess as $keyName => $value) {
            if ('createTable' === $keyName) {
                $this->dropTable('{{%installation}}');
            } elseif ('addTableComment' === $keyName) {
                $this->dropCommentFromTable('{{%installation}}');
            } else {
                throw new \yii\db\Exception('only support "dropTable" and "dropCommentFromTable"');
            }
        }
    }
}
