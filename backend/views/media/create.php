<?php
/**
 * @Author: cnzhihua
 * @Date: 2018-05-09 16:00
 * @Github: https://github.com/Hzhihua
 */

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Announcement */

$this->title = '上传新视频';
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Announcements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="announcement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>