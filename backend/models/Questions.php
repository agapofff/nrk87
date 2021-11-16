<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%questions}}".
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_vi
 * @property string $date_start
 * @property string $date_end
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Answers[] $answers
 */
class Questions extends \yii\db\ActiveRecord
{
    
    public $saveAndExit = 0;
    
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
            [['date_start', 'date_end', 'created_at', 'updated_at', 'saveAndExit'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'name' => Yii::t('back', 'Вопрос'),
            'date_start' => Yii::t('back', 'Начало'),
            'date_end' => Yii::t('back', 'Окончание'),
            'created_at' => Yii::t('back', 'Created At'),
            'updated_at' => Yii::t('back', 'Updated At'),
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
