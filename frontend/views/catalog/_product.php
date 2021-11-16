<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\HtmlPurifier;
    
    $product_name = json_decode($model->name)->{Yii::$app->language};
?>

    <div class="card bg-transparent border-0 product">
        <div class="card-body px-0 py-2">
            <a href="<?= Url::to(['/product/'.$model->slug]) ?>">
                <div class="position-relative h-0 images" style="padding-top:140%">
                    <div class="row justify-content-center no-gutters fixed-top fixed-bottom position-absolute overflow-hidden rounded-lg-">
                <?php
                    $images = $model->getImages(); 
                    $imgQty = count($images) > 4 ? 4 : count($images);
                    $col = 12 / $imgQty;
                    for ($i = 0; $i < $imgQty; $i++){
                        $image = $images[$i];
                        $cachedImage = '/images/cache/Products/Product' . $image->itemId . '/' . $image->urlAlias . '_700x1000.jpg';
                ?>
                        <div class="col-<?= $col ?> image-hover-change"><?= file_exists($cachedImage) ?></div>
                        <img src="<?= file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImage) ? $cachedImage : $image->getUrl('700x1000') ?>" class="img-fluid position-absolute rounded-lg- image" alt="<?= $image->alt ? $image->alt : $product_name ?>" loading="lazy">
                        <div class="dot"></div>
                <?php
                    }
                ?>
                    </div>
                </div>
            </a>
            <h5 class="font-weight-light header mt-4">
				<?= $product_name ?>
			</h5>
            <p class="lead price">
            <?php if (isset($prices_old[$model->id]) && (int)$prices_old[$model->id] > 0){ ?>
                <del class="text-muted"><?= Yii::$app->formatter->asCurrency((int)$prices_old[$model->id], Yii::$app->params['currency']) ?></del>&nbsp;
            <?php } ?>
            <?php if (isset($prices[$model->id]) && (int)$prices[$model->id] > 0){ ?>
                <?= Yii::$app->formatter->asCurrency((int)$prices[$model->id], Yii::$app->params['currency']) ?>
            <?php } ?>
            </p>
        </div>
    </div>
