<?php 
/*
 * View component for displaying motorcycle stock
 * Expects directory of images within lowercase stocknumber e.g. backend/uploads/images/bikestock/a123/
 *
 */

use common\models\TblProductLines;

$image=TblProductLines::setCategoryImage($model);
use yii\helpers\Url;
use yii\helpers\Html;
//use yii\web\UrlManager;
//use yii\bootstrap\Button;
$url = Url::toRoute(['ducati-clothing/browse/'.$model->Category ]);
    ?> 


	<a href=<?=$url?>>
	    <img itemprop="image" class="img-fullwidth" src="http://placehold.it/400x400?text=<?=$model->Category ?>">
	</a>

	<h2 itemprop="name"><a href="#"><?=strtoupper($model->Category) ?></a></h2>
           

