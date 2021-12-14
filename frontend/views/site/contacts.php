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
	<iframe src="https://snazzymaps.com/embed/349900" width="100%" height="100%" style="border:none;"></iframe>
</div>