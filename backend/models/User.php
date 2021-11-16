<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property int|null $confirmed_at
 * @property string|null $unconfirmed_email
 * @property int|null $blocked_at
 * @property string|null $registration_ip
 * @property int $created_at
 * @property int $updated_at
 * @property int $flags
 * @property int|null $last_login_at
 * @property string|null $password_reset_token
 * @property int $status
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $phone
 * @property string|null $birthday
 * @property int $sex
 * @property string|null $comment
 * @property int $agree
 * @property int $lottery
 *
 * @property Profile $profile
 * @property SocialAccount[] $socialAccounts
 * @property Token[] $tokens
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'auth_key', 'created_at', 'updated_at'], 'required'],
            [['confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'flags', 'last_login_at', 'status', 'sex', 'agree', 'lottery'], 'integer'],
            [['birthday'], 'safe'],
            [['comment'], 'string'],
            [['username', 'email', 'unconfirmed_email', 'password_reset_token', 'first_name', 'last_name', 'phone'], 'string', 'max' => 255],
            [['password_hash'], 'string', 'max' => 60],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 45],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'username' => Yii::t('back', 'Username'),
            'email' => Yii::t('back', 'Email'),
            'password_hash' => Yii::t('back', 'Password Hash'),
            'auth_key' => Yii::t('back', 'Auth Key'),
            'confirmed_at' => Yii::t('back', 'Confirmed At'),
            'unconfirmed_email' => Yii::t('back', 'Unconfirmed Email'),
            'blocked_at' => Yii::t('back', 'Blocked At'),
            'registration_ip' => Yii::t('back', 'Registration Ip'),
            'created_at' => Yii::t('back', 'Created At'),
            'updated_at' => Yii::t('back', 'Updated At'),
            'flags' => Yii::t('back', 'Flags'),
            'last_login_at' => Yii::t('back', 'Last Login At'),
            'password_reset_token' => Yii::t('back', 'Password Reset Token'),
            'status' => Yii::t('back', 'Status'),
            'first_name' => Yii::t('back', 'First Name'),
            'last_name' => Yii::t('back', 'Last Name'),
            'phone' => Yii::t('back', 'Phone'),
            'birthday' => Yii::t('back', 'Birthday'),
            'sex' => Yii::t('back', 'Sex'),
            'comment' => Yii::t('back', 'Comment'),
            'agree' => Yii::t('back', 'Agree'),
            'lottery' => Yii::t('back', 'Lottery'),
        ];
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[SocialAccounts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSocialAccounts()
    {
        return $this->hasMany(SocialAccount::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Tokens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTokens()
    {
        return $this->hasMany(Token::className(), ['user_id' => 'id']);
    }
}
