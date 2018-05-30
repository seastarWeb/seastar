<?php

use yii\helpers\Html;
use kartik\nav\NavX; 
use kartik\tabs\TabsX;
use kartik\sidenav\SideNav; 
use kartik\dropdown\DropdownX;
use yii\widgets\ListView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BikeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Motorcycles';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] ='Approved Used Motorcycles'; 

?>
<div class="bikestock-index">
	<h1><?= Html::encode($this->title) ?></h1>
        <div class="col-sm-12"> 
            <?= $model->page ?> 
        </div>
 	<div class="row">
 		<div class="nav-tabs-container">
  	<?php \yii\widgets\Pjax::begin(); ?>
 	<?php	echo TabsX::widget([
    'items' => [
	        [
		        'label'=>'Bikes  <i class="glyphicon glyphicon-camera"></i>',
		        'content'=> ListView::widget( [
		        	'dataProvider' => $dataProvider,
		        	'itemView' => '_listItem',
		        	'pager' => ['class' => \kop\y2sp\ScrollPager::className()],
		        	'layout' => '{items}{pager}','itemOptions' => ['container' =>  'infinite',
		        	'class' => 'item'],
		        ]),
		        'active'=>true
	        ],
	        [
				'label' => 'Filter Results <i class="glyphicon glyphicon-filter"></i>',
				'content' => $this->render('_searchForm', ['model' => $searchModel,]),
				'active' => false
	        ],   
	        [
	            'label' => 'Warranty <i class="glyphicon glyphicon-wrench"></i>',
	            'content' => $this->render('warranty'),
	            'active' => false
	        ],
        ],
    'position'=>TabsX::POS_ABOVE,
    'align'=>TabsX::ALIGN_LEFT,
    'bordered'=>false,
    'encodeLabels'=>false]);
 	 ?>
 	<?php \yii\widgets\Pjax::end(); ?>
 		</div>
 	</div>
</div>
