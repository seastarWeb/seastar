<?php
/* Ducati History Controller
 * Created by stoat as template for module controllers invoked by Menu System
 * Locate Requested URL Lookup meta information and page data from tbl_menu
 */
namespace frontend\modules\controllers;
use Yii;
use frontend\models\Menu;
use yii\web\NotFoundHttpException;

class DucatiTrioptionsFinanceController extends \yii\web\Controller
{
    public function actionIndex($i=0)
    {
     var_dump($i);
     $menukey=Yii::$app->request->url;
     $model=$this->findModelByUrl($menukey);
   //  $parent=Menu::getParent($menukey);
        return $this->render('index',['model' => $model,]);
    
     }
     public function actionBelts($i=0)
    {
     if ($i<>0){
         var_dump($session);
     }else {
     $menukey=Yii::$app->request->url;
     $model=$this->findModelByUrl($menukey);
        return $this->render('index',['model' => $model,]);
     }
    }
    protected function findModelByUrl($url)
    {
        if (($model = Menu::getPage($url)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested finance page does not exist.  ~'.$url);
        }
    }

}
