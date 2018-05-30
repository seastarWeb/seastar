<?php

namespace backend\controllers;

use Yii;
use common\models\TblProductLines;
use common\models\ProductLineSearch;
use common\models\DeepBlueParts;
use common\models\SearchDeepBlue;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\db\Query;
/**
 * ProductLineController implements the CRUD actions for TblProductLines model.
 */
class ProductLineController extends Controller
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
        $searchModel = new ProductLineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
  // validate if there is a editable input saved via AJAX
    if (Yii::$app->request->post('hasEditable')) {
      
	die(var_dump('here'));
       // die(var_dump(current($_POST)));
          
        // instantiate your book model for saving
        $productLineId = Yii::$app->request->post('editableKey');
        $model = TblProductLines::findOne($productLineId);
 
        // store a default json response as desired by editable
        $out = Json::encode(['output'=>'Not Saved', 'message'=>'']);
 
  
        // fetch the first entry in posted data (there should 
        // only be one entry anyway in this array for an 
        // editable submission)
        // - $posted is the posted data for Book without any indexes
        // - $post is the converted array for single model validation
        $post = [];
      
        $posted = current($_POST['TblProductLines']);

        $post['TblProductLines'] = $posted;
        //die(print_r($post['Active']));
   //         $out = Json::encode(['output'=>'', 'message'=>'posted'.$post['Active']]);
   
        // load model like any single model validation
        if ($model->load($post)) {
            // can save model or do something before saving model
            $model->save();
 
            // custom output to return to be displayed as the editable grid cell
            // data. Normally this is empty - whereby whatever value is edited by 
            // in the input by user is updated automatically.
            $output = $model->Active ? 'Active' : 'On Hold' ;
 
            // specific use case where you need to validate a specific
            // editable column posted when you have more than one 
            // EditableColumn in the grid view. We evaluate here a 
            // check to see if buy_amount was posted for the Book model
     //       if (isset($posted['buy_amount'])) {
       //        $output =  Yii::$app->formatter->asDecimal($model->buy_amount, 2);
        //    } 
 
            // similarly you can check if the name attribute was posted as well
            // if (isset($posted['name'])) {
            //   $output =  ''; // process as you need
            // } 
            $out = Json::encode(['output'=>$output, 'message'=>'']);
        } 
        // return ajax json encoded response and exit
         
        echo $out;
        return;
       
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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

    /**
     * Creates a new TblProductLines model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblProductLines();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TblProductLines model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $checkBoxProvider = new ActiveDataProvider([
            'query'=>DeepBlueParts::find()->select(['partid', 'PARTNO','DESCRIPTION','PRICE','SUPPLIER']),
            'pagination'=>[
            'pageSize'=> 20,
        ]]);
        $searchModel= new SearchDeepBlue(); 
        $filterProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'checkBoxProvider'=>$checkBoxProvider,
                'searchModel'=>$searchModel,
                'filterProvider'=>$filterProvider,
            ]);
        }
    }

    /**
     * Deletes an existing TblProductLines model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblProductLines model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblProductLines the loaded model
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
    public function actionPartsList($q = null) {
    $query = new Query;
    
    $query->select(["CONCAT(PARTNO, ' -', DESCRIPTION) as DeepBluePartNo",'PRICE']) //["CONCAT(first_name, ' ', last_name) AS full_name", 'email']
        ->from('parts')
        ->where('PARTNO LIKE "' . $q .'%"')
        ->limit(10)
        ->orderBy('PARTNO');
    $command = $query->createCommand();
    $data = $command->queryAll();
    $out = [];
    foreach ($data as $d) {
        $out[] = ['value' => $d['DeepBluePartNo'].$d['PRICE']];
    }
    echo Json::encode($out);
    }
}
