<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RollingMap */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rolling-map-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'picture_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
