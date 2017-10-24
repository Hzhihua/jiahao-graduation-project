<?php

namespace common\models;

use yii\base\Model;
/**
 * This is the model class for table "{{%author}}".
 *
 * @property int $id
 * @property string $name 名称
 * @property int $created_at 创建时间
 * @property int $updated_at 修改时间
 */
class Author extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%author}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            ],
            'update' => [
                'name',
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
            'name' => '名称',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }
}
