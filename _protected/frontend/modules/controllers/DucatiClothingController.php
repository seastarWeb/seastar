<?php
/* Ducati History Controller
 * Created by stoat as template for module controllers invoked by Menu System
 * Locate Requested URL Lookup meta information and page data from tbl_menu
 */
namespace frontend\modules\controllers;
use Yii;
use yii\helpers\Url;
use frontend\models\Menu;
use frontend\models\Product;
use common\models\DucatiClothingCategories;
use common\models\ProductLineSearch;
use common\models\plBrowse;
use frontend\models\DucatiClothingSearch;
use yii\web\NotFoundHttpException;

class DucatiClothingController extends \yii\web\Controller
{

    public function actionIndex()
    {
      $searchModel = new plBrowse();
      $dataProvider = $searchModel->categories(Yii::$app->request->queryParams);    
      $catModel = new ProductLineSearch();
    	$catProvider = $catModel->categories();    
    	$model=$this->findModelByUrl('/ducati/ducati-clothing/');

      return $this->render('index',[
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'catProvider'=>$catProvider,
        'model' => $model,
	    ]);
     }


    public function actionCategory()
    {
        $searchModel = new plBrowse();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);    
    	//var_dump(Yii::$app->request->queryParams);
         return $this->render('productindex', [
	            'searchModel' => $searchModel,
        	    'dataProvider' => $dataProvider,
              'model' => $cat,
        ]);
    }
    
    public function actionBrowse()
    {
       $params=Yii::$app->request->queryParams;
       $model=$this->findModelByUrl('/ducati/ducati-clothing/');
       $searchModel = new plBrowse();
       if (isset($params['Category'])) 
       {
           $subcatProvider = $searchModel->getBrandCategoryItems('Ducati',$params['Category']);    
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
    
    public function actionShop()
    {
    	$params=Yii::$app->request->queryParams;
        $searchModel = new ProductLineSearch();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);    
    	//var_dump($params);
            return $this->render('productindex',[
    	            'searchModel' => $searchModel,
            	    'dataProvider' => $dataProvider,
    		]);
    
    }
    
    
    
    
    public function actionSee()
    {
	$params=Yii::$app->request->queryParams;

	Url::remember();
       // $searchModel = new ProductLineSearch();
    $searchModel = new plBrowse();
	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);    
	$subcatProvider = $searchModel->SubCategories(Yii::$app->request->queryParams);    
    $model=$this->findModelByUrl('/ducati/ducati-clothing/');
//	var_dump($Cat);    
//        $categories_sm = DucatiClothingCategories::getCategories_tn($Cat);
//	var_dump($Cat);
 //       $categories_lg = DucatiClothingCategories::getCategories_lg($Cat);
        return $this->render('productindex',[
        	    'dataProvider' => $dataProvider,
	//	    'categories_tn'=>$categories_sm,
	//	    'categories_lg'=>$categories_lg,
		    'catProvider'=>$subcatProvider,
		    'params'=>$params,
            'model'=>$model,
//		    'subcat'=>$Cat,
		 
		]);
    
    }
    public function actionGetparts($pl)
    {
//	$items[]=array(1,2,3,4);
        $items=DucatiClothingCategories::getPartNumbers($pl);
	\Yii::$app->response->format = 'json';
	return $items;
    }
   
    protected function findModelByUrl($url)
    {
        if (($model = Menu::getPage($url)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requesteda page does not exist.  ~'.$url);
        }
    }
    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function getItemsBySubCat($scat){
        if (($items = Product::getBySubCat($scat)) !== null) {
            return $items;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        
    }
}
