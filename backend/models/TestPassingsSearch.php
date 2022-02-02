<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TestPassings;

class TestPassingsSearch extends TestPassings
{

    public function rules()
    {
        return [
            [['id', 'user_id', 'test_id', 'question_id', 'answer_id'], 'integer'],
            [['session', 'ip', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = TestPassings::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'test_id' => $this->test_id,
            'question_id' => $this->question_id,
            'answer_id' => $this->answer_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'session', $this->session])
            ->andFilterWhere(['like', 'ip', $this->ip]);

        return $dataProvider;
    }
}
