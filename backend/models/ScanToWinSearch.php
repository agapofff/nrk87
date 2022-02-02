<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ScanToWin;

class ScanToWinSearch extends ScanToWin
{
    
    public function rules()
    {
        return [
            [['id', 'product_id', 'winner_id', 'code_id', 'users_count', 'codes_count'], 'integer'],
            [['date_start', 'date_end', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = ScanToWin::find();

        // add conditions that should always apply here
        
        $query->joinWith([
            'product',
            'winner',
        ]);
        
        // $dataProvider->sort->attributes['product_id'] = [
            // 'asc' => ['{{%shop_product}}.name' => SORT_ASC],
            // 'desc' => ['{{%shop_product}}.name' => SORT_DESC],
        // ];
        
        // $dataProvider->sort->attributes['winner_id'] = [
            // 'asc' => ['{{%user}}.username' => SORT_ASC],
            // 'desc' => ['{{%user}}.username' => SORT_DESC],
        // ];

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ],
            ],
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
            'product_id' => $this->product_id,
            'winner_id' => $this->winner_id,
            'code_id' => $this->code_id,
            'users_count' => $this->users_count,
            'codes_count' => $this->codes_count,
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

        return $dataProvider;
    }
}
