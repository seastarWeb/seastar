<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Bikestock */

$this->title = $model->shortdesc;
$this->params['breadcrumbs'][] = ['label' => 'Ducati Clothing', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<h1><?= Html::encode($this->title) ?></h1>
<?= dosamigos\gallery\Carousel::widget([
	'items' => $slides, 'json' => true,
	'clientEvents' => [
	'onslide' => 'function(index, slide) {
	console.log(slide);
	}'
	]]); ?>
</div>
<div class="row">
<img src=<?='/backend/uploads/images/'.strtolower($model->defaultimage)?>> 
<?= DetailView::widget([
	'model' => $model,
	'attributes' => [
	'brand',
	'category',
	'subcat',
	//            'cc',
	'description',
	'pricenett',
	//
	            ],
	            ]) ?>
</div>
	
