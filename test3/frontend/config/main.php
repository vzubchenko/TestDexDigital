<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'name' => 'test',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'enableCsrfValidation' => false,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl'       => true,
            'enableStrictParsing'   => true,
            'showScriptName'        => false,
            'rules' => [
                ['pattern' => '', 'route' => 'site_new/index','suffix' => '/', 'normalizer' => [
                    // do not collapse consecutive slashes for this rule
                    'collapseSlashes' => false,
                ],],

                ['pattern' => 'api/callback',   'route' => 'api/callback'],

                ['pattern' => '<status:(sorry|thank-you)+>',          'route' => 'site_new/returned'],
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@fmc/messages',
                    'sourceLanguage' => 'ru-RU',
                    'fileMap' => [
                        'app' => 'main.php',
                    ],
                ],
            ],
        ],
    ],

    'controllerMap' => [
        'site_new'  => 'fmc\modules\site\SiteController',
        'api'       => 'fmc\modules\api\ApiController',
    ],

    'params' => $params,
];
