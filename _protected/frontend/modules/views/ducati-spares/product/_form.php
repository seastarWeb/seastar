<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'part_no')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'shortdesc')->textInput(['maxlength' => 160]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pricenett')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'taxcode')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'defaultimage')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'imagelocation')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'imagename')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'brand')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'fitment')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'sku')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'category')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'subcat')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
