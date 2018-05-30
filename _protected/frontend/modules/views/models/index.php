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
<div class="checkerboard ctawrapper">
            
    <div class="container">
                        
        <div class="row">
            
            <div class="col-xs-12 col-sm-6 vcenter ctatext">

			    	<?=$model->page ?> 
		    </div>
		</div>
	</div>
</div>	
<?php
/*
Iterate through the models within the range.

			echo ListView::widget([
				'dataProvider' => $ranges,
				'itemOptions' => [
				'container' =>  'infinite',
				'class' => 'item'],
				'itemView' => '_listModel',
				'pager' => ['triggerText'=>'!','triggerTemplate'=>'<div class="ias-trigger" style="text-align: center; cursor: pointer;"><h3><span class="label label-success"><a>{text}</a></span></h3></div>','noneLeftText'=>'!','class' => \kop\y2sp\ScrollPager::className()],
				]);
*/
		echo ListView::widget( [
		    'dataProvider' => $ranges,
		    'class'=>'col-xs-12 col-sm-6 vcenter',
		    'itemView' => '_listItem',
		    'layout' => '{items}{pager}',
		    'itemOptions' => [ ],
	    	]);
    ?>
