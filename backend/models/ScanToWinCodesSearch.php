<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ScanToWinCodes;

class ScanToWinCodesSearch extends ScanToWinCodes
{

    public function rules()
    {
        return [
            [['id', 'user_id', 'order_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = ScanToWinCodes::find();
        
        $query->joinWith('user');

        // add conditions that should always apply here

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
            '{{%scan_to_win_codes}}.id' => $this->id,
            'user_id' => $this->user_id,
            '{{%scan_to_win_codes}}.status' => $this->status,
        ]);
        
        $query->andFilterWhere(['like', 'order_id', $this->order_id]);
        
        if(!empty($this->created_at) && strpos($this->created_at, '-') !== false) {
            $created_at = explode('-', $this->created_at);
            $start_date = explode('.', trim($created_at[0]));
            $end_date = explode('.', trim($created_at[1]));
            $query->andFilterWhere(['between', '{{%scan_to_win_codes}}.created_at', $start_date[2].'-'.$start_date[1].'-'.$start_date[0].' 00:00:00', $end_date[2].'-'.$end_date[1].'-'.$end_date[0].' 23:59:59']);
        }

        return $dataProvider;
    }
}
