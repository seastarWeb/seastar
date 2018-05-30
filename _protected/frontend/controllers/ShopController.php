<?php

namespace frontend\controllers;

use Yii;
use common\models\TblProductLines;
use frontend\models\ShopFor;
use common\models\ProductLineSearch;
use common\models\Parts;
use frontend\models\DeepBlueProduct;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\Json;
use yz\shoppingcart\ShoppingCart;
/**
 * ProductLineController implements the CRUD actions for TblProductLines model.
 */
class ShopController extends Controller
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

    /**
     * Lists all TblProductLines models.
     * @return mixed    
     */
    public function actionIndex()
    {
        $searchModel = new ShopFor();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $brandCats=TblProductLines::getBrandCats();
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'brandCategories'=>$brandCats,
        ]);
    }

    /**
     * Displays a single TblProductLines model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /*
     * Accepts Brand and Product Line to identify productline
     * 
     */
    public function actionFor()
    {  
      $params=Yii::$app->request->queryParams;
      if (isset($params['Brand'], $params['ProductLine'])) 
      {
          $stufftofind= $params['Brand'] . '/' . $params['ProductLine'];
        } elseif (isset($params['Brand'])) 
        {
          $stufftofind[]= $params['Brand'];
      }
  /* pick up the parameters from the Url identifying Product Line
   * pick up the parts associated with that Product Line
   * */
  	$model=ProductLineSearch::find()//->select('PartNumbers')
  	       ->where(['Brand'=>$params['Brand']])
  	       ->andWhere(['LIKE','Url',$params['ProductLine']])
  	       ->asArray()
  	       ->all();
   /* Requires Defensive Adjustment */        
    $to_fit= ProductLineSearch::getModelsFitted($model);
    $parts=ProductLineSearch::getPartNumbers($model[0]['id']);
    
    //$to_fit=[];
    //$parts=[];
    if ($parts){
    	return $this->render('_itemBuy',[
    		'model'=>$model,
    		'params'=>$params,
    		'parts'=>$parts,
        'to_fit'=>$to_fit,
    		]);
       } else {
            throw new NotFoundHttpException('There has been a problem identifying the product within "Deep Blue".'.$model[0]['PartNumbers']);
        }
    }
/*
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
    /*
     * Searched Deep Blue Data for partnumber
     *  
     */
    public function actionAddToCart($id)
    {

      $cart=Yii::$app->cart;
      $model = DeepBlueProduct::findOne($id);
      if ($model) {
    	      $cart->put($model, 1);
             \Yii::$app->session->setFlash('success', 'One '.html::label($model->description). ' added to basket.');
    	      //return $this->redirect(['/cart/list']); 
            // die(print_r($this->redirect([Url::Previous()])));
             return $this->redirect(Url::previous(), 200);
    	 }
        throw new NotFoundHttpException();
    }

    public function actionCartView()
    {
    	/** @var ShoppingCart $sc */
    	foreach(Yii::$app->cart->positions as $position){
    	       // echo $this->render('_cart_item',['position'=>$position]);
    		 //   var_dump($position);
    	}
    	$itemsCount = \Yii::$app->cart->getCount();
 //     var_dump($itemsCount);
    	return $this->render('_cart');
    }
    public function actionList()
    {
    	/* @var $cart ShoppingCart */
    	$cart = \Yii::$app->cart;
    	$products = $cart->getPositions();
    	$total = $cart->getCost();
    	return $this->render('list', [
    		'products' => $products,
    		'total' => $total,
    		]);
    }

/** 
 * Your controller action to fetch the list of Brands in the shop provisioning a typeahead widget.
 */
public function actionBrandsList($q = null) {
    $query = new Query;
    
    $query->select('brand')
        ->distinct()
        ->from('tbl_product_lines')
        ->where('brand LIKE "%' . $q .'%"')
        ->orderBy('brand');
    $command = $query->createCommand();
    $data = $command->queryAll();
    $out = [];
    foreach ($data as $d) {
        $out[] = ['value' => $d['name']];
    }
    return $out;
   // echo Json::encode($out);
  }

public function actionBrandcats() {
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if ($parents != null) {
            $cat_id = $parents[0];
            $out = self::getCatList($cat_id); 
            echo Json::encode(['output'=>$out, 'selected'=>'']);
            return;
        }
    }
    echo Json::encode(['output'=>'', 'selected'=>'']);
}

  private static function getCatList($brand)
  {

    $data = TblProductLines::find()->select('Category')->where(['LIKE','Brand',$brand])->distinct()->orderBy('Category')->asArray()->All();
    $out = [];
    foreach ($data as $d) {
        $out[] = ['id'=>  $d['Category'],'name' => $d['Category']];
    }
    return $out;
  }
}
