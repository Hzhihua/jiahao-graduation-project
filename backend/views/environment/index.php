<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\helpers\ColumnsHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EnvironmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Environments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="environment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Create Environment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'content:ntext',
            [
                'attribute' => 'author_id',
                'value' => function ($model) {
                    return ColumnsHelper::getAuthorNameById($model->author_id);
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
