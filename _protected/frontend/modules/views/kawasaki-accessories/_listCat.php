<?php 
/*
 * View component for displaying motorcycle stock
 * Expects directory of images within lowercase stocknumber e.g. backend/uploads/images/bikestock/a123/
 *
 */

use common\models\TblProductLines;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\UrlManager;
use yii\bootstrap\Button;
$image=TblProductLines::getProductLineImage($model);
$url = Url::toRoute(['kawasaki-accessories/browse/'.$model->Category ]);

?> 

<div class='col-xs-12 col-sm-6 col-md-4 col-lg-3'>
	<div class='KawasakiCatContainer'>
		<a href=<?=$url?>><?=$image?></a>
		<?= Html::a($model->Category, $url, ['class' => 'btn btn-sm btn-block'])?>
	</div>
</div>
