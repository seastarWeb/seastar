<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\People */
/* @var $form ActiveForm */
?>

<div class="panel panel-default">

	<div class="form-group">
		<div class="col-sm-3">
	    <?= $form->field($model, 'firstname',['showLabels'=>false])->textInput(['placeholder'=>'First Name']); ?>
		</div>
	    <div class="col-sm-3">
	    <?= $form->field($model, 'lastname',['showLabels'=>false])->textInput(['placeholder'=>'Last Name']); ?>
		</div>
		<div class="col-sm-6">
	    <?= $form->field($model, 'email',['showLabels'=>false])->textInput(['placeholder'=>'email@whatever.com']); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-4">
			<?= $form->field($model, 'phone',['showLabels'=>false])->textInput(['placeholder'=>'Telephone']); ?>
    		</div>
		<div class="col-sm-4">
			<?= $form->field($model, 'mobile',['showLabels'=>false])->textInput(['placeholder'=>'Mobile Telephone']); ?>
    		</div>
    		<div class="col-sm-4">
    	 	        <?= $form->field($model, 'postcode',['showLabels'=>false])->textInput(['maxlength'=>10, 'placeholder'=>'Post Code']) ?>
			     <a href= "javascript:SPLGetAddressData(document.getElementById('order-postcode').value)"><span class='pull-right'><?= Html::Button('Lookup Postcode','btn btn-sm')?></span></a>
	       </div>	
	</div>
	    		<div id="SPLSearchArea"></div>
</div>
	   <?= $form->field($model,'add1',['showLabels'=>false])->textInput(['maxlength'=>10,'placeholder'=>'First line of address']);?>
	   <?=Html::activeHiddenInput($model,'add2')?>
	   <?=Html::activeHiddenInput($model,'city')?>
	   <?=Html::activeHiddenInput($model,'county')?>
	   <?=Html::activeHiddenInput($model,'country')?>
<?php
     // styling for the PostCode Lookup routine 
      $this->registerJsFile('/js/SPL_AJAX_Full.js');
    //  die(var_dump('alksdjlaskjdlkasjd'));
      $this->registerCss(
	      ".SPLAddressListSt{
	      font-size: 14px;
	      color:black;	
	      margin-top: 0;
	      margin-bottom: 0;
	      width: 85%;}
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
	    } ");
