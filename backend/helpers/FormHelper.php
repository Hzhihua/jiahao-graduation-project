<?php
/**
 * @Author: cnzhihua
 * @Date: 2018-04-20 12:47
 * @Github: https://github.com/Hzhihua
 */

namespace backend\helpers;

use common\models\Picture;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Author;

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
        }
        $inputId = static::getInputId();
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
                'deleteUrl' => Url::to(['image-delete']),
                'previewFileType' => 'image/*',
                'initialPreview' => isset($fileInfo) ? static::initialPreview($fileInfo) : [],
                'overwriteInitial' => false,
                'initialPreviewAsData' => true,
                'initialPreviewFileType' => 'image',
                'initialCaption' => $model->$attribute,
                'initialPreviewConfig' => isset($fileInfo) ? static::initialPreviewConfig($fileInfo) : [],
                'maxFileSize' => 5120,
            ]
        ], $clientOptions);

        return static::upload($form, $model, $attribute, $clientOptions);
    }

    public static function initialPreview(array $fileInfo)
    {
        $url = sprintf(
            '%s%s/%s.%s',
            dirname($_SERVER['PHP_SELF']).'/img/temp/',
            $fileInfo['new_directory'],
            $fileInfo['new_name'],
            $fileInfo['extension']
        );
        return [$url];
    }

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
        $inputId = static::getInputId();
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
    public static function getInputId()
    {
        static $id = '';
        if (empty($id)) {
            $id = 'input_' . uniqid();
        }
        return $id;
    }

}