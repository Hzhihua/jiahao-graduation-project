<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Announcement */

$this->title = sprintf('%s%s',
    Yii::t('backend', 'Create'),
    Yii::t('backend', '课程动态')
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', '动态管理'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="announcement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
