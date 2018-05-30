<?php

namespace common\models;

use Yii;
use yii\imagine\Image;
use yii\behaviors\SluggableBehavior;
use himiklab\thumbnail\EasyThumbnailImage;
use yii\helpers\Url;
/**
 * This is the model class for table "tbl_product_lines".
 *
 * @property integer $id
 * @property string $Department
 * @property string $Brand
 * @property string $Category
 * @property string $SubCategory
 * @property string $ProductLine
 * @property string $DefaultImage
 * @property string $Fitment
 * @property string $PartNumbers
 * @property string $Description
 * @property string $Colours 
 * @property string $Sizes 
 */
class TblProductLines extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
public function behaviors()
{
    return [
	[
	'class' => SluggableBehavior::className(),
	'attribute' => 'ProductLine',
	'slugAttribute' => 'Slug',
	],
	];
}

    public static function tableName()
    {
        return 'tbl_product_lines';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Description'], 'string'],
            [['Department', 'Brand', 'DefaultImage'], 'string', 'max' => 50],
            [['Category', 'SubCategory', 'ProductLine'], 'string', 'max' => 100],
            [['Fitment'], 'string', 'max' => 30],
            [['Active'], 'integer'],
            [['PartNumbers'], 'string', 'max' => 400],
            [['Colours', 'Sizes','Slug'], 'string', 'max' => 255]

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Department' => 'Department',
            'Brand' => 'Brand',
            'Category' => 'Category',
            'SubCategory' => 'Sub Category',
            'ProductLine' => 'Product Line',
            'DefaultImage' => 'Default Image',
            'Fitment' => 'Fitment',
            'PartNumbers' => 'Part Numbers',
            'Description' => 'Description',
            'Colours' => 'Colours', 
            'Sizes' => 'Sizes',
            'Slug' => 'Slug',
            'Active'=>'Active On Site',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinkModelProductlines()
    {
        return $this->hasMany(LinkModelProductline::className(), ['plid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMs()
    {
        return $this->hasMany(Models::className(), ['id' => 'mid'])->viaTable('link_model_productline', ['plid' => 'id']);
    }
    
/* 
* Backend ProductLine Image Generation
To Be Deprecated
*/
    public static function setProductLineImage($model)
    {
    	$prodImg = \Yii::getAlias('@webroot').strtolower('/uploads/images/'.$model->Brand.'/').$model->DefaultImage;
    	$files=$prodImg;
    	if (!file_exists($prodImg)){
    	    //mark model with no image!
    	    return false;
    	}
    	$destImg= \Yii::getAlias('@webroot').strtolower('/../productline/'.$model->Brand.'/');
    	if (!file_exists($destImg)){
    	    	mkdir($destImg);
    		}
    	$savefolder = $destImg.str_replace(' ', '_', strtolower($model->ProductLine));
    	if (!file_exists($savefolder.'/')){
    	    	/* create ProductLine folder */
    	    	mkdir($savefolder);
    	}
    	if (file_exists($savefolder.'/tn.jpg')){
    	}else{
	    	Image::thumbnail($files, 120, 120)->save($savefolder.'/tn.jpg', ['quality' => 90]);
    		Image::thumbnail($files, 300, 300)->save($savefolder.'/sm.jpg', ['quality' => 90]);
    		Image::thumbnail($files, 800, 800)->save($savefolder.'/lg.jpg', ['quality' => 90]);
    	}
	return true; 
   }
   public function  getThumb(){
     // $image = \yii\helpers\Html::img('path/to/image.jpg');
       $pictureFile=\Yii::getAlias('@webroot').'/uploads/images/'.strtolower($this->Brand).'/'.$this->DefaultImage;
       //die(print_r($pictureFile));
       $image=EasyThumbnailImage::thumbnailImg($pictureFile, 200,200,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => $this->ProductLine,'class'=>'img-rounded']);
    return \yii\helpers\Html::a($image, '/product-line/view?id='.$this->id);
    }

// Returns brands and categories 
    public function getBrandCats(){
        $command = Yii::$app->db->createCommand("SELECT LCASE(brand) AS Brand, LCASE(category) AS Category, COUNT(1) AS Items FROM tbl_product_lines GROUP BY brand, category ORDER BY brand, category");
        $result= $command->queryAll();
        $savedbrand='';
        foreach ($result as $key => $value) {
    # If the brand is unchanged then add the category to it, otherwise create the new brand and add the category to that
            if ($value['Brand']==$savedbrand){
                $response[] = array('content'=>$value['Category'], 'url'=>$value['Category'],  'badge'=>$value['Items']);
            }else{
                $savedbrand=$value['Brand'];
                $response[] = array('content'=>['heading' => $value['Brand'], 'body' => ''], 'url'=>$value['Brand']);    
                $response[] = array('content'=>$value['Category'], 'url'=>$value['Category'],  'badge'=>$value['Items']);
            }
       }
        return $response;
    }


/*
RCM 26/10/2015
See if we have a large image stored locally if so return it if not generate the re-sized files and return 1
Modified to allow biggest available (original image) to be stored as lg.jpg
*/
    public static function getProductLineImage($model)
    {
/*
Check if a file already exists in the productline folder
If not create one and populate it with the result of the image from the URL
*/

        $pictureFile = \Yii::getAlias('@webroot').strtolower('/productline/'.$model->Brand.'/').$model->Url.'/lg.jpg';
        $savefolder = \Yii::getAlias('@webroot').strtolower('/productline/'.$model->Brand.'/').$model->Url;
         $img="<img class='img-fullwidth ctaimage-image' src='http://placehold.it/400x400?text=$model->ProductLine'>";
// If the folder doesn't exist then create it
        if(!file_exists(dirname($pictureFile))&&$model->OrigImageUrl>'')
            {

            mkdir(dirname($pictureFile), 0755, true);
// And then get the image from the Url supplied
            $imageUrl=str_replace("http://","",$model->OrigImageUrl);
            $ch = curl_init('http://'.$imageUrl);
            $fp = fopen($pictureFile, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 1000);      // some large value to allow curl to run for a long time
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);
            if(file_exists($pictureFile)){
                $img="<img class='img-fullwidth ctaimage-image' src=".Url::to('@web/productline/'.$model->Brand.'/'.$model->Url.'/lg.jpg', true).">";
            }else{
                $img="<img class='img-fullwidth ctaimage-image' src=".Url::to('@web/productline/'.$model->Brand.'/'.$model->Url.'/lg.jpg', true).">";
                Image::thumbnail($pictureFile, 120, 120)->save($savefolder.'/tn.jpg', ['quality' => 90]);
                Image::thumbnail($pictureFile, 300, 300)->save($savefolder.'/sm.jpg', ['quality' => 90]);
            }
         //   $img=EasyThumbnailImage::thumbnailImg($pictureFile, 400,400,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => $model->ProductLine,'class'=>'img-fullwidth','itemprop'=>'image']);
        }elseif(file_exists(dirname($pictureFile))){
            //    die(var_dump(Url::to('@web/productline/'.$model->Brand.'/'.$model->Slug.'/lg.jpg', true)));
                $img="<img class='img-fullwidth ctaimage-image' src=".Url::to('@web/productline/'.$model->Brand.'/'.$model->Url.'/lg.jpg', true).">";
        }
//die(var_dump($pictureFile));
        
        return $img;
    }


    public static function setCategoryImage($model)
    {
/* If an image is marked as Category representative then attempt to use that
//Create a variable to store category text minus any spaces etc
$cat=strtolower(str_replace(' ','_',$model->category)); 

$CatFolder=\Yii::getAlias('@webroot').strtolower('/category/'.$cat.'/');
$catfile=$CatFolder.'tn.jpg';
//Check if folder exists
if(!file_exists(dirname($CatFolder)))
    {
        mkdir(dirname($CatFolder), 0755, true);
    }
//Check if file exists
    if (!file_exists($catfile')){
    attempt download from model
    if {successful}
         save to $variable 
         Image::thumbnail($pictureFile, 300, 300)->save($CatFolder.'/sm.jpg', ['quality' => 90]);
    else
       {
         return Placehold image
       }

}

*/

        $img="<img class='img-fullwidth ctaimage-image' src='http://placehold.it/400x400?text=$model->Category'>";
        //$img="http://placehold.it/400x400?text=".$model->Category ;
        return $img;
    }

    /*
     * * Frontend ProductCategory Image Generation*/
    public static function setProductCategoryImage($model)
    {
        /*
        // get the image from default location - e.g. motrack or ferridax

/*Product line images*/
        $prodImg = \Yii::getAlias('@webroot').strtolower('/backend/uploads/images/'.$model->Brand.'/').$model->DefaultImage;

        $noapostrophe=  str_replace('\'','',$model->ProductLine);
        $nopuncs = preg_replace("/[^0-9a-zA-Z- ]/", "", $model->ProductLine);
        $productline=  strtolower(str_replace(' ','_',$nopuncs));
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
    //  die(print_r($savefolder.'/'));
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
