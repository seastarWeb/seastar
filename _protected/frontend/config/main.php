<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],    
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        // here you can set theme used for your frontend application 
        // - template comes with: 'default', 'slate', 'spacelab' and 'cerulean'
        'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@webroot/themes/slate/views'],
                'baseUrl' => '@web/themes/slate',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\UserIdentity',
            'enableAutoLogin' => true,
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
   ],
   'modules' => [

            'ducati' => [
                'class' => 'frontend\modules\ducati',
            ],
            'kawasaki' => [
                'class' => 'frontend\modules\kawasaki',
            ],
     //       'clothing' => [
      //          'class' => 'frontend\modules\clothing',
       //     ],
            'scrambler' => [
                'class' => 'frontend\modules\scrambler',
            ],
            'service' => [
                'class' => 'frontend\modules\service',
            ],
            'motorcycles' => [
                'class' => 'frontend\modules\motorcycles',
            ],
            'gridview' =>  [
                'class' => '\kartik\grid\Module'
            ],
            'sitemap' => [
                'class' => 'himiklab\sitemap\Sitemap\ ',
		'urls'=>[
		'loc'=>'/blog',
		'loc'=>'/ducati',
		],
            ],
        ], 
    'params' => $params,
];
