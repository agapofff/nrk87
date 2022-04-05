<?php

    use yii\helpers\Url;
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use yii\widgets\Breadcrumbs;
    use frontend\assets\AppAsset;
    // use common\widgets\Alert;
    use yii\web\View;
    use dvizh\cart\widgets\CartInformer;
    use dvizh\cart\widgets\ElementsList;

    AppAsset::register($this);
    
    $this->registerLinkTag([
        'rel' => 'canonical',
        'href' => Url::canonical()
    ]);

    if (Yii::$app->params['title']) {
        $this->title = Yii::$app->params['title'];
    }

    if (Yii::$app->params['description']) {
        $this->registerMetaTag([
            'name' => 'description',
            'content' => Yii::$app->params['description']
        ]);
    }
    
    $this->registerMetaTag([
        'property' => 'og:title',
        'content' => $this->title
    ]);
    if (Yii::$app->params['description']) {
        $this->registerMetaTag([
            'property' => 'og:description',
            'content' => Yii::$app->params['description']
        ]);        
    }
    $this->registerMetaTag([
        'property' => 'og:locale',
        'content' => Yii::$app->language
    ]);
    $this->registerMetaTag([
        'property' => 'og:site_name',
        'content' => Yii::$app->id
    ]);
    $this->registerMetaTag([
        'property' => 'og:type',
        'content' => 'website'
    ]);
    $this->registerMetaTag([
        'property' => 'og:updated_time',
        'content' => Yii::$app->formatter->format('now', 'datetime')
    ]);
    $this->registerMetaTag([
        'property' => 'og:url',
        'content' => Url::canonical()
    ]);


    // кладём валюту текущего языка в параметры
    Yii::$app->params['currency'] = \backend\models\Langs::findOne([
        'code' => Yii::$app->language
    ])->currency;
    
    
    // получаем языки
    $langs = new cetver\LanguageSelector\items\MenuLanguageItems([
        'languages' => Yii::$app->params['languages'],
    ]);
    $langs = $langs->toArray();
    
    
    // меню
    $menuItems = [
        [
            'label' => Yii::t('front', 'О нас'),
            'url' => Url::to(['/about']),
            'class' => '',
        ],
        [
            'label' => Yii::t('front', 'Каталог'),
            'url' => Url::to(['/catalog']),
            'class' => '',
        ],
        [
            'label' => Yii::t('front', 'Новости'),
            'url' => Url::to(['/news']),
            'class' => '',
        ],
        [
            'label' => Yii::t('front', 'Контакты'),
            'url' => Url::to(['/contacts']),
            'class' => '',
        ],
        [
            'label' => Yii::t('front', 'Помощь'),
            'url' => Url::to(['/help']),
            'class' => '',
        ],
    ];
    
    $bottomMenuItems = $menuItems;
    
    $menuItems[] = [
        'label' => '<hr>',
        'class' => 'd-lg-none',
    ];
    
    if (Yii::$app->user->isGuest) {
        $menuItems[] = [
            'label' => Yii::t('front', 'Войти'),
            'url' => Url::to(['/login']),
            'class' => 'd-lg-none',
        ];
    } else {
        $menuItems[] = [
            'label' => Yii::t('front', 'Аккаунт'),
            'url' => Url::to(['/account']),
            'class' => 'd-lg-none',
        ];
        $menuItems[] = [
            'label' => Yii::t('front', 'Заказы'),
            'url' => Url::to(['/orders']),
            'class' => 'd-lg-none',
        ];
        $menuItems[] = [
            'label' => Yii::t('front', 'Избранное'),
            'url' => Url::to(['/wishlist']),
            'class' => 'd-lg-none',
        ];
        $menuItems[] = [
            'label' => Yii::t('front', 'Выйти'),
            'url' => Url::to(['/logout']),
            'class' => 'd-lg-none',
            'options' => [
                'data-method' => 'POST'
            ]
        ];
    }
    
    $controllerID = Yii::$app->controller->id;
    $actionID = Yii::$app->controller->action->id;
    
    // главная страница?
    $isMainPage = $controllerID == 'site' && $actionID == 'index';
    
    // карточка товара
    $isProductPage = $controllerID == 'product' && $actionID == 'index';
    
    $cart = Yii::$app->cart;
    
    
    // товар в подарок
    $giftData = null;
    if (Yii::$app->params['gift']) {
        $gift = \dvizh\shop\models\Product::findOne(Yii::$app->params['gift']['product_id']);
        
        $giftOptions = [];
        if ($giftCartOptions = $gift->getCartOptions()) {
            foreach ($giftCartOptions as $key => $giftCartOption) {
                foreach ($giftCartOption['variants'] as $k => $v) {
                    $giftOptions[$key] = $k;
                }
            }
        }

        $giftAttributes = $gift->getModifications()->andWhere([
            'lang' => Yii::$app->language,
            'store_type' => Yii::$app->params['store_type'],
        ])->all();

        if ($giftAttributes && !empty($giftOptions)) {
            $giftData = [
                'model' => \dvizh\shop\models\Product::className(),
                'item_id' => Yii::$app->params['gift']['product_id'],
                'count' => Yii::$app->params['gift']['count'],
                'price' => Yii::$app->params['gift']['price'],
                'options' => $giftOptions,
                'id' => $giftAttributes[0]->sku,
                'lang' => Yii::$app->language,
                'url' => Url::to(['/cart/element/create'])
            ];
            
            if (Yii::$app->params['gift']['disableAddToCart']) {
                $this->registerCss('
                    .product-content .product-buy[data-id="' . Yii::$app->params['gift']['product_id'] . '"],
                    .product-content .price-options[data-id="' . Yii::$app->params['gift']['product_id'] . '"] {
                        display: none;
                    }
                ');
            }
        }
    }

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=0"/>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="HandheldFriendly" content="true"/>
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        
        <link rel="apple-touch-icon" sizes="57x57" href="/images/favicons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/images/favicons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/images/favicons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/images/favicons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/images/favicons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/images/favicons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/images/favicons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/images/favicons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192" href="/images/favicons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/images/favicons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/favicons/favicon-16x16.png">
        <link rel="manifest" href="/images/favicons/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/images/favicons/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        
        <!-- Google Tag Manager -->
        <script>(function (w,d,s,l,i) {w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KJWR5X2');</script>
        <!-- End Google Tag Manager -->
        
        <meta name="facebook-domain-verification" content="ow656i7d8fj2k61bm0t1vsbisir0pu" />
        <meta name="yandex-verification" content="8534594848771dbc" />
        <meta name="google-site-verification" content="aBPgHR_MNoFK2chOGxm2WAUNITUDcdOrTrQ_wd2X7aA" />

        
        <?php // обработка ссылок из приложения
            $this->registerJs("
                if (window.location.hash) {
                    var params = [],
                        redirect = false,
                        url = window.location.href.split('#')[0],
                        query = window.location.hash.substring(1).replace('&amp;', '&').split('&');
                        
                    for (var i = 0; i < query.length; i++) {
                        var params = query[i].split('=');
                        if (params[0] === 'store') {
                            url = url.includes('?') ? url + '&store=' + params[1] : url + '?store=' + params[1];
                            redirect = true;
                        }
                        if (params[0] === 'id') {
                            url = url.includes('?') ? url + '&promo=' + params[1] : url + '?promo=' + params[1];
                            redirect = true;
                        }
                    }
                    
                    if (redirect) {
                        window.location.href = url;
                    }
                }
            ",
            View::POS_HEAD);
        ?>
        
        <?php
            if (Yii::$app->language != 'ru') {
        ?>
                <meta name="yandex" content="noindex" />
        <?php
            }
        ?>
        
        <script src="https://api-maps.yandex.ru/2.1/?apikey=ba64904a-6f6b-42da-82b6-4483c98a8114&lang=ru_RU" type="text/javascript"></script>
        
    </head>
    <body 
        data-c="<?= $controllerID ?>" 
        data-a="<?= $actionID ?>" 
<?php
    if ($giftData) {
?>
        data-gift="<?= base64_encode(json_encode($giftData)) ?>"
<?php
    }
?>
        class="position-relative">
    
        <div id="fade" class="fixed-top vw-100 vh-100 bg-white"></div>
        
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KJWR5X2"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        
    <?php $this->beginBody() ?>
        
        <nav id="nav" class="navbar navbar-expand-lg <?= $isMainPage ? 'navbar-dark dark' : 'navbar-light' ?> bg-transparent fixed-top py-0 mt-0_5 mt-lg-1 px-0_5 px-lg-0">
        
            <div id="nav-container" class="container-fluid py-2 py-lg-3 px-lg-2 px-xl-3 px-xxl-5">

                <button class="btn btn-link text-decoration-none p-0 d-lg-none" type="button" data-toggle="modal" data-target="#menu" aria-label="<?= Yii::t('front', 'Меню') ?>">
                    <span class="white">
                        <svg width="23" height="15" viewBox="0 0 23 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <line y1="0.5" x2="23" y2="0.5" stroke="white"/>
                            <line y1="7.5" x2="23" y2="7.5" stroke="white"/>
                            <line y1="14.5" x2="23" y2="14.5" stroke="white"/>
                        </svg>
                    </span>
                    <span class="black">
                        <svg width="23" height="15" viewBox="0 0 23 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <line y1="0.5" x2="23" y2="0.5" stroke="black"/>
                            <line y1="7.5" x2="23" y2="7.5" stroke="black"/>
                            <line y1="14.5" x2="23" y2="14.5" stroke="black"/>
                        </svg>
                    </span>
                </button>

                <div class="d-none d-lg-block mr-auto">
                    <ul class="nav navbar-nav">
                        <?php                            
                            foreach ($menuItems as $menuItem) {
                                $activeMenu = false;
                                if (isset($menuItem['url'])) {
                                    $activeMenu = $menuItem['url'] == Url::to();
                                }
                        ?>
                                <li class="nav-item mr-lg-1 mr-xl-2 mr-xxl-3 <?= $menuItem['class'] ?> <?= $activeMenu ? 'active' : '' ?>">
                                <?php
                                    if (isset($menuItem['url'])) {
                                ?>
                                        <a href="<?= $menuItem['url'] ?>" class="nav-link text-uppercase px-0 pb-0 <?= $activeMenu ? 'text-underline' : 'text-decoration-none' ?>"
                                            <?php 
                                                if (isset($menuItem['options'])) {
                                                    foreach ($menuItem['options'] as $optionKey => $optionVal) {
                                                        echo $optionKey . '="' . $optionVal . '" ';
                                                    }
                                                }
                                            ?>
                                        >
                                            <?= $menuItem['label'] ?>
                                        </a>
                                <?php
                                    } else {
                                        echo $menuItem['label'];
                                    }
                                ?>
                                </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
                
                <div id="logo" class="mx-auto navbar-brand d-flex h-100 align-items-center">
                    <a href="<?= Url::home(true) ?><?= Yii::$app->language ?>">
                        <?= Html::img('/images/logo_white.svg', [
                                'class' => 'white',
                                'style' => '
                                    width: 48px;
                                ',
                            ])
                        ?>
                        <?= Html::img('/images/logo_black.svg', [
                                'class' => 'black',
                                'style' => '
                                    width: 48px;
                                ',
                            ])
                        ?>
                    </a>
                </div>
                
                <div id="nav-lang-select" class="d-none d-lg-block ml-lg-3 ml-xl-4 ml-xxl-5">
                    <?php
                        if ($langs) {
                            foreach (array_reverse($langs) as $key => $lang) {
                                echo Html::a($lang['label'], $lang['url'], [
                                    'class' => 'text-uppercase text-decoration-none ml-0_5 ' . ($lang['active'] ? 'text-black' : ($isMainPage ? 'text-gray-400' : 'text-gray-500'))
                                ]);
                            }
                        }
                    ?>
                </div>
                
                <div id="nav-user-icon" class="d-none d-lg-block ml-lg-3 ml-xl-4 ml-xxl-5 p-0_25 rounded-pill <?= Yii::$app->user->isGuest ? '' : 'border' ?>">
                    <a href="<?= Yii::$app->user->isGuest ? Url::to(['/login']) : Url::to(['/account']) ?>">
                        <span class="white">
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.4997 11.5296C5.43859 11.5296 0.507324 16.461 0.507324 22.5221C0.507324 22.7859 0.721453 23 0.985271 23C1.24909 23 1.46322 22.7859 1.46322 22.5221C1.46322 16.9876 5.96533 12.4855 11.4998 12.4855C17.0342 12.4855 21.5364 16.9876 21.5364 22.5221C21.5364 22.7859 21.7505 23 22.0143 23C22.2781 23 22.4922 22.7859 22.4922 22.5221C22.4922 16.46 17.5609 11.5296 11.4997 11.5296Z" fill="white"/>
                                <path d="M11.4999 0C8.60172 0 6.24268 2.3581 6.24268 5.25723C6.24268 8.15637 8.60176 10.5145 11.4999 10.5145C14.3981 10.5145 16.7571 8.15637 16.7571 5.25723C16.7571 2.3581 14.3981 0 11.4999 0ZM11.4999 9.55862C9.12841 9.55862 7.19852 7.62873 7.19852 5.25723C7.19852 2.88574 9.12841 0.955849 11.4999 0.955849C13.8714 0.955849 15.8013 2.88574 15.8013 5.25723C15.8013 7.62873 13.8714 9.55862 11.4999 9.55862Z" fill="white"/>
                            </svg>
                        </span>
                        <span class="black">
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.5002 11.5296C5.43908 11.5296 0.507812 16.461 0.507812 22.5221C0.507812 22.7859 0.721941 23 0.985759 23C1.24958 23 1.46371 22.7859 1.46371 22.5221C1.46371 16.9876 5.96582 12.4855 11.5003 12.4855C17.0347 12.4855 21.5368 16.9876 21.5368 22.5221C21.5368 22.7859 21.751 23 22.0148 23C22.2786 23 22.4927 22.7859 22.4927 22.5221C22.4927 16.46 17.5614 11.5296 11.5002 11.5296Z" fill="black"/>
                                <path d="M11.5004 0C8.60221 0 6.24316 2.3581 6.24316 5.25723C6.24316 8.15637 8.60225 10.5145 11.5004 10.5145C14.3985 10.5145 16.7576 8.15637 16.7576 5.25723C16.7576 2.3581 14.3986 0 11.5004 0ZM11.5004 9.55862C9.1289 9.55862 7.19901 7.62873 7.19901 5.25723C7.19901 2.88574 9.1289 0.955849 11.5004 0.955849C13.8719 0.955849 15.8018 2.88574 15.8018 5.25723C15.8018 7.62873 13.8719 9.55862 11.5004 9.55862Z" fill="black"/>
                            </svg>
                        </span>
                    </a>
                </div>
                
                <div id="nav-wishlist-icon" class="ml-auto mr-2 ml-lg-3 mr-lg-0 ml-xl-4 ml-xxl-5 p-0_25">
                    <a href="<?= Url::to(['/wishlist']) ?>">
                        <span class="white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" class="bi bi-heart" viewBox="0 0 16 16">
                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" fill="white"/>
                            </svg>
                        </span>
                        <span class="black">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="none" class="bi bi-heart" viewBox="0 0 16 16">
                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" fill="black"/>
                            </svg>
                        </span>
                    </a>
                </div>
                
                <div id="nav-cart-icon" class="ml-lg-3 ml-xl-4 ml-xxl-5">
                    <button type="button" class="btn btn-link text-decoration-none p-0" data-toggle="modal" data-target="#mini-cart" aria-label="<?= Yii::t('front', 'Корзина') ?>">
                        <span class="white">
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_797_389)">
                                <path d="M21.387 5.43742H16.4725V0.755749C16.4725 0.547661 16.3037 0.378778 16.0956 0.378778H6.90353C6.69544 0.378778 6.52656 0.547661 6.52656 0.755749V5.43742H1.61268C1.41665 5.43742 1.25139 5.59062 1.23691 5.78604L0.00105417 22.2165C-0.00678681 22.3208 0.0294023 22.4246 0.0999711 22.5C0.17054 22.5772 0.271266 22.6212 0.376818 22.6212H22.6235C22.729 22.6212 22.8298 22.5772 22.8997 22.5006C22.9709 22.4246 23.0071 22.3209 22.9992 22.2159L21.7634 5.78604C21.7489 5.59062 21.5836 5.43742 21.387 5.43742ZM16.0956 7.8265C16.2862 7.8265 16.4412 7.98091 16.4412 8.1703C16.4412 8.36029 16.2862 8.5153 16.0956 8.5153C15.905 8.5153 15.75 8.36029 15.75 8.1703C15.75 7.98091 15.905 7.8265 16.0956 7.8265ZM7.2805 1.13332H15.7186V5.43802H7.2805V1.13332ZM6.90353 7.8265C7.09412 7.8265 7.24913 7.98091 7.24913 8.1703C7.24913 8.36029 7.09412 8.5153 6.90353 8.5153C6.71293 8.5153 6.55792 8.36029 6.55792 8.1703C6.55792 7.98091 6.71293 7.8265 6.90353 7.8265ZM0.782739 21.8679L1.9619 6.19196H6.52656V7.14373C6.10616 7.29814 5.80398 7.69863 5.80398 8.1709C5.80398 8.77707 6.29736 9.26984 6.90353 9.26984C7.5097 9.26984 8.00307 8.77707 8.00307 8.1709C8.00307 7.69863 7.70089 7.29814 7.2805 7.14373V6.19196H15.7186V7.14373C15.2982 7.29814 14.996 7.69863 14.996 8.1709C14.996 8.77707 15.4894 9.26984 16.0956 9.26984C16.7017 9.26984 17.1951 8.77707 17.1951 8.1709C17.1951 7.69863 16.8929 7.29814 16.4725 7.14373V6.19196H21.0378L22.217 21.8679H0.782739Z" fill="white" stroke="white" stroke-width="0.2"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_797_389">
                                <rect width="23" height="23" fill="white"/>
                                </clipPath>
                                </defs>
                            </svg>
                        </span>
                        <span class="black">
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_773_50)">
                                <path d="M21.387 5.43742H16.4725V0.755749C16.4725 0.547661 16.3037 0.378778 16.0956 0.378778H6.90353C6.69544 0.378778 6.52656 0.547661 6.52656 0.755749V5.43742H1.61268C1.41665 5.43742 1.25139 5.59062 1.23691 5.78604L0.00105417 22.2165C-0.00678681 22.3208 0.0294023 22.4246 0.0999711 22.5C0.17054 22.5772 0.271266 22.6212 0.376818 22.6212H22.6235C22.729 22.6212 22.8298 22.5772 22.8997 22.5006C22.9709 22.4246 23.0071 22.3209 22.9992 22.2159L21.7634 5.78604C21.7489 5.59062 21.5836 5.43742 21.387 5.43742ZM16.0956 7.8265C16.2862 7.8265 16.4412 7.98091 16.4412 8.1703C16.4412 8.36029 16.2862 8.5153 16.0956 8.5153C15.905 8.5153 15.75 8.36029 15.75 8.1703C15.75 7.98091 15.905 7.8265 16.0956 7.8265ZM7.2805 1.13332H15.7186V5.43802H7.2805V1.13332ZM6.90353 7.8265C7.09412 7.8265 7.24913 7.98091 7.24913 8.1703C7.24913 8.36029 7.09412 8.5153 6.90353 8.5153C6.71293 8.5153 6.55792 8.36029 6.55792 8.1703C6.55792 7.98091 6.71293 7.8265 6.90353 7.8265ZM0.782739 21.8679L1.9619 6.19196H6.52656V7.14373C6.10616 7.29814 5.80398 7.69863 5.80398 8.1709C5.80398 8.77707 6.29736 9.26984 6.90353 9.26984C7.5097 9.26984 8.00307 8.77707 8.00307 8.1709C8.00307 7.69863 7.70089 7.29814 7.2805 7.14373V6.19196H15.7186V7.14373C15.2982 7.29814 14.996 7.69863 14.996 8.1709C14.996 8.77707 15.4894 9.26984 16.0956 9.26984C16.7017 9.26984 17.1951 8.77707 17.1951 8.1709C17.1951 7.69863 16.8929 7.29814 16.4725 7.14373V6.19196H21.0378L22.217 21.8679H0.782739Z" fill="black" stroke="black" stroke-width="0.2"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_773_50">
                                <rect width="23" height="23" fill="white"/>
                                </clipPath>
                                </defs>
                            </svg>
                        </span>
                        <?= CartInformer::widget([
                                'htmlTag' => 'div',
                                'cssClass' => 'dvizh-cart-informer float-right ml-0_5',
                                'text' => '{c}'
                            ]);
                        ?>
                    </button>
                
                </div>
                
            </div>
            
        </nav>


        <div id="pagecontent" class="<?= $isMainPage ? 'mt-0' : 'mt-' . ($isProductPage ? '7' : '9') . ' mt-lg-11' ?>">

            <?php 
                // echo Breadcrumbs::widget([
                    // 'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                // ]);
            ?>
            
            <?= \lavrentiev\widgets\toastr\NotificationFlash::widget([
                'options' => [
                    "closeButton" => true,
                    "debug" => false,
                    "newestOnTop" => false,
                    "progressBar" => false,
                    "positionClass" => \lavrentiev\widgets\toastr\NotificationFlash::POSITION_BOTTOM_RIGHT,
                    "preventDuplicates" => true,
                    "onclick" => null,
                    "showDuration" => "300",
                    "hideDuration" => "1000",
                    "timeOut" => "5000",
                    "extendedTimeOut" => "1000",
                    "showEasing" => "swing",
                    "hideEasing" => "linear",
                    "showMethod" => "fadeIn",
                    "hideMethod" => "fadeOut",
                    'escapeHtml' => false,
                ]
            ]) ?>

            <div id="content">
                <?= $content ?>
            </div>
            
        </div>


        <footer>
            <div class="container-fluid pt-lg-5 px-lg-2 px-xl-3 px-xxl-5">
                <div class="row justify-content-between">
                
                    <div class="col-12 my-1">
                        <hr>
                    </div>
            
                    <div class="col-7">
                <?php
                    foreach ($bottomMenuItems as $menuItem) {
                ?>
                        <p>
                            <a href="<?= $menuItem['url'] ?>" class="text-uppercase text-decoration-none">
                                <?= $menuItem['label'] ?>
                            </a>
                        </p>
                <?php
                    }
                ?>
                    </div>
                    
                    <div class="col-5 col-md-2 order-md-last text-right">
                        <a href="<?= Url::home(true) ?>/<?= Yii::$app->language ?>">
                    <?php
                        if (Yii::$app->controller->id == 'blog' && Yii::$app->controller->action->id == 'index') {
                            echo Html::img('/images/logo_white.svg', [
                                    'style' => '
                                        width: 54px;
                                    ',
                                ]);                        
                        } else {
                            echo Html::img('/images/logo_black.svg', [
                                    'style' => '
                                        width: 54px;
                                    ',
                                ]);
                        }
                    ?>
                        </a>
                    </div>
                    
                    <div class="col-10 col-md-3">
                        <p class="mb-1_5 mb-lg-2">
                            <?= Yii::t('front', Yii::$app->params['contacts']['Россия']['Москва'][0]['address'][0]) ?>
                            <br>
                            <?= Yii::t('front', Yii::$app->params['contacts']['Россия']['Москва'][0]['address'][1]) ?>
                        </p>
                        <p class="m-0">
                            <!--
                            <a href="tel:<?= preg_replace('/[D]/', '', Yii::$app->params['contacts']['Россия']['phone']) ?>" class="text-decoration-none"><?= Yii::$app->params['contacts']['Россия']['Москва'][0]['phone'] ?></a>
                            <br>
                            -->
                            <a href="tel:<?= preg_replace('/[D]/', '', Yii::$app->params['contacts']['Россия']['Москва'][0]['phone']) ?>" class="text-decoration-none"><?= Yii::$app->params['contacts']['Россия']['Москва'][0]['phone'] ?></a>
                            <br>
                            <a href="mailto:<?= Yii::$app->params['contacts']['Россия']['Москва'][0]['email'] ?>" class="text-decoration-none"><?= Yii::$app->params['contacts']['Россия']['Москва'][0]['email'] ?></a>
                        </p>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-12 mb-md-0 mb-1 mb-lg-0">
                        <hr>
                    </div>
                    <div class="col-12">
                        <div class="row justify-content-between">
                            <div class="col-12 col-lg-auto">
                                <div class="row">
                                    <div class="col-12 col-md-auto mb-1">
                                        <?= Html::a(Yii::t('front', 'Файлы cookies'), [
                                                '/cookie-policy'
                                            ], [
                                                'class' => 'text-decoration-none mr-4'
                                            ])
                                        ?>
                                    </div>
                                    <div class="col-12 col-md-auto mb-1">
                                        <?= Html::a(Yii::t('front', 'Политика конфиденциальности'), [
                                                '/privacy-policy'
                                            ], [
                                                'class' => 'text-decoration-none mr-4'
                                            ])
                                        ?>
                                    </div>
                                    <div class="col-12 col-md-auto mb-1">
                                        <?= Html::a(Yii::t('front', 'Публичная оферта'), [
                                                '/public-offer'
                                            ], [
                                                'class' => 'text-decoration-none mr-4'
                                            ])
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-auto mb-1 mt-2 mt-md-0">
                                <div class="row">
                                    <div class="col-12 col-md-auto mb-1 mb-md-0">
                                        <a href="<?= Yii::$app->params['socials']['Vkontakte']['link'] ?>" target="_blank" class="text-decoration-none text-nowrap d-inline-block position-relative pl-1_5">
                                            <!--
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="22" height="22" style="
                                                position: absolute;
                                                transform: translateX(-130%);
                                            ">
                                                <path fill="none" stroke="#000" stroke-miterlimit="10" d="M7.839 11.467h.897s.271-.028.409-.167c.127-.128.123-.368.123-.368s-.018-1.126.541-1.291c.55-.163 1.257 1.087 2.006 1.568.567.364.997.284.997.284l2.003-.026s1.048-.06.551-.831c-.041-.063-.289-.57-1.489-1.611-1.256-1.09-1.088-.914.425-2.799.921-1.148 1.29-1.849 1.175-2.149-.11-.286-.787-.21-.787-.21l-2.255.013s-.167-.021-.291.048a.6.6 0 0 0-.199.226s-.357.888-.833 1.644c-1.004 1.594-1.406 1.679-1.57 1.58-.383-.231-.288-.928-.288-1.422 0-1.545.251-2.189-.488-2.356-.245-.056-.426-.092-1.053-.098-.805-.008-1.486.002-1.871.179-.257.117-.455.379-.334.394.149.019.486.085.665.313.231.294.223.954.223.954s.133 1.819-.31 2.045c-.304.155-.721-.161-1.616-1.608-.459-.741-.805-1.56-.805-1.56s-.067-.153-.186-.235c-.145-.099-.347-.131-.347-.131l-2.143.014s-.322.008-.44.139c-.105.116-.008.357-.008.357s1.678 3.67 3.578 5.52c1.742 1.695 3.72 1.584 3.72 1.584z"/>
                                            </svg>
                                            -->
                                            Vkontakte: <?= Yii::$app->params['socials']['Vkontakte']['name'] ?>
                                        </a>
                                    </div>
                                    <div class="col-12 col-md-auto mb-1 mb-md-0">
                                        <a href="<?= Yii::$app->params['socials']['Telegram']['link'] ?>" target="_blank" class="text-decoration-none text-nowrap d-inline-block position-relative pl-1_5">
                                            <!--
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" style="
                                                position: absolute;
                                                transform: translateX(-130%);
                                            ">
                                                <path d="M22.26465,2.42773a2.04837,2.04837,0,0,0-2.07813-.32421L2.26562,9.33887a2.043,2.043,0,0,0,.1045,3.81836l3.625,1.26074,2.0205,6.68164A.998.998,0,0,0,8.134,21.352c.00775.012.01868.02093.02692.03259a.98844.98844,0,0,0,.21143.21576c.02307.01758.04516.03406.06982.04968a.98592.98592,0,0,0,.31073.13611l.01184.001.00671.00287a1.02183,1.02183,0,0,0,.20215.02051c.00653,0,.01233-.00312.0188-.00324a.99255.99255,0,0,0,.30109-.05231c.02258-.00769.04193-.02056.06384-.02984a.9931.9931,0,0,0,.20429-.11456,250.75993,250.75993,0,0,1,.15222-.12818L12.416,18.499l4.03027,3.12207a2.02322,2.02322,0,0,0,1.24121.42676A2.05413,2.05413,0,0,0,19.69531,20.415L22.958,4.39844A2.02966,2.02966,0,0,0,22.26465,2.42773ZM9.37012,14.73633a.99357.99357,0,0,0-.27246.50586l-.30951,1.504-.78406-2.59307,4.06525-2.11695ZM17.67188,20.04l-4.7627-3.68945a1.00134,1.00134,0,0,0-1.35352.11914l-.86541.9552.30584-1.48645,7.083-7.083a.99975.99975,0,0,0-1.16894-1.59375L6.74487,12.55432,3.02051,11.19141,20.999,3.999Z"/>
                                            </svg>
                                            -->
                                            Telegram: <?= Yii::$app->params['socials']['Telegram']['name'] ?>
                                        </a>
                                    </div>
                                    <div class="col-12 col-md-auto mb-1 mb-md-0 d-none">
                                        <a href="<?= Yii::$app->params['socials']['Instagram']['link'] ?>" target="_blank" class="text-decoration-none text-nowrap d-inline-block position-relative pl-1_5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16" style="
                                                position: absolute;
                                                top: 2px;
                                                transform: translateX(-130%);
                                            ">
                                                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                            </svg>
                                            <?= Yii::$app->params['socials']['Instagram']['name'] ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </footer>
        
        
        
        <div class="modal side p-0 fade" id="menu" tabindex="-1" aria-labelledby="menuLabel" aria-hidden="true">
            <div class="modal-dialog position-absolute top-0 bottom-0 left-0 border-0 m-0">
                <div class="modal-content m-0 border-0 vh-100">
                    <div class="modal-header align-items-center flex-nowrap pl-1 pr-2">
                        <div class="user-icon p-0_25 m-0_5 rounded-pill <?= Yii::$app->user->isGuest ? '' : 'border border-dark' ?>">
                            <a href="<?= Yii::$app->user->isGuest ? Url::to(['/login']) : Url::to(['/account']) ?>">
                                <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.5002 11.5296C5.43908 11.5296 0.507812 16.461 0.507812 22.5221C0.507812 22.7859 0.721941 23 0.985759 23C1.24958 23 1.46371 22.7859 1.46371 22.5221C1.46371 16.9876 5.96582 12.4855 11.5003 12.4855C17.0347 12.4855 21.5368 16.9876 21.5368 22.5221C21.5368 22.7859 21.751 23 22.0148 23C22.2786 23 22.4927 22.7859 22.4927 22.5221C22.4927 16.46 17.5614 11.5296 11.5002 11.5296Z" fill="black"/>
                                    <path d="M11.5004 0C8.60221 0 6.24316 2.3581 6.24316 5.25723C6.24316 8.15637 8.60225 10.5145 11.5004 10.5145C14.3985 10.5145 16.7576 8.15637 16.7576 5.25723C16.7576 2.3581 14.3986 0 11.5004 0ZM11.5004 9.55862C9.1289 9.55862 7.19901 7.62873 7.19901 5.25723C7.19901 2.88574 9.1289 0.955849 11.5004 0.955849C13.8719 0.955849 15.8018 2.88574 15.8018 5.25723C15.8018 7.62873 13.8719 9.55862 11.5004 9.55862Z" fill="black"/>
                                </svg>
                            </a>
                        </div>
                        <button type="button" class="close p-0 float-none" data-dismiss="modal" aria-label="<?= Yii::t('front', 'Закрыть') ?>">
                            <svg width="53" height="53" viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="13.7891" y1="12.3744" x2="39.9521" y2="38.5373" stroke="black" stroke-width="2"/>
                                <line x1="12.3749" y1="38.5379" x2="38.5379" y2="12.3749" stroke="black" stroke-width="2"/>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="modal-body d-flex align-items-center">
                        <ul class="nav flex-column my-auto w-100">
                            <?php                            
                                foreach ($menuItems as $menuItem) {
                                    $activeMenu = false;
                                    if (isset($menuItem['url'])) {
                                        $activeMenu = $menuItem['url'] == Url::to();
                                    }
                            ?>
                                    <li class="nav-item <?= $menuItem['class'] ?> <?= $activeMenu ? 'active' : '' ?>">
                                    <?php
                                        if (isset($menuItem['url'])) {
                                    ?>
                                            <a href="<?= $menuItem['url'] ?>" class="nav-link text-uppercase p-0 mx-1 my-1 <?= $activeMenu ? 'text-underline' : 'text-decoration-none' ?>"
                                                <?php 
                                                    if (isset($menuItem['options'])) {
                                                        foreach ($menuItem['options'] as $optionKey => $optionVal) {
                                                            echo $optionKey . '="' . $optionVal . '" ';
                                                        }
                                                    }
                                                ?>
                                            >
                                                <?= $menuItem['label'] ?>
                                            </a>
                                    <?php
                                        } else {
                                            echo $menuItem['label'];
                                        }
                                    ?>
                                    </li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                    
                    <div class="modal-footer justify-content-between pb-2">
                <?php
                    if ($langs) {
                ?>
                        <div class="col-auto">
                            <div class="row">
                    <?php
                            foreach ($langs as $key => $lang) {
                    ?>
                                <div class="col-auto">
                                    <?= Html::a($lang['label'], $lang['url'], [
                                            'class' => 'text-uppercase text-decoration-none ml-0_5 ' . ($lang['active'] ? 'text-black' : 'text-gray-500')
                                        ]);
                                    ?>
                                </div>
                    <?php
                            }
                    ?>
                            </div>
                        </div>
                <?php
                    }
                ?>
                        <div class="col-auto">
                            <div class="row">
                                <div class="col-auto">
                                    <a href="<?= Yii::$app->params['socials']['Vkontakte']['link'] ?>" target="_blank" class="text-decoration-none text-nowrap">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="22" height="22"><path fill="none" stroke="#000" stroke-miterlimit="10" d="M7.839 11.467h.897s.271-.028.409-.167c.127-.128.123-.368.123-.368s-.018-1.126.541-1.291c.55-.163 1.257 1.087 2.006 1.568.567.364.997.284.997.284l2.003-.026s1.048-.06.551-.831c-.041-.063-.289-.57-1.489-1.611-1.256-1.09-1.088-.914.425-2.799.921-1.148 1.29-1.849 1.175-2.149-.11-.286-.787-.21-.787-.21l-2.255.013s-.167-.021-.291.048a.6.6 0 0 0-.199.226s-.357.888-.833 1.644c-1.004 1.594-1.406 1.679-1.57 1.58-.383-.231-.288-.928-.288-1.422 0-1.545.251-2.189-.488-2.356-.245-.056-.426-.092-1.053-.098-.805-.008-1.486.002-1.871.179-.257.117-.455.379-.334.394.149.019.486.085.665.313.231.294.223.954.223.954s.133 1.819-.31 2.045c-.304.155-.721-.161-1.616-1.608-.459-.741-.805-1.56-.805-1.56s-.067-.153-.186-.235c-.145-.099-.347-.131-.347-.131l-2.143.014s-.322.008-.44.139c-.105.116-.008.357-.008.357s1.678 3.67 3.578 5.52c1.742 1.695 3.72 1.584 3.72 1.584z"/></svg>
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a href="<?= Yii::$app->params['socials']['Telegram']['link'] ?>" target="_blank" class="text-decoration-none text-nowrap">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path d="M22.26465,2.42773a2.04837,2.04837,0,0,0-2.07813-.32421L2.26562,9.33887a2.043,2.043,0,0,0,.1045,3.81836l3.625,1.26074,2.0205,6.68164A.998.998,0,0,0,8.134,21.352c.00775.012.01868.02093.02692.03259a.98844.98844,0,0,0,.21143.21576c.02307.01758.04516.03406.06982.04968a.98592.98592,0,0,0,.31073.13611l.01184.001.00671.00287a1.02183,1.02183,0,0,0,.20215.02051c.00653,0,.01233-.00312.0188-.00324a.99255.99255,0,0,0,.30109-.05231c.02258-.00769.04193-.02056.06384-.02984a.9931.9931,0,0,0,.20429-.11456,250.75993,250.75993,0,0,1,.15222-.12818L12.416,18.499l4.03027,3.12207a2.02322,2.02322,0,0,0,1.24121.42676A2.05413,2.05413,0,0,0,19.69531,20.415L22.958,4.39844A2.02966,2.02966,0,0,0,22.26465,2.42773ZM9.37012,14.73633a.99357.99357,0,0,0-.27246.50586l-.30951,1.504-.78406-2.59307,4.06525-2.11695ZM17.67188,20.04l-4.7627-3.68945a1.00134,1.00134,0,0,0-1.35352.11914l-.86541.9552.30584-1.48645,7.083-7.083a.99975.99975,0,0,0-1.16894-1.59375L6.74487,12.55432,3.02051,11.19141,20.999,3.999Z"/></svg>
                                    </a>
                                </div>
                                <div class="col-auto d-none">
                                    <a href="<?= Yii::$app->params['socials']['Instagram']['link'] ?>" target="_blank" class="text-decoration-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="modal side p-0 fade" id="mini-cart" tabindex="-1" aria-labelledby="miniCartLabel" aria-hidden="true">
            <div class="modal-dialog position-absolute top-0 bottom-0 right-0 max-vw-50 border-0 m-0">
                <div class="modal-content m-0 border-0 vh-100 vw-50">
                    <div class="modal-header align-items-center flex-nowrap py-md-2 pt-lg-3 pt-xl-4 pt-xxl-5 px-md-1 px-lg-2 px-xl-3">
                        <span class="ttfirsneue h1 m-0 text-nowrap font-weight-light">
                            <?= Yii::t('front', 'Корзина') ?> (<?= CartInformer::widget([
                                    'htmlTag' => 'span',
                                    'cssClass' => 'dvizh-cart-informer',
                                    'text' => '{c}'
                                ]);
                            ?>)
                        </span>
                        <button type="button" class="close p-0 float-none" data-dismiss="modal" aria-label="<?= Yii::t('front', 'Закрыть') ?>">
                            <svg width="53" height="53" viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="13.7891" y1="12.3744" x2="39.9521" y2="38.5373" stroke="black" stroke-width="2"/>
                                <line x1="12.3749" y1="38.5379" x2="38.5379" y2="12.3749" stroke="black" stroke-width="2"/>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="modal-body px-0 h-100 overflow-scroll">
                        <div class="w-100">
                            <div class="col-12 px-md-1 px-lg-2 px-xl-3">
                                <hr class="my-1_5">                            
                                <?= ElementsList::widget([
                                        'type' => 'div',
                                        'currency' => Yii::$app->params['currency'],
                                        'lang' => Yii::$app->language,
                                    ]);
                                ?>
                            </div>
                            <div id="mini-cart-total" class="col-12 px-md-1 px-lg-2 px-xl-3 mt-2 mb-2 text-right <?= $cart->getCount() == 0 ? 'd-none' : '' ?>">
                                <?= CartInformer::widget([
                                        'currency' => Yii::$app->params['currency'],
                                        'text' => Yii::t('front', 'Итого') . ': {p}'
                                    ]);
                                ?>
                                <?= Html::a(Yii::t('front', 'Оформить заказ'), [
                                            '/checkout'
                                        ], [
                                            'class' => 'btn btn-primary btn-hover-warning btn-block py-1 my-2 mini-cart-checkout-link',
                                        ]
                                    )
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
    <?php
        if (!Yii::$app->session->get('cookiesNotificationShown')) {
            echo $this->render('@frontend/views/layouts/_cookies');
        }
    ?>
        
        
        <!-- Yandex.Metrika counter -->
        <script type="text/javascript" >
           (function (m,e,t,r,i,k,a) {m[i]=m[i]||function () {(m[i].a=m[i].a||[]).push(arguments)};
           m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
           (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

           ym(85187701, "init", {
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true,
                webvisor:true,
                ecommerce:"dataLayer"
           });
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/85187701" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->

        <script type="text/javascript">
        window.dataLayer = window.dataLayer || [];
        </script>
        
        
        
        <!-- Facebook Pixel Code -->
        <script>
        !function (f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function () {n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '323610652739800');
        fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=323610652739800&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Facebook Pixel Code -->

<?php
    if (Yii::$app->controller->id != 'checkout') {
        $this->registerJs("
            // показ корзины при изменении
            $(document).on('dvizhCartChanged', function () {
                $('#mini-cart').modal('show');
            });
        ", View::POS_READY);
    }
?>
        

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
