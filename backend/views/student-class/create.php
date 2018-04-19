<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\StudentClass */

$this->title = sprintf('%s%s',
    Yii::t('backend', 'Create'),
    Yii::t('backend', 'Student Class')
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Student Classes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-class-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
