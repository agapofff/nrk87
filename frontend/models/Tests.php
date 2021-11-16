<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%tests}}".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
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
            [['created_at', 'updated_at'], 'safe'],
            [['active'], 'integer'],
            [['slug'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('front', 'ID'),
            'name' => Yii::t('front', 'Тест'),
            'slug' => Yii::t('front', 'Алиас'),
            'description' => Yii::t('front', 'Описание'),
            'created_at' => Yii::t('front', 'Создано'),
            'updated_at' => Yii::t('front', 'Изменено'),
            'active' => Yii::t('front', 'Активно'),
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

    /**
     * Gets query for [[TestResults]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestResults()
    {
        return $this->hasMany(TestResults::className(), ['test_id' => 'id']);
    }
}
