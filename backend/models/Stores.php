<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%stores}}".
 *
 * @property int $id
 * @property int $active
 * @property string $lang
 * @property int $type
 * @property int $store_id
 */
class Stores extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%stores}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active', 'type', 'store_id', 'saveAndExit'], 'integer'],
            [['lang', 'type', 'store_id'], 'required'],
            [['lang', 'name', 'currency', 'description'], 'string', 'max' => 255],
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
            'lang' => Yii::t('back', 'Язык'),
            'type' => Yii::t('back', 'Тип'),
            'store_id' => Yii::t('back', 'ID магазина'),
            'name' => Yii::t('back', 'Название'),
            'currency' => Yii::t('back', 'Валюта'),
            'description' => Yii::t('back', 'Описание'),
        ];
    }
    
}
