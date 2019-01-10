<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);
return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@api/modules/v1',
            'class' => 'api\modules\v1\Module'
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-api',
        ],

        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-api',
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
            'enablePrettyUrl' => true,
//            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/user',
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                ],
                ['class'=>'yii\rest\UrlRule', 'controller'=> 'v1/post',
                    'tokens'=>[
                        '{id}'=> '<id:\\w+>'
                    ],
                ],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'v1/user',
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                'extraPatterns' => [
                    'POST logins'=> 'login/index'

                ],
],
                ['class'=> 'yii\rest\UrlRule', 'controller'=> 'v1/...',
                    'tokens'=>[
                        '{id}'=> '<id:\\w+'
                    ],
                    ],

            ],
        ],
    ],
    'params' => $params,
];
