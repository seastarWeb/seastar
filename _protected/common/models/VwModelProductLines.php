<?php

namespace common\models;

use Yii;
use himiklab\thumbnail\EasyThumbnailImage;
use common\models\Models;
use common\models\TblProductLines;
/**
 * This is the model class for table "uvw_ModelProductLines".
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
class VwModelProductLines extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'uvw_ModelProductLines';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','mid','plid'], 'integer'],
            [['Department', 'Brand', 'Category', 'SubCategory', 'ProductLine', 'DefaultImage', 'Fitment', 'PartNumbers', 'Description','Colours','Sizes','Url','OrigImageUrl'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mid' => 'ModelID',
            'plid' => 'Product Line ID',
            'Department' => 'Department',
            'Brand' => 'Brand',
            'Category' => 'Category',
            'SubCategory' => 'Sub Category',
            'ProductLine' => 'Product Line',
            'DefaultImage' => 'Default Image',
            'Fitment' => 'Fitment',
            'PartNumbers' => 'Part Numbers',
            'Description' => 'Description',
            'Url' => 'Slug',
            'OrigImageUrl' => 'Original Image Url',
            'Colours' => 'Colours', 
            'Sizes' => 'Sizes',
            'Slug' => 'Slug',
            'Active'=>'Active On Site',
        ];
    }
    
    public function getThumb()
    {
        $img=TblProductLines::getProductLineImage($this);    
        return $img;
    }
    
}