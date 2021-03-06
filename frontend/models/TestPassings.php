<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%test_passings}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $session
 * @property string $ip
 * @property int $test_id
 * @property int $question_id
 * @property int $answer_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TestAnswers $answer
 * @property TestQuestions $question
 * @property Tests $test
 */
class TestPassings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%test_passings}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_id', 'question_id', 'answer_id'], 'required'],
            [['user_id', 'test_id', 'question_id', 'answer_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['session', 'ip'], 'string', 'max' => 255],
            [['answer_id'], 'exist', 'skipOnError' => true, 'targetClass' => TestAnswers::className(), 'targetAttribute' => ['answer_id' => 'id']],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => TestQuestions::className(), 'targetAttribute' => ['question_id' => 'id']],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tests::className(), 'targetAttribute' => ['test_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('front', 'ID'),
            'user_id' => Yii::t('front', 'Пользователь'),
            'session' => Yii::t('front', 'Сессия'),
            'ip' => Yii::t('front', 'IP'),
            'test_id' => Yii::t('front', 'Тест'),
            'question_id' => Yii::t('front', 'Вопрос'),
            'answer_id' => Yii::t('front', 'Ответ'),
            'created_at' => Yii::t('front', 'Создано'),
            'updated_at' => Yii::t('front', 'Изменено'),
        ];
    }

    /**
     * Gets query for [[Answer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswer()
    {
        return $this->hasOne(TestAnswers::className(), ['id' => 'answer_id']);
    }

    /**
     * Gets query for [[Question]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(TestQuestions::className(), ['id' => 'question_id']);
    }

    /**
     * Gets query for [[Test]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Tests::className(), ['id' => 'test_id']);
    }
}
