<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
// use yii\grid\GridView;
use common\models\TblModelRange;
use common\models\TblModels;
use kartik\tabs\TabsX;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchModels */
/* @var $dataProvider yii\data\ActiveDataProvider */

$make = Yii::$app->controller->module->id;
$this->title = $model->model_description;
$this->params['breadcrumbs'][] = ['label' => ucfirst($make), 'url' => ['/'.$make.'/ ']];
$this->params['breadcrumbs'][] = ['label' => ucfirst($make).' Models', 'url' => ['/'.$make.'/models/ ']];
$this->params['breadcrumbs'][]=$model->model;
$images1=TblModels::getModelImages($model->id,1);
$images2=TblModels::getModelImages($model->id,0);
//$images1='';
//$images2='';
$chassis=$model->chasses;

?>

<div class="models-index">
<h1><?= Html::encode($this->title) ?></h1>
        <?php echo TabsX::widget([
        'items' => [
            [
            'label'=>'Gallery',
            'content'=> '<label>Click for full screen version..</label>'.Slick::widget([

                    // HTML tag for container. Div is default.
                    'itemContainer' => 'div',
                    
                    // HTML attributes for widget container
                    'containerOptions' => ['class' => 'slick-nav'],
                    
                    // Items for carousel. Empty array not allowed, exception will be throw, if empty 
                    'items' => $images1,

                    // HTML attribute for every carousel item
                    'itemOptions' => ['class' => 'model-image'],

                    
                    // settings for js plugin
                    // @see http://kenwheeler.github.io/slick/#settings
                        'clientOptions' => [
                            'dots'     => true,
                            'speed'    => 300,
                            'autoplay' => true,
                            'infinite' =>  true,
                            'slidesToShow' => 4,
                            'slidesToScroll' => 1,
                            'asNavFor'=> 'single-item',
                            'responsive' => [
                                [
                                    'breakpoint' => 1200,
                                    'settings' => [
                                        'slidesToShow' => 4,
                                        'slidesToScroll' => 1,
                                        'infinite' => true,
                                        'autoplay' => true,
                                        'dots' => true,
                                    ],
                                ],
                                [
                                    'breakpoint' => 992,
                                    'settings' => [
                                        'slidesToShow' => 3,
                                        'slidesToScroll' => 1,
                                        'infinite' => true,
                                        'autoplay' => true,
                                        'dots' => true,
                                    ],
                                ],
                                [
                                    'breakpoint' => 768,
                                    'settings' => [
                                        'slidesToShow' => 2,
                                        'slidesToScroll' => 1,
                                        'infinite' => true,
                                        'autoplay' => true,
                                        'dots' => true,
                                    ],
                                ],
                                [
                                    'breakpoint' => 480,
                                    'settings' => 'unslick', // Destroy carousel, if screen width less than 480px
                                ],

                            ],
                        // note, that for params passing function you should use JsExpression object
                        'onAfterChange' => new JsExpression('function() {console.log("The cat has shown")}'),
                    ],    
                    ]),
            'active'=> true],
            [
            'label'=>'Full Description',
            'content'=>  DetailView::widget([
                'model' => $model,
                'attributes'=>[
                'title'=>'model_page:html',
                ],
                ])
            ,
            'active'=> false],
            [
            'label'=>'Colours',
            'content'=> DetailView::widget([
              'model' => $model,
              'attributes' => [
                ['label'=>'Colour', 'value'=> $model->colours[0]->colour_combinations,],
                ['label'=>'Colour Option', 'value'=> $model->colours[0]->colour_option,],
                ['label'=>'Tank Frame Wheels', 'value'=> $model->colours[0]->tank_frame_wheels,],
              ],
              ]),
            'active'=> false],
            [
            'label'=>'Specification',
            'content'=>  '<h3>General</h3>'.
                DetailView::widget([
                  'model' => $model,
                  'attributes' => [
                    ['label'=> 'Instruments','value' =>  $model->generals[0]->instruments,],
                    ['label'=> 'Warranty','value' =>  $model->generals[0]->warranty,],
                    ['label'=> 'Service Interval','value' =>  $model->generals[0]->maintenance_service_intervals,],
                    ['label'=> 'Valve Clearance','value' =>  $model->generals[0]->valve_clearance_check,],
                  ],
                ]).'<br/><h3>Chassis</h3>'.
                DetailView::widget([
                    'model' => $chassis,
                    'attributes' => [
                      ['label'=>'Frame', 'value' => $model->chasses[0]->frame,],
                      ['label'=>'Wheelbase', 'value' => $model->chasses[0]->wheelbase,],
                      ['label'=>'Rake', 'value' => $model->chasses[0]->rake,],
                      ['label'=>'Trail', 'value' => $model->chasses[0]->trail,],
                      ['label'=>'Front Suspension', 'value' => $model->chasses[0]->front_suspension,],
                      ['label'=>'Front Wheel', 'value' => $model->chasses[0]->front_wheel,],
                      ['label'=>'Front Wheel Travel', 'value' => $model->chasses[0]->front_wheel_travel,],
                      ['label'=>'Front Brake', 'value' => $model->chasses[0]->front_brake,],
                      ['label'=>'Front Tyre', 'value' => $model->chasses[0]->front_tyre,],
                      ['label'=>'Rear Suspension', 'value' => $model->chasses[0]->rear_suspsension,],
                      ['label'=>'Rear Wheel Travel', 'value' => $model->chasses[0]->rear_wheel_travel,],
                      ['label'=>'Rear Brake', 'value' => $model->chasses[0]->rear_brake,],
                      ['label'=>'Rear Wheel', 'value' => $model->chasses[0]->rear_wheel,],
                      ['label'=>'Rear Tyre', 'value' => $model->chasses[0]->rear_tyre,],
                      ['label'=>'Fuel Capacity', 'value' => $model->chasses[0]->fuel_capacity,],
                      ['label'=>'Dry Weight', 'value' => $model->chasses[0]->dry_weight,],
                      ['label'=>'Seat Height', 'value' => $model->chasses[0]->seat_height,],
                      ['label'=>'Max Height', 'value' => $model->chasses[0]->max_height,],
                      ['label'=>'Max Length', 'value' => $model->chasses[0]->max_length,],
                      ],
                      ]).'<br/><h3>Engine</h3>'.DetailView::widget([
                      'model' => $model,
                      'attributes' => [
                      ['label'=>'Type', 'value'=> $model->engines[0]->type,],
                      ['label'=>'Displacement', 'value'=> $model->engines[0]->displacement,],
                      ['label'=>'Bore and Stroke', 'value'=> $model->engines[0]->bore_and_stroke,],
                      ['label'=>'Compression Ratio', 'value'=> $model->engines[0]->compression_ratio,],
                      ['label'=>'Power', 'value'=> $model->engines[0]->power,],
                      ['label'=>'Torque', 'value'=> $model->engines[0]->torque,],
                      ['label'=>'Fuel Delivery', 'value'=> $model->engines[0]->fuel_injection,],
                      ['label'=>'Exhaust', 'value'=> $model->engines[0]->exaust,],
                      ['label'=>'Emissions', 'value'=> $model->engines[0]->emissions,],
                      ['label'=>'Gearbox', 'value'=> $model->engines[0]->gearbox,],
                      ['label'=>'Ratio', 'value'=> $model->engines[0]->ratio,],
                      ['label'=>'Primary Drive', 'value'=> $model->engines[0]->primary_drive,],
                      ['label'=>'Final Drive', 'value'=> $model->engines[0]->final_drive,],
                      ['label'=>'Clutch', 'value'=> $model->engines[0]->clutch,],
                      ],
                    ]),
            'active'=> false],
 
            [
            'label'=>'Finance',
            'content'=> DetailView::widget([
            'model' => $model->finance,
            'attributes'=>[
                  ['label'=>'Plan Name', 'value'=> $model->finance[0]->plan_name,],
                  ['label'=>'Deposit', 'value'=> $model->finance[0]->deposit,'format'=>'currency'],
                  ['label'=>'Total Credit', 'value'=> $model->finance[0]->total_credit, 'format'=>'currency'],
                  
                  ['label'=>'Purchase Fee', 'value'=> $model->finance[0]->purchase_fee,'format'=>'currency'],
                  ['label'=>'Credit Facilty Fee', 'value'=> $model->finance[0]->credit_facility_fee,'format'=>'currency'],
                  ['label'=>'Total Payable', 'value'=> $model->finance[0]->total_payable,'format'=>'currency'],
                  ['label'=>'Initial Payment', 'value'=> $model->finance[0]->initial_payment,'format'=>'currency'],
                  ['label'=>'Monthly Payments', 'value'=> $model->finance[0]->monthly_payments,'format'=>'currency'],
                  ['label'=>'Optional Final Payment', 'value'=> $model->finance[0]->optional_final_payment,'format'=>'currency'],
                  ['label'=>'Agreement Duration', 'value'=> $model->finance[0]->agreement_duration,],
                  ['label'=>'Representative APR', 'value'=> $model->finance[0]->representative_apr,'format'=>'percent'],
                  ['label'=>'Interest Rate', 'value'=> $model->finance[0]->interest_rate,'format'=>['percent',2]],
                  ['label'=>'Valid From', 'value'=> $model->finance[0]->date_from,'format'=>'date'],
                  ['label'=>'Valid To', 'value'=> $model->finance[0]->date_to,'format'=>'date'],
                  ]]) ,
            'active'=> false],
            [
            'label'=>'Offers',
            'content'=> '',//$this->render('@frontend/modules/views/the/_fullscreen'),
            'active'=> false],
            [
            'label'=>'Accessories',
            'content'=> ListView::widget([
                'dataProvider' => $dataProvider,
                //'slug'=>$model->alias,
                'itemOptions' => [
                'container' =>  'infinite',
                'class' => 'item'],
                'itemView' => function ($model, $key, $index, $widget) {
        return $this->render('_listItem',['model' => $model,]);
        
        // or just do some echo
        // return $model->title . ' posted by ' . $model->author;
    },//'_listItem',
                'pager' => ['triggerText'=>'Give me more!','triggerTemplate'=>'<div class="ias-trigger" style="text-align: center; cursor: pointer;"><h3><span class="label label-success"><a>{text}</a></span></h3></div>','noneLeftText'=>'That\'s all folks!!','class' => \kop\y2sp\ScrollPager::className()],
                ]),
            'active'=> false],
          ]]);

?>
   <div class='row'>
    <span class="hidden-lg-down">
    <?php
    // Create Slick slider_for Window here 
    echo Slick::widget([

            // HTML tag for container. Div is default.
            'itemContainer' => 'div',
            
            // HTML attributes for widget container
            'containerOptions' => ['class' => 'single-item'],
            
            // Items for carousel. Empty array not allowed, exception will be throw, if empty 
            'items' => $images2,

            // HTML attribute for every carousel item
            'itemOptions' => ['class' => 'hidden-lg-down'],
            
            // settings for js plugin
            // @see http://kenwheeler.github.io/slick/#settings
                'clientOptions' => [
                    'slidesToShow' => 1,
                    'slidesToScroll' => 1,
                    'asNavFor'=> 'slick-nav',

            // note, that for params passing function you should use JsExpression object
                'onAfterChange' => new JsExpression('function() {console.log("The cat has shown")}'),
            ],    
            ])
              ?>
    </span>
  </div>
</div>

