<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%registration}}".
 *
 * @property int $id
 * @property string $name
 * @property int $country
 * @property string $phone
 * @property string $email
 * @property string $promocode
 *
 * @property Countries $country0
 */
class Registration extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%registration}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'country', 'phone', 'email', 'promocode'], 'required'],
            [['country'], 'integer'],
            [['name', 'phone', 'email', 'promocode'], 'string', 'max' => 255],
            [['country'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['country' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('front', 'ID'),
            'name' => Yii::t('front', 'Name'),
            'country' => Yii::t('front', 'Country'),
            'phone' => Yii::t('front', 'Phone'),
            'email' => Yii::t('front', 'Email'),
            'promocode' => Yii::t('front', 'Promocode'),
        ];
    }

    /**
     * Gets query for [[Country0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry0()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country']);
    }
}
