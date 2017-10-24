<?php

use hzhihua\dump\Migration;

/**
 * Class m171024_230758_0_table_file
 * @property yii\db\Transaction $_transaction
 * @Author Hzhihua <cnzhihua@gmail.com>
 */
class m171024_230758_0_table_file extends Migration
{

	/**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->runSuccess['createTable'] = $this->createTable('{{%file}}', [
            'id' => $this->integer()->unsigned(),
            'name' => $this->string(255)->notNull()->comment('上传文件的名称'),
            'size' => $this->integer(11)->unsigned()->notNull()->comment('上传文件的大小(单位：字节)'),
            'url' => $this->string(255)->notNull()->comment('文件url地址(ltrim(/))'),
            'created_at' => $this->integer(10)->unsigned()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer(10)->unsigned()->notNull()->comment('修改时间'),
        ], $this->tableOptions);

        $this->runSuccess['addTableComment'] = $this->addCommentOnTable('{{%file}}', '上传文件表');

    }

	/**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        foreach ($this->runSuccess as $keyName => $value) {
            if ('createTable' === $keyName) {
                $this->dropTable('{{%file}}');
            } elseif ('addTableComment' === $keyName) {
                $this->dropCommentFromTable('{{%file}}');
            } else {
                throw new \yii\db\Exception('some errors in:' . __FILE__);
            }
        }
    }
}
