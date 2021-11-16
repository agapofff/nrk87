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
?>

<div class="container-fluid my-4 my-lg-5" itemscope itemtype="http://schema.org/Product">
    
    <div class="row justify-content-center my-4 my-lg-5">
    
        <div class="col-12 col-lg-10">

            <div class="row">

                <div class="col-12 col-md-6 col-lg-7 col-xl-7">
                
                    <div class="row d-none d-md-flex">
                    
                    <?php
                        foreach ($images as $key => $image){
                            $cachedImageMin = '/images/cache/Products/Product' . $image->itemId . '/' . $image->urlAlias . '_x600.jpg';
                            $cachedImageMax = '/images/cache/Products/Product' . $image->itemId . '/' . $image->urlAlias . '_x1200.jpg';
                    ?>
                            <div class="col-12 col-md-6 p-2 rounded overflow-hidden">
                                <a href="#images" data-toggle="modal" class="d-block rounded overflow-hidden zoom" data-url="<?= file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImageMax) ? $cachedImageMax : $image->getUrl('x1200') ?>">
									<img <?php if ($key == 0){?> itemprop="image" <?php } ?> src="<?= file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImageMin) ? $cachedImageMin : $image->getUrl('x600') ?>" class="img-fluid rounded" alt="<?= $image->alt ? $image->alt : $product_name ?>" loading="lazy">
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
                                $cachedImageMin = '/images/cache/Products/Product' . $image->itemId . '/' . $image->urlAlias . '_x600.jpg';
								$cachedImageMax = '/images/cache/Products/Product' . $image->itemId . '/' . $image->urlAlias . '_x1500.jpg';
                        ?>
								<!-- <a href="<?= file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImageMax) ? $cachedImageMax : $image->getUrl('x1500') ?>" class="fancybox" data-width="100" data-height="100"> -->
									<img src="<?= file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImageMin) ? $cachedImageMin : $image->getUrl('x600') ?>" class="img-fluid rounded" alt="<?= $image->alt ? $image->alt : $product_name ?>" loading="lazy">
								<!-- </a> -->
                        <?php
                            }
                        ?>
                            
                            </div>
                        
                        </div>
                    
                    </div>
                    
                </div>
                
                <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                
                    <div class="row justify-content-end">
                    
                        <div class="col-12 col-lg-11 col-xl-10">
                
                            <h1 class="display-3 acline" itemprop="name">
                                <?= $h1 ?>
                            </h1>
							
					<?php
						if ($price && $model->available){
					?>

                            <div class="product-price my-4" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
								<meta itemprop="price" content="<?= $price ?>">
								<meta itemprop="priceCurrency" content="<?= Yii::$app->params['currency'] ?>">
                                <?= ShowPrice::widget([
                                        'htmlTag' => 'p',
                                        'cssClass' => 'lead',
                                        'model' => $model,
                                        'price' => $price,
                                        'priceOld' => $priceOld,
                                    ])
                                ?>
                            </div>
                            
                            <p class="mb-1">
                                <?= Yii::t('front', 'Выберите размер') ?>
                            </p>
                            
                            <div class="price-options mt-3 mb-5">
                                <?= ChangeOptions::widget([
                                        'model' => $model,
                                        'type' => 'radio'
                                    ]);
                                ?>
                            </div>
                            
                            <div class="product-buy my-4">
                                <?= BuyButton::widget([
                                        'model' => $model,
                                        'htmlTag' => 'button',
                                        'cssClass' => 'btn-nrk',
                                    ]);
                                ?>
                            </div>
					<?php
						}
					?>
					
					<?php
						if ($model->code){
					?>
							<div class="my-5">
								<p class="lead"><?= $model->code ?></p>
							</div>
					<?php
						}
					?>
                            
                            <div class="product-description my-5">
                                <h4 class="mb-4 d-none"><?= Yii::t('front', 'Описание') ?></h4>
                                <div itemprop="description">
									<?= json_decode($model->text)->{Yii::$app->language} ?>
								</div>
                            </div>
                            <hr>
							<br>
                            <div class="product-features">
                                <h4 class="mb-4 d-none"><?= Yii::t('front', 'Характеристики') ?></h4>
                                <?= json_decode($model->short_text)->{Yii::$app->language} ?>
                            </div>
                        
						<?php
							if ($sizes = json_decode($model->sizes)->{Yii::$app->language}){
						?>
							<br>
							<hr>
							<br>
							<div class="mt-4">
								<a href="#sizes" data-toggle="modal" class="btn-nrk btn-sm" title="<?= Yii::t('front', 'Размерная сетка') ?>">
									<span></span>
									<?= Yii::t('front', 'Размерная сетка') ?>
								</a>
							</div>
							<div id="sizes" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="w-100 text-center font-weight-light">
												<?= Yii::t('front', 'Размерная сетка') ?>
											</h4>
											<div class="btn-modal-close rounded-circle overflow-hidden" data-dismiss="modal">
												<svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
													<line x1="1.49418" y1="0.738243" x2="39.6779" y2="38.922" stroke="white"/>
													<line x1="0.787072" y1="38.9223" x2="38.9708" y2="0.73856" stroke="white"/>
												</svg>
											</div>
										</div>
										<div class="modal-body">
											<div id="size-grid" class="">
												<?= str_replace('<table>', '<table class="table product-sizes">', $sizes) ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php
							}
						?>
						
                        </div>
                    
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
    </div>

</div>


<?php
	if ($images){
?>
        <div id="images" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="btn-modal-close rounded-circle overflow-hidden" data-dismiss="modal">
                            <svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="1.49418" y1="0.738243" x2="39.6779" y2="38.922" stroke="white"/>
                                <line x1="0.787072" y1="38.9223" x2="38.9708" y2="0.73856" stroke="white"/>
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
