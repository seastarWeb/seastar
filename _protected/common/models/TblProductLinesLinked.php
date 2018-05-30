<?php

namespace common\models;

use Yii;

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
 * @property string $Url
 * @property string $Slug
 * @property integer $Active
 * @property string $Notes
 * @property string $OrigImageUrl
 *
 * @property LinkModelProductline[] $linkModelProductlines
 * @property Models[] $ms
 */
class TblProductLinesLinked extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
            [['Active'], 'integer'],
            [['Department', 'Brand'], 'string', 'max' => 50],
            [['Category', 'SubCategory'], 'string', 'max' => 100],
            [['ProductLine', 'DefaultImage', 'Colours', 'Sizes', 'Url', 'Slug', 'Notes'], 'string', 'max' => 255],
            [['Fitment'], 'string', 'max' => 30],
            [['PartNumbers', 'OrigImageUrl'], 'string', 'max' => 400]
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
            'DefaultImage' => 'Product Image',
            'Fitment' => 'Fitment/gender',
            'PartNumbers' => 'Associated Part Numbers',
            'Description' => 'Product Description',
            'Colours' => 'Colours',
            'Sizes' => 'Sizes',
            'Url' => 'FormattedUrl',
            'Slug' => 'Slug',
            'Active' => 'Displayed or not',
            'Notes' => 'Product Notes',
            'OrigImageUrl' => 'Original Image Url',
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
}
