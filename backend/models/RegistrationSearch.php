<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Registration;

/**
 * RegistrationSearch represents the model behind the search form of `backend\models\Registration`.
 */
class RegistrationSearch extends Registration
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'country', 'client_id'], 'integer'],
            [['name', 'phone', 'email', 'promocode', 'event', 'datetime'], 'safe'],
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
        $query = Registration::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
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
            'country' => $this->country,
        ]);
        
        if(!empty($this->datetime) && strpos($this->datetime, '-') !== false) {
            $datetime = explode('-', $this->datetime);
            $start_date = explode('.', trim($datetime[0]));
            $end_date = explode('.', trim($datetime[1]));
            $query->andFilterWhere(['between', 'datetime', $start_date[2].'-'.$start_date[1].'-'.$start_date[0].' 00:00:00', $end_date[2].'-'.$end_date[1].'-'.$end_date[0].' 23:59:59']);
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'client_id', $this->client_id])
            ->andFilterWhere(['like', 'event', $this->event])
            ->andFilterWhere(['like', 'promocode', $this->promocode]);

        return $dataProvider;
    }
}
