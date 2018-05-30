<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\People */
/* @var $form ActiveForm */
?>
<div class="customer">
    <div class="panel panel-default">
	    <div class="row">
			<div class='col-sm-8'>
			<?php //= $form->field($model, 'postcode',['template' => ' {label} <span class="glyphicon glyphicon-search pull-right"></span> {input}  {error}{hint} '])->textInput(['maxlength'=>10])->label('Post Code') ?>
			</div>
			<div class='col-sm-2'>
			<br>
			     <a href= "javascript:SPLGetAddressData(document.getElementById('order-postcode').value)"><span class='pull-right'><?= Html::img('/search-postcodes.png')?></span></a>
			</div>
	    </div>
	    <div class="row">
			<div class='col-sm-12'>
	    		<div id="SPLSearchArea"></div>
	    	</div>
         </div>
	    <br>
	    <?= $form->field($model, 'notes',['template' => '<span class="glyphicon glyphicon-tag pull-right"></span> {input}  {error}{hint} '])->textArea(['rows' => '8','readonly' => true,])  ?>
	    <?=Html::activeHiddenInput($model,'add1')?>
	    <?=Html::activeHiddenInput($model,'add2')?>
	    <?=Html::activeHiddenInput($model,'city')?>
	    <?=Html::activeHiddenInput($model,'county')?>
	    <?=Html::activeHiddenInput($model,'country')?>
    </div>
</div>

   <?php

     // styling for the PostCode Lookup routine 
      $this->registerJsFile('/js/SPL_AJAX_Full.js');
    //  die(var_dump('alksdjlaskjdlkasjd'));
      $this->registerCss(
	      ".SPLAddressListSt{
	      font-size: 14px;
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
