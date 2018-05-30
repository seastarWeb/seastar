<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchOrder */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="col-xs-12 col-sm-12 col-md-12">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
       //     ['class' => 'yii\grid\SerialColumn'],

            'order_id',
            'orderstatus',
//            'ordertds',
//            'order_customer_id',
//            'updated_at',
            // 'status',
             'firstname',
             'lastname',
            // 'dob',
             'email:email',
             'mobile',
             'phone',
             'add1',
            // 'add2',
            // 'city',
            // 'county',
             'postcode',
            // 'country',
          //   'notes:ntext',
            // 'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>

</div>
