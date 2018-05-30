<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TblMenu;

/**
 * Menu handles requests for Navigation menuitems
 */
class Menu extends TblMenu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pid', 'status', 'version'], 'integer'],
	    [['pid','status','version'],'default',1],
            [['menu', 'metadesc', 'title', 'page', 'template','url'], 'safe'],
        ];
    }
    public static function getItems()
    {
    $items = [];
    $models = Menu::find()->all();
    foreach($models as $model) {
                $item[] = ['label' => $model->menu, 'url' => $model->menu];
    }
    }
    public static function getMenu()
    { $result=static::getMenuRecursive(1);
        return $result;
    }

    private static function getMenuRecursive($parent)
    {
        $items=Menu::find()
                ->where(['pid'=>$parent])
                ->andwhere(['status'=>'1'])
                ->asArray()
                ->all();
        $result=[];

        foreach ($items as $item){
            $result[]=[
                'label'=>$item['menu'],
                'url'=>['#'],
                'items'=>static::getKids($item['id']),
                ];
         }
        return $result;
    }
    private static function getKids($parent)
    {
        $items=Menu::find()
                ->where(['pid'=>$parent])
                ->andwhere(['status'=>'1'])
                ->asArray()
                ->all();
        $result=[];
        foreach ($items as $item){
            $result[] = array('label'=>$item['menu'], 'url'=>'/menu-maintenance/update?id='.$item['id'],
                'items'=>static::getKids($item['id']),
                    );
        }
	asort($result);
        return $result;

    }
    public function getLeaves($parent)
	// returns excerpts from the child menu Items
    {
        $items=Menu::find()
                ->where(['pid'=>$parent])
                ->andwhere(['status'=>'1'])
                ->asArray()
                ->all();
        $result=[];
        foreach ($items as $item){
         $result[] = array('label'=> $item['menu'], 
                   'content'=>$item['excerpt'].'<p><a class="btn btn-sm btn-success" href="'.$item['URL'].'">Read More...</a></p>',
                   );
        }
        //return $result;
        return $result;

    }
    public static function getPage($url)
    {
        $page = Menu::find()->where(['URL' => $url])->one();
        return $page;
    }
    public static function getMenuImage($url='default')
    {
        $image = 'http://www.seastarsuperbikes.co.uk/Kawasaki%202015/Ninja%2030th%20Anniversary/140/zx10r_30_anni_lrhsf.jpg';
        return $image;
    }
    public static function getParent($url)
    {
        $page = Menu::find()->where(['URL' => $url])->one();
        $searchurl=Menu::findOne($page['id']);
        return $searchurl['URL'];
    }

}
