<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchDeepBlue */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Deep Blue Parts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deep-blue-parts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Deep Blue Parts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn'],
            //'partid',
            'PARTNO',
            'SUPPLIER',
            'DESCRIPTION:ntext',
            'PRICE',
            'REFERNO',
            // 'OBSOLETE:ntext',
            // 'STOCK_LEVEL',
            // 'BIN:ntext',
            // 'TRADE_PRICE',
            // 'ON_ORDER',
            // 'GROUP1:ntext',
            // 'PATTERN1:ntext',
            // 'PATTERN2:ntext',
            // 'PATTERN3:ntext',
            // 'REORDER',
            // 'MAX',
            // 'VAT',
            // 'NOTES:ntext',
            // 'MODEL:ntext',
            // 'PC:ntext',
            // 'PQTY',
            // 'checksum',
            // 'Supplier2:ntext',
            // 'Supplier3:ntext',
            // 'Supplier4:ntext',
            // 'Supplier5:ntext',
            // 'Supplier6:ntext',
            // 'Supplier7:ntext',
            // 'TradePrice2',
            // 'TradePrice3',
            // 'TradePrice4',
            // 'TradePrice5',
            // 'TradePrice6',
            // 'TradePrice7',
            // 'supPartNo2:ntext',
            // 'supPartNo3:ntext',
            // 'supPartNo4:ntext',
            // 'supPartNo5:ntext',
            // 'supPartNo6:ntext',
            // 'supPartNo7:ntext',
            // 'type',
            // '2ndPartNO:ntext',
            // 'HighLight:ntext',
            // 'AddNotes',
            // 'A',
            // 'B',
            // 'C',
            // 'PriceB',
            // 'trade_price1',
            // 'URL:ntext',
            // 'PriceC',
            // 'PriceD',
            // 'weight',

           
        ],
    ]); ?>

</div>
