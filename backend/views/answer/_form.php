<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Answer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="answer-form">

    <?php $form = ActiveForm::begin(); ?>

    咨询人：<input class="form-control" type="text" disabled value="<?= Html::encode($data['username']) ?>" />
    咨询内容：
    <textarea class="form-control" rows="6" disabled><?= Html::encode($data['question']) ?></textarea>
    <hr>
    <?= $form->field($model, 'answer_name')->textInput(['maxLength' => true, 'value' => Html::encode($data['answer']['answer_name']) ?: '管理员']) ?>
    <?= $form->field($model, 'answer')->textarea(['rows' => 6, 'value' => Html::encode($data['answer']['answer']) ?: '']) ?>

    <?// $form->field($model, 'created_at')->textInput() ?>

    <?// $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
