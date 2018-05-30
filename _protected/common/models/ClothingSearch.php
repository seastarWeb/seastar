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
 * Accessory Search represents the model behind the search form about `app\models\TblProductLines`.
 */
class ClothingSearch extends TblProductLines
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['Department', 'Brand', 'Category', 'SubCategory', 'ProductLine', 'DefaultImage', 'Fitment', 'PartNumbers', 'Description','Colours','Sizes'], 'safe'],
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

    public function getAccessoryBrands()
    {
        $dataProvider = new ActiveDataProvider([
        'query' => TblProductLines::find()
                ->select('Brand')->distinct()
                ->where(['Department'=>'Clothing'])
                ->orderBy('Brand'),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);
        return $dataProvider;
    }
    

    public function getClothingCats()
    {
        $query = TblProductLines::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->andFilterWhere(['=', 'Department', 'Clothing'])
           // ->distinct('Category')
            ->groupBy('Category');
//die(print_r($query->createCommand()->getRawSql()));
        return $dataProvider;

    }

    public function getClothingBrands()
    {
        $query = TblProductLines::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->andFilterWhere(['=', 'Department', 'Clothing'])
           // ->distinct('Category')
            ->groupBy('Brand');
//die(print_r($query->createCommand()->getRawSql()));
        return $dataProvider;

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
     
     //   die(print_r($params));
        $query = TblProductLines::find()->where(['=','Department','Clothing']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

      
        if (!$this->validate()) {

            // uncomment the following line if you do not want to any records when validation fails
             $query->where('0=1');
            return $dataProvider;
        }
    //    $cat=$params['category'];
        //die(var_dump($params['Brand']));
        $query->andFilterWhere([
            'id' => $this->id,
        ]);
        if (isset($params['Brand'])){
            $query->andFilterWhere(['like','Brand',$params['Brand']]);
        }
        if (isset($params['category'])){
            $query->andFilterWhere(['like','Category',$params['category']]);
        }
      //  $make=$params['brand'];
        $query->andFilterWhere(['like', 'Brand', $this->Brand])
            ->andFilterWhere(['like', 'Category', $this->Category])
            ->andFilterWhere(['like', 'SubCategory', $this->SubCategory])
            ->andFilterWhere(['like', 'ProductLine', $this->ProductLine])
            ->andFilterWhere(['like', 'DefaultImage', $this->DefaultImage])
            ->andFilterWhere(['like', 'Fitment', $this->Fitment])
            ->andFilterWhere(['like', 'PartNumbers', $this->PartNumbers])
	    ->andFilterWhere(['like', 'Description', $this->Description])
	    ->andFilterWhere(['like', 'Colours', $this->Colours])
	    ->andFilterWhere(['like', 'Sizes', $this->Sizes]);
 //die(print_r($query->createCommand()->getRawSql()));
 // die(print_r($query));
        return $dataProvider;
    }
}
