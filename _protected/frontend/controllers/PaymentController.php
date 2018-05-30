<?php
namespace frontend\controllers;
use yii\helpers\Url;
use yii;
use frontend\models\People;
use frontend\models\Order;
use frontend\models\OrderItem;
use common\models\FinanceLog;
use dwmsw\sagepay\Direct;
use dwmsw\sagepay\Basket;
use dwmsw\sagepay\Address;
use dwmsw\sagepay\Card;
use dwmsw\sagepay\Item;
use frontend\components\Sagepay;
use linslin\yii2\curl;





class PaymentController extends \yii\web\Controller
{
    public function actionProcess($id=null)
    {
/* Process Payment accepting orderid as argument.
 * Verify Order is "new" status and contains items
 * Begin Transaction
 * Accept Card Details and process the payment.
 * If successful, udate order status to paid and send emails
 * Commit or Rollback the Transaction
 *
 */
      if (!$id){
	 		return $this->redirect(Url::previous());
		}else{
	  		$order=Order::findOne($id);
			if ($order->status==='New'){
       			$items=OrderItem::findAll(['order_id'=>$id]);
			}else{
				\Yii::$app->session->addFlash('error', 'This order has already been processed.');
				return $this->render('index', [ 'model' => $customer, ]);
			}
		}
/*
      
      $sagePay = new SagePay();
      $sagePay->setCurrency('EUR');
      $sagePay->setAmount('100');
      $sagePay->setDescription('Lorem ipsum');
      $sagePay->setBillingSurname('Mustermann');
      $sagePay->setBillingFirstnames('Max');
      $sagePay->setBillingCity('Cologne');
      $sagePay->setBillingPostCode('50650');
      $sagePay->setBillingAddress1('Bahnhofstr. 1');
      $sagePay->setBillingCountry('de');
      $sagePay->setDeliverySameAsBilling();
      $sagePay->setSuccessURL('https://pon.me.uk/success.php');
      $sagePay->setFailureURL('https://pon.me.uk/fail.php');
      //$trnx=new Sagepay;
          */
	    $sagepay = new Direct();

	    $basket = new Basket();
	    foreach($items as $item)
	    {
		    $basket->addItem(new Item($item->title, $item->price, 6, 1));
	    }
	    $sagepay->setBasket($basket);

	    $sagepay->setConnectionMode('TEST');
	    $sagepay->setVendorName('SEASTAR');
	    $sagepay->setCurrency('GBP');
	    $sagepay->setApplyAvsCv2(1);
	    $sagepay->setApply3dSecure(0);
	    $sagepay->setGiftAid(0);

	    $vendorTxCode = md5(rand(1, 1000));


	    $sagepay->setVendorTxCode($vendorTxCode);
	    $sagepay->setDescription('Seastar Payment');
	    $sagepay->setCustomerEmail($order->email);


	    $BillingAddress = new Address();
	    $BillingAddress->setName($order->firstname, $order->lastname);
	    $BillingAddress->setPhone($order->mobile);
	    $BillingAddress->setAddress($order->add1,$order->add2, $order->city, 'GB', $order->postcode);


	    $sagepay->setBillingAddress($BillingAddress);
	    $sagepay->setDeliveryAddress($BillingAddress);


	    $card = new Card();

	    $card->setCardHolder('Mr C Mewton');
	    $card->setCardType('VISA');
	    $card->setCardNumber('4929000000006');
	    $card->setStartDate(false);
	    $card->setExpiryDate('1216');
	    $card->setCV2('123');

	    $sagepay->setCard($card);

	    $output = $sagepay->register('PAYMENT');
	
		$customer = new People();
		return $this->render('index', [ 'order' => $order,'items'=>$items,'output'=>$output,'sagepay'=>$sagepay ]);
    }


    public function actionSuccess()
    {
	$customer = new People();
	return $this->render('index', [ 'model' => $customer, ]);
    }


    public function actionFail()
    {
	$customer = new People();
	return $this->render('index', [ 'model' => $customer, ]);
    }


