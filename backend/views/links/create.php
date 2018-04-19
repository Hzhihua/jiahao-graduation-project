<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Links */

$this->title = sprintf('%s%s',
    Yii::t('backend', 'Create'),
    Yii::t('backend', 'Link')
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="links-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
