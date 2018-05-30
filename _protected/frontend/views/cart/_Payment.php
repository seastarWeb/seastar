<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $model common\models\Payment */
/* @var $form ActiveForm */
$model->billingFirstnames=$order->firstname;
$model->deliveryFirstnames=$order->firstname;
$model->billingSurname=$order->lastname;
$model->deliverySurname=$order->lastname;
$model->billingPhone=$order->phone;
$model->deliveryPhone=$order->phone;
$model->billingCity=$order->city;
$model->deliveryCity=$order->city;
$model->billingAddress1=$order->add1;
$model->deliveryAddress1=$order->add1;
$model->billingAddress2=$order->add2;
$model->deliveryAddress2=$order->add2;
$model->billingPostCode=$order->postcode;
$model->deliveryPostCode=$order->postcode;
$model->billingState=$order->county;
$model->deliveryState=$order->county;
$model->billingCountry=$order->country;
$model->deliveryCountry=$order->country;

// :w
 //var_dump($items);
VarDumper::export($items);
?>

<?php
?>
<div class="Payment">

<?php $form = ActiveForm::begin(); ?>
<div class='col-sm-12 col-lg-4'>
	<?= $form->field($model, 'billingFirstnames') ?>
	<?= $form->field($model, 'billingSurname') ?>
	<?= $form->field($model, 'billingAddress1') ?>
	<?= $form->field($model, 'billingAddress2') ?>
	<?= $form->field($model, 'billingCity') ?>
	<?= $form->field($model, 'billingState') ?>
	<?= $form->field($model, 'billingCountry') ?>
	<?= $form->field($model, 'billingPostCode') ?>
	<?= $form->field($model, 'billingPhone') ?>
</div>	
<div class='col-sm-12 col-lg-4'>
	<?= $form->field($model, 'deliveryFirstnames') ?>
	<?= $form->field($model, 'deliverySurname') ?>
	<?= $form->field($model, 'deliveryAddress1') ?>
	<?= $form->field($model, 'deliveryAddress2') ?>
	<?= $form->field($model, 'deliveryCity') ?>
	<?= $form->field($model, 'deliveryState') ?>
	<?= $form->field($model, 'deliveryCountry') ?>
	<?= $form->field($model, 'deliveryPostCode') ?>
	<?= $form->field($model, 'deliveryPhone') ?>
	<?= $form->field($model, 'customerEmail') ?>
</div>	
	
	
	<?= $form->field($model, 'vendorTxCode') ?>
	<?= $form->field($model, 'amount') ?>
	<?= $form->field($model, 'created') ?>
	<?= $form->field($model, 'modified') ?>
	<?= $form->field($model, 'transactionType') ?>
	<?= $form->field($model, 'capturedAmount') ?>
	<?= $form->field($model, 'surcharge') ?>
	<?= $form->field($model, 'basket') ?>
	<?= $form->field($model, 'basketXml') ?>
	<?= $form->field($model, 'createToken') ?>
	<?= $form->field($model, 'giftAid') ?>
	<?= $form->field($model, 'txAuthNo') ?>
	<?= $form->field($model, 'relatedVendorTxCode') ?>
	<?= $form->field($model, 'token') ?>
	<?= $form->field($model, 'addressResult') ?>
	<?= $form->field($model, 'addressStatus') ?>
	<?= $form->field($model, 'cv2Result') ?>
	<?= $form->field($model, 'payerStatus') ?>
	<?= $form->field($model, 'postCodeResult') ?>
	<?= $form->field($model, 'status') ?>
	<?= $form->field($model, 'bankAuthCode') ?>
	<?= $form->field($model, 'declineCode') ?>
	<?= $form->field($model, 'fraudResponse') ?>
	<?= $form->field($model, 'avsCv2') ?>
	<?= $form->field($model, 'threeDSecureStatus') ?>
	<?= $form->field($model, 'securityKey') ?>
	<?= $form->field($model, 'cardType') ?>
	<?= $form->field($model, 'payerId') ?>
	<?= $form->field($model, 'cavv') ?>
	<?= $form->field($model, 'currency') ?>
	<?= $form->field($model, 'expiryDate') ?>
	<?= $form->field($model, 'last4Digits') ?>
	<?= $form->field($model, 'statusMessage') ?>
	<?= $form->field($model, 'vpsTxId') ?>

<div class="form-group">
<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>

</div><!-- _Payment -->

