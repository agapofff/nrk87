<?php

use yii\helpers\Url;
use yii\helpers\Html;
use dvizh\shop\widgets\ShowPrice;
use dvizh\cart\widgets\BuyButton;
use dvizh\cart\widgets\ChangeCount;
use dvizh\cart\widgets\ChangeOptions;
use yii\web\View;
use yii\widgets\Pjax;

$images = $model->getImages();

if ($images){
	$image = $images[0];
	$cachedImage = '/images/cache/Products/Product' . $image->itemId . '/' . $image->urlAlias . '_x600.jpg';
	$this->registerMetaTag([
		'property' => 'og:image',
		'content' => Url::to(file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImage) ? $cachedImage : $image->getUrl('x600'), true)
	]);
}

$product_name = json_decode($model->name)->{Yii::$app->language};
$h1 = Yii::$app->params['h1'] ?: $product_name;
$this->title = Yii::$app->params['title'] ?: $product_name . ' - ' . Yii::t('front', 'Купить в интернет-магазине') . ' ' . Yii::$app->name;

$sizes = json_decode($model->sizes)->{Yii::$app->language};
?>

<div class="container-fluid mb-5 px-lg-2 px-xl-3 px-xxl-5" itemscope itemtype="http://schema.org/Product">
    
    <div class="row justify-content-center">

		<div class="col-12 col-md-6">
		
			<div class="row d-none d-md-flex">
			
			<?php
				foreach ($images as $key => $image){
					$cachedImageMin = '/images/cache/Products/Product' . $image->itemId . '/' . $image->urlAlias . '_x1500.jpg';
					$cachedImageMax = '/images/cache/Products/Product' . $image->itemId . '/' . $image->urlAlias . '_x2500.jpg';
			?>
					<div class="col-12 mt-1 overflow-hidden">
						<a href="#images" data-toggle="modal" class="d-block overflow-hidden zoom" data-url="<?= file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImageMax) ? $cachedImageMax : $image->getUrl('x2500') ?>">
							<img <?php if ($key == 0){?> itemprop="image" <?php } ?> src="<?= file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImageMin) ? $cachedImageMin : $image->getUrl('x1500') ?>" class="d-block w-100" alt="<?= $image->alt ? $image->alt : $product_name ?>" loading="lazy">
						</a>
					</div>
			<?php
				}
			?>
			
			</div>
			
			<div class="row d-md-none">
			
				<div class="col-12 mb-4">
				
					<div class="owl-carousel owl-theme owl-dots">
					
				<?php
					foreach ($images as $key => $image){
						$cachedImageMin = '/images/cache/Products/Product' . $image->itemId . '/' . $image->urlAlias . '_x1000.jpg';
						$cachedImageMax = '/images/cache/Products/Product' . $image->itemId . '/' . $image->urlAlias . '_x1500.jpg';
				?>
						<a href="<?= file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImageMax) ? $cachedImageMax : $image->getUrl('x1500') ?>" class="fancybox" data-width="100" data-height="100">
							<img src="<?= file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImageMin) ? $cachedImageMin : $image->getUrl('x1000') ?>" class="img-fluid rounded" alt="<?= $image->alt ? $image->alt : $product_name ?>" loading="lazy">
						</a>
				<?php
					}
				?>
					
					</div>
				
				</div>
			
			</div>
			
		</div>
		
		<div class="col-12 col-md-6">
		
			<div class="sticky-top" style="top:100px">
			
				<h1 class="ttfirsneue font-weight-light mb-3" itemprop="name">
					<?= $h1 ?>
				</h1>
				
		<?php
			if ($price && $model->available){
		?>

				<div class="product-price mb-3" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
					<meta itemprop="price" content="<?= $price ?>">
					<meta itemprop="priceCurrency" content="<?= Yii::$app->params['currency'] ?>">
					<?= ShowPrice::widget([
							'htmlTag' => 'p',
							'cssClass' => 'lead font-weight-normal ttfirsneue',
							'model' => $model,
							'price' => $price,
							// 'priceOld' => $priceOld,
						])
					?>
				</div>
				
				<div class="row mb-4">
					<div class="product-buy col-sm-6 col-md-12 col-lg-6 mb-0_5">
						<?= BuyButton::widget([
								'model' => $model,
								'htmlTag' => 'button',
								'cssClass' => 'btn btn-lg btn-primary btn-block py-1 text-uppercase ttfirsneue text-nowrap',
							]);
						?>
						<span class="select-size-note" style="display:none">
							<?= Yii::t('front', 'Выберите размер') ?>
						</span>
					</div>
					<div class="price-options col-sm-6 col-md-12 col-lg-6 mb-0_5">
						<?= ChangeOptions::widget([
								'model' => $model,
								'type' => 'select',
							]);
						?>
					</div>
					<div class="col-auto mb-0_5">
						<?= $this->render('@frontend/views/wishlist/product', [
								'product_id' => $model->id
							])
						?>
					</div>
				</div>
				
		<?php
			}
		?>
		
		<?php
			if ($model->code){
		?>
				<div class="my-5 d-none">
					<p class="lead"><?= $model->code ?></p>
				</div>
		<?php
			}
		?>
				<div class="row mb-1">
					<div class="product-features col-sm-6 col-md-12 col-lg-6 mb-2">
						<p class="text-uppercase font-weight-normal mb-1_5"><?= Yii::t('front', 'Характеристики') ?></p>
						<div id="product-characteristics" style="opacity: 0.6">
							<?= json_decode($model->short_text)->{Yii::$app->language} ?>
						</div>
					</div>
					<div class="product-description col-sm-6 col-md-12 col-lg-6 mb-2">
						<p class="text-uppercase font-weight-normal mb-1_5"><?= Yii::t('front', 'Описание') ?></p>
						<div id="product-description" itemprop="description" style="opacity: 0.6">
							<?= json_decode($model->text)->{Yii::$app->language} ?>
						</div>
					</div>
				</div>

		<?php
			if ($sizes){
		?>
				<p>
					<a href="#sizes" data-toggle="modal" title="<?= Yii::t('front', 'Размерная сетка') ?>" class="text-uppercase">
						<?= Yii::t('front', 'Размерная сетка') ?>
					</a>
				</p>
		<?php
			}
		?>
				
			</div>
			
		</div>
        
    </div>
	
