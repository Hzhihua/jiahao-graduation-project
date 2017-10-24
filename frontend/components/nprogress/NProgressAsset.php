<?php
/**
 * @Author: Hzhihua
 * @Time: 2017/9/20 19:00
 * @Email: cnzhihua@gmail.com
 */

namespace frontend\components\nprogress;

use yii\web\AssetBundle;

class NProgressAsset extends AssetBundle
{
    public $sourcePath = '@frontend/components/nprogress/static';
    public $css = [
        'nprogress.css',
    ];
    public $depends = [
        'edgardmessias\assets\nprogress\NProgressAsset',
    ];
}