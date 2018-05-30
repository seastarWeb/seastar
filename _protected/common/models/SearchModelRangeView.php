<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TblModelRange;
use common\models\VwModelRangeModels;

/**
 * SearchModelRange represents the model behind the search form about `common\models\TblModelRange`.
 */
class SearchModelRangeView extends VwModelRangeModels
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['make', 'model', 'model_range', 'year', 'alias'], 'string', 'max' => 100],
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
     * NB Filters using the module ID to prevent Kawasaki models being presented on Ducati pages... It could work!
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = VwModelRangeModels::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort' =>false,
            'sort'=> [
                'attributes'=>['year','model'],
                'defaultOrder' => ['year' => 'DESC','model'=>'ASC',]
            ],

        ]);
        
        $module=Yii::$app->controller->module->id;

        if (!($this->load($params) && $this->validate())) {
            if ($module=='ducati'){
                $this->make='Ducati';
            }elseif($module=='kawasaki'){
                $this->make='Kawasaki';
            }
            $query->andFilterWhere(['make' => $this->make,]);    
            return $dataProvider;
        }
       
        if ($module=='ducati'){
            $this->make='Ducati';
        }elseif($module=='kawasaki'){
            $this->make='Kawasaki';
        }
        $query->andFilterWhere(['make' => $this->make,]);
        $query->andFilterWhere(['like', 'model', $this->model]);
        $query->andFilterWhere(['like', 'model_range', $this->model_range]);
        $query->andFilterWhere(['year'=> $this->year]);
        return $dataProvider;
    }
}
