<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%answers}}".
 *
 * @property int $id
 * @property int $question_id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Questions $question
 * @property Votes[] $votes
 */
class Answers extends \yii\db\ActiveRecord
{
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
            [['created_at', 'updated_at'], 'safe'],
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
            'id' => Yii::t('front', 'ID'),
            'question_id' => Yii::t('front', 'Question ID'),
            'name' => Yii::t('front', 'Name'),
            'created_at' => Yii::t('front', 'Created At'),
            'updated_at' => Yii::t('front', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Question]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Questions::className(), ['id' => 'question_id']);
    }

    /**
     * Gets query for [[Votes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVotes()
    {
        return $this->hasMany(Votes::className(), ['answer_id' => 'id']);
    }
}
