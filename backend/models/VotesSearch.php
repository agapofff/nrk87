<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Votes;

class VotesSearch extends Votes
{
    
    public $questions;
    
    public $answers;
    
    public function rules()
    {
        return [
            [['id', 'question_id', 'answer_id'], 'integer'],
            [['ip', 'created_at', 'updated_at'], 'safe'],
            [['questions', 'answers'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Votes::find();

        // add conditions that should always apply here
        
        $query->joinWith(['questions', 'answers']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ],
            ],
        ]);
        
        $dataProvider->sort->attributes['questions'] = [
            'asc' => ['{{%questions}}.name' => SORT_ASC],
            'desc' => ['{{%questions}}.name' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['answers'] = [
            'asc' => ['{{%answers}}.name' => SORT_ASC],
            'desc' => ['{{%answers}}.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            '{{%votes}}.id' => $this->id,
            '{{%votes}}.question_id' => $this->question_id,
            '{{%votes}}.answer_id' => $this->answer_id,
            '{{%votes}}.created_at' => $this->created_at,
            '{{%votes}}.updated_at' => $this->updated_at,
        ]);

        $query
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', '{{%questions}}.name', $this->questions])
            ->andFilterWhere(['like', '{{%answers}}.name', $this->answers]);

        return $dataProvider;
    }
    
    public function getResults($params)
    {

        $this->load($params);

        $results = Yii::$app->db->createCommand("SELECT A.name, count(V.answer_id) as votes FROM {{%votes}} as V, {{%answers}} as A WHERE V.answer_id = A.id AND V.question_id = :question_id GROUP BY V.answer_id ORDER BY votes DESC")
            ->bindValue(':question_id', $this->question_id)
            ->queryAll();
            
        return $results;
    }
}
