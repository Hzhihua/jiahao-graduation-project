<?php
/**
 * @Author: cnzhihua
 * @Date: 2018-05-09 16:00
 * @Github: https://github.com/Hzhihua
 */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use backend\helpers\ColumnsHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AnnouncementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Media');
$this->params['breadcrumbs'][] = $this->title;
$baseUrl = rtrim(Yii::$app->params['baseUrl'], '/') . '/';
?>
<div class="media-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(sprintf('%s%s',
            Yii::t('backend', 'Create'),
            Yii::t('backend', 'Media')
        ), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'origin_name',
            [
                'attribute' => 'picture_url',
                'format' => 'raw',
                'value' => function ($model) {
                    return ColumnsHelper::getPictureHtml(rtrim(Yii::$app->params['baseUrl'], '/') . '/' . $model->picture_url);
                },
            ],
            'type',
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return ColumnsHelper::date($model->created_at);
                },
            ],

            [
                'header' => '操作',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        return Html::a("<span class='glyphicon glyphicon-trash'></span>", Url::to(['delete', 'file_key' => $model->file_key]), ['data-pjax' => 0, 'data-confirm' => '您确定要删除此项吗？', 'data-method' => 'post', 'title' => Yii::t('backend', 'Delete')]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>

