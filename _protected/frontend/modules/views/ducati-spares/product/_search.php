<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'part_id') ?>

    <?= $form->field($model, 'part_no') ?>

    <?= $form->field($model, 'shortdesc') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'pricenett') ?>

    <?php // echo $form->field($model, 'taxcode') ?>

    <?php // echo $form->field($model, 'defaultimage') ?>

    <?php // echo $form->field($model, 'imagelocation') ?>

    <?php // echo $form->field($model, 'imagename') ?>

    <?php // echo $form->field($model, 'brand') ?>

    <?php // echo $form->field($model, 'fitment') ?>

    <?php // echo $form->field($model, 'sku') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'subcat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
