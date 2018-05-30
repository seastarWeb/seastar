<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DeepBlueParts */

$this->title = $model->partid;
$this->params['breadcrumbs'][] = ['label' => 'Deep Blue Parts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deep-blue-parts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->partid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->partid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'partid',
            'PARTNO',
            'DESCRIPTION:ntext',
            'PRICE',
            'REFERNO',
            'OBSOLETE:ntext',
            'STOCK_LEVEL',
            'BIN:ntext',
            'TRADE_PRICE',
            'ON_ORDER',
            'GROUP1:ntext',
            'PATTERN1:ntext',
            'PATTERN2:ntext',
            'PATTERN3:ntext',
            'REORDER',
            'MAX',
            'VAT',
            'SUPPLIER',
            'NOTES:ntext',
            'MODEL:ntext',
            'PC:ntext',
            'PQTY',
            'checksum',
            'Supplier2:ntext',
            'Supplier3:ntext',
            'Supplier4:ntext',
            'Supplier5:ntext',
            'Supplier6:ntext',
            'Supplier7:ntext',
            'TradePrice2',
            'TradePrice3',
            'TradePrice4',
            'TradePrice5',
            'TradePrice6',
            'TradePrice7',
            'supPartNo2:ntext',
            'supPartNo3:ntext',
            'supPartNo4:ntext',
            'supPartNo5:ntext',
            'supPartNo6:ntext',
            'supPartNo7:ntext',
            'type',
            '2ndPartNO:ntext',
            'HighLight:ntext',
            'AddNotes',
            'A',
            'B',
            'C',
            'PriceB',
            'trade_price1',
            'URL:ntext',
            'PriceC',
            'PriceD',
            'weight',
        ],
    ]) ?>

</div>
