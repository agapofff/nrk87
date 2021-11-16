<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%redirects}}".
 *
 * @property int $id
 * @property int $type
 * @property string $link_from
 * @property string $link_to
 */
class Redirects extends \yii\db\ActiveRecord
{
    
    public $saveAndExit = 0;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%redirects}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'active', 'saveAndExit'], 'integer'],
            [['link_from', 'link_to'], 'required'],
            [['link_from', 'link_to'], 'string', 'max' => 255],
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
            'type' => Yii::t('back', 'Тип'),
            'link_from' => Yii::t('back', 'Ссылка'),
            'link_to' => Yii::t('back', 'Редирект'),
        ];
    }
}
