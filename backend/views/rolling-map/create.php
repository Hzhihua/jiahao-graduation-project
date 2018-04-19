<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RollingMap */

$this->title = sprintf('%s%s',
    Yii::t('backend', 'Create'),
    Yii::t('backend', 'Rolling Map')
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Rolling Maps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rolling-map-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
