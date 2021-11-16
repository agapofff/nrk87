<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%votes}}".
 *
 * @property int $id
 * @property int $question_id
 * @property int $answer_id
 * @property string $ip
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Answers $answer
 * @property Questions $question
 */
class Votes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%votes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id', 'answer_id', 'ip'], 'required'],
            [['question_id', 'answer_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['ip'], 'string', 'max' => 45],
            [['answer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Answers::className(), 'targetAttribute' => ['answer_id' => 'id']],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('front', 'ID'),
            'question_id' => Yii::t('front', 'Question ID'),
            'answer_id' => Yii::t('front', 'Answer ID'),
            'ip' => Yii::t('front', 'Ip'),
            'created_at' => Yii::t('front', 'Created At'),
            'updated_at' => Yii::t('front', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Answer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnswer()
    {
        return $this->hasOne(Answers::className(), ['id' => 'answer_id']);
    }

    /**
     * Gets query for [[Question]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Questions::className(), ['id' => 'question_id']);
    }
	
	
    public function getResults($question_id)
    {
		$results = [];
		
		$asks = Yii::$app->db->createCommand("SELECT A.name, count(V.answer_id) as votes FROM {{%votes}} as V, {{%answers}} as A WHERE V.answer_id = A.id AND V.question_id = :question_id GROUP BY V.answer_id ORDER BY votes DESC")
			->bindValue(':question_id', $question_id)
			->queryAll();
			
		if ($asks){
			$sum = array_sum(ArrayHelper::getColumn($asks, 'votes'));
			foreach ($asks as $ask){
				$results[] = [
					'name' => Yii::t('front', $ask['name']),
					'votes' => $ask['votes'],
					'percent' => round(($ask['votes'] / $sum) * 100)
				];
			}
		}
            
        return $results;
    }
}
