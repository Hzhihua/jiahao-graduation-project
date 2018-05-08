<?php

namespace common\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "{{%question}}".
 *
 * @property int $id
 * @property string $username 提问者名称
 * @property string $question 提问内容
 * @property int $answer_id 回答内容
 * @property int $created_at 创建时间
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%question}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'question'], 'required'],
            [['question'], 'string'],
            [['answer_id', 'created_at'], 'integer'],
            [['username'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            [
                'class' => 'yii\behaviors\TimestampBehavior',
                'updatedAtAttribute' => false,
            ],
        ]);
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $this->username && $this->username = Html::encode($this->username);
        $this->question && $this->question = Html::encode($this->question);
        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'username' => Yii::t('common', 'Username'),
            'question' => Yii::t('common', 'Question'),
            'answer_id' => Yii::t('common', 'Answer ID'),
            'created_at' => Yii::t('common', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswer()
    {
        return static::hasOne('common\models\Answer', ['id' => 'answer_id']);
    }

}
