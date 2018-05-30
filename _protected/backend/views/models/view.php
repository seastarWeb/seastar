 <?php

use yii\helpers\Html;
//:w
use yii\helpers\ArrayHelper;
use common\models\TblModels;
use common\models\TblModelRange;
use yii\widgets\ActiveForm;
 //use yii\widgets\DetailView;
use kartik\detail\DetailView;
use kartik\tabs\TabsX;
use dosamigos\fileupload\FileUploadUI;
use mihaildev\ckeditor\CKEditor;



/* @var $this yii\web\View */
/* @var $model common\models\Models */

$this->title = $model->model_description;
$this->params['breadcrumbs'][] = ['label' => 'Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$attributes=[
    [
        'attribute'=>'id',
        'format'=>'raw',
        'value'=>'<kbd>'.$model->id.'</kbd>',
        'displayOnly'=>true
    ],];

$js2=<<<JS2
 function showDoner(){
     console.log('show Doner');
     }
JS2;
$this->registerJs($js2);
    ?>
    <script src="<?php echo  \Yii::$app->request->BaseUrl.'/ckeditor/ckeditor.js'; ?>"></script>
<script >
 function setDoner(str){
     console.log('show Doner');
     $('#donerid').val(str)
     }

</script>
<div class="models-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-6">
    <?php
    $form = ActiveForm::begin([
    'method' => 'post',
    'id'=> 'fred',
    'action' => ['models/duplicate'],
    ]);
    $listData= ArrayHelper::map(TblModels::find()->orderBy('model ASC,year DESC')->asArray()->all(), 'id', 'model');
    ?>
    <input type="hidden" id="targetid" name="targetid" value=<?=$model->id ?>>
    <input type="hidden" id="donerid" name="donerid" value=''>
    <?php
    echo $form->field($model,'id')->dropDownList($listData, 
    ['prompt'=>'Choose...','onchange'=>'setDoner(this.value)'])->label('Select Donor Vehicle');
    echo Html::activeHiddenInput($model, 'id',['input' => '#donerid']);
    ?>
</div>
<div class="col-md-6"><br>
<?php    if (Yii::$app->user->can('theCreator'))
	{
    	echo Html::submitButton('Use this model for current model template', ['class' => 'btn btn-primary']);
	}	
    ActiveForm::end();
    ?>
</div>

</div>
    <p>
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
              ['attribute'=>'model_range_id',
              'format'=>'raw',
              'value'=>$model->model_range_id,
              'type'=>DetailView::INPUT_SELECT2, 
              'widgetOptions'=>[
                  'data'=>ArrayHelper::map(TblModelRange::find()->orderBy('model_range')->asArray()->all(), 'id', 'model_range'),
                  'options' => ['placeholder' => 'Select ...'],
                  'pluginOptions' => ['allowClear' => true, 'width' => '100%']
              ],
              'inputContainer' => ['class'=>'col-sm-6']
              ],
              'model_description',
              'make',
              'model',
              'year',
	      ['attribute'=>'model_excerpt',
	      'format'=>'raw',
	      'value'=>$model->model_excerpt,
	      'type'=>DetailView::INPUT_TEXTAREA,
	      'options'=>['rows'=>4]
	      ],
	      //'model_excerpt',
	      'model_image',
        	    ['attribute'=> 'model_page',
                      'format'=>'raw',
                      'value'=> $model->model_page ,
                      'type'=>DetailView::INPUT_TEXTAREA,
                      'options'=>['rows'=>10 ]
        	    ],
		'rrp',
	      'colourway_one',
	      'tfw_one',
	      'colourway_one_rrp',
	      'colourway_two',
	      'tfw_two',
	      'colourway_two_rrp',
	      'colourway_three',
	      'tfw_three',
	      'colourway_three_rrp',
          ],
    ]) ?>
  </p>
<!--Motorcycle model characteristics -->
<div class="row">
      <div class="col-md-6">
      <!-- Chassis -->
      <?= DetailView::widget([
        'model' => $chassis,
        'condensed'=>true,
        'hover'=>true,
        'buttons1'=>'{update}',
        'mode'=>DetailView::MODE_VIEW,
        'panel'=>[
            'heading'=>'Chassis',
    //            'type'=>DetailView::TYPE_INFO,
            ],
        'attributes'=>[
          ['attribute'=>'frame',],
          ['attribute'=>'wheelbase',],
          ['attribute'=>'rake',],
          ['attribute'=>'trail',],
          ['attribute'=>'front_suspension',],
          ['attribute'=>'front_wheel',],
          ['attribute'=>'front_wheel_travel',],
          ['attribute'=>'front_brake',],
          ['attribute'=>'front_tyre',],
          ['attribute'=>'rear_suspsension',],
          ['attribute'=>'rear_wheel_travel',],
          ['attribute'=>'rear_brake',],
          ['attribute'=>'rear_wheel',],
          ['attribute'=>'rear_tyre',],
          ['attribute'=>'fuel_capacity',],
          ['attribute'=>'dry_weight',],
          ['attribute'=>'wet_weight',],
          ['attribute'=>'seat_height',],
          ['attribute'=>'max_height',],
          ['attribute'=>'max_length',],
          ],
      ]) ?>
      </div>
      <div class="col-md-6">
