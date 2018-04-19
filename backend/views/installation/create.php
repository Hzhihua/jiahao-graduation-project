<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Installation */

$this->title = sprintf('%s%s',
    Yii::t('backend', 'Create'),
    Yii::t('backend', 'Installation')
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Installations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="installation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
