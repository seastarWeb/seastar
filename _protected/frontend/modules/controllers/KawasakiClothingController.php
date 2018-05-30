<?php
/* Ducati History Controller
 * Created by stoat as template for module controllers invoked by Menu System
 * Locate Requested URL Lookup meta information and page data from tbl_menu
 */
namespace frontend\modules\controllers;
use Yii;
use yii\helpers\Url;
use frontend\models\Menu;
use yii\web\NotFoundHttpException;
use common\models\plBrowse;
use common\models\ProductLineSearch;

class  KawasakiClothingController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new plBrowse();
        $dataProvider = $searchModel->categories(Yii::$app->request->queryParams);    
        $catModel = new ProductLineSearch();
        $catProvider = $catModel->getKawasakiClothingCatsDP();    
        $model=$this->findModelByUrl(Url::to());

        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'catProvider'=>$catProvider,
            'model' => $model,
             ]);       
        $menukey=Yii::$app->request->url;
        return $this->render('index',['model' => $this->findModelByURL($menukey),]);
    }
    public function actionBrowse()
    {
       $params=Yii::$app->request->queryParams;
       $model=$this->findModelByUrl('/kawasaki/kawasaki-clothing/');
       $searchModel = new plBrowse();
       if (isset($params['Category'])) 
       {
           // Get Categories for Kawasaki clothes
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
