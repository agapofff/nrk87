<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ScanToWinStores;

/**
 * ScanToWinStoresSearch represents the model behind the search form of `backend\models\ScanToWinStores`.
 */
class ScanToWinStoresSearch extends ScanToWinStores
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'active', 'store_id', 'mlm'], 'integer'],
            [['name', 'currency', 'description'], 'safe'],
            [['sum'], 'number'],
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
