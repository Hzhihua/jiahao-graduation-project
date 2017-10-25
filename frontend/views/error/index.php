<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = $name;
?>

<div style="width:728px;height:90px;margin:0 auto;"></div>

<p class="error"><?= Yii::$app->getResponse()->statusCode; ?></p>

<div class="content">
    <h2><?= nl2br(Html::encode($message)) ?></h2>

    <p class="text">
        如果您认为这是服务器内部出现问题，请与管理员联系。谢谢！
    </p>

    <p class="links">
        <a id="button" href="javascript:window.history.back();">&larr; 返回</a> <a href="<?= Url::to([Yii::$app->defaultRoute]) ?>">主页</a>
    </p>
</div>
