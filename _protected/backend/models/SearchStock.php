<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UvwStockLevels;

/**
 * SearchVat represents the model behind the search form about `common\models\TblVat`.
 */
class SearchStock extends UvwStockLevels
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['InStock', 'StockValue','TotalPartNumbers','Department', 'Brand','Category','ProductLine'] ,'safe'],
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
        $query = UvwStockLevels::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
    }
    public function getDistinctCategories()
    {
        $query = UvwStockLevels::find()
        ->select(['Category','sum(InStock) AS StockLevel'])
        ->groupBy('Category')
        ->asArray()
        ->orderBy('Category')
        ->all();;
        return $query;
    }
    public function getDistinctBrands()
    {
        $query = UvwStockLevels::find()
        ->select(['Brand','sum(InStock) AS StockLevel'])
        ->groupBy('Brand')
        ->asArray()
        ->orderBy('Brand')
        ->all();;
        return $query;
    }
    public function getStockBrandValues()
    {
        $query = UvwStockLevels::find()
        ->select(['Brand','round(sum(StockValue),0) AS StockValue'])
        ->groupBy('Brand')
        ->asArray()
        ->orderBy('Brand')
        ->all();;
        return $query;
    }

}
