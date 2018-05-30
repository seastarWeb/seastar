<?php 
/*
 * View component for displaying motorcycle models
 * 
 *
 */
use yii\helpers\ArrayHelper;
$thisyear=date("Y");
$modelsU = $model->models;

$fred=ArrayHelper::multisort($modelsU, ['year', 'model'], [SORT_DESC, SORT_ASC]);
// iterate through the model range and select one of this year's models.
foreach($modelsU as $bikemodel){
	if ($bikemodel->year >= $thisyear) {
		break;
	//	die(var_dump($bikemodel));
	}
};

 //die(var_dump($modelsU));
$t1 = Yii::$app->controller->module->id;
$to=Yii::$app->urlManager->createUrl([$t1.'/the/'.$model->alias])
?>
<div class="row ">
	<div class="col-xs-12 col-sm-6 vcenter" >
		<div class="miright">
		<a href=<?=$to?>><?=$bikemodel->thumb ?></a>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 vcenter">
			<h2><?=$model->model_range?></h2>
		</div>
		<p class="text-danger">
		<?php
			// line items of the specific models
			foreach ($modelsU as $key => $value) {
				if (intval($value['year'])>=$thisyear){
					echo '<a class="col-xs-12 col-sm-6" vcenter href=/'.$t1.'/the/'.$value['alias'].'><h2 class="label">'.$value['model_description'].$value['year'].'</h2><span class="glyphicon glyphicon-menu-right transition"></span></a></br>';
				}
			}

			if (strpos($t1,'ucati') !== false) {
			    echo "<div class='colorbar ducati'></div>";
			}elseif(strpos($t1,'awasaki') !== false) {
			    echo "<div class='colorbar Kawasaki'></div>";
			}elseif(strpos($t1,'rambler') !== false) {
			    echo "<div class='colorbar scrambler'></div>";
			}else{
			    echo "<div class='colorbar seastar'></div>";
			}
		?>
		</p>
		</div>	
	</div>
</div>

