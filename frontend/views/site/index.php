<?php
    use yii\web\View;
    use yii\helpers\Url;
    use yii\helpers\Html;
    
    $title = Yii::$app->name;

    $this->title = Yii::$app->params['title'] ?: $title;
    
    $this->registerCss("


        #pagecontent {
            margin-top: 0 !important;
        }
        
        @keyframes arrow {
            0% {
                transform: matrix(1,0,0,1,0,0);
                animation-timing-function: linear;
            }
            100% {
                transform: matrix(1,0,0,1,0,20);
            }
        }
        
        @keyframes spaceship1 {
            0% {
                transform: matrix(1,0,0,1,0,0);
                opacity: 1;
                animation-timing-function: linear;
            }
            100% {
                transform: matrix(0.001,0,0,0.001,437,-82);
                opacity: 1;
            }
        }
        
        @keyframes spaceship2 {
            0% {
                transform: matrix(1,0,0,1,0,0);
                opacity: 1;
                animation-timing-function: linear;
            }
            100% {
                transform: matrix(0.001,0,0,0.001,-181,-145);
                opacity: 1;
            }
        }

        @keyframes spaceship3 {
            0% {
                transform: matrix(1,0,0,1,0,0);
                opacity: 1;
                animation-timing-function: linear;
            }
            100% {
                transform: matrix(0.001,0,0,0.001,-457,-275);
                opacity: 1;
            }
        }

    ");

