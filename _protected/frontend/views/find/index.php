<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use kartik\tabs\TabsX;
//ause kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SearchPL */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Results';
$this->params['breadcrumbs'][] = $this->title;
$term = Yii::$app->request->queryParams;
$txt=$term['SearchTerm'];
?>
<div class="tbl-product-lines-index">
    <div class="jumbotron">
        <h1>Showing results for ...'<?=$txt?>'</h1>
    </div>

    <div class="container">
        <div class="row">
            <?php Pjax::begin();?>
            <?php   echo TabsX::widget([
            'items' =>[
                    [
                    'label'=>'Browse Clothing & Accessories <i class="glyphicon glyphicon-camera"></i>',
                    'content'=> ListView::widget( ['dataProvider' => $dataProvider,
                        'itemOptions' => [
                        'container' =>  'infinite',
                        'class' => 'item'],
                        'itemView' => '_listItem',
                        'pager' => ['triggerText'=>'Click for  more...','triggerTemplate'=>'<div class="ias-trigger" style="text-align: center; cursor: pointer;"><h3><span class="label label-default"><a>{text}</a></span></h3></div>','noneLeftText'=>'That\'s all folks!!','class' => \kop\y2sp\ScrollPager::className()],
                        ])
                    ,
                    'active'=>true
                    ],
                ],
            'position'=>TabsX::POS_ABOVE,
            'align'=>TabsX::ALIGN_LEFT,
            'bordered'=>false,
            'encodeLabels'=>false]);
             ?>
            <?php Pjax::end();?>
        </div>
    </div>
</div>
