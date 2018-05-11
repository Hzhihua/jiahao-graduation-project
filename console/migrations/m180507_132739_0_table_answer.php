<?php

use hzhihua\dump\Migration;

/**
 * Class m180507_132739_0_table_answer
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180507_132739_0_table_answer extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->runSuccess['createTable'] = $this->createTable('{{%answer}}', [
            'id' => $this->integer(11)->unsigned()->notNull(),
            'answer_name' => $this->string(255)->notNull()->comment('回答者名称'),
            'answer' => $this->text()->notNull()->comment('回答内容'),
            'created_at' => $this->integer(11)->notNull()->comment('创建时间'),
            'updated_at' => $this->integer(11)->notNull()->comment('更新时间'),
        ], $this->tableOptions);

        $this->runSuccess['addTableComment'] = $this->addCommentOnTable('{{%answer}}', '回答咨询表');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        foreach ($this->runSuccess as $keyName => $value) {
            if ('createTable' === $keyName) {
                $this->dropTable('{{%answer}}');
            } elseif ('addTableComment' === $keyName) {
                $this->dropCommentFromTable('{{%answer}}');
            } else {
                throw new \yii\db\Exception('only support "dropTable" and "dropCommentFromTable"');
            }
        }
    }
}
