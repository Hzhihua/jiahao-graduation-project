<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UploadWork */

$this->title = sprintf('%s%s: %s',
    Yii::t('backend', 'Update'),
    Yii::t('backend', 'Upload Work'),
    $model->title
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Upload Works'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="upload-work-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
