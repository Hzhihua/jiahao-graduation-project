<?php
/**
 * @Author: cnzhihua
 * @Date: 2018-04-20 12:47
 * @Github: https://github.com/Hzhihua
 */

namespace backend\helpers;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
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
     * 默认是单一图片上传
     *
     * 多图片上传
     * ```php
     * 'clientOptions' => [
     *     'pick' => [
     *         'multiple' => true,
     *     ],
     * ],
     * ```
     * @param ActiveForm $form
     * @param $model
     * @param string $attribute
     * @param array $clientOptions
     * @return string
     * @see https://github.com/bailangzhan/yii2-webuploader
     * @see http://www.manks.top/document/yii2-webuploader.html
     */
    public static function ImageUpload(ActiveForm $form, $model, $attribute, array $clientOptions = [])
    {
        // default options
        $defaultOptions = [
            'clientOptions' => [
                'pick' => [
                    'multiple' => false,
                ],
                'server' => Url::to(['image-upload']),
                'accept' => [
                    'extensions' => ['jpeg', 'jpg', 'png'],
                ],
            ],
        ];

        $clientOptions = array_merge($defaultOptions, $clientOptions);

        return $form->field($model, $attribute)->widget('manks\FileInput', $clientOptions);
    }

}