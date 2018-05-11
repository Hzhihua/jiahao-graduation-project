<?php

namespace common\models;

use Yii;
use yii\base\Exception;
use yii\web\JsExpression;
use yii\helpers\FileHelper;
use hzhihua\actions\Event;
use hzhihua\actions\UploadedFile;

/**
 * This is the model class for table "{{%media}}".
 *
 * @property int $id
 * @property int $picture_url 封面图url
 * @property string $new_name 视频名称
 * @property string $origin_name 视频原始名称
 * @property string $new_directory 新目录(a/b/c)
 * @property string $extension 拓展名
 * @property string $type MIME type
 * @property int $size 文件大小
 * @property string $file_key 文件key参数
 * @property int $created_at 创建时间
 */
class Media extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%media}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['picture_url', 'new_name', 'origin_name', 'new_directory', 'extension', 'type', 'size', 'file_key'], 'required'],
            [['size', 'created_at'], 'integer'],
            [['picture_url', 'new_name', 'origin_name', 'new_directory', 'file_key'], 'string', 'max' => 255],
            [['extension'], 'string', 'max' => 20],
            [['type'], 'string', 'max' => 50],
        ];
    }

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
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'picture_url' => Yii::t('common', 'Picture Url'),
            'new_name' => Yii::t('common', 'New Name'),
            'origin_name' => Yii::t('common', 'Origin Name'),
            'new_directory' => Yii::t('common', 'New Directory'),
            'extension' => Yii::t('common', 'Extension'),
            'type' => Yii::t('common', 'Type'),
            'size' => Yii::t('common', 'Size'),
            'file_key' => Yii::t('common', 'File Key'),
            'created_at' => Yii::t('common', 'Created At'),
        ];
    }

    /**
     * @param $ffmpeg
     * @param $input
     * @param $output
     * @param integer $position
     * @param int $forceReplace
     * @return bool|string
     */
    public static function generateMediaPicture($ffmpeg, $input, $output, $position = 5, $forceReplace = 1)
    {
        $replace = $forceReplace ? '-y' : '';
        return system("{$ffmpeg} -ss {$position} -i {$input} -r 1 -vframes 1 -an -vcodec mjpeg {$replace} {$output}");
    }

    /**
     * @param Event $event
     * @throws Exception
     * @throws \Throwable
     */
    public function afterMediaUpload(Event $event)
    {
        $uploadFile = sprintf(
            '%s%s/%s.%s',
            $event->sender->uploadDirectory,
            trim($event->sender->newDirectory, '/'),
            $event->sender->newName,
            $event->file->extension
        );
        $picturePath = sprintf(
            '%s/%s/%s/',
            date('y'),
            date('m'),
            date('d')
        );
        $picturePathAs = Yii::getAlias("@source/{$picturePath}");
        $picture = md5(uniqid()) . '.jpg';
        if (!is_dir($picturePathAs)) {
            FileHelper::createDirectory($picturePathAs);
        }
        if (false === static::generateMediaPicture('ffmpeg', $uploadFile, "{$picturePathAs}{$picture}")) {
            throw new Exception('视频封面生成失败');
        }
        $this->picture_url = "{$picturePath}{$picture}";
        $this->size = $event->file->size;
        $this->type = $event->file->type;
        $this->extension = $event->file->extension;
        $this->origin_name = $event->file->baseName;
        $this->file_key = $event->sender->fileKey;
        $this->new_name = $event->sender->newName;
        $this->new_directory = $event->sender->newDirectory;

//        $event->sender->initialPreview = [
//            Yii::$app->params['baseUrl'] . $event->sender->newDirectory . '/' . $event->sender->newName . '.' . $event->file->extension,
//        ];
        $event->sender->setResponseBody([
            'initialPreviewConfig' => [
                'type' => 'video',
                'fileType' => $event->file->type,
                'filename' => $event->file->name,
                'caption' => $event->file->baseName,
                'size' => $event->file->size,
                'downloadUrl' => $event->sender->getDownloadUrl(), // download url
                'url' => $event->sender->getDeleteUrl(), // delete url
            ],
            'previewFileIconSettings' => [ // 配置你的文件扩展名对应的图标
                    'doc' => '<i class="fa fa-file-word-o text-primary"></i>',
                    'xls' => '<i class="fa fa-file-excel-o text-success"></i>',
                    'ppt' => '<i class="fa fa-file-powerpoint-o text-danger"></i>',
                    'pdf' => '<i class="fa fa-file-pdf-o text-danger"></i>',
                    'zip' => '<i class="fa fa-file-archive-o text-muted"></i>',
                    'htm' => '<i class="fa fa-file-code-o text-info"></i>',
                    'txt' => '<i class="fa fa-file-text-o text-info"></i>',
                    'mov' => '<i class="fa fa-file-movie-o text-warning"></i>',
                    'mp3' => '<i class="fa fa-file-audio-o text-warning"></i>',
                    // 以下这些文件类型的注释未配置扩展名确定逻辑（键值本身会被用作扩展名）
                    // has been configured (the keys itself will be used as extensions)
                    'jpg' => '<i class="fa fa-file-photo-o text-danger"></i>',
                    'gif' => '<i class="fa fa-file-photo-o text-muted"></i>',
                    'png' => '<i class="fa fa-file-photo-o text-primary"></i>'
            ],
        ]);

        $event->isValid = static::validate() && static::insert();

    }

    /**
     * @param Event $event
     */
    public function beforeMediaDownload(Event $event)
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
     */
    public function beforeMediaDelete(Event $event)
    {
        $this->beforeMediaDownload($event);
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

}
