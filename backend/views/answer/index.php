<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AnswerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Answers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'question',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a(mb_substr(strip_tags($model->question), 0, 100, 'utf-8'), Url::to(['create', 'id' => $model->id]), ['style' => $model->answer_id ? '' : ['color' => 'red']]);
                },
            ],
            [
                'attribute' => 'username',
                'options' => [
                    'width' => '6%',
                ],
            ],
            [
                'attribute' => 'answer.answer_name',
                'options' => [
                    'width' => '6%',
                ],
            ],
            [
                'attribute' => 'answer.answer',
                'options' => [
                    'width' => '6%',
                ],
                'value' => function ($model) {
                    return mb_substr(strip_tags($model->answer['answer']), 0, 100, 'utf-8');
                },
            ],

//            'answer.answer:ntext',
//            'created_at',
//            'updated_at',

//            [
//                'header' => '操作',
//                'class' => 'yii\grid\ActionColumn',
//                'options' => [
//                    'width' => '6%',
//                ],
//            ],
        ],
    ]); ?>
</div>
