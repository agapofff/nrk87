<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

use backend\models\ScanToWin;
use backend\models\ScanToWinCodes;
use backend\models\ScanToWinStores;

use backend\models\Langs;

use dvizh\shop\models\Product;
use dvizh\order\models\Order;
use yii\web\NotFoundHttpException;

use dektrium\user\models\User;
use dektrium\user\models\Profile;

use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;

class ScanToWinController extends \yii\web\Controller
{
    
    public function actionIndex()
    {
        $current = null;
        $product = null;
        $previous = null;
        $products = null;
        $price = null;
        $countUsers = 0;
        $countCodes = 0;
        $userCodes = null;
        $codes = [];
        $orderNotFound = false;
        $new = false;
        $winners = [];
        
        $scanToWin = new ScanToWin();
        $scanToWinCodes = new ScanToWinCodes();
        
        $current = $scanToWin->getCurrent();
        
        $previous = ScanToWin::find()
            ->where([
                '<>', 'id', $current ? $current->id : 0
            ])
            ->orderBy([
                'date_end' => SORT_DESC
            ])
            ->all();
            
        if ($previous){
            foreach ($previous as $prev){
                $profile = Profile::findOne([
                    'user_id' => $prev->winner_id
                ]);
                $winners[$prev->id] = [
                    'phone' => $profile ? $scanToWinCodes->getSecurePhone($profile->phone) : '',
                    'code' => $scanToWinCodes->getCode($prev->code_id),
                ];
            }
        }
        
        if ($current){
            if ($scanToWinCodes->load(Yii::$app->request->post())){
                $scanToWinCodes->user_id = Yii::$app->user->id;
                $scanToWinCodes->status = 1;
                $scanToWinCodes->created_at = $scanToWinCodes->updated_at = date('Y-m-d H:i:s');
                
                if ($checkOrder = $scanToWinCodes->checkOrder($scanToWinCodes->order_id)){
                    $checkOrder = json_decode($checkOrder);
                    if ($checkOrder->status == 'success'){
                        $quantity = 0;
                        $response = $checkOrder->message;
                        if (isset($response->content)){
                            foreach ($response->content as $content) {
                                $quantity += $content->quantity;
                            }
                        }

                        for ($i = 0; $i < $quantity; $i++){
                            $model = new ScanToWinCodes();
                            $model->user_id = Yii::$app->user->id;
                            $model->status = 1;
                            $model->order_id = $scanToWinCodes->order_id;
                            $model->created_at = $model->updated_at = date('Y-m-d H:i:s');
                            $model->save();
                        }
                        
                        Yii::$app->session->setFlash('success', Yii::t('front', 'Заказ успешно добавлен и будет участвовать в розыгрышах призов'));
                        
                        $new = true;
                        $scanToWinCodes->order_id = null;
                    } else {
                        Yii::$app->session->setFlash('error', $checkOrder->message);
                        if ($checkOrder->code == 2){
                            $orderNotFound = true;
                        }
                    }
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('front', 'Ошибка сервера! Попробуйте ещё раз чуть позже'));
                }
            }
            
            $product = Product::findOne($current->product_id);
            
            $prices = (new \yii\db\Query())
                ->select([
                    'p.price',
                    'p.price_old',
                ])
                ->from([
                    'm' => '{{%shop_product_modification}}',
                    'p' => '{{%shop_price}}',
                ])
                ->where([
                    'm.available' => 1,
                    'm.product_id' => $product->id,
                ])
                ->andWhere(['like', 'm.name', Yii::$app->language])
                ->andWhere(['like', 'm.name', Yii::$app->params['store_types'][Yii::$app->params['store_type']]])
                ->andWhere('m.id = p.item_id')
                ->one();
                
            $price = $prices['price'];

            $countUsers = $scanToWinCodes->getCountUsers();
                
            $countCodes = $scanToWinCodes->getCountCodes();
                
            if ($userCodes = $scanToWinCodes->getUserCodes(Yii::$app->user->id)){
                foreach ($userCodes as $userCode){
                    $won = false;
                    if ($previous){
                        foreach ($previous as $prev){
                            if ($prev->code_id == $userCode->id){
                                $won = true;
                                break;
                            }
                        }
                    }
                    $codes[] = [
                        'id' => $scanToWinCodes->getCode($userCode->id),
                        'active' => $userCode->status,
                        'won' => $won ? 1 : 0,
                    ];
                }
            }

            if ($new){
                Yii::$app->mailer
                    ->compose('@common/mail/scan-to-win/new.php', [
                        'date_start' => Yii::$app->formatter->asDate($current->date_start, 'dd/MM'),
                        'date_end' => Yii::$app->formatter->asDate($current->date_end, 'dd/MM'),
                        'product_name' => json_decode($product->name)->{Yii::$app->language},
                        'product_description' => json_decode($product->text)->{Yii::$app->language},
                        'product_image' => Url::to($product->getImage()->getUrl('x250'), true),
                        'product_price' => Yii::$app->formatter->asCurrency($price, Yii::$app->params['currency']),
                        'product_link' => Url::to(['/product/' . $product->slug], true),
                        'codes' => $codes,
                    ])
                    // ->setTo('agapofff@gmail.com')
                    ->setTo(Yii::$app->user->identity->email)
                    ->setFrom([
                        Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']
                    ])
                    ->setSubject(Yii::t('front', 'Вы зарегистрировались в розыгрыше') . ' ' . Yii::$app->name)
                    ->send();
                    
                $current->users_count = $countUsers;
                $current->codes_count = $countCodes;
                $current->save();
            }
        }
            
