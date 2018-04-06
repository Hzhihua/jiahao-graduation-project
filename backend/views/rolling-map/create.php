<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RollingMap */

$this->title = Yii::t('backend', 'Create Rolling Map');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Rolling Maps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rolling-map-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
