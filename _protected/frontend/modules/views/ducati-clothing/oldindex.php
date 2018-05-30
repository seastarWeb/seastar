<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

 $this->title = $model->title;
 $this->params['breadcrumbs'][] = ['label' => 'Ducati', 'url' => ['/ducati/ ']];
  $this->params['breadcrumbs'][] = ['label' => 'Ducati Clothing', 'url' => ['/ducati/ducati-clothing/ ']];
 //$this->params['breadcrumbs'][] = explode('\\', $model->URL );
$this->params['breadcrumbs'][]  = $model->title;
 $this->registerMetaTag(['name' => 'description', 'content' => $this->title.' also browse our Ducati accessories, spares and clothing at Ducati Norwich ']);
?>
 <h1><?=  $model->title ?></h1>
 <?=  $model->page ?>
<div class="ducati-default-index">

<?= yii\bootstrap\Carousel::widget([
    'items' => $items
]); ?>

</div>

