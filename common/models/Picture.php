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
 * @property string $origin_name 图片名称
 * @property string $url 原图url地址(ltrim(/))
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
            [['origin_name', 'url', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['origin_name', 'url'], 'string', 'max' => 255],
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
                'origin_name',
            ],
            'update' => [
                'url',
                'origin_name',
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
            'url' => Yii::t('common', 'Url'),
            'origin_name' => Yii::t('common', 'Origin Name'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
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
        $params['uploadPictureRoot'] = rtrim($params['uploadPictureRoot'], '/');
        $picture = $this->url ? $this->url : $params['uploadPictureRoot'];
        $picture = $params['uploadPictureRoot'] . DIRECTORY_SEPARATOR . $picture;
        if (! is_file($picture)) {
            throw new Exception('Picture could not be found at \''.$picture.'\'');
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
        $params['uploadPictureRoot'] = rtrim($params['uploadPictureRoot'], '/');
        $picture = $this->url ? $this->url : $params['uploadPictureRoot'];
        $picture = $params['uploadPictureRoot'] . DIRECTORY_SEPARATOR . $picture;
        if (! is_file($picture)) {
            throw new Exception('Picture could not be found at \''.$picture.'\'');
        }

        return $event->isValid;
    }
}
