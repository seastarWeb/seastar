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

$this->title = 'Seastar catalogue of accessories for your motorcycle';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-product-lines-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h2>High quality accessories</h2>
    <div class="container">
        <div class="row">
            <?php // Pjax::begin();
            ?>
            <?php   echo TabsX::widget([
            'items' =>[
                    [
                    'label'=>'Browse  <i class="glyphicon glyphicon-camera"></i>',
                    'content'=> ListView::widget( ['dataProvider' => $dataProvider,
                        'itemOptions' => [
                        'container' =>  'infinite',
                        'class' => 'item'],
                        'itemView' => '_listMake',
                        'pager' => ['class' => \kop\y2sp\ScrollPager::className()],
                        ])
                    ,
                    'active'=>true
                    ],
                    [
                        'label' => 'Filter Results <i class="glyphicon glyphicon-filter"></i>',
                        'content' => $this->render('_searchForm', ['model' => $searchModel,]),
                        'active' => false
                    ], 
                ],
            'position'=>TabsX::POS_ABOVE,
            'align'=>TabsX::ALIGN_LEFT,
            'bordered'=>false,
            'encodeLabels'=>false]);
             ?>
            <?php // Pjax::end();
            ?>
        </div>
    </div>
</div>
