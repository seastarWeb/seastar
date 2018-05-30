<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\jui\Draggable;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Button;
use kartik\widgets\Typeahead;
use common\models\DeepBlueParts;
use yii\helpers\Url;
use kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\TblProductLines */

$this->title = 'Update Tbl Product Lines: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Product Lines', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-product-lines-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <?php   


?>
</div>
<?php
$js = <<<JS
 function showValues() {
     var fields = $( ":checkbox" ).serializeArray();
     $( "#results" ).empty();
     jQuery.each( fields, function( i, field ) {
         $( "#results" ).append( field.value + " " );
         });
 }
$( ":checkbox"  ).click( showValues );
$(document).on('pjax:send', function() {
      $('#loading').show()
      })
$(document).on('pjax:complete', function() {
      $('#loading').hide()
      })
$(document).ready(function(){
    $('#checkFilterButton').click(function(){
        var modelranges = {};
        modelranges = $('#checkboxFilter').yiiGridView('getSelectedRows');

        if (jQuery.isEmptyObject(modelranges)){
             console.log('Nothing selected')}else
        {
        console.log (modelranges);
        console.log (JSON.stringify(modelranges));
        $.ajax({
        url:'/models/checks',
        dataType: 'json',
        data: {range:modelranges },
        success:function(data){
            console.log(data);
            var pathname = window.location.href;
            console.log(pathname);
            if(1==1){
                $.pjax.defaults.timeout = false;//IMPORTANT
                // $.pjax.reload({url:pathname, container:'#resultSet'});
            }else if(data.status == 'failed'){
                alert("Error on query!");
                }
            },
        });}
    })
})
JS;
$this->registerJs($js);