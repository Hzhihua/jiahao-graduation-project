<?php
/**
 * @Author: Hzhihua
 * @Time: 2017/10/21 14:01
 * @Email: cnzhihua@gmail.com
 */
use yii\helpers\Url;
use frontend\assets\AppAsset;

/* @var $this \yii\web\View */

AppAsset::register($this);
$js = <<<JS
$(function () {
    $('h1.item-title').click(function () {
        var _this = $(this);
        var n = _this.index();
        if (0 === n) {
            $('#mo-dian').hide();
            $('#shu-dian').show();
        } else if (1 === n) {
            $('#shu-dian').hide();
            $('#mo-dian').show();
        }
        _this.css('color', '#10D07A').siblings().css('color', '#000');
    });
});
JS;

$this->registerJs($js);

?>

<!-- content srart -->
<div class="am-g am-g-fixed blog-fixed blog-content">
    <div class="am-u-sm-12">
        <h1 class="blog-text-center">-- 电子仿真模块 --</h1>
        <div>
            <h1 class="item-title" style="display: inline;cursor: pointer;color: #10D07A">数电</h1>
            <h1 class="item-title" style="display: inline;cursor: pointer;">模电</h1>
        </div>
        <div class="timeline-year" id="shu-dian">
            <hr>
            <ul>
                <hr>
                <?php $n=0; foreach ($data as $simulation): $n++;?>
                    <?php if (1 != $simulation['category']) continue;?>
                    <?php if ($n % 5 == 0):?>
                        <hr />
                    <?php endif;?>
                    <li>
                        <span class="am-u-sm-4 am-u-md-2 timeline-span"><?= date('Y/m/d', $simulation['file']['updated_at']); ?></span>
                        <span class="am-u-sm-8 am-u-md-6"><a href="<?= Url::to(['download', 'file'=>$simulation['file']['id']])?>"><?= $simulation['file']['name']; ?></a></span>
                        <span class="am-u-sm-4 am-u-md-2 am-hide-sm-only"><?= $simulation['file']['size']; ?></span>
                        <span class="am-u-sm-4 am-u-md-2 am-hide-sm-only"><?= $simulation['author']['name']; ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="timeline-year" id="mo-dian" style="display: none;">
            <hr>
            <ul>
                <hr>
                <?php $n=0; foreach ($data as $simulation): $n++;?>
                    <?php if (2 != $simulation['category']) continue;?>
                    <?php if ($n % 5 == 0):?>
                        <hr />
                    <?php endif;?>
                    <li>
                        <span class="am-u-sm-4 am-u-md-2 timeline-span"><?= date('Y/m/d', $simulation['file']['updated_at']); ?></span>
                        <span class="am-u-sm-8 am-u-md-6"><a href="<?= Url::to(['download', 'file'=>$simulation['file']['id']])?>"><?= $simulation['file']['name']; ?></a></span>
                        <span class="am-u-sm-4 am-u-md-2 am-hide-sm-only"><?= $simulation['file']['size']; ?></span>
                        <span class="am-u-sm-4 am-u-md-2 am-hide-sm-only"><?= $simulation['author']['name']; ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <hr>
    </div>


</div>
<!-- content end -->
