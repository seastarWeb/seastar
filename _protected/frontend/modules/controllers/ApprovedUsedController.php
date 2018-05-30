<?php

namespace frontend\modules\controllers;

use Yii;
use common\models\Bikes;
use common\models\BikeSearch;
use frontend\models\Menu;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BikeController implements the CRUD actions for Bikes model.
 */
class ApprovedUsedController extends Controller
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
     * Lists all Bikes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BikeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);    
        $makefilter=Bikes::getManufacturers();
        $model=$this->findModelByUrl('/motorcycles/approved-used/');//Url::to());
      //  $bikes_tn=Bikes::getBikes();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model,
        //    'bikes_tn'=$bikes_tn,
            'filter'=>$makefilter,
        ]);
    }
    public function actionWarranty()
    {
            return $this->render('warranty');
    }
/**
 * * Displays a single Bikes model.
 * * @param string $id
 * * @return mixed
 * */
    public function actionView($id)
    {
	$model=$this->findModel($id);
	$images[]=Bikes::getBikeimages($id);

	$i=0;
	foreach($images as $img)
	{    
	    foreach($img as $slide){
		$slides[]= [
		    /* 
		     * These settings are required to launch video from image click RCM 23/1/2015
		     * 'url'=>$slide,
		     * 'poster'=>$slide,
		     * 'href' => 'https://www.youtube.com/watch?v=mwOLqcMFyaE',
		     * 'type' => 'text/html',
		     * 'youtube' => 'mwOLqcMFyaE',
		     * */
		    'href'=>$slide,
		    'type'=> 'image/jpeg',
		    'thumbnail'=>$slide,
		    //	'title'=>$model['id'].' '.$model['model'],
			 'options'=>array('title'=>$model['id'],)
			     ];
		$i=$i+1;
	    }
	}       
	return $this->render('view', [
			'model' => $model,
				'images'=>$images,
					'slides'=>$slides,
					]);
    }

    /**
     * Creates a new Bikes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Bikes();
        $makefilter=Bikes::getManufacturers();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Bikes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Bikes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Bikes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Bikes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bikes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelByUrl($url)
    {
        if (($model = Menu::getPage($url)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested Menu page does not exist.'.$url);
        }
    }
}
