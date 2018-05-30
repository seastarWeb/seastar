<?php

namespace common\models;

use Yii;
use himiklab\thumbnail\EasyThumbnailImage;
use common\models\Models;
/**
 * This is the model class for table "vw_ducati_models_parts".
 *
 * @property integer $model_range_id
 * @property integer $model_id
 * @property string $partno
 * @property string $category
 * @property string $subcat
 * @property string $fitment
 * @property string $description
 * @property string $price
 * @property integer $stock_level
 * @property string $VAT
 */
class VwModelRangeModels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'uvw_ModelRangeModels';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['make', 'model', 'model_range', 'year', 'alias'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'make'=>'Manufacturer',
            'model_range' => 'Model Range',
            'model' => 'Model',
            'year' => 'Year',
            'slug' => 'Slug',
        ];
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
       $image=EasyThumbnailImage::thumbnailImg($img_to_process, 260,200,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => $this->model,'class'=>'img-rounded'] );
       return \yii\helpers\Html::a($image, '/'.Yii::$app->controller->module->id.'/accessorize/my/'.$this->alias);
    }


    public function getAccessories($slug){
        $fred=Models::findModelByAlias($slug);
        Return $fred;
    }


}