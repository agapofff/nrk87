<?php

namespace backend\models;

use Yii;

class Registration extends \yii\db\ActiveRecord
{
    
    public $saveAndExit = 0;
    
    public static function tableName()
    {
        return '{{%registration}}';
    }

    public function rules()
    {
        return [
            [['name', 'country', 'phone', 'email', 'promocode'], 'required'],
            [['name', 'phone', 'promocode', 'datetime'], 'safe'],
            ['email', 'email', 'enableIDN' => true],
            [['country', 'saveAndExit', 'client_id'], 'integer'],
            [['name', 'phone', 'email', 'promocode', 'event'], 'string', 'max' => 255],
            [['country'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['country' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'name' => Yii::t('back', 'Имя'),
            'country' => Yii::t('back', 'Страна'),
            'phone' => Yii::t('back', 'Телефон'),
            'email' => Yii::t('back', 'Email'),
            'promocode' => Yii::t('back', 'Код клиента'),
            'countries' => Yii::t('back', 'Страна'),
            'event' => Yii::t('back', 'Событие'),
            'datetime' => Yii::t('back', 'Дата и время'),
            'client_id' => Yii::t('back', '№ участника'),
        ];
    }

    public function getCountries()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country']);
    }
}
