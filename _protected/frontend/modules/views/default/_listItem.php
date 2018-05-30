<?php
/* Detail view for main site submenu items
*/
use frontend\models\Menu;
use yii\helpers\Url;
$pictureFile = \Yii::getAlias('@webroot').strtolower('/uploads/menu/'.$model->id.'/lg.jpg');
if (!file_exists($pictureFile)){
    $img="<img class='img-fullwidth ctaimage-image' src='http://placehold.it/880x450?text=$model->title'>";
}else
{  $img="<img class='img-fullwidth ctaimage-image' src='http://placehold.it/880x450?text=$model->title'>";
   //$img="<img class='img-fullwidth ctaimage-image' src='Url::to('@web/uploads/menu/'.$model->id.'/lg.jpg', true)'"; 
}

//§die(var_dump($pictureFile));
//$image=EasyThumbnailImage::thumbnailImg($pictureFile, 350,200,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' =>
	//$model->menu,'class'=>'img-fullwidth ctaimage-image']);
?>
<div class="col-xs-12 col-sm-6 spacer20">
		<a class='ctaimage' href=<?=$model->URL?>><?= $img ?>
		<h2 class="ctaimage-text whitetext"><?=$model->title?></h2>
<!-- <p class="text-danger"><?=$model->excerpt?></p> -->
<!-- Need to place conditional formatter here for Ducati/Kawasaki/Other -->
		<?php 
            $t1 = $model->title;
            if (strpos($t1,'ucati') !== false) {
                echo "<div class='colorbar ducati'></div>";
            }elseif(strpos($t1,'awasaki') !== false) {
                echo "<div class='colorbar kawasaki'></div>";
            }elseif(strpos($t1,'rambler') !== false) {
                echo "<div class='colorbar scrambler'></div>";
            }else{
                echo "<div class='colorbar seastar'></div>";
            }
    	?>
		</a>
</div>
