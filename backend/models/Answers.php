<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%answers}}".
 *
 * @property int $id
 * @property int $question_id
 * @property string $title_ru
 * @property string $title_vi
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Questions $question
 */
class Answers extends \yii\db\ActiveRecord
{
    
    public $saveAndExit = 0;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%answers}}';
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
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

    /**
     * Gets query for [[Question]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasOne(Questions::className(), ['id' => 'question_id']);
    }
    
}
