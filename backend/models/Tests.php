<?php

namespace backend\models;

use Yii;

class Tests extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    public static function tableName()
    {
        return '{{%tests}}';
    }

    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'description'], 'string'],
            [['saveAndExit'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['active'], 'integer'],
            [['slug'], 'string', 'max' => 30],
        ];
    }    
    
    function behaviors()
    {
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'name' => Yii::t('back', 'Название'),
            'slug' => Yii::t('back', 'Алиас'),
            'description' => Yii::t('back', 'Описание'),
            'created_at' => Yii::t('back', 'Создано'),
            'updated_at' => Yii::t('back', 'Обновлено'),
            'active' => Yii::t('back', 'Активно'),
        ];
    }

    public function getTestPassings()
    {
        return $this->hasMany(TestPassings::className(), ['test_id' => 'id']);
    }

    public function getTestQuestions()
    {
        return $this->hasMany(TestQuestions::className(), ['test_id' => 'id']);
    }
    
    public function getTestResults()
    {
        return $this->hasMany(TestResults::className(), ['test_id' => 'id']);
    }
    
}
