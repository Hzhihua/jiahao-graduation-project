<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\helpers\FormHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Announcement */
/* @var $form yii\widgets\ActiveForm */

//\backend\actions\UploadAsset::register($this);
?>

<div class="announcement-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= FormHelper::authorSelectize($form, $model, 'author_id') ?>

    <?= FormHelper::ImageUpload($form, $model, 'picture_id') ?>

    <?= FormHelper::FileUpload($form, $model, 'file_id') ?>

<!--    --><?//= \backend\actions\UploadWidget::widget([])?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $this->render('_ckeditor', [
        'form' => $form,
        'model' => $model,
        'attribute' => 'content',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
