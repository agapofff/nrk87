<?php

use yii\web\View;
use yii\helpers\Html;

$this->title = Yii::t('front', 'О нас');

// $this->params['breadcrumbs'][] = $this->title;


?>

<div class="container-fluid mt-1_5 px-lg-2 px-xl-3 px-xxl-5">
	<div class="row">
		<div class="col-12">
			<h1 class="ttfirsneue text-uppercase display-2 position-relative d-inline-block mb-0 red_dot">
				<?= Yii::t('front', 'О нас') ?>
			</h1>
		</div>
		<div class="col-12 mt-5 col-md-9 col-lg-10 col-xl-11">
			<h2 class="h2 mb-0 font-weight-light">
				<?= Yii::$app->id ?> - <?= Yii::t('front', 'fashion tech wear бренд') ?>. <?= Yii::t('front', 'Для тех, кто ищет себя, и ответственно и осознанно относится к нашей планете. Для тех, кто верит в технологии, а также для тех, кто мечтает прогуляться по Марсу.') ?>
			</h2>
		</div>
	</div>
</div>

<div id="about-earth">
    <?= Html::img('/images/about/earth.jpg', [
            'class' => 'd-block w-100',
        ])
    ?>
    <div class="container-fluid mt-1_5 px-lg-2 px-xl-3 px-xxl-5" style="
        position: absolute;
        top: 57%;
        left: 0;
        right: 0;
    ">
        <div class="row">
            <div class="col-12 col-md-10 offset-md-1 col-lg-9 offset-lg-3 col-xl-6 offset-xl-6 col-xxl-4 offet-xxl-6">
                <h2 class="ttfirsneue h2 mb-2 text-uppercase font-weight-light text-white">
                    <?= Yii::t('front', 'Земля') ?>
                </h2>
                <p class="mb-0 font-weight-light text-white">
                    <?= Yii::t('front', 'Территория личной ответственности каждого из нас. Мы полагаем, что одежда, которая максимально близко прилегает к каждому человеку, может и должна напоминать об ответственности за свою жизнь, за своих  близких за планету в целом. Поэтому мы используем технологические инновации в наших вещах и поддерживаем принципы бережного отношения к окружающей среде.') ?>
                </p>
            </div>
        </div>
    </div>
</div>

<img src="/images/about/about0.jpg" class="d-block w-100">

<div class="container-fluid mb-7 mt-5  px-lg-2 px-xl-3 px-xxl-5">	
	<div class="row mb-6 justify-content-start">
		<div class="col-12 col-md-9">
			<h2 class="h1 mb-0 font-weight-light">
				<?= Yii::t('front', 'Для тех, кто ищет себя, и ответственно и осознанно относится к нашей планете. Для тех, кто верит в технологии, а также для тех, кто мечтает прогуляться по Марсу.') ?>
			</h2>
		</div>
	</div>
	
	<div class="row justify-content-end mb-5">
		<div class="col-12 col-sm-6 col-md-4 col-lg-3">
			<p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ultrices dignissim lorem cursus commodo sit nunc. Dictumst purus eu odio risus, sollicitudin risus cras id. Odio egestas convallis tortor nec  lorem diam morbi convallis. Est tellus ultrices sed sagittis  
			</p>
		</div>
		<div class="col-12 col-sm-6 col-md-4 col-lg-3">
			<p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ultrices dignissim lorem cursus commodo sit nunc. Dictumst purus eu odio risus,  
			</p>
		</div>
	</div>
	<!-- 
	<div class="row">
		<div class="col-12">
			<div class="position-relative mb-8 mb-md-5">
				<svg width="100%" viewBox="0 0 100 70" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" class="ttfirsneue">
					<text x="0%" y="36.5" font-size="36.5" font-weight="300">AW22</text>
				</svg>
				<?= Html::img('/images/about/about1.png', [
						'style' => '
							position: absolute;
							top: 47%;
							left: 47%;
							width: 67vw;
							transform: translate(-59%, -53%);
							pointer-events: none;
						',
					])
				?>
				<div class="row justify-content-end position-absolute" style="top: 70%">
					<div class="col-12 col-md-5 col-lg-5 col-xl-4 col-xxl-3">
						<h1 class="mb-3">
							<?= Yii::t('front', 'Марс') ?>
						</h1>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ultrices dignissim lorem cursus commodo sit nunc. Dictumst purus eu odio risus, sollicitudin risus cras id. Odio egestas convallis tortor nec  lorem diam morbi convallis. Est tellus ultrices sed sagittis  
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
    -->

</div>
