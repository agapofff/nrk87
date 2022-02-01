<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Answers;

class AnswersSearch extends Answers
{
    
    public $questions;
    
    public function rules()
    {
        return [
            [['id', 'question_id'], 'integer'],
            [['name', 'created_at', 'updated_at'], 'safe'],
            [['questions'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Answers::find();

        // add conditions that should always apply here
        
        $query->joinWith('questions');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['questions'] = [
            'asc' => ['{{%questions}}.name' => SORT_ASC],
            'desc' => ['{{%questions}}.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            '{{%answers}}.id' => $this->id,
            '{{%answers}}.question_id' => $this->question_id,
            '{{%answers}}.created_at' => $this->created_at,
            '{{%answers}}.updated_at' => $this->updated_at,
        ]);

        $query
            ->andFilterWhere(['like', '{{%answers}}.name', $this->name])
            ->andFilterWhere(['like', '{{%questions}}.name', $this->questions]);

        return $dataProvider;
    }
}
