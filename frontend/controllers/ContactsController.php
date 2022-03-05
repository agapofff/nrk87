<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use backend\models\Countries;
use backend\models\Cities;
use backend\models\Addresses;
use jisoft\sypexgeo\Sypexgeo;

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
            // $country = Countries::find()
                // ->where([
                    // 'active' => 1
                // ])
                // ->orderBy([
                    // 'ordering' => SORT_ASC
                // ])
                // ->one();
                
            $geo = new Sypexgeo();
            $geo->get();
            
            // внешний IP для localhost
            if ($geo->ip == $_SERVER['SERVER_ADDR']) {
                $geo->get(file_get_contents('https://myip.axioweb.ru'));
            }
            
            if ($country = Countries::findOne([
                'iso' => $geo->country['iso']
            ])) {
echo $geo->country['iso']; exit;
                return $this->redirect(['/contacts/' . $country->slug]);
            } else if ($geo->country['continent'] == 'EU') {
                return $this->redirect(['/contacts/austria']);
            } else if (in_array($geo->country['continent'], ['NA', 'SA', 'US'])) {
                return $this->redirect(['/contacts/usa']);
            } else if ($geo->country['continent'] == 'AS') {
                return $this->redirect(['/contacts/vietnam']);
            } else {
                return $this->redirect(['/contacts/austria']);
            }
        }
    }
    
}
