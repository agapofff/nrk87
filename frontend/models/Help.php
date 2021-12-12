<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%help}}".
 *
 * @property int $id
 * @property string $name
 * @property string $content
 * @property int $active
 * @property int $ordering
 */
class Help extends \yii\db\ActiveRecord
{
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
            [['name', 'content'], 'required'],
            [['name', 'content'], 'string'],
            [['active', 'ordering'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('front', 'ID'),
            'name' => Yii::t('front', 'Name'),
            'content' => Yii::t('front', 'Content'),
            'active' => Yii::t('front', 'Active'),
            'ordering' => Yii::t('front', 'Ordering'),
        ];
    }
}
