<?php
    use yii\web\View;
    use yii\helpers\Url;
    use yii\helpers\Html;
    
    $title = Yii::$app->name;

    $this->title = Yii::$app->params['title'] ?: $title;
    
	
	function getCoverId($lastId, $max){
		do {
			$id = rand(1, $max);
		} while (
			$id == $lastId
		);
		return $id;
	}
	
	$coverId = getCoverId(Yii::$app->session->get('coverId'), 6);
	$coverIdMobile = getCoverId(Yii::$app->session->get('coverIdMobile'), 4);
// echo '<div class="d-none">' . Yii::$app->session->get('coverIdMobile') . ' - ' . $coverIdMobile . '</div>';
	Yii::$app->session->set('coverId', $coverId);
	Yii::$app->session->set('coverIdMobile', $coverIdMobile);
?>

<div class="vw-100 vh-100 d-none d-md-block pointer-events-none" style="
	background: url('/images/main/banner_<?= $coverId ?>.jpg') center center / cover no-repeat;
"></div>

<div class="vw-100 vh-100 d-md-none pointer-events-none" style="
	background: url('/images/main/banner_mobile_<?= $coverIdMobile ?>.jpg') center center / cover no-repeat;
"></div>

<!--
<div class="container-fluid mb-7 pb-0_5 mt-1_5 px-lg-2 px-xl-3 px-xxl-5">
	<div class="row">
		<div class="col-8 text-uppercase">
			<?= Yii::t('front', 'Находимся в Москве') ?>
			<br>
			<?= Yii::t('front', 'Работаем по всему миру') ?>
		</div>
		<div class="col-4 text-right">
			EST.2019
		</div>
	</div>
</div>
-->

<div class="container-fluid mb-10 pt-5 pb-5 mt-1_5 px-lg-2 px-xl-3 px-xxl-5" style="
    background: url('/images/main/ellipse.png') center center /cover no-repeat;
">
	<div class="row">
		<div class="col-12">
    <?php
        $text = explode('|', Yii::t('front', 'GPS-одежда | для тех | кто мечтает | о Марсе'));
        foreach ($text as $k => $txt) {
    ?>
			<h1 class="ttfirsneue text-uppercase display-2 d-inline-block mb-0 w-100 position-relative <?= $k % 2 ? 'text-right' : 'text-left' ?>">
				<?= trim($txt) ?>
                <?php
                    if ($k == 1) {
                ?>
                        <div class="d-none d-xl-block" style="
                            position: absolute;
                            top: 40px;
                            left: 15px;
                            max-width: 400px;
                            float: left;
                            font-family: Helvetica;
                            font-size: 16px;
                            font-weight: normal;
                            line-height: 20.8px;
                            text-decoration: none;
                            text-transform: none;
                            text-align: left;
                        ">
                            <?= Yii::t('front', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ultrices dignissim lorem cursus commodo sit nunc. Dictumst purus eu odio risus, sollicitudin risus cras id. Odio egestas convallis tortor nec  lorem diam morbi convallis. Est tellus ultrices sed sagittis') ?>
                        </div>
                <?php
                    }
                ?>
			</h1>
    <?php
        }
    ?>
		</div>
	</div>
</div>

<div class="container-fluid pb-0_5 mt-1_5 px-lg-2 px-xl-3 px-xxl-5">
	<hr>
	<h2 class="h1 mt_1_5 ttfirsneue font-weight-light text-uppercase">
		<?= Html::a(Yii::t('front', 'Каталог'), ['/catalog'], [
				'class' => 'text-decoration-none'
			]);
		?>
	</h2>
</div>

<div class="container-fluid pb-0_5 mt-1_5 px-lg-2 px-xl-3 px-xxl-5 mt-4">
	<div class="row list-products justify-content-center">
	<?php
		foreach ($products as $product){
	?>
			<div class="col-12 col-md-6 mb-3 mb-md-4">
				<?= $this->render('@frontend/views/catalog/_product', [
						'model' => $product,
						'prices' => $prices,
						'prices_old' => $prices_old
					])
				?> 
			</div>
	<?php
		}
	?>
	</div>
</div>

<div class="container-fluid text-center">
	<?= Html::a(Yii::t('front', 'Смотреть еще'), ['/catalog'], [
			'class' => 'btn btn-outline-primary text-uppercase px-2 py-1'
		]);
	?>
</div>

<div class="vw-100 h-auto mt-8 mb-12 position-relative d-none d-md-block">
	<?= Html::img('/images/main/banner_6.jpg', [
			'class' => 'd-block w-100 pointer-events-none'
		])
	?>
	<div class="container-fluid position-absolute pb-0_5 mt-1_5 pl-lg-2 pl-xl-3 pl-xxl-6 pr-2 pr-lg-2 pr-xl-2 pr-xxl-0 mt-3 mt-md-4 mt-lg-5 mt-xl-6 mt-xxl-7" style="
		top: 0;
		left: 0;
	">
		<div class="row justify-content-between">
			<div class="col-md-6">
				<h3 class="h1 ttfirsneue text-uppercase text-white">
					<?= Yii::t('front', 'Кто мы') ?>
				</h3>
			</div>
			<div class="col-md-6 col-lg-5 col-xl-4 col-xxl-3">
				<p class="text-white">
					<?= Yii::t('front', 'NRK87 clothing is minimalistic, where technology, fashion relevance and principles of sustainable development intersect.') ?>
				</p>
				<p class="text-white">
					<?= Yii::t('front', 'High-tech fabrics, integrated GPS and NFC (near field communications) labels, unique color solutions, and natural graphics create a ready-made positive environment for the self-realization of those who truly care.') ?>
				</p>
				<p class="text-white">
					<?= Yii::t('front', 'For those who are looking for themselves, and responsibly and consciously relate to our planet. For those who believe in technology, and also for those who dream of walking on Mars.') ?>
				</p>
				<div class="mt-3 text-right text-xl-left">
					<?= Html::a(Yii::t('front', 'Узнать больше'), ['/about'], [
							'class' => 'btn btn-outline-primary text-uppercase text-white border-light bg-transparent px-2 py-1'
						]);
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="d-md-none mt-1_5 mb-5">
	<?= Html::img('/images/main/banner_mobile_bottom.jpg', [
			'class' => 'd-block w-100 pointer-events-none'
		])
	?>
	<div class="container-fluid mt-5">
		<hr>
		<h3 class="h1 ttfirsneue text-uppercase mb-3">
			<?= Yii::t('front', 'Кто мы') ?>
		</h3>
		<p>
			<?= Yii::t('front', 'NRK87 clothing is minimalistic, where technology, fashion relevance and principles of sustainable development intersect.') ?>
		</p>
		<p>
			<?= Yii::t('front', 'High-tech fabrics, integrated GPS and NFC (near field communications) labels, unique color solutions, and natural graphics create a ready-made positive environment for the self-realization of those who truly care.') ?>
		</p>
		<p>
			<?= Yii::t('front', 'For those who are looking for themselves, and responsibly and consciously relate to our planet. For those who believe in technology, and also for those who dream of walking on Mars.') ?>
		</p>
		<div class="text-center mt-5">
			<?= Html::a(Yii::t('front', 'Узнать больше'), ['/about'], [
					'class' => 'btn btn-outline-primary text-uppercase px-2 py-1'
				]);
			?>
		</div>
	</div>
</div>

