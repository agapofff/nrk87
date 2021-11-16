<?php

namespace frontend\controllers;

use Yii;

use backend\models\Stores;
use backend\models\Langs;

use dvizh\shop\models\Product;
use dvizh\shop\models\product\ProductSearch;
// use dvizh\shop\events\ProductEvent;
// use dvizh\shop\models\PriceType;
// use dvizh\shop\models\Price;
use dvizh\shop\models\Category;
// use dvizh\shop\models\price\PriceSearch;


// use dvizh\shop\models\Modification;
// use dvizh\shop\models\modification\ModificationSearch;

// use dvizh\filter\models\Filter;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\data\ActiveDataProvider;

use yii\db\Query;
use yii\helpers\ArrayHelper;

class CatalogController extends \yii\web\Controller
{
    
    // public function actionIndex()
    // {
        // $categories = Category::find()
            // ->where([
                // 'parent_id' => null
            // ])
            // ->orderBy('sort')
            // ->all();
            
        // $subCategories = [];
        // $images = [];
            
        // if ($categories){
            // foreach ($categories as $category)
            // {
                // $subCategories[$category->id] = Category::find()
                    // ->where([
                        // 'parent_id' => $category->id
                    // ])
                    // ->orderBy('sort')
                    // ->all();
                // $images[$category->id] = $category->getImages();
            // }
        // }
        
        // return $this->render('index', [
            // 'categories' => $categories,
            // 'subCategories' => $subCategories,
            // 'images' => $images,
        // ]);
    // }
	
