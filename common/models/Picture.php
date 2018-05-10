<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\base\Exception;
use yii\base\ModelEvent;
use hzhihua\actions\Event;
use hzhihua\actions\UploadedFile;

/**
 * This is the model class for table "{{%picture}}".
 *
 * @property int $id
 * @property string $file_key 文件key
 * @property string $new_name 新文件名称
 * @property string $origin_name 原始名称
 * @property int $size 大小
 * @property string $extension 文件类型
 * @property string $type 文件MIME type
 * @property string $new_directory 新目录,05/05/2018
 * @property int $created_at 创建时间
 * @property int $updated_at 修改时间
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
            [['file_key', 'new_name', 'origin_name', 'size', 'extension', 'type', 'new_directory'], 'required'],
            [['size', 'created_at', 'updated_at'], 'integer'],
            [['file_key', 'new_name', 'origin_name', 'new_directory'], 'string', 'max' => 255],
            [['extension'], 'string', 'max' => 10],
            [['type'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return array_merge(Model::scenarios(), [
            'insert' => [
                'file_key',
                'new_name',
                'size',
                'extension',
                'type',
                'origin_name',
            ],
            'update' => [
                'file_key',
                'new_name',
                'size',
                'extension',
                'type',
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
            'id' => Yii::t('common', 'ID'),
            'file_key' => Yii::t('common', 'File Key'),
            'new_name' => Yii::t('common', 'New Name'),
            'origin_name' => Yii::t('common', 'Origin Name'),
            'size' => Yii::t('common', 'Size'),
            'extension' => Yii::t('common', 'Extension'),
            'type' => Yii::t('common', 'Type'),
            'new_directory' => Yii::t('common', 'New Directory'),
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
//    public function beforeInsert($event)
//    {
//        if (! parent::beforeInsert($event)) {
//            return $event->isValid = false;
//        }
//
//        $params = Yii::$app->params;
//        $params['imageUploadSuccessPath'] = rtrim($params['imageUploadSuccessPath'], '/');
//        $picture = $params['imageUploadSuccessPath'] . DIRECTORY_SEPARATOR . $this->url;
//        if (! is_file($picture)) {
//            throw new Exception('Picture could not be found at \''.$picture.'\'');
//        }
//
//        return $event->isValid;
//    }

    /**
     * 在添加数据之前调用
     * @param ModelEvent $event
     * @return bool
     * @throws Exception
     */
//    public function beforeUpdate($event)
//    {
//        if (! parent::beforeUpdate($event)) {
//            return $event->isValid = false;
//        }
//
//        $params = Yii::$app->params;
//        $params['imageUploadSuccessPath'] = rtrim($params['imageUploadSuccessPath'], '/');
//        $picture = $params['imageUploadSuccessPath'] . DIRECTORY_SEPARATOR . $this->url;
//        if (! is_file($picture)) {
//            throw new Exception('Picture could not be found at \''.$picture.'\'');
//        }
//
//        return $event->isValid;
//    }

    /**
     * @param $key
     * @return array
     */
    public static function getInfoByFileKey($key)
    {
        return static::find()->where(['file_key' => $key])->asArray()->one();
    }

    /**
     * @param $key
     * @return int
     */
    public static function getIdByFileKey($key)
    {
        $data = static::find()->select('id')->where(['file_key' => $key])->asArray()->one();
        return (int) $data['id'];
    }

    /**
     * @param int $id
     * @return string
     */
    public static function getFileKeyById($id)
    {
        $data = static::find()->select('file_key')->where(['id' => (int) $id])->asArray()->one();
        return $data['file_key'];
    }

    /**
     * @param Event $event
     */
    public function beforeImageUpload(Event $event)
    {
//        $event->sender->newName = 'new_file_name';
//        $event->sender->newDirectory = '/a/b/c/';
    }

    /**
     * @param Event $event
     * @throws \Throwable
     */
    public function afterImageUpload(Event $event)
    {
        /* @var {$event->sender} \hzhihua\actions\FileUploadAction */
        $this->file_key = $event->fileKey;
        $this->type = $event->file->type;
        $this->size = $event->file->size;
        $this->extension = $event->file->extension;
        $this->origin_name = $event->file->baseName;

        $this->new_name = $event->sender->newName;
        $this->new_directory = $event->sender->newDirectory;

        $event->isValid = $this->validate() && $this->insert();
    }

    /**
     * @param Event $event
     * @throws \Throwable
     */
    public function afterImageUploadCKeditor(Event $event)
    {
        $this->afterImageUpload($event);
        /**
         * @see https://docs.ckeditor.com/ckeditor4/latest/guide/dev_file_upload.html
         */
        $event->sender->setResponseBody([
            'uploaded' => 1,
            'fileName' => $event->file->baseName,
            'url' => sprintf(
                '%s/%s/%s.%s',
                rtrim(Yii::$app->params['baseUrl'], '/'),
                rtrim($event->sender->newDirectory, '/'),
                $event->sender->newName,
                $event->file->extension
            ),
//            'error' => [
//                'message' => ''
//            ]
        ]);
    }

    /**
     * @param Event $event
     */
    public function beforeImageDelete(Event $event)
    {
        $data = static::find()->where(['file_key' => $event->fileKey])->asArray()->one();

        if ($data) {
            $file = new UploadedFile();
            $file->type = $data['type'];
            $file->size = (int) $data['size'];
            $file->extension = $data['extension'];
            $file->baseName = $data['origin_name'];
            $file->name = $data['origin_name'] . '.' . $data['extension'];

            $event->sender->newName = $data['new_name'];
            $event->sender->newDirectory = $data['new_directory'];
            $event->file = $file;
        } else {
            $event->isValid = false;
        }
    }

    /**
     * @param Event $event
     * @throws \yii\db\Exception
     */
    public function afterImageDelete(Event $event)
    {
        $rst = Yii::$app->db->createCommand()
            ->delete(static::tableName(), ['file_key' => $event->fileKey])
            ->execute();
        $event->isValid = boolval($rst);
    }

    /**
     * @param Event $event
     */
    public function beforeImageDownload(Event $event)
    {
        $this->beforeImageDelete($event);
    }
}
