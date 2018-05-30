<?php
namespace frontend\controllers;
use yii\web\Controller;
use common\models\AccessorySearch  ;
use common\models\TblProductLines;
use yii\web\NotFoundHttpException;
use yii\web\MethodNotAllowedHttpException;
use yii\helpers\Url;
use yii\helpers\Json;
use Yii;

/**
 * Accessories Controller implements Browsing ProductLines for Accessories.
 */
class AccessoriesController extends Controller
{
    /**
     * Lists all Article models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccessorySearch;
        $dataProvider =$searchModel::getAccessoryCats();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a category of Accessories.
    */
    public function actionCategory()
    {
       // die(print_r(Yii::$app->request->queryParams));
        Url::remember();
       $searchModel = new AccessorySearch;
       $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('accessoryindex', [
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
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * 
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();

        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            return $this->redirect(['view', 'id' => $model->id]);
        } 
        else 
        {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * 
     * @param  integer $id
     * @return mixed
     *
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->user->can('updateArticle', ['model' => $model])) 
        {
            if ($model->load(Yii::$app->request->post()) && $model->save()) 
            {
                return $this->redirect(['view', 'id' => $model->id]);
            } 
            else 
            {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
        else
        {
            throw new MethodNotAllowedHttpException(Yii::t('app', 'You are not allowed to access this page.'));
        } 
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * 
     * @param  integer $id
     * @return mixed
     *
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect('admin');
    }

    /**
     * Manage Articles.
     * 
     * @return mixed
     */
    public function actionAdmin()
    {
        /**
         * How many articles we want to display per page.
         * @var integer
         */
        $pageSize = 11;

        /**
         * Only admin+ roles can see everything.
         * Editors will be able to see only published articles and their own drafts @see: search(). 
         * @var boolean
         */
        $published = (Yii::$app->user->can('admin')) ? false : true ;

        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $pageSize, $published);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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

    $data = TblProductLines::find()->select('Category')->where(['LIKE','Brand',$brand])->andwhere(['=','Department','Accessories'])->distinct()->orderBy('Category')->asArray()->All();
    $out = [];
    foreach ($data as $d) {
        $out[] = ['id'=>  $d['Category'],'name' => $d['Category']];
    }
    return $out;
  }
}
