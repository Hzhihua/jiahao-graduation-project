<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\helpers\ColumnsHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AnnouncementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Announcements');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="announcement-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(sprintf('%s%s',
            Yii::t('backend', 'Create'),
            Yii::t('backend', 'Announcement')
        ), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            [
                'attribute' => 'author_id',
                'value' => function ($model) {
                    return ColumnsHelper::getAuthorNameById($model->author_id);
                },
            ],
            [
                'attribute' => 'picture_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return ColumnsHelper::getPictureHtmlById($model->picture_id);
                },
            ],
            'description',
            //'content:ntext',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
