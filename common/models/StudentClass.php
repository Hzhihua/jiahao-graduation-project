<?php

namespace common\models;

use yii\base\Model;
/**
 * This is the model class for table "{{%student_class}}".
 *
 * @property int $id
 * @property string $class_name 班级名称
 * @property string $created_at 创建时间
 * @property string $updated_at 修改时间
 */
class StudentClass extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%student_class}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_name', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['class_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return array_merge(Model::scenarios(), [
            'insert' => [
                'class_name',
            ],
            'update' => [
                'class_name',
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
            'class_name' => '班级名称',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }
}
