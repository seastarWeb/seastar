<?php 
/*
 * View component for displaying motorcycle stock
 * DucatiClothingCategories for function of images needs to be replaced with ProductLine specific one
 *
 */

use common\models\TblProductLines;
use yii\imagine\Image; 
use yii\helpers\Html; 
use yii\helpers\Url; 
use yii\web\UrlManager;
use yii\jui\Accordion;

$image=TblProductLines::getProductLineImage($model);

    ?> 
<div class='col-xs-12 col-sm-6 col-md-3'>
	<div class='AccessorizeItemContainer'>
		<div class="itemcategory"><?=strtoupper($model->Category) ?></div>
		<a href='/shop/for/<?=strtolower($model->Brand)?>/<?= $model->Url ?>'>
			<?=$image?>
		<div class="itemcaption"><?=$model->ProductLine ?></div>
	</div>
</div>
