<?php

use yii\helpers\Html;
use common\models\File;

/* @var $this yii\web\View */
/* @var $model common\models\UploadWork */

$data = File::find()->select('name')->where(['id' => $model->file_id])->asArray()->one();
$this->title = sprintf('%s%s: %s',
    Yii::t('backend', 'Update'),
    Yii::t('backend', 'Upload Work'),
    $data['name']
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Upload Works'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="upload-work-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
