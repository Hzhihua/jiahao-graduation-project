<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%video}}".
 *
 * @property int $id
 * @property string $title 视频标题
 * @property string $url 视频地址
 * @property string $iframe iframe代码
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class Video extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%video}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'iframe'], 'string'],
            [['created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'title' => Yii::t('common', 'Title'),
            'url' => Yii::t('common', 'Url'),
            'iframe' => Yii::t('common', 'Iframe'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }
}