<?php
	if ($relations){
?>
	<div class="row mt-12">
		<div class="col-12">
			<hr>
			<h4 class="h1 ttfirsneue text-uppercase mb-6">
				<?= Yii::t('front', 'Сопутствующие товары') ?>
			</h4>
		</div>
		<div class="owl-carousel owl-theme" data-items="2-2-3-3-4-4" data-nav="true" data-dots="true" data-margin="0">
	<?php
		foreach ($relations->all() as $related){
	?>
		<div class="col-12">
			<div class="card bg-transparent border-0 product">
				<div class="card-body px-0">
					<a href="<?= Url::to(['/product/'.$related->slug]) ?>">
						<?php
							$image = $related->getImage();
							$cachedImage = '/images/cache/Products/Product' . $image->itemId . '/' . $image->urlAlias . '_x1000.jpg';
						?>
						<img src="<?= file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImage) ? $cachedImage : $image->getUrl('x1000') ?>" class="img-fluid" alt="<?= $image->alt ? $image->alt : $product_name ?>" loading="lazy">
					</a>
					<p class="text-center mt-1_5 mb-0_5">
						<?= $product_name ?>
					</p>
					<p class="price text-center">
					<?php if (isset($prices_old[$related->id]) && (int)$prices_old[$related->id] > 0){ ?>
						<del class="text-muted"><?= Yii::$app->formatter->asCurrency((int)$prices_old[$related->id], Yii::$app->params['currency']) ?></del>&nbsp;
					<?php } ?>
					<?php if (isset($prices[$related->id]) && (int)$prices[$related->id] > 0){ ?>
						<?= Yii::$app->formatter->asCurrency((int)$prices[$related->id], Yii::$app->params['currency']) ?>
					<?php } ?>
					</p>
				</div>
			</div>
		</div>
	<?php
		}
	?>
		</div>
	</div>
<?php
	}
?>

</div>


