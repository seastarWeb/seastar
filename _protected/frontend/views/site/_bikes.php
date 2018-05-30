<?php
use kartik\helpers\Html;
use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;

$slick1= array();
foreach ($bikes as $bike){
     $slick1[]= Html::a($bike['Image'].Html::Panel(['heading' =>$bike['Model'].' <br>'.Html::badge('£'.$bike['Price'])]),'/motorcycles/approved-used/view?id='.$bike['ID']);
    }
?>
<div class='carousel'>
<?php 
 echo Slick::widget([

    'itemContainer' => 'div',
    'containerOptions' => ['class' => 'col-xs-12 col-sm-12 col-md-12'],
    'items' => $slick1,
    'itemOptions' => [
    'class' => 'image-rounded',
    ],
    'clientOptions' => [
    'autoplay' => true,
    'dots'     => true,
    'lazyLoad' => 'ondemand',
    'slidesToShow'=>5,
    'slidesToScroll'=>1,
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
    'onAfterChange' => new JsExpression('function() {console.log("The next bike has shown")}'),
    ],
    
   ]); 
/*
   */
   ?>
</div>