<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model common\models\Bikestock */

$this->title = $model->make.' '.$model->model;
$this->params['breadcrumbs'][] = ['label' => 'Motorcycles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Approved Used', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<h1><?= Html::encode($this->title) ?></h1>

 	<?php	echo TabsX::widget([
    'items' => [
        [
        'label'=>'<span>'.$model->model.' Images</span> ',
		'content'=> dosamigos\gallery\Carousel::widget([
			'items' => $slides, 'json' => true,
			'clientEvents' => [
			'onslide' => 'function(index, slide) {
				console.log(slide);
				}'
		]]),
        'active'=>true
        ],
        [
        'label'=>'<span>Bike Specifications</span> ',
        'content'=> DetailView::widget([
			'model' => $model,
			'attributes' => [
			'make',
			'model',
			'colour',
			'mileage',
			'description',
			'id',
			//'cc',
			//    'from',
			//    'sale_date',
			//    'sale_price',
			//    'sold',
			'display_price',
			],
		]) ,
        'active'=>false
        ],

   	],

    'position'=>TabsX::POS_ABOVE,
    'align'=>TabsX::ALIGN_LEFT,
    'bordered'=>false,
    'encodeLabels'=>false]);
 	 ?>

<?php
/* dosamigos\gallery\Carousel::widget([
	'items' => $slides, 'json' => true,
	'clientEvents' => [
	'onslide' => 'function(index, slide) {
	
		console.log(slide);
	}'
	]]); 
*/
	?>
</div>
<div class="row">
<?php
/* DetailView::widget([
	'model' => $model,
	'attributes' => [
	'make',
	'model',
	'colour',
	//            'cc',
	            'mileage',
	//            //    'from',
	            'description',
	//            'id',
	//            //    'sale_date',
	//            //    'sale_price',
	//            //    'sold',
	            'display_price',
	//
	            ],
	            ])
	          */
	           ?>
</div>
	
