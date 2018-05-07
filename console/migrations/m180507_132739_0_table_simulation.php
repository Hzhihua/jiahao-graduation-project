<?php

use hzhihua\dump\Migration;

/**
 * Class m180507_132739_0_table_simulation
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180507_132739_0_table_simulation extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->runSuccess['createTable'] = $this->createTable('{{%simulation}}', [
            'id' => $this->integer(11)->unsigned()->notNull(),
            'category' => $this->smallInteger(4)->unsigned()->notNull()->comment('内容分类(1数电,2模电)'),
            'file_id' => $this->integer(11)->unsigned()->notNull()->comment('文件ID'),
            'author_id' => $this->integer(11)->unsigned()->notNull()->comment('发布人ID'),
            'created_at' => $this->integer(10)->unsigned()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer(10)->unsigned()->notNull()->comment('修改时间'),
        ], $this->tableOptions);

        $this->runSuccess['addTableComment'] = $this->addCommentOnTable('{{%simulation}}', '电子仿真模块表');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        foreach ($this->runSuccess as $keyName => $value) {
            if ('createTable' === $keyName) {
                $this->dropTable('{{%simulation}}');
            } elseif ('addTableComment' === $keyName) {
                $this->dropCommentFromTable('{{%simulation}}');
            } else {
                throw new \yii\db\Exception('only support "dropTable" and "dropCommentFromTable"');
            }
        }
    }
}
