<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Simulation */

$this->title = Yii::t('backend', 'Create Simulation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Simulations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="simulation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
