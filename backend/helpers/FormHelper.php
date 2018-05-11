<?php
/**
 * @Author: cnzhihua
 * @Date: 2018-04-20 12:47
 * @Github: https://github.com/Hzhihua
 */

namespace backend\helpers;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Author;
use common\models\Picture;

class FormHelper
{
    /**
     * @param ActiveForm $form
     * @param $model
     * @param string $attribute
     * @param array $data
     * @param array $clientOptions
     * @return string
     */
    public static function selectize(ActiveForm $form, $model, $attribute, array $data, array $clientOptions = [])
    {
        return $form->field($model, $attribute)->widget('dosamigos\selectize\SelectizeDropDownList', [
            'name' => $attribute,
            'items' => $data,
            'clientOptions' => $clientOptions,
        ]);
    }

    /**
     * @param ActiveForm $form
     * @param $model
     * @param string $attribute
     * @param array $db_select
     * @param array $clientOptions
     * @return string
     */
    public static function authorSelectize(ActiveForm $form, $model, $attribute, array $db_select = [], array $clientOptions = [])
    {
        empty($db_select) && $db_select = ['id', 'name'];
        $authod = Author::find()->select($db_select)->asArray()->all();
        $authod_select = ArrayHelper::map($authod, 'id', 'name');

        return static::selectize($form, $model, $attribute, $authod_select, $clientOptions);
    }

    /**
     * @param ActiveForm $form
     * @param $model
     * @param string $attribute
     * @param string $editor
     * @param array $clientOptions
     * @return string
     */
    public static function editor(ActiveForm $form, $model, $attribute, $editor = 'ckeditor' , array $clientOptions = [])
    {
        return static::$editor($form, $model, $attribute, $clientOptions);
    }

    /**
     * ckeditor编辑器
     * @param ActiveForm $form
     * @param $model
     * @param string $attribute
     * @param array $clientOptions
     * @return string
     */
    public static function ckeditor(ActiveForm $form, $model, $attribute, array $clientOptions = [])
    {
        isset($clientOptions['options']) || $clientOptions['options'] = ['rows' => 6];
        /* @see \dosamigos\ckeditor\CKEditorTrait */
        isset($clientOptions['preset']) || $clientOptions['preset'] = 'full';
        $model->$attribute = Html::decode($model->$attribute);
        return $form->field($model, $attribute)->widget('dosamigos\ckeditor\CKEditor', $clientOptions);
    }

    /**
     * 处理ajax上传并返回JSON响应的服务器代码。
     * 服务器方法必须返回一个包含`initialPreview`、`initialPreviewConfig`和`append`的JSON对象。
     *
     * @param ActiveForm $form
     * @param ActiveRecord $model
     * @param string $attribute
     * @param array $clientOptions
     * @return string
     * @throws \Exception
     * @see http://demos.krajee.com/widget-details/fileinput#advanced-usage
     * @see https://github.com/kartik-v/bootstrap-fileinput/wiki/10.-%E4%BA%8B%E4%BB%B6
     * @see https://github.com/kartik-v/bootstrap-fileinput/wiki/12.-%E4%B8%80%E4%BA%9B%E6%A0%B7%E4%BE%8B%E4%BB%A3%E7%A0%81
     */
    public static function ImageUpload(ActiveForm $form, $model, $attribute, array $clientOptions = [])
    {
        $fileKey = Yii::$app->request->post($attribute);
        if ($fileKey) {
            $fileInfo = Picture::getInfoByFileKey($fileKey);
        } elseif ($model->id) {
            $fileInfo = Picture::find()->where(['id' => $model->picture_id])->asArray()->one();
        }
        $inputId = static::getInputId($attribute);
        $alertMsg = 'Are you sure you want to delete this file?';
        $clientOptions = ArrayHelper::merge([
            'name' => 'picture',
            'options'=>[
                'multiple' => false,
                'accept' => 'image/*',
            ],
            'pluginEvents' => [
                'filepredelete' => 'function (jqXHR) {var abort = true;if (confirm("'.$alertMsg.'")) {abort = false;}return abort;}',
                'fileuploaded' => 'function (event, data) {var key = data.response.file_key;$("#'.$inputId.'").val(key)}'
            ],
            'pluginOptions' => [
                'browseOnZoneClick' => true, // 点击打开文件选择
                'uploadAsync' => true, // ajax异步上传
                'uploadUrl' => Url::to(['image-upload']), // 上传URL
//                'deleteUrl' => Url::to(['image-delete']),
                'previewFileType' => 'image/*',
                'initialPreview' => isset($fileInfo) ? static::initialPreview($fileInfo) : [],
                'overwriteInitial' => false,
                'initialPreviewAsData' => true,
                'initialPreviewFileType' => 'image',
                'initialCaption' => $model->$attribute,
                'initialPreviewConfig' => isset($fileInfo) ? static::initialPreviewConfig($fileInfo) : [],
                'maxFileSize' => 512000,
            ]
        ], $clientOptions);

        return static::upload($form, $model, $attribute, $clientOptions);
    }

