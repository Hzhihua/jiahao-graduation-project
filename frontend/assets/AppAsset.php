<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@frontend/assets/static';
    public $css = [
        'css/amazeui.min.css',
        'css/app.css',
    ];
    public $js = [
        'js/amazeui.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
