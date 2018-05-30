<?php

namespace frontend\modules\controllers;
use yii\web\Controller;
use Yii;
use frontend\models\Menu;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

class DefaultController extends Controller
{
    /*
     * current menu as model with child menus as Data provider
     * 
     * */
    public function actionIndex()
    {
    	$menukey=Yii::$app->request->url;
    	$model=$this->findModelByUrl($menukey);
        $submenuitems=Menu::getSubMenu($model->id);
    	$id=$model->id;
    	$dataProvider = new ActiveDataProvider([
    		'query'=>Menu::find()
    			->where(['pid' => $id])
    			->andWhere('id > 1')
    			->andWhere('status = 1'),
    		'pagination'=>[
    		'pageSize'=>12,
    		],
    		]);
        return $this->render('index', 
            ['model' => $model,
            'dataProvider'=>$dataProvider,
            'submenuitems'=>$submenuitems,
            ]);
    }

   public function actionView()
    {
        $message='Your message here';
        return $this->render('index',array('message'=>$message));
    }
    public function actionApprovedUsed()
    {
     return $this->render('index');
    }
    protected function findModelByUrl($url)
    {
        if (($model = Menu::getPage($url)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.'.$url);
        }
    }
}
