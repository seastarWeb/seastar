<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TblProductLines */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-product-lines-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Department')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'Brand')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'Category')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'SubCategory')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'ProductLine')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'DefaultImage')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'Fitment')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'PartNumbers')->textInput(['maxlength' => 400]) ?>

    <?= $form->field($model, 'Description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
