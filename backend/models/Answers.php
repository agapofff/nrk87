<?php

namespace backend\models;

use Yii;

class Answers extends \yii\db\ActiveRecord
{
    
    public $saveAndExit = 0;
    
    public static function tableName()
    {
        return '{{%answers}}';
    }

    public function rules()
    {
        return [
            [['question_id', 'name'], 'required'],
            [['question_id'], 'integer'],
            [['created_at', 'updated_at', 'saveAndExit'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'question_id' => Yii::t('back', 'Question ID'),
            'name' => Yii::t('back', 'Ответ'),
            'created_at' => Yii::t('back', 'Created At'),
            'updated_at' => Yii::t('back', 'Updated At'),
            'questions' => Yii::t('back', 'Вопрос'),
        ];
    }

    public function getQuestions()
    {
        return $this->hasOne(Questions::className(), ['id' => 'question_id']);
    }
    
}