        $products = Product::find()->all();
        
        return $this->render('index', [
            'model' => $scanToWinCodes,
            'current' => $current,
            'product' => $product,
            'price' => $price,
            'countUsers' => $countUsers,
            'countCodes' => $countCodes,
            'previous' => $previous,
            'products' => $products,
            'codes' => $codes,
            'orderNotFound' => $orderNotFound,
            'winners' => $winners,
        ]);
    }
    
    
    public function actionChooseWinner($i)
    {
        if ($i != '58f81bcf6d30494e99368c813e073cb6'){
            return false;
        }
        
        $current = ScanToWin::find()
            ->where([
                'is', 'winner_id', null
            ])
            ->andWhere([
                '<', 'date_end', date('Y-m-d H:i:s')
            ])
            ->orderBy([
                'date_end' => SORT_DESC
            ])
            ->one();
    
        if ($current){
            $scanToWinCodes = new ScanToWinCodes();
            
            $winnersCodes = $scanToWinCodes->getWinnersCodes();
            $winnersUsers = $scanToWinCodes->getWinnersUsers();
            
            $winner = ScanToWinCodes::find()
				->where([
					'status' => 1
				])
                ->andWhere([
                    'not in', 'id', $winnersCodes
                ])
                ->andWhere([
                    'not in', 'user_id', array_slice($winnersUsers, 0, 2)
                ])
                ->orderBy('RAND()')
                ->one();
                
            $winUser = $winner->user_id;
            $winCode = $winner->id;
                
            $current->winner_id = $winUser;
            $current->code_id = $winCode;
            
            if ($current->save()){
                $user = User::findOne([
                    'id' => $winUser
                ]);
                
                $profile = Profile::findOne([
                    'user_id' => $winUser
                ]);
                
                $product = Product::findOne($current->product_id);
                    
                Yii::$app->mailer
                    ->compose()
                    ->setTo(Yii::$app->params['adminEmail'])
                    // ->setTo('agapofff@gmail.com')
                    ->setFrom([
                        Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']
                    ])
                    ->setSubject(Yii::t('front', 'Состоялся розыгрыш') . ' - ' . Yii::$app->name)
                    ->setHtmlBody('
                        <p>Состоялся розыгрыш ' . Yii::$app->formatter->asDate($current->date_start, 'dd/MM') . '-' . Yii::$app->formatter->asDate($current->date_end, 'dd/MM') . '</p>
                        <p><strong>Товар</strong>: <a href="' . Url::to(['/product/' . $product->slug], true) . '">' . json_decode($product->name)->{Yii::$app->language} . '</p>
                        <p><strong>Победитель</strong>: ' . $profile->first_name . ' ' . $profile->last_name . '</p>
                        <p><strong>Выигравший код</strong>: ' . $scanToWinCodes->getCode($winCode) . '</p>
                        <p><strong>Телефон</strong>: ' . $profile->phone . '</p>
                        <p><strong>E-mail</strong>: ' . $user->email . '</p>
                    ')
                    ->send();
                    
                Yii::$app->language = $user->lang ?: Yii::$app->language; // меняем язык на язык пользователя
                    
                Yii::$app->mailer
                    ->compose('@common/mail/scan-to-win/win.php', [
                        'date_start' => Yii::$app->formatter->asDate($current->date_start, 'dd/MM'),
                        'date_end' => Yii::$app->formatter->asDate($current->date_end, 'dd/MM'),
                        'product_name' => json_decode($product->name)->{Yii::$app->language},
                        'product_description' => json_decode($product->text)->{Yii::$app->language},
                        'product_image' => Url::to($product->getImage()->getUrl('x250'), true),
                        'product_link' => Url::to('/product/' . $product->slug, true),
                        'code' => $scanToWinCodes->getCode($winCode),
                        'lang' => $user->lang ?: Yii::$app->language,
                    ])
                    ->setTo($user->email)
                    // ->setTo('agapofff@gmail.com')
                    ->setFrom([
                        Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']
                    ])
                    ->setSubject(Yii::t('front', 'Вы победили в розыгрыше') . ' ' . Yii::$app->name)
                    ->send();
					
				ScanToWinCodes::updateAll([
					'status' => 0
				]);
            } else {
                Yii::$app->mailer
                    ->compose()
                    ->setTo(Yii::$app->params['adminEmail'])
                    // ->setTo('agapofff@gmail.com')
                    ->setFrom([
                        Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']
                    ])
                    ->setSubject(Yi::t('front', 'Ошибка') . '! ' . Yii::t('front', 'Розыгрыш не состоялся') . ' - ' . Yii::$app->name)
                    ->setHtmlBody('
                        <p>' . Yii::t('front', 'Ошибка сервера! Попробуйте ещё раз чуть позже') . '</p>
                    ')
                    ->send();
            }
        }
    }
    
    
}