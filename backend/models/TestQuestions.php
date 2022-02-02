<?php

namespace backend\models;

use Yii;

class TestQuestions extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
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

    public function getTestAnswers()
    {
        return $this->hasMany(TestAnswers::className(), ['question_id' => 'id']);
    }

    public function getTestPassings()
    {
        return $this->hasMany(TestPassings::className(), ['question_id' => 'id']);
    }

    public function getTest()
    {
        return $this->hasOne(Tests::className(), ['id' => 'test_id']);
    }
}
