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
			'label' => Yii::t('front', 'Помощь'),
			'url' => Url::to(['/help']),
			'class' => '',
		],
		[
			'label' => Yii::t('front', 'Контакты'),
			'url' => Url::to(['/contacts']),
			'class' => '',
		],
		[
			'label' => '<hr>',
			'class' => 'd-lg-none',
		],
	];
	
	if (Yii::$app->user->isGuest){
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
	
	
	// главная страница?
	$isMainpage = Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index';
	
	
	$cart = Yii::$app->cart;

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
        
        <nav id="nav" class="navbar navbar-expand-lg <?= $isMainpage ? 'navbar-dark dark' : 'navbar-light bg-white' ?> bg-transparent fixed-top py-0 mt-0_5 mt-lg-1_5 px-0_5 px-lg-0">
        
            <div id="nav-container" class="container-fluid py-1_5 px-lg-2 px-xl-3 px-xxl-5">

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
							foreach ($menuItems as $menuItem){
								$activeMenu = $menuItem['url'] == Url::to();
						?>
								<li class="nav-item mr-lg-1 mr-xl-2 mr-xxl-3 <?= $menuItem['class'] ?> <?= $activeMenu ? 'active' : '' ?>">
								<?php
									if ($menuItem['url']){
								?>
										<a href="<?= $menuItem['url'] ?>" class="nav-link text-uppercase px-0 pb-0 <?= $activeMenu ? 'text-underline' : 'text-decoration-none' ?>"
											<?php 
												if (isset($menuItem['options'])){
													foreach ($menuItem['options'] as $optionKey => $optionVal){
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
                
                <div id="logo" class="mx-auto mt-lg-0_25 navbar-brand">
                    <a href="<?= Url::home(true) ?>">
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
						if ($langs){
							foreach ($langs as $key => $lang){
								echo Html::a($lang['label'], $lang['url'], [
									'class' => 'text-uppercase text-decoration-none ml-0_5 ' . ($lang['active'] ? 'text-black' : ($isMainpage ? 'text-gray-400' : 'text-gray-500'))
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


        <div id="pagecontent" class="<?= $isMainpage ? 'mt-0' : 'mt-10 mt-lg-14' ?>">

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


        <footer class="container-fluid mt-7 px-lg-2 px-xl-3 px-xxl-5">
            
			<div class="row justify-content-between">
			
				<div class="col-12">
					<hr>
				</div>
		
				<div class="col-7 mb-5">
					<p>
						<?= Html::a(Yii::t('front', 'Каталог'), ['/catalog'], [
								'class' => 'text-uppercase text-decoration-none'
							])
						?>
					</p>
					<p>
						<?= Html::a(Yii::t('front', 'О нас'), ['/about'], [
								'class' => 'text-uppercase text-decoration-none'
							])
						?>
					</p>
					<p>
						<?= Html::a(Yii::t('front', 'Контакты'), ['/contacts'], [
								'class' => 'text-uppercase text-decoration-none'
							])
						?>
					</p>
				</div>
				
				<div class="col-5 col-md-2 order-md-last text-right">
					<a href="<?= Url::home(true) ?>">
						<?= Html::img('/images/logo_black.svg', [
								'style' => '
									width: 54px;
								',
							])
						?>
					</a>
				</div>
				
				<div class="col-10 col-md-3">
					<p>
						<?= Yii::$app->params['contacts']['full_address'][0] ?>
						<br>
						<?= Yii::$app->params['contacts']['full_address'][1] ?>
					</p>
					<br>
					<p>
						<!--
						<a href="tel:<?= preg_replace('/[D]/', '', Yii::$app->params['contacts']['phones'][0]) ?>" class="text-decoration-none"><?= Yii::$app->params['contacts']['phones'][0] ?></a>
						<br>
						-->
						<a href="tel:<?= preg_replace('/[D]/', '', Yii::$app->params['contacts']['phone']) ?>" class="text-decoration-none"><?= Yii::$app->params['contacts']['phone'] ?></a>
						<br>
						<a href="mailto:<?= Yii::$app->params['contacts']['email'] ?>" class="text-decoration-none"><?= Yii::$app->params['contacts']['email'] ?></a>
					</p>
				</div>
			</div>
			<div class="row justify-content-between">
				<div class="col-12 mt-3 mt-md-7 mb-1">
					<hr>
					<div class="row justify-content-between">
						<div class="col-12 col-lg-auto">
							<?= Html::a(Yii::t('front', 'Cookies'), ['/cookie-policy'], [
									'class' => 'text-decoration-none mr-4'
								])
							?>
							<?= Html::a(Yii::t('front', 'Privacy policy'), ['/privacy-policy'], [
									'class' => 'text-decoration-none mr-4'
								])
							?>
							<?= Html::a(Yii::t('front', 'Terms and conditions'), ['/user-agreement'], [
									'class' => 'text-decoration-none mr-4'
								])
							?>
						</div>
						<div class="col-12 col-lg-auto mt-1 mt-lg-0">
							<?= Yii::t('front', 'Designed by hell of a talanted people') ?>
						</div>
					</div>
				</div>
				
			</div>
            
        </footer>
		
		
		
		<div class="modal p-0 fade" id="menu" tabindex="-1" aria-labelledby="menuLabel" aria-hidden="true">
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
								foreach ($menuItems as $menuItem){
									$activeMenu = $menuItem['url'] == Url::to();
							?>
									<li class="nav-item <?= $menuItem['class'] ?> <?= $activeMenu ? 'active' : '' ?>">
									<?php
										if ($menuItem['url']){
									?>
											<a href="<?= $menuItem['url'] ?>" class="nav-link text-uppercase p-0 mx-1 my-1 <?= $activeMenu ? 'text-underline' : 'text-decoration-none' ?>"
												<?php 
													if ($menuItem['options']){
														foreach ($menuItem['options'] as $optionKey => $optionVal){
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
					
					<div class="modal-footer justify-content-center">
					<?php
						if ($langs){
							foreach ($langs as $key => $lang){
								echo Html::a($lang['label'], $lang['url'], [
									'class' => 'text-uppercase text-decoration-none mx-1 ' . ($lang['active'] ? 'text-black' : 'text-gray-500')
								]);
							}
						}
					?>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="modal p-0 fade" id="mini-cart" tabindex="-1" aria-labelledby="miniCartLabel" aria-hidden="true">
			<div class="modal-dialog position-absolute top-0 bottom-0 right-0 max-vw-50 border-0 m-0">
				<div class="modal-content m-0 border-0 vh-100 vw-50">
					<div class="modal-header align-items-center flex-nowrap py-md-2 pt-lg-3 pt-xl-4 pt-xxl-5 px-md-1 px-lg-2 px-xl-3">
						<span class="ttfirsneue h1 m-0 text-nowrap">
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
											'class' => 'btn btn-primary btn-block py-1 my-2 mini-cart-checkout-link',
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
            if (!Yii::$app->session->get('cookiesNotificationShown')){
        ?>
            <div id="cookiesNotification" class="fixed-bottom w-100 pb-2">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-11 col-sm-10 col-md-9 col-lg-7 col-xl-5 px-2 py-1 border bg-white text-secondary font-weight-light shadow">
                            <div class="row align-items-center justify-content-between">
                                <div class="col">
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
                                            'class' => 'btn btn-outline-secondary rounded-0 ajax',
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
