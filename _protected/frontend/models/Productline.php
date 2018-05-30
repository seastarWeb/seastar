<?php

namespace common\models;

use Yii;
use yii\imagine\Image;
use yii\behaviors\SluggableBehavior;
use himiklab\thumbnail\EasyThumbnailImage;
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
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);
            if(!file_exists($pictureFile)){
            }else{
                Image::thumbnail($pictureFile, 120, 120)->save($savefolder.'/tn.jpg', ['quality' => 90]);
                Image::thumbnail($pictureFile, 300, 300)->save($savefolder.'/sm.jpg', ['quality' => 90]);
            }
        }

        $img=EasyThumbnailImage::thumbnailImg($pictureFile, 250,200,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => $model->ProductLine,'class'=>'img-rounded']);
        return $img;
    }

}
