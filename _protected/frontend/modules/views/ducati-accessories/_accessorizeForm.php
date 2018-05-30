<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\TblProductLines;
use common\models\Models;
use common\models\ProductLineSearch;
use yii\helpers\Url;
use kartik\widgets\Typeahead;
use yii\widgets\Pjax;
use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\ProductLineSearch */
/* @var $form yii\widgets\ActiveForm */
# Makes for dropdown
$marques = array();
$marques=ArrayHelper::map(Models::find()->select('make')->distinct()->orderBy('make')->all(), 'make', 'make');


?>

<div class="tbl-product-lines-search">
    
    <?php 
        \yii\widgets\Pjax::begin();
        $form = ActiveForm::begin([
            'action' => ['browse'],
            'method' => 'get',
        ]); 
      



        echo Typeahead::widget([
            'name' => 'models',
            'options' => ['placeholder' => 'Filter as you type ...'],
            'scrollable' => true,
            'pluginOptions' => ['highlight'=>true,'minLength'=>5,],
            'pluginEvents' => ["typeahead:selected" => "function(e,datum) { $( '#tblproductlines-models' ).append(datum.value.concat(',')); }"],
            'dataset' => [
                [
                    'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                    'display' => 'value',
                    'prefetch' => Url::to(['accessorize/model']),
                    'limit' => 10,
                    'remote' => [
                        'url'=>Url::to(['accessorize/model?q=%QUERY']),
                        'wildcard' => '%QUERY'
                    ],
                ]
            ]
        ]);


    ?>
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php 
        ActiveForm::end(); 
        \yii\widgets\Pjax::end();
    ?>
</div>
