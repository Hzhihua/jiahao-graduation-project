<?php
/**
 * @Author: cnzhihua
 * @Time: 18-3-1 20:23
 * @Github: https://github.com/Hzhihua
 */

/* @var $this \yii\web\View */
use frontend\assets\AppAsset;

AppAsset::register($this);
$this->title = Yii::t('frontend', 'Videos');

?>

<!-- content start -->
<div class="am-g am-g-fixed blog-fixed blog-content">
    <ul class="list-unstyled video-list-thumbs row">
        <?php for ($i=0; $i<5; $i++): ?>
        <li class="col-lg-3 col-sm-4 col-xs-6">
            <a href="#" title="Claudio Bravo, antes su debut con el Barça en la Liga">
                <img src="http://i.ytimg.com/vi/ZKOtE9DOwGE/mqdefault.jpg" alt="Barca" class="img-responsive" height="130px">
                <h2>Claudio Bravo, antes su debut con el Barça en la Liga</h2>
                <span class="glyphicon glyphicon-play-circle"></span>
            </a>
        </li>
        <?php endfor; ?>
    </ul>
</div>
<!-- content end -->
