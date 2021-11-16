<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%questions}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $date_start
 * @property string|null $date_end
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Answers[] $answers
 * @property Votes[] $votes
 */
class Questions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%questions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['date_start', 'date_end', 'created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('front', 'ID'),
            'name' => Yii::t('front', 'Name'),
            'date_start' => Yii::t('front', 'Date Start'),
            'date_end' => Yii::t('front', 'Date End'),
            'created_at' => Yii::t('front', 'Created At'),
            'updated_at' => Yii::t('front', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Answers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answers::className(), ['question_id' => 'id']);
    }

    /**
     * Gets query for [[Votes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVotes()
    {
        return $this->hasMany(Votes::className(), ['question_id' => 'id']);
    }
}
