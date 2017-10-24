<?php

namespace common\models;

use PDOException;
use yii\base\Model;
/**
 * This is the model class for table "{{%simulation}}".
 *
 * @property int $id
 * @property int $category 内容分类(1数电,2模电)
 * @property int $file_id 文件ID
 * @property string $author_id 发布人
 * @property string $created_at 创建时间
 * @property string $updated_at 修改时间
 */
class Simulation extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%simulation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'file_id', 'author_id', 'created_at', 'updated_at'], 'required'],
            [['category', 'file_id', 'author_id'], 'integer'],
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
                'category',
                'file_id',
                'author_id',
            ],
            'update' => [
                'category',
                'file_id',
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
            'category' => '分类',
            'file_id' => '文件ID',
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

        // 判断 file_id 是否存在
        if (! self::findFileById($this->file_id)) {
            throw new PDOException('File ID('.$this->file_id.') could not be found in '.File::tableName().' table');
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

        // 判断 file_id 是否存在
        if (! self::findFileById($this->file_id)) {
            throw new PDOException('File ID('.$this->file_id.') could not be found in '.File::tableName().' table');
        }

        // 判断 authod_id 是否存在
        if (! self::findAuthorById($this->author_id)) {
            throw new PDOException('Author ID('.$this->author_id.') could not be found in '.Author::tableName().' table');
        }

        return $event->isValid;
    }

    /**
     * 判断 file_id 是否存在
     * @param int $fileId
     * @return File|null
     */
    public static function findFileById($fileId)
    {
        return File::findOne($fileId);
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
     * 与 file 表一对一关系
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        // id 是 file 表的 id
        return $this->hasOne(File::className(), ['id' => 'file_id']);
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
