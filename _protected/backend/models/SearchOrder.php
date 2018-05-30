<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Order;

/**
 * SearchOrder represents the model behind the search form about `backend\models\TblOrder`.
 */
class SearchOrder extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'orderstatus', 'order_customer_id'], 'integer'],
            [['ordertds', 'updated_at', 'status', 'firstname', 'lastname', 'dob', 'email', 'mobile', 'phone', 'add1', 'add2', 'city', 'county', 'postcode', 'country', 'notes', 'created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Order::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'order_id' => $this->order_id,
            'orderstatus' => $this->orderstatus,
            'ordertds' => $this->ordertds,
            'order_customer_id' => $this->order_customer_id,
            'dob' => $this->dob,
        ]);

        $query->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'add1', $this->add1])
            ->andFilterWhere(['like', 'add2', $this->add2])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'county', $this->county])
            ->andFilterWhere(['like', 'postcode', $this->postcode])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'created_at', $this->created_at]);

        return $dataProvider;
    }
}
