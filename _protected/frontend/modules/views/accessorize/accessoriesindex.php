<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Models;
use yii\widgets\ListView;

use kartik\grid\GridView;
use yii\bootstrap\Carousel;
use yii\jui\Accordion;
use kartik\nav\NavX;
use yii\widgets\Pjax;
use kartik\tabs\TabsX;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Button;
use yii\jui\Draggable;

$make=Yii::$app->controller->module->id;
$mod=$slug;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchModels */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Accessorize '.ucfirst($make).' '.$mod.' motorcycle ';
$this->params['breadcrumbs'][] = ['label'=> ucfirst($make), 'url' => ['/'.$make.'/ ']];
$this->params['breadcrumbs'][] = ['label'=> 'Accessorize', 'url' => ['/'.$make.'/accessorize/ ']];
//$this->params['breadcrumbs'][] = $this->title;


?>
<div class="model-accessories-index">
<h1><?= Html::encode($this->title) ?></h1>

            <?php Pjax::begin();?>
            <?php   echo TabsX::widget([
            'items' =>[
                    [
                    'label'=>'Browse  <i class="glyphicon glyphicon-camera"></i>',
                    'content'=> ListView::widget( ['dataProvider' => $dataProvider,
                        'layout' => "<div class='list-group'>Sort Results...{sorter}</div>\n{items}\n{pager}",
                        'itemOptions' => [
                        'container' =>  'infinite',
                        'class' => 'item'],
                        'itemView' => '_listItem',
                        'pager' => ['triggerText'=>'Click for  more...','triggerTemplate'=>'<div class="ias-trigger" style="text-align: center; cursor: pointer;"><h3><span class="label label-default"><a>{text}</a></span></h3></div>','noneLeftText'=>'That\'s all folks!!','class' => \kop\y2sp\ScrollPager::className()],
                        ])
                    ,
                    'active'=>true
                    ],
                    [
                        'label' => 'Filter Results <i class="glyphicon glyphicon-filter"></i>',
                        'content' =>$this->render('_search', ['model' => $searchModel,]),
                        'active' => false
                    ], 
                ],
            'position'=>TabsX::POS_ABOVE,
            'align'=>TabsX::ALIGN_LEFT,
            'bordered'=>false,
            'encodeLabels'=>false]);
             ?>
            <?php Pjax::end();?>
</div>


