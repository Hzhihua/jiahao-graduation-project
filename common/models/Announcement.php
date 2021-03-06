<?php

namespace common\models;

use Yii;
use yii\base\Model;
use PDOException;

/**
 * This is the model class for table "{{%announcement}}".
 *
 * @property int $id
 * @property string $title 公告标题
 * @property string $author_id 发布人
 * @property int $picture_id 公告预览图
 * @property string $description 公告简介
 * @property string $content 公告内容
 * @property string $created_at 创建时间
 * @property string $updated_at 修改时间
 */
class Announcement extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%announcement}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
        return [
            [['title', 'author_id', 'picture_id', 'description', 'content'], 'required'],
            [['content'], 'string', 'max' => 65535],
            [['picture_id', 'author_id', 'file_id'], 'integer'],
            [['created_at', 'updated_at'], 'integer'],
            [['title', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return array_merge(Model::scenarios(), [
            'insert' => [
                'title',
                'author_id',
                'picture_id',
                'file_id',
                'description',
                'content',
            ],
            'update' => [
                'title',
                'author_id',
                'picture_id',
                'file_id',
                'description',
                'content',
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
            'title' => Yii::t('common', 'Title'),
            'author_id' => Yii::t('common', 'Author'),
            // 'picture_id' => Yii::t('common', 'Picture'),
            'picture_id' => '预览图',
            // 'description' => Yii::t('common', 'Description'),
            'file_id' => '附件',
            'description' => '动态简介',
            'content' => Yii::t('common', 'Content'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    /**
     * 在数据添加之前调用
     * @param \yii\base\ModelEvent $event
     * @return bool
     */
    public function beforeInsert($event)
    {
//        if (! parent::beforeInsert($event)) {
//            return $event->isValid = false;
//        }
//
//        // 判断 picture_id 是否存在
//        if (! self::findPictureById($this->picture_id)) {
//            throw new PDOException('Picture ID('.$this->picture_id.') could not be found in ' . Picture::tableName() . ' table');
//        }
//
//        // 判断 authod_id 是否存在
//        if (! self::findAuthorById($this->author_id)) {
//            throw new PDOException('Author ID('.$this->author_id.') could not be found in ' . Author::tableName() . ' table');
//        }
//
//        return $event->isValid;
    }

    /**
     * 在数据修改之前调用
     * @param \yii\base\ModelEvent $event
     * @return bool
     */
    public function beforeUpdate($event)
    {
//        if (! parent::beforeUpdate($event)) {
//            return $event->isValid = false;
//        }
//
//        // 判断 picture_id 是否存在
//        if (! self::findPictureById($this->picture_id)) {
//            throw new PDOException('Picture ID('.$this->picture_id.') could not be found in ' . Picture::tableName() . ' table');
//        }
//
//        // 判断 authod_id 是否存在
//        if (! self::findAuthorById($this->author_id)) {
//            throw new PDOException('Author ID('.$this->author_id.') could not be found in ' . Author::tableName() . ' table');
//        }
//
//        return $event->isValid;
    }

    /**
     * 判断 picture_id 是否存在
     * @param int $pictureId
     * @return Picture|null
     */
    public static function findPictureById($pictureId)
    {
        return Picture::findOne($pictureId);
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
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }

    /**
     * 与 picture 表一对一关系
     * @return \yii\db\ActiveQuery
     */
    public function getPicture()
    {
        // id 是 picture 表的 id
        return $this->hasOne(Picture::class, ['id' => 'picture_id']);
    }

    /**
     * 与 file 表一对一关系
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        // id 是 picture 表的 id
        return $this->hasOne(File::class, ['id' => 'file_id']);
    }

}
