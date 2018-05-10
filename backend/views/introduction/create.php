<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Environment */

$this->title = sprintf('%s%s',
    Yii::t('backend', 'Create'),
    Yii::t('backend', 'Environment')
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Environments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="environment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
