<?php
/**
 * @Author: Hzhihua
 * @Time: 17-10-25 下午2:04
 * @Email: cnzhihua@gmail.com
 */
/* @var \yii\web\View $this */
/* @var string $message */
/* @var string $content */

use frontend\assets\ErrorAsset;
use yii\helpers\Html;

ErrorAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name=renderer content=webkit>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
