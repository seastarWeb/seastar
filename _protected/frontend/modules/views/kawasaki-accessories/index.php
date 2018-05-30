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

$this->title = $model->title; //'Ducati Accessories';
$this->params['breadcrumbs'][] = ['label'=> 'Kawasaki', 'url' => ['/kawasaki/ ']];
$this->params['breadcrumbs'][] = ['label'=> 'Kawasaki Accessories', 'url' => ['/kawasaki/kawasaki-accessories/ ']];


?>
<div class="kawasaki-accessories-index">
	<div>
		<?= $model->page ?>
	</div>
	<div class="container">
		<div class="row">
			<div class="jumbotron">
				<h2>Categories</h2>
			</div>
			 	<?php	echo TabsX::widget([
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
							'label' => 'Filter Results <i class="glyphicon glyphicon-filter"></i>',
							'content' => $this->render('_searchForm', ['model' => $searchModel,]),
							'active' => false
				        ],  
					        ],
			    'position'=>TabsX::POS_ABOVE,
			    'align'=>TabsX::ALIGN_LEFT,
			    'bordered'=>false,
			    'encodeLabels'=>false]);
				?>
		</div>
	</div>
</div>

