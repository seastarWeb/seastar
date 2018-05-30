<?php

use yii\helpers\Html;
use kartik\nav\NavX; 
use kartik\dropdown\DropdownX;
use  yii\widgets\ListView;
/* @var $this yii\web\View */
/* @var $searchModel common\models\BikeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ducati Accessories';
$this->params['breadcrumbs'][] = ['label'=> 'Ducati', 'url' => ['/ducati/ ']];
$this->params['breadcrumbs'][] = ['label'=> 'Ducati Accessories', 'url' => ['/ducati/ducati-accessories/ ']];

$t1=Yii::$app->request->queryParams;
// iterate through search params for next breadcrumb
if (is_array($t1)){
	foreach (array_values($t1) as $v)
	{
		$this->params['breadcrumbs'][] = $v;
	}
}
?>
<div class="accessories-index">
    <div class="row" >
	<h1><?= Html::encode($this->title) ?></h1>
	<div>
	<?= $model->page ?>
	</div>
    </div>
    
    <div class="row" >
	<div class="col-xs-12 col-md-3 col-lg-2">
	<?php 
	/*
	 * Filter section for all product
	 * 
		$this->params['breadcrumbs'][] = 'Index';
		echo Html::beginTag('div', ['class'=>'dropdown']);
		echo Html::button('Filter Results <span class="caret"></span><span class="glyphicon glyphicon-filter"></span></button>', ['type'=>'button', 'class'=>'btn btn-default', 'data-toggle'=>'dropdown']);
		echo DropdownX::widget(['items' => $scats,]); 
		echo Html::a('X', ['/ducati/ducati-accessories/ '], ['class'=>'btn btn-primary']);
		echo Html::endTag('div');
		*/
	?>
	</div>
	<div class="col-xs-8">
	    <div class="scrollcontainer" id="infinite">
 		<?php 
		echo ListView::widget([
     		'dataProvider' => $dataProvider,
          	'itemOptions' => [
		'container' =>  'infinite',
		'class' => '.thumbnail'],
	       	'itemView' => '_listCat',
	        'pager' => ['class' => \kop\y2sp\ScrollPager::className()]
	    ]); ?>
	    </div>
	  </div>
    </div>
</div>

