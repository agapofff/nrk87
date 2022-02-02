<?php

namespace backend\models;

use Yii;

class PastEvents extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    public static function tableName()
    {
        return '{{%past_events}}';
    }

    public function rules()
    {
        return [
            [['title_ru', 'title_vi', 'video_ru'], 'required'],
            [['event_date', 'created_at', 'updated_at'], 'safe'],
            [['title_ru', 'title_vi', 'video_ru', 'video_vi'], 'string', 'max' => 255],
            [['saveAndExit'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'title_ru' => Yii::t('back', 'Название по-русски'),
            'title_vi' => Yii::t('back', 'Название по-вьетнамски'),
            'event_date' => Yii::t('back', 'Дата события'),
            'video_ru' => Yii::t('back', 'Ссылка на русское видео'),
            'video_vi' => Yii::t('back', 'Ссылка на вьетнамское видео'),
            'created_at' => Yii::t('back', 'Created At'),
            'updated_at' => Yii::t('back', 'Updated At'),
        ];
    }

}