?>




	<div id="sliderModal" class="modal fade show" tabindex="-1" role="dialog" aria-modal="true" aria-hidden="false" data-slide="0">
		<div class="modal-dialog modal-dialog-centered m-0" style="max-width: 100vw !important;">
			<div class="modal-content">
				<div class="modal-body p-0">
					<div class="btn-modal-close rounded-circle overflow-hidden" data-dismiss="modal" style="
						top: 0.5em;
						right: 0.5em;
					">
						<svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg"><line x1="1.49418" y1="0.738243" x2="39.6779" y2="38.922" stroke="white"></line><line x1="0.787072" y1="38.9223" x2="38.9708" y2="0.73856" stroke="white"></line></svg>
						<svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg"><line x1="1.49418" y1="0.738243" x2="39.6779" y2="38.922" stroke="black"></line><line x1="0.787072" y1="38.9223" x2="38.9708" y2="0.73856" stroke="black"></line></svg>
					</div>
					
				<!--
					<div class="position-relative vw-100 vh-100">
						<?= Html::img('/images/main/endless_search_3_mobile.jpg', [
								'class' => 'd-sm-none',
								'style' => '
									object-fit: cover;
									width: 100%;
									height: 100%;
									pointer-events: none;
								',
							])
						?>
						<?= Html::img('/images/main/endless_search_3.jpg', [
								'class' => 'd-none d-sm-block',
								'style' => '
									object-fit: cover;
									width: 100%;
									height: 100%;
									pointer-events: none;
								',
							])
						?>
						<?= Html::a(Html::tag('span') . Yii::t('front', 'Посмотреть каталог'), [
								'/catalog'
							], [
								'title' => Yii::t('front', 'Посмотреть каталог'),
								'class' => 'btn btn-nrk',
								'style' => '
									position: absolute;
									top: 65%;
									right: 10%;
								',
							])
						?>
					</div>
				-->
					
					<div id="mainpageSlider" data-loop="true" data-dots="true" data-autoplay="true">
						<div class="position-relative vw-100 vh-100" data-id="0">
							<?= Html::img('/images/main/endless_search_1.jpg', [
									'class' => 'd-none d-sm-block',
									'style' => '
										object-fit: cover;
										width: 100%;
										height: 100%;
										pointer-events: none;
									',
								])
							?>
							<?= Html::img('/images/main/endless_search_1_mobile.jpg', [
									'class' => 'd-sm-none',
									'style' => '
										object-fit: cover;
										width: 100%;
										height: 100%;
										pointer-events: none;
									',
								])
							?>
							<?= Html::a(Html::tag('span') . Yii::t('front', 'Посмотреть каталог'), [
									'/catalog'
								], [
									'title' => Yii::t('front', 'Посмотреть каталог'),
									'class' => 'btn btn-nrk d-none d-md-block',
									'style' => '
										position: absolute;
										top: 65%;
										right: 10%;
									',
								])
							?>
							<?= Html::a(Html::tag('span') . Yii::t('front', 'Посмотреть каталог'), [
									'/catalog'
								], [
									'title' => Yii::t('front', 'Посмотреть каталог'),
									'class' => 'btn btn-nrk btn-sm d-md-none',
									'style' => '
										position: absolute;
										top: 60%;
										left: 50%;
										right: auto;
										transform: translateX(-50%);
										white-space: nowrap;
									',
								])
							?>
						</div>
						<div class="position-relative vw-100 vh-100" data-id="1">
							<?= Html::img('/images/main/endless_search_2.jpg', [
									'class' => 'd-none d-sm-block',
									'style' => '
										object-fit: cover;
										width: 100%;
										height: 100%;
										pointer-events: none;
									',
								])
							?>
							<?= Html::img('/images/main/endless_search_2_mobile.jpg', [
									'class' => 'd-sm-none',
									'style' => '
										object-fit: cover;
										width: 100%;
										height: 100%;
										pointer-events: none;
									',
								])
							?>
							<?= Html::a(Html::tag('span') . Yii::t('front', 'Посмотреть каталог'), [
									'/catalog'
								], [
									'title' => Yii::t('front', 'Посмотреть каталог'),
									'class' => 'btn btn-nrk black font-weight-light d-none d-md-block',
									'style' => '
										position: absolute;
										top: 65%;
										right: 10%;
									',
								])
							?>
							<?= Html::a(Html::tag('span') . Yii::t('front', 'Посмотреть каталог'), [
									'/catalog'
								], [
									'title' => Yii::t('front', 'Посмотреть каталог'),
									'class' => 'btn btn-nrk black font-weight-light btn-sm d-md-none',
									'style' => '
										position: absolute;
										top: 60%;
										left: 50%;
										right: auto;
										transform: translateX(-50%);
										white-space: nowrap;
									',
								])
							?>
						</div>
						<div class="position-relative vw-100 vh-100" data-id="2">
							<?= Html::img('/images/main/endless_search_3.jpg', [
									'class' => 'd-none d-sm-block',
									'style' => '
										object-fit: cover;
										width: 100%;
										height: 100%;
										pointer-events: none;
									',
								])
							?>
							<?= Html::img('/images/main/endless_search_3_mobile.jpg', [
									'class' => 'd-sm-none',
									'style' => '
										object-fit: cover;
										width: 100%;
										height: 100%;
										pointer-events: none;
									',
								])
							?>
							<?= Html::a(Html::tag('span') . Yii::t('front', 'Посмотреть каталог'), [
									'/catalog'
								], [
									'title' => Yii::t('front', 'Посмотреть каталог'),
									'class' => 'btn btn-nrk d-none d-md-block',
									'style' => '
										position: absolute;
										top: 65%;
										right: 10%;
									',
								])
							?>
							<?= Html::a(Html::tag('span') . Yii::t('front', 'Посмотреть каталог'), [
									'/catalog'
								], [
									'title' => Yii::t('front', 'Посмотреть каталог'),
									'class' => 'btn btn-nrk btn-sm d-md-none',
									'style' => '
										position: absolute;
										top: 60%;
										left: 50%;
										right: auto;
										transform: translateX(-50%);
										white-space: nowrap;
									',
								])
							?>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	
	<?php
		$this->registerCss('
			#mainpageSlider .owl-dots {
				position: absolute;
				right: -1.5em;
				top: 50%;
				transform: rotate(-90deg);
			}
			#mainpageSlider .owl-dots .owl-dot span {
				background: transparent !important;
				border: 1px solid #D6D6D6 !important;
			}
			#mainpageSlider .owl-dots .owl-dot.active span {
				background: #D6D6D6 !important;
			}
			#sliderModal[data-slide="1"] .owl-dots .owl-dot span {
				border: 0.5px solid #000 !important;
			}
			#sliderModal[data-slide="1"] .owl-dots .owl-dot.active span {
				background: #000 !important;
			}
			
			#sliderModal .btn-modal-close {
				background: transparent !important;
			}
			#sliderModal .btn-modal-close svg:last-child {
				display: none;
			}
			#sliderModal[data-slide="1"] .btn-modal-close svg:first-child {
				display: none;
			}
			#sliderModal[data-slide="1"] .btn-modal-close svg:last-child {
				display: block;
			}
			
			@media (max-width: 767px){
				#sliderModal .btn-nrk {
					top: auto !important;
					bottom: 10%;
					right: 5%;
				}
			}
		');
	?>
	
	<?php
		$this->registerJs("
			$('#sliderModal').modal('show');
			$('#sliderModal').on('shown.bs.modal', function(){
				$('#mainpageSlider').addClass('owl-carousel owl-theme');
				generateOwlCarousel();
			});
			// $('#sliderModal').on('hide.bs.modal', function (event) {
				// window.scrollBy({
					// top: $('#models').offset().top,
					// behavior: 'smooth'
				// });
			// })
			
			$('#mainpageSlider').on('changed.owl.carousel', function(e){
				setTimeout(function(){
					$('#sliderModal').attr('data-slide', $('#mainpageSlider .owl-item.active > div').attr('data-id'));
				}, 1);				
			});			
		", View::POS_READY);
	?>




    <?= Html::tag('div', Html::img('/images/main/main_bg.jpg', [
            'class' => 'h-100',
            'loading' => 'lazy',
        ]), [
            'id' => 'main-bg',
            'class' => 'd-flex justify-content-center fixed-top vw-100 vh-100',
            'style' => 'z-index: 1',
            'data' => [
                0 => '
                    transform: translateY(0px);
                    opacity: 1;
                ',
                500 => '
                    transform: translateY(-100px);
                    opacity: 1;
                ',
                1000 => '
                    transform: translateY(-200px);
                    opacity: 0;
                ',
                'smooth-scrolling' => 'off',
            ],
        ])
    ?>
    
    
    <?= Html::tag('div', Html::img('/images/main/spaceship.png', [
            'class' => 'img-fluid',
            'loading' => 'lazy',
            'style' => 'transform: rotate(9deg);',
            'data' => [
                0 => '
                    opacity: 1;
                ',
                700 => '
                    opacity: 1;
                ',
                900 => '
                    opacity: 0;
                ',
                'smooth-scrolling' => 'off',
            ],
        ]), [
            'id' => 'spaceship-1',
            'style' => '
                position: absolute;
                top: 60vh;
                left: 20%;
                display: block;
                width: 10vw;
                z-index: 2;
                animation: spaceship1 99s;
            ',
        ])
    ?>

    <?= Html::tag('div', Html::img('/images/main/spaceship.png', [
            'class' => 'img-fluid',
            'loading' => 'lazy',
            'style' => 'transform: rotate(-10deg) scaleX(-1);',
            'data' => [
                0 => '
                    opacity: 1;
                ',
                700 => '
                    opacity: 1;
                ',
                900 => '
                    opacity: 0;
                ',
                'smooth-scrolling' => 'off',
            ],
        ]), [
            'id' => 'spaceship-2',
            'style' => '
                position: absolute;
                top: 55vh;
                left: 65%;
                display: block;
                width: 5vw;
                z-index: 2;
                animation: spaceship2 99s;
            ',
        ])
    ?>

    <?= Html::tag('div', Html::img('/images/main/spaceship.png', [
            'class' => 'img-fluid',
            'loading' => 'lazy',
            'style' => 'transform: rotate(-35deg) scaleX(-1);',
            'data' => [
                0 => '
                    opacity: 1;
                ',
                700 => '
                    opacity: 1;
                ',
                900 => '
                    opacity: 0;
                ',
                'smooth-scrolling' => 'off',
            ],
        ]), [
            'id' => 'spaceship-3',
            'style' => '
                position: absolute;
                top: 65vh;
                left: 70%;
                display: block;
                width: 15vw;
                z-index: 2;
                animation: spaceship3 99s;
            ',
        ])
    ?>


    <div class="fixed-top w-100" 
        style="
            z-index: 2;
            transform-origin: center top;
			pointer-events: none;
            transform: scale(0.01);
            top: 40%;
        " 
        data-0="
            transform: scale(0.01);
            top: 40%;
        " 
        data-0="
            transform: scale(0.13);
            top: 50%;
        " 
        data-100="
            transform: scale(0.25);
            top: 45%
        " 
        data-200="
            transform: scale(0.45);
            top: 40%;
        " 
        data-300="
            transform: scale(0.55);
            top: 35%;
        " 
        data-400="
            transform: scale(0.6);
            top: 30%
        "
        data-500="
            transform: scale(0.65);
            top: 25%;
        "
        data-600="
            transform: scale(0.675);
            top: 20%;
        "
        data-700="
            transform: scale(0.7);
            top: 15%;
        "
        data-800="
            transform: scale(0.725);
            top: 10%;
        "
        data-900="
            transform: scale(0.75);
            top: 5%;
        "
        data-1000="
            transform: scale(0.775);
            top: 0%;
        " 
        data-1100="
            transform: scale(0.8);
            top: -2.5%;
        " 
        data-1200="
            transform: scale(0.825);
            top: -5%;
        " 
        data-1300="
            transform: scale(0.85);
            top: -7.5%;
        " 
        data-1400="
            transform: scale(0.875);
            top: -10%;
        " 
        data-1500="
            transform: scale(0.9);
            top: -12.5%;
        " 
        data-1600="
            transform: scale(0.925);
            top: -15%;
        " 
        data-1700="
            transform: scale(0.95);
            top: -17.5%;
        " 
        data-1800="
            transform: scale(0.975);
            top: -20%;
            opacity: 1;
        " 
        data-1900="
            transform: scale(1);
            opacity: 0.5;
        "
        data-anchor-target="#models" 
        data-top="
            opacity: 0;
        "
    >
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    
                    <?= Html::img('/images/main/mars.png', [
                            'class' => 'd-block w-100',
                            'loading' => 'lazy',
                        ])
                    ?>
                    
                    <?= Html::img('/images/main/mars.gif', [
                            'class' => 'position-absolute d-block w-100',
                            'loading' => 'lazy',
                            'style' => '
                                top: -5%;
                                opacity: 0.25;
                                transform: scale(1.41);
                                transform-origin: center top;
                            ',
                        ])
                    ?>
                    
                    <?= Html::img('/images/main/mars-shadow.png', [
                            'class' => 'position-absolute d-block w-100',
                            'loading' => 'lazy',
                            'style' => '
                                top: 0;
                                transform: scale(1.5);
                                opacity: 0.25;
                            ',
                        ])
                    ?>
                    
                </div>
            </div>
        </div>
    </div>

        
    <div class="fixed-bottom w-100" 
        style="
            z-index: 1;
            transform-origin: center top;
        " 
        data-0="
            transform: scale(1);
            bottom: 0px;
            opacity: 1;
        " 
        data-400="
            transform: scale(2); 
            bottom: -400px;
            opacity: 0.5;
        "
        data-600="
            opacity: 0;
        "
    >
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    
                    <?= Html::img('/images/main/earth.png', [
                            'class' => 'd-block w-100',
                            'loading' => 'lazy',
                        ])
                    ?>
                    
                    <?= Html::img('/images/main/earth.gif', [
                            'class' => 'position-absolute d-block w-100',
                            'loading' => 'lazy',
                            'style' => '
                                top: 0;
                                opacity: .03;
                            ',
                        ])
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
    
    <div class="fixed-top w-100 d-none d-lg-block pointer-events-none">
        <div class="container-fluid">
            <div id="note1" class="row justify-content-end align-items-end mt-4 mt-lg-5 vh-25" 
                data-anchor-target="#models"
                data-bottom-top="
                    opacity: 1;
                "
                data-center-top="
                    opacity: 0;
                "
            >
                <div class="col-auto" style="
					min-width: 280px;
				">
                    <p class="acline lead line-height-1">
                        <?= Yii::t('front', 'Расстояние<br>до Марса') ?>
                    </p>
                    <p class="display-4 acline text-nowrap line-height-1">
                        <span id="distance" class="mr-1">225 000 000</span>
                        <br class="d-none d-lg-block">
                        <small><?= Yii::t('front', 'км') ?></small>
                    </p>
                </div>
            </div>
        </div>
    </div>
	
	
    <div class="fixed-bottom w-100 d-lg-none pointer-events-none" style="
		background: -moz-linear-gradient(top,  rgba(0,0,0,0) 0%, rgba(0,0,0,1) 100%);
		background: -webkit-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,1) 100%);
		background: linear-gradient(to bottom,  rgba(0,0,0,0) 0%,rgba(0,0,0,1) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00000000', endColorstr='#000000',GradientType=0 );
	"
		data-1800="
			opacity: 1;
		" 
		data-2000="
			opacity: 0;
		"
	>
        <div class="container-fluid">
            <div class="row justify-content-start align-items-center py-2">
				<div class="col-auto">
					<p class="acline line-height-1 m-0">
						<small class="acline"><?= Yii::t('front', 'Расстояние<br>до Марса') ?></small>
					</p>
				</div>
				<div class="col-auto">
					<p class="lead acline text-nowrap line-height-1 m-0">
				<?php
					$distance = 225000000;
					$height = 1800;
					for ($i = 1; $i < ($height + 2); $i++){
				?>
						<span 
							style="
								display: none;
							" 
							data-<?= ($i - 1) ?>="
								display: <?= $i == 1 ? 'inline-block' : 'none' ?>;
							" 
							data-<?= $i ?>="
								display: inline-block;
							" 
							data-<?= ($i + 1) ?>="
								display: <?= $i > $height ? 'inline-block' : 'none' ?>;
							" 
						>
							<?= Yii::$app->formatter->format($distance - (($distance / $height) * ($i-1)), 'integer') ?>
						</span>
				<?php
					}
				?>
						<small><?= Yii::t('front', 'км') ?></small>
					</p>
				</div>
            </div>
        </div>
    </div>
    

    <div class="fixed-top vw-100 vh-100 pointer-events-none" 
        style="
            background: url('/images/main/cold.gif') center center/cover no-repeat;
            z-index: 3;
            opacity: 0;
        " 
        data-smooth-scrolling="off" 
        data-anchor-target="#cold" 
        data-bottom-top="
            opacity: 0;
        " 
        data-center-top="
            opacity: 1;
        " 
        data-center-bottom="
            opacity: 1;
        " 
        data-top-bottom="
            opacity: 0;
        "
    >
		<?= Html::img('/images/main/feature1.png', [
				'style' => '
					position: absolute;
					top: 10vh;
					left: 15%;
					display: block;
					height: 85vh;
					opacity: .85;
				',
			])
		?>
    </div>
    
    <div class="fixed-top vw-100 vh-100 pointer-events-none"
        style="
            z-index: 6;
            opacity: 0;
        "
        data-smooth-scrolling="off" 
        data-anchor-target="#cold" 
        data-bottom-top="
            opacity: 0;
        " 
        data-center-top="
            opacity: 1;
        " 
        data-center-bottom="
            opacity: 1;
        " 
        data-top-bottom="
            opacity: 0;
        "
    >
        <div class="position-absolute w-100 h-100 row align-items-center">
            <div class="col-10 offset-2 col-sm-8 offset-sm-4 col-md-6 offset-md-6 col-lg-5 offset-lg-6 col-xl-4 offset-xl-6">
                <p class="display-4 acline">
                    <?= Yii::t('front', 'Теплостойкая мембрана защитит колониста от экстремального холода на Марсе') ?>
                </p>
            </div>
        </div>
    </div>
    

    <div class="fixed-top vw-100 vh-100 pointer-events-none" 
        style="
            background: url('/images/main/sand.gif') center center/cover no-repeat;
            z-index: 3;
            opacity: 0;
        " 
        data-smooth-scrolling="off" 
        data-anchor-target="#sand" 
        data-bottom-top="
            opacity: 0;
        " 
        data-center-top="
            opacity: 1;
        " 
        data-center-bottom="
            opacity: 1;
        " 
        data-top-bottom="
            opacity: 0;
        "
    >
		<?= Html::img('/images/main/feature2.png', [
				'style' => '
					position: absolute;
					top: 10vh;
					left: 15%;
					display: block;
					height: 85vh;
					opacity: .85;
				',
			])
		?>
    </div>
    
    <div class="fixed-top vw-100 vh-100 pointer-events-none"
        style="
            z-index: 6;
            opacity: 0;
        "
        data-smooth-scrolling="off" 
        data-anchor-target="#sand" 
        data-bottom-top="
            opacity: 0;
        " 
        data-center-top="
            opacity: 1;
        " 
        data-center-bottom="
            opacity: 1;
        " 
        data-top-bottom="
            opacity: 0;
        "
    >
        <div class="position-absolute w-100 h-100 row align-items-center">
            <div class="col-10 offset-2 col-sm-8 offset-sm-4 col-md-6 offset-md-6 col-lg-5 offset-lg-6 col-xl-4 offset-xl-6">
                <p class="display-4 acline">
                    <?= Yii::t('front', 'Плотная ткань мешает частицам марсианского песка попадать внутрь') ?>
                </p>
            </div>
        </div>
    </div>
    
    
    <div class="fixed-top vw-100 vh-100 pointer-events-none" 
        style="
            background: url('/images/main/rain.gif') center center/cover no-repeat;
            z-index: 3;
            opacity: 0;
        " 
        data-smooth-scrolling="off" 
        data-anchor-target="#rain" 
        data-bottom-top="
            opacity: 0;
        " 
        data-center-top="
            opacity: 1;
        " 
        data-center-bottom="
            opacity: 1;
        " 
        data-top-bottom="
            opacity: 0;
        "
    >
		<?= Html::img('/images/main/feature3.png', [
				'style' => '
					position: absolute;
					top: 10vh;
					left: 15%;
					display: block;
					height: 85vh;
					opacity: .85;
				',
			])
		?>
    </div>
    
    <div class="fixed-top vw-100 vh-100 pointer-events-none"
        style="
            z-index: 6;
            opacity: 0;
        "
        data-smooth-scrolling="off" 
        data-anchor-target="#rain" 
        data-bottom-top="
            opacity: 0;
        " 
        data-center-top="
            opacity: 1;
        " 
        data-center-bottom="
            opacity: 1;
        " 
        data-top-bottom="
            opacity: 0;
        "
    >
        <div class="position-absolute w-100 h-100 row align-items-center">
            <div class="col-10 offset-2 col-sm-8 offset-sm-4 col-md-6 offset-md-6 col-lg-5 offset-lg-6 col-xl-4 offset-xl-6">
                <p class="display-4 acline">
                    <?= Yii::t('front', 'Водостойкое покрытие обеспечивает надежную влагозащиту в любом климате') ?>
                </p>
            </div>
        </div>
    </div>
    
    
    <div class="fixed-top vw-100 vh-75 pointer-events-none" 
        style="
            background: url('/images/main/gps.gif') 25% top/contain no-repeat;
            z-index: 3;
            opacity: 0;
        " 
        data-smooth-scrolling="off" 
        data-anchor-target="#gps" 
        data-bottom-top="
            opacity: 0;
        " 
        data-center-top="
            opacity: 1;
        " 
        data-center-bottom="
            opacity: 1;
        "
        data-top="
            transform: translateY(0vh);
        " 
        data-top-bottom="
            opacity: 0;
            transform: translateY(-50vh);
        "
    >
		<?= Html::img('/images/main/feature4.png', [
				'style' => '
					position: absolute;
					top: 10vh;
					left: 12%;
					display: block;
					height: 85vh;
					opacity: .85;
				',
			])
		?>
    </div>
    
    <div class="fixed-top vw-100 vh-100"
        style="
            z-index: 6;
            opacity: 0;
        " 
        data-smooth-scrolling="off" 
        data-anchor-target="#gps" 
        data-bottom-top="
            opacity: 0;
            pointer-events: none;
        " 
        data-center-top="
            opacity: 1;
            pointer-events: all;
        " 
        data-center-bottom="
            opacity: 1;
            pointer-events: all;
        " 
        data-top="
            transform: translateY(0vh);
        " 
        data-top-bottom="
            opacity: 0;
            pointer-events: none;
            transform: translateY(-50vh);
        "
    >
        <div class="position-absolute w-100 h-100 row align-items-center">
            <div class="col-10 offset-2 col-sm-8 offset-sm-4 col-md-6 offset-md-6 col-lg-5 offset-lg-6 col-xl-4 offset-xl-6">
                <p class="display-4 acline">
                    <?= Yii::t('front', 'Метки GPS в детской коллекции помогают колонистам поддерживать постоянную связь') ?>
                </p>
                <br>
                <br>
                <?= Html::a(Html::tag('span') . Yii::t('front', 'Узнать больше'), [
                        '/gps'
                    ], [
                        'title' => Yii::t('front', 'Узнать больше'),
                        'class' => 'btn btn-nrk',
                    ])
                ?>
            </div>
            <?= Html::img('/images/main/kid2.png', [
                    'style' => '
                        position: absolute;
                        top: 33%;
                        left: 25%;
                        height: 65vh;
                        pointer-events: none;
                        z-index: -1;
                    ',
                    'loading' => 'lazy',
                ])
           ?>
        </div>
    </div>
    
    
    <?php
		// echo Html::tag('div', Html::img('/images/main/model10.png', [
            // 'style' => '
                // height: 85vh;
                // pointer-events: none;
            // ',
            // 'loading' => 'lazy',
            // 'data' => [
                // 'anchor-target' => '#sources',
                // 'smooth-scrolling' => 'off',
                // 'bottom' => '
                    // transform: translateY(0vh);
                // ',
                // 'top-bottom' => '
                    // transform: translateY(-100vh);
                // ',
            // ],
        // ]), [
            // 'class' => 'fixed-top vw-100 vh-100 d-flex justify-content-center align-items-center pointer-events-none',
            // 'style' => '
                // opacity: 0;
                // z-index: 4;
            // ',
            // 'data' => [
                // 'smooth-scrolling' => 'off',
                // 'anchor-target' => '#man',
                // 'center-top' => '
                    // opacity: 0;
                    // transform: translateX(0%) translateY(150px);
                // ',
                // 'center' => '
                    // opacity: 0;
                    // transform: translateX(0%) translateY(150px);
                // ',
                // 'top-bottom' => '
                    // opacity: 1;
                    // transform: translateX(-25%) translateY(100px);
                // ',
            // ],
        // ])
    ?>
    

    <div id="skrollr-body" class="position-relative w-100 my-5 py-5" 
        style="
            z-index: 3;
        "
    >
    
        <div class="container-fluid my-5">
            
            <div id="note2" class="row justify-content-center align-items-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 text-center">
                    <h1 class="display-3 acline">
                        <?= Yii::t('front', 'Мы живем на самой прекрасной планете. Но она, вращаясь в открытом космосе, не застрахована от климатических и других природных рисков.') ?>
                    </h1>
                </div>
            </div>
            
            <div class="row my-4 my-lg-5 py-4 py-lg-5">
                <div class="col-12 text-center py-4 py-lg-5">
                    <?= Html::img('/images/main/arrow.png', [
                            'style' => '
                                transform: matrix(1, 0, 0, 1, 0, 0);
                                width: 80px;
                                height: 50px;
                                z-index: 322;
                                animation-name: arrow;
                                animation-duration: 2s;
                                animation-delay: 0s;
                                animation-iteration-count: infinite;
                                animation-direction: alternate;
                                animation-fill-mode: none;
                                animation-play-state: running;
                            ',
                        ])
                    ?>
                </div>
            </div>
            
            
            <div id="note3" class="row justify-content-center align-items-center my-4 my-lg-5 py-4 py-lg-5" 
                data-top="opacity: 1"
                data-top-bottom="opacity: 0"
            >
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 text-center">
                    <h2 class="display-3 acline">
                        <?= Yii::t('front', 'Нам кажется, что с Землей вряд ли что-то случится, и поэтому у нас пока нет реального плана спасения цивилизации.') ?>
                    </h2>
                </div>
            </div>
            
            <div class="my-4 my-lg-5 py-4 py-lg-5">
                <br>
            </div>
            
            <div id="note4" class="row justify-content-center align-items-center my-4 my-lg-5 py-4 py-lg-5" 
                data-top="opacity: 1"
                data-top-bottom="opacity: 0"
            >
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 text-center">
                    <h3 class="display-3 acline">
                        <?= Yii::t('front', 'Колонизация Марса — это реальный план. Работая над ним, человечество ответственно подходит к своему будущему и находит новые решения и локации.') ?>
                    </h3>
                </div>
            </div>
            
            <div class="my-4 my-lg-5 py-4 py-lg-5">
                <br>
            </div>
            
            <div id="note5" class="row justify-content-center align-items-center my-4 my-lg-5" 
                data-top="opacity: 1"
                data-top-bottom="opacity: 0"
            >
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 text-center">
                    <h4 class="display-3 acline">
                        <?= Yii::t('front', 'Мы в NRK87. тоже задумываемся о будущем человечества. Поэтому создали линию одежды для первооткрывателей Красной планеты.') ?>
                    </h4>
                    <br>
                    <br>
                    <p class="lead text-center">
                        <?= Yii::t('front', '10% от доходов NRK87. перечисляется в фонд изучения Марса') ?>
                    </p>
                    <br>
                    <br>
                    <div class="text-center my-5">
                        <?= Html::a(Html::tag('span') . Yii::t('front', 'К каталогу'), [
                                '/catalog'
                            ], [
                                'title' => Yii::t('front', 'К каталогу'),
                                'class' => 'btn btn-nrk',
                            ])
                        ?>
                    </div>
                </div>
            </div>
            
        </div>
        
        
        <div id="sources" class="position-relative">
        
            <?= Html::tag('div', Html::img('/images/main/model10.png', [
                    'style' => '
                        height: 85vh;
                        pointer-events: none;
                    ',
                    'loading' => 'lazy',
                ]), [
                    'id' => 'man',
                    'class' => 'd-flex vw-100 vh-100 justify-content-center align-items-center',
                    'style' => '
                        position: absolute;
                        top: 0;
                        left: 0;
                        z-index: 5;
                        pointer-events: none;
						transform: translateX(0%) translateY(150px);
                    ',
                    // 'data' => [
                        // 'smooth-scrolling' => 'off',
                        // 'bottom-top' => '
                            // position: absolute;
                            // transform: translateX(0%) translateY(150px);
                            // opacity: 0;
                        // ',                        
                        // 'center' => '
                            // position: absolute;
                            // transform: translateX(0%) translateY(150px);
                            // opacity: 1;
                        // ',
                        // 'top' => '
                            // position: fixed;
                            // transform: translateX(0%) translateY(150px);
                            // opacity: 1;
                        // ',
                        // 'top-bottom' => '
                            // position: fixed;
                            // transform: translateX(-25%) translateY(100px);
                            // opacity: 0;
                        // ',
                    // ],
                ])
            ?>
        
            <?= Html::img('/images/main/red_bg.png', [
                    'style' => '
                        position: absolute;
                        width: 100vw;
                        min-width: 1200px;
                        pointer-events: none;
                    ',
                    'loading' => 'lazy',
                ])
            ?>
            
            <?= Html::img('/images/main/rocks.png', [
                    'style' => '
                        position: absolute;
                        width: 100vw;
                        min-width: 1200px;
                        pointer-events: none;
                    ',
                    'loading' => 'lazy',
                ])
            ?>
            
            <?= Html::img('/images/main/smoke.png', [
                    'style' => '
                        position: absolute;
                        width: 100vw;
                        min-width: 1200px;
                        pointer-events: none;
                    ',
                    'loading' => 'lazy',
                ])
            ?>
            

        
            <div class="position-absolute vw-100" style="top:0">
            
                <div class="container-fluid px-0 "
                    data-anchor-target="#mars-video" 
                    data-bottom-top="
                        opacity: 1;
                    " 
                    data-center-top="
                        opacity: 0;
                    "
                >

                    <div id="models" class="row justify-content-center no-gutters my-4 my-lg-5 py-4 py-lg-5 position-relative">
                    
                        <div class="col-12 py-4 py-lg-5" style="min-width: 800px;">
                            
                            <?= Html::img('/images/main/model1.png', [
                                    'class' => 'wow fadeIn pointer-events-none',
                                    'data-wow-delay' => '3.5s',
                                    'style' => '
                                        position: absolute;
                                        top: 245px;
                                        left: -4%;
                                        height: 35vh;
                                    ',
                                    'loading' => 'lazy',
                                ])
                            ?>
                            
                            <?= Html::img('/images/main/model3.png', [
                                    'class' => 'wow fadeIn pointer-events-none',
                                    'data-wow-delay' => '4s',
                                    'style' => '
                                        position: absolute;
                                        top: 200px;
                                        left: 31%;
                                        height: 45vh;
                                    ',
                                    'loading' => 'lazy',
                                ])
                            ?>
                            
                            <?= Html::img('/images/main/model4.png', [
                                    'class' => 'wow fadeIn pointer-events-none',
                                    'data-wow-delay' => '3s',
                                    'style' => '
                                        position: absolute;
                                        top: 200px;
                                        right: 17%;
                                        height: 45vh;
                                    ',
                                    'loading' => 'lazy',
                                ])
                            ?>
                            
                            <?= Html::img('/images/main/model5.png', [
                                    'class' => 'wow fadeIn pointer-events-none',
                                    'data-wow-delay' => '5s',
                                    'style' => '
                                        position: absolute;
                                        top: 255px;
                                        right: -3%;
                                        height: 35vh;
                                    ',
                                    'loading' => 'lazy',
                                ])
                            ?>
                            
                            <?= Html::img('/images/main/model6.png', [
                                    'class' => 'wow fadeIn pointer-events-none',
                                    'data-wow-delay' => '2.5s',
                                    'style' => '
                                        position: absolute;
                                        top: 295px;
                                        left: 5%;
                                        height: 45vh;
                                    ',
                                    'loading' => 'lazy',
                                ])
                            ?>
                            
                            <?= Html::img('/images/main/model7.png', [
                                    'class' => 'wow fadeIn pointer-events-none',
                                    'data-wow-delay' => '1.5s',
                                    'style' => '
                                        position: absolute;
                                        top: 200px;
                                        left: 15%;
                                        height: 60vh;
                                    ',
                                    'loading' => 'lazy',
                                ])
                            ?>
                            
                            <?= Html::img('/images/main/smoke.png', [
                                    'style' => '
                                        position: absolute;
                                        top: 0;
                                        left: -10%;
                                        width: 120%;
                                        pointer-events: none;
                                    ',
                                    'loading' => 'lazy',
                                ])
                            ?>
                            
                            <?= Html::img('/images/main/smoke.png', [
                                    'style' => '
                                        position: absolute;
                                        top: 0;
                                        right: -1%;
                                        width: 120%;
                                        pointer-events: none;
                                    ',
                                    'loading' => 'lazy',
                                ])
                            ?>
                            
                            <?= Html::img('/images/main/model8.png', [
                                    'class' => 'wow fadeIn pointer-events-none',
                                    'data-wow-delay' => '1s',
                                    'style' => '
                                        position: absolute;
                                        top: 220px;
                                        right: 27%;
                                        height: 60vh;
                                    ',
                                    'loading' => 'lazy',
                                ])
                            ?>
                            
                            <?= Html::img('/images/main/model9.png', [
                                    'class' => 'wow fadeIn pointer-events-none',
                                    'data-wow-delay' => '2s',
                                    'style' => '
                                        position: absolute;
                                        top: 260px;
                                        right: 8%;
                                        height: 60vh;
                                    ',
                                    'loading' => 'lazy',
                                ])
                            ?>
                            
                            <?= Html::img('/images/main/smoke.png', [
                                    'style' => '
                                        position: absolute;
                                        top: 0;
                                        left: -30%;
                                        width: 160%;
                                        pointer-events: none;
                                        transform: scaleX(-1);
                                    ',
                                    'loading' => 'lazy',
                                ])
                            ?>

                            <?= Html::img('/images/main/smoke.png', [
                                    'style' => '
                                        position: absolute;
                                        top: -100px;
                                        right: -30%;
                                        width: 160%;
                                        pointer-events: none;
                                    ',
                                    'loading' => 'lazy',
                                ])
                            ?>

                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
            
            
            <div class="vh-100"></div>
            <div class="vh-100"></div>
            
            <div id="cold" class="vh-100"></div>
            
            <div class="vh-25"></div>
            
            <div id="sand" class="vh-100"></div>
            
            <div class="vh-25"></div>
            
            <div id="rain" class="vh-100"></div>
            
            <div class="vh-25"></div>
            
            <div id="gps" class="vh-100"></div>
        
            <div class="vh-50"></div>
        
        </div>
            
        
        <div class="vh-50"></div>
        
        
        <div id="mars-video" class="position-relative vw-100 vh-100">
            
            <div id="panorama" class="position-relative overflow-hidden vw-100 vh-100">
                <iframe id="youtube-mars" src="https://www.youtube.com/embed/wE-aQO9XD1g?controls=0&showinfo=0&rel=0&autoplay=1&loop=1&mute=1&playlist=wE-aQO9XD1g&modestbranding=1&iv_load_policy=3&autohide=1&fs=0&cc_load_policy=0&disablekb=0&origin=<?= Url::home(true) ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="position-absolute vw-100 vh-100"
                    style="
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                    "
                ></iframe>
            </div>
            
            <div class="position-absolute vw-100 vh-100 pointer-events-none" style="top: 0;">
                <div class="container-fluid vw-100 vh-100">
                    <div class="row vh-100 justify-content-center">
                        <div class="col-12 col-sm-11 col-md-10 position-relative align-self-center" style="height: 70vh">
                            <div class="row justify-content-between align-items-start h-50"
                                data-anchor-target="#mars-video" 
                                data-center-top="
                                    opacity: 0;
                                    top: -100vh;
                                "
                                data-top="
                                    opacity: 1;
                                    top: 0;
                                "
                            >
                                <div class="col-4 col-md-3 col-lg-2 cursor-pointer audio" onclick="
									playPauseMarsSound('/audio/space.mp3');
									return false;
								" style="
									pointer-events: all !important;
								">
                                    <p class="lead acline">
                                        <?= Yii::t('front', 'Аудио-запись с поверхности Марса') ?>
                                    </p>
									<div style="
										width: 144px;
										height: 66px;
										overflow: hidden;
										position: relative;
									">
										<div id="soundwave" style="
											position: absolute;
											top: 0;
											left: 0;
											width: 288px;
											height: 132px;
											background-image: url('/images/main/audio.png');
											background-position: 0 0;
											bacground-repeat: repeat-x;
											background-size: 144px 66px;
										">
										</div>
									</div>
                                </div>
                                <div class="col-4 col-md-3 col-lg-2">
                                    <p class="lead acline text-center">
                                        <?= Yii::t('front', 'Вы можете покрутить панораму') ?>
                                    </p>
                                </div>
                                <div class="col-4 col-md-3 col-lg-2">
                                    <div class="display-3 acline text-right">
                                        12:32
                                    </div>
                                    <div class="display-4 acline text-right">
                                        <?= Yii::t('front', 'Лето') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-between align-items-end h-50 position-absolute"
                                data-anchor-target="#mars-video" 
                                data-bottom-top="
                                    opacity: 0;
                                    bottom: 100vh;
                                    transform: translateY(-50vh);
                                "
                                data-center-top="
                                    opacity: 1;
                                    bottom: 0;
                                    transform: translateY(0);
                                "
                            >
                                <div class="col-12 col-lg-3 col-xl-2 text-right order-lg-last">
                                    <?= Html::img('/images/main/temp.png', [
                                            'class' => 'img-fluid',
                                            'style' => '
                                                max-width: 200px;
                                            ',
                                            'data' => [
                                                'anchor-target' => '#mars-video',
                                                'center-top' => '
                                                    opacity: 0;
                                                ',
                                                'top' => '
                                                    opacity: 1;
                                                ',
                                            ],
                                        ])
                                    ?>
                                </div>
                                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
                                    <p class="display-4 acline">
                                        <?= Yii::t('front', 'Мы знаем, что нас ждет на Марсе. И готовы принять любой вызов Красной планеты.') ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <!--
        <div id="show" class="position-relative vw-100 vh-100 mt-4 my-lg-5 py-4 py-lg-5 horizontal-parallax">
            <div class="position-absolute vw-100 vh-100">
                <div class="row mt-2 mt-lg-5 pt-2 pt-lg-5 position-relative vh-100 justify-content-center justify-content-lg-start">
                    <div class="position-absolute col-12 col-sm-11 col-md-10 col-lg-9 col-xl-8" style="min-width: 1000px;">
                        <?= Html::img('/images/main/show.png', [
                                'class' => 'img-fluid',
                            ])
                        ?>
                    </div>
                    <?= Html::img('/images/main/smoke.png', [
                            'style' => '
                                position: absolute;
                                left: -20%;
                                top: -20vh;
                                width: 140%;
                                min-width: 1000px;
                                pointer-events: none;
                            ',
                        ])
                    ?>
                    <?= Html::img('/images/main/smoke.png', [
                            'style' => '
                                position: absolute;
                                right: -20%;
                                top: 0;
                                width: 140%;
                                min-width: 1000px;
                                transform: scaleX(-1);
                                pointer-events: none;
                            ',
                        ])
                    ?>
                    <div class="col-11 offset-1 col-sm-10 offset-sm-2 col-md-5 offset-md-7 col-lg-4 offset-lg-7 col-xl-3 offset-xl-8 mt-5 pt-5">
                        <p class="display-4 acline">
                            <?= Yii::t('front', 'Выиграй приглашение на fashion-show NRK87.') ?>
                        </p>
                        <br>
                        <?= Html::a(Html::tag('span') . Yii::t('front', 'Участвовать'), ['/fashion-show'], [
                                'title' => Yii::t('front', 'Участвовать'),
                                'class' => 'btn btn-nrk',
                            ])
                        ?>
                    </div>
                </div>
            </div>
        </div>
        -->
        
        <div id="form" class="position-relative mb-5" 
            style="
                margin-top: 50vh;
                background: url('/images/main/stars.png') bottom center/cover no-repeat;
            "
        >
            <div class="row justify-content-center">
                <div class="col-11 col-sm-11 col-md-10 col-lg-8 col-xl-6 text-center">
                    <p class="display-4 acline">
                        <?= Yii::t('front', 'Твой путь на Марс начинается здесь.') ?>
                    </p>
                    <p class="display-4 acline">
                        <?= Yii::t('front', 'Оставь заявку на участие в экспедиции') ?>
                    </p>
                    <br>
                    <?= Html::a(Html::tag('span') . Yii::t('front', 'Перейти к форме'), ['/expedition'], [
                            'title' => Yii::t('front', 'Перейти к форме'),
                            'class' => 'btn btn-nrk',
                        ])
                    ?>
                    <?= Html::img('/images/main/meteor.png', [
                            'class' => 'wow slideInUp',
                            'style' => '
                                position: absolute;
                                top: -30vh;
                                left: calc(50% - 98px);
                                pointer-events: none;
                            ',
                            'data-wow-duration' => '20s',
                            'loading' => 'lazy',
                        ])
                    ?>
                </div>
                <div class="col-12 col-md-11 col-lg-10 col-xl-8 text-center position-relative">
                    <?= Html::img('/images/main/earth_2.png', [
                            'class' => 'img-fluid',
                            'loading' => 'lazy',
                        ])
                    ?>
                    <?= Html::img('/images/main/meteors.png', [
                            'class' => 'wow slideInUp',
                            'style' => '
                                position: absolute;
                                top: -30vh;
                                left: 0;
                                width: 100%;
                                pointer-events: none;
                            ',
                            'data-wow-duration' => '20s',
                            'loading' => 'lazy',
                        ])
                    ?>
                </div>
            </div>
            
        </div>
        
        <div style="height: 25vh"></div>
        
        <div id="step">
        
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-11 col-md-10 col-lg-9 col-xl-8 my-4 my-lg-5">
                        <h3 class="w-100 text-center">
                            <?= Yii::t('front', '21 июля 1969 года в 2 часа 56 минут 15 секунд по всемирному времени астронавт Нил Армстронг первым из землян ступил на Луну. В этот момент он произнес фразу, ставшую исторической: «Это один маленький шаг для человека, но гигантский скачок для всего человечества».') ?>
                        </h3>
                    </div>
                </div>
            </div>
            
            <div class="position-relative overflow-hidden vw-100 vh-75" 
                style="
                    background: url('/images/main/NRK87_1.gif') center center / cover no-repeat;
                "
            >
            <!--
                <iframe src="https://www.youtube.com/embed/YUUU7jDjNQU?controls=0&showinfo=0&rel=0&autoplay=1&loop=1&mute=1&playlist=YUUU7jDjNQU&modestbranding=1&iv_load_policy=3&autohide=1&fs=0&cc_load_policy=0&disablekb=0&origin=<?= Url::home(true) ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="position-absolute vw-100 vh-100"
                    style="
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        pointer-events: none !important;
                    "
                ></iframe>
            -->
            </div>
            
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-11 col-md-10 col-lg-9 col-xl-8 my-4 my-lg-5">
                        <h3 class="w-100 vh-25">
                            <span class="text-uppercase"><?= Yii::t('front', 'Ещё один шаг') ?></span> - <span id="typed" class="typed"></span>
                        </h3>
                    </div>
                </div>
            </div>
            
        </div>
        
        
    </div>







<?php
    $this->registerJs("
        skrollr.init({
            forceHeight: false,
            mobileCheck: false,
        });
    ");
?>

<?php
    $this->registerJs("
        function getDistance(){
            var distance = 225000000 - Math.round((225000000 / 2000) * $(window).scrollTop());
            $('#distance').text(distance < 0 ? 0 : distance.toLocaleString());
        }
        $(window).scroll(function(){
            getDistance();
        });
        getDistance();
    ", View::POS_READY);
?>

<?php
    $this->registerJsFile('@web/js/typed.min.js');
    $this->registerJs("
		var typed = new Typed('.typed', {
			strings: ['" . Yii::t('front', 'это следующий этап освоения Вселенной. Ещё один прорыв человечества. Новая надежда и новая идея. Ещё один шаг в будущее.') . "'],
			typeSpeed: 100,
			startDelay: 30,
			backSpeed: 20,
			smartBackspace: true,
			loop: true
		});
    ", View::POS_READY);
?>


<?php
	$this->registerJs("
		var audio = {},
			wave;
		playPauseMarsSound = function(url){
			$('.audio').toggleClass('play');
			if ('pause' in audio){
				audio.pause();
				clearInterval(wave);
			}
			audio = new Audio(url);
			audio.addEventListener('ended', function(){
				this.currentTime = 0;
				this.play();
			}, false);
			if ($('.audio').is('.play')){
				audio.play();
				wave = setInterval(function(){
					if (Math.abs(parseFloat($('#soundwave').css('left'))) > $('#soundwave').parent().width()){
						$('#soundwave').css('left', -1);
					} else {
						$('#soundwave').css('left', '-=1');
					}
				}, 30);
			}
		}
	");
?>


