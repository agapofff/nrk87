<?php

namespace frontend\controllers;

use Yii;
use backend\models\Stores;
use backend\models\Langs;
use common\models\Product;
// use dvizh\shop\models\product\ProductSearch;
// use dvizh\shop\events\ProductEvent;
// use dvizh\shop\models\PriceType;
// use dvizh\shop\models\Price;
use common\models\Category;
// use dvizh\shop\models\price\PriceSearch;
// use dvizh\shop\models\Modification;
// use dvizh\shop\models\modification\ModificationSearch;
use dvizh\filter\models\Filter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class CatalogController extends \yii\web\Controller
{
    
    public function actionIndex($collectionSlug = null, $categorySlug = null)
    {
        $collIDs = [
            16, // 2021
            17, // 2021 дети
            9, // 2020
        ];
        
        if ($collectionSlug && !in_array(Category::findOne(['slug' => $collectionSlug])->id, $collIDs)) {
            $categorySlug = $collectionSlug;
            $collectionSlug = null;
        }
        
        $collectionsIDs = $collectionSlug ? [Category::findOne(['slug' => $collectionSlug])->id] : $collIDs;
        
        $category = $categorySlug ? Category::findOne(['slug' => $categorySlug]) : null;

        $modifications = Product::getAllProductsPrices();

        $modificationPrices = ArrayHelper::map($modifications, 'product_id', 'price');
        $modificationOldPrices = ArrayHelper::map($modifications, 'product_id', 'price_old');

        $collections = [];
        
        foreach ($collectionsIDs as $collectionID) {
            $collectionCategories = [];
            $collectionProductsIDs = [];
            $products = null;
            $allProductSizes = [];
            $allProductPrices = [];
            
            $collection = Category::findOne([
                'id' => $collectionID,
                'active' => 1
            ]);
            
            if ($collection) {
                $collectionProducts = $collection->products;
                
                if ($collectionProducts) {
                    $collectionCategoriesIDs = [];
                    
                    foreach ($collectionProducts as $collectionProduct) {
                        $collectionProductCategories = $collectionProduct->categories;
                        if ($collectionProductCategories) {
                            foreach ($collectionProductCategories as $collectionProductCategory) {
                                if ($collectionProductCategory->id != $collectionID) {
                                    $collectionCategoriesIDs[] = $collectionProductCategory->id;
                                }
                                if (!$categorySlug || $collectionProductCategory->slug == $categorySlug) {
                                    $collectionProductsIDs[] = $collectionProduct->id;
                                }
                            }
                        }
                    }
                    
                    $collectionCategoriesIDs = array_unique($collectionCategoriesIDs);

                    $collectionCategories = Category::find()
                        ->where([
                            'id' => array_unique($collectionCategoriesIDs),
                            'active' => 1,
                        ])
                        ->orderBy([
                            'sort' => SORT_ASC
                        ])
                        ->all();
                        
                    $goods = Product::find()
                        ->where([
                            'active' => 1,
                            'id' => $collectionProductsIDs
                        ]);
                        
                    if (Yii::$app->request->get('filter')) {
                        $goods = $goods->filtered();
                    }
                    
                    $goods = $goods->all();
                    
                    $products = [];
                    
                    if ($goods) {
                        foreach ($goods as $key => $product) {
                            $productSizes = $product->getCartOptions()[1]['variants'];
                            
                            $products[] = [
                                'model' => $product,
                                'name' => json_decode($product->name)->{Yii::$app->language},
                                'price' => (float) $modificationPrices[$product->id],
                                'oldPrice' => (float) $modificationOldPrices[$product->id],
                                'sizes' => $productSizes ?: [],
                            ];
                            
                            if ($productSizes) {
                                foreach ($productSizes as $productSize) {
                                    $allProductSizes[$productSize] = $productSize;
                                }
                            }
                        }
                    }
                    
                    $allProductPrices = array_unique(ArrayHelper::getColumn($products, 'price'));
                    
                    $price = Yii::$app->request->get('price');
                    if ($price) {
                        $price = explode(';', $price);
                        $products = array_filter($products, function ($product) use ($price) {
                            return $product['price'] >= (float) $price[0] && $product['price'] <= (float) $price[1];
                        });
                    }

                    $sizes = Yii::$app->request->get('sizes');
                    if ($sizes) {
                        $products = array_filter($products, function ($product) use ($sizes) {
                            return !empty(array_intersect($product['sizes'], $sizes));
                        });
                    }
                    
                    $sort = Yii::$app->request->get('sort');
                    if ($sort) {
                        $isDesc = mb_substr($sort, 0, 1) == '-';
                        $sortField = $isDesc ? mb_substr($sort, 1) : $sort;
                        $sortDir = $isDesc ? SORT_DESC : SORT_ASC;
                        ArrayHelper::multisort($products, [$sortField], [$sortDir]);
                    }
                }
                
                $collections[$collectionID] = [
                    'collection' => $collection,
                    'subCategories' => $collectionCategories,
                    'products' => $products,
                    'productSizes' => $allProductSizes,
                    'productPrices' => $allProductPrices,
                ];
            }
        }
        
        Yii::$app->params['currency'] = Langs::findOne([
            'code' => Yii::$app->language
        ])->currency;
        
        if ($collectionSlug && $categorySlug) {
            $title = json_decode($collection->name)->{Yii::$app->language} . ' - ' . json_decode($category->name)->{Yii::$app->language};
        } elseif ($categorySlug) {
            $title = json_decode($category->name)->{Yii::$app->language};
        } elseif ($collectionSlug) {
            $title = json_decode($collection->name)->{Yii::$app->language};
        } else {
            $title = Yii::t('front', 'Каталог');
        }

        return $this->render('index', [
            'collections' => $collections,
            'collectionSlug' => $collectionSlug,
            'categorySlug' => $categorySlug,
            'category' => $category,
            'title' => $title,
        ]);
    }

    
}