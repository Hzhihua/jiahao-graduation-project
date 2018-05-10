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

    <?= FormHelper::FileUpload($form, $model, 'file_key') ?>

    <?php ActiveForm::end(); ?>

</div>
