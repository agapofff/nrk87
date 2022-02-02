<?php

namespace backend\models;

use Yii;

class TestPassings extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%test_passings}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'session', 'ip', 'test_id', 'question_id', 'answer_id'], 'required'],
            [['user_id', 'test_id', 'question_id', 'answer_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['session', 'ip'], 'string', 'max' => 255],
            [['answer_id'], 'exist', 'skipOnError' => true, 'targetClass' => TestAnswers::className(), 'targetAttribute' => ['answer_id' => 'id']],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => TestQuestions::className(), 'targetAttribute' => ['question_id' => 'id']],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tests::className(), 'targetAttribute' => ['test_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'user_id' => Yii::t('back', 'Пользователь'),
            'session' => Yii::t('back', 'Сессия'),
            'ip' => Yii::t('back', 'IP'),
            'test_id' => Yii::t('back', 'Тест'),
            'question_id' => Yii::t('back', 'Вопрос'),
            'answer_id' => Yii::t('back', 'Ответ'),
            'created_at' => Yii::t('back', 'Создано'),
            'updated_at' => Yii::t('back', 'Обновлено'),
        ];
    }

    public function getAnswer()
    {
        return $this->hasOne(TestAnswers::className(), ['id' => 'answer_id']);
    }

    public function getQuestion()
    {
        return $this->hasOne(TestQuestions::className(), ['id' => 'question_id']);
    }

    public function getTest()
    {
        return $this->hasOne(Tests::className(), ['id' => 'test_id']);
    }
}
