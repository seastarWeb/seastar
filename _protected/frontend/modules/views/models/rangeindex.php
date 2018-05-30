<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\bootstrap\Carousel;
use yii\data\ArrayDataProvider;
use common\models\ProductLineSearch;

$make = Yii::$app->controller->module->id;
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => ucfirst($make), 'url' => ['/'.$make.'/ ']];
$this->params['breadcrumbs'][] = ['label' => ucfirst($make).' Models', 'url' => ['/'.$make.'/models/ ']];
$this->params['breadcrumbs'][]  = $model->title;
$this->registerMetaTag(['name' => 'description', 'content' => $this->title.' also browse our Ducati accessories, spares and clothing at Ducati Norwich ']);

/* @var $this yii\web\View */
?>
<div class="ducati-default-index">
	<h1>The <?=  $model->title ?></h1>
    <div class="body-content">
        <div class="row">
	        <div class="col-xs-12 col-md-6">
		 		<div class="panel panel-default">
				    <div class="panel-body"> 
				    	<?=$model->page ?> 
				    </div>
	 		    </div>
		    </div>
	        <div class="col-xs-12 col-md-6">

	        </div>	
		</div>
		<div class="row spacer20">
				<?php
				echo ListView::widget( [
				    'dataProvider' => $dataProvider,
				    'itemView' => '_listItemNew',
				     'class'=>'col-xs-12 col-sm-6 vcenter',
				    'layout' => '{items}{pager}',
				    'itemOptions' => [ ],
				    ] );
		    ?>

		</div>	
	</div>
</div>	
<div class="container">
	<div class="row">
		<div class="col-sm-12 col-lg-4">
			<h3>Associated Clothing</h3>
			<?php 
			echo ListView::widget( ['dataProvider' => $clothingProvider,
				'layout' => "{items}\n{pager}",
                        'itemOptions' => [
                        'container' =>  'infinite',
                        'class' => 'item'],
                        'itemView' => '_listClothingItem',
                        'pager' => [
                            'triggerText'=>'Give me more!',
                            'triggerTemplate'=>'<div class="ias-trigger" style="text-align: center; cursor: pointer;"><h3><span class="label label-success"><a>{text}</a></span></h3></div>',
                            'noneLeftText'=>'That\'s all folks!!',
                            'class' => \kop\y2sp\ScrollPager::className()],
                        ]);
            ?>		
		</div>
		<div class="col-sm-12 col-lg-4">
			<h3>Associated Accessories</h3>
			<?php 
			echo ListView::widget( ['dataProvider' => $partsProvider,
						'layout' => "{items}\n{pager}",
                        'itemOptions' => [
                        'container' =>  'infinite',
                        'class' => 'item'],
                        'itemView' => '_listAccessoryItem',
                        'pager' => [
                            'triggerText'=>'Give me more!',
                            'triggerTemplate'=>'<div class="ias-trigger" style="text-align: center; cursor: pointer;"><h3><span class="label label-success"><a>{text}</a></span></h3></div>',
                            'noneLeftText'=>'That\'s all folks!!',
                            'class' => \kop\y2sp\ScrollPager::className()],
                        ]);
            ?>
		</div>
		<div class="col-sm-12 col-lg-4">
			<h3>Pre Owned Bikes</h3>
			<?php 
			//		die(var_dump($bikesProvider));
			echo ListView::widget( ['dataProvider' => $bikesProvider,
						'layout' => "{items}\n{pager}",
                        'itemOptions' => [
                        'container' =>  'infinite',
                        'class' => 'item'],
                        'itemView' => '_bikeView',
                        'pager' => [
                            'triggerText'=>'Give me more!',
                            'triggerTemplate'=>'<div class="ias-trigger" style="text-align: center; cursor: pointer;"><h3><span class="label label-success"><a>{text}</a></span></h3></div>',
                            'noneLeftText'=>'That\'s all folks!!',
                            'class' => \kop\y2sp\ScrollPager::className()],
                        ]);
            ?>
		</div>
	</div>
		<div class="col-md-12">
			<div class="panel panel-default">
			 	<div class="col-sm-12 col-lg-12">
			      <?php 
			      /*
			      echo dosamigos\gallery\Carousel::widget([
				      'items' => $slides, 'json' => true,
				      'clientEvents' => [
				      'onslide' => 'function(index, slide) {
				      console.log(slide);
				      }'
				      ]]); 
				      */
				      ?>
	      		</div>
			</div>
		</div>
</div>

