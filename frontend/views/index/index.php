<?php
/**
 * @Author: Hzhihua
 * @Time: 2017/10/20 15:38
 * @Email: cnzhihua@gmail.com
 */
/* @var array $data*/
use yii\helpers\Url;
use frontend\assets\AppAsset;
//use common\models\Announcement;

AppAsset::register($this);

//$page = Yii::$app->getRequest()->get('page');
//$page = (int)$page < 1 ? 1 : $page;
//$params = Yii::$app->params;
$rootDir = rtrim(Yii::$app->params['baseUrl'], '/') . '/';

//$hasNext = ((int) Announcement::find()->count() - ((int) $page * (int) Yii::$app->params['AnnouncementPageSize'])) > 0 ? true : false;

$this->title = 'Proteus -- 嘉应学院';
?>

<!-- banner start -->
<div class="am-g am-g-fixed blog-fixed am-u-sm-centered blog-article-margin">
    <div data-am-widget="slider" class="am-slider am-slider-b1" data-am-slider='{&quot;controlNav&quot;:false}' >
        <ul class="am-slides">
            <?php foreach ($data['rollingMap'] as $rollingMap): ?>
                <li style="height:500px">
                    <img src="<?= $rootDir . $rollingMap['picture']['new_directory'] . '/' .$rollingMap['picture']['new_name'] .'.'. $rollingMap['picture']['extension']; ?>">
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<!-- banner end -->

<!-- content start -->
<div class="am-g am-g-fixed blog-fixed">
    <div class="am-u-md-8 am-u-sm-12">

        <?php if ($announcement = $data['announcement']): ?>
        <article class="am-g blog-entry-article">
            <div class="am-u-lg-6 am-u-md-12 am-u-sm-12 blog-entry-img">
                <img width="400" height="192" src="<?= $rootDir . $announcement['picture']['new_directory'] . '/' .$announcement['picture']['new_name'] .'.'. $announcement['picture']['extension']; ?>" alt="预览图" class="am-u-sm-12">
            </div>
            <div class="am-u-lg-6 am-u-md-12 am-u-sm-12 blog-entry-text">
<!--                <span> @--><?//= $announcement['author']['name']; ?><!-- &nbsp;</span>-->
                <span><?= date('Y/m/d', $announcement['updated_at']); ?></span>
                <h1><a href="<?= Url::to(['announcement/view', 'pk' => $announcement['id']])?>"><?= $announcement['title']; ?></a></h1>
                <p><?=
                    mb_strlen($announcement['description'], 'utf-8') > 60 ?
                        mb_substr($announcement['description'], 0, 60, 'utf-8') . '...' :
                        $announcement['description'];
                ?></p>
                <p><a href="<?= Url::to(['announcement/view', 'pk' => $announcement['id']])?>" class="blog-continue"><?= Yii::t('frontend', 'Read More') ?></a></p>
            </div>
        </article>
        <?php endif;?>

        <?php if ($installtion = $data['installation']): ?>
        <article class="am-g blog-entry-article">
            <div class="am-u-lg-6 am-u-md-12 am-u-sm-12 blog-entry-img">
                <img width="400" height="192" src="<?= $rootDir . 'picture.jpg'; ?>" alt="预览图" class="am-u-sm-12">
            </div>
            <div class="am-u-lg-6 am-u-md-12 am-u-sm-12 blog-entry-text">
<!--                <span> @--><?//= $installtion['author']['name']; ?><!-- &nbsp;</span>-->
                <span><?= date('Y/m/d', $installtion['updated_at']); ?></span>
                <h1><a href="<?= Url::to(['installation/index', 'pk' => $installtion['id']])?>"><?= $installtion['title']; ?></a></h1>
                <p><?=
                    mb_strlen($installtion['description'], 'utf-8') > 60 ?
                        mb_substr($installtion['description'], 0, 60, 'utf-8') . '...' :
                        $installtion['description'];
                    ?></p>
                <p><a href="<?= Url::to(['installation/index', 'pk' => $installtion['id']])?>" class="blog-continue"><?= Yii::t('frontend', 'Read More') ?></a></p>
            </div>
        </article>
        <?php endif;?>

<!--        <ul class="am-pagination">-->
<!--            --><?php //if ($page > 1): ?>
<!--            <li class="am-pagination-prev">-->
<!--                <a data-pjax=0 href="--><?//= Url::to(['index', 'page' => $page - 1])?><!--">&laquo; 上一页</a>-->
<!--            </li>-->
<!--            --><?php //endif; ?>
<!---->
<!--            --><?php //if ($hasNext): ?>
<!--            <li class="am-pagination-next">-->
<!--                <a data-pjax=0 href="--><?//= Url::to(['index', 'page' => $page + 1])?><!--">下一页 &raquo;</a>-->
<!--            </li>-->
<!--            --><?php //endif; ?>
<!--        </ul>-->
    </div>

    <div class="am-u-md-4 am-u-sm-12 blog-sidebar">
        <div class="blog-sidebar-widget blog-bor">
            <h2 class="blog-text-center blog-title"><span>Proteus</span></h2>
            <img src="images/i/proteus.gif" alt="about me" class="blog-entry-img" >
            <p style="text-indent: 2em">
                Proteus是英国著名的EDA工具(仿真软件)，从原理图布图、代码调试到单片机与外围电路协同仿真，一键切换到PCB设计，真正实现了从概念到产品的完整设计。是目前世界上唯一将电路仿真软件、PCB设计软件和虚拟模型仿真软件三合一的设计平台，其处理器模型支持8051、HC11、PIC10/12/16/18/24/30/DsPIC33、AVR、ARM、8086和MSP430等，2010年又增加了Cortex和DSP系列处理器，并持续增加其他系列处理器模型。在编译方面，它也支持IAR、Keil和MPLAB等多种编译器。
            </p>
        </div>
        <div class="blog-sidebar-widget blog-bor">
            <h2 class="blog-title"><span>友情链接</span></h2>
            <ul class="am-list">
                <?php foreach ($data['links'] as $link): ?>
                    <li><a href="<?= $link['url']; ?>" target="_blank"><?= $link['name']; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<!-- content end -->
