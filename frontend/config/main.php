<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'index/index',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'frontend-session',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'error/index',
        ],
        'assetManager' => [
//            'basePath' => '@webroot',
//            'baseUrl' => '@web',
            'bundles' => [
                'edgardmessias\assets\nprogress\NProgressAsset' => [
                    'configuration' => [
                        'minimum' => 0.7,
                        'showSpinner' => true,
                        'easing' => 'ease-out',
                        'speed' => 300,
                        'trickleSpeed' => 300,
                    ],
                    'page_loading' => false,
                    'pjax_events' => true,
                    'jquery_ajax_events' => false,
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '.html',
            'enableStrictParsing' => true,
            'rules' => [
                '/' => 'index/index',
                'int' => 'introduction/index',
                'ins' => 'installation/index',
                'sim' => 'simulation/index',
                'env' => 'environment/index',
                'upl' => 'upload-works/index',
                'ann/<pk:\d+>' => 'announcement/index',
                '<controller>/<pk:\d+>' => '<controller>/index',
                '<controller>/<action>' => '<controller>/<action>',
            ],
        ],

    ],
    'params' => $params,
    'as PjaxBehaviours' => 'frontend\behaviours\PjaxBehaviours',
];
