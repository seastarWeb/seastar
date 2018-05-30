<?php

namespace backend\controllers;

use Yii;

use common\models\Models;
use common\models\TblModels;
use common\models\TblEngine;
use common\models\TblChassis;
use common\models\TblColour;
use common\models\TblGeneral;
use common\models\TblFinanceExample;
use common\models\TblModelRange;

use common\models\SearchModels;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\ActiveQuery;
use yii\data\ActiveDataProvider;
use backend\models\MultipleUploadForm;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\imagine\Image;

/**
 * ModelsController implements the CRUD actions for Models model.
 */
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

    /**
     * Lists all Models models.
     * @return mixed
     */
    public function actionIndex()
    {
      $searchModel = new SearchModels();
      $fModel= new Models();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      $dataProvider->sort->attributes['model_range_id'] = [
        'asc' => ['tbl_models.model_range_id' => SORT_ASC],
        'desc' => ['tbl_models.model_range_id' => SORT_DESC],
      ];
      $dataProvider->sort->attributes['model_description'] = [
        'asc' => ['tbl_models.model_description' => SORT_ASC],
        'desc' => ['tbl_models.model_description' => SORT_DESC],
        'default' => SORT_ASC,
      ];
      $dataProvider->sort->attributes['year'] = [
        'asc' => ['year' => SORT_ASC],
        'desc' => ['year' => SORT_DESC],
        'default' => SORT_DESC,
      ];

      
 	    $checkBoxProvider = new ActiveDataProvider([
		  'query'=>TblModelRange::find(),
		  'pagination'=>[
		  'pageSize'=> 20,
		  ]
		]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
	        'model'=>$fModel,
	//    'items'=>$items,
 	        'checkBoxProvider'=>$checkBoxProvider,
        ]);
    }

    /**
     * Displays a single Models model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

           $imgmodel = new MultipleUploadForm();

            $model= $this->findModel($id);
            
          //chassis
            $chassis =$this->getChassis($id);
            if ($chassis->load(Yii::$app->request->post()) && $chassis->save()) {
              return $this->redirect(['view', 'id'=>$model->id]);
            }
           // die(print_r($model));
          //general
            $general =$this->getGeneral($id);
            if ($general->load(Yii::$app->request->post()) && $general->save()) {
              return $this->redirect(['view', 'id'=>$model->id]);
            }
            //colour
            $colour =$this->getColours($id);
            if ($colour->load(Yii::$app->request->post()) && $colour->save()) {
              return $this->redirect(['view', 'id'=>$model->id]);
            }
            //engine
            $engine =$this->getEngine($id);
            if ($engine->load(Yii::$app->request->post()) && $engine->save()) {
              return $this->redirect(['view', 'id'=>$model->id]);
            }
            //finance
            $finance =$this->getFinance($id);
              if ($finance->load(Yii::$app->request->post()) && $finance->save()) {
                return $this->redirect(['view', 'id'=>$model->id]);
            }
                        //Model detail itself
         //   die(print_r($model));
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
              return $this->redirect(['view', 'id'=>$model->id]);
            } else {
		if (!$model->save()){
		    echo 'There has been an error saving to the database';
		    die(var_dump($model->getErrors()));
		}
//		die(var_dump(Yii::$app->request->post()));
              return $this->render('view', [
                'model'=>$model,
                'engine'=>$engine,
                'chassis'=>$chassis,
                'general'=>$general,
                'colour'=>$colour,
                'finance'=>$finance,
                'imgmodel'=>$imgmodel
              ]);
            }
    }

    /**
     * Creates a new Models model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblModels();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Models model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
           $imgmodel = new MultipleUploadForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,'imgmodel'=>$imgmodel,
            ]);
        }
    }

    /**
     * Deletes an existing Models model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
     public function actionDelete($id) {
         $this->findModel($id)->delete();
         return $this->redirect(['index']);
     }

    /**
     * Duplicates an existing Model's associated data
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
  public function actionDuplicate() {
  	if (Yii::$app->user->can('theCreator'))
  		{
  	// Calls Stored procedures to 

      	if (isset($_POST['targetid'])) {
         //die(var_dump($_POST['targetid']));
            $id=$_POST['targetid'];
            $templateid=$_POST['donerid'];
            return Models::replicateModel($templateid,$id);		
        }
  		}
         return $this->redirect(['index']);
  }

    public function actionChecks(){
    //check for model ranges selected
    $ids = Yii::$app->request->post('range');

    if ($ids) {
        Yii::$app->request->setQueryParams([
            'SearchModels' => ['model_range_id' => implode(', ', $ids)],
        ]);
    }
//var_dump(Yii::$app->request->queryParams);

    $searchModel = new SearchModels();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $dataProvider;
}





    /**
     * Finds the Models model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Models the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblModels::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function getEngine($id)
    {
      if (($engineData = TblEngine::findOne(['model_id'=>$id])) !== null) {
        //var_dump($engineData);
        return $engineData;
      } else {
        throw new NotFoundHttpException('The requested page does not exist.');
      }
    }
    protected function getChassis($id)
    {
      if (($chassisData = TblChassis::findOne(['model_id'=>$id])) !== null) {
        return $chassisData;
      } else {
        throw new NotFoundHttpException('The requested page does not exist.');
      }
    }
    protected function getGeneral($id)
    {
      if (($generalData = TblGeneral::findOne(['model_id'=>$id])) !== null) {
        return $generalData;
      } else {
        throw new NotFoundHttpException('The requested page does not exist.');
      }
    }
    protected function getColours($id)
    {
      if (($colourData = TblColour::findOne(['model_id'=>$id])) !== null) {
        return $colourData;
      } else {
        throw new NotFoundHttpException('The requested colour data does not exist for model id '.$id);
      }
    }
    protected function getFinance($id)
    {
      if (($finance = TblFinanceExample::findOne(['model_id'=>$id])) !== null) {
        return $finance;
      } else {
        throw new NotFoundHttpException('The requested finance data does not exist for model id '.$id);
      }
    }

    public function actionUpload($id)
    {
       $model = new MultipleUploadForm();
        
        if (Yii::$app->request->isPost) {
            $model->files = UploadedFile::getInstances($model, 'files');
            $response=[];
            Yii::$app->response->getHeaders()->set('Vary', 'Accept');

            Yii::$app->response->format = Response::FORMAT_JSON;

            $savefolder = \Yii::getAlias('@webroot').'/uploads/images/models/'.strtolower($id);
            if (!file_exists($savefolder.'/thumbnails')){
                     mkdir($savefolder.'/thumbnails',0775,true);
                }
            
            if ($model->upload($savefolder)) {
                Image::thumbnail($savefolder.'/'.$model->files[0]->name, 160, 100)->save($savefolder.'/thumbnails/'.$model->files[0]->name, ['quality' => 80]);
                $response['files'][] = [
                    'name' => $model->files[0]->name,
                    'url'=>Url::to('@web/uploads/images/models/'.strtolower($id).'/'.$model->files[0]->name,true),
                    'type' => $model->files[0]->type,
                    'size' => $model->files[0]->size,
                    'thumbnailUrl' => Url::to('@web/uploads/images/models/'.strtolower($id).'/thumbnails/'.$model->files[0]->name,true),
                  //  'deleteUrl' => Url::to(['delete', 'id' => $picture->id]),
                  //  'deleteType' => 'POST'
                ];
                return $response;
            }else{
                $response[] = ['error' => Yii::t('app', 'Unable to save picture')];
                return $response;
            }
        }
    }
}
