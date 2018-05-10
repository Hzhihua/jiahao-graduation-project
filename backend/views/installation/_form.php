<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\helpers\FormHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Installation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="installation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $this->render('_ckeditor', [
        'form' => $form,
        'model' => $model,
        'attribute' => 'content',
    ]) ?>

    <?= FormHelper::authorSelectize($form, $model, 'author_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
