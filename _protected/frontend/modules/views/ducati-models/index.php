<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\bootstrap\Carousel;
use yii\data\ArrayDataProvider;
use common\models\ProductLineSearch;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Ducati', 'url' => ['/ducati/ ']];
$this->params['breadcrumbs'][] = ['label' => 'Ducati Models', 'url' => ['/ducati/ducati-models/ ']];
$this->params['breadcrumbs'][]  = $model->title;
$this->registerMetaTag(['name' => 'description', 'content' => $this->title.' also browse our Ducati accessories, spares and clothing at Ducati Norwich ']);
/* @var $this yii\web\View */
?>
<div class="ducati-default-index">
	<h1>The <?=  $model->title ?></h1>
    <div class="body-content">
        <div class="row">
	        <div class="col-md-9">
		 		<div class="panel panel-default">
				    <div class="panel-body"> 
				    	<?=$model->page ?> 
				    </div>
	 		    </div>
		    </div>
	        <div class="col-md-3">
					<?php if($ismodel){ echo ListView::widget( ['dataProvider' => $dataProvider,'itemView' => '_listModel','layout' => '{items}{pager}',]); }?>
		 	</div>
		</div>
		<div class="row">
<?php 
// -- If this is a model range view 
	if($ismodel){?>
	    <div class="col-sm-12 col-lg-12">
			<div class="panel panel-default">
			  <div class="panel-heading">Clothing </div>
			    <div class="panel-body">
			    	<?php //$this->render('_productList', ['products' => $assocClothing, ]) ?>
			    </div>
		    </div>
		</div>
		<div class="col-sm-12 col-lg-12">
			<div class="panel panel-default">
			  <div class="panel-heading">Accessories </div>
			    <div class="panel-body">
					<?php // $this->render('_productList', ['products' => $assocParts, ]) ?>
			    </div>
		    </div>
		</div>
		<div class="col-md-12">
			<div class="panel panel-default">
			 	<div class="col-sm-12 col-lg-12">
			      <?= dosamigos\gallery\Carousel::widget([
				      'items' => $slides, 'json' => true,
				      'clientEvents' => [
				      'onslide' => 'function(index, slide) {
				      console.log(slide);
				      }'
				      ]]); ?>
	      		</div>
			</div>
		</div>
<?php }// This is just a menu to render ?> 
    </div>
    <div class="row">
<?php
   /*
* List view rendering subform _listItem with paging and images if viewing model range
* OR
* List models within model range
*/
	$i=0;
	if (!$ismodel){
// This is just the menu being rendered so present any submenus and exerpt
		echo ListView::widget( [
		    'dataProvider' => $dataProvider,
		    'itemView' => '_listItem',
		    'layout' => '{items}{pager}',
		    'itemOptions' => [ ],
		    ] );
	}	?>

</div>
