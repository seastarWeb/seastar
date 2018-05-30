<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SearchDeepBlue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="deep-blue-parts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'partid') ?>

    <?= $form->field($model, 'PARTNO') ?>

    <?= $form->field($model, 'DESCRIPTION') ?>

    <?= $form->field($model, 'PRICE') ?>

    <?= $form->field($model, 'REFERNO') ?>

    <?php // echo $form->field($model, 'OBSOLETE') ?>

    <?php // echo $form->field($model, 'STOCK_LEVEL') ?>

    <?php // echo $form->field($model, 'BIN') ?>

    <?php // echo $form->field($model, 'TRADE_PRICE') ?>

    <?php // echo $form->field($model, 'ON_ORDER') ?>

    <?php // echo $form->field($model, 'GROUP1') ?>

    <?php // echo $form->field($model, 'PATTERN1') ?>

    <?php // echo $form->field($model, 'PATTERN2') ?>

    <?php // echo $form->field($model, 'PATTERN3') ?>

    <?php // echo $form->field($model, 'REORDER') ?>

    <?php // echo $form->field($model, 'MAX') ?>

    <?php // echo $form->field($model, 'VAT') ?>

    <?php // echo $form->field($model, 'SUPPLIER') ?>

    <?php // echo $form->field($model, 'NOTES') ?>

    <?php // echo $form->field($model, 'MODEL') ?>

    <?php // echo $form->field($model, 'PC') ?>

    <?php // echo $form->field($model, 'PQTY') ?>

    <?php // echo $form->field($model, 'checksum') ?>

    <?php // echo $form->field($model, 'Supplier2') ?>

    <?php // echo $form->field($model, 'Supplier3') ?>

    <?php // echo $form->field($model, 'Supplier4') ?>

    <?php // echo $form->field($model, 'Supplier5') ?>

    <?php // echo $form->field($model, 'Supplier6') ?>

    <?php // echo $form->field($model, 'Supplier7') ?>

    <?php // echo $form->field($model, 'TradePrice2') ?>

    <?php // echo $form->field($model, 'TradePrice3') ?>

    <?php // echo $form->field($model, 'TradePrice4') ?>

    <?php // echo $form->field($model, 'TradePrice5') ?>

    <?php // echo $form->field($model, 'TradePrice6') ?>

    <?php // echo $form->field($model, 'TradePrice7') ?>

    <?php // echo $form->field($model, 'supPartNo2') ?>

    <?php // echo $form->field($model, 'supPartNo3') ?>

    <?php // echo $form->field($model, 'supPartNo4') ?>

    <?php // echo $form->field($model, 'supPartNo5') ?>

    <?php // echo $form->field($model, 'supPartNo6') ?>

    <?php // echo $form->field($model, 'supPartNo7') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, '2ndPartNO') ?>

    <?php // echo $form->field($model, 'HighLight') ?>

    <?php // echo $form->field($model, 'AddNotes') ?>

    <?php // echo $form->field($model, 'A') ?>

    <?php // echo $form->field($model, 'B') ?>

    <?php // echo $form->field($model, 'C') ?>

    <?php // echo $form->field($model, 'PriceB') ?>

    <?php // echo $form->field($model, 'trade_price1') ?>

    <?php // echo $form->field($model, 'URL') ?>

    <?php // echo $form->field($model, 'PriceC') ?>

    <?php // echo $form->field($model, 'PriceD') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
