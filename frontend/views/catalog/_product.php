<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\HtmlPurifier;
?>

    <div class="card bg-transparent border-0 product">
        <div class="card-body px-sm-1 px-md-2 px-lg-3 px-xl-4 px-xxl-5">
            <a href="<?= Url::to(['/product/' . $product->slug]) ?>">
                <?php
                    $image = $product->getImage();
                    $cachedImage = '/images/cache/Products/Product' . $image->itemId . '/' . $image->urlAlias . '_1000x1000.jpg';
                    $imageUrl = file_exists(Yii::getAlias('@frontend') . '/web' . $cachedImage) ? $cachedImage : $image->getUrl('1000x1000');
                ?>
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+ip1sAAAAASUVORK5CYII=" data-src="<?= $imageUrl ?>" class="img-fluid lazyload" alt="<?= $image->alt ? $image->alt : $productName ?>">
            </a>
            <p class="text-center mt-1_5 mb-0_5">
                <?= $productName ?>
            </p>
            <p class="price text-center">
            <?php if ($oldPrice) { ?>
                <del class="text-muted d-none"><?= Yii::$app->formatter->asCurrency($oldPrice, Yii::$app->params['currency']) ?></del>&nbsp;
            <?php } ?>
            <?php if ($price) { ?>
                <?= Yii::$app->formatter->asCurrency($price, Yii::$app->params['currency']) ?>
            <?php } ?>
            </p>
        </div>
    </div>
