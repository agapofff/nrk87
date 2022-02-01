<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Questions;

/**
 * QuestionsSearch represents the model behind the search form of `backend\models\Questions`.
 */
class QuestionsSearch extends Questions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'date_start', 'date_end', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Questions::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        
        if(!empty($this->date_start) && strpos($this->date_start, '-') !== false) {
            $date_start = explode('-', $this->date_start);
            $start_date = explode('.', trim($date_start[0]));
            $end_date = explode('.', trim($date_start[1]));
            $query->andFilterWhere(['between', 'date_start', $start_date[2].'-'.$start_date[1].'-'.$start_date[0].' 00:00:00', $end_date[2].'-'.$end_date[1].'-'.$end_date[0].' 23:59:59']);
        }

        if(!empty($this->date_end) && strpos($this->date_end, '-') !== false) {
            $date_end = explode('-', $this->date_end);
            $start_date = explode('.', trim($date_end[0]));
            $end_date = explode('.', trim($date_end[1]));
            $query->andFilterWhere(['between', 'date_end', $start_date[2].'-'.$start_date[1].'-'.$start_date[0].' 00:00:00', $end_date[2].'-'.$end_date[1].'-'.$end_date[0].' 23:59:59']);
        }

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
