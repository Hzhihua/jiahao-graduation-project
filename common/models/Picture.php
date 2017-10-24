<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\base\Exception;
use yii\base\ModelEvent;
/**
 * This is the model class for table "{{%picture}}".
 *
 * @property int $id
 * @property string $url 原图url地址
 * @property string $created_at 创建时间
 * @property string $updated_at 修改时间
 */
class Picture extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%picture}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return array_merge(Model::scenarios(), [
            'insert' => [
                'url',
            ],
            'update' => [
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
            'url' => '原图url地址',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }

    /**
     * 在添加数据之前调用
     * @param ModelEvent $event
     * @return bool
     * @throws Exception
     */
    public function beforeInsert($event)
    {
        if (! parent::beforeInsert($event)) {
            return $event->isValid = false;
        }

        $params = Yii::$app->params;
        $params['uploadFileRoot'] = rtrim($params['uploadFileRoot'], '/');
        $file = $params['uploadFileRoot'] . DIRECTORY_SEPARATOR . $this->url;
        if (! is_file($file)) {
            throw new Exception('File could not be found at \''.$file.'\'');
        }

        return $event->isValid;
    }

    /**
     * 在添加数据之前调用
     * @param ModelEvent $event
     * @return bool
     * @throws Exception
     */
    public function beforeUpdate($event)
    {
        if (! parent::beforeUpdate($event)) {
            return $event->isValid = false;
        }

        $params = Yii::$app->params;
        $params['uploadFileRoot'] = rtrim($params['uploadFileRoot'], '/');
        $file = $params['uploadFileRoot'] . DIRECTORY_SEPARATOR . $this->url;
        if (! is_file($file)) {
            throw new Exception('File could not be found at \''.$file.'\'');
        }

        return $event->isValid;
    }
}
