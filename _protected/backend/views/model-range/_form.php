<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model common\models\TblModelRange */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-model-range-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'model_range')->textInput(['maxlength' => 150]) ?>
    <?= $form->field($model, 'alias')->textInput(['maxlength' => 150]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


  
</div>
