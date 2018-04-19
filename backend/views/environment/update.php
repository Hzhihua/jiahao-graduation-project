<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Environment */

$this->title = sprintf('%s%s: %s',
    Yii::t('backend', 'Update'),
    Yii::t('backend', 'Environment'),
    $model->title
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Environments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="environment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
