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

$make = Yii::$app->controller->module->id;
$productline=$model['Url'];
$brand=strtolower($model['Brand']);
$pieces = explode(" ", $model['Category']);
$cat = $pieces[0];
$plink=Url::toRoute([$make.'-accessories/browse/'.$cat]);

$imgtogo=\Yii::getAlias('@webroot').'/productline/'.$brand.'/'.$productline.'/sm.jpg';
$img=EasyThumbnailImage::thumbnailImg($imgtogo, 200,150,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => $model['Category'] ,'class'=>'img-rounded',]);

?> 
<div class='col-sm-12 col-md-12 col-lg-12'>
	<div class="thumbnail">
	  	<div class="itemcategory"><?=strtoupper($model['Category']) ?></div>
		<a href="<?=$plink?>"><?=$img?></a>
	</div>
</div>
