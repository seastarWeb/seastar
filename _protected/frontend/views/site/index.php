<?php

/* @var $this yii\web\View */
 //die(var_dump($haspromo));

use yii\widgets\ListView;
use yii\helpers\Html;
use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;
$this->title = $model->title;
$this->registerMetaTag([
        'name' => 'description',
            'content' => Html::encode($model->metadesc) 
        ]);
?>

<div class="site-index">
    <h1><?=html::encode('Seastar Superbikes Kawasaki Norfolk & Norwich Ducati!!')?></h1>
   <div class='row visible-lg'>
    <?php
    if ($haspromo==true){
    // Create promotion slider here if required       
           echo '<p>'.$this->render('_listPromo', ['promos' => $promos, ]).'</p>' ;

        }
    ?>
  </div>
    <div class="body-content">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="col-sm-12"> 
                    <?= $model->page ?> 
                </div>
            </div>
            <div class="row">
                <div "children">
                    
                
                   <?php
                   /*
                * List view rendering subform _listItem with paging and images 
                */
                $i=0;
                echo ListView::widget( [
                        'dataProvider' => $dataProvider,
                        'itemView' => '_listItem',
                        'pager' => ['class' => \kop\y2sp\ScrollPager::className()],
                        'layout' => '{items}{pager}','itemOptions' => ['container' =>  'infinite',
                        'class' => 'item'],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
  
