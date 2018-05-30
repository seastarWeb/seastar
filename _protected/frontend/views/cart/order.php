<?php
//use \yii\helpers\Html;
use yii\widgets\Pjax;
//use \yii\bootstrap\ActiveForm;
use common\models\ProductLineSearch;
use kartik\tabs\TabsX;
use yii\jui\Tabs;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\helpers\Html;
$form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL,'id' => 'contact-form',  'action'=>'order' ],'https');
//$form = ActiveForm::begin( [ 'id' => 'contact-form', 'enableAjaxValidation' => false, 'action'=>'order', ],'https');
$wizard_config = [
    'id' => 'stepwizard',
    'steps' => [
        1 => [
            'title' => 'Basket Details',
            'icon' => 'glyphicon glyphicon-shopping-cart',
            'content' => '<h3>Basket Details</h3>'.$this->render('_basket', ['products' => $products, 'form' => $form]),
            'buttons' => [
                'next' => [
                    'title' => 'Confirm', 
                    'options' => [
                        //'class' => 'disabled'
                    ],
                 ],
             ],
        ],
        2 => [
            'title' => 'Personal Details',
            'icon' => 'glyphicon glyphicon-home',
            'content' => '<h3>Personal Details</h3>'.$this->render('_name_phone', ['model' => $order, 'form' => $form]),

        ],

    ],
    'complete_content' => '<h3>Finance Options</h3>'.$this->render('_payOptions', ['model' => $order, 'form' => $form]),// Optional final screen
    'start_step' => 1, // Optional, start with a specific step
];

?>
<h1>Your order</h1>

<div class="container-fluid">

<?= \drsdre\wizardwidget\WizardWidget::widget($wizard_config); ?>
<?php  
Html::submitButton('Pay Now', ['class' => 'btn btn-success pull-right','value'=>'Pay', 'name'=>'submit']);
ActiveForm::end();  ?>
</div>