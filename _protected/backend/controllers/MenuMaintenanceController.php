<?php

namespace backend\controllers;

use Yii;
use backend\models\MenuMaintenance;
use backend\models\SearchMenu;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\MultipleUploadForm;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\imagine\Image;

/**
 * MenuMaintenanceController implements the CRUD actions for MenuMaintenance model.
 */
class MenuMaintenanceController extends Controller
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
     * Lists all MenuMaintenance models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new SearchMenu();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $menuItems=MenuMaintenance::getMenu();
        $menuTreeItems=MenuMaintenance::getTree();
        return $this->render('index', [
            'searchModel' => $searchModel,
    	    'menuItems'=>$menuItems,
            'items'=>$menuTreeItems,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MenuMaintenance model.
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
     * Creates a new MenuMaintenance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new MenuMaintenance();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MenuMaintenance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $_SESSION['KCFINDER']['disabled'] = false; // enables the file browser in the admin
        // $_SESSION['KCFINDER']['uploadURL'] = Yii::app()->baseUrl."/uploads/"; // enables the file browser in the admin
        $_SESSION['KCFINDER']['uploadURL'] = "@app/uploads"; // enables the file browser in the admin
        $_SESSION['KCFINDER']['uploadDir'] = "@backend/uploads"; // enables the file browser in the admin
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
     * Deletes an existing MenuMaintenance model.
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
     * Finds the MenuMaintenance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MenuMaintenance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MenuMaintenance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
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

            $savefolder = \Yii::getAlias('@webroot').'/images/menu/'.strtolower($id);
            if (!file_exists($savefolder.'/thumbnails')){
                     mkdir($savefolder.'/thumbnails',0775,true);
                }
            
            if ($model->upload($savefolder)) {
                Image::thumbnail($savefolder.'/'.$model->files[0]->name, 120, 120)->save($savefolder.'/thumbnails/'.$model->files[0]->name, ['quality' => 80]);
                $response['files'][] = [
                    'name' => $model->files[0]->name,
                    'url'=>Url::to('@web/images/menu/'.strtolower($id).'/'.$model->files[0]->name,true),
                    'type' => $model->files[0]->type,
                    'size' => $model->files[0]->size,
                    'thumbnailUrl' => Url::to('@web/images/menu/'.strtolower($id).'/thumbnails/'.$model->files[0]->name,true),
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
