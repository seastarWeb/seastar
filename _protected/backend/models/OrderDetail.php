<?php

namespace backend\models;

use Yii;

/**
 * * This is the model class for table "tbl_orderdetail".
 * *
 * * @property integer $orderdetail_id
 * * @property integer $order_id
 * * @property string $partnumber
 * * @property string $vat
 * * @property string $title
 * * @property string $price
 * * @property integer $product_id
 * * @property integer $quantity
 * *
 * * @property Order $order
 * */
class OrderDetail extends \yii\db\ActiveRecord
{
    /**
     * * @inheritdoc
     * */
    public static function tableName()
    {
	return 'tbl_orderdetail';
    }

    /**
     * * @inheritdoc
     * */
    public function rules()
    {
	return [
	    [['order_id', 'product_id', 'quantity'], 'integer'],
	    [['price'], 'number'],
	    [['partnumber'], 'string', 'max' => 20],
	    [['vat'], 'string', 'max' => 2],
	    [['title'], 'string', 'max' => 255]
		];
    }

    /**
     * * @inheritdoc
     * */
    public function attributeLabels()
    {
	return [
	    'orderdetail_id' => 'Orderdetail ID',
	    'order_id' => 'Order ID',
	    'partnumber' => 'Partnumber',
	    'vat' => 'Vat',
	    'title' => 'Title',
	    'price' => 'Price',
	    'product_id' => 'Product ID',
	    'quantity' => 'Quantity',
	    ];
    }

    /**
     * * @return \yii\db\ActiveQuery
     * */
    public function getOrder()
    {
	return $this->hasOne(Order::className(), ['order_id' => 'order_id']);
    }
}
