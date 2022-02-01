<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->title = Yii::$app->params['title'] ?: $title;
$h1 = Yii::$app->params['h1'] ?: $this->title;

// \yii\web\YiiAsset::register($this);

?>


<div class="container-fluid mb-7 mt-1_5 px-lg-2 px-xl-3 px-xxl-5">
    
    <div class="row mb-5">
        <div class="col-12">
            <h1 class="ttfirsneue text-uppercase display-2 position-relative d-inline-block mb-0 red_dot">
                <?= Yii::t('front', 'Каталог') ?>
            </h1>
        </div>
    </div>



<?php
    foreach ($collections as $collection) {
?>
        <div class="row mb-5">
            <div class="col-auto">
                <h2 class="h1 ttfirsneue text-uppercase font-weight-light mb-0">
                    <?= Html::a(json_decode($collection['collection']->text)->{Yii::$app->language}, [
                            '/catalog/' . $collection['collection']->slug
                        ], [
                            'class' => 'text-decoration-none'
                        ])
                    ?>
                </h2>
            </div>
        </div>
                <?= $collectionSlug ?>        
    <?php
        if ($collection['subCategories']) {
    ?>
            <div class="row justify-content-between flex-nowrap overflow-x-auto overflow-y-hidden product-types py-0_5">
                <div class="col-auto">
                    <?= Html::a(Yii::t('front', 'Все'), [
                            '/catalog' . ($collectionSlug ? '/' . $collectionSlug : '')
                        ], [
                            'class' => 'ttfirsneue text-uppercase text-decoration-none py-1 ' . (($collectionSlug && $collection['collection']->slug == $collectionSlug) || (!$collectionSlug && !$categorySlug) ? 'text-dark' : ' text-gray-500')
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
    
        <hr class="d-none d-md-block mt-0">
                            

            
    <?php
        if ($collection['products']) {
    ?>
            <div class="row list-products justify-content-center mt-6">
            <?php
                foreach ($collection['products'] as $product) {
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
    <?php
        }
    ?>
        
<?php
    }
?>

</div>