<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DeepBlueParts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="deep-blue-parts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PARTNO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DESCRIPTION')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'PRICE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REFERNO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OBSOLETE')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'STOCK_LEVEL')->textInput() ?>

    <?= $form->field($model, 'BIN')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'TRADE_PRICE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ON_ORDER')->textInput() ?>

    <?= $form->field($model, 'GROUP1')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'PATTERN1')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'PATTERN2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'PATTERN3')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'REORDER')->textInput() ?>

    <?= $form->field($model, 'MAX')->textInput() ?>

    <?= $form->field($model, 'VAT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SUPPLIER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOTES')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'MODEL')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'PC')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'PQTY')->textInput() ?>

    <?= $form->field($model, 'checksum')->textInput() ?>

    <?= $form->field($model, 'Supplier2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Supplier3')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Supplier4')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Supplier5')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Supplier6')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Supplier7')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'TradePrice2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TradePrice3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TradePrice4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TradePrice5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TradePrice6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TradePrice7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'supPartNo2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'supPartNo3')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'supPartNo4')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'supPartNo5')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'supPartNo6')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'supPartNo7')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, '2ndPartNO')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'HighLight')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'AddNotes')->textInput() ?>

    <?= $form->field($model, 'A')->textInput() ?>

    <?= $form->field($model, 'B')->textInput() ?>

    <?= $form->field($model, 'C')->textInput() ?>

    <?= $form->field($model, 'PriceB')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trade_price1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'URL')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'PriceC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PriceD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
