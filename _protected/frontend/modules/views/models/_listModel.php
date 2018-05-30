<?php 

use yii\helpers\Html;
use yii\helpers\Url;

$make = Yii::$app->controller->module->id;
$t1=Yii::$app->urlManager->createUrl(['/'.$make.'/models/'.$model->alias, 'model' => $model->model_range]);
$models = $model->models;//->models->make;
//var_dump($models);
$pmodel=array();
$t1 = Yii::$app->controller->module->id;
//print_r($model->model_range->models->make);
?>
<div class="col-lg-1">
	<?= Html::a($model->model_range, ['/'.$make.'/models/'.$model->alias], ['class'=>'btn btn-sm btn-default']) ?>
	<?php 
	echo $models[0]['thumb'];

	echo $models[0]['id'];
	//krsort($models);
	foreach ($models as $key => $value) {
		if (intval($value['year'])>=2014){
			//	echo $value['thumb'];//->id;
				echo '<h2 class="label">'.$value['model_description'].'</h2></br>';
			}
	# code...
	}
	if (strpos($t1,'ucati') !== false) {
		    echo "<div class='DucatiCatContainer'></div>";
	}elseif(strpos($t1,'awasaki') !== false) {
		    echo "<div class='KawasakiCatContainer'></div>";
	}elseif(strpos($t1,'rambler') !== false) {
		    echo "<div class='ScramblerCatContainer'></div>";
	}else{
		    echo "<div class='SeastarCatContainer'></div>";
	}
?>
</div>
