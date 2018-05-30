<?php

namespace frontend\modules\controllers;
use yii\web\Controller;
use Yii;

use common\models\TblModelRange;
use common\models\Models;
use common\models\ModelAccessorizeSearch;
use common\models\VwModelProductLines;
use common\models\SearchModelRangeView;
// SearchModelRangeView
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\db\Query;


class AccessorizeController extends Controller
{
/*
 * Accepts Model to accessorize and presents items below
 * 
 * */
    public function actionIndex()
    {
      $searchModel = new SearchModelRangeView();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      return $this->render('index',  
            [   'model' => $searchModel,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]
            );
    }

/*
Accepts string unique slug of Models - returns JSON 
...www.example.com/ducati/accessorize/my/diavel_carbon_2016
*/
   public function actionMy($slug = null)
    {

       // Insert $slug validation here:-

        //$dataProvider=Models::findModelPartsByAlias($slug);
        Url::remember();
        $modelfilter='';
        $searchModel = new ModelAccessorizeSearch();
        $dataProvider= $searchModel->search($slug);
          return $this->render('accessoriesindex',  
                ['dataProvider' => $dataProvider,
                'searchModel'=>$searchModel,
                'slug'=>$slug,
                ]
            );
//        die(var_dump($fred));

    }
/*
Accepts string performs fuzzy search for Models - returns JSON 
*/
   public function actionModel($q = null)
    {
        $query = new Query;
        $query->select(['model']) 
            ->from('tbl_models')
            ->where('model LIKE "' . $q .'%"')
            ->limit(40)
            ->orderBy('model');
        $command = $query->createCommand();
        $data = $command->queryAll();
        $out = [];
        foreach ($data as $d) {
            $out[] = ['value' => $d['model']];
        }
        echo Json::encode($out);
    }

/*
* Function to find the motorcycle model model (sic)
*/
    protected function findModelByUrl($url)
    {
        if (($model = VwModelRangeModels::getAccessories($url)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested model does not exist.'.$url);
        }
    }
}
