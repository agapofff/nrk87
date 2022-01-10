<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('front', 'Контакты');

// $this->params['breadcrumbs'][] = $this->title;

?>

<div class="container-fluid mb-7 mt-1_5 px-lg-2 px-xl-3 px-xxl-5">
    
	<div class="row mb-7">
		<div class="col-12">
			<h1 class="ttfirsneue text-uppercase display-2 position-relative d-inline-block mb-0 red_dot">
				<?= Yii::t('front', 'Контакты') ?>
			</h1>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-4 col-lg-5 col-xl-6 mb-3">
			<p class="text-uppercase">
				<?= Yii::t('front', 'Часы работы') ?>
			</p>
			<p class="mb-0_5">
				<?= Yii::t('front', 'Будни') ?> 9:00 - 23:00
			</p>
			<p class="mb-0_5">
				<?= Yii::t('front', 'Выходные') ?> 9:00 - 18:00
			</p>
		</div>
		<div class="col-md-8 col-lg-7 col-xl-6">
			<div class="row">
				<div class="col-md-6 mb-3">
					<p class="text-uppercase">
						<?= Yii::t('front', 'Адрес') ?>
					</p>
					<p class="mb-0_5">
						<?= Yii::t('front', Yii::$app->params['contacts']['full_address'][0]) ?>
					</p>
					<p class="mb-0_5">
						<?= Yii::t('front', Yii::$app->params['contacts']['full_address'][1]) ?>
					</p>
				</div>
				<div class="col-md-6 mb-3">
					<p class="text-uppercase">
						<?= Yii::t('front', 'Контакты') ?>
					</p>
					<p class="mb-0_5">
						<a href="tel:<?= preg_replace('/[D]/', '', Yii::$app->params['contacts']['phone']) ?>" class="text-decoration-none"><?= Yii::$app->params['contacts']['phone'] ?></a>
					</p>
					<p class="mb-0_5">
						<a href="mailto:<?= Yii::$app->params['contacts']['email'] ?>" class="text-decoration-none"><?= Yii::$app->params['contacts']['email'] ?></a>
					</p>
				</div>
			</div>
		</div>
	</div>

</div>

<div class="mt-3 my-5 vw-100 vh-75">
	<!-- <iframe src="https://snazzymaps.com/embed/349900" width="100%" height="100%" style="border:none;"></iframe> -->
	<iframe id="contacts-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2245.6574805053137!2d37.53473712383441!3d55.74708005153804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54bdcf5c58c73%3A0x6d14c6130e7d0b31!2z0J_RgNC10YHQvdC10L3RgdC60LDRjyDQvdCw0LEuLCA2INGB0YLRgNC-0LXQvdC40LUgMiwg0JzQvtGB0LrQstCwLCAxMjMxMTI!5e0!3m2!1sru!2sru!4v1624208653877!5m2!1sru!2sru" width="100%" height="100%"></iframe>
</div>