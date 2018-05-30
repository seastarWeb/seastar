<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use himiklab\thumbnail\EasyThumbnailImage;
use yii\behaviors\SluggableBehavior;
use yii\imagine\Image;
use yii\helpers\Url;
/**
 * This is the model class for table "tbl_models".
 *
 * @property integer $id
 * @property integer $model_range_id
 * @property string $model_description
 * @property string $make
 * @property string $model
 * @property string $year
 *
 * @property Chassis[] $chasses
 * @property Colour[] $colours
 * @property Engine[] $engines
 * @property General[] $generals
 * @property ModelRange $modelRange
 */
class Models extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
            'class' => SluggableBehavior::className(),
            'attribute' => 'model',
            'slugAttribute' => 'alias',
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_models';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_range_id', 'model_description', 'make', 'model', 'year', ], 'required'],
            [['model_range_id'], 'integer'],
            [['model_page', 'model_image'], 'string'],
            [['rrp', 'colourway_one_rrp', 'colourway_two_rrp', 'colourway_three_rrp'], 'number'],
            [['model_description', 'model', 'alias', 'colourway_one', 'tfw_one', 'colourway_two', 'tfw_two', 'colourway_three', 'tfw_three'], 'string', 'max' => 100],
            [['model_excerpt'], 'string', 'max' => 1000],
            [['make'], 'string', 'max' => 50],
            [['year'], 'string', 'max' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model_range_id' => 'Model Range ID',
            'model_description' => 'Description',
            'model_excerpt' => 'Model Introduction',
            'model_page' => 'Web description of model',
            'make' => 'Manufacturer',
            'model' => 'Model',
            'year' => 'Model Year',
            'model_image' => 'Default image for model',
            'alias' => 'Slug - unique',
            'rrp' => 'Recommended retail price',
            'colourway_one' => 'Colourway One',
            'tfw_one' => 'Tank Frame Wheels One',
            'colourway_one_rrp' => 'RRP colourway one',
            'colourway_two' => 'Colourway Two',
            'tfw_two' => 'Tank Frame Wheels Two',
            'colourway_two_rrp' => 'RRP colourway two',
            'colourway_three' => 'Colourway Three',
            'tfw_three' => 'Tank Frame Wheels Three',
            'colourway_three_rrp' => 'RRP colourway three',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChasses()
    {
        return $this->hasMany(Chassis::className(), ['model_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColours()
    {
        return $this->hasMany(Colour::className(), ['model_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngines()
    {
        return $this->hasMany(Engine::className(), ['model_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenerals()
    {
        return $this->hasMany(General::className(), ['model_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinance()
    {
        return $this->hasMany(FinanceExample::className(), ['model_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinkModelProductlines()
    {
        return $this->hasMany(LinkModelProductline::className(), ['mid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPls()
    {
        return $this->hasMany(TblProductLines::className(), ['id' => 'plid'])->viaTable('link_model_productline', ['mid' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModelRange()
    {
        return $this->hasOne(TblModelRange::className(), ['id' => 'model_range_id']);
    }
    
    public static function getModelRanges()
    {
    	$primaryConnection = \Yii::$app->db;
    	$command = $primaryConnection->createCommand('select id,`model_range` from tbl_model_range order by model_range');
    	$rows = $command->queryAll();
    	$range=[];
        	foreach ($rows as $item){
        	       $range[]=array('label'=>$item['model_range'],'url'=>'?SearchModels[model_range_id]='.trim($item['id']).'&page=1&_pjax=%23w3&sort=-year');
        	}
        return $range;
    }

    public function replicateModel($doner,$recipient)
    {
	try{
	    	$sql = 'call usp_duplicateWrapper(:doner,:recipient)';
            $primaryConnection = \Yii::$app->db;
            $command =$primaryConnection->createCommand($sql);
            $command->bindParam(":doner", intval($doner));
            $command->bindParam(":recipient", intval($recipient));
            $command->execute();
	//	$list = $command->queryAll();
        $list=true;
	}catch (Exception $e) {
	    Log::trace("Error : ".$e);
	    throw new Exception("Error : ".$e);
	}
	return $list;
    }
/*
Return ActiveDataProvider for Model range <= 2 years old
This is has been er botched to allow for a single model range to have its own special treatment.
700 do it one way - and the Scrambler does it another... Way to go.
*/
    public function getCurrentModelRanges()
    {
        $make = Yii::$app->controller->module->id;
//bodge for ducati scrambler
        //die(print_r($make));
        $yr=date('Y')-2;
        if ($make=='scrambler'){
            $make='Ducati';
            $dp = new ActiveDataProvider([
                'query'=>TblModelRange::find()
                    ->joinWith(['models'])
                    //->where(['in','tbl_model_range.id',$ranges])
                    ->Where('Year > :year', [':year' => $yr])
                    ->andWhere(['Make'=>$make,])
                    ->andWhere(['model_range_id'=>15,]),
                'pagination'=>[
                    'pageSize'=>160,
                ],]);

        }else{

        $ranges = TblModels::find()
                ->select(['model_range_id'])
                ->distinct()
                ->where(['Make'=>$make,])
                ->andWhere('Year > :year', [':year' => $yr])
                ->asArray()
                ->all();
               // die(print_r($ranges));
        $dp = new ActiveDataProvider([
        'query'=>TblModelRange::find()
                ->joinWith(['models'])
                //->where(['in','tbl_model_range.id',$ranges])
                ->Where('Year > :year', [':year' => $yr])
                ->andWhere(['Make'=>$make,])
                ->orderBy(['Model'=>SORT_ASC ,'rrp'=>SORT_DESC,     'Year'=>SORT_DESC,      ])
                ,
            'pagination'=>[
            'pageSize'=>160,
            ],
            'sort' => [
                'attributes' => [
                    'Model',
                ],
            ],
        ]);
    }
        return $dp;
    }


// model range URL    
   public function  getMralias(){
        $mr=TblModelRange::findOne($this->model_range_id);
        $slug=$mr->alias;
        return $slug;
   }

   public function  getThumb(){

       $img_folder=\Yii::getAlias('@webroot').'/backend/uploads/images/models/'.$this->id.'/';
       $img_to_process ='';

        if(file_exists($img_folder)){
            $h=opendir($img_folder);
            while (false !== ($entry = readdir($h))) {
                if($entry != '.' && $entry != '..') { //Skips over . and ..
                    $img_to_process= $img_folder.$entry; //Do whatever you need to do with the file
                    break; //Exit the loop so no more files are read
                }
            }
        }else{
            $img_to_process='backend/uploads/images/bikestock/default/1.jpg';
        }
       
       $image=EasyThumbnailImage::thumbnailImg($img_to_process, 260,200,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => $this->model_description,'class'=>'img-rounded'] );
       
       return \yii\helpers\Html::a($image, '/'.Yii::$app->controller->module->id.'/models/'.$this->mralias);
    }

   public function  getDetailThumb(){

       $img_folder=\Yii::getAlias('@webroot').'/backend/uploads/images/models/'.$this->id.'/';
       $img_to_process ='';

        if(file_exists($img_folder)){
            $h=opendir($img_folder);
            while (false !== ($entry = readdir($h))) {
                if($entry != '.' && $entry != '..'&& $entry != 'thumnails') { //Skips over . and ..
                    $img_to_process= $img_folder.$entry; //Do whatever you need to do with the file
                    break; //Exit the loop so no more files are read
                }
            }
        }else{
            $img_to_process='backend/uploads/images/bikestock/default/1.jpg';
        }
       
       $image=EasyThumbnailImage::thumbnailImg($img_to_process, 260,200,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => $this->model_description,'class'=>'img-rounded']);
       
       return \yii\helpers\Html::a($image, '/'.Yii::$app->controller->module->id.'/the/'.$this->alias);
    }


    private function getMotorCycleSpecs($i=9) 
    {
    /*
     * create data provider determined by model_range_id
     * 
     */

    $year=intval(date("Y")-2);
        
    $dataProvider = new ActiveDataProvider([
        'query'=>TblModels::find()
            ->joinWith(['colours'])
            ->joinWith(['generals'])
            ->joinWith(['chasses'])
            ->joinWith(['engines'])
            ->where(['model_range_id' => $i])
            ->andWhere(['>','year',$year])
            ->orderBy(['year'=> SORT_DESC]),
        'pagination'=>[
        'pageSize'=>12,
        ],
        ]);
    return $dataProvider;
    }

   /*
    *
    * */
    public function getModelDetails($modelid)
    {
    $dataProvider = new ActiveDataProvider([
        'query'=>TblModels::find()
            ->joinWith(['colours'])
            ->joinWith(['generals'])
            ->joinWith(['chasses'])
            ->joinWith(['engines'])
            ->where(['tbl_models.id' => $modelid])
            ->orderBy(['year'=> SORT_DESC]),
        'pagination'=>[
        'pageSize'=>12,
        ],
        ]);
    return $dataProvider;

    }
    public function getImages($id=1)
    {
    /*
     * search in model ID folder (in backend/uploads/images/bikestock/) resize to 800x600 review to Viewport dependant RCM
     * 22/02/2014
     * */


    $img_folder=\Yii::getAlias('@webroot').'/backend/uploads/images/models/'.$id.'/';
    $model=Models::findOne($id);
    if(file_exists($img_folder)){
         $files[]=\yii\helpers\FileHelper::findFiles($img_folder,['only'=>['*.jpg','*.png'],'recursive'=>FALSE]);
    }else{
        $files[]=\yii\helpers\FileHelper::findFiles('backend/uploads/images/bikestock/default/',['recursive'=>FALSE]);
    }

    $images=array();
    foreach ($files as $image){
        foreach ($image as $url){
        $t1=$url;
        //die(print_r($t1));

 //       $images[]=Yii::$app->urlManager->createAbsoluteUrl([\yii\helpers\FileHelper::normalizePath($t1,'/')],true);
         $images[]=EasyThumbnailImage::thumbnailImg($t1, 660,400,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => $model->model_description,'class'=>'img-rounded']);
        }
    }
   // die(print_r($images));
    return $images;
    }


        /**
     *      * Finds the Bikes model based on its primary key value.
     *     * If the model is not found, a 404 HTTP exception will be thrown.
     *       * @param string $id
     *       * @return Bikes the loaded model
     *      * @throws NotFoundHttpException if the model cannot be found
     *                             */
    private function findModel($id)
    {
        if (($model = TblModels::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function findModelPartsByAlias($alias)
    {
        $model=TblModels::find()->where(['alias'=> $alias])->one();
        die(var_dump($model->id));
        $totalCount = Yii::$app->db->createCommand('SELECT COUNT(*) FROM link_model_productline WHERE mid=:id', [':id' => $model->id])
                    ->queryScalar();

        $dataProvider = new SqlDataProvider([
            'sql' => 'SELECT * FROM link_model_productline WHERE mid=:mid',
            'params' => [':mid' => $model->id],
            'totalCount' => $totalCount,
            'sort' =>false, //to remove the table header sorting
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $dataProvider;
    }


    /*
     * Return the latest version of the model identied needs to be sluggified 14/08/2015
     * */
    private function findModelByName($name)
    {
        // define year from date
        $year=date("Y");
        if (($model= TblModels::find() ->where(['model_description'=> $name]) ->andWhere(['year'=>$year]) ->one()) !==null){
            $year='2014';// !!!!!!!!!!!!!!! Remove !!!!!!entered for 2014 data only 
        }
        
        // return model from name and date
        if (($model= TblModels::find() ->where(['model_description'=> $name]) ->andWhere(['year'=>$year]) ->one()) !==null){
            return $model;
        }else
           {
                throw new NotFoundHttpException('The requested page does not exist. Has this years model been input?');
           }
    }
}
