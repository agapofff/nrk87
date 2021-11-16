<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%learn}}".
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_vi
 * @property string $created_at
 * @property string $updated_at
 */
class Learn extends \yii\db\ActiveRecord
{
    
    public $saveAndExit = 0;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%learn}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title_ru', 'title_vi'], 'required'],
            [['created_at', 'updated_at', 'saveAndExit'], 'safe'],
            [['title_ru', 'title_vi'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
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
