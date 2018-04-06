<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Simulation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="simulation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category')->textInput() ?>

    <?= $form->field($model, 'file_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
