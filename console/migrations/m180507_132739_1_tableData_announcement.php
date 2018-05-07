<?php

use hzhihua\dump\Migration;

/**
 * Class m180507_132739_1_tableData_announcement
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180507_132739_1_tableData_announcement extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->_transaction = $this->getDb()->beginTransaction();
        $this->batchInsert('{{%announcement}}', 
            ['id', 'title', 'author_id', 'picture_id', 'description', 'content', 'created_at', 'updated_at'],
            [
                [1, '世间所有的相遇，都是久别重逢。', 1, 1, '你可以选择在原处不停地跟周遭不解的人解释你为何这么做，让他们理解你，你可以选择什么都不讲，自顾自往前走。 ', '你可以选择在原处不停地跟周遭不解的人解释你为何这么做，让他们理解你，你可以选择什么都不讲，自顾自往前走。 ', 1508764616, 1508764616],
                [2, '陌上花开，可缓缓归矣。', 1, 2, '那时候刚好下着雨，柏油路面湿冷冷的，还闪烁着青、黄、红颜色的灯火。我们就在骑楼下躲雨，看绿色的邮筒孤独地站在街的对面。', '那时候刚好下着雨，柏油路面湿冷冷的，还闪烁着青、黄、红颜色的灯火。我们就在骑楼下躲雨，看绿色的邮筒孤独地站在街的对面。', 123, 123],
                [3, 'new titile', 1, 34, '123', '123', 1525588856, 1525588856],
            ]
        );
        $this->_transaction->commit();

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        $this->_transaction->rollBack();

    }
}
