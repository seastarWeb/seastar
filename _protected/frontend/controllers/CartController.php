<?php
namespace frontend\controllers;

use yii\helpers\Url;
use yii;
use common\models\LoginForm;
use frontend\models\People;
use frontend\models\Order;
use frontend\models\OrderItem;
//use common\models\Product;
use frontend\models\DeepBlueProduct;
use yz\shoppingcart\ShoppingCart;
class CartController extends \yii\web\Controller
{
    public function actionAdd($id)
    {
	$product = Product::findOne($id);
	if ($product) {
	    \Yii::$app->cart->put($product);
	    \Yii::$app->session->addFlash('success', 'Added to cart.');

	    return $this->goBack();
	}
    }
    public function actionList()
    {
	/* @var $cart ShoppingCart */
//	die(print_r('Cart List Action'));
	$cart = \Yii::$app->cart;
	$products = $cart->getPositions();
	$total = $cart->getCost();
	return $this->render('list', [
		'products' => $products,
		'total' => $total,
		]);
    }
    public function actionRemove($id)
    {
	$product = DeepBlueProduct::findOne($id);
	if ($product) {
	    \Yii::$app->cart->remove($product);
	    $this->redirect(['cart/list']);
	}
    }
    public function actionUpdate($id, $quantity)
    {
	$product = DeepBlueProduct::findOne($id);
	if ($product) {
	    \Yii::$app->cart->update($product, $quantity);
	    $this->redirect(['cart/list']);
	}
    }

    public function actionPreorder()
    {
    	if (!Yii::$app->user->isGuest) {
    		return $this->redirect('/cart/verify');	
    	}else{
	    return $this->redirect('/cart/order/');
	}
    }

