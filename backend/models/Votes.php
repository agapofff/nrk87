<?php

namespace backend\models;

use Yii;

class Votes extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    public static function tableName()
    {
        return '{{%votes}}';
    }

    public function rules()
    {
        return [
            [['question_id', 'answer_id', 'ip'], 'required'],
            [['question_id', 'answer_id'], 'integer'],
            [['created_at', 'updated_at', 'saveAndExit'], 'safe'],
            [['ip'], 'string', 'max' => 45],
            [['answer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Answers::className(), 'targetAttribute' => ['answer_id' => 'id']],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'question_id' => Yii::t('back', 'Вопрос'),
            'answer_id' => Yii::t('back', 'Ответ'),
            'ip' => Yii::t('back', 'IP'),
            'created_at' => Yii::t('back', 'Created At'),
            'updated_at' => Yii::t('back', 'Updated At'),
            'questions' => Yii::t('back', 'Вопрос'),
            'answers' => Yii::t('back', 'Ответ'),
        ];
    }

    public function getAnswers()
    {
        return $this->hasOne(Answers::className(), ['id' => 'answer_id']);
    }

    public function getQuestions()
    {
        return $this->hasOne(Questions::className(), ['id' => 'question_id']);
    }
}
