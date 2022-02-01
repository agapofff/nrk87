<?php

namespace backend\models;
use yii\web\UploadedFile;
use Yii;

class Experts extends \yii\db\ActiveRecord
{
    
    public $imageFile;
    public $saveAndExit = 0;
    
    public static function tableName()
    {
        return '{{%experts}}';
    }

    public function rules()
    {
        return [
            [['title_ru', 'title_vi', 'description_ru', 'description_vi'], 'required'],
            [['created_at', 'updated_at', 'saveAndExit'], 'safe'],
            [['title_ru', 'title_vi', 'description_ru', 'description_vi', 'image'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],
            [['publish'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'publish' => Yii::t('back', 'Публикация'),
            'title_ru' => Yii::t('back', 'Имя по-русски'),
            'title_vi' => Yii::t('back', 'Имя по-вьетнамски'),
            'description_ru' => Yii::t('back', 'Описание по-русски'),
            'description_vi' => Yii::t('back', 'Описание по-вьетнамски'),
            'image' => Yii::t('back', 'Изображение'),
            'imageFile' => Yii::t('back', 'Изображение'),
            'created_at' => Yii::t('back', 'Created At'),
            'updated_at' => Yii::t('back', 'Updated At'),
        ];
    }
    
    public function upload($fileName)
    {
        if ($this->validate()) {
            $this->imageFile->saveAs(Yii::getAlias('@frontend') . '/web/images/experts/' . $fileName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
    
}
