<?php
$this->title = $model->title;
$this->params['breadcrumbs'][]  = $model->title;
/* @var $this yii\web\View */
use yii\widgets\ListView;
use yii\widgets\Menu;
use yii\widgets\Nav;
use yii\bootstrap\NavBar;
//use kartik\nav\NavX; 


$this->registerMetaTag(['name' => 'description', 'content' => $model->metadesc ]);
$this->title = 'Seastar Superbikes';
?>
<div class="default-index">
    <div class="row">
		<?=$model->page ?>
    </div>
    <div class="row">
    	<div class="children">
       <?php
		echo ListView::widget( [
		    'dataProvider' => $dataProvider,
		    'itemView' => '_listItem',
		    'layout' => '{items}{pager}',
		    'itemOptions' => [ ],
		    ] );
	    	?>
	    </div>
   </div>
</div>
