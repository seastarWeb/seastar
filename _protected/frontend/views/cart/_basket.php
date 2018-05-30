<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\widgets\ActiveForm;
use common\models\ProductLineSearch;
/* @var $this yii\web\View */
/* @var $model frontend\models\People */
/* @var $form ActiveForm */
?>
<div class="row">
    <div class="col-xs-4"> </div>
    <div class="col-xs-2"> Price </div>
    <div class="col-xs-2"> Quantity </div>
    <div class="col-xs-2"> Total inc. </div>
</div>
<?php foreach ($products as $product):?>

<div class="row">
    <div class="col-xs-4">
    <?php
        Modal::begin([
            'header' => '<h3>'.Html::encode($product->description).'</h3>',
            'toggleButton' => ['label' => '<i class="glyphicon glyphicon-camera"></i>'],
            'footer'=> Html::encode($product->partno.' £'.$product->price),
            ]);
            echo ProductLineSearch::getImageForPartNo($product->partno);
         ;
        Modal::end();
    ?>
    <?= Html::encode($product->description) ?>

    </div>
    <div class="col-xs-2">
    £<?= $product->price ?>
    </div>
    <div class="col-xs-2">
    <?= $quantity = $product->getQuantity()?>
    </div>
    <div class="col-xs-2">
    £<?= $product->getCost() ?>
    </div>
</div>

<?php endforeach ?>