<?php
/* Ducati Accessory Controller
 * Created by stoat as template for module controllers invoked by Menu System
 * Locate Requested URL Lookup meta information and page data from tbl_menu
 */
namespace frontend\modules\controllers;
use Yii;
use yii\helpers\Url;
use frontend\models\Menu;
use frontend\models\DucatiSpares;
use frontend\models\DucatiAccessorySearch;
use common\models\plBrowse;
use common\models\ProductLineSearch;
use common\models\TblProductLines;
use yii\data\SqlDataProvider;
use yii\web\NotFoundHttpException;
class DucatiAccessoriesController extends \yii\web\Controller
{
    public function actionIndex()
    {    
        $searchModel = new DucatiSpares();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      //  $model=$this->findModelByUrl('/'.Yii::$app->request->getPathInfo());	
        $menukey=Yii::$app->request->url;
        $model=$this->findModelByUrl('/ducati/ducati-accessories/');  
	  //  $subcats=$searchModel->getSubcategories();
        $catModel= new ProductLineSearch();
        $catProvider = $catModel->getDucatiAccessoryDP();
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
       $model=$this->findModelByUrl('/ducati/ducati-accessories/');
       $searchModel = new plBrowse();
       if (isset($params['Category'])) 
       {
           //die(print_r($params,true));
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

/*
 *
 */
    public function actionCategory()
    {
      var_dump(Yii::$app->request->queryParams);
    $searchModel = new plBrowse();
    $dataProvider = $searchModel->categories(Yii::$app->request->queryParams);    
    $model=$this->findModelByUrl('/ducati/ducati-accessories/'); 
/*
	$totalCount = Yii::$app->db->createCommand('SELECT COUNT(DISTINCT Category) FROM tbl_product_lines WHERE brand=:brand and department=:dept',
		[':brand' => 'Ducati',':dept'=>'Accessories'])
	    ->queryScalar();

	$dataProvider = new SqlDataProvider([
		'sql' => 'SELECT distinct Category FROM tbl_product_lines WHERE brand=:brand and department=:dept',
		'params' => [':brand' => 'Ducati',':dept'=>'Accessories'],
		'totalCount' => $totalCount,
		'sort' => [
		'attributes' => [
		'Category' => [
			'asc' => ['Category' => SORT_ASC],
			'desc' => ['Category' => SORT_DESC],'default' => SORT_ASC,
			'label' => 'Catgegory',
			],
	//		],
			'pagination' => [ 'pageSize' => 10, ],
	]	]]);
*/
    //    $searchModel = new plBrowse();
//	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);    
        return $this->render('catindex',[
	            'searchModel' => $searchModel,
        	    'dataProvider' => $dataProvider,
              'model'=>$model,
		    ]);
    }



    public function actionView($id)
    {
        $parts=ProductLineSearch::getPartNumbers($id) ;
        return $this->render('view', [
              'model' => $this->findModel($id),
              'parts'=>$parts,
        ]);
    }
   

    protected function findModelByUrl($url)
    {
        if (($model = Menu::getPage($url)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist. '.$url);
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
        if (($model = TblProductLines::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
