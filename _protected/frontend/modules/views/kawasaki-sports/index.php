<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Kawasaki', 'url' => ['/kawasaki/ ']];
$this->params['breadcrumbs'][]  = ['label' => 'Kawasaki Models', 'url' => ['/kawasaki-models/ ']];
$this->params['breadcrumbs'][]  = $model->title;
$this->registerMetaTag(['name' => 'description', 'content' => $this->title.' also browse our Ducati accessories, spares and clothing at Ducati Norwich ']);
  
?>
<h1><?=  $model->title ?></h1>
<div class="col-lg-12">
<?=  $model->page ?>
    
    <?= dosamigos\gallery\Carousel::widget([
    'items' => $slides, 'json' => true,
    'clientEvents' => [
        'onslide' => 'function(index, slide) {
            console.log(slide);
        }'
]]); ?>

</div>

<div class="ducati-default-index">


</div>

