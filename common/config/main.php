<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language'       => 'zh-CN',
    'sourceLanguage' => 'en',
    'timeZone'       => 'Asia/Shanghai',
    'components' => [
        'cache' => [
            'class'           => 'yii\caching\FileCache',
            'cachePath'       => '@common/runtime/cache',
            'defaultDuration' => 300,
        ],
        'formatter' => [
            'timeZone'        => 'Asia/Shanghai',
            'defaultTimeZone' => 'Asia/Shanghai',
            'dateFormat'      => 'php:Y-m-d',
            'timeFormat'      => 'php:H:i:s',
            'datetimeFormat'  => 'php:Y-m-d H:i:s',
        ],
    ],
];
