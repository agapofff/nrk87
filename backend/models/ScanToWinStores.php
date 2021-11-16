<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%scan_to_win_stores}}".
 *
 * @property int $id
 * @property int $active
 * @property int $store_id
 * @property string $name
 * @property string $currency
 * @property float $sum
 * @property int $mlm
 * @property string $description
 */
class ScanToWinStores extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%scan_to_win_stores}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active', 'store_id', 'mlm', 'saveAndExit'], 'integer'],
            [['store_id', 'name'], 'required'],
            [['sum'], 'number'],
            [['name', 'currency', 'description'], 'string', 'max' => 255],
            [['store_id'], 'unique'],
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
            'store_id' => Yii::t('back', 'ID магазина'),
            'name' => Yii::t('back', 'Название'),
            'currency' => Yii::t('back', 'Валюта'),
            'sum' => Yii::t('back', 'Мин.сумма'),
            'mlm' => Yii::t('back', 'МЛМ'),
            'description' => Yii::t('back', 'Описание'),
        ];
    }
}
