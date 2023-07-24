<?php

use kartik\datecontrol\Module;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$i18n = require __DIR__ . '/i18n.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'pt-BR',
    'sourceLanguage' => 'en-US',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@views'   => '@app/views',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Lxf-tSy7ioQ8fzScQPrNX0cQjynoYZsq',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
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
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@Da/User/resources/views' => '@app/views/user'
                ]
            ]
        ],
        'authManager' => [
            'class' => 'Da\User\Component\AuthDbManagerComponent',
        ],
        'i18n' => $i18n,
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'pluralize' => false,
                    'class' => \yii\rest\UrlRule::class,
                    'controller' => [
                        'api/*',
                    ]
                ]
            ],
        ],
        'formatter' => [
            'class' => \app\helpers\Formatter::class,
            'nullDisplay' => '',
        ]
    ],
    'modules' => [
        'user' => [
            'class' => Da\User\Module::class,
            'classMap' => [
                'User' => \app\models\User::class,
            ],
            'administrators' => ['admin'], // this is required for accessing administrative actions
            // ...other configs from here: [Configuration Options](installation/configuration-options.md), e.g.
            // 'generatePasswords' => true,
            // 'switchIdentitySessionKey' => 'myown_usuario_admin_user_key',
            'enableRegistration' => true,
            'enableGdprCompliance' => true,
            'controllerMap' => [
                'security' => 'app\controllers\user\SecurityController',
                'recovery' => 'app\controllers\user\RecoveryController',
                'registration' => 'app\controllers\user\RegistrationController',
            ]
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
        'datecontrol' =>  [
            'class' => 'kartik\datecontrol\Module',

            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                Module::FORMAT_DATE => 'dd/MM/yyyy',
                Module::FORMAT_TIME => 'hh:mm:ss a',
                Module::FORMAT_DATETIME => 'dd/MM/yyyy hh:mm:ss a',
            ],

            // set your display timezone
            'displayTimezone' => 'America/Sao_Paulo',

            // custom widget settings that will be used to render the date input instead of kartik\widgets,
            // this will be used when autoWidget is set to false at module or widget level.
            'widgetSettings' => [
                Module::FORMAT_DATE => [
                    'class' => 'yii\jui\DatePicker', // example
                    'options' => [
                        'dateFormat' => 'php:d-M-Y',
                        'options' => ['class'=>'form-control'],
                    ]
                ]
            ]
        ],
        'api' => [
            'class' => 'app\modules\api\Module'
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
        'generators' => [ //here
            'model' => [ // generator name
                'class' => 'app\generators\model\Generator', // generator class
                'templates' => [ //setting for out templates
                    'Project Default' => '@app/generators/model/default', // template name => path to template
                ]
            ],
            'crud' => [ // generator name
                'class' => 'app\generators\crud\Generator', // generator class
                'templates' => [ //setting for out templates
                    'Project Default' => '@app/generators/crud/default', // template name => path to template
                ]
            ]
        ],
    ];
}

return $config;
