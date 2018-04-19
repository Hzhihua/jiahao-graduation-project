<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Announcement */

$this->title = sprintf('%s%s',
    Yii::t('backend', 'Create'),
    Yii::t('backend', 'Announcement')
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Announcements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="announcement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
