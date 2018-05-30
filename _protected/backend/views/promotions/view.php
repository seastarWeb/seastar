<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;
/* @var $this yii\web\View */
/* @var $model common\models\TblPromotion */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Promotions', 'url' => ['index']];
?>
<div class="tbl-promotion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
         <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'condensed'=>true,
        'hover'=>true,
        'buttons1'=>'{update}',
        'mode'=>DetailView::MODE_VIEW,
        'panel'=>[
            'heading'=>'Ducati Model',
            ],
          'attributes' => [
                'id',
                'promotion',
                'wef',
                'wet',
                'created',
                'imageUrl:url',
                ['attribute'=> 'promotion_text',
                      'format'=>'html',
                      'value'=> $model->promotion_text ,
                      'type'=>DetailView::INPUT_TEXTAREA,
                      'options'=>['rows'=>10 ]
                ]
          ],
    ]) ?>


</div>
<?php
$js = <<<JS
// get the form id and set the event
    $('#fred').on('beforeSubmit', function(e) {
     var \$form = $(this);

    var r = confirm("You are about to replace the values in THIS engine, chassis, finance etc with those you have selected in the drop down list!");
    if (r==true)
            {alert ("For reasons I cannot fathom you may need to run this twice!")}
    else 
        {alert("Wimped out eh?");
            e.preventDefault();
                e.stopImmediatePropagation();
        
        }
   // do whatever here, see the parameter \$form? is a jQuery Element to your form
    }).on('submit', function(e){
    if (r==false)
            {
        alert ("Cancelled!");
            e.preventDefault();
                e.stopImmediatePropagation();
        }

    });

CKEDITOR.replace( 'tblpromotion-promotion_text',{
filebrowserBrowseUrl: '/kcfinder/browse.php?type=files',
filebrowserImageBrowseUrl: '/kcfinder/browse.php?type=images',
filebrowserFlashBrowseUrl: '/kcfinder/browse.php?type=flash',
filebrowserUploadUrl: '/kcfinder/upload.php?type=files',
filebrowserImageUploadUrl: '/kcfinder/upload.php?type=images',
filebrowserFlashUploadUrl: '/kcfinder/upload.php?type=flash'
}
);


JS;
$this->registerJs($js);
