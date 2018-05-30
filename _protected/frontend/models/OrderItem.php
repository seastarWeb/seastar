<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tbl_orderdetail".
 *
 * @property integer $orderdetail_id
 * @property integer $order_id
 * @property integer $partnumber
 * @property integer $partquantity
 * @property string $partunitprice
 * @property string $vat
 * @property string $title
 * @property string $price
 * @property integer $product_id
 * @property integer $quantity
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_orderdetail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'partnumber', 'partquantity', 'product_id', 'quantity'], 'integer'],
            [['partunitprice', 'price'], 'number'],
            [['vat'], 'string'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orderdetail_id' => 'Orderdetail ID',
            'order_id' => 'Order ID',
            'partnumber' => 'Partnumber',
            'partquantity' => 'Partquantity',
            'partunitprice' => 'Partunitprice',
            'vat' => 'Vat',
            'title' => 'Title',
            'price' => 'Price',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
        ];
    }
}
