<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tbl_order".
 *
 * @property integer $order_id
 * @property string $orderdate
 * @property integer $orderstatus
 * @property string $ordertds
 * @property integer $order_customer_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $phone
 * @property string $address
 * @property string $email
 * @property string $notes
 * @property string $status
 * @property string $postcode
 * @property string $country
 *
 * @property People $orderCustomer
 */
class Order extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 'New';
    const STATUS_IN_PROGRESS = 'In progress';
    const STATUS_DONE = 'Done';
    public function behaviors()
    {
        return [
                TimestampBehavior::className(),
            ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname','lastname','postcode','email','phone'], 'required'],
            [['ordertds', 'created_at', 'updated_at'], 'safe'],
            [['ordertype', 'order_customer_id'], 'integer'],
            [['notes'], 'string'],
            [['phone', ], 'string', 'max' => 255],
            ['email', 'email'],
            [['add1', 'add2', 'city','county','country'], 'string', 'max' => 100],
            [['firstname', 'lastname' ], 'string', 'min' => 2],
            [['status','mobile' ], 'string', 'max' => 25],
            [['postcode'], 'string', 'max' => 10] 
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
    return [
        'order_id' => 'Order ID',
        'orderstatus' => 'Orderstatus',
        'ordertds' => 'Ordertds',
        'order_customer_id' => 'Order Customer ID',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'phone' => 'Phone',
        'email' => 'Email',
        'notes' => 'Notes',
        'status' => 'Status',
        'postcode' => 'Post Code',
	    'firstname' => 'Firstname',
	    'lastname' => 'Lastname',
	    'dob' => 'Dob',
	    'mobile' => 'Mobile',
	    'phone' => 'Phone',
	    'add1' => 'Address Line1',
	    'add2' => 'Address Line2',
	    'city' => 'City',
	    'county' => 'County',
	    'country' => 'Country',
    ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderCustomer()
    {
        return $this->hasOne(People::className(), ['people_id' => 'order_customer_id']);
    }
/**
 * * @return \yii\db\ActiveQuery
 * */
public function getOrderItems()
{
    return $this->hasMany(OrderItem::className(), ['order_id' => 'order_id']);
}
/**
 * * @return \yii\db\ActiveQuery
 * */
public function getBasketItems()
{
     \Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
     $basket=$this->hasMany(OrderItem::className(), ['order_id' => 'order_id']);
    return $basket;
}

public function beforeSave($insert)
{
    if (parent::beforeSave($insert)) {
	if ($this->isNewRecord) {
	    $this->status = self::STATUS_NEW;
	}
	return true;
    } else {
	return false;
    }
}
public static function getStatuses()
{
    return [
	self::STATUS_DONE => 'Done',
	self::STATUS_IN_PROGRESS => 'In progress',
	self::STATUS_NEW => 'New',
	];
}
public function sendEmail()
{
   // die(var_dump(Yii::$app->params['adminEmail']));
    return Yii::$app->mailer->compose('order', ['order' => $this])
	->setTo(Yii::$app->params['adminEmail'])
	->setFrom(Yii::$app->params['adminEmail'])
	->setSubject('Seastar Superbikes order #' . $this->order_id)
	->send();
}

public function getPostCode(){


	######################################################
	#Get Full Address and write back to main page
	#See JavaScript at bottom of page to change mapping
	######################################################
	$simplyserver = "http://www.simplylookupadmin.co.uk/xmlservice";
	$datakey = "W_E00CBD5783F44C44BC63B38C835F6D";


##################################################################
# see http://www.simply-postcode-lookup.com/full_address_inline_ajax_section_list.htm
# # for explanation for code
# ##################################################################
#
 $usernameID = "";
 $postcode = "";
 $XMLData = "";
 $data ="";
 $usernameID ="";



 ################################################
 #So Get Data from SPL Web server:

 header('Expires: Wed, 23 Dec 1980 00:30:00 GMT');
 header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
 header('Cache-Control: no-cache, must-revalidate');
 header('Pragma: no-cache');
 header('Content-Type: text/xml');

 $postcode = $_GET['postcode'];
 $postcode = str_replace(" ", "", $postcode);

 $XMLService =
     $simplyserver."/InlineComboSearch3.aspx?datakey=".$datakey."&postcode=".$postcode."&username=".$usernameID."&user=".urlencode($_SERVER['HTTP_USER_AGENT'])."&ip=".$_SERVER['REMOTE_HOST'];

 #Set Message when on Mobile
 $XMLService = $XMLService."&textmob=Please%20Select%20Address";

 #Set to 1 to show License status
 $XMLService = $XMLService."&showlic=0";

 #Set Number of lines in list
 #Set to 0 to display Combo box
 $XMLService = $XMLService."&lines=6";
 #Dropdown list
 #$XMLService += "&lines=0";

 #Future use
 $XMLService = $XMLService."&style=1";

 #Message at bottom of combo
 #Set to nothing to remove
 $XMLService = $XMLService."&text=Please%20Select%20Address";

 #get XML
 $DataToSend = file_get_contents($XMLService);
 Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
 Yii::$app->response->statusCode = 200;
         $headers = Yii::$app->response->headers;
	         $headers->add('Content-Type', 'text/xml');
 #return XML
		 return $DataToSend;
}
}
