<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Bikestock */

$this->title = $model->ProductLine;
$this->params['breadcrumbs'][] = ['label' => 'Ducati', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Ducati Accessories', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<h1><?= Html::encode($this->title) ?></h1>
<?php
/* dosamigos\gallery\Carousel::widget([
	'items' => $slides, 'json' => true,
	'clientEvents' => [
	'onslide' => 'function(index, slide) {
	console.log(slide);
	}'
	]]); 
*/
	?>
</div>
    <picture>
      <source media='(min-width: 800px)' srcset='/product/<?=$model->part_no?>/med_<?=$model->part_no ?>.jpg, /product/<?=$model->part_no ?>/bg_<?=$model->part_no?>.jpg 2x'>
	  <source media='(min-width: 450px)' srcset='/product/<?=$model->part_no ?>/sm_<?=$model->part_no ?>.jpg,  /product/<?=$model->part_no ?>/med_<?=$model->part_no ?>.jpg 2x'>
	<img src='/product/<?=$model->part_no ?>/sm_<?=$model->part_no ?>.jpg'   srcset='/product/<?=$model->part_no ?>/sm_<?=$model->part_no ?>.jpg 1x, /product/<?=$model->part_no ?>/bg_<?=$model->part_no ?>.jpg 2x'>  
    </picture>
<div class="row">
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
	
