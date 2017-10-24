<?php
/**
 * @Author: Hzhihua
 * @Time: 2017/10/20 15:38
 * @Email: cnzhihua@gmail.com
 */
use yii\helpers\Url;
use frontend\assets\AppAsset;

AppAsset::register($this);

$page = Yii::$app->getRequest()->get('page');
$page = (int)$page < 1 ? 1 : $page;
$params = Yii::$app->params;
$rootDir = rtrim($params['uploadFileRoot'], '/') . '/';
?>

<!-- banner start -->
<div class="am-g am-g-fixed blog-fixed am-u-sm-centered blog-article-margin">
    <div data-am-widget="slider" class="am-slider am-slider-b1" data-am-slider='{&quot;controlNav&quot;:false}' >
        <ul class="am-slides">
            <?php foreach ($data['rollingMap'] as $rollingMap): ?>
                <li>
                    <img width="1170" height="529" src="<?= $rootDir . $rollingMap['picture']['url']; ?>">
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<!-- banner end -->

<!-- content srart -->
<div class="am-g am-g-fixed blog-fixed">
    <div class="am-u-md-8 am-u-sm-12">

        <?php foreach ($data['announcement'] as $announcement): ?>
        <article class="am-g blog-entry-article">
            <div class="am-u-lg-6 am-u-md-12 am-u-sm-12 blog-entry-img">
                <img width="400" height="192" src="<?= $rootDir . $announcement['picture']['url']; ?>" alt="预览图" class="am-u-sm-12">
            </div>
            <div class="am-u-lg-6 am-u-md-12 am-u-sm-12 blog-entry-text">
                <span> @<?= $announcement['author']['name']; ?> &nbsp;</span>
                <span><?= date('Y/m/d', $announcement['updated_at']); ?></span>
                <h1><a href="<?= Url::to(['announcement/index', 'pk' => $announcement['id']])?>"><?= $announcement['title']; ?></a></h1>
                <p><?=
                    mb_strlen($announcement['description'], 'utf-8') > 60 ?
                        mb_substr($announcement['description'], 0, 60, 'utf-8') . '...' :
                        $announcement['description'];
                ?></p>
                <p><a href="<?= Url::to(['announcement/index', 'pk' => $announcement['id']])?>" class="blog-continue">阅读全文</a></p>
            </div>
        </article>
        <?php endforeach; ?>

        <ul class="am-pagination">
            <li class="am-pagination-prev"><a href="<?= Url::to(['index', 'page' => $page - 1])?>">&laquo; Prev</a></li>
            <li class="am-pagination-next"><a href="<?= Url::to(['index', 'page' => $page + 1])?>">Next &raquo;</a></li>
        </ul>
    </div>

    <div class="am-u-md-4 am-u-sm-12 blog-sidebar">
        <div class="blog-sidebar-widget blog-bor">
            <h2 class="blog-text-center blog-title"><span>About ME</span></h2>
            <img src="assets/i/f14.jpg" alt="about me" class="blog-entry-img" >
            <p>妹纸</p>
            <p>
                我是妹子UI，中国首个开源 HTML5 跨屏前端框架
            </p><p>我不想成为一个庸俗的人。十年百年后，当我们死去，质疑我们的人同样死去，后人看到的是裹足不前、原地打转的你，还是一直奔跑、走到远方的我？</p>
        </div>
        <div class="blog-sidebar-widget blog-bor">
            <h2 class="blog-title"><span>么么哒</span></h2>
            <ul class="am-list">
                <li><a href="#">每个人都有一个死角， 自己走不出来，别人也闯不进去。</a></li>
                <li><a href="#">我把最深沉的秘密放在那里。</a></li>
                <li><a href="#">你不懂我，我不怪你。</a></li>
                <li><a href="#">每个人都有一道伤口， 或深或浅，盖上布，以为不存在。</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- content end -->
