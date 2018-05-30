<?php

namespace common\models;

use Yii;
use yii\helpers\Url;
use common\models\DucatiClothingCategories;
use himiklab\thumbnail\EasyThumbnailImage;
/**
 * This is the model class for table "tbl_bikestock".
 *
 * @property string $make
 * @property string $model
 * @property string $colour
 * @property string $frame_no
 * @property string $engine_no
 * @property string $cc
 * @property string $mileage
 * @property string $1st_reg_date
 * @property string $purchase_date
 * @property integer $from
 * @property string $description
 * @property string $location
 * @property string $id
 * @property string $sale_date
 * @property string $sale_price
 * @property integer $sold
 * @property string $display_price
 * @property string $purchase_price
 * @property string $min_price
 * @property string $catagory
 * @property string $reg
 * @property string $spent
 * @property integer $sold_to
 * @property integer $invoice_in
 * @property string $holding
 * @property integer $invoice_out
 * @property string $MISC1
 * @property string $MISC2
 * @property string $MISC3
 * @property string $MISC4
 * @property string $MISC5
 * @property string $MMISC1
 * @property string $MMISC2
 * @property string $MMISC3
 * @property string $trim
 * @property string $mot
 * @property string $door
 * @property string $ignition
 * @property string $plan
 * @property string $siv
 * @property string $plan_date
 * @property string $fuel
 * @property string $warranty
 * @property string $wdate
 * @property string $nominal
 * @property integer $transferred
 * @property string $nominal_in
 * @property string $dateEdit
 * @property string $timeEdit
 * @property string $vehicleClass
 * @property string $category
 * @property string $supplierRef
 * @property integer $A
 * @property integer $B
 * @property integer $C
 * @property string $details
 * @property string $regfee
 * @property string $roadtax
 */
class Bikes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bikestock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from', 'sold', 'sold_to', 'invoice_in', 'invoice_out', 'transferred', 'A', 'B', 'C'], 'integer'],
            [['id'], 'required'],
            [['purchase_price', 'spent'], 'number'],
            [['make', 'colour', 'frame_no', 'trim'], 'string', 'max' => 25],
            [['model'], 'string', 'max' => 28],
            [['engine_no'], 'string', 'max' => 26],
            [['cc', 'holding', 'MISC2', 'MISC3', 'MMISC1', 'MMISC2', 'MMISC3', 'vehicleClass', 'category'], 'string', 'max' => 10],
            [['mileage', 'id'], 'string', 'max' => 5],
            [['1st_reg_date', 'purchase_date', 'sale_date', 'plan_date', 'wdate', 'dateEdit', 'timeEdit'], 'string', 'max' => 16],
            [['description'], 'string', 'max' => 391],
            [['location', 'siv', 'fuel'], 'string', 'max' => 6],
            [['sale_price', 'plan'], 'string', 'max' => 3],
            [['display_price', 'min_price'], 'string', 'max' => 7],
            [['catagory'], 'string', 'max' => 18],
            [['reg', 'MISC5', 'ignition', 'supplierRef'], 'string', 'max' => 8],
            [['MISC1', 'MISC4', 'mot', 'door', 'warranty', 'nominal', 'nominal_in', 'regfee', 'roadtax'], 'string', 'max' => 1],
            [['details'], 'string', 'max' => 109]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'make' => 'Make',
            'model' => 'Model',
            'colour' => 'Colour',
            'frame_no' => 'Frame No',
            'engine_no' => 'Engine No',
            'cc' => 'Cc',
            'mileage' => 'Mileage',
            '1st_reg_date' => '1st Reg Date',
            'purchase_date' => 'Purchase Date',
            'from' => 'From',
            'description' => 'Description',
            'location' => 'Location',
            'id' => 'ID',
            'sale_date' => 'Sale Date',
            'sale_price' => 'Sale Price',
            'sold' => 'Sold',
            'display_price' => 'Display Price',
            'purchase_price' => 'Purchase Price',
            'min_price' => 'Min Price',
            'catagory' => 'Catagory',
            'reg' => 'Reg',
            'spent' => 'Spent',
            'sold_to' => 'Sold To',
            'invoice_in' => 'Invoice In',
            'holding' => 'Holding',
            'invoice_out' => 'Invoice Out',
            'MISC1' => 'Misc1',
            'MISC2' => 'Misc2',
            'MISC3' => 'Misc3',
            'MISC4' => 'Misc4',
            'MISC5' => 'Misc5',
            'MMISC1' => 'Mmisc1',
            'MMISC2' => 'Mmisc2',
            'MMISC3' => 'Mmisc3',
            'trim' => 'Trim',
            'mot' => 'Mot',
            'door' => 'Door',
            'ignition' => 'Ignition',
            'plan' => 'Plan',
            'siv' => 'Siv',
            'plan_date' => 'Plan Date',
            'fuel' => 'Fuel',
            'warranty' => 'Warranty',
            'wdate' => 'Wdate',
            'nominal' => 'Nominal',
            'transferred' => 'Transferred',
            'nominal_in' => 'Nominal In',
            'dateEdit' => 'Date Edit',
            'timeEdit' => 'Time Edit',
            'vehicleClass' => 'Vehicle Class',
            'category' => 'Category',
            'supplierRef' => 'Supplier Ref',
            'A' => 'A',
            'B' => 'B',
            'C' => 'C',
            'details' => 'Details',
            'regfee' => 'Regfee',
            'roadtax' => 'Roadtax',
        ];
    }
        public static function find()
        {
	    // modified to only display sales grade machines (trim A to C).
            return parent::find()->where(['trim' => 'A'])->orWhere(['trim'=>'B'])->orWhere(['trim'=>'C'])->orderBy('make');// ->limit(5);
     }
    /*
Return list of manufacturers that are in stock and salesworthy
18.1.2015
*/    
	
    public static function getManufacturers()
    {
        $makes=Bikes::find()->select('Make')->distinct()->asArray()->All();
/*
            $primaryConnection = \Yii::$app->db;
            $command = $primaryConnection->createCommand('select distinct `Make` from tbl_bikestock where sold = 0 and trim < "D" order by make');
            $rows = $command->queryAll();
            $makes=[];
// dicked around with to correct 2nd hand bike filtering using form rather than dropdown.            
            foreach ($rows as $make){
              // $makes[]=array('label'=>$make['Make'],'url'=>'?BikeSearch[make]='.trim($make['Make']).'&page=1');
                $makes[]=$make;
            }
            */
            return $makes;
    }

    public static function getManufacturersBikes()
    {
            $primaryConnection = \Yii::$app->db;
            $command = $primaryConnection->createCommand('select distinct `Make` from tbl_bikestock where sold = 0 and trim < "C" order by make, model');
            $distinctmakes = $command->queryAll();
            $command = $primaryConnection->createCommand('select distinct `Make`,`Model` from tbl_bikestock where sold = 0 and trim < "C" order by make, model');
            $distinctmakes_models = $command->queryAll();
            $makes=[];
            foreach ($distinctmakes as $make){
               $return[]=array('label'=>$make['Make'],'url'=>'#',
		       // 'linkOptions'=>['data-url'=>Url::to(['/motorcycles/approved-used/index?BikeSearch[make]=TRIUMPH&page=2&per-page=1'])]);
		        'linkOptions'=>['data-url'=>Url::to(['/motorcycles/approved-used/simple'])],
			 'content' =>$content1,

			);
            }
            return $return;
    }
