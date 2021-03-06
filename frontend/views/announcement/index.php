<?php
/**
 * @Author: Hzhihua
 * @Time: 2017/10/24 3:05
 * @Email: cnzhihua@gmail.com
 */
/* @var array $data */
use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
$this->title = Yii::t('frontend', 'Announcement');
?>

<!-- content start -->
<div class="am-g am-g-fixed blog-fixed blog-content">
    <div class="am-u-sm-12">
        <?php foreach ($data as $v): ?>
        <article class="am-article blog-article-p">
            <div class="am-article-hd">
                <h1 class="am-article-title blog-text-center"><?= Html::a($v['title'], \yii\helpers\Url::to(['view', 'pk' => $v['id']])) ?></h1>
                <p class="am-article-meta blog-text-center">
                    <span><a href="#">@<?= $v['author']['name'] ?></a></span>-
                    <span><a href="#"><?= date('Y/m/d', $v['updated_at']) ?></a></span>
                </p>
            </div>
            <div class="am-article-bd">
                <?= Html::decode(mb_substr(strip_tags($v['content']), 0, 250, 'utf-8')) ?>
            </div>
        </article>
        <hr>
        <?php endforeach; ?>
    </div>
</div>
<!-- content end -->
