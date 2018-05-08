<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\helpers\ColumnsHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PictureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Pictures');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picture-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
<!--        --><?//= Html::a(sprintf('%s%s',
//            Yii::t('backend', 'Create'),
//            Yii::t('backend', 'Picture')
//        ), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'origin_name',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->origin_name, \yii\helpers\Url::to(['update', 'id' => $model->id]));
                },
            ],
            [
                'attribute' => '图片',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
