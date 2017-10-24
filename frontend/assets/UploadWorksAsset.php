<?php
/**
 * @Author: Hzhihua
 * @Time: 2017/10/20 16:55
 * @Email: cnzhihua@gmail.com
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class UploadWorksAsset extends AssetBundle
{
    public $sourcePath = '@frontend/assets/static';
    public $css = [
        'css/html5uploader.css',
    ];
    public $js = [
        'js/jquery.js',
        'js/jQ.html5SliceUpload.js',
    ];
    public $depends = [
        'frontend\\assets\\AppAsset',
    ];
}