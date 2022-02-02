<?php

namespace backend\models;

use Yii;

class ScanToWinStores extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    public static function tableName()
    {
        return '{{%scan_to_win_stores}}';
    }

    public function rules()
    {
        return [
            [['active', 'store_id', 'mlm', 'saveAndExit'], 'integer'],
            [['store_id', 'name'], 'required'],
            [['sum'], 'number'],
            [['name', 'currency', 'description'], 'string', 'max' => 255],
            [['store_id'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'active' => Yii::t('back', 'Активно'),
            'store_id' => Yii::t('back', 'ID магазина'),
            'name' => Yii::t('back', 'Название'),
            'currency' => Yii::t('back', 'Валюта'),
            'sum' => Yii::t('back', 'Мин.сумма'),
            'mlm' => Yii::t('back', 'МЛМ'),
            'description' => Yii::t('back', 'Описание'),
        ];
    }
}
