<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\helpers\ColumnsHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RollingMapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Rolling Maps');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rolling-map-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(sprintf('%s%s',
            Yii::t('backend', 'Create'),
            Yii::t('backend', 'Rolling Map')
        ), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'picture_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return ColumnsHelper::getPictureHtmlById($model->picture_id);
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
                    return ColumnsHelper::date($model->created_at);
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
