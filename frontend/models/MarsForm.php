<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%mars_form}}".
 *
 * @property int $id
 * @property string $name
 * @property int $gender
 * @property string $country
 * @property string $language
 * @property int $age
 * @property string $email
 * @property int|null $user_id
 * @property string|null $session
 * @property string|null $ip
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class MarsForm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%mars_form}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'country', 'language', 'age', 'email'], 'required'],
            [['gender', 'age', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'country', 'language', 'email', 'session', 'ip'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('front', 'ID'),
            'name' => Yii::t('front', 'Полное имя'),
            'gender' => Yii::t('front', 'Пол'),
            'country' => Yii::t('front', 'Страна рождения'),
            'language' => Yii::t('front', 'Ваш родной язык'),
            'age' => Yii::t('front', 'Ваш возраст'),
            'email' => Yii::t('front', 'E-mail'),
            'user_id' => Yii::t('front', 'User ID'),
            'session' => Yii::t('front', 'Session'),
            'ip' => Yii::t('front', 'Ip'),
            'created_at' => Yii::t('front', 'Created At'),
            'updated_at' => Yii::t('front', 'Updated At'),
        ];
    }
}
