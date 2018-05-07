<?php
/**
 * @Author: cnzhihua
 * @Date: 2018-04-27 09:41
 * @Github: https://github.com/Hzhihua
 */

namespace common\components;

use common\models\Picture;
use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * 文件上传处理
 */
class Upload extends Model
{
    public $file;
    private $_appendRules;

    public function init ()
    {
        parent::init();
        $extensions = Yii::$app->params['webuploader']['baseConfig']['accept']['extensions'];
        $this->_appendRules = [
            [['file'], 'file', 'extensions' => $extensions],
        ];
    }

    public function rules()
    {
        $baseRules = [];
        return array_merge($baseRules, $this->_appendRules);
    }

    /**
     * @return array
     */
    public function upImage ()
    {
        $model = new static;
        $model->file = UploadedFile::getInstanceByName('file');
        if (!$model->file) {
            return [
                'code' => 1,
                'msg' => 'upload file failed',
            ];
        }
        if ($model->validate()) {
            $relativePath = Yii::$app->params['imageUploadRelativePath'];
            $successPath = Yii::$app->params['imageUploadSuccessPath'];
            $fileName = md5($model->file->name) . '.' . $model->file->extension;

            if (!is_dir($relativePath)) {
                try {
                    FileHelper::createDirectory($relativePath);
                } catch (Exception $e) {
                    return [
                        'code' => 1,
                        'msg' => $e->getMessage(),
                    ];
                }
            }

            try {
                $model->file->saveAs($relativePath . $fileName);
                $id = $this->savePicture2DB($model->file);

                return [
                    'code' => 0,
                    'url' => Yii::$app->params['domain'] . $successPath . $fileName,
                    'attachment' => $id,
//                    'attachment' => $successPath . $fileName,

                ];
            } catch (Exception $e) {
                return [
                    'code' => 1,
                    'msg' => $e->getMessage(),
                ];
            }

        } else {
            $errors = $model->errors;
            return [
                'code' => 1,
                'msg' => current($errors)[0]
            ];
        }
    }

    /**
     * @param UploadedFile $file
     * @return bool
     * @throws Exception
     */
    public function savePicture2DB(UploadedFile $file)
    {
        $model = new Picture();
        $model->origin_name = $file->name;
        $model->url = md5($file->name) . '.' . $file->extension;

        if ($model->validate() && $model->save()) {
            return Yii::$app->db->getLastInsertID();
        } else {
            throw new Exception('could not save picture');
        }

    }
}