<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
 use kartik\widgets\SwitchInput;
 use frontend\models\TblMenu;
 use common\models\TblModelRange;
use mihaildev\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model common\models\Models */
/* @var $form yii\widgets\ActiveForm */
$listData= ArrayHelper::map(TblModelRange::find()->orderBy('model_range DESC')->asArray()->all(), 'id', 'model_range');
 
//use iutbay\yii2kcfinder\KCFinderInputWidget;
//use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuMaintenance */
/* @var $form yii\widgets\ActiveForm */
$parents=ArrayHelper::map(TblMenu::find()->orderBy('menu')->asArray()->all(), 'id', 'menu');
//$parents = MenuMaintenance::getMenu();

?>


<div class="menu-maintenance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //= $form->field($model, 'pid')->textInput() ?>

    <?= $form->field($model, 'pid')->textInput()->dropdownList($parents,['prompt'=>'Any','id'=>'menu']) ?>

    <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [    'type' => SwitchInput::CHECKBOX]); ?> 

    <?= $form->field($model, 'menu')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'metadesc')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 200]) ?>
   
    <?= $form->field($model, 'excerpt')->widget(CKEditor::className(), ['editorOptions' => [ 'preset' => 'full', 'inline' => false]]); ?>
    <?= $form->field($model, 'page')->widget(CKEditor::className(), ['editorOptions' => [ 'preset' => 'full', 'inline' => false]]); ?>

    <?php // $form->field($model, 'status')->textInput() ?>


    <?= $form->field($model, 'URL')->textInput(['maxlength' => 255]) ?>
    
    <?= $form->field($model, 'imagelocation')->textInput(['maxlength' => 255]) ?>

    <?php // $form->field($model, 'template')->textInput(['maxlength' => 100]) ?>

    <?php // $form->field($model, 'version')->textInput() ?>

    <?= $form->field($model, 'model_range_id')->textInput()->dropdownList($listData,['prompt'=>'Any','id'=>'model_range'])  ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
