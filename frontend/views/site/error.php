<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::t('front', 'Ошибка') . ' 404 - ' . Yii::$app->name;

$this->registerCss("
	@keyframes rotation {
		0% {
			transform:rotate(0deg);
		}
		100% {
			transform:rotate(-360deg);
		}
	}
");

?>

	<div class="fixed-top fixed-bottom w-100" style="
		z-index: -1;
	">
		<div style="
			position: absolute;
			top: 0;
			right: 0;
			bottom: 0;
			left: 0;
			background: url('/images/error/stars.png') center center/cover no-repeat;
			opacity: .7;
		"></div>
		
		<div style="
			position: absolute;
			bottom: 0;
			right: 0;
			width: 50vw;
			max-width: 750px;
			height: auto;
		">
			<?= Html::img('/images/error/mars.png', [
					'id' => 'mars',
					'style' => '
						width: 100%;
						min-width: 400px;
					',
				])
			?>
			
			
		<?= Html::img('/images/error/kosmonavt.png', [
				'style' => '
					position: absolute;
					top: -4vw;
					left: -15vw;
					width: 15vw;
					min-width: 150px;
					animation-name: rotation;
					animation-duration: 60s;
					animation-iteration-count: infinite;
					animation-timing-function: linear;
				',
			])
		?>
		</div>
		

	</div>
	
	<div class="container-fluid position-relative">
	
		<div class="row">
		
			<div class="col-11 col-sm-10 col-md-7 col-lg-6 col-xl-5 offset-md-1 col-lg-4 col-xl-3">
			
				<h1 class="display-1 acline m-0" style="
					font-size: calc(13rem + 5vw);
				">404</h1>
				
				<h2 class="display-3 acline text-uppercase mt-2 mt-lg-3 mb-3 mb-lg-4">
					<?= Yii::t('front', 'Вы в открытом космосе') ?>
				</h2>
				
				<p style="
					margin-bottom: .5rem;
				">
					<?= Yii::t('front', 'Что-то пошло не так, и Вас унесло в бескрайнюю пучину.') ?>
				</p>
				
				<p>
					<?= Yii::t('front', 'Но волноваться не стоит! Отряд {0} уже летит Вам на помощь!', [
							Yii::$app->name
						])
					?>
				</p>
				
				<div>
					<?= Html::a(Html::tag('span') . Yii::t('front', 'Вернуться на Главную'), Url::home(true),[
							'class' => 'btn btn-nrk',
							'style' => '
								margin-top: 2rem;
							',
							'title' => Yii::t('front', 'Вернуться на Главную'),
							'data-pjax' => 0
						])
					?>
				</div>
				
			</div>
			
		</div>
		
	</div>

