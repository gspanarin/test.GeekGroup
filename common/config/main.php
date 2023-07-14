<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=test_geek_group',
            'username' => 'geek_group',
            'password' => 'geek_group',
            'charset' => 'utf8',
        ],
        /*'i18n' => [
            'translations' => [
                '*' => [
                    'class'          => 'yii\i18n\PhpMessageSource',
                    'basePath'       => '@backend/messages', // if advanced application, set @frontend/messages
                    'sourceLanguage' => 'ua',
                    'fileMap'        => [
                        //'main' => 'main.php',
                        //require __DIR__ . '/i18n.php'
                    ],
                ],
            ],
        ],*/
    ],
];
