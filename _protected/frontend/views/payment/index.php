<?php

use yii\helpers\Html;
use frontend\components\Sagepay;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SearchPL */
/* @var $dataProvider yii\data\ActiveDataProvider */

   $sagePay = new SagePay();
      $sagePay->setCurrency('GBP');
      $sagePay->setAmount('100');
      $sagePay->setDescription('Lorem ipsum');
      $sagePay->setBillingSurname('Mustermann');
      $sagePay->setBillingFirstnames('Max');
      $sagePay->setBillingCity('Cologne');
      $sagePay->setBillingPostCode('NR151AX');
      $sagePay->setBillingAddress1('Bahnhofstr. 1');
      $sagePay->setBillingCountry('gb');
      $sagePay->setDeliverySameAsBilling();
      $sagePay->setSuccessURL('http://pon.me.uk/payment/success');
      $sagePay->setFailureURL('http://pon.me.uk/payment/fail');

      var_dump($output);


$this->title = 'Process Payment';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payement-index">
    <h1><?= Html::encode($this->title) ?></h1>

<form method="POST" id="SagePayForm" action="https://test.sagepay.com/gateway/service/vspform-register.vsp">
	<input type="hidden" name="VPSProtocol" value= "3.00">
	<input type="hidden" name="TxType" value= "PAYMENT">
	<input type="hidden" name="Vendor" value= "SEASTAR">
	    <input name="currency" type="hidden" value=GBP />
	<input type="hidden" name="Crypt" value= "<?php echo $sagePay->getCrypt(); ?>">
	<input type="submit" value="continue to SagePay">
</form>
	<form name="pp_form" action="https://test.sagepay.com/gateway/service/vspform-register.vsp" method="post">
	    <input name="VPSProtocol" type="hidden" value=3.00 />
	    <input name="TxType" type="hidden" value=PAYMENT />
	    <input name="Amount" type="hidden" value=100 />
	    <input name="Currency" type="hidden" value=GBP />
	    <input name="Vendor" type="hidden" value="SEASTAR" />
	    <input name="VendorTxCode" type="hidden" value=<?php echo $sagePay->getVendorTxCode();?> />
	    <input name="Crypt" type="hidden" value="<?php echo $sagePay->getCrypt(); ?>" /> 
	    <p>Click here to submit <input type="submit" value="here"> </p>
	</form>
</div>
