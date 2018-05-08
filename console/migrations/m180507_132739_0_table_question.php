<?php

use hzhihua\dump\Migration;

/**
 * Class m180507_132739_0_table_question
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180507_132739_0_table_question extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->runSuccess['createTable'] = $this->createTable('{{%question}}', [
            'id' => $this->integer(11)->notNull(),
            'username' => $this->string(255)->notNull()->comment('提问者名称'),
            'question' => $this->text()->notNull()->comment('提问内容'),
            'answer_id' => $this->integer(11)->null()->comment('回答内容'),
            'created_at' => $this->integer(11)->notNull()->comment('创建时间'),
        ], $this->tableOptions);

        $this->runSuccess['addTableComment'] = $this->addCommentOnTable('{{%question}}', '咨询问题表');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        foreach ($this->runSuccess as $keyName => $value) {
            if ('createTable' === $keyName) {
                $this->dropTable('{{%question}}');
            } elseif ('addTableComment' === $keyName) {
                $this->dropCommentFromTable('{{%question}}');
            } else {
                throw new \yii\db\Exception('only support "dropTable" and "dropCommentFromTable"');
            }
        }
    }
}
