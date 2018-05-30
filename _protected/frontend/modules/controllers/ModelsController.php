<?php

namespace frontend\modules\controllers;

use yii\web\Controller;
use Yii;
use frontend\models\Menu;
use common\models\Models;
use common\models\BikeSearch;
use common\models\VideoSlides;
use common\models\TblModelRange;
use common\models\TblProductLines;
use common\models\ProductLineSearch;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;

class ModelsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    /*
     * current menu as model with child menus as Data provider
     * 
     * */
    public function actionIndex()
    {
      //  die(print_r(Yii::$app->request->queryParams));
        $make = Yii::$app->controller->module->id;
        $menukey='/'.$make.'/models/';
        $model=$this->findModelByUrl($menukey); 
        $params=Yii::$app->request->queryParams;

        if (isset($params['modelrange'])){
            // 0 Get Menu Page Optimized for model range.
                $menukey='/'.$make.'/models/'.$params['modelrange'].'/';
                $model=$this->findModelByUrl($menukey);
            // 1 Find range id from model range slug          
                $mod_id = TblModelRange::find()
                    ->where(['alias'=>$params['modelrange']])
                    ->one();
                $rid = $mod_id->id;    
                 //   die(print_r($rid));
                $yearcutoff=date('Y')-2;
                $modeldata= new ActiveDataProvider([
                    'query'=>Models::find()
                    ->where(['model_range_id'=>$rid])
                    ->andWhere('Year > :year', [':year' => $yearcutoff]),
                   // ->orderBy(['year desc','model asc']),
                    'pagination'=>[
                    'pageSize'=>40,
                    ],
                ]); 
             //   die(print_r($query->createCommand()->query)) ;   
            //  2 Get associated product accessories and clothing
                $partsProvider=ProductLineSearch::getPartsDataForModelRange($rid);
                $clothingProvider=ProductLineSearch::getClothingDataForModelRange($rid);
                $bikesProvider=BikeSearch::getBikesForModelRange($rid);
               // $assocParts=array_filter($assocParts);
            // Spit it into the screen
                return $this->render('rangeindex',[
                    'model'=>$model,
            //    'clothingProvider'=>$clothingProvider,
                    'partsProvider'=>$partsProvider,
                    'bikesProvider'=>$bikesProvider,
                    'clothingProvider'=>$clothingProvider,
         //       'slides'=>$slides,          
                    'dataProvider'=>$modeldata,
                    ]);
         } 
        $submenuitems=Menu::getSubMenu($model->id);
        $modelranges=Models::getCurrentModelRanges();
    	$id=$model->id;  
    	$dataProvider = new ActiveDataProvider([
    		'query'=>Menu::find()
    			->where(['pid' => $id])
    			->andWhere('id > 1')
    			->andWhere('status = 1'),
    		'pagination'=>[
    		'pageSize'=>40,
    		],
    		]);
        return $this->render('index', 
            ['model' => $model,
            'dataProvider'=>$dataProvider,
            'submenuitems'=>$submenuitems,
            'ranges'=>$modelranges,
            ]);
    }
/*
New Action to Collect Newest Model in the range.
*/
   public function actionNew()
    {
        $params=Yii::$app->request->queryParams;
        if (isset($params['id'])){
            $id=$params['id'];
            $model=Models::findOne($id);
            $images[]=Models::getImages($id);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.'.$url);
        }     
     
        $i=0;
        foreach($images as $img)
        {    
            foreach($img as $slide){
            $slides[]= [
                'content'=>$slide,
                'caption'=>$model->model_description,
            ];
            $i=$i+1;
            }
        } 
       $dataProvider=Models::getModelDetails($id);
       $slides= Videoslides::getVideos(1);
        return $this->render('modelview',[
            'model'=>$model,
            'slides'=>$slides,          
            'dataProvider'=>$dataProvider,
        ]);      
    }


    public function actionApprovedUsed()
    {
     return $this->render('index');
    }


    /*
     * Retrieves product information to be displayed agains associated product
     * */
    private function getAssociatedProduct($category='Accessories',$make='Ducati',$modelrange=2)
    {
        $dataProvider = New ActiveDataProvider ([
            'query'=>TblProductLines::find()
                ->where(['brand' => $make])
                ->andwhere(['department' => $category]),
            'pagination'=>[
            'pageSize'=>20,
            ],
            ]);
        return $dataProvider;
    }
    

    protected function findModelByUrl($url)
    {
        if (($model = Menu::getPage($url)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.'.$url);
        }
    }
}
