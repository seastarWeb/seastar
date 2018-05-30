<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TblOrder */

$this->title = $model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->order_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->order_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="col-xs-12 col-sm-4 col-md-4">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'order_id',
            'orderstatus',
            'ordertds',
            'order_customer_id',
            'updated_at',
            'status',
            'firstname',
            'lastname',
            'dob',
            'email:email',
            'mobile',
            'phone',
            'add1',
            'add2',
            'city',
            'county',
            'postcode',
            'country',
            'notes:ntext',
            'created_at',
        ],
    ]) ?>
    </div>
    <div class="col-sm-8 col-md-8">
<div class="panel">
Order details
<?php //var_dump($details);
?>

<?php foreach ($details as $product):?>

<div class="row">
    <div class="col-xs-4">
      <?= Html::encode($product->title) ?>
   </div>
       <div class="col-xs-2">
    £<?= $product->price ?>
        </div>
	    <div class="col-xs-2">
        <?=  $product->quantity?>
	    </div>
        <div class="col-xs-2">
		    £<?= $product->partnumber ?>
	        </div>
	</div>
<?php endforeach ?>

</div>
    </div>

</div>