/*
Function to retrieve thumbnail image of each motorcycle and return it to Slick Carousel
15/06/2015
*/
    public function getBikes(){
        $result=[];
        $items=Bikes::find()->all();
        foreach ($items as $item){
            $pictureFile = Bikes::getOneImage($item['id']);
            $img = EasyThumbnailImage::thumbnailImg($pictureFile, 300,200,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => $item['model'],'class'=>'img-rounded','style'=>'width:98%; height:auto;']);         
            $result[] =array('Make'=>$item['make'],'Model'=>$item['model'],'Image'=>$img,'Price'=>$item['display_price'],'ID'=>$item['id']);
            }
        return $result;
    }

/*
Return file system location of stock id image from folder
*/
    public static function getOneImage($id){
        $img_folder=\Yii::getAlias('@webroot').strtolower('/backend/uploads/images/bikestock/'.strtolower($id).'/');
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
        return $img_to_process;
    }



    public static function getBikeimages($stockid='default')
    {
	/*
	 * search in stock number folder (in uploads/images/bikestock/) resize to 800x600 review to Viewport dependant RCM
	 * 22/02/2014
	 * */
	if (file_exists('backend/uploads/images/bikestock/'.strtolower($stockid))){
	    $files[]=\yii\helpers\FileHelper::findFiles('backend/uploads/images/bikestock/'.strtolower($stockid),['only'=>['*.jpg','*.png'],'recursive'=>FALSE]);
	    /* Resize check needs to be implemented here */
	}else
	{
	    $files[]=\yii\helpers\FileHelper::findFiles('backend/uploads/images/bikestock/default/',['recursive'=>FALSE]);
	}
    $images=array();
	foreach ($files as $image){
	    foreach ($image as $url){
		$t1=$url;
		$images[]=Yii::$app->urlManager->createAbsoluteUrl([\yii\helpers\FileHelper::normalizePath($t1,'/')],true);
	    }
	}
	return $images;
    }

}

/*
 * String to filter via pjax
 */
