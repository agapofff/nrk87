<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%test_answers}}".
 *
 * @property int $id
 * @property int $question_id
 * @property int $name
 * @property int $correct
 * @property string $created_at
 * @property string $updated_at
 *
 * @property TestQuestions $question
 * @property TestPassings[] $testPassings
 */
class TestAnswers extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
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
            [['question_id', 'name'], 'required'],
            [['question_id', 'correct', 'active', 'saveAndExit'], 'integer'],
            [['name', 'created_at', 'updated_at'], 'safe'],
            [['name'], 'string'],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => TestQuestions::className(), 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
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
