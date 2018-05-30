<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\jui\Droppable;
use kartik\widgets\SwitchInput;
use kartik\widgets\Select2;
use kartik\widgets\Typeahead;
use kartik\widgets\ColorInput;
$data = [
    "red" => "red",
    "green" => "green",
    "blue" => "blue",
    "orange" => "orange",
    "white" => "white",
    "black" => "black",
    "purple" => "purple",
    "cyan" => "cyan",
    "teal" => "teal"
];

#colour filter plugin
$colorPluginOptions =  [
'showPalette' => true,
    'showPaletteOnly' => true,
    'showSelectionPalette' => true,
    'showAlpha' => false,
    'allowEmpty' => true,
    'preferredFormat' => 'name',
    'palette' =>[
        [
        "Red",
        "Orange",
        "Yellow",
        "Brown",
        ],
        [
        "Green",
        "Blue",
        "Purple",
        "Black",
        ],
        [
        "Grey",
        "Silver",
        "Gold",
        "White" ,
        ],
    ]
];
/* @var $this yii\web\View */
/* @var $model app\models\TblProductLines */
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

    <?php 
    /*echo  $form->field($model, 'Colours')->textInput(['maxlength' => 255])->widget(Select2::classname(), ['name' => 'color_1',
    'value' => 'red', // initial value
    'data' => $data,
    'options' => ['placeholder' => 'Select a colour ...','multiple' => true],
    'size' => Select2::SMALL,
    'pluginOptions' => [
        'allowClear' => true
    ],
    ]);
    */
     ?>
    <?php
         echo $form->field($model, 'Colours')->widget(ColorInput::classname(), [ 
        'showDefaultPalette' => false,
        'options' => ['placeholder' => 'Select colour ...'],
        'pluginOptions'=>$colorPluginOptions,
        ]);

        echo $form->field($model, 'PartNumbers') ;
        echo '<label class="control-label">Verify Part Numbers Below... then copy and paste the part number only to Part Numbers above</label>';
        echo Typeahead::widget([
            'name' => 'partnumbers',
            'options' => ['placeholder' => 'Filter as you type ...'],
            'scrollable' => true,
            'pluginOptions' => ['highlight'=>true,'minLength'=>3,],
            'pluginEvents' => ["typeahead:selected" => "function(e,datum) { $( '#tblproductlines-partnumbers' ).append(datum.value.concat(',')); }"],
            'dataset' => [
                [
                    'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                    'display' => 'value',
                    'prefetch' => Url::to(['product-line/parts-list']),
                    'limit' => 10,
                    'remote' => [
                        'url'=>Url::to(['product-line/parts-list?q=%QUERY']),
                        'wildcard' => '%QUERY'
                    ],
                ]
            ]
        ]);
    ?>

    <?= $form->field($model, 'Description')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'Url')->textInput(['maxlength' => 100]) ?>
   
    <?= $form->field($model, 'Slug')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model,'Active')->widget(SwitchInput::classname(), ['type' => SwitchInput::CHECKBOX]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
