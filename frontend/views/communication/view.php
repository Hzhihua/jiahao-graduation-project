<?php
/**
 * @Author: cnzhihua
 * @Date: 2018-05-08 20:18
 * @Github: https://github.com/Hzhihua
 */

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Question */

AppAsset::register($this);
$this->title = $data['answer_id'] ? '<span style="color: green">已回复</span>' : '未回复';
?>
<div class="question-view" style="width: 80%;margin: 0 auto;">

    <div style="text-align: center;">
        <h1><?= $this->title ?></h1>
    </div>
    提问人：<span><?= Html::encode($data['username'])?></span>
    <br />
    咨询问题：<span><?= Html::encode($data['question'])?></span>
    <br />
    <hr>
    回复人：<span><?= Html::encode($data['answer']['answer_name'])?></span>
    <br />
    回复：<span><?= Html::encode($data['answer']['answer'])?></span>
</div>

