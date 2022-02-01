<?php

namespace backend\models;

use Yii;

class Help extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    public static function tableName()
    {
        return '{{%help}}';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'content'], 'string'],
            [['active', 'ordering', 'saveAndExit'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'name' => Yii::t('back', 'Заголовок'),
            'content' => Yii::t('back', 'Контент'),
            'active' => Yii::t('back', 'Активно'),
            'ordering' => Yii::t('back', 'Порядок'),
        ];
    }
}
