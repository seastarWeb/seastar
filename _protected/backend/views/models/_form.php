<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\TblModelRange;
/* @var $this yii\web\View */
/* @var $model common\models\Models */
/* @var $form yii\widgets\ActiveForm */
$listData= ArrayHelper::map(TblModelRange::find()->orderBy('model_range DESC')->asArray()->all(), 'id', 'model_range');
?>

<div class="models-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model,'model_range_id')->dropDownList($listData, ['prompt'=>'Choose...']); ?>
    
    <?= $form->field($model, 'model_description')->textInput(['maxlength' => 100]) ?>


    <?= $form->field($model, 'make')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => 4]) ?>
    <?= $form->field($model, 'rrp')->textInput(['maxlength' => 5]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
