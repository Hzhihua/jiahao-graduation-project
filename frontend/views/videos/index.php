<?php
/**
 * @Author: cnzhihua
 * @Time: 18-3-1 20:23
 * @Github: https://github.com/Hzhihua
 */

/* @var $this \yii\web\View */
/* @var $data array */
use yii\helpers\Url;
use frontend\assets\AppAsset;

AppAsset::register($this);
$this->title = Yii::t('frontend', 'Videos');
$baseUrl = rtrim(Yii::$app->params['baseUrl'], '/') . '/';

?>

<!-- content start -->
<div class="am-g am-g-fixed blog-fixed blog-content">
    <ul class="list-unstyled video-list-thumbs row">
        <?php foreach($data as $value): ?>
        <li class="col-lg-3 col-sm-4 col-xs-6">
            <a data-pjax="0" href="<?= Url::to(['view', 'id' => $value['file_key']]) ?>" title="<?= $value['origin_name'] ?>">
                <img src="<?= $baseUrl . $value['picture_url'] ?>" alt="<?= $value['origin_name']?>" class="img-responsive" height="130px">
                <h2><?= $value['origin_name'] ?></h2>
                <span class="glyphicon glyphicon-play-circle"></span>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<!-- content end -->
