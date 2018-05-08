<?php
/**
 * @Author: cnzhihua
 * @Date: 2018-05-08 10:43
 * @Github: https://github.com/Hzhihua
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>

<div style="width: 80%;margin:0 auto">
    <div style="text-align: center">
        <?= Html::tag('h1', '咨询内容') ?>
    </div>
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'question')->textarea(['rows' => 6]) ?>
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end() ?>
</div>

