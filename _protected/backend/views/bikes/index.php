<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BikeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bikes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bikes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bikes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'make',
            'model',
            'colour',
            'frame_no',
            'engine_no',
            // 'cc',
            // 'mileage',
            // '1st_reg_date',
            // 'purchase_date',
            // 'from',
            // 'description',
            // 'location',
             'id',
            // 'sale_date',
            // 'sale_price',
            // 'sold',
            // 'display_price',
            // 'purchase_price',
            // 'min_price',
            // 'catagory',
             'reg',
            // 'spent',
            // 'sold_to',
            // 'invoice_in',
            // 'holding',
            // 'invoice_out',
            // 'MISC1',
            // 'MISC2',
            // 'MISC3',
            // 'MISC4',
            // 'MISC5',
            // 'MMISC1',
            // 'MMISC2',
            // 'MMISC3',
            // 'trim',
            // 'mot',
            // 'door',
            // 'ignition',
            // 'plan',
            // 'siv',
            // 'plan_date',
            // 'fuel',
            // 'warranty',
            // 'wdate',
            // 'nominal',
            // 'transferred',
            // 'nominal_in',
            // 'dateEdit',
            // 'timeEdit',
            // 'vehicleClass',
            // 'category',
            // 'supplierRef',
            // 'A',
            // 'B',
            // 'C',
            // 'details',
            // 'regfee',
            // 'roadtax',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
