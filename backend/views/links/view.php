<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\helpers\ColumnsHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Links */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="links-view">

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
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($model) {
                    return ColumnsHelper::links($model->name, $model->url);
                },
            ],
            'url',
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
