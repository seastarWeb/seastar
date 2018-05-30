<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Bikes;
/* @var $this yii\web\View */
/* @var $model common\models\Bikes */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bikes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bikes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php // var_dump(Bikes::getBikeimages($model->id)); ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'make',
            'model',
            'colour',
            'frame_no',
            'engine_no',
            'cc',
            'mileage',
            '1st_reg_date',
            'purchase_date',
            'from',
            'description',
            'location',
            'id',
            'sale_date',
            'sale_price',
            'sold',
            'display_price',
            'purchase_price',
            'min_price',
            'catagory',
            'reg',
            'spent',
            'sold_to',
            'invoice_in',
            'holding',
            'invoice_out',
            'MISC1',
            'MISC2',
            'MISC3',
            'MISC4',
            'MISC5',
            'MMISC1',
            'MMISC2',
            'MMISC3',
            'trim',
            'mot',
            'door',
            'ignition',
            'plan',
            'siv',
            'plan_date',
            'fuel',
            'warranty',
            'wdate',
            'nominal',
            'transferred',
            'nominal_in',
            'dateEdit',
            'timeEdit',
            'vehicleClass',
            'category',
            'supplierRef',
            'A',
            'B',
            'C',
            'details',
            'regfee',
            'roadtax',
        ],
    ]) ?>

</div>
