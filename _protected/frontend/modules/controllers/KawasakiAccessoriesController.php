<?php
/* Ducati History Controller
 * Created by stoat as template for module controllers invoked by Menu System
 * Locate Requested URL Lookup meta information and page data from tbl_menu
 */
namespace frontend\modules\controllers;
use Yii;
use frontend\models\Menu;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use common\models\plBrowse;
use common\models\ProductLineSearch;

class  KawasakiAccessoriesController extends \yii\web\Controller
{
    public function actionIndex()
    {      

        $searchModel = new ProductLineSearch();
        $searchModel;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider= ProductLineSearch::getKawasakiAccessories();
      //  $model=$this->findModelByUrl('/'.Yii::$app->request->getPathInfo());  
        $menukey=Yii::$app->request->url;
        $model=$this->findModelByUrl('/kawasaki/kawasaki-accessories/');  
      //  $subcats=$searchModel->getSubcategories();
        $catModel= new ProductLineSearch();
        $catProvider = $catModel->getKawasakiAccessoryCatsDP();
       // $categories_tn=DucatiAccessorySearch::getStuff();
        return $this->render('index',[
            'searchModel' => $searchModel,
            'model' => $model,
            'dataProvider' => $dataProvider,
            'catProvider'=>$catProvider,
         //   'categories_tn'=>$categories_tn,
           // 'scats'=>$subcats,
        ]);
    }
    public function actionBrowse()
    {
       $params=Yii::$app->request->queryParams;
       $model=$this->findModelByUrl('/kawasaki/kawasaki-accessories/');
       $searchModel = new plBrowse();
       if (isset($params['Category'])) 
       {
           //die(print_r($params,true));
           //$subcatProvider = $searchModel->getCategoryItems($params['Category']);    
             $subcatProvider = $searchModel->getBrandCategoryItems('Kawasaki',$params['Category']);    

        }else{
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);    
            $subcatProvider = $searchModel->SubCategories(Yii::$app->request->queryParams);    
        }
        Url::remember();
       return $this->render('productindex',[
           // 'dataProvider' => $dataProvider,
            'catProvider'=>$subcatProvider,
            'params'=>$params,
            'model'=>$model,
        ]);
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
