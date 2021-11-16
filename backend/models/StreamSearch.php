<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Stream;

/**
 * StreamSearch represents the model behind the search form of `backend\models\Stream`.
 */
class StreamSearch extends Stream
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['preview_ru', 'preview_vi', 'event_ru', 'event_vi', 'created_at', 'updated_at'], 'safe'],
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
        $query = Stream::find();

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

        $query->andFilterWhere(['like', 'preview_ru', $this->preview_ru])
            ->andFilterWhere(['like', 'preview_vi', $this->preview_vi])
            ->andFilterWhere(['like', 'event_ru', $this->event_ru])
            ->andFilterWhere(['like', 'event_vi', $this->event_vi]);

        return $dataProvider;
    }
}
