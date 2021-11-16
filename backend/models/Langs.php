<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%langs}}".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $active
 */
class Langs extends \yii\db\ActiveRecord
{
    
    public $saveAndExit = 0;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%langs}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code', 'currency'], 'required'],
            [['publish', 'saveAndExit'], 'integer'],
            [['name', 'code', 'currency'], 'string', 'max' => 255],
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
            'code' => Yii::t('back', 'Код (ISO-639)'),
            'publish' => Yii::t('back', 'Включено'),
            'currency' => Yii::t('back', 'Валюта (ISO-4217)'),
        ];
    }
}
