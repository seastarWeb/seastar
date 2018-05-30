<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

 $this->title = $model->title;
 $mod=Yii::$app->controller->module->id;
 $this->params['breadcrumbs'][] = ['label' => $mod, 'url' => ['/'.$mod.'/ ']];
$this->params['breadcrumbs'][]  = $model->title;
 $this->registerMetaTag(['name' => 'description', 'content' => $this->title.' also browse our Ducati accessories, spares and clothing at Ducati Norwich ']);
 
?>

<div class="col-lg-12">
    <div class="ducati-default-index">
    <?=  $model->page ?>
    </div>
</div>

