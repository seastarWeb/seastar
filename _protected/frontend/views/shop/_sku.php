<?php 
/* Display individual part numbers,nett price and description
 *
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
    ?> 
<div class="item">
	<?=$item->PARTNO?> <?=$item->DESCRIPTION?><div class='pull-right'>£<?=$item->PRICE?></div>
	<?php $form = ActiveForm::begin(['class'=>'form-horizontal','action'=>Url::toRoute(['/shop/add-to-cart','id'=>$item->partid])]); ?>
	<div class='h2'>
		Button to popup model fitment selection.
	</div
	<span class="glyphicon glyphicon-shopping-cart"></span>
	<?=Html::input('submit','submit','Add to cart',[ 'class'=>'btn btn-success btn-sm button add', ])?>
	<?php ActiveForm::end(); ?>
</div>