    public function actionOrder()
    {
	$order = new Order();
	//$customer = new People();
	/* @var $cart ShoppingCart */
	$cart = \Yii::$app->cart;
	/* @var $products Product[] */
	$products = $cart->getPositions();
//	$cart->attachBehaviour('postDiscount',['class'=>'frontend\components\PostDiscount']);
	$total = $cart->getCost(true);

	if ($total==0){
		\Yii::$app->session->addFlash('error', 'There was a problem processing that order(empty cart). Please try again, or give us a ring on 01508 471919.');
		    return $this->redirect(Url::previous());
	}
    //	die(var_dump($order->validate));
	if ($order->load(\Yii::$app->request->post()) && $order->validate()) {
//	if ($order->load(\Yii::$app->request->post()) ) {
//	die(var_dump(\Yii::$app->request->post('submit')));
	    $selected=\Yii::$app->request->post('submit');
	    switch($selected){
		case 'Pay':
		    $order->ordertype=1;
		    break;
		case 'Finance':
		    $order->ordertype=2;
		    break;
	        case 'Wishlist':
		    $order->ordertype=3;
		    break;
		default:
		    $order->ordertype=4;

		}
	    $transaction = $order->getDb()->beginTransaction();
/*
	   if (!Yii::$app->user->isGuest) {
	// get the id  and email address of the person who is logged in.
			$loggedin_id=Yii::$app->user->identity->id;
			$loggedin_email=Yii::$app->user->identity->email;
			$customer = new People();
	//		$customer= People::find()->where('user_id > :userid', [':userid   ' => $loggedin_id])->one();
	 //   die(var_dump('Die; Mo fo'));
			//$customer = People::find($personid);
		// if the id isn't found then create a new one.
			if(!$customer||$loggedin_email<>$order->email) {
			//	If there is no record of the logged in user or if the email address of the user has changed then create a new User
				$customer = new People();
				$customer->firstname=$order->firstname;
				$customer->lastname=$order->lastname;
				$customer->email=$order->email;
				$customer->phone=$order->phone;
				$customer->user_id=Yii::$app->user->identity->id;
				$customer->postcode=$order->postcode;
				$customer->mobile=$order->mobile;
				$customer->save(false);
				$order->order_customer_id=$customer->people_id;
			}else{
				$customer->firstname=$order->firstname;
				$customer->lastname=$order->lastname;
				$customer->postcode=$order->postcode;
				$customer->phone=$order->phone;
				$customer->mobile=$order->mobile;
				$customer->postcode=$order->postcode;
				$customer->save(false);
		    	$order->order_customer_id=Yii::$app->user->identity->id;
			}
				
			die(var_dump($customer));

		}
	   */
            // set the orderer to the logged in user.
	    $order->order_customer_id=Yii::$app->user->identity->id;
	    $order->save(false);
	    $ord = $order->order_id;
	    // Add carraige charge unless the order total is > fifty Quid - needs parameterizing
	    if ($total>50)
	    {
		    $orderItem = new OrderItem();
		    $orderItem->order_id = $order->order_id;
		    $orderItem->title = 'Carraige FOC';
		    $orderItem->price = '0.00';
		    $orderItem->vat = 'S';
		    $orderItem->quantity = 1;
		    $orderItem->partnumber = 'CARRAIGE';
		if (!$orderItem->save(false)) {
		    $transaction->rollBack();
		    \Yii::$app->session->addFlash('error', 'Cannot place your order. Please contact us.');
		    return $this->redirect(Url::previous());
		}
	//	$cart->on(ShoppingCart::EVENT_COST_CALCULATION, function ($event) { $event->discountValue = 7.50; });
		}else{
		    $orderItem = new OrderItem();
		    $orderItem->order_id = $order->order_id;
		    $orderItem->title = 'Carraige';
		    $orderItem->price = '7.50';
		    $orderItem->vat = 'S';
		    $orderItem->quantity = 1;
		    $orderItem->partnumber = 'CARRAIGE';
		if (!$orderItem->save(false)) {
		    $transaction->rollBack();
		    \Yii::$app->session->addFlash('error', 'Cannot place your order. Please contact us.');
		    return $this->redirect(Url::previous());
		}
	    }


	    foreach($products as $product) {
			$orderItem = new OrderItem();
			$orderItem->order_id = $order->order_id;
			$orderItem->title = $product->description;
			$orderItem->price = $product->getPrice();
			$orderItem->product_id = $product->id;
			$orderItem->vat = $product->vat;
			$orderItem->partnumber = $product->partno;
			$orderItem->quantity = $product->getQuantity();
			if (!$orderItem->save(false)) {
			    $transaction->rollBack();
			    \Yii::$app->session->addFlash('error', 'Cannot place your order. Please contact us.');
			    return $this->redirect(Url::previous());
			}
	    }
	    $transaction->commit();
	    \Yii::$app->cart->removeAll();
	    \Yii::$app->session->addFlash('success', 'Thanks - we are processing your request. Please wait!');
	    $order->sendEmail();
	  //  return $this->redirect(Url::previous());
	    $finance=true;
	    if ($selected=='Pay'){
			return $this->redirect('/payment/process/?id='.$ord);
	    }elseif($selected=='Finance'){
		$order->status='In Progress';
	    	$order->save(false);
	    	return $this->redirect('/payment/paylater/?id='.$ord);	
	    }else{
		$order->status='In Progress';
	    	$order->save(false);
	    \Yii::$app->session->addFlash('success', 'Thanks for creating a wish list. We\'ll process it and contact you shortly.');
			    return $this->redirect(Url::previous());
	    }
	    
	}
	return $this->render('order', [
		'order' => $order,
		//'customer' => $customer,
		'products' => $products,
		'total' => $total,
		]);
    }
    public function actionVerify(){
    	// get setting value for 'Login With Email'
        $lwe = Yii::$app->params['lwe'];

        // if 'lwe' value is 'true' we instantiate LoginForm in 'lwe' scenario
        $model = $lwe ? new LoginForm(['scenario' => 'lwe']) : new LoginForm();

        // now we can try to log in the user
        if ($model->load(Yii::$app->request->post()) && $model->login()) 
        {
            return $this->goBack();
        }
        // user couldn't be logged in, because he has not activated his account
        elseif($model->notActivated())
        {
            // if his account is not activated, he will have to activate it first
            Yii::$app->session->setFlash('error', 
                'You have to activate your account first. Please check your email.');
            return $this->refresh();
        }    
        // account is activated, but some other errors have happened
        else
        {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
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


   public function actionPayment($id=null)
   {
       if (!$id){
	   return $this->redirect(Url::previous());
       }else{
	       $order=Order::findOne($id);
	       \Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
	       $items=OrderItem::findAll(['order_id'=>$id]);
	       \Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;

	   $model = new \common\models\CreditCard;
//	   $model->attributes = \Yii::$app->request->post('ContactForm');
//
	   return $this->render('_Payment', [
		'order' => $order,
		'model'=>$model,
		'items'=>$items,
		]);
       }
   }


public function actionPostcode1()
    {
	//Output to Order Model.
	######################################################
	#Get Full Address and write back to main page
	#See JavaScript at bottom of page to change mapping
	######################################################
	$simplyserver = "http://www.simplylookupadmin.co.uk/xmlservice";
	$datakey = "W_1BB6E59623994C71954FAAFAC2EB44";
$r = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
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
	 //    $simplyserver."/InlineComboSearch3.aspx?datakey=".$datakey."&postcode=".$postcode."&username=".$usernameID."&user=".urlencode($_SERVER['HTTP_USER_AGENT'])."&ip=".$_SERVER['REMOTE_HOST'];
$simplyserver."/InlineComboSearch3.aspx?datakey=".$datakey."&postcode=".$postcode."&username=".$usernameID."&user=".urlencode($_SERVER['HTTP_USER_AGENT'])."&ip=".$r;
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


 public function actionPostcode2(){
	// Return specific address from list
	// Order::PostCode2
	$simplyserver = "http://www.simplylookupadmin.co.uk/xmlservice";
	$datakey = "W_1BB6E59623994C71954FAAFAC2EB44";
	$usernameID='';
	################################################
	#So Get Data from SPL Web server:

	header('Expires: Wed, 23 Dec 1980 00:30:00 GMT');
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
	header('Cache-Control: no-cache, must-revalidate');
	header('Pragma: no-cache');
	header('Content-Type: text/xml');

	$AddressID = $_GET['AddressID'];
	$XMLService = $simplyserver . "/GetAddressRecord.aspx?datakey=" . $datakey . "&id=" . $AddressID . "&username=" .
	    $usernameID."&AppID=36";

	#get XML
	@$XMLtoSend = file_get_contents($XMLService);

	if (strpos($XMLtoSend,"<line1>"))
	{
	    	#return XML
	    	echo $XMLtoSend;
	}
	else
	{
	    	#Noting to return, so return XML to stop error on client
	    	echo "<data>asda</data>";
	}

}

	    

}
