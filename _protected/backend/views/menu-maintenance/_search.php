<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SearchMenu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-maintenance-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'pid') ?>

    <?= $form->field($model, 'menu') ?>

    <?= $form->field($model, 'metadesc') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'page') ?>

    <?php // echo $form->field($model, 'template') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'version') ?>

    <?php // echo $form->field($model, 'URL') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
