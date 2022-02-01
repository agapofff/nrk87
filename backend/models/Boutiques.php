<?php

namespace backend\models;

use Yii;

class Boutiques extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    public static function tableName()
    {
        return '{{%boutiques}}';
    }
    
    function behaviors()
    {
        return [
            'images' => [
                'class' => 'dvizh\gallery\behaviors\AttachImages',
                'mode' => 'gallery',
                'quality' => 80,
            ],
        ];
    }

    public function rules()
    {
        return [
            [['id', 'active', 'saveAndExit', 'cssTop', 'cssLeft', 'note_position'], 'integer'],
            [['name', 'description'], 'required'],
            [['name', 'description', 'image', 'map', 'category'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'active' => Yii::t('back', 'Активно'),
            'name' => Yii::t('back', 'Название'),
            'description' => Yii::t('back', 'Описание'),
            'category' => Yii::t('back', 'Категория'),
            'image' => Yii::t('back', 'Изображение'),
            'map' => Yii::t('back', 'Карта'),
            'cssTop' => Yii::t('back', 'Отступ точки сверху (в процентах)'),
            'cssLeft' => Yii::t('back', 'Отступ точки слева (в процентах)'),
            'note_position' => Yii::t('back', 'Позиция надписи'),
        ];
    }
}
