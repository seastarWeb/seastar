<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\nav\NavX; 
use kartik\sidenav\SideNav;
/* @var $this yii\web\View */
/* @var $searchModel common\models\BikeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Motorcycles';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="bikestock-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php \yii\widgets\Pjax::begin(); ?>
       <div class="row">
	  <div class="col-sm-6 col-md-4 col-lg-2">

            <?php
	    echo SideNav::widget(['items' => $filter, 'heading' => '<i class="glyphicon glyphicon-cog"></i> Make']);
            ?>
        </div>
        <div class="col-xs-9">
            <div class="thumbnail">
                <div class="Ducati-default-index">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
//                        'filterModel' => $searchModel,
            			'layout'=>'{pager}{items}{pager}',
                                    'columns' => [
                                        array(
                                        'format' => 'image',
                                        'value'=>function($data) { return 
            	                   		    \Yii::$app->request->getBaseUrl().'/uploads/images/bikestock/'.strtolower($data->id).'/1.jpg'; }, 
                                           ),
                                         'description',
            			                 ['class' => 'yii\grid\ActionColumn'],
                                        ],
                                ]); ?>
                </div>
                <?php \yii\widgets\Pjax::end(); ?>       
        </div>
    </div>        
    </div>        
</div>