    /**
     * 媒体资源上传
     * @param ActiveForm $form
     * @param $model
     * @param $attribute
     * @param array $clientOptions
     * @return string
     * @throws \Exception
     */
    public static function FileUpload(ActiveForm $form, $model, $attribute, array $clientOptions = [])
    {
        $inputId = static::getInputId($attribute);
        $alertMsg = 'Are you sure you want to delete this file?';
        $clientOptions = ArrayHelper::merge([
            'name' => 'file',
            'options'=>[
                'multiple' => false,
                'accept' => 'all',
            ],
            'pluginEvents' => [
                'filepredelete' => 'function (jqXHR) {var abort = true;if (confirm("'.$alertMsg.'")) {abort = false;}return abort;}',
                 'fileuploaded' => 'function (event, data) {var key = data.response.file_key;$("#'.$inputId.'").val(key)}'
            ],

            'pluginOptions' => [
                'browseOnZoneClick' => true, // 点击打开文件选择
                'uploadAsync' => true, // ajax异步上传
                'uploadUrl' => Url::to(['file-upload']), // 上传URL
                'deleteUrl' => Url::to(['file-delete']),
//                'previewFileType' => 'image',
                'initialPreview' => [],
                'overwriteInitial' => false,
                'initialPreviewAsData' => true,
                'initialPreviewFileType' => 'image',
                'initialCaption' => $model->$attribute,
                'preferIconicPreview' => true, // 这将强制缩略图按照以下文件扩展名的图标显示
                'initialPreviewConfig' => [],
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
                'previewFileExtSettings' => [ // 配置确定图标文件扩展名的逻辑代码
                    'doc' => new JsExpression('function(ext) {return ext.match(/(doc|docx)$/i);}'),
                    'xls' => new JsExpression('function(ext) {return ext.match(/(xls|xlsx)$/i);}'),
                    'ppt' => new JsExpression('function(ext) {return ext.match(/(ppt|pptx)$/i);}'),
                    'zip' => new JsExpression('function(ext) {return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);}'),
                    'htm' => new JsExpression('function(ext) {return ext.match(/(htm|html)$/i);}'),
                    'txt' => new JsExpression('function(ext) {return ext.match(/(txt|ini|csv|java|php|js|css)$/i);}'),
                    'mov' => new JsExpression('function(ext) {return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);}'),
                    'mp3' => new JsExpression('function(ext) {return ext.match(/(mp3|wav)$/i);}'),
                ],
                'maxFileSize' => 0,
            ]
        ], $clientOptions);
//        return \kartik\file\FileInput::widget($clientOptions);
        return static::upload($form, $model, $attribute, $clientOptions);
    }

    /**
     * @param array $fileInfo
     * @return array
     */
    public static function initialPreview(array $fileInfo)
    {
        $url = sprintf(
            '%s%s/%s.%s',
            rtrim(Yii::$app->params['baseUrl'], '/') . '/',
            $fileInfo['new_directory'],
            $fileInfo['new_name'],
            $fileInfo['extension']
        );
        return [$url];
    }

    /**
     * @param array $fileInfo
     * @return array
     */
    public static function initialPreviewConfig(array $fileInfo)
    {
        return [
            [
                'size' => $fileInfo['size'],
                'caption' => $fileInfo['origin_name'],
                'url' => Url::to(['image-delete', 'file_key' => '123']),
                'downloadUrl' => Url::to(['image-download', 'file_key' => '123']),
            ],
        ];
    }


    /**
     * @param ActiveForm $form
     * @param ActiveRecord $model
     * @param string $attribute
     * @param array $clientOptions
     * @return string
     * @throws \Exception
     */
    public static function upload(ActiveForm $form, $model, $attribute, array $clientOptions = [])
    {
        $inputId = static::getInputId($attribute);
        $fileKey = Yii::$app->request->post($attribute);
        $attributeLabels = $model->attributeLabels();
        $html = '<label class="control-label">'. $attributeLabels[$attribute] .'</label>';
        $html .= "<input id='{$inputId}' type='hidden' name='{$attribute}' value='{$fileKey}' />";
        $html .= \kartik\file\FileInput::widget($clientOptions);

        return $html;
    }

    /**
     * @return string input id
     */
    public static function getInputId($prefix = '')
    {
        static $id = [];
        if (!isset($id[$prefix])) {
            $id[$prefix] = $prefix . '_input_' . uniqid();
        }
        return $id[$prefix];
    }

}