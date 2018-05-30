<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TblMenu;
use common\models\TblModelRange;
use yii\imagine\Image;
use himiklab\thumbnail\EasyThumbnailImage;
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
            [['id', 'pid', 'status', 'version','model_range_id'], 'integer'],
	        [['pid','status','version'],'default',1],
            [['menu', 'metadesc', 'title', 'page', 'template','url','imagelocation'], 'safe'],
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

    public static function getSubMenu($pid=1)
    { $result=static::getMenuRecursive($pid);
        return $result;
    }
/*
Recursively reads menu table - v inefficient should use array functions
1-Finds active child pages with status=1
2-If the page has the model range field set = then find the models relating to that model range

*/
    private static function getMenuRecursive($parent)
    {
        $items=Menu::find()
                ->where(['pid'=>$parent])
                ->andwhere(['status'=>'1'])
                ->asArray()
                ->all();
        $result=[];
        foreach ($items as $item){
            $modelrange=intval($item['model_range_id']);
            if ($modelrange==0){
                $result[]=[
                    'label'=>$item['menu'],
                    'url'=>$item['URL'],
               //     'items'=>static::getKids($item['id']),
                    ];
            }else{
                $mr=TblModelRange::find()->where(['id'=>$modelrange])->one();
                $models=$mr->models;
                $t=array();
                foreach($models as $mdl){
                    $y=date('Y');
                    $y=$y-1;
                  //  die(print_r($mdl));
                  //  die(print_r($mr->alias));
                    if ($mdl->make=='Ducati'&&$mr->alias='scrambler'){
                        //die("argh!! Botched to death");
                          $turl='/scrambler/models/';//.$mr->alias;
                        }else{
                            $turl='/'.strtolower($mdl->make).'/models/'.$mr->alias;
                        };
                    
                    if ($mdl->year>=$y){
                        $t[]=array('label'=>$mdl->model_description,'url'=>'');
                    }
                }
              //  die(var_dump($models));
                    //$result[] = array('label'=>$mr->model_range,'url'=>$turl,'items'=>$t);
                    $result[] = array('label'=>$mr->model_range,'url'=>$turl);
              //  die('A Model Range has been declared'.intval($item['model_range_id']));
            }
         }
          
        return $result;
    }

    /* Gets children of the menu item unless a model range is declared - then returns model range.
    */
    private static function getKids($parent)
    {
        $items=Menu::find()
                ->where(['pid'=>$parent])
                ->andwhere(['status'=>'1'])
                ->asArray()
                ->all();
        $result=[];
        foreach ($items as $item){
            $modelrange=intval($item['model_range_id']);
            if ($modelrange==0){
                    $result[] = array('label'=>$item['menu'], 'url'=>$item['URL'],  'items'=>static::getKids($item['id']),);
                }else{
                    $mr=TblModelRange::find()->where(['id'=>$modelrange])->one();
                    $models=$mr->models;
                    $t=array();
                    foreach($models as $mdl){
                        $y=date('Y');
                        $y=$y-1;
                        if ($mdl->year>=$y){
                            $t[]=array('label'=>$mdl->model_description,'url'=>'');
                            $turl='/'.strtolower($mdl->make).'/models/'.$mr->alias;
                        }
                    }
                //    $result[] = array('label'=>$mr->model_range,'url'=>'#','items'=>$t);
                $result[] = array('label'=>$mr->model_range,'url'=>$turl);
            }
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
    public function getParent() {
    return $this->hasOne(self::classname(), 
           ['parent_id' => 'id'])->
           from(self::tableName() . ' AS parent');
    }
    public static function getParent1($url)
    {
        $page = Menu::find()->where(['URL' => $url])->one();
        $searchurl=Menu::findOne($page['id']);
        return $searchurl['URL'];
    }
/*
RCM 26/10/2015
See if we have a large image stored locally if so return it if not generate the re-sized files and return 1
Modified to allow biggest available (original image) to be stored as lg.jpg
*/
    public static function setMenuImage($model)
    {
/*
Check if a file already exists in the productline folder
If not create one and populate it with the result of the image from the URL
*/
        $pictureFile = \Yii::getAlias('@webroot').strtolower('/uploads/menu/'.$model->id.'/lg.jpg');
        $savefolder = \Yii::getAlias('@webroot').strtolower('/uploads/menu/'.$model->id.'/');
        $default = \Yii::getAlias('@webroot').strtolower('/uploads/menu/default/lg.jpg');
	// If the folder doesn't exist then create it
        if(!file_exists(dirname($pictureFile))&& $model->imagelocation>'')
            {
            mkdir(dirname($pictureFile), 0755, true);
// And then get the image from the Url supplied
            $imageUrl=str_replace("http://","",$model->imagelocation);
            $ch = curl_init('http://'.$imageUrl);
            $fp = fopen($pictureFile, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);
            if(!file_exists($pictureFile)){
//		die(var_dump('file dont exist'));
            }else{
                Image::thumbnail($pictureFile, 120, 120)->save($savefolder.'/tn.jpg', ['quality' => 90]);
                Image::thumbnail($pictureFile, 300, 300)->save($savefolder.'/sm.jpg', ['quality' => 90]);
            }
        }else{
	    if (!file_exists($pictureFile)){ $pictureFile=$default;}
	//	die(var_dump('file dont exist'));
	}

        $img=EasyThumbnailImage::thumbnailImg($pictureFile, 350,200,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => $model->menu,'class'=>'img-rounded']);
//	die(var_dump($img));
	return $img;
    }
}
