<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SearchPromotion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-promotion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'promotion') ?>

    <?= $form->field($model, 'promotion_text') ?>

    <?= $form->field($model, 'wef') ?>

    <?= $form->field($model, 'wet') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'imageUrl') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
