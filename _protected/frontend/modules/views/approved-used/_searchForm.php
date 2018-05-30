<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use common\models\Bikes;
$marquelist = array('Aprilia'=>'Aprilia','bmw'=>'BMW','ducati'=>'Ducati','harley'=>'Harley Davidson','honda'=>'Honda','kawasaki'=>'Kawasaki','moto'=>'Moto Guzzi','suzuki'=>'Suzuki','triumph'=>'Triumph','yamaha'=>'Yamaha');

?>
<div style="width:50%; display: inline-block">
    <div class="tbl-product-lines-search">
    <?php \yii\widgets\Pjax::begin(); ?>
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); ?>
        <?php echo $form->field($model, 'make')->dropdownList($marquelist,['Make'=>'Make','prompt'=>'Any marque']) ?>
        <?php  echo $form->field($model, 'description') ?>
        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    <?php \yii\widgets\Pjax::end(); ?>
    </div>
</div>