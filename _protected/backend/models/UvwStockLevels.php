<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "uvw_StockLevels".
 *
 * @property string $InStock
 * @property string $StockValue
 * @property integer $TotalPartNumbers
 * @property string $Department
 * @property string $Brand
 * @property string $Category
 * @property string $ProductLine
 */
class UvwStockLevels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'uvw_StockLevels';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['InStock', 'StockValue'], 'number'],
            [['TotalPartNumbers'], 'integer'],
            [['Department', 'Brand'], 'string', 'max' => 50],
            [['Category'], 'string', 'max' => 100],
            [['ProductLine'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'InStock' => 'In Stock',
            'StockValue' => 'Stock Value',
            'TotalPartNumbers' => 'Total Part Numbers',
            'Department' => 'Department',
            'Brand' => 'Brand',
            'Category' => 'Category',
            'ProductLine' => 'Product Line',
        ];
    }

    /**
     * @inheritdoc
     * @return UvwStockLevelsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UvwStockLevelsQuery(get_called_class());
    }
}
