<?php 
use yii\helpers\Html;
use yii\helpers\Url;
$t1=Yii::$app->urlManager->createUrl(['/ducati/ducati-models/review', 'model' => $model->model_description]);
    ?>

<div class="caption">
	<h6><?= Html::a('<span class="label label-default">'.$model->model.'</span>',$t1)?></h6>
</div>
