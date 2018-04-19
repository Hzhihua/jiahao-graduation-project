<?php

namespace common\models;

use Yii;
use yii\base\Model;
/**
 * This is the model class for table "{{%links}}".
 *
 * @property int $id
 * @property string $name 友情链接名称
 * @property string $url 友情链接url地址
 * @property string $created_at 创建时间
 * @property string $updated_at 修改时间
 */
class Links extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%links}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return array_merge(Model::scenarios(), [
            'insert' => [
                'name',
                'url',
            ],
            'update' => [
                'name',
                'url',
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
            'name' => Yii::t('common', 'Name'),
            'url' => Yii::t('common', 'Url'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }
}
