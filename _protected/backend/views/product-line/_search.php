<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductLineSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-product-lines-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'Department') ?>

    <?= $form->field($model, 'Brand') ?>

    <?= $form->field($model, 'Category') ?>

    <?= $form->field($model, 'SubCategory') ?>
    
    <?php  echo $form->field($model, 'Colours') ?>

    <?php  echo $form->field($model, 'Sizes') ?>

    <?php // echo $form->field($model, 'ProductLine') ?>

    <?php // echo $form->field($model, 'DefaultImage') ?>

    <?php // echo $form->field($model, 'Fitment') ?>

    <?php // echo $form->field($model, 'PartNumbers') ?>

    <?php // echo $form->field($model, 'Description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
