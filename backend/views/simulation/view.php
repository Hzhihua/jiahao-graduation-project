<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\helpers\ColumnsHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Simulation */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Simulations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="simulation-view">

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
            [
                'attribute' => 'category',
                'value' => function ($model) {
                    $index = [
                        1 => '数电',
                        2 => '模电',
                    ];
                    return $index[$model->category];
                },
            ],
            [
                'attribute' => 'file_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return ColumnsHelper::getFileHtmlById($model->file_id);
                },
            ],
            [
                'attribute' => 'author_id',
                'value' => function ($model) {
                    return ColumnsHelper::getAuthorNameById($model->author_id);
                },
            ],
            [
                'attribute' => 'created_at)',
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
