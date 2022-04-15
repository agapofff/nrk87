<?php
use \kartik\datecontrol\Module;

$config = [
    'id' => 'NRK87.',
    'name' => 'fashion tech wear бренд',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'sourceLanguage' => 'ru',
    'language' => 'ru',
    'bootstrap' => [
        'dvizh\order\Bootstrap'
    ],

    'modules' => [
        // 'languages' => [
            // 'class' => 'klisl\languages\Module',
            // 'default_language' => 'ru',
            // 'show_default' => false,
        // ],

        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['admin'],
            'enableGeneratingPassword' => true,
        ],
        
        /*
        'rbac' => [
            'class' => 'githubjeka\rbac\Module',
            'as access' => [ // if you need to set access
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'] // all auth users 
                    ],
                ]
            ]
        ],
        */
        
        /*
        'rbac' => [
            'class' => 'yii2mod\rbac\Module',
        ],
        */
        
        'datecontrol' => [
            'class' => '\kartik\datecontrol\Module'
        ],

        'shop' => [
            'class' => 'dvizh\shop\Module',
            'adminRoles' => ['administrator', 'superadmin', 'admin', 'manager'],
            'defaultPriceTypeId' => 1, //Цена по умолчанию
        ],
        'filter' => [
            'class' => 'dvizh\filter\Module',
            'adminRoles' => ['admin'],
            'relationFieldName' => 'category_id',
            'relationFieldValues' =>
                function() {
                    return \dvizh\shop\models\Category::buildTextTree();

                    // $return = [];
                    // foreach ($products as $product) {
                       // if (empty($category->parent_id)) {
                            // $return[] = $category;
                            // foreach($categories as $category2) {
                                // if($category2->parent_id == $category->id) {
                                    // $category2->name = ' --- '.$category2->name;
                                    // $return[] = $category2;
                                // }
                            // }
                       // }
                    // }
                    
                    // $products =  \dvizh\shop\models\Product::find()->asArray()->all();
                    // return \yii\helpers\ArrayHelper::map($products, 'id', 'name');
                },
        ],
        'field' => [
            'class' => 'dvizh\field\Module',
            'relationModels' => [
                'dvizh\shop\models\Product' => 'Продукты',
                'dvizh\shop\models\Category' => 'Категории',
                'dvizh\shop\models\Producer' => 'Производители',
            ],
            'adminRoles' => ['admin'],
        ],
        'relations' => [
            'class' => 'dvizh\relations\Module',
            'fields' => ['code'],
        ],
        'gallery' => [
            'class' => 'dvizh\gallery\Module',
            'imagesStorePath' => dirname(dirname(__DIR__)).'/frontend/web/images/store',
            'imagesCachePath' => dirname(dirname(__DIR__)).'/frontend/web/images/cache',
            'graphicsLibrary' => 'GD',
            'placeHolderPath' => dirname(dirname(__DIR__)).'/frontend/web/images/placeholder.png',
        ],
        'cart' => [
            'class' => 'dvizh\cart\Module',
        ],
        'tree' => [
            'class' => 'dvizh\tree\Module',
            'adminRoles' => ['@'],
        ],
        'order' => [
            'class' => 'dvizh\order\Module',
            'layoutPath' => 'frontend\views\layouts',
            'successUrl' => '/checkout/pay', //Страница, куда попадает пользователь после успешного заказа
            'adminNotificationEmail' => 'info@nrk87.com', //Мыло для отправки заказов
            'as order_filling' => 'dvizh\order\behaviors\OrderFilling',
            'showCountColumn' => false,
            'orderStatuses' => [
                'new' => 'Новый',
                'approve' => 'Подтвержден',
                'paid' => 'Оплачен',
                'cancel' => 'Отменен',
                'process' => 'В обработке', 
                'done' => 'Выполнен',
            ],
            'superadminRole' => 'admin',
            'orderColumns' => [
                'client_name',
                'phone',
                'email',
                'shipping_type_id',
            ],
            'robotEmail' => 'noreply@nrk87.com',
            'robotName' => 'NRK87.',
            'adminNotificationEmail' => true,
            'clientEmailNotification' => true,
        ],

    ],
    'components' => [
        /*
        'request' => [
            'baseUrl' => '',
            'class' => 'klisl\languages\Request',
        ],
        */


        'cache' => [
            'class' => 'yii\caching\FileCache',
            // 'class' => 'yii\caching\DummyCache',
        ],
        
        /*
        // перевод через файлы
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    // 'basePath' => '@app/messages',
                    // 'enableCaching' => false,
                    // 'forceTranslation' => true,
                    // 'sourceLanguage' => 'ru',
                    'fileMap' => [
                        'app' => 'app.php',
                    ],
                ],
            ],
        ],
        */
        
        
        // интернационализация через базу данных
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'forceTranslation' => true,
                    'sourceMessageTable' => '{{%source_message}}',
                    'messageTable' => '{{%message}}',
                    'enableCaching' => false,
                    // 'cachingDuration' => 3600,
                    'sourceLanguage' => 'ru'
                ],
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'forceTranslation' => true,
                    'sourceMessageTable' => '{{%source_message}}',
                    'messageTable' => '{{%message}}',
                    'enableCaching' => false,
                    // 'cachingDuration' => 3600,
                    'sourceLanguage' => 'ru'
                ],
            ],
        ],
        
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // 'class' => 'klisl\languages\UrlManager',
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
                'normalizeTrailingSlash' => true,
                'collapseSlashes' => true,
            ],
            // 'rules' => [
                // 'languages' => 'languages/default/index',
                // '/' => 'site/index',
                // '<module:\w+>/<controller:\w+>/<action:(\w|-)+>' => '<module>/<controller>/<action>',
                // '<module:\w+>/<controller:\w+>/<action:(\w|-)+>/<id:\d+>' => '<module>/<controller>/<action>',
                // 'admin/user/admin' => 'user/admin',
                // '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                // '<controller:\w+>' => '<controller>/index',
            // ]
        ],
        
        

        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // 'defaultRoles' => ['guest', 'user'],
        ],
        
		'formatter' => [
			'dateFormat' => 'dd.MM.yyyy',
            'defaultTimeZone' => 'Europe/Moscow',
            'timeZone' => 'Europe/Moscow',
            'timeFormat' => 'HH:mm',
			// 'decimalSeparator' => ',',
			// 'thousandSeparator' => ' ',
			// 'currencyCode' => 'RUB',
            'numberFormatterOptions' => [
                NumberFormatter::MIN_FRACTION_DIGITS => 0,
                NumberFormatter::MAX_FRACTION_DIGITS => 0,
            ],
            // 'numberFormatterSymbols' => [
                // NumberFormatter::CURRENCY_SYMBOL => '&#8364;',
            // ],
            'language' => 'ru'
		],
        
        'fileStorage' => [
            'class' => '\trntv\filekit\Storage',
            // 'baseUrl' => '@storageUrl/source',
            'baseUrl' => Yii::$app->urlManager->hostInfo . '/images/source',
            'filesystem'=> function() {
                $adapter = new \League\Flysystem\Adapter\Local(dirname(dirname(__DIR__)).'/frontend/web/images/source');
                return new League\Flysystem\Filesystem($adapter);
            },
        ],
        
        'cart' => [
            'class' => 'dvizh\cart\Cart',
            'currency' => 'р.',
            'currencyPosition' => 'after',
            'priceFormat' => [2, '.', ''],
        ],
        
        'treeSettings' => [
            'class' => 'dvizh\tree\TreeSettings',
            'models' => [
                '\dvizh\shop\models\Category' => [
                    'orderField' => 'sort asc',
                ],
            ],
        ],
        
    ],
];


return $config;