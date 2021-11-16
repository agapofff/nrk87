<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%test_questions}}".
 *
 * @property int $id
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
    
    public $saveAndExit;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%test_questions}}';
    }
    
    function behaviors()
    {
        return [
            'images' => [
                'class' => 'dvizh\gallery\behaviors\AttachImages',
                'mode' => 'gallery',
                'quality' => 80,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_id', 'name'], 'required'],
            [['test_id', 'active', 'saveAndExit'], 'integer'],
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
            'id' => Yii::t('back', 'ID'),
            'active' => Yii::t('back', 'Активно'),
            'test_id' => Yii::t('back', 'Тест'),
            'name' => Yii::t('back', 'Вопрос'),
            'description' => Yii::t('back', 'Описание'),
            'created_at' => Yii::t('back', 'Создано'),
            'updated_at' => Yii::t('back', 'Ищзменено'),
            'image' => Yii::t('back', 'Изображение'),
            'text_right' => Yii::t('back', 'Сообщение о правильном ответе'),
            'text_wrong' => Yii::t('back', 'Сообщение о неправильном ответе'),
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
