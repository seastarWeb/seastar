<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;
use dosamigos\fileupload\FileUploadUI;
/* @var $this yii\web\View */
/* @var $model backend\models\MenuMaintenance */

$this->title = 'Update Menu Maintenance: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Menu Maintenance', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

?>

<div class="menu-maintenance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // $this->render('_form', [        'model' => $model,    ]) ?>

</div>
 	<?php	echo TabsX::widget([
    'items' => [
    	['label' =>'Menu Navigation Elements',
    	'content'=>$this->render('_form', [
        	'model' => $model,]), 
    	'active'=> true
    	],
		[
		'label'=>'Upload Image for '.$model->menu.'',
		'content'=>FileUploadUI::widget([
			'model' => $imgmodel,
			'attribute' => 'files',
			'url' => ['menu-maintenance/upload', 'id' => $model->id],
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