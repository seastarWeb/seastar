<?php
use \yii\helpers\Html;
use \yii\helpers\Url;
use common\models\ProductLineSearch;
use yii\bootstrap\Collapse;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $products common\models\Product[] */

?>
<h1><?= Html::a('Continue Shopping',Url::previous() , ['class' => 'btn btn-success'])?></h1>

<div class="container-fluid">
<div class="row">
    <div class="col-xs-4"></div>
    <div class="col-xs-2">Price</div>
    <div class="col-xs-2">Qty.</div>
    <div class="col-xs-1">Cost</div>
    <div class="col-xs-2"></div>
</div>
<?php Pjax::begin()?>
<?php foreach ($products as $product):?>
    <div class="row">
        <div class="col-xs-4">
    <?php
        if($product->vat=='S'){$vat=1.2;}elseif($product->vat=='Z'){$vat=1;}
        $displayprice=$product->price*$vat;
        Modal::begin([
            'header' => '<h3>'.Html::encode($product->description).'</h3>',
            'toggleButton' => ['label' => '<i class="glyphicon glyphicon-camera"></i>'],
            'footer'=> Html::encode($product->partno.' £'.$displayprice),
            'size'=>'modal-sm',
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
        <div class="col-xs-1">
        <?= $quantity = $product->getQuantity()?>
        </div>
        <div class="col-xs-1">
        <?= Html::a(' -', ['cart/update', 'id' => $product->getId(), 'quantity' => $quantity - 1], ['class' => 'btn btn-sm btn-danger', 'disabled'
    	    => ($quantity - 1) < 1])?>
        <?= Html::a('+', ['cart/update', 'id' => $product->getId(), 'quantity' => $quantity + 1], ['class' => 'btn btn-sm btn-success'])?>
        </div>
        <div class="col-xs-2">
        £<?= round($product->getCost()*$vat,2) ?>
        </div>
        <div class="col-xs-1">
        <?= Html::a('×', ['cart/remove', 'id' => $product->getId()], ['class' => 'btn btn-sm btn-danger'])?>
        </div>
    </div>
<?php endforeach ?>
<?php Pjax::end()?>
<div class="row">
    <div class="col-xs-6">

    <?= Html::a('Checkout', ['cart/order'], ['class' => 'btn btn-success'])?>
    </div>
    <div class="col-xs-2">
    </div>
    <div class="col-xs-2">
    Total: £<?= $total ?> Plus VAT
    </div>
</div>
 <div class="table-responsive">
   <table class="table">
         </table>
	 </div> 

