<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%promocodes}}".
 *
 * @property int $id
 * @property int $publish
 * @property string $code
 * @property int $type
 * @property string $description
 */
class Promocodes extends \yii\db\ActiveRecord
{
    
    public $saveAndExit = 0;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%promocodes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['publish', 'type', 'saveAndExit'], 'integer'],
            [['code', 'description'], 'required'],
            [['code', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'publish' => Yii::t('back', 'Активно'),
            'code' => Yii::t('back', 'Промокод'),
            'type' => Yii::t('back', 'Магазин'),
            'description' => Yii::t('back', 'Описание'),
        ];
    }
}
