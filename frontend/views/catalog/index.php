<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\web\View;
use frontend\widgets\FilterPanel\FilterPanel;

$this->title = (Yii::$app->request->get('search') ? Yii::t('front', 'Поиск') . ': ' . Yii::$app->request->get('search') : (Yii::$app->params['title'] ?: $title)) . ' - ' . Yii::$app->id;
$h1 = Yii::$app->params['h1'] ?: $this->title;

// \yii\web\YiiAsset::register($this);
?>

<div class="container-fluid mb-1 mb-md-2 px-lg-2 px-xl-3 px-xxl-5">
    <div class="row">
        <div class="col-12">
    <?php
        if (Yii::$app->request->get('search')) {
    ?>
            <h1 class="h2 mb-5 w-100 font-weight-light floating-label text-uppercase">
                <div class="row align-items-baseline">
                    <div class="col-12 col-sm-auto">
                        <?= Yii::t('front', 'Поиск') ?>:
                    </div>
                    <div class="col-12 col-sm-auto position-relative">
                        <?= Html::beginForm(['/catalog'], 'get') ?>
                            <?= Html::input('text', 'search', Yii::$app->request->get('search'), [
                                    'id' => 'catalog-search-field',
                                    'class' => 'form-control form-control pl-0 pt-1 text-uppercase',
                                    'style' => 'font-size: inherit',
                                    'maxlength' => 30,
                                ]) 
                            ?>
                                <button type="submit" class="btn btn-link position-absolute bottom-0 right-0 text-gray-500 pb-1 pb-lg-1_5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                    </svg>
                                </button>
                        <?= Html::endForm() ?>
                    </div>
                </div>
            </h1>
    <?php
        } else {
    ?>
            <h1 class="ttfirsneue text-uppercase display-2 position-relative d-inline-block mb-0 red_dot">
                <?= Yii::t('front', 'Каталог') ?>
            </h1>
    <?php
        }
    ?>
        </div>
    </div>
</div>

<div class="container-fluid px-lg-2 px-xl-3 px-xxl-5">
<?php
    foreach ($collections as $collection) {
?>
        <div class="row mb-1 mb-md-3">
            <div class="col-auto">
                <h2 class="display-3 ttfirsneue text-uppercase font-weight-light mb-0">
                    <?= Html::a(json_decode($collection['collection']->text)->{Yii::$app->language}, [
                            '/catalog/' . $collection['collection']->slug
                        ], [
                            'class' => 'text-decoration-none'
                        ])
                    ?>
                </h2>
            </div>
        </div>
        
    <?php
        if ($collection['subCategories']) {
    ?>
            <div class="row justify-content-between flex-nowrap overflow-x-auto overflow-y-hidden product-types pb-0_5">
                <div class="col-auto">
                    <?= Html::a(Yii::t('front', 'Все'), [
                            '/catalog' . ($collectionSlug ? '/' . $collectionSlug : '')
                        ], [
                            'class' => 'ttfirsneue text-uppercase text-decoration-none pb-1 ' . (($collectionSlug && $collection['collection']->slug == $collectionSlug) || (!$collectionSlug && !$categorySlug) ? 'text-dark' : ' text-gray-500')
                        ])
                    ?>
                </div>
            <?php
                foreach ($collection['subCategories'] as $subCategory) {
            ?>
                <div class="col-auto">
                    <?= Html::a(json_decode($subCategory->name)->{Yii::$app->language}, [
                            '/catalog/' . ($collectionSlug ? $collectionSlug . '/' : '') . $subCategory->slug
                        ], [
                            'class' => 'ttfirsneue text-uppercase text-decoration-none py-1 ' . ($categorySlug && $subCategory->slug == $categorySlug ? 'text-dark' : 'text-gray-500'),
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
    
        <hr class="d-none d-md-block mt-0">
        <?php Pjax::begin(); ?>

            <?= FilterPanel::widget([
                    'itemId' => $collection['collection']->id,
                    'actionRoute' => Url::to(['/catalog' . ($collectionSlug ? '/' . $collectionSlug : '') . ($categorySlug ? '/' . $categorySlug : '')]),
                    'blockCssClass' => 'col-12 col-md-6 col-lg-4 col-xl-3 mb-1',
                    'productsSizes' => $collection['productsSizes'],
                    'productsPrices' => $collection['productsPrices'],
                    'actionRoute' => explode('?', Url::to())[0],
                ]);
            ?>
            
            <?php
                if ($collection['products']) {
            ?>
                    
                    <div class="row list-products justify-content-center mt-1 mt-md-3">
                    <?php
                        foreach ($collection['products'] as $product) {
                    ?>
                            <div class="col-12 col-md-6">
                                <?= $this->render('@frontend/views/catalog/_product', [
                                        'product' => $product['model'],
                                        'productName' => $product['name'],
                                        'oldPrice' => $product['oldPrice'],
                                        'price' => $product['price'],
                                        'sizes' => $product['sizes'],
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
            
            <?php
                $this->registerJs("
                    $('.select2-search__field').addClass('form-control');
                ", View::POS_READY);
            ?>

        <?php Pjax::end(); ?>
        
<?php
    }
?>

</div>

