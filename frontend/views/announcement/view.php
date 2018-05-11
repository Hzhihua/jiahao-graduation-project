<?php
/**
 * @Author: Hzhihua
 * @Time: 2017/10/24 3:05
 * @Email: cnzhihua@gmail.com
 */
/* @var array $data */
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
$this->title = $data['title'];
?>

<!-- content start -->
<div class="am-g am-g-fixed blog-fixed blog-content">
    <div class="am-u-sm-12">
        <article class="am-article blog-article-p">
            <div class="am-article-hd">
                <h1 class="am-article-title blog-text-center"><?= $data['title'] ?></h1>
                <p class="am-article-meta blog-text-center">
                    <span><a href="#">@<?= $data['author']['name'] ?></a></span>-
                    <span><a href="#"><?= date('Y/m/d', $data['updated_at']) ?></a></span>
                </p>
            </div>
            <div class="am-article-bd">
                <?= Html::decode($data['content']) ?>
            </div>
        </article>
        附件下载：
        <?php if($data['file']): ?>
            <a href="<?= Url::to(['file-download', 'file_key' => $data['file']['file_key']])?>"><?= $data['file']['origin_name'] . '.' . $data['file']['extension'] ?></a>
        <?php endif; ?>
        <hr>
    </div>
</div>
<!-- content end -->
