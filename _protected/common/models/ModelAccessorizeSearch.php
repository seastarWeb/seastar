<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TblProductLines;
use common\models\TblModelRange;
use yii\db\Query;
use himiklab\thumbnail\EasyThumbnailImage;
/**
 * ProductLineSearch represents the model behind the search form about `app\models\TblProductLines`.
 */
class ModelAccessorizeSearch extends VwModelProductLines
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['Department', 'Brand', 'Category', 'SubCategory', 'ProductLine', 'DefaultImage', 'Fitment', 'PartNumbers', 'Description','Colours','Sizes','Alias'], 'safe'],
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
       // die(var_dump($params));
        $query = VwModelProductLines::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query, 
            'sort'=>[
                'attributes'=>['Category','ProductLine'],
                'defaultOrder' => ['Category'=>'ASC','ProductLine' => 'ASC'],
            ],

            'pagination' => [
                'pageSize' => 24,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Alias' => $params,
        ]);

        $query
            ->andFilterWhere(['like', 'Category', $this->Category])
            ->andFilterWhere(['like', 'SubCategory', $this->SubCategory])
            ->andFilterWhere(['like', 'ProductLine', $this->ProductLine])
            ->andFilterWhere(['like', 'DefaultImage', $this->DefaultImage])
            ->andFilterWhere(['like', 'Fitment', $this->Fitment])
            ->andFilterWhere(['like', 'PartNumbers', $this->PartNumbers])
    	    ->andFilterWhere(['like', 'Description', $this->Description])
    	    ->andFilterWhere(['like', 'Colours', $this->Colours])
    	    ->andFilterWhere(['like', 'Sizes', $this->Sizes]);


        return $dataProvider;
    }
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchcats($params)
    {
        //die(var_dump($params));
        $query = VwModelProductLines::find()->groupBy('Category');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Alias' => $params,
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'attributes'=>['Category']
            ],
        ]);
        return $dataProvider;
    }

}