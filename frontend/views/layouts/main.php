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

	if (Yii::$app->params['title']){
		$this->title = Yii::$app->params['title'];
	}

	if (Yii::$app->params['description']){
		$this->registerMetaTag([
			'name' => 'description',
			'content' => Yii::$app->params['description']
		]);
	}
	
	$this->registerMetaTag([
		'property' => 'og:title',
		'content' => $this->title
	]);
	if (Yii::$app->params['description']){
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

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="HandheldFriendly" content="true"/>
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <?php $this->head() ?>
        
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
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
				if (window.location.hash){
					var params = [],
						redirect = false,
						url = window.location.href.split('#')[0],
						query = window.location.hash.substring(1).replace('&amp;', '&').split('&');
						
					for (var i = 0; i < query.length; i++){
						var params = query[i].split('=');
						if (params[0] === 'store'){
							url = url.includes('?') ? url + '&store=' + params[1] : url + '?store=' + params[1];
							redirect = true;
						}
						if (params[0] === 'id'){
							url = url.includes('?') ? url + '&promo=' + params[1] : url + '?promo=' + params[1];
							redirect = true;
						}
					}
					
					if (redirect){
						window.location.href = url;
					}
				}
			",
			View::POS_HEAD);
		?>
		
		<?php
			if (Yii::$app->language != 'ru'){
		?>
				<meta name="yandex" content="noindex" />
		<?php
			}
		?>
        
    </head>
    <body>
	
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KJWR5X2"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        
    <?php $this->beginBody() ?>
    
        <div id="menu" class="fixed-top fixed-bottom bg-black dropdown-menu menu w-100 border-0 rounded-0 py-3 fade">
            <div class="container h-100">
                <div class="row align-items-center my-5 h-100">
                    <div class="col-12 my-5">
                        <div class="row justify-content-center mt-5 mt-lg-0">
                            <?php
                                $menuItems = [
                                    // [
                                        // 'label' => Yii::t('front', 'Для взрослых'),
                                        // 'url' => Url::to(['/catalog/adults'])
                                    // ],
                                    // [
                                        // 'label' => Yii::t('front', 'Для детей'),
                                        // 'url' => Url::to(['/catalog/kids'])
                                    // ],
                                    // [
                                        // 'label' => Yii::t('front', 'Для нее'),
                                        // 'url' => Url::to(['/catalog/women'])
                                    // ],
                                    // [
                                        // 'label' => Yii::t('front', 'Для него'),
                                        // 'url' => Url::to(['/catalog/men'])
                                    // ],
                                    // [
                                        // 'label' => Yii::t('front', 'Полет на Марс'),
                                        // 'url' => Url::to(['/fashion-show'])
                                    // ],
                                    [
                                        'label' => Yii::t('front', 'Каталог'),
                                        'url' => Url::to(['/catalog'])
                                    ],
                                    [
                                        'label' => Yii::t('front', 'LookBook'),
                                        'url' => Url::to(['/lookbook'])
                                    ],
                                    [
                                        'label' => Yii::t('front', 'О нас'),
                                        'url' => Url::to(['/about'])
                                    ],
                                    [
                                        'label' => Yii::t('front', 'О Марсе'),
                                        'url' => Url::to(['/about-mars'])
                                    ],
                                    [
                                        'label' => Yii::t('front', 'Пройти тест'),
                                        'url' => Url::to(['/test/mars'])
                                    ],
                                    [
                                        'label' => Yii::t('front', 'Scan-to-Win'),
                                        'url' => Url::to(['/scan-to-win'])
                                    ],
                                    // [
                                        // 'label' => Yii::t('front', 'Клиентская служба'),
                                        // 'url' => Url::to(['/customer-service'])
                                    // ],
                                    [
                                        'label' => Yii::t('front', 'Контакты'),
                                        'url' => Url::to(['/contacts/earth'])
                                    ],
                                    // [
                                        // 'label' => Yii::t('front', 'Экспедиция'),
                                        // 'url' => Url::to(['/expedition'])
                                    // ],
                                ];
                                
                                $i = 1;
                                foreach ($menuItems as $menuItem)
                                {
                            ?>
                                    <div class="col-12 col-sm-auto px-5 py-3 py-lg-5 text-center">
                                        <?= Html::a($menuItem['label'], $menuItem['url'], [
                                            'class' => 'main-menu-link text-decoration-none acline display-4 position-relative' . ($menuItem['url'] == Url::to() ? ' active' : '')
                                        ]) ?>
                                    </div>
                            <?php
                                    $i++;
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <nav id="nav" class="navbar navbar-expand navbar-light py-4 fixed-top bg-transparent">
        
            <div id="nav-container" class="container-fluid px-2">

                <div class="mr-auto">
                    <div class="dropdown cursor-pointer">
                        <a href="#menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="menu-toggle text-decoration-none d-flex align-items-center">
                            <svg width="56" height="8" viewBox="0 0 56 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line y1="0.5" x2="28" y2="0.5" stroke="white"/>
                                <line y1="7.39307" x2="56" y2="7.39307" stroke="white"/>
                            </svg>
                            <svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="1.49418" y1="0.738243" x2="39.6779" y2="38.922" stroke="white"/>
                                <line x1="0.787072" y1="38.9223" x2="38.9708" y2="0.73856" stroke="white"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div id="logo" class="mx-auto">
                    <a href="<?= Url::home(true) ?>">
                        <?= Html::img('/images/logo.svg', [
								'style' => '
									width: 70px;
								',
							])
						?>
                    </a>
                </div>
                
                <div class="ml-auto">
                    
                    <div class="row align-items-center justify-content-end">
                    
                        <div class="col px-2 px-md-3 px-lg-4 right">
                        <?php
                            $langs = new cetver\LanguageSelector\items\MenuLanguageItems([
                                'languages' => Yii::$app->params['languages'],
                            ]);
                            $langs = $langs->toArray();
                            if ($langs){
                        ?>
                                <div class="languages dropdown hover">
                                    <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="lead m-0">
                                        <?= Yii::$app->language ?>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right border-0 text-center mt-0 pt-0" style="min-width: 60px;
                                    margin-right: -18px;">
                                    <?php
                                        foreach ($langs as $key => $lang){
                                            if (!$lang['active']){
                                    ?>
                                                <p class="lead mb-0">
                                                    <?= Html::a($lang['label'], $lang['url']) ?>
                                                </p>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </div>
                                </div>
                        <?php
                            }
                        ?>
                        </div>
                    
                        <div class="col px-2 px-md-3 px-lg-4 text-right">
                    <?php
                        if (Yii::$app->user->isGuest){
                    ?>
                            <a href="<?= Url::to(['/login']) ?>">
                                <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.4999 11.5296C5.43875 11.5296 0.507483 16.4609 0.507483 22.522C0.507483 22.7859 0.721612 23 0.98543 23C1.24925 23 1.46338 22.7859 1.46338 22.522C1.46338 16.9876 5.96549 12.4855 11.4999 12.4855C17.0344 12.4855 21.5365 16.9876 21.5365 22.522C21.5365 22.7859 21.7506 23 22.0145 23C22.2783 23 22.4924 22.7859 22.4924 22.522C22.4924 16.46 17.561 11.5296 11.4999 11.5296Z" fill="white"/>
                                    <path d="M11.5 0C8.60181 0 6.24276 2.3581 6.24276 5.25723C6.24276 8.15637 8.60185 10.5145 11.5 10.5145C14.3981 10.5145 16.7572 8.15637 16.7572 5.25723C16.7572 2.3581 14.3982 0 11.5 0ZM11.5 9.55862C9.1285 9.55862 7.19861 7.62873 7.19861 5.25723C7.19861 2.88574 9.1285 0.955849 11.5 0.955849C13.8715 0.955849 15.8014 2.88574 15.8014 5.25723C15.8014 7.62873 13.8715 9.55862 11.5 9.55862Z" fill="white"/>
                                </svg>
                            </a>
                    <?php
                        } else {
                    ?>
                            <div class="dropdown hover">
                                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg" class="user-authorised">
                                        <path d="M11.4999 11.5296C5.43875 11.5296 0.507483 16.4609 0.507483 22.522C0.507483 22.7859 0.721612 23 0.98543 23C1.24925 23 1.46338 22.7859 1.46338 22.522C1.46338 16.9876 5.96549 12.4855 11.4999 12.4855C17.0344 12.4855 21.5365 16.9876 21.5365 22.522C21.5365 22.7859 21.7506 23 22.0145 23C22.2783 23 22.4924 22.7859 22.4924 22.522C22.4924 16.46 17.561 11.5296 11.4999 11.5296Z" fill="white"/>
                                        <path d="M11.5 0C8.60181 0 6.24276 2.3581 6.24276 5.25723C6.24276 8.15637 8.60185 10.5145 11.5 10.5145C14.3981 10.5145 16.7572 8.15637 16.7572 5.25723C16.7572 2.3581 14.3982 0 11.5 0ZM11.5 9.55862C9.1285 9.55862 7.19861 7.62873 7.19861 5.25723C7.19861 2.88574 9.1285 0.955849 11.5 0.955849C13.8715 0.955849 15.8014 2.88574 15.8014 5.25723C15.8014 7.62873 13.8715 9.55862 11.5 9.55862Z" fill="white"/>
                                    </svg>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right border-0 text-center mt-0 pt-4 px-4 user-menu">
                                    <p class="lead text-right mb-2">
                                        <?= Html::a(Yii::t('front', 'Аккаунт'), ['/account']) ?>
                                    </p>
                                    <p class="lead text-right mb-2">
                                        <?= Html::a(Yii::t('front', 'Заказы'), ['/orders']) ?>
                                    </p>
                                    <p class="lead text-right mb-2">
                                        <?= Html::a(Yii::t('front', 'Выход'), ['/logout'], ['data-method' => 'POST']) ?>
                                    </p>
                                </ul>
                            </div>
                    <?php
                        }
                    ?>
                        </div>
                    
                        <div class="col-auto pl-3 pr-2 pr-md-3 pl-md-4">
                            <div class="dropdown">
                                <a href="#cart-widget" data-toggle="dropdown" class="d-flex align-items-center justify-content-end cursor-pointer text-decoration-none">
                                    <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M21.3872 5.43742H16.4727V0.755754C16.4727 0.547667 16.3038 0.378784 16.0957 0.378784H6.90369C6.6956 0.378784 6.52672 0.547667 6.52672 0.755754V5.43742H1.61284C1.41681 5.43742 1.25155 5.59062 1.23707 5.78604L0.00121439 22.2165C-0.00662659 22.3209 0.0295625 22.4246 0.100131 22.5C0.1707 22.5772 0.271427 22.6212 0.376978 22.6212H22.6236C22.7292 22.6212 22.8299 22.5772 22.8999 22.5006C22.9711 22.4246 23.0072 22.3209 22.9994 22.2159L21.7635 5.78604C21.7491 5.59062 21.5838 5.43742 21.3872 5.43742ZM16.0957 7.82651C16.2863 7.82651 16.4413 7.98091 16.4413 8.1703C16.4413 8.3603 16.2863 8.51531 16.0957 8.51531C15.9051 8.51531 15.7501 8.3603 15.7501 8.1703C15.7501 7.98091 15.9051 7.82651 16.0957 7.82651ZM7.28066 1.13333H15.7188V5.43802H7.28066V1.13333ZM6.90369 7.82651C7.09428 7.82651 7.24929 7.98091 7.24929 8.1703C7.24929 8.3603 7.09428 8.51531 6.90369 8.51531C6.71309 8.51531 6.55808 8.3603 6.55808 8.1703C6.55808 7.98091 6.71309 7.82651 6.90369 7.82651ZM0.7829 21.8679L1.96206 6.19196H6.52672V7.14374C6.10632 7.29814 5.80414 7.69864 5.80414 8.17091C5.80414 8.77707 6.29752 9.26985 6.90369 9.26985C7.50986 9.26985 8.00323 8.77707 8.00323 8.17091C8.00323 7.69864 7.70106 7.29814 7.28066 7.14374V6.19196H15.7188V7.14374C15.2984 7.29814 14.9962 7.69864 14.9962 8.17091C14.9962 8.77707 15.4896 9.26985 16.0957 9.26985C16.7019 9.26985 17.1953 8.77707 17.1953 8.17091C17.1953 7.69864 16.8931 7.29814 16.4727 7.14374V6.19196H21.038L22.2171 21.8679H0.7829Z" fill="white" stroke="white" stroke-width="0.2"/>
                                    </svg>
                                    <?= CartInformer::widget([
                                            'htmlTag' => 'div',
                                            'cssClass' => 'dvizh-cart-informer lead mt-1 ml-2',
                                            'text' => '{c}'
                                        ]);
                                    ?>
                                </a>
                                <div id="cart-widget" class="dropdown-menu dropdown-menu-right py-3 cart-widget mt-4 fade">
                                    <?= ElementsList::widget([
                                            'type' => 'nav',
                                            'currency' => Yii::$app->params['currency'],
                                            'lang' => Yii::$app->language,
                                        ]);
                                    ?>
                                    <div class="px-4 py-1">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-12 col-sm-6 px-2">
                                                <?= CartInformer::widget([
                                                        'currency' => Yii::$app->params['currency'],
                                                    ]);
                                                ?>
                                            </div>
                                            <div class="col-12 col-sm-6 px-2 text-right">
                                                <?= Html::a(Yii::t('front', 'Оформить заказ'), ['/checkout'], [
                                                    'class' => 'btn btn-primary rounded-pill btn-minicart-checkout',
                                                ]) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    
                    </div>
                    
                </div>
                
            </div>
            
        </nav>


        <div id="pagecontent" class="mt-5 pt-5 min-vh-100">

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

            <?= $content ?>
            
        </div>


        <footer class="py-5 mt-4">
        
            <div class="container-fluid">
            
                <div class="row justify-content-start">
            
                    <div class="col">
                        <a href="<?= Url::home(true) ?>">
							<?= Html::img('/images/logo.svg', [
									'style' => '
										width: 70px;
									',
								])
							?>
                        </a>
                    </div>
            
                    <div class="col-12">
                        <hr class="border-light my-4">
                    </div>
                    
                </div>
                
                <div class="row">
            
                    <div class="col-auto mr-auto">
                        @ <?= date('Y') ?>
                    </div>
					
					<div class="col-auto">
						<a href="<?= Url::to(['/sitemap']) ?>" target="_blank">
							<?= Yii::t('front', 'Карта сайта') ?>
						</a>
					</div>

                    <div class="col-auto ml-auto text-right">
                    
                        <a href="<?= Yii::$app->params['socials']['TikTok'] ?>" target="_blank">
                            TikTok
                        </a>
                    
                        <a href="<?= Yii::$app->params['socials']['Fb'] ?>" target="_blank" class="ml-4">
                            Fb
                        </a>
                
                        <a href="<?= Yii::$app->params['socials']['Ig'] ?>" target="_blank" class="ml-4">
                            Ig
                        </a>

                        <a href="<?= Yii::$app->params['socials']['Vk'] ?>" target="_blank" class="ml-4">
                            Vk
                        </a>

                        <a href="<?= Yii::$app->params['socials']['Yt'] ?>" target="_blank" class="ml-4">
                            Yt
                        </a>
                        
                    </div>
                    
                </div>
                
            </div>
            
        </footer>
        
        <?php
            if (!Yii::$app->session->get('cookiesNotificationShown')){
        ?>
            <div id="cookiesNotification" class="fixed-bottom w-100 pb-2">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-11 col-sm-10 col-md-9 col-lg-7 col-xl-5 px-3 py-2 bg-white text-secondary font-weight-light rounded-lg">
                            <div class="row align-items-center justify-content-between">
                                <div class="col small">
									<strong>
                                        <?= Yii::t('front', 'Мы используем файлы cookie') ?>
                                    </strong>
                                    <br>
                                    <?= Yii::t('front', 'Чтобы улучшить работу сайта и предоставить вам лучший сервис.' ) ?>
                                    <?= Yii::t('front', 'Продолжая использовать сайт, вы соглашаетесь с {0} файлов cookie.', Html::a(Yii::t('front', 'условиями использования'), [
                                        '/cookie-policy'
                                    ], [
                                        'target' => '_blank',
                                        'class' => 'text-secondary',
                                        'style' => 'text-decoration: underline',
                                    ])) ?>
                                </div>
                                <div class="col-auto">
                                    <?= Html::button(Yii::t('front', 'OK'), [
                                            'id' => 'cookiesNotificationShown',
                                            'type' => 'button',
                                            'class' => 'btn btn-outline-secondary rounded-pill ajax',
                                            'data-remote' => Url::to(['/cookies-notification-shown']),
                                            'onclick' => '$("#cookiesNotification").remove();',
                                        ])
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        <?php
            }
        ?>
		
		
		<!-- Yandex.Metrika counter -->
		<script type="text/javascript" >
		   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
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
		!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
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



    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
