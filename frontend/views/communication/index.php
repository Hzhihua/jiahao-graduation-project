<?php
/**
 * @Author: cnzhihua
 * @Date: 2018-05-08 10:18
 * @Github: https://github.com/Hzhihua
 */

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $searchModel common\models\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Questions');
$this->params['breadcrumbs'][] = $this->title;

AppAsset::register($this);
?>
<style>
    tr, td, th {
        text-align: center;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
    }
</style>
<div class="question-index" style="width: 80%;margin: 0 auto;">

    <p>
        <?= Html::a('添加新的留言', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <table style="width: 100%;">
        <tr>
            <th>序号</th>
            <th>咨询内容</th>
            <th>咨询人</th>
            <th>咨询时间</th>
            <th>是否已回复</th>
        </tr>
        <?php $n=0; foreach($data as $value): $n++;?>
        <tr>
            <td width="10%"><?= $n ?></td>
            <td width="45%"><?= Html::a(mb_substr(Html::encode($value['question']), 0, 100, 'utf-8'), Url::to(['view', 'id' => $value['id']])) ?></td>
            <td width="10%"><?= Html::encode($value['username']) ?></td>
            <td width="15%"><?= date('Y-m-d H:i:s', $value['created_at']) ?></td>
            <td width="10%"><?= $value['answer_id'] ? Html::a('已回复', Url::to(['view', 'id' => $value['id']]), ['style' => ['color' => 'green']]) : '未回复' ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

