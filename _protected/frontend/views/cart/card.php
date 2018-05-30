<?php
use Omnipay\Omnipay;

use yii\helpers\Html;

$gateway = Omnipay::create('SagePay_Server');
$settings = $gateway->getDefaultParameters();
var_dump($settings);



$formData = ['number' => '4242424242424242', 'expiryMonth' => '6', 'expiryYear' => '2016', 'cvv' => '123'];
// $response = $gateway->purchase(['amount' => '10.00', 'currency' => 'USD', 'card' => $formData])->send();

$response = $gateway->purchase([
	    'amount' => '10.00', // this represents $10.00
	        'card' => $formData,
		    'returnUrl' => 'http://www.pciot.com/',
		    ]);
var_dump($response);
/*
$gateway->setUsername('percy');
$gateway->setPassword('12345');
*/

/* @var $this yii\web\View */
/* @var $model frontend\models\People */
/* @var $form ActiveForm */
?>
<div class="customer">


</div>
   <?php
     // $this->registerJsFile('http://www.simplylookupadmin.co.uk/XMLService/RegisterWithServer.aspx');
	?>

