<?php

namespace backend\models;

use Yii;

class TestAnswers extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    public static function tableName()
    {
        return '{{%test_answers}}';
    }

    public function rules()
    {
        return [
            [['question_id', 'name'], 'required'],
            [['question_id', 'correct', 'active', 'saveAndExit'], 'integer'],
            [['name', 'created_at', 'updated_at'], 'safe'],
            [['name'], 'string'],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => TestQuestions::className(), 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'active' => Yii::t('back', 'Активно'),
            'question_id' => Yii::t('back', 'Вопрос'),
            'name' => Yii::t('back', 'Текст ответа'),
            'correct' => Yii::t('back', 'Это правильный ответ?'),
            'created_at' => Yii::t('back', 'Создано'),
            'updated_at' => Yii::t('back', 'Изменено'),
        ];
    }

    public function getQuestion()
    {
        return $this->hasOne(TestQuestions::className(), ['id' => 'question_id']);
    }

    public function getTestPassings()
    {
        return $this->hasMany(TestPassings::className(), ['answer_id' => 'id']);
    }
}
