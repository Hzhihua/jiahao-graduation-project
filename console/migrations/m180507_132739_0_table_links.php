<?php

use hzhihua\dump\Migration;

/**
 * Class m180507_132739_0_table_links
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180507_132739_0_table_links extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->runSuccess['createTable'] = $this->createTable('{{%links}}', [
            'id' => $this->integer(11)->unsigned()->notNull(),
            'name' => $this->string(255)->notNull()->comment('友情链接名称'),
            'url' => $this->string(255)->notNull()->comment('友情链接url地址'),
            'created_at' => $this->integer(10)->unsigned()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer(10)->unsigned()->notNull()->comment('修改时间'),
        ], $this->tableOptions);

        $this->runSuccess['addTableComment'] = $this->addCommentOnTable('{{%links}}', '友情链接表');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        foreach ($this->runSuccess as $keyName => $value) {
            if ('createTable' === $keyName) {
                $this->dropTable('{{%links}}');
            } elseif ('addTableComment' === $keyName) {
                $this->dropCommentFromTable('{{%links}}');
            } else {
                throw new \yii\db\Exception('only support "dropTable" and "dropCommentFromTable"');
            }
        }
    }
}
