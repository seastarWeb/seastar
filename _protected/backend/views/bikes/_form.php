<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\fileupload\FileUploadUI;
/* @var $this yii\web\View */
/* @var $model common\models\Bikes */
/* @var $form yii\widgets\ActiveForm */
?>

<div>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'make')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => 28]) ?>

    <?= $form->field($model, 'colour')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 391]) ?>

    <?= $form->field($model, 'mileage')->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, '1st_reg_date')->textInput(['maxlength' => 16]) ?>

    <?= $form->field($model, 'display_price')->textInput(['maxlength' => 7]) ?>


<?php 
/*

    <?= $form->field($model, 'frame_no')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'engine_no')->textInput(['maxlength' => 26]) ?>

    <?= $form->field($model, 'cc')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'purchase_date')->textInput(['maxlength' => 16]) ?>

    <?= $form->field($model, 'from')->textInput() ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => 6]) ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, 'sale_date')->textInput(['maxlength' => 16]) ?>

    <?= $form->field($model, 'sale_price')->textInput(['maxlength' => 3]) ?>

    <?= $form->field($model, 'sold')->textInput() ?>

    
    <?= $form->field($model, 'purchase_price')->textInput(['maxlength' => 7]) ?>

    <?= $form->field($model, 'min_price')->textInput(['maxlength' => 7]) ?>

    <?= $form->field($model, 'catagory')->textInput(['maxlength' => 18]) ?>

    <?= $form->field($model, 'reg')->textInput(['maxlength' => 8]) ?>

    <?= $form->field($model, 'spent')->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, 'sold_to')->textInput() ?>

    <?= $form->field($model, 'invoice_in')->textInput() ?>

    <?= $form->field($model, 'holding')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'invoice_out')->textInput() ?>

    <?= $form->field($model, 'MISC1')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'MISC2')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'MISC3')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'MISC4')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'MISC5')->textInput(['maxlength' => 8]) ?>

    <?= $form->field($model, 'MMISC1')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'MMISC2')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'MMISC3')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'trim')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'mot')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'door')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'ignition')->textInput(['maxlength' => 8]) ?>

    <?= $form->field($model, 'plan')->textInput(['maxlength' => 3]) ?>

    <?= $form->field($model, 'siv')->textInput(['maxlength' => 6]) ?>

    <?= $form->field($model, 'plan_date')->textInput(['maxlength' => 16]) ?>

    <?= $form->field($model, 'fuel')->textInput(['maxlength' => 6]) ?>

    <?= $form->field($model, 'warranty')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'wdate')->textInput(['maxlength' => 16]) ?>

    <?= $form->field($model, 'nominal')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'transferred')->textInput() ?>

    <?= $form->field($model, 'nominal_in')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'dateEdit')->textInput(['maxlength' => 16]) ?>

    <?= $form->field($model, 'timeEdit')->textInput(['maxlength' => 16]) ?>

    <?= $form->field($model, 'vehicleClass')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'category')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'supplierRef')->textInput(['maxlength' => 8]) ?>

    <?= $form->field($model, 'A')->textInput() ?>

    <?= $form->field($model, 'B')->textInput() ?>

    <?= $form->field($model, 'C')->textInput() ?>

    <?= $form->field($model, 'details')->textInput(['maxlength' => 109]) ?>

    <?= $form->field($model, 'regfee')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'roadtax')->textInput(['maxlength' => 1]) ?>
*/
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
