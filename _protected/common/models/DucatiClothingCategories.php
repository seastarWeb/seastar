<?php

namespace common\models;

use Yii;
use yii\imagine\Image;
use yii\helpers\Url;
use common\models\ProductLineSearch;
use common\models\SearchParts;
use himiklab\thumbnail\EasyThumbnailImage;

/**
 * This is the model class for table "vw_DucatiClothingCategories".
 *
 * @property string $category
 * @property string $Qty
 * @property string $SrcImage
 */
class DucatiClothingCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_DucatiClothingCategories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Qty'], 'integer'],
            [['category'], 'string', 'max' => 100],
            [['SrcImage'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category' => 'Category',
            'Qty' => 'Qty',
            'SrcImage' => 'Src Image',
        ];
    }
	public function getCategories_tn($cat=1)
	{	
	    $result=[];
	    if($cat==1){
		$items=DucatiClothingCategories::find()
		->all();
	    	foreach ($items as $item){
		$result[] =array('Category'=>$item['category'],'Image'=>'/category/ducati/'.str_replace(' ','_',strtolower($item['category']).'/tn.jpg'),'alt'=>$item['category'],'Qty'=>$item['Qty']);
		}
	    }else{
		$items=ProductLineSearch::find()->select('SubCategory, ProductLine,Description')
		->where(['Category'=> $cat])
		->andwhere(['Brand'=> 'Ducati'])
		->all();
	    	foreach ($items as $item){
		$result[] = array('Category'=>$item['SubCategory'],'Image'=>'/productline/ducati/'.str_replace(' ','-',strtolower($item['ProductLine']).'/tn.jpg'),'alt'=>$item['SubCategory'],'ProductLine'=>$item['ProductLine']);
		}
	    }

	    return $result;
	}
	public function getCategories_lg($cat=1)
	{	
	    $result=[];
	    if($cat==1){
	        $items=DucatiClothingCategories::find()
//		->asArray()
		->all();
	        foreach ($items as $item){
		//GetRandom Sub category image, resize it and present it
		// $this->setProductLineImage($item('SrcImage'));
		$result[] =array('Category'=>$item['category'],'Image'=>'/category/ducati/'.str_replace(' ','_',strtolower($item['category']).'/sm.jpg'),'alt'=>$item['category'],'Qty'=>$item['Qty'],'Description'=>$item['Description']);
		}
	        }else{
		    $items=ProductLineSearch::find()->select('Brand,SubCategory, ProductLine,Description')
		    ->where(['Category'=> $cat])
		    ->andwhere(['Brand'=> 'Ducati'])
		//    ->groupBy('SubCategory')
		    ->all();
		    foreach ($items as $item){
		     $result[] = array('Brand'=>$item['Brand'],'Category'=>$item['SubCategory'],'Image'=>'/productline/ducati/'.str_replace(' ','_',strtolower($item['ProductLine']).'/sm.jpg'),'alt'=>$item['SubCategory'],'Qty'=>1,'Description'=>$item['Description'],'ProductLine'=>$item['ProductLine']);
		    }
		}
	    return $result;
	}

	
/*
Function to retrieve associated partnumbers
Accepts product line as text input
Returns associated parts to Superceded partno
 */
	public function getPartNumbers($pline)
	{
	   $bits=ProductLineSearch::find()->select('PartNumbers')
	       ->where(['ProductLine'=>$pline])
	       ->asArray()
	       ->all();
	    $qry=explode(',',implode(',',$bits[0]));
	    //$parts=SearchParts::find()->select ('fn_GetSuperSession(PARTNO),DESCRIPTION,PRICE')
	    $parts=SearchParts::find()->select ('PARTNO,REFERNO,DESCRIPTION,PRICE,partid,STOCK_LEVEL')
		->where(['IN','PARTNO',$qry])
		->andWhere("REFERNO = ''")
		->all();
	    return $parts;

	}


