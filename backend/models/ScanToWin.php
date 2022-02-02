<?php

namespace backend\models;

use Yii;

class ScanToWin extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    public static function tableName()
    {
        return '{{%scan_to_win}}';
    }

    public function rules()
    {
        return [
            [['date_start', 'date_end', 'created_at', 'updated_at'], 'safe'],
            [['product_id', 'winner_id', 'code_id', 'users_count', 'codes_count', 'saveAndExit'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShopProduct::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['winner_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['winner_id' => 'id']],
            [['code_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScanToWinCodes::className(), 'targetAttribute' => ['code_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'date_start' => Yii::t('back', 'Начало'),
            'date_end' => Yii::t('back', 'Окончание'),
            'product_id' => Yii::t('back', 'Товар'),
            'winner_id' => Yii::t('back', 'Победитель'),
            'code_id' => Yii::t('back', 'Код'),
            'users_count' => Yii::t('back', 'Участников'),
            'codes_count' => Yii::t('back', 'Кодов'),
            'created_at' => Yii::t('back', 'Создано'),
            'updated_at' => Yii::t('back', 'Обновлено'),
        ];
    }


    public function getProduct()
    {
        return $this->hasOne(ShopProduct::className(), ['id' => 'product_id']);
    }


    public function getWinner()
    {
        return $this->hasOne(User::className(), ['id' => 'winner_id']);
    }
    
    public function getCode()
    {
        return $this->hasOne(ScanToWinCodes::className(), ['id' => 'code_id']);
    }
    
    public function getCountUsers(int $countUsers)
    {
        return str_replace(
            $countUsers,
            '<span>' . $countUsers . '</span>',
            Yii::t('back', '{number, plural, one{# участник} few{# участника} many{# учасников} other{# участника}}', [
                'number' => $countUsers,
            ])
        );
    }

    public function getCountCodes(int $countCodes)
    {
        return str_replace(
            $countCodes,
            '<span>' . $countCodes . '</span>',
            Yii::t('back', '{number} участвующих номеров', [
                'number' => $countCodes,
            ])
        );
    }
    
    public function getCurrent()
    {
        $model = ScanToWin::find()
            ->where('date_start <= :date AND date_end >= :date', [
                'date' => date('Y-m-d H:i:s'),
            ])
            ->one();
            
        if (!$model) {
            return false;
        }
        return $model;
    }
}
