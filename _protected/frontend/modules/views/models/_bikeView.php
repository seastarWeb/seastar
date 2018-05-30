<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Bikes;
use himiklab\thumbnail\EasyThumbnailImage;

$make = Yii::$app->controller->module->id;
$imgtogo=Bikes::getOneImage($model->id);
$img=EasyThumbnailImage::thumbnailImg($imgtogo, 200,150,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => $model->model ,'class'=>'img-rounded',]);
$i=$index+1;

?>
<div class="thumbnail">
	<a href='/motorcycles/approved-used/view?id=<?=$model->id ?>'><?=$img ?></a>
		<div class="caption">
			<p><?=$model->model?></p>
		</div>
		<p class="text-muted">£<?=$model->display_price?></p>
</div>
