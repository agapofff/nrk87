<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\HtmlPurifier;
    
    $product_name = json_decode($model->name)->{Yii::$app->language};
?>

    <div class="card bg-transparent border-0 product">
        <div class="card-body px-sm-1 px-md-2 px-lg-3 px-xl-4 px-xxl-5">
            <a href="<?= Url::to(['/product/'.$model->slug]) ?>">
				<?php
					$image = $model->getImage();
					$cachedImage = '/images/cache/Products/Product' . $image->itemId . '/' . $image->urlAlias . '_x1000.jpg';
				?>
				<img src="<?= file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImage) ? $cachedImage : $image->getUrl('x1000') ?>" class="img-fluid" alt="<?= $image->alt ? $image->alt : $product_name ?>" loading="lazy">
            </a>
            <p class="text-center mt-1_5 mb-0_5">
				<?= $product_name ?>
			</p>
            <p class="price text-center">
            <?php if (isset($prices_old[$model->id]) && (int)$prices_old[$model->id] > 0){ ?>
                <del class="text-muted d-none"><?= Yii::$app->formatter->asCurrency((int)$prices_old[$model->id], Yii::$app->params['currency']) ?></del>&nbsp;
            <?php } ?>
            <?php if (isset($prices[$model->id]) && (int)$prices[$model->id] > 0){ ?>
                <?= Yii::$app->formatter->asCurrency((int)$prices[$model->id], Yii::$app->params['currency']) ?>
            <?php } ?>
            </p>
        </div>
    </div>
