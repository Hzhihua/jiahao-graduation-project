<?php

namespace common\models;

use PDOException;
use yii\base\Model;
/**
 * This is the model class for table "{{%introduction}}".
 *
 * @property int $id
 * @property string $title 标题
 * @property string $content 简介文章内容
 * @property string $author_id 发布人
 * @property string $created_at 创建时间
 * @property string $updated_at 修改时间
 */
class Introduction extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%introduction}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'author_id', 'created_at', 'updated_at'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['content'], 'string', 'max' => 65535],
            [['author_id'], 'integer'],
            [['created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return array_merge(Model::scenarios(), [
            'insert' => [
                'content',
                'author_id',
            ],
            'update' => [
                'content',
                'author_id',
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '简介文章内容',
            'author_id' => '发布人',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }

    /**
     * 在数据添加之前调用
     * @param \yii\base\ModelEvent $event
     * @return bool
     */
    public function beforeInsert($event)
    {
        if (! parent::beforeInsert($event)) {
            return $event->isValid = false;
        }

        // 判断 authod_id 是否存在
        if (! self::findAuthorById($this->author_id)) {
            throw new PDOException('Author ID('.$this->author_id.') could not be found in '.Author::tableName().' table');
        }

        return $event->isValid;
    }

    /**
     * 在数据修改之前调用
     * @param \yii\base\ModelEvent $event
     * @return bool
     */
    public function beforeUpdate($event)
    {
        if (! parent::beforeUpdate($event)) {
            return $event->isValid = false;
        }

        // 判断 authod_id 是否存在
        if (! self::findAuthorById($this->author_id)) {
            throw new PDOException('Author ID('.$this->author_id.') could not be found in '.Author::tableName().' table');
        }

        return $event->isValid;
    }

    /**
     * 判断 authod_id 是否存在
     * @param int $authod_id
     * @return Author|null
     */
    public static function findAuthorById($authod_id)
    {
        return Author::findOne($authod_id);
    }

    /**
     * 与 author 表一对一关系
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        // id 是 author 表的 id
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }
}
