<?php

//use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use kartik\helpers\Html;
use yii\helpers\Url;
use kartik\nav\NavX; 
use frontend\models\Menu;
use kartik\dropdown\DropdownX;
use common\models\DucatiClothingCategories;

use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\BikeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ducati Clothing';
$this->registerMetaTag(['name' => 'description', 'content' => $model->metadesc ]);
$this->params['breadcrumbs'][] = ['label'=> 'Ducati', 'url' => ['/ducati/ ']];
$this->params['breadcrumbs'][] = ['label'=> 'Ducati Clothing', 'url' => ['/ducati/ducati-clothing/ ']];

$t1=Yii::$app->request->queryParams;
// iterate through search params for next breadcrumb
if ($t1){
	foreach (array_values($t1)[0] as $v)
	{
		$this->params['breadcrumbs'][] =$v;
	}
}
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



