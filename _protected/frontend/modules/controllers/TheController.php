<?php

namespace frontend\modules\controllers;
use yii\web\Controller;
use Yii;

use common\models\TblModelRange;
use common\models\Models;
use common\models\TblModels;
use common\models\ModelAccessorizeSearch;
use common\models\VwModelProductLines;
use common\models\SearchModelRangeView;
use yii\helpers\Url;
// SearchModelRangeView
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\helpers\Json;
use yii\db\Query;


class TheController extends Controller
{
/*
 * Presents Model
 * 
 * */
    public function actionIndex()
    {
        
       $alias=Yii::$app->request->queryParams;
       $model=TblModels::find()->where(['alias'=> $alias])->one();
       $searchModel = new ModelAccessorizeSearch();
       $dataProvider= $searchModel->searchcats($alias);
       Url::remember();   
        return $this->render('index',
            [
            'model'=>$model,
            'dataProvider' => $dataProvider,
            'searchModel'=>$searchModel,
            ]);
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
