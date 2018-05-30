<?php

namespace frontend\models;

use Yii;

use yii\db\ActiveRecord;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;


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
class DeepBlueProduct extends \yii\db\ActiveRecord implements CartPositionInterface
{
    use CartPositionTrait;
    public function getPrice()
   {
       return $this->price;
     }

    public function getId()
    {
        return $this->partid;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_DeepBlue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'partid'], 'required'],
            [[ 'stock_level'], 'integer'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['partno', ], 'string', 'max' => 50],
            [['VAT'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'partno' => 'Partno',
            'partid' => 'Part ID',
            'description' => 'Description',
            'price' => 'Price',
            'stock_level' => 'Stock Level',
            'VAT' => 'Vat',
        ];
    }
    public static function primaryKey()
    {
        return ['partid'];
    }
}
