<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "help".
 *
 * @property int $id
 * @property string $name
 * @property string $content
 * @property int $active
 * @property int $ordering
 */
class Help extends \yii\db\ActiveRecord
{
    
    public $saveAndExit;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%help}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'content'], 'string'],
            [['active', 'ordering', 'saveAndExit'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'name' => Yii::t('back', 'Заголовок'),
            'content' => Yii::t('back', 'Контент'),
            'active' => Yii::t('back', 'Активно'),
            'ordering' => Yii::t('back', 'Порядок'),
        ];
    }
}
