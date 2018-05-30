<?php

namespace backend\models;

use Yii;

/**
 * * This is the model class for table "tbl_order".
 * *
 * * @property integer $order_id
 * * @property integer $ordertype
 * * @property string $ordertds
 * * @property integer $order_customer_id
 * * @property string $updated_at
 * * @property string $status
 * * @property string $firstname
 * * @property string $lastname
 * * @property string $dob
 * * @property string $email
 * * @property string $mobile
 * * @property string $phone
 * * @property string $add1
 * * @property string $add2
 * * @property string $city
 * * @property string $county
 * * @property string $postcode
 * * @property string $country
 * * @property string $notes
 * * @property string $created_at
 * *
 * * @property People $orderCustomer
 * * @property Orderdetail $order
 * */
class Order extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 'New';
    const STATUS_IN_PROGRESS = 'In progress';
    const STATUS_DONE = 'Done';


    /**
     * * @inheritdoc
     * */
    public static function tableName()
    {
	return 'tbl_order';
    }

    /**
     * * @inheritdoc
     * */
    public function rules()
    {
	return [
	    [['ordertype', 'order_customer_id'], 'integer'],
	    [['ordertds', 'dob'], 'safe'],
	    [['notes'], 'string'],
	    [['updated_at', 'created_at'], 'string', 'max' => 20],
	    [['status'], 'string', 'max' => 25],
	    [['firstname', 'lastname'], 'string', 'max' => 50],
	    [['email', 'add1', 'add2', 'city', 'county', 'country'], 'string', 'max' => 100],
	    [['mobile', 'phone'], 'string', 'max' => 15],
	    [['postcode'], 'string', 'max' => 10]
		];
    }

    /**
     * * @inheritdoc
     * */
    public function attributeLabels()
    {
	return [
	    'order_id' => 'Order ID',
	    'ordertype' => 'Type order e.g. Wishlist or Finance',
	    'ordertds' => 'Ordertds',
	    'order_customer_id' => 'Order Customer ID',
	    'updated_at' => 'Updated At',
	    'status' => 'Status',
	    'firstname' => 'Firstname',
	    'lastname' => 'Lastname',
	    'dob' => 'Dob',
	    'email' => 'Email',
	    'mobile' => 'Mobile',
	    'phone' => 'Phone',
	    'add1' => 'Add1',
	    'add2' => 'Add2',
	    'city' => 'City',
	    'county' => 'County',
	    'postcode' => 'Postcode',
	    'country' => 'Country',
	    'notes' => 'Notes',
	    'created_at' => 'Created At',
	    ];
    }

    /**
     * * @return \yii\db\ActiveQuery
     * */
    public function getOrderCustomer()
    {
	return $this->hasOne(People::className(), ['people_id' => 'order_customer_id']);
    }

    /**
     * * @return \yii\db\ActiveQuery
     * */
    public function getOrderDetail()
    {
	return $this->hasMany(OrderDetail::className(), ['order_id' => 'order_id']);
    }
    public static function getStatuses()
    {
     return [
           self::STATUS_DONE => 'Done',
           self::STATUS_IN_PROGRESS => 'In progress',
           self::STATUS_NEW => 'New',
	        ];
    }
} 
