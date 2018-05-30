<?php 
/*
 * View component for displaying motorcycle stock
 * Expects directory of images within lowercase stocknumber e.g. backend/uploads/images/bikestock/a123/
 *

use common\models\DucatiClothingCategories;
use yii\imagine\Image; 
$image=DucatiClothingCategories::setProductCategoryImage($model);
use yii\web\UrlManager;
use yii\bootstrap\Button;
 */
use yii\helpers\Html;
use yii\helpers\Url;
$url = Url::toRoute(['ducati-accessories/see', 'plBrowse[Category]' =>$model->Category ]);
//var_dump($model['Category']);
    ?> 
<div class='col-xs-12 col-sm-6 col-md-2'>
	<a href='/ducati/ducati-accessories/see?plBrowse[Category]=<?=$model->Category?>'><img src=<?=$image.'/tn.jpg'?> class="img-rounded" alt=<?=$model->Category?>></a>

	<?= Html::a('View', $url, ['class' => 'btn btn-sm btn-success'])?>

	<div class="itemcaption"> <?=$model['Category'] ?></div>
</div>
