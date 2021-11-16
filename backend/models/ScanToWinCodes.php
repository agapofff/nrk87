<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%scan_to_win_codes}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $order_id
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class ScanToWinCodes extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%scan_to_win_codes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'order_id'], 'required'],
            [['user_id', 'order_id', 'status', 'saveAndExit'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'Код'),
            'user_id' => Yii::t('back', 'Пользователь'),
            'order_id' => Yii::t('front', 'Номер заказа'),
            'status' => Yii::t('back', 'Статус'),
            'created_at' => Yii::t('back', 'Создано'),
            'updated_at' => Yii::t('back', 'Обновлено'),
        ];
    }
    
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    
    public function getCode($id)
    {
        $code = 'A0000000';
        $symbols = mb_strlen($id);
        $str = substr($code, 0, -$symbols) . $id;
        return $str;
    }
    
    
    public function getSecurePhone($phone)
    {
        $phone = str_replace('-', '',  str_replace(')', '', str_replace('(', '', $phone)));

        $start = substr($phone, 0, 2);
        $end = substr($phone, -4, 4);
        return '+' . $start . '******' . $end;
    }
    
    
    public function getWinnersUsers()
    {
        return ScanToWin::find()
            ->select('winner_id')
            ->where([
                'not', [
                    'winner_id' => null
                ]
            ])
            ->orderBy([
                'date_end' => SORT_DESC
            ])
            ->asArray()
            ->column();
    }
    
    
    public function getWinnersCodes()
    {
        return ScanToWin::find()
            ->where([
                'not', [
                    'code_id' => null
                ]
            ])
            ->select('code_id')
            ->asArray()
            ->column();
    }
    

    public function getCountUsers()
    {
        $winnersCodes = $this->getWinnersCodes();
        
        return ScanToWinCodes::find()
            ->select('user_id')
            // ->where('status = :status', [
                // 'status' => 1,
            // ])
            ->where([
                'not in', 'id', $winnersCodes
            ])
            ->distinct()
            ->count();
    }
    
    
    public function getCountCodes()
    {
        $winnersCodes = $this->getWinnersCodes();
        
        return ScanToWinCodes::find()
            // ->where('status = :status', [
                // 'status' => 1,
            // ])
            ->where([
                'not in', 'id', $winnersCodes
            ])
            ->count();
    }
    
    
    public function getUserCodes($user_id)
    {
       return ScanToWinCodes::find()
            ->where('user_id = :user_id', [
                'user_id' => $user_id,
            ])
            ->orderBy('created_at DESC, id DESC')
            ->all();
    }


    public function checkOrder($order_id)
    {
        if ($exists = ScanToWinCodes::findOne([
            'order_id' => $order_id
        ])){
            return json_encode([
                'status' => 'error',
                'code' => 1,
                'message' => Yii::t('front', 'Такой номер заказа ранее уже был введён.'),
            ]);
        }
        
        $order = [];
        $stores = ScanToWinStores::findAll([
            'active' => 1
        ]);
        if ($stores){
            Yii::$app->controllerNamespace = 'frontend\controllers';
            foreach ($stores as $store){
                $check = Yii::$app->runAction('curl', [
                    'url' => 'https://www.sessia.com/api/market/' . $store->store_id . '/orders/' . $order_id,
                ]);
                $order = json_decode($check, JSON_UNESCAPED_UNICODE);
                if (in_array('id', $order) && $order['id'] == $order_id){
                    break;
                } else {
                    unset($order);
                }
            }
            
            if (!isset($order)){
                return json_encode([
                    'status' => 'error',
                    'code' => 2,
                    'message' => Yii::t('front', 'Указанный Вами заказ не найден')
                ]);
            }
            
            if (!in_array('payment_status', $order) || $order['payment_status'] != 100){
                return json_encode([
                    'status' => 'error',
                    'code' => 3,
                    'message' => Yii::t('front', 'Заказ не оплачен')
                ]);
            }
            
            if (!in_array('bank_transaction_sum', $order) || $order['bank_transaction_sum'] < $store->sum){
                return json_encode([
                    'status' => 'error',
                    'code' => 4,
                    'message' => Yii::t('front', 'Минимальная сумма заказа') . ' - ' . Yii::$app->formatter->asCurrency(round($store->sum), $store->currency)
                ]);
            }
            
            return json_encode([
                'status' => 'success',
                'message' => $order,
            ]);
        }
        
        return json_encode([
            'status' => 'error',
            'code' => 0,
            'message' => Yii::t('front', 'Ошибка сервера! Попробуйте ещё раз чуть позже')
        ]);
    }
    
    
    public function updateStatus()
    {
        return ScanToWinCode::updateAll(['status' => 0], ['status' => 1]);
    }
    
}
