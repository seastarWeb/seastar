<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\ProductLineSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-product-lines-search">
   <?php Pjax::begin();?>
    <?php $form = ActiveForm::begin([
        'action' => ['my'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Category') ?>
    <?php  echo $form->field($model, 'ProductLine') ?>
    <?php  echo $form->field($model, 'Description') ?>

    <div class="form-group"> 
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
   <?php Pjax::end();?>
</div>
