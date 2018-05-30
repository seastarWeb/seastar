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
class AccessorySearch extends TblProductLines
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
                ->where(['Department'=>'Accessories'])
                ->orderBy('Brand'),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);
        return $dataProvider;
    }
    

    public function getAccessoryCats()
    {
        $query = TblProductLines::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->andFilterWhere(['=', 'Department', 'Accessories'])
           // ->distinct('Category')
            ->groupBy('Category');
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
     
        //die(print_r($params));
        $query = TblProductLines::find()->where(['=','Department','Accessories']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        //die(print_r($params['Category']));
        if (!$this->validate()) {

            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $cat=$params['category'];
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'Brand', $this->Brand])
            ->andFilterWhere(['like', 'Category', $cat])
            ->andFilterWhere(['like', 'SubCategory', $this->SubCategory])
            ->andFilterWhere(['like', 'ProductLine', $this->ProductLine])
            ->andFilterWhere(['like', 'DefaultImage', $this->DefaultImage])
            ->andFilterWhere(['like', 'Fitment', $this->Fitment])
            ->andFilterWhere(['like', 'PartNumbers', $this->PartNumbers])
	    ->andFilterWhere(['like', 'Description', $this->Description])
	    ->andFilterWhere(['like', 'Colours', $this->Colours])
	    ->andFilterWhere(['like', 'Sizes', $this->Sizes]);
// die(print_r($query->createCommand()->getRawSql()));

        return $dataProvider;
    }
}
