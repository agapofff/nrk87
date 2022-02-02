<?php

namespace backend\models;

use Yii;

class Stream extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%stream}}';
    }

    public function rules()
    {
        return [
            [['preview_ru', 'preview_vi', /* 'event_ru', 'event_vi' */], 'required'],
            [['publish'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['preview_ru', 'preview_vi', 'event_ru', 'event_vi'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'publish' => Yii::t('back', 'Публикация'),
            'preview_ru' => Yii::t('back', 'Ссылка на русское превью'),
            'preview_vi' => Yii::t('back', 'Ссылка на вьетнамское превью'),
            'event_ru' => Yii::t('back', 'Ссылка на русское событие'),
            'event_vi' => Yii::t('back', 'Ссылка на вьетнамское событие'),
            'created_at' => Yii::t('back', 'Created At'),
            'updated_at' => Yii::t('back', 'Updated At'),
        ];
    }
}
