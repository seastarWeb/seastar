<?php

use yii\helpers\Html;
use kartik\nav\NavX; 
use kartik\sidenav\SideNav; 
use kartik\dropdown\DropdownX;
use kartik\tabs\TabsX;
use  yii\widgets\ListView;
use yii\widgets\Pjax;
use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;
/* @var $this yii\web\View */
/* @var $searchModel common\models\BikeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ducati Accessories';
$this->params['breadcrumbs'][] = ['label'=> 'Ducati', 'url' => ['/ducati/ ']];
$this->params['breadcrumbs'][] = ['label'=> 'Ducati Accessories', 'url' => ['/ducati/ducati-accessories/ ']];


?>
	<h1><?= Html::encode($this->title) ?></h1>


<div class="container">
    <div class="row">
  	   	<h2>Categories</h2>
	   <?=$model->page ?>
    </div>   
	<?php
		echo ListView::widget([
			'dataProvider' => $catProvider,
			'itemOptions' => [
			'container' =>  'infinite',
			'class' => 'col-xs-12 col-sm-6 col-md-4 col-lg-3 vtop'],
			'itemView' => '_listCat',
				'pager' => ['triggerText'=>'Click for more...','triggerTemplate'=>'<div class="ias-trigger" style="text-align: center; cursor: pointer;"><h3><span class="label label-default"><a>{text}</a></span></h3></div>','noneLeftText'=>'That\'s all folks!!','class' => \kop\y2sp\ScrollPager::className()],
			]);
		?>
</div>
		 	<?php	
/*
		 	echo TabsX::widget([
    'items' => [
	        [
				'label'=>'Categories <i class="glyphicon glyphicon-camera"></i>',
				'content'=> ListView::widget([
				'dataProvider' => $catProvider,
				'itemOptions' => [
				'container' =>  'infinite',
				'class' => 'item'],
				'itemView' => '_listCat',
	'pager' => ['triggerText'=>'Click for  more...','triggerTemplate'=>'<div class="ias-trigger" style="text-align: center; cursor: pointer;"><h3><span class="label label-default"><a>{text}</a></span></h3></div>','noneLeftText'=>'That\'s all folks!!','class' => \kop\y2sp\ScrollPager::className()],
				]),
		        'active'=>true
	        ],
			[
				'label' => 'Accessorize your Ducati Motorcycle <i class="glyphicon glyphicon-filter"></i>',
				'content' => $this->render('_accessorizeForm', ['model' => $searchModel,]),
				'active' => false
	        ],

	        ],
    'position'=>TabsX::POS_ABOVE,
    'align'=>TabsX::ALIGN_LEFT,
    'bordered'=>false,
    'encodeLabels'=>false]);
 	 ?>
</div>
  <?php 
  /*Pjax::begin();?>

            <div class='col-xs-6 col-md-3'>
                <?= $this->render('_searchForm', [
                     'model' => $searchModel,
                ]) ?>
            </div>

            <div class='col-xs-12 col-md-9'>
			<?php 
				echo ListView::widget([
				'dataProvider' => $dataProvider,
				'itemOptions' => [
				'container' =>  'infinite',
				'class' => '.thumbnail'],
				'itemView' => '_listItem',
				'pager' => ['class' => \kop\y2sp\ScrollPager::className()]
				]); ?>
			</div>
	 <?php Pjax::end();
	 */ ?>


