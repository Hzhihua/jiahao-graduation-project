<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\helpers\ColumnsHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UploadWorkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Upload Works');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upload-work-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(sprintf('%s%s',
            Yii::t('backend', 'Create'),
            Yii::t('backend', 'Upload Work')
        ), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'file_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return ColumnsHelper::getFileHtmlById($model->file_id);
                },
            ],
            'student_name',
            [
                'attribute' => 'student_class_id',
                'value' => function ($model) {
                    return ColumnsHelper::getStudentClassNameById($model->student_class_id);
                },
            ],
            [
                'attribute' => 'updated_at',
                'value' => function ($model) {
                    return ColumnsHelper::date($model->updated_at);
                },
            ],
            //'updated_at',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
