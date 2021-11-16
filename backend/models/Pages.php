<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%pages}}".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $text
 */
class Pages extends \yii\db\ActiveRecord
{
    
    public $saveAndExit = 0;

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
        return '{{%pages}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'text'], 'string'],
            [['active'], 'integer'],
            [['saveAndExit'], 'safe'],
            [['slug'], 'string', 'max' => 255],
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
            'name' => Yii::t('back', 'Название'),
            'slug' => Yii::t('back', 'Алиас'),
            'text' => Yii::t('back', 'Текст'),
        ];
    }
}
