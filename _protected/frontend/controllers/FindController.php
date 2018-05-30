<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\TblProductLines;
use common\models\ProductLineSearch;
use common\models\ProductLineFuzzy;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\Json;
/**
 * ProductLineController implements the CRUD actions for TblProductLines model.
 */
class FindController extends Controller
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
        $searchModel = new ProductLineFuzzy();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //die(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
          //  'cats'=>$cats,

        ]);
    }
    /**
     * Lists all TblProductLines models.
     * @return mixed    
     */
    public function actionOur()
    {
        $searchModel = new ProductLineFuzzy();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

       // die(var_dump(Yii::$app->request->queryParams));
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
          //  'cats'=>$cats,

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