<!-- Engine -->
      <?= DetailView::widget([
          'model' => $engine,
          'condensed'=>true,
          'hover'=>true,
          'buttons1'=>'{update}',
          'mode'=>DetailView::MODE_VIEW,
          'panel'=>[
              'heading'=>'Engine',
  //            'type'=>DetailView::TYPE_WARNING,
              ],
          'attributes' => [
    //          'id',
    //          'model_id',
              ['attribute'=>'type',
              'format'=>'raw',
              'value'=>'<span class="text-justify"><em>' . $engine->type .
              '</em></span>',
              'type'=>DetailView::INPUT_TEXTAREA,
              'options'=>['rows'=>4]
              ],
              ['attribute'=> 'displacement',
                'format'=>'raw',
                'value'=>'<span class="text-justify"><em>' . $engine->displacement .
                '</em></span>',
                'type'=>DetailView::INPUT_TEXTAREA,
                'options'=>['rows'=>2]
              ],
              ['attribute'=>'bore_and_stroke'],
              ['attribute'=>'compression_ratio'],
              ['attribute'=>'power',
              'format'=>'raw',
              'value'=>'<span class="text-justify"><em>' . $engine->bore_and_stroke .
              '</em></span>',
              'type'=>DetailView::INPUT_TEXTAREA,
              'options'=>['rows'=>2]
              ],
              ['attribute'=>'torque'],
              ['attribute'=>'fuel_injection',
              'format'=>'raw',
              'value'=>'<span class="text-justify"><em>' . $engine->fuel_injection .
              '</em></span>',
              'type'=>DetailView::INPUT_TEXTAREA,
              'options'=>['rows'=>4]
              ],
              ['attribute'=>'exaust',
              'format'=>'raw',
              'value'=>'<span class="text-justify"><em>' . $engine->exaust .
              '</em></span>',
              'type'=>DetailView::INPUT_TEXTAREA,
              'options'=>['rows'=>4]
              ],
              ['attribute'=>'emissions'],
              ['attribute'=>'gearbox'],
              ['attribute'=>'ratio',
              'format'=>'raw',
              'value'=>'<span class="text-justify"><em>' . $engine->ratio .
              '</em></span>',
              'type'=>DetailView::INPUT_TEXTAREA,
              'options'=>['rows'=>4]
              ],
              ['attribute'=>'primary_drive',
              'format'=>'raw',
              'value'=>'<span class="text-justify"><em>' . $engine->primary_drive .
              '</em></span>',
              'type'=>DetailView::INPUT_TEXTAREA,
              'options'=>['rows'=>2]
              ],
              ['attribute'=>'final_drive',
              'format'=>'raw',
              'value'=>'<span class="text-justify"><em>' . $engine->final_drive .
              '</em></span>',
              'type'=>DetailView::INPUT_TEXTAREA,
              'options'=>['rows'=>2]
              ],
              [ 'attribute'=>'clutch',
              'format'=>'raw',
              'value'=>'<span class="text-justify"><em>' . $engine->clutch .
              '</em></span>',
              'type'=>DetailView::INPUT_TEXTAREA,
              'options'=>['rows'=>4]
              ],
          ],
      ]) ?>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <!-- General -->
      <?= DetailView::widget([
          'model' => $general,
          'condensed'=>true,
          'hover'=>true,
          'buttons1'=>'{update}',
          'mode'=>DetailView::MODE_VIEW,
          'panel'=>[
              'heading'=>'General',
//              'type'=>DetailView::TYPE_INFO,
              ],
          'attributes'=>[
            ['attribute'=>'instruments',
            'format'=>'raw',
            'value'=>'<span class="text-justify"><em>' . $general->instruments .
            '</em></span>',
            'type'=>DetailView::INPUT_TEXTAREA,
            'options'=>['rows'=>4]
            ],
            ['attribute'=>'warranty',
            'format'=>'raw',
            'value'=>'<span class="text-justify"><em>' . $general->warranty .
            '</em></span>',
            'type'=>DetailView::INPUT_TEXTAREA,
            'options'=>['rows'=>4]
            ],
            ['attribute'=>'maintenance_service_intervals',
            'format'=>'raw',
            'value'=>'<span class="text-justify"><em>' . $general->maintenance_service_intervals .
            '</em></span>',
            'type'=>DetailView::INPUT_TEXTAREA,
            'options'=>['rows'=>4]
            ],
            ['attribute'=>'valve_clearance_check',
            'format'=>'raw',
            'value'=>'<span class="text-justify"><em>' . $general->valve_clearance_check .
            '</em></span>',
            'type'=>DetailView::INPUT_TEXTAREA,
            'options'=>['rows'=>4]
            ],
            ],
      ]) ?>
      </div>
        <div class="col-md-4">
        <?= DetailView::widget([
            'model' => $finance,
            'condensed'=>true,
            'hover'=>true,
            'mode'=>DetailView::MODE_VIEW,
            'buttons1'=>'{update}',
            'panel'=>[
                'heading'=>'Finance Deal',
      //          'type'=>DetailView::TYPE_INFO,
                ],
            'attributes'=>[
                  ['attribute'=>'plan_name',
                  'format'=>'raw',
                  'value'=>'<span class="text-justify"><em>' . $finance->plan_name .
                  '</em></span>',
                  'type'=>DetailView::INPUT_TEXTAREA,
                  'options'=>['rows'=>4]],
                  ['attribute'=>'deposit',
                  'label'=>'Deposit (£)',
                  'format'=>['decimal', 2],
                  'inputWidth' => '40%',
                  ],
                  ['attribute'=>'total_credit',
                    'label'=>'Total Credit (£)',
                    'format'=>['decimal', 2],
                    'inputWidth' => '40%',
                  ],
                  ['attribute'=>'purchase_fee',
                  'format'=>['decimal', 2],
                  'inputWidth' => '40%',
                  ],
                  ['attribute'=>'credit_facility_fee',
                  'format'=>['decimal', 2],
                  'inputWidth' => '40%',
                  ],
                  ['attribute'=>'total_payable',
                  'format'=>['decimal', 2],
                  'inputWidth' => '40%',
                  ],
                  ['attribute'=>'initial_payment',
                  'format'=>['decimal', 2],
                  'inputWidth' => '40%',
                  ],
                  ['attribute'=>'monthly_payments',
                  'format'=>['decimal', 2],
                  'inputWidth' => '40%',
                  ],
                  ['attribute'=>'optional_final_payment',
                  'format'=>['decimal', 2],
                  'inputWidth' => '40%',
                  ],
                  ['attribute'=>'agreement_duration',
                  'inputWidth' => '40%',
                  ],
                  ['attribute'=>'representative_apr',
                  'inputWidth' => '40%',],
                  ['attribute'=>'interest_rate',
                  'inputWidth' => '40%',],
                  ['attribute'=>'date_from',
                  'format'=>'date',
                  'type'=>DetailView::INPUT_DATE,
                  'value'=>$finance->date_from,
                  'widgetOptions' => [
                      'pluginOptions'=>['format'=>'yyyy-mm-dd']
                    ],

                  ],
                  ['attribute'=>'date_to',
                  'format'=>'date',
                  'type'=>DetailView::INPUT_DATE,
                  'value'=>$finance->date_to,
                  'widgetOptions' => [
                      'pluginOptions'=>['format'=>'yyyy-mm-dd']
                    ],

                  ],
                ]]) ?>
              </div>
              <div class="col-md-4">
              <?php
	      /*= DetailView::widget([
                  'model' => $colour,
                  'condensed'=>true,
                  'hover'=>true,
                  'mode'=>DetailView::MODE_VIEW,
                  'panel'=>[
                      'heading'=>'Colours',
          //            'type'=>DetailView::TYPE_INFO,
                      ],
                  'attributes'=>[
                    ['attribute'=>'colour_combinations',
                    'format'=>'raw',
                    'value'=>'<span class="text-justify"><em>' . $colour->colour_combinations .
                    '</em></span>',
                    'type'=>DetailView::INPUT_TEXTAREA,
                    'options'=>['rows'=>4]
                    ],
                    ['attribute'=>'tank_frame_wheels',
                    'format'=>'raw',
                    'value'=>'<span class="text-justify"><em>'.$colour->tank_frame_wheels .'</em></span>',
                    'type'=>DetailView::INPUT_TEXTAREA,
                    'options'=>['rows'=>4]],
                    ['attribute'=>'colour_option',
                    'format'=>'raw',
                    'value'=>'<span class="text-justify"><em>' . $colour->colour_option .
                    '</em></span>',
                    'type'=>DetailView::INPUT_TEXTAREA,
                    'options'=>['rows'=>4]]
                    ],
              ])
	      */?>
              </div>
      </div>
<?php
    echo FileUploadUI::widget([
      'model' => $imgmodel,
      'attribute' => 'files',
      'url' => ['models/upload', 'id' => $model->id],
      'gallery' => false,
      'fieldOptions' => [
      'accept' => 'image/*'
      ],
      'clientOptions' => [
      'maxFileSize' => 2000000
      ],
      // ...
      'clientEvents' => [
      'fileuploaddone' => 'function(e, data) {
                          console.log(e);
                          console.log(data);
                      }',
      'fileuploadfail' => 'function(e, data) {
                          console.log(e);
                          console.log(data);
                      }',
      ],
    ]);
?>

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
CKEDITOR.replace('models-model_page',{
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

