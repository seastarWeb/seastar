<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Models;

/**
 * SearchModels represents the model behind the search form about `common\models\Models`.
 */
class SearchModels extends Models
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','model_range_id'], 'integer'],
            [['model_description', 'make', 'model', 'year'], 'safe'],
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
        $query = Models::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->setSort([
		'attributes'=>[
		'year'=>SORT_DESC,
		'model_description'=>SORT_DESC,]
		]);
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        if ($this->model_range_id && is_array($this->model_range_id)) {
            $ids = explode(',', $this->model_range_id);
            $query->andFilterWhere(['model_range_id' => $ids]);
        }else{
            $query->andFilterWhere(['=', 'model_range_id', $this->model_range_id]) ;
        }

//	$filtre[]='12,15';
        $query->andFilterWhere(['like', 'model_description', $this->model_description])
            ->andFilterWhere(['like', 'make', $this->make])
           
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'year', $this->year]);
      //      ->andFilterWhere(['model_range_id'=>$filtre]);

        return $dataProvider;
    }
}
