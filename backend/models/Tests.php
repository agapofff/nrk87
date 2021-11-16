<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tests}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $active
 *
 * @property TestPassings[] $testPassings
 * @property TestQuestions[] $testQuestions
 * @property TestResults[] $testResults
 */
class Tests extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tests}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'description'], 'string'],
            [['saveAndExit'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['active'], 'integer'],
            [['slug'], 'string', 'max' => 30],
        ];
    }
    
    
    function behaviors()
    {
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'name' => Yii::t('back', 'Название'),
            'slug' => Yii::t('back', 'Алиас'),
            'description' => Yii::t('back', 'Описание'),
            'created_at' => Yii::t('back', 'Создано'),
            'updated_at' => Yii::t('back', 'Обновлено'),
            'active' => Yii::t('back', 'Активно'),
        ];
    }

    /**
     * Gets query for [[TestPassings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestPassings()
    {
        return $this->hasMany(TestPassings::className(), ['test_id' => 'id']);
    }

    /**
     * Gets query for [[TestQuestions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestQuestions()
    {
        return $this->hasMany(TestQuestions::className(), ['test_id' => 'id']);
    }
    
    
    public function getTestResults()
    {
        return $this->hasMany(TestResults::className(), ['test_id' => 'id']);
    }
    
    
}
