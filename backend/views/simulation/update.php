<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Simulation */

$this->title = sprintf('%s%s',
    Yii::t('backend', 'Update'),
    Yii::t('backend', 'Simulation')
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Simulations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="simulation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
