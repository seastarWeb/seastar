<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\TblProductLines;
use common\models\ProductLineSearch;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\ProductLineSearch */
/* @var $form yii\widgets\ActiveForm */

$dataDept=['accessories'=>'Accessories','clothing'=>'Clothing'] ;
$dataFitment=['female'=>'Female','male'=>'Male'] ;

$cats=array();
$cats=ArrayHelper::map(TblProductLines::find()->select('Category')->orderBy('Category')->distinct()->where(['Department'=>'Accessories','Brand'=>'Ducati'])->all(), 'Category', 'Category');

$brands=ProductLineSearch::getDistinctBrands();
$marques = array();
foreach ($brands as $key => $value) {
    # code...
    foreach ($value as $i => $j) {
        $marques[] = [$j=>$j];
    }
}

//var_dump($dogs);
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
?>

<div class="tbl-product-lines-search">
    <?php 
        \yii\widgets\Pjax::begin();
        $form = ActiveForm::begin([
            'action' => ['browse'],
            'method' => 'get',
        ]); 
    ?>

    <?php // $form->field($model, 'Brand')->dropdownList($marques,['prompt'=>'Any']) ?>

    <?= $form->field($model, 'Category')->dropDownList($cats,['prompt'=>'Any category...']) ?>

    <?php // echo $form->field($model, 'Colours') ?>

    <?php // echo $form->field($model, 'Fitment')->dropdownList($dataFitment,['prompt'=>'All...']) ?>

    <?php  echo $form->field($model, 'Description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php 
        ActiveForm::end(); 
        \yii\widgets\Pjax::end();
    ?>
</div>
