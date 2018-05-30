<?php
use yii\widgets\ListView;


/* @var $this yii\web\View */
$this->title = $model->model_description;
$this->params['breadcrumbs'][] = ['label' => 'Ducati', 'url' => ['/ducati/ ']];
$this->params['breadcrumbs'][] = ['label' => 'Ducati Models', 'url' => ['/ducati/models/ ']];
$this->params['breadcrumbs'][]  = $model->model;
$this->registerMetaTag(['name' => 'description', 'content' => $this->title.' also browse our Ducati accessories, spares and clothing
	at Ducati Norwich ']);
?>

<h1> <?= $model->model_description?></h1>
<div class="row">
<div class="col-sm-8"> <?= $model->model_page ?> </div>
<?php
/*
 * * List view rendering subform _listItem with paging and images
 * */
$i=0;
echo ListView::widget( [
	'dataProvider' => $dataProvider,
	'itemView' => '_modelView',
	'layout' => '{items}{pager}',
	'itemOptions' => [ ],
	] );
?>
</div>

