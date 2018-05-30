<?php
use kartik\helpers\Html;
use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;
//die(var_dump($promos));
$slick1= array();
foreach ($promos as $promo){
     $slick1[]= Html::a($promo['img'],'#').Html::label('<h2>'.$promo['Title'].'</h2>'.$promo['Message']);//Html::Panel(['heading' =>$promo['Title'],'body' =>$promo['Message']]);
    }
?>
<div class='col-xs-12 col-sm-12 col-md-12'>
<?php 
 echo Slick::widget([

    'itemContainer' => 'div',
    'containerOptions' => ['class' => 'col-xs-12 col-sm-12 col-md-12'],
    'items' => $slick1,
    'itemOptions' => [
    'class' => 'image-rounded img-responsive',
    ],
    'clientOptions' => [
    'autoplay' => true,
    'dots'     => false,
    'lazyLoad' => 'ondemand',
     'autoplaySpeed'=>5000,
//    'centerMode'=> true,
    'slidesToShow'=>1,
    'slidesToScroll'=>1,
    'arrows'=>false,
    'swipeToSlide'=>true,
    'responsive'=>[
        [
        'breakpoint'=>840,
        'settings'=>[
            'slidesToShow'=>4,
            'slidesToScroll'=>1,
              ]
        ],
        [
        'breakpoint'=>700,
        'settings'=>[
            'slidesToShow'=>3,
            'slidesToScroll'=>1,
              ]
        ],
        [
        'breakpoint'=>480,
        'settings' => 'unslick',
        ],
    ],
    // note, that for params passing function you should use JsExpression object
    'onAfterChange' => new JsExpression('function() {console.log("The next promotion has shown")}'),
    ],
    
   ]); 
/*
   */
   ?>
</div>

