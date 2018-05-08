<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $data array */
/* @var $model common\models\Answer */

$this->title = Html::encode($data['username']);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Answers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'data' => $data,
        'model' => $model,
    ]) ?>

</div>
