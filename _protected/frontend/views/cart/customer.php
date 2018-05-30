<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\label\LabelInPlace;
/* @var $this yii\web\View */
/* @var $model frontend\models\People */
/* @var $form ActiveForm */
?>
<div class="customer">
      <div class="form-group">
<?php $form = ActiveForm::begin(
	    [
	        'id' => 'contact-form',
		    'enableAjaxValidation' => true,
		    ]
	    ); ?>
        <div class='col-sm-12 col-md-6 col-lg-4'>
	    <div class="panel panel-default">
	    <div class="panel-heading">Personal Details</div>
	    <?= $form->field($model, 'firstname')->textInput(['maxlength' => 20])->label('First name') ?>
	    <?= $form->field($model, 'lastname',['template' => ' {label} <span class="glyphicon glyphicon-user pull-right"></span> {input}  {error}{hint} '])->hint('Please enter your name')->label('Last name')?>
	    <?= $form->field($model, 'email',['template' => ' {label} <span class="glyphicon glyphicon-envelope pull-right"></span> {input}  {error}{hint} '])->input('email')->hint('We will send invoice details to this address') ?>
	    <?= $form->field($model, 'mobile',['template' => ' {label} <span class="glyphicon glyphicon-phone-alt pull-right"></span> {input}  {error}{hint} ']) ?>
	    </div>
	</div>
        <div class='col-sm-12 col-md-6 col-lg-4'>
	    <div class="panel panel-default">
	    <div class="panel-heading">Address Details</div>
	    <?= $form->field($model, 'postcode',['template' => ' {label} <span class="glyphicon glyphicon-envelope pull-right"></span> {input}  {error}{hint} '])->textInput(['maxlength'=>10])->hint('Please press lookup to enter your address details')->label('Post Code') ?>
	    <?= Html::submitButton('Lookup Address', ['class' => 'btn btn-primary','onclick' => "(function ( $event ) {SPLGetAddressData(document.getElementById('people-postcode').value,1); })();"]) ?>
	    <br>
	    <br>
	    <div id="SPLSearchArea"></div>
	    <?= $form->field($model, 'notes',['template' => '<span class="glyphicon glyphicon-tag pull-right"></span>
		    {input}  {error}{hint} '])->textArea(['rows' => '8','readonly' => true,])  ?>
	    <?=Html::activeHiddenInput($model,'add1')?>
	    <?=Html::activeHiddenInput($model,'add2')?>
	    <?=Html::activeHiddenInput($model,'city')?>
	    <?=Html::activeHiddenInput($model,'county')?>
	    <?=Html::activeHiddenInput($model,'country')?>
	    </div>
             <?= Html::submitButton('Continue to Checkout', ['class' => 'btn btn-success pull-right']) ?>
        </div>
<?php ActiveForm::end(); ?>
    </div>
</div>
   <?php
     // $this->registerJsFile('http://www.simplylookupadmin.co.uk/XMLService/RegisterWithServer.aspx');
      $this->registerJsFile('/backend/js/SPL_AJAX_Full.js');
      $this->registerCss(
	      ".SPLAddressListSt{
	      font-size: 14px;
	      margin-top: 0;
	      margin-bottom: 0;
	      width: 95%;}
/* Line under the list box when address found */
.SPLAddressListStBottomLine{
font-family: Arial, Helvetica, sans-serif;
font-size: 12px;
text-align: center;
margin-top: 0;
margin-bottom: 0;
}
/* Line if nothing is found */
.SPLAddressListStErrorLine{
font-family: Arial, Helvetica, sans-serif;
font-size: 14px;
text-align: center;
margin-top: 0;
margin-bottom: 0;
}
/* License information line */
.SPLAddressListLicenseLine{
    font-family: Arial, Helvetica, sans-serif;
    font-size: 10px;
    text-align: center
	margin-top: 0;
    margin-bottom: 0;
}
.panel-default {
      border-color: red;
      padding: 10px;
}
");
	?>