    public function actionCustomer()
    {
	$customer = new People();
	if ($customer->load(Yii::$app->request->post()) && $customer->save()) {
	 //   return $this->redirect(['order', 'custid' => $customer->id]);
	    return $this->render('customer', [ 'model' => $customer, ]);
	} else {
	    return $this->renderAjax('order', [ 'model' => $customer, ]);
	}
    }

/*
Function to calculate VAT at payment end.
All order detail prices are recorded net of VAT
*/
    private function getVatRate($vatcode){
// set new effective date here
    	$VATChangeDate='2015-11-01';

		$time = new \DateTime('now');
		$today = $time->format('Y-m-d');
		$vatRate=1;

		if ($today>=$VATChangeDate&&$vatcode=='S'){
//Set new VAT rate value here
			$vatRate=1.2;	
		}elseif($vatcode=='S'){
//Default VAT rate set at 20% 02/11/2015
			$vatRate=1.2;	
		}
    	return $vatRate;
    }

    public function actionPaylater($id=null)
    {

      	if (!$id){
	 		return $this->redirect(Url::previous());
		}else{
	  		$order=Order::findOne($id);
			if ($order->status==='New'){
       			$items=OrderItem::findAll(['order_id'=>$id]);
			}else{
				\Yii::$app->session->addFlash('error', 'This order has already been processed.');
			return $this->render('index', [ 'model' => $customer, ]);
			}
		}

		$cost = 0;
        foreach ($items as $position) {
        	// work out price including VAT
        	$priceinc=$this->getVatRate($position->vat)*$position->price;
            $cost += $priceinc * $position->quantity;//:w
            //getCost($withDiscount);
        }
    // turn to pennies for Pay4Later    
        $pennyvalue=intval($cost*100);

    //   Calculate Minimum deposit here    
        $depositvalue=intval(ceil ($pennyvalue/10));
    
		$curlSession = curl_init();
		$interface = 'https://test.pay4later.com:3343/';

// log request here. orderid, time stamp, url , requester IP and geolocation inserted into Finance Log.
$flog = new FinanceLog();
$flog->url = $interface;
$flog->tds=Yii::$app->formatter->asDatetime('now');
$flog->orderid=$id;
$flog->requester_ip=Yii::$app->request->getUserIP();
$flog->amount=$cost;
$flog->save();


		$postFields = Array(
		    "action" => "credit_application_link",
		    "Identification[api_key]" => "4f95e7ab152eb1132820e07788da49b2",
		    "Identification[InstallationID]" => "8067",
		    "Identification[RetailerUniqueRef]" => md5(rand(1, 1000)),
		    "Goods[Description]" => "Goods",
		    "Goods[Price]" => $pennyvalue,
		    "Finance[Code]" => "ONIB24-4.9",
		    "Finance[Deposit]" => $depositvalue,
		  //  "Consumer[Title]"	=>"Mr",		//STRING	No	The title of the customer
			"Consumer[Forename]"=>$order->firstname,		//STRING	No	The forename of the customer
			"Consumer[Surname]"	=>$order->lastname,		//STRING	No	The surname of the customer
			"Consumer[EmailAddress]"=>$order->email,
			"Consumer[Postcode]"=>$order->postcode,
			"Consumer[PersonalPhoneNumber]"=>$order->mobile
		);
	    curl_setopt($curlSession, CURLOPT_URL, $interface);
	    curl_setopt($curlSession, CURLOPT_HEADER, 0);
	    curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, 0);
	    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curlSession, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($curlSession, CURLOPT_POST, 1);
	    curl_setopt($curlSession, CURLOPT_POSTFIELDS, $postFields);
    	$curl_response = curl_exec($curlSession);
//Log the response
$flog = new FinanceLog();
$flog->url = $curl_response;
$flog->tds=Yii::$app->formatter->asDatetime('now');
$flog->orderid=$id;
$flog->requester_ip=Yii::$app->request->getUserIP();
$flog->amount=$cost;
$flog->save();

	return $this->redirect( $curl_response);
	
    }

	    

}
