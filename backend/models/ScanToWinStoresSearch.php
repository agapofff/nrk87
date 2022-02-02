<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ScanToWinStores;

class ScanToWinStoresSearch extends ScanToWinStores
{

    public function rules()
    {
        return [
            [['id', 'active', 'store_id', 'mlm'], 'integer'],
            [['name', 'currency', 'description'], 'safe'],
            [['sum'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = ScanToWinStores::find();

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
            'active' => $this->active,
            'store_id' => $this->store_id,
            'sum' => $this->sum,
            'mlm' => $this->mlm,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
