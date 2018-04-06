<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UploadWork */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="upload-work-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'file_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'student_class_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
