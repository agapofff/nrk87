<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%test_questions}}".
 *
 * @property int $id
 * @property int $active
 * @property int $test_id
 * @property string $name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property string|null $image
 * @property string $text_right
 * @property string $text_wrong
 *
 * @property TestAnswers[] $testAnswers
 * @property TestPassings[] $testPassings
 * @property Tests $test
 */
class TestQuestions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%test_questions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active', 'test_id'], 'integer'],
            [['test_id', 'name', 'text_right', 'text_wrong'], 'required'],
            [['name', 'description', 'text_right', 'text_wrong'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['image'], 'string', 'max' => 255],
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
            'active' => Yii::t('front', 'Активно'),
            'test_id' => Yii::t('front', 'Тест'),
            'name' => Yii::t('front', 'Вопрос'),
            'description' => Yii::t('front', 'Описание'),
            'created_at' => Yii::t('front', 'Создано'),
            'updated_at' => Yii::t('front', 'Изменено'),
            'image' => Yii::t('front', 'Изображение'),
            'text_right' => Yii::t('front', 'Текст правильного ответа'),
            'text_wrong' => Yii::t('front', 'Текст неправильного ответа'),
        ];
    }

    /**
     * Gets query for [[TestAnswers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestAnswers()
    {
        return $this->hasMany(TestAnswers::className(), ['question_id' => 'id']);
    }

    /**
     * Gets query for [[TestPassings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestPassings()
    {
        return $this->hasMany(TestPassings::className(), ['question_id' => 'id']);
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
