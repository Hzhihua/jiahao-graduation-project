<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\helpers\ColumnsHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Files');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(sprintf('%s%s',
            Yii::t('backend', 'Create'),
            Yii::t('backend', 'File')
        ), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($model) {
                    return ColumnsHelper::getFileHtml($model->name, $model->url);
                },
            ],
            [
                'attribute' => 'size',
                'value' => function ($model) {
                    return ColumnsHelper::formatBytes($model->size);
                },
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return ColumnsHelper::date($model->created_at);
                },
            ],
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
