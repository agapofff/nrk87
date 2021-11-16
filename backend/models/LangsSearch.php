<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Langs;

/**
 * LangsSearch represents the model behind the search form of `backend\models\Langs`.
 */
class LangsSearch extends Langs
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'publish'], 'integer'],
            [['name', 'code', 'currency'], 'safe'],
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
        $query = Langs::find();

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
            'publish' => $this->publish,
        ]);

        $query
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
