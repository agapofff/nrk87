<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%meta_tags}}".
 *
 * @property int $id
 * @property string $link
 * @property string $title
 * @property string $description
 * @property string $h1
 */
class MetaTags extends \yii\db\ActiveRecord
{
    
    public $saveAndExit = 0;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%meta_tags}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['link', 'title', 'description', 'h1'], 'required'],
            [['description'], 'string'],
            [['saveAndExit', 'active'], 'integer'],
            [['link', 'title', 'h1'], 'string', 'max' => 255],
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
            'link' => Yii::t('back', 'Ссылка'),
            'title' => Yii::t('back', 'Title'),
            'description' => Yii::t('back', 'Description'),
            'h1' => Yii::t('back', 'H1'),
        ];
    }
}
