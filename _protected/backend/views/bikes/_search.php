<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BikeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bikes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'make') ?>

    <?= $form->field($model, 'model') ?>

    <?= $form->field($model, 'colour') ?>

    <?= $form->field($model, 'frame_no') ?>

    <?= $form->field($model, 'engine_no') ?>

    <?php // echo $form->field($model, 'cc') ?>

    <?php // echo $form->field($model, 'mileage') ?>

    <?php // echo $form->field($model, '1st_reg_date') ?>

    <?php // echo $form->field($model, 'purchase_date') ?>

    <?php // echo $form->field($model, 'from') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php  echo $form->field($model, 'id') ?>

    <?php // echo $form->field($model, 'sale_date') ?>

    <?php // echo $form->field($model, 'sale_price') ?>

    <?php // echo $form->field($model, 'sold') ?>

    <?php // echo $form->field($model, 'display_price') ?>

    <?php // echo $form->field($model, 'purchase_price') ?>

    <?php // echo $form->field($model, 'min_price') ?>

    <?php // echo $form->field($model, 'catagory') ?>

    <?php  echo $form->field($model, 'reg') ?>

    <?php // echo $form->field($model, 'spent') ?>

    <?php // echo $form->field($model, 'sold_to') ?>

    <?php // echo $form->field($model, 'invoice_in') ?>

    <?php // echo $form->field($model, 'holding') ?>

    <?php // echo $form->field($model, 'invoice_out') ?>

    <?php // echo $form->field($model, 'MISC1') ?>

    <?php // echo $form->field($model, 'MISC2') ?>

    <?php // echo $form->field($model, 'MISC3') ?>

    <?php // echo $form->field($model, 'MISC4') ?>

    <?php // echo $form->field($model, 'MISC5') ?>

    <?php // echo $form->field($model, 'MMISC1') ?>

    <?php // echo $form->field($model, 'MMISC2') ?>

    <?php // echo $form->field($model, 'MMISC3') ?>

    <?php // echo $form->field($model, 'trim') ?>

    <?php // echo $form->field($model, 'mot') ?>

    <?php // echo $form->field($model, 'door') ?>

    <?php // echo $form->field($model, 'ignition') ?>

    <?php // echo $form->field($model, 'plan') ?>

    <?php // echo $form->field($model, 'siv') ?>

    <?php // echo $form->field($model, 'plan_date') ?>

    <?php // echo $form->field($model, 'fuel') ?>

    <?php // echo $form->field($model, 'warranty') ?>

    <?php // echo $form->field($model, 'wdate') ?>

    <?php // echo $form->field($model, 'nominal') ?>

    <?php // echo $form->field($model, 'transferred') ?>

    <?php // echo $form->field($model, 'nominal_in') ?>

    <?php // echo $form->field($model, 'dateEdit') ?>

    <?php // echo $form->field($model, 'timeEdit') ?>

    <?php // echo $form->field($model, 'vehicleClass') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'supplierRef') ?>

    <?php // echo $form->field($model, 'A') ?>

    <?php // echo $form->field($model, 'B') ?>

    <?php // echo $form->field($model, 'C') ?>

    <?php // echo $form->field($model, 'details') ?>

    <?php // echo $form->field($model, 'regfee') ?>

    <?php // echo $form->field($model, 'roadtax') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
