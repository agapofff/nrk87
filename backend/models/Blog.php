<?php

namespace backend\models;

use Yii;

class Blog extends \yii\db\ActiveRecord
{
    
    public $saveAndExit = 0;

    function behaviors()
    {
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
            ],
            'images' => [
                'class' => 'dvizh\gallery\behaviors\AttachImages',
                'mode' => 'single',
                'quality' => 60,
                'galleryId' => 'blog',
                'allowExtensions' => ['jpg', 'jpeg', 'png'],
            ],
        ];
    }
    
    public static function tableName()
    {
        return '{{%blog}}';
    }

    public function rules()
    {
        return [
            [['active', 'category_id', 'saveAndExit'], 'integer'],
            [['date_published'], 'safe'],
            [['name', 'description', 'text', 'publisher'], 'string'],
            [['category_id'], 'required'],
            [['slug'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogCategories::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'active' => Yii::t('back', 'Активно'),
            'date_published' => Yii::t('back', 'Дата публикации'),
            'name' => Yii::t('back', 'Название'),
            'category_id' => Yii::t('back', 'Категория'),
            'description' => Yii::t('back', 'Описание'),
            'text' => Yii::t('back', 'Текст'),
            'publisher' => Yii::t('back', 'Издание'),
            'slug' => Yii::t('back', 'Алиас'),
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(BlogCategories::className(), ['id' => 'category_id']);
    }
}
