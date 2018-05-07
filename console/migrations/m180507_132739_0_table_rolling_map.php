<?php

use hzhihua\dump\Migration;

/**
 * Class m180507_132739_0_table_rolling_map
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180507_132739_0_table_rolling_map extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->runSuccess['createTable'] = $this->createTable('{{%rolling_map}}', [
            'id' => $this->integer(11)->unsigned()->notNull(),
            'picture_id' => $this->integer(10)->unsigned()->notNull()->comment('图片ID'),
            'created_at' => $this->integer(10)->unsigned()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer(10)->unsigned()->notNull()->comment('修改时间'),
        ], $this->tableOptions);

        $this->runSuccess['addTableComment'] = $this->addCommentOnTable('{{%rolling_map}}', '主页轮播图');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        foreach ($this->runSuccess as $keyName => $value) {
            if ('createTable' === $keyName) {
                $this->dropTable('{{%rolling_map}}');
            } elseif ('addTableComment' === $keyName) {
                $this->dropCommentFromTable('{{%rolling_map}}');
            } else {
                throw new \yii\db\Exception('only support "dropTable" and "dropCommentFromTable"');
            }
        }
    }
}
