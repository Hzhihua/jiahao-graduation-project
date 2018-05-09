<?php
/**
 * @Author: Hzhihua
 * @Time: 2017/10/20 15:24
 * @Email: cnzhihua@gmail.com
 */
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\widgets\Pjax;
use frontend\components\nprogress\NProgressAsset;

NProgressAsset::register($this); // show pjax progress at the top

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@frontend/views/layouts');
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

<body id="blog-article-sidebar">
<?php $this->beginBody() ?>
    <div style="min-height: 80%">
<!--    --><?php //Pjax::begin([
//        'timeout' => 30000, // 设置ajax请求超时时间（ms）
//        // 'scrollTo' => 0,
//        // 'linkSelector' => 'a[data-pjax!=0]',
//        'formSelector' => 'form',
//        'clientOptions' => [
//            // 'cache' => false, // 解决ie缓存问题 在url请求地址中添加"_=123456"参数
//            'container' => '#pjax-container', // 容器，这里的所有内容会被ajax请求的内容替换
//            // 'fragment' => 'section.content', // 片段，从请求的内容中提取<section class="content">内容替换掉container中的内容(这里是：#pjax-container)
//        ],
//    ]); ?>

    <?= $this->render(
        'nav.php',
        ['directoryAsset' => $directoryAsset]
    ) ?>

    <div class="content-wrapper" id="pjax-container">
        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        );?>
    </div>

<!--    --><?php //Pjax::end(); ?>
    </div>

    <?= $this->render(
        'footer.php',
        ['directoryAsset' => $directoryAsset]
    ) ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>