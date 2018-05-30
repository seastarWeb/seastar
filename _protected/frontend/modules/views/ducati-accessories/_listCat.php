<?php 
/*
 * View component for displaying Ducati Accessory Categories
 * Expects directory of images within lowercase stocknumber e.g. backend/uploads/images/bikestock/a123/
 *
 */

use common\models\TblProductLines;
use yii\helpers\Url;
use yii\helpers\Html;
$image=TblProductLines::setCategoryImage($model);
$url = Url::toRoute(['ducati-accessories/browse/'.$model->Category ]);

    ?> 
	<h2 itemprop="name"><a href="#"><?=strtoupper($model->Category) ?></a></h2>
		<a href=<?=$url?>><?=$image?></a>
