<?php 
/*
 * View component for displaying motorcycle stock
 * Expects directory of images within lowercase stocknumber e.g. backend/uploads/images/bikestock/a123/
 *
 */

use common\models\DucatiClothingCategories;
use yii\imagine\Image; 
use yii\helpers\Html; 
use yii\helpers\Url; 
use yii\web\UrlManager;
$image=DucatiClothingCategories::setProductCategoryImage($model);

$productline=  str_replace('\'','',$model->ProductLine);
$productline=  str_replace(' ','_',$productline);
$productline=  strtolower($productline);
    ?> 
<div class='col-xs-12 col-sm-6 col-md-2'>
	<div class="hproduct">
	<label class="brand"><?=$model->Brand ?></label>
	<a href='/shop/for/<?=strtolower($model->Brand)?>/<?= $model->Url ?>' rel='product'><img src=<?=$image.'/tn.jpg'?> class="prodImage img-rounded " width="100%" alt="<?=$model->ProductLine ?>"></a>
	<div class="itemcaption"><span class='product_title'><h3 class="badge" text_><?=$model->ProductLine ?></h3></span></div>
	</div>
</div>
