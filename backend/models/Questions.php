<?php

namespace backend\models;

use Yii;

class Questions extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    public static function tableName()
    {
        return '{{%questions}}';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['date_start', 'date_end', 'created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['saveAndExit'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'name' => Yii::t('back', 'Вопрос'),
            'date_start' => Yii::t('back', 'Начало'),
            'date_end' => Yii::t('back', 'Окончание'),
            'created_at' => Yii::t('back', 'Created At'),
            'updated_at' => Yii::t('back', 'Updated At'),
        ];
    }

    public function getAnswers()
    {
        return $this->hasMany(Answers::className(), ['question_id' => 'id']);
    }
    
    public function getVotes()
    {
        return $this->hasMany(Votes::className(), ['question_id' => 'id']);
    }
    
}
