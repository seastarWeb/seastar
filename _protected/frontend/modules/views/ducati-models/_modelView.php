<?php 
/*
 * View component for displaying motorcycle models
 * Expects directory of images within lowercase model range
 *
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use frontend\models\Menu;
use yii\helpers\ArrayHelper; 
use kartik\tabs\TabsX;
use common\models\Videoslides;
use common\models\ProductLineSearch;

/* 
Retrieve data for Associated Clothing and Parts/Accessories
If the model_range_id isn't set in the Menu item then default the accessories to Monsters
*/
if (is_null($model->model_range_id)){
	$mr= 7;
}else{
	$mr=$model->model_range_id;
}
/* get associated data - use default value if not */
$assocParts=ProductLineSearch::getPartsForModelRange($mr);
$assocParts=array_filter($assocParts);
if (empty($assocParts)){
     $assocParts=ProductLineSearch::getPartsForModelRange(7);
}

$assocClothing=ProductLineSearch::getClothingForModelRange($mr); 
$assocClothing=array_filter($assocClothing);
if (empty($assocClothing)){
     $assocParts=ProductLineSearch::getPartsForModelRange(7);
}

$slides= Videoslides::getVideos(4);
//var_dump($slides);
$i=$index+1;
// setup url for detail view
$t1=Yii::$app->urlManager->createUrl(['/ducati/ducati-models/review', 'model' => $model->model_description]);



    ?>
<div class="col-sm-12 col-md-12 col-lg-12">
    <div class="thumbnail">
		<div class="caption">
		<?= Html::a('<h5>'.$model->model.'</h5>',$t1)?>
		</div>
	</div>
    <div class="panel panel-default">
 	<?php	echo TabsX::widget([
    'items' => [
		[
		'label'=>'Images',
		'content'=>dosamigos\gallery\Carousel::widget([
			'items' => $slides, 'json' => true,
			'clientEvents' => [
			    'onslide' => 'function(index, slide) {
			        console.log(slide);
			    }'
			]]),
		'active'=> true],
        [
        'label'=>'<span>Specifications</span> ',
        'content'=> DetailView::widget([
			'model' => $model,
			'attributes' => [
				['label'=> 'Instruments','value' =>  $model->generals[0]->instruments,],
				['label'=> 'Warranty','value' =>  $model->generals[0]->warranty,],
				['label'=> 'Service Interval','value' =>  $model->generals[0]->maintenance_service_intervals,],
				['label'=> 'Valve Clearance','value' =>  $model->generals[0]->valve_clearance_check,],
			],
		]),
        'active'=>false
        ],
        [
        'label'=>'<span >Chassis</span>',
        'content'=>DetailView::widget([
			'model' => $model,
		    'attributes' => [
			    ['label'=>'Frame', 'value' => $model->chasses[0]->frame,],
			    ['label'=>'Wheelbase', 'value' => $model->chasses[0]->wheelbase,],
			    ['label'=>'Rake', 'value' => $model->chasses[0]->rake,],
			    ['label'=>'Trail', 'value' => $model->chasses[0]->trail,],
			    ['label'=>'Front Suspension', 'value' => $model->chasses[0]->front_suspension,],
			    ['label'=>'Front Wheel', 'value' => $model->chasses[0]->front_wheel,],
			    ['label'=>'Front Wheel Travel', 'value' => $model->chasses[0]->front_wheel_travel,],
			    ['label'=>'Front Brake', 'value' => $model->chasses[0]->front_brake,],
			    ['label'=>'Front Tyre', 'value' => $model->chasses[0]->front_tyre,],
			    ['label'=>'Rear Suspension', 'value' => $model->chasses[0]->rear_suspsension,],
			    ['label'=>'Rear Wheel Travel', 'value' => $model->chasses[0]->rear_wheel_travel,],
			    ['label'=>'Rear Brake', 'value' => $model->chasses[0]->rear_brake,],
			    ['label'=>'Rear Wheel', 'value' => $model->chasses[0]->rear_wheel,],
			    ['label'=>'Rear Tyre', 'value' => $model->chasses[0]->rear_tyre,],
			    ['label'=>'Fuel Capacity', 'value' => $model->chasses[0]->fuel_capacity,],
			    ['label'=>'Dry Weight', 'value' => $model->chasses[0]->dry_weight,],
			    ['label'=>'Seat Height', 'value' => $model->chasses[0]->seat_height,],
			    ['label'=>'Max Height', 'value' => $model->chasses[0]->max_height,],
			    ['label'=>'Max Length', 'value' => $model->chasses[0]->max_length,],
		    	],
		    ]),
		'active'=>false
		],
		[
		'label'=>'<span>Engine</span>',
		'content'=>DetailView::widget([
		    'model' => $model,
		    'attributes' => [
				['label'=>'Type', 'value'=> $model->engines[0]->type,],
				['label'=>'Displacement', 'value'=> $model->engines[0]->displacement,],
				['label'=>'Bore and Stroke', 'value'=> $model->engines[0]->bore_and_stroke,],
				['label'=>'Compression Ratio', 'value'=> $model->engines[0]->compression_ratio,],
				['label'=>'Power', 'value'=> $model->engines[0]->power,],
				['label'=>'Torque', 'value'=> $model->engines[0]->torque,],
				['label'=>'Fuel Delivery', 'value'=> $model->engines[0]->fuel_injection,],
				['label'=>'Exhaust', 'value'=> $model->engines[0]->exaust,],
				['label'=>'Emissions', 'value'=> $model->engines[0]->emissions,],
				['label'=>'Gearbox', 'value'=> $model->engines[0]->gearbox,],
				['label'=>'Ratio', 'value'=> $model->engines[0]->ratio,],
				['label'=>'Primary Drive', 'value'=> $model->engines[0]->primary_drive,],
				['label'=>'Final Drive', 'value'=> $model->engines[0]->final_drive,],
				['label'=>'Clutch', 'value'=> $model->engines[0]->clutch,],
				],
			]),
		'active'=>false
		],
		[
		'label'=>'<span>Colours</span>',
		'content'=> DetailView::widget([
			'model' => $model,
			'attributes' => [
				['label'=>'Colour', 'value'=> $model->colours[0]->colour_combinations,],
				['label'=>'Colour Option', 'value'=> $model->colours[0]->colour_option,],
				['label'=>'Tank Frame Wheels', 'value'=> $model->colours[0]->tank_frame_wheels,],
			],
			]),
		'active'=>false
		]

    ],
    'position'=>TabsX::POS_ABOVE,
    'align'=>TabsX::ALIGN_LEFT,
    'bordered'=>false,
    'encodeLabels'=>false]);
 	 ?>
	</p>
	</div>
	<div class="container">
		<div class="caption">
			<h5>Apparel</h5>
		</div>
		<?= $this->render('_productList', ['products' => $assocClothing, ]);?>
		<div class="caption">
			<h5>Accessories</h5>
		</div>
		<?= $this->render('_productList', ['products' => $assocParts, ]); ?>
	</div>
</div>
