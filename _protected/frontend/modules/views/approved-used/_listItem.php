<?php 
/*
 * View component for displaying motorcycle stock
 *
 */

use common\models\Bikes;
use himiklab\thumbnail\EasyThumbnailImage;

$imgtogo=Bikes::getOneImage($model->id);
$img=EasyThumbnailImage::thumbnailImg($imgtogo, 300,195,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => $model->model ,'class'=>'img-rounded',]);
$i=$index+1;

?>
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
    <div class="thumbnail">
		<a href='/motorcycles/approved-used/view?id=<?=$model->id ?>'><?=$img ?></a>
		<div class="caption">
			<p><?=$model->model?></p>
		</div>
		<p class="text-muted">£<?=$model->display_price?></p>
    </div>
</div>