<?php
	if ($images){
?>
        <div id="images" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="btn-modal-close rounded-circle overflow-hidden" data-dismiss="modal">
							<svg width="53" height="53" viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg">
								<line x1="13.7891" y1="12.3744" x2="39.9521" y2="38.5373" stroke="black" stroke-width="2"/>
								<line x1="12.3749" y1="38.5379" x2="38.5379" y2="12.3749" stroke="black" stroke-width="2"/>
							</svg>
                        </div>
						
						<div id="productImages" class="carousel slide carousel-fade" data-interval="false" data-touch="true" data-ride="carousel">
							<div class="carousel-inner">
						<?php
							foreach ($images as $key => $image){
								$cachedImageMin = '/images/cache/Products/Product' . $image->itemId . '/' . $image->urlAlias . '_x1500.jpg';
								$cachedImageMax = '/images/cache/Products/Product' . $image->itemId . '/' . $image->urlAlias . '_x2500.jpg';
						?>
								<div class="carousel-item<?= $key ? '' : ' active' ?>">
									<div class="row h-100">
										<div class="col-12 h-100 text-center overflow-hidden zoom" data-url="<?= file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImageMax) ? $cachedImageMax : $image->getUrl('x2500') ?>">
											<img src="<?= file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImageMin) ? $cachedImageMin : $image->getUrl('x1500') ?>" class="img-fluid rounded" alt="<?= $image->alt ? $image->alt : $product_name ?>" loading="lazy">
										</div>
									</div>
								</div>
						<?php
							}
						?>
							</div>
							<a class="carousel-control-prev" href="#productImages" role="button" data-slide="prev" style="left: -6em">
								<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
									<circle cx="25" cy="25" r="24.75" stroke="white" stroke-width="0.5"/>
									<path d="M21.6863 25.0006L27.5598 28.3917L27.5598 21.6096L21.6863 25.0006Z" fill="white"/>
								</svg>
							</a>
							<a class="carousel-control-next" href="#productImages" role="button" data-slide="next" style="right: -6em">
								<svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
									<circle r="24.75" transform="matrix(-1 0 0 1 25 25)" stroke="white" stroke-width="0.5"/>
									<path d="M28.3137 25.0006L22.4402 28.3917L22.4402 21.6096L28.3137 25.0006Z" fill="white"/>
								</svg>
							</a>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
	<?php
		foreach ($images as $key => $image){
			$cachedImageMin = '/images/cache/Products/Product' . $image->itemId . '/' . $image->urlAlias . '_x1500.jpg';
	?>
			<div id="image_<?= $key ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-body">
							<div class="btn-modal-close rounded-circle overflow-hidden" data-dismiss="modal">
								<svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
									<line x1="1.49418" y1="0.738243" x2="39.6779" y2="38.922" stroke="white"/>
									<line x1="0.787072" y1="38.9223" x2="38.9708" y2="0.73856" stroke="white"/>
								</svg>
							</div>
							<img id="img_<?= $key ?>" src="<?= file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImageMin) ? $cachedImageMin : $image->getUrl('x1500') ?>" class="img-fluid zoom-touch" data-fancybox>
						</div>
					</div>
				</div>
			</div>
	<?php
		}
	?>
	
<?php
	}
?>

<?php
	if ($sizes){
?>
		<div id="sizes" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="w-100 text-center font-weight-light">
							<?= Yii::t('front', 'Размерная сетка') ?>
						</h4>
						<div class="btn-modal-close rounded-circle overflow-hidden" data-dismiss="modal">
							<svg width="53" height="53" viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg">
								<line x1="13.7891" y1="12.3744" x2="39.9521" y2="38.5373" stroke="black" stroke-width="2"/>
								<line x1="12.3749" y1="38.5379" x2="38.5379" y2="12.3749" stroke="black" stroke-width="2"/>
							</svg>
						</div>
					</div>
					<div class="modal-body">
						<div id="size-grid" class="table-responsive">
							<?= str_replace('<table>', '<table class="table product-sizes">', $sizes) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
	}
?>


<?php
    $this->registerJs("
        outOfStock = function(){
            toastr.error('" . Yii::t('front', 'Нет в наличии') . "');
        }
    ");
?>

<?php
    $this->registerJS("
            // function setProductOptionsOnLoad(){
                // $($('.dvizh-option-values-before').get().reverse()).each(function(){
                    // $(this).trigger('change');
                // });
            // }
        
            // setProductOptionsOnLoad();
            
            var id,
                options = {};
            $('.dvizh-option').each(function(){
                var option = $(this).find('.dvizh-option-values-before:first'),
                    optionId = $(option).data('filter-id'),
                    optionVal = $(option).val();
                options[optionId] = optionVal;
            });

// console.log(options);
            $('.dvizh-cart-buy-button').data('options', options);
            $('.dvizh-cart-buy-button').attr('data-options', options);
            
            $('.dvizh-option-values-before:first').trigger('click');
            
            // $('#option1 option:first').trigger('click');
            // $(document).trigger('beforeChangeCartElementOptions', id);
        ",
        View::POS_READY,
        'set-product-options-on-load'
    );
?>


<?php // Yandex Ecommerce
	$this->registerJs("
		var id = $('.dvizh-cart-buy-button').attr('data-comment'),
			name = '" . $product_name . "',
			price = '" . round($price) . "',
			// category = '" . json_decode($categoryName)->{Yii::$app->language} . "',
			variant = $('.dvizh-option:first').find('.dvizh-option-values-before:checked').closest('label').text().trim(),
			currency = '" . Yii::$app->params['currency'] . "';
			
		ymDetail(id, name, price, variant, currency);
		fbqViewContent(id, name, price, variant, currency);
	", View::POS_READY);
?>

<?php
	$this->registerJs("
		$(document).on('click', '.dvizh-cart-buy-button', function(){
			var id = $('.dvizh-cart-buy-button').attr('data-comment'),
				name = '" . $product_name . "',
				quantity = 1,
				price = '" . round($price) . "',
				// category = '" . json_decode($categoryName)->{Yii::$app->language} . "',
				variant = $('.dvizh-option:first').find('.dvizh-option-values-before:checked').closest('label').text().trim(),
				currency = '" . Yii::$app->params['currency'] . "';
				
			ymAdd(id, name, price, variant, currency);
			fbqAddToCart(id, name, price, variant, currency);
		});
	", View::POS_READY);
?>
