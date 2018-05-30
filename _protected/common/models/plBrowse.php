<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TblProductLines;

/**
 * ProductLineSearch represents the model behind the search form about `app\models\TblProductLines`.
 */
class plBrowse extends TblProductLines
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['Department', 'Brand', 'Category', 'SubCategory', 'ProductLine', 'DefaultImage', 'Fitment', 'PartNumbers', 'Description','Colours','Sizes','Url','Slug'], 'safe'],
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
        $query = TblProductLines::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'Department', $this->Department])
            ->andFilterWhere(['like', 'Brand', $this->Brand])
            ->andFilterWhere(['like', 'Category', $this->Category])
            ->andFilterWhere(['like', 'SubCategory', $this->SubCategory])
            ->andFilterWhere(['like', 'ProductLine', $this->ProductLine])
            ->andFilterWhere(['like', 'DefaultImage', $this->DefaultImage])
            ->andFilterWhere(['like', 'Fitment', $this->Fitment])
            ->andFilterWhere(['like', 'PartNumbers', $this->PartNumbers])
	    ->andFilterWhere(['like', 'Description', $this->Description])
	    ->andFilterWhere(['like', 'Colours', $this->Colours])
	    ->andFilterWhere(['like', 'Sizes', $this->Sizes])
	    ->andFilterWhere(['like', 'Url', $this->Url]);


        return $dataProvider;
    }
    public function categories()
    {
        $query = TblProductLines::find()->distinct(['category']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->andFilterWhere(['=', 'Department', 'Clothing'])
            ->andFilterWhere(['=', 'Brand', 'Ducati'])->distinct('Category')
	    ->groupBy(['Category']);

	return $dataProvider;
	}  
    public function SubCategories($params)
    {
        $query = TblProductLines::find();
        $this->load($params);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->andFilterWhere(['=', 'Department', 'Clothing'])
            ->andFilterWhere(['=', 'Brand', 'Ducati'])
            ->andFilterWhere(['like', 'Category',$this->Category ]);//->distinct('SubCategory')
	    //->groupBy(['SubCategory']);
	return $dataProvider;
	}  

    public function getBrandCategoryItems($brand=null,$category=null)
    {
        $query = TblProductLines::find()->where(['LIKE','Category',$category])->andWhere(['=','Brand',$brand])->andWhere(['=','Active',true]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
            'sort' => [

            ],
        ]);

        return $provider;
    }

    public function getCategoryItems($category)
    {
        $query = TblProductLines::find()->where(['LIKE','Category',$category]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
            'sort' => [

            ],
        ]);

        return $provider;
    }
    /*
     * Function to retrieve associated partnumbers
     * Accepts product line as text input
     * Returns associated parts to Superceded partno
     *  */
    public function getPartNumbers($pline)
    {
	$bits=ProductLineSearch::find()->select('PartNumbers')
	    ->where(['Url'=>$pline])
	    ->asArray()
	    ->all();
	$qry=explode(',',implode(',',$bits[0]));
	$parts=SearchParts::find()->select ('PARTNO,REFERNO,DESCRIPTION,PRICE,partid,STOCK_LEVEL')
	    ->where(['IN','PARTNO',$qry])
	    ->andWhere("REFERNO = ''")
	    ->all();
	return $parts;

    }

}
