<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UploadWork */

$this->title = Yii::t('backend', 'Create Upload Work');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Upload Works'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upload-work-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
