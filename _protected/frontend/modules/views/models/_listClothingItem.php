<?php 
/*
 * View component for displaying motorcycle stock
 * Expects directory of images within lowercase stocknumber e.g. backend/uploads/images/bikestock/a123/
 * 20/10/2015 Amended to cirrect productline to be taken from the Url field of the model
 */
use frontend\models\Product;
use common\models\TblProductLines;
use yii\helpers\Url;
use himiklab\thumbnail\EasyThumbnailImage;
//$image=Product::getProductImage(strtolower($model->defaultimage),$model->part_no);
/*
$i=$index+1;
$productline=  str_replace('\'','',$model->ProductLine);
$productline=  str_replace(' ','_',$productline);
$productline=  strtolower($productline);
*/
// die(var_dump($model['Url']));
$make = Yii::$app->controller->module->id;
$productline=$model['Url'];
$brand=strtolower($model['Brand']);
$plink=Url::toRoute(['/shop/index?ShopFor[Brand]=Ducati&ShopFor[Category]='.$model['Category']]);
$pieces = explode(" ", $model['Category']);
$cat = $pieces[0];
$plink=Url::toRoute([$make.'-clothing/browse/'.$cat]);
$image=\Yii::getAlias('@webroot').'/productline/'.$brand.'/'.$productline.'/sm.jpg';
//die(var_dump($image));

$imgtogo=$image;//Bikes::getOneImage($model->id);
$img=EasyThumbnailImage::thumbnailImg($imgtogo, 200,150,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => $model['Category'] ,'class'=>'img-rounded',]);
//$image=TblProductLines::getProductLineImage($model);
?> 
<div class='col-sm-12 col-md-12 col-lg-12'>
	<div class="thumbnail">
	  	<div class="itemcategory"><?=strtoupper($model['Category']) ?></div>
		<a href="<?=$plink?>"><?=$img?></a>
	</div>
</div>
