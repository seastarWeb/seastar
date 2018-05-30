<?php
/* Ducati History Controller
 * Created by stoat as template for module controllers invoked by Menu System
 * Locate Requested URL Lookup meta information and page data from tbl_menu
 */
namespace frontend\modules\controllers;
use Yii;
use frontend\models\Menu;
use yii\web\NotFoundHttpException;

class  KawasakiModelsController extends \yii\web\Controller
{
    public function actionIndex()
    {   
        $menukey=Yii::$app->request->url;
        return $this->render('index',['model' => $this->findModelByURL($menukey),]);
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
