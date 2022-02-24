<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use backend\models\Countries;
use backend\models\Cities;
use backend\models\Addresses;

class ContactsController extends \yii\web\Controller
{
    public function actionIndex($slug = null)
    {
        if ($slug) {
            $country = Countries::find()
                ->where('slug = :slug', [
                    ':slug' => $slug
                ])
                ->andWhere([
                    'active' => 1
                ])
                ->one();
                
            if ($country) {
                $cities = Cities::find()
                    ->where([
                        'active' => 1,
                        'country_id' => $country->id,
                    ])
                    ->orderBy([
                        'ordering' => SORT_ASC
                    ])
                    ->all();
                    
                $addresses = Addresses::find()
                    ->where([
                        'active' => 1,
                        'country_id' => $country->id
                    ])
                    ->orderBy([
                        'ordering' => SORT_ASC
                    ])
                    ->all();
                    
                $countries = Countries::find()
                    ->where([
                        'active' => 1
                    ])
                    ->orderBy([
                        'ordering' => SORT_ASC
                    ])
                    ->all();
                    
                return $this->render('index', [
                    'countries' => $countries,
                    'cities' => $cities,
                    'addresses' => $addresses,
                    'currentCountry' => $country
                ]);
            } else {
                throw new NotFoundHttpException(Yii::t('front', 'Страница не найдена'));
            }
        } else {
            $country = Countries::find()
                ->where([
                    'active' => 1
                ])
                ->orderBy([
                    'ordering' => SORT_ASC
                ])
                ->one();
            
            return $this->redirect(['/contacts/' . $country->slug]);
        }
    }
    
}