/*
See if we have a thumbnail stored locally if so return it resized, if not generate the files and return 1
Modified to allow biggest available (original image) to be stored as lg.jpg
*/
	public static function setClothingCategoryImage($model)
	{
/*
	Check if a file already exists in the productline folder
	If not create one and populate it with the result of the image from the URL
	Return Image html complete with Alt tag.
*/
   		$pictureFile = \Yii::getAlias('@webroot').strtolower('/productline/'.$model->Brand.'/').$model->Slug.'/lg.jpg';
   		$savefolder = \Yii::getAlias('@webroot').strtolower('/productline/'.$model->Brand.'/').$model->Slug;

		if(!file_exists(dirname($pictureFile)))
            {
        	mkdir(dirname($pictureFile), 0755, true);
	        if ($model->Brand=='Ducati'){
	            $ch = curl_init('http://'.$model->OrigImageUrl);
	            $fp = fopen($pictureFile, 'wb');
	            curl_setopt($ch, CURLOPT_FILE, $fp);
	            curl_setopt($ch, CURLOPT_HEADER, 0);
	            curl_exec($ch);
	            curl_close($ch);
	            fclose($fp);
				Image::thumbnail($pictureFile, 120, 120)->save($savefolder.'/tn.jpg', ['quality' => 90]);
				Image::thumbnail($pictureFile, 300, 300)->save($savefolder.'/sm.jpg', ['quality' => 90]);
	        }
	    }    

	   // $img=EasyThumbnailImage::thumbnailImg($pictureFile, 400,400,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => $model->ProductLine,'class'=>'img-fullwidth']);
	    return $img;

	}


	/*
	 * * Frontend ProductCategory Image Generation*/
	public static function setProductCategoryImage($model)
	{
	    /*
/*finally the product line images*/
	    $prodImg = \Yii::getAlias('@webroot').strtolower('/backend/uploads/images/'.$model->Slug.'/').$model->DefaultImage;
	    $noapostrophe=  str_replace('\'','',$model->ProductLine);

	    $nopuncs = preg_replace("/[^0-9a-zA-Z- ]/", "", $model->ProductLine);

	    $productline=  strtolower(str_replace(' ','_',$nopuncs));
//die(print_r(strtolower($productline)));
	   //  $productline=  str_replace('/?','',$model->ProductLine);

	     //$productline=  str_replace('\#','',$model->ProductLine);
	 //   $productline =  strtolower($productline);

	    $brand=  str_replace('\'','',$model->Brand);
	    $brand=  str_replace(' ','_',$brand);
	    $brand=  strtolower($brand);
	  //  $destImg = \Yii::getAlias('@webroot').'/productline/'.str_replace(' ','-',strtolower($model->Brand.'/').strtolower($model->ProductLine));
	    $destImg = \Yii::getAlias('@webroot').'/productline/'.$brand.'/'.$productline;
	    	
	    if (file_exists($destImg.'/tn.jpg')){
		    $finalUrl=Url::home().strtolower('productline/'.$brand.'/'.$productline);
		    return $finalUrl;
	    }
	    if(!file_exists($prodImg)){
	    	// set model->hasimage = false
		      return '/';
		    }else{
		    $files=$prodImg;
		    } ;

	    $savefolder = $destImg;
	//    echo $savefolder;
	    if (!file_exists($savefolder.'/')){
		/* create Product Category folder */
	//	die(print_r($savefolder.'/'));
			 mkdir($savefolder,0775,true);
			   //   die(print_r($savefolder));
			 //return '/';
	    }
	
	    if (file_exists($savefolder.'/tn.jpg')){
	    }else{
			if (isset($model->DefaultImage)){
				if (strlen($model->DefaultImage)>4){
					Image::thumbnail($files, 120, 120)->save($savefolder.'/tn.jpg', ['quality' => 90]);
					Image::thumbnail($files, 300, 300)->save($savefolder.'/sm.jpg', ['quality' => 90]);
					Image::thumbnail($files, 800, 800)->save($savefolder.'/lg.jpg', ['quality' => 90]);
				}
			}
	    }
/*finally the product line images*/

	//    $finalUrl=Url::home().strtolower('productline/'.$model->Brand.'/').str_replace(' ','-',strtolower($model->ProductLine));
	    $finalUrl=Url::home().strtolower('productline/'.$brand.'/'.$productline);
	    return $finalUrl;
	}


}
