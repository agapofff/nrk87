<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Wishlist;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use dvizh\shop\models\Product;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class WishlistController extends \yii\web\Controller
{
	
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'add', 'remove', 'check'],
                'rules' => [
                    [
                        'actions' => ['index', 'add', 'remove', 'check'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
		$wishlist = Wishlist::findAll([
			'user_id' => Yii::$app->user->id
		]);
		
		$products = Product::findAll([
			'id' => ArrayHelper::getColumn($wishlist, 'product_id')
		]);
			
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
			
		Yii::$app->params['currency'] = \backend\models\Langs::findOne([
			'code' => Yii::$app->language
		])->currency;
	
		$prices = ArrayHelper::map($modifications, 'product_id', 'price');
		$pricesOld = ArrayHelper::map($modifications, 'product_id', 'price_old');
		
        return $this->render('index', [
			'wishlist' => $wishlist,
			'products' => $products,
			'prices' => $prices,
			'prices_old' => $pricesOld,
		]);
	}
	
	public function actionCheck($product_id, $size = null)
	{
		$model = Wishlist::findOne([
			'user_id' => Yii::$app->user->id,
			'product_id' => $product_id,
			'size' => $size,
		]);
		
		return $this->renderPartial('product', [
			'check' => $model ? true : false,
			'product_id' => $product_id,
			'size' => $size,
		]);
	}
	
	public function actionAdd($product_id, $size = null)
	{
		if (!$model = Wishlist::findOne([
			'product_id' => $product_id,
			'size' => $size,
		])){
			$model = new Wishlist();
			$model->user_id = Yii::$app->user->id;
			$model->product_id = $product_id;
			$model->size = $size;
			$model->save();
		}
	}
	
	public function actionRemove($product_id, $size = null)
	{
		$model = Wishlist::findOne([
			'user_id' => Yii::$app->user->id,
			'product_id' => $product_id,
			'size' => $size,
		]);
        $model->delete();
	}

}