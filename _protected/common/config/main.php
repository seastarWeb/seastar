<?php
return [
    'name' => 'Seastar Superbikes CMS',
    //'language' => 'sr',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'assetManager' => [
            'bundles' => [
                // we will use bootstrap css from our theme
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [], // do not use yii default one
                ],
                // // use bootstrap js from CDN
                // 'yii\bootstrap\BootstrapPluginAsset' => [
                //     'sourcePath' => null,   // do not use file from our server
                //     'js' => [
                //         'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js']
                // ],
                // // use jquery from CDN
                // 'yii\web\JqueryAsset' => [
                //     'sourcePath' => null,   // do not use file from our server
                //     'js' => [
                //         'ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js',
                //     ]
                // ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'dateFormat' => 'dd.MM.yyyy',
            'decimalSeparator' => '.',
            'thousandSeparator' => ',',
            'currencyCode' => 'GBP',
       ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules'=>[
        //  '<controller:(ducati-models)>/<action:\w+>/<model>' => '<controller>/<action>',
                'debug/<controller>/<action>' => 'debug/<controller>/<action>',
                '<module:ducati>/<controller:(models)>/<modelrange>' => '<module>/<controller>/index',
        //        '<module:ducati>/<controller:(models)>/<model>' => '<module>/<controller>/buy',
                '<module:ducati>/<controller:(accessorize)>/<action:\w+>/<slug>' => '<module>/<controller>/my',
                '<module:ducati>/<controller:(the)>/<slug>' => '<module>/<controller>/',
                '<module:ducati>/<controller:(ducati-clothing)>/<action:\w+>/<Category:\w+>' => '<module>/<controller>/<action>',
                '<module:ducati>/<controller:(ducati-accessories)>/<action:\w+>/<Category:\w+>' => '<module>/<controller>/<action>',

                '<module:kawasaki>/<controller:(models)>/<modelrange>' => '<module>/<controller>/index',
                '<module:kawasaki>/<controller:(the)>/<slug>' => '<module>/<controller>/',                
                '<module:kawasaki>/<controller:(accessorize)>/<action:\w+>/<slug>' => '<module>/<controller>/my',
                '<module:kawasaki>/<controller:(kawasaki-clothing)>/<action:\w+>/<Category:\w+>' => '<module>/<controller>/<action>', 
                '<module:kawasaki>/<controller:(kawasaki-accessories)>/<action:\w+>/<Category:\w+>' => '<module>/<controller>/<action>',               
                
                '<module:scrambler>/<controller:(models)>/<modelrange>' => '<module>/<controller>/index',

        // Revised to handle shop URLs RCM 7.5.2015
                '<controller:(shop)>/<action:\w+>/<Brand>/<ProductLine>' => '<controller>/<action>',
                '<controller:(find)>/<action:\w+>/<SearchTerm>' => '<controller>/<action>',
                '<controller:(accessories)>/<action:\w+>/<category:\w+>' => '<controller>/<action>',
                '<controller:(clothing)>/<action:\w+>/<category:\w+>' => '<controller>/<action>',
                '<controller:(clothing)>/<Brand:\w+>' => '<controller>/index',
		'pattern'=>'sitemap','route'=>'sitemap/default/index','suffix'=>'.xml',
            ],
        ],
        'cart' => [
            'class' => 'yz\shoppingcart\ShoppingCart',
            'cartId' => 'my_application_cart',
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/translations',
                    'sourceLanguage' => 'en',
                ],
                'yii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/translations',
                    'sourceLanguage' => 'en'
                ],
            ],
        ],
    ], // components

    // set allias for our uploads folder so it can be shared by both frontend and backend applications
    // @appRoot alias is definded in common/config/bootstrap.php file
    'aliases' => [
        '@uploads' => '@appRoot/uploads'
    ],
];
