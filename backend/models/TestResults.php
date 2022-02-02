<?php

namespace backend\models;

use Yii;

class TestResults extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    public static function tableName()
    {
        return '{{%test_results}}';
    }

    public function rules()
    {
        return [
            [['min', 'max', 'name', 'description', 'test_id'], 'required'],
            [['min', 'max', 'test_id', 'active', 'saveAndExit'], 'integer'],
            [['name', 'description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tests::className(), 'targetAttribute' => ['test_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'min' => Yii::t('back', 'Min'),
            'max' => Yii::t('back', 'Max'),
            'name' => Yii::t('back', 'Статус'),
            'description' => Yii::t('back', 'Описание'),
            'test_id' => Yii::t('back', 'Тест'),
            'active' => Yii::t('back', 'Активно'),
            'created_at' => Yii::t('back', 'Created At'),
            'updated_at' => Yii::t('back', 'Updated At'),
        ];
    }

    public function getTest()
    {
        return $this->hasOne(Tests::className(), ['id' => 'test_id']);
    }
}
