<?php

use yii\helpers\Html;

$this->title = Yii::t('front', 'О нас');

// $this->params['breadcrumbs'][] = $this->title;

?>

<div class="container-fluid mb-5 mt-1_5 px-lg-2 px-xl-3 px-xxl-5">
	<div class="row">
		<div class="col-12">
			<h1 class="ttfirsneue text-uppercase display-2 position-relative d-inline-block mb-0 red_dot">
				<?= Yii::t('front', 'О нас') ?>
			</h1>
		</div>
	</div>
</div>

<img src="/images/about/about0.jpg" class="d-block w-100">

<div class="container-fluid mb-7 mt-5 px-lg-2 px-xl-3 px-xxl-5">	
	<div class="row mb-6 justify-content-start">
		<div class="col-12 col-md-9">
			<h2 class="display-3 mb-0 font-weight-light">
				<?= Yii::$app->id ?> - <?= Yii::t('front', 'fashion tech wear бренд') ?>. <?= Yii::t('front', 'Для тех, кто ищет себя, ответственно и осознанно относится к нашей планете. Для тех, кто верит в технологии, а также для тех, кто мечтает прогуляться по Марсу.') ?>
			</h2>
		</div>
	</div>
</div>
