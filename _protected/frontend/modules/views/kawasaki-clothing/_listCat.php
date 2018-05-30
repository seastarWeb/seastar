<?php 
/*
 * View component for displaying motorcycle stock
 * Expects directory of images within lowercase stocknumber e.g. backend/uploads/images/bikestock/a123/
 *
 */
use common\models\TblProductLines;
//use yii\imagine\Image; 
//$image=DucatiClothingCategories::setProductCategoryImage($model);

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\UrlManager;
//use yii\bootstrap\Button;
$image=TblProductLines::getProductLineImage($model);
$url = Url::toRoute(['kawasaki-clothing/browse/'.\yii\helpers\Html::encode($model->Category) ]);
//die(var_dump($url));
?> 

<div class='col-xs-12 col-sm-6 col-md-4 col-lg-3'>
	<div class='KawasakiCatContainer'>
		<div class="itemcategory"><h3 class='label'><?=strtoupper($model->Category) ?></h3></div>
		<a href=<?=$url?>><?=$image?></a>
	</div>
</div>
