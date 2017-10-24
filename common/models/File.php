<?php

namespace common\models;

use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\base\ModelEvent;

/**
 * This is the model class for table "{{%file}}".
 *
 * @property int $id
 * @property string $name 上传文件的名称
 * @property int $size 上传文件的大小(单位：字节)
 * @property string $url 文件url地址
 * @property string $created_at 创建时间
 * @property string $updated_at 修改时间
 */
class File extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%file}}';
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
            'name' => '上传文件的名称',
            'size' => '上传文件的大小',
            'url' => '文件url地址',
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
            throw new Exception('File could not be found at \'' . $file . '\'');
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
            throw new Exception('File could not be found at \'' . $file . '\'');
        }

        return $event->isValid;
    }
}
