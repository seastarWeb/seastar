<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Bikes;
use common\models\TblModelRange;


/**
 * BikeSearch represents the model behind the search form about `common\models\Bikes`.
 */
class BikeSearch extends Bikes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['make', 'model', 'colour', 'frame_no', 'engine_no', 'cc', 'mileage', '1st_reg_date', 'purchase_date', 'description', 'location', 'id', 'sale_date', 'sale_price', 'display_price', 'min_price', 'catagory', 'reg', 'holding', 'MISC1', 'MISC2', 'MISC3', 'MISC4', 'MISC5', 'MMISC1', 'MMISC2', 'MMISC3', 'trim', 'mot', 'door', 'ignition', 'plan', 'siv', 'plan_date', 'fuel', 'warranty', 'wdate', 'nominal', 'nominal_in', 'dateEdit', 'timeEdit', 'vehicleClass', 'category', 'supplierRef', 'details', 'regfee', 'roadtax'], 'safe'],
            [['from', 'sold', 'sold_to', 'invoice_in', 'invoice_out', 'transferred', 'A', 'B', 'C'], 'integer'],
            [['purchase_price', 'spent'], 'number'],
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
        $query = Bikes::find();
        $dataProvider = new ActiveDataProvider(['query'=>$query,
		
	    'pagination' => [
		        'pageSize' => 12,
		    ]
		]);
	/*
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
	'pagination' => [
	        'pageSize' => 1,
		    ],
]	);
	*/

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'from' => $this->from,
            'trim'=>$this->trim,
            'sold' => $this->sold,
            'purchase_price' => $this->purchase_price,
            'spent' => $this->spent,
            'sold_to' => $this->sold_to,
            'invoice_in' => $this->invoice_in,
            'invoice_out' => $this->invoice_out,
            'transferred' => $this->transferred,
            'A' => $this->A,
            'B' => $this->B,
            'C' => $this->C,
        ]);

        $query->andFilterWhere(['like', 'make', $this->make])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'colour', $this->colour])
            ->andFilterWhere(['like', 'frame_no', $this->frame_no])
            ->andFilterWhere(['like', 'engine_no', $this->engine_no])
            ->andFilterWhere(['like', 'cc', $this->cc])
            ->andFilterWhere(['like', 'mileage', $this->mileage])
            ->andFilterWhere(['like', 'purchase_date', $this->purchase_date])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'sale_date', $this->sale_date])
            ->andFilterWhere(['like', 'sale_price', $this->sale_price])
            ->andFilterWhere(['like', 'display_price', $this->display_price])
            ->andFilterWhere(['like', 'min_price', $this->min_price])
            ->andFilterWhere(['like', 'catagory', $this->catagory])
            ->andFilterWhere(['like', 'reg', $this->reg])
            ->andFilterWhere(['like', 'holding', $this->holding])
            ->andFilterWhere(['like', 'MISC1', $this->MISC1])
            ->andFilterWhere(['like', 'MISC2', $this->MISC2])
            ->andFilterWhere(['like', 'MISC3', $this->MISC3])
            ->andFilterWhere(['like', 'MISC4', $this->MISC4])
            ->andFilterWhere(['like', 'MISC5', $this->MISC5])
            ->andFilterWhere(['like', 'MMISC1', $this->MMISC1])
            ->andFilterWhere(['like', 'MMISC2', $this->MMISC2])
            ->andFilterWhere(['like', 'MMISC3', $this->MMISC3])
            ->andFilterWhere(['like', 'trim', $this->trim])
            ->andFilterWhere(['like', 'mot', $this->mot])
            ->andFilterWhere(['like', 'door', $this->door])
            ->andFilterWhere(['like', 'ignition', $this->ignition])
            ->andFilterWhere(['like', 'plan', $this->plan])
            ->andFilterWhere(['like', 'siv', $this->siv])
            ->andFilterWhere(['like', 'plan_date', $this->plan_date])
            ->andFilterWhere(['like', 'fuel', $this->fuel])
            ->andFilterWhere(['like', 'warranty', $this->warranty])
            ->andFilterWhere(['like', 'wdate', $this->wdate])
            ->andFilterWhere(['like', 'nominal', $this->nominal])
            ->andFilterWhere(['like', 'nominal_in', $this->nominal_in])
            ->andFilterWhere(['like', 'dateEdit', $this->dateEdit])
            ->andFilterWhere(['like', 'timeEdit', $this->timeEdit])
            ->andFilterWhere(['like', 'vehicleClass', $this->vehicleClass])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'supplierRef', $this->supplierRef])
            ->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'regfee', $this->regfee])
            ->andFilterWhere(['like', 'roadtax', $this->roadtax]);

        return $dataProvider;
    }
    public function getBikesForModelRange($rid)
    {
 
       $model =  TblModelRange::findOne($rid);
       $lookfor = $model->model_range;

       $count=18;
   //    $provider=Bikes::find()->where(['LIKE', 'model', $lookfor])->all();
$dataProvider = new ActiveDataProvider([
                    'query'=>Bikes::find()->where(['LIKE', 'model', $lookfor]),
                    ]);
      // die(var_dump($dataProvider));
/*
       $provider='';
       $provider = new SqlDataProvider([
            'sql' => 'SELECT  * from  WHERE model:rid GROUP BY Category ORDER BY category',
            'params' => [':rid' => $rid],
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 40,
            ],
            'sort' => [
                'attributes' => [
                    'Category',
                ],
            ],
        ]);
        */
      return $dataProvider;      
    }
}
