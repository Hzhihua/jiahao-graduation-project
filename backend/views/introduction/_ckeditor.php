<?php
/**
 * @Author: cnzhihua
 * @Date: 2018-05-10 23:03
 * @Github: https://github.com/Hzhihua
 */
/* @var $this \yii\web\View */
/* @var $attribute string */
/* @see https://packagist.org/packages/2amigos/yii2-ckeditor-widget */

use yii\helpers\Url;
use yii\helpers\Html;

//$this->registerJs("CKEDITOR.plugins.addExternal('image2', '/gp/backend/web/ckeditor_plugins/image2/plugin.js', '');");
?>

<?php $model->$attribute = Html::decode($model->$attribute) ?>
<?= $form->field($model, $attribute)->widget('dosamigos\ckeditor\CKEditor', [
//    'options' => ['rows' => 6],
    'preset' => 'custom', /* @see \dosamigos\ckeditor\CKEditorTrait */
    'clientOptions' => [
//        'extraPlugins' => 'uploadimage',
        'filebrowserUploadUrl' => Url::to(['ckeditor-image-upload']),
        'filebrowserBrowseUrl' => rtrim(Yii::$app->params['baseUrl'], '/') . '/',
    ],
]) ?>