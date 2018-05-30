<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;
use dosamigos\fileupload\FileUploadUI;

/* @var $this yii\web\View */
/* @var $model common\models\Bikes */

$this->title = 'Update Bikes: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bikes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bikes-update">

    <h1><?= Html::encode($this->title) ?></h1>
 	<?php	echo TabsX::widget([
    'items' => [
        [
        'label'=>'<span>Bike Specifications</span> ',
        'content'=> $this->render('_form', [
        'model' => $model,
        'imgmodel'=>$imgmodel,
    		]),
        'active'=>true
        ],
		[
		'label'=>'Images',
		'content'=>FileUploadUI::widget([
			'model' => $imgmodel,
			'attribute' => 'files',
			'url' => ['bikes/upload', 'id' => $model->id],
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
		]),
		'active'=> false
		],
  
    	],
    'position'=>TabsX::POS_ABOVE,
    'align'=>TabsX::ALIGN_LEFT,
    'bordered'=>false,
    'encodeLabels'=>false]);
 	 ?>

</div>
