<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->title = Yii::$app->params['title'] ?: $title;
$h1 = Yii::$app->params['h1'] ?: $this->title;

// \yii\web\YiiAsset::register($this);

?>

<?= $this->render('@frontend/views/site/cover-socials') ?>



<?php
	foreach ($collections as $collection){
?>

		<div class="container-fluid position-relative">

			<div class="row justify-content-center my-2 my-lg-5">
			
				<div class="col-12 col-lg-11 col-xl-10 mb-2 mb-lg-5 pb-2 pb-lg-5 px-4">
				
					<div class="row align-items-center">
					
						<div class="col-12 col-sm-8 p-0 position-absolute h-100 cover <?= $collectionSlug ?> <?= $categorySlug ?>">
						
					<?php // коллекция 2020
						if ($collection['collection']->id == 9){
					?>
							<img data-src="/images/category/collection_2020_1.png" alt="<?= $title ?> <?= Yii::$app->name ?>" class="lazyload" style="
								position: absolute;
								top: 10%;
								left: 50%;
								transform: translateX(-50%);
							">
							<img data-src="/images/category/collection_2020_2.png" alt="<?= $title ?> <?= Yii::$app->name ?>" class="lazyload" style="
								position: absolute;
								top: 10%;
								left: 50%;
								transform: translateX(-50%);
							">							
					<?php
						}
					?>

					<?php // коллекция 2021 дети
						if ($collection['collection']->id == 17){
					?>
							<img data-src="/images/category/category_woman_mars.png" alt="<?= $title ?> <?= Yii::$app->name ?>" class="lazyload" style="
								position: absolute;
								top: 30%;
								left: 50%;
								transform: translateX(-30%);
							">
							<img data-src="/images/category/collection_2021_child.png" alt="<?= $title ?> <?= Yii::$app->name ?>" class="lazyload" style="
								position: absolute;
								top: 10%;
								left: 50%;
								transform: translateX(-50%);
							">							
					<?php
						}
					?>
					
					<?php // коллекция 2021
						if ($collection['collection']->id == 16 && !$categorySlug){
					?>
							<img data-src="/images/category/collection_2021_1.png" alt="<?= $title ?> <?= Yii::$app->name ?>" class="lazyload d-none d-sm-block" style="
								position: absolute;
								top: 10%;
								left: 0;
							">
							<img data-src="/images/category/collection_2021_2.png" alt="<?= $title ?> <?= Yii::$app->name ?>" class="lazyload d-none d-sm-block" style="
								position: absolute;
								top: 10%;
								left: 100%;
								transform: translateX(-90%);
							">
							<img id="collection_2021_3" data-src="/images/category/collection_2021_3.png" alt="<?= $title ?> <?= Yii::$app->name ?>" class="lazyload" style="
								position: absolute;
								top: -10%;
								left: 50%;
								transform: translateX(-35%);
							">
							
							<?php
								$this->registerCss('
									@media (max-width: 767px){
										#collection_2021_3 {
											height: 75vh;
											top: 20% !important;
											left: 55% !important;
										}
									}
								');
							?>
					<?php
						}
					?>
					
					<?php // футболки
						if ($collection['collection']->id == 16 && $category && $category->id == 18){
					?>
							<img id="tshirts" data-src="/images/category/tshirts.png" alt="<?= $title ?> <?= Yii::$app->name ?>" class="lazyload" style="
								position: absolute;
								top: -10%;
								left: 50%;
								transform: translateX(-50%);
							">
							<?php
								$this->registerCss('
									@media (max-width: 767px){
										#tshirts {
											height: 75vh;
											top: 25% !important;
											left: 65% !important;
										}
									}
								');
							?>
					<?php
						}
					?>
					
					<?php // свитшоты
						if ($collection['collection']->id == 16 && $category && $category->id == 19){
					?>
							<img id="sweatshots" data-src="/images/category/sweatshots.png" alt="<?= $title ?> <?= Yii::$app->name ?>" class="lazyload" style="
								position: absolute;
								top: -10%;
								left: 50%;
								transform: translateX(-50%);
							">
							<?php
								$this->registerCss('
									@media (max-width: 767px){
										#sweatshots {
											height: 75vh;
											top: 25% !important;
											left: 60% !important;
										}
									}
								');
							?>
					<?php
						}
					?>
					
					<?php // худи
						if ($collection['collection']->id == 16 && $category && $category->id == 20){
					?>
							<img id="hoodie" data-src="/images/category/hoodie.png" alt="<?= $title ?> <?= Yii::$app->name ?>" class="lazyload" style="
								position: absolute;
								top: -5%;
								left: 50%;
								transform: translateX(-40%);
							">
							<?php
								$this->registerCss('
									@media (max-width: 767px){
										#hoodie {
											height: 70vh;
											top: 25% !important;
											left: 55% !important;
										}
									}
								');
							?>
					<?php
						}
					?>
					
					<?php // куртки
						if ($collection['collection']->id == 16 && $category && $category->id == 21){
					?>
							<img id="jackets" data-src="/images/category/jackets.png" alt="<?= $title ?> <?= Yii::$app->name ?>" class="lazyload" style="
								position: absolute;
								top: -10%;
								left: 50%;
								transform: translateX(-40%);
							">
							<?php
								$this->registerCss('
									@media (max-width: 767px){
										#jackets {
											height: 75vh;
											top: 20% !important;
											left: 55% !important;
										}
									}
								');
							?>
					<?php
						}
					?>
					
					<?php // брюки
						if ($collection['collection']->id == 16 && $category && $category->id == 22){
					?>
							<img id="pants" data-src="/images/category/pants.png" alt="<?= $title ?> <?= Yii::$app->name ?>" class="lazyload" style="
								position: absolute;
								top: 0;
								left: 50%;
								transform: translateX(-40%);
							">
							<?php
								$this->registerCss('
									@media (max-width: 767px){
										#pants {
											height: 60vh;
											top: 30% !important;
											left: 60% !important;
										}
									}
								');
							?>
					<?php
						}
					?>
					
					<?php // шорты
						if ($collection['collection']->id == 16 && $category && $category->id == 23){
					?>
							<img id="shorts" data-src="/images/category/shorts.png" alt="<?= $title ?> <?= Yii::$app->name ?>" class="lazyload" style="
								position: absolute;
								top: 10%;
								left: 50%;
								transform: translateX(-40%);
							">
							<?php
								$this->registerCss('
									@media (max-width: 767px){
										#shorts {
											height: 55vh;
											top: 30% !important;
											left: 55% !important;
										}
									}
								');
							?>
					<?php
						}
					?>
					
					<?php // лонгсливы
						if ($collection['collection']->id == 16 && $category && $category->id == 24){
					?>
							<img id="longsleeves" data-src="/images/category/longsleeves.png" alt="<?= $title ?> <?= Yii::$app->name ?>" class="lazyload" style="
								position: absolute;
								top: 0;
								left: 50%;
								transform: translateX(-40%);
							">
							<?php
								$this->registerCss('
									@media (max-width: 767px){
										#longsleeves {
											height: 65vh;
											top: 30% !important;
											left: 55% !important;
										}
									}
								');
							?>
					<?php
						}
					?>
					
							<img src="/images/category/category_smoke_1.png" alt="<?= $title ?> <?= Yii::$app->name ?>" class="pointer-events-none d-none" style="
								position: absolute;
								bottom: -35%;
								left: 0;
								display: block;
								width: 100vw;
								min-width: 100%;
								transform: translateX(-30%);
							">
						
						</div>
					
					<!--
					<?php
						if (isset($collection['images'])){
					?>
						<div class="col-12 col-sm-8 p-0 position-absolute h-100" style="right: 0">
						<?php
							foreach ($collection['images'] as $image){
						?>
								<img data-src="<?= $image->getUrl() ?>" alt="<?= $title ?> <?= Yii::$app->name ?>" class="lazyload pointer-events-none">
						<?php
							}
						?>
						</div>
					<?php
						}
					?>
					-->
						
						<div class="col-12 col-sm-8 col-md-6 col-lg-5 my-4 my-lg-5 cover-menu">
							
							<h2 class="my-5 text-nowrap">
								<?= Html::a(json_decode($collection['collection']->name)->{Yii::$app->language}, [
										'/catalog/' . $collection['collection']->slug
									], [
										'class' => 'display-1 acline font-weight-light mb-0' . ($collection['collection']->slug == $collectionSlug ? ' text-underline' : ''),
									]
								) ?>
							</h2>
							
							<?php
								if ($collection['collection']->id == 17){
							?>
									<h3 class="display-3 acline my-5">
										<?= Yii::t('front', 'Coming soon...') ?>
									</h3>
							<?php
								}
							?>
							
						<?php
							if ($collection['subCategories']){
						?>
							<div class="row">
							<?php
								foreach ($collection['subCategories'] as $subCategory){
							?>
								<div class="col-12 col-sm-6 my-2">
									<?= Html::a(json_decode($subCategory->name)->{Yii::$app->language}, [
											'/catalog/' . ($collectionSlug ? $collectionSlug . '/' : '') . $subCategory->slug
										], [
											'class' => 'h4 font-weight-light mb-0' . ($subCategory->slug == $categorySlug ? ' text-underline' : ''),
										]
									) ?>
								</div>
							<?php
								}
							?>
							</div>
						<?php
							}
						?>
							
						</div>
					
					</div>
				
				</div>
			
			</div>
			
			
		
			

		</div>


		<div class="container-fluid">

			<div class="products-view px-3 py-3 mb-3 mb-lg-5">
			
			<?php
				if ($collection['products']){
			?>
					<div class="row list-products justify-content-center pb-3 pb-lg-5 mb-3 mb-lg-5">
				<?php
					foreach ($collection['products'] as $product){
				?>
						<div class="col-12 col-md-6 col-lg-4 col-xl-3 px-2 mb-3">
							<?= $this->render('_product', [
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
			<?php
				}
			?>

			</div>

		</div>
		
<?php
	}
?>