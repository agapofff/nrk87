<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%message}}".
 *
 * @property int $id
 * @property string $language
 * @property string|null $translation
 *
 * @property SourceMessage $id0
 */
class Message extends \yii\db\ActiveRecord
{
    
    public $saveAndExit = 0;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%message}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'language'], 'required'],
            [['id'], 'integer'],
            [['translation'], 'string'],
            [['language'], 'string', 'max' => 16],
            [['id', 'language'], 'unique', 'targetAttribute' => ['id', 'language']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => SourceMessage::className(), 'targetAttribute' => ['id' => 'id']],
            [['saveAndExit'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'sourceMessage' => Yii::t('back', 'Константа'),
            'language' => Yii::t('back', 'Язык'),
            'translation' => Yii::t('back', 'Перевод'),
        ];
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSourceMessage()
    {
        return $this->hasOne(SourceMessage::className(), ['id' => 'id']);
    }
}
