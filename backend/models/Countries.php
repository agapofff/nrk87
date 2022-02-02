<?php

namespace backend\models;

use Yii;

class Countries extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    public static function tableName()
    {
        return '{{%countries}}';
    }

    public function rules()
    {
        return [
            [['publish', 'selected', 'country_id', 'code'], 'integer'],
            [['code', 'country_id', 'name'], 'required'],
            [['created_at', 'updated_at', 'saveAndExit'], 'safe'],
            [['name', 'mask', 'icon', 'lang'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'publish' => Yii::t('back', 'Публикация'),
            'selected' => Yii::t('back', 'По умолчанию'),
            'code' => Yii::t('back', 'Код номера телефона'),
            'country_id' => Yii::t('back', 'ID страны'),
            'name' => Yii::t('back', 'Название'),
            'lang' => Yii::t('back', 'Код языка'),
            'mask' => Yii::t('back', 'Маска телефона'),
            'icon' => Yii::t('back', 'Изображение'),
            'created_at' => Yii::t('back', 'Created At'),
            'updated_at' => Yii::t('back', 'Updated At'),
        ];
    }
    
    public function unselect($id)
    {
        return Yii::$app->db->createCommand("UPDATE {{%countries}} SET selected = 0 WHERE id <> :id")
            ->bindValues([
                ':id' => $id
            ])
            ->execute();
    }
    
    
}