	public function actionIndex($collectionSlug = null, $categorySlug = null)
	{
		$collIDs = [
			16, // 2021
			17, // 2021 дети
			9, // 2020
		];
		
		if ($collectionSlug && !in_array(Category::findOne(['slug' => $collectionSlug])->id, $collIDs)){
			$categorySlug = $collectionSlug;
			$collectionSlug = null;
		}
		
		$collectionsIDs = $collectionSlug ? [Category::findOne(['slug' => $collectionSlug])->id] : $collIDs;
		
		$category = $categorySlug ? Category::findOne(['slug' => $categorySlug]) : null;

		$modifications = (new Query())
			->select([
				'product_id' => 'm.product_id',
				'price' => 'p.price',
				'price_old' => 'p.price_old',
			])
			->from([
				'm' => '{{%shop_product_modification}}',
				'p' => '{{%shop_price}}',
			])
			->where([
				'm.available' => 1,
				// 'm.lang' => Yii::$app->language,
				// 'm.store_type' => Yii::$app->params['store_type'],
			])
			->andWhere(['like', 'm.name', Yii::$app->language])
			->andWhere(['like', 'm.name', Yii::$app->params['store_types'][Yii::$app->params['store_type']]])
			->andWhere('m.id = p.item_id')
			->groupBy([
				'product_id',
				'price',
				'price_old'
			])
			->all();
	
		$prices = ArrayHelper::map($modifications, 'product_id', 'price');
		$pricesOld = ArrayHelper::map($modifications, 'product_id', 'price_old');

		$collections = [];
		
		foreach ($collectionsIDs as $collectionID)
		{
			$collectionCategories = [];
			$collectionProductsIDs = [];
			$products = null;
			
			$collection = Category::findOne([
				'id' => $collectionID,
				'active' => 1
			]);
			
			if ($collection){
			
				$collectionProducts = $collection->products;
				
				if ($collectionProducts){
					$collectionCategoriesIDs = [];
					
					foreach ($collectionProducts as $collectionProduct)
					{
						$collectionProductCategories = $collectionProduct->categories;
						if ($collectionProductCategories){
							foreach ($collectionProductCategories as $collectionProductCategory)
							{
								if ($collectionProductCategory->id != $collectionID){
									$collectionCategoriesIDs[] = $collectionProductCategory->id;
								}
								if (!$categorySlug || $collectionProductCategory->slug == $categorySlug){
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
						
					$products = Product::findAll([
						'active' => 1,
						'id' => $collectionProductsIDs
					]);
					
				}
				
				// if ($collection->id == 17 || $collection->id == 9){
					// $images = $collection->getImages();
				// } else {
					// if ($categorySlug){
						// $images = $category->getImages();
					// } else {
						// $images = $collection->getImages();
					// }
				// }
				
				if (!$categorySlug || ($categorySlug && $products)){
					$collections[$collectionID] = [
						'collection' => $collection,
						'subCategories' => $collectionCategories,
						'products' => $products,
						// 'images' => $images,
					];
				}
			}
		}
		
		Yii::$app->params['currency'] = \backend\models\Langs::findOne([
			'code' => Yii::$app->language
		])->currency;

		
		if ($collectionSlug && $categorySlug){
			$title = json_decode($collection->name)->{Yii::$app->language} . ' - ' . json_decode($category->name)->{Yii::$app->language};
		} else if ($categorySlug){
			$title = json_decode($category->name)->{Yii::$app->language};
		} else if ($collectionSlug){
			$title = json_decode($collection->name)->{Yii::$app->language};
		} else {
			$title = Yii::t('front', 'Каталог');
		}

		return $this->render('index', [
			'collections' => $collections,
			'prices' => $prices,
			'prices_old' => $pricesOld,
			'collectionSlug' => $collectionSlug,
			'categorySlug' => $categorySlug,
			'category' => $category,
			'title' => $title,
		]);

	}
 
	
    public function actionCategory($categoryID = null, $collectionID = null)
    {
		$collections = [9, 16, 17];
		
		if ($categoryID){
			$category = Category::findOne([
				'slug' => $categoryID
			]);
			if ($category){
				if (in_array($category->id, $collections)){ // это коллекция
					
				} else { // это тип товара
					
				}
			} else {
				throw new NotFoundHttpException();
			}
		} else {
			
		}


        // $model = null;
        $searchModel = new ProductSearch([
            'pageSize' => 99,
            // 'route' => Yii::$app->request->pathInfo,
        ]);
        $dataProvider = $searchModel->search([
            'ProductSearch' => [
                'active' => 1,
                'category_id' => $category->id,
            ],
            
        ]);
        
        // $filters = Filter::find()->all();
        
        // $ignoreAttribute =  ['amount_in_stock', 'images'];
        
        // $query = Product::find()->where([
            // 'available' => 1,
            // '{{%shop_product_to_category}}.category_id' => $slug ? $this->getCategoryId($slug) : null,
        // ]);
        // $dataProvider = new ActiveDataProvider([
            // 'query' => $query,
            // 'pagination' => [
                // 'pageSize' => 20,
            // ],
        // ]);
        
        // print_r($query->createCommand()->getRawSql());
        

        // $prods = [];
        $products = $dataProvider->models;
        
        $modifications = (new Query())
            ->select([
                'product_id' => 'm.product_id',
                'price' => 'p.price',
                'price_old' => 'p.price_old',
            ])
            ->from([
                'm' => '{{%shop_product_modification}}',
                'p' => '{{%shop_price}}',
            ])
            ->where([
                'm.available' => 1,
                // 'm.lang' => Yii::$app->language,
                // 'm.store_type' => Yii::$app->params['store_type'],
            ])
            ->andWhere(['like', 'm.name', Yii::$app->language])
            ->andWhere(['like', 'm.name', Yii::$app->params['store_types'][Yii::$app->params['store_type']]])
            ->andWhere('m.id = p.item_id')
            ->groupBy([
                'product_id',
                'price',
                'price_old'
            ])
            ->all();
            
        $prices = ArrayHelper::map($modifications, 'product_id', 'price');
        $pricesOld = ArrayHelper::map($modifications, 'product_id', 'price_old');
        
        if (Yii::$app->params['hideNotAvailable']){
            if (count($products)){
                foreach ($products as $k => $product)
                {
                    if (json_decode(json_decode($product->sku)->{Yii::$app->language})->{Yii::$app->params['store_type']}){
                        continue;
                    } else {
                        unset($products[$k]);
                    }

                }
            }
        }
        
        $dataProvider->models = $products;
        
        $subCats = Category::findAll(['parent_id' => $category->id]);
        
        $subCategories = $subCats ? $subCats : Category::find()
            ->where([
                'parent_id' => $category->parent_id ?: $category->id
            ])
            ->orderBy('sort')
            ->all();
        
        $title = $subCats ? $category->name : Category::findOne($category->parent_id ?: $category->id)->name;
        $title = json_decode($title)->{Yii::$app->language};
        
        $cover = $subCats ? $category->slug : Category::findOne($category->parent_id ?: $category->id)->slug;
        
        $imagesModel = $subCats ? $category : Category::findOne($category->parent_id ?: $category->id);
        
		Yii::$app->params['currency'] = \backend\models\Langs::findOne([
			'code' => Yii::$app->language
		])->currency;

        return $this->render('category', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'category' => $category,
            'subCategories' => $subCategories,
            'slug' => $slug,
            'title' => $title,
            'cover' => $cover,
            'images' => $imagesModel->getImages(),
            // 'currency' => $currency,
            'prices' => $prices,
            'prices_old' => $pricesOld,
            // 'prices' => ArrayHelper::map($modifications, 'product_id', 'price'),
            // 'prices_old' => ArrayHelper::map($modifications, 'product_id', 'price_old'),
            // 'filters' => $filters,
            // 'ignoreAttribute' => $ignoreAttribute,
        ]);
        
        
        
        
        // $store_id = Stores::find()
            // ->where([
                // 'lang' => Yii::$app->params['language'],
                // 'type' => Yii::$app->params['store_type'],
            // ])
            // ->one();
            
            
            
            
        
        // находим все категории
        
        
        // $categories = Category::findAll([
            // 'not', [
                // 'parent_id' => null
            // ]
        // ]);
        
        // if ($parent_category_name)
        // {
            // $parent_category_id = $this->getCategoryId($parent_category_name);
            // $categories = $categories->andWhere([
                // 'parent_id' => $parent_category_id
            // ]);
        // } 
        // else if ($category_name)
        // {
            // $parent_category_id = $this->getCategoryId($parent_category_name);
            // $category_id = $this->getCategoryId($category_name, $parent_category_id);
            // $categories = $categories->andWhere([
                // 'id' => $category_id
            // ]);
        // }
        
        // $products = Product::findAll([
            // 'in', 'id', ArrayHelper::getColumn($categories, 'id')
        // ]);
        

        // foreach ($products as $key => $product)
        // {
            // $in_stock = false;
            // $vendor_codes = json_decode($prouct->sku);
            
            // if (!empty($vendor_codes))
            // {
                // foreach ($vendor_codes as $lang => $store_types)
                // {
                    // if ($lang == Yii::$app->params['language'])
                    // {
                        // foreach ($store_types as $store_type => $vendor_code)
                        // {
                            // if ($store_type == Yii::$app->params['store_type'] && $vendor_code)
                            // {
                                // $in_stock = true;
                            // }
                        // }
                    // }
                // }
            // }
            
            // if (!$in_stock){
                // unset($products[$key]);
            // }            
        // }
        
        // $modifications = Modification::find()
            // ->where([
                // 'lang' => Yii::$app->params['language'],
                // 'store_type' => Yii::$app->params['store_type'],
            // ])
            // ->andWhere([
                // 'in', 'product_id', implode(',', ArrayHelper::getColumn($products, 'id'))
            // ])
            // ->all();
            
        // $prices = Price::find()
            // ->where([
                // 'in', 'item_id', implode(',', ArrayHelper::getColumn($modifications, 'id'))
            // ])
            // ->all();
        
        // return $this->render('index', [
            // 'products' => $products,
            // 'modifications' => $modifications,
        // ]);        
    }

    
}