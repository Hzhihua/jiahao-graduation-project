<?php

namespace common\models;

use PDOException;
use yii\base\Model;
/**
 * This is the model class for table "{{%rolling_map}}".
 *
 * @property int $id
 * @property int $picture_id 图片ID
 * @property string $created_at 创建时间
 * @property string $updated_at 修改时间
 */
class RollingMap extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rolling_map}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['picture_id', 'created_at', 'updated_at'], 'required'],
            [['picture_id'], 'integer'],
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
                'picture_id',
            ],
            'update' => [
                'picture_id',
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
            'picture_id' => '图片ID',
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

        // 判断 picture_id 是否存在
        if (! self::findPictureById($this->picture_id)) {
            throw new PDOException('Picture ID('.$this->picture_id.') could not be found in '.Picture::tableName().' table');
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

        // 判断 picture_id 是否存在
        if (! self::findPictureById($this->picture_id)) {
            throw new PDOException('Picture ID('.$this->picture_id.') could not be found in '.Picture::tableName().' table');
        }

        return $event->isValid;
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
     * 与 picture 表一对一关系
     * @return \yii\db\ActiveQuery
     */
    public function getPicture()
    {
        // id 是 picture 表的 id
        return $this->hasOne(Picture::className(), ['id' => 'picture_id']);
    }
}
