<?php
namespace frontend\controllers;
use yii\web\Controller;
use common\models\ClothingSearch  ;
use common\models\TblProductLines;
use yii\web\NotFoundHttpException;
use yii\web\MethodNotAllowedHttpException;
use yii\helpers\Url;
use yii\helpers\Json;
use Yii;

/**
 * Accessories Controller implements Browsing ProductLines for Accessories.
 */
class ClothingController extends Controller
{
    /**
     * Lists all Clothing Category models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
//die(print_r(Yii::$app->request->queryParams));
        $params=Yii::$app->request->queryParams;
    if (isset($params['Brand'])) 
       {       
            $searchModel = new ClothingSearch;
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('clothingindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);        
       }else{
            $searchModel = new ClothingSearch;
            $dataProvider =$searchModel::getClothingCats();
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);

       }
//die(print_r(Yii::$app->request->queryParams));

    }

    /**
     * Displays a category of Clothing.
    */
    public function actionCategory()
    {
      // die(print_r(Yii::$app->request->queryParams));
       $searchModel = new ClothingSearch;
       $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      // die(var_dump(Yii::$app->request->queryParams));
        return $this->render('clothingindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); 
    }
    /**
     * Displays a category of Accessories.
    */
    public function actionMake()
    {
       // die(print_r(Yii::$app->request->queryParams));
        $searchModel = new ClothingSearch;
        $dataProvider =$searchModel::getClothingBrands();
        return $this->render('brandindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); 
    }
    /**
     * Displays a category of Clothing.
    */
    public function actionBrand()
    {
       // die(print_r(Yii::$app->request->queryParams));
       $searchModel = new ClothingSearch;
       $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('clothingindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); 
    }


    /**
     * Displays a single Article model.
     * 
     * @param  integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * 
     * @param integer  $id
     * @return Article The loaded model.
     * 
     * @throws NotFoundHttpException if the model cannot be found.
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) 
        {
            return $model;
        } 
        else 
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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

    $data = TblProductLines::find()->select('Category')->where(['LIKE','Brand',$brand])->andwhere(['=','Department','Clothing'])->distinct()->orderBy('Category')->asArray()->All();
    $out = [];
    foreach ($data as $d) {
        $out[] = ['id'=>  $d['Category'],'name' => $d['Category']];
    }
    return $out;
  }
}
