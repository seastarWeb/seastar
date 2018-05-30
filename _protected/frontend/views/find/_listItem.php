<?php 
/*
 * View component for displaying motorcycle stock
 * Expects directory of images within lowercase stocknumber e.g. backend/uploads/images/bikestock/a123/
 *
 */

use common\models\TblProductLines;
use yii\imagine\Image; 
use yii\helpers\Html; 
use yii\helpers\Url; 
use yii\web\UrlManager;

$image=TblProductLines::getProductLineImage($model);
?> 
<div class='col-xs-12 col-sm-6 col-md-3'>
	<div class='FindItemContainer'>
		<a href='/shop/for/<?=strtolower($model->Brand)?>/<?= $model->Url ?>'>
			<?=$image?>
		<div class="itemcaption"><?=$model->ProductLine ?></div>
	</div>
</div>