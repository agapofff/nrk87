<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%addresses}}".
 *
 * @property int $id
 * @property int $active
 * @property int $ordering
 * @property int $country_id
 * @property int $city_id
 * @property string|null $address
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $worktime
 * @property string|null $lat
 * @property string|null $lon
 *
 * @property Cities $city
 * @property Countries $country
 */
class Addresses extends \yii\db\ActiveRecord
{
    public $saveAndExit;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addresses}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active', 'ordering', 'country_id', 'city_id', 'saveAndExit'], 'integer'],
            [['country_id', 'city_id'], 'required'],
            [['address', 'worktime'], 'string'],
            [['email', 'phone', 'lat', 'lon'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
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
            'country_id' => Yii::t('back', 'Страна'),
            'city_id' => Yii::t('back', 'Город'),
            'address' => Yii::t('back', 'Адрес'),
            'email' => Yii::t('back', 'E-mail'),
            'phone' => Yii::t('back', 'Телефон'),
            'worktime' => Yii::t('back', 'Режим работы'),
            'lat' => Yii::t('back', 'Широта'),
            'lon' => Yii::t('back', 'Долгота'),
        ];
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
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
