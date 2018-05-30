<?php
use yii\widgets\ListView;


/* @var $this yii\web\View */
$this->title = $model->model_description;
$this->params['breadcrumbs'][] = ['label' => 'Ducati', 'url' => ['/ducati//']];
$this->params['breadcrumbs'][] = ['label' => 'Ducati Models', 'url' => ['/ducati/ducati-models/ ']];
$this->params['breadcrumbs'][]  = $model->model;
$this->registerMetaTag(['name' => 'description', 'content' => $this->title.' also browse our Ducati accessories, spares and clothing
	at Ducati Norwich ']);
?>

<h1> <?= $model->model_description?></h1>
<p>
This view will require the details of the models to be added.
<?= $model->model_page ?>
</p>
