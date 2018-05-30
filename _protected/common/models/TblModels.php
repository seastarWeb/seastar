<?php

namespace common\models;

use Yii;
use himiklab\thumbnail\EasyThumbnailImage;
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
class TblModels extends \yii\db\ActiveRecord
{
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
            [['model_range_id', 'model_description', 'make', 'model', 'year'], 'required'],
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
    public function getModelRange()
    {
        return $this->hasOne(ModelRange::className(), ['id' => 'model_range_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinance()
    {
        return $this->hasMany(TblFinanceExample::className(), ['model_id' => 'id']);
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
        return $this->hasMany(ProductLines::className(), ['id' => 'plid'])->viaTable('link_model_productline', ['mid' => 'id']);
    }

    public static function getModelImages($id=0,$thumb=0)
    {
    /*

     * */
//	die(var_dump($id));
    $model=TblModels::findModel($id);
    $alt=$model->model;
    if (file_exists('backend/uploads/images/models/'.$id)){
        $files[]=\yii\helpers\FileHelper::findFiles('backend/uploads/images/models/'.$id,['only'=>['*.jpg','*.png'],'recursive'=>FALSE]);
        /* Resize check needs to be implemented here */
    }else
    {
        $files[]=\yii\helpers\FileHelper::findFiles('backend/uploads/images/bikestock/default/',['recursive'=>FALSE]);
    }
    $images=array();
    foreach ($files as $image){
        foreach ($image as $url){
        $t1=$url;
       // $images[]=Yii::$app->urlManager->createAbsoluteUrl([\yii\helpers\FileHelper::normalizePath($t1,'/')],true);
            if (!$thumb){
                $images[]=EasyThumbnailImage::thumbnailImg($t1, 1200,750  ,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => $alt,'class'=>'img-rounded img-responsive']);
            }else{
                $images[]=EasyThumbnailImage::thumbnailImg($t1, 241,150,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => $alt,'class'=>'img-rounded']);    
            }
        }
    }
    return $images;
    }
    private function findModel($id)
    {
        if (($model = TblModels::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
