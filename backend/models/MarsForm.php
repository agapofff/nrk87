<?php

namespace backend\models;

use Yii;

class MarsForm extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    public static function tableName()
    {
        return '{{%mars_form}}';
    }

    public function rules()
    {
        return [
            [['name', 'country', 'language', 'age', 'email'], 'required'],
            [['gender', 'age', 'user_id', 'saveAndExit'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'country', 'language', 'email', 'session', 'ip'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'name' => Yii::t('back', 'Имя'),
            'gender' => Yii::t('back', 'Пол'),
            'country' => Yii::t('back', 'Страна'),
            'language' => Yii::t('back', 'Язык'),
            'age' => Yii::t('back', 'Возраст'),
            'email' => Yii::t('back', 'E-mail'),
            'user_id' => Yii::t('back', 'Пользователь'),
            'session' => Yii::t('back', 'ID сессии'),
            'ip' => Yii::t('back', 'IP'),
            'created_at' => Yii::t('back', 'Создано'),
            'updated_at' => Yii::t('back', 'Обновлено'),
        ];
    }
}
