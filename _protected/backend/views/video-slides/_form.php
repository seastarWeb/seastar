<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\TblModels;

$mods=ArrayHelper::map(TblModels::find()->orderBy('model,year DESC,model')->asArray()->all(), 'id', 'model');
/* @var $this yii\web\View */
/* @var $model common\models\TblVideoslides */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-videoslides-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'vid')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'href')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'youtube')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'poster')->textInput(['maxlength' => true]) ?>

    <?php
//var_dump($model);
     echo $form->field($model, 'model_id')->textInput()->dropDownList($mods, ['prompt'=>'Choose...','onchange'=>'setDoner(this.value)'])->label('Select Donor Vehicle');
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
