<?php

use hzhihua\dump\Migration;

/**
 * Class m180507_132739_0_table_upload_work
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180507_132739_0_table_upload_work extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->runSuccess['createTable'] = $this->createTable('{{%upload_work}}', [
            'id' => $this->integer(11)->unsigned()->notNull(),
            'file_id' => $this->integer(11)->unsigned()->notNull()->comment('上传文件ID'),
            'student_name' => $this->string(255)->notNull()->comment('学生名称'),
            'student_class_id' => $this->integer(11)->notNull()->comment('学生班级ID'),
            'created_at' => $this->integer(10)->unsigned()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer(10)->unsigned()->notNull()->comment('修改时间'),
        ], $this->tableOptions);

        $this->runSuccess['addTableComment'] = $this->addCommentOnTable('{{%upload_work}}', '学生作业上传表');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        foreach ($this->runSuccess as $keyName => $value) {
            if ('createTable' === $keyName) {
                $this->dropTable('{{%upload_work}}');
            } elseif ('addTableComment' === $keyName) {
                $this->dropCommentFromTable('{{%upload_work}}');
            } else {
                throw new \yii\db\Exception('only support "dropTable" and "dropCommentFromTable"');
            }
        }
    }
}
