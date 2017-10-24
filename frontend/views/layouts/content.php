<?php
/**
 * @Author: Hzhihua
 * @Time: 17-10-24 下午7:45
 * @Email: cnzhihua@gmail.com
 */

/* @var $this yii\web\View */
/* @var $content string */

use yii\helpers\Html;

$title = Html::encode($this->title);
$isPjax = Yii::$app->getRequest()->isPjax;
?>

<?php if ($isPjax): ?>
    <?php $this->beginPage() ?>
    <?php $this->head() ?>
    <?php $this->beginBody() ?>
<?php endif; ?>

<title><?= $title; ?></title>

<?= $content ?>

<?php if ($isPjax): ?>
    <?php $this->endBody() ?>
    <?php $this->endPage() ?>
<?php endif; ?>