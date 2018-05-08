<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\helpers\ColumnsHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Picture */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Pictures'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picture-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'file_key',
            'new_name',
            'origin_name',
            'size',
            'extension',
            'type',
            'new_directory',
            [
                'attribute' => 'url',
                'format' => 'raw',
                'value' => function ($model) {
                    static $baseUrl = '';
                    if (!$baseUrl) $baseUrl = Yii::$app->params['baseUrl'];;
                    return ColumnsHelper::getPictureHtml(sprintf(
                        '%s%s/%s.%s',
                        $baseUrl,
                        $model->new_directory,
                        $model->new_name,
                        $model->extension
                    ));
                },
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return ColumnsHelper::date($model->created_at);
                },
            ],
            [
                'attribute' => 'updated_at',
                'value' => function ($model) {
                    return ColumnsHelper::date($model->updated_at);
                },
            ],
        ],
    ]) ?>

</div>
