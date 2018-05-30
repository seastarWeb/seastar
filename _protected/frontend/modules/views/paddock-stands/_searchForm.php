<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
//use kartik\color\ColorInput;
use kartik\widgets\ColorInput;
use common\models\TblProductLines;
use common\models\ProductLineSearch;
use kartik\widgets\DepDrop;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\ProductLineSearch */
/* @var $form yii\widgets\ActiveForm */

    function toLabel($value)
    {
        return ucwords(strtolower($value));   
    }





$dataDept=['accessories'=>'Accessories','clothing'=>'Clothing'] ;
$dataFitment=['female'=>'Female','male'=>'Male'] ;
$cats=array();
$cats=ArrayHelper::map(TblProductLines::find()->select('Category')->orderBy('Category')->distinct()->all(), 'Category', 'Category');
# Makes for dropdown
$marques = array();
$marques=ArrayHelper::map(TblProductLines::find()->select('Brand')->distinct()->orderBy('Brand')->all(), 'Brand', 'Brand');
#format brands all init capped lowercase
$brands=array_map("toLabel", $marques);
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
?>

<div class="tbl-product-lines-search">
<?php \yii\widgets\Pjax::begin(); ?>
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Brand')->dropdownList($brands,['prompt'=>'Any','id'=>'brand']) ?>
    <?php echo $form->field($model, 'Category')->widget(DepDrop::classname(), [
    'options'=>['id'=>'Cat'],
    'pluginOptions'=>[
        'depends'=>['brand'],
        'placeholder'=>'Select...',
        'url'=>Url::to(['/shop/brandcats'])
    ]]);
    ?>
    <?php // $form->field($model, 'Category')->dropDownList($cats,['Category'=>'Category','prompt'=>'Any category...']) ?>


    <?php  echo $form->field($model, 'Colours')->widget(ColorInput::classname(), [ 
    'showDefaultPalette' => false,
    'options' => ['placeholder' => 'Select colour ...'],
    'pluginOptions'=>$colorPluginOptions,
        ]);
    ?>
    <?php  echo $form->field($model, 'Fitment')->dropdownList($dataFitment,['prompt'=>'All...']) ?>
    <?php  echo $form->field($model, 'Description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>
    <?php ActiveForm::end(); ?>
<?php \yii\widgets\Pjax::end(); ?>
</div>
