<?php
/**
 * @Author: Hzhihua
 * @Time: 2017/10/20 15:29
 * @Email: cnzhihua@gmail.com
 */
use yii\helpers\Url;

$select = [];
$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
$requestRoute = $controller . '/' . $action;

switch ($requestRoute) {
    case 'index/index':
        $select[0] = 'class="am-active"';
        break;

    case 'introduction/index':
        $select[1] = 'class="am-active"';
        break;

    case 'installation/index':
        $select[2] = 'class="am-active"';
        break;

    case 'simulation/index':
        $select[3] = 'class="am-active"';
        break;

    case 'announcement/index':
        $select[4] = 'class="am-active"';
        break;

    case 'videos/index':
        $select[5] = 'class="am-active"';
        break;

    case 'upload-works/index':
        $select[6] = 'class="am-active"';
        break;
}

$weekArray = ['日', '一', '二', '三', '四', '五', '六'];
$weekDay = '星期' . $weekArray[date('w')];
?>

<hr>
<!-- nav start -->
<nav class="am-g am-g-fixed blog-fixed blog-nav">
    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only blog-button" data-am-collapse="{target: '#blog-collapse'}" ><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

    <div class="am-collapse am-topbar-collapse" id="blog-collapse">
        <ul class="am-nav am-nav-pills am-topbar-nav">
            <li <?= !isset($select[0]) ?: $select[0]; ?>><a href="<?= Url::home() ?>" data-pjax = 0><?= Yii::t('frontend', 'Home')?></a></li>
            <li <?= !isset($select[1]) ?: $select[1]; ?>><a href="<?= Url::to(['/introduction/index'])?>"><?= Yii::t('frontend', 'Introduction')?></a></li>
            <li <?= !isset($select[2]) ?: $select[2]; ?>><a href="<?= Url::to(['/installation/index'])?>"><?= Yii::t('frontend', 'Installation')?></a></li>
            <li <?= !isset($select[3]) ?: $select[3]; ?>><a href="<?= Url::to(['/communication/index'])?>"><?= Yii::t('frontend', 'Communication')?></a></li>
            <li <?= !isset($select[4]) ?: $select[4]; ?>><a href="<?= Url::to(['/announcement/index'])?>"><?= Yii::t('frontend', '课程动态')?></a></li>
            <li <?= !isset($select[5]) ?: $select[5]; ?>><a href="<?= Url::to(['/videos/index'])?>"><?= Yii::t('frontend', 'Videos')?></a></li>
            <li <?= !isset($select[6]) ?: $select[6]; ?>><a href="<?= Url::to(['/upload-works/index'])?>"><?= Yii::t('frontend', 'Upload Works')?></a></li>
        </ul>
        <div class="am-topbar-form am-topbar-right am-form-inline" style="text-align: center">
            <span><?= date('Y-m-d') .' '. $weekDay ?></span>
        </div>
    </div>
</nav>
<hr>

<?php
$js = <<<'JS'
    $('.am-topbar-nav > li').click(function () {
        var _this = $(this);
        _this.children('a').css('color', '#10D07A');
        _this.siblings().children('a').css('color', '#474747');
    });
JS;
$this->registerJs($js);
?>
