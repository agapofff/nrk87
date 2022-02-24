<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%cities}}".
 *
 * @property int $id
 * @property int $active
 * @property int $ordering
 * @property string|null $name
 * @property int $slug
 * @property int $country_id
 *
 * @property Countries $country
 */
class Cities extends \yii\db\ActiveRecord
{
    public $saveAndExit;

    function behaviors()
    {
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
            ],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cities}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'country_id'], 'required'],
            [['active', 'ordering', 'country_id'], 'integer'],
            [['name', 'slug'], 'string'],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['country_id' => 'id']],
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
            'ordering' => Yii::t('back', 'Порядок'),
            'name' => Yii::t('back', 'Название'),
            'slug' => Yii::t('back', 'Алиас'),
            'country_id' => Yii::t('back', 'Страна'),
        ];
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }
}
