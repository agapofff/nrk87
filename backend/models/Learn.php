<?php

namespace backend\models;

use Yii;

class Learn extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    public static function tableName()
    {
        return '{{%learn}}';
    }

    public function rules()
    {
        return [
            [['title_ru', 'title_vi'], 'required'],
            [['created_at', 'updated_at', 'saveAndExit'], 'safe'],
            [['title_ru', 'title_vi'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'title_ru' => Yii::t('back', 'По-русски'),
            'title_vi' => Yii::t('back', 'По-вьетнамски'),
            'created_at' => Yii::t('back', 'Created At'),
            'updated_at' => Yii::t('back', 'Updated At'),
        ];
    }
}
