<?php
/**
 * @Author: cnzhihua
 * @Date: 2018-04-23 19:54
 * @Github: https://github.com/Hzhihua
 */

namespace backend\actions;

use Yii;
use yii\base\Action;
use yii\helpers\FileHelper;
use yii\helpers\Json;

class ImageDeleteAction extends Action
{
    /**
     * @var string
     */
    public $directoryRoot = '@backend/web/img/temp';

    public function run($name)
    {
        $directory = Yii::getAlias($this->directoryRoot) . DIRECTORY_SEPARATOR . Yii::$app->session->id;
        if (is_file($directory . DIRECTORY_SEPARATOR . $name)) {
            unlink($directory . DIRECTORY_SEPARATOR . $name);
        }

        $files = FileHelper::findFiles($directory);
        $output = [];
        foreach ($files as $file) {
            $fileName = basename($file);
            $path = '/img/temp/' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
            $output['files'][] = [
                'name' => $fileName,
                'size' => filesize($file),
                'url' => $path,
                'thumbnailUrl' => $path,
                'deleteUrl' => 'image-delete?name=' . $fileName,
                'deleteType' => 'POST',
            ];
        }
        return Json::encode($output);
    }
}