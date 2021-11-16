<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%test_results}}".
 *
 * @property int $id
 * @property int $min
 * @property int $max
 * @property string $name
 * @property string $description
 * @property int $test_id
 * @property int $active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Tests $test
 */
class TestResults extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%test_results}}';
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
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
