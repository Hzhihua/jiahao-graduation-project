<?php

namespace common\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "{{%answer}}".
 *
 * @property int $id
 * @property string $answer_name 回答者名称
 * @property string $answer 回答内容
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%answer}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['answer_name', 'answer'], 'required'],
            [['answer'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['answer_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'yii\behaviors\TimestampBehavior',
        ]);
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $this->answer && $this->answer = Html::encode($this->answer);
        $this->answer_name && $this->answer_name = Html::encode($this->answer_name);
        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'answer_name' => Yii::t('common', 'Answer Name'),
            'answer' => Yii::t('common', 'Answer'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

}
