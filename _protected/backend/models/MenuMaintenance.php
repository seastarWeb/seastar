<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_menu".
 *
 * @property integer $id
 * @property integer $pid
 * @property string $menu
 * @property string $metadesc
 * @property string $title
 * @property string $page
 * @property string $template
 * @property integer $status
 * @property integer $version
 * @property string $URL
 *
 * @property MenuMaintenance $p
 * @property MenuMaintenance[] $menuMaintenances
 */
class MenuMaintenance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'status', 'version','model_range_id'], 'integer'],
            [['menu', 'metadesc', 'title', 'page', 'URL'], 'required'],
            [['excerpt'], 'string'],
            [['page'], 'string'],
            [['menu'], 'string', 'max' => 50],
            [['metadesc'], 'string', 'max' => 160],
            [['URL','imagelocation'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 200],
            [['template'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => 'Parent Menu',
            'menu' => 'Menu',
            'metadesc' => 'Meta Description',
            'title' => 'Title',
            'excerpt' => 'Excerpt',
            'page' => 'Page',
            'template' => 'Template',
            'status' => 'Enabled',
            'version' => 'Version',
            'URL' => 'Url',
            'imagelocation' => 'Image Location',
            'model_range_id'=> 'Model Range'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(MenuMaintenance::className(), ['id' => 'pid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(MenuMaintenance::className(), ['pid' => 'id']);
    }
public static function getMenu()
{ 
    $result=static::getMenuRecursive(1);
    return $result;
}


public static function getTree()
{
    $result=static::getTreeMenu(1);
    //die(var_dump($result));
    return $result;
}

private static function getMenuRecursive($parent)
{
    $items=MenuMaintenance::find()
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
    $items=MenuMaintenance::find()
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
    return $result;
}

private static function getTreeMenu($parent)
{
    $items=MenuMaintenance::find()
    ->where(['pid'=>$parent])
    ->andwhere(['status'=>'1'])
    ->asArray()
    ->all();
    $result=[];
    foreach ($items as $item){
    $result[] = array('text'=>$item['menu'], 'href'=>'/menu-maintenance/update?id='.$item['id'],
        'nodes'=>static::getTreeMenu($item['id']),
        );
    }
    return $result;
}


public function afterSave($insert, $changedAttributes)
{
    if(isset($this->logo)){
        $this->logo=UploadedFile::getInstance($this,'logo');
    if(is_object($this->logo)){
        $path=Yii::$app->basePath . '/images/';  //set directory path to save image
        $this->logo->saveAs($path.$this->id."_".$this->logo);   //saving img in folder
        $this->logo = $this->id."_".$this->logo;    //appending id to image name            
    \Yii::$app->db->createCommand()
              ->update('organization', ['logo' => $this->logo], 'id = "'.$this->id.'"')
              ->execute(); //manually update image name to db
        }
    }
}

}
