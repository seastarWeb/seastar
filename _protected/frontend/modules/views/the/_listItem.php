<?php 
/*
 * View component for displaying Ducati Clothing Items
 * Expects directory of images within lowercase stocknumber e.g. backend/uploads/images/bikestock/a123/
 *
 */
use common\models\TblProductLines;
use yii\helpers\Html; 
use yii\helpers\Url; 
use yii\web\UrlManager;
$image=TblProductLines::getProductLineImage($model);
$make = Yii::$app->controller->module->id;
$slug = Yii::$app->getRequest()->getQueryParam('slug');

$url = Url::toRoute(['/'.$make.'/accessorize/my/'.$slug]);

?> 
<div class='col-xs-12 col-sm-6 col-md-3'>
	<div class='SeastarItemContainer'>
			<?=$model->Category?>
			<?= Html::a($image,$url) ?>
	</div>
</div>