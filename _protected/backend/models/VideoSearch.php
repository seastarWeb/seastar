<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TblVideoslides;

/**
 * VideoSearch represents the model behind the search form about `common\models\TblVideoslides`.
 */
class VideoSearch extends TblVideoslides
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'vid', 'model_id'], 'integer'],
            [['title', 'href', 'type', 'youtube', 'poster'], 'safe'],
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
        $query = TblVideoslides::find();

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
            'id' => $this->id,
            'vid' => $this->vid,
            'model_id' => $this->model_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'href', $this->href])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'youtube', $this->youtube])
            ->andFilterWhere(['like', 'poster', $this->poster]);

        return $dataProvider;
    }
} 