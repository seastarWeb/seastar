<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tbl_people".
 *
 * @property integer $people_id
 * @property string $firstname
 * @property string $lastname
 * @property string $dob
 * @property string $email
 * @property string $mobile
 * @property string $phone
 * @property string $add1
 * @property string $add2
 * @property string $city
 * @property string $county
 * @property string $postcode
 * @property string $notes
 *
 * @property Order[] $orders
 */
class People extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_people';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname'], 'required'],
            [['dob'], 'safe'],
            [['firstname', 'lastname'], 'string', 'max' => 50],
            [['email', 'add1', 'add2', 'city', 'county'], 'string', 'max' => 100],
	    ['email','email'],
            [['mobile', 'phone'], 'string', 'max' => 15],
            [['postcode'], 'string', 'max' => 10],
            [['notes'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'people_id' => 'People ID',
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
            'notes' => 'Notes',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['order_customer_id' => 'people_id']);
    }
}
