<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%test_answers}}".
 *
 * @property int $id
 * @property int $active
 * @property int $question_id
 * @property string $name
 * @property int $correct
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TestQuestions $question
 * @property TestPassings[] $testPassings
 */
class TestAnswers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%test_answers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active', 'question_id', 'correct'], 'integer'],
            [['question_id', 'name'], 'required'],
            [['name'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => TestQuestions::className(), 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('front', 'ID'),
            'active' => Yii::t('front', 'Активно'),
            'question_id' => Yii::t('front', 'Вопрос'),
            'name' => Yii::t('front', 'Ответ'),
            'correct' => Yii::t('front', 'Это правильный ответ?'),
            'created_at' => Yii::t('front', 'Создано'),
            'updated_at' => Yii::t('front', 'Изменено'),
        ];
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
     * Gets query for [[TestPassings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestPassings()
    {
        return $this->hasMany(TestPassings::className(), ['answer_id' => 'id']);
    }
}
